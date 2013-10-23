<?php
require_once 'gbase.php';
require_once 'goaamb/web/json.php';
require_once 'goaamb/web/tags.php';
require_once 'goaamb/mail/qmail.php';
if (isset ( $_REQUEST ["__q"] )) {
	$file = "listado/" . strtolower ( $_REQUEST ["__q"] ) . ".php";
	if (is_file ( $file )) {
		include $file;
	} else {
		new Exception ( "El archivo receptor:" . $file . ", no existe." );
	}
} else {
	new Exception ( "No existe archivo receptor." );
}
?>