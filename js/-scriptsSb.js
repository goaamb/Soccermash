///////////////////////////////////////////////////////////////////////////////////////
//////////////////Specific Fields - Friendly Register//////////////////////////////////

/////////////////////////////////////////////////////////////////////
//////////hide me - hides elements by id/////////////////
function hide_me(val){

$("#"+val).hide('fast');
$('#modules').show();

}


//////////unhide me - unhides elements by id/////////////////
function unhide_me(val){

$("#"+val).show('fast');

}	


///////////////set path for saving file/////////////////////

var profilePath="gestion/modulos/profile/profileSave.php";



/////////validatePlayer///////////	
function validatePlayer(){

var pos=''; 


for(i=0;i<11;i++){
	if($("#position"+i).is(':checked')){
		pos=i+1+','+pos;
	}
}


if($("#nick").val()==''){
	//$('#nickAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your Nick'});
	$('#nickAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#nickAdvisorPlayer').tipsy('show');
//$("#nickAdvisorPlayer").html('* please, complete your Nick');


}else{
	$('#nickAdvisorPlayer').tipsy('hide');
	//$("#nickAdvisorPlayer").html('');
}


if($("#idProfile").val()!=3){
	if($("#otherClub").val()=='' && $("#hclub").val()==''){
		//$('#clubAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your club'});
		$('#clubAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
		$('#clubAdvisorPlayer').tipsy('show');
		//$("#clubAdvisorPlayer").html('* please, complete your Club');
		var clubComp ='';
	}else {
		$('#clubAdvisorPlayer').tipsy('hide');
		//$("#clubAdvisorPlayer").html('');
		var clubComp ='complete';
	}
}//if it doesnt have contract



/*if($("#idProfile").val()==2){
	if($("#endingContractDate").val()==''){
		$('#dateAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'Select the date'});
		$('#dateAdvisorPlayer').tipsy('show');
		//$("#dateAdvisorPlayer").html('* please, select the date');	
	}else{
		$('#dateAdvisorPlayer').tipsy('hide');
		//$("#dateAdvisorPlayer").html('');	
	}
}//only if it has contract
*/

if(pos==''){
	//$('#posAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'Select your position'});
	$('#posAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#posAdvisorPlayer').tipsy('show');
	//$("#posAdvisorPlayer").html('* please, select your position');		
}else{
	$('#posAdvisorPlayer').tipsy('hide');
	//$("#posAdvisorPlayer").html('');
}





if($("#nick").val()!='' && clubComp!='' /*&& $("#endingContractDate").val()!=''*/ && pos!=''){

var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var contract=$("#contract").val();
var nick=$("#nick").val();
var hclub=$("#hclub").val();
var clubName=$("#club").val();
var otherClub=$("#otherClub").val();
//var endingContractDate=$("#endingContractDate").val();
var dayECD=$("#dayECD").val();
var monthECD=$("#monthECD").val();
var yearECD=$("#yearECD").val();





//alert(idUser);

$("#resultProfilePlayer").load(profilePath,{idUser:idUser,idProfile:idProfile,club:hclub,clubName:clubName,contract:contract,nick:nick,otherClub:otherClub,position:pos,dayECD:dayECD,monthECD:monthECD,yearECD:yearECD});


}

}






/////////////////Validate Coach////////////////////////////////////	
function validateCoach(){



if($("#nick").val()==''){
	//$('#nickAdvisorCoach').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your Nick'});
	$('#nickAdvisorCoach').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#nickAdvisorCoach').tipsy('show');
//$("#nickAdvisorPlayer").html('* please, complete your Nick');


}else{
	$('#nickAdvisorCoach').tipsy('hide');
	//$("#nickAdvisorPlayer").html('');
}



if($("#otherClub").val()=='' && $("#hclub").val()==''){
//	$('#clubAdvisorCoach').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your Club'});
	$('#clubAdvisorCoach').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#clubAdvisorCoach').tipsy('show');
	//$("#clubAdvisorCoach").html('* please, complete your Club');
	var clubComp ='';
}else {
	$('#clubAdvisorCoach').tipsy('hide');
	//$("#clubAdvisorCoach").html('');
	var clubComp ='complete';

}



/*if($("#idProfile").val()!=8 && $("#idProfile").val()!=10 && $("#idProfile").val()!=12){

	if($("#endingContractDate").val()==''){
		$('#dateAdvisorCoach').tipsy({trigger: 'manual', gravity:'e', fallback:'select the date'});
		$('#dateAdvisorCoach').tipsy('show');
		//$("#dateAdvisorCoach").html('* please, select the date');	
	
	}else{
		$('#dateAdvisorCoach').tipsy('hide');	
		//$("#dateAdvisorCoach").html('');	
	}

}//if it doesnt have contract
*/




if($('#nick').val!='' && clubComp!='' /*&& $("#endingContractDate").val()!=''*/){

var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var club=$("#hclub").val();
var nick=$("#nick").val();
var clubName=$("#club").val();
var otherClub=$("#otherClub").val();
var contract=$("#contract").val();;
//var endingContractDate=$("#endingContractDate").val();
var dayECD=$("#dayECD").val();
var monthECD=$("#monthECD").val();
var yearECD=$("#yearECD").val();

//alert('enter');

$("#resultProfileCoach").load(profilePath,{idProfile:idProfile,idUser:idUser,club:club,nick:nick,clubName:clubName,otherClub:otherClub,contract:contract,dayECD:dayECD,monthECD:monthECD,yearECD:yearECD});

}
}		






/////////////////Validate Agent////////////////////////////////////	
function validateAgent(){


if($("#federation").val()=='' && $("#otherFederation").val()==''){
	//$('#federationAdvisorAgent').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your federation/asociation/company'});
	$('#federationAdvisorAgent').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#federationAdvisorAgent').tipsy('show');
	//$("#federationAdvisorAgent").html('* please, complete your federation/asociation/company');
	var fed='';
}else{
	$('#federationAdvisorAgent').tipsy('hide');
	//$("#federationAdvisorAgent").html('');
	var fed='ok';
}



if($("#licenceNumber").val()==''){
	//$('#numberAdvisorAgent').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your licence number'});
	$('#numberAdvisorAgent').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#numberAdvisorAgent').tipsy('show');
	//$("#numberAdvisorAgent").html('* please, complete your licence number');
}else{
	$('#numberAdvisorAgent').tipsy('hide');
	//$("#numberAdvisorAgent").html('');
}







if(fed!='' && $("#licenceNumber").val()!=''){

var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var licenceNumber=$("#licenceNumber").val();
var federation=$("#federation").val();
var federationName=$("#federat").val();
var otherFederation=$("#otherFederation").val();

//alert('oka');
$("#resultProfileAgent").load(profilePath,{idProfile:idProfile,idUser:idUser,licenceNumber:licenceNumber,federation:federation,federationName:federationName,otherFederation:otherFederation});

}
}




/////////////////Validate Scout////////////////////////////////////	
function validateScout(){

	if($("#otherClub").val()=='' && $("#hclub").val()==''){
//		$('#clubAdvisorScout').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your club'});
		$('#clubAdvisorScout').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
		$('#clubAdvisorScout').tipsy('show');
		//$("#clubAdvisorScout").html('* please, complete your Club');
		var clubComp ='';
	}else {
		$('#clubAdvisorScout').tipsy('hide');
		//$("#clubAdvisorCoach").html('');
		var clubComp ='complete';
	
	}
	
	if(clubComp!=''){
		
		var idUser=$("#idUsr").val();
		var idProfile=$("#idProfile").val();
		var club=$("#hclub").val();
		var clubName=$("#club").val();
		var otherClub=$("#otherClub").val();
		
		$("#resultProfileScout").load(profilePath,{idProfile:idProfile,idUser:idUser,club:club,clubName:clubName,otherClub:otherClub});
	
	}
}		



/////////////////Validate Lawyer////////////////////////////////////	
function validateLawyer(){

if($("#asociation").val()=='' && $("#otherAsociation").val()==''){
	//$('#asociationAdvisorLawyer').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your asociation'});
	$('#asociationAdvisorLawyer').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#asociationAdvisorLawyer').tipsy('show');
	//$("#asociationAdvisorLawyer").html('* please, complete your asociation');
	var asoc='';
}else{
	$('#asociationAdvisorLawyer').tipsy('hide');
	//$("#asociationAdvisorLawyer").html('');
	var asoc='ok';
}


if($("#enterprise").val()=='' && $("#otherEnterprise").val()==''){
	//$('#enterpriseAdvisorLawyer').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your enterprise'});
	$('#enterpriseAdvisorLawyer').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#enterpriseAdvisorLawyer').tipsy('show');
	//$("#enterpriseAdvisorLawyer").html('* please, complete your enterprise');
	var enter='';
}else{
	$('#enterpriseAdvisorLawyer').tipsy('hide');
	//$("#enterpriseAdvisorLawyer").html('');
var enter='ok';
}


if($("#hcountry").val()==''){
	//$('#countryAdvisorLawyer').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your country developing activity'});
	$('#countryAdvisorLawyer').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#countryAdvisorLawyer').tipsy('show');
	//$("#countryAdvisorLawyer").html('* please, complete your country developing activity');
}else{
	$('#countryAdvisorLawyer').tipsy('hide');
	//$("#countryAdvisorLawyer").html('');
}


if(asoc!='' && enter!='' && $("#hcountry").val()!=''){

var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var asociation=$("#asociation").val();
var asociationName=$("#asociat").val();
var enterprise=$("#enterprise").val();
var enterpriseName=$("#enterp").val();
var otherAsociation=$("#otherAsociation").val();
var otherEnterprise=$("#otherEnterprise").val();
var countryActivity=$("#hcountry").val();


$("#resultProfileLawer").load(profilePath,{idProfile:idProfile,idUser:idUser,asociation:asociation,asociationName:asociationName,otherAsociation:otherAsociation,otherEnterprise:otherEnterprise,enterprise:enterprise,enterpriseName:enterpriseName,countryActivity:countryActivity});


}
}



/////////////////Validate manager////////////////////////////////////	
function validateManager(){

if($("#otherClub").val()=='' && $("#hclub").val()==''){

	//$("#clubAdvisorManager").html('* please, complete your Club');
	//$('#clubAdvisorManager').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your club'});
	$('#clubAdvisorManager').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#clubAdvisorManager').tipsy('show');
	var clubComp ='';
}else {
	$('#clubAdvisorManager').tipsy('hide');
	//$("#clubAdvisorManager").html('');
	var clubComp ='complete';

}

if(clubComp!=''){

var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var club=$("#hclub").val();
var clubName=$("#club").val();
var otherClub=$("#otherClub").val();

$("#resultProfileManager").load(profilePath,{idProfile:idProfile,idUser:idUser,club:club,clubName:clubName,otherClub:otherClub});

}
}		







/////////////////Validate Medic////////////////////////////////////	
function validateMedic(){



if($("#federation").val()=='' && $("#otherFederation").val()==''){
	//$('#federationAdvisorMedic').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your federation/asociation'});
	$('#federationAdvisorMedic').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#federationAdvisorMedic').tipsy('show');
	//$("#federationAdvisorMedic").html('* please, complete your federation/asociation');
	var fed='';
}else{
	$('#federationAdvisorMedic').tipsy('hide');
	//$("#federationAdvisorMedic").html('');
	var fed='ok';
}


if($("#licenceNumber").val()==''){
	//$('#numberAdvisorMedic').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your licence number'});
	$('#numberAdvisorMedic').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#numberAdvisorMedic').tipsy('show');
	//$("#numberAdvisorMedic").html('* please, complete your licence number');
}else{
	$('#numberAdvisorMedic').tipsy('show');

}



if($("#otherClub").val()=='' && $("#hclub").val()==''){
	//$('#clubAdvisorMedic').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your club'});
	$('#clubAdvisorMedic').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#clubAdvisorMedic').tipsy('show');
	//$("#clubAdvisorMedic").html('* please, complete your Club');
	var clubComp ='';
}else {
	$('#clubAdvisorMedic').tipsy('hide');
	//$("#clubAdvisorMedic").html('');
	var clubComp ='complete';

}

if(clubComp!='' && fed!='' && $("#licenceNumber").val()!=''){

var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var federation=$("#federation").val();
var federationName=$("#federat").val();
var otherFederation=$("#otherFederation").val();
var licenceNumber=$("#licenceNumber").val();
var club=$("#hclub").val();
var clubName=$("#club").val();
var otherClub=$("#otherClub").val();

$("#resultProfileMedic").load(profilePath,{idProfile:idProfile,idUser:idUser,club:club,clubName:clubName,otherClub:otherClub,federation:federation,federationName:federationName,otherFederation:otherFederation,licenceNumber:licenceNumber});

}
}		








/////////////////Validate Fan////////////////////////////////////	
function validateFan(){


if($("#nick").val()==''){
	//$('#nickAdvisorFan').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your nick'});
	$('#nickAdvisorFan').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#nickAdvisorFan').tipsy('show');

}else{
	$('#nickAdvisorFan').tipsy('hide');
}




/*if($("#ocupation").val()==''){
	$('#ocupationAdvisorFan').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your Ocupation'});
	$('#ocupationAdvisorFan').tipsy('show');

}else{
	$('#ocupationAdvisorFan').tipsy('hide');
}*/



if($("#otherClub").val()=='' && $("#hclub").val()==''){
	//$('#clubAdvisorFan').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your club'});
	$('#clubAdvisorFan').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#clubAdvisorFan').tipsy('show');
	var clubComp ='';
}else {
	$('#clubAdvisorFan').tipsy('hide');
	var clubComp ='complete';

}

if(clubComp!='' /*&& $("#ocupation").val()!=''*/ && $("#nick").val()!=''){

var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var nick=$("#nick").val();
//var ocupation=$("#ocupation").val();
var club=$("#hclub").val();
var clubName=$("#club").val();
var otherClub=$("#otherClub").val();

$("#resultProfileFan").load(profilePath,{idProfile:idProfile,idUser:idUser,nick:nick,club:club,clubName:clubName,otherClub:otherClub});

}
}		






/////////////////Validate Journalist////////////////////////////////////	
function validateJournalist(){


if($("#federation").val()=='' && $("#otherFederation").val()==''){
	//$('#federationAdvisorJournalist').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your federation/asociation'});
	$('#federationAdvisorJournalist').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#federationAdvisorJournalist').tipsy('show');
	var fed='';
}else{
	$('#federationAdvisorJournalist').tipsy('hide');
	var fed='ok';
}


if($("#company").val()=='' && $("#otherCompany").val()==''){
	//$('#companyAdvisorJournalist').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your medium/company'});
	$('#companyAdvisorJournalist').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#companyAdvisorJournalist').tipsy('show');
	var comp='';
}else{
	$('#companyAdvisorJournalist').tipsy('hide');
	var comp='ok';
}


if($("#licenceNumber").val()==''){
	//$('#numberAdvisorJournalist').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your licence number'});
	$('#numberAdvisorJournalist').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#numberAdvisorJournalist').tipsy('show');

}else{
	$('#numberAdvisorJournalist').tipsy('hide');

}





if(fed!='' && $("#licenceNumber").val()!='' && comp!=''){


var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var licenceNumber=$("#licenceNumber").val();
var federation=$("#federation").val();
var federationName=$("#federat").val();
var otherFederation=$("#otherFederation").val();
var company=$("#company").val();
var companyName=$("#compan").val();
var otherCompany=$("#otherCompany").val();


//alert('oka');
$("#resultProfileJournalist").load(profilePath,{idProfile:idProfile,idUser:idUser,licenceNumber:licenceNumber,federation:federation,federationName:federationName,otherFederation:otherFederation,company:company,companyName:companyName,otherCompany:otherCompany});

}
}








/////////////////Validate Federation////////////////////////////////////	
function validateFederation(){


if($("#name").val()==''){
	//$('#nameAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete the name'});
	$('#nameAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#nameAdvisorFederation').tipsy('show');

}else{
	$('#nameAdvisorFederation').tipsy('hide');
}



if($("#hcountry").val()==''){
	//$('#countryAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete the country'});
	$('#countryAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#countryAdvisorFederation').tipsy('show');

}else{
	$('#countryAdvisorFederation').tipsy('hide');

}


if($("#nickName").val()==''){
	//$('#nickAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete the nick name'});
	$('#nickAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#nickAdvisorFederation').tipsy('show');

}else{
	$('#nickAdvisorFederation').tipsy('hide');
}




if($("#fifaCode").val()==''){
	//$('#codeAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete the fifa code'});
	$('#codeAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#codeAdvisorFederation').tipsy('show');

}else{
	$('#codeAdvisorFederation').tipsy('hide');
}



if($("#foundationDate").val()==''){
	//$('#foundationAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your foundation date'});
	$('#foundationAdvisorFederation').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#foundationAdvisorFederation').tipsy('show');

}else{
	$('#foundationAdvisorFederation').tipsy('hide');
}



if($("#name").val()!='' && $("#fifaCode").val()!='' && $("#nickName").val()!=''  && $("#hcountry").val()!='' && $("#foundationDate").val()!=''){


var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var name=$("#name").val();
var nickName=$("#nickName").val();
var fifaCode=$("#fifaCode").val();
var foundationDate=$("#foundationDate").val();
var countryId=$("#hcountry").val();




$("#resultProfileFederation").load(profilePath,{idProfile:idProfile,idUser:idUser,fifaCode:fifaCode,foundationDate:foundationDate,countryId:countryId,nickName:nickName,name:name});

}
}




/////////////////Validate Club////////////////////////////////////	
function validateClub(){



if($("#hcountry").val()==''){
	//$('#countryAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your country'});
	$('#countryAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#countryAdvisorClub').tipsy('show');

}else{
	$('#countryAdvisorClub').tipsy('hide');

}


if($("#nick").val()==''){
	//$('#nickAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your nick'});
	$('#nickAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#nickAdvisorClub').tipsy('show');

}else{
	$('#nickAdvisorClub').tipsy('hide');
}


if($("#name").val()==''){
	//$('#nameAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your name'});
	$('#nameAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#nameAdvisorClub').tipsy('show');

}else{
	$('#nameAdvisorClub').tipsy('hide');

}




if($("#foundationDate").val()==''){
	//$('#foundationAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your foundation date'});
	$('#foundationAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#foundationAdvisorClub').tipsy('show');

}else{
	$('#foundationAdvisorClub').tipsy('hide');
}




if($("#federation").val()=='' && $("#otherFederation").val()==''){
	//$('#federationAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your federation/asociation'});
	$('#federationAdvisorClub').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#federationAdvisorClub').tipsy('show');
	var fed='';
}else{
	$('#federationAdvisorClub').tipsy('hide');
	var fed='ok';
}




if($("#name").val()!='' && $("#nick").val()!=''  && $("#hcountry").val()!='' && $("#foundationDate").val()!='' && fed!=''){


var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var nickName=$("#nick").val();
var name=$("#name").val();
var countryId=$("#hcountry").val();
var foundationDate=$("#foundationDate").val();
var federation=$("#federation").val();
var federationName=$("#federat").val();
var otherFederation=$("#otherFederation").val();



$("#resultProfileClub").load(profilePath,{idProfile:idProfile,idUser:idUser,name:name,countryId:countryId,nickName:nickName,foundationDate:foundationDate,federation:federation,federationName:federationName,otherFederation:otherFederation});

}
}








/////////////////Validate Company////////////////////////////////////	
function validateCompany(){

if($("#hcountry").val()==''){
	//$('#countryAdvisorCompany').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your country'});
	$('#countryAdvisorCompany').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#countryAdvisorCompany').tipsy('show');

}else{
	$('#countryAdvisorCompany').tipsy('hide');

}




if($("#name").val()==''){
	//$('#nameAdvisorCompany').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your name'});
	$('#nameAdvisorCompany').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#nameAdvisorCompany').tipsy('show');

}else{
	$('#nameAdvisorCompany').tipsy('hide');

}



if($("#foundationDate").val()==''){
	//$('#foundationAdvisorCompany').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your foundation date'});
	$('#foundationAdvisorCompany').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#foundationAdvisorCompany').tipsy('show');

}else{
	$('#foundationAdvisorCompany').tipsy('hide');
}



if($("#name").val()!='' && $("#hcountry").val()!='' && $("#foundationDate").val()!=''){


var idUser=$("#idUsr").val();
var idProfile=$("#idProfile").val();
var name=$("#name").val();
var countryId=$("#hcountry").val();
var foundationDate=$("#foundationDate").val();




$("#resultProfileCompany").load(profilePath,{idProfile:idProfile,idUser:idUser,name:name,countryId:countryId,foundationDate:foundationDate});

}
}




/////////////Checks if both profiles are complete in the Friendly Register////////////////////////
function checkProfileComplete(){

//alert($("#specificProfileComplete").val());

var idUser=$("#idUserComplete").val();
var specific=$("#specificProfileComplete").val();
var general=$("#generalProfileComplete").val();


if(specific==undefined || general==undefined){
	//$('#completeAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'Complete your data'});
	$('#completeAdvisorPlayer').tipsy({trigger: 'manual', gravity:'e', fallback:'->'});
	$('#completeAdvisorPlayer').tipsy('show');

}else{
	$('#completeAdvisorPlayer').tipsy('show');
	//$("#completeAdvisorPlayer").html('');
    $("#completeAdvisorPlayer").load('ajax/checkRegisterFriendly.php',{idUser:idUser});

}
}









//////////////////////////////////VIDEOS FOR PROFILE////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////videoProfile - Loads the videos from pagination function///////////////////

function loadVideosPaginate(sUp){
	$("#extendedGallery").html('<img src="img/indicator.gif" width="16" height="16"/>');
	$("#extendedGallery").load('gestion/modulos/video/view/videoTester.php',{sUp_uV_pV_uN_pN_eP:sUp});
	
	}


/////////////////////////////////LoadVideo - Loads a video player/////////////////////////

function loadVideo(iFvpu_pOkuOk_n_ph_uN_pN){
	$('#videoPlayer').css('top','181px');
	SetHeightVPlayer();
	$("#videoPlayer").show();
	//$('#modules').css('margin-top','135px');
	$('#modules').hide();
	$("#videoPlayer").html('<img src="img/indicator.gif" width="16" height="16"/>');
	$("#videoPlayer").load('gestion/modulos/video/videoPlayer.php',{iFvpu_pOkuOk_n_ph_uN_pN:iFvpu_pOkuOk_n_ph_uN_pN});
	
	}
	function upPlayer(){
		$('#videoPlayer').css('top','153px');
	}
							
/////////////////Save video File////////////////////////

function saveVideoFile(){
	
			if($("#nameVideo").val()==''){
						$("#nameAdvisorVideo").html('* please, complete the video name');
				}else{
						$("#nameAdvisorVideo").html('');
				}
				
			if($("#tagsVideo").val()==''){
						$("#tagsAdvisorVideo").html('* please, complete the video tags with words separated by commas');
				}else{
						$("#tagsAdvisorVideo").html('');
				}	
				
			if($("#youtube").val()=='' && $("#fileName").val()==''){
						$("#fileAdvisorVideo").html('* please, complete your video');
						fileN='';
				}else{
						$("#fileAdvisorVideo").html('');
						fileN='ok';
				}
				
			
			if($("#nameVideo").val()!='' && fileN!='' && $("#tagsVideo").val()!=''){
				
				$("#nameAdvisorVideo").html('');
				$("#tagsAdvisorVideo").html('');
				$("#fileAdvisorVideo").html('');
				
				$("#saveVideoFile").html('<img src="img/indicator.gif" width="16" height="16"/> uploading, please wait...');
				document.getElementById('videoForm').submit();
			
			}
	
	
	
}



//////////////////VISITS AND VOTES///////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////Sum view - Adds 1 value to the 'view' field on db////////////
function sumView(iVpu_pOk_uOk){
	action='visit';
	$("#videoSum").load('gestion/modulos/video/addVoteViewVideo.php',{iVpu_pOk_uOk:iVpu_pOk_uOk,action:action});
}

/////////////////Rates of votes/////////////////////////////
function ratesVote(rPuV){
	$("#voteRatesLoader").load('gestion/modulos/video/view/lateralViewVotes.php',{rPuV:rPuV});
}

///////////////////////vote Video - To vote videos/////////////////////////////
function voteVideo(vFvpu_pOkuOk_n_ph_va_uN_pN){
	action='vote';
	$("#votaProgress").html('<img src="img/indicator.gif" width="15" height="15"/>');
	$("#videoSum").load('gestion/modulos/video/addVoteViewVideo.php',{vFvpu_pOkuOk_n_ph_va_uN_pN:vFvpu_pOkuOk_n_ph_va_uN_pN,action:action});
}


/////////////show stars y the vote options////////////////////////////////////
function showStar(id){
	
		if(id=='star1'){
			document.getElementById(id).style.backgroundImage = "url(img/starVote.png)";
			
		}else if(id=='star2'){
			document.getElementById(id).style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star1').style.backgroundImage = "url(img/starVote.png)";
		
		}else if(id=='star3'){
			document.getElementById(id).style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star2').style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star1').style.backgroundImage = "url(img/starVote.png)";
		
		}else if(id=='star4'){
			document.getElementById(id).style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star3').style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star2').style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star1').style.backgroundImage = "url(img/starVote.png)";
		
		}else if(id=='star5'){
			document.getElementById(id).style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star4').style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star3').style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star2').style.backgroundImage = "url(img/starVote.png)";
			document.getElementById('star1').style.backgroundImage = "url(img/starVote.png)";
			
		}
}

