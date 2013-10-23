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
	$("#dataPicker3").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '1900:+nn');
	
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
		$('#'+place).html("<input type='text' class='editmode f3' id='finder'></input><input name='fhidden' id='fhidden' type='hidden'/><div name='das' id='resultDiv'></div>");

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
	//alert(code);
	$("#cityag").removeAttr('disabled');
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=selectCity&field=f5&value="+code,
		type: 'POST',
		success: function(data){
			var parts = data.split('|');
			var deleted = parts.pop();
			//alert(var_dump(parts));
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
			
				if(vuelta==0){
				arreglito='<option value="'+(parts[vuelta])+'">'+(parts[vuelta])+'<option>';
				$("#cityag").html(arreglito);
				}else{
				arreglito='<option value="'+(parts[vuelta])+'">'+(parts[vuelta])+'<option>';
				$("#cityag").html($("#cityag").html()+arreglito);
				}
				
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
	//alert(code);
var code2=$(".f5").val();
	//alert(code2);	
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=change&field=f11&value="+code+"&value2="+code2,
		type: 'POST',
		success: function(data){
			//alert("changed");
		}
	})
}

function dateOfBirth(){
	
	var valorDate=$(".f2").val();
	//alert(valorDate);
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=change&field=f2&value="+valorDate,
		type: 'POST',
		success: function(data){
			//alert(data);
		}
	})
}


function endingContractDate(){
	
	var valorDate=$(".f4").val();
	//alert(valorDate);
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=change&field=f4&value="+valorDate,
		type: 'POST',
		success: function(data){
			//alert(data);
		}
	})
}


function lastContractDate(){
	
	var valorDate=$(".f4bis").val();
//	alert(valorDate);
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=change&field=f4bis&value="+valorDate,
		type: 'POST',
		success: function(data){
		//	alert(data);
		}
	})
}


function beginContractDate(){
	
	var valorDate=$(".f23").val();
//	alert(valorDate);
	$.ajax({
		url: dir2+"editagProfile.php",
		data: "type=change&field=f23&value="+valorDate,
		type: 'POST',
		success: function(data){
		//	alert(data);
		}
	})
}


</script>


<!-- Group Coach -->
<?php }
#Datos Profesionales
$iCantCamposNulos=0;
#nick
if(!empty($aProfile[0]->nick))
	$sNick=$aProfile[0]->nick;
else{
	$sNick=' - ';
	$iCantCamposNulos++;
}
#club
if(!empty($aProfile[0]->clubName)) 
	$sClub=$aProfile[0]->clubName;
else{
	$sClub=$aProfile[0]->otherClub;
	if(empty($sClub)){
		$sClub=' - ';
		$iCantCamposNulos++;
	}
}	
#BeginContractDate
if(!empty($aProfile[0]->beginContractDate))
    $sBeginContractDate=explodeEdad($aProfile[0]->beginContractDate);	
else{ 
	$sBeginContractDate=' - ';
	$iCantCamposNulos++;
	
}
#EndingContractDate
if(!empty($aProfile[0]->endingContractDate))
    $sEndingContractDate=explodeEdad($aProfile[0]->endingContractDate);	
else{  
	$sEndingContractDate=' - ';
	$iCantCamposNulos++;
}
#LastContractDate
if(!empty($aProfile[0]->lastContractDate))
    $sLastContractDate=explodeEdad($aProfile[0]->lastContractDate);	
else{  
	$sLastContractDate=' - ';
	$iCantCamposNulos++;
	
}	
#passaport
if(!empty($aProfile[0]->passaport))
    $sPassaport=$aProfile[0]->passaport;	
else{  
	$sPassaport=' - ';		
	$iCantCamposNulos++;
}
#height	
if(!empty($aProfile[0]->height))
    $sHeight=$aProfile[0]->height;	
else{  
	$sHeight=' - ';		
	$iCantCamposNulos++;
}		
#weigth
if(!empty($aProfile[0]->weigth))
    $sWeigth=$aProfile[0]->weigth;	
else{  
	$sWeigth=' - ';
	$iCantCamposNulos++;
}		
#maritalStatus
if(!empty($aProfile[0]->maritalStatus))
    $sMaritalStatus=$aProfile[0]->maritalStatus;	
else{  
	$sMaritalStatus=' - ';	
	$iCantCamposNulos++;
}	

#Porcentaje
if($iUserProfileId==7 ||$iUserProfileId==9 ||$iUserProfileId==11){#Coach c/ contract
	$iCantCamposNulos=$iCantCamposNulos-1;#saco los campos(date) de Coach c/ contract
	$iCantTotal=8;
}	

if($iUserProfileId==8 ||$iUserProfileId==10 ||$iUserProfileId==12){#Coach s/ contract
	$iCantCamposNulos=$iCantCamposNulos-2;#saco los campos(date) de Coach c/ contract
	$iCantTotal=7;
}

$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;

?>

