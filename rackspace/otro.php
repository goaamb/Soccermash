<?php
require_once 'lib/cloudfiles.php';
//********** Autenticacion**********//
$auth = new CF_Authentication ( "soccermash", "92f6ab773351c06f10d29f2a9bbc3999" );
$auth->authenticate ();
$conn = new CF_Connection ( $auth );
//********** FIN Autenticacion**********//
//********** Bajar Archivo**********//
$fname = "images.png";
$comp_cont = ($conn->get_container ( "big-file-php" ));
$o2 = $comp_cont->get_object ( $fname );
$o2->save_to_filename ( "prueba/descargado.png" );
?><a href="prueba/descargado.png">Aqui el descargado</a><?php
//************ FIN Bajar Archivo*******//
?>