<link href="gestion/modulos/account/css/accountStyle.css" rel="stylesheet" type="text/css" />

<!--<script type="text/javascript" src="js/jquery-1.6.1.js"></script>-->

<?php

require_once('../../lib/site_ini.php');
require_once('../../lib/share/clases/class_site.inc.php');
if(isset($_SESSION["iSMuIdKey"])){
		global   $SITE;
		$SITE    	= new SITE();
		$aUsuario	= Array();		
		$iUserIdSM	= $_SESSION["iSMuIdKey"];	
		$aUsuario 	= $SITE->getUsuario(NULL, "id='$iUserIdSM'");
		$sName		= $aUsuario['name'];
		$sLastName	= $aUsuario['lastName'];
		$sEmail		= $aUsuario['email'];
}
?>
<div id="closing" onclick="clsAcc();" title="<?php print $_IDIOMA->traducir("Close");?>"></div> 

<div id="content">

    
    <div id="main">
    	<h5><?php print $_IDIOMA->traducir("ACCOUNT");?></h5>
        <h4><?php print $_IDIOMA->traducir("Account info");?></h4>



<form id="formUpdate" name="formUpdate" action="" ><!--  Form Update -->                 
  
  <div class="alerts" id="error-update"></div>
  
  
  <ul class="none">
            	<li><span><?php print $_IDIOMA->traducir("First Name");?>:</span><input type="text" name="fname" value="<?php echo $sName;?>" class="txt"></li>
                <li><span><?php print $_IDIOMA->traducir("Last Name");?>:</span><input type="text" value="<?php echo $sLastName;?>" name="lname" class="txt"></li>

               <p><a href="#" id="changeEmail" title="<?php print $_IDIOMA->traducir("Change your account reference email");?>"><?php print $_IDIOMA->traducir("Change email");?></a></p>
			     <div class="newemail">
						<li><span><?php print $_IDIOMA->traducir("Email");?>:</span><input  style="width:230px;" id="emailUser" value="<?php echo $sEmail;?>" type="text" name="emailNewUser" class="txt"></li>
						<li><span><?php print $_IDIOMA->traducir("New Email");?>:</span><input id="emailNewUser"  type="text" name="emailNewUser" class="txt"></li>
						<li><span><?php print $_IDIOMA->traducir("Repeat your Email");?>:</span><input  style="width:230px;" id="repeatEmail"  type="text" name="repeatEmail" class="txt"></li>
				  </div>
              
			  
			   <p><a href="#" id="changePass" title="<?php print $_IDIOMA->traducir("Change your account password");?>"><?php print $_IDIOMA->traducir("Change password");?></a></p>
			   <div class="newpass">
			    <li><span><?php print $_IDIOMA->traducir("Old Password");?>:</span><input type="password" name="newOldPass" id="newOldPass" class="txt"></li>
                <li><span><?php print $_IDIOMA->traducir("New Password");?>:</span><input type="password" name="newUserPass" id="newUserPass" class="txt"></li>
				<li><span><?php print $_IDIOMA->traducir("Repeat Password");?>:</span><input style="width:207px;" type="password" name="repeatPass" id="repeatPass" class="txt"></li>
	           </div>
  
    </ul>
        <div class="submit"><input type="button" name="update" id="update" value="<?php print $_IDIOMA->traducir("Save");?>" onClick="JS_updateData('<?php print $_IDIOMA->traducir("Saved");?>'); return false;"/></div>
   
</form>






    </div>

</div>
<div id="footer">
          <?php include('footer.php');?>
</div><!--END footer-->




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
	
});


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
