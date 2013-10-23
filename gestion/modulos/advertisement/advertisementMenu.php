<?php
require_once $_SERVER ["DOCUMENT_ROOT"] . '/gbase.php';
require_once $_GBASE . '/gestion/lib/site_ini.php';
?>
<link href="css/advertisement.css" rel="stylesheet" type="text/css" />

<!--<script type="text/javascript" src="gestion/modulos/account/js/jquery-1.6.1.js"></script>-->

<div id="content">

<div id="sidebar">
<ul>
	<li><a id="accountA" class="first current" href="#"
		onclick="lacC();return false;"><?php
		print $_IDIOMA->traducir ( "Create Advertisement" );
		?></a></li>
	<li><span class="title"><?php
	print $_IDIOMA->traducir ( "Advertisements" );
	?></span>
	<ul style="margin-top: 0px;">
		<li><a id="typeA" class="first current" href="#"
			onclick="ltyP();return false;"><?php
			print $_IDIOMA->traducir ( "Type 1" );
			?></a></li>
		<li><a id="emailA" class="first current" href="#"
			onclick="lemM();return false;"><?php
			print $_IDIOMA->traducir ( "Type 2" );
			?></a></li>
	</ul>
	</li>
	<li><a id="regA" class="last" href="#" onclick="lreG();return false;"><?php
	print $_IDIOMA->traducir ( "Regulations" );
	?></a></li>

</ul>
</div>

</div>

<script type="text/javascript">


function lacC(){
	$("#emailA").removeClass('current');
	$("#typeA").removeClass('current');
	$("#regA").removeClass('current');
	$("#accountA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/advertisementHome.php');
}
function lemM(){
	$("#accountA").removeClass('current');
	$("#typeA").removeClass('current');
	$("#regA").removeClass('current');
	$("#emailA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/statAdvertisement.php');
}
function ltyP(){
	$("#accountA").removeClass('current');
	$("#emailA").removeClass('current');
	$("#regA").removeClass('current');
	$("#typeA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/statAdvertisement1.php');
}
function lreG(){
	$("#accountA").removeClass('current');
	$("#emailA").removeClass('current');
	$("#typeA").removeClass('current');
	$("#regA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/regulationAdvertisement.php');
}

//////starts opening the info////////
lacC();
////////////////////////////////////
</script>