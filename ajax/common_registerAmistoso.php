<?php
require_once('../gestion/lib/site_ini.php');
require_once('../gestion/lib/share/clases/class_site.inc.php');
require_once('../gestion/modulos/cityCountry/cityCountry.php');


# Function p/ Register Amistoso
function validaRegisterAmistoso($aForm)
{



$oRespuesta = new xajaxResponse();

#clear fields
	$oRespuesta->script("$('#dayAg').tipsy('hide');");
	$oRespuesta->script("$('#textShowed').tipsy('hide');");
	$oRespuesta->script("$('#textShowed3').tipsy('hide');");
	$oRespuesta->script("$('#personalData-sex').tipsy('hide');");
	
	
	
	

	
	$aErrores = array();
		
	global  $SITE;
	$SITE 	 = new SITE();
	$aUser	 = getParametros($aForm);
	

	$iIdUser =$aUser['id'];
	unset($aUser['id']);
	if(!is_file($_SERVER["DOCUMENT_ROOT"]."/photoGeneral/big/photoPerfil_SM_".$iIdUser)){
		$aUser['photo']="photoDefault.jpg";
	}


	
	
	
	
	#Validacion de datos del Personal Data
	if(!isset($aUser['day']) 	|| empty($aUser['day']) || !is_numeric($aUser['day']))
		$aErrores['date'] 	 = 'Day field empty.';
	if(!isset($aUser['month']) 	|| empty($aUser['month']) || !is_numeric($aUser['month']))
		$aErrores['date'] 	 = 'Month field empty.';
	if(!isset($aUser['year']) 	|| empty($aUser['year']) || !is_numeric($aUser['year']))
		$aErrores['date'] 	 = 'Year field empty.';
	if(!isset($aUser['countryId']) || empty($aUser['countryId'])){
		$aErrores['country'] = 'Country field empty.';	
	}
	if(!isset($aUser['cityId']) 		|| empty($aUser['cityId']))
		$aErrores['city']    = 'City field empty.';	
	
	if(!isset($aForm['sex']) && trim($aForm['sex'])===""){
		$aErrores['sex']     = 'Sex field empty.';
		
	}
	
	
		
	#si hubo errores, los escribo y no se modifica los datos del user
	if (sizeof($aErrores) > 0)
	{
		global $_IDIOMA;
		
		if (isset($aErrores['date']))#dayOfBirthDay
		{
			$oRespuesta->script("$('#dayAg').tipsy({ trigger: 'manual', gravity:'e', fallback:'->'});");
			$oRespuesta->script("$('#dayAg').tipsy('show');");
			//$oRespuesta->script("$('#selDate').fadeOut('slow');");
			unset($aErrores['date']);
		}
		if (isset($aErrores['country']))#country
		{
			$oRespuesta->script("$('#textShowed').tipsy({ trigger: 'manual', gravity:'e', fallback:'->'});");
			$oRespuesta->script("$('#textShowed').tipsy('show');");
			//$oRespuesta->script("$('#textShowed').fadeOut('slow');");
			unset($aErrores['country']);
		}
		if (isset($aErrores['city']))#city
		{
			$oRespuesta->script("$('#textShowed3').tipsy({ trigger: 'manual', gravity:'e', fallback:'->'});");
			$oRespuesta->script("$('#textShowed3').tipsy('show');");
			//$oRespuesta->script("$('#textShowed3').fadeOut('slow');");
			unset($aErrores['city']);
		}
		if (isset($aErrores['sex']))#sex
		{
			$oRespuesta->script("$('#personalData-sex').tipsy({ trigger: 'manual', gravity:'e', fallback:'->'});");
			$oRespuesta->script("$('#personalData-sex').tipsy('show');");
			unset($aErrores['sex']);
		
		}
		
		
		}else{	
		#Si esta todo ok, modifica los datos
		
		/////////Check if cityName hs any spaces and deletes them//////////
		$exp=explode(' ',$aForm['cityName']);
			$word='';
			
			foreach($exp as $eExp){
			
				if (strlen($eExp)>0) {
					if(empty($word)){
						$word=$eExp;
					}else{
						$word=$word.' '.$eExp;
					}	
					
				}
			}
		/////set the correct cityName/////	
		$aUser['cityName']=$word;
		$aUser['dayOfBirthDay']=$aUser['year']."/".$aUser['month']."/".$aUser['day'];
		unset($aUser['day']);
		unset($aUser['month']);
		unset($aUser['year']);
		////////////////////////////////////////////////////////////////////////
		
		#Si esta todo ok, modifica los datos
		if($SITE->modificarUsuario($iIdUser , $aUser))
		{
			global $_IDIOMA;
			$oRespuesta->script("$('#generalFormAmistoso').fadeOut();");#hide register amistoso
			$oRespuesta->assign("msjGeneralRegister", "innerHTML", '<br>'.$_IDIOMA->traducir("Thanks for completing your data!").' <input type="hidden" name="generalProfileComplete" id="generalProfileComplete" value="1"/>' );
			$oRespuesta->script("$('#msjGeneralRegister').fadeIn();");#Open msj Exitoso
			$oRespuesta->assign("generalProfileComplete", "innerHTML", '' );
			$oRespuesta->script("$('#professionalData').fadeIn('slow');");#Open DIV Data Profesional
			 
			 
			 
			 
			 
			 
			///////if is set Other City it saves the city in the table/////////
			$cFields=array();
			$cFields['CountryCode']=$aForm['countryId'];
						
			$cCo=new CityCountry();
			
			$res=$cCo->selectProfile('city','Name',"Name LIKE '%".$word."%'");
			$cFields['Name']=$word;
			
			if($res[0]==''){
				$cCo->addProfile('city',$cFields);
			}
			/////////////////////////////////////////////////////////////////// 
			 
			 
			 
			 
			 
			return $oRespuesta;
			
		
		}
		else 
		{
			$oRespuesta->assign("msjGeneralRegister", "innerHTML", 'Please, Try Again!' );
			$oRespuesta->script("$('#msjGeneralRegister').fadeIn();");#Open msj NO Exitoso
			return $oRespuesta;
			
		}
	}
	return $oRespuesta;
}

