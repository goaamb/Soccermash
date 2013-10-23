<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('gestion/modulos/home/head.php'); ?>


 <script type="text/javascript">

function mostrar(){
	document.getElementById("divUpload").style.display = "block";
}

function ocultar(){
	document.getElementById("divUpload").style.display = "none";
}
</script>

<script src="js/AjaxUpload.2.0.min.js" type="text/javascript"></script>

</head>

<?php 
if(isset($_SESSION["iSMuIdKey"])){

	require_once('gestion/lib/site_ini.php');
	require_once('gestion/lib/share/clases/class_site.inc.php');
	require_once('gestion/modulos/profile/profileClass.php');
	require_once('gestion/lib/share/clases/class_MessaggeSM.php');
	/* ajax */
	$oXajaxRegister = new xajax('ajax/common_user_follower.php');
	$oXajaxRegister->registerFunction("setFollower");
	$oXajaxRegister->registerFunction("setAllFollower");
	$oXajaxRegister->registerFunction("getAllFollower");
	$oXajaxRegister->registerFunction("addFollower");
	$oXajaxRegister->registerFunction("setUser");
	$oXajaxRegister->registerFunction("logout");
	$oXajaxRegister->registerFunction("editProfile");
	$oXajaxRegister->registerFunction("quitEdit");
	$oXajaxRegister->registerFunction("addVisitlatestPeople");
	$oXajaxRegister->registerFunction("setLatestPeople");
	$oXajaxRegister->registerFunction("addUserLatestPeople");
	$oXajaxRegister->registerFunction("getMyFollowers");
	$oXajaxRegister->registerFunction("getMyFollowing");
	$oXajaxRegister->registerFunction("getAccount");
	$oXajaxRegister->registerFunction("updateData");
	$oXajaxRegister->registerFunction("enviarMsj");#new
	$oXajaxRegister->registerFunction("enviarReplyMsj");#new		
	$oXajaxRegister->registerFunction("enviarError");#new
	$oXajaxRegister->registerFunction("descMsj");#new
	$oXajaxRegister->registerFunction("getAllFeatured");#new
	$oXajaxRegister->registerFunction("getAllSugested");#new
	$oXajaxRegister->registerFunction("getWhoIsOnline");#new

	$oXajaxRegister->printJavascript("gestion/share/js");
	
	/* ********* Proceso Data del User ppal ************* */
	$oProfile= new Profile();
	global  $SITE;
	$SITE = new SITE();
	$aUsuario=Array();

	#IdUser ppal
	$iUserIdSM= $_SESSION["iSMuIdKey"];
	
	#get msj
	global  $oMsjs;
	$oMsjs = new MessaggeSM();
	$aCantMsj=$oMsjs->checkRecibidos($iUserIdSM);
	$aCantRta=$oMsjs->checkRespuestas($iUserIdSM);
	$iCantMSj=sizeof($aCantMsj)+sizeof($aCantRta);#cant de msj sin leer + msj de rtas sin leer
	$aNamesSend=Array();$aApesSend=Array();

	#nombres  de user send msj
	$iInd=0;
	foreach($aCantMsj as $aMsj){#msj sin leer	
		$iIdOtherUserSend = $aMsj['idUserSend'];
		$aUserSendMsj     = $SITE->getUsuario(NULL, "id='$iIdOtherUserSend'");
		$aNamesSend[$iInd]= $aUserSendMsj['name'];
		$aApesSend[$iInd] = $aUserSendMsj['lastName'];
		$iInd++;
	}

	foreach($aCantRta as $aRta){#msj de rta sin leer	
		$iIdOtherUserReply = $aRta['idUserReply'];#id user q respondio
		$aUserReplyMsj     = $SITE->getUsuario(NULL, "id='$iIdOtherUserReply'");
		$aNamesSend[$iInd]= $aUserReplyMsj['name'];
		$aApesSend[$iInd] = $aUserReplyMsj['lastName'];
		$iInd++;
	}	


	#Lista de followers 
	$aFollowers=Array();
	$iEstado='active=1';
	$iComplete='complete=1';
	#traer los users solamente, q esten activos y completos: active=1 y complete=1
	$aFollowers = $SITE->getUsuarios(NULL, "id!='$iUserIdSM'". " AND ". $iEstado. " AND ".$iComplete);
		   
	if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 ){#idUserVisiting

		$aUsuario = $SITE->getUsuario(NULL, "id='$iUserIdSM'");

		#trae Sugested Pople
		$iCity=$aUsuario['cityId'];
		$sCountry=$aUsuario['countryId'];
		$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."cityId='$iCity')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
		if(sizeof(($aSugestedPeoples)<=0) || ($aSugestedPeoples<=3)){
			$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."countryId='$sCountry')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
		}
		#Merge Array


		#Calcula la edad (formato: año/mes/dia) y asigno al array de datos
		$edad=$aUsuario['dayOfBirthDay'];
		$aUsuario['edad']=edad($edad);
			
		if(isset($_SESSION["iSMuProfTypeKey"])){#viene del registerGeneral
			$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
			#Get Data User
			$aProfile=$oProfile->selectProfile($iUserProfileId,'*',"idUser='$iUserIdSM'");
			/* Name Profile*/
			$aUsuario['nameProfile']=nameProfile($iUserProfileId);
			$aUsuario['idProfile']=$iUserProfileId;
			$aUsuario['grupoProfile']=grupoPerfil($iUserProfileId);#get group perfil

			if(($aUsuario['idProfile']==25) ||($aUsuario['idProfile']==26) ||( $aUsuario['idProfile']==27)){#es company or federation or club
				$_SESSION["iSMuProfTypeKey"] =	$aUsuario['profileId'];
				$_SESSION["nameUserSM"]      =  $aProfile[0]->name;
				$_SESSION["namePerfilUserSM"]=  nameProfile($iUserProfileId);
				
			}else{
				$_SESSION["iSMuProfTypeKey"] =  $aUsuario['profileId'];
				$_SESSION["nameUserSM"]      =  $aUsuario['name'].' '.$aUsuario['lastName'];
				$_SESSION["namePerfilUserSM"]=  nameProfile($iUserProfileId);
			}


		}else{#viene del loguin
			$iUserProfileId=$aUsuario['profileId'];

			#Get Data User
			$aProfile=$oProfile->selectProfile($iUserProfileId,'*',"idUser='$iUserIdSM'");
			/* Name Profile*/
			$aUsuario['nameProfile']=nameProfile($iUserProfileId);
			$aUsuario['idProfile']=$iUserProfileId;
			$aUsuario['grupoProfile']=grupoPerfil($iUserProfileId);#get group perfil

			if(($aUsuario['idProfile']==25) ||($aUsuario['idProfile']==26) ||( $aUsuario['idProfile']==27)){#es company or federation or club
				$_SESSION["nameUserSM"]      =  'porongaaa';
				$_SESSION["namePerfilUserSM"]=  $aProfile[0]->name;
				$_SESSION["namePerfilUserSM"]=  nameProfile($iUserProfileId);
			}else{
				$_SESSION["iSMuProfTypeKey"] =  $aUsuario['profileId'];
				$_SESSION["nameUserSM"]      =  $aUsuario['name'].' '.$aUsuario['lastName'];
				$_SESSION["namePerfilUserSM"]=  nameProfile($iUserProfileId);
			}


		}
	
	}#activeSessionVisitant	
	else{#se muestra el home del visitant
		if(isset($_SESSION["idUserVisiting"])){
			$iUserIdFW=$_SESSION["idUserVisiting"];
			$aUsuario= $SITE->getUsuario(NULL, "id='$iUserIdFW'");
			#trae Sugested Pople
			$iCity=$aUsuario['cityId'];
			$sCountry=$aUsuario['countryId'];
			$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."id!='$iUserIdFW'". " AND "."cityId='$iCity')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
			if(sizeof($aSugestedPeoples)<=0){
				$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."id!='$iUserIdFW'". " AND "."countryId='$sCountry')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
			}

			#Calcula la edad (formato: año/mes/dia) y asigno al array de datos
			$edad=$aUsuario['dayOfBirthDay'];
			$aUsuario['edad']=edad($edad);

			$iUserProfileId=$aUsuario['profileId'];
			$_SESSION["idProfileVisiting"]=$aUsuario['profileId'];
			#Get Data User
			$aProfile=$oProfile->selectProfile($iUserProfileId,'*',"idUser='$iUserIdFW'");
			/* Name Profile*/
			$aUsuario['nameProfile']=nameProfile($iUserProfileId);
			$aUsuario['idProfile']=$iUserProfileId;
			$aUsuario['grupoProfile']=grupoPerfil($iUserProfileId);#get group perfil
		}	
	}
}
else #si no existe la session, tiene q loguarse de nuevo
{
?>	
	 <script type="text/javascript">   
	 	document.location.href='index.php';
	 </script>	
<?php 	   
}
?>

