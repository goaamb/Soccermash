<?php
require_once $_GBASE . '/goaamb/GTranslate.php';
$json = new JSON ();
$success = false;

$gt = new Gtranslate ();
$gt->setRequestType ( 'curl' );
//english to spanish
$ml = ModelLoader::crear ( "ax_traduccion" );
$mlLan = ModelLoader::crear ( "ax_language" );
if ($mlLan->buscarPorCampo ( array ("tag" => "es-Es" ) )) {
	$lista = $ml->listar ( "traducido='No' and language='$mlLan->id'" );
	$error = 0;
	foreach ( $lista as $traduccion ) {
		try {
			$traduccion->traduccion = $gt->english_to_spanish ( $traduccion->original );
			$traduccion->traducido = "Si";
			$traduccion->modificar ( "id" );
		} catch ( GTranslateException $ge ) {
			$json->add ( "error" . $error, "'" . Utilidades::procesarTextoJSON ( $ge->getMessage () . $ge->getTraceAsString () ) . "'" );
			$error ++;
		}
	}
	$success = true;
}

if ($mlLan->buscarPorCampo ( array ("tag" => "pt-PT" ) )) {
	$lista = $ml->listar ( "traducido='No' and language='$mlLan->id'" );
	$error = 0;
	foreach ( $lista as $traduccion ) {
		try {
			$traduccion->traduccion = $gt->english_to_portuguese ( $traduccion->original );
			$traduccion->traducido = "Si";
			$traduccion->modificar ( "id" );
		} catch ( GTranslateException $ge ) {
			$json->add ( "error" . $error, "'" . Utilidades::procesarTextoJSON ( $ge->getMessage () . $ge->getTraceAsString () ) . "'" );
			$error ++;
		}
	}
	$success = true;
}

$json->add ( "success", $success ? "true" : "false" );
$json->printJSON ();
?>