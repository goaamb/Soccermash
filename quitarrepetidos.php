<?php
require_once 'gbase.php';

$ml=ModelLoader::crear("ax_traduccion");
$lista=$ml->listar();
foreach ($lista as $trad) {
	$cod=$trad->id;
	$conexion->consulta("delete from ax_traduccion where id<>'$cod' and hash='$trad->hash' and language='$trad->language'");
}
?>