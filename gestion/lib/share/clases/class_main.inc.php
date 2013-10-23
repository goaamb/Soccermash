<?PHP
class CLASS_Main{
	//
	// Properties
	var $__aErrorList = array();
	var $__mLastError = NULL;
	var $__aEvents = array();
	var $__aParameters = array();	
	var $__sOnUserError = NULL;
	var $__sOnNoticeError = NULL;
	var $__sOnSystemError = NULL;
	var $__sOnWarningError = NULL;
	
	//
	// Constructor
	function CLASS_Main(){
		//
		$this->_LoadErrorList();
		//
	}#END CLASS_Main()
	
	//
	// Methods

	function __SetError($mCode = 0, $sP1 = NULL, $sP2 = NULL, $sP3 = NULL, $sP4 = NULL, $sP5 = NULL, $sP6 = NULL){
		$this->__mLastError = $mCode;
		$this->__aParameters[1] = $sP1;
		$this->__aParameters[2] = $sP2;
		$this->__aParameters[3] = $sP3;
		$this->__aParameters[4] = $sP4;
		$this->__aParameters[5] = $sP5;
		$this->__aParameters[6] = $sP6;
		//
		if (isset($this->__aErrorList[$mCode])){
			switch($this->__aErrorList[$mCode]['type']){
				case ERROR_User:
					if ($sAction = $this->__sOnUserError) $this->$sAction(); break;
				case ERROR_System:
					if ($sAction = $this->__sOnSystemError) $this->$sAction(); break;
				case ERROR_Warning:
					if ($sAction = $this->__sOnWarningError) $this->$sAction(); break;
				case ERROR_Notice:
					if ($sAction = $this->__sOnNoticeError) $this->$sAction(); break;
			}
		}
	}#END __SetError()


	// Function....: __AddError(int $iCode, str $iType, str $sMessage)
	// Desc........: Registra un nuevo error a la lista de errores
	//
	function __AddError($iCode, $sType = 1, $sMessage = ''){
		$this->__aErrorList[$iCode]['type'] = $sType;
		$this->__aErrorList[$iCode]['msg'] = $sMessage;
	}#END __AddError()


	function _LoadErrorList(){
		return true;
	}#END _LoadErrorList();


	function __LogEvent($sEvent = ''){
		$this->__aEvents[] = $sEvent;
	}#END __LogEvent()

	function __ShowEvents(){
		die (DEBUG_DumpArray($this->__aEvents)); exit;
	}#END __ShowEvents()

	function GetErrorCode(){
		return $this->__mLastError;
	}#END Error


	// Devuelve el mensaje de error. Lo personaliza en función de los parámetros pasados por __SetError
	function GetErrorMessage($mEid = NULL, $aParameters = NULL){
		if (!$mEid) $mEid = $this->__mLastError;
		if (isset($this->__aErrorList[$mEid]['msg'])){
			$sMsg = $this->__aErrorList[$mEid]['msg'];
			if (gettype($aParameters) != 'array') $aParameters = $this->__aParameters;
			for ($iI = 1; $iI <= 6; $iI++){
				if (isset($aParameters[$iI])){
					$sMsg = str_replace('#P'.$iI.'#', $aParameters[$iI], $sMsg);
				}
			}
			return $sMsg;
		}else{
			return "Error Desconocido: $mEid";
		}
	}

	// Function....: OnUserError(str $Procedure)
	// Desc........: Establece el procedimiento que se va a lanzar en caso de producirse un error
	//               de usuario.
	// Paramters...: str $sProcedure: Nombre del Procedimiento a lanzar
	function OnUserError($sProcedure = NULL){
		$this->__sOnUserError = $sProcedure;
	}#END $sProcedure

	function OnNoticeError($sProcedure = NULL){
		$this->__sOnNoticeError = $sProcedure;
	}#END $sProcedure

	function OnWarningError($sProcedure = NULL){
		$this->__sOnWarningError = $sProcedure;
	}#END $sProcedure

	function OnSystemError($sProcedure = NULL){
		$this->__sOnSystemError = $sProcedure;
	}#END $sProcedure


}#END CLASS_Main{}
?>