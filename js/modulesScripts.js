var dir='gestion/modulos/home/modules/';
var dir2='gestion/modulos/home/perfil/';

////////////////// function load ////////////
function pasaV9(id,name){
	$("#asociation").val(name);
	$("#fhiddenAsociation").val(id);
	$("#hideShow").hide(300);
	saveThisNewAsociation2(id,name);
	
	//$("#finderprofile").attr('disabled', 'disabled');
		
}

function saveThisNewAsociation2(id,name){
	$.ajax({
		url: dir2+"editagProfile.php",
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		data: "type=change&field=f41&value="+id+"&value2="+name,
		//data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST'
		//succes: function(data){
		//}
})
		var asd="company_finder";
		$("#"+asd).html('<a href="javascript:void(0);" class="editmode 28" onclick="javascript:companyFinder(\''+name+'\',\''+asd+'\');" original-title="" style="background-color: rgb(234, 239, 232);">'+name+'</a>');
		//<a onClick="javascript:finder1('+val2+',"club_finder");" class="editmode f3" href="javascript:void(0);">'+val2+'</a>');
}


function pasaV8(id,name){
	$("#agent").val(name);
	$("#fhiddenEnterprise").val(id);
	$("#hideShow").hide(300);
	saveThisNewEnterprise(id,name);
	
	//$("#finderprofile").attr('disabled', 'disabled');
		
}

function saveThisNewEnterprise(id,name){
	$.ajax({
		url: dir2+"editagProfile.php",
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		data: "type=change&field=f29&value="+id+"&value2="+name,
		//data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST'
		//succes: function(data){
		//}
	})
		var asd="enterprise_finder";
		$("#"+asd).html('<a href="javascript:void(0);" class="editmode f29" onclick="javascript:enterpriseFinder(\''+name+'\',\''+asd+'\');" original-title="" style="background-color: rgb(234, 239, 232);">'+name+'</a>');
		//<a onClick="javascript:finder1('+val2+',"club_finder");" class="editmode f3" href="javascript:void(0);">'+val2+'</a>');
}


function pasaV7(id,name){
	$("#agent").val(name);
	$("#fhiddenAgent").val(id);
	$("#hideShow").hide(300);
	saveThisNewCompany2(id,name);
	
	//$("#finderprofile").attr('disabled', 'disabled');
		
}

function saveThisNewCompany2(id,name){
	$.ajax({
		url: dir2+"editagProfile.php",
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		data: "type=change&field=f28&value="+id+"&value2="+name,
		//data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST'
		//succes: function(data){
		//}
	});
		var asd="company_finder";
		$("#"+asd).html('<a href="javascript:void(0);" class="editmode f28" onclick="javascript:companyFinder(\''+name+'\',\''+asd+'\');" original-title="" style="background-color: rgb(234, 239, 232);">'+name+'</a>');
		//<a onClick="javascript:finder1('+val2+',"club_finder");" class="editmode f3" href="javascript:void(0);">'+val2+'</a>');
}



function pasaV6(id,name,lastName){
	$("#agent").val(name+' '+lastName);
	$("#fhiddenAgent").val(id);
	$("#hideShow").hide(300);
	saveThisNewAgent(name,lastName,id);
	
	//$("#finderprofile").attr('disabled', 'disabled');
		
}

function saveThisNewAgent(name,lastName,id){
	$.ajax({
		url: dir2+"editagProfile.php",
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		data: "type=change&field=f42&value="+id+"&value2="+name+"&value3="+lastName,
		//data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST'
		//succes: function(data){
		//}
	});
		var asd="agent_finder";
		$("#"+asd).html('<a href="javascript:void(0);" class="editmode f42" onclick="javascript:agentFinder(\''+name+'\',\''+asd+'\');" original-title="" style="background-color: rgb(234, 239, 232);">'+name+' '+lastName+'</a>');
		//<a onClick="javascript:finder1('+val2+',"club_finder");" class="editmode f3" href="javascript:void(0);">'+val2+'</a>');
}




function pasaV5(val1,val2){
	$("#fhiddenCompany").val(val2);
	$("#finderCompany").val(val1);
	$("#hideShow").hide(300);
	saveThisNewCompany(val2,val1);
	
	//$("#finderprofile").attr('disabled', 'disabled');
		
}

function saveThisNewCompany(val1,val2){
	$.ajax({
		url: dir2+"editagProfile.php",
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		data: "type=change&field=f27&value="+val1+"&value2="+val2,
		//data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST'
		//succes: function(data){
		//}
	});
		var asd="company_finder";
		$("#"+asd).html('<a href="javascript:void(0);" class="editmode f27" onclick="javascript:companyFinder(\''+val2+'\',\''+asd+'\');" original-title="" style="background-color: rgb(234, 239, 232);">'+val2+'</a>');
		//<a onClick="javascript:finder1('+val2+',"club_finder");" class="editmode f3" href="javascript:void(0);">'+val2+'</a>');
}



function pasaV4(val1,val2){
	$("#fhiddenAsociation").val(val2);
	$("#finderAsociation").val(val1);
	$("#hideShow").hide(300);
	saveThisNewAsociation(val2,val1);
	
	//$("#finderprofile").attr('disabled', 'disabled');
		
}

function saveThisNewAsociation(val1,val2){
	$.ajax({
		url: dir2+"editagProfile.php",
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		data: "type=change&field=f41&value="+val1+"&value2="+val2,
		//data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST'
		//succes: function(data){
		//}
	});
		var asd="association_finder";
		$("#"+asd).html('<a href="javascript:void(0);" class="editmode f41" onclick="javascript:asociationFinder(\''+val2+'\',\''+asd+'\');" original-title="" style="background-color: rgb(234, 239, 232);">'+val2+'</a>');
		//<a onClick="javascript:finder1('+val2+',"club_finder");" class="editmode f3" href="javascript:void(0);">'+val2+'</a>');
}