/////////////hide stars y the vote options////////////////////////////////////
function hideStar(id){
	document.getElementById('star1').style.backgroundImage = "";
	document.getElementById('star2').style.backgroundImage = "";
	document.getElementById('star3').style.backgroundImage = "";
	document.getElementById('star4').style.backgroundImage = "";
	document.getElementById('star5').style.backgroundImage = "";
}









///////////////Delete a Video//////////////////////////////
function delVideo(iVpuF_ph){
		$("#extendedGallery").html($("#extendedGallery").html()+'<div style="position:absolute;z-index:20;background-color:rgba(255,255,255,0.9);width:inherit; height:inherit; text-align:center; padding-top:100px;"><img src="img/indicator.gif" width="16" height="16" /></div>');
		$("#delVideo").load('gestion/modulos/video/delVideo.php',{iVpuF_ph:iVpuF_ph});
	}

////////////Update the title of the video////////////////////
function upVideo(iVtyt,title){
		$("#extendedGallery").html($("#extendedGallery").html()+'<div style="position:absolute;z-index:20;background-color:rgba(255,255,255,0.9);width:inherit; height:inherit; text-align:center; padding-top:100px;"><img src="img/indicator.gif" width="16" height="16" /></div>');
		$("#delVideo").load('gestion/modulos/video/upVideo.php',{iVt:iVtyt,title:title});
	}
	
