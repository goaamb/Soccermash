<?php

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/lib/site_ini.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");



	$myId=$_SESSION['iSMuIdKey'];

	$profileVisiting=$_SESSION['iSMuProfTypeKey'];
	
	
	
	$tableProfile=selectTable($profileVisiting);
	

	$todaslasvariables=" ";
	foreach($_POST as $key=>$value){
		$todaslasvariables.="$key - $value<br>";
	}	
	

	
	//echo $todaslasvariables;
	//echo "CASE: ".$agmjc;
	switch($agmjc){
		case 'ppuc':
				$dateBirthDay=$yearBirth."-".$montBirth."-".$dayBirth;
				$endingContractDate=$yearEnding."-".$monthEnding."-".$dayEnding;
				if($cPassport=='yes'){
					$europass=1;
				}else{
					$europass=0;
				}
				
				$perfil=array('passaport'=>$oPassport,'europass'=>$europass,'nick'=>$nick,'otherClub'=>$currentClub,'otherAgent'=>$agent,'nationalSelection'=>$nationalSelected,'maritalStatus'=>$maritalStatusag,'height'=>$height,'weigth'=>$weigth,'skillfullLegHand'=>$skillful,'endingContractDate'=>$endingContractDate);
				$general=array('dayOfBirthDay'=>$dateBirthDay);
				
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
	
				$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
		break;
		
		
		case 'ppwc':
				$dateBirthDay=$yearBirth."-".$montBirth."-".$dayBirth;
				
				if($cPassport=='yes'){
					$europass=1;
				}else{
					$europass=0;
				}
				
				$perfil=array('nick'=>$nick,'otherClub'=>$lastClub,'otherAgent'=>$agent,'nationalSelection'=>$nationalSelected,'maritalStatus'=>$maritalStatusag,'height'=>$height,'weigth'=>$weigth,'skillfullLegHand'=>$skillful,'passaport'=>$oPassport,'europass'=>$europass);
				$general=array('dayOfBirthDay'=>$dateBirthDay);
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
	
				$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
		break;
		
		
		
		case 'ap':
				$dateBirthDay=$yearBirth."-".$montBirth."-".$dayBirth;
				
				if($cPassport=='yes'){
					$europass=1;
				}else{
					$europass=0;
				}
				
				$perfil=array('nick'=>$nick,'otherClub'=>$lastClub,'otherAgent'=>$agent,'nationalSelection'=>$nationalSelected,'maritalStatus'=>$maritalStatusag,'height'=>$height,'weigth'=>$weigth,'skillfullLegHand'=>$skillful,'passaport'=>$oPassport,'europass'=>$europass);
				$general=array('dayOfBirthDay'=>$dateBirthDay);
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
	
				$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
		break;
		
		case 'ep':
				$dateBirthDay=$yearBirth."-".$montBirth."-".$dayBirth;
				
				if($cPassport=='yes'){
					$europass=1;
				}else{
					$europass=0;
				}
				
				$perfil=array('nick'=>$nick,'otherClub'=>$lastClub,'otherAgent'=>$agent,'nationalSelection'=>$nationalSelected,'maritalStatus'=>$maritalStatusag,'height'=>$height,'weigth'=>$weigth,'skillfullLegHand'=>$skillful,'passaport'=>$oPassport,'europass'=>$europass);
				$general=array('dayOfBirthDay'=>$dateBirthDay);
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
	
				$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
		break;	
		
		
		case 'cuc':
				
				$endingContractDate=$yearEnding."-".$monthEnding."-".$dayEnding;
				
				if(!isset($club) and (isset($lastClub))){
					$club=$lastClub;
				}else{
					$club=$club;
				}
				
				
				$perfil=array('nick'=>$nick,'endingContractDate'=>$endingContractDate,'otherClub'=>$club);
				
				$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
				$general=array('dayOfBirthDay'=>$dateBirthDay);
				
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
	
				$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
		break;
		
		
		case 'cwc':
				
				$lastContractDate=$yearLastContract."-".$monthLastContract."-".$dayLastContract;
				
				
				$perfil=array('nick'=>$nick,'lastContractDate'=>$lastContractDate,'otherClub'=>$lastClub);
				
				$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
				$general=array('dayOfBirthDay'=>$dateBirthDay);
				
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
	
				$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
		break;
		
		
		case 'lfa':
				$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
				
							
				$perfil=array('licenceNumber'=>$licenceNumber,'otherFederation'=>$federation);
				$general=array('dayOfBirthDay'=>$dateBirthDay);
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
	
				$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				var_dump($DB_Result);
		break;	
		
		case 'sc':
		
			$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
						
				$perfil=array('otherClub'=>$club);
				$general=array('dayOfBirthDay'=>$dateBirthDay);
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
		
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
	
				$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
		break;	
		
		case 'l':
		
			$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
						
			$list = explode("|", $countryDevAg);
			$perfil=array('countryActivity'=>$list[0],'countryName'=>$list[1]);	
		
			$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
		
			$general=array('dayOfBirthDay'=>$dateBirthDay);
			$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
		break;

		case 'm':
		
			$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
						
			
			$perfil=array('otherClub'=>$club);	
			$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
		
			$general=array('dayOfBirthDay'=>$dateBirthDay);
			$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
		break;	

		case 'fa':
		
			$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
						
			
			$perfil=array('otherClub'=>$club,'nick'=>$nick);	
			$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
		
			$general=array('dayOfBirthDay'=>$dateBirthDay);
			$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
		break;
		
		
		case 'jo':
		
			$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
						
			
			$perfil=array('otherCompany'=>$company);	
			$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
		
			$general=array('dayOfBirthDay'=>$dateBirthDay);
			$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
		break;
		
		case 'fed':
		
			$foundationDate=$yearFoundation."-".$monthFoundation."-".$dayFoundation;
					
			$list = explode("|", $countryDevAg);
			$perfil=array('name'=>$name,'nickName'=>$nick,'foundationDate'=>$foundationDate,'fifaCode'=>$fifaCode,'address'=>$address,'worldCup'=>$worldCup,'olimpicGames'=>$olimpicGames,'website'=>$website,'otherPresident'=>$president,'otherManager'=>$manager,'otherDt'=>$dt,'topScorerName'=>$topScorer,'mostParticipationName'=>$mostParticipationName,'firstInternationalMatch'=>$firstInternationalMatch,'countryId'=>$list[0],'countryName'=>$list[1]);	
			$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
			var_dump($sSQL_Update);
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
			var_dump($DB_Result);
			//$general=array('dayOfBirthDay'=>$dateBirthDay);
			//$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
			//$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
		break;
		
		
		case 'cl':
		
			$foundationDate=$yearFoundation."-".$monthFoundation."-".$dayFoundation;
					
			$list = explode("|", $countryag);
			$perfil=array('name'=>$club,'nickName'=>$nickName,'foundationDate'=>$foundationDate,'ground'=>$ground,'address'=>$address,'website'=>$website,'otherPresident'=>$president,'otherManager'=>$manager,'otherDt'=>$dt,'otherFederation'=>$federation,'countryId'=>$list[0],'countryName'=>$list[1]);	
			$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
			var_dump($sSQL_Update);
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
			var_dump($DB_Result);
			//$general=array('dayOfBirthDay'=>$dateBirthDay);
			//$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
			//$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
		break;
		
		
		case 'co':
		
			$foundationDate=$yearFoundation."-".$monthFoundation."-".$dayFoundation;
					
			$list = explode("|", $countryag);
			$perfil=array('name'=>$name,'foundationDate'=>$foundationDate,'address'=>$address,'website'=>$website,'countryId'=>$list[0],'countryName'=>$list[1]);	
			$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
			var_dump($sSQL_Update);
			$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
			var_dump($DB_Result);
			//$general=array('dayOfBirthDay'=>$dateBirthDay);
			//$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
			//$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
				
		break;
		
		
		
		
	}
	
