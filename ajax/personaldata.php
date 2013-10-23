<?php

require_once('../gestion/lib/site_ini.php');
require_once('../gestion/lib/share/clases/class_site.inc.php');


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
<div id="closing" title="Close"></div> 
<div id="updateMsj">
<h2 id="pdH2">Personal Data Changes</h2>
<form id="formUpdate" name="formUpdate" action="" ><!--  Form Update -->                 
  
  <div class="alerts" id="error-update"></div>
  
  <div>
    <label id="labName" class="label" for="firstName">First Name:</label>
    <label id="getName" class="" for="getName"><?php echo $sName;?></label>
  </div>
  
  
  <div>
    <label id="labSurname" class="label" for="lastName">Last Name:</label>
    <label id="getLastName" class="" for="getLastName"><?php echo $sLastName;?></label>
  </div>
  

  <div>
    <label id="labMail" class="label" for="emailUser">Email:</label>
    <label id="getEmail" class="" for="getEmail"><?php echo$sEmail;?></label>
  </div>
            
 	<p><a href="#" id="changeEmail" title="Change your account reference email">Change email</a></p>
  
  <div class="newemail">
    <label id="labMail" class="label" for="emailNewUser">New Email:</label>
    <input type="text" id="emailNewUser" value="" name="emailNewUser" tabindex="" />
  </div>
  
  <div class="newemail">
    <label id="reEmail" class="label" for="repeatEmail">Repeat your new email:</label>
    <input type="text" id="repeatEmail" value="" name="repeatEmail" tabindex="" />
  </div>
                     
  <p><a href="#" id="changePass" title="Change your account password">Change password</a></p>
  
  <div class="newpass">
    <label id="labPass" class="label" for="newOldPass">Old Password:</label>
    <input type="password" id="newOldPass"  value="" name="newOldPass" tabindex="" />
  </div>
    
  
  <div class="newpass">
    <label id="labPass" class="label" for="newUserPass">New Password:</label>
    <input type="password" id="newUserPass"  value="" name="newUserPass" tabindex="" />
  </div>
                       
  
  <div class="newpass">
    <label id="labPass" class="label" for="repeatPass">Repeat New Password:</label>
    <input type="password" id="repeatPass"  value="" name="repeatPass" tabindex="" />
  </div>
    
  <div class="updateBttn">
  	<input title="Update!" type="button" name="update" id="update" value="Update" alt="Update" tabindex="" onClick="JS_updateData(); return false;"/>
  </div>
   
</form>
</div>
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
	$('#closing').click(function(){
							 $('#results').fadeOut(); 														 
	});
});
</script>
