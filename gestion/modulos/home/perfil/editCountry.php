
<?php

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");



	$myId=$_SESSION['iSMuIdKey'];

	$profileVisiting=$_SESSION['iSMuProfTypeKey'];
	
	

$field=$_POST['field'];

switch($field){
	case 'f5':
		$value=$_POST['value'];
		$field=$value;
		
		//$tableProfile='ax_generalRegister';
		$tableProfile = 'ax_city';
		$jug=new Profile();
		$jug->selectCountry($tableProfile,$field);
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
		$jug->changeCountryCity('ax_generalRegister',$fields,$myId);
		break;

		
		
	}



class Profile{

	function __construct(){
		global $SITE_oDB;	
		$this->oDB =& $SITE_oDB;
	}
		
		function selectCountry($tableProfile,$field){
			
			//$sSQL_Select=GenerateSelect('Name',$tableProfile,'CountryCode='.$field);
			$sSQL_Select="SELECT Name FROM ax_city WHERE CountryCode='$field' ORDER BY Name ASC";
			
			$DB_Result = $this->oDB->Query($sSQL_Select);
			while($asd=mysql_fetch_array($DB_Result)){
				echo $asd['Name']."|";
			}
			
			
		}
		
		function changeCountryCity($tableProfile,$fields,$idUserWho){
		//var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'id='.$idUserWho);
		//var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}
	
	function selectCodes($tableProfile,$field,$value2=''){
			
		//$sSQL_Select=GenerateSelect('Name',$tableProfile,'CountryCode='.$field);
		if($tableProfile=='ax_country'){
			$sSQL_Select="SELECT Country FROM $tableProfile WHERE Code='$field'";
			//var_dump($sSQL_Select);	
			$DB_Result = $this->oDB->Query($sSQL_Select);
			while($asd=mysql_fetch_array($DB_Result)){
			echo $asd['Country'];
			return $asd['Country'];
		}
		}else{
			$sSQL_Select="SELECT ID FROM $tableProfile WHERE CountryCode='$value2' and Name='$field'";
			//var_dump($sSQL_Select);
			$DB_Result = $this->oDB->Query($sSQL_Select);
			while($asd=mysql_fetch_array($DB_Result)){
			echo $asd['ID'];
			return $asd['ID'];
		}
	}
	
	
	}
	
}

?>