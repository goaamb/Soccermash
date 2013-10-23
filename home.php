<?php
require_once('gestion/lib/site_ini.php');
require_once $_GBASE.'/goaamb/util/util.php';
require_once $_GBASE.'/goaamb/anuncio.php';
$mlagr=ModelLoader::crear("ax_generalRegister");
if(isset($_COOKIE["SOCSESSIONID"]) && !isset($_SESSION["iSMuIdKey"])){
	$email=Utilidades::descifrar(base64_decode($_COOKIE["SOCSESSIONID"]));
	if($mlagr->buscarPorCampo(array("email"=>$email))) {
		$_SESSION ["iSMuIdKey"]=$mlagr->id;
		$_SESSION["iSMuProfTypeKey"]=$mlagr->profileid;
	}
}

if (isset ( $_GET ["user"] )) {
		
	$valorId = intval ( $_GET ["user"] );
	if (isset ( $_SESSION ["iSMuIdKey"] )) {
		$iIdUSer = ( int ) $_SESSION ["iSMuIdKey"];
		if ($iIdUSer != $valorId) { #es un verdadero visit
			$_SESSION ["idUserVisiting"] = $valorId;
			$_SESSION ["editProfile"] = false;
	#addVisitlatestPeople($valorId);#add the visit::QUEDA EN STAND BY X EL MOMENTO!!!!!	
		} else { #es el mismo user ppal, pero como visit
			$_SESSION ["idUserVisiting"] = 0;
			$_SESSION ["editProfile"] = false;

		}
	}
}

if(isset($_SESSION ["idUserVisiting"]) && $mlagr->buscarPorCampo(array("id"=>$_SESSION ["idUserVisiting"],"active"=>0))) {
	$_SESSION ["idUserVisiting"]=0;
	$_SESSION ["editProfile"] = false;
	header("location:/error404.php");
}

