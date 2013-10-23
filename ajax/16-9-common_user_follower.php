<?php
require_once('../gestion/lib/site_ini.php');
require_once('../gestion/lib/share/clases/class_site.inc.php');
require_once('../gestion/lib/share/clases/class_peopleNet.php');
require_once('../gestion/lib/share/clases/class_MessaggeSM.php');
require_once('../gestion/modulos/profile/profileClass.php');
$dir = '';
require_once ($_SERVER ['DOCUMENT_ROOT'] . $dir . '/gbase.php');
require_once ($_GBASE . '/goaamb/mail/qmail.php');

#mostrar users followers
function setFollower($valorId){

	$oRespuesta = new xajaxResponse();
	if(isset($_SESSION["iSMuIdKey"])){
		$iIdUSer=(int)$_SESSION["iSMuIdKey"];
		if($iIdUSer!=$valorId){#es un verdadero visit
			$_SESSION["idUserVisiting"]=$valorId;
			$_SESSION["editProfile"]=false;
			#addVisitlatestPeople($valorId);#add the visit::QUEDA EN STAND BY X EL MOMENTO!!!!!	
		}else{#es el mismo user ppal, pero como visit
			$_SESSION["idUserVisiting"]=0;
			$_SESSION["editProfile"]=false;
			
		}
	}
	
	$oRespuesta->call('JS_homeUserFollower');
	return $oRespuesta;
}	

#agregar Follower
function addFollower(){
	$oRespuesta = new xajaxResponse();
	if(isset($_SESSION["iSMuIdKey"])){
		$iIdUser=(int)$_SESSION["iSMuIdKey"];
		if(isset($_SESSION["idUserVisiting"])){
			$iIdFollower=(int)$_SESSION["idUserVisiting"];
			if($iIdUser!=$iIdFollower){#si el ID de user es != al visit
				global  $Follower;
				$Follower = new PeopleNet();	
				$bFollower=$Follower->agregarFollower($iIdUser,$iIdFollower);
				
				
				if($bFollower){#send email for user
			 global   $SITE;
			 $SITE    	= new SITE();
			 $aUsuario	= Array();		
			 $aUser 	= $SITE->getUsuario(NULL, "id='$iIdUser'");
			 $aUserAccepted 	= $SITE->getUsuario(NULL, "id='$iIdFollower'");
			 $aUserAccepted['nameAccepted']= $aUser['name'].', '.$aUser['lastName'];
			 
			 $prioridad="Sistema";
		         $asunto=$aUserAccepted['nameAccepted'].' added you as your friend at SOCCERMASH.com';
		         $tipo="alguno";
		         $archivo='/templatemail/emailAcceptedFriend.tpl';
		     
		         if(QMail::add($tipo, $iIdFollower, $asunto, $archivo, $aUserAccepted, $prioridad)){
					return $oRespuesta;
			 }
		}
				
			}
		}#idUserVisiting
	}#iSMuIdKey	
	
	global $_IDIOMA;
	#Recargo el Status del Boton Add Friend

	$aFolloweres=$Follower->getHistoryFollowing($iIdUser);#todos los Friends
	$iCantTotal=count($aFolloweres['id']);
	
	$i=0;
	while($i<$iCantTotal){
	if($iIdFollower==$aFolloweres['id'][$i]){
		$you=TRUE;
		break;
	}else{
		$you=FALSE;
	}
		$i++;
	}		

	if($you){

			
			$sDatos = '  <li><span class="bdBreak"></span><a id="follow" onmouseover="overFriend();" onmouseout="mouseleaveFriend();" onclick="JS_removeFollower(); return false;" class="now" href="#"><em id="followII"></em><div id="myTextFriend">'.$_IDIOMA->traducir("Friend").'</div></a><span class="bgShdw"></span></li>';
	}else{
				$sDatos = '  <li><span class="bdBreak"></span><a id="follow" onclick="JS_addFollower(); return false;" href="#"><em id="followII"></em><div id="myTextFriend">'.$_IDIOMA->traducir("Add Friend").'</div></a><span class="bgShdw"></span></li>';
	}
	
	
	
	
	$oRespuesta->assign("statusFriend", "innerHTML", $sDatos);#Button Menu Profile-> Friend
	
	
	$oRespuesta->call('JS_setLatestPeople');#call Div Follower
	
	
	
	return $oRespuesta;
}


#Remove Follower
function removeFollower(){
	$oRespuesta = new xajaxResponse();
	if(isset($_SESSION["iSMuIdKey"])){
		$iIdUser=(int)$_SESSION["iSMuIdKey"];
		
		if(isset($_SESSION["idUserVisiting"])){
			$iIdFriend=(int)$_SESSION["idUserVisiting"];
			if($iIdUser!=$iIdFriend){#si el ID de user es != al visit
				global  $Follower;
				$Follower = new PeopleNet();	
				$bFollower=$Follower->removeFollower($iIdUser,$iIdFriend);
			}
		}#idUserVisiting
		
	}#iSMuIdKey
	
	global $_IDIOMA;
	#Recargo el Status del Boton Add Friend

	$aFolloweres=$Follower->getHistoryFollowing($iIdUser);#todos los Friends
	$iCantTotal=count($aFolloweres['id']);
	
	$i=0;
	while($i<$iCantTotal){
	if($iIdFriend==$aFolloweres['id'][$i]){
		$you=TRUE;
		break;
	}else{
		$you=FALSE;
	}
		$i++;
	}		

	if($you){
		
			$sDatos = " $(document).ready(function(){
							$('#follow').hover(function(){
					
								$('#myTextFriend').html('<?php print ($_IDIOMA->traducir('Remove Friend')); ?>');
								$('#follow').addClass('remf');
								$('#follow').removeClass('now');
								});";
			$sDatos.="		$('#follow').mouseleave(function(){

								$('#myTextFriend').html('<?php print ($_IDIOMA->traducir('Friend')); ?>');
								$('#follow').addClass('now');
								$('#follow').removeClass('remf');
							});
						})";
			
			$sDatos.= '  <li><span class="bdBreak"></span><a id="follow" onclick="JS_removeFollower(); return false;" class="now" href="#"><em id="followII"></em><div id="myTextFriend">'.$_IDIOMA->traducir("Friend").'</div></a><span class="bgShdw"></span></li>';
			}else{
				$sDatos = '  <li><span class="bdBreak"></span><a id="follow" onclick="JS_addFollower(); return false;" href="#"><em id="followII"></em><div id="myTextFriend">'.$_IDIOMA->traducir("Add Friend").'</div></a><span class="bgShdw"></span></li>';
	}
	
	$oRespuesta->assign("statusFriend", "innerHTML", $sDatos);#Button Menu Profile-> Friend
	$oRespuesta->call('JS_setLatestPeople');#call Div Friends
	
	return $oRespuesta;
}

#muestra los ultimos followers de un User
function getMyFollowers()
{

global $_IDIOMA;

	$oRespuestaF = new xajaxResponse();
	if(isset($_SESSION["iSMuIdKey"])){
		$iIdUSer=(int)$_SESSION["iSMuIdKey"];
		global  $oFollower;
		$oFollower = new PeopleNet();	
		$aFollowers=Array();
		$aFollowers=$oFollower->getAllFollower($iIdUSer);#ultimos followers

		$sPhoto='<span class="subtitlesLC paddingLC">'.$_IDIOMA->traducir("Followers").'</span>
				  <p class="onright paddingLC"></p>
				  <ul>';

		$sPhotoF='<span class="subtitlesLC paddingLC"><a href="#" onclick="JS_getMyFollowers(); return false;">'.$_IDIOMA->traducir("Followers").'</a></span>
				  <p class="onright paddingLC"></p>
				  <ul>';

		for($i=0;$i<sizeof($aFollowers['id']);$i++){
			if($aFollowers['id'][$i]!=0){
				$aFollowerData = $SITE->getUsuario(NULL, "id='".$aFollowers['id'][$i]."'");	
				$sPhotoF.='<li>	<a href="/'.$_IDIOMA->traducir("user")."/".$aFollowerData["id"]."-".Utilidades::normalizarTexto($aFollowerData["name"]." ".$aFollowerData["lastName"]).'" title="'.$aFollowers['name'][$i].'">		   	
			   							<img src="photoGeneral/small/small_'.$aFollowerData["photo"].'"  />
			   					</a>
						  </li>  ';
			}
		}#for

		$sPhoto.='</ul>';

	}

	$oRespuestaF->assign("centralFollower", "innerHTML", $sPhoto);
	return $oRespuestaF;
	
}


