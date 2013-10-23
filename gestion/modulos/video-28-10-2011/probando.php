<?
//$cadena="hola que tal espacio";
$cadena="asasdas";
$cadena = ereg_replace( "([     ]+)", "", $cadena ); 
echo $cadena;
?>