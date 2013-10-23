<?php
$dir = '';
require_once ($_SERVER ['DOCUMENT_ROOT'] . $dir . '/gbase.php');
require_once ($_GBASE . '/goaamb/mail/qmail.php');
QMail::add ( "alguno", 129, "hola", "/templatemail/destacado.tpl", array ("imgDestacado" => "http://www.soccermash.com/images/featured/3815Big.jpg", "urlDestacado" => "http://www.soccermash.com/home.php" ), "Sistema" );
?>