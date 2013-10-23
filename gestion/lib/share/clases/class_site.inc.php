<?PHP
require_once('lib_util.inc.php');

class SITE
{

/* +++++++:: Comment ::+++++++ 
	La clase SITE maneja las funciones 
relacionadas con los datos del user en el 
registro general. 
 Controla la creacion de una nueva cuenta
y el loguin.

 +++++++:: MmCc ::+++++++ 
*/
	// Global properties
	var $aErrores = array();
	var $sFields 	= NULL;
	var $oDB;

	// User Data
	var $iID 			= NULL;
	var $iProfile 		= NULL;
	var $sName 			= NULL;
	var $sLastName 		= NULL;
	var $sEmail    		= NULL;	
	var $aAccess 		= array();

	// Include browser name in fingerprint?
	var $check_browser = true;

	// How many numbers from IP use in fingerprint?
	var $check_ip_blocks = 0;

	// Control word - any word you want.
	var $secure_word = 'SECURESTAFF';

	// Regenerate session ID to prevent fixation attacks?
	var $regenerate_id = true;

	var $_SqlDump = array();

	
	
	function __construct()
	{
		global $SITE_oDB;

		$this->sFields ='id, name, lastName,sex, dayOfBirthDay, email, passwordUser, registerDate, ipAddress, photo, active,
		                 countryId, countryName, cityId, cityName, languageId, profileId, hidden, complete,destacado,emailPrivacy,represented_users,represented_recived,myAgent,tiempoUtlimaActividad';
		$this->oDB =& $SITE_oDB;
	}#SITE_User()

	function userLogin(&$aUsuario,&$bError)//controla el loguin del user
	{
 		$bError=false;
		$aErrores = array();
		if ($aGetUser =$this->getUsuario('id,active,passwordUser,name,lastName,profileId,email,complete', "email='". $aUsuario['email'] . "'"))
		{		
				if($aGetUser['passwordUser']!= md5($aUsuario['passwordUser'])){
					$aErrores['passwordLoguin'] = 'Incorrect Password.';	
					return array($aErrores,$bError);				
				}		
				if ($aGetUser['active'] == 1)// user Active
				{      		
                    $bError=true;   
					$this->setUserLogin($aGetUser);//Setea los datos del user P/ la session
					return array($aGetUser,$bError);  
	
			    }					
				else
				{	$aErrores['emailLoguin'] 	  ='Disabled Account.';	}//user disabled: active=0				
		}else
		 		$aErrores['emailLoguin'] 	  ='E-mail User Does Not Exist.';//user not exist in BD
		
		return array($aErrores,$bError);
	}//userLogin


	function userLogout()
	{
		SiteDestroyCookieVar('sessionIdSM');
		SiteDestroyCookieVar('sessionProfileSM');
	}

	// Call this to check session.
	function Check()
	{
		if (SiteRetrieveCookieVar('sessionIdSM', dINTEGER, 0))
		{
			return true;
		}
		return false;
	}

	// Call this when init session.
	function Open()
	{
		$_SESSION['ss_fprint'] = $this->_Fingerprint();
	}

	// Internal function. Returns MD5 from fingerprint.
	function _Fingerprint()
	{
		$fingerprint = $this->secure_word;
		if ($this->check_browser)
		{
			$fingerprint .= $_SERVER['HTTP_USER_AGENT'];
		}
		if ($this->check_ip_blocks)
		{
			$num_blocks = abs(intval($this->check_ip_blocks));
			if ($num_blocks > 4) $num_blocks = 4;

			$blocks = explode('.', $_SERVER['REMOTE_ADDR']);
		  	for ($i=0; $i<$num_blocks; $i++) $fingerprint .= $blocks[$i] . '.';
		}

		return md5($fingerprint);
	}

	// Internal function. Regenerates session ID if possible.
	function _RegenerateId()
	{
		if ($this->regenerate_id && function_exists('session_regenerate_id'))
		{
		  session_regenerate_id();
		}
	}

