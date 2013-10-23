<?PHP
/* ******************                 ***********/
/*  Aqui estan las function comunes del site
 *  incluyendo este archivo podes utilizar dichas
 *  function
 * 
 * 
 * 
 */
 
 ////translation///////
 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
 require_once $_GBASE. '/goaamb/idioma.php';
if(class_exists("Idioma")){
     $_IDIOMA=Idioma::darLenguaje();
  }
 


/*******************                 ***********/
    function getObjeto($sNameObject) {
		global $SITE;
		return $SITE->getObjeto($sNameObject);
    } 
    
	function makeListByArray($array = array(0 => 'Sin Datos'), $fieldName, $fieldClass = "", $select = 0, $attachedFunction = "") {
		$sReturn = null;
		
		if(!$array OR !is_array($array)){
			return false;
		}
		
		$sReturn = "<select name=\"" . $fieldName . "\" id=\"" . $fieldName . "\" class=\"" . $fieldClass . "\"" . $attachedFunction . ">";
			
		if ($select) {
			$sReturn .= "<option value=\"0\">" . $select . "</option>\n";
		}
		
		$check = null;
		
		foreach($array as $k => $toShow) {
			
			$check = (!empty($_POST[$fieldName]) AND $_POST[$fieldName]) ? " SELECTED" : '';
			
			/*
			foreach ($fields AS $key => $field) {
				if ($show) {
					$show .= " " . $row[$field];
				}else{
					$show = $row[$field];
				}
			}
			*/
			
			$sReturn .= "<option value=\"" . $k . "\"" . $check . ">" . $toShow . "</option>\n";
			
			unset($show);
		}
		$sReturn .= "</select>";
		
		return $sReturn;
	}
	
	function MakeCData($sString){
		
		$sString = ReplaceTags($sString);
		
		if(!empty($sString)){
			return '<![CDATA[' . $sString . ']]>';
		}
		
		return '';
		
	}
	
	function ReplaceTags($sString){
		/*
		$sString = @html_entity_decode(strip_tags($sString), ENT_QUOTES, "UTF-8");
		
		$aSearch = array("á", "é", "í", "ó", "ú", "ñ");
		$aReplace = array("Á", "É", "Í", "Ó", "Ú", "Ñ");
		
		
		return str_replace($aSearch, $aReplace, $sString);
		*/
		return @html_entity_decode(strip_tags($sString), ENT_QUOTES, "UTF-8");
	}
	

	#retorna el año de cant. q le pasa
	function getAnio($iCantAnio){
		$anionow 	= date("Y");
		$anioOld=$anionow-(int)$iCantAnio;
		return $anioOld;
		
	}
	#La edad viene en format: yyyy-mm-dd, retorna un int c/ la edad actual
	function edad($edad){
		$time=strtotime($edad);
		if($time!=0){
		$anio_dif 	= date("Y") - date("Y",$time);
		$mes_dif 	= date("m") - date("m",$time);
		$dia_dif 	= date("d") - date("d",$time);
	
		if( $mes_dif < 0)
			return $anio_dif=($anio_dif-1);
		else
		if($mes_dif==0)	
			if($dia_dif < 0)	
				return $anio_dif=($anio_dif-1);
				
	    return $anio_dif;
		}
		return "";			
	}


	//La edad viene en format: yyyy-mm-dd, retorno dd/mm/yyyy
	function explodeEdad($edad){
		//list($anio,$mes,$dia) = explode("-",$edad);
		return date("d/m/Y",strtotime($edad));
	}
	
	#retorna el nombre de la posicion de un player
	function namePosition($iPosition){
		global $_IDIOMA;
	#estas posiciones NO se corresponden c/ las verdaderas, sino 
	#con un ordenamiento con el que se guardan
	if($iPosition==1){	
		return $nNamePosition=$_IDIOMA->traducir("Goalkeeper");  break;
	}
	if($iPosition==2){
		return $nNamePosition=$_IDIOMA->traducir("Left Back");	break;
	}
	if($iPosition==3){
		return $nNamePosition=$_IDIOMA->traducir("Central Back Left");	break;
	}
	if($iPosition==4){
		return $nNamePosition=$_IDIOMA->traducir("Central Back Right");	break;
	}
	if($iPosition==5){
		return $nNamePosition=$_IDIOMA->traducir("Right Back");	break;
	}
	if($iPosition==6){
		return $nNamePosition=$_IDIOMA->traducir("Defensive Midfielder");	break;
	}
	if($iPosition==7){
		return $nNamePosition=$_IDIOMA->traducir("Creative Midfielder");	break;
	}
	if($iPosition==8){
		return $nNamePosition=$_IDIOMA->traducir("Left Wing");	break;
	}

	if($iPosition==9){
		return $nNamePosition=$_IDIOMA->traducir("Right Wing");	break;
	}
	if($iPosition==10){
		return $nNamePosition=$_IDIOMA->traducir("Play Maker / Second Striker");	break;
	}
	if($iPosition==11){
		return $nNamePosition=$_IDIOMA->traducir("Target Striker");	break;
	}
}
	
	
#obtine el nombre del perfil y lo retorna
function nameProfile($profileId){
 global $_IDIOMA;
 if($profileId==1){
    $profile=$_IDIOMA->traducir("Comunity Manager");
   }elseif($profileId==2){
    $profile=$_IDIOMA->traducir("Professional Player  Under Contract");
   }elseif($profileId==3){
    $profile=$_IDIOMA->traducir("Professional Player Without Contract");
   }elseif($profileId==5){
    $profile=$_IDIOMA->traducir("Amateur Player");
   }elseif($profileId==6){
    $profile=$_IDIOMA->traducir("Professional Ex Player"); 
   }elseif($profileId==7){
    $profile=$_IDIOMA->traducir("Coach Under Contract");
   }elseif($profileId==8){
    $profile=$_IDIOMA->traducir("Coach Without Contract");
   }elseif($profileId==9){
    $profile=$_IDIOMA->traducir("Goalkeeper Coach Under Contrac");
   }elseif($profileId==10){
    $profile=$_IDIOMA->traducir("Goalkeeper Coach Without Contrac");
   }elseif($profileId==11){
    $profile=$_IDIOMA->traducir("Physical Coach Under Contract");
   }
 elseif($profileId==12){
    $profile=$_IDIOMA->traducir("Physical Coach Without Contract");
   }
 elseif($profileId==13){
    $profile=$_IDIOMA->traducir("Licensed FIFA Agent");
   }
 elseif($profileId==14){
    $profile=$_IDIOMA->traducir("Licensed UEFA Agent");
   }
 elseif($profileId==15){
    $profile=$_IDIOMA->traducir("Authorized Agent");
   }
 elseif($profileId==16){
    $profile=$_IDIOMA->traducir("Scouting");
   }
 elseif($profileId==17){
    $profile=$_IDIOMA->traducir("Lawyer");
   }
 elseif($profileId==18){
    $profile=$_IDIOMA->traducir("Sport Director");
   }
 elseif($profileId==19){
    $profile=$_IDIOMA->traducir("Technical Secretary");
   }
 elseif($profileId==20){
    $profile=$_IDIOMA->traducir("Sport Doctor");
   }
 elseif($profileId==21){
    $profile=$_IDIOMA->traducir("Nutritionist");
   }
 elseif($profileId==22){
    $profile=$_IDIOMA->traducir("Massagist");
   }
 elseif($profileId==23){
    $profile=$_IDIOMA->traducir("Fan");
   }
 elseif($profileId==24){
    $profile=$_IDIOMA->traducir("Journalist");
   }
 elseif($profileId==25){
    $profile=$_IDIOMA->traducir("Federation");
   }
 elseif($profileId==26){
    $profile=$_IDIOMA->traducir("Club");
   }
 elseif($profileId==27){
    $profile=$_IDIOMA->traducir("Company");
   }
   return $profile;
}

