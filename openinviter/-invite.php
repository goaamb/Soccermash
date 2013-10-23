<script src="/goaamb/js/G.js"></script>
<script src="/js/jquery.js"></script>
<?php
include ('openinviter.php');
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
		if (empty ( $_POST ['email_box'] ))
			$ers ['email'] = "Email missing !";
		if (empty ( $_POST ['password_box'] ))
			$ers ['password'] = "Password missing !";
		if (empty ( $_POST ['provider_box'] ))
			$ers ['provider'] = "Provider missing !";
		if (count ( $ers ) == 0) {
			$inviter->startPlugin ( $_POST ['provider_box'] );
			$internal = $inviter->getInternalError ();
			if ($internal)
				$ers ['inviter'] = $internal;
			elseif (! $inviter->login ( $_POST ['email_box'], $_POST ['password_box'] )) {
				$internal = $inviter->getInternalError ();
				$ers ['login'] = ($internal ? $internal : "Login failed. Please check the email and password you have provided and try again later !");
			} elseif (false === $contacts = $inviter->getMyContacts ())
				$ers ['contacts'] = "Unable to get contacts !";
			else {
				$import_ok = true;
				$step = 'send_invites';
				$_POST ['oi_session_id'] = $inviter->plugin->getSessionID ();
				$_POST ['message_box'] = '';
			}
		}
	} elseif ($step == 'send_invites') {
		if (empty ( $_POST ['provider_box'] ))
			$ers ['provider'] = 'Provider missing !';
		else {
			$inviter->startPlugin ( $_POST ['provider_box'] );
			$internal = $inviter->getInternalError ();
			if ($internal)
				$ers ['internal'] = $internal;
			else {
				if (empty ( $_POST ['email_box'] ))
					$ers ['inviter'] = 'Inviter information missing !';
				if (empty ( $_POST ['oi_session_id'] ))
					$ers ['session_id'] = 'No active session !';
				if (empty ( $_POST ['message_box'] ))
					$ers ['message_body'] = 'Message missing !';
				else
					$_POST ['message_box'] = strip_tags ( $_POST ['message_box'] );
					
				$_POST['oi_session_id']=$io_session;	
				$selected_contacts = array ();
				$contacts = array ();
				$message = array ('subject' => $inviter->settings ['message_subject'], 'body' => $inviter->settings ['message_body'], 'attachment' => "\n\rAttached message: \n\r" . $_POST ['message_box'] );
				if ($inviter->showContacts ()) {
					foreach ( $_POST as $key => $val )
						if (strpos ( $key, 'check_' ) !== false)
							$selected_contacts [$_POST ['email_' . $val]] = $_POST ['name_' . $val];
						elseif (strpos ( $key, 'email_' ) !== false) {
							$temp = explode ( '_', $key );
							$counter = $temp [1];
							if (is_numeric ( $temp [1] ))
								$contacts [$val] = $_POST ['name_' . $temp [1]];
						}
					if (count ( $selected_contacts ) == 0)
						$ers ['contacts'] = "You haven't selected any contacts to invite !";
						//var_dump($_POST);
					}
			}
		}
	}
} else {
	$_POST ['email_box'] = '';
	$_POST ['password_box'] = '';
	$_POST ['provider_box'] = '';
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
//$contents.="<h3>".JText::_("CC INVITE CONTACTS")."</h3>";
ob_start();
?>
<script type="text/javascript" src="<?php print JDIR_WEB;?>goaamb/js/G.js"></script>
<script type="text/javascript">
/*jax.xCall=function (page,request){
	if(typeof request=="string"){
		page+="?"+request;
	}else if(typeof request=="object"){
		page+="?";
		var x=[];
		for(r in request){
			x=r+"="+request[r];
		}
		page+=x.join("&");
	}
	
	this.xSubmitITask(page);
};*/
/*jax.xSubmitITask=function (url){
	var xmlReq=url;
	this.loadingFunction();
	if(!this.iframe){
		this.iframe=document.createElement("iframe");
		this.iframe.setAttribute("id","ajaxIframe");
		this.iframe.setAttribute("height",0);
		this.iframe.setAttribute("width",0);
		this.iframe.setAttribute("border",0);
		this.iframe.style.visibility="hidden";
		document.body.appendChild(this.iframe);
		this.iframe.src=xmlReq;
	}else{
		this.iframe.src=xmlReq;
	}
};*/
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
	function seleccionarEmail(inp){
		var emails=G.dom.$$("emails",0);
		if(emails){
			var xemails=G.util.trim(emails.innerHTML).split(",");
			if(this.checked){
				xemails.push(this.value);
			}else{
				var nemails=[];
				for(var i=0;i<xemails.length;i++){
					if(xemails[i]!=this.value){
						nemails.push(xemails[i]);
					}
				}
				xemails=nemails;
			}
			var nemails=[];
			for(var i=0;i<xemails.length;i++){
				var trimmed=G.util.trim(xemails[i]);
				if(trimmed!=""){
					nemails.push(trimmed);
				}
			}
			emails.innerHTML=nemails.join(",");
		}
		
	}
	function sendCaptcha(){
		cWindowShow("", '', 450, 100);
		var a=new G.ajax({
			pagina:"<?php print JDIR_WEB;?>openinviter/ajaxgetcontacts.php",
			post:{
				captcha:this.captcha.value,
				data:G.cookie.get("yahoo_data")
			},
			accion:function(){
				G.dom.$("cWindowContent").innerHTML=this.TEXT;
				cWindowResize(300);
				joms.jQuery('#cWindowContentWrap').removeClass('loading').css('overflow', 'auto');
			}
		});
		jax.loadingFunction();
		a.enviar();
		return false;
	}
	
	function addToList(inp){
		$("#jsform-friends-invite").append(inp);
	}
	
</script>
<div style="display:none; position:absolute;z-index:1;left:50px;top:50px;width:400px;height:300px; border:1px solid black;background:white;" id="ventanaContactos">
<div id="ventanaContactosTitulo" style="width:390px;background:black;height:22px;padding:5px;color:white; cursor: move;" onmousedown="G.Dragdrop.dragStart(event,this.parentNode);"><span style="float:left;">List of Contacts</span> <div style="padding:1px 4px;border:1px solid white;float:right; cursor:pointer;" onclick="this.parentNode.parentNode.style.display='none';">x</div></div>
<div id="ventanaContactosContenido" style="width:390px;padding:5px;height:258px;overflow: auto;cursor: default;"></div>
</div>
<?php
$contents .=ob_get_contents();
ob_clean();
$contents .= "<form action='' method='POST' name='openinviter' id='formopeninviter' onsubmit='return ajaxRequestContacts.call(this);'>" . ers ( $ers ) . oks ( $oks );
if (! $done) {
	$contents .= "<table align='center' class='thTable' cellspacing='10' cellpadding='0' style='border:none;'>";
	$contents.="<tr class='thTableRow'><td align='right'><label for='provider_box'>Email provider</label></td><td><select class='thSelect' name='provider_box'><option value=''></option>";
	foreach ( $oi_services as $type => $providers ) {
		$contents .= "<optgroup label='{$inviter->pluginTypes[$type]}'>";
		foreach ( $providers as $provider => $details )
			$contents .= "<option value='{$provider}'" . ($_POST ['provider_box'] == $provider ? ' selected' : '') . ">{$details['name']}</option>";
		$contents .= "</optgroup>";
	}
	$contents .= "</select></td></tr>";
	$contents .= "<tr class='thTableRow'><td align='right'><label for='email_box'>Email</label></td><td><input class='thTextbox' type='text' name='email_box' value='{$_POST['email_box']}'></td></tr>
			<tr class='thTableRow'><td align='right'><label for='password_box'>Password</label></td><td><input class='thTextbox' type='password' name='password_box' value='{$_POST['password_box']}'></td></tr>";
	$contents .= "<tr class='thTableImportantRow'><td colspan='2' align='right'>
			<input class='thButton' type='submit' name='import' value='Import Contacts'><br/><br/>";
	if($ajaxActive){
		$contents .= "<input type='button' class='button' value='". JText::_('CC INVITE SKIP') ."' onclick='location.href=\"".JDIR_WEB."searchown/uploadphoto.php\";'>";
	}
	$contents .= "</td></tr>
			</td></tr>
		</table><input type='hidden' name='step' value='get_contacts'>";
	if ($step == 'send_invites') {
		if ($inviter->showContacts ()) {
			$contents .= "<table class='thTable' align='center' cellspacing='0' cellpadding='0'><tr class='thTableHeader'><td colspan='" . ($plugType == 'email' ? "3" : "2") . "'>Your contacts</td></tr>";
			if (count ( $contacts ) == 0)
				$contents .= "<tr class='thTableOddRow'><td align='center' style='padding:20px;' colspan='" . ($plugType == 'email' ? "3" : "2") . "'>You do not have any contacts in your address book.</td></tr>";
			else {
				$contents .= "<tr class='thTableDesc'><td><input type='checkbox' onChange='toggleAll(this)' name='toggle_all' title='Select/Deselect all'>Invite?</td><td>Name</td>" . ($plugType == 'email' ? "<td>E-mail</td>" : "") . "</tr>";
				$odd = true;
				$counter = 0;
				foreach ( $contacts as $email => $name ) {
					$counter ++;
					if ($odd)
						$class = 'thTableOddRow';
					else
						$class = 'thTableEvenRow';
					$contents .= "<tr class='{$class}'><td><input name='check_{$counter}' value='{$email}' onchange='seleccionarEmail.call(this); addToList(this);' type='checkbox' class='thCheckbox'><input type='hidden' name='email_{$counter}' value='{$email}'><input type='hidden' name='name_{$counter}' value='{$name}'></td><td>{$name}</td>" . ($plugType == 'email' ? "<td>{$email}</td>" : "") . "</tr>";
					$odd = ! $odd;
				}
				//$contents.="<tr class='thTableFooter'><td colspan='".($plugType=='email'? "3":"2")."' style='padding:3px;'><input type='submit' name='send' value='Send invites' class='thButton'></td></tr>";
				
			}
			
			$contents .= "</table>";
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
<form name="jsform-friends-invite" id="jsform-friends-invite" action="" method="post">
 <input type="hidden" value="<?php print $_POST ['email_box'];?>" name="email_box"/>
 <input type="hidden" value="<?php print $_POST ['password_box'];?>" name="password_box"/>
 <input type="hidden" value="<?php print $_POST ['provider_box'];?>" name="provider_box"/>
  <?php //echo $beforeFormDisplay;?>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
  <tr>
  <td><label>
   
   </label></td>
  <td><?php echo $my->email; ?></td>
  </tr>
  <tr><td><label>
    
   </label></td>
  <td><textarea class="required inputbox" name="emails" style="height:60px;line-height: 1.2em;"><?php echo (! empty($post['emails'])) ? $post['emails'] : '' ; ?></textarea>
   <div class="small"></div></td></tr>
  <tr><td><label>
   
   </label></td>
  <td><textarea name="message_box" rows="6">Este es el mensaje</textarea> <textarea  name="message_subject" rows="6">subjettt</textarea>
   </td></tr>
  <tr><td colspan="2"><span class="hints"></span></td></tr>
  <tr><td colspan="2"><?php //echo $afterFormDisplay;?></td></tr>
  <tr><td colspan="2"><input type="hidden" name="step" value="send_invites" />
  <input type="hidden" value="<? echo $_POST['oi_session_id'] ?>" name="oi_session_id">
   <input type="submit" class="button" value="send">
  </tbody>
  </table>
 </form>



