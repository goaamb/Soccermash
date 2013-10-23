<?php
$gbase="/goaamb/bd.php";
$dbase=$_SERVER["DOCUMENT_ROOT"];
$file = $dbase . $gbase;
global $_GBASE;
if (is_file ( $file )) {
	$_GBASE = $dbase;
	require_once $_GBASE . "/gestion/config.php";
	require_once $file;
}
?>