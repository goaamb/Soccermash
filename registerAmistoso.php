<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
if(isset($_SESSION["iSMuIdKey"])){
	
	require_once('gestion/lib/site_ini.php');
	///////////////Country List//////////////////////////////////
	require_once('gestion/lib/share/clases/countryListStyled.php');
		
 
	$oXajaxRegisterAmistoso = new xajax('ajax/common_registerAmistoso.php');
	$oXajaxRegisterAmistoso->registerFunction("validaRegisterAmistoso");

	$oXajaxRegisterAmistoso->printJavascript("gestion/share/js");
}
else #si no existe la session, tiene q loguarse de nuevo
{
?>	
	 <script type="text/javascript">   
	 	document.location.href='index.php';
	   </script>	
<?php 	   
}
/*$passport=false;	
if(isset($_SESSION["iSMuProfTypeKey"])){
	if($_SESSION["iSMuProfTypeKey"]!=0){
		$idUser=$_SESSION["iSMuIdKey"];
		$idProfile=$_SESSION["iSMuProfTypeKey"];
		if($idProfile==2 || $idProfile==3 || $idProfile==5 || $idProfile==11){
			$passport=true;
		}
	}
}*/
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<title><? print $_IDIOMA->traducir("Register at the premier social network for soccer players"); ?>&quot;</title>
<link href="css/reset-min.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/custom-theme/jquery-ui-1.8.11.custom.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/registerStyles.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/general.css" rel="stylesheet" type="text/css" media="screen" />
<link href="img/favicon.ico" rel="shortcut icon" type="image/ico" />
<link href="Plugins/tipsy/src/stylesheets/tipsy.css" type="text/css" rel="stylesheet" />
<link type="text/css" href="cometchat2/cometchatcss.php"
	rel="stylesheet" charset="utf-8" />


<script type="text/javascript" src="js/css_browser_selector.js"></script>
<script type="text/javascript" src="Plugins/si.files.js"></script>
<!-- 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
 -->
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>
<script src="js/scripts.js" type="text/javascript"></script>
<script type='text/javascript' src='js/scriptsSb.js'></script>
<script src="Plugins/tooltipsLogin/jquery.qtip.pack.js" type="text/javascript"></script>
<script src="js/i18n/jquery.ui.datepicker-en-GB.js"></script>
<script src="Plugins/tipsy/src/javascripts/jquery.tipsy.js" type="text/javascript"></script>	
<script language="javascript" src="js/AjaxUpload.2.0.min.js">
</script>
<script type="text/javascript" src="cometchat2/cometchatjs.php"
	charset="utf-8" language="javascript"></script>
	<?php //if($passport){?>
	<!--<script type="text/javascript">
	 /*$(document).ready(function(){

	var passport = $('.lblFieldp');
	passport.click(function(){
				$(this).toggleClass('lblFieldp2');
	});
	$('#lblyesp').click(function(){
		$('#lblnop').removeClass('lblFieldp2');
			//alert('yes is check');
});

$('#lblnop').click(function(){
		$('#lblyesp').removeClass('lblFieldp2');
		 //alert('no is check');
});
	 });*/
	</script>-->
	<?php // }?>
</head>

<body>

