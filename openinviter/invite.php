<script src="/goaamb/js/G.js"></script>
<script src="/js/jquery.js"></script>
<script src="js/css_browser_selector.js" type="text/javascript"></script>



<style type="text/css">
.webkit .thCheckbox, .ie .thCheckbox{
width:13px;
}

</style>

<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/profile/profileClass.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/openinviter/saveInvitesClass.php');

require_once ($_SERVER ['DOCUMENT_ROOT'].'/gbase.php');
require_once ($_GBASE . '/goaamb/mail/qmail.php');
include ('openinviter.php');
/////////////////////////////////////////////////
$aUrPEm=array();
if(isset($_POST['aUrPEm'])){
	$aUrPEm=$_POST['aUrPEm'];
}

if(isset($aUrPEm[0])){
	$_POST ['email_box']=$aUrPEm[0];
}
if(isset($aUrPEm[1])){
	$_POST ['password_box']=$aUrPEm[1];
}
if(isset($aUrPEm[2])){
	$_POST ['step']=$aUrPEm[2];
}
if(isset($aUrPEm[3])){
	$_POST ['provider_box']=$aUrPEm[3];
}





$inviter = new OpenInviter ();
$oi_services = $inviter->getPlugins ();
unset($oi_services ['social']);
if (isset ( $_POST ['provider_box'] )) {
	if (isset ( $oi_services ['email'] [$_POST ['provider_box']] ))
		$plugType = 'email';
	elseif (isset ( $oi_services ['social'] [$_POST ['provider_box']] ))
		$plugType = 'social';
	else
		$plugType = '';
} else
	$plugType = '';
function ers($ers) {
	if (! empty ( $ers )) {
		$contents = "<table cellspacing='0' cellpadding='0' style='border:1px solid red;' align='center'><tr><td valign='middle' style='padding:3px' valign='middle'><img src='images/ers.gif'></td><td valign='middle' style='color:red;padding:5px;'>";
		foreach ( $ers as $key => $error )
			$contents .= "{$error}<br >";
		$contents .= "</td></tr></table><br >";
		return $contents;
	}
}


function oks($oks) {
	if (! empty ( $oks )) {
		$contents = "<table border='0' cellspacing='0' cellpadding='10' style='border:1px solid #5897FE;' align='center'><tr><td valign='middle' valign='middle'><img src='images/oks.gif' ></td><td valign='middle' style='color:#5897FE;padding:5px;'>	";
		foreach ( $oks as $key => $msg )
			$contents .= "{$msg}<br >";
		$contents .= "</td></tr></table><br >";
		return $contents;
	}
}

if (! empty ( $_POST ['step'] ))
	$step = $_POST ['step'];
else
	$step = 'get_contacts';

$ers = array ();
$oks = array ();
$import_ok = false;
$done = false;
if (isset( $_POST ['step'] )) {
	if ($step == 'get_contacts') {
		if (empty ( $_POST ['email_box'] )){
			$ers ['email'] = "Email missing !";
			}
		if (empty ( $_POST ['password_box'] )){
			$ers ['password'] = "Password missing !";
			}
		if (empty ( $_POST ['provider_box'] )){
			$ers ['provider'] = "Provider missing !";
			}
		if (count ( $ers ) == 0) {
			$inviter->startPlugin ( $_POST ['provider_box'] );
			$internal = $inviter->getInternalError ();
			}
			if ($internal){
				$ers ['inviter'] = $internal;
			}elseif (! $inviter->login ( $_POST ['email_box'], $_POST ['password_box'] )) {
				$internal = $inviter->getInternalError ();
				echo '<script type="text/javascript">
						window.top.window.changeSecondInvite();
						window.top.window.$("#contentThrdInvite").hide();
						window.top.window.$("#indicLoadContacts").hide();
						window.top.window.$("#alertInviteError").html("'.$_IDIOMA->traducir("Login failed. Please check the email and password and try again").'");
					</script>';	
					die();
			} elseif (false === $contacts = $inviter->getMyContacts ()){
				echo '<script type="text/javascript">
						window.top.window.changeSecondInvite();
						window.top.window.$("#contentThrdInvite").hide();
						window.top.window.$("#indicLoadContacts").hide();
						window.top.window.$("#alertInviteError").html("'.$_IDIOMA->traducir("Unable to get contacts, please try again").'");
					</script>';	
					die();
			}else {
				$import_ok = true;
				$step = 'send_invites';
				$_POST ['oi_session_id'] = $inviter->plugin->getSessionID ();
				$_POST ['message_box'] = '';
			}
		}
	} 
	
	
 


