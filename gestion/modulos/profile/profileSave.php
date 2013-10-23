<?php
//////////////Require necesary files//////////////
require_once('profileClass.php');
require_once('../../lib/share/clases/getPost.php');
require_once('../../lib/share/clases/countryListStyled.php');

	////translation///////
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }
	  
	  
	  
global $_IDIOMA;	




///////////////////////////////////////////////
$fields=array();
$posPlayer='';


/////////////Get the data from form//////////////////////


$fields['idUser']=addslashes($idUser);
$fields['registerDate']=date('Y-m-d');

$dayECD=$_POST['dayECD'];
$monthECD=$_POST['monthECD'];
$yearECD=$_POST['yearECD'];

$dayFD=$_POST['dayFD'];
$monthFD=$_POST['monthFD'];
$yearFD=$_POST['yearFD'];





$endingContractDate=$dayECD."/".$monthECD."/".$yearECD;
$foundationDate=$dayFD."/".$monthFD."/".$yearFD;


if($idProfile<7){
	
	///////////Player//////////////////////////
	$divLoad='playerFieldsForm';
	
	$fields['nick']=addslashes($nick);
		
		if(addslashes($club)!=undefined && addslashes($club)!=''){
			$fields['club']=addslashes($club);
		}else{
			$fields['club']='';
		}
		
		if(addslashes($clubName)!=undefined && addslashes($clubName)!=''){
			$fields['clubName']=addslashes($clubName);
		}else{
			$fields['clubName']='';
		}
	
		if(addslashes($otherClub)!=undefined && addslashes($otherClub)!=''){
			$fields['otherClub']=addslashes($otherClub);
		}else{
			$fields['otherClub']='';
		}
		
	$fields['contract']=addslashes($contract);
	
	if($idProfile==2){
	
		$end=explode('/',$endingContractDate);
		$endingContractDate=$end[2].'-'.$end[1].'-'.$end[0];
		$fields['endingContractDate']=addslashes($endingContractDate);
		
		
	}
			
	if($position){
		$fields['position']=addslashes($position);
	}
	
	
}elseif($idProfile<13){
	//////////Coach/////////////////////////////
	$divLoad='coachFieldsForm';
	
	$fields['nick']=addslashes($nick);
	$fields['club']=addslashes($club);
	$fields['clubName']=addslashes($clubName);
	if(addslashes($otherClub)!=undefined && addslashes($otherClub)!=''){
			$fields['otherClub']=addslashes($otherClub);
		}
	$fields['contract']=addslashes($contract);
	
	if($idProfile!=8 && $idProfile!=10 && $idProfile!=12){
		$end=explode('/',$endingContractDate);
		$endingContractDate=$end[2].'-'.$end[1].'-'.$end[0];
		$fields['endingContractDate']=addslashes($endingContractDate);
		
	}
	
}elseif($idProfile<16){
	//////////Agente/////////////////////////////
	$divLoad='agentFieldsForm';
	
	$fields['licenceNumber']=addslashes($licenceNumber);
	$fields['federation']=addslashes($federation);
	$fields['federationName']=addslashes($federationName);
	if(addslashes($otherFederation)!=undefined && addslashes($otherFederation)!=''){
		$fields['otherFederation']=addslashes($otherFederation);
	}
	
}elseif($idProfile==16){
	//////////Scout/////////////////////////////
	$divLoad='scoutFieldsForm';
	
	$fields['club']=addslashes($club);	
	$fields['clubName']=addslashes($clubName);	
	if(addslashes($otherClub)!=undefined && addslashes($otherClub)!=''){
			$fields['otherClub']=addslashes($otherClub);
		}
	
}elseif($idProfile==17){
	//////////Lawer/////////////////////////////
	$divLoad='lawyerFieldsForm';
	
	$fields['asociation']=addslashes($asociation);
	$fields['asociationName']=addslashes($asociationName);
	$fields['enterprise']=addslashes($enterprise);
	$fields['enterpriseName']=addslashes($enterpriseName);
	if(addslashes($otherAsociation)!=undefined && addslashes($otherAsociation)!=''){
		$fields['otherAsociation']=addslashes($otherAsociation);
	}
	if(addslashes($otherEnterprise)!=undefined && addslashes($otherEnterprise)!=''){
		$fields['otherEnterprise']=addslashes($otherEnterprise);
	}
	$fields['countryActivity']=addslashes($countryActivity);
	
	#select country name by code
	$oCountry=new CountryList();
	$registroC=$oCountry->selectCountry(addslashes($countryActivity));
	$fields['countryName']=$registroC[0]->country;
	

}elseif($idProfile<20){
	//////////Manager/////////////////////////////
	$divLoad='managerFieldsForm';
	
	$fields['club']=addslashes($club);	
	$fields['clubName']=addslashes($clubName);	
	if(addslashes($otherClub)!=undefined && addslashes($otherClub)!=''){
			$fields['otherClub']=addslashes($otherClub);
	}		
	
}elseif($idProfile<23){
	//////////Medic/////////////////////////////
	$divLoad='medicFieldsForm';
	
	$fields['licenceNumber']=addslashes($licenceNumber);
	$fields['federation']=addslashes($federation);
	if(addslashes($federationName)!=undefined && addslashes($federationName)!=''){
		$fields['federationName']=addslashes($federationName);
	}
	if(addslashes($otherFederation)!=undefined && addslashes($otherFederation)!=''){
		$fields['otherFederation']=addslashes($otherFederation);
	}
	$fields['club']=addslashes($club);
	$fields['clubName']=addslashes($clubName);	
	if(addslashes($otherClub)!=undefined && addslashes($otherClub)!=''){
			$fields['otherClub']=addslashes($otherClub);
		}
	
}elseif($idProfile==23){
	//////////Fan/////////////////////////////
	$divLoad='fanFieldsForm';
	
	$fields['nick']=addslashes($nick);
	$fields['ocupation']=addslashes($ocupation);
	$fields['club']=addslashes($club);
	$fields['clubName']=addslashes($clubName);		
	if(addslashes($otherClub)!=undefined && addslashes($otherClub)!=''){
			$fields['otherClub']=addslashes($otherClub);
		}
	
}elseif($idProfile==24){
	//////////Journalist/////////////////////////////
	$divLoad='journalistFieldsForm';
	
	$fields['licenceNumber']=addslashes($licenceNumber);
	$fields['federation']=addslashes($federation);
	
	if(addslashes($federationName)!=undefined && addslashes($federationName)!=''){
		$fields['federationName']=addslashes($federationName);
	}
	if(addslashes($otherFederation)!=undefined && addslashes($otherFederation)!=''){
		$fields['otherFederation']=addslashes($otherFederation);
	}
	$fields['company']=addslashes($company);
	$fields['companyName']=addslashes($companyName);
	if(addslashes($otherCompany)!=undefined && addslashes($otherCompany)!=''){
		$fields['otherCompany']=addslashes($otherCompany);
	}
	
}elseif($idProfile==25){
	//////////Federation/////////////////////////////
	$divLoad='federationFieldsForm';
	
	$fields['name']=addslashes($name);
	$fields['nickName']=addslashes($nickName);
	$fields['countryId']=addslashes($countryId);
	$fields['fifaCode']=addslashes($fifaCode);
	
	$end=explode('/',$foundationDate);
	$foundationDate=$end[2].'-'.$end[1].'-'.$end[0];
	$fields['foundationDate']=addslashes($foundationDate);
	
	
	#select country name by code
	$oCountry=new CountryList();
	$registroC=$oCountry->selectCountry(addslashes($countryId));
	$fields['countryName']=$registroC[0]->country;
	
	
	
}elseif($idProfile==26){
	//////////Club/////////////////////////////
	$divLoad='clubFieldsForm';
	
	$fields['nickName']=addslashes($nickName);
	$fields['countryId']=addslashes($countryId);
	$fields['name']=addslashes($name);
	
	$end=explode('/',$foundationDate);
	$foundationDate=$end[2].'-'.$end[1].'-'.$end[0];
	$fields['foundationDate']=addslashes($foundationDate);
	
	$fields['federation']=addslashes($federation);
	
	if(addslashes($federationName)!=undefined && addslashes($federationName)!=''){
		$fields['federationName']=addslashes($federationName);
	}
	if(addslashes($otherFederation)!=undefined && addslashes($otherFederation)!=''){
		$fields['otherFederation']=addslashes($otherFederation);
	}
	
	#select country name by code
	$oCountry=new CountryList();
	$registroC=$oCountry->selectCountry(addslashes($countryId));
	$fields['countryName']=$registroC[0]->country;
	
	
	
}elseif($idProfile==27){
	//////////Company/////////////////////////////
	$divLoad='companyFieldsForm';
	
	$end=explode('/',$foundationDate);
	$foundationDate=$end[2].'-'.$end[1].'-'.$end[0];
	$fields['foundationDate']=addslashes($foundationDate);
	
	$fields['countryId']=addslashes($countryId);
	$fields['name']=addslashes($name);
	
	
	#select country name by code
	$oCountry=new CountryList();
	$registroC=$oCountry->selectCountry(addslashes($countryId));
	$fields['countryName']=$registroC[0]->country;
	
	
	
}