///////////load the comments of the video /////////////////
function loadComment(iUpvNpN){
	$("#votaProgress").html('<img src="img/indicator.gif" width="15" height="15"/>');
	$("#loadComment").load('gestion/modulos/video/comment/loadCommentVideo.php',{iUpvNpN:iUpvNpN});
	}
	
///////////save the comments for the video /////////////////	
function saveComment(iUpvNpNc){
		if($("#commentText").val()!=''){
			$("#commProgress").html('<img src="img/indicator.gif" width="15" height="15"/>');
			$("#saveComment").load('gestion/modulos/video/comment/addCommentVideo.php',{iUpvNpNc:iUpvNpNc});
		}
	}	


////////////set usr Visit ///////////////////
function setVis(iUv){
		$("#loadComment").load('gestion/lib/share/clases/setVis.php',{iUv:iUv});
	}

/////////delete comment////////////////////
function delComment(iCpv){
		$("#votaProgress").html('<img src="img/indicator.gif" width="15" height="15"/>');
		$("#saveComment").load('gestion/modulos/video/comment/delCommentVideo.php',{iCpv:iCpv});
	}




///------------------------------------------------------------------------------------------///

//////////////////////////////////PHOTOS//////////////////////////////////////////////



/////////////////Save Photo File////////////////////////