if (isset($_POST['steps'])) {

				
				$_POST['oi_session_id']=$io_session;	
				$selected_contacts = array ();
				$contacts = array ();
					
					echo '<script type="text/javascript">
						window.top.window.$("#sendingInvite").html("");
						window.top.window.$("#emailListInvite").html("");
						window.top.window.$("#contactListBtnInvite2").hide();
						window.top.window.$("#invitationSentCartel").show();
					</script>';	
					$aEmailsS=array();
					$aEmails=explode(',',$_POST['emails']);	
					$aNamesS=array();
					$aNamesS=explode(',',$_POST['theNames']);	
					
	
				///////////send email////////////////
					$profl=new Profile();
					$invite=new saveInvite();
					$aFieldsContacts=array();
				 foreach($aEmails as $kk => $em){
				 		
					   if($em!=''){	
						
					   $iIdUserRecived = "$em";  
					   $aUserRecived = array(); 
					   $aUserRecived['name']=$_SESSION['nameUserSM'];
					   $prioridad     = "Usuario";
					   $asunto      = '{Contact Invitation at SOCCERMASH.com The premier social network for professional soccer players}';
					   $tipo      = "inviteUser";
					   
					   if(!isset($_SESSION['lg']) || $_SESSION['lg']=='' || $_SESSION['lg']==NULL || $_SESSION['lg']=='en-US'){
					   		$lang='';
					   }else{
					   		$lang='.'.$_SESSION['lg'];
					   }
					   $archivo     = '/templatemail/sendInvites'.$lang.'.tpl';
						
					 	////save contacts//
							$registros=$profl->selectGen('email',"email='".$em."'");
							if(is_null($registros[0]->email)){
								$registrosInv=$invite->selectProfile('email',"email='".$em."'");
								QMail::add($tipo, $iIdUserRecived, $asunto, $archivo, $aUserRecived, $prioridad);
									
									if(is_null($registrosInv[0]->email)){
										$aFieldsContacts['email']=$em;	
										$aFieldsContacts['nameSender']=$_SESSION['nameUserSM'];
										$aFieldsContacts['lang']=$_SESSION['lg'];
										$invite->addProfile($aFieldsContacts);	
									}
							}
					   //////////////////////
					}
				}
				
				//////////////////////////////////
	
	
}



$contents = "<script type='text/javascript'>
function toggleAll(element) 
{
	var form = G.dom.$('cWindowContent'), z = 0;
	form=G.dom.$$$('input',-1,form);
	for(z=0; z<form.length;z++)
	{
		if(form[z].type == 'checkbox'){
			form[z].checked = element.checked;
			if(form[z].value.test && form[z].value.test(/^.*@.*$/)){
				seleccionarEmail.call(form[z]);
			}
		}
	}
}
</script>
<style type='text/css'>
.thTextbox,.thSelect{
	width:200px;
}
</style>
";
ob_start();
?>
<script type="text/javascript" src="<?php print JDIR_WEB;?>goaamb/js/G.js"></script>
<script type="text/javascript">
function ajaxRequestContacts(){
	cWindowShow("", '', 450, 100);
	var a=new G.ajax({
		pagina:"<?php print JDIR_WEB;?>openinviter/ajaxgetcontacts.php",
		post:{
			email_box:this.email_box.value,
			password_box:this.password_box.value,
			provider_box:this.provider_box.value
			},
		accion:function(){
			G.dom.$("cwin_logo").innerHTML="<span>Lista de Contactos</span>&nbsp;<input class='thButton' type='button' name='sendInvite' value='Send Invitation' onclick='G.dom.$$(\"jsform-friends-invite\",0).submit();'>";
			G.dom.$("cWindowContent").innerHTML=this.TEXT;
			cWindowResize(300);
			joms.jQuery('#cWindowContentWrap').removeClass('loading').css('overflow', 'auto');
			

		}
	});
	jax.loadingFunction();
	a.enviar();
	return false;
}
	
	////////emails and names array///
	var allTheNamesToSend=new Array();
	var allTheEmailsToSend=new Array();
	
	var theEmailsToSend=new Array();
	var theNamesToSend=new Array();
	function addToList(inp){
		if($(inp).is(':checked')){
			ex='no';
			for(i in theEmailsToSend){
				if($(inp).val()==theEmailsToSend[i])		
					ex='si';				
			}
			if(ex=='no'){	
					theEmailsToSend.push($(inp).val());
					theNamesToSend.push($(inp).attr('id'));
			}		
		}else{
			for(i in theEmailsToSend){
				if($(inp).val()==theEmailsToSend[i]){		
					theEmailsToSend.splice(i,1);			
					theNamesToSend.splice(i,1);
				}			
			}
				
		}
	}
	
