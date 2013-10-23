<?PHP
// Se crea un objeto oDBM por cada Base de Datos a la que quiera acceder

class CLASS_DBObject{
	/**
	Properties
	**/
	private $_sType 			= NULL;
	private $_sUserName 		= NULL;
	private $_sPassword 		= NULL;
	private $_sHost 			= 'localhost';
	private $_iPort 			= 0;
	private $_sName 			= NULL;
	private $_mLastId 			= NULL;
	private $_iAffectedRows 	= 0;
	private $_iLinkId 			= NULL;
	private $_iLastResult 	= NULL;

	public $_sTable 			= NULL;
	public $sFields 			= NULL;
	public $_mId 				= NULL;
	public $_mEstado 			= NULL;
	public $_mOrden 			= NULL;

	public $aErrores 		= array();

	/**
	@method:: IWSL_CLASS_DBObjectm2
	@desc:: Constructor
	**/
	public function __construct()
	{
		$this->Setup('mysql', SITE_DB_Host, NULL, SITE_DB_User, SITE_DB_Pass, SITE_DB_Name, true);
	}#END __construct()


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
	public function Setup($sType = NULL, $sServer = NULL, $iPort = NULL, $sUser = NULL, $sPassword = NULL, $sName = NULL, $bConnect = true)
	{
		$this->_sType     = $sType;
		$this->_sHost     = $sServer;
		$this->_iPort     = $iPort;
		$this->_sUserName = $sUser;
		$this->_sPassword = $sPassword;
		$this->_sName     = $sName;

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
	public function Connect(){

		global $SITE_oError;

		if ($this->_iLinkId = mysql_connect($this->_sHost, $this->_sUserName, $this->_sPassword, true)){
			if (mysql_select_db($this->_sName, $this->_iLinkId)){
				return true;
			}else{
				//Debemos mostrar el error de que no se pudo conectar a la base de datos
				//Hacemos esto de manera provisional
				printl("No se pudo hacer uso de la BD");
			}
		}else{
			printl("No se pudo conectar a la BD");
		}
		return false;
	}#END Connect



	/**
	@method:: Query
	@desc:: Envía una consulta al servidor
	**/
	public function Query($sDB_Sql, $bDebug = false){

		global $SITE_oError;

		$this->_iLastResult = mysql_query($sDB_Sql, $this->_iLinkId);

		if (!$this->_iLastResult){
			printl("No se pudo realizar la consulta");
			printl("---- CONSULTA:");
			printl($sDB_Sql);
			printl("---- ERROR:");
			printl(mysql_error());
			if($bDebug)
			{
				printl(mysql_error($this->iLinkId));
				printl($sDB_Sql);
			}
			exit;
		}

		$this->_mLastId = mysql_insert_id($this->_iLinkId);

		$this->_iAffectedRows = mysql_affected_rows($this->_iLinkId);

		if ($bDebug)
		{
			printt($sDB_Sql);
			printl('ID Resultado.......: ' . $this->iLastResult);
			printl('Auto ID............: ' . mysql_insert_id($this->iLinkId));
			printl('Filas afectadas....: ' . $this->iAffectedRows);
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
	public function GetLastId(){

		return (isset($this->_mLastId) ? $this->_mLastId : false);

	}#END GetLastId()



	public function GetAffectedRows(){

		return (isset($this->_iAffectedRows) ? $this->_iAffectedRows : 0);

	}#END GetAffectedRows()



	/**
	@method:: GetNumRows
	@parameters:: mix $DB_Result : ID del resultado
	@output:: int : Número de filas recuperadas por una sentencia SQL SELECT.
	@desc:: Devuelve el número de filas recuperadas por una sentencia SELECT.
	**/
	public function GetNumRows($DB_Result = NULL){

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;

		return mysql_num_rows($DB_Result);

	}#END $DB_Result;


	public function count($sWhere = NULL)
	{
		if ($aRow = $this->FetchRowAssoc($this->Query(GenerateSelect("COUNT({$this->_mId}) as cant", $this->_sTable, $sWhere))))
		{
			return $aRow['cant'];
		}
		return 0;
	}#END Count;

	public function Max($sField, $sWhere = NULL)
	{
		if ($aRow = $this->FetchRowAssoc($this->Query(GenerateSelect("MAX({$sField}) as max", $this->_sTable, $sWhere))))
		{
			return $aRow['max'];
		}
		return 0;
	}#END Count;

	/**
	@method:: FetchRowAssoc
	@parameters:: mix : $DB_Result : ID del resultado
	@output:: ARRAY asociativo con las columnas seleccionadas o FALSE sinó puede recuperar nada
	@desc:: Recupera en un array asociativo una fila de un DB_Result. Los índices del
	        array son los nombres de las columnas.
	**/
	public function FetchRowAssoc($DB_Result = NULL, $bFreeResult = FALSE){

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
	public function FetchRow($DB_Result = NULL, $bFreeResult = FALSE){

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
	public function FetchRowsAssoc($DB_Result = NULL, $sColId = NULL){

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
	public function FetchRows($DB_Result = NULL){

		$aRow = array();
		$aRows = array();

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;

		while ($aRow = mysql_fetch_assoc($DB_Result)){
			$aRows[] = $aRow;
		}

		$this->FreeResult($DB_Result);

		return $aRows;

	}#END FetchRows()

	public function fetchRowObject($DB_Result = NULL, $bFreeResult = false)
	{
		$aRow = array();
		if ($DB_Result === NULL) $DB_Result = $this->iLastResult;
		$aRow = (object)mysql_fetch_assoc($DB_Result);
		if ($bFreeResult) $this->FreeResult($DB_Result);
		return $aRow;
	}#END fetchRowObject()


	public function FetchRowsObject($DB_Result = NULL, $sColId = NULL){

		$aRow = array();
		$aRows = array();

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;
		if (empty($sColId)) die ('FetchRowsAssoc() : No indicó el parámetro sColId');

		while ($aRow = mysql_fetch_assoc($DB_Result)){
			if (is_null($sColId)) $aRows[] = (object)$aRow;
			else $aRows[$aRow[$sColId]] = (object)$aRow;
		}
		$this->FreeResult($DB_Result);
		return $aRows;
	}#END FetchArrayAssoc()


	function insert($aData, $bAplicarSlashes = true)
	{   //die('entro');
		return $this->Query(GenerateInsert($this->_sTable, $aData, $bAplicarSlashes));
	}

	function update($aData, $mValue, $bAplicarSlashes = true)
	{
		if($this->Query(GenerateUpdate($this->_sTable, $aData, "{$this->_mId}=$mValue", $bAplicarSlashes))){
			#getObjeto('xmls')->guardar();
			return true;
		}

		return false;
	}

	function delete($mValue = NULL, $sWhere = NULL)
	{
		if (!is_null($mValue)) $aWhere[] = "{$this->_mId}='$mValue'";
		if (!is_null($sWhere)) $aWhere[] = $sWhere;
		$mWhere = (isset($aWhere) ? implode(' AND ', $aWhere) : '');
		return $this->Query("DELETE FROM {$this->_sTable} WHERE $mWhere;");
	}

	public function __call($sNombreMetodo, $aArgumentos)
	{
		$aMetodos = array('gets', 'get', 'cruzar');
		if(!in_array($sNombreMetodo, $aMetodos))
		{
			trigger_error("Metodo <strong>$sNombreMetodo</strong> no existe", E_USER_ERROR);
		}

		switch ($sNombreMetodo)
		{
			case 'gets':
				if (is_array($aArgumentos[0]))
				{
					return $this->gets_object($aArgumentos[0]);
				}
				else
				{
					$aOptions['type'] = $aArgumentos[0];
					if (isset($aArgumentos[1])) $aOptions['fields'] = $aArgumentos[1];
					if (isset($aArgumentos[2])) $aOptions['where'] 	= $aArgumentos[2];
					if (isset($aArgumentos[3])) $aOptions['order'] 	= $aArgumentos[3];
					if (isset($aArgumentos[4])) $aOptions['offset'] = $aArgumentos[4];
					if (isset($aArgumentos[5])) $aOptions['rows'] 	= $aArgumentos[5];
					if (isset($aArgumentos[6])) $aOptions['campo'] 	= $aArgumentos[6];
					return $this->gets_object($aOptions);
				}
				break;

			case 'get':
				if (is_array($aArgumentos[0]))
				{
					$aArgumentos[0]['offset'] 	= 0;
					$aArgumentos[0]['rows'] 	= 1;
					unset($aArgumentos[0]['campo']);
					if ($aRows = $this->gets_object($aArgumentos[0])) return $aRows[0];
				}
				else
				{
					$aOptions['type'] = $aArgumentos[0];
					if (isset($aArgumentos[1])) $aOptions['fields'] = $aArgumentos[1];
					if (isset($aArgumentos[2])) $aOptions['where'] 	= $aArgumentos[2];
					if (isset($aArgumentos[3])) $aOptions['order'] 	= $aArgumentos[3];
					$aOptions['offset'] = 0;
					$aOptions['rows']	= 1;
					return $this->gets_object($aOptions);
				}
				break;

			case 'cruzar':
				if (is_array($aArgumentos[0]))
				{
					return $this->gets_object($aArgumentos[0]);
				}
				else
				{
					$aOptions['type'] = $aArgumentos[0];
					if (isset($aArgumentos[1])) $aOptions['table'] 		= $aArgumentos[1];
					if (isset($aArgumentos[2])) $aOptions['forenkey'] 	= $aArgumentos[2];
					if (isset($aArgumentos[3])) $aOptions['fields'] 	= $aArgumentos[3];
					if (isset($aArgumentos[4])) $aOptions['where'] 		= $aArgumentos[4];
					if (isset($aArgumentos[5])) $aOptions['order'] 		= $aArgumentos[5];
					if (isset($aArgumentos[6])) $aOptions['offset'] 	= $aArgumentos[6];
					if (isset($aArgumentos[7])) $aOptions['rows'] 		= $aArgumentos[7];
					if (isset($aArgumentos[8])) $aOptions['campo'] 		= $aArgumentos[8];
					return $this->gets_object($aOptions);
				}
				break;
		}
	}

	public function gets_object($aOption)
	{
		if (!isset($aOption['type'])) $aOption['type'] = 'object';

		if (isset($aOption['sql']))
		{
			return $this->gets_sql($aOption['type'], $aOption['sql'], (isset($aOption['campo']) ? $aOption['campo'] : NULL));
		}
		if (!isset($aOption['fields'])) 	$aOption['fields'] 	= $this->sFields;
		if (!isset($aOption['where'])) 	$aOption['where'] 	= NULL;
		if (!isset($aOption['order'])) 	$aOption['order'] 	= NULL;
		if (!isset($aOption['offset'])) 	$aOption['offset'] 	= NULL;
		if (!isset($aOption['rows'])) 	$aOption['rows'] 		= NULL;
		if (!isset($aOption['group'])) 	$aOption['group'] 	= NULL;
		$mTables = $this->_sTable;
		if (isset($aOption['table']))
		{
			$mTables = array($this->_sTable, $aOption['table']);
			$aOption['where'] = array($aOption['forenkey'], $aOption['where']);
		}
		return $this->gets_sql($aOption['type'], GenerateSelect($aOption['fields'], $mTables, $aOption['where'], $aOption['order'], $aOption['offset'], $aOption['rows'], $aOption['group']), (isset($aOption['campo']) ? $aOption['campo']: NULL));
	}

	private function gets_sql($sTipoObjeto, $sSQL, $sCampo = NULL)
	{
		if ($sTipoObjeto == 'objeto'){
			return $this->FetchRowsObject($this->Query($sSQL), $sCampo);
		}elseif ($sTipoObjeto = 'array'){
			if (is_null($sCampo)) return $this->FetchRows($this->Query($sSQL));
			return $this->FetchRowsAssoc($this->Query($sSQL), $sCampo);
		}
		return false;
	}


	function setEstado($iRegistroId, $iEstado)
	{
		return $this->update(array($this->_mEstado => $iEstado), $iRegistroId);
	}


	public function getMetaField(){
		global $SITE_aLang;

		$sBase = $this->_metaField;

		if(empty($SITE_aLang)) return $sBase;
		if(!defined('SITE_LENGUAJE')) return $sBase;
		if(empty($SITE_aLang[SITE_LENGUAJE]['extra'])) return $sBase;

		return $sBase . $SITE_aLang[SITE_LENGUAJE]['extra'];
	}

	function makeMeta(&$aDatos){

		$aFields = explode(",", str_replace(" ", "", $this->sFields));
		$aMetaFields = explode(",", str_replace(" ", "", $this->metaFields));

		if(is_array($aFields)){

			foreach($aDatos as $sField => $sValue){
				if(in_array($sField, $aMetaFields)){
					$aMeta[$sField] = $sValue;
					unset($aDatos[$sField]);
				}else{
					//unset($aDatos[$sField]);
				}
			}

		}

		return serialize($aMeta);
	}

	function returnMeta(&$aDatos, $aMetaData){

		$aMetaData = unserialize($aMetaData);
		if(is_array($aMetaData)){
			$aDatos = array_merge($aDatos, $aMetaData);
		}

		return $aDatos;
	}

	function setOrden($iRegistroId, $iNewOrden, $mWhere = NULL)
	{
		if ($iNewOrden > 0)
		{
			$aDatos = $this->gets(array('type' => 'array', 'fields' => "{$this->_mId}, {$this->_mOrden}", 'where' => $mWhere, 'order' => "{$this->_mOrden} ASC", 'campo' => $this->_mOrden));
			if (isset($aDatos[$iNewOrden]) && $aDatos[$iNewOrden][$this->_mId] == $iRegistroId) return;
			if (!isset($aDatos[$iNewOrden]))
			{
				$this->update(array($this->_mOrden => $iNewOrden), $iRegistroId);
				return;
			}

			$bEncontroPosicion = false;
			$aUpdates = array();
			foreach ($aDatos as $iOrden => $aRow)
			{
				if ($aRow[$this->_mId] == $iRegistroId) continue;
				if ($iOrden > $iNewOrden)
				{
					if (!$bEncontroPosicion)
					{
						$this->update(array($this->_mOrden => $iNewOrden), $iRegistroId);
						return true;
					}
					else
					{
						$aUpdates[] = array($aRow[$this->_mId], $iOrden);
					}
				}
				elseif ($iOrden == $iNewOrden)
				{
					$bEncontroPosicion = true;
					$aUpdates[] = array($iRegistroId, $iNewOrden);
					$aUpdates[] = array($aRow[$this->_mId], $iOrden);
				}
			}

			# Modificamos todos los registros afectados
			if (sizeof($aUpdates) > 0)
			{
				$aActual = array_shift($aUpdates);
				$this->update(array($this->_mOrden => $aActual[1]), $aActual[0]);

				$iOrdenActual = $aActual[1];

				foreach ($aUpdates as $iProdId => $aUpdate)
				{
					$iOrden = $aUpdate[1];
					if ($iOrdenActual == $aUpdate[1])
					{
						$iOrdenActual = $aUpdate[1]+1;
						$this->update(array($this->_mOrden => $iOrdenActual), $aUpdate[0]);
					}
				}
				return true;
			}
		}
	}#setOrden()


	public function setFields($sFields) { $this->sFields = $sFields; }
	public function setTable($sTableName) { $this->_sTable = $sTableName; }
	public function setId($mId) { $this->_mId = $mId; }
	public function setFieldOrden($mOrden) { $this->_mOrden = $mOrden; }
	public function setFieldEstado($mEstado) { $this->_mEstado = $mEstado; }
	public function setFieldsAction ($aFields)
	{
		if (isset($aFields['id'])) $this->setId($aFields['id']);
		if (isset($aFields['orden'])) $this->setFieldOrden($aFields['orden']);
		if (isset($aFields['estado'])) $this->setFieldEstado($aFields['estado']);
	}


	/**
	@method:: FreeResult
	@desc:: Libera un resultado
	@parameters:: mix : $DB_Result
	**/
	public function FreeResult($DB_Result){

		if ($DB_Result === NULL) $DB_Result = $this->_iLastResult;

		@mysql_free_result($DB_Result);

		return true;

	}#END FreeResult()


	public function GetDBName(){
		return $this->_sName;
	}#END GetDBName()


	public function GetTableInfo($sTableName = NULL){
		if (!is_null($sTableName)){
			if ($DB_Result = $this->Query( "SHOW TABLE STATUS FROM `" . $this->GetDBName() . "` LIKE '" . $sTableName . "';")){
				return $this->FetchRowAssoc($DB_Result, true);
			}
		}
		return false;
	}#END GetTableInfo()


	public function &ShowCreateTable($sTableName)
	{
		$DB_Result = $this->Query(sprintf('SHOW CREATE TABLE `%s`', $sTableName));
		$aRow = $this->FetchRow($DB_Result) ;
		$this->FreeResult($DB_Result) ;
		return $aRow[1] ;
	}#END ShowCreateTable()


    public function db_real_escape_string($theString, $dblink)
    {
        trigger_error("db_real_escape_string method must be overridden", E_USER_ERROR) ;
    }

	# Retorna los errores ocurridos
	function getErrores()
	{
		return $this->aErrores;
	}#getErrores()

}#END ISWL_CLASS_DBObjectm{}
?>