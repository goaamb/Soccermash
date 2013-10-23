<?php
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');



$iVt=addslashes(base64_decode($_POST['pVt']));
$title=addslashes($_POST['title']);

$pho=new Photo();

$aFields=array();
$aFields['name']=$title;

$pho->upPhoto($aFields,'id='.$iVt);

?>

<script type="text/javascript">
	//loadPhotos();
</script>