<!-- Group Coach -->
<span id="hideinf"><span>HIDE INFO<a class="menosinf" href="#"></a></span></span>
            <table id="profFields" width="589" border="0">
            	<tr>
              	<td id="lftTD"  width="250" height="160" valign="top">
              	<ul>
                  <li><span>Sport Nick Name:</span><input  <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f1" value="<?php echo $sNick;?>" type="text" /><span  class="icon"></span></li>
                  <?php if($editingProfile){ ?>
				  <li><span>Date of birth:</span><input class="editmode f2" onChange="javascript:dateOfBirth();" id="dataPicker" value="<?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']);?>" type="text" /><span  class="icon"></span></li>
				 <?php }else{ ?>
				<li><span>Date of birth:</span><input disabled class="editmode f2" value="<?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']).' ('.$aUsuario['edad'].')';?>" type="text" /><span  class="icon"></span></li>
				<?php } ?>
                  <?php if($editingProfile){ ?>
				  <li><span>Current Club:</span><div id="club_finder"><a onClick="javascript:finder('<?php echo $sClub;?>','club_finder');" class="editmode f3" href="javascript:void(0);"><?php echo $sClub;?></a></div><span  class="icon"></span></li>
                  <?php }else{ ?>
				  <li><span>Current Club:</span><input  disabled class="editmode f3"         value="<?php echo $sClub;?>" type="text" /><span  class="icon"></span></li>
				  <?php } ?>
                  <?php 	
                  if($iUserProfileId==7 ||$iUserProfileId==9 ||$iUserProfileId==11){#Coach c/ contract
                  ?>
                  	<li><span>Begin Contract Date:</span><input  <?php echo ($editingProfile)? 'id="dataPicker3" onChange="javascript:beginContractDate();"' : 'disabled="disabled"' ;?> class="editmode f23" value="<?php echo $sBeginContractDate;?>" type="text" /><span  class="icon"></span></li>
                  	<li style=""><span>Ending contract date:</span><input <?php echo ($editingProfile)? 'id="dataPicker2" onChange="javascript:endingContractDate();"' : 'disabled="disabled"' ;?> class="editmode f4" value="<?php echo $sEndingContractDate;?>" type="text" /><span  class="icon"></span></li>
					
                  <?php 
                  }else{ if($iUserProfileId==8 ||$iUserProfileId==10 ||$iUserProfileId==12){#Coach s/ contract
                  ?>	               
                  	<li><span>Last contract date:</span><input <?php echo ($editingProfile)? 'id="dataPicker3" onChange="javascript:lastContractDate();"' : 'disabled="disabled"' ;?> class="editmode f4bis" value="<?php echo $sLastContractDate;?>" type="text" /><span  class="icon"></span></li>
                  <?php  }
                  }?>	
                </ul>
                </td>
                <td id="ctrTD"  width="250" valign="top">
               	<ul>
                  
                  <?php if($editingProfile){ ?>
				 <?php
				
				while($country=mysql_fetch_array($sql1)){
					$countryList[]=$country['country'];
					$countryCode[]=$country['Code'];
					
					
				}
				
				$cL=count($countryList);
				$cC=count($countryCode);
				
				echo '<li><span>Country:</span><select name="countryag" class="editmode f5" onClick="javascript:selectCity();">';
				
				
				for($cC1=0;$cC--;$cC1++){
					($countryList[$cC1]==$aUsuario['countryName'])? $selected='selected' :  $selected='';
					echo '<option '.$selected.' value="'.$countryCode[$cC1].'">'.$countryList[$cC1].'</option>';
				}
				echo '</select><span class="icon"></span></li>';
				
				
				}else{
				
				
				
				?><li><span>Country:</span><input <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f5"          value="<?php echo $aUsuario['countryName'];?>" type="text" /><span  class="icon"></span></li><?php
				
				}
				//var_dump($countryList);
				//var_dump($countryCode);
				?>
				<?php if($editingProfile){ ?>
				 <li><span id="">Place of birth:</span><select disabled name="cityag"  class="editmode f11" id="cityag" onClick="javascript:selectedCity();"></select><span class="icon"></span></li>
				  <?php }else{ ?>
					<li><span id="">Place of birth:</span><input class="editmode f11"  disabled  value="<?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?>" type="text" /><span id="" class="icon"></span></li>
                  <?php } ?>
				  
				  
				
                  <li><span>Passport:</span><input class="editmode f6"  <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> value="<?php echo $sPassaport;?>" type="text" /><span  class="icon"></span></li>
                  <li><span id="">Height:</span><input  <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f12" value="<?php echo $sHeight;?>" type="text" /><span id="" class="icon"></span></li>
                  <li><span id="">Weigth:</span><input  <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f13" value="<?php echo $sWeigth;?>" type="text" /><span id="" class="icon"></span></li>
                  <?php if($editingProfile){ ?>
						<li><span id="">Marital Status:</span><select name="maritalStatusag" id="maritalStatusag" onClick="javascript:changeMaritalStatus();" class="editmode f14">
																<option <?php if ($sMaritalStatus == 'Singled'){ echo 'selected';} ?> value="Singled">Singled</option>
																<option <?php if ($sMaritalStatus == 'Married'){ echo 'selected';} ?> value="Married">Married</option>
															</select>
															<span id="" class="icon"></span></li>
						 <?php }else{ ?>
						<li><span id="">Marital Status:</span><input <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f14"    value="<?php echo $sMaritalStatus;?>" type="text" /><span id="" class="icon"></span></li>
						<?php } ?>
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
