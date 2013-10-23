<?php

	if (isset ( $_SESSION ["iSMuIdKey"] ) && trim($_SESSION ["iSMuIdKey"])!=="") {
		header("location:home.php");	
	}
    #echo phpinfo();	
	require_once('gestion/lib/site_ini.php');
	if(isset($_COOKIE["SOCSESSIONID"])){
		$email=Utilidades::descifrar(base64_decode($_COOKIE["SOCSESSIONID"]));
		$mlagr=ModelLoader::crear("ax_generalRegister");
		if($mlagr->buscarPorCampo(array("email"=>$email))) {
			$_SESSION ["iSMuIdKey"]=$mlagr->id;
			header("location:home.php");
		}
	}	
	require_once('gestion/lib/share/clases/class_site.inc.php');
	include('includes/meta.php'); 

	global  $SITE;
	$SITE = new SITE();
	$aUsuarios=Array();
	$iEstado	='active=1';
	$iComplete	='complete=1';
	$iDestacado	='destacado=1';
	$iNoDestacado	='destacado!=1';
	#$sWhere="id!=0". " AND ". $iEstado. " AND ".$iComplete;
	$aUsuariosDes 	= $SITE->getUsuarios(NULL, $iEstado. " AND ".$iComplete. " AND ".$iDestacado,'registerDate DESC');
 	$iCant=sizeof($aUsuariosDes );
 	$iDiferencia=100-$iCant;
 	$aUsuariosNoDes=array();
 	if($iCant<100){
 		$aUsuariosNoDes = $SITE->getUsuarios(NULL, $iEstado. " AND ".$iComplete. " AND ".$iNoDestacado." AND photo<>'photoDefault.jpg'",'registerDate DESC Limit 0,'.$iDiferencia);
 	}
	$aUsuarios=array_merge($aUsuariosDes,$aUsuariosNoDes);
	$iCant=sizeof($aUsuarios);

	$oXajaxRegister = new xajax('ajax/common_registrar_loguin.php');
	$oXajaxRegister->registerFunction("enviarRegistrar");
	$oXajaxRegister->registerFunction("validaRegistrar");
	$oXajaxRegister->registerFunction("mostrarRegistrar");
	
	$oXajaxRegister->registerFunction("validaLoguin");
	$oXajaxRegister->registerFunction("enviarLoguin");
	$oXajaxRegister->registerFunction("mostrarLoguin");
	
	$oXajaxRegister->registerFunction("enviarForgot");
	
	$oXajaxRegister->printJavascript("gestion/share/js");
	
	///////////////Profile List//////////////////////////////////
	require_once('gestion/lib/share/clases/profileListStyled.php');
	
	
?>
<body>
<style>
.slogan{
	display:none;
}
</style>
<div class="slogan"><p>LA PRIMERA RED SOCIAL PARA FUTBOLISTAS PROFESIONALES</p></div>
<script type="text/javascript" src="/goaamb/js/G.js"></script>
<script type="text/javascript">
G.cookie.set("lang","<?php print $_SESSION["lg"]?>",7,"/");
</script>
<script type="text/javascript">
///////////////////////login/////////////////
////SHOW CAPTCHA IF ALL FIELDS ARE COMPLETES////
$(document).keyup(function() {
					$("#textShowed").text();
					var a = $("#firstName"), b = $("#lastName"), c = $("#emailNewUser"), e = $("#repeatEmail"), f = $("#newUserPass");
					$("#sample-check");
					return a.val().length < 2 ? !1 : b.val().length < 2 ? !1 : c.val().length < 5 ? !1 : c.val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i) ? c.val() != e.val() ? !1 : f.val() <= 4 ? !1 : ($("#captcha").show(), $('#captcha').mousemove(function() {
					$("#recaptcha_response_field").focus();
					}), !0) : !1;
});


