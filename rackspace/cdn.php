<?php
require_once 'lib/cloudfiles.php';
//********** Autenticacion**********//
$auth = new CF_Authentication ( "soccermash", "92f6ab773351c06f10d29f2a9bbc3999" );
$auth->authenticate ();
$conn = new CF_Connection ( $auth );
//********** FIN Autenticacion**********//
//********** Subir Archivo**********//
$archivo = "prueba/images_aver.png";
$pi = pathinfo ( $archivo );
//crear un contenedor
$comp_cont = ($conn->create_container ( "big-file-php" ));
$md5_orig = md5_file ( $archivo );
$filesize_orig = filesize ( $archivo );
$obj = $comp_cont->create_object ( $pi ['basename'] );
$obj->content_type = "application/octet-stream";
$obj->set_etag ( $md5_orig );
$fp = fopen ( $archivo, "rb" );
$obj->write ( $fp );
fclose ( $fp );
//********** FIN Subir Archivo**********//
print "Prueba subir archivo con autenticacion";
?>