function savePhotoFile(){
	
			if($("#namePhoto").val()==''){
						$("#nameAdvisorPhoto").html('* please, complete the Photo name');
				}else{
						$("#nameAdvisorPhoto").html('');
				}
				
			if($("#tagsPhoto").val()==''){
						$("#tagsAdvisorPhoto").html('* please, complete the Photo tags with words separated by commas');
				}else{
						$("#tagsAdvisorPhoto").html('');
				}	
				
			if($("#photoFileName").val()==''){
						$("#fileAdvisorPhoto").html('* please, complete your Photo');
						
				}else{
						$("#fileAdvisorPhoto").html('');
						
				}
				
			
			if($("#namePhoto").val()!='' && $("#photoFileName").val()!='' && $("#tagsPhoto").val()!=''){
				
				$("#nameAdvisorPhoto").html('');
				$("#tagsAdvisorPhoto").html('');
				$("#fileAdvisorPhoto").html('');
				
				$("#savePhotoFile").html('<img src="img/indicator.gif" width="16" height="16"/> uploading, please wait...');
				document.getElementById('photoForm').submit();
			
			}
	
	
	
}


/////////////////////////////////LoadPHOTOS - Loads a PHOTOS player/////////////////////////

function loadPhoto(iFvpu_pOkuOk_n_ph_uN_pN){
	$('#videoPlayer').css('top','181px');
	SetHeightVPlayer();
	$("#videoPlayer").show();
	//$('#modules').css('margin-top','135px');
	$('#modules').hide();
	$("#videoPlayer").html('<img src="img/indicator.gif" width="16" height="16"/>');
	$("#videoPlayer").load('gestion/modulos/photo/photoPlayer.php',{iFvpu_pOkuOk_n_ph_uN_pN:iFvpu_pOkuOk_n_ph_uN_pN});
	
	}
