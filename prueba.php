<?php
$gbase = '/goaamb/bd.php';
$dbase = dirname(__FILE__);
$file = $dbase . $gbase;
while ( trim ( $dbase ) !== "" && ! is_file ( $file ) ) {
	$dbase = dirname ( $dbase );
	$file = $dbase . $gbase;
}
if (is_file ( $file )) {
	$_GBASE = $dbase;
	require_once $_GBASE."/gestion/lib/site_ini.php";
	require_once $file;
}
var_dump($conexion);

?>