<?php
$file = $_GBASE.'/goaamb/bd/modelloader.php';
if (is_file($file)) {
	require_once $file;
	global $conexion,$sDB_Host,$sDB_User,$sDB_Pass,$sDB_Name;
	$conexion = new GConexion ( "$sDB_Host", "$sDB_User", "$sDB_Pass", "$sDB_Name" );
	$conexion->abrir ();
}