<div id="topLogo"><div id="soccerlog"></div></div>

	<div id="regContent">
  		<div id="header">
      <h1><? print $_IDIOMA->traducir("Hello"); ?>, <?php  if(isset($_SESSION['sSMuNameUserKey'])) echo $_SESSION['sSMuNameUserKey'];?>! </h1>
     
	</div><!--END header-->
  <!--------------------------------------------------------------------------------->    
    
	
	 <div id="generalFields">
   <h1><? print $_IDIOMA->traducir("Personal Data"); ?></h1>
        <div id="msjGeneralRegister"  class="frm txtRight alerts"></div>
       <div id="generalFormAmistoso" >
       		
         
       <form class="frm" name="registerAmistoso" id="registerAmistoso" action="" >
          
          <input type="hidden" id="idUser"    name="iSMuIdKey"         value="<?php echo $_SESSION['iSMuIdKey'];?>" />
          <input type="hidden" id="profileId" name="iSMuProfTypeKey"   value="<?php echo $_SESSION['iSMuProfTypeKey'] ?>" />
         
          
          <span class="clear pos">
	  	 
          <label id="personalData-date" for="datepicker"><? print $_IDIOMA->traducir("Birthday"); ?></label>
		  
		  <select id="dayAg" name="day">
		  <option selected disabled><? print $_IDIOMA->traducir("Day"); ?>:</option>
		  <?php
		  
		  for ($day = 1; $day <= 31; $day++) {
				echo "<option value='$day'>$day</option>";
			}
		 
		  ?>
		  </select>
		  
		  <select id="monthAg" name="month">
		  <option selected disabled><? print $_IDIOMA->traducir("Month"); ?>:</option>
		  <option value="01">Jan</option>
		  <option value="02">Feb</option>
		  <option value="03">Mar</option>
		  <option value="04">Apr</option>
		  <option value="05">May</option>
		  <option value="06">Jun</option>
		  <option value="07">Jul</option>
		  <option value="08">Aug</option>
		  <option value="09">Sep</option>
		  <option value="10">Oct</option>
		  <option value="11">Nov</option>
		  <option value="12">Dec</option>
		  </select>
		  
		  <select id="yearAg" name="year">
		  <option selected disabled><? print $_IDIOMA->traducir("Year"); ?>:</option>
		  <?php  for ($year = 2011; $year >= 1905; $year--) { echo "<option value='$year'>$year</option>";} ?>
		  </select>
		  
          <!-- <input class="input" name="dayOfBirthDay" type="text" id="selDate" /> --> </span> 
           	
			<?php 
			$country=new CountryList();
			$country->init('countryId',$_IDIOMA->traducir("Nationality"),'textShowed','showIT','selector','0');
			?>  
          
		  <div id="city"></div>
		  <?php //if($passport){?>
		  <!--<span class="clear pos">
		  <span class="imgceu" style="background-image: url(img/bandera-CEra.png);float: right;height: 28px;width: 46px;"></span>
		  <label id="labMan" for="yesp"><? //print $_IDIOMA->traducir("Yes"); ?>&nbsp; <label id="lblyesp" class="lblFieldp"><input class="spCheckp" id="yesp" type="radio" value="1" name="passport" /></label></label>
              <label id="labWom" for="nop" style=" margin: 0 5px;width: auto;"><? //print $_IDIOMA->traducir("No"); ?>&nbsp;<label id="lblnop" class="lblFieldp"><input class="spCheckp" id="nop" type="radio" value="0" name="passport"  /></label></label>
              <label id="sexlab" for="sex" style=" margin: 0 5px;width: auto;"><? //print $_IDIOMA->traducir("European Community passport"); ?></label>
		  </span>
		  <span class="clear pos">
		  	<span id="other-passport" class="clear pos">
		  		<a onclick="$('#othPassport').show(); $('#other-passport').hide();" href="javascript:;"><? //print $_IDIOMA->traducir("Other Passport"); ?></a>
		  	</span>
		  	<span style="display:none;" id="othPassport" class="clear pos">
          		<label for="otherPassport" id="ooPassport"><? //print $_IDIOMA->traducir("Other Passport"); ?></label>
          		<input type="text" id="otherPassport" name="otherpassport" class="input">
          	</span>
		  </span>-->
		  <?php //}?>
		  
          <span class="clear pos" id="showPhoto" style="width:206px; height:206px; overflow:hidden;"><img class="add_img" id="add_img" src="img/add_imagen.gif"  width="206" height="206"></span>  
          
          <span class="upload pos">
          <label id="upPhoto"><? print $_IDIOMA->traducir("Upload my photo"); ?></label><br />
          
          <div id="divUpload" for="inpUpload">
           <input id="inpUpload" name="inpUpload" type="file"  multiple=""/>              
          </div>  
          </span>
          <input type="hidden" id="photo" name="photo"    value="<?php echo 'photoPerfil_SM_'.$_SESSION['iSMuIdKey'];?>"/>
         <!-- <div id="upload_button">Upload</div> --> 
          
		  
 			<span class="clear pos" style="width:100%;">
		      <div class="alerts" id='personalData-sex' style="clear: both;"></div>
          	  <div style="clear: both; width: 100%; float: right;">
          	  <label id="labMan" for="man">
          	  <div><img src="img/hombre.png"></div>
          	  <? print $_IDIOMA->traducir("Man"); ?>&nbsp;
          	  <label id="lblman" class="lblRadio"><input class="spRadio" id="man" type="radio" value="1" name="sex" /></label>
          	  </label>
          	  <label id="labWom" for="woman">
          	  <div>
          	  <img src="img/mujer.png">
          	  </div>
          	  <? print $_IDIOMA->traducir("Woman"); ?>&nbsp;
              <label id="lblwoman" class="lblRadio"><input class="spRadio" id="woman" type="radio" value="0" name="sex"  /></label>
              </label>
              <label id="sexlab" for="sex"><? print $_IDIOMA->traducir("Sex"); ?></label>
          	  </div>
          </span>
          
          <span class="clear pos continue">
            <input  type="button"  id="personalDate" value="<? print $_IDIOMA->traducir("Continue"); ?>" alt="<? print $_IDIOMA->traducir("Continue"); ?>" onClick="JS_enviarRegisterAmistoso(); return false;"/>
          </span>
      </form>
      
        </div> <!--END generalFormAmistoso-->
      </div><!--END generalFields-->
     
 
  
  
  
