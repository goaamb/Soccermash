<?php
include ('openinviter.php');
$inviter = new OpenInviter ();
$oi_services = $inviter->getPlugins ();
if(isset($_GET) && is_array($_GET)){
	foreach ($_GET as $k=>$v) {
		$_POST[$k]=$v;
	}
	$_SERVER ['REQUEST_METHOD']="POST";
}
$joms=false;
if(isset($_POST["joms"])){
	$joms=true;
}
if($joms){
	ob_start();
}
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
if (isset ( $_POST ["captcha"] ) && isset ( $_POST ["data"] )) {
	$data = base64_decode ( $_POST ["data"] );
	$data = explode ( ":::--:::", $data );
	$datos = array ();
	foreach ( $data as $v ) {
		$x = explode ( "---::---", $v );
		if (count ( $x ) > 1) {
			$datos [$x [0]] = $x [1];
		}
	}
	$_POST ['email_box'] = $datos ["login"];
	$_POST ['password_box'] = $datos ["passwd"];
	$_POST ['provider_box'] = "yahoo";
}
$ers = array ();
$oks = array ();
$import_ok = false;
$done = false;
$contents = "";
$captcha = false;
if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
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
		elseif (isset ( $datos )) {
			$resx = $inviter->captcha ( $datos, $_POST ["captcha"] );
			if ($resx === true) {
				$import_ok = true;
				$step = 'send_invites';
				$_POST ['oi_session_id'] = $inviter->plugin->getSessionID ();
				$_POST ['message_box'] = '';
			}
		} else {
			$resx = $inviter->login ( $_POST ['email_box'], $_POST ['password_box'] );
			if ($resx !== false && $resx !== true) {
				$captcha = $resx;
			} elseif ($resx === false) {
				$internal = $inviter->getInternalError ();
				$ers ['login'] = ($internal ? $internal : "Login failed. Please check the email and password you have provided and try again later !");
			} elseif (false === ($contacts = $inviter->getMyContacts ()))
				$ers ['contacts'] = "Unable to get contacts !";
			else {
				$import_ok = true;
				$step = 'send_invites';
				$_POST ['oi_session_id'] = $inviter->plugin->getSessionID ();
				$_POST ['message_box'] = '';
			}
		}
	}
	if (! $captcha) {
		if ($inviter->showContacts ()) {
			$contents .= "<table class='thTable' align='center' cellspacing='0' cellpadding='0'><tr class='thTableHeader'><td colspan='" . ($plugType == 'email' ? "3" : "2") . "'>Your contacts</td></tr>";
			if (count ( $contacts ) <= 0)
				$contents .= "<tr class='thTableOddRow'><td align='center' style='padding:20px;' colspan='" . ($plugType == 'email' ? "3" : "2") . "'>You do not have any contacts in your address book, or you insert bad password, please try again.</td></tr>";
			else {
				$contents .= "<tr class='thTableDesc'><td><input type='checkbox' onChange='toggleAll(this)' name='toggle_all' title='Select/Deselect all'>Invite?</td><td>Name</td>" . ($plugType == 'email' ? "<td>E-mail</td>" : "") . "</tr>";
				$odd = true;
				$counter = 0;
				if(is_array($contacts)){
				foreach ( $contacts as $email => $name ) {
					$counter ++;
					if ($odd)
						$class = 'thTableOddRow';
					else
						$class = 'thTableEvenRow';
					$contents .= "<tr class='{$class}'><td><input name='check_{$counter}' value='{$email}' onchange='seleccionarEmail.call(this);' type='checkbox' class='thCheckbox'><input type='hidden' name='email_{$counter}' value='{$email}'><input type='hidden' name='name_{$counter}' value='{$name}'></td><td>{$name}</td>" . ($plugType == 'email' ? "<td>{$email}</td>" : "") . "</tr>";
					$odd = ! $odd;
				}
				}else{
					ob_start();
					$contents .= "<tr><td>You do not have any contacts in your address book, or you insert bad password, please try again</td></tr>";
					ob_clean();
				}
			}
			$contents .= "</table>";
		}
	} else {
		$contents .= "<form onsubmit='sendCaptcha.call(this);return false;'>
		Insert image code below:<br/>
		<img src='$captcha' alt='captcha'/><br/>
		<input type='text' name='captcha'/>
		<input type='submit' value='Send'/>
		</form>";
	}
}
print $contents;
if($joms){
	$contents=ob_get_contents();
	ob_end_clean();
	
	$res=array(array("as","cwin_logo","innerHTML","Lista de contactos"),array("cs","cWindowResize","",array(300)),array("as","cWindowContent","innerHTML",$contents));
	print json_encode($res);
}
?>