	function setUser()
	{
		if(!$this->Check()) return false;

		$this->iID = SiteRetrieveCookieVar('sessionIdSM', dINTEGER, 0);
		$aGetUser = $this->getUsuario(NULL, "id='{$this->iID}'");

		$this->iID 			= $aGetUser['id'];	
		$this->iProfile		= $aGetUser['profileId'];	
		$this->sName 		= $aGetUser['name'];
		$this->sLastName 	= $aGetUser['lastName'];
		$this->sEmail 		= $aGetUser['email'];
		
		return true;
	}

	function setUserLogin($aUsuario)
	{
      
		# Setea los datos del user p/ la session
		$iKeyRegisterUserSM			 		= $aUsuario['id'];
		$iKeyProfileUser			 		=$aUsuario['profileId'];
		$sSMuNameUserKey			 		=$aUsuario['name'];
		$_SESSION["iSMuIdKey"] 		 		=$iKeyRegisterUserSM ;
		$_SESSION["iSMuProfTypeKey"] 		=$iKeyProfileUser ;
		$_SESSION["sSMuNameUserKey"] 		=$sSMuNameUserKey ;


	}


	#Cambia el estado del Usuario:: Active=1
	function cambiarEstadoUsuario($iUsuarioId)
	{
		$aUsuarioDb = $this->getUsuario(NULL, "id='$iUsuarioId'");
		$aUsuarioDb['active'] = ($aUsuarioDb['active']==0 ? 1 : 0);
		$sSQL_Update = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aUsuarioDb, "id='$iUsuarioId'");
		return $this->oDB->Query($sSQL_Update);
	}

	#retorna el status del usuario en la tabla cometchat_status
	function statusUser($sWhere){
		$sSQL_Select = GenerateSelect('userid,status', SITE_DB_TB_StatusUser, $sWhere);
		$DB_Result = $this->oDB->Query($sSQL_Select);
		return $this->oDB->FetchRowAssoc($DB_Result);
	}#statusUser

	#Config Privacy Email::Por el momento, solo tiene: 1,1,1,1,1,1,1 o 0,0,0,0,0,0,0
	function setEmailPrivacy($iIdUser,$sTipoPrivacy)
	{
		$aUsuarioDb = $this->getUsuario(NULL, "id='$iIdUser'");

		if($sTipoPrivacy==1){#set en 1,1,1,1,1,1,1 ; Recibe All Email
			$aUsuarioDb['emailPrivacy']='1,1,1,1,1,1,1';
			if($this->modificarUsuario($iIdUser, $aUsuarioDb))
			 return true;
			else
			 return false; 
		}else{#gset en 0,0,0,0,0,0,0 : No recibe Email
			$aUsuarioDb['emailPrivacy']='0,0,0,0,0,0,0';
			if($this->modificarUsuario($iIdUser, $aUsuarioDb))
			 return true;
			else
			 return false; 
		}
		
	}#emailPrivacy

	function getEmailPrivacy($iIdUser)
	{
		$aUsuarioDb = $this->getUsuario(NULL, "id='$iIdUser'");

		if($aUsuarioDb['emailPrivacy']=='1,1,1,1,1,1,1'){#set en 1,1,1,1,1,1,1 ; Recibe All Email
			return true;
		}else{
			 return false; 
		}
		
	}#getEmailPrivacy

	# Retorna los datos de un usuario
	function getUsuario($sFields = NULL, $sWhere)
	{
		if (is_null($sFields)) $sFields = $this->sFields;
		$sSQL_Select = GenerateSelect($sFields, SITE_DB_TB_SystemUsuarios, $sWhere);
		$DB_Result = $this->oDB->Query($sSQL_Select);
		return $this->oDB->FetchRowAssoc($DB_Result);
	}#getUsuario()



	# Retorna los datos de todos los usuarios del sistema
	function getUsuarios($sFields = NULL, $sWhere = NULL, $sOrder = NULL, $iOffset = NULL, $iRows = NULL)
	{
		if (is_null($sFields)) $sFields = $this->sFields;
		$sSQL_Select = GenerateSelect($sFields, SITE_DB_TB_SystemUsuarios, $sWhere, $sOrder, $iOffset, $iRows);
		#echo $sSQL_Select;
		$DB_Result = $this->oDB->Query($sSQL_Select);
		
		return $this->oDB->FetchRowsAssoc($DB_Result, 'id');
	}#getUsuarios()

	# Return the quantity users
	function contarUsuarios($sWhere = NULL)
	{
		return $this->oDB->Count('id', SITE_DB_TB_SystemUsuarios, $sWhere);
	}#contarUsuarios()


	# Add user the system
	function agregarUsuario(&$aUsuario)
	{
		$aUsuario['registerDate'] = gmdate("Y-m-d", time());
		$aUsuario['passwordUser'] = md5($aUsuario['passwordUser']);
		$aUsuario['photo'] = "photoDefault.jpg";
		unset($aUsuario['repeatEmail']);
		$sSQL_Insert = GenerateInsert(SITE_DB_TB_SystemUsuarios, $aUsuario);
		if ($DB_Result = $this->oDB->Query($sSQL_Insert))
		{

			return true;
		}
		
		return false;
		
	}#agregarUsuario()

	
	# Modifica los datos de un usuario en el sistema
	function modificarUsuario($iUsuarioId, $aUsuario)
	{
		unset($aUsuario['id']);
		$sSQL_Insert = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aUsuario, "id=$iUsuarioId");
		if ($DB_Result = $this->oDB->Query($sSQL_Insert))
		{
			
		return true;
		}
		
		return false;
	}#modificarUsuario()


	# Elimina un usuario del sistema
	function eliminarUsuario($iUsuarioId)
	{
		$sSql = "DELETE FROM " . SITE_DB_TB_SystemUsuarios . " WHERE id='$iUsuarioId';";
		if ($DB_Result = $this->oDB->Query($sSql))
		{
			return true;
		}
		return false;
	}#eliminarUsuario()


	# Valida todos los datos de un usuario
    function validaUsuario(&$aUsuario, $bEditMode = false)
	{
		
	        # Name
		if (empty($aUsuario['name']))
		{
			$this->aErrores['name'] = 'No Ingresó el Nombre del Usuario.';
		}
		# LastName
		if (empty($aUsuario['lastName']))
		{
			$this->aErrores['lastName'] = 'No Ingresó el Apellido del Usuario.';
		}
		# password
		if (empty($aUsuario['passwordUser']))
		{
			if (!$bEditMode)
			{
				$this->aErrores['passwordUser'] ='No ingresó la Contraseña para la cuenta del usuario.';
			}
		}
		
		# Confirmation password
		if (empty($aUsuario['repeat_pass']))
			{
				$this->aErrores['repeat_pass'] = 'Por favor, ingrese nuevamente su Contraseña para confirnar.';
			}
			else if ($aUsuario['passwordUser'] != $aUsuario['repeat_pass'])
			{
				$this->aErrores['repeat_pass'] = 'Las Contraseñas ingresadas no coinciden.';
			}
			
	
		# Validación del e-mail
			if (!empty($aUsuario['email']) )
			{
				if(!ValidateEmail($aUsuario['email']))
				{
	              $this->aErrores['email'] = 'La dirección de E-mail ingresada no possee un formato válido';
				}
				else
				{
				  $email=$aUsuario['email'];
				  if($this->getUsuario('email', "email='$email'"))
				  {
	                 $this->aErrores['email'] = 'La dirección de E-mail ya existe en la Base de Datos, ingrese otra por favor!.';
				  }
	
				}
	
	
			}

		return ((sizeof($this->aErrores) == 0) ? true : false);
	}#validaUsuario()


	# Retorna los errores ocurridos
	function getErrores()
	{
		return $this->aErrores;
	}#getErrores()
	
	
	# Valida una dirección de E-mail
	function ValidateEmail($sEmail)
	{
		return ereg ("^[^[:space:]@]+@[[:alnum:]_\.\-]+\.[[:alnum:]]{2,4}\$", $sEmail);
	}





	/* Modulo Represented Users - begin*/
	
	# Send a represented notification 
	function sendRepresented($iIdUser, $iIdInvited){
		
		#get data user
		$aUser 		  = $this->getUsuario(NULL, "id='$iIdInvited'");
		if(!isset($aUser['myAgent']) || (isset($aUser['myAgent']) && $aUser['myAgent']=="0")){#si no tiene agente
				#echo 'entra';
				if(!isset($aUser['represented_recived'])){#no tiene ninguna invitacion
					$aUser['represented_recived']=(string)$iIdUser;
					#echo 'S -inv'; 
				}else{
					#echo 'C-Inv';
					$aRepresented = explode(",",$aUser['represented_recived']);#get yours notifications
					$sId=(string)$iIdUser;
					$bKey = array_search($sId,$aRepresented,TRUE);#si ya existe una invitacion del mismo agent
				
					if($bKey || $bKey===0){#compara si el cualkier indice o el cero, xq el cero lo toma como false
						return true;
					}else{
						
						array_push($aRepresented,$iIdUser);#add ID
						$aUser['represented_recived']=implode(",",$aRepresented);#ID's string

					}
				}
				#insert a new notification represented
				$sSQL_Insert  = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aUser, "id=$iIdInvited");
				if ($DB_Result = $this->oDB->Query($sSQL_Insert))	return true;
			
			
		}
		
		return false;
		
	}#sendRepresented
	

	#get represented notification a player user
	function getRepresentedPlayer($iIdPlayer){
		#get data user
		$aUser 		  = $this->getUsuario(NULL, "id='$iIdPlayer'");
		$aRepresented = explode(",",$aUser['represented_recived']);#get yours notifications
		if(empty($aRepresented[0]))#xq indice cero viene vacio!!
			return false;#devulevo q no tiene valor
		else				
			return $aRepresented;

	}#getRepresentedPlayer

	#Add Agent
	function addAgent($iIdUser, $iIdAgent){
		#get data user
		$aUser 		= $this->getUsuario(NULL, "id='$iIdUser'");
		if(empty($aUser ['myAgent'])){
			$sIdAgent   = (int)$iIdAgent;	
			$aUser ['myAgent']=$sIdAgent;
			$aUser['represented_recived']='';
			$sSQL_Insert  = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aUser, "id=$iIdUser");
			if ($DB_Result = $this->oDB->Query($sSQL_Insert)){
				
				#insert Id player---> Id Agent
				$aAgent 		= $this->getUsuario(NULL, "id='$iIdAgent'");
				$aRepresented 	= explode(",",$aAgent['represented_users']);#get yours notifications	
				array_push($aRepresented,$iIdUser);#add idPlayer
				$aAgent['represented_users']=implode(",",$aRepresented);#ID's string
				
				$sSQL_Insert  = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aAgent, "id=$iIdAgent");
				if ($DB_Result = $this->oDB->Query($sSQL_Insert)){
					return true;
				}
			}
		}
		
		return false;
	}#addAgent

	#delete Agent
	function deleteAgent($iIdUser){
		#get data user
		$aUser 		= $this->getUsuario(NULL, "id='$iIdUser'");#player
		$IdAgent	=(int)$aUser ['myAgent'];
		$aAgent		= $this->getUsuario(NULL, "id='$IdAgent'");#agent
		
		$aRepresented = explode(",",$aAgent['represented_users']);#get yours representeds
		$iKey 		  = array_search((string)$iIdUser,$aRepresented,TRUE);
		if($iKey){
			unset($aRepresented[$iKey]);
			$aRepresented = array_values($aRepresented);#reordena el array de player representados
		}

		$aAgent['represented_users']=implode(",",$aRepresented);#ID's string;
		$aUser ['myAgent']='';#saco el ID de Agent
		$sSQL_Insert  = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aUser, "id=$iIdUser");#update Player
		if ($DB_Result = $this->oDB->Query($sSQL_Insert)){
			$sSQL_Insert  = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aAgent, "id=$IdAgent");#update Agent
			if ($DB_Result = $this->oDB->Query($sSQL_Insert)){
				return true;
			}else
				return false;
			
		}
		return false;
	}#deleteAgent
	
	#delete a represented notification
	function deleteRepresentedNotification($iIdUser, $iIdAgent){
		#get data user
		$aUser 		  = $this->getUsuario(NULL, "id='$iIdUser'");
		$aRepresented = explode(",",$aUser['represented_recived']);#get yours notifications
		
		if(sizeof($aRepresented)==1)
			$aUser['represented_recived']=null;
		else{
						
			$sId			= (string)$iIdAgent;
			$iKey 			= array_search($sId,$aRepresented,TRUE);
			if($iKey || $iKey===0){
				unset($aRepresented[$iKey]);
				$aRepresented = array_values($aRepresented);#reordena el array
				
			}
			$aUser['represented_recived']=implode(",",$aRepresented);#ID's string
		}
		
		#update a new notification represented
		$sSQL_Insert  = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aUser, "id=$iIdUser");
		if ($DB_Result = $this->oDB->Query($sSQL_Insert))	return true;
		
		return false;
		
	}#deleteRepresentedNotification
	
	#delete a represented user
	function deleteRepresentedUser($iIdAgent, $iIdPlayerRepresented){
		#get data user
		$aUser 		  = $this->getUsuario(NULL, "id='$iIdAgent'");
		$aRepresented = explode(",",$aUser['represented_users']);#get yours representeds
		$iKey 		  = array_search((string)$iIdPlayerRepresented,$aRepresented,TRUE);
		if($iKey){
			unset($aRepresented[$iKey]);
			$aRepresented = array_values($aRepresented);#reordena el array
		}
		$aUser['represented_users']=implode(",",$aRepresented);#ID's string
		
		#update a represented user
		$sSQL_Insert   = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aUser, "id=$iIdAgent");
		if ($DB_Result = $this->oDB->Query($sSQL_Insert)){
			$aUser 		  = $this->getUsuario(NULL, "id='$iIdPlayerRepresented'");#DELETE agent of player
			$aUser['myAgent']=NULL;
			$sSQL_Insert   = GenerateUpdate(SITE_DB_TB_SystemUsuarios, $aUser, "id=$iIdPlayerRepresented");
			if ($DB_Result = $this->oDB->Query($sSQL_Insert))#si se elimino de ambos return true
					return true;
		}
		
		return false;
		
	}#deleteRepresentedUser
	
	#return the users represented by an agent
	function getUsersRepresented($iIdAgent){
		#get data user
		$aUser 		  = $this->getUsuario(NULL, "id='$iIdAgent'");
		$aRepresented = explode(",",$aUser['represented_users']);#get yours users representeds
		
		return $aRepresented;
		
	}#getUsersRepresented
	
	
	
	/*  Modulo Represented Users - end*/

}#SITE_User()

