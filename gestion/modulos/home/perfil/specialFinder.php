<?php

$chars=$_POST['chars'];
$field=$_POST['field'];





//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();


switch($field){
	case 'agent':
		$campo='name';
		break;

}


$sql="SELECT * FROM ax_generalRegister WHERE $campo LIKE '%$chars%' AND profileId BETWEEN 13 AND 16";

$sql1=$oDB->query($sql) or die(mysql_error());

echo '<div class="hideShow" style="margin-left:-110px;margin-top:14px;">';
 while($row = mysql_fetch_array($sql1)){

    switch($field){
		case 'agent':
		echo '<div><a onclick="pasaV6(\''.$row['id'].'\',\''.$row['name'].'\',\''.$row['lastName'].'\');"  >'.$row['name'].' '.$row['lastName'].'</a></div><br />';
		break;

	}

  
}
echo '</div>';
?>
