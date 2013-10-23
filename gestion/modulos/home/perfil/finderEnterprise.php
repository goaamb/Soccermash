<?php

$chars=$_POST['chars'];
$field=$_POST['field'];





//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();


switch($field){
	case 'company':
		
		$campo='name';
		break;

}


$sql="SELECT * FROM ax_$field WHERE $campo LIKE '%$chars%'";

$sql1=$oDB->query($sql) or die(mysql_error());

echo '<div class="hideShow">';
 while($row = mysql_fetch_array($sql1)){

    switch($field){
		case 'company':
		echo '<div><a onclick="pasaV8(\''.$row['id'].'\',\''.$row['name'].'\');"  >'.$row['name'].'</a></div><br />';
		break;

	}

  
}
echo '</div>';
?>
