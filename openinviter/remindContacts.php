<?
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/profile/profileClass.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/openinviter/saveInvitesClass.php');
require_once ($_SERVER ['DOCUMENT_ROOT'].'/gbase.php');
require_once ($_GBASE . '/goaamb/mail/qmail.php');
include ('openinviter.php');
/////////////////////////////////////////////////////////////////////////////////////
	$profl=new Profile();
	$invite=new saveInvite();
	$aFieldsContacts=array();


   $aUserRecived = array(); 
   $prioridad     = "Sistema";
   $asunto      = '{You have a pending invitation at SOCCERMASH.com} ';
   $tipo      = "inviteUser";
  
	
	///select contscts from reminder table///
	$registrosInv=$invite->selectProfile('email,nameSender,lang',NULL);
	
	foreach($registrosInv as $regsInvEmail){
	  	$registros=$profl->selectGen('email',"email='".$regsInvEmail->email."'");
		if(is_null($registros[0]->email)){
			$iIdUserRecived = $regsInvEmail->email; 
			$aUserRecived['name']=$regsInvEmail->nameSender;
			$aUserRecived['email']=$regsInvEmail->email;
			
			if(is_null($regsInvEmail->lang) || $regsInvEmail->lang=='en-US' || $regsInvEmail->lang==''){
				$lang='';
			}else{
				$lang='.'.$regsInvEmail->lang;
			}
			
		    $archivo = '/templatemail/remindContacts'.$lang.'.tpl';
			
			QMail::add($tipo, $iIdUserRecived, $asunto, $archivo, $aUserRecived, $prioridad);
			
			////update the send timestapm//
			$aFieldsContacts['lastSend']=date("Y-m-d H:i:s");
			$invite->upProfile($aFieldsContacts,"email='".$regsInvEmail->email."'");
			
			echo 'remind sent to: ', $regsInvEmail->email,'-',$regsInvEmail->nameSender,'////';
			
		
		////deletes the already registered mail from the list/////////
		}else{
			$invite->delProfile("email='".$regsInvEmail->email."'");
			echo 'deleted: ',$regsInvEmail->email;
		}
			
	}



?>