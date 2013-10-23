<?php

$chars=$_POST['chars'];
$field=$_POST['field'];





//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/soccermashTest2/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();


$campo=(($field=='country') ? 'country' : 'name' );
if($campo!='country'){
	$sql="SELECT ax_club.*,ax_country.* FROM ax_club,ax_country WHERE ax_club.name LIKE '%$chars%' AND ax_country.country LIKE '%$chars%'";
}else{
	$sql="SELECT * FROM ax_$field WHERE $campo LIKE '%$chars%'";
}
$sql1=$oDB->query($sql) or die(mysql_error());

echo '<div id="hideShow" style="position:absolute;heigth:200px;border:1px solid black;background-color:green;color:white;">';
 while($row = mysql_fetch_array($sql1)){
    if($field=='country'){
	echo '<div><a onclick="pasaV(\''.$row['Code'].'\',\''.$row['country'].'\');"  >'.$row['country'].'</a></div>';
}else{
	echo '<div><a onclick="pasaV(\''.$row['id'].'\',\''.$row['name'].' - '.$row['federationName'].'\');"  >'.$row['name'].' - '.$row['federationName'].'</a></div>';	
	}
}
echo '</div>';
?>