//New validation new user
$('#signUpBttn').click(function(){		
								$('#labTerms').tipsy({trigger: 'manual', gravity:'n', fallback:'Do you accept Terms of Use?'});
								$('#textShowed').tipsy({ trigger: 'manual', gravity:'e', fallback:'Unselected profile. Choose your.'});
								var a = $("#textShowed").text(), b = $("#firstName"), c = $("#lastName"), e = $("#emailNewUser"), f = $("#repeatEmail"), g = $("#newUserPass"),
								h = $("#sample-check");
								if (a == '') {
								//alert(e1);
								$('#selectMenu').css('background-color','#fdefd0');
								$('#textShowed').tipsy('show');
								}
								else if (b.val().length < 2){
								//alert('nombre nulo');
								b.css('background-color','#fdefd0');
								$("#error").text(e2);
								}
								else if (c.val().length < 2){
								//alert('apellido nulo');
								c.css('background-color','#fdefd0');
								$("#error").text(e3);
								}
								else if (e.val() < 6){
								//alert('email nulo');
								e.css('background-color','#fdefd0');
								$("#error").text(e4);
								}
								else if (!(e.val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i))){
								//alert('email forma error');
								e.css('background-color','#fdefd0');
								$("#error").text(e4);
								}
								else if (e.val() != f.val()){
								//alert('no conciden mails');
								f.css('background-color','#fdefd0');
								$("#error").text(e7);
								}
								else if(g.val() <= 4){
								//alert('error cantidad letras pass');
								g.css('background-color','#fdefd0');
								$("#error").text(e5);
								}
								else if (!(h.is(':checked'))){
								//alert('no acepto terminos');
								$('#labTerms').css('color','#f2b431');
								//$("#error").text(e6);
								//$('#labTerms').tipsy('show');
								}
								else{
								//alert('datos pasan a validacion en servidor');
								return true;
								};
});
//Empty validations effects
$(':text').blur(function(){
				$(this).css('background-color','#ffffff');
				$('#error').text('');
});
$('#labTermUse').click(function(){
						$('#labTerms').css('color','#979696');	
						$('#error').text('');
});
///////////////////////////////////////////////
</script>
<div id="help"></div>
<div id="winContainer"><div id="border"><div id="smallWindow"><?php //include('gestion/modulos/home/winFooters.php'); ?></div></div></div>
	<div id="sector1">

		<div id="holder">
    <div id="leftColumn">
    		<h1>Soccermash, The premier social network for soccer players&quot;</h1>
        <span id="logo"></span>
    </div><!--leftColumn-->
    
    <div id="rigthColumn">
    		<div id="rcTop">
                        
            <!--Start alternative login forms layer-->                       		
                            <form id="formLogin" name="formLogin" action=""><!-- Form Loguin -->
                            	
                              <fieldset>
                                <ul>
                                  <li><label><?php print $_IDIOMA->traducir("Email"); ?><br /><input id="emailLogin" name="emailLoguin" type="text" tabindex="1"  /></label><br />
								
                                      <label class="lblField" for="rememberMe"><input type="checkbox"  class="spCheck" value="1" name="rememberMe" id="rememberMe"    tabindex="3" />&nbsp;<?php print $_IDIOMA->traducir("Remember me"); ?></label>
                                  </li>
                                  <li>
                                      <label id="ps"><?php print $_IDIOMA->traducir("Password"); ?><br /><input id="passwordLoguin" name="passwordLoguin" type="password" tabindex="2" /></label><br />
									
                                      <a tabindex="5" id="forgot" href="#" title="<?php print $_IDIOMA->traducir("Did you forget your password?"); ?>"><?php print $_IDIOMA->traducir("Forgot your password?"); ?></a></li>
                                  </li>  
                                  <li>
                                     
					<input  type="button"  id="enterButton" value="<?php print $_IDIOMA->traducir("Enter"); ?>" alt="<?php print $_IDIOMA->traducir("Enter"); ?>" tabindex="4" onClick="JS_checkLoguin(); return false;"/>
                                  </li>
                               </ul>
                              </fieldset>
                             </form> 
                             <div id="msjPassw"><p><?php print $_IDIOMA->traducir("You´ll recive your new password in few minutes. Please also check your spam folder."); ?></p></div>
                             <div id="msjError"><p><?php print $_IDIOMA->traducir("Hi! You have tried reiterated times to login with wrong email or password. Caring for your security, we have sent a new password to your email. Try with it!"); ?> </p></div>  
                             
                             <form id="formForgot" name="formForgot" action=""><!-- Form Forgot -->
                             <a id="forgotClose" href="#" style="float: right;" title="<?php print $_IDIOMA->traducir("Go back"); ?>"><?php print $_IDIOMA->traducirF("Go back"); ?></a>
                             <br/>
				<div class="alerts"  id='error-emailForgot'> </div>
                              <fieldset>
                                <label><?php print $_IDIOMA->traducir("Enter your email so we can help you recover it."); ?></label>
                                <ul>
                                  <li><input style="font-size: 13px;margin: 0;" id="emailForgot" 
                                  placeholder="<?php print $_IDIOMA->traducir("your@email.com"); ?>" name="emailForgot" type="text" tabindex="1"  /></li> 
            			  <li>
				    <input  type="button"  alt="<?php print $_IDIOMA->traducir("Send"); ?>" id="enterForgot" value="<?php print $_IDIOMA->traducir("Send"); ?>" tabindex="2" onClick="JS_checkForgot(); return false;"/>
				  </li>
                                </ul>
                                
                              </fieldset>
                             </form>
                                <hr />
                          
            <!--End alternative login forms layer--> 
                           
                             <div id="newAccount"><a title="<?php print $_IDIOMA->traducir("New at Soccermash? Create an account in seconds!"); ?>" id="createIt"><?php print $_IDIOMA->traducir("Create an account"); ?></a></div> 
         </div><!--End rightTop-->
         
         <div id="rcBottom" class="showBgImg<?php
         if(isset($_SESSION["lg"])){
         	print $_SESSION["lg"];
         } 
         ?>">
                <!--Start the new user registration. Hidden by default.-->
            		<div id="newUser" class="hideNewUser">
              
                		 <form id="formNewUser" name="formNewUser" action="" ><!--  Form Loguin -->
 						<input type="hidden" name="ac" id="ac" value="save" />
			        		<input type="hidden" name="ipAddress" value="<?=$_SERVER['REMOTE_ADDR'];?>"/>
			        		<input type="hidden" name="language" value="<?=LANGUAGE;?>"/>
			        		
                       
                    
                    <table width="376" class="iepos1">    
					<div class="alerts"  id='error-registerGeneral' align="center"> </div>
	   	    	 <tr><td colspan="2">
		    	     
				
			     </td> </tr> 
                    	<tr>
                      <td width="146">
					  			<?php 
								$profile=new ProfileList();
								$profile->init('profileType', $_IDIOMA->traducir("Select your profile"),'textShowed','showIT','selector');
								?> 
                      </td>
                      </tr>
                      
                    	<tr>
                      <td width="146"><label id="labName" class="label" for="firstName"><?php print $_IDIOMA->traducir("First Name"); ?></label></td>
                      <td width="260"> <input type="text" id="firstName" value="" name="firstName" tabindex="" />
					  </td>
                      </tr>

                    	<tr>
                      <td width="146"><label id="labSurname" class="label" for="lastName"><?php print $_IDIOMA->traducir("Last Name"); ?></label></td>
                      <td width="260"><input  type="text" id="lastName" value="" name="lastName" tabindex="" />
					  </td>
                      </tr>                      
											
                      <tr>
                      <td width="146"><label id="labMail" class="label" for="emailNewUser"><?php print $_IDIOMA->traducir("Email"); ?></label></td>
                      <td width="260"><input type="text" id="emailNewUser" value="" name="emailNewUser" tabindex="" />
			          </td>
                      </tr>                      

											<tr>
                      <td><label id="reEmail" class="label" for="repeatEmail"><?php print $_IDIOMA->traducir("Repeat your email"); ?></label></td>
                      <td width="260"><input type="text" id="repeatEmail" value="" name="repeatEmail" tabindex="" />
			          </td>
                      </tr>                      

											<tr>
                      <td width="146"><label id="labPass" class="label" for="newUserPass"><?php print $_IDIOMA->traducir("Password"); ?></label></td>
                      <td width="260"><input type="password" id="newUserPass"  value="" name="newUserPass" tabindex="" />
					  </td>
                      </tr>                      

											<tr>
                      <td colspan="2">
                      	<div id="captcha">
							<script type="text/javascript">
                                    var RecaptchaOptions = {
                                    theme : 'custom',
                                    custom_theme_widget: 'recaptcha_widget'
                                    };</script>
                           
                                    <div id="recaptcha_widget" style="display:none">
                                    <div id="recaptcha_image"></div>
                                    <div class="recaptcha_only_if_incorrect_sol" style="color:red"><?php print $_IDIOMA->traducir("Incorrect please try again"); ?></div>
                                    <br />
                                    <div style="float:right; position:relative; height:57px;">
                                    	<span class="recaptcha_only_if_image" style="font-size:10px; color:#666666;"><?php print $_IDIOMA->traducir("Type the two words:"); ?></span>
                                    	<span class="recaptcha_only_if_audio" style="font-size:10px; color:#666666;" ><?php print $_IDIOMA->traducir("Type the numbers you hear:"); ?></span><br />
                                     
                                    	<input type="text" style="width:180px; position:relative; float:right;" id="recaptcha_response_field" name="recaptcha_response_field" />
                                    </div>
                                    
                                    <ul style="padding-bottom:30px;" id="optionsCaptcha">
                                    <li><a title="<?php print $_IDIOMA->traducir("Get a New Captcha"); ?>"    href="javascript:Recaptcha.reload()" id="capOther"><span class="optCapt" ><?php print $_IDIOMA->traducir("Reload CAPTCHA"); ?></span></a></li>
                                    <li><a title="<?php print $_IDIOMA->traducir("Get an Audio Captcha"); ?>" href="javascript:Recaptcha.switch_type('audio')" id="capAudio"><span class="optCapt" ><?php print $_IDIOMA->traducir("Audio"); ?></span></a></li>
                                    <li><a title="<?php print $_IDIOMA->traducir("Get an Image Captcha"); ?>" href="javascript:Recaptcha.switch_type('image')" id="capIMG"><span class="optCapt" ><?php print $_IDIOMA->traducir("Image"); ?></span></a></li>
                                    <li><a title="<?php print $_IDIOMA->traducir("Do You Need Help?"); ?>"    href="javascript:Recaptcha.showhelp()" id="capHlp"><span class="optCapt" ><?php print $_IDIOMA->traducir("Help"); ?></span></a></li>
                                    </ul>
                                                                        
                                    </div>
                                    
                                    <script type="text/javascript"
                                    src="http://www.google.com/recaptcha/api/challenge?k=6LeE1cQSAAAAAFCoYCvdsvpJy_sUvbLRqz8nO8x2">
                                    </script>
                                    <noscript>
                                    <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LeE1cQSAAAAAFCoYCvdsvpJy_sUvbLRqz8nO8x2"
                                    height="65" width="400" frameborder="0"></iframe><br>
                                    <textarea name="recaptcha_challenge_field" rows="2" cols="10">
                                    </textarea>
                                    <input type="hidden" name="recaptcha_response_field"
                                    value="manual_challenge">
                                    </noscript>
                            
                        </div><!--END captcha div-->
                      </td>
                      </tr>
                      <tr>
                      	<td colspan="2" style="text-align: right;">
                      	   
                       		<label id="labTermUse" class="lblField" for="sample-check" > 
                     			<input type="checkbox" value="" class="spCheck" id="sample-check" name="termsOfUse" /></label>
                          <span><a id="labTerms" title="<?php print $_IDIOMA->traducir("Read the terms of use and privacy policy"); ?>" href="#"><?php print $_IDIOMA->traducir("I accept the terms of use and privacy policy"); ?></a></span>
                        	</td>
                      </tr>
                      <tr>
                      	<td colspan="2">
                        	<input title="<?php print $_IDIOMA->traducir("Sign Up!"); ?>" type="button" name="register" id="signUpBttn" value="<?php print $_IDIOMA->traducir("Sign Up"); ?>" alt="<?php print $_IDIOMA->traducir("Sign Up"); ?>" tabindex="" onClick="JS_enviarRegistrar(); return false;"/>
                        </td>
                      </tr>                                                         
                    </table>    
                    </form>                              
              	</div><!--End newUser div-->	
              	<div style="display:none" id="carga" class=""><img class="" src="img/carga.gif"  width="33" height="33" />  </div>
         </div><!--End rightBottom-->
		</div>
    </div><!--holder-->    
  </div>
  <!--sector1-->
  
  <div id="sector2">
	<?php include('includes/slider.php'); ?>
  </div>
  <!--sector2-->
  
  <div id="sector3">
	<?php include('includes/footer.php'); ?>
  </div>  <!--sector3-->
 <script type="text/javascript">   

  	function JS_enviarRegistrar()
	{
  			document.getElementById('newUser').style.display = "none"; 
  			document.getElementById('carga').style.display='';
			xajax_validaRegistrar(xajax.getFormValues('formNewUser'));
			return false;
	}
    function JS_registrar()
	{
			xajax_enviarRegistrar(xajax.getFormValues('formNewUser'));
			return false;
	}
    function JS_enviarformRegistro()
    {
    	    xajax_mostrarRegistrar();
			return false;         
    }

    function JS_registerAmistoso()
    {
            document.location.href='registerAmistoso.php';
  
    }
    function JS_homeUser()
    {
            document.location.href='home.php';
  
    }

    function JS_checkLoguin()
    {
          
		xajax_validaLoguin(xajax.getFormValues('formLogin'));
		return false;         
    }
    function JS_sendLoguin()
    {
		xajax_enviarLoguin(xajax.getFormValues('formLogin'));
		return false;         
    }
    function JS_checkForgot()
    {
		xajax_enviarForgot(xajax.getFormValues('formForgot'));
		return false; 

    }
		////SPECIAL LAYOUT RULE FOR HIGH HEIGHT RESOLUTIONS////
		$(document).ready(function() {
		screen.height >= 900 && $("#holder").css("margin-top", "6%")
		});
  </script>
  
  
  
  
  
  
  
  
  <!-- //ANALITYCS// -->
<script type="text/javascript"> 
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19711436-2']);
  _gaq.push(['_trackPageview']);
  setTimeout('_gaq.push([\'_trackEvent\', \'NoBounce\', \'Over 10 seconds\'])',10000);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>





</body>
</html>