#muestra TOdos los followers de un User
function getAllFollower($iPagActual)
{


	$oRespuestaF = new xajaxResponse();
	global  $oFollower;
	$oFollower = new PeopleNet();	
	$aFollowers=Array();
	
	#Users 
	global $SITE; 
	$SITE        = new SITE();
	$iEstado     ='active=1';
	$iComplete   ='complete=1';
	$iDestacado  ='destacado=1';
	
	global $_IDIOMA;
	
	#Paginator
	if(isset($iPagActual)){
	  $page=$iPagActual;
	}else $page=1;
	#$iCantTotal=sizeof($Follower->getHistoryFollowing($iIdUSer)));#cant total Destac
	$iCantSet=15;#cant de record x page
	
	
	if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 || $_SESSION["idUserVisiting"]==$_SESSION["iSMuIdKey"]){#esta activo el USER ppal!
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUser=(int)$_SESSION["iSMuIdKey"];
			$aFollowers=$oFollower->getHistoryFollower($iIdUser);#todos los  followers
			
			#paginator
			$iCantTotal=sizeof($aFollowers['id']);
			$array = mostrarPaginadoPeople($iCantTotal,$page,$iCantSet,3); #$iCantTotal:cant Total;$page:pag actual;$cant:record visibles;1:tipo de Func
			list($paginado, $inicio) = $array; 
			$sSqlId =  implode("','", $aFollowers['id']);
			$aFolloweres = $SITE->getUsuarios(NULL, "id IN ('$sSqlId')". " AND ". $iEstado. " AND ".$iComplete,'registerDate DESC Limit '.$inicio.','.$iCantSet);
	
			
			$sPhoto='<span><a title="'.$_IDIOMA->traducir("Close").'"  onclick="$('."'".'#modules'."'".').show();$('."'".'#results'."'".').fadeOut('."'".'slow'."'".'); $('."'".'#videoPlayer'."'".').hide();$('."'".'#wall'."'".').fadeIn();$('."'".'#wall'."'".').fadeIn();" href="javascript:;">'.$_IDIOMA->traducir("Close").': </a></span>
				<h2>'.$_IDIOMA->traducir("Following").': </h2>
				<ul id="condition"><li></li></ul>';
			foreach($aFolloweres as $aFollower){
				
				/////Move the img to center thumb//////////
				$aImPhoto=array();
				$aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aFollower['photo']);
								    
				if($aImPhoto[0]>50){
					$moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
				}else{
				     $moveLeft='';
				}
								    
								    
				if($aImPhoto[1]>50){
				     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
				}else{
				     $moveTop='';
				}
								
				 #dayOfBirthDay
				 if(!empty($aFollower['dayOfBirthDay'])){
				   $brd=explode('-',$aFollower['dayOfBirthDay']);
				   #$sEdad='('.edad($aFollower['dayOfBirthDay']).')';
				  }else{
				   $brd[0]=''; $brd[1]=''; $brd[2]='';      
				  }
				#Country  
				$sCountry=$aFollower['countryName'];
				
				$sPhoto.='<div class="itemResult" onclick="location.href=\'/'.$_IDIOMA->traducir("user")."/".$aFollower["id"]."-".Utilidades::normalizarTexto($aFollower["name"]." ".$aFollower["lastName"]).'\'"  onmouseover="subir('.$aFollower['id'].');" onmouseout="bajar('.$aFollower['id'].');">
					  <div id="imagen'.$aFollower['id'].'"  style="height:190px; overflow:hidden;">
								<img '.$moveLeft.' title="'.$aFollower['name'].'" src="photoGeneral/big/'.$aFollower['photo'].'">
							</div>
							<h4>'.$aFollower['name'].'</h4>
								<ul>
								<li>'.nameProfile($aFollower['profileId']).'</li>
								<li>'.$sCountry.'</li>
								<li> BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>
								
							</ul>
						 </div>';
				
			}#for
			#escribe link del paginator
			$sPhoto.=$paginado;
		}
	}else{#user visit
		if(isset($_SESSION["idUserVisiting"])){
			$iIdVisit=(int)$_SESSION["idUserVisiting"];
			$aFollowers=$oFollower->getHistoryFollower($iIdVisit);#todos los  followers
			#paginator
			$iCantTotal=sizeof($aFollowers['id']);
			$array = mostrarPaginadoPeople($iCantTotal,$page,$iCantSet,3); 
			list($paginado, $inicio) = $array; 
			$sSqlId =  implode("','", $aFollowers['id']);
			$aFolloweres = $SITE->getUsuarios(NULL, "id IN ('$sSqlId')". " AND ". $iEstado. " AND ".$iComplete,'registerDate DESC Limit '.$inicio.','.$iCantSet);			

			
			$sPhoto='<span><a title="'.$_IDIOMA->traducir("Close").'"   onclick="$('."'".'#modules'."'".').show();$('."'".'#results'."'".').fadeOut('."'".'slow'."'".'); $('."'".'#videoPlayer'."'".').hide();" href="javascript:;">'.$_IDIOMA->traducir("Close").': </a></span>
				<h2>'.$_IDIOMA->traducir("Following").': </h2>
				<ul id="condition"><li></li></ul>';
			foreach($aFolloweres as $aFollower){
				////Move the img to center thumb//////////
				$aImPhoto=array();
				$aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aFollower['photo']);
								    
				if($aImPhoto[0]>50){
					$moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
				}else{
				     $moveLeft='';
				}
								    
								    
				if($aImPhoto[1]>50){
				     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
				}else{
				     $moveTop='';
				}
				 
				
				#dayOfBirthDay
				 if(!empty($aFollower['dayOfBirthDay'])){
				   $brd=explode('-',$aFollower['dayOfBirthDay']);
				   #$sEdad='('.edad($aFollower['dayOfBirthDay']).')';
				  }else{
				   $brd[0]=''; $brd[1]=''; $brd[2]='';      
				  }
				#Country  
				$sCountry=$aFollower['countryName'];	
				$sPhoto.='<div class="itemResult" onclick="location.href=\'/'.$_IDIOMA->traducir("user")."/".$aFollower["id"]."-".Utilidades::normalizarTexto($aFollower["name"]." ".$aFollower["lastName"]).'\'"  onmouseover="subir('.$aFollower['id'].');" onmouseout="bajar('.$aFollower['id'].');">
					  <div id="imagen'.$aFollower['id'].'"  style="height:190px; overflow:hidden;">
								<img '.$moveLeft.' title="'.$aFollower['name'].'" src="photoGeneral/big/'.$aFollower['photo'].'">
							</div>
							<h4>'.$aFollower['name'].'</h4>
								<ul>
								<li>'.nameProfile($aFollower['profileId']).'</li>
								<li>'.$sCountry.'</li>
								<li> BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>
							
							</ul>
						 </div>';
				
				}#for
				#escribe link del paginator
				$sPhoto.=$paginado;
		}#if	
	}#else
	$oRespuestaF->script("$('#results').css('height','1375px');");
	$oRespuestaF->script("$('#centralcolumn').css('min-height','1400px');");
   	$oRespuestaF->script("$('#modules').hide();");
    	$oRespuestaF->script("$('#wall').hide();");
	$oRespuestaF->assign("results", "innerHTML", $sPhoto);
	$oRespuestaF->script("$('#results').fadeIn();");

	return $oRespuestaF;
	
}#getAllFollower

#Muestra todos my Following
function getMyFollowing($iPagActual)
{



	$oRespuestaF = new xajaxResponse();
	global  $Follower;
	$Follower = new PeopleNet();	
	$aFollowers=Array();
	#Users 
	global $SITE; 
	global $_IDIOMA;
	$SITE        = new SITE();
	$iEstado     ='active=1';
	$iComplete   ='complete=1';
	$iDestacado  ='destacado=1';
	
	global $_IDIOMA;
	
	#Paginator
	if(isset($iPagActual)){
	  $page=$iPagActual;
	}else $page=1;
	#$iCantTotal=sizeof($Follower->getHistoryFollowing($iIdUSer)));#cant total Destac
	$iCantSet=15;#cant de record x page


	if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 || $_SESSION["idUserVisiting"]==$_SESSION["iSMuIdKey"]){#esta activo el USER ppal!
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUSer=(int)$_SESSION["iSMuIdKey"];
			$aFollowers=$Follower->getHistoryFollowing($iIdUSer);#get all Followers del user

			#paginator
			$iCantTotal=sizeof($aFollowers['id']);
			$array = mostrarPaginadoPeople($iCantTotal,$page,$iCantSet,2); #$iCantTotal:cant Total;$page:pag actual;$cant:record visibles;1:tipo de Func
			list($paginado, $inicio) = $array; 
			$sSqlId =  implode("','", $aFollowers['id']);
			$aFolloweres = $SITE->getUsuarios(NULL, "id IN ('$sSqlId')". " AND ". $iEstado. " AND ".$iComplete,'registerDate DESC Limit '.$inicio.','.$iCantSet);

			#Photos: 
			$sPhoto='<span><a title="'.$_IDIOMA->traducir("Close").'"  onclick="$('."'".'#modules'."'".').show();$('."'".'#results'."'".').fadeOut('."'".'slow'."'".'); $('."'".'#videoPlayer'."'".').hide();$('."'".'#wall'."'".').fadeIn();$('."'".'#wall'."'".').fadeIn();" href="javascript:;">'.$_IDIOMA->traducir("Close").': </a></span>
				<h2>'.$_IDIOMA->traducir("Friends").': </h2>
				<ul id="condition"><li></li></ul>';
			foreach($aFolloweres as $aFollower){
			////Move the img to center thumb//////////
				$aImPhoto=array();
				$aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aFollower['photo']);
								    
				if($aImPhoto[0]>50){
					$moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
				}else{
				     $moveLeft='';
				}
								    
								    
				if($aImPhoto[1]>50){
				     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
				}else{
				     $moveTop='';
				}
				 
				
				#dayOfBirthDay
				 if(!empty($aFollower['dayOfBirthDay'])){
				   $brd=explode('-',$aFollower['dayOfBirthDay']);
				   #$sEdad='('.edad($aFollower['dayOfBirthDay']).')';
				  }else{
				   $brd[0]=''; $brd[1]=''; $brd[2]='';      
				  }
				#Country  
				$sCountry=$aFollower['countryName'];	
				$sPhoto.='<div class="itemResult" onclick="location.href=\'/'.$_IDIOMA->traducir("user")."/".$aFollower["id"]."-".Utilidades::normalizarTexto($aFollower["name"]." ".$aFollower["lastName"]).'\'"  onmouseover="subir('.$aFollower['id'].');" onmouseout="bajar('.$aFollower['id'].');">
					  <div id="imagen'.$aFollower['id'].'"  style="height:190px; overflow:hidden;">
								<img '.$moveLeft.' title="'.$aFollower['name'].'" src="photoGeneral/big/'.$aFollower['photo'].'">
							</div>
							<h4>'.$aFollower['name'].'</h4>
								<ul>
								<li>'.nameProfile($aFollower['profileId']).'</li>
								<li>'.$sCountry.'</li>
								<li> BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>
							
							</ul>
						 </div>';
				
			}#for
			#escribe link del paginator
			$sPhoto.=$paginado;
		}

	}else{#user visit
		
			if(isset($_SESSION["idUserVisiting"])){
				
				$iIdVisit=(int)$_SESSION["idUserVisiting"];
				$aFollowers=$Follower->getHistoryFollowing($iIdVisit);
				
				#paginator
				$iCantTotal=sizeof($aFollowers['id']);
				$array = mostrarPaginadoPeople($iCantTotal,$page,$iCantSet,2); 
				list($paginado, $inicio) = $array; 
				$sSqlId =  implode("','", $aFollowers['id']);
				$aFolloweres = $SITE->getUsuarios(NULL, "id IN ('$sSqlId')". " AND ". $iEstado. " AND ".$iComplete,'registerDate DESC Limit '.$inicio.','.$iCantSet);

				
				#Photos';
				$sPhoto='<span><a title="'.$_IDIOMA->traducir("Close").'"   onclick="$('."'".'#modules'."'".').show();$('."'".'#results'."'".').fadeOut('."'".'slow'."'".'); $('."'".'#videoPlayer'."'".').hide();" href="javascript:;">'.$_IDIOMA->traducir("Close").': </a></span>
				<h2>'.$_IDIOMA->traducir("Friends").': </h2>
				<ul id="condition"><li></li></ul>';
				foreach($aFolloweres as $aFollower){
					////Move the img to center thumb//////////
					$aImPhoto=array();
					$aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aFollower['photo']);
									    
					if($aImPhoto[0]>50){
						$moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
					}else{
					     $moveLeft='';
					}
									    
									    
					if($aImPhoto[1]>50){
					     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
					}else{
					     $moveTop='';
					}
					 
				
					#dayOfBirthDay
					 if(!empty($aFollower['dayOfBirthDay'])){
					   $brd=explode('-',$aFollower['dayOfBirthDay']);
					   #$sEdad='('.edad($aFollower['dayOfBirthDay']).')';
					  }else{
					   $brd[0]=''; $brd[1]=''; $brd[2]='';      
					  }
					#Country  
					$sCountry=$aFollower['countryName'];	
					$sPhoto.='<div class="itemResult" onclick="location.href=\'/'.$_IDIOMA->traducir("user")."/".$aFollower["id"]."-".Utilidades::normalizarTexto($aFollower["name"]." ".$aFollower["lastName"]).'\'"  onmouseover="subir('.$aFollower['id'].');" onmouseout="bajar('.$aFollower['id'].');">
						  <div id="imagen'.$aFollower['id'].'"  style="height:190px; overflow:hidden;">
									<img '.$moveLeft.' title="'.$aFollower['name'].'" src="photoGeneral/big/'.$aFollower['photo'].'">
								</div>
								<h4>'.$aFollower['name'].'</h4>
									<ul>
									<li>'.nameProfile($aFollower['profileId']).'</li>
									<li>'.$sCountry.'</li>
									<li> BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>
							
								</ul>
							 </div>';
				
				}#for
				#escribe link del paginator
				#echo $paginado;die();
				$sPhoto.=$paginado;
			}#if
	}#else
	$oRespuestaF->script("$('#results').css('height','1375px');");
	$oRespuestaF->script("$('#centralcolumn').css('min-height','1400px');");
	$oRespuestaF->script("$('#modules').hide();");
	$oRespuestaF->script("$('#wall').hide();");
	$oRespuestaF->assign("results", "innerHTML", $sPhoto);
	$oRespuestaF->script("$('#results').fadeIn();");

	return $oRespuestaF;	
}#getMyFollowing

