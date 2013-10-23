<div id="modules" class="paddRightCenter">
          	
  <div id="holdmenu">
    <ul class="menu">
<?php	  
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
$profileVisiting  = $_SESSION['iSMuProfTypeKey'];
if(isset($_SESSION["bEditPlayer"])&& $_SESSION["bEditPlayer"]==true){#edicion perfil player by agent
	if(isset($_SESSION["iIdPlayer"])&&isset($_SESSION["iPerfilPlayer"])){	
		$profileVisiting = $_SESSION['iPerfilPlayer'];
		
	}
}else{#sigue la logica original
	if(!isset($_SESSION['idProfileVisiting'])|| (isset($_SESSION['idProfileVisiting'])&& !$_SESSION['idProfileVisiting'])){;
		$profileVisiting  = $_SESSION['iSMuProfTypeKey'];
	}else{
		$profileVisiting  = $_SESSION['idProfileVisiting'];
	}
}
global $_IDIOMA;
$agtime		 = $profileVisiting;
$table		 = selectTable($agtime);
//$profileName = nameProfile($profileVisiting);
$profileName = substr($table,3);
$profileName = ucfirst($profileName);

?>


      <li class="tabbg"  id="Player"><?php echo $_IDIOMA->traducir($profileName); ?></li>
    </ul>

  </div><!--END holdmenu-->
  <div class="content player sortable">
<?php 
	
if(!isset($_SESSION["editProfile"]) || $_SESSION["editProfile"]==false){
	 
	$_SESSION["editProfile"]= false;   
	$editingProfile			= $_SESSION["editProfile"];   
}else{
	
	$editingProfile			= $_SESSION["editProfile"];   
}     

$prip	 = (int)$profileVisiting;
$profile = grupoPerfil($prip);
//Elige el ID del user q va a mostrar
if(!isset($_SESSION['idUserVisiting'])){
	$idUserVisiting = $_SESSION['iSMuIdKey'];
}else{
	$idUserVisiting = $_SESSION['idUserVisiting'];
}

$MyID=(int)$_SESSION['iSMuIdKey'];
if(!isset($_SESSION['idUserVisiting'])){
	$VisitingId=(int)$_SESSION['iSMuIdKey'];
}else{
	$VisitingId=(int)$_SESSION['idUserVisiting'];
}
//Trae los datos
$oDB=new mysql;
$oDB->connect();
$sSQL_Select=GenerateSelect('*',"ax_generalRegister",'id='.$idUserVisiting);
$destacado=$oDB->query($sSQL_Select);
while($isDestacado = mysql_fetch_array($destacado)){
	$dest=$isDestacado['destacado'];
}

//Elige si es o no Editable el perfil
if(isset($_SESSION["bEditPlayer"])&& $_SESSION["bEditPlayer"]==true){#edicion perfil player by agent
	if(isset($_SESSION["iIdPlayer"]) && isset($_SESSION["iPerfilPlayer"])){	
		$canEdit=true;
	}
}else{#sigue la logica original

	if(($MyID==$VisitingId) or ($VisitingId==0)){
		$canEdit=true;
	}else{
		$canEdit=false;
	}
}
//Elige los modulos x perfil
switch ($profile)  {
			
			case 1:
				//Perfil Player
				include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				isset($dest)|| (isset($dest) && !$dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				break;
				
			case 2:

				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				break;
				
			case 3:
				include(($canEdit) ? ('modules/RepresentedPlayers/RepresentedPlayers.php') : ('modules/RepresentedPlayers/editRepresentedPlayers.php'));
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				break;
				
			case 4:
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				break;
				
			case 5:
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				break;
				
			case 6:
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				break;
				
			case 7:
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				break;
			case 8: 
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				break;
				
			case 9:
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				break;
				
			case 10:
				
				include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				break;
				
			case 11:
				
				include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				break;
				
			case 12:
				include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				break;
}
		

		
		?>
             </div>
              
              
              
          </div><!--END modules-->