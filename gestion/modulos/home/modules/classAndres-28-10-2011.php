<?php
//mysql_query ("SET NAMES 'utf8'");

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/js/modulesScripts.js"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/js/modulesScripts.js"); 


////translation///////
//require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/share/clases/lib_util.inc.php');
require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
require_once $_GBASE. '/goaamb/idioma.php';

if(class_exists("Idioma")){
	$_IDIOMA=Idioma::darLenguaje();
}
  global $_IDIOMA;
class mysql
{
    var $server='localhost';

	var $conn_username='soccer_migracion';
	//var $conn_username='soccer_test';
   	
	var $conn_password='M16R4C10N';
	//var $conn_password='735750cc3r';
   
	var $database_name='soccer_migracion';
	//var $database_name='soccer_test';
    
	var $connection;
    var $select;
    var $query;

    function connect()
 {
 
   
    $this->connection = mysql_connect($this->server,$this->conn_username,$this->conn_password);
	$this->select = mysql_select_db($this->database_name,$this->connection);
	mysql_query ("SET NAMES 'utf8'");
	
}
    function query($query)
    {
        
		$result = mysql_query($query);
		if (!$result) {
            echo 'Could not run query: ' . mysql_error();
            exit;
		}else{
			return $result;
		}
    }
	
	
    function end()
    {
        mysql_free_result($connection);
    }
} 



function selectTable($profileId){
 $tableProfile='';
   if($profileId<7){
    $tableProfile='ax_player';
   }elseif($profileId<13){
    $tableProfile='ax_coach';
   }elseif($profileId<16){
    $tableProfile='ax_agent';
   }elseif($profileId==16){
    $tableProfile='ax_scout';
   }elseif($profileId==17){
    $tableProfile='ax_lawyer';
   }elseif($profileId<20){
    $tableProfile='ax_manager';
   }elseif($profileId<23){
    $tableProfile='ax_medic';
   }elseif($profileId==23){
    $tableProfile='ax_fan';
   }elseif($profileId==24){
    $tableProfile='ax_journalist';
   }elseif($profileId==25){
    $tableProfile='ax_federation';
   }elseif($profileId==26){
    $tableProfile='ax_club';
   }elseif($profileId==27){
    $tableProfile='ax_company';
   }
   
   return $tableProfile;
  
  }

function GenerateDelete($sTable, $aRow, $idUser)
{
	return "DELETE FROM $sTable WHERE id=$aRow AND idPlayer=$idUser";
}



//Funcion para ver "hace cuanto" hizo una publicacion o un comentario
function ago($time) {

 
  global $_IDIOMA;
  

  
  
  
//$time = strtotime($time);
//echo "Time actule: ".time()."<br />Time guardado en bd: ".$time."<br />";
  $delta = time() - $time;
  if ($delta < 60) {
    return $_IDIOMA->traducir("less than a minute ago.");
  } else if ($delta < 120) {
    return $_IDIOMA->traducir("about a minute ago.");
  } else if ($delta < (45 * 60)) {
    return  floor($delta / 60) . ' ' .$_IDIOMA->traducir("minutes ago");
  } else if ($delta < (90 * 60)) {
    return $_IDIOMA->traducir("about an hour ago.");
  } else if ($delta < (24 * 60 * 60)) {
    return  floor($delta / 3600) . ' '. $_IDIOMA->traducir("hours ago");
  } else if ($delta < (48 * 60 * 60)) {
    return $_IDIOMA->traducir("1 day ago.");
  } else {
    return  floor($delta / 86400) . ' '. $_IDIOMA->traducir("days ago");
  }
}


//Se fija si la variable de session idUserVisiting esta seteada o si es igual a 0(cero), de ser asi se devuelve el valor de iSMuIdKey
function setIdUserVisiting(){
	if(!isset($_SESSION['idUserVisiting']) OR ($_SESSION['idUserVisiting']==0)){
		//echo "no seteada<br />";
		$iSMuIdKey=$_SESSION['iSMuIdKey'];
		return $iSMuIdKey;
	}else{
		//echo "seteada<br />";
		$iSMuIdKey=$_SESSION['idUserVisiting'];
		return $iSMuIdKey;
	}
}


function setProfileId(){
	if(!isset($_SESSION['idProfileVisiting']) or ($_SESSION['idProfileVisiting']==0)){;
		$profileVisiting=$_SESSION['iSMuProfTypeKey'];
		return $profileVisiting;
	}else{
		$profileVisiting=$_SESSION['idProfileVisiting'];
		return $profileVisiting;
	}
}

function createTableWall($valueOfProfileVisiting){
	$table=selectTable($valueOfProfileVisiting);
	$anexo='Wall';
	$tableWall=$table.$anexo;
	return $tableWall;
}

function crateTableReceivedComments($valueOfProfileVisiting){
	$table=selectTable($valueOfProfileVisiting);
	$anexo='ReceivedComments';
	$tableReceivedComments=$table.$anexo;
	return $tableReceivedComments;
}