/*
 * 
 * ClassBy Mcantero
 * MmCc
 */
class CLASS_Site extends SITE
{
	# Modules (Objects)
	var $_aModules = array();

	# Modules (Menu)
	var $_aMenuModules = array();

	function checkModule($sModule = SITE_CURRENT_Modulo, $bReturnReference = false)
	{
		return true;

		foreach ($this->_aMenuModules as $sModId => $aModulo)
		{
			if ($sModule == $aModulo['dirname'])
			{
				if($bReturnReference)
					return $aModulo;
				else
					return $this->checkModuleId($sModId);
			}
		}
		return false;
	}

	function checkSectionModule($sModule, $sSubModule)
	{
		foreach ($this->_aMenuModules as $sModId => $aModulo)
		{
			if(!isset($aModulo['pg'][$sSubModule])) return false;

			$sDir = (isset($aModulo['pg'][$sSubModule]['dirname'])) ? $aModulo['pg'][$sSubModule]['dirname'] : $aModulo['dirname'];

			if ($sModule == $sDir)
			{
				return true;
			}
		}
		return false;
	}

	function checkModuleId($sModId)
	{
		if (isset($this->_aMenuModules[$sModId]))
		{
			return true;
			/*if (in_array($sModId, $this->aAccess))
			{
				return true;
			}*/
		}
		return false;
	}

