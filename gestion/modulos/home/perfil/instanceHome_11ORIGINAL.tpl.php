<?php


if(!isset($_SESSION["editProfile"]) or $_SESSION["editProfile"]==0 or $_SESSION["editProfile"]==false){
	
	$editingProfile=false;   
}else{

	$editingProfile=$_SESSION["editProfile"];   
	require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
	
	
	
	
	$oDB=new mysql;
	$oDB->connect();
	$sql=GenerateSelect("Code,country","ax_country");
	$sql1=$oDB->query($sql) or die('Die');
	
	
	
	
	
	
	
	
	?>
	
	<script type="text/javascript">
	
	
$(document).ready(function(){
	$("#dataPicker").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '1900:+nn');
	$("#dataPicker2").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');
	
	//$("#dataPicker").datepicker("option", "yearRange", '1900:+nn');

	$('.editmode').css('background-color','#EAEFE8');
	
	
	$('#profFields :text').focus(function(e){
		
			$('#profFields :text').keydown(function(e){

				var code = e.keyCode;
			
				if (code === 13){
					
				
					var clase=$(this).attr('class');
					//alert("Clase :"+clase);
						
					var tot=clase.length;
					var clas=clase.substring(9,tot);
					//alert(clas);
					
					
					
					var asd=$('.'+clas+'').val();
					//alert('.'+clas+'');
					//alert("Value "+asd);
					
					//alert(clas);
				
				$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field="+clas+"&value="+asd,
					type: 'POST',
							
					success: function(){
						//alert('Your new information has been saved!');
					}
				})
			
		}
	})
})
})		
function finder(val,place){
		$('#'+place).html("<input type='text' onChange='javascript:alert('moved');' class='editmode f3' id='finder'></input><input name='fhidden' id='fhidden' type='hidden'/><div name='das' id='resultDiv'></div>");

		$('#finder').keyup(function(){
		$.post(dir2+"finder.php",{
			field:'club',
			chars:$('#finder').val()
		},
		function(data){
			$('#resultDiv').html(data);
		});
	})
}



/*
$oDB2=new mysql;
	$oDB2->connect();
	$sql2=GenerateSelect("Code,country","ax_country",);
	$sql2=$oDB->query($sql2) or die('Die');
	
	$aUsuario['countryName'] == $row['country']
	
	*/
	
	function var_dump(obj) {
   if(typeof obj == "object") {
      return "Type: "+typeof(obj)+((obj.constructor) ? "\nConstructor: "+obj.constructor : "")+"\nValue: " + obj;
   } else {
      return "Type: "+typeof(obj)+"\nValue: "+obj;
   }
}//end function var_dump
	
function selectCity(){
	
	var code=$(".f5").val();
	alert(code);
	
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=selectCity&field=f5&value="+code,
		type: 'POST',
		success: function(data){
			var parts = data.split('|');
			var deleted = parts.pop();
			alert(var_dump(parts));
			//var total = parts.size();
			//alert(total);
			//var ini=0;
			//for (elemento in datoArrayAsociativo){
				
			//}
			//<option '.$selected.' value="'.$countryCode[$cC1].'">'.$countryList[$cC1].'</option>';
			//alert(var_dump(parts));
			//var arreglito = new Array();
			var vuelta=0;
			for (vuelta = 0; vuelta < parts.length; vuelta++){
			//for (x in parts){
			
				arreglito='<option value="'+(parts[vuelta])+'">'+(parts[vuelta])+'<option>';
				
				$("#cityag").html($("#cityag").html()+arreglito);
				
			}
			
		
			
			
		}
	})
}

function changeNationalSelected(){
	var value;
	value=$("#nationalSelectedag").val();
	
	$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field=f10&value="+value,
					type: 'POST',
							
					success: function(){
						//alert('Your new information has been saved!');
					}
				})
	

}

function changeSkillful(){
	var value;
	value=$("#skillfulChange").val();
	
	$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field=f9&value="+value,
					type: 'POST',
							
					success: function(){
						//alert('Your new information has been saved!');
					}
				})
	

}


function changeMaritalStatus(){
	var value;
	value=$("#maritalStatusag").val();
	
	$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field=f14&value="+value,
					type: 'POST',
							
					success: function(){
						//alert('Your new information has been saved!');
					}
				})
	

}

function selectedCity(){
	
var code=$(".f11").val();
	alert(code);
var code2=$(".f5").val();
	alert(code2);	
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=change&field=f11&value="+code+"&value2="+code2,
		type: 'POST',
		success: function(data){
			alert("changed");
		}
	})
}

function dateOfBirth(){
	
	var valorDate=$(".f31").val();
	alert(valorDate);
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=change&field=f31&value="+valorDate,
		type: 'POST',
		success: function(data){
			alert(data);
		}
	})
}


function endingContractDate(){
	
	var valorDate=$(".f4").val();
	alert(valorDate);
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=change&field=f4&value="+valorDate,
		type: 'POST',
		success: function(data){
			alert(data);
		}
	})
}


</script>


<!-- Group Club -->
<?php }

