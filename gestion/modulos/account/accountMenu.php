<?php
require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
require_once $_GBASE. '/gestion/lib/site_ini.php'; 
?>
<link href="gestion/modulos/account/css/accountStyle.css" rel="stylesheet" type="text/css" />

<!--<script type="text/javascript" src="gestion/modulos/account/js/jquery-1.6.1.js"></script>-->

<div id="content">

	<div id="sidebar">
    	<ul>
        	<li><a id="accountA" class="first current" href="#" onclick="lacC();"><?php print $_IDIOMA->traducir("ACCOUNT");?></a></li>
            <li><a id="emailA" class="last" href="#" onclick="lemM();"><?php print $_IDIOMA->traducir("EMAIL NOTIFICATIONS");?></a></li>
           <!-- <li><a href="#">WALL</a></li>
            <li><a href="#">MULTIMEDIA GALLERY</a></li>
            <li><a href="#">PRIVATE MESSAGES</a></li>-->
            <li></li>
        </ul>
    </div>
    
</div>

<script type="text/javascript">


function lacC(){
	$("#emailA").removeClass('current');
	$("#accountA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/personaldata.php',function(){setHeigthAcount();});
	
}
function lemM(){
	$("#accountA").removeClass('current');
	$("#emailA").addClass('current');
	$("#accountContent").show();
	$("#accountContent").load('gestion/modulos/home/emailPrivacy.php',function(){setHeigthAcount();});
}
function setHeigthAcount(){
	var a = $('#holder').height();
	var b = a + 50;
	$('#accountContent').height(b);
	$('#accountContent #main').height(a-1);
}

//////starts opening the info////////
lacC();
////////////////////////////////////
</script>