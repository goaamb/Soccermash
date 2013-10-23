<?php
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoClass.php');



$iVt=addslashes(base64_decode($_POST['iVt']));
$title=addslashes($_POST['title']);

$vid=new Video();

$aFields=array();
$aFields['name']=$title;

$vid->upVideo($aFields,'id='.$iVt);

?>

<script type="text/javascript">
	loadVideos();
</script>