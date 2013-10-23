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

//var_dump($selectAllMyFollowers);

$iCantTotal=sizeof($selectAllMyFollowers['id']);
$sSqlId =  implode("','", $selectAllMyFollowers['id']);
$sSqlId =  explode("','", $sSqlId);

//foreach ($sSqlId as $idFollower){
//	echo $idFollower."<br >";
//};

$tableProfile=selectTable($profileVisiting);#Selecciono la tabla general ax_[perfil]


//Wall Activites
$wallActivities=generateSelect("publication,time,user_id",$tableProfile."Wall","user_id_who=$id ORDER BY time ASC");
$wallAct=$oDB->query($wallActivities);
while($ResWallAct=mysql_fetch_array($wallAct)){

		$activitiesPublications[]="public this ".$ResWallAct['publication'];
		$activitiesTime[]=$ResWallAct['time'];
		$activitiesReceivedId[]=$ResWallAct['user_id'];//el que recibe
	
}

//Wall Comments Activites
$wallCommentActivities=generateSelect("idUserWhoReceiveAComment,comment,time",$tableProfile."ReceivedComments","idUserWhoMakeComment=$id ORDER BY time ASC");
$wallCommentAct=$oDB->query($wallCommentActivities);
while($ResWallCommentAct=mysql_fetch_array($wallCommentAct)){

		$activitiesPublications[]="Comment this ".$ResWallCommentAct['comment']." on the wall of ";
		$activitiesTime[]=$ResWallCommentAct['time'];
		$activitiesReceivedId[]=$ResWallCommentAct['idUserWhoReceiveAComment'];//el que recibe
	
}

//Publications Comments Checks Activites
/*
$pubComChecksActivities=generateSelect("id_coment,id_publication,time",$tableProfile."PubComChecks","id_user=$id ORDER BY time ASC");
$pubComChecksAct=$oDB->query($pubComChecksActivities);
while($ResPubComChecksAct=mysql_fetch_array($pubComChecksAct)){

		$activitiesPublications[]="Check this ".$ResPubComChecksAct['id_coment']." on the wall of ";
		$activitiesTime[]=$ResPubComChecksAct['time'];
		$activitiesReceivedId[]=$ResPubComChecksAct['id_publication'];//el que recibe
	
}*/

//Photo Upload Activities
$photoUpload=generateSelect("idUserUploading,name,registerDate","ax_photoUpload","idUserUploading=$id ORDER BY registerDate ASC");
$photoUploadActivities=$oDB->query($photoUpload);

while($ResPhotoUploadAct=mysql_fetch_array($photoUploadActivities)){

		$activitiesPublications[]="upload this photo named ".$ResPhotoUploadAct['name'];
		$activitiesTime[]=$ResPhotoUploadAct['registerDate'];
		$activitiesReceivedId[]=$ResPhotoUploadAct['idUserUploading'];//el que recibe
	
}


//Photo Comment Activities
$photoComment=generateSelect("idUserCommenting,comment,registerDate","ax_photoComment","idUserCommenting=$id ORDER BY registerDate ASC");
$photoCommentActivities=$oDB->query($photoComment);

while($ResPhotoCommentAct=mysql_fetch_array($photoCommentActivities)){

		$activitiesPublications[]="Comment this ".$ResPhotoCommentAct['comment']." on a photo of ";
		$activitiesTime[]=$ResPhotoCommentAct['registerDate'];
		$activitiesReceivedId[]=$ResPhotoCommentAct['idUserCommenting'];//el que recibe
	
}


//Video Upload Activities
$videoUpload=generateSelect("idUserUploading,name,registerDate","ax_videoUpload","idUserUploading=$id ORDER BY registerDate ASC");
$videoUploadActivities=$oDB->query($videoUpload);

while($ResVideoUploadAct=mysql_fetch_array($videoUploadActivities)){

		$activitiesPublications[]="upload this video named ".$ResVideoUploadAct['name'];
		$activitiesTime[]=$ResVideoUploadAct['registerDate'];
		$activitiesReceivedId[]=$ResVideoUploadAct['idUserUploading'];//el que recibe
	
}

//Video Vote Activities SEBA,AGREGAR TIME() AL FINAL
/*
$videoUpload=generateSelect("idUser,idVideo,registerDate","ax_videoVote","idUser=$id ORDER BY registerDate ASC");
$videoUploadActivities=$oDB->query($videoUpload);

while($ResVideoUploadAct=mysql_fetch_array($videoUploadActivities)){

		$activitiesPublications[]="upload this video named ".$ResVideoUploadAct['name'];
		$activitiesTime[]=$ResVideoUploadAct['registerDate'];
		$activitiesReceivedId[]=$ResVideoUploadAct['idUserUploading'];//el que recibe
	
}
*/
//Video Comment Activities
$videoComment=generateSelect("comment,idUserCommenting,registerDate","ax_videoComment","idUserCommenting=$id ORDER BY registerDate ASC");
$videoCommentActivities=$oDB->query($videoComment);

while($ResVideoCommentAct=mysql_fetch_array($videoCommentActivities)){

		$activitiesPublications[]="Comment this ".$ResVideoCommentAct['comment'];
		$activitiesTime[]=$ResVideoCommentAct['registerDate'];
		$activitiesReceivedId[]=$ResVideoCommentAct['idUserCommenting'];//el que recibe
	
}

//Show All Activities
$total=sizeof($activitiesReceivedId);
echo "total: $total<br />";
$total--;
echo "total: $total<br />";
$a=$total;
echo "total: $a<br />";
//

//



while($a >= 0){
	$sSQL_SelectThisUser=GenerateSelect('name,lastName','ax_generalRegister',"id=$activitiesReceivedId[$a]");
	$queryOfReceived=$oDB->query($sSQL_SelectThisUser);
	while($nameAndLastFromReceived=mysql_fetch_array($queryOfReceived)){
		$nameReceveidUser=$nameAndLastFromReceived['name'];
		$lastNameReceveidUser=$nameAndLastFromReceived['lastName'];
	}
	echo "<br /><br /><br /><br /><hr><a onClick='JS_follower($id)'>$userName $userLastName</a> <bold>".$activitiesPublications[$a]."</bold> <a onClick='JS_follower(".$activitiesReceivedId[$a].")'> $nameReceveidUser $lastNameReceveidUser </a> ".ago($activitiesTime[$a]);
	$a--;
}


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