function pasaV3(val1,val2){
	$("#fhiddenFederation").val(val2);
	$("#finderfederation").val(val1);
	$("#hideShow").hide(300);
	saveThisNewFederation(val2,val1);
	
	//$("#finderprofile").attr('disabled', 'disabled');
		
}


function saveThisNewFederation(val1,val2){
	$.ajax({
		url: dir2+"editagProfile.php",
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		data: "type=change&field=f41&value="+val1+"&value2="+val2,
		//data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST'
		//succes: function(data){
		//}
	});
		var asd="federation_finder";
		$("#"+asd).html('<a href="javascript:void(0);" class="editmode f3" onclick="javascript:finderFederation(\''+val2+'\',\''+asd+'\');" original-title="" style="background-color: rgb(234, 239, 232);">'+val2+'</a>');
		//<a onClick="javascript:finder1('+val2+',"club_finder");" class="editmode f3" href="javascript:void(0);">'+val2+'</a>');
}


function pasaV2(val1,val2){
	$("#fhiddenprofile").val(val1);
	$("#finderprofile").val(val2);
	$("#hideShow").hide(300);
	saveThisNewClub(val1,val2);
	
	//$("#finderprofile").attr('disabled', 'disabled');
		
}

function saveThisNewClub(val1,val2){
	$.ajax({
		url: dir2+"editagProfile.php",
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		data: "type=change&field=f3&value="+val1+"&value2"+val2,
		//data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST'
		//succes: function(data){
		//}
	});
		var asd="club_finder";
		$("#club_finder").html('<a href="javascript:void(0);" class="editmode f3" onclick="javascript:finder1(\''+val2+'\',\''+asd+'\');" original-title="" style="background-color: rgb(234, 239, 232);">'+val2+'</a>');
		//<a onClick="javascript:finder1('+val2+',"club_finder");" class="editmode f3" href="javascript:void(0);">'+val2+'</a>');
}

function pasaV(val1,val2){
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}

function loadNews(agdate,agtime)
{
	var d=new Date();
	$('#resultNews').load(dir+'News/listarNews.php?cache='+d.getTime()+"&agdate="+agdate+"&agtime="+agtime);
}


function loadCareer(agdate,agtime)
{
	var d=new Date();
	$('#resultCareer').load(dir+'Career/listarCareer.php?cache='+d.getTime()+"&agdate="+agdate+"&agtime="+agtime);
	//$('#resultCareer').load(dir+'Career/CareerAI1.php?cache='+d.getTime()+"&agdate="+$agdate+"&agtime="+$agtime);
}

function loadObservation(agdate,agtime)
{
	var d=new Date();
	$('#resultObservation').load(dir+'Observation/listarObservation.php?cache='+d.getTime()+"&agdate="+agdate+"&agtime="+agtime);
}


function loadHonour(agdate,agtime)
{

	var d=new Date();
	$('#resultHonour').load(dir+'Honour/listarHonours.php?cache='+d.getTime()+"&agdate="+agdate+"&agtime="+agtime);
}

function loadPersonalDistinction(agdate,agtime)
{
//alert(" Dentro de jquery");
var d=new Date();
	$('#resultPersonalDistinction').load(dir+'PersonalDistinction/listarPersonalDistinction.php?cache='+d.getTime()+"&agdate="+agdate+"&agtime="+agtime);
}
////////////////// function load ////////////







////////////////// function convertToSelectHiddenag ////////////
function convertToSelectHiddenNewsag(idRow, field ,link, agdate, agtime) {
//alert("IdRow: "+idRow);
//alert("Field: "+field);
//alert("link: "+link);
//alert("agdate: "+agdate);
//alert("agtime: "+agtime);
	$('#' + field +"_"+ idRow).html("<select class='left' onBlur='saveNewValueHiddenNewsag(\"" + idRow + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");'><option value='Visible'>Visible</option><option value='Hidden'>Hidden</option></select>");
	//$('#' + id).html("<input type='text' value='" + link.innerHTML + "' onBlur='saveNewValue(\"" + id + "\",\"" + field + "\", this.value);' />");
}

function convertToSelectHiddenPersonalDistinctionag(id, field ,link, agdate, agtime) {
//alert(id);
//alert(field);
//alert(link);
	$('#' + field +"_"+ id).html("<select class='left' onBlur='saveNewValueHiddenPersonalDistinctionag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");'><option value='Visible'>Visible</option><option value='Hidden'>Hidden</option></select>");
	//$('#' + id).html("<input type='text' value='" + link.innerHTML + "' onBlur='saveNewValue(\"" + id + "\",\"" + field + "\", this.value);' />");
}

function convertToSelectHiddenCareerag(id, field ,link, agdate, agtime) {
	$('#' + field +"_"+ id).html("<select class='left' onBlur='saveNewValueHiddenCareerag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");'><option value='Visible'>Visible</option><option value='Hidden'>Hidden</option></select>");
}

////////////////// function convertToSelectHiddenag ////////////

////////////////// function convertToFinder ////////////
function convertToFinderCareerag(id, field ,link, agdate, agtime) {


	$('#' + field +"_"+ id).html("<input name='finder' id='finder' type='text'/><input name='fhidden' id='fhidden' type='hidden'/><div name='das' id='resultDiv'></div><img src='img/accept.png' onclick='saveCareer(\"" + id + "\",\"" + field + "\",\"" + agdate + "\",\"" + agtime + "\",this.value);'>Check This");
	// <img src='img/cancel.png' onclick='cancelCareer(\"" + id + "\",\"" + field + "\", this.value);'>
	$("#finder").keyup(function(){			
		$.post(dir+"Career/busqueda.php", { 
			field: field,
			chars: $("#finder").val()		
		},
		function(data) {
			$("#resultDiv").html(data);
		});	
	})
}


