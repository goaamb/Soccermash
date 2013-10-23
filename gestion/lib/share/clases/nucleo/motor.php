<?php
// Núcleo del CMS
require("nucleo.php");

// Paso de variables GET y POST
if (count($_POST))
{
	while (list($key, $val) = each($_POST))
	{
		$$key = $val;
	}
}
if (count($_GET))
{
	while (list($key, $val) = each($_GET))
	{
		$$key = $val;
	}
}

// Variables constantes (directorios y otras)
//include("cons.php");

// Funciones
include("funciones.php");
?>