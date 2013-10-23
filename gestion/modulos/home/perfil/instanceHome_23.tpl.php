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
				$("#loadGif").css('display','block');
					$("#loadGif").html("<img src='img/indicator.gif' width='15px' height='15px'>");
				$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field="+clas+"&value="+asd,
					type: 'POST',
							
					success: function(){
						$("#loadGif").html('');
					$("#loadGif").css('display','none');
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

function save(clas){
	var asd=$('.'+clas+'').val();
					//alert('.'+clas+'');
					//alert("Value "+asd);
					
					//alert(clas);
					$("#loadGif").css('display','block');
					$("#loadGif").html("<img src='img/indicator.gif' width='15px' height='15px'>");
				$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field="+clas+"&value="+asd,
					type: 'POST',
							
					success: function(){
					$('.'+clas).animate({ backgroundColor: "#f6f6f6" }, 'fast');
					
					$("#loadGif").html('');
					$("#loadGif").css('display','none');
					//$('.'+clas).('background-color');
						
					}
				})

}


function saveBirthDay(val){
	$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field=f2&value="+val,
					type: 'POST',
				})
}

function saveBCD(val){
	$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field=f23&value="+val,
					type: 'POST',
				})
}

function saveECD(val){
	$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field=f4&value="+val,
					type: 'POST',
				})
}

function saveLCD(val){
	$.ajax({
					url: dir2+"editagProfile.php",
					data: "type=change&field=f4bis&value="+val,
					type: 'POST',
				})
}

function year(){
	//alert($("#yearAndresGrosso").val());
	
	var year=$("#yearAndresGrosso").val();
	var month=$("#monthAndresGrosso").val();
	var day=$("#dayAndresGrosso").val();
	var birthday=year+'-'+month+'-'+day;
	
	//alert(birthday);
	
	saveBirthDay(birthday);
}

function yearBCD(){
	//alert($("#yearAndresGrosso").val());
	
	var year=$("#yearAndresGrossoBCD").val();
	var month=$("#monthAndresGrossoBCD").val();
	var day=$("#dayAndresGrossoBCD").val();
	var BCD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	
	saveBCD(BCD);
}

function yearECD(){
	//alert($("#yearAndresGrosso").val());
	
	var year=$("#yearAndresGrossoECD").val();
	var month=$("#monthAndresGrossoECD").val();
	var day=$("#dayAndresGrossoECD").val();
	var ECD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	
	saveECD(ECD);
}

function yearLCD(){
	//alert($("#monthAndresGrosso").val());
	
	var year=$("#yearAndresGrossoLCD").val();
	var month=$("#monthAndresGrossoLCD").val();
	var day=$("#dayAndresGrossoLCD").val();
	var LCD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveLCD(LCD);
}

function month(){
	//alert($("#monthAndresGrosso").val());
	
	var year=$("#yearAndresGrosso").val();
	var month=$("#monthAndresGrosso").val();
	var day=$("#dayAndresGrosso").val();
	var birthday=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveBirthDay(birthday);
}

function monthBCD(){
	//alert($("#monthAndresGrosso").val());
	
	var year=$("#yearAndresGrossoBCD").val();
	var month=$("#monthAndresGrossoBCD").val();
	var day=$("#dayAndresGrossoBCD").val();
	var BCD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveBCD(BCD);
}

function monthECD(){
	//alert($("#monthAndresGrosso").val());
	
	var year=$("#yearAndresGrossoECD").val();
	var month=$("#monthAndresGrossoECD").val();
	var day=$("#dayAndresGrossoECD").val();
	var ECD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveECD(ECD);
}

function monthLCD(){
	//alert($("#monthAndresGrosso").val());
	
	var year=$("#yearAndresGrossoLCD").val();
	var month=$("#monthAndresGrossoLCD").val();
	var day=$("#dayAndresGrossoLCD").val();
	var LCD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveLCD(LCD);
}

function day(){
	//alert($("#dayAndresGrosso").val());
	
	var year=$("#yearAndresGrosso").val();
	var month=$("#monthAndresGrosso").val();
	var day=$("#dayAndresGrosso").val();
	var birthday=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveBirthDay(birthday);
}

function dayBCD(){
	//alert($("#monthAndresGrosso").val());
	
	var year=$("#yearAndresGrossoBCD").val();
	var month=$("#monthAndresGrossoBCD").val();
	var day=$("#dayAndresGrossoBCD").val();
	var BCD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveBCD(BCD);
}