  	function RequireObjeto($sNameObject)
	{
		$sModule = $this->GetObjectClassPath($sNameObject);

		if (file_exists($sModule))
		{
			include($sModule);
    		return true;
    	}
    	return false;
    }# Include the module

	function GetObjectClassPath($sName){
		return SITE_MODULES_Path . '/' . strtolower($sName) . '/.class.php';
	}# Returns the Class path

	function GetObjectConfigPath($sName){
		return SITE_MODULES_Path . '/' . strtolower($sName) . '/.config.php';
	}# Returns the Config Class path

	function ScanModules(){
		global $SITE;

		$sDefaultDir = SITE_MODULES_Path;
		$aDirs = array();

		if ($aHd = opendir($sDefaultDir)) {
		    # Loop through the directory
		    while (false !== ($sFile = readdir($aHd))) {
		    	if ($sFile != "." && $sFile != "..") {
					$sConfig = $this->GetObjectConfigPath($sFile);
					if(file_exists($sConfig)){
						include ($sConfig);
						//$aDirs[$iOrder] = $sFile;

						if(isset($iOrder)){
							$SITE->_aMenuModules[$iOrder]['dirname'] = $sFile;
						}

						unset($iOrder, $sForceDirname);
					}
				}
		    }
			/*
			 * EXPERIMENTAL
			 *
			if(is_array($SITE->_aMenuModules)){
				ksort($SITE->_aMenuModules);
				ksort($aDirs);

				foreach($SITE->_aMenuModules as $k => $aArray){
					if(!empty($aDirs[$k])) $sDir = $aDirs[$k];
					$SITE->_aMenuModules[$k]['dirname'] = $sDir;
				}
			}
			*/

		    closedir($aHd);
		}

		# Order by key alphabethically
		@ksort($SITE->_aMenuModules);
	}

