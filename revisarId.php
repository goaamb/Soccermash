<?php
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/share/clases/lib_util.inc.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

global $SITE_oDB;


$sSQL_Select=generateSelect("*","ax_generalRegister","profileId = 18");

$DB_Result = mysql_query($sSQL_Select);
while($res=mysql_fetch_array($DB_Result)){
	$arrId[]=$res['id'];
	//echo "Id: ".$res['id']." Nombre ".$res['name']." Apellido ".$res['lastName']." profileId ".$res['profileId']."<br />";
}

//var_dump($arrId);
$bien='';
$mal='';

$total=count($arrId);

foreach ($arrId as $id){

$sSQL_Select=generateSelect("*","ax_manager","idUser = $id");
$DB_Result = mysql_query($sSQL_Select);
$ocurrencias=mysql_num_rows($DB_Result);
if($ocurrencias >= 1){
		echo "<p style='color:blue;'>este usuario con id: $id esta en la tabla correspondiende: ax_manager </p>";
		$bien++;
}else{
	$sSQL_Select=generateSelect("*","ax_player","idUser = $id");
	$DB_Result = mysql_query($sSQL_Select);
	$ocurrencias=mysql_num_rows($DB_Result);
	if($ocurrencias >= 1){
		echo "<p style='color:red;'>este usuario con id: $id esta en la tabla equivocada: ax_player</p>";
		$mal++;
	
	}
}
}

echo "<p style='color:blue;'>Total de usuarios correctos: $bien </p>";
echo "<p style='color:red;'>Total de usuarios incorrectos: $mal </p>";

$total2=$total-$bien;
$total2=$total2-$mal;
echo "<p style='color:green;'>Total de usuarios fuera de esas dos tablas: $total2</p>";

?>