function convertToFinderHonourag(id, field ,link, agdate, agtime) {

																																																										
	$('#' + field +"_"+ id).html("<input name='finder' id='finder' type='text'/><input name='fhidden' id='fhidden' type='hidden'/><div name='das' id='resultDiv'></div><img src='img/accept.png' onclick='saveHonour(\"" + id + "\",\"" + field + "\",\"" + agdate + "\",\"" + agtime + "\",\"" + link + "\");'>Check This");
	//$('#' + field +"_"+ id).html("<input name='finder' id='finder' type='text'/><input name='fhidden' id='fhidden' type='hidden'/><div name='das' id='resultDiv'></div>");
	 
	$("#finder").keyup(function(){			
		$.post(dir+"Honour/busqueda.php", { 
			field: field,
			chars: $("#finder").val()		
		},
		function(data) {
			$("#resultDiv").html(data);
		});	
	})
}
////////////////// function  convertToFinder ////////////


////////////////// function  convertToInput////////////

function convertToInputNewsag(idRow, field ,link, agdate, agtime) {

	//$("a[id=" + id + "]").html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValueag(\"" + id + "\",\"" + field + "\", this.value);' />");
	$('#' + field +"_"+ idRow).html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValueNewsag(\"" + idRow + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");' />");
}

function convertToTextAreaNewsag(id, field ,link, agdate, agtime) {
	//$("a[id=" + id + "]").html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValueag(\"" + id + "\",\"" + field + "\", this.value);' />");
$('#' + field +"_"+ id).html("<textarea rows='20' cols='80' onBlur='saveNewValueNewsag(\"" + id + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");' >"+link.innerHTML+"</textarea>");
}

function convertToInputObservationag(idRow, field ,link, agdate, agtime) {
	//$("a[id=" + id + "]").html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValueag(\"" + id + "\",\"" + field + "\", this.value);' />");
	$('#' + field +"_"+ idRow).html("<textarea rows='20' cols='80' onBlur='saveNewValueObservationag(\"" + idRow + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");' >"+link.innerHTML+"</textarea>");
}

function convertToInputPersonalDistinctionag(idRow, field ,link, agdate, agtime) {
//alert("id: "+idRow);
//alert("field: "+field);
//alert("link: "+link);
//alert("agdate: "+agdate);
//alert("agtime: "+agtime);
	//$("a[id=" + id + "]").html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValueag(\"" + id + "\",\"" + field + "\", this.value);' />");
	$('#' + field +"_"+ idRow).html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValuePersonalDistinctionag(\"" + idRow + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");' />");
   
}

function convertToInputHonourag(idRow, field ,link, agdate, agtime) {
	$('#' + field +"_"+ idRow).html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValueHonourag(\"" + idRow + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");' /></form>");
}

function convertToInputCareerag(idRow, field ,link, agdate, agtime) {
	$('#' + field +"_"+ idRow).html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValueCareerag(\"" + idRow + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");' /></form>");
}

function convertToInputCareerNumbersag(idRow, field ,link, agdate, agtime) {
	$('#' + field +"_"+ idRow).html("<input class='left' type='text' value='" + link.innerHTML + "' onKeyPress='LP_data(event);' onBlur='saveNewValueCareerag(\"" + idRow + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");' /></form>");
}

////////////////// function  convertToInput////////////


////////////////// function  convertToSelectHidden////////////
function convertToSelectHiddenObservationag(id, field ,link, agdate, agtime) {
	$('#' + field +"_"+ id).html("<select class='left' onBlur='saveNewValueHiddenObservationag(\"" + id + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");'><option value='Visible'>Visible</option><option value='Hidden'>Hidden</option></select>");
}

function convertToSelectHiddenHonourag(id, field ,link, agdate, agtime) {
	$('#' + field +"_"+ id).html("<select class='left' onBlur='saveNewValueHiddenHonourag(\"" + id + "\",\"" + field + "\", this.value, \"" + agdate + "\", \"" + agtime + "\");'><option value='Visible'>Visible</option><option value='Hidden'>Hidden</option></select>");
}
////////////////// function  convertToSelectHidden////////////




////////////////// function  saveNewValueHidden////////////

function WhenEnterForFirstTimeNewsag(agdate,agtime){
var addText='Add New Text Here'; 
$.ajax({
                    url: dir+"News/classNews.php",
					//data: "type=edit&field="+field+"&val="+val+"&id="+id,
					data: "type=add&title="+addText+"&description="+addText+"&idUser="+agdate+"&idProfile="+agtime,
                    //data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
					type: 'POST',
				success: function(){
				loadNews(agdate,agtime);
				}
				});

				

}

function WhenEnterForFirstTimeObservationsag(agdate,agtime){
var addText='Add New Text Here'; 
$.ajax({
                    url: dir+"Observation/classObservation.php",
					//data: "type=edit&field="+field+"&val="+val+"&id="+id,
					data: "type=add&observation="+addText+"&idUser="+agdate+"&idProfile="+agtime,
                    //data: "type=add&field=title&val='Add New Text Here'&T"+field+"&val="+val+"&idUser="+agdate+"&idProfile="+agtime,
					type: 'POST',
				success: function(){
				loadObservation(agdate,agtime);
				}
				});

				

}

function saveNewValueNewsag(idRow, field, val, agdate, agtime) {
//alert(field);
//$('#' + id).html("<a href='javascript:void(0);' onClick='convertToInput(\"" + id + "\",\"" + field + "\", this.value);' >" + val + "</a>");
$('#' + field +"_"+ idRow).html("<a href='javascript:void(0);' onClick='convertToInputNewsag(\"" + idRow + "\",\"" + field + "\", this,\"" + agdate + "\", \"" + agtime + "\" );' >" + val + "</a>");


$.ajax({
                    url: dir+"News/classNews.php",
					//data: "type=edit&field="+field+"&val="+val+"&id="+id,
                    data: "type=edit&field="+field+"&val="+val+"&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
					type: 'POST',
				success: function(){
				loadNews(agdate,agtime);
				}
				});

				
}


