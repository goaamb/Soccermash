<div id="modules" class="paddRightCenter">
          	
  <div id="holdmenu">
    <ul class="menu">
<?php	  
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

if(!isset($_SESSION['idProfileVisiting'])){;
$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}else{
$profileVisiting=$_SESSION['idProfileVisiting'];
}

global $_IDIOMA;

//echo "profileVisiting: ".$profileVisiting."<br />";

//echo "profileTypeKye: ".$profileVisiting."<br />";

$agtime=$profileVisiting;
$table=selectTable($agtime);

//echo "table: ".$table."<br />";

$profileName=nameProfile($profileVisiting);
$profileName=substr($table,3);
$profileName=ucfirst($profileName);

//echo "profileName: ".$profileName."<br />";


 ?>


      <li class="tabbg"  id="Player"><?php echo $_IDIOMA->traducir($profileName); ?></li>
    </ul>

  </div><!--END holdmenu-->
  <div class="content player sortable">
<?php 
	
if(!isset($_SESSION["editProfile"]) || $_SESSION["editProfile"]==false){
	//echo  $_SESSION["editProfile"];   
	$_SESSION["editProfile"]=false;   
	$editingProfile=$_SESSION["editProfile"];   
}else{
	//echo $_SESSION["editProfile"]; 
	$editingProfile=$_SESSION["editProfile"];   
}     

/*if(!isset($_SESSION['editProfile'])){
	 //echo "<br />No esta seteado, asi que lo pongo en false";
		//$_SESSION['editProfile']=false;
		$editingProfile=false;
	 //echo "<br />".$_SESSION['editProfile'];
	} else {
		$editingProfile=$_SESSION['editProfile'];
	}*/
	
	
	//var_dump ($_SESSION['editProfile']);
// echo "Userid1 :.$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"];
//echo "<br /><br /><br /><br /><br /><br />";
		//echo "<br />".$_SESSION['editProfile'];
//echo "profileVisiting: ".$profileVisiting."<br />";
  $prip=(int)$profileVisiting;
		$profile=grupoPerfil($prip);
		//echo "profile: ".$profile."<br />";
//echo "profile: ".$profile."<br />";

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

$oDB=new mysql;
$oDB->connect();
$sSQL_Select=GenerateSelect('*',"ax_generalRegister",'id='.$idUserVisiting);
$destacado=$oDB->query($sSQL_Select);
while($isDestacado = mysql_fetch_array($destacado)){
	$dest=$isDestacado['destacado'];
}

//echo ($dest) ? 'destacado' : 'no destacado' ;
if(($MyID==$VisitingId) or ($VisitingId==0)){
$canEdit=true;
}else{
$canEdit=false;
}
		switch ($profile)  {
			case 1:
			
				include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				//include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')); 
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 

				break;
			case 2:
		
				
				//include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 3:
				
				//include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/RepresentedPlayers/RepresentedPlayers.php') : ('modules/RepresentedPlayers/editRepresentedPlayers.php'));
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				//include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php')); 
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 4:
				
				 //include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 5:
				
				//include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				//include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 6:
				//Agent ?
				//include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				//include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 7:
				
				//include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 8: 
				
				//include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				//include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 9:
				
				//include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 10:
				
				include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				//include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 11:
				
				include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				//include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
			case 12:
				include(($canEdit) ? ('modules/News/editNews.php') : ('modules/News/news.php'));
				//($dest) ? include(($canEdit) ? ('modules/Honour/editHonours.php') : ('modules/Honour/honours.php')) : '';
				//include(($canEdit) ? ('modules/Observation/editObservations.php') : ('modules/Observation/observations.php')); 
				//include(($canEdit) ? ('modules/PersonalDistinction/editPersonalDistinction.php') : ('modules/PersonalDistinction/PersonalDistinction.php'));
				//include(($canEdit) ? ('modules/Career/editCareer.php') : ('modules/Career/career.php')); 
				
				break;
		}
		

		
		?>
             </div>
              
              
              
          </div><!--END modules-->