#mostrar user Ppal
function setUser(){
	$oRespuesta = new xajaxResponse();
	
	if(isset($_SESSION["idUserVisiting"])){
		$_SESSION["idUserVisiting"]=0;
		$_SESSION["idProfileVisiting"]=0;
	}
		
		
	$_SESSION["editProfile"]=false;
	$oRespuesta->call('JS_homeUserFollower');
	
	return $oRespuesta;
}


#Logout
function logout(){
		$oRespuesta = new xajaxResponse();
		$_SESSION = array();
		// destruirla
		session_destroy();
		$oRespuesta->call('JS_indexUser');
	
		return $oRespuesta;
}



#Edit Profile
function editProfile(){
		$oRespuesta = new xajaxResponse();
		$_SESSION["editProfile"]=true;
		$oRespuesta->call('JS_homeUserFollower');	
	
		return $oRespuesta;
}



#Quit Edit Profile
function quitEdit(){
		$oRespuesta = new xajaxResponse();
		$_SESSION["editProfile"]=false;
		$oRespuesta->call('JS_homeUserFollower');	
	
		return $oRespuesta;
}



#Add visit Latest people
function addVisitlatestPeople($idVisit){
	
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUSer=(int)$_SESSION["iSMuIdKey"];
			if(isset($idVisit)){
				$idVisit=(int)$idVisit;
				$oRespuesta = new xajaxResponse();
				global  $LPEOPLE;
				$LPEOPLE = new PeopleNet();	
				$bResult=$LPEOPLE->agregarVisit($iIdUSer,$idVisit);

				return $oRespuesta;
			}
		}
}



#Mostrar Destacados & My Follower
function setLatestPeople(){
	
		$oRespuesta = new xajaxResponse();
		if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 ){#esta activo el USER ppal!
	
			if(isset($_SESSION["iSMuIdKey"])){
				$iIdUser		=(int)$_SESSION["iSMuIdKey"];
				global  $LPEOPLE;
				$LPEOPLE 		= new PeopleNet();	
				$aLatestPeople	= Array();
				$aFollowers		= Array();
				
				
				#Users Destacados
				global $SITE; 
				$SITE 			= new SITE();
				$iEstado		='active=1';
				$iComplete		='complete=1';
				$iDestacado		='destacado=1';
				global $_IDIOMA;
				#traer los users solamente, q esten activos y completos: active=1 y complete=1
				$aDestacados 	= $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ". $iEstado. " AND ".$iComplete. " AND ".$iDestacado,'registerDate DESC');
				$aRandDestacados = array_rand($aDestacados,18);
				$sSqlId =  implode("','", $aRandDestacados);
				$aDestacados = $SITE->getUsuarios(NULL, "id IN ('$sSqlId')");
				#print_r($aDestacados);die();
				global $_IDIOMA;
				$sPhoto='<p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllFeatured(1);">'.$_IDIOMA->traducir("Featured Profiles").'</a> </p>
			  				<img class="posBreak" src="img/break.png" width="200" height="3" />    <ul>';
						
				#$i=0;
				foreach($aDestacados as $aDestacado){
					
					   //////Move the img to center thumb//////////
					    $aImPhoto=array();
					    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aDestacado['photo']);
					    
					    if($aImPhoto[0]>50){
					     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
					    }else{
					     $moveLeft='';
					    }
					    
					    
					    if($aImPhoto[1]>50){
					     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
					    }else{
					     $moveTop='';
					    }
				
					    $sPhoto.='<li><div class="imgProfileBorder" style="overflow:hidden;">
							<a href="/'.$_IDIOMA->traducir("user")."/".$aDestacado["id"]."-".Utilidades::normalizarTexto($aDestacado["name"]." ".$aDestacado["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'" title="'.utf8_encode($aDestacado['name']).'">		   	   <img src="photoGeneral/small/small_'.$aDestacado['photo'].'"  />
					   		</a></div>
						       </li>';

				}#for
			
	
				$sPhoto.='</ul>';
				$oRespuesta->assign("latestPeople", "innerHTML", $sPhoto);
				
				/* ***** BEGIN:Last register ***** */
				$aLastRegisteredes= $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ". $iEstado. " AND ".$iComplete,'id DESC Limit 0,9');

				$sPhoto='<p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllLatestRegistered(1);">'.$_IDIOMA->traducir("Latest Members").'</a> </p>
			  				<img class="posBreak" src="img/break.png" width="200" height="3" />    <ul>';
				foreach($aLastRegisteredes as $aLastRegistered){
					
					   //////Move the img to center thumb//////////
					    $aImPhoto=array();
					    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aLastRegistered['photo']);
					    
					    if($aImPhoto[0]>50){
					     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
					    }else{
					     $moveLeft='';
					    }
					    
					    
					    if($aImPhoto[1]>50){
					     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
					    }else{
					     $moveTop='';
					    }
				
					    $sPhoto.='<li><div class="imgProfileBorder" style="overflow:hidden;">
							<a href="/'.$_IDIOMA->traducir("user")."/".$aLastRegistered["id"]."-".Utilidades::normalizarTexto($aLastRegistered["name"]." ".$aLastRegistered["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'" title="'.utf8_encode($aLastRegistered['name']).'">		
							   	   <img src="photoGeneral/small/small_'.$aLastRegistered['photo'].'"  />
					   		</a></div>
						       </li>';

				}#for
			
	
				$sPhoto.='</ul>';
				$oRespuesta->assign("lastRegistered", "innerHTML", $sPhoto);
				
				
				/*  ***** END:Last register ***** */
				
				$aFollowers=$LPEOPLE->getHistoryFollowing($iIdUser);#todos los  followers
				#Cant de Followeres
				$iCantTotal=sizeof($aFollowers['id']);
				$aFollowers=$LPEOPLE->getAllFollowing($iIdUser);#set the last Follower
				global $_IDIOMA;
				$sIdioma=$_IDIOMA->traducir("View All"); 
				$sDivCant='<p class="onright paddingLC" original-title="">'.$iCantTotal.' <span original-title="" id="clickFllwr" onclick="JS_getMyFollowing(1); return false;" class=" paddingLC cursor">'. $sIdioma.'</span> </p>';

				$sPhotoF='<ul>';
				#print_r($aFollowers);
				for($i=0;$i<sizeof($aFollowers['id']);$i++){
					if($aFollowers['id'][$i]!=0){
						$idF=$aFollowers['id'][$i];
						$aFollowerData = $SITE->getUsuario(NULL, "id='$idF'");	
					   //////Move the img to center thumb//////////
					    $aImPhoto=array();
					    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aFollowerData['photo']);
					    
					    if($aImPhoto[0]>50){
					     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
					    }else{
					     $moveLeft='';
					    }
					    
					    
					    if($aImPhoto[1]>50){
					     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
					    }else{
					     $moveTop='';
					    }
					    
		                            $sPhotoF.='<li>
							<div class="imgProfileBorder" style="overflow:hidden;">
							<a href="/'.$_IDIOMA->traducir("user")."/".$aFollowerData["id"]."-".Utilidades::normalizarTexto($aFollowerData["name"]." ".$aFollowerData["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'"   title="'.$aFollowerData['name'].'">		   	
					   			<img src="photoGeneral/small/small_'.$aFollowerData["photo"].'"  />
							</a></div>
							</li>  ';
					}
				}#for
	
				$sPhotoF.='</ul>';
				$oRespuesta->assign("ffCant", "innerHTML", $sDivCant);
				$oRespuesta->assign("followerContent", "innerHTML", $sPhotoF);
	
			
			
			}#IF::$_SESSION["iSMuIdKey"]
	
		}else{#esta activo el user visitante!
				if(isset($_SESSION["idUserVisiting"])){
					$iIdUser		=(int)$_SESSION["iSMuIdKey"];
					$iIdVisit		=(int)$_SESSION["idUserVisiting"];
					global  $LPEOPLE;
					$LPEOPLE 		= new PeopleNet();	
					$aLatestPeople	= Array();
					$aFollowers		= Array();
				
					#Destacados
					global $SITE; 
					$SITE 			= new SITE();
					$iEstado		='active=1';
					$iComplete		='complete=1';
					$iDestacado		='destacado=1';
					
					global $_IDIOMA;
					
					#traer los users solamente, q esten activos y completos: active=1 y complete=1
					$aDestacados = $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ". $iEstado. " AND ".$iComplete. " AND ".$iDestacado,'registerDate DESC');
					$aRandDestacados = array_rand($aDestacados,18);
					$sSqlId =  implode("','", $aRandDestacados);
					$aDestacados = $SITE->getUsuarios(NULL, "id IN ('$sSqlId')");
					global $_IDIOMA;
					$sPhoto='<p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllFeatured(1);">'.$_IDIOMA->traducir("Featured Profiles").'</a> </p>
				  				<img class="posBreak" src="img/break.png" width="200" height="3" />    <ul>';
					#$i=0;

					foreach($aDestacados as $aDestacado){
						#if($i<9){
							
						   //////Move the img to center thumb//////////
						    $aImPhoto=array();
						    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aDestacado['photo']);
						    
						    if($aImPhoto[0]>50){
						     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
						    }else{
						     $moveLeft='';
						    }
						    
						    
						    if($aImPhoto[1]>50){
						     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
						    }else{
						     $moveTop='';
						    }
					
						    $sPhoto.='<li><div class="imgProfileBorder" style="overflow:hidden;">
								<a href="/'.$_IDIOMA->traducir("user")."/".$aDestacado["id"]."-".Utilidades::normalizarTexto($aDestacado["name"]." ".$aDestacado["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'" title="'.$aDestacado['name'].'">		   	   <img src="photoGeneral/small/small_'.$aDestacado['photo'].'"  />
						   		</a></div>
							       </li>';
						#}
						#$i++;
					}#for
					
					$sPhoto.='</ul>';
					$oRespuesta->assign("latestPeople", "innerHTML", $sPhoto);
					/* ***** BEGIN:Last register ***** */
					$aLastRegisteredes= $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ". $iEstado. " AND ".$iComplete,'id DESC Limit 0,9');
					$sPhoto='<p class="greyTitles paddingRC">
							<a href="javascript:;" onClick="JS_getAllLatestRegistered(1);">'.$_IDIOMA->traducir("Latest Members").' </a></p>
				  				<img class="posBreak" src="img/break.png" width="200" height="3" />    <ul>';
					foreach($aLastRegisteredes as $aLastRegistered){
					
						   //////Move the img to center thumb//////////
						    $aImPhoto=array();
						    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aLastRegistered['photo']);
						    
						    if($aImPhoto[0]>50){
						     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
						    }else{
						     $moveLeft='';
						    }
						    
						    
						    if($aImPhoto[1]>50){
						     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
						    }else{
						     $moveTop='';
						    }
				
						    $sPhoto.='<li><div class="imgProfileBorder" style="overflow:hidden;">
								<a href="/'.$_IDIOMA->traducir("user")."/".$aLastRegistered["id"]."-".Utilidades::normalizarTexto($aLastRegistered["name"]." ".$aLastRegistered["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'" title="'.utf8_encode($aLastRegistered['name']).'">		
								   	   <img src="photoGeneral/small/small_'.$aLastRegistered['photo'].'"  />
						   		</a></div>
							       </li>';

					}#for
			
	
					$sPhoto.='</ul>';
					$oRespuesta->assign("lastRegistered", "innerHTML", $sPhoto);
				
				
					/* ***** END:Last register ***** */


					#set the last Follower
					$aFollowers=$LPEOPLE->getHistoryFollowing($iIdVisit);#todos los  followers
			
					#Cant de Followeres
					$iCantTotal=sizeof($aFollowers['id']);
					$aFollowers=$LPEOPLE->getAllFollowing($iIdVisit);
					$sDivCant='<p class="onright paddingLC" original-title="">'.$iCantTotal.' <span original-title="" id="clickFllwr" onclick="JS_getMyFollowing(1); return false;" class=" paddingLC cursor">   '.$_IDIOMA->traducir("View All").'</span> </p>';
					$sPhotoF=' <ul>';
		
					for($i=0;$i<sizeof($aFollowers['id']);$i++){
						if($aFollowers['id'][$i]!=0 ){
						    $idF=$aFollowers['id'][$i];
						    $aFollowerData = $SITE->getUsuario(NULL, "id='$idF'");	
						    $aImPhoto=array();
						    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aFollowerData["photo"]);
						    
						    if($aImPhoto[0]>50){
						     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
						    }else{
						     $moveLeft='';
						    }
						    
						    
						    if($aImPhoto[1]>50){
						     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
						    }else{
						     $moveTop='';
						    }
						    
			                            $sPhotoF.='<li>
								<div class="imgProfileBorder" style="overflow:hidden;">
								<a href="/'.$_IDIOMA->traducir("user")."/".$aFollowerData["id"]."-".Utilidades::normalizarTexto($aFollowerData["name"]." ".$aFollowerData["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'"   title="'.utf8_encode($aFollowerData['name']).'">		   	
						   			<img src="photoGeneral/small/small_'.$aFollowerData["photo"].'"  />
								</a></div>
								</li>  ';




						}	
					}#for
		
					$sPhotoF.='</ul>';
					$oRespuesta->assign("ffCant", "innerHTML", $sDivCant);
					$oRespuesta->assign("followerContent", "innerHTML", $sPhotoF);
				}
		
		}#else
	
	
	
		return $oRespuesta;
}#setLatestPeople