#Datos Profesionales
$iCantCamposNulos=0;
#name
if(!empty($aProfile[0]->name))
	$sName=$aProfile[0]->name;
else{
	$sName=' - ';
	$iCantCamposNulos++;
}
#nick
if(!empty($aProfile[0]->nickName))
	$sNick=$aProfile[0]->nickName;
else{
	$sNick=' - ';
	$iCantCamposNulos++;
}
#foundationDate
if(!empty($aProfile[0]->foundationDate))
    $sFoundationDate=explodeEdad($aProfile[0]->foundationDate);	
else { 
	$sFoundationDate=' - ';	
	$iCantCamposNulos++;
}	
#ground
if(!empty($aProfile[0]->ground))
    $sGround=$aProfile[0]->ground;	
else{  
	$sGround=' - ';
	$iCantCamposNulos++;
}
#address
if(!empty($aProfile[0]->address))
    $sAddress=$aProfile[0]->address;	
else  
	$sAddress=' - ';	
#countryName
if(!empty($aProfile[0]->countryName))
    $sCountryName=$aProfile[0]->countryName;	
else{  
	$sCountryName=' - ';
	$iCantCamposNulos++;
}	

/* otra columna */

#website
if(!empty($aProfile[0]->website))
    $sWebsite=$aProfile[0]->website;	
else{  
	$sWebsite=' - ';
	$iCantCamposNulos++;
}	
#presidentName
if(!empty($aProfile[0]->presidentName))
    $sPresidentName=$aProfile[0]->presidentName;	
else{  
	if(!empty($aProfile[0]->otherPresident)){
		$sPresidentName=$aProfile[0]->otherPresident;
	}else{
		$sPresidentName=' - ';
		$iCantCamposNulos++;
	}
}	
#dtName
if(!empty($aProfile[0]->dtName))
    $sDtName=$aProfile[0]->dtName;	
else{  
	if(!empty($aProfile[0]->otherDt)){
		$sDtName=$aProfile[0]->otherDt;
	}else{
		$sDtName=' - ';
		$iCantCamposNulos++;
	}
}	
#managerName
if(!empty($aProfile[0]->managerName))
    $sManagerName=$aProfile[0]->managerName;	
else{  
	if(!empty($aProfile[0]->otherManager)){
		$sManagerName=$aProfile[0]->otherManager;
	}else{
		$sManagerName=' - ';
		$iCantCamposNulos++;
	}

}			
#federationName
if(!empty($aProfile[0]->federationName))
    $sFederationName=$aProfile[0]->federationName;	
else{  
	if(!empty($aProfile[0]->otherFederation)){
		$sFederationName=$aProfile[0]->otherFederation;
	}else{
		$sFederationName	=' - ';
		$iCantCamposNulos++;
	}
}	
	
#porcentaje
$iCantTotal=11;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;	
?>
<!-- Group Club -->
<span id="hideinf"><span>HIDE INFO<a class="menosinf" href="#"></a></span></span>
            <table id="profFields" width="589" height="130" border="0">
            	<tr>
              	<td id="lftTD" width="250" valign="top">
              	<ul>
              	
              	  <li><span>Club Name:</span><input class="editmode f1" value="<?php echo $sName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Sport Nick Name:</span><input class="editmode f32" value="<?php echo $sNick;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Foundation date:</span><input class="editmode f33" value="<?php echo $sFoundationDate;?>" type="text" /><span  class="icon"></span></li>            
				  <li><span>Ground :</span><input class="editmode f34" value="<?php echo $sGround;?>" type="text" /><span  class="icon"></span></li>
				  <li><span>Address:</span><input class="editmode f35" value="<?php echo $sAddress;?>" type="text" /><span  class="icon"></span></li>
				  <li><span>Country:</span><input class="editmode f36" value="<?php echo $sCountryName;?>" type="text" /><span  class="icon"></span></li>
                </ul>
                </td>
                
                <td id="ctrTD" width="250" valign="top">
               	<ul>
               	  <li><span>Website:</span><input class="editmode f37" value="<?php echo $sWebsite;?>" type="text" /><span  class="icon"></span></li>
               	  <li><span>President:</span><input class="editmode f38" value="<?php echo $sPresidentName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>DT:</span><input class="editmode f39"      value="<?php echo $sDtName;?>" type="text" /><span class="icon"></span></li>                   
                  <li><span>Manager:</span><input class="editmode f40" value="<?php echo $sManagerName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Federation:</span><input class="editmode f41" value="<?php echo $sFederationName;?>" type="text" /><span  class="icon"></span></li>
    
               	</ul>
                </td>
                <td id="rgtTD" width="89">
                <div id="advance">
      					<div id="progressbar"><span id="pbyellow"></span></div>
      					<p><?php echo $iPorcentajeMostrar;?>% (?)</p>
  							</div>
                </td>
              </tr>
            </table>
            <!----->
 <script type="text/javascript">
	document.getElementById('pbyellow').style.backgroundPosition = '0px <?php echo $iPorcFinal;?>px';
</script>         
