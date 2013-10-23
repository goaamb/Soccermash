
<?
/////////////////////////////////////////////////////////////////////////////////
require_once('gestion/lib/share/clases/search/buscador.js.php');

//////////////if exists the profile id from de register////////////////////
if(isset($_SESSION["iSMuProfTypeKey"])){
if($_SESSION["iSMuProfTypeKey"]!=0){



$idUser=$_SESSION["iSMuIdKey"];
$idProfile=$_SESSION["iSMuProfTypeKey"];

//echo 'ei prof: ',$_SESSION["iSMuProfTypeKey"];
/////////////////////Set the contract value/////////////////////////////////////////////
if($idProfile==2 || $idProfile==7 || $idProfile==9 || $idProfile==11){
	$contract='1';
}else{
	$contract='0';
}
//////////////////////////////////////////////////////////////////////////////////////////


echo '<div id="professionalData" style="display:none">';


if($idProfile<7){

	if($idProfile==6){
		$clubTag="Last Club";	
	}else{
		$clubTag="Current Club";
	}	
	///////////Player//////////////////////////

	echo '
	
	
		
	 <div id="playerFields">

      	<h1>Professional Data</h1>
      
	  
	  <form class="frm" method="post" id="playerFieldsForm">

                   
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
					
					<input type="hidden" name="contract" id="contract" value="'.$contract.'" />
					
					<input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<span class="clear pos"><label for="nick">Sport Nick Name
                    <input class="input" type="text" name="nick" id="nick" /></label> 
					<div id="nickAdvisorPlayer" class="alerts"></div>
					</span>
                    ';
					
					///Player without contract///
					if($idProfile!=3){
						
					echo '			
                   
				    
				   
				    <span class="clear pos" id="span_hclub"><label class="posLabel2">'.$clubTag.'
                    <script type="text/javascript">buscador(\'espacio1\',\'club\',\'clubes\',\'hclub\',\'\',\'\');</script>
                    </label>
                    </span>

                    
                    <span class="pos clear" style="display:none;" id="other_Hclub"><label>Other Club
                    <input class="input" type="text" name="otherClub" id="otherClub" /></label>
					</span>
					
					<span class="pos clear"><label>
					<div id="clubAdvisorPlayer" class="alerts"></div>
					</span>			
					';
					 
					}
					
					///Player with contract///
					if($idProfile==2){
						
					echo '			
						 <span class="clear pos"><label>Ending contract date
						<input class="input" type="text" name="endingContractDate" id="endingContractDate"/></label>
						<div id="dateAdvisorPlayer" class="alerts"></div>
						</span>';
						}
					
					echo'
                    
                    <span class="clear pos">
                    <label class="posLabel">Position</label>
                    <div id="playField">
                    <label class="lblField" id="posit0" for="position0"><input class="spCheck" type="checkbox"  name="position0" id="position0"  /></label>
                    <label class="lblField" id="posit1" for="position1"><input class="spCheck" type="checkbox"  name="position1" id="position1"  /></label>
                    <label class="lblField" id="posit2" for="position2"><input class="spCheck" type="checkbox"  name="position2" id="position2"  /></label>
                    <label class="lblField" id="posit3" for="position3"><input class="spCheck" type="checkbox"  name="position3" id="position3"  /></label>
                    <label class="lblField" id="posit4" for="position4"><input class="spCheck" type="checkbox"  name="position4" id="position4"  /></label>
                    <label class="lblField" id="posit5" for="position5"><input class="spCheck" type="checkbox"  name="position5" id="position5"  /></label>
                    <label class="lblField" id="posit6" for="position6"><input class="spCheck" type="checkbox"  name="position6" id="position6"  /></label>
                    <label class="lblField" id="posit7" for="position7"><input class="spCheck" type="checkbox"  name="position7" id="position7"  /></label>
                    <label class="lblField" id="posit8" for="position8"><input class="spCheck" type="checkbox"  name="position8" id="position8"  /></label>
                    <label class="lblField" id="posit9" for="position9"><input class="spCheck" type="checkbox"  name="position9" id="position9"  /></label>
                    <label class="lblField" id="posit10" for="position10"><input class="spCheck" type="checkbox"  name="position10" id="position10"  /></label>
                    </div>
					<div id="posAdvisorPlayer" class="alerts"></div>
                    </span>
                    <span class="clear pos">
                    	<input class="submit" type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onclick="validatePlayer();" /> 
                 </span>
                </form>
    
             <div class="frm txtRight alerts" id="resultProfilePlayer"></div>
      	</div><!--END specificFields-->
		';
	
	
	
}elseif($idProfile<13){
	//////////Coach/////////////////////////////
	 if($idProfile==8 || $idProfile==10 || $idProfile==12){
		$clubTag="Last Club";	
	}else{
		$clubTag="Current Club";
	}
	
	echo' 
	<div id="coachWiContr"> 

      	<h1>Professional Data</h1>
      
      	<form class="frm" method="post" id="coachFieldsForm">


                    <input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
					
					<input type="hidden" name="contract" id="contract" value="'.$contract.'" />
					
					
					<span class="clear pos"><label for="nick">Sport Nick Name
                    <input class="input" type="text" name="nick" id="nick" /></label> 
					<div id="nickAdvisorCoach" class="alerts"></div>
					</span>
                   

                   <span class="clear pos" id="span_hclub"><label class="posLabel2">'.$clubTag.'
                     <script type="text/javascript">buscador(\'espacio1\',\'club\',\'clubes\',\'hclub\',\'\',\'\');</script>
                    </label>
                    </span>                  
                  
				  
				  <span class="pos clear" style="display:none;" id="other_Hclub"><label>Other Club
                    <input class="input" type="text" name="otherClub" id="otherClub" /></label>
					<div id="clubAdvisorCoach" class="alerts"></div>
					</span> 
					
					<span class="pos clear"><label>
					<div id="clubAdvisorPlayer" class="alerts"></div>
					</span>	
					
				  ';
				  
				  //////////////Coach under Contract///////////////
                  if($idProfile!=8 && $idProfile!=10 && $idProfile!=12){
						
					echo '			
						 <span class="clear pos"><label>Ending contract date
						<input class="input" type="text" name="endingContractDate" id="endingContractDate"/></label>
						<div id="dateAdvisorCoach" class="alerts"></div>
						</span>';
						}
					
					echo'
                    <span class="clear pos">
                    	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onclick="validateCoach();" /> 
                      
                  	</span>
                  </form>
				  
				  
				 <div class="frm txtRight alerts" id="resultProfileCoach"></div> 
				  
      	</div><!--END coachWiContr-->
	
	
	
	';
	
}elseif($idProfile<16){
	//////////Agent/////////////////////////////
	if($idProfile==13){
		$numberType='FIFA licence number';
	}elseif($idProfile==14){
		$numberType='UEFA licence number';
	}elseif($idProfile==15){
		$numberType='Licence number';
	}
	
	echo '
	<div id="FIFAagent"> 

      	<h1>Professional Data</h1>
      
      	<form class="frm" method="post" id="agentFieldsForm">
                    
                    <input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
                    
                    
                     <span class="clear pos" id="span_federation"><label class="posLabel2">Federation
                     <script type="text/javascript">buscador(\'espacio1\',\'federat\',\'federations\',\'federation\',\'\',\'\');</script>
                    </label>
                    </span>
					
					<span class="pos clear" style="display:none" id="other_Federation"><label for="otherFederation">Other Federation
                    <input class="input" type="text" name="otherFederation" id="otherFederation" /></label>
					</span>    
					
					<span class="pos clear">
					<div class="alerts" id="federationAdvisorAgent"></div>
					</span>  
					
					<span class="pos clear"><label for="licenceNumber">'.$numberType.'
                    <input class="input" type="text" name="licenceNumber" id="licenceNumber" /></label>
					<div class="alerts" id="numberAdvisorAgent"></div>
					</span>                 

                    <span class="clear pos">
                    	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onclick="validateAgent();" /> 
                     
                  	</span>
                  </form>
				  
				 
				  
      	</div><!--END FIFAagent-->
			 <div class="frm txtRight alerts" id="resultProfileAgent"></div>

	';
	

}elseif($idProfile==16){
	//////////SCOUT/////////////////////////////
	echo '
	<div id="FIFAagent"> 

      	<h1>Professional Data</h1>
	<form class="frm" method="post" id="scoutFieldsForm">
	
					<input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />


	
	                <span class="clear pos" id="span_hclub"><label class="posLabel2">Club
                    <script type="text/javascript">buscador(\'espacio1\',\'club\',\'clubes\',\'hclub\',\'\',\'\');</script>
                    </label>
                    </span>

                    
                    <span class="pos clear" style="display:none;" id="other_Hclub"><label>Other Club
                    <input class="input" type="text" name="otherClub" id="otherClub" /></label>
					</span>
					
					<span class="pos clear"><label>
					<div id="clubAdvisorScout" class="alerts"></div>
					</span>			


	<span class="clear pos">
	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onClick="validateScout();"/>
	</span>

	</form>
	
	</div>
	<div id="resultProfileScout" class="frm txtRight alerts"></div>
	
	
	';


}elseif($idProfile==17){
	//////////Lawyer/////////////////////////////
	echo '
	
	<div id="FIFAagent"> 
	<h1>Professional Data</h1>
	
	<form class="frm" method="post" id="lawyerFieldsForm">
	
					<input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />

	 
	 
	 <span class="clear pos" id="span_asociation"><label class="posLabel2">Professional Asociation
     <script type="text/javascript">buscador(\'espacio1\',\'asociat\',\'companies\',\'asociation\',\'\',\'\');</script>
     </label>
     </span>
	 
	 <span class="pos clear" style="display:none;" id="other_Asociation"><label>Other Asociation
	<input class="input" type="text" name="otherAsociation" id="otherAsociation" /></label>
	</span>
	
	 <span class="pos clear"><label>
	<div class="alerts" id="asociationAdvisorLawyer"></div>
	</span>
	
	
	
	<span class="clear pos" id="span_enterprise"><label class="posLabel2">Enterprise
     <script type="text/javascript">buscador(\'espacio2\',\'enterp\',\'companies\',\'enterprise\',\'\',\'\');</script>
     </label>
     </span>
	
	
	 <span class="pos clear" style="display:none;" id="other_Enterprise"><label>Other Enterprise
	<input class="input" type="text" name="otherEnterprise" id="otherEnterprise" /></label>
	</span>
	
	
	<span class="pos clear"><label>
	<div class="alerts" id="enterpriseAdvisorLawyer"></div>
	</span>
	
	';
	
		
	//$country=new CountryList();
	$country->init('hcountry','Country developing activity','textShowed2','showIT2','selector2','-95');
	
	
	echo '
	
	 <span class="clear pos"> <div class="alerts" id="countryAdvisorLawyer"></div></span>
	
	  				
					
	<span class="clear pos">
	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onClick="validateLawyer();"/>
	</span>
	
	</form>
	
	</div>
	
	
	<div id="resultProfileLawer" class="frm txtRight alerts"></div>
	
	
	';
	

}elseif($idProfile<20){
	//////////MANAGER - Sport Director/////////////////////////////
	 /*if($idProfile==8 || $idProfile==10 || $idProfile==12){
		$clubTag="Last Club";	
	}else{
		$clubTag="Current Club";
	}*/
	
	echo' 
	<div id="coachWiContr"> 

      	<h1>Professional Data</h1>
      
      	<form class="frm" method="post" id="managerFieldsForm">


                    <input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
					
					<!--<input type="hidden" name="contract" id="contract" value="'.$contract.'" />-->
                   

                   <span class="clear pos" id="span_hclub"><label class="posLabel2">Club
                     <script type="text/javascript">buscador(\'espacio1\',\'club\',\'clubes\',\'hclub\',\'\',\'\');</script>
                    </label>
                    </span>                  
                  
				  
				  <span class="pos clear" style="display:none;" id="other_Hclub"><label>Other Club
                    <input class="input" type="text" name="otherClub" id="otherClub" /></label>
					</span> 
					
					 <span class="pos clear">
					<div id="clubAdvisorManager" class="alerts"></div>
					</span>
				  ';
				  
				  //////////////Manager with Contract///////////////
                  /*if($idProfile!=8 && $idProfile!=10 && $idProfile!=12){
						
					echo '			
						 <span class="clear pos"><label>Ending contract date
						<input class="input" type="text" name="endingContractDate" id="endingContractDate"/></label>
						<div id="dateAdvisorCoach" class="alerts"></div>
						</span>';
						}*/
					
					echo'
                    <span class="clear pos">
                    	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onclick="validateManager();" /> 
                      
                  	</span>
                  </form>
				  
				  
				 <div class="frm txtRight alerts" id="resultProfileManager"></div> 
				  
      	</div><!--END coachWiContr-->
	
	
	
	';
	


}elseif($idProfile<23){
	//////////MKEDIC/////////////////////////////
	echo '
	<div id="FIFAagent"> 

      	<h1>Professional Data</h1>
	<form class="frm" method="post" id="medicFieldsForm">
	
					<input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
					
					
					<span class="pos clear"><label for="licenceNumber">Licence Number
                    <input class="input" type="text" name="licenceNumber" id="licenceNumber" /></label>
					<div class="alerts" id="numberAdvisorMedic"></div>
					</span>
					
					 <span class="clear pos" id="span_federation"><label class="posLabel2">Professional Asociation
					 <script type="text/javascript">buscador(\'espacio1\',\'federat\',\'companies\',\'federation\',\'\',\'\');</script>
					 </label>
					 </span>
					 
					 <span class="pos clear" style="display:none;" id="other_Federation"><label>Other Asociation
					<input class="input" type="text" name="otherFederation" id="otherFederation" /></label>
					</span>
					
					 <span class="pos clear"><label>
					<div class="alerts" id="federationAdvisorMedic"></div>
					</span>
					
				
						
	             <span class="clear pos" id="span_hclub"><label class="posLabel2">Club
                     <script type="text/javascript">buscador(\'espacio2\',\'club\',\'clubes\',\'hclub\',\'\',\'\');</script>
                    </label>
                    </span>                  
                  
				  
				  <span class="pos clear" style="display:none;" id="other_Hclub"><label>Other Club
                    <input class="input" type="text" name="otherClub" id="otherClub" /></label>
					</span> 
					
					 <span class="pos clear">
					<div id="clubAdvisorMedic" class="alerts"></div>
					</span>
					
					
					
					 
					
					
					

	<span class="clear pos">
	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onClick="validateMedic();"/>
	</span>

	</form>
	
	</div>
	<div id="resultProfileMedic" class="frm txtRight alerts"></div>
	
	
	';
	
	


}elseif($idProfile==23){
	//////////FAN/////////////////////////////
	echo '
	<div id="FIFAagent"> 

      	<h1>Professional Data</h1>
	<form class="frm" method="post" id="fanFieldsForm">
	
					<input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />

					
					<span class="clear pos"><label for="nick">Sport Nick Name
                    <input class="input" type="text" name="nick" id="nick" /></label> 
					<div id="nickAdvisorFan" class="alerts"></div>
					</span>
					
					
					<span class="clear pos"><label for="ocupation">Ocupation
                    <input class="input" type="text" name="ocupation" id="ocupation" /></label> 
					<div id="ocupationAdvisorFan" class="alerts"></div>
					</span>
                    
					
	
	                <span class="clear pos" id="span_hclub"><label class="posLabel2">Favourite Club
                     <script type="text/javascript">buscador(\'espacio2\',\'club\',\'clubes\',\'hclub\',\'\',\'\');</script>
                    </label>
                    </span>                  
                  
				  
				  <span class="pos clear" style="display:none;" id="other_Hclub"><label>Other Club
                    <input class="input" type="text" name="otherClub" id="otherClub" /></label>
					</span> 
					
					 <span class="pos clear">
					<div id="clubAdvisorFan" class="alerts"></div>
					</span>


	<span class="clear pos">
	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onClick="validateFan();"/>
	</span>

	</form>
	
	</div>
	<div id="resultProfileFan" class="frm txtRight alerts"></div>
	
	
	';
	

}elseif($idProfile==24){
	//////////Journalist/////////////////////////////
		
	echo '
	<div id="FIFAagent"> 

      	<h1>Professional Data</h1>
      
      	<form class="frm" method="post" id="journalistFieldsForm">
                    
                    <input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
                    
                    
                     <span class="clear pos" id="span_federation"><label class="posLabel2">Professional Asociation
					 <script type="text/javascript">buscador(\'espacio1\',\'federat\',\'companies\',\'federation\',\'\',\'\');</script>
					 </label>
					 </span>
					 
					 <span class="pos clear" style="display:none;" id="other_Federation"><label>Other Federation
					<input class="input" type="text" name="otherFederation" id="otherFederation" /></label>
					</span>
					
					<span class="pos clear">					
					<div class="alerts" id="federationAdvisorJournalist"></div>
					</span>
					
					
					
					<span class="clear pos" id="span_company"><label class="posLabel2">Medium/Company
					 <script type="text/javascript">buscador(\'espacio2\',\'compan\',\'companies\',\'company\',\'\',\'\');</script>
					 </label>
					 </span>
					
					
					 <span class="pos clear" style="display:none;" id="other_Company"><label>Other Medium/Company
					<input class="input" type="text" name="otherCompany" id="otherCompany" /></label>
					<div class="alerts" id="companyAdvisorJournalist"></div>
					</span>
					
					 <span class="pos clear">
					<div class="alerts" id="companyAdvisorJournalist"></div>
					</span>
					
					
					<span class="pos clear"><label for="licenceNumber">Journalist Number
                    <input class="input" type="text" name="licenceNumber" id="licenceNumber" /></label>
					<div class="alerts" id="numberAdvisorJournalist"></div>
					</span>                 

                    <span class="clear pos">
                    	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onclick="validateJournalist();" /> 
                     
                  	</span>
                  </form>
				  
				 
				  
      	</div><!--END FIFAagent-->
			 <div class="frm txtRight alerts" id="resultProfileJournalist"></div>

	';




}elseif($idProfile==25){
	//////////Federation/////////////////////////////
		
	echo '
	<div id="FIFAagent"> 

      	<h1>Professional Data</h1>
      
      	<form class="frm" method="post" id="federationFieldsForm">
                    
                    <input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
                    ';
                    
					$country->init('hcountry','Country','textShowed2','showIT2','selector2','12');
					
					echo'
					
					<span class="clear pos"> <div class="alerts" id="countryAdvisorFederation"></div></span>
					
					<span class="pos clear"><label for="name">Federation Name
                    <input class="input" type="text" name="name" id="name" /></label>
					<div class="alerts" id="nameAdvisorFederation"></div>
					</span>
					
					<span class="pos clear"><label for="nickName">Federation Nick Name
                    <input class="input" type="text" name="nickName" id="nickName" /></label>
					<div class="alerts" id="nickAdvisorFederation"></div>
					</span>
					
					<span class="pos clear"><label for="fifa code">FIFA Code
                    <input class="input" type="text" name="fifaCode" id="fifaCode" /></label>
					<div class="alerts" id="codeAdvisorFederation"></div>
					</span>
					
					 <span class="clear pos"><label>Foundation date
						<input class="input" type="text" name="foundationDate" id="foundationDate"/></label>
						<div id="foundationAdvisorFederation" class="alerts"></div>
						</span>
					
                     
                    <span class="clear pos">
                    	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onclick="validateFederation();" /> 
                     
                  	</span>
                  </form>
				  
				 
				  
      	</div><!--END FIFAagent-->
			 <div class="frm txtRight alerts" id="resultProfileFederation"></div>

	';
	
	
	
}elseif($idProfile==26){
	//////////Club/////////////////////////////
		
	echo '
	<div id="FIFAagent"> 

      	<h1>Professional Data</h1>
      
      	<form class="frm" method="post" id="clubFieldsForm">
                    
                    <input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
                    ';
                    
					$country->init('hcountry','Country','textShowed2','showIT2','selector2','12');
					
					echo'
					
					<span class="clear pos"> <div class="alerts" id="countryAdvisorClub"></div></span>
					
					
					<span class="pos clear"><label for="name">Club Name
                    <input class="input" type="text" name="name" id="name" /></label>
					<div class="alerts" id="nameAdvisorClub"></div>
					</span>
					
					<span class="pos clear"><label for="nick">Club Nick Name
                    <input class="input" type="text" name="nick" id="nick" /></label>
					<div class="alerts" id="nickAdvisorClub"></div>
					</span>
					
					
					 <span class="clear pos" id="span_federation"><label class="posLabel2">Federation
					 <script type="text/javascript">buscador(\'espacio1\',\'federat\',\'federations\',\'federation\',\'\',\'\');</script>
					 </label>
					 </span>
					 
					 <span class="pos clear" style="display:none;" id="other_Federation"><label>Other Federation
					<input class="input" type="text" name="otherFederation" id="otherFederation" /></label>
					</span>
					
					<span class="pos clear">					
					<div class="alerts" id="federationAdvisorClub"></div>
					</span>
					
					
					<span class="clear pos"><label>Foundation date
						<input class="input" type="text" name="foundationDate" id="foundationDate"/></label>
						<div id="foundationAdvisorClub" class="alerts"></div>
						</span>
					

                    <span class="clear pos">
                    	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onclick="validateClub();" /> 
                     
                  	</span>
                  </form>
				  
				 
				  
      	</div><!--END FIFAagent-->
			 <div class="frm txtRight alerts" id="resultProfileClub"></div>

	';	
	
	
	
}elseif($idProfile==27){
	//////////Company/////////////////////////////
		
	echo '
	<div id="FIFAagent"> 

      	<h1>Professional Data</h1>
      
      	<form class="frm" method="post" id="companyFieldsForm">
                    
                    <input type="hidden" name="idUsr" id="idUsr" value="'.$idUser.'" />
					
					<input type="hidden" name="idProfile" id="idProfile" value="'.$idProfile.'" />
                   
					
					';
                    
					$country->init('hcountry','Country','textShowed2','showIT2','selector2','12');
					
					echo'
					
					<span class="clear pos"> <div class="alerts" id="countryAdvisorCompany"></div></span>
					
					
					<span class="pos clear"><label for="name">Company Name
                    <input class="input" type="text" name="name" id="name" /></label>
					<div class="alerts" id="nameAdvisorCompany"></div>
					</span>
					
					
					
					<span class="clear pos"><label>Foundation date
						<input class="input" type="text" name="foundationDate" id="foundationDate"/></label>
						<div id="foundationAdvisorCompany" class="alerts"></div>
						</span>
					

                    <span class="clear pos">
                    	<input type="button" value="CONTINUE" alt="CONTINUE" id="saveButton" onclick="validateCompany();" /> 
                     
                  	</span>
                  </form>
				  
				 
				  
      	</div><!--END FIFAagent-->
			 <div class="frm txtRight alerts" id="resultProfileCompany"></div>

	';		

	
}//if









echo '</div>';








}//if!=0
}//if exists

?>