<script language="javascript">
$(document).ready(function(){

//Msj error
/*$('#personalDate').click(function(){
	if (!($('#man').is(':checked')) && !($('#woman').is(':checked'))){
		//$('#sexlab').tipsy({trigger: 'manual', gravity:'n', fallback:'Choose your sex'});
		$('#sexlab').tipsy({trigger: 'manual', gravity:'n', fallback:'->'});
		$('#sexlab').tipsy('show');
		
	}
});*/




//OnloadPhoto		
 var button = $('#divUpload'), interval;
 
 new AjaxUpload('#divUpload', {
        //action: 'uploadPhoto/upload.php',
	action: 'uploadPhoto/upload.php',
  onSubmit : function(file , ext){
  if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
   // extensiones permitidas
   alert('Error: Solo se permiten imagenes');
   // cancela upload
   return false;
  } else {
   button.text('Uploading');
   document.getElementById('showPhoto').innerHTML='<img class="" src="img/carga.gif"  width="33" height="33" />  ';
   this.disable();
  }
  },
  onComplete: function(file, response){
   button.text('Uploaded');
   // enable upload button
   this.enable();   
   // Agrega archivo a la lista
   $('#showPhoto').html(response);
  } 
 });
});
</script>
<hr />
  <!--------------------------------------------------------------------------------->      
   <!-- specificFields-->
		<?
	   require_once('gestion/modulos/profile/view/profileTesterAll.php');
		?>	   
	   <!--END specificFields-->
<!---------------------------------------------------------------------------------> 
	<hr class="linea"/>
	
	<br />
	<br />
	

  <div id="registerFoot" class="frm" style="display:none">
<!--
	  <h1>Find your contacts</h1>
	  <span class="posFoot txtFoot cleared txtRight">Select your email provider and find your contacts</span>
	  <span id="hotmail" class="posFoot"><a href="#"><h2>Hotmail</h2></a></span>
	  <span id="gmail" class="posFoot"><a href="#"><h2>Gmail</h2></a></span>
	  <span id="yahoo" class="posFoot"><a href="#"><h2>Yahoo!</h2></a></span>
	  <span class="cleared txtRight" id="others"><a href="#">I have another email provider</a></span>
 -->
	  <form class="frm" >
		<input type="hidden" name="idUserComplete" id="idUserComplete" value="<? echo $idUser; ?>"  />
	        <span class="clear pos">	
		<input  type="button"  id="" value="<? print $_IDIOMA->traducir("Continue"); ?>" alt="<? print $_IDIOMA->traducir("Continue"); ?>" onClick="checkProfileComplete();"/>
		<div id="completeAdvisorPlayer" class="alerts"></div>
		</span>
	 </form>
 </div>	  
 
  
  <!--------------------------------------------------------------------------------->       
      <div class="clear"></div>
	</div><!--END regContent-->
      <div class="clear"></div>

 <script type="text/javascript">   
  	function JS_enviarRegisterAmistoso()
	{
			xajax_validaRegisterAmistoso(xajax.getFormValues('registerAmistoso'));
			return false;
	}





	/* ACTIVITY */
	 function JS_sessionActividad(){
		$.ajax({url:'gestion/modulos/home/chkS.php',success:function(data){
				if(data=="logout"){
					JS_logout();
				}
			}});
    }

   // setTimeout("JS_setLatestPeople()",1000);
   // setTimeout("JS_getWhoIsOnline()",600);
   // setInterval("JS_sessionActividad()",(1000*60));//2 min
    //JS_sessionActividad();



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