<body id="home">

    <div id="header">
	<?php include('gestion/modulos/home/tprgtmenu.php'); ?>
    </div><!--END header-->
  	<div id="help"></div> 
	<div id="winContainer"><div id="border"><div id="smallWindow"><?php include('gestion/modulos/home/supplements.php'); ?></div></div></div>
    <div id="holder">	
    	<div id="news">
        <span>Here the news rss</span>
   	    <div><span id="mobil"></span><span id="world"></span></div>
    </div><!--END news-->
    		
<!--------------------------------------------->         
        <div id="leftcolumn">
          <?php include('gestion/modulos/home/photoprofile.php');?>
          <?php include('gestion/modulos/home/menuprofile.php');?>
          <?php include('gestion/modulos/home/followers.php');?>
          <?php include('gestion/modulos/home/votesviews.php');?>
        </div><!--END leftcolumn-->
<!--------------------------------------------->        
        <div id="centralcolumn">
        
            <?php include('gestion/modulos/home/idprofile.php');?>
	    <?php include('gestion/modulos/home/slidemultimedia.php');?>
	    <?php include('gestion/modulos/home/perfil/instanceHome_'.$aUsuario['grupoProfile'].'.tpl.php');?><!-- Ubica c/ perfil  -->
            <?php include('gestion/modulos/home/modules.php');?>
	    <?php include('gestion/modulos/home/Wall.php');?>
	    <div id="results"></div>   
	    <div id="videoPlayer"></div>  
    
        </div><!--END centralcolumn-->
