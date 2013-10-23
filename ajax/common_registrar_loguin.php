<?php
require_once ('../gestion/lib/site_ini.php');
require_once ('../gestion/lib/share/clases/lib_util.inc.php');
require_once ('../gestion/lib/share/clases/class_site.inc.php');
require_once ('../gestion/lib/share/clases/class_peopleNet.php');


#lib del captcha
require_once ('recaptchalib.php');

#Verifica si el mail esta en la lista negra
function esBlackList($email) {
	global  $sDB_Host, $sDB_User, $sDB_Pass, $sDB_Name;
	require_once '../gbase.php';
	if (isset ( $_GBASE )) {
		require_once $_GBASE . '/goaamb/bd/modelloader.php';
		$mlaxblacklist = ModelLoader::crear ( "ax_blacklist" );
		if ($mlaxblacklist->buscarPorCampo ( array ("mail" => $email ) )) {
			return true;
		}
	}
	return false;
}

#Function p/ enviar el e-mail de Forgot
function enviarForgot($aForm) {
	global $_IDIOMA;
	$oRespuesta = new xajaxResponse ();
	$oRespuesta->script ( "$('#emailForgot').tipsy('hide');" );
	
	global $SITE;
	$SITE = new SITE ();
	
	if (! chekEmail ( $aForm ['emailForgot'] )) {
		
		$oRespuesta->script ( "$('#emailForgot').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $_IDIOMA->traducir('Invalid Email format')."'});" );
		$oRespuesta->script ( "$('#emailForgot').tipsy('show');" );
		#return false;					
	} else {
		$email = $aForm ['emailForgot'];
		if ($aUsuario = $SITE->getUsuario ( NULL, "email='$email'" )) {
			$iIdUser = $aUsuario ['id'];
			$newPass = generatePassword ( 6, 2 );
			$newPass2 = $newPass;
			$sName = $aUsuario ['name'] . ', ' . $aUsuario ['lastName'];
			$aUsuario ['passwordUser'] = md5 ( $newPass );
			$aUsuario ['joomla'] = 0;
			
			if ($SITE->modificarUsuario ( $iIdUser, $aUsuario )) {
				if (sendEmail ( $sName, $newPass2, $email,$iIdUser )) {
				
					$oRespuesta->assign ( "error-emailForgot", "innerHTML",  $_IDIOMA->traducir("Email sent"));
					$oRespuesta->script ( "$('#formForgot').hide();" );
					$oRespuesta->script ( "$('#formLogin').show();" );
					$oRespuesta->script ( "$('#forgot').hide();" );
					$oRespuesta->script ( "$('#msjPassw').show();" );
					
				} else {
				
					$oRespuesta->script ( "$('#emailForgot').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $_IDIOMA->traducir('Email not sent')."'});" );
					$oRespuesta->script ( "$('#emailForgot').tipsy('show');" );
				}
			} else {
				
				$oRespuesta->script ( "$('#emailForgot').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $_IDIOMA->traducir('Please try again')."'});" );
				$oRespuesta->script ( "$('#emailForgot').tipsy('show');" );
				
			}
		
		} else {
			
			$oRespuesta->script ( "$('#emailForgot').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $_IDIOMA->traducir('Email doesnt exist')."'});" );
			$oRespuesta->script ( "$('#emailForgot').tipsy('show');" );
			
		}
	}
	
	return $oRespuesta;
} #enviarForgot


function generatePassword($length = 6, $level = 2) {
	
	$validchars [1] = "0123456789abcdfghjkmnpqrstvwxyz";
	$validchars [2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$validchars [3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";
	
	$password = "";
	$counter = 0;
	
	while ( $counter < $length ) {
		$actChar = substr ( $validchars [$level], rand ( 0, strlen ( $validchars [$level] ) - 1 ), 1 );
		
		// All character must be different
		if (! strstr ( $password, $actChar )) {
			$password .= $actChar;
			$counter ++;
		}
	}
	$sPassNew = $password;
	return $password;
}

function sendEmail($sName, $sNewPass, $sEmail,$iIdUser) {
	// User Data
	$to = $sEmail;
	$subject = "SOCCERMASH.com: New Password";
	global $_GBASE;

	// Send E-mail
	require_once $_SERVER["DOCUMENT_ROOT"]."/gbase.php";
	require_once $_GBASE."/goaamb/mail/qmail.php";
	
	return QMail::add("forgotPassword", $iIdUser, $subject, "/templatemail/emailForgotPassword.tpl", array("name"=>$sName,"email"=>$sEmail,"password"=>$sNewPass), "Sistema");

		//return false;	


}
# end Forgot


## Funciones del form de Registrar
function mostrarRegistrar() {
	$oRespuesta = new xajaxResponse ();
	$oRespuesta->script ( "$('#registerAmistoso').fadeOut();" ); #hide register amistoso
	$oRespuesta->script ( "$('#portadaGeneral').fadeIn();" ); #Open loguin & general register
	return $oRespuesta;
}

function enviarRegistrar($aForm) {
	global $_IDIOMA;
	$oRespuesta = new xajaxResponse ();
	
	if (registrar ( $aForm )) {
		
		#$oRespuesta->script("$('#portadaGeneral').hide();");#hide loguin & general register
		#$oRespuesta->script("$('#registerAmistoso').fadeIn();");#Open register amistoso
		$oRespuesta->call ( 'JS_registerAmistoso' );
	
	} else {
		$oRespuesta->assign ( "error-registerGeneral", "innerHTML",  $_IDIOMA->traducir("There were problems during registration. Please try again"));
		$oRespuesta->script ( "$('#error-registerGeneral').fadeIn();" );
	}
	return $oRespuesta;
}

function registrar($aForm) {
	$aUser = getParametros ( $aForm );
	unset ( $aUser ['recaptcha_response'] );
	unset ( $aUser ['recaptcha_challenge'] );
	#unset ($aUser['termsOfUse']); 
	global $SITE;
	$SITE = new SITE ();
	global $LPEOPLE;
	$LPEOPLE = new PeopleNet ();
	
	if ($SITE->agregarUsuario ( $aUser )) {
		$aGetUser = $SITE->getUsuario ( NULL, "email='" . $aUser ['email'] . "'" );
		$iKeyRegisterUserSM = $aGetUser ['id'];
		$bResultLP = $LPEOPLE->agregarUsuario ( $iKeyRegisterUserSM );
		$iKeyProfileUser = $aGetUser ['profileId'];
		$sSMuNameUserKey = $aGetUser ['name'];
		$_SESSION ["iSMuIdKey"] = $iKeyRegisterUserSM;
		$_SESSION ["iSMuProfTypeKey"] = $iKeyProfileUser;
		$_SESSION ["sSMuNameUserKey"] = $sSMuNameUserKey;
		
		return true;
	}
	
	return false;
}

function getParametros($aForm) {
	$aUser = array ();
	$aUser ['profileId'] = $aForm ['profileType'];
	$aUser ['name'] = $aForm ['firstName'];
	$aUser ['lastName'] = $aForm ['lastName'];
	$aUser ['email'] = $aForm ['emailNewUser'];
	$aUser ['repeatEmail'] = $aForm ['repeatEmail'];
	$aUser ['passwordUser'] = $aForm ['newUserPass'];
	$aUser ['ipAddress'] = $aForm ['ipAddress'];
	$aUser ['active'] = 1;
	$aUser ['photo'] = 'photoDefault.jpg';
	#$aUser['termsOfUse'] 			=	$aForm['termsOfUse'];
	$aUser ['recaptcha_response'] = $aForm ["recaptcha_response_field"];
	$aUser ['recaptcha_challenge'] = $aForm ["recaptcha_challenge_field"];
	if (empty ( $aUser ['ipAddress'] ))
		$aUser ['ipAddress'] = "0"; //"0" no IP
	

	return $aUser;
}

function validaRegistrar($aForm) {
	global $_IDIOMA;
	$oRespuesta = new xajaxResponse ();
	$aErrores = array ();
	//clear foelds error
	$oRespuesta->script ( "$('#error-registerGeneral').fadeOut();" );
	
	$oRespuesta->script ( "$('#firstName').tipsy('hide');" );
	$oRespuesta->script ( "$('#lastName').tipsy('hide');" );
	$oRespuesta->script ( "$('#emailNewUser').tipsy('hide');" );
	$oRespuesta->script ( "$('#newUserPass').tipsy('hide');" );
	$oRespuesta->script ( "$('#repeatEmail').tipsy('hide');" );
	
	$oRespuesta->assign ( "register-termsOfUse", "innerHTML", '' );
	$oRespuesta->script ( "$('#register-termsOfUse').fadeOut();" );
	
	global $SITE;
	$SITE = new SITE ();
	$aUser = getParametros ( $aForm );
	
	//Chek de fields: General Register
	# Name
	if (empty ( $aUser ['name'] )) {
		$aErrores ['name'] =  $_IDIOMA->traducir("Name field empty");
	}
	
	# Name
	if (empty ( $aUser ['profileId'] )) {
		$aErrores ['profileId'] =  $_IDIOMA->traducir("Unselected profile. Choose yours");
	}
	
	# LastName
	if (empty ( $aUser ['lastName'] )) {
		$aErrores ['lastName'] = $_IDIOMA->traducir("Last Name field empty");
	}
	
	# Validación del e-mail
	if (! empty ( $aUser ['email'] )) {
		if (! chekEmail ( $aUser ['email'] )) {
			$aErrores ['email1'] = $_IDIOMA->traducir("Invalid Email format");
		} else {
			$email = $aUser ['email'];
			if ($SITE->getUsuario ( 'email', "email='$email'" )) {
				$aErrores ['email2'] = $_IDIOMA->traducir("Email already exists");
			}
		
		}
	} else
		$aErrores ['email3'] = $_IDIOMA->traducir("Email required");
	
		#Compara los e-mail
	if ($aUser ['email'] != $aUser ['repeatEmail'])
		$aErrores ['repeatEmail'] = $_IDIOMA->traducir("Email is different");
	
		# password
	if (empty ( $aUser ['passwordUser'] )) {
		$aErrores ['passwordUser'] = $_IDIOMA->traducir("Password required");
	}
	
	#terms of use
	/*if (!isset($aUser['termsOfUse']))
		{
				$aErrores['termsOfUse'] = 'You do not accept the conditions.';		
		}*/
	if (empty ( $aUser ['recaptcha_response'] )) {
		$aErrores ['recaptcha'] = $_IDIOMA->traducir("Captcha required");
	}
	
	#Captcha
	$publickey = "6LeE1cQSAAAAAFCoYCvdsvpJy_sUvbLRqz8nO8x2";
	$privatekey = "6LeE1cQSAAAAAAqt0DPw6HOxGjgYo-aD3ql1pTAn";
	;
	# the response from reCAPTCHA
	$resp = null;
	# the error code from reCAPTCHA, if any
	$error = null;
	if ($aUser ['recaptcha_response']) {
		$resp = recaptcha_check_answer ( $privatekey, $_SERVER ["REMOTE_ADDR"], $aUser ['recaptcha_challenge'], $aUser ['recaptcha_response'] );
		
		if (! $resp->is_valid) {
			$aErrores ['recaptcha'] = $_IDIOMA->traducir("Incorrect Captcha.");
		}
	}
	
	if(esBlackList($aUser ['email'])){
		$aErrores ['invalidEmail'] = $_IDIOMA->traducir("Invalid Email.");
	}
	
	// Si hubo errores en el form se escribe	
	if (sizeof ( $aErrores ) > 0) {
		//$oRespuesta->assign ( "error-registerGeneral", "innerHTML",  $_IDIOMA->traducir("Check the data fields"));
		//$oRespuesta->script ( "$('#error-registerGeneral').fadeIn();" );
		$oRespuesta->script ( "$('#carga').fadeOut();" );
		$oRespuesta->script ( "$('#newUser').fadeIn();" );
		
		if (isset ( $aErrores ['name'] )) {
			$oRespuesta->script ( "$('#firstName').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['name']."'});" );
			$oRespuesta->script ( "$('#firstName').tipsy('show');" );
			unset ( $aErrores ['name'] );
		}
		
		if (isset ( $aErrores ['profileId'] )) {
			$oRespuesta->script ( "$('#textShowed').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['profileId']."'});" );
			$oRespuesta->script ( "$('#textShowed').tipsy('show');" );
			unset ( $aErrores ['profileId'] );
		}
		
		if (isset ( $aErrores ['lastName'] )) {
			$oRespuesta->script ( "$('#lastName').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['lastName']."'});" );
			$oRespuesta->script ( "$('#lastName').tipsy('show');" );
			unset ( $aErrores ['lastName'] );
		}
		
		if (isset ( $aErrores ['passwordUser'] )) {
			
			$oRespuesta->script ( "$('#newUserPass').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['passwordUser']."'});" );
			$oRespuesta->script ( "$('#newUserPass').tipsy('show');" );
			unset ( $aErrores ['passwordUser'] );
		}
		
		if (isset ( $aErrores ['email1'] )) {
			
			$oRespuesta->script ( "$('#emailNewUser').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['email1']."'});" );
			$oRespuesta->script ( "$('#emailNewUser').tipsy('show');" );
			unset ( $aErrores ['email1'] );
		}
		if (isset ( $aErrores ['email2'] )) {
			
			$oRespuesta->script ( "$('#emailNewUser').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['email2']."'});" );
			$oRespuesta->script ( "$('#emailNewUser').tipsy('show');" );
			unset ( $aErrores ['email2'] );
		}
		if (isset ( $aErrores ['email3'] )) {
			
			$oRespuesta->script ( "$('#emailNewUser').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['email3']."'});" );
			$oRespuesta->script ( "$('#emailNewUser').tipsy('show');" );
			unset ( $aErrores ['email3'] );
		}
		
		if (isset ( $aErrores ['repeatEmail'] )) {
			$oRespuesta->script ( "$('#repeatEmail').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$aErrores ['repeatEmail']."'});" );
			$oRespuesta->script ( "$('#repeatEmail').tipsy('show');" );
			unset ( $aErrores ['repeatEmail'] );
		}
		if (isset ( $aErrores ['recaptcha'] )) {
			
			$oRespuesta->script ( "$('#recaptcha_response_field').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['recaptcha']."'});" );
			$oRespuesta->script ( "$('#recaptcha_response_field').tipsy('show');" );
			$oRespuesta->script ( "Recaptcha.reload();" );
			unset ( $aErrores ['recaptcha'] );
		}
		if (isset ( $aErrores ['termsOfUse'] )) {
			$oRespuesta->assign ( "register-termsOfUse", "innerHTML", $aErrores ['termsOfUse'] );
			$oRespuesta->script ( "$('#register-termsOfUse').fadeIn();" );
			unset ( $aErrores ['termsOfUse'] );
		}
		if(isset($aErrores ['invalidEmail'])){
			$oRespuesta->script ( "$('#emailNewUser').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$aErrores ['invalidEmail']."'});" );
			$oRespuesta->script ( "$('#emailNewUser').tipsy('show');" );
			unset ( $aErrores ['invalidEmail'] );
		}
	} else {
		$oRespuesta->call ( 'JS_registrar' );
	}
	return $oRespuesta;
}

## Funciones del form de Loguin
function mostrarLoguin() {
	$oRespuesta = new xajaxResponse ();
	$oRespuesta->script ( "$('#loguin').fadeIn();" ); #Open loguin & general register
	return $oRespuesta;
}

function enviarLoguin($aForm) {
	global $_IDIOMA;
	$oRespuesta = new xajaxResponse ();
	$aResult = loguin ( $aForm );
	if ($aResult ['error'] == 1) //sin errores
{
		if ($aResult ['complete'] == 1) { //esta todo ok! muestro el Home del User
			$oRespuesta->call ( 'JS_homeUser' );
		} else { // No esta completo el regisetrAmistoso
			$oRespuesta->call ( 'JS_registerAmistoso' );
		}
	} else //Hubo errores, los muestro!
{
		
		$oRespuesta->assign ( "error-loguin", "innerHTML",  $_IDIOMA->traducir('Check the data fields. Please try again'));
		$oRespuesta->script ( "$('#error-loguin').fadeIn();" );
		if (isset ( $aResult ['emailLoguin'] )) {
			$oRespuesta->assign ( "error-emailLoguin", "innerHTML", $aResult ['emailLoguin'] );
			$oRespuesta->script ( "$('#error-emailLoguin').fadeIn();" );
		}
		if (isset ( $aResult ['passwordLoguin'] )) {
			$oRespuesta->assign ( "error-passwordLoguin", "innerHTML", $aResult ['passwordLoguin'] );
			$oRespuesta->script ( "$('#error-passwordLoguin').fadeIn();" );
		}
	}
	
	return $oRespuesta;
}

function loguin($aForm) {
	$aUser = getParametrosLoguin ( $aForm );
	global $SITE;
	$SITE = new SITE ();
	
	# Obtengo $aGetUser & $bGetError, (los datos del user o true), o (los errores y false)
	list ( $aGetUser, $bGetError ) = $SITE->userLogin ( $aUser, $bError );

	if ($bGetError) //datos correctos
{
		$aGetUser ['error'] = 1; //No hubo error
		return $aGetUser;
	
	} else { //Hubo error
		$aGetUser ['error'] = 0;
		return $aGetUser;
	}

}

function getParametrosLoguin($aForm) {
	$aUser = array ();
	
	$aUser ['email'] = $aForm ['emailLoguin'];
	$aUser ['passwordUser'] = $aForm ['passwordLoguin'];
	
	return $aUser;
}

function validaLoguin($aForm) {
	global $_IDIOMA;
	$oRespuesta = new xajaxResponse ();
	$aErrores = array ();
	//clear msj error
	$oRespuesta->script ( "$('#emailLogin').tipsy('hide');" );
	$oRespuesta->script ( "$('#ps').tipsy('hide');" );
	
	global $SITE;
	$SITE = new SITE ();
	
	$aUser = getParametrosLoguin ( $aForm );
	
	//Chek de fields: Loguin
	if (! empty ( $aUser ['email'] )) {
		if (! chekEmail ( $aUser ['email'] )) {
			$aErrores ['email1'] = $_IDIOMA->traducir('Invalid Email format');
		}
		else #formato de email correcto-->consulta BD
		{
			$email = $aUser ['email'];
			#if(!$SITE->getUsuario('email', "email='$email'"))
			if ($aGetUser = $SITE->getUsuario ( 'id,active,passwordUser,name,lastName,profileId,email,complete,joomla', "email='" . $email . "'" )) {
				$bPasa = true;
				if ($aGetUser ['active'] != 1) { #User desabilitado
					$aErrores ['active'] = $_IDIOMA->traducir('Disabled Account.');
					$bPasa = false;
				}
				/* *** Validacion de Loguin de users de Joomla y Nuevos ****  */
				if (! empty ( $aGetUser ['joomla'] )) { #es usuario de joomla
					$respuesta = file_get_contents ( "http://pruebagral.soccermash.com/verificar.php?u=" . $aUser ['email'] . "&p=" . $aUser ['passwordUser'] );
					if ($respuesta == "Si") { #son correctos los datos de loguin de joomla
						

						//codigo para guardar la contraseña: $aUser['passwordUser']
						$aGetUser ['joomla'] = 'NULL'; #el "NULL" indica q es usuario nuevo
						$iIdUser = $aGetUser ['id'];
						$aGetUser ['passwordUser'] = md5 ( $aUser ['passwordUser'] ); #es la pass q ingreso en el loguin
						

						if ($SITE->modificarUsuario ( $iIdUser, $aGetUser )) {
							$bPasa = true; #se actualiza el user de joomla en la nueva plataforma
						} else { #no se pudo actualizar
							$bPasa = false;
						} #
					

					} else { #son incorrectos los datos del user de joomla
						$aErrores ['passwordUser1'] = $_IDIOMA->traducir('Incorrect Password');
						$bPasa = false;
					}
				
				} elseif ($aGetUser ['passwordUser'] != md5 ( $aUser ['passwordUser'] )) { #Compara al User nuevo
					$aErrores ['passwordUser1'] = $_IDIOMA->traducir('Incorrect Password');
					$bPasa = false;
				}
				
				if ($bPasa) { #Esta todo Ok-->carga la session
					$_SESSION ["iSMuIdKey"] = $aGetUser ['id'];
					$iKeyProfileUser = $aGetUser ['profileId'];
					$sSMuNameUserKey = $aGetUser ['name'];
					$_SESSION ["iSMuProfTypeKey"] = $iKeyProfileUser;
					$_SESSION ["sSMuNameUserKey"] = $sSMuNameUserKey;
				
				}
			} else { #no existe el user
				$aErrores ['email2'] = $_IDIOMA->traducir('Email not exists');
			}
		
		}
	} else
		$aErrores ['email'] = $_IDIOMA->traducir('Email required');
	
		# password
	if (empty ( $aUser ['passwordUser'] )) {
		$aErrores ['passwordUser2'] = $_IDIOMA->traducir('Incorrect Password');
	}
	
	// Si hubo errores en el form se escribe
	if (sizeof ( $aErrores ) > 0) {
		if (isset ( $aErrores ['active'] )) {
			$oRespuesta->script ( "$('#emailLogin').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $_IDIOMA->traducir('Disabled Account')."'});" );
			$oRespuesta->script ( "$('#emailLogin').tipsy('show');" );
			unset ( $aErrores ['active'] );
		}
		if (isset ( $aErrores ['email'] )) {
			$oRespuesta->script ( "$('#emailLogin').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $_IDIOMA->traducir('Email required')."'});" );
			$oRespuesta->script ( "$('#emailLogin').tipsy('show');" );
			unset ( $aErrores ['email'] );
		}
		if (isset ( $aErrores ['email1'] )) {
			$oRespuesta->script ( "$('#emailLogin').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $_IDIOMA->traducir('Invalid Email format')."'});" );
			$oRespuesta->script ( "$('#emailLogin').tipsy('show');" );
			unset ( $aErrores ['emai1l'] );
		}
		if (isset ( $aErrores ['email2'] )) {
			$oRespuesta->script ( "$('#emailLogin').tipsy({ trigger: 'manual', gravity:'e', fallback:'". $aErrores ['email2']."'});" );
			$oRespuesta->script ( "$('#emailLogin').tipsy('show');" );
			unset ( $aErrores ['email2'] );
		}
		if (isset ( $aErrores ['passwordUser1'] ) ) {
			$oRespuesta->script ( "$('#ps').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$aErrores ['passwordUser1']."'});" );
			$oRespuesta->script ( "$('#ps').tipsy('show');" );
			unset ( $aErrores ['passwordUser1'] );

		}
		if ( isset ( $aErrores ['passwordUser2'] )) {
			$oRespuesta->script ( "$('#ps').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$aErrores ['passwordUser2']."'});" );
			$oRespuesta->script ( "$('#ps').tipsy('show');" );
			unset ( $aErrores ['passwordUser2'] );
		}
	
	} else # No Hubo Errores
{
		if(isset($aForm["rememberMe"])){
			setcookie("SOCSESSIONID",base64_encode(Utilidades::cifrar($aForm ['emailLoguin'])),time()+7*24*60*60,"/");
		}
		if ($aGetUser ['complete'] == 1) { //si esta completo el registro--> muestro el Home del User
			$oRespuesta->call ( 'JS_homeUser' );
		} else { // No esta completo--> regisetrAmistoso
			$oRespuesta->call ( 'JS_registerAmistoso' );
		}
	}
	return $oRespuesta;
}

$oXajax = new xajax ();

$oXajax->registerFunction ( "enviarRegistrar" );
$oXajax->registerFunction ( "validaRegistrar" );
$oXajax->registerFunction ( "mostrarRegistrar" );
$oXajax->registerFunction ( "mostrarLoguin" );
$oXajax->registerFunction ( "enviarForgot" );
$oXajax->registerFunction ( "loguin" );
$oXajax->registerFunction ( "validaLoguin" );
$oXajax->registerFunction ( "enviarLoguin" );
$oXajax->registerFunction ( "mostrarLoguin" );
$oXajax->processRequest ();
?>
