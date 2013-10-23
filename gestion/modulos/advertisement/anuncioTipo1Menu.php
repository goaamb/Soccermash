<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/gbase.php';
require_once $_GBASE . '/gestion/lib/site_ini.php';
?>
<link href="css/advertisement.css" rel="stylesheet" type="text/css" />

<!--<script type="text/javascript" src="gestion/modulos/account/js/jquery-1.6.1.js"></script>-->

<div id="content">

<div id="sidebar">
<ul>
	<li><a id="accountA" class="first current" href="#" onclick="lacC();"><?php
	print $_IDIOMA->traducir ( "Create Advertisement" );
	?></a></li>
	<li><a id="emailA" class="last" href="#" onclick="lemM();"><?php
	print $_IDIOMA->traducir ( "Advertisements" );
	?></a></li>
	<li><a id="regA" class="last" href="#" onclick="remM();"><?php
	print $_IDIOMA->traducir ( "Regulations" );
	?></a></li>
</ul>
</div>

</div>

<script type="text/javascript">


function lacC(){
	$("#emailA").removeClass('current');
	$("#regA").removeClass('current');
	$("#accountA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/anuncioTipo1Home.php');
}
function lemM(){
	$("#accountA").removeClass('current');
	$("#regA").removeClass('current');
	$("#emailA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/statAnuncioTipo1.php');
}
function remM(){
	$("#accountA").removeClass('current');
	$("#emailA").removeClass('current');
	$("#regA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/regulationsAnuncioTipo1.php');
}

//////starts opening the info////////
lacC();
////////////////////////////////////
</script>