function saveNewValueHiddenNewsag(idRow, field, val, agdate, agtime) {
//alert(field);
//$('#' + id).html("<a href='javascript:void(0);' onClick='convertToInput(\"" + id + "\",\"" + field + "\", this.value);' >" + val + "</a>");
$('#' + field +"_"+ idRow).html("<div class='left' id='" + idRow + "'><a href='javascript:void(0);' onClick='convertToSelectHiddenNewsag(\"" + idRow + "\",\"" + field + "\", this,\"" + agdate + "\", \"" + agtime + "\" );' >" + val + "</a></div>");


$.ajax({
                    url: dir+"News/classNews.php",
                    data: "type=edit&field="+field+"&val="+val+"&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
					//data: "type=edit&field="+field+"&val="+val+"&id="+id,
					type: 'POST',
				success: function(){
				loadNews(agdate,agtime);
				}
                });
				
				}


function saveNewValueHiddenObservationag(id, field, val, agdate, agtime) {
	$('#' + field +"_"+ id).html("<div class='left' id='" + id + "'><a href='javascript:void(0);' onClick='convertToSelectHiddenObservationag(\"" + id + "\",\"" + field + "\", this,\"" + agdate + "\", \"" + agtime + "\" );' >" + val + "</a></div>");
	
	
	$.ajax({
		url: dir+"Observation/classObservation.php",
        data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			loadObservation(agdate, agtime);
		}
	});
}


function saveNewValueObservationag(idRow, field, val, agdate, agtime) {
	$('#' + field +"_"+ idRow).html("<a href='javascript:void(0);' onClick='convertToInputObservationag(\"" + idRow + "\",\"" + field + "\", this,\"" + agdate + "\", \"" + agtime + "\" );' >" + val + "</a>");
	$.ajax({
		url: dir+"Observation/classObservation.php",
		data: "type=edit&field="+field+"&val="+val+"&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		type: 'POST',
		success: function(){
			loadObservation(agdate, agtime);
		}
	});
}

function saveNewValuePersonalDistinctionag(id, field, val, agdate, agtime) {
//alert(field);
//$('#' + id).html("<a href='javascript:void(0);' onClick='convertToInput(\"" + id + "\",\"" + field + "\", this.value);' >" + val + "</a>");
$('#' + field +"_"+ id).html("<a href='javascript:void(0);' onClick='convertToInputPersonalDistinctionag(\"" + id + "\",\"" + field + "\", this,\"" + agdate + "\", \"" + agtime + "\" );' >" + val + "</a>");


$.ajax({
                    url: dir+"PersonalDistinction/classPersonalDistinction.php",
  
					data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
					//data: "type=edit&field="+field+"&val="+val+"&id="+id,
					type: 'POST',
				success: function(){
				loadPersonalDistinction(agdate, agtime);
				}
                    
                });

				
}


function saveNewValueCareerag(idRow, field, val, agdate, agtime) {
	$('#' + field +"_"+ idRow).html("<a href='javascript:void(0);' onClick='convertToInputCareerag(\"" + idRow + "\",\"" + field + "\", this,\"" + agdate + "\",\"" + agtime + "\");' >" + val + "</a>");
	$.ajax({
		url: dir+"Career/classCareer.php",
		data: "type=edit&field="+field+"&val="+val+"&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			loadCareer(agdate,agtime);
		}
	});
}

function saveNewValueHiddenPersonalDistinctionag(idRow, field, val, agdate, agtime) {
//alert(field);
//$('#' + id).html("<a href='javascript:void(0);' onClick='convertToInput(\"" + id + "\",\"" + field + "\", this.value);' >" + val + "</a>");
$('#' + field +"_"+ idRow).html("<div class='left' id='" + idRow + "'><a href='javascript:void(0);' onClick='convertToSelectHiddenPersonalDistinctionag(\"" + idRow + "\",\"" + field + "\", this,\"" + agdate + "\",\"" + agtime + "\");' >" + val + "</a></div>");


$.ajax({
                    url: dir+"PersonalDistinction/classPersonalDistinction.php",
                    //data: field +"="+ val + "&id=" +id+ ",
						data: "type=edit&field="+field+"&val="+val+"&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
						//data: "type=edit&field="+field+"&val="+val+"&id="+id,
					type: 'POST',
				success: function(){
				loadPersonalDistinction(agdate, agtime);
				}
                    
                });
					
				}

function saveNewValueHiddenHonourag(id, field, val, agdate, agtime) {
	$('#' + field +"_"+ id).html("<div class='left' id='" + id + "'><a href='javascript:void(0);' onClick='convertToSelectHiddenHonourag(\"" + id + "\",\"" + field + "\", this,\"" + agdate + "\",\"" + agtime + "\");' >" + val + "</a></div>");
	
	$.ajax({
		url: dir+"Honour/classHonour.php",
        data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			loadHonour(agdate, agtime);
		}
	});
}


function saveNewValueHonourag1(id, field, val, agdate, agtime) {
	$('#' + field +"_"+ id).html("<a href='javascript:void(0);' onClick='convertToFinderHonourag1(\"" + id + "\",\"" + val + "\", this,\"" + agdate + "\",\"" + agtime + "\");' >" + val + "</a>");
	$.ajax({
		url: dir+"Honour/classHonour.php",
        data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			loadHonour(agdate, agtime);
		}
	});
}

function saveNewValueCareerag1(id, field, val, agdate, agtime) {
	$('#' + field +"_"+ id).html("<a href='javascript:void(0);' onClick='convertToFindercareerag(\"" + id + "\",\"" + val + "\", this,\"" + agdate + "\",\"" + agtime + "\");' >" + val + "</a>");
	$.ajax({
		url: dir+"Career/classCareer.php",
        data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
        type: 'POST',
		success: function(){
			loadCareer(agdate, agtime);
		}
	});
}

