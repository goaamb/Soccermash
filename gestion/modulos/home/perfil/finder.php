<?php

$chars=$_POST['chars'];
$field=$_POST['field'];





//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();


switch($field){
	case 'club':
		$campo='name';
		break;
	case 'federation':
		$campo='name';
		break;
	case 'asociation':
		$field='company';
		$campo='name';
		break;
	case 'company':
		$field2='company';
		$campo='name';
		break;
}

if($field2){
$sql="SELECT * FROM ax_$field2 WHERE $campo LIKE '%$chars%'";
}else{
$sql="SELECT * FROM ax_$field WHERE $campo LIKE '%$chars%'";
}
$sql1=$oDB->query($sql) or die(mysql_error());

echo '<div class="hideShow" style="margin-top:15px;margin-left:-140px;">';
 while($row = mysql_fetch_array($sql1)){
 if($field2){
	echo '<div><a onclick="pasaV5(\''.$row['name'].'\',\''.$row['idUser'].'\');"  >'.$row['name'].'</a></div><br />';
 }else{
    switch($field){
		case 'country':
		echo '<div><a onclick="pasaV(\''.$row['Code'].'\',\''.$row['country'].'\');"  >'.$row['country'].'</a></div><br />';
		break;
		
		case 'club':
		echo '<div><a onclick="pasaV2(\''.$row['id'].'\',\''.$row['name'].' - '.$row['federationName'].'\');"  >'.$row['name'].' - '.$row['federationName'].'</a></div><br />';
		break;
		
		case 'federation':
		echo '<div><a onclick="pasaV3(\''.$row['name'].' - '.$row['nickName'].'\',\''.$row['idUser'].'\');"  >'.$row['name'].' - '.$row['nickName'].'</a></div><br />';
		break;
		
		//asociation
		case 'company':
		echo '<div><a onclick="pasaV4(\''.$row['name'].'\',\''.$row['idUser'].'\');"  >'.$row['name'].'</a></div><br />';
		break;
	
		
	}
}
  
}
echo '</div>';
?>