# trae los datos del form
function getParametros($aForm)
{

		$aUser = array();
		$aUser['id'] 					=   $aForm['iSMuIdKey'];
		$aUser['profileId'] 		   	=	$aForm['iSMuProfTypeKey'];
		$aUser['countryId'] 			=	$aForm['countryId'];
		$aUser['countryName'] 			=	$aForm['countryName'];
		if(isset($aForm['cityId']) && isset($aForm['cityName'])){
			$aUser['cityId'] 	=	$aForm['cityId'];
			$aUser['cityName']	=	$aForm['cityName'];
		}

/*Begin Andres*/
//$aForm['day'];//day
//$aForm['month'];//month
//$aForm['year'];//year

		$aUser['day']=$aForm['day'];
		$aUser['month']=$aForm['month'];
		$aUser['year']=$aForm['year'];//tiene que tomar el valor de los otros 3 campos
//		$aUser['dayOfBirthDay'] 		= 	$aForm['dayOfBirthDay'];
/*End Andres*/
		$aUser['photo'] 	= 	$aForm['photo'];
		
		if(isset($aForm['sex']) && !trim($aForm['sex'])!==""){
			
			if($aForm['sex']=="2"){
				$aUser['sex'] = 0;
			}else{	
				$aUser['sex'] =	$aForm['sex'];
			}
		}
		
		
		
		
		#cambio formato fecha
		if(!empty($aUser['dayOfBirthDay']))
			$aUser['dayOfBirthDay']=explode2Edad($aUser['dayOfBirthDay']);
			
		return $aUser;		
}

//exploto el formato de fecha
function explode2Edad($edad){
	list($dia,$mes,$anio) = explode("/",$edad);
	return $edad= $anio.'-'.$mes.'-'.$dia;
}

# Funciones del form de Loguin
function mostrarRegisterAmistoso()
{ 
    $oRespuesta = new xajaxResponse();
	$oRespuesta->script("$('#loguin').fadeIn();");#Open loguin & general register
    return $oRespuesta;
}


	
$oXajaxRegisterAmistoso=new xajax();
$oXajaxRegisterAmistoso->registerFunction("validaRegisterAmistoso");
$oXajaxRegisterAmistoso->processRequest();
?>

