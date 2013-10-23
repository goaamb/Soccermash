<?
	require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/msgs/rss/rss/rsslib.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/profile/profileClass.php");
	///////////////////////////
	
	
	
	///////////////save the rss to my profile/////////
	$pro=new Profile();
	$aFields=array();
	$aFields['rss']=$_POST['countryRss'].','.$_POST['mediumRss'].','.$_POST['title']; //country - the xml - title,  in this order is saved
	$pro->upGeneral($aFields,'id='.$_SESSION['iSMuIdKey']);
	
	
	
	
	
	
	//////////Get the rss and set the info///////////
	$pages= RSS_Display($_POST['mediumRss'], 9);
	?>
<!--	<script type="text/javascript">
	window.top.window.$("#theRssContainer").html("<? //echo addslashes($pages); ?>");
	</script>-->
	
<script type="text/javascript">
	$("#loadingTRSS").hide();
	</script>
	
	
	
	<? echo $pages; ?>
	

	
	
	
	<script type="text/javascript">
	$("#loadingTRSS").hide();
	</script>
	
