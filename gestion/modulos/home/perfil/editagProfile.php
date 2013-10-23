<?php

require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");


	if(isset($_SESSION["bEditPlayer"])&& $_SESSION["bEditPlayer"]==true){#si la edicion del perfil q se kiere guardar 
																		 #es la de player x su representante
			if(isset($_SESSION["iIdPlayer"])&&isset($_SESSION["iPerfilPlayer"])){															 
				$myId = $_SESSION["iIdPlayer"];
				$profileVisiting = $_SESSION['iPerfilPlayer'];
			}
			
	}else{#sigue como spre, con el perfil ppal activo
			$myId = $_SESSION['iSMuIdKey'];
	
			$profileVisiting = $_SESSION['iSMuProfTypeKey'];
		
	}

	
	
	if(isset($profileVisiting)&&isset($myId)){#guardo los cambios solo si estan set las var
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
						
					$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
					
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
						
					$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
					
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
					
					$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
					
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
						
					$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
					
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
						
					$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
					
			break;
			
			
			case 'cwc':
					
					$lastContractDate=$yearLastContract."-".$monthLastContract."-".$dayLastContract;
					
					
					$perfil=array('nick'=>$nick,'lastContractDate'=>$lastContractDate,'otherClub'=>$lastClub);
					
					$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
					$general=array('dayOfBirthDay'=>$dateBirthDay);
					
					$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
						
					$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
					
			break;
			
			
			case 'lfa':
					$dateBirthDay=$yearBirth."-".$monthBirth."-".$dayBirth;
					
								
					$perfil=array('licenceNumber'=>$licenceNumber,'otherFederation'=>$federation);
					$general=array('dayOfBirthDay'=>$dateBirthDay);
					$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
					
					$sSQL_Update = GenerateUpdate('ax_generalRegister',$general,"id=$myId");
					$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());
					
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
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
	
					
			break;
			
			
			case 'cl':
			
				$foundationDate=$yearFoundation."-".$monthFoundation."-".$dayFoundation;
						
				$list = explode("|", $countryag);
				$perfil=array('name'=>$club,'nickName'=>$nickName,'foundationDate'=>$foundationDate,'ground'=>$ground,'address'=>$address,'website'=>$website,'otherPresident'=>$president,'otherManager'=>$manager,'otherDt'=>$dt,'otherFederation'=>$federation,'countryId'=>$list[0],'countryName'=>$list[1]);	
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
	
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
	
					
			break;
			
			
			case 'co':
			
				$foundationDate=$yearFoundation."-".$monthFoundation."-".$dayFoundation;
						
				$list = explode("|", $countryag);
				$perfil=array('name'=>$name,'foundationDate'=>$foundationDate,'address'=>$address,'website'=>$website,'countryId'=>$list[0],'countryName'=>$list[1]);	
				$sSQL_Update = GenerateUpdate($tableProfile,$perfil,"idUser=$myId");
				
				$DB_Result=mysql_query($sSQL_Update) or die(mysql_error());	
	
					
			break;
			
		}
		
	    if(isset($_SESSION["sNameAgent"]) && (isset($_SESSION["bEditPlayer"])&& $_SESSION["bEditPlayer"]==true) ){
		    #si es Agent q edita los datos, => seteo una var p/ q los datos queden tipo visible, esta var
		    #la comprueba en la seccion visitante en el home
		    $_SESSION["bSavedPlayer"]=true;#
	            #echo 'estan entrandooo';	die();	
	    }#else{echo 'acaaa le entroo'; die();}    	
	}#if
?>
	<script type="text/javascript">
		window.top.window.$('#ResForInformation').html("<?php $_IDIOMA->traducir('Updated'); ?>");
		window.top.window.JS_QuitEdit();
		window.parent.JS_QuitEdit.call(window.parent);
	</script>
