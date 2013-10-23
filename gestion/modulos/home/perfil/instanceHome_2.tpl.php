<iframe style="width:0;height:0;border:none;display:none;" src="" name="iframeEdit" id="iframeEdit"></iframe>
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

<script>



function selectCity(){
	$("#cityag").html('');
	var arreglito='';
	var parts = new Array();
	var code=$(".f5").val();
	//alert(code);
	$("#cityag").removeAttr('disabled');
	$.ajax({
		url: dir2+"editCountry.php",
		data: "type=selectCity&field=f5&value="+code,
		type: 'POST',
		success: function(data){
			var parts = data.split('|');
			var deleted = parts.pop();

			var vuelta=0;
			var total = parts.length;
			for (vuelta = 0; vuelta < total; vuelta++){
				
				
				arreglito=arreglito+'<option value="'+(parts[vuelta])+'">'+(parts[vuelta])+'</option>';
				
				
			}
				$("#cityag").html(arreglito);
		}
	});
}

function selectedCity(){
	
var code=$(".f11").val();
//	alert(code);
var code2=$(".f5").val();
//	alert(code2);	
	$.ajax({
		url: dir2+"editCountry.php",
		data: "type=change&field=f11&value="+code+"&value2="+code2,
		type: 'POST',
		success: function(data){
		//	alert("changed");
		}
	})
}

$(document).ready(function(){

	$("#divGif").click(function(){
		//alert("clic");
		$("#ResForInformation").html('<img src="img/indicator.gif" style="width:15px;height:15px">');
	})
})

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
if(!empty($aProfile[0]->otherClub)) 
	$sClub=$aProfile[0]->otherClub;
else{ 
		$sClub=' - ';
		$iCantCamposNulos++;
	}

#BeginContractDate
if(!empty($aProfile[0]->beginContractDate))
    $sBeginContractDate=explodeEdad($aProfile[0]->beginContractDate);	
else{ 
	$sBeginContractDate='00/00/0000';
	$iCantCamposNulos++;
	
}
#EndingContractDate
if(!empty($aProfile[0]->endingContractDate))
    $sEndingContractDate=explodeEdad($aProfile[0]->endingContractDate);	
else{  
	$sEndingContractDate='00/00/0000';
	$iCantCamposNulos++;
}
#LastContractDate
if(!empty($aProfile[0]->lastContractDate))
    $sLastContractDate=explodeEdad($aProfile[0]->lastContractDate);	