function saveNewValueHonourag(idRow, field, val, agdate, agtime) {
	$('#' + field +"_"+ idRow).html("<a href='javascript:void(0);' onClick='convertToInputYearHonourag(\"" + idRow + "\",\"" + field + "\", this,\"" + agdate + "\",\"" + agtime + "\");' >" + val + "</a>");
	$.ajax({
		url: dir+"Honour/classHonour.php",
		data: "type=edit&field="+field+"&val="+val+"&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			loadHonour(agdate, agtime);
		}
	});
}

function saveNewValueHiddenCareerag(id, field, val, agdate, agtime) {
	$('#' + field +"_"+ id).html("<div class='left' id='" + id + "'><a href='javascript:void(0);' onClick='convertToSelectHiddenCareerag(\"" + id + "\",\"" + field + "\", this,\"" + agdate + "\",\"" + agtime + "\");' >" + val + "</a></div>");
	
	$.ajax({
		url: dir+"Career/classCareer.php",
        data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			loadCareer(agdate, agtime);
		}
	});
}


////////////////// function  saveNewValueHidden////////////



////////////////// function  convertToInputYear////////////
function convertToInputYearHonourag(id, field ,link, agdate, agtime) {
	$('#' + field +"_"+ id).html("<input class='left' type='text' onkeypress='LP_data(event);' maxlength='4' value='" + link.innerHTML + "' onBlur='saveNewValueHonourag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");' />");
}

function convertToInputYearPersonalDistinctionag(id, field ,link, agdate, agtime) {
	//$("a[id=" + id + "]").html("<input class='left' type='text' value='" + link.innerHTML + "' onBlur='saveNewValueag(\"" + id + "\",\"" + field + "\", this.value);' />");
$('#' + field +"_"+ id).html("<input class='left' type='text' onkeypress='LP_data(event);' maxlength='4' value='" + link.innerHTML + "' onBlur='saveNewValuePersonalDistinctionag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");' />");
}

function convertToInputYearCareerag(id, field ,link, agdate, agtime) {
	$('#' + field +"_"+ id).html("<input class='left' type='text' onkeypress='LP_data(event);' maxlength='4' value='" + link.innerHTML + "' onBlur='saveNewValueCareerag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");' />");
}

////////////////// function  convertToInputYear////////////





////////////////// function  convertToSelect////////////
function convertToSelectHonourag(id, field ,link, agdate, agtime) {
	$('#' + field +"_"+ id).html("<select class='left' onBlur='saveNewValueHonourag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");'><option value='National'>National</option><option value='International'>International</option></select>");
}

function convertToCareerag(id, field ,link) {
	$('#' + field +"_"+ id).html("<select class='left' onBlur='saveNewValueCareerag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");'><option value='National'>National</option><option value='International'>International</option></select>");
}
////////////////// function  convertToInputYear////////////



////////////////// function  LP_data////////////
function LP_data(e)
{
	key=(document.all) ? e.keyCode : e.which;
	if (key < 48 || key > 57 ){
		if (key==8){			
			return true;
		}else{
			if(e.preventDefault) e.preventDefault();
			e.returnValue = false;
			return false;
		}
	}
}
////////////////// function  LP_data////////////


	

////////////////// function  deleteAg////////////
function deleteNewsag(id, agdate, agtime){
var answer = confirm ("Delet this row?")
if (answer){
	$.ajax({
		url: dir+"News/classNews.php",
		//data: "type=delet&id="+id,
		data: "type=delet&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
				success: function(){
				loadNews(agdate, agtime);
				}
	
	});
	
}
}

function deleteCareerag(idRow, agdate, agtime){
	var answer = confirm ("adasdsdasdas this row?")
	if (answer){
		$.ajax({
			url: dir+"Career/classCareer.php",
			data: "type=delet&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
			type: 'POST',
			success: function(){
				loadCareer(agdate, agtime);
			}
		});
	}
}


function deleteHonourag(idRow, agdate, agtime){
	var answer = confirm ("Delet this row?")
	if (answer){
		$.ajax({
			url: dir+"Honour/classHonour.php",
			data: "type=delet&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
			type: 'POST',
			success: function(){
				loadHonour(agdate, agtime);
			}
		});
	}
}

function deletePersonalDistinctionag(idRow, agdate, agtime){
var answer = confirm ("Delet this row?")
if (answer){
	$.ajax({
		url: dir+"PersonalDistinction/classPersonalDistinction.php",
		data: "type=delet&idRow="+idRow+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
				success: function(){
				loadPersonalDistinction(agdate, agtime);
				}
                    
                });
	

	
}
}
////////////////// function  deleteAg////////////


////////////////// function  convertToClubInput////////////
function convertToClubInputHonourag(id, field ,link, agdate, agtime) {
//alert("Id: "+id);
//alert("Field: "+field);
//alert("link: "+link);
//alert("agdate: "+agdate);
//alert("agtime: "+agtime);


//alert(field);
//alert(link);
	$('#' + field +"_"+ id).html("<input name='finder' id='finder' type='text'/><input name='fhidden' id='fhidden' type='hidden'/><div name='das' id='resultDiv'></div><img src='img/accept.png' title='Accept' onclick='saveHonour(\"" + id + "\",\"" + field + "\",\"" + agdate + "\",\"" + agtime + "\");'> <img src='img/redCard.png' title='I don´t have more Club' onClick='noMoreClubHonour(\"" + id + "\",\"" + field + "\",\"" + agdate + "\",\"" + agtime + "\")'>");
	//<img src='img/cancel.png' title='Cancel' onclick='cancelHonour(\"" + id + "\",\"" + field + "\", this.value);'> 
	$("#finder").keyup(function(){			
		$.post(dir+"Honour/busqueda2.php", { 
			chars: $("#finder").val()		
		},
		function(data) {
			$("#resultDiv").html(data);
		});	
	})

}