</script>

<?php
$contents .=ob_get_contents();
ob_clean();








$contents .= "<form action='' method='POST' name='openinviter' id='formopeninviter' onsubmit='return ajaxRequestContacts.call(this);'>" . ers ( $ers ) . oks ( $oks );
if (! $done) {
	
	
	$contents.='<div id="emailsListadoDivInvite">';
	$contents .= "<table width='100%' align='center' class='thTable' cellspacing='10' cellpadding='0' style='border:none;'>";
	
	if ($step == 'send_invites') {
		if ($inviter->showContacts ()) {
			$contents .= "<table width='100%' class='thTable' align='center' cellspacing='0' cellpadding='0'><tr class='thTableHeader'><td colspan='" . ($plugType == 'email' ? "3" : "2") . "'></td></tr>";
			if (count ( $contacts ) == 0)
				$contents .= "<tr class='thTableOddRow'><td align='center' style='padding:20px;' colspan='" . ($plugType == 'email' ? "3" : "2") . "'>".$_IDIOMA->traducir('You do not have any contacts in your address book')."</td></tr>";
			else {
				$contents .= "<tr class='thTableDesc'><td><!--<input type='checkbox' onChange='addAll(this);' name='toggle_all' title='".$_IDIOMA->traducir('Select/Deselect all')."'>--></td><td>".$_IDIOMA->traducir('Name')."</td>" . ($plugType == 'email' ? "<td>".$_IDIOMA->traducir('Email')."</td>" : "") . "</tr>";
				$odd = true;
				$counter = 0;
				foreach ( $contacts as $email => $name ) {
					$counter ++;
					if ($odd)
						$class = 'thTableOddRow';
					else
						$class = 'thTableEvenRow';
					$contents .= "<tr class='{$class}'><td> <input id='{$name}' name='check_{$counter}' value='{$email}' onchange='addToList(this);' type='checkbox' class='thCheckbox'></td><td>{$name}</td>" . ($plugType == 'email' ? "<td>{$email}</td>" : "") . "</tr>";
					$odd = ! $odd;
				}
				
			}
			
			$contents .= "</table>";
			$contents.='</div>';
			
			
		}
		$contents .= "<input type='hidden' name='step' value='get_contacts'>
			<input type='hidden' name='provider_box' value='{$_POST['provider_box']}'>
			<input type='hidden' name='email_box' value='{$_POST['email_box']}'>
			<input type='hidden' name='oi_session_id' value='{$_POST['oi_session_id']}'>";
	}
}
$contents .= "</form>";
echo $contents;

?>




<!--////////////Form invited/////////////////-->
<form style="display:none;" name="jsform-friends-invite" id="jsform-friends-invite" action="openinviter/invite.php" target="iframeSendInvitation" method="post">
 <input type="hidden" value="<?php print $_POST ['email_box'];?>" name="email_box"/>
 <input type="hidden" value="<?php print $_POST ['password_box'];?>" name="password_box"/>
 <input type="hidden" value="<?php print $_POST ['provider_box'];?>" name="provider_box"/>
 <textarea class="required inputbox" name="emails" id="emails" style="display:none;"></textarea>
 <textarea class="required inputbox" name="theNames" id="theNames" style="display:none;"></textarea>
 <textarea name="message_box" rows="6" style="display:none;">Este es el mensaje</textarea> 
 <textarea style="display:none;"  name="message_subject" rows="6">subjettt</textarea>
 <input type="hidden" name="steps" value="send_invites" />
 <input type="hidden" value="<? echo $_POST['oi_session_id'] ?>" name="oi_session_id">
 </form>



