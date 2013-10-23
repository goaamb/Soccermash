<?php

		echo $name='';
		echo $lastName='';
		echo $sex='';
		echo $dayOfBirthDay='';
		echo $email='';
		echo $passwordUser='';
		echo $registerDate='';
		echo $ipAddress='';
		echo $photo='';
		echo $active='';
		echo $countryId='';
		echo $countryName='';
		echo $cityId='';
		echo $cityName='';
		echo $languageId='';
		echo $profileId='';
		echo "<br />";
		echo $complete='';
		echo $destacado='';
		echo $emailPrivacy='';
		echo $tiempoUtlimaActividad='';
		echo $joomla='';
		echo $tableProfileNick='';
		echo $tableProfileNlub='';
		echo $tableProfileOtherClub='';
		echo $tableProfileClubName='';
		echo $tableProfileOcupation='';
		echo $tableProfileVerified='';
		echo $tableProfileHidden='';
		echo $tableProfileLastVisitors='';
		echo $tableProfileRegisterDate='';
		echo $tableProfileCheck='';
		echo $tableProfileActive='';
		echo $TableObservationObservation='';
		echo $TableObservationHidden='';
		echo $TableObservationDate='';
		echo $TablePubComChecksId_user_profile='';
		echo $TablePubComChecksId_comment='';
		echo $TablePubComChecksId_publication='';
		echo $TablePubComChecksId_user_who_check='';
		echo $TablePubComChecksTime='';
		echo $tableProfileReceivedCommentsIdUserWhoMakeComment='';
		echo $tableProfileReceivedCommentsIdComment='';
		echo $tableProfileReceivedCommentsComment='';
		echo $tableProfileReceivedCommentsTime='';
		echo $tableProfileWallUser_id_who='';
		echo $tableProfileWallPublication='';
		echo $tableProfileWallTime='';
		echo $tableProfileWallAlertId_publication='';
		echo $tableProfileWallAlertId_userWhoMakeComment='';
		echo $tableProfileWallAlertActivity='';
		echo $tableProfileWallAlertViewed='';
		echo $tableProfileWallAlertTime='';


require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");
$oDB=new mysql;
$oDB->connect();
$oDB2=new mysql;
$oDB2->connect();
$id=276;//ID GENERALREGISTER
$idNewProfile=27;//ID NEW PROFILE
//Rescato todos los datos el usuario que desea cambiar el perfil
$sSQL_SelectGeneralRegister=GenerateSelect('*','ax_generalRegister',"id=$id");
if($DB_ResultGeneralRegister = $oDB->query($sSQL_SelectGeneralRegister) or die(mysql_error())){
		while($generalRegister=mysql_fetch_array($DB_ResultGeneralRegister)){
			$name=$generalRegister['name'];
			$lastName=$generalRegister['lastName'];
			$sex=$generalRegister['sex'];
			$dayOfBirthDay=$generalRegister['dayOfBirthDay'];
			$email=$generalRegister['email'];
			$passwordUser=$generalRegister['passwordUser'];
			$registerDate=$generalRegister['registerDate'];
			$ipAddress=$generalRegister['ipAddress'];
			$photo=$generalRegister['photo'];
			$active=$generalRegister['active'];
			$countryId=$generalRegister['countryId'];
			$countryName=$generalRegister['countryName'];
			$cityId=$generalRegister['cityId'];
			$cityName=$generalRegister['cityName'];
			$languageId=$generalRegister['languageId'];
			$profileId=$generalRegister['profileId'];
			$hidden=$generalRegister['hidden'];
			$complete=$generalRegister['complete'];
			$destacado=$generalRegister['destacado'];
			$emailPrivacy=$generalRegister['emailPrivacy'];
			$tiempoUtlimaActividad=$generalRegister['tiempoUtlimaActividad'];
			$joomla=$generalRegister['joomla'];
		}		
}


