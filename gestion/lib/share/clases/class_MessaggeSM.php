<?PHP
require_once('lib_util.inc.php');

class MessaggeSM
{

/*
 +++++++:: Comment ::+++++++ 
	La clase MessaggeSM tiene el manejo de los mensajes entre losa usuario de la 
	plataforma de SM.
	Implementa la funcionalidad en base a las tablas ax_sentMsj(mensajes enviados) y
	ax_replyMsj(respuesta a los msj de ax_sentMsj).
	
 +++++++:: MmCc ::+++++++ 
*/ 
 	// Global properties
	var $aErrores = array();
	var $sFieldsSent 	= NULL;
	var $sFieldsReply	= NULL;
	var $oDBMSJ;

	// User Data
	var $iID 			= NULL;
	
	function __construct()
	{
		global $SITE_oDB ;

		$this->sFieldsSent ='idMsj,idUserSend,idUserRecived,txtMsj,date,checkit';#ax_sentMsj
		$this->sFieldsReply ='idMsjReply,idMsjSent,idUserReply,idUserGetReply,txtMsjReply,date,checkit';#ax_replyMsj
		$this->oDBMSJ =& $SITE_oDB ;
	}#()
	
	
	/*   #SITE_DB_TB_SystemSentMsj
	 * 
	 *   :: _Begin_ Funciones de la tabla de msj enviados
	 * 
	 */
	
	
	#agrega un nuevo msj que genero un usuario con ID $iIdUserSend
	function agregarMsj($iIdUserSend,$iIdUserRecived,$sTxtMsj)
	{
		$aDatosMsj=Array();
		$aDatosMsj['idUserSend']    = (int)$iIdUserSend;
		$aDatosMsj['idUserRecived'] = (int)$iIdUserRecived;
		$aDatosMsj['txtMsj']        = $sTxtMsj;
		$aDatosMsj['date']          = gmdate("Y-m-d", time());
		
		
		$sSQL_Insert = GenerateInsert(SITE_DB_TB_SystemSentMsj, $aDatosMsj);
		if ($DB_Result = $this->oDBMSJ->Query($sSQL_Insert))
		{
			return true;
		}
		
		return false;
		
	}#agregarMsj()
	
	
	#chekea  todos los msj SIN LEER de un user
	function checkRecibidos($iIdUser){

		$sSQL_Select = GenerateSelect($this->sFieldsSent, SITE_DB_TB_SystemSentMsj, "idUserRecived='$iIdUser' and checkit!=1");
		#$DB_Result   = $this->oDBMSJ->Query($sSQL_Select);
		#return $this->oDBMSJ->FetchRowAssoc($DB_Result);
		$DB_Result = $this->oDBMSJ->Query($sSQL_Select);		
		return $this->oDBMSJ->FetchRowsAssoc($DB_Result, 'idMsj');
		
	}#checkRecividos
	
	#hace el check cdo el user lee el msj
	function onCheck($iIdMsjSent){
		$aMsjRecived=Array();
		$aMsjRecived['checkit']=1;
		$sSQL_Update = GenerateUpdate(SITE_DB_TB_SystemSentMsj, $aMsjRecived, "idMsj='$iIdMsjSent'");
		$bresultUpdate= $this->oDBMSJ->Query($sSQL_Update);
		
		return $bresultUpdate;
		
	}#onCheck
	

	#Return todos los msj enviados de un user
	function historyMySentMsj($iIdUser){
		
		$aMsjSent=Array();
		#return todos los msj de un user
		$sSQL_Select = GenerateSelect($this->sFieldsSent, SITE_DB_TB_SystemSentMsj, "idUserSend='$iIdUSer'");
		if($DB_Result 	 = $this->oDBMSJ->Query($sSQL_Select)){
			$aMsjSent = $this->oDBMSJ->FetchRowAssoc($DB_Result);
			return $aMsjSent;
		}	
	}#allMySentMsj

	
	#Return todos los msj recibidos de un user
	function historyMyRecivedMsj($iIdUser){
		
		$aMsjRecived=Array();
		#return todos los msj de un user
		$sSQL_Select = GenerateSelect($this->sFieldsSent, SITE_DB_TB_SystemSentMsj, "idUserRecived='$iIdUSer'");
		if($DB_Result 	 = $this->oDBMSJ->Query($sSQL_Select)){
			$aMsjRecived = $this->oDBMSJ->FetchRowAssoc($DB_Result);
			return $aMsjRecived;
		}	
	}#allMyRecivedMsj
	
 	#   :: _End_ Funciones de la tabla de msj enviados	
 	
		
	
	/*   #SITE_DB_TB_SystemReplyMsj
	 * 
	 *   :: _Begin_ Funciones de la tabla de msj respuestas
	 * 
	 */
	
	#se hace cdo un suer presiona en responder a un msj
	function agregarMsjRespuesta($iIdMsjSent,$iIdUserReply,$iIdUserGetReply,$sTxtMsj)
	{
		$aDatosMsj=Array();
		$aDatosMsj['idMsjSent']    	 = (int)$iIdMsjSent;
		$aDatosMsj['idUserReply']    = (int)$iIdUserReply;
		$aDatosMsj['idUserGetReply'] = (int)$iIdUserGetReply;
		$aDatosMsj['txtMsjReply']    = $sTxtMsj;
		$aDatosMsj['date']           = gmdate("Y-m-d", time());
		
		
		$sSQL_Insert = GenerateInsert(SITE_DB_TB_SystemReplyMsj, $aDatosMsj);
		if ($DB_Result = $this->oDBMSJ->Query($sSQL_Insert))
		{
			return true;
		}
		
		return false;
		
	}#agregarMsj()
	
	
	
	#chekea  todos las respuestas SIN LEER de un user-->q serian msj sin leer tb!!
	function checkRespuestas($iIdUser){
		
		$aMsjRecived=Array();
		#get all las rtas no chekeados-->check!=1
		$sSQL_Select = GenerateSelect($this->sFieldsReply, SITE_DB_TB_SystemReplyMsj, "idUserGetReply='$iIdUser' and checkit!=1");
		$DB_Result = $this->oDBMSJ->Query($sSQL_Select);
		
		return $this->oDBMSJ->FetchRowsAssoc($DB_Result, 'idMsjReply');
	}#checkRespuestas
	
	
	
	#return el historial de respuestas de un msj
	function historyMsjReply($iIdMsj){
		$aMsjReply=Array();
		#return todas las respuestas de un msj original(de la tabla ax_sentMsj)
		$sSQL_Select = GenerateSelect($this->sFieldsReply, SITE_DB_TB_SystemReplyMsj, "idMsjSent='$iIdMsj'");
		if($DB_Result 	 = $this->oDBMSJ->Query($sSQL_Select)){
			$aMsjReply = $this->oDBMSJ->FetchRowAssoc($DB_Result);
			return $aMsjReply;
		}	
	}#historyMsjReply
	
	
	
	#hace el check cdo el user lee la rta
	function onCheckReply($iIdMsjReply){
		$aMsjReply=Array();
		$aMsjReply['checkit']=1;
		$sSQL_Update = GenerateUpdate(SITE_DB_TB_SystemReplyMsj, $aMsjReply, "idMsjReply='$iIdMsjReply'");
		$bresultUpdate= $this->oDBMSJ->Query($sSQL_Update);
		
		return $bresultUpdate;
		
	}#onCheckReply
	
	#return el ultimo msj de respuesta sin leer de un user
	
	
}#end ClassMessaggeSM






/*
 * 
 * ClassBy Mcantero
 * MmCc
 */
