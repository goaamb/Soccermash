<?PHP
// Se crea un objeto oDBM por cada Base de Datos a la que quiera acceder 
// 

class CLASS_DB extends CLASS_Main{
	/**
	Properties
	**/
	var $_sType 			= NULL;
	var $_sUserName 		= NULL;
	var $_sPassword 		= NULL;
	var $_sHost 			= 'localhost';
	var $_iPort 			= 0;
	var $_sName 			= NULL;
	var $_mLastId 			= NULL;
	var $_iAffectedRows 	= 0;
	var $_iLinkId 			= NULL;
	var $_iLastResult 	= NULL;
	var $_sTable 			= NULL;


	/**
	@method:: IWSL_CLASS_Dbm2
	@desc:: Constructor
	**/
	function __construct()
	{
		$this->CLASS_Main();
	}#END ISLW_CLASS_Dbm2()
	

	/**
	@method:: Setup
	@param::	@str : $sType : Tipo de RDBMS: Mysql | Oracle
				@str : $sServer : Nombre o IP del servidor
				@int : $iPort : Puerto
				@str : $sUser : Nombre de Usuario
				@str : $sPassword : Contraseña para el usuario
				@str : $sName : Nombre de las base de datos a seleccionar
				@str : $bConnect : Si admite múltiples conexiones. Por defecto TRUE
	@out:: 	true | false si pudo conectarse a la base de datos
	**/
	function Setup($sType = NULL, $sServer = NULL, $iPort = NULL, $sUser = NULL, $sPassword = NULL, $sName = NULL, $bConnect = true){

		$this->_sType = $sType;
		$this->_sHost = $sServer;
		$this->_iPort = $iPort;
		$this->_sUserName = $sUser;
		$this->_sPassword = $sPassword;
		$this->_sName = $sName;

		if ($bConnect){
			return $this->Connect();
		}

		return true;

	}#END Register



	/**
	@method:: Connect
	@desc:: Se conecta a la base de datos
	@out: Devuelve true si logró conectarse, false sinó
	**/
	function Connect(){

		global $SITE_oError;

		if ($this->_iLinkId = mysql_connect($this->_sHost, $this->_sUserName, $this->_sPassword, true)){
			if (mysql_select_db($this->_sName, $this->_iLinkId)){
				mysql_query ("SET NAMES 'utf8'");
				return true;
			}else{
				$SITE_oError->SetError('SITE_oDB_CantSelectDb', $this->_sHost, mysql_error());
			}
		}else{
			$SITE_oError->SetError('SITE_oDB_CantConnect', $this->_sHost, mysql_error());
		}
		return false;
	}#END Connect



	/**
	@method:: Query
	@desc:: Envía una consulta al servidor
	**/
	function Query($sDB_Sql, $bDebug = false){

		global $SITE_oError;

		if ($bDebug) echo '<TT>' . $sDB_Sql . '<br>';
		
		$this->_iLastResult = mysql_query($sDB_Sql, $this->_iLinkId);

		if (!$this->_iLastResult){
			$SITE_oError->SetError('SITE_oDB_QueryError', __FILE__, __LINE__, mysql_errno($this->_iLinkId), mysql_error($this->_iLinkId), $sDB_Sql);
		}

		$this->_mLastId = mysql_insert_id($this->_iLinkId);

		$this->_iAffectedRows = mysql_affected_rows($this->_iLinkId);

		if ($bDebug){
			echo 'ID Resultado.......: ' . $this->_iLastResult . '<br>';
			echo 'Auto ID............: ' . mysql_insert_id($this->_iLinkId) . '<br>';
			echo 'Filas afectadas....: ' . mysql_affected_rows($this->_iLinkId) . '<br>';
			echo 'Filas recuperadas..: ' . mysql_num_rows($this->_iLastResult) . '<br>';
			echo '</TT>';
		}

		return $this->_iLastResult;

	}#END Query()



	/**
	@method:: GetLastId
	@parameters:: 
	@output:: 
	@desc:: 	Devuelve el ID generado en la última operación INSERT. Solo devuelve
				un valor cuando la operación INSERT se hizo sin un ID explícito.
	**/
	function GetLastId(){

		return (isset($this->_mLastId) ? $this->_mLastId : false);

	}#END GetLastId()



	function GetAffectedRows(){

		return (isset($this->_iAffectedRows) ? $this->_iAffectedRows : 0);

	}#END GetAffectedRows()



	/**
	@method:: GetNumRows
	@parameters:: mix $DB_Result : ID del resultado
	@output:: int : Número de filas recuperadas por una sentencia SQL SELECT.
	@desc:: Devuelve el número de filas recuperadas por una sentencia SELECT.
	**/
	function GetNumRows($DB_Result = NULL){

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;

		return mysql_num_rows($DB_Result);

	}#END $DB_Result;