<!--------------------------------------------->         
        <div id="rightcolumn">
        	<div id="internalNews">
                  <span>Welcome to the premier social 
						network for professional soccer
						players!!! For all of us!!!
                  </span>
                </div><!--close internalNews-->
                
                <div id="search">
                	<?php include('gestion/modulos/home/search.php');?>	
        	</div><!--close search-->
                

       		    
       		    
       		   <div id="latestPeople">
                
	                <p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllFeatured(page);">Featured Profiles</a> </p>
	                <img class="posBreak" src="img/break.png" width="200" height="3" />
	                <ul>
	                	<li>
	                	<img class="" src="img/carga.gif"  width="33" height="33" />  
	                	</li>
	                </ul> 
	  				
                	
       			</div><!--close Destacados-->
       		         
                <div id="sugestedPeople">
                  	<?php include('gestion/modulos/home/sugestedpeople.php');?>
        	</div><!--close sugestedPeople-->
        		
                <div id="whoIsOnline">
                  	  <p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getWhoIsOnline(page);">who's online</a> </p>
	                <img class="posBreak" src="img/break.png" width="200" height="3" />
	                <ul>
	                    <li>
	                	<img class="" src="img/carga.gif"  width="33" height="33" />  
	                    </li>
	                </ul> 
        	</div><!--close whoIsOnline-->
                
		<!-- <div id="advertising"> -->
                  <?php // include('gestion/modulos/home/advertising.php');?>
                  <?php // include('gestion/modulos/home/advertising.php');?>
               <!--   <span><a class="onright" href="#">Create an add</a> -->
                 <!-- <hr /> -->
                	<!-- </span> -->
               <!-- </div>-->
      
               <!-- <div id="sponsoredBy"> -->
                  <?php // include('gestion/modulos/home/sponsored.php');?>
                <!-- </div> --><!--close sponsoredby-->  
        
        </div><!--END rightcolumn-->
        <div class="cleared"></div> 
    </div><!--END holder-->
        <div id="footer">
          <?php include('gestion/modulos/home/footer.php');?>
        </div><!--END footer-->
		<div id="sL"></div>
 <script type="text/javascript">   

  	function JS_follower(a)
	{
		xajax_setFollower(a);
		return false;		

	}
	function JS_addFollower()
	{
		xajax_addFollower();
		return false;
	}
	function JS_getMyFollowers()
	{
		xajax_getMyFollowers();
		return false;
	}
	function JS_getAllFollowers(page)
	{
 
		xajax_getAllFollower(page);
		return false;
	}
	function JS_getMyFollowing(page)
	{

		xajax_getMyFollowing(page);
		return false;
	}
	function JS_setAllFollower()
	{
		xajax_setAllFollower();
		return false;
		
	}
	function JS_getAllFeatured(page)
	{
		xajax_getAllFeatured(page);
		return false;
	}
	function JS_getAllSugested()
	{
		xajax_getAllSugested();
		return false;
	}
	function JS_getWhoIsOnline(page)
	{
		xajax_getWhoIsOnline(page);
		return false;

	}
	function JS_homeUserFollower()
	{
		document.location.href='home.php';
	  
	}
  	function JS_User()
	{
		xajax_setUser();
		return false;	

	}
	function JS_account()
	{
		
		xajax_getAccount();
		return false;
		
	}
	function JS_updateData()
	{
		
		xajax_updateData(xajax.getFormValues('formUpdate'));
		return false;
	}
	function JS_enviarMsj(){

		xajax_enviarMsj(xajax.getFormValues('emailSender'));
		return false;
	}
	function JS_enviarReplyMsj(){

		xajax_enviarReplyMsj(xajax.getFormValues('replyMsjSender'));
		return false;
	}
	function JS_enviarError(){

		xajax_enviarError(xajax.getFormValues('errorReport'));
		return false;
	}
	function JS_descMsj(aForm){

		xajax_descMsj(xajax.getFormValues(aForm));
		return false;
	}
  	function JS_logout()
	{
		$("#sL").load('gestion/modulos/home/chkS.php',{out:'out'});
		xajax_logout();
		return false;	

	}
    function JS_indexUser()
    {
        document.location.href='index.php';
  
    }
    function JS_EditProfile()
    {
		xajax_editProfile();
		return false;
  
    }
    function JS_QuitEdit()
    {
        xajax_quitEdit();
        return false;
    }
    function JS_setLatestPeople()
    {
        xajax_setLatestPeople();
		return false;
  
    }
    function JS_addUserLatestPeople()
    {
		xajax_addUserLatestPeople();
		return false;
    }   
    
    function JS_sessionActividad(){
		$("#sL").load('gestion/modulos/home/chkS.php');
    }

    setTimeout("JS_setLatestPeople()",1000);
    setInterval("JS_sessionActividad()",(1000*300));//5 min
    JS_sessionActividad();
	
	

    
</script>

<script language="javascript" src="js/AjaxUpload.2.0.min.js"></script>


</body>
</html>