function convertToClubInputCareerag(id, field ,link, agdate, agtime) {
//alert("agdata : " + agdate);
//alert("agtime : " + agtime);
	$('#' + field +"_"+ id).html("<input name='finder' id='finder' type='text'/><input name='fhidden' id='fhidden' type='hidden'/><div name='das' id='resultDiv'></div><img src='img/accept.png' title='Accept' onclick='saveCareer(\"" + id + "\",\"" + field + "\",\"" + agdate + "\",\"" + agtime + "\");'> <img src='img/redCard.png' title='I don´t have more Club' onClick='noMoreClubCareer(\"" + id + "\",\"" + field + "\",\"" + agdate + "\",\"" + agtime + "\")'>");
	 //<img src='img/cancel.png' title='Cancel' onclick='cancel(\"" + id + "\",\"" + field + "\", this.value);'>
	$("#finder").keyup(function(){			
		$.post(dir+"Career/busqueda2.php", { 
			chars: $("#finder").val()		
		},
		function(data) {
			$("#resultDiv").html(data);
		});	
	})
}

////////////////// function  convertToClubInput////////////

////////////////// function  cancel////////////
function cancelHonour(id, field ,link, agdate, agtime){
	$("#fhidden").val('');
	$("#finder").val('');
	//alert("asd");
	$('#' + field +"_"+ id).html('<td><div id="country_a1b2"><a  href="javascript:void(0);" onClick="convertToFinderHonourag(\'a1b2\',\'country\',this,\'' + agdate + '\',\'' + agtime + '\');" class="insert" >Editme</a></div></td>');
	
}

function cancelCareer(id, field ,link, agdate, agtime){
	$("#fhidden").val('');
	$("#finder").val('');
}

////////////////// function  cancel////////////

////////////////// function  cancel////////////
function noMoreClubHonour(id,field,agdate, agtime){
val='';
	$.ajax({
		url: dir+"Honour/classHonour.php",
		//data: "type=edit&idUser="+agdate+"&idProfile="+agtime+"&field="+field+"&val=''&idRow="+id,
		data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			loadHonour(agdate, agtime);
		}
	});
}

function noMoreClubCareer(id,field, agdate, agtime){
val='';
	$.ajax({
		url: dir+"Career/classCareer.php",
		data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			loadCareer(agdate, agtime);
		}
	});
}
////////////////// function  cancel////////////

////////////////// function  save////////////

function saveCareer(id, field, agdate, agtime,val){

//alert("ID " + id);
//alert("FIELD " + field);
//alert("agdate " + agdate);
//alert("agtime " + agtime);
//alert("val " + val);
//alert(id);
//alert(field);
//alert(val);

if(id == 'a1b1'){
	var val1=$("#finder").val();
	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}else {
	//alert(val);
	//alert(val1);
	$("#"+field+"_"+id).html('<div id="'+id+'"><a href="javascript:void(0)" onClick="convertToFinderCareerag(\'a1b1\',\'club\',this,\'' + agdate + '\',\'' + agtime + '\');" >'+val1+'</a><input type="hidden" name="fhidden" id="CountryCareerAg" value="'+val+'"></div>');
	
		return false;
	}


}else if(id == 'a1b11'){
	var val1=$("#finder").val();
	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}else {
	//alert(val);
	//alert(val1);
	$("#"+field+"_"+id).html('<div id="'+id+'"><a href="javascript:void(0)" onClick="convertToFinderCareerag(\''+id+'\',\'club\',this,\'' + agdate + '\',\'' + agtime + '\');" >'+val1+'</a><input type="hidden" name="fhidden" id="a1b22fhidden" value="'+val+'"></div>');
		return false;
	}


}else if(id == 'a1b2'){
	var val1=$("#finder").val();
	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}else {
	//alert(val);
	//alert(val1);
	$("#"+field+"_"+id).html('<div id="'+id+'"><a href="javascript:void(0)" onClick="convertToFinderCareerag(\''+id+'\',\'country\',this,\'' + agdate + '\',\'' + agtime + '\');" >'+val1+'</a><input type="hidden" name="fhidden" id="a1b3fhidden" value="'+val+'"></div>');
		return false;
	}


}else if(id == 'a1b22'){
	var val1=$("#finder").val();
	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}else {
	//alert(val);
	//alert(val1);
	$("#"+field+"_"+id).html('<div id="'+id+'"><a href="javascript:void(0)" onClick="convertToFinderCareerag(\''+id+'\',\'club\',this,\'' + agdate + '\',\'' + agtime + '\');" >'+val1+'</a><input type="hidden" name="fhidden" id="a1b33fhidden" value="'+val+'"></div>');
		return false;
	}


}

	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}

	//alert("agdate para salvar " + agdate);
	//alert("agtime para salvar" + agtime);
	$.ajax({
		url: dir+"Career/classCareer.php",
		data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			//alert("asd");
			loadCareer(agdate, agtime);
			
		}
	});
}



