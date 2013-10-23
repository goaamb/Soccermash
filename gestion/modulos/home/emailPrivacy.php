<link href="gestion/modulos/account/css/accountStyle.css" rel="stylesheet" type="text/css" />
<!--script type="text/javascript" src="gestion/modulos/account/js/prettyCheckboxes.js"></script>-->
<?php

require_once('../../lib/site_ini.php');
require_once('../../lib/share/clases/class_site.inc.php');
if(isset($_SESSION["iSMuIdKey"])){
		global   $SITE;
		$SITE    	= new SITE();
		$aUsuario	= Array();		
		$iUserIdSM	= $_SESSION["iSMuIdKey"];
		$bPrivacy= $SITE->getEmailPrivacy($iUserIdSM);
		
}
?>       



<div id="closing" onclick="clsAcc();" title="Close"></div> 


<div id="content">

    
    <div id="main">
    	<h5><?php print $_IDIOMA->traducir("EMAIL NOTIFICATIONS");?></h5>
        <h4><?php print $_IDIOMA->traducir("I would like to receive Email notifications from");?>:</h4>
        <form id="formPrivacy" name="formPrivacy" action="" ><!--  Form Update --> 
        	<ul>
            	<li><div class="inpDivEm"><input <?php if($bPrivacy){  echo 'checked="checked"';}?> type="radio" id="whole" name="rad" value="1" class="inpEm"></div><label for="checkbox-3" tabindex="3"><span class="spInpp"><?php print $_IDIOMA->traducir("The whole network.");?></span></label></li>

				<li class="last"><div class="inpDivEm"><input <?php if(!$bPrivacy){  echo 'checked="checked"';	}?>type="radio" name="rad" value="2" id="any" class="inpEm" /></div><label for="checkbox-4" tabindex="4"><span class="spInpp"><?php print $_IDIOMA->traducir("I do not want to receive any Email notifications.");?></span></label>
                </li>			            
            </ul>
          
        <div class="submit"><input type="button" name="save" id="save" value="<?php print $_IDIOMA->traducir("save");?>" alt="<?php print $_IDIOMA->traducir("save");?>" onClick="JS_setEmailPrivacy(); return false;"/></div>

</form>  
    </div>

</div>
<div id="footer">
          <?php include('footer.php');?>
</div><!--END footer-->


<script type="text/javascript">
/*$('#checkboxDemo input[type=checkbox],#radioDemo input[type=radio]').prettyCheckboxes();
$('.inlineRadios input[type=radio]').prettyCheckboxes({'display':'inline'});*/

function clsAcc(){
	$('#accountContent').fadeOut();
	$('#accountViewer').fadeOut('slow', function() {
		$('#accountViewer').html('');
		$('#accountContent').html('');
		$('#accountViewer').show();
	
  });
	setTimeout("$('#footMenu').show()",3000);
	setTimeout("$('#footMenuDos').show()",3000);
	$('#wall').show();
	$('#acountLeft').hide();
}
</script>
