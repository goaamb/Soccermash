<?php
try {
	require_once $_SERVER ["DOCUMENT_ROOT"] . '/gbase.php';
	require_once $_GBASE . '/goaamb/idioma.php';
	$ml = ModelLoader::crear ( "ax_trace" );
	$mlippais = ModelLoader::crear ( "ax_ip_pais" );
	$ml->ip = isset ( $_SERVER ["HTTP_CLIENT_IP"] ) ? $_SERVER ["HTTP_CLIENT_IP"] : (isset ( $_SERVER ["HTTP_X_FORWARDED_FOR"] ) ? $_SERVER ["HTTP_X_FORWARDED_FOR"] : $_SERVER ["REMOTE_ADDR"]);
	$ip = explode ( ",", $ml->ip );
	if (count ( $ip ) > 0) {
		$ml->ip = trim ( $ip [0] );
	}
	if (isset ( $_SESSION ["iSMuIdKey"] )) {
		$ml->user = $_SESSION ["iSMuIdKey"];
		$mlu = ModelLoader::crear ( "ax_generalRegister" );
		if ($mlu->buscarPorCampo ( array ("id" => $ml->user ) )) {
			$mllang = ModelLoader::crear ( "ax_language" );
			$mlu->tiempoutlimaactividad = date ( "Y-m-d H:i:s" );
			$mlu->ipAddress = $ml->ip;
			if (! $mlippais->buscarPorCampo ( array ("ip" => $ml->ip ) )) {
				$code = Idioma::darCodigo2AlfaPais ( $ml->ip );
				$mlippais->ip = $ml->ip;
				$mlippais->pais = $code;
				$mlippais->insertar ();
			} else {
				$code = $mlippais->pais;
			}
			$mlu->paisReal = $code;
			if (isset ( $_SESSION ["lg"] ) && $mllang->buscarPorCampo ( array ("tag" => $_SESSION ["lg"] ) )) {
				$mlu->languageid = $mllang->id;
			}
			$mlu->modificar ( "id" );
		}
	}
	$ml->tiempo = date ( "Y-m-d H:i:s" );
	$ml->url = $_SERVER ["REQUEST_URI"];
	$ml->post = json_encode ( $_POST );
	$ml->get = json_encode ( $_GET );
	$ml->cookie = json_encode ( $_COOKIE );
	$browser = get_browser ( null, true );
	if (isset ( $browser ["parent"] )) {
		$ml->navegador = $browser ["parent"];
	}
	if (isset ( $browser ["platform"] )) {
		$ml->so = $browser ["platform"];
	}
	$ml->session = json_encode ( $_SESSION );
	$ml->files = json_encode ( $_FILES );
	$ml->insertar ();
} catch ( Exception $ex ) {
	$fname = $_SERVER ["DOCUMENT_ROOT"] . "/traza.log";
	$file = file_get_contents ( $fname );
	if (! $file) {
		$file = "";
	}
	$file .= $ex->getMessage ();
	file_put_contents ( $fname, $file );
}
?>