/* Function p/ Obtener el grupo
 * de perfil p/ el TPL */
function grupoPerfil($iPerfil){

	#Grupo Player
	if($iPerfil==2 || $iPerfil==3 || $iPerfil==5 || $iPerfil==6){
		return $iGrupo=1;
	}
	#Grupo Coach
	if($iPerfil==7 || $iPerfil==8 || $iPerfil==9 || $iPerfil==10 || $iPerfil==11 || $iPerfil==12){
		return $iGrupo=2;
	}
	#Grupo Agent
	if($iPerfil==13 || $iPerfil==14 || $iPerfil==15 ){
		return $iGrupo=3;
	}
	#Grupo Scouts
	if($iPerfil==16){
		return $iGrupo=4;
	}
	#Grupo Lawyer
	if($iPerfil==17){
		return $iGrupo=5;
	}
	#Grupo Manager
	if($iPerfil==18 || $iPerfil==19){
		return $iGrupo=6;
	}
	#Grupo Medic
	if($iPerfil==20 || $iPerfil==21 || $iPerfil==22){
		return $iGrupo=7;
	}
	#Grupo Fan
	if($iPerfil==23){
		return $iGrupo=8;
	}
	#Grupo Journalist
	if($iPerfil==24){
		return $iGrupo=9;
	}
	#Grupo Selection
	if($iPerfil==25){
		return $iGrupo=10;
	}
	#Grupo club
	if($iPerfil==26){
		return $iGrupo=11;
	}
	#Grupo company
	if($iPerfil==27){
		return $iGrupo=12;
	}
}
	#caluclo porcentaje vacio
	function porcentajeDatos($iDatosVacios,$iCantTotal){
		$iPorcentaje=($iDatosVacios*100)/$iCantTotal;
		
		return intval($iPorcentaje);	
	}

	# Valida una dirección de E-mail
	function chekEmail($email){
	    $mail_correcto = 0;
	    // echo $email; die();
	    //compruebo unas cosas primeras
	    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
	       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
	          //miro si tiene caracter .
	          if (substr_count($email,".")>= 1){
	             //obtengo la terminacion del dominio
	             $term_dom = substr(strrchr ($email, '.'),1);
	             //compruebo que la terminación del dominio sea correcta
	             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
	                //compruebo que lo de antes del dominio sea correcto
	                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
	                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
	                if ($caracter_ult != "@" && $caracter_ult != "."){
	                   $mail_correcto = 1;
	                }
	             }
	          }
	       }
	    }
	    if ($mail_correcto)
	       return 1;
	    else
	       return 0;
	} 

	# Valida una dirección URL
	function ValidateUrl($sUrl)
	{
		$aExpReg = array(	'protocol' 		=> '((http|https|ftp)://)',
							'access' 			=> '(([a-z0-9_]+):([a-z0-9-_]*)@)?',
							'sub_domain' 	=> '(([a-z0-9_-]+\.)*)',
							'domain' 			=> '(([a-z0-9-]{2,})\.)',
							'tld' 				=>'(com|net|org|edu|gov|mil|int|arpa|aero|biz|coop|info|museum|name|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cf|cd|cg|ch|ci|ck|cl|cm|cn|co|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|ee|eg|eh|er|es|et|fi|fj|fk|fm|fo|fr|fx|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zr|zw)',
							'port' 				=>'(:(\d+))?',
							'path' 				=>'((/[a-z0-9-_.%~]*)*)?',
							'query' 			=>'(\?[^? ]*)?'
						 );
		$sExpReg = "`^" . implode('', $aExpReg) . "$`iU";
		return preg_match($sExpReg, $sUrl);
	}

	# Formatea 
	function formatOrder($sOrder){
		return str_pad($sOrder, 5 , "-", STR_PAD_LEFT);
	}
	
	# Retorna la extension del archivo
	function returnExtension($sFilename){
		return strtolower( substr( $sFilename, ( strrpos($sFilename, '.') + 1 ) ) );
	}

	# Retorna los hijos de un nodo pasado como parámetro
	function GetChildsOfNode($aData, $iNode, $iStart = 0, $sColPrtId = 'prt', $sColId = 'id')
	{
		static $iCurrentParent = 0;
		$aChilds = array();
		for ($iItem = $iStart; $iItem <= (sizeof($aData) - 1); $iItem++)
		{
			$iCurrentParent = $iNode;
			if ($aData[$iItem][$sColPrtId] == $iNode)
			{
				$aChilds[] = $aData[$iItem][$sColId];
				$aChilds = ArrayMerge($aChilds, GetChildsOfNode($aData, $aData[$iItem][$sColId], $iItem, $sColPrtId, $sColId));
			}
			else if ($iCurrentParent < $aData[$iItem][$sColPrtId])
			{
				break;
			}
		}
		return $aChilds;
	}#GetChildsOfNode()


	# Genera un arbol indicando los nodos con sus respectivos hijos
	function GenerateLinearTree($aData = NULL, $iNodeId = 0, $sColId = 'id',  $sColPrtId = 'prt_id', $sColName = 'nm', $sInitialString = '*', $sGlueString = '--', $iRepeatGlueString = 2, $sEndString = '>')
	{
		static $iLevel = -1;  // Para mantener el nivel
		$aTree = array();
		$iLevel++;
		foreach($aData as $iId => $aNodo)
		{
			if ($aNodo[$sColPrtId] == $iNodeId)
			{
				$aTree[$aNodo[$sColId]] = $sInitialString . (str_repeat($sGlueString,($iLevel  * $iRepeatGlueString))) . ' ' . $sEndString . $aNodo[$sColName];
				$aTree = ArrayMerge($aTree, GenerateLinearTree($aData, $aNodo[$sColId], $sColId, $sColPrtId, $sColName, $sInitialString, $sGlueString, $iRepeatGlueString, $sEndString));
			}
		}
		$iLevel--;
		return $aTree;
	}#GenerateLinearTree()


	# Genera una sentencia INSERT para Sql
	function GenerateInsert($sTable, $aRow, $bAplicarSlashes = true)
	{
		$aFields = array();
		$aValues = array();
		foreach($aRow as $sField => $sValue)
		{
			$aFields[] = $sField;
			$aValues[] = "'" . ($bAplicarSlashes ? addslashes($sValue) : $sValue) . "'";
		}
		return "INSERT INTO $sTable (" . implode(',', $aFields) . ") VALUES (" . implode(',', $aValues) . ");";
	}#GenerateInsert()


	# Genera una sentencia INSERT para Sql
	function GenerateInsertMulti($sTable, $aRows)
	{
		$aFields = array();
		$aAllValues = array();
		foreach ($aRows as $iKey => $aRow)
		{
			$aValues = array();
			foreach($aRow as $sField => $sValue)
			{
				$aFields[$sField] = $sField;
				$aValues[] = "'" . ($sValue) . "'";
			}
			$aAllValues[$iKey] = '(' . implode(',', $aValues) . ')';
		}
		return "INSERT INTO $sTable (" . implode(',', $aFields) . ') VALUES ' . implode(',', $aAllValues) . ';';
	}#GenerateInsertMulti()


	function ArrayMerge($aOne = array(), $aTwo = array(), $aThree = NULL, $aFour = NULL)
	{
		$aResult = array();

		foreach ($aOne as $mKey => $mVal) $aResult[$mKey] = $mVal;
		foreach ($aTwo as $mKey => $mVal) $aResult[$mKey] = $mVal;		
		if (gettype($aThree) == 'array')
		{
			foreach ($aThree as $mKey => $mVal) $aResult[$mKey] = $mVal;
		}
		if (gettype($aFour) == 'array'){
			foreach ($aFour as $mKey => $mVal) $aResult[$mKey] = $mVal;
		}
		return $aResult;
	}#ArrayMerge()


	function ArrayIndexar($aCampos, $aDatos, $bIgnoreDiferences = false)
	{
		$iI = 0;
		if (!$bIgnoreDiferences && (sizeof($aCampos) != sizeof($aDatos)))
		{
			die ('ArrayIndezar() ' . __('La cantidad de elementos entre aCampos y aDatos son distintos'));
		}
		$aAsociativo = array();
		
		foreach($aCampos as $sCampo){
			$aAsociativo[$sCampo] = $aDatos[$iI];
			$iI++;
		}
		/*		
		foreach($aDatos as $mDato){
		$aAsociativo[$aCampos[$iI]] = $mDato;
		$iI++;
		}
		*/
		return $aAsociativo;
	}#ArrayIndexar()


	# Genera una sentencia UPDATE para Sql
	function GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
	{
		$aSet = array();
		foreach($aRow as $sField => $sValue) $aSet[] = "$sField='" . ($bAplicarSlashes ? addslashes($sValue) : $sValue) . "'";
		return "UPDATE $sTable SET " . implode(',', $aSet) . (!is_null($sWhere) ? " WHERE $sWhere" : '') . ";";
	}#GenerateUpdate()


	# Genera una sentencia SELECT para Sql
	function GenerateSelect($aFields = '*', $aTables = NULL, $aWhere = NULL, $aOrders = NULL, $iOffset = NULL, $iRows = NULL, $sGroup = NULL)
	{
		$sFields 	= ((gettype($aFields) == 'array') ? implode(',', $aFields) : $aFields);
		$sTables 	= ((gettype($aTables) == 'array') ? implode(',', $aTables) : $aTables);
		$sWhere 	= (!is_null($aWhere) ? 'WHERE ' . ((gettype($aWhere) == 'array') ? implode(' AND ', array_filter($aWhere)) : $aWhere) : '');
		$sOrder 	= (!is_null($aOrders) ? 'ORDER BY ' . ((gettype($aOrders) == 'array') ? implode(',', array_filter($aOrders)) : $aOrders) : '');
		$sLimit 	= (!is_null($iOffset) && !is_null($iRows) ? "LIMIT $iOffset,$iRows" : '');
		$sGroupBy = (!is_null($sGroup) ? "GROUP BY $sGroup" : '');
		return "SELECT $sFields FROM $sTables $sWhere $sGroupBy $sOrder $sLimit;";
	}#GenerateSelect()


	function Array2Json($aData)
	{
		
		if(empty($aData)) return false;
		
		$aDataJson = array();
		foreach ($aData as $sKey => $sValue)
		{
			$aDataJson[] = "$sKey: " . (is_array($sValue) ? Array2Json($sValue) : "'" . addslashes($sValue) . "'");
		}
		return '{' . implode(', ', $aDataJson) . '}';
	}#Array2Json()
	
	function Array2Autocompleter($aData)
	{
		$sReturn = "[ ";
		foreach($aData as $aDataKey => $aData){
			if(!isset($step)){
				$sReturn .= Array2Json($aData);
				$step = 1;
			}else{
				$sReturn .= "," . "\n" . Array2Json($aData);
			}
		}
		$sReturn .= "]";
		
		return $sReturn;
	}#Array2Autocompleter()
	
	function Array2Query($aData)
	{
		if(empty($aData) OR !is_array($aData)) return false;
		
		$aReturn = array();
		foreach ($aData as $sKey => $sValue)
		{
			$aReturn[] = $sKey . '=' . addslashes($sValue);
		}
		return implode('&', $aReturn);
	}#Array2Query()


	function FORMAT_AsNumber($mNumber = '', $sFormat = '', $bPdf = false)
	{
		$iNumber = number_format($mNumber, 2, '.', ',');
		switch ($sFormat)
		{
			case 'money': case 'peso': $iNumber = '$ ' . $iNumber; break;
			case 'dolar': $iNumber = 'U$D ' . $iNumber; break;
			case 'euro': $iNumber = ($bPdf ? chr(128) . ' ' : '€ ') . $iNumber; break;
		}
		return $iNumber;
	}#FORMAT_AsNumber()

	function SubString($sString, $iLargo)
	{
		return (strlen($sString) > $iLargo) ? substr(strip_tags($sString), 0, $iLargo) . '...' : $sString;
	}

	function System_getPaises($sWhere = NULL)
	{
		global $SITE_oDB;
		$sSQL_Select = GenerateSelect('pais_nombre_en,pais_nombre_es,pais_iso_2,pais_iso_3,pais_iso_num', SITE_DB_TB_SystemPaises, $sWhere, 'pais_nombre_' . SYSTEM_Language . ' ASC');
		$DB_Result = $SITE_oDB->Query($sSQL_Select);
		return $SITE_oDB->FetchRowsAssoc($DB_Result, 'pais_iso_num');
	}

	function _basename($sFile)
	{
		if (strstr($sFile, '/'))
		{
			return array_pop(explode('/', $sFile));
		}
		elseif (strstr($sFile, '\\'))
		{
			return array_pop(explode('\\', $sFile));
		}
		else
		{
			return $sFile;
		}
	}

	function ValidateImagen($sPath, $sImagen, $aValidate = array(), $bEliminarSiError = false)
	{
		global $SITE_aImagenesPermitidas;
		$aReturn['estado'] = true;
	
		if (empty($sImagen))
		{
			$aReturn['estado'] = false;
			$aReturn['code'] = 'empty';
			$aReturn['error'] = ___('No hay ninguna imagen');
		}
		else
		{
			$aImageInfo = getimagesize("$sPath/$sImagen");
			if (isset($aValidate['permitidas']))
			{
				if (!array_key_exists($aImageInfo[2], $SITE_aImagenesPermitidas))
				{
					$aReturn['estado'] = false;
					$aReturn['code'] = 'invalido';
					$aReturn['error'] = ___('Solo se aceptan imágenes tipo') . ': ' . implode(',', $SITE_aImagenesPermitidas) . '. Archivo recibido: {$aImageInfo[2]}';
					if ($bEliminarSiError) @unlink("$sPath/$sImagen");
				}
			}
			elseif (isset($aValidate['ancho']))
			{
				if ($aImageInfo[0] > $aValidate['ancho'])
				{
					$aReturn['estado'] = false;
					$aReturn['code'] = 'ancho';
					$aReturn['error'] = ___('Solo se aceptan imágenes de un máximo de ') . "{$aValidate['ancho']}px de ancho. Archivo recibido {$aImageInfo[0]}px";
					if ($bEliminarSiError) @unlink("$sPath/$sImagen");
				}
			}
			elseif (isset($aValidate['alto']))
			{
				if ($aImageInfo[1] > $aValidate['alto'])
				{
					$aReturn['estado'] = false;
					$aReturn['code'] = 'alto';
					$aReturn['error'] = ___('Solo se aceptan imágenes de un máximo de ') . "{$aValidate['ancho']}px de alto. Archivo recibido {$aImageInfo[1]}px";
					if ($bEliminarSiError) @unlink("$sPath/$sImagen");
				}
			}
			elseif (isset($aValidate['size'])) # Tamaño en KB
			{
				if($iFileSize = filesize($sImagen))
				{
					if (($iFileSize/1024) > $aValidate['size'])
					{
						$aReturn['estado'] = false;
						$aReturn['code'] = 'size';
						$aReturn['error'] = ___('El tamaño de la imagen no puede ser mayor a ') . "{$aValidate['size']}KB (" . ($aValidate['size']/1024) . "MB). Imagen recibida: " . $iFileSize . 'KB';
						if ($bEliminarSiError) @unlink("$sPath/$sImagen");
					}
				}
			}
		}
		return $aReturn;
	}


	function buscarString($sContent = '')
	{
		$aDatos = array();
		if (empty($sContent))
		{
			return $sContent;
		}
		else
		{
			$bRepetir = true;
			while ($bRepetir == true)
			{
				if (ereg('[A-Z][^ \!\?]+', $sContent, $aRetorno))
				{
					$aDatos[] = $aRetorno[0];
					$sContent = str_replace($aRetorno[0], strtolower($aRetorno[0]), $sContent);
				}
				else
				{
					$bRepetir = false;
				}
			}
			if ($aDatos)
			{
				return implode(', ', array_splice($aDatos, 0, 10));
			}
		}
		return $sContent;
	}
	#Funcion que facilita el mostrado de arreglos
	function pr($aArray)
	{
		echo '<pre>';
			print_r($aArray);
		echo '</pre>';
	}

	#Funcion que facilita el mostrado de strings
	function printl($sString)
	{
		echo "$sString <br />";
	}
	
	#Funcion que imprime una linea como titulo
	function printt($sString)
	{
		echo "<h4>$sString</h4>";
	}
	
	#Funcion completa que envia un email.
			
	function sendMailComplex($sFromAddr, $sFromName, $sToAddr, $sToName, $sSubject, $sContent)
	{
		require_once(SITE_LIB_Site_class . '/class_mail.php');
		$oMail = new CLASS_Mail();
		$oMail->From     = $sFromAddr; 	//Mail de quien envia el mensaje;
		$oMail->FromName = $sFromName;		//Nombre de la persona que envia el mensaje;
	
		# Seteo la clase mail y Envio del e-mail
		$oMail->AddAddress($sToAddr, $sToName);
		$oMail->Subject = $sSubject;
		$oMail->Body    = utf8_decode($sContent);

		# Envio del e-mail
		$bSendMail = $oMail->Send();
	
		# Borra las direcciones cargadas
		$oMail->ClearAddresses();
		
		return $bSendMail;
	}
	
	#Ensuciar id para utilizarlo con jquery
	
	function dirty($id){
		$one=rand(100,900);
		//echo "<br />rand1 :",$one;
		$two=rand(100,900);
		//echo "<br />rand2 :",$two;
		$three=rand(100,900);
		//echo "<br />rand3 :",$three;
		$pos=rand(1,4);
		
		switch($pos){
			case 1: $asd=$id.$one.$two.$three;
			break;
			
			case 2: $asd=$one.$id.$two.$three;
			break;
			
			case 3: $asd=$one.$two.$id.$three;
			break;
			
			case 4: $asd=$one.$two.$three.$id;
			break;
		}
		$dirtyParam=$pos.$asd;
		return $dirtyParam;
	}
	
	#para saber cual es el nombre de perfil que arma la tabla ax_['nombre_perfil'] y despues agregarle cualqueir cosa
	
	function profileAg($profileId){
			switch($profileId){
				case 1: return 'ax_player';
				break;
				
				case 2: return 'ax_coach';
				break;
				
				case 3: return 'ax_agent';
				break;
				
				case 4: return 'ax_scout';
				break;
				
				case 5: return 'ax_lawyer';
				break;
				
				case 6: return 'ax_manager';
				break;
				
				case 7: return 'ax_medic';
				break;
				
				case 8: return 'ax_fan';
				break;
				
				case 9: return 'ax_journalist';
				break;
				
				case 10: return 'ax_selection';
				break;
				
				case 11: return 'ax_club';
				break;
				
				case 12: return 'ax_company';
				break;
			}
	}
	
	#Ensuciar id sucio con function dirty($id) para utilizarlo con php
	
	function cleanDirty($id){
		$total = strlen($id);
		$string = $id;
		$first = substr( $string, 0, 1 );
		
		switch($first){
		
			case 1: $idTotal=$total-10;
			return substr( $string, 1, $idTotal );
			
			
			//$total=strlen($string); substr(
			break;
			
			case 2: $idTotal=$total-10;
			return substr( $string, 4, $idTotal );
			break;
			
			case 3: $idTotal=$total-10;
			return substr( $string, 7, $idTotal );
			break;
			
			case 4: $idTotal=$total-10;
			return substr( $string, 10, $idTotal );
			break;
		
		}
	}
	
	#con esta funcion obtengo el tiempo que paso desde que posteo
	
