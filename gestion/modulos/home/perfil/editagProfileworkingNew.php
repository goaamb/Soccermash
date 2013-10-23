<?php

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/soccermashTest2/gestion/modulos/home/modules/classAndres.php"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/soccermashTest2/gestion/lib/site_ini.php");



if(!isset($_SESSION['idUserVisiting'])){;
$idUserVisiting=$_SESSION['iSMuIdKey'];
}else{
$idUserVisiting=$_SESSION['idUserVisiting'];
}

//exploto el formato de fecha
function explode2Edad($edad){
 list($dia,$mes,$anio) = explode("/",$edad);
 return $edad= $anio.'-'.$mes.'-'.$dia;
}

$profileVisiting=$_SESSION['iSMuProfTypeKey'];


$value=$_POST['value'];
$field=$_POST['field'];
$idUserWho=$_SESSION['iSMuIdKey'];
$type=$_POST['type'];

/*if($type == 'selectCountry'){
	case 'country':
		$jug=new Profile();
		GenerateSelect("ID,Name","ax_city",'CountryCode="'.$aUsuario['codeCountry'].'"');
		
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;

}*/



switch($field){
	

	//F1 = SportNickName
	case 'f1':
	
		
		
				
		$fields=array('nick'=>$value);
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
	//F2 = DateOfBirth
	case 'f2':
		
		
		
		$value2=explode2Edad($value);
		
		
		$fields=array('dayOfBirthDay'=>$value2);	
		$tableProfile='ax_generalRegister';
				
		$jug=new Profile();
		$jug->changeDate($tableProfile,$fields,$idUserWho);
		break;
		
	//F3 = CurrentClub
	case 'f3':
	
		
		$jug=new Profile();
		$club=$jug->selectClub('ax_club',$value);
		var_dump($club);		
		$fields=array('clubName'=>$club,'club'=>$value);
		
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
	//F4 = EndingContractDate
	case 'f4':
	
		$value2=explode2Edad($value);
		$tableProfile=selectTable($profileVisiting);
		$jug=new Profile();
		$fields=array('endingContractDate'=>$value2);
		$jug->changeContractDate('ax_player',$fields,$idUserWho);
		break;
		
		
		
	//F5 = Country
	case 'f5':
		//$value2=$_POST['value2'];
		$field=$value;
		
		//$tableProfile='ax_generalRegister';
		$tableProfile = 'ax_city';
		$jug=new Profile();
		$jug->selectCountry($tableProfile,$field,$idUserWho);
		break;
	
	//F6 = Passport
	case 'f6':
	
		
		
				
		$fields=array('passaport'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
	
	
	//F7 = Agent
	/*case 'f7':
	
		
		
				
		$fields=array('agent'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;*/
		
		
	//F8 = Position
	/*case 'f8':
	
		
		
				
		$fields=array('position'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;*/
		
	//F9 = Skillful Leg Hand
	case 'f9':
	
		
		
				
		$fields=array('skillfullLegHand'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		

		
	
		
	//F10 = National Selected
	case 'f10':
	
		
		
				
		$fields=array('nationalSelection'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
		
	//F11 = Place of birth
	case 'f11':
	
		$value2=$_POST['value2'];
		var_dump($value);
		var_dump($value2);
			
		$jug2=new Profile();
		$res=$jug2->selectCodes('ax_country',$value2);
		
		$jug3=new Profile();
		$res3=$jug3->selectCodes('ax_city',$value,$value2);
		
		$fields=array('cityName'=>$value,'countryId'=>$value2,'countryName'=>$res,'cityId'=>$res3);	
		//$tableProfile=selectTable($profileVisiting);
		
		
		$jug=new Profile();
		$jug->changeCountryCity('ax_generalRegister',$fields,$idUserWho);
		break;
		
	//F12 = height
	case 'f12':
	
		
		
				
		$fields=array('height'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	
		
		
		
	//F13 = weigth
	case 'f13':
	
		
		
				
		$fields=array('weigth'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;		
		
		
		
		
	//F14 = Marital Status
	case 'f14':
	
		
		
				
		$fields=array('maritalStatus'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;		
		
		
	
	
}



class Profile{

	function __construct(){
		global $SITE_oDB;	
		$this->oDB =& $SITE_oDB;
	}
		
		function selectCountry($tableProfile,$field,$idUserWho){
			
			//$sSQL_Select=GenerateSelect('Name',$tableProfile,'CountryCode='.$field);
			$sSQL_Select="SELECT Name FROM ax_city WHERE CountryCode='$field'";
			
			$DB_Result = $this->oDB->Query($sSQL_Select);
			while($asd=mysql_fetch_array($DB_Result)){
				echo $asd['Name']."|";
			}
			
			
		}
	
	
		function selectClub($tableProfile,$value){
		//var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Select = GenerateSelect('name',$tableProfile,'id='.$value);
		//var_dump($sSQL_Select);
		$DB_Result = $this->oDB->Query($sSQL_Select);
		while($asd=mysql_fetch_array($DB_Result)){
			return $asd['name'];
		}
	}	

		function changeProfile($tableProfile,$fields,$idUserWho){
		var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'idUser='.$idUserWho);
		var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}
	
		function selectCodes($tableProfile,$field,$value2=''){
			
		//$sSQL_Select=GenerateSelect('Name',$tableProfile,'CountryCode='.$field);
		if($tableProfile=='ax_country'){
			$sSQL_Select="SELECT Country FROM $tableProfile WHERE Code='$field'";
			var_dump($sSQL_Select);	
			$DB_Result = $this->oDB->Query($sSQL_Select);
			while($asd=mysql_fetch_array($DB_Result)){
			echo $asd['Country'];
			return $asd['Country'];
		}
		}else{
			$sSQL_Select="SELECT ID FROM $tableProfile WHERE CountryCode='$value2' and Name='$field'";
			var_dump($sSQL_Select);
			$DB_Result = $this->oDB->Query($sSQL_Select);
			while($asd=mysql_fetch_array($DB_Result)){
			echo $asd['ID'];
			return $asd['ID'];
		}
	}
	}
	
	function changeCountryCity($tableProfile,$fields,$idUserWho){
		var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'id='.$idUserWho);
		var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}
	
	
	function changeDate($tableProfile,$fields,$idUserWho){
		var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'id='.$idUserWho);
		var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}
	
	function changeContractDate($tableProfile,$fields,$idUserWho){
			 
		var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'id='.$idUserWho);
		var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}
	
}	
		
		
		
		

?>