#Account
function getAccount(){
		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			global   $SITE;
			$SITE    	= new SITE();
			$aUsuario	= Array();		
			$iUserIdSM	= $_SESSION["iSMuIdKey"];	
			$aUsuario 	= $SITE->getUsuario(NULL, "id='$iUserIdSM'");
			$sName		= $aUsuario['name'];
			$sLastName	= $aUsuario['lastName'];
			$sEmail		= $aUsuario['email'];
			global $_IDIOMA;
			$sForm='    <div id="closing" title="'.$_IDIOMA->traducir("Close").'"></div> 

					<h2 id="pdH2">Personal Data Saved</h2>
					  
				  
					  <div>
					    <label id="labName" class="label" for="firstName">'.$_IDIOMA->traducir("First Name").':</label>
					    <label id="getName" class="" for="getName">'.$sName.'</label>
					  </div>
					  
					  
					  <div>
					    <label id="labSurname" class="label" for="lastName">'.$_IDIOMA->traducir("Last Name").':</label>
					    <label id="getLastName" class="" for="getLastName">'.$sLastName.'</label>
					  </div>
					  
					  <div>
					    <label id="labMail" class="label" for="emailUser">'.$_IDIOMA->traducir("Email").':</label>
					    <label id="getEmail" class="" for="getEmail">'.$sEmail.'</label>
					  </div>
						    
					  <div>
					    <label id="labMail" class="label" for="emailUser">
					    '.$_IDIOMA->traducir("Check your E-mail, your new data was correctly sent").'.</label>
					   
					  </div>
				

					 <script type="text/javascript">
					 	$(document).ready(function(){
						   
						    $('."'".'#closing'."'".').tipsy({gravity:'."'".'w'."'".'});

						    $('."'".'#closing'."'".').click(function(){
						    						 $('."'".'#results'."'".').fadeOut(); 														 
						    });
						 });
					</script>

			';
			$oRespuesta->assign("results", "innerHTML", $sForm);
			$oRespuesta->script("$('#results').fadeIn();");
		
		}
		return $oRespuesta;
}#getAccount

#Set Email Notification
function setEmailPrivacy($aForm){
	$oRespuesta = new xajaxResponse();
	if(isset($_SESSION["iSMuIdKey"])){
			$iIdUser=$_SESSION["iSMuIdKey"];
			global   $SITE;
			$SITE    = new SITE();
			global $_IDIOMA;
			
			if($aForm['rad']==1){
				$sTipoPrivacy=1;
				$bPrivacy=$SITE->setEmailPrivacy($iIdUser,$sTipoPrivacy);
				
			}else{
				$sTipoPrivacy=0;
				$bPrivacy=$SITE->setEmailPrivacy($iIdUser,$sTipoPrivacy);
			}
	}
	$oRespuesta->assign("main", "innerHTML", '<h5>'.$_IDIOMA->traducir("EMAIL NOTIFICATIONS").'</h5> <h4>'.$_IDIOMA->traducir("Your email preferences were saved").'.</h4>');#msj de exito!
	return $oRespuesta;
}#setEmailPrivacy