function dayECD(){
	//alert($("#monthAndresGrosso").val());
	
	var year=$("#yearAndresGrossoECD").val();
	var month=$("#monthAndresGrossoECD").val();
	var day=$("#dayAndresGrossoECD").val();
	var ECD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveECD(ECD);
}

function dayLCD(){
	//alert($("#monthAndresGrosso").val());
	
	var year=$("#yearAndresGrossoLCD").val();
	var month=$("#monthAndresGrossoLCD").val();
	var day=$("#dayAndresGrossoLCD").val();
	var LCD=year+'-'+month+'-'+day;
	
	//alert(birthday);
	saveLCD(LCD);
}
</script>
<style>
#loadGif{
	float:left;
	margin-left:250px;
	margin-top:50px;
}
</style>

<!-- Group Coach -->
<?php }
#Datos Profesionales
$iCantCamposNulos=0;
#nick
if($aProfile[0]){
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
}else{
	$sNick=' - ';
	$iCantCamposNulos++;
	$sClub=' - ';
	$iCantCamposNulos++;
	$sBeginContractDate=' - ';
	$iCantCamposNulos++; 
	$sEndingContractDate=' - ';
	$iCantCamposNulos++; 
	$sLastContractDate=' - ';
	$iCantCamposNulos++; 
	$sPassaport=' - ';		
	$iCantCamposNulos++; 
	$sHeight=' - ';		
	$iCantCamposNulos++; 
	$sWeigth=' - ';
	$iCantCamposNulos++; 
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
                  <li><span>Sport Nick Name:</span><input  <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f1" value="<?php echo $sNick;?>" type="text" /><?php echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save it!" onClick="javascript:save(\'f1\');">' : '' ;?></li>
                 <?php if($editingProfile){ ?>
				  <li><span>Date of birth:</span>
				  

<?php $date=explode('-',$aUsuario['dayOfBirthDay']) ;
$yearBD=(int)$date[0];
//echo $date[1]."<br />";//month
$monthBD=(int)$date[1];
//echo $date[2]."<br />";//day
$dayBD=(int)$date[2];
$selectYear='';
$selectMonth='';
$selectDay='';
?>
				  
<select id="dayAndresGrosso" onChange="javascript:day();">

		  <?php
		  
		  for ($day = 1; $day <= 31; $day++) {
		  
		  
			if($day==$dayBD){		  		  
			echo "<option selected value='$day'>$day</option>";
				}else{
			echo "<option value='$day'>$day</option>";
			}
		  }
		 
		  ?>
		  </select>
		  
		  <select id="monthAndresGrosso" onChange="javascript:month();">
		  <option <?php echo ($monthBD==01)? 'selected' : '' ; ?> value="01">Jan</option>
		  <option <?php echo ($monthBD==02)? 'selected' : '' ; ?> value="02">Feb</option>
		  <option <?php echo ($monthBD==03)? 'selected' : '' ; ?> value="03">Mar</option>
		  <option <?php echo ($monthBD==04)? 'selected' : '' ; ?> value="04">Apr</option>
		  <option <?php echo ($monthBD==05)? 'selected' : '' ; ?> value="05">May</option>
		  <option <?php echo ($monthBD==06)? 'selected' : '' ; ?> value="06">Jun</option>
		  <option <?php echo ($monthBD==07)? 'selected' : '' ; ?> value="07">Jul</option>
		  <option <?php echo ($monthBD==08)? 'selected' : '' ; ?> value="08">Aug</option>
		  <option <?php echo ($monthBD==09)? 'selected' : '' ; ?> value="09">Sep</option>
		  <option <?php echo ($monthBD==10)? 'selected' : '' ; ?> value="10">Oct</option>
		  <option <?php echo ($monthBD==11)? 'selected' : '' ; ?> value="11">Nov</option>
		  <option <?php echo ($monthBD==12)? 'selected' : '' ; ?> value="12">Dec</option>
		  </select>
		  
		  <select id="yearAndresGrosso" onChange="javascript:year();">
	  <?php  for ($year = 2011; $year >= 1905; $year--) { 
	if($year==$yearBD){
		echo "<option selected value='$year'>$year</option>";
	}else{
		echo "<option  value='$year'>$year</option>";
	}
	  } ?>
		  </select>
				  

</li>
<?php }else{ ?>
				<li><span>Date of birth:</span><input disabled class="editmode f2" 
value="<?php if(!empty($aUsuario['dayOfBirthDay'])) echo explodeEdad($aUsuario['dayOfBirthDay']); else echo ' - ';?>" type="text" /> </li>
				<?php } ?>
                  <?php if($editingProfile){ ?>
				  <li><span>Current Club:</span><div id="club_finder"><a onClick="javascript:finder('<?php echo $sClub;?>','club_finder');" class="editmode f3" href="javascript:void(0);"><?php echo $sClub;?></a></div></li>
                  <?php }else{ ?>
				  <li><span>Current Club:</span><input  disabled class="editmode f3"         value="<?php echo $sClub;?>" type="text" /></li>
				  <?php } ?>
                  <?php 	
                  if($iUserProfileId==7 ||$iUserProfileId==9 ||$iUserProfileId==11){#Coach c/ contract
                  ?>
				  
				  
<!-- Begin Contract Date -->


                 <?php if($editingProfile){ ?>
				  <li><span>Begin Contract Date:</span>
				  

<?php 
//var_dump($sBeginContractDate);
$date2=explode('/',$sBeginContractDate) ;

$dayBCDBD=(int)$date2[0];

$monthBCDBD=(int)$date2[1];

$yearBCDBD=(int)$date2[2];

$selectYear='';

$selectMonth='';

$selectDay='';
?>
				  
<select id="dayAndresGrossoBCD" onChange="javascript:dayBCD();">

		  <?php
		  
		  for ($day = 1; $day <= 31; $day++) {
		  
		  
			if($day==$dayBCDBD){		  		  
			echo "<option selected value='$day'>$day</option>";
				}else{
			echo "<option value='$day'>$day</option>";
			}
		  }
		 
		  ?>
		  </select>
		  
		  <select id="monthAndresGrossoBCD" onChange="javascript:monthBCD();">
		  <option <?php echo ($monthBCDBD==01)? 'selected' : '' ; ?> value="01">Jan</option>
		  <option <?php echo ($monthBCDBD==02)? 'selected' : '' ; ?> value="02">Feb</option>
		  <option <?php echo ($monthBCDBD==03)? 'selected' : '' ; ?> value="03">Mar</option>
		  <option <?php echo ($monthBCDBD==04)? 'selected' : '' ; ?> value="04">Apr</option>
		  <option <?php echo ($monthBCDBD==05)? 'selected' : '' ; ?> value="05">May</option>
		  <option <?php echo ($monthBCDBD==06)? 'selected' : '' ; ?> value="06">Jun</option>
		  <option <?php echo ($monthBCDBD==07)? 'selected' : '' ; ?> value="07">Jul</option>
		  <option <?php echo ($monthBCDBD==08)? 'selected' : '' ; ?> value="08">Aug</option>
		  <option <?php echo ($monthBCDBD==09)? 'selected' : '' ; ?> value="09">Sep</option>
		  <option <?php echo ($monthBCDBD==10)? 'selected' : '' ; ?> value="10">Oct</option>
		  <option <?php echo ($monthBCDBD==11)? 'selected' : '' ; ?> value="11">Nov</option>
		  <option <?php echo ($monthBCDBD==12)? 'selected' : '' ; ?> value="12">Dec</option>
		  </select>
		  
		  <select id="yearAndresGrossoBCD" onChange="javascript:yearBCD();">
	  <?php  for ($year = 2011; $year >= 1905; $year--) { 
	if($year==$yearBCDBD){
		echo "<option selected value='$year'>$year</option>";
	}else{
		echo "<option  value='$year'>$year</option>";
	}
	  } ?>
		  </select>
				  

</li>
<?php }else{ ?>
				<li><span>Begin Contract Date:</span><input disabled class="editmode f23" 
value="<?php echo $sBeginContractDate; ?>" type="text" /> </li>
				<?php } ?>


<!-- End Begin Contract Date -->




                  <!--	<li><span>Begin Contract Date:</span><input  <?php // echo ($editingProfile)? 'id="dataPicker3" onChange="javascript:beginContractDate();"' : 'disabled="disabled"' ;?> class="editmode f23" value="<?php // echo $sBeginContractDate;?>" type="text" /><span  class="icon"></span></li> -->
                  	<!-- <li style=""><span>Ending contract date:</span><input <?php // echo ($editingProfile)? 'id="dataPicker2" onChange="javascript:endingContractDate();"' : 'disabled="disabled"' ;?> class="editmode f4" value="<?php // echo $sEndingContractDate;?>" type="text" /><span  class="icon"></span></li> -->
<!-- BEGIN ENDING CONTRACT DATE -->

 <?php if($editingProfile){ ?>
				  <li><span>Ending Contract Date:</span>
				  

<?php 
//var_dump($sBeginContractDate);
$date3=explode('/',$sEndingContractDate) ;

$dayECDBD=(int)$date3[0];

$monthECDBD=(int)$date3[1];

$yearECDBD=(int)$date3[2];

$selectYear='';

$selectMonth='';

$selectDay='';
?>
				  
<select id="dayAndresGrossoECD" onChange="javascript:dayECD();">

		  <?php
		  
		  for ($day = 1; $day <= 31; $day++) {
		  
		  
			if($day==$dayECDBD){		  		  
			echo "<option selected value='$day'>$day</option>";
				}else{
			echo "<option value='$day'>$day</option>";
			}
		  }
		 
		  ?>
		  </select>
		  
		  <select id="monthAndresGrossoECD" onChange="javascript:monthECD();">
		  <option <?php echo ($monthECDBD==01)? 'selected' : '' ; ?> value="01">Jan</option>
		  <option <?php echo ($monthECDBD==02)? 'selected' : '' ; ?> value="02">Feb</option>
		  <option <?php echo ($monthECDBD==03)? 'selected' : '' ; ?> value="03">Mar</option>
		  <option <?php echo ($monthECDBD==04)? 'selected' : '' ; ?> value="04">Apr</option>
		  <option <?php echo ($monthECDBD==05)? 'selected' : '' ; ?> value="05">May</option>
		  <option <?php echo ($monthECDBD==06)? 'selected' : '' ; ?> value="06">Jun</option>
		  <option <?php echo ($monthECDBD==07)? 'selected' : '' ; ?> value="07">Jul</option>
		  <option <?php echo ($monthECDBD==08)? 'selected' : '' ; ?> value="08">Aug</option>
		  <option <?php echo ($monthECDBD==09)? 'selected' : '' ; ?> value="09">Sep</option>
		  <option <?php echo ($monthECDBD==10)? 'selected' : '' ; ?> value="10">Oct</option>
		  <option <?php echo ($monthECDBD==11)? 'selected' : '' ; ?> value="11">Nov</option>
		  <option <?php echo ($monthECDBD==12)? 'selected' : '' ; ?> value="12">Dec</option>
		  </select>
		  
		  <select id="yearAndresGrossoECD" onChange="javascript:yearECD();">
	  <?php  for ($year = 2011; $year >= 1905; $year--) { 
	if($year==$yearECDBD){
		echo "<option selected value='$year'>$year</option>";
	}else{
		echo "<option  value='$year'>$year</option>";
	}
	  } ?>
		  </select>
				  

</li>
<?php }else{ ?>
				<li><span>Ending Contract Date:</span><input disabled class="editmode f4" 
value="<?php echo $sEndingContractDate; ?>" type="text" /> </li>
				<?php } ?>

<!-- END ENDING CONTRACT DATE -->					
					
                  <?php 
                  }else{ if($iUserProfileId==8 ||$iUserProfileId==10 ||$iUserProfileId==12){#Coach s/ contract
                  ?>	               
                  	
					
					
					<!-- BEGIN LAST CONTRACT DATE -->

 <?php if($editingProfile){ ?>
				  <li><span>Last Contract Date:</span>
				  

<?php 
//var_dump($sLastContractDate);
$date4=explode('/',$sLastContractDate) ;

$dayLCDBD=(int)$date4[0];

$monthLCDBD=(int)$date4[1];

$yearLCDBD=(int)$date4[2];

$selectYear='';

$selectMonth='';

$selectDay='';
?>
				  
<select id="dayAndresGrossoLCD" onChange="javascript:dayLCD();">

		  <?php
		  
		  for ($day = 1; $day <= 31; $day++) {
		  
		  
			if($day==$dayLCDBD){		  		  
			echo "<option selected value='$day'>$day</option>";
				}else{
			echo "<option value='$day'>$day</option>";
			}
		  }
		 
		  ?>
		  </select>
		  
		  <select id="monthAndresGrossoLCD" onChange="javascript:monthLCD();">
		  <option <?php echo ($monthLCDBD==01)? 'selected' : '' ; ?> value="01">Jan</option>
		  <option <?php echo ($monthLCDBD==02)? 'selected' : '' ; ?> value="02">Feb</option>
		  <option <?php echo ($monthLCDBD==03)? 'selected' : '' ; ?> value="03">Mar</option>
		  <option <?php echo ($monthLCDBD==04)? 'selected' : '' ; ?> value="04">Apr</option>
		  <option <?php echo ($monthLCDBD==05)? 'selected' : '' ; ?> value="05">May</option>
		  <option <?php echo ($monthLCDBD==06)? 'selected' : '' ; ?> value="06">Jun</option>
		  <option <?php echo ($monthLCDBD==07)? 'selected' : '' ; ?> value="07">Jul</option>
		  <option <?php echo ($monthLCDBD==08)? 'selected' : '' ; ?> value="08">Aug</option>
		  <option <?php echo ($monthLCDBD==09)? 'selected' : '' ; ?> value="09">Sep</option>
		  <option <?php echo ($monthLCDBD==10)? 'selected' : '' ; ?> value="10">Oct</option>
		  <option <?php echo ($monthLCDBD==11)? 'selected' : '' ; ?> value="11">Nov</option>
		  <option <?php echo ($monthLCDBD==12)? 'selected' : '' ; ?> value="12">Dec</option>
		  </select>
		  
		  <select id="yearAndresGrossoLCD" onChange="javascript:yearLCD();">
	  <?php  for ($year = 2011; $year >= 1905; $year--) { 
	if($year==$yearLCDBD){
		echo "<option selected value='$year'>$year</option>";
	}else{
		echo "<option  value='$year'>$year</option>";
	}
	  } ?>
		  </select>
				  

</li>
<?php }else{ ?>
				<li><span>Last Contract Date:</span><input disabled class="editmode f4" 
value="<?php echo $sLastContractDate; ?>" type="text" /> </li>
				<?php } ?>

<!-- END LAST CONTRACT DATE -->	
					
					
					
					
					<!-- <li><span>Last contract date:</span><input <?php // echo ($editingProfile)? 'id="dataPicker3" onChange="javascript:lastContractDate();"' : 'disabled="disabled"' ;?> class="editmode f4bis" value="<?php // echo $sLastContractDate;?>" type="text" /><span  class="icon"></span></li> -->
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
				echo '</select> </li>';
				
				
				}else{
				
				
				
				?><li><span>Country:</span><input <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f5"          value="<?php echo $aUsuario['countryName'];?>" type="text" /></li><?php
				
				}
				//var_dump($countryList);
				//var_dump($countryCode);
				?>
				<?php if($editingProfile){ ?>
				 <li><span id="">Place of birth:</span><select disabled name="cityag"  class="editmode f11" id="cityag" onClick="javascript:selectedCity();"></select> </li>
				  <?php }else{ ?>
					<li><span id="">Place of birth:</span><input class="editmode f11"  disabled  value="<?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?>" type="text" /> </li>
                  <?php } ?>
				  
				  
				
                  <li><span>Passport:</span><input class="editmode f6"  <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> value="<?php echo $sPassaport;?>" type="text" /><?php echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save it!" onClick="javascript:save(\'f6\');">' : '' ;?></li>
                  <li><span id="">Height:</span><input  <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f12" value="<?php echo $sHeight;?>" type="text" /><?php echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save it!" onClick="javascript:save(\'f12\');">' : '' ;?> </li>
                  <li><span id="">Weigth:</span><input  <?php echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f13" value="<?php echo $sWeigth;?>" type="text" /><?php echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save it!" onClick="javascript:save(\'f13\');">' : '' ;?> </li>
                  <?php // if($editingProfile){ ?>
				  <!-- <li><span id="">Marital Status:</span><select name="maritalStatusag" id="maritalStatusag" onClick="javascript:changeMaritalStatus();" class="editmode f14"> -->
					<!--											<option <?php //if ($sMaritalStatus == 'Single'){ echo 'selecte';} ?> value="Single">Single</option>-->
						<!--										<option <?php //if ($sMaritalStatus == 'Married'){ echo 'selected';} ?> value="Married">Married</option>-->
							<!--								</select> 
															 </li>-->
						 <?php //}else{ ?>
						<!-- <li><span id="">Marital Status:</span><input <?php // echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f14"    value="<?php // echo $sMaritalStatus;?>" type="text" /> </li> -->
						<?php // } ?>
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
