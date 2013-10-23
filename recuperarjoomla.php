<?php
require_once 'gbase.php';
require_once 'goaamb/mail/qmail.php';
function getPass() {
	return substr ( md5 ( rand ( 1, 100000 ) ), 0, 8 );
}
$ml = ModelLoader::crear ( "ax_generalRegister" );
$listar = $ml->listar ( "joomla<>0 and not isnull(joomla)" );
//$listar = $ml->listar ( "id=129 or id=66" );
$fail = "";
foreach ( $listar as $usuario ) {
	try {
		$pass = getPass ();
		$usuario->passwordUser = md5 ( $pass );
		$usuario->joomla = "0";
		$usuario->joomlaSend = "1";
		$usuario->modificar ( "id" );
		QMail::add ( "recoverJoomla", $usuario->id, "SOCCERMASH.com recordatorio de tu nueva contraseña / SOCCERMASH.com your new password remainder.", "/templatemail/emailRecoverPassword.tpl", array ("email" => $usuario->email, "password" => $pass ), "Sistema" );
	} catch ( Exception $e ) {
		$fail .= $usuario->id . "<br/>";
	}
}
if ($fail) {
	print $fail;
} else {
	print "Enviado";
}
?>