else{  
	$sLastContractDate='00/00/0000';
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
<form target="iframeEdit" method="post" action="gestion/modulos/home/perfil/editagProfile.php">
<span id="hideinf">
<?php if($editingProfile){?> 
<a onclick="JS_QuitEdit(); return false;" href="#" style="float: right;font-size: 10px;font-weight: bold;">Close</a>
<?php }else{?>
<span>HIDE INFO<a class="menosinf" href="#"></a></span>
<?php }?>
</span>
            <table id="profFields" width="589" border="0">
            	<tr>
              	<td id="lftTD" width="285" valign="top">
              	<ul>
				<?php
				  switch($iUserProfileId){
					case 7:
						echo '<input type="hidden" value="cuc" name="agmjc">';
						break;
					
					case 9:
						echo '<input type="hidden" value="cuc" name="agmjc">';
						break;
					
					case 11:
						echo '<input type="hidden" value="cuc" name="agmjc">';
						break;
						
					case 8:
						echo '<input type="hidden" value="cwc" name="agmjc">';
						break;
						
					case 10:
						echo '<input type="hidden" value="cwc" name="agmjc">';
						break;
						
					case 12:
						echo '<input type="hidden" value="cwc" name="agmjc">';
						break;
				  }
				  ?>
                  <li><span><?php print $_IDIOMA->traducir("Sport Nick Name"); ?>:&nbsp;</span>
                  <?php if($editingProfile){?>
                  	<input  class="editmode f1" name="nick" value="<?php echo $sNick;?>" type="text" />
                  	<?php }else{?>
                  	<?php echo $sNick;?>
                  	<?php }?></li>
                 <?php if($editingProfile){ ?>
				  	<li><span><?php print $_IDIOMA->traducir("Date of birth"); ?>:&nbsp;</span>
					<?php $date=explode('-',$aUsuario['dayOfBirthDay']) ;
					$yearBD=(int)$date[0];
					$monthBD=(int)$date[1];
					$dayBD=(int)$date[2];
					$selectYear='';
					$selectMonth='';
					$selectDay='';
					?>
					<div style="clear:both;width: 100%"></div>
					<select id="dayAndresGrosso" name="dayBirth">
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
					<select id="monthAndresGrosso" name="monthBirth">
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
		  			<select id="yearAndresGrosso" name="yearBirth">
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
					<li>
						<span><?php print $_IDIOMA->traducir("Date of birth"); ?>:&nbsp;</span>
						<?php if(!empty($aUsuario['dayOfBirthDay'])) echo explodeEdad($aUsuario['dayOfBirthDay']); else echo ' - ';?>
					</li>
				<?php } ?>
                  
                  <?php 	
                  if($iUserProfileId==7 ||$iUserProfileId==9 ||$iUserProfileId==11){#Coach c/ contract
                  ?>
				  
				  
<!-- Begin Contract Date -->


                 <?php /*if($editingProfile){ ?>
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
				<?php } */?>


<!-- End Begin Contract Date -->




                  <!--	<li><span>Begin Contract Date:</span><input  <?php // echo ($editingProfile)? 'id="dataPicker3" onChange="javascript:beginContractDate();"' : 'disabled="disabled"' ;?> class="editmode f23" value="<?php // echo $sBeginContractDate;?>" type="text" /><span  class="icon"></span></li> -->
                  	<!-- <li style=""><span>Ending contract date:</span><input <?php // echo ($editingProfile)? 'id="dataPicker2" onChange="javascript:endingContractDate();"' : 'disabled="disabled"' ;?> class="editmode f4" value="<?php // echo $sEndingContractDate;?>" type="text" /><span  class="icon"></span></li> -->

					
					
				  
				  
					<!-- BEGIN ENDING CONTRACT DATE -->

 <?php if($editingProfile){ ?>
				  <li><span><?php print $_IDIOMA->traducir("Ending Contract Date"); ?>:&nbsp;</span>
				  

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
				 <div style="clear:both;width: 100%"></div> 
<select id="dayAndresGrossoECD" name="dayEnding">

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
		  
		  <select id="monthAndresGrossoECD" name="monthEnding">
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
		  
		  <select id="yearAndresGrossoECD" name="yearEnding">
	  <?php  for ($year = 2011; $year <= 2100; $year++) { 
	if($year==$yearECDBD){
		echo "<option selected value='$year'>$year</option>";
	}else{
		echo "<option  value='$year'>$year</option>";
	}
	  } ?>
		  </select>
				  

</li>
<?php }else{ ?>
				<li><span><?php print $_IDIOMA->traducir("Ending Contract Date"); ?>:&nbsp;</span>
				<?php echo $sEndingContractDate; ?>
				</li>
				<?php } ?>

<!-- END ENDING CONTRACT DATE -->					
					
                  <?php 
                  }else{ if($iUserProfileId==8 ||$iUserProfileId==10 ||$iUserProfileId==12){#Coach s/ contract
                  ?>	               
                  	
					
					
					<!-- BEGIN LAST CONTRACT DATE -->

 <?php if($editingProfile){ ?>
				  <li><span><?php print $_IDIOMA->traducir("Last Contract Date"); ?>:&nbsp;</span>
				  

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
				  <div style="clear:both;width: 100%"></div>
<select id="dayAndresGrossoLCD" name="dayLastContract" >

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
		  
		  <select id="monthAndresGrossoLCD" name="monthLastContract">
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
		  
		  <select id="yearAndresGrossoLCD" name="yearLastContract">
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
				<li><span><?php print $_IDIOMA->traducir("Last Contract Date"); ?>:&nbsp;</span>
				<?php echo $sLastContractDate; ?>
				</li>
				<?php } ?>

<!-- END LAST CONTRACT DATE -->	
					
					
					
					
					<!-- <li><span>Last contract date:</span><input <?php // echo ($editingProfile)? 'id="dataPicker3" onChange="javascript:lastContractDate();"' : 'disabled="disabled"' ;?> class="editmode f4bis" value="<?php // echo $sLastContractDate;?>" type="text" /><span  class="icon"></span></li> -->
                  <?php  }
                  }?>	
                </ul>
                </td>
                <td id="ctrTD" width="280" valign="top" style="padding-right: 10px;">
               	<ul>
                  
                  <?php if($editingProfile){ ?>
				 <?php
				
				while($country=mysql_fetch_array($sql1)){
					$countryList[]=$country['country'];
					$countryCode[]=$country['Code'];
					
					
				}
				
				$cL=count($countryList);
				$cC=count($countryCode);
				
				echo '<li><span>';
				print $_IDIOMA->traducir("Country");
				echo ':&nbsp;</span><select name="countryag" class="editmode f5" onChange="selectCity();">';
				
				
				for($cC1=0;$cC--;$cC1++){
					($countryList[$cC1]==$aUsuario['countryName'])? $selected='selected' :  $selected='';
					echo '<option '.$selected.' value="'.$countryCode[$cC1].'">'.$countryList[$cC1].'</option>';
				}
				echo '</select> </li>';
				
				
				}else{
				
				
				
				?><li><span><?php print $_IDIOMA->traducir("Country"); ?>:&nbsp;</span>
				<?php echo $aUsuario['countryName'];?>
				</li><?php
				
				}
				//var_dump($countryList);
				//var_dump($countryCode);
				?>
				<?php if($editingProfile){ ?>
				 <li><span id=""><?php print $_IDIOMA->traducir("City"); ?>:&nbsp;</span><select disabled name="cityag"  class="editmode f11" id="cityag" onChange="selectedCity();"></select>
				 		<script type="text/javascript">
				 		selectCity();
				 		</script>
				 	</li>
				  <?php }else{ ?>
					<li><span id=""><?php print $_IDIOMA->traducir("City"); ?>:&nbsp;</span>
					<?php echo $aUsuario['cityName'];?>
					</li>
                  <?php } ?>
				  
				  
				
                  <!-- <li><span>Passport:</span><input class="editmode f6"  <?php // echo ($editingProfile)? '' : 'disabled="disabled"' ;?> value="<?php //  echo $sPassaport;?>" type="text" /><?php // echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save it!" onClick="javascript:save(\'f6\');">' : '' ;?></li> -->
                  <!--<li><span id="">Height:</span><input  <?php // //echo  ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f12" value="<?php // echo  $sHeight;?>" type="text" /><?php // echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save it!" onClick="javascript:save(\'f12\');">' : '' ;?> </li>-->
                  <!--<li><span id="">Weigth:</span><input  <?php // echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f13" value="<?php // echo  $sWeigth;?>" type="text" /><?php // echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save it!" onClick="javascript:save(\'f13\');">' : '' ;?> </li>-->
                  <?php // if($editingProfile){ ?>
				  <!-- <li><span id="">Marital Status:</span><select name="maritalStatusag" id="maritalStatusag" onClick="javascript:changeMaritalStatus();" class="editmode f14"> -->
					<!--											<option <?php //if ($sMaritalStatus == 'Single'){ echo 'selecte';} ?> value="Single">Single</option>-->
						<!--										<option <?php //if ($sMaritalStatus == 'Married'){ echo 'selected';} ?> value="Married">Married</option>-->
							<!--								</select> 
															 </li>-->
						 <?php //}else{ ?>
						<!-- <li><span id="">Marital Status:</span><input <?php // echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f14"    value="<?php // echo $sMaritalStatus;?>" type="text" /> </li> -->
						<?php // } ?>
						 
						 
						 <?php if($iUserProfileId==7 OR $iUserProfileId==9){#couch c/ contract ?>
						
						<?php if($editingProfile){ ?>
				  <li>
				  	<span><?php print $_IDIOMA->traducir("Current Club"); ?>:&nbsp;</span>
				  	<div id="club_finder">
				  		<input type="text" name="club" class="editmode f3" value="<?php echo $sClub;?>">
				  	</div>
				  </li>
                  <?php }else{ ?>
				  <li><span><?php print $_IDIOMA->traducir("Current Club"); ?>:&nbsp;</span>
				  <?php echo $sClub;?>
				  </li>
				  <?php } ?>
				  <?php }else{#couch c contract
				  
				  if($editingProfile){ ?>
				  <li>
				  	<span><?php print $_IDIOMA->traducir("Last Club"); ?>:&nbsp;</span>
				  	<div id="club_finder">
				  		<input type="text" name="lastClub" class="editmode f3" value="<?php echo $sClub;?>">
				  	</div>
				  </li>
                  <?php }else{ ?>
				  <li><span><?php print $_IDIOMA->traducir("Last Club"); ?>:&nbsp;</span>
				  <?php echo $sClub;?></li>
				  <?php } 
				  
				  }?>
               	</ul>
               	<?php if($editingProfile){?>
            	<input type="submit" id="divGif"  class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all" role="button" value="<?php print ($_IDIOMA->traducir("Save"));?>"/>
            <?php }?>
                </td>
                <!--<td id="rgtTD" width="89">
                <div id="advance">
      					<div id="progressbar"><span id="pbyellow"></span></div>
      					<p><?php //echo $iPorcentajeMostrar;?>% (?)</p>
  							</div>
                </td>-->
              </tr>
            </table>
			<div id="ResForInformation"></div>
            </form>
            <!----->

