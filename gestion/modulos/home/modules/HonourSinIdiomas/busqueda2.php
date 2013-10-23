<?php

$chars=$_POST['chars'];


//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/share/clases/lib_util.inc.php"); 

$oDB=new mysql;
$oDB->connect();



$sql=GenerateSelect("*","ax_club","name LIKE '%$chars%'");

//$sql="SELECT * FROM ax_club WHERE name LIKE '%$chars%'";
$sql1=$oDB->query($sql) or die(mysql_error());
echo '<div id="hideShow" class="hideShow">';
 while($row = mysql_fetch_array($sql1)){
    echo '<div><a onclick="pasaV(\''.$row['id'].'\',\''.$row['name'].' - '.$row['federationName'].'\');"  >'.$row['name'].' - '.$row['federationName'].'</a></div>';	
}
echo '</div>';
?>