/*function time_stamp($session_time){ 
	global $_IDIOMA;
	$time_difference = time() - $session_time ; 
	$seconds = $time_difference ; 
	$minutes = round($time_difference / 60 );
	$hours = round($time_difference / 3600 ); 
	$days = round($time_difference / 86400 ); 
	$weeks = round($time_difference / 604800 ); 
	$months = round($time_difference / 2419200 ); 
	$years = round($time_difference / 29030400 ); 

	if($seconds <= 60)
	{
		echo"$seconds ".$_IDIOMA->traducir("seconds ago"); 
	}
		else if($minutes <=60)
	{
		if($minutes==1)
	{
		echo $_IDIOMA->traducir("one minute ago"); 
	}
		else
	{
		echo"$minutes ". $_IDIOMA->traducir("minutes ago"); 
	}
	}
		else if($hours <=24)
	{
		if($hours==1)
	{
		echo $_IDIOMA->traducir("one hour ago");
	}
		else
	{
		echo "$hours ".$_IDIOMA->traducir("hours ago");
	}
	}
		else if($days <=7)
	{
		if($days==1)
	{
		echo $_IDIOMA->traducir("one day ago");
	}
		else
	{
		echo"$days " . $_IDIOMA->traducir("days ago");
	}



	}
		else if($weeks <=4)
	{
		if($weeks==1)
	{
		echo $_IDIOMA->traducir("one week ago");
	}
		else
	{
		echo"$weeks ".$_IDIOMA->traducir("weeks ago");
	}
	}
		else if($months <=12)
	{
		if($months==1)
	{
		echo $_IDIOMA->traducir("one month ago");
	}
		else
	{
		echo"$months ". $_IDIOMA->traducir("months ago");
	}


	}

		else
	{
		if($years==1)
	{
		echo $_IDIOMA->traducir("one year ago");
	}
		else
	{
		echo "$years " . $_IDIOMA->traducir("years ago");
	}

	
	}
} */











?>
