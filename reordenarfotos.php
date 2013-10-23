<?php
require_once 'gbase.php';

$ml=ModelLoader::crear("ax_generalRegister");
$lista=$ml->listar("photo<>'photoDefault.jpg'");
var_dump(count($lista));
$dir="photoGeneral/small/small_";
$l=array();
foreach ($lista as $usuario) {
	print $dir.$usuario->photo."<br/>";
	if(!is_file($dir.$usuario->photo)){
		$usuario->photo="photoDefault.jpg";
		$usuario->modificar("id");
		$l[]=$usuario->id;
	}
}
var_dump($l);
print "concluyo";
?>