function saveHonour(id, field, agdate, agtime, val ){


//alert("ID " + id);
//alert("FIELD " + field);
//alert("val " + val);
//alert("agdate " + agdate);
//alert("agtime " + agtime);
//alert(id);
//alert(field);
//alert(val);

if(id == 'a1b2'){
	var val1=$("#finder").val();
	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}else {
	//alert(val);
	//alert(val1);
	$("#"+field+"_"+id).html('<div id="'+id+'"><a href="javascript:void(0)" onClick="convertToFinderHonourag(\''+id+'\',\'country\',this,\'' + agdate + '\',\'' + agtime + '\');" >'+val1+'</a><input type="hidden" name="fhidden" id="CountryAg" value="'+val+'"></div>');
		return false;
	}


}else if(id == 'a1b22'){
	var val1=$("#finder").val();
	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}else {
	//alert(val);
	//alert(val1);
	$("#"+field+"_"+id).html('<div id="'+id+'"><a href="javascript:void(0)" onClick="convertToFinderHonourag(\''+id+'\',\'club\',this,\'' + agdate + '\',\'' + agtime + '\');" >'+val1+'</a><input type="hidden" name="fhidden" id="ClubAg" value="'+val+'"></div>');
		return false;
	}


}else if(id == 'a1b3'){
	var val1=$("#finder").val();
	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}else {
	//alert(val);
	//alert(val1);
	$("#"+field+"_"+id).html('<div id="'+id+'"><a href="javascript:void(0)" onClick="convertToFinderHonourag(\''+id+'\',\'country\',this,\'' + agdate + '\',\'' + agtime + '\');" >'+val1+'</a><input type="hidden" name="fhidden" id="CountryNationalAg" value="'+val+'"></div>');
		return false;
	}


}else if(id == 'a1b33'){
	var val1=$("#finder").val();
	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}else {
	//alert(val);
	//alert(val1);
	$("#"+field+"_"+id).html('<div id="'+id+'"><a href="javascript:void(0)" onClick="convertToFinderHonourag(\''+id+'\',\'club\',this,\'' + agdate + '\',\'' + agtime + '\');" >'+val1+'</a><input type="hidden" name="fhidden" id="ClubNationalAg" value="'+val+'"></div>');
		return false;
	}


}

	var val=$("#fhidden").val();
	if(val == ''){
		alert("You must fill this field:" + field);
		return false;
	}

	$.ajax({
		url: dir+"Honour/classHonour.php",
		data: "type=edit&field="+field+"&val="+val+"&idRow="+id+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			//alert("asd");
			loadHonour(agdate, agtime);
		}
	});
}
////////////////// function  save////////////



////////////////// function  saveAll////////////
function saveAllCareerag(agdate, agtime){

//alert("Saving");
	var addCategoryCareerag = document.getElementById('addCategoryCareerag').value;
	if(addCategoryCareerag == ''){alert("Please fill this field: Category.");return false;}
	
	var club = document.getElementById('CountryCareerAg').value;
	//var addOtherClubCareerag = document.getElementById('addOtherClubCareerag').value;
	//if(addOtherClubCareerag=='' && club=='Editme' || club=='' ){alert('You must Fill Your club, from the finder or add your club manually.');return false;}
	
	var addMatchesCareerag = document.getElementById('addMatchesCareerag').value;
	if(addMatchesCareerag==''){alert("Please fill this field: Matches.");return false;}
	var addTitularCareerag = document.getElementById('addTitularCareerag').value;
	if(addTitularCareerag==''){alert("Please fill this field: Titular.");return false;}
	var addGoalsCareerag = document.getElementById('addGoalsCareerag').value;
	if(addGoalsCareerag==''){alert("Please fill this field: Goals.");return false;}
	var addAssistsCareerag = document.getElementById('addAssistsCareerag').value;
	if(addAssistsCareerag==''){alert("Please fill this field: Assists.");return false;}
	var addYellowCardsCareerag = document.getElementById('addYellowCardsCareerag').value;
	if(addYellowCardsCareerag==''){alert("Please fill this field: Yellow Cards.");return false;}
	var addRedCardsCareerag = document.getElementById('addRedCardsCareerag').value;
	if(addRedCardsCareerag==''){alert("Please fill this field: Red Cards.");return false;}
//	var addSeasonCareerag = document.getElementById('addSeasonCareerag').value;
	//if(addSeasonCareerag==''){alert("Please fill this field: Season.");return false;}
	var addYearOfSeasonCareerag = document.getElementById('addYearOfSeasonCareerag').value;
	if(addYearOfSeasonCareerag==''){alert("Please fill this field: Year of Season.");return false;}
	//var addHiddenCareerag = document.getElementById('addHiddenCareerag').value;
	//if(addHiddenCareerag==''){alert("Please fill this field: Hidden/Visible.");return false;}


$.ajax({
		url: dir+"Career/classCareer.php",
		data: "type=add&addCategoryag="+addCategoryCareerag+"&a1b22fhidden="+club+"&addMatchesag="+addMatchesCareerag+"&addTitularag="+addTitularCareerag+"&addGoalsag="+addGoalsCareerag+"&addAssistsag="+addAssistsCareerag+"&addYellowCardsag="+addYellowCardsCareerag+"&addRedCardsag="+addRedCardsCareerag+"&addYearOfSeasonag="+addYearOfSeasonCareerag+"&idUser="+agdate+"&idProfile="+agtime,
		//data: "type=add&addCategoryag="+addCategoryCareerag+"&addOtherClubag="+addOtherClubCareerag+"&a1b22fhidden="+club+"&addMatchesag="+addMatchesCareerag+"&addTitularag="+addTitularCareerag+"&addGoalsag="+addGoalsCareerag+"&addAssistsag="+addAssistsCareerag+"&addYellowCardsag="+addYellowCardsCareerag+"&addRedCardsag="+addRedCardsCareerag+"&addSeasonag="+addSeasonCareerag+"&addYearOfSeasonag="+addYearOfSeasonCareerag+"&addHiddenag="+addHiddenCareerag+"&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(data){
			if(data){alert(data)}else{
			loadCareer(agdate,agtime);}
		}
	});

}