function profileType($idProfile){

	  global $_IDIOMA;

	switch($idProfile){
		case 2: return "<option disabled selected>". $_IDIOMA->traducir("Professional Player Under Contract")."</option>
						<option value='3'>". $_IDIOMA->traducir("Professional Player Without Contract")."</option>
						<option value='5'>". $_IDIOMA->traducir("Amateur Player")."</option>
						<option value='6'>". $_IDIOMA->traducir("Professional Ex Player")."</option> ";
			break;
		case 3: return "<option disabled selected>". $_IDIOMA->traducir("Professional Player Without Contract")."</option>
						<option value='2'>". $_IDIOMA->traducir("Professional Player Under Contract")."</option>
						<option value='5'>". $_IDIOMA->traducir("Amateur Player")."</option>
						<option value='6'>". $_IDIOMA->traducir("Professional Ex Player")."</option> ";
			break;
		case 5: return "<option disabled selected>". $_IDIOMA->traducir("Amateur Player")."</option>
						<option value='2'>". $_IDIOMA->traducir("Professional Player Under Contract")."</option>
						<option value='3'>". $_IDIOMA->traducir("Professional Player Without Contract")."</option>
						<option value='6'>". $_IDIOMA->traducir("Professional Ex Player")."</option> ";
			break;
		case 6: return "<option disabled selected>". $_IDIOMA->traducir("Professional Ex Player")."</option>
						<option value='2'>". $_IDIOMA->traducir("Professional Player Under Contract")."</option>
						<option value='3'>". $_IDIOMA->traducir("Professional Player Without Contract")."</option>
						<option value='5'>". $_IDIOMA->traducir("Amateur Player")."</option> ";
			break;
		case 7: return "<option disabled selected>". $_IDIOMA->traducir("Coach Under Contract")."</option>
						<option value='8'>". $_IDIOMA->traducir("Coach Without Contract")."</option>
						<option value='9'>". $_IDIOMA->traducir("Goalkeeper Coach Under Contract")."</option>
						<option value='10'>". $_IDIOMA->traducir("Goalkeeper Coach Without Contract")."</option>
						<option value='11'>". $_IDIOMA->traducir("Physical Coach Under Contract")."</option>
						<option value='12'>". $_IDIOMA->traducir("Physical Coach Without Contract")."</option>";
			break;
		case 8: return "<option disabled selected>". $_IDIOMA->traducir("Coach Without Contract")."</option>
						<option value='7'>". $_IDIOMA->traducir("Coach Under Contract")."</option>
						<option value='9'>". $_IDIOMA->traducir("Goalkeeper Coach Under Contract")."</option>
						<option value='10'>". $_IDIOMA->traducir("Goalkeeper Coach Without Contract")."</option>
						<option value='11'>". $_IDIOMA->traducir("Physical Coach Under Contract")."</option>
						<option value='12'>". $_IDIOMA->traducir("Physical Coach Without Contract")."</option>";
			break;
		case 9: return "<option disabled selected>". $_IDIOMA->traducir("Goalkeeper Coach Under Contract")."</option>
						<option value='7'>". $_IDIOMA->traducir("Coach Under Contract")."</option>
						<option value='8'>". $_IDIOMA->traducir("Coach Without Contract")."</option>
						<option value='10'>". $_IDIOMA->traducir("Goalkeeper Coach Without Contract")."</option>
						<option value='11'>". $_IDIOMA->traducir("Physical Coach Under Contract")."</option>
						<option value='12'>". $_IDIOMA->traducir("Physical Coach Without Contract")."</option>";
			break;
		case 10: return "<option disabled selected>". $_IDIOMA->traducir("Goalkeeper Coach Without Contract")."</option>
						<option value='7'>". $_IDIOMA->traducir("Coach Under Contract")."</option>
						<option value='8'>". $_IDIOMA->traducir("Coach Without Contract")."</option>
						<option value='9'>". $_IDIOMA->traducir("Goalkeeper Coach Under Contract")."</option>
						<option value='11'>". $_IDIOMA->traducir("Physical Coach Under Contract")."</option>
						<option value='12'>". $_IDIOMA->traducir("Physical Coach Without Contract")."</option>";
			break;
		case 11: return "<option disabled selected>". $_IDIOMA->traducir("Physical Coach Under Contract")."</option>
						<option value='7'>". $_IDIOMA->traducir("Coach Under Contract")."</option>
						<option value='8'>". $_IDIOMA->traducir("Coach Without Contract")."</option>
						<option value='9'>". $_IDIOMA->traducir("Goalkeeper Coach Under Contract")."</option>
						<option value='10'>". $_IDIOMA->traducir("Goalkeeper Coach Without Contract")."</option>
						<option value='12'>". $_IDIOMA->traducir("Physical Coach Without Contract")."</option>";
			break;
		case 12: return "<option disabled selected>". $_IDIOMA->traducir("Physical Coach Without Contract")."</option>
						<option value='7'>". $_IDIOMA->traducir("Coach Under Contract")."</option>
						<option value='8'>". $_IDIOMA->traducir("Coach Without Contract")."</option>
						<option value='9'>". $_IDIOMA->traducir("Goalkeeper Coach Under Contract")."</option>
						<option value='10'>". $_IDIOMA->traducir("Goalkeeper Coach Without Contract")."</option>
						<option value='11'>". $_IDIOMA->traducir("Physical Coach Under Contract")."</option>";
			break;
		case 13: return "<option disabled selected>". $_IDIOMA->traducir("Licensed FIFA Agent")."</option>
						<option value='14'>". $_IDIOMA->traducir("Licensed UEFA Agent")."</option>
						<option value='15'>". $_IDIOMA->traducir("Authorized Agent")."</option>";
			break;
		case 14: return "<option disabled selected>". $_IDIOMA->traducir("Licensed UEFA Agent")."</option>
						<option value='13'>". $_IDIOMA->traducir("Licensed FIFA Agent")."</option>
						<option value='15'>". $_IDIOMA->traducir("Authorized Agent")."</option>";
			break;
			
		case 15: return "<option disabled selected>". $_IDIOMA->traducir("Authorized Agent")."</option>
						<option value='13'>". $_IDIOMA->traducir("Licensed FIFA Agent")."</option>
						<option value='14'>". $_IDIOMA->traducir("Licensed UEFA Agent")."</option>";
			break;
	
	}
}


?>