if(isset($_SESSION ["iSMuIdKey"])){
	if(!$mlagr->buscarPorCampo(array("id"=>$_SESSION ["iSMuIdKey"]))){
		unset($_SESSION ["iSMuIdKey"]);
	}
}
if(isset($_SESSION["idUserVisiting"])&&$_SESSION["idUserVisiting"]==$_SESSION ["iSMuIdKey"]){
	$_SESSION ["idUserVisiting"] = 0;
}
if(isset($_GET["anuncio"])&&isset($_GET["tipo"])){
	$mlat2=ModelLoader::crear("ax_anuncioTipo2");
	if($mlat2->buscarPorCampo(array("id"=>$_GET["anuncio"]))){
		Anuncio::insertarEstadisticaAnuncioTipo2($mlat2, "Click", $_GET["tipo"]);
	}
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/css; charset=utf-8" />
<meta http-equiv="Cache-Control" CONTENT="no-cache" />
<meta http-equiv="pragma" CONTENT="no-cache" />
<?php include('gestion/modulos/home/head.php'); 
if(isset($_SESSION["iSMuIdKey"])){
	
	#Idioma
	
	require_once('gestion/lib/share/clases/class_site.inc.php');
	require_once('gestion/modulos/profile/profileClass.php');
	require_once('gestion/lib/share/clases/class_MessaggeSM.php');
	require_once('gestion/lib/share/clases/class_peopleNet.php');
	/* ajax */
	$oXajaxRegister = new xajax('ajax/common_user_follower.php');
	$oXajaxRegister->registerFunction("setFollower");
	$oXajaxRegister->registerFunction("setAllFollower");
	$oXajaxRegister->registerFunction("getAllFollower");
	$oXajaxRegister->registerFunction("addFollower");
	$oXajaxRegister->registerFunction("removeFollower");
	$oXajaxRegister->registerFunction("removeFriend");#new
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
	$oXajaxRegister->registerFunction("getAllOnline");#new
	$oXajaxRegister->registerFunction("getAllLatestRegistered");#new
	$oXajaxRegister->registerFunction("setEmailPrivacy");#new
	$oXajaxRegister->registerFunction("deleteInvitation");#new
	//Module Represented
	$oXajaxRegister->registerFunction("addRepresentedNotifi");#new 
	$oXajaxRegister->registerFunction("removeNotiAgent");#new
	$oXajaxRegister->registerFunction("addAgent");#new
	$oXajaxRegister->registerFunction("deleteAgent");#new
	$oXajaxRegister->registerFunction("representedPlayers");#new
	$oXajaxRegister->registerFunction("representedPlayers");#new
	$oXajaxRegister->registerFunction("deletePlayerRepresented");#new
	$oXajaxRegister->registerFunction("EditProfilePlayer");#new
	$oXajaxRegister->registerFunction("mostrarPlayers");#new
	//

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

	#Count 	Friend Request
	global  $Follower;
	$Follower = new PeopleNet();	
	$iCountInvitation=$Follower->countInvitation($iUserIdSM);

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
		#echo 'MyEditP: '.$_SESSION["editProfile"];
		$aUsuario = $SITE->getUsuario(NULL, "id='$iUserIdSM'");
		/*********** NEW: Modulo Representante **********/
	
		#player
		#si es algun perfil player
		if(($aUsuario['profileId']==2) ||($aUsuario['profileId']==3) ||( $aUsuario['profileId']==5)||($aUsuario['profileId']==6) ||( $aUsuario['profileId']==7)){
			$_SESSION["sessionPlayer"]=true;
			if(empty($aUsuario['myAgent'])){#no tiene agent-->puede tener represented notification
				$aNotification = $SITE->getRepresentedPlayer($iUserIdSM);
				$_SESSION["bDeleteAgent"]=false;
				$_SESSION["sNameAgent"]=false;
				$_SESSION["iIdAgent"]=false;
				if($aNotification!=false)
					$iCantRepresentedNotifi=count($aNotification);#cant. de notificaciones de agent
			}else{#tiene Agent
				$_SESSION["iIdAgent"]=(int)$aUsuario['myAgent']; 
				$iIdAgent=(int)$aUsuario['myAgent'];
				$aAgent = $SITE->getUsuario(NULL, "id='$iIdAgent'");
				$_SESSION["sNameAgent"]=(string)$aAgent['name'].' '.$aAgent['lastName'];
				$_SESSION["iIdAgent"]=$iIdAgent;
				$_SESSION["iIdAgentPlayer"]=$iIdAgent;
				$_SESSION["bDeleteAgent"]=true;
				
			}


		}

		#Agent
		if(isset($aUsuario['profileId']) ){
			#pregunto si es algun tipo de perfil agente
			if($aUsuario['profileId']==13 || $aUsuario['profileId']==14 || $aUsuario['profileId']==15 || $aUsuario['profileId']==16){
				$_SESSION["isAgent"]=1;#seta en uno si es agente
				$_SESSION["iIdAgent"]=$iUserIdSM;#setea el ID agente
				$_SESSION["iProfileAgent"]=$aUsuario['profileId'];
				$_SESSION["bEditPlayer"]=false;$_SESSION["bSavedPlayer"]=false;
				?>
				 <script type="text/javascript">   
					 setTimeout("JS_representedPlayers(1)",300);
				 </script>

				<?php
				
			}else $_SESSION["isAgent"]=0;#setea en cero, sino es agente
		}
		/*********** End: Modulo Representante **********/
		

		#trae Sugested Pople
		$iCity=$aUsuario['cityId'];
		$sCountry=$aUsuario['countryId'];
		$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."cityId='$iCity')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
		if(sizeof(($aSugestedPeoples)<=0) || ($aSugestedPeoples<=3)){
			$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."countryId='$sCountry')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
		}
		#Merge Array


		#Calcula la edad (formato: aÃ±o/mes/dia) y asigno al array de datos
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
				#echo 'NoMyEditP: '.$_SESSION["editProfile"];
		if(isset($_SESSION["idUserVisiting"])){
			$iUserIdFW=$_SESSION["idUserVisiting"];
			$aUsuario= $SITE->getUsuario(NULL, "id='$iUserIdFW'");
			
			/************ Begin: Modulo Represent********/

			#si es algun perfil player
			if(($aUsuario['profileId']==2) ||($aUsuario['profileId']==3) ||( $aUsuario['profileId']==5)||($aUsuario['profileId']==6) ||( $aUsuario['profileId']==7)){
				
				#cdo el user session tiene = agent q el perfil player visitado
				$iIdMyAgent=$aUsuario['myAgent'];#ID Agents
				if(isset( $_SESSION["iIdAgentPlayer"]) && isset($iIdMyAgent) ){#si el dueÃ±o de la session es un player
						if($_SESSION["iIdAgentPlayer"]==$iIdMyAgent){#tiene el mismo agente
								$aAgent 			= $SITE->getUsuario(NULL, "id='$iIdMyAgent'");
								$_SESSION["sNameAgent"]		=(string)$aAgent['name'].' '.$aAgent['lastName'];#name Agent
								$_SESSION["editProfile"] =false;#desabilito la edicion de su perfil
								$_SESSION["bEditPlayer"] =false;#esta inactivo la edicion de un player por su agent(save data)
								$_SESSION["bSavedPlayer"]=false;
						 
						}
				}else{#agent <>
				
						if(!isset($aUsuario['myAgent'])||empty($aUsuario['myAgent'])){#no tiene agent
						
							#si ya existe una notificacion del agent a este user
							$aRepresented = explode(",",$aUsuario['represented_recived']);#get yours notifications
							$sId=(string)$iUserIdSM;
							$bKey = array_search($sId,$aRepresented,TRUE);#si ya existe una invitacion del mismo agent
							$_SESSION["editProfile"]	=false;
							$_SESSION["bEditPlayer"]	=false;
							$_SESSION["bSavedPlayer"]	=false;
							$_SESSION["sNameAgent"]		=false;#p q no muestre el name del agente
							
							if($bKey || $bKey===0){#compara si el cualkier indice o el cero, xq el cero lo toma como false
								$_SESSION["sentRepresented"]=0;#ya envio una invitacion de representacion
		
							}else{ 
								
								$_SESSION["sentRepresented"]=1;#no envio una invitacion de representacion
								if(isset($_SESSION["isAgent"]) && $_SESSION["isAgent"]==1){#si el que visita es un agente
									$_SESSION["playerAgent"]=1;
								}	
								
							}
						}else{#player c agent
							$_SESSION["playerAgent"]=0;#No le aparecera el boton send represented
							$iIdMyAgent=$aUsuario['myAgent'];#ID Agents
						
							if(isset($_SESSION["iIdAgent"]) && $_SESSION["iIdAgent"]==$iIdMyAgent) {#compara si el player es representado x ese Agen
								if(isset($_SESSION["bSavedPlayer"])&&$_SESSION["bSavedPlayer"]==true){#p la edicion de datos player
									$_SESSION["editProfile"]=false;#desabilito la edicion de su perfil
									$_SESSION["bEditPlayer"]=false;#esta inactivo la edicion de un player por su agent(save data)
								}else{	
									$_SESSION["editProfile"]=true;#habilito la edicion de su perfil
									$_SESSION["bEditPlayer"]=true;#esta activo la edicion de un player por su agent(save data)
									#Session player
									$aAgent 					= $SITE->getUsuario(NULL, "id='$iIdMyAgent'");
									$_SESSION["sNameAgent"]		=(string)$aAgent['name'].' '.$aAgent['lastName'];#name Agent
									$_SESSION["iIdPlayer"]		=$aUsuario['id'];#guardo el ID player represented
									$_SESSION["iPerfilPlayer"]	=$aUsuario['profileId'];#guardo el perfil player represented
									$_SESSION["iSexPlayer"]		=$aUsuario['sex'];#guardo el sex player represented
									$_SESSION["iCountryPlayer"]	=$aUsuario['countryId'];#guardo el country player represented
								}
							}else{#tiene otro Agente
								$_SESSION["sNameAgent"]  =false;#p q no muestre el name del agente
								$_SESSION["editProfile"] =false;#desabilito la edicion de su perfil
								$_SESSION["bEditPlayer"] =false;#esta inactivo la edicion de un player por su agent(save data)
								$_SESSION["bSavedPlayer"]=false;
							}
						}
				}#agent <>
			}else{#cualkier otro perfil
				$_SESSION["editProfile"]	=false;#desabilito la edicion de otro perfil perfil
				$_SESSION["bEditPlayer"]	=false;#desactivo la edicion p guardar datos
				$_SESSION["bSavedPlayer"]	=false;
				$_SESSION["sentRepresented"]	=0;#ya envio una invitacion de representacion
				$_SESSION["sNameAgent"] 	=false;#p q no muestre el name del agente
				$_SESSION["playerAgent"]	=0;
			}#cualkier otro perfil
			/************ End Represent ********/
			
			
			#trae Sugested Pople
			$iCity=$aUsuario['cityId'];
			$sCountry=$aUsuario['countryId'];
			$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."id!='$iUserIdFW'". " AND "."cityId='$iCity')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
			if(sizeof($aSugestedPeoples)<=0){
				$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."id!='$iUserIdFW'". " AND "."countryId='$sCountry')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
			}


$Follower = new PeopleNet();	
		$aFollowers=Array();
		$aFollowers=$Follower->getHistoryFollowing($iUserIdSM);#get all Followers del user
		$sSqlId =  implode("','", $aFollowers['id']);
		
		$iCity=$aUsuario['cityId'];
		$sCountry=$aUsuario['countryId'];
		$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND ". "id NOT IN ('$sSqlId')". " AND "."cityId='$iCity')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC limit 0,200' );
		if(sizeof(($aSugestedPeoples)<=0) || ($aSugestedPeoples<=3)){
			$aSugestedPeoples=$SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND ". "id NOT IN ('$sSqlId')". " AND "."countryId='$sCountry')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC limit 0,200' );
			}
			#Calcula la edad (formato: aÃ±o/mes/dia) y asigno al array de datos
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
</head>
<body id="home">
	<div id="suptop" class="display:none;"></div>
    <div id="header">
	<?php include('gestion/modulos/home/tprgtmenu.php');?>
    </div><!--END header-->
    <div id="mapasFondo">
		<div class="mapaLeft"></div>
		<div class="mapaRight"></div>
    </div>
  	<div id="help"></div> 
	<div id="winContainer"><div id="border"><a href="javascript:;" id="clsMail" title="<? print $_IDIOMA->traducir("Close"); ?>"></a><div id="smallWindow"><?php include('gestion/modulos/home/supplements.php'); ?></div></div></div>
<div id="inviteContainer" style="background:#FFFFFF;"></div>
		
		<div id="inviteDiv">
		
			<div id="border" original-title=""><a id="clsMail" onclick="closeAdvicess();" href="javascript:;" original-title="CERRAR"></a>
			
					<div id="smallWindow" original-title="">
					
								<div id="bimgInvite"><div id="titleInvite"><? print $_IDIOMA->traducir("Invite friends"); ?></div>
								
</div>
					
					
					<div id="invitationSentCartel"><? print $_IDIOMA->traducir('Your invitation has been successfully sent'); ?></div>
					
					<div style="clear:both;width: 100%;" original-title=""></div>
					
					
					
					<div id="contentThrdInvite"  style="display: none;">
					<div id="mailSelectedInvite2"></div>
					<div id="emailTxtInvite"></div>
					<div id="pwdTxtInvite2"><? print $_IDIOMA->traducir("Select contacts, then send the invitations"); ?>. <img id="indicLoadContacts" src="img/indicator.gif" width="15"/></div>
					<!--<div id="contactListBtnInvite" original-title="">Invite</div>-->
					
					
					<iframe id="iframeSendInvitation" name="iframeSendInvitation" width="0" height="0" style="border:none;" src=""></iframe>
					<div id="emailListInvite"></div>
					<div id="borderLineInvite2"></div>
					<div id="sendingInvite"></div>
					<div id="contactListBtnInvite2" onclick="goToInvite();"><? print $_IDIOMA->traducir("Invite"); ?></div>
					</div>
					
					<div id="contentSecondtInvite" style="display: none;">
					<div id="alertInviteError"></div>
					<div id="mailSelectedInvite"></div>
					<div id="emailTxtInvite"><? print $_IDIOMA->traducir("Email"); ?></div>
					<div id="pwdTxtInvite"><? print $_IDIOMA->traducir("Password"); ?></div>
					<div id="bgInputInvite"></div>
					<div id="bgInputInvite2"></div>
					<div id="borderLineInvite"></div>
					<div id="emailInputInvite"><input type="text" name="email_box" id="email_box"/></div>
					<div id="passInputInvite"><input type="password" id="password_box" name="password_box"/></div>
					<input type="hidden" value="get_contacts" name="step" id="step"/>
					<input type="hidden" value="" name="provider_box" id="provider_box"/>
					<div id="contactListBtnInvite" onclick="changeThirdInvite();"><? print $_IDIOMA->traducir("Contact List"); ?></div>
					</div>
					
					<div id="contentFirstInvite">
					<div id="emailProviderInvite"><? print $_IDIOMA->traducir("Select your Email provider"); ?>:</div>
					<div id="wedonotInvite"><? print $_IDIOMA->traducir("We do not save your login information or send out invites to any of your contacts without your permission"); ?></div>
					<div id="hotmailButtonInvite" onclick="setHotmailgotoSecondInvite();"></div>
					<div id="gmailButtonInvite" onclick="setGmailgotoSecondInvite();"></div>
<!--<div id="yahooButtonInvite" onclick="setYahoogotoSecondInvite();"></div>-->
					<div id="borderLineInvite"></div>
					</div>
					
					
					
					
					
					</div></div>			
		
		
		</div>
    <div id="holder">	
    		
<!--------------------------------------------->         
        <div id="leftcolumn">
			
          <?php include('gestion/modulos/home/photoprofile.php');?>
          <?php include('gestion/modulos/home/menuprofile.php');?>
          <?php include('gestion/modulos/home/followers.php');?>
          <?php include('gestion/modulos/home/votesviews.php');?>
        </div><!--END leftcolumn-->
<!--------------------------------------------->        
        <div id="centralcolumn">
        <div id="news">
        <span><?// print $_IDIOMA->traducir("Here the news rss"); ?></span>
   	    <div>
   	    <span id="rss" title="<? print $_IDIOMA->traducir("RSS"); ?>" onclick="opMsgNews();"><span style="display:none;">0</span></span>
   	    <span id="world" title="<? print $_IDIOMA->traducir("Live scores"); ?>" onclick="opMsgScores();"><span id="oneGoal" style="display:none;">G!</span></span>
		<span id="mobil"></span>   	    
   	    </div>
    </div><!--END news-->
			<div id="alertsMsgs"></div>
			
			<div id="alertsNewsRss" style="display:none;">
			<? require_once('gestion/modulos/home/msgs/msgsnews.php');?>
			</div>
			<div id="alertsLiveScores" style="display:none;">
			<? //require_once('gestion/modulos/home/msgs/msgsscores.php');?>
				<div class="theMsgsS">
				<iframe id="iframeLiveScores" name="iframeLiveScores" width="590" height="660" style="border:none;" src="gestion/modulos/home/msgs/msgsscores.php"></iframe>
				<iframe id="iframeLiveScores2" name="iframeLiveScores2" width="0" height="0" style="border:none;" src=""></iframe>
				</div>
			</div>
			<div id="privateMsgs"></div>
			<div id="accountContent"></div>
			<div id="accountViewer"></div>
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
        	<div id="acountLeft" style="display:none;background-color: #F2F2F2;background-image: url(../img/bgBorderRC.png);background-repeat: repeat-y;background-position: left;width: 212px;height: 100%;position: fixed;z-index: 9999;"></div>
        	<div id="internalNews"><?php
        	include("gestion/modulos/home/superiorDerecha.php");  
        	?></div><!--close internalNews-->
                
                <div id="search">
                	<?php include('gestion/modulos/home/search.php');?>	
        	</div><!--close search-->
                
<div id="advertising"><?php include('gestion/modulos/home/advertising.php');?> </div>
       		    
       		    
       		   <div id="latestPeople">
                
	                <p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllFeatured(page);"><? print $_IDIOMA->traducir("Featured Profiles"); ?></a> </p>
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
                  	  <p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllOnline(page);"><? print $_IDIOMA->traducir("Who's online"); ?></a> </p>
	                <img class="posBreak" src="img/break.png" width="200" height="3" />
	                <ul>
	                    <li>
	                	<img class="" src="img/carga.gif"  width="33" height="33" />  
	                    </li>
	                </ul> 
        	</div><!--close whoIsOnline-->

            <div id="lastRegistered">
	                
	                <p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllLatestRegistered(page);"><? print $_IDIOMA->traducir("Latest Registered"); ?></a></p>
			  				<img class="posBreak" src="img/break.png" width="200" height="3" />
	                <ul>
	                    <li>
	                	<img class="" src="img/carga.gif"  width="33" height="33" />  
	                    </li>
	                </ul> 
           </div><!--close lastRegistered--> 
                
		 
		 <div id="sponsoredAdvertising" style="clear:both;"><?php include('gestion/modulos/home/sponsoredAdvertising.php');?> </div>
        
        </div><!--END rightcolumn-->
        <div class="cleared"></div> 
    </div><!--END holder-->
        <div id="footer">
          <?php include('gestion/modulos/home/footer.php');?>
        </div><!--END footer-->
		<!--<div id="sL"></div>-->
 <script type="text/javascript">   

 	function opMsgNews(){
		$("#privateMsgs").html('');
		$("#alertsMsgs").html('');
		$(".privBgMsgsWS").hide();
		$(".bgMsgsWS").hide();
		$(".bgMsgsFL").hide();
		$("#alertsLiveScores").hide();
		$("#alertsNewsRss").toggle();
		
	} 
 	function opMsgScores(){
		$("#privateMsgs").html('');
		$("#alertsMsgs").html('');
		$(".privBgMsgsWS").hide();
		$(".bgMsgsWS").hide();
		$(".bgMsgsFL").hide();
		$("#alertsNewsRss").hide();
		$("#alertsLiveScores").toggle();
		$("#oneGoal").hide();
		
		
	} 
  	function JS_follower(a)
	{
		xajax_setFollower(a);
		return false;		

	}
	function JS_addFollower()
	{
		$('#follow').unbind('hover');
		$('#follow').hover(function(){
		$('#myTextFriend').html('<?php print ($_IDIOMA->traducir("Remove Friend")); ?>');
		$('#follow').addClass("remf");
		$('#follow').removeClass("now");
		});
		$('#follow').unbind('mouseleave');
		$('#follow').mouseleave(function(){
		$('#myTextFriend').html('<?php print ($_IDIOMA->traducir("Friend")); ?>');
		$('#follow').addClass("now");
		$('#follow').removeClass("remf");
		});
		
		xajax_addFollower();
		return false;
	}
	function JS_deleteInvitation(a)
	{

		xajax_deleteInvitation(a);
		return false;
	}

	function JS_removeFollower()
	{
		$('#follow').unbind('hover');
		$('#follow').hover(function(){
			$('#myTextFriend').html('<?php print ($_IDIOMA->traducir("Add Friend")); ?>');
			$('#follow').removeClass("remf");
		});
		$('#follow').unbind('mouseleave');
		$('#follow').mouseleave(function(){
			$('#myTextFriend').html('<?php print ($_IDIOMA->traducir("Add Friend")); ?>');
			$('#follow').removeClass("now");
		});
		
		xajax_removeFollower();
		return false;
	}
	function JS_removeFriend(a){
				
		xajax_removeFriend(a);
		return false;
	}
	function JS_getMyFollowers()
	{
		$('#videoPlayer').hide();
		xajax_getMyFollowers();
		return false;
	}
	function JS_getAllFollowers(page)
	{
		$('#videoPlayer').hide();
		xajax_getAllFollower(page);
		return false;
	}
	function JS_getMyFollowing(page)
	{
		$('#videoPlayer').hide();
		xajax_getMyFollowing(page);
		return false;
	}
	function JS_setAllFollower()
	{
		$('#videoPlayer').hide();
		xajax_setAllFollower();
		return false;
		
	}
	function JS_getAllFeatured(page)
	{
		$('#videoPlayer').hide();
		xajax_getAllFeatured(page);
		return false;
	}
	function JS_getAllSugested(page)
	{
		$('#videoPlayer').hide();
		xajax_getAllSugested(page);
		return false;
	}
	function JS_getWhoIsOnline()
	{
		$('#videoPlayer').hide();
		xajax_getWhoIsOnline();
		return false;

	}
	function JS_getAllOnline(page)
	{
		$('#videoPlayer').hide();
		xajax_getAllOnline(page);
		return false;

	}
	function JS_getAllLatestRegistered(page)
	{
		$('#videoPlayer').hide();
		xajax_getAllLatestRegistered(page);
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
	function JS_updateData(bot)
	{
		$('#update').val(bot);

		xajax_updateData(xajax.getFormValues('formUpdate'));
		return false;
	}
	function JS_setEmailPrivacy(aForm){

		xajax_setEmailPrivacy(xajax.getFormValues(aForm));
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
	/*funciones represent*/

	function JS_addRepresentedNotifi(){
		var f=$('#agree');
		if (!(f.is(':checked'))){
			$('#Errormsgs').show();
		}else{
			xajax_addRepresentedNotifi();		
			$('#myText').html('<?php print ($_IDIOMA->traducir("Request Sent")); ?>');
			$('#alertEmergente').hide();
			$('#alertEmergente0').hide();
			$('#represent').attr('onclick','return false');
			return false;
		}
		
	}	



	function aceptarSolicitud(id){
	var d=$('#agree');
	if (!(d.is(':checked'))){
		$('#Errormsgs').show();
	}else{
		$('#alertEmergente').hide();
		$('#alertEmergente0').hide();
		JS_hideAllNoti();
		JS_addAgent(id);
	}
}
	function JS_removeNotiAgent(id){
		xajax_removeNotiAgent(id);
		return false;
	}
	function removeAgent(){
		$("#alertEmergenteDatos").load('gestion/modulos/home/msgs/removeRepresent.php');
		$('#alertEmergente').show();
		$('#alertEmergente0').show();
	}
	function JS_addAgent(id){

		xajax_addAgent(id);
	
		return false;
	}
	function JS_deleteAgent(id){

		xajax_deleteAgent(id);
		$('#alertEmergente').hide();
		$('#alertEmergente0').hide();
		JS_QuitEdit();
		return false;
	}
	function JS_deletePlayerRepresented(id){
		xajax_deletePlayerRepresented(id);
		$('#alertEmergente').hide();
		$('#alertEmergente0').hide();
		return false;
	}
	function JS_EditProfilePlayer(){
		
		xajax_EditProfilePlayer();
		return false;
	 }    
	/* end funciones represent*/
	function JS_descMsj(aForm){

		xajax_descMsj(xajax.getFormValues(aForm));
		return false;
	}
  	function JS_logout()
	{
		$("#sL").load('gestion/modulos/home/chkS.php',{out:'out'});
		xajax_logout();
		G.cookie.set("SOCSESSIONID","",0,"/");
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
    var actionQueue=[];
    function JS_sessionActividad(){
		$.ajax({url:'gestion/modulos/home/chkS.php',success:function(data){
				if(actionQueue && actionQueue.length>0){
					try{
						eval("data="+data);
					}catch(e){}
					for ( var i = 0; i < actionQueue.length; i++) {
						if(actionQueue[i] && actionQueue[i].call){
							
							actionQueue[i](data);
						}
					}
				}
			}});
    }
    actionQueue.push(function(data){
       if(data.logout){
           JS_logout();
       }
    });
    actionQueue.push(function(data){
            var counter=G.dom.$("numPrivMsgReceived");
			if(data.faltan>0){
				counter.innerHTML=data.faltan;
				counter.style.display="block";
				$(".privMsgNone").removeClass("privMsgNone").addClass("privMsgReceived");
			}
			else{
				counter.style.display="none";
				$(".privMsgReceived").removeClass("privMsgReceived").addClass("privMsgNone");
			}
			counter=G.dom.$("numReceivedMsgWallS");
			if(data.wallfaltan>0){
				counter.innerHTML=data.wallfaltan;
				counter.style.display="block";
				$(".noneMsgWallS").removeClass("noneMsgWallS").addClass("receivedMsgWallS");
			}
			else{
				counter.style.display="none";
				$(".receivedMsgWallS").removeClass("receivedMsgWallS").addClass("noneMsgWallS");
			}
    });
    setTimeout("JS_setLatestPeople()",600);
    setTimeout("JS_getWhoIsOnline()",600);
    setInterval("JS_sessionActividad()",(1000*60));//1 min
    JS_sessionActividad();
	
    var HideInfo='<?php print $_IDIOMA->traducir("HIDE INFO");?>';
    var ShowInfo='<?php print $_IDIOMA->traducir("SHOW INFO");?>';
    function cerrarAlertEmergente(){
    	$('#alertEmergente').hide();$('#alertEmergente0').hide();$('#represent').removeClass('now');
    	$('#alertEmergenteDatos').html("");
   }
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



<script type="text/javascript" src="js/inf_fotos.js"></script>	
<script type="text/javascript" src="gestion/modulos/video/JWPlayer/swfobject.js"></script>
<script type='text/javascript' src='gestion/modulos/video/JWPlayer/jwplayer.js'></script>
<script type="text/javascript" src="cometchat2/cometchatjs.php"	charset="utf-8" language="javascript"></script>


<!-- esto es para las alertas de representantes o agentes-->
<div id="loadingEmergente" style="display:none;"></div>
<div id="alertEmergente" style="display:none;"></div>
<div id="alertEmergente0" style="display:none;">
<div id="alertEmergente1">
<a href="#" onclick="cerrarAlertEmergente();return false;" class="close"></a>
<div id="alertEmergenteDatos"></div>
</div>
</div>
<!-- esto es para las alertas de representantes o agentes-->
</body>
</html>