function saveAllHonourag(asd, agdate, agtime){
	//alert(asd);
	
	
	
	if(asd=='International'){
	
	var addCategoryag = document.getElementById('addCategoryag').value;
	if(addCategoryag==''){alert('Must fill this field: Category');return false;}
	
	var addTitleag = document.getElementById('addTitleag').value;
	if(addTitleag==''){alert('Must fill this field: Title');return false;}
	
	var country = document.getElementById('CountryAg').value;
	if(country=='Editme'){alert('Must Change this field: Country');return false;}
	if(country==''){alert('Must Change this field: Country');return false;}
	
	var addYearOfag = document.getElementById('addYearOfag').value;
	if(addYearOfag==''){alert('Must fill this field: Year Of');return false;}
	
	var club = document.getElementById('ClubAg').value;
//	var addOtherClubag = document.getElementById('addOtherClubag').value;
	//if(addOtherClubag=='' && club=='Editme' || club==''){alert('You must Fill Your club, from the finder or add your club manually.');return false;}
	
	//var addHiddenag = document.getElementById('addHiddenag').value;
	
		

$.ajax({
		url: dir+"Honour/classHonour.php",
		data: "type=add&addCategoryag="+addCategoryag+"&addTitleag="+addTitleag+"&a1b2fhidden="+country+"&addYearOfag="+addYearOfag+"&a1b22fhidden="+club+"&idUser="+agdate+"&idProfile="+agtime,
		//data: "type=add&addCategoryag="+addCategoryag+"&addTitleag="+addTitleag+"&a1b2fhidden="+country+"&addYearOfag="+addYearOfag+"&a1b22fhidden="+club+"&addOtherClubag="+addOtherClubag+"&addHiddenag="+addHiddenag+"&idUser="+agdate+"&idProfile="+agtime,
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		type: 'POST',
		success: function(){
			//alert("vamos al load");
			loadHonour(agdate, agtime);
		}
	});

}else if(asd=='National'){
	
	var addNationalCategoryag = document.getElementById('addNationalCategoryag').value;
	if(addNationalCategoryag==''){alert('Must fill this field: Category');return false;}
	
	var addNationalTitleag = document.getElementById('addNationalTitleag').value;
	if(addNationalTitleag==''){alert('Must fill this field: Title');return false;}
	
	var countryNational = document.getElementById('CountryNationalAg').value;
	if(countryNational=='Editme'){alert('Must fill this field: Country');return false;}
	
	var addNationalYearOfag = document.getElementById('addNationalYearOfag').value;
	if(addNationalYearOfag==''){alert('Must fill this field: Year Of');return false;}
	
	
	var clubNational = document.getElementById('ClubNationalAg').value;
//	var addNationalOtherClubag = document.getElementById('addNationalOtherClubag').value;
	//if(addNationalOtherClubag =='' && clubNational=='Editme' || clubNational==''){alert('You must Fill Your club, from the finder or add your club manually.');return false;}

	//var addNationalHiddenag = document.getElementById('addNationalHiddenag').value;


$.ajax({
		url: dir+"Honour/classHonour.php",
		data: "type=add&addCategoryag="+addNationalCategoryag+"&addTitleag="+addNationalTitleag+"&a1b2fhidden="+countryNational+"&addYearOfag="+addNationalYearOfag+"&a1b22fhidden="+clubNational+"&idUser="+agdate+"&idProfile="+agtime,
		//data: "type=add&addCategoryag="+addNationalCategoryag+"&addTitleag="+addNationalTitleag+"&a1b2fhidden="+countryNational+"&addYearOfag="+addNationalYearOfag+"&a1b22fhidden="+clubNational+"&addOtherClubag="+addNationalOtherClubag+"&addHiddenag="+addNationalHiddenag+"&idUser="+agdate+"&idProfile="+agtime,
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		type: 'POST',
		success: function(){
		//	alert("vamos al load");
			loadHonour(agdate, agtime);
		}
	});

}
}


function saveAllPersonalDistinctionag(agdate, agtime){
//alert("saving");
	//alert(document.getElementById('addDistinctionag').value);
	var addDistinctionag = document.getElementById('addDistinctionag').value;
	//alert(document.getElementById('addSeasonag').value);
	//var addSeasonag = document.getElementById('addSeasonag').value;
	//alert(document.getElementById('addYearag').value);
	var addYearag = document.getElementById('addYearag').value;
	//alert(document.getElementById('addHiddenag').value);
	//var addHiddenPersonalDistinctionag = document.getElementById('addHiddenPersonalDistinctionag').value;
	
	
$.ajax({
		url: dir+"PersonalDistinction/classPersonalDistinction.php",
		data: "type=add&addDistinctionag="+addDistinctionag+"&addYearag="+addYearag+"&idUser="+agdate+"&idProfile="+agtime,
		//data: "type=edit&field="+field+"&val="+val+"&id="+id,
		type: 'POST',
		success: function(data){
			if(data){alert(data)}else{
			loadPersonalDistinction(agdate, agtime);
			}
		}
	});

}

////////////////// function  saveAll////////////


////////////////// function  convertToSelectSeasonPersonalDistinctionag////////////
function convertToSelectSeasonPersonalDistinctionag(id, field ,link, agdate, agtime) {
//alert(id);
//alert(field);
//alert(link);
	$('#' + field +"_"+ id).html("<select class='left' onBlur='saveNewValueHiddenPersonalDistinctionag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");'><option value='Opening'>Opening</option><option value='Closing'>Closing</option></select>");
	//$('#' + id).html("<input type='text' value='" + link.innerHTML + "' onBlur='saveNewValue(\"" + id + "\",\"" + field + "\", this.value);' />");
}

function convertToSelectSeasonCareerag(id, field ,link, agdate, agtime) {
//alert(id);
//alert(field);
//alert(link);
	$('#' + field +"_"+ id).html("<select class='left' onBlur='saveNewValueHiddenCareerag(\"" + id + "\",\"" + field + "\", this.value,\"" + agdate + "\",\"" + agtime + "\");'><option value='Opening'>Opening</option><option value='Closing'>Closing</option></select>");
	//$('#' + id).html("<input type='text' value='" + link.innerHTML + "' onBlur='saveNewValue(\"" + id + "\",\"" + field + "\", this.value);' />");
}

////////////////// function  convertToSelectSeasonPersonalDistinctionag////////////