	function getModuleName($sNameObject){
		return 'CLASS_' . ucfirst($sNameObject);
	}# Returns the correct definition of the Class name

    function &getObjeto($sNameObject) {

    	$sNameObject = strtolower($sNameObject);

    	if (isset($this->_aModules[$sNameObject])) {
    		return $this->_aModules[$sNameObject];
    	} else {
    		if ($this->RequireObjeto($sNameObject)) {
    			$sClassName = $this->getModuleName($sNameObject);

				if ($this->_aModules[$sNameObject] =  new $sClassName ()) {
    				return $this->_aModules[$sNameObject];
    			} else {
    				$this->outputClassError($sNameObject);
    			}
    		} else {
				$this->outputClassError($sNameObject);
    		}
    	}
    	return NULL;
    } #getObjeto()

	function getChildrenModules($sMenuModule)
	{
		if(!is_array($this->_aMenuModules)) return false;

		foreach ($this->_aMenuModules as $sModId => $aModulo)
		{
			$sDir = (isset($aModulo[$sModId]['pg']['dirname'])) ? $aModulo[$sModId]['pg']['dirname'] : $aModulo['dirname'];

			if ($sMenuModule != 'home'
				AND
				($sMenuModule == $sDir))
			{
				if(isset($this->_aMenuModules[$sModId]['pg']))	return $this->_aMenuModules[$sModId]['pg'];
			}
		}
		return false;
	}# Returns the Config Sub menu

	function outputClassError($sNameObject){
		printt('Error: No se encuentra el objeto buscado');
		printl("Parametro buscado: $sNameObject");
		printl('Nombre de la clase: ' . ucfirst($sNameObject));
		printl("Archivo de la clase: " . $this->GetObjectClassPath($sNameObject));
		exit;
	}# Devuelve el error completo
}
/*
 * 
 * ClassBy Mcantero
 * MmCc
 */
?>