$sSQL_SelectFromTableProfile=GenerateSelect('*',$oldTableProfile,"id=$id");
if($DB_ResultTableProfile = $oDB->query($sSQL_SelectFromTableProfile) or die(mysql_error())){
	while($tableProfile=mysql_fetch_array($DB_ResultTableProfile)){
		$tableProfileNick=$tableProfile['nick'];
		$tableProfileNlub=$tableProfile['club'];
		$tableProfileOtherClub=$tableProfile['otherClub'];
		$tableProfileClubName=$tableProfile['clubName'];
		$tableProfileOcupation=$tableProfile['ocupation'];
		$tableProfileVerified=$tableProfile['verified'];
		$tableProfileHidden=$tableProfile['hidden'];
		$tableProfileLastVisitors=$tableProfile['lastVisitors'];
		$tableProfileRegisterDate=$tableProfile['registerDate'];
		$tableProfileCheck=$tableProfile['check'];
		$tableProfileActive=$tableProfile['active'];
		
	
	}
}


$oldTableProfile=selectTable($profileId);
$newTableProfile=selectTable($idNewProfile);


if($DB_ResultGeneralRegister = $oDB->query("INSERT INTO $newTableProfile (nick,club,otherClub,clubName,ocupation,verified,hidden,lastVisitors,registerDate,check,active) VALUES ($tableProfileNick,$tableProfileNlub,$tableProfileOtherClub,$tableProfileClubName,$tableProfileOcupation,$tableProfileVerified,$tableProfileVerified,$tableProfileHidden,$tableProfileLastVisitors,$tableProfileRegisterDate,$tableProfileCheck,$tableProfileActive)") or die(mysql_error())){
		echo "bien",
	}else{
		echo "mal",
	}
}




$sSQL_SelectFromTableProfileObservation=GenerateSelect('*',$oldTableProfile.'Observation',"idPlayer=$id");
if($DB_ResultTableProfileObservation = $oDB->query($sSQL_SelectFromTableProfileObservation) or die(mysql_error())){
	while($tableProfileObservation=mysql_fetch_array($DB_ResultTableProfileObservation)){
		$TableObservationObservation=$tableProfileObservation['observation'];
		$TableObservationHidden=$tableProfileObservation['hidden'];
		$TableObservationDate=$tableProfileObservation['date'];
	}
}

$sSQL_SelectFromTableProfilePubComChecks=GenerateSelect('*',$oldTableProfile.'PubComChecks',"id_user=$id");
if($DB_ResultTableProfilePubComChecks = $oDB->query($sSQL_SelectFromTableProfilePubComChecks) or die(mysql_error())){
	while($tableProfilePubComChecks=mysql_fetch_array($DB_ResultTableProfilePubComChecks)){
		$TablePubComChecksId_user_profile=$tableProfilePubComChecks['id_user_profile'];
		$TablePubComChecksId_comment=$tableProfilePubComChecks['id_coment'];
		$TablePubComChecksId_publication=$tableProfilePubComChecks['id_publication'];
		$TablePubComChecksId_user_who_check=$tableProfilePubComChecks['id_user_who_check'];
		$TablePubComChecksTime=$tableProfilePubComChecks['time'];

	}
}

$sSQL_SelectFromTableProfileReceivedComments=GenerateSelect('*',$oldTableProfile.'ReceivedComments',"idUserWhoReceiveAComment=$id");
if($DB_ResultTableProfileReceivedComments = $oDB->query($sSQL_SelectFromTableProfileReceivedComments) or die(mysql_error())){
	while($tableProfileReceivedComments=mysql_fetch_array($DB_ResultTableProfileReceivedComments)){
		$tableProfileReceivedCommentsIdUserWhoMakeComment=$tableProfileReceivedComments['idUserWhoMakeComment'];
		$tableProfileReceivedCommentsIdComment=$tableProfileReceivedComments['idComment'];
		$tableProfileReceivedCommentsComment=$tableProfileReceivedComments['comment'];
		$tableProfileReceivedCommentsTime=$tableProfileReceivedComments['time'];
	}
}

