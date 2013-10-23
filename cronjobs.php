<?php
require_once 'gbase.php';
require_once $_GBASE . '/goaamb/mail/qmail.php';
header ( "content-type:text/plain" );
print "Iniciando CronJobs SOCCERMASH\n";
if (isset ( $_REQUEST ["tipo"] ) && $_REQUEST ["tipo"] == "Sistema") {
	QMail::send ( "Sistema" );
} else {
	QMail::send ( "Usuario" );
}
print "Finalizando CronJobs SOCCERMASH\n";
?>