	/**
	 * @method: Count
	 * @return: int Cantidad de filas encontradas
	 * @param $sSQL_Select Object
	 */
	function Count($sField, $sTable, $sWhere = NULL)
	{
		$sSQL_Select = GenerateSelect("COUNT($sField) as cant", $sTable, $sWhere);
		$DB_Result = $this->Query($sSQL_Select);
		$aRow = $this->FetchRowAssoc($DB_Result);
		return $aRow['cant'];
	}#END Count;


	/**
	@method:: FetchRowAssoc
	@parameters:: mix : $DB_Result : ID del resultado
	@output:: ARRAY asociativo con las columnas seleccionadas o FALSE sinó puede recuperar nada 
	@desc:: Recupera en un array asociativo una fila de un DB_Result. Los índices del
	        array son los nombres de las columnas.
	**/
	function FetchRowAssoc($DB_Result = NULL, $bFreeResult = FALSE){
	
		$aRow = array();

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;
		$aRow = mysql_fetch_assoc($DB_Result);
		if ($bFreeResult) $this->FreeResult($DB_Result);
		return $aRow;

	}#END FetchRowAssoc()



	/**
	@method:: FetchRow
	@parameters:: mix : $DB_Result : ID del resultado
	@output:: Array ordinario con los valores de la fila recuperada.
	@desc:: Recupera en un array ordinario una fila de un DB_Result.
	**/
	function FetchRow($DB_Result = NULL, $bFreeResult = FALSE){

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;
		$aRow = mysql_fetch_array($DB_Result);
		if ($bFreeResult) $this->FreeResult($DB_Result);
		return $aRow;

	}#END FetchRowAssoc()



	/**
	@method:: FetchRowAssoc
	@param:: mix : $DB_Result : ID del resultado
	@desc:: Recupera en un array asociativo por $sColId todas las filas de un ResultSet.
           y libera el resultado de la memoria.
	@output:: Array asociativo con los campos. Un array vacío si no pudo recuperar nada.
	**/
	function FetchRowsAssoc($DB_Result = NULL, $sColId = NULL){

		$aRow = array();
		$aRows = array();

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;
		if (empty($sColId)) die ('FetchRowsAssoc() : No indicó el parámetro sColId');

		while ($aRow = mysql_fetch_assoc($DB_Result)){
			$aRows[$aRow[$sColId]] = $aRow;
		}

		$this->FreeResult($DB_Result);

		return $aRows;

	}#END FetchArrayAssoc()



	/**
	@method:: FetchRows
	@desc:: Genera array ordinario con todos los resultados de un ResultSet. Libera el Resultado de la memoroia
	@parameters:: mix : $DB_Result : ID del Resultado
	@output:: Array ordinario con todos las filas de un ResultSet.
	**/
	function FetchRows($DB_Result = NULL){

		$aRow = array();
		$aRows = array();

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;

		while ($aRow = mysql_fetch_assoc($DB_Result)){
			$aRows[] = $aRow;
		}

		$this->FreeResult($DB_Result);

		return $aRows;

	}#END FetchRows()

	function fetchRowObject($DB_Result = NULL, $bFreeResult = false)
	{
		$aRow = array();
		if ($DB_Result === NULL) $DB_Result = $this->iLastResult;
		$aRow = (object)mysql_fetch_assoc($DB_Result);
		if ($bFreeResult) $this->FreeResult($DB_Result);
		return $aRow;
	}#END fetchRowObject()

	function getArray($sFields = NULL, $sWhere = NULL, $sOrder = NULL, $iOffset = NULL, $iRows = NULL, $sCampo = NULL)
	{
		$sSQL_Select = GenerateSelect($sFields, $this->sTable, $sWhere, $sOrder, $iOffset, $iRows);
		$DB_Result = $this->oDB->Query($sSQL_Select);
		return $this->oDB->FetchRowsAssoc($DB_Result, $sCampo);
	}



	/**
	@method:: FreeResult
	@desc:: Libera un resultado
	@parameters:: mix : $DB_Result
	**/	
	function FreeResult($DB_Result){

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;

		@mysql_free_result($DB_Result);

		return true;

	}#END FreeResult()


	function GetDBName(){
		return $this->_sName;
	}#END GetDBName()


	function GetTableInfo($sTableName = NULL){
		if (!is_null($sTableName)){
			if ($DB_Result = $this->Query( "SHOW TABLE STATUS FROM `" . $this->GetDBName() . "` LIKE '" . $sTableName . "';")){
				return $this->FetchRowAssoc($DB_Result, true);
			}
		}
		return false;
	}#END GetTableInfo()


	function &ShowCreateTable($sTableName)
	{
		$DB_Result = $this->Query(sprintf('SHOW CREATE TABLE `%s`', $sTableName));
		$aRow = $this->FetchRow($DB_Result) ;
		$this->FreeResult($DB_Result) ;
		return $aRow[1] ;
	}#END ShowCreateTable()



    function db_real_escape_string($theString, $dblink)
    {
        trigger_error("db_real_escape_string method must be overridden", E_USER_ERROR) ;
    }

}#END ISWL_CLASS_Dbm{}
?>
