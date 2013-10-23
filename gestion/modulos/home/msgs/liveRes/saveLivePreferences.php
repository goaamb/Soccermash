<?
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/profile/profileClass.php");
	///////////////////////////

	///////////////save the rss to my profile/////////
	$pro=new Profile();
	$aFields=array();
	$aFields['liveRes']=$_POST['country'].','.$_POST['divToCheck'].','.$_POST['url'];
	$pro->upGeneral($aFields,'id='.$_SESSION['iSMuIdKey']);
	
?>