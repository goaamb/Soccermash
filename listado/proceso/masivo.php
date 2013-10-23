<?php
$json = new JSON ();
if (isset ( $_POST ["asunto"] ) && isset ( $_POST ["mensaje"] )) {
	$asunto = $_POST ["asunto"];
	$mensaje = $_POST ["mensaje"];
	$pmensaje = "/(\/files\/[^\"]+)/Us";
	$mensaje = preg_replace ( $pmensaje, "http://www.soccermash.com$1", $mensaje );
	$ml = ModelLoader::crear ( "ax_generalRegister" );
	$lista = $ml->listar ( "active=1" );
	$patronemail = "/^[a-zA-Z0-9\_\-\.]{2,}\@[a-zA-Z0-9\_\-\.]{2,}\.[a-zA-Z0-9\_\-\.]{2,6}$/";
	foreach ( $lista as $usuario ) {
		if (preg_match ( $patronemail, $usuario->email ) === 1) {
			QMail::add ( "Notificacion", $usuario->id, $asunto, "/templatemail/emailDefault.tpl", array ("content" => $mensaje ), "Sistema" );
		}
	}
	$json->add ( "cuenta", count ( $lista ) );
}
$json->printJSON ();
?>