$sSQL_SelectFromTableProfileWall=GenerateSelect('*',$oldTableProfile.'Wall',"user_id=$id");
if($DB_ResultTableProfileWall = $oDB->query($sSQL_SelectFromTableProfileWall) or die(mysql_error())){
	while($tableProfileWall=mysql_fetch_array($DB_ResultTableProfileWall)){
		$tableProfileWallUser_id_who=$tableProfileWall['user_id_who'];
		$tableProfileWallPublication=$tableProfileWall['publication'];
		$tableProfileWallTime=$tableProfileWall['time'];
	}
}

$sSQL_SelectFromTableProfileWallAlert=GenerateSelect('*',$oldTableProfile.'WallAlert',"id_user=$id");
if($DB_ResultTableProfileWallAlert = $oDB->query($sSQL_SelectFromTableProfileWallAlert) or die(mysql_error())){
	while($tableProfileWallAlert=mysql_fetch_array($DB_ResultTableProfileWallAlert)){
		$tableProfileWallAlertId_publication=$tableProfileWallAlert['id_publication'];
		$tableProfileWallAlertId_userWhoMakeComment=$tableProfileWallAlert['id_userWhoMakeComment'];
		$tableProfileWallAlertActivity=$tableProfileWallAlert['activity'];
		$tableProfileWallAlertViewed=$tableProfileWallAlert['viewed'];
		$tableProfileWallAlertTime=$tableProfileWallAlert['time'];
	}
}




		echo $name."<br />";
		echo $lastName."<br />";
		echo $sex."<br />";
		echo $dayOfBirthDay."<br />";
		echo $email."<br />";
		echo $passwordUser."<br />";
		echo $registerDate."<br />";
		echo $ipAddress."<br />";
		echo $photo."<br />";
		echo $active."<br />";
		echo $countryId."<br />";
		echo $countryName."<br />";
		echo $cityId."<br />";
		echo $cityName."<br />";
		echo $languageId."<br />";
		echo $profileId."<br />";
		var_dump($hidden);
		echo "<br />";
		echo $complete."<br />";
		echo $destacado."<br />";
		echo $emailPrivacy."<br />";
		echo $tiempoUtlimaActividad."<br />";
		echo $joomla."<br />";
		echo $tableProfileNick."<br />";
		echo $tableProfileNlub."<br />";
		echo $tableProfileOtherClub."<br />";
		echo $tableProfileClubName."<br />";
		echo $tableProfileOcupation."<br />";
		echo $tableProfileVerified."<br />";
		echo $tableProfileHidden."<br />";
		echo $tableProfileLastVisitors."<br />";
		echo $tableProfileRegisterDate."<br />";
		echo $tableProfileCheck."<br />";
		echo $tableProfileActive."<br />";
		echo $TableObservationObservation."<br />";
		echo $TableObservationHidden."<br />";
		echo $TableObservationDate."<br />";
		echo $TablePubComChecksId_user_profile."<br />";
		echo $TablePubComChecksId_comment."<br />";
		echo $TablePubComChecksId_publication."<br />";
		echo $TablePubComChecksId_user_who_check."<br />";
		echo $TablePubComChecksTime."<br />";
		echo $tableProfileReceivedCommentsIdUserWhoMakeComment."<br />";
		echo $tableProfileReceivedCommentsIdComment."<br />";
		echo $tableProfileReceivedCommentsComment."<br />";
		echo $tableProfileReceivedCommentsTime."<br />";
		echo $tableProfileWallUser_id_who."<br />";
		echo $tableProfileWallPublication."<br />";
		echo $tableProfileWallTime."<br />";
		echo $tableProfileWallAlertId_publication."<br />";
		echo $tableProfileWallAlertId_userWhoMakeComment."<br />";
		echo $tableProfileWallAlertActivity."<br />";
		echo $tableProfileWallAlertViewed."<br />";
		echo $tableProfileWallAlertTime."<br />";
		
		
		
		
		










//



?>