?>
	<script type="text/javascript">
	window.top.window.$('#ResForInformation').html("pepito");
	window.top.JS_QuitEdit();
	</script>


<?php 	
/*


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

/*

switch($field){
	

	//F1 = SportNickName
	case 'f1':
	
		
		
				
		$fields=array('nick'=>$value);
		$tableProfile=selectTable($profileVisiting);
		if($tableProfile=='ax_club'){
				$fields=array('name'=>$value);
		}
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
	//F2 = DateOfBirth
	case 'f2':
		
		
		
		//$value2=explode2Edad($value);
		
		
		$fields=array('dayOfBirthDay'=>$value);	
		$tableProfile='ax_generalRegister';
				
		$jug=new Profile();
		$jug->changeDate($tableProfile,$fields,$idUserWho);
		break;
	
	//F31 = DateOfBirth
	case 'f31':
		
		
		
		//$value2=explode2Edad($value);
		
		
		$fields=array('foundationDate'=>$value);	
		$tableProfile=selectTable($profileVisiting);
		//$tableProfile='ax_federation';
				
		$jug=new Profile();
		$jug->changeFoundationDate($tableProfile,$fields,$idUserWho);
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
		
	//F3bis = otherClub
	case 'f3bis':
	
		
		$fields=array('otherClub'=>$value,'clubName'=>null,'club'=>'0');
		
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
	//F4bis = lastContractDate
	case 'f4bis':
	
		//$value2=explode2Edad($value);
		$tableProfile=selectTable($profileVisiting);
		$jug=new Profile();
		$fields=array('lastContractDate'=>$value);
		$jug->changeContractDate($tableProfile,$fields,$idUserWho);
		break;
	
	//F4 = EndingContractDate
	case 'f4':
	
		//$value2=explode2Edad($value);
		$tableProfile=selectTable($profileVisiting);
		var_dump($tableProfile);
		$jug=new Profile();
		$fields=array('endingContractDate'=>$value);
		$jug->changeContractDate($tableProfile,$fields,$idUserWho);
		break;
	

	//f23 = beginContractDate
	case 'f23':
	
		//$value2=explode2Edad($value);
		$tableProfile=selectTable($profileVisiting);
		$jug=new Profile();
		$fields=array('beginContractDate'=>$value);
		$jug->changeContractDate($tableProfile,$fields,$idUserWho);
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
	
	
	//F7 = name
	case 'f7':
	
		
		
				
		$fields=array('name'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
		
	//F8 = Position
	/*case 'f8':
	
		
		
				
		$fields=array('position'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;*/
		
	//F9 = Skillful Leg Hand
	/*case 'f9':
	
		
		
				
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
		
	//F19 = License Number
	case 'f19':
	
		
		
				
		$fields=array('licenceNumber'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;

	//F26 = Ocupation
	case 'f26':
	
		
		
				
		$fields=array('ocupation'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
	//F47 = name
	case 'f47':
	
		
		
				
		$fields=array('name'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
	
	case 'f37':
	
		
		
				
		$fields=array('address'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
	

	
	case 'f44':
	
		
		
				
		$fields=array('worldCup'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
	
	case 'f46':
	
		
		
				
		$fields=array('olimpicGames'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
	
	
	case 'f32':
	
		
		
				
		$fields=array('website'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
			
	case 'f35':
	
		
		
				
		$fields=array('presidentName'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	
		
	case 'f38':
	
		
		
				
		$fields=array('managerName'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	
		

		
	case 'f33':
	
		
		
				
		$fields=array('dtName'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		

	case 'f48':
			
		$fields=array('topScorerName'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
	
	
	
	case 'f50':
			
		$fields=array('mostParticipationName'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
	
	
	case 'f52':
			
		$fields=array('firstInternationalMatch'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	

		
	case 'f39':
			
		$fields=array('fifaCode'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;
		
	case 'f53':
			
		$fields=array('nickName'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	

		
	case 'f54':
			
		$fields=array('ground'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	

	case 'f36':
			
		$fields=array('ground'=>$value);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;		
		
		
	case 'f55':
		
		$list = explode("|", $value);
		
		
		$fields=array('countryId'=>$list[0],'countryName'=>$list[1]);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;		


	case 'f41':
		
		
		$value2=$_POST['value2'];
		
		$fields=array('federation'=>$value,'federationName'=>$value2);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;

	case 'f42':
		
		
		
		$value3=$_POST['value2'].' '.$_POST['value3'];
		
		
		$fields=array('agent'=>$value,'agentName'=>$value3);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	
		
	case 'f59':
		
		$list = explode("|", $value);
		
		
		$fields=array('countryActivity'=>$list[0],'countryName'=>$list[1]);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	

	case 'f28':
		
		$value2=$_POST['value2'];
		
		
		$fields=array('asociation'=>$value,'asociationName'=>$value2);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;	

	case 'f29':
		
		$value2=$_POST['value2'];
		
		
		$fields=array('enterprise'=>$value,'enterpriseName'=>$value2);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;

	case 'f29':
		
		$value2=$_POST['value2'];
		
		
		$fields=array('enterprise'=>$value,'enterpriseName'=>$value2);	
		$tableProfile=selectTable($profileVisiting);
				
		$jug=new Profile();
		$jug->changeProfile($tableProfile,$fields,$idUserWho);
		break;

	case 'f60':
		
		$list = explode("|", $value);
				
		$fields=array('countryId'=>$list[0],'countryName'=>$list[1]);	
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
		//var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'idUser='.$idUserWho);
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
	
	function changeCountryCity($tableProfile,$fields,$idUserWho){
		//var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'id='.$idUserWho);
		//var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}
	
	
	function changeDate($tableProfile,$fields,$idUserWho){
		//var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'id='.$idUserWho);
		//var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}
	
	function changeFoundationDate($tableProfile,$fields,$idUserWho){
		//var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'idUser='.$idUserWho);
		//var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}	

	
	function changeContractDate($tableProfile,$fields,$idUserWho){
			 
		//var_dump($fields);
//		GenerateUpdate($sTable = NULL, $aRow = array(), $sWhere = NULL, $bAplicarSlashes = true)
		$sSQL_Update = GenerateUpdate($tableProfile,$fields,'idUser='.$idUserWho);
		//var_dump($sSQL_Update);
		$DB_Result = $this->oDB->Query($sSQL_Update);
		var_dump($DB_Result);
	}
	
}	
		
		
		*/
		

?>