#Update Data USer
function updateData($aForm){
		$oRespuesta = new xajaxResponse();
		$aErrores = array();
	
		#clear Error msj
		$oRespuesta->script("$('#error-update').fadeOut();");
		$oRespuesta->script("$('#emailNewUser').tipsy('hide');");
		$oRespuesta->script("$('#newUserPass').tipsy('hide');");
		$oRespuesta->script("$('#repeatEmail').tipsy('hide');");
		$oRespuesta->script("$('#repeatPass').tipsy('hide');");
		$oRespuesta->script("$('#newOldPass').tipsy('hide');");
		$oRespuesta->script("$('#newUserPass').tipsy('hide');");
		$oRespuesta->script("$('#repeatPass').tipsy('hide');");
	
		
	
		if(isset($_SESSION["iSMuIdKey"])){
			global   $SITE;
			$SITE    = new SITE();
			global $_IDIOMA;
			
			$aUsuario= Array();		
			$iUserIdSM= $_SESSION["iSMuIdKey"];	
			$aUsuario = $SITE->getUsuario(NULL, "id='$iUserIdSM'");
			$sName=$aUsuario['name'];
			$sLastName=$aUsuario['lastName'];
			$sNames=$sName.','.$sLastName;
			$sEmail=$aUsuario['email'];
			$sPass=$aUsuario['passwordUser'];
		
			# Validación del e-mail
			if (!empty($aForm['emailNewUser']) )
			{		
					if(!chekEmail($aForm['emailNewUser']))
					{
			     	  $aErrores['email1'] =  'E-mail invalid format';
					}
					else
					{
						  $email=$aForm['emailNewUser'];
						  if($SITE->getUsuario('email', "email='$email'"))#si el new email no este en la BD!!
						  {
				         $aErrores['email2'] = ''.$_IDIOMA->traducir("E-mail already exists").'';
						  }else{#debe comparar con el repeat email
						  	 #Compara los e-mail nuevos
							 if($aForm['emailNewUser']<>$aForm['repeatEmail'])
								$aErrores['repeatEmail'] = 'E-mail New is Different!';	
							else
								$bEmail=true;#kiere cambiar el email y todo esta OK!		
						  }
	
					}
			}else 		
				$bEmail=false;#no kiere cambiar el email

			#Password
			if(!empty($aForm['newOldPass'])){
			
				if($sPass!=md5($aForm['newOldPass'])){
					$aErrores['passwordUser'] =''.$_IDIOMA->traducir("Incorrect Old Password").'';
				}else{
					if (empty($aForm['newUserPass']))
					{
						$aErrores['passwordUser2'] =''.$_IDIOMA->traducir("New Password empty").'';
					}else{
						if($aForm['newUserPass']!=$aForm['repeatPass']){
							$aErrores['passwordUser3'] =''.$_IDIOMA->traducir("Different Password").'';
						}else{
						 	$bPass=true;	
						}
					}
				}
			}else{
			
				$bPass=false;#no kiere cambiar pass
			}	
			
			// Si hubo errores en el form se escribe	
			if (sizeof($aErrores) > 0)
			{
			
				$oRespuesta->assign("error-update", "innerHTML", ''.$_IDIOMA->traducir("Check the data fields").'');
				$oRespuesta->script("$('#error-update').fadeIn();");
	
				if (isset($aErrores['email1']))
				{
	
					$oRespuesta->script("$('#emailNewUser').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$_IDIOMA->traducir('E-mail invalid format')."'});");
					$oRespuesta->script("$('#emailNewUser').tipsy('show');");
					unset($aErrores['email1']);
				}
				if (isset($aErrores['email2']))
				{
	
					$oRespuesta->script("$('#emailNewUser').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$_IDIOMA->traducir('E-mail already exists')."'});");
					$oRespuesta->script("$('#emailNewUser').tipsy('show');");
					unset($aErrores['email2']);
				}
				/*if (isset($aErrores['email3']))
				{
					$oRespuesta->script("$('#emailNewUser').tipsy({ trigger: 'manual', gravity:'e', fallback:'E-mail address empty'});");
					$oRespuesta->script("$('#emailNewUser').tipsy('show');");
					unset($aErrores['email3']);
				}*/
			
				if (isset($aErrores['repeatEmail']))
				{
					$oRespuesta->script("$('#repeatEmail').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$_IDIOMA->traducir('E-mail is Different')."!'});");
					$oRespuesta->script("$('#repeatEmail').tipsy('show');");
					unset($aErrores['repeatEmail']);
				}
			
				if (isset($aErrores['passwordUser']))
				{
					$oRespuesta->script("$('#newOldPass').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$_IDIOMA->traducir('Incorrect Old Password')."'});");
					$oRespuesta->script("$('#newOldPass').tipsy('show');");
					unset($aErrores['passwordUser']);
				}	
				if (isset($aErrores['passwordUser2']))
				{
					$oRespuesta->script("$('#newUserPass').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$_IDIOMA->traducir('New Password empty')."'});");
					$oRespuesta->script("$('#newUserPass').tipsy('show');");
					unset($aErrores['passwordUse2r']);
				}
				if (isset($aErrores['passwordUser3']))
				{
					$oRespuesta->script("$('#repeatPass').tipsy({ trigger: 'manual', gravity:'e', fallback:'".$_IDIOMA->traducir('Different Password')."'});");
					$oRespuesta->script("$('#repeatPass').tipsy('show');");
					unset($aErrores['passwordUser3']);
				}	
			
			}#$aErrores
			else{#no hubo error =>modifico
			
	
				$aUpdate=Array();
				if($bEmail){$aUpdate['email']=$aForm['emailNewUser'];}
				if($bPass){$aUpdate['passwordUser']=md5($aForm['newUserPass']);}
				#cambia si esta puesto uno o el otro, o ambos
				if($bEmail || $bPass){
				
					if($aUserUdpate = $SITE->modificarUsuario($iUserIdSM, $aUpdate)){
					
						$sMsj='Could change your Personal Data:';
						if($bEmail){
							if($bPass){#si ademas cambio la pass envio los 2 new
							
								if(sendEmailUpdate($iUserIdSM,$sNames,$aForm['emailNewUser'],$aForm['newUserPass'],$sMsj)){
									$oRespuesta->assign("main", "innerHTML", '<h5>'.$_IDIOMA->traducir("ACCOUNT").'</h5> <h4>'.$_IDIOMA->traducir("An email was sent with your new data").'! <div>'.$_IDIOMA->traducir("Check your account email").', '.$aForm['emailNewUser'].'</div> </h4>');#msj de exito!
								}
							}else{#cambio solo el email
							
								$iPass='no';#q saber q no se envia el pass!
								if(sendEmailUpdate($iUserIdSM,$sNames,$aForm['emailNewUser'],$iPass,$sMsj)){
								$oRespuesta->assign("main", "innerHTML", '<h5>'.$_IDIOMA->traducir("ACCOUNT").'</h5> <h4>'.$_IDIOMA->traducir("An email was sent with your new data").'!
				  <div> '.$_IDIOMA->traducir("Check your email account").', '.$aForm['emailNewUser'].'</div> </h4>');#msj de exito!
								
								
								}
							}
							
						}else{#evidentemente modifico el passs!!!! sin cambiar email!!!
							$sPass=$aForm['newUserPass'];
									
							if(sendEmailUpdate($iUserIdSM,$sNames,$sEmail,$sPass,$sMsj)){
								$oRespuesta->assign("main", "innerHTML", '<h5>'.$_IDIOMA->traducir("ACCOUNT").'</h5> <h4>'.$_IDIOMA->traducir("An email was sent with your new data").'!
				  <div> Check your email account, '.$sEmail.'</div> </h4>');#msj de exito!
							}
						}
					
					
					}else{#no se pudo modificar, =>again el form
						$oRespuesta->assign("error-update", "innerHTML", ''.$_IDIOMA->traducir("Could not change the data. Please, try again").'');
						$oRespuesta->script("$('#error-update').fadeIn();");
					}
				}#$bEmail || $bPass
			}#else, no hubo error


		}#iSMuIdKey
	
		return $oRespuesta;
}#updateData

#send Email
function sendEmailUpdate($iUserIdSM,$sUserName,$sUserEmail,$Pass,$sMsj){
	
	    $aUsuario=Array();
	    $aUsuario['name']=$sUserName;
	    $aUsuario['msj']=$sMsj;

	     #Data Email p/ Admin
	     #1. id de usuario de soccermash
	     #2. * para todos los usuarios (con verificacion de permisos)
	     #3. algo@soccermash.com emails terminados en soccermash otros no se acepta
	     $prioridad="Sistema";
	     $asunto='Changes Personal Data';
	     $tipo="alguno";
		
		
		
	    if('no'!=$Pass){
	    	$aUsuario['email']=$sUserEmail;
	    	$aUsuario['password']=$Pass;
	    	$archivo='/templatemail/emailPersonalDataPass.tpl';
	    	if(QMail::add($tipo, $iUserIdSM, $asunto, $archivo, $aUsuario, $prioridad)){#solo cambio el pass
			return true;
		}
	    }else{
	    	$aUsuario['email']=$sUserEmail;
	    	$archivo='/templatemail/emailPersonalDataEmail.tpl';
	    	if(QMail::add($tipo, $iUserIdSM, $asunto, $archivo, $aUsuario, $prioridad)){#solo cambio el emails
			return true;
		}	
	    }
	    	
		return false;
		
}#sendEmailUpdate


#envio de msj a un user
function enviarMsj($aForm){

global $_IDIOMA;
		$oRespuesta = new xajaxResponse();

		if(isset($_SESSION["iSMuIdKey"]) && isset($_SESSION["idUserVisiting"])){
			$iIdUserSend=(int)$_SESSION["iSMuIdKey"];
			$iIdUserRecived=(int)$_SESSION["idUserVisiting"];
			global  $oMsj;
			$oMsj = new MessaggeSM();	
	
			$sMsj = $aForm['bodyMsg'];#txt escrito
			if($bAddMsj=$oMsj->agregarMsj($iIdUserSend,$iIdUserRecived,$sMsj)){
				$oRespuesta->assign("msgSender", "innerHTML", '<h2 id="emailTitle">'.$_IDIOMA->traducir("Message Sent").'! <span id=""></span></h2>');
			#Send Email
			#Data Email
			#1. id de usuario de soccermash
			#2. * para todos los usuarios (con verificacion de permisos)
			#3. algo@soccermash.com emails terminados en soccermash otros no se acepta
			global   		$SITE;
			$SITE   		= new SITE();
			$aUsuario		= Array();		
			$aUserRecived 	= $SITE->getUsuario(NULL, "id='$iIdUserRecived'");
			$aUsuario		= $SITE->getUsuario(NULL, "id='$iIdUserSend'");
			$aUserRecived['nameSent'] =	$aUsuario['name'];
			#$aUserRecived['msj'] =	 $aForm['bodyMsg'];#el msj q escribio q este en el email
			
			$prioridad		= "Sistema";
			$asunto			= 'New Private Message at SOCCERMASH.com';
			$tipo			= "alguno";
			$archivo		= '/templatemail/emailNewMsjPrivate.tpl';
			
			
			if(QMail::add($tipo, $iIdUserRecived, $asunto, $archivo, $aUserRecived, $prioridad)){
				return $oRespuesta;
			}
				
			}#agregarMsj
			else{
				$oRespuesta->assign("msgSender", "innerHTML", '<h2 id="emailTitle">'.$_IDIOMA->traducir("Could not Send Message").'!!<span id=""></span></h2>');
			}			
		}


		return $oRespuesta;
}#enviarMsj


#escribe la cant de msj de un user
function cantMsj(){

		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUserSend=(int)$_SESSION["iSMuIdKey"];
		
			global  $oMsj;
			$oMsj = new MessaggeSM();
			$aCantMsj=$oMsj->checkRecibidos($iIdUserSend);#cant de msj
			if(sizeof($aCantMsj)>0){
				$_SESSION["cantMsj"]=sizeof($aCantMsj);
			}else{	$_SESSION["cantMsj"]=0;}

		}
			#$oRespuesta->assign("divalertMSG", "innerHTML",'<span id="alertMSG">'.$_SESSION["cantMsj"].'</span' );

		return $oRespuesta;
}#cantMsj

#descuenta el msj q lee el user::
function descMsj($aForm){
		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUserRecived=(int)$_SESSION["iSMuIdKey"];
			#Instance Msj
			global  $oMsj;
			$oMsj = new MessaggeSM();
			if(isset($aForm['TleyRcPkSpUuE'])){
				if($aForm['TleyRcPkSpUuE']=='msjo'){#si msj original::ax_sentMsj
					$iIdMsjSent=(int)$aForm['kleyDcSEJSud'];
					$bMSj=$oMsj->onCheck($iIdMsjSent);
				}else{#el msj es reply::ax_replyMsj
					$iIdMsjSent=(int)$aForm['kleyDcSEJSud'];
					$bMSj=$oMsj->onCheckReply($iIdMsjSent);	
				}
			}#isset2
			
			
		}#isset1

		return $oRespuesta;
		
}#desc

#envia la rta de un msj a un user
function enviarReplyMsj($aForm){
		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUserSend=(int)$_SESSION["iSMuIdKey"];
			#Instance Msj
			global  $oMsj;
			$oMsj = new MessaggeSM();
			#data p insetar en replyMsj

			$iIdUserReply	        =$iIdUserSend;#id msj original
			$iIdUserRta    		=$aForm['kleyRcEkSmUud'];#id user al q rta
			$iIdMsjSent    		=$aForm['kleyMcSkJmud'];#id msj
			$sTxtMsj    		=$aForm['bodyMsg2'];#id de user q recibe la rta
			$sDivReplyOut		=$aForm['divReply'];

			$aGetMsjs=$oMsj->agregarMsjRespuesta($iIdMsjSent,$iIdUserReply,$iIdUserRta,$sTxtMsj);#add msj de rta
			#debe dar algun msj de exito de envio de la rta, oculta la div de rta!!
			$oRespuesta->script("$('#$sDivReplyOut').fadeOut();");
	
			}else{	#$oRespuesta->script("$('#$sDivReplyOut').fadeOut();");}
		
		}
	

		return $oRespuesta;
}#enviarReplyMsj


#Report Error
function enviarError($aForm){
		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			global   	$SITE;global $_IDIOMA;
			$SITE   	= new SITE();
			$aUsuario	= Array();		
			$iUserIdSM	= $_SESSION["iSMuIdKey"];	
			$aUsuario 	= $SITE->getUsuario(NULL, "id='$iUserIdSM'");
			$aUsuario['msj']=$aForm['bodyError'];#msj del user;

			#Data Email
			#1. id de usuario de soccermash
			#2. * para todos los usuarios (con verificacion de permisos)
			#3. algo@soccermash.com emails terminados en soccermash otros no se acepta
			$prioridad="Sistema";
			$asunto='Report Error';
			$tipo="alguno";
			$usuario='support@soccermash.com';
			$archivo='/templatemail/emailReportError.tpl';
			
			
			if(QMail::add($tipo, $usuario, $asunto, $archivo, $aUsuario, $prioridad)){

				#Data Email p/ User
				$prioridad="Sistema";
				$asunto='Report Error';
				$tipo="alguno";
				$archivo='/templatemail/emailReportErrorReply.tpl';
				
				if(QMail::add($tipo, $iUserIdSM, $asunto, $archivo, $aUsuario, $prioridad)){
					$oRespuesta->script("$('#bodyError').val(' ');");
					$oRespuesta->assign("msjErrorReport", "innerHTML", '<h2 id="emailTitle">'.$_IDIOMA->traducir("You have reported an error. We will evaluate the case.
					Thanks for helping to improve your network!")	.'</h2>');
				}

			}else{#no se envio el email

				$oRespuesta->assign("msjErrorReport", "innerHTML", '<h2 id="emailTitle">'.$_IDIOMA->traducir(" Messagge not send. Please try again!").'</h2>');

			}
		
		}
	
		return $oRespuesta;
}#enviarError

#send Email Error
function sendEmailError($sUserName,$sUserEmail,$sMsjError,$sAdminEmail){

		$to = $sAdminEmail;
		$subject = "Report Error";
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf-8\n";
		$headers .= "Content-Transfer-Encoding: quoted-printable\n";
		$dDate = gmdate("Y-m-d", time());
		$body="Report error by: $sUserName  - $dDate\n\n ";
		    
		$body .= "User Data: \n\n";
		$body .= "Name: $sUserName \n\n";
		$body .= "E-mail: $sUserEmail \n\n";
		$body .= "Messagge: $sMsjError \n\n";
 	        $body = wordwrap($body, 70); 


		// Send E-mail a Admin
		if(mail($to, $subject, $body, $headers)){
		      //Send Email to user
		      $body='<html><body><center>
<table bgcolor="#FFFFFF" width="640" cellpadding="0" cellspacing="0" border="0" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; text-align: left;">
<tr>
<td>
<img src="http://www.soccermash.com/img/header_Email.png">
</td>	

</tr>
<tr>
	<td>
		<h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 28px; font-weight: bold; margin: 0 0 20px 0; border-bottom: 1px solid #CCCCCC;">
                soccermash</h1>
        </td>
</tr>
<tr>
	<td>3</td>
</tr>
		</table>
</center></body></html>';

		      $to= $sUserEmail;	
		      $subject = "Reply Report Error. SOCCERMASH.com‏";        
		      	
		      return mail($to, $subject, $body, $headers);// Send Reply E-mail a User
	

		}#if	
		
}#sendEmailError



/////////////Mostrar Paginado seba(V) People////////////////////////////
function mostrarPaginadoPeople($totalRegistros,$paginaActual,$limiteRegistros,$iFunction){
			
			global $_IDIOMA;
			
			if (!$paginaActual)
			{
				$inicio = 0;
				$paginaActual = 1;
			}
			else
			{
				$inicio = ($paginaActual - 1) * $limiteRegistros;
			}
		
			$totalPaginas = ceil($totalRegistros / $limiteRegistros);
			#select function
			if($iFunction==1){#tipo de function q llama
			  $sFuncion='JS_getAllFeatured';#get All Featured Profiles
			}else{
			  if($iFunction==2){
				 $sFuncion='JS_getMyFollowing';#get All Followers
			  }else{
			  	if($iFunction==3){
					$sFuncion='JS_getAllFollowers';#get All Following
			  	}else{
			  		if($iFunction==4){#get all online
						$sFuncion='JS_getAllOnline';#get All online
			  		}else{
			  			if($iFunction==5){
			  				$sFuncion='JS_getAllSugested';#get All Sugested
			  			}else
			  				$sFuncion='JS_getAllLatestRegistered';#get All Latest registered
			  		}
			  	}
			 }
			}

			$paginado='';
			if (($paginaActual - 1) > 0)
			{				
				$paginado .= '<span class="paginador"><a href="javascript:;" onclick="'. $sFuncion.'('.($paginaActual - 1).');">'.$_IDIOMA->traducir("previous").'</a></span>';

			}
			if (($paginaActual + 1) <= $totalPaginas)
			{

				$paginado .= '<span class="paginador"><a href="javascript:;" onclick="'. $sFuncion.'('.($paginaActual + 1).');">'.$_IDIOMA->traducir("more results").'</a></span>';

			}
		
			$array = array($paginado,$inicio);
			return $array;
}#mostrarPaginadoPeople



#get all festured profile
function getAllFeatured($iPagActual){
		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUSer=(int)$_SESSION["iSMuIdKey"];
			#Object Profile
			$oProfile= new Profile();	

			#Users Destacados
			global $SITE; 
			global $_IDIOMA;
			$SITE        = new SITE();
			$iEstado     ='active=1';
			$iComplete   ='complete=1';
			$iDestacado  ='destacado=1';
			#Paginator
			if(isset($iPagActual)){
				$page=$iPagActual;
			
			}else $page=1;

			$iCantTotal=sizeof($SITE->getUsuarios(NULL, "id!='$iIdUSer'". " AND ". $iEstado. " AND ".$iComplete. " AND ".$iDestacado));#cant total Destac
			$iCantSet=15;#cant de record x page
			$array = mostrarPaginadoPeople($iCantTotal,$page,$iCantSet,1); #$iCantTotal:cant Total;$page:pag actual;$cant:record visibles;1:tipo de Func
			list($paginado, $inicio) = $array; 
			#echo 'INI:'.$inicio;die();
			#traer los users solamente, q esten activos y completos: active=1 y complete=1
			$aDestacados = $SITE->getUsuarios(NULL, "id!='$iIdUSer'". " AND ". $iEstado. " AND ".$iComplete. " AND ".$iDestacado,'fecha_destacado desc,registerDate DESC Limit '.$inicio.','.$iCantSet);
			#$sPhoto= ' <script type="text/javascript"> $("#centralcolumn").css("min-height","1400px");</script>';

			$sPhoto='<span><a title="'.$_IDIOMA->traducir("Close").'"  onclick="$('."'".'#modules'."'".').show();$('."'".'#results'."'".').fadeOut('."'".'slow'."'".');
			 $('."'".'#videoPlayer'."'".').hide();$('."'".'#wall'."'".').fadeIn();$('."'".'#wall'."'".').fadeIn();" href="javascript:;">'.$_IDIOMA->traducir("Close").': </a></span>
				<h2>'.$_IDIOMA->traducir("Featured Profiles").': </h2>
				<ul id="condition"><li></li></ul>';
			
			foreach($aDestacados as $aDestacado){
				//////Move the img to center thumb//////////
				$aImPhoto=array();
				$aImPhoto=@getimagesize('../photoGeneral/big/'.$aDestacado['photo']);
					    
				 if($aImPhoto[0]>180){
				     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
				 }else{
				     $moveLeft='';
				 }
				 if($aImPhoto[1]>180){
				     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
				 }else{
				     $moveTop='';
			         }
				#dayOfBirthDay
				 if(!empty($aDestacado['dayOfBirthDay'])){
				   $brd=explode('-',$aDestacado['dayOfBirthDay']);
				   $sEdad='('.edad($aDestacado['dayOfBirthDay']).')';
				 }else{
				   $brd[0]=''; $brd[1]=''; $brd[2]='';      
				 }

				#Get Data Profesional
				 if($aDestacado['profileId']<7 && $aDestacado['profileId']>1){ #si es perfil player
        				#$sEdad='('.edad($aDestacado['dayOfBirthDay']).')';
        			 	$aPlayer=$oProfile->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$aDestacado['id'].""); 
					 if($aDestacado['profileId']==2){
					   	$ecDD='ECD: '.$aPlayer[0]->endingContractDate;
					 }else{ $ecDD  = 'BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0];}

					 if(!empty($aPlayer[0]->clubName)){#name club
						$sNameClub=$aPlayer[0]->clubName;					 
					
					 }else{
						 if(!empty($aPlayer[0]->otherClub))
							$sNameClub=$aPlayer[0]->otherClub;
						 else   $sNameClub='-';
					 }
					 if(!empty($aPlayer[0]->position))#position
					 	$posP  = namePosition($aPlayer[0]->position);
					 else   $posP  = '-';
					
					 #$posP  = 'player Pos';
					 $clubB = 'CLUB: '.$sNameClub;                  
				}else{#cualkier otro perfil
					 $sEdad = '';	
					 $ecDD  = 'BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0];
					 $clubB = $aDestacado['cityName'];
					 $posP  = '';
				}


				#write All Data

			$sPhoto.='<div class="itemResult" onclick="location.href=\'/'.$_IDIOMA->traducir("user")."/".$aDestacado["id"]."-".Utilidades::normalizarTexto($aDestacado["name"]." ".$aDestacado["lastName"]).'\'"  onmouseover="subir('.$aDestacado['id'].');" onmouseout="bajar('.$aDestacado['id'].');">
				  <div id="imagen'.$aDestacado['id'].'" style="height:190px; overflow:hidden;">
						<img  '.$moveLeft.'title="'.$aDestacado['name'].'" src="photoGeneral/big/'.$aDestacado['photo'].'">
						</div>
						<h4>'.$aDestacado['name'].' '.$aDestacado['lastName'].'</h4>
					<ul>
						<li>'.nameProfile($aDestacado['profileId']).'</li>
						<li>'.$ecDD.'</li>
						<li>'.$posP.'</li>
						<li>'.$clubB.'</li>
						
					</ul>
					 </div>';
			}#foreach
			#escribe link del paginator
			$sPhoto.=$paginado;
			$oRespuesta->script("$('#centralcolumn').css('min-height','1400px');");
			$oRespuesta->script("$('#modules').hide();");
			$oRespuesta->script("$('#wall').hide();");
			$oRespuesta->assign("results", "innerHTML", $sPhoto);
			$oRespuesta->script("$('#results').fadeIn();");
		}
		return $oRespuesta;
}#getAllFeatured


#get all sugested people
function getAllSugested($iPagActual){
global $_IDIOMA;
		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			global   		$SITE;
			$SITE   		= new SITE();
			$aUsuario		= Array();		
			$iUserIdSM		= $_SESSION["iSMuIdKey"];
			$iEstado    	= 'active=1';
			$iComplete      = 'complete=1';
			$iDestacado     = 'destacado=1';	
			$aUsuario 		= $SITE->getUsuario(NULL, "id='$iUserIdSM'");
			$iCountry  		= $aUsuario['countryId'];
			$iCity   		= $aUsuario['cityId'];
			
			if(!empty($iCity)){
				$aSugestedCity = $SITE->getUsuarios(NULL, "(id!='$iUserIdSM'". " AND "."cityId='$iCity')"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
				$i=0;
				foreach($aSugestedCity as $aSugested){
					$aIdPeoples[$i]=$aSugested['id'];$i++;
				}
				$sSqlId =  implode("','", $aIdPeoples);
				$aSugestedCountry = $SITE->getUsuarios(NULL, "id!='$iUserIdSM'". " AND id NOT IN ('$sSqlId')"." AND "."countryId='$iCountry'"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
				
				$aSugestedPeoples=array_merge($aSugestedCity,$aSugestedCountry);
				#print_r($aSugestedPeoples);die();
			}else{
				$aSugestedPeoples = $SITE->getUsuarios(NULL, "id!='$iUserIdSM'". " AND ". "countryId='$iCountry'"." AND ". $iEstado. " AND ".$iComplete,'registerDate DESC' );
			}
			#Paginator
			if(isset($iPagActual)){
				$page=$iPagActual;
			
			}else $page=1;
			
			$iCantTotal=sizeof($aSugestedPeoples);#cant total de SugestedPeoples
			$iCantSet=15;#cant de record x page
			$array = mostrarPaginadoPeople($iCantTotal,$page,$iCantSet,5); #$iCantTotal:cant Total;$page:pag actual;$cant:record visibles;5:tipo de Func
			list($paginado, $inicio) = $array;
			$i=0;
			foreach($aSugestedPeoples as $aSugested){
				$aIdPeoples[$i]=$aSugested['id'];$i++;
			}
			$sSqlId =  implode("','", $aIdPeoples);
			$aSugestedPeoples = $SITE->getUsuarios(NULL, "id!='$iUserIdSM'". " AND id IN ('$sSqlId')",'registerDate DESC Limit '.$inicio.','.$iCantSet );
			
			#Html
			$sPhoto='<span><a title="'.$_IDIOMA->traducir("Close").'"  onclick="$('."'".'#modules'."'".').show();$('."'".'#results'."'".').fadeOut('."'".'slow'."'".'); $('."'".'#videoPlayer'."'".').hide();$('."'".'#wall'."'".').fadeIn();$('."'".'#wall'."'".').fadeIn();" href="javascript:;">'.$_IDIOMA->traducir("Close").': </a></span>
				<h2>'.$_IDIOMA->traducir("Suggested People").' : </h2>
				<ul id="condition"><li></li></ul>';
			
					foreach($aSugestedPeoples as  $aSugestedPeople){
  
								    //////Move the img to center thumb//////////
								    $aImPhoto=array();
								    $aImPhoto=@getimagesize('../photoGeneral/big/'.$aSugestedPeople['photo']);
								    if($aImPhoto[0]>50){
								     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
								    }else{
								     $moveLeft='';
								    }
								    
								    
								    if($aImPhoto[1]>50){
								     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
								    }else{
								     $moveTop='';
								    }


								    #dayOfBirthDay
								    if(!empty($aSugestedPeople['dayOfBirthDay'])){
									   $brd=explode('-',$aSugestedPeople['dayOfBirthDay']);
									   $sEdad='('.edad($aSugestedPeople['dayOfBirthDay']).')';
								   }else{
									   $brd[0]=''; $brd[1]=''; $brd[2]='';      
								   }
								  $ecDD  = 'BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0];

								    $sPhoto.='<div class="itemResult" onclick="location.href=\'/'.$_IDIOMA->traducir("user")."/".$aSugestedPeople["id"]."-".Utilidades::normalizarTexto($aSugestedPeople["name"]." ".$aSugestedPeople["lastName"]).'\'" 
						 onmouseover="subir('.$aSugestedPeople['id'].');" onmouseout="bajar('.$aSugestedPeople['id'].');">
				  			<div id="imagen'.$aSugestedPeople['id'].'" style="height:190px; overflow:hidden;">
			  	   
								<img '.$moveLeft.'  title="'.$aSugestedPeople['name'].'" src="photoGeneral/big/'.$aSugestedPeople['photo'].'">
							</div>
								<h4>'.$aSugestedPeople['name'].' '.$aSugestedPeople['lastName'].'</h4>
							<ul>
								<li>'.nameProfile($aSugestedPeople['profileId']).'</li>
								<li>'.$ecDD.'</li>

							</ul>
							 </div>';	    

							
						
					}#foreach
			
			#escribe link del paginator
			$sPhoto.=$paginado;
			
			$oRespuesta->script("$('#centralcolumn').css('min-height','1400px');");
        		$oRespuesta->script("$('#modules').hide();");
        		$oRespuesta->script("$('#wall').hide();");
			$oRespuesta->assign("results", "innerHTML", $sPhoto);
			$oRespuesta->script("$('#results').fadeIn();");
		}
		return $oRespuesta;
}#getAllSugested

#get Who is online
function getWhoIsOnline(){
global $_IDIOMA;
		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			global   	$SITE;
			$SITE   	= new SITE();
			$aUsuario	= Array();		
			$iIdUser	= $_SESSION["iSMuIdKey"];
			global  $oFollower;
			$oFollower      = new PeopleNet();	
			$aFollowers     = Array();	
			#get all followeres
			$aFollowers=$oFollower->getHistoryFollower($iIdUser);#todos los  followers
			#followeres
			$aOnlineId  		= Array();
			$aOnlines    		= Array();
			$iEstado    	 	='active=1';
			$iComplete  		='complete=1';
			
			#print_r($aFollowers['id']);
			$sSqlId =  implode("','", $aFollowers['id']);
			$aFolloweres = $SITE->getUsuarios(NULL, "id IN ('$sSqlId')". " AND ". $iEstado. " AND ".$iComplete);
			$ahora = time ();
			$antes = $ahora - 5 * 60;#5min
			#Who is online??
			$i=0;
			foreach($aFolloweres as $aFollowerOnline){
				#tiempoUtlimaActividad
				 $tiempo = strtotime ( $aFollowerOnline['tiempoUtlimaActividad']);
				 if (($tiempo >= $antes) && ($tiempo <= $ahora)){
				 	#query con la tabla dnd estan los invisibles
					$id=$aFollowerOnline['id'];
				 	$aStatusUser=$SITE->statusUser("userid='$id'");
				 	if($aStatusUser['status']!="invisible"){
				 	    $aOnlineId[$i] = $aFollowerOnline['id'];#save ID user's online
					    $i++;
				 	}

				 } 
			}#for
			
			if(sizeof($aOnlineId)>0){#existen user online con mis following

				$sSqlId    =  implode("','", $aOnlineId);
				$aOnlines  =  $SITE->getUsuarios(NULL, "id IN ('$sSqlId')". " AND ". $iEstado. " AND ".$iComplete,'tiempoUtlimaActividad DESC');
			
			
			
				#write html
				$sPhotoOnline='<p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllOnline(1);">'.$_IDIOMA->traducir("Who's online").'</a> </p>
		                		<img class="posBreak" src="img/break.png" width="200" height="3" />
		                		<ul>';
				$i=0;
				foreach($aOnlines  as $aOnline){#mis following
					if($i<9){
						   //////Move the img to center thumb//////////
						    $aImPhoto=array();
						    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aOnlineId['photo']);
						    
						    if($aImPhoto[0]>50){
						     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
						    }else{
						     $moveLeft='';
						    }
						    
						    
						    if($aImPhoto[1]>50){
						     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
						    }else{
						     $moveTop='';
						    }
					
						    $sPhotoOnline.='<li><div class="imgProfileBorder" style="overflow:hidden;">
								<a href="/'.$_IDIOMA->traducir("user")."/".$aOnline["id"]."-".Utilidades::normalizarTexto($aOnline["name"]." ".$aOnline["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'" title="'.$aOnline['name'].'">		   	   <img src="photoGeneral/small/small_'.$aOnline['photo'].'"  />
						   		</a></div>
							       </li>';
						}
						$i++;
					
				}#foreach
				
				
				#$i tiene la cant total de user online
				if($i<9){#hay menos de 9--->completar los 9 c cualkier otro user online
					
					$sTime='tiempoUtlimaActividad IS NOT NULL AND tiempoUtlimaActividad!="0000-00-00 00:00:00"';
					#$aOtherOnlines = $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ".$sTime. " AND ". $iEstado. " AND ".$iComplete,'tiempoUtlimaActividad DESC');
					
					$sSqlId        =  implode("','", $aOnlineId);
					$aOtherOnlines = $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND id NOT IN('$sSqlId')"." AND ".$sTime. " AND ". $iEstado. " AND ".$iComplete,'tiempoUtlimaActividad DESC');
					
					#print_r($aOtherOnlines);
					foreach($aOtherOnlines as  $aOtherOnline){
						if($i<9){
							#tiempoUtlimaActividad
							 $tiempo = strtotime ( $aOtherOnline['tiempoUtlimaActividad']);
							 if (($tiempo >= $antes) && ($tiempo <= $ahora)){#tiempoUtlimaActividad
							 	#query con la tabla dnd estan los invisibles
								$id=$aOtherOnline['id'];
				 				$aStatusUser=$SITE->statusUser("userid='$id'");
				 				if($aStatusUser['status']!="invisible"){  
									//////Move the img to center thumb//////////
								    $aImPhoto=array();
								    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aOtherOnline['photo']);
								    
								    if($aImPhoto[0]>50){
								     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
								    }else{
								     $moveLeft='';
								    }
								    
								    
								    if($aImPhoto[1]>50){
								     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
								    }else{
								     $moveTop='';
								    }
							
								    $sPhotoOnline.='<li><div class="imgProfileBorder" style="overflow:hidden;">
										<a href="/'.$_IDIOMA->traducir("user")."/".$aOtherOnline["id"]."-".Utilidades::normalizarTexto($aOtherOnline["name"]." ".$aOtherOnline["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'" title="'.$aOtherOnline['name'].'">		   	   <img src="photoGeneral/small/small_'.$aOtherOnline['photo'].'"  />
								   		</a></div>
									       </li>';
								    $i++;
				 				}#$aStatusUser
							}#tiempoUtlimaActividad
							
						}# ya estan los 9
						else{
							break;
						}
					}#foreach
					
				}#($i<9)
				$sPhotoOnline.='</ul>';
				$oRespuesta->assign("whoIsOnline", "innerHTML", $sPhotoOnline);
			
			}else{#no hay ningun Follower online--->muestra 9 cualkiera
					#echo 'sin FF';die();
					#write html
					$sPhotoOnline='<p class="greyTitles paddingRC"><a href="javascript:;" onClick="JS_getAllOnline(1);">'.$_IDIOMA->traducir("Who's online").'</a> </p>
		                		<img class="posBreak" src="img/break.png" width="200" height="3" />
		                		<ul>';
					$i=0;
					$sTime='tiempoUtlimaActividad IS NOT NULL AND tiempoUtlimaActividad!="0000-00-00 00:00:00"';
					$aOtherOnlines = $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ".$sTime. " AND ". $iEstado. " AND ".$iComplete,'tiempoUtlimaActividad DESC');
				
					foreach($aOtherOnlines as  $aOtherOnline){
						if($i<9){
							#tiempoUtlimaActividad
							 $tiempo = strtotime ( $aOtherOnline['tiempoUtlimaActividad']);
							 if (($tiempo >= $antes) && ($tiempo <= $ahora)){#tiempoUtlimaActividad
							    $id=$aOtherOnline['id'];
				 			    $aStatusUser=$SITE->statusUser("userid='$id'");
				 			    if($aStatusUser['status']!="invisible"){ 	  
								    //////Move the img to center thumb//////////
								    $aImPhoto=array();
								    $aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aOtherOnline['photo']);
								    
								    if($aImPhoto[0]>50){
								     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
								    }else{
								     $moveLeft='';
								    }
								    
								    
								    if($aImPhoto[1]>50){
								     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
								    }else{
								     $moveTop='';
								    }
						
								    $sPhotoOnline.='<li><div class="imgProfileBorder" style="overflow:hidden;">
										<a href="/'.$_IDIOMA->traducir("user")."/".$aOtherOnline["id"]."-".Utilidades::normalizarTexto($aOtherOnline["name"]." ".$aOtherOnline["lastName"]).'" style="'.$moveLeft.' '.$moveTop.'" title="'.$aOtherOnline['name'].'" >		   	   <img src="photoGeneral/small/small_'.$aOtherOnline['photo'].'"  />
								   		</a></div>
									       </li>';
								    $i++;
							   }#$aStatusUser['status']	
							}#tiempoUtlimaActividad
							
						}# ya estan los 9
						else{break;}
					}#foreach
					
				$sPhotoOnline.='</ul>';
				$oRespuesta->assign("whoIsOnline", "innerHTML", $sPhotoOnline);
			}#else
			
			
		}#isset($_SESSION["iSMuIdKey"]

		return $oRespuesta;
}#getWhoIsOnline
	
#get All user online
function getAllOnline($iPagActual){
		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUser=(int)$_SESSION["iSMuIdKey"];
			#Object Profile
			$oProfile= new Profile();	

			#Users Destacados
			global $SITE; 
			global $_IDIOMA;
			$SITE        = new SITE();
			$iEstado     ='active=1';
			$iComplete   ='complete=1';
			$ahora = time ();
			$antes = $ahora - 5 * 60;#5min
			#Paginator
			if(isset($iPagActual)){
				$page=$iPagActual;
			
			}else $page=1;

			$sTime='tiempoUtlimaActividad IS NOT NULL AND tiempoUtlimaActividad!="0000-00-00 00:00:00"';
			$aOtherOnlines = $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ".$sTime. " AND ". $iEstado. " AND ".$iComplete,'tiempoUtlimaActividad DESC');

			$i=0; $aOnlineId=Array();
			foreach($aOtherOnlines as  $aOtherOnline){
				#tiempoUtlimaActividad
				$tiempo = strtotime ( $aOtherOnline['tiempoUtlimaActividad']);
				if (($tiempo >= $antes) && ($tiempo <= $ahora)){#tiempoUtlimaActividad
					    $id=$aOtherOnline['id'];
					    $aStatusUser=$SITE->statusUser("userid='$id'");
					    if($aStatusUser['status']!="invisible"){ 	
				 			$aOnlineId[$i] = $aOtherOnline['id'];#save ID user's online
					    	$i++;	    	
					    }	
				}
			}#foreach	

			$sSqlId    =  implode("','", $aOnlineId);
			$aOtherOnlines  =  $SITE->getUsuarios(NULL, "id!='$iIdUser'"."AND id IN ('$sSqlId')". " AND ". $iEstado. " AND ".$iComplete,'tiempoUtlimaActividad DESC');
			
					
			$iCantTotal=sizeof($aOtherOnlines);#cant total de online
			#echo 'cant Total'.$iCantTotal;
			$iCantSet=15;#cant de record x page
			$array = mostrarPaginadoPeople($iCantTotal,$page,$iCantSet,4); #$iCantTotal:cant Total;$page:pag actual;$cant:record visibles;4:tipo de Func
			list($paginado, $inicio) = $array; 
			$aOtherOnlines = $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ".$sTime. " AND ". $iEstado. " AND ".$iComplete,'tiempoUtlimaActividad DESC Limit '.$inicio.','.$iCantSet);

			$sPhoto='<span><a title="'.$_IDIOMA->traducir("Close").'"  onclick="$('."'".'#modules'."'".').show();$('."'".'#results'."'".').fadeOut('."'".'slow'."'".'); $('."'".'#videoPlayer'."'".').hide();$('."'".'#wall'."'".').fadeIn();$('."'".'#wall'."'".').fadeIn();" href="javascript:;">'.$_IDIOMA->traducir("Close").': </a></span>
				<h2>'.$_IDIOMA->traducir("Who's Online").' : </h2>
				<ul id="condition"><li></li></ul>';
			
					foreach($aOtherOnlines as  $aOtherOnline){
						
							#tiempoUtlimaActividad
							 $tiempo = strtotime ( $aOtherOnline['tiempoUtlimaActividad']);
							 if (($tiempo >= $antes) && ($tiempo <= $ahora)){#tiempoUtlimaActividad
							    $id=$aOtherOnline['id'];
				 			    $aStatusUser=$SITE->statusUser("userid='$id'");
				 			    if($aStatusUser['status']!="invisible"){ 	  
								    //////Move the img to center thumb//////////
								    $aImPhoto=array();
								    $aImPhoto=@getimagesize('../photoGeneral/big/'.$aOtherOnline['photo']);
								    if($aImPhoto[0]>180){
								     $moveLeft='style="margin-left:-'.(($aImPhoto[0]-180)/2).'px;"';
								    }else{
								     $moveLeft='';
								    }
								    
								    
								    /*if($aImPhoto[1]>50){
								     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
								    }else{
								     $moveTop='';
								    }*/


								    #dayOfBirthDay
								    if(!empty($aOtherOnline['dayOfBirthDay'])){
									   $brd=explode('-',$aOtherOnline['dayOfBirthDay']);
									   $sEdad='('.edad($aOtherOnline['dayOfBirthDay']).')';
								   }else{
									   $brd[0]=''; $brd[1]=''; $brd[2]='';      
								   }
								  $ecDD  = 'BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0];

								    $sPhoto.='<div class="itemResult" onclick="location.href=\'/'.$_IDIOMA->traducir("user")."/".$aOtherOnline["id"]."-".Utilidades::normalizarTexto($aOtherOnline["name"]." ".$aOtherOnline["lastName"]).'\'" 
						 onmouseover="subir('.$aOtherOnline['id'].');" onmouseout="bajar('.$aOtherOnline['id'].');">
				  			<div id="imagen'.$aOtherOnline['id'].'" style="height:190px; overflow:hidden;">
			  	   
								<img '.$moveLeft.'  title="'.$aOtherOnline['name'].'" src="photoGeneral/big/'.$aOtherOnline['photo'].'">
							</div>
								<h4>'.$aOtherOnline['name'].' '.$aOtherOnline['lastName'].'</h4>
							<ul>
								<li>'.nameProfile($aOtherOnline['profileId']).'</li>
								<li>'.$ecDD.'</li>

							</ul>
							 </div>';	    
							   }#$aStatusUser['status']	
							}#tiempoUtlimaActividad
							
						
					}#foreach
			
			#escribe link del paginator
			$sPhoto.=$paginado;
			
			$oRespuesta->script("$('#centralcolumn').css('min-height','1400px');");
        	$oRespuesta->script("$('#modules').hide();");
        	$oRespuesta->script("$('#wall').hide();");
			$oRespuesta->assign("results", "innerHTML", $sPhoto);
			$oRespuesta->script("$('#results').fadeIn();");
		}
		return $oRespuesta;
}#getAllOnline