function upPhotoPlayer(){
		$('#videoPlayer').css('top','153px');
	}

//////////////////////////////////videoProfile - Loads the PHOTOS from pagination function///////////////////

function loadPhotosPaginate(pUp){
	$("#extendedGallery").html('<img src="img/indicator.gif" width="16" height="16"/>');
	$("#extendedGallery").load('gestion/modulos/photo/view/photoTester.php',{pUp_uV_pV_uN_pN_eP:pUp});
	}


///////////////Sum view - Adds 1 value to the 'view' field on db////////////
function sumViewPhoto(pVpu_pOk_uOk){
	$("#photoSum").load('gestion/modulos/photo/addVoteViewPhoto.php',{pVpu_pOk_uOk:pVpu_pOk_uOk});
}


////////////Update the title of the PHOTOS////////////////////
function upPhoto(pVtyt,title){
		$("#extendedGallery").html($("#extendedGallery").html()+'<div style="position:absolute;z-index:20;background-color:rgba(255,255,255,0.9);width:inherit; height:inherit; text-align:center; padding-top:100px;"><img src="img/indicator.gif" width="16" height="16" /></div>');
		$("#delPhoto").load('gestion/modulos/photo/upPhoto.php',{pVt:pVtyt,title:title});
	}


///////////////Delete a Photo//////////////////////////////
function delPhoto(pVpuF_ph){
		$("#extendedGallery").html($("#extendedGallery").html()+'<div style="position:absolute;z-index:20;background-color:rgba(255,255,255,0.9);width:inherit; height:inherit; text-align:center; padding-top:100px;"><img src="img/indicator.gif" width="16" height="16" /></div>');
		$("#delPhoto").load('gestion/modulos/photo/delPhoto.php',{pVpuF_ph:pVpuF_ph});
	}
	
	
	
