<?php

require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/share/clases/lib_util.inc.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/share/clases/class_peopleNet.php");

$oDB=new mysql;
$oDB->connect();

if(!isset($_SESSION['idUserVisiting']) OR ($_SESSION['idUserVisiting']==0)){
	$id=$_SESSION['iSMuIdKey'];
}else{
	$id=$_SESSION['idUserVisiting'];
}

if(!isset($_SESSION['idProfileVisiting'])){
	$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}else{
	$profileVisiting=$_SESSION['idProfileVisiting'];
}


$oUser=generateSelect("name,lastName","ax_generalRegister","id=$id");
$oUsers=$oDB->query($oUser);
while($oUserData=mysql_fetch_array($oUsers)){
$userName=$oUserData['name'];
$userLastName=$oUserData['lastName'];
}
$sSQL_Select=generateSelect('history_follower','ax_follower',"id_user=$id");
$selectAllMyFollowers=$oDB->query($sSQL_Select);

while($res=mysql_fetch_array($selectAllMyFollowers)){
	$arreglo=$res['history_follower']."<br >";
};

$selectAllMyFollowers=array();
$selectAllMyFollowers=unserialize($arreglo);

var_dump($selectAllMyFollowers);

$iCantTotal=sizeof($selectAllMyFollowers['id']);
$sSqlId =  implode("','", $selectAllMyFollowers['id']);
$sSqlId =  explode("','", $sSqlId);

foreach ($sSqlId as $idFollower){
	echo $idFollower."<br >";
};

$tableProfile=selectTable($profileVisiting);


//Wall activites
$wallActivities=generateSelect("*",$tableProfile."Wall","user_id_who=$id ORDER BY time ASC");
$wallAct=$oDB->query($wallActivities);

while($ResWallAct=mysql_fetch_array($wallAct)){

		$arrWallPublications[]=$ResWallAct['publication'];
		$arrWallTime[]=$ResWallAct['time'];
		$arrWallReceivedId[]=$ResWallAct['user_id'];//el que recibe
	
}
$total=sizeof($arrWallReceivedId);
$total--;
$a=$total;

//

//

while($a >= 0){
	$sSQL_SelectThisUser=GenerateSelect('name,lastName','ax_generalRegister',"id=$arrWallReceivedId[$a]");
	$queryOfReceived=$oDB->query($sSQL_SelectThisUser);
	while($nameAndLastFromReceived=mysql_fetch_array($queryOfReceived)){
		$nameReceveidUser=$nameAndLastFromReceived['name'];
		$lastNameReceveidUser=$nameAndLastFromReceived['lastName'];
	}
	echo "<br /><br /><br /><br /><hr><a onClick='JS_follower($id)'>$userName $userLastName</a> public this <bold>".$arrWallPublications[$a]."</bold> on the wall of <a onClick='JS_follower(".$arrWallReceivedId[$a].")'> $nameReceveidUser $lastNameReceveidUser </a> ".ago($arrWallTime[$a]);
	$a--;
}



//


						  "¿Quién me ha robado el mes de abril?",
						  "El Blues de la Soledad",
						  "El breve espacio",
					),

					array(
						  "Naturaleza muerta",
						  "Cuando el mar te tenga",
						  "Lucía"
					)
);

echo $canciones[0][1], "El Blues de la Soledad"

/*
$random=rand (1,$iCantTotal-1);
echo "random: ",$random;
echo "<br />".$sSqlId[$random]."<br />";

$tableProfile=selectTable($profileVisiting);//Genero la tabla con el tipo de perfil para agregarle despues un identificador

$wallActivities=generateSelect("*",$tableProfile."Wall","user_id_who=".$sSqlId[$random]." ORDER BY time ASC");
$wallAct=$oDB->query($wallActivities);
while($ResWallAct=mysql_fetch_array($wallAct)){
	$arrWallPublications[]=$ResWallAct['publication'];
	$arrWallTime[]=$ResWallAct['time'];
	$arrWallReceivedId[]=$ResWallAct['user_id'];
}

foreach($arrWallTime as $time){
	echo ago($time)."<br />";
}

//$cantOfPublications=sizeof($arrWallPublications);
//$cantOfTime=sizeof($arrWallTime);
//$cantOfReceivedId=sizeof($arrWallReceivedId);
//echo $cantOfPublications."<br />";
//echo $cantOfTime."<br />";
//echo $cantOfReceivedId."<br />";

*/
?>