#Latest Registered
function getAllLatestRegistered($iPagActual){
global $_IDIOMA;

		$oRespuesta = new xajaxResponse();
		if(isset($_SESSION["iSMuIdKey"])){
			$iIdUser=(int)$_SESSION["iSMuIdKey"];
			#Object Profile
			$oProfile= new Profile();	

			#Users 
			global $SITE; 
			$SITE        = new SITE();
			$iEstado     ='active=1';
			$iComplete   ='complete=1';
			$aLastRegisteredes= $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ". $iEstado. " AND ".$iComplete,'id DESC Limit 0,120 ');
			
			#Paginator
			if(isset($iPagActual)){
				$page=$iPagActual;
			
			}else $page=1;
			
			$iCantTotal=sizeof($aLastRegisteredes);#cant total 
			$iCantSet=15;#cant de record x page
			$array = mostrarPaginadoPeople($iCantTotal,$page,$iCantSet,6); #$iCantTotal:cant Total;$page:pag actual;$cant:record visibles;6:tipo de Func
			list($paginado, $inicio) = $array; 
			$aLastRegisteredes = $SITE->getUsuarios(NULL, "id!='$iIdUser'". " AND ". $iEstado. " AND ".$iComplete,'id DESC Limit '.$inicio.','.$iCantSet);
			
			#Html
			$sPhoto='<span><a title="'.$_IDIOMA->traducir("Close").'"  onclick="$('."'".'#modules'."'".').show();$('."'".'#results'."'".').fadeOut('."'".'slow'."'".'); $('."'".'#videoPlayer'."'".').hide();$('."'".'#wall'."'".').fadeIn();$('."'".'#wall'."'".').fadeIn();" href="javascript:;">'.$_IDIOMA->traducir("Close").': </a></span>
				<h2>'.$_IDIOMA->traducir("Latest Members").': </h2>
				<ul id="condition"><li></li></ul>';
			
			foreach($aLastRegisteredes as  $aLastRegistered){
  				 //////Move the img to center thumb//////////
				$aImPhoto=array();
				$aImPhoto=@getimagesize('../photoGeneral/big/'.$aLastRegistered['photo']);
				if($aImPhoto[0]>180){
					$moveLeft='style="margin-left:-'.(($aImPhoto[0]-180)/2).'px;"';
				}else{
					$moveLeft='';
				}

				#dayOfBirthDay
				 if(!empty($aLastRegistered['dayOfBirthDay'])){
				   $brd=explode('-',$aLastRegistered['dayOfBirthDay']);
				   $sEdad='('.edad($aLastRegistered['dayOfBirthDay']).')';
				 }else{
				   $brd[0]=''; $brd[1]=''; $brd[2]='';      
				 }

				#Get Data Profesional
				 if($aLastRegistered['profileId']<7 && $aLastRegistered['profileId']>1){ #si es perfil player
        				#$sEdad='('.edad($aDestacado['dayOfBirthDay']).')';
        			 	$aPlayer=$oProfile->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$aLastRegistered['id'].""); 
					 if($aLastRegistered['profileId']==2){
					   	$ecDD='ECD: '.$aPlayer[0]->endingContractDate;
					 }else{ $ecDD  = 'BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0];}

					 if(!empty($aPlayer[0]->clubName)){#name club
						$sNameClub=$aPlayer[0]->clubName;					 
					
					 }else{
						 if(!empty($aPlayer[0]->otherClub))
							$sNameClub=$aPlayer[0]->otherClub;
						 else   $sNameClub='-';
					 }
					 if(!empty($aPlayer[0]->position))#position
					 	$posP  = namePosition($aPlayer[0]->position);
					 else   $posP  = '-';
					
					 #$posP  = 'player Pos';
					 $clubB = 'CLUB: '.$sNameClub;                  
				}else{#cualkier otro perfil
					 $sEdad = '';	
					 $ecDD  = 'BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0];
					 $clubB = $aLastRegistered['cityName'];
					 $posP  = '';
				}


				#write All Data

			$sPhoto.='<div class="itemResult" onclick="location.href=\'/'.$_IDIOMA->traducir("user")."/".$aLastRegistered["id"]."-".Utilidades::normalizarTexto($aLastRegistered["name"]." ".$aLastRegistered["lastName"]).'\'"  onmouseover="subir('.$aLastRegistered['id'].');" onmouseout="bajar('.$aLastRegistered['id'].');">
				  <div id="imagen'.$aLastRegistered['id'].'" style="height:190px; overflow:hidden;">
						<img  '.$moveLeft.'title="'.$aLastRegistered['name'].'" src="photoGeneral/big/'.$aLastRegistered['photo'].'">
						</div>
						<h4>'.$aLastRegistered['name'].' '.$aLastRegistered['lastName'].'</h4>
					<ul>
						<li>'.nameProfile($aLastRegistered['profileId']).'</li>
						<li>'.$ecDD.'</li>
						<li>'.$posP.'</li>
						<li>'.$clubB.'</li>
						
					</ul>
					 </div>';
			}#foreach
			
			#escribe link del paginator
			$sPhoto.=$paginado;
			$oRespuesta->script("$('#centralcolumn').css('min-height','1400px');");
			$oRespuesta->script("$('#modules').hide();");
			$oRespuesta->script("$('#wall').hide();");
			$oRespuesta->assign("results", "innerHTML", $sPhoto);
			$oRespuesta->script("$('#results').fadeIn();");
			
		}
		return $oRespuesta;
}#Latested Registered
	
    #instances
	$oXajaxFollower = new xajax();
	$oXajaxFollower->registerFunction("setFollower");
	$oXajaxFollower->registerFunction("setAllFollower");
	$oXajaxFollower->registerFunction("getAllFollower");
	$oXajaxFollower->registerFunction("addFollower");
	$oXajaxFollower->registerFunction("removeFollower");
	$oXajaxFollower->registerFunction("setUser");
	$oXajaxFollower->registerFunction("logout");
	$oXajaxFollower->registerFunction("editProfile");
	$oXajaxFollower->registerFunction("quitEdit");
	$oXajaxFollower->registerFunction("addVisitlatestPeople");
	$oXajaxFollower->registerFunction("setLatestPeople");
	$oXajaxFollower->registerFunction("addUserLatestPeople");
	$oXajaxFollower->registerFunction("getMyFollowers");
	$oXajaxFollower->registerFunction("getMyFollowing");
	$oXajaxFollower->registerFunction("getAccount");
	$oXajaxFollower->registerFunction("updateData");
	$oXajaxFollower->registerFunction("enviarMsj");
	$oXajaxFollower->registerFunction("enviarReplyMsj");	
	$oXajaxFollower->registerFunction("enviarError");
	$oXajaxFollower->registerFunction("descMsj");
	$oXajaxFollower->registerFunction("getAllFeatured");
	$oXajaxFollower->registerFunction("getAllSugested");
	$oXajaxFollower->registerFunction("getWhoIsOnline");
	$oXajaxFollower->registerFunction("getAllOnline");
	$oXajaxFollower->registerFunction("getAllLatestRegistered");
	$oXajaxFollower->registerFunction("setEmailPrivacy");
	
	$oXajaxFollower->processRequest();
	
?>