$jug= new Profile();


///////////Select to check if profile already exists//////////
$registros=$jug->selectProfile($idProfile,'id',"idUser='$idUser'");



//echo $registros[0]->id;
//die();
///////////Check if update or insert new profile///////////////	
	if($registros[0]->id!=''){
		
		//////////Update data///////////////////////////////////
			//echo 'updated';
			if($jug->upProfile($idProfile,$fields,"idUser='$idUser'")){
					echo '<br/>'.$_IDIOMA->traducir("Thanks for completing your data!").'';
							echo '<input type="hidden" name="specificProfileComplete" id="specificProfileComplete" value="1"/>';
							?>
							<script type="text/javascript">
								$("#<? echo $divLoad; ?>").hide();
								$("#registerFoot").show();
								//checkProfileComplete();
							</script>
							<?
						
					}else{
							echo $_IDIOMA->traducir("There was an error, please try again");
					}
	
			

	
	}else{
	
	
	
		///////////Inserts the data///////////////////////////////
		//echo 'inserted';
			if($jug->addProfile($idProfile,$fields)){
					echo '<br/>'.$_IDIOMA->traducir("Thanks for completing your data!").'';
					echo '<input type="hidden" name="specificProfileComplete" id="specificProfileComplete" value="1"/>';
					?>
					<script type="text/javascript">
						$("#<? echo $divLoad; ?>").hide();
						$("#registerFoot").show();
						//checkProfileComplete();
					</script>
					<?
				
			}else{
					echo $_IDIOMA->traducir("There was an error, please try again");
			}
			/////////////////////////////////////////////////////////
		  
	
	
	}//if 








//////////Delete data///////////////////////////////////
/*if($jug->delProfile($idProfile,"id='$idProfileRow'")){
	echo 'bien';
}else{
	echo 'mal';
}*/


?>
