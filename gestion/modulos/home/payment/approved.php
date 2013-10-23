<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/gestion/lib/site_ini.php');
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/gestion/lib/share/clases/class_site.inc.php');
?>
<style type="text/css">
#alertEmergenteDatos .bottomAdvert {
	float: right;
	background-image: url(../img/botAdv.jpg);
	display: block;
	text-align: center;
	color: white;
	text-transform: uppercase;
	height: 20px;
	padding: 0px 20px 0;
	margin-left: 5px;
	font-size: 12px;
	font-family: Verdana;
	border: none;
}
</style>
<h1><?php print $_IDIOMA->traducir("Succesfull Payment")?></h1>
<p><?php print $_IDIOMA->traducir("The pay for the advertising was successfully done. please wait until 72 hours for be approved. Thanks for choose SOCCERMASH.com.")?></p>
<input class="bottomAdvert" type="button"
	onclick="cerrarPagoCompleto();"
	value="<?php print $_IDIOMA->traducir("Ok");?>" />
<script type="text/javascript">
function cerrarPagoCompleto(){
	cerrarAlertEmergente();
	lacC();
}
</script>