///////////load the comments of the PHOTOS /////////////////
function loadCommentPhoto(pUpvNpN){
	$("#votaProgress").html('<img src="img/indicator.gif" width="15" height="15"/>');
	$("#loadComment").load('gestion/modulos/photo/comment/loadCommentPhoto.php',{pUpvNpN:pUpvNpN});
	}
	
///////////save the comments for the PHOTOS /////////////////	
function saveCommentPhoto(pUpvNpNc){
		if($("#commentText").val()!=''){
			$("#commProgress").html('<img src="img/indicator.gif" width="15" height="15"/>');
			$("#saveComment").load('gestion/modulos/photo/comment/addCommentPhoto.php',{pUpvNpNc:pUpvNpNc});
		}
	}		

/////////delete comment////////////////////
function delCommentPhoto(pCpv){
		$("#votaProgress").html('<img src="img/indicator.gif" width="15" height="15"/>');
		$("#saveComment").load('gestion/modulos/photo/comment/delCommentPhoto.php',{pCpv:pCpv});
	}
	
	
	
	
	
	
	
	
	
///////////////////////////////////////////SEARCHS//////////////////////////////////////////

//////////////People Search//////////////////////////
function chkSrch(){
		
		if($('#strgToSearch').val()==textoSearchIdioma){
				$('#strgToSearch').val('');
		}
		document.getElementById('searcher').submit();
		$("#videoPlayer").hide();
		$("#photoPlayer").hide();
		
		if($('#strgToSearch').val()==''){
				$('#strgToSearch').val(textoSearchIdioma);
		}
		
		
		//setmyheight();
		
}









	
/*Made by Rodrigo Berlochi - Martin Cantero - Sebastian Volta - Andres Grosso, for Axyoma/Jaque. 2011, Rosario, Santa Fe, Argentine*/