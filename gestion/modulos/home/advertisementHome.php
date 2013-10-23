<link href="css/advertisement.css" rel="stylesheet" type="text/css" /><?php
require_once ('../../lib/site_ini.php');
require_once ('../../lib/share/clases/class_site.inc.php');
?><div id="closing" onclick="clsAcc();"
	title="<?php
	print $_IDIOMA->traducir ( "Close" );
	?>"></div>
<div id="content">
<div id="main">
<h5><?php
print $_IDIOMA->traducir ( "What type of ad you want to create?" );
?></h5><br/>
<br/>
<h5><?php
print $_IDIOMA->traducir ( "TYPE 1 ADVERTISEMENTS" );
?></h5>
<a class="bottomAdvert" href="javascript:;"
	onclick="createAdvert01();"><?php
	print $_IDIOMA->traducir ( "Create advertisement" );
	?></a> 
<p><?php
print $_IDIOMA->traducir ( "Advertising, in shades and right column." );
?></p>
<hr />
<img src="img/advertisment02.jpg" style="float: left; margin: 5px 10px" />
<p style="margin-top: 130px;"><span><?php
print $_IDIOMA->traducir ( "in shades." );
?></span></p>
<p style="margin-top: 235px;"><span><?php
print $_IDIOMA->traducir ( "right column." );
?></span></p>
<div style="clear: both;width: 100%"></div>
<hr class="verde"/>
<br />
<br />
<br />
<h5><?php
print $_IDIOMA->traducir ( "TYPE 2 ADVERTISEMENTS" );
?></h5>
<a class="bottomAdvert" href="javascript:;"
	onclick="emergentAdvert01();"><?php
	print $_IDIOMA->traducir ( "Insert Code" );
	?></a><a class="bottomAdvert" href="javascript:;"
	onclick="emergentAdvert00();"><?php
	print $_IDIOMA->traducir ( "Contact us" );
	?></a> <br />
<br />
<br />
<p><?php
print $_IDIOMA->traducir ( "This kind of advertisement represent a system of sponsoring and is scheduled by contacting our agents." );
?><br />
<br /><?php
print $_IDIOMA->traducir ( "The kit consists of three images that appear in different locations. One in the Login page, another above of search engine and the last one int the right column at the bottom." );
?> <br />
<br /><?php
print $_IDIOMA->traducir ( "Your brand will be next to other brands, so you may need to filland contact form and to proceed with the approval." );
?> <br />
<br /><?php
print $_IDIOMA->traducir ( "This type of campaign focuses on a co-sponsorship and participationSOCCERMASH.com trademark accompanying exponential growth with newnetwork users." );
?></p>
<hr />
<img src="img/advertisment00.jpg" style="float: left; margin: 5px 10px" />
<p style="margin-top: 165px;"><span><?php
print $_IDIOMA->traducir ( "In Initial Page of Login." );
?></span></p>
<hr />
<img src="img/advertisment01.jpg" style="float: left; margin: 5px 10px" />
<p style="margin-top: 20px;"><span><?php
print $_IDIOMA->traducir ( "Appears in random way with another advertisers and news of network." );
?></span></p>
<p style="margin-top: 435px;"><span><?php
print $_IDIOMA->traducir ( "Under Type 1 advertising in the right column." );
?></span></p>
<div style="clear: both;width: 100%"></div>
<br />
<br />
<br />
<br />
<br />
<br /><br />
<br />
<br />
<br />
<br />
<br /><br />
<br />
<br />
<br />
<br />
<br />
</div>
</div>
<div id="footer"><?php
include ('footer.php');
?></div>
<!--END footer-->
<script type="text/javascript">
$(document).ready(function(){
	$("#update").button();
	$('#changeEmail, #changePass, #closing').tipsy({gravity: 'w'});
	$('#changeEmail').click(function(){
									 $(	'.newemail').toggle();
	});
	$('#changePass').click(function(){
								$('.newpass').toggle();
	});
	
});function clsAcc(){
	$('#accountContent').fadeOut();
	$('#accountViewer').fadeOut('slow', function() {
		$('#accountViewer').html('');
		$('#accountContent').html('');
		$('#accountViewer').show();
  });
	$('#footMenu').show();
	$('#footMenuDos').show();
	$('#wall').show();
	$('#acountLeft').hide();
}</script>