<?php
require_once('../gestion/lib/site_ini.php');
require_once('../gestion/lib/share/clases/class_site.inc.php');

  
global  $SITE;
$SITE = new SITE();
$iIdUser=$_POST['idUser'];
$aUser['complete']=1;

if($SITE->modificarUsuario($iIdUser , $aUser))
{
	$_SESSION["iSMuIdKey"] = $iIdUser;  
?>
	<script type="text/javascript">
		document.location.href='home.php';
	</script>
<?
}
else 
{
    echo '* there was an error during the data saving, please try again';
}
?>