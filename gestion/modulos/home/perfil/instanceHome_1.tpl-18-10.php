<iframe style="width:0;height:0;border:none;display:none;" src="" name="iframeEdit" id="iframeEdit"></iframe>
<?php			

if(!isset($_SESSION["editProfile"]) or $_SESSION["editProfile"]==0 or $_SESSION["editProfile"]==false){
	
	$editingProfile=false;   
}else{

	$editingProfile=$_SESSION["editProfile"];   
	require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
	
	
	
	
	$oDB=new mysql;
	$oDB->connect();
	//$sql=GenerateSelect("Code,country","ax_country");
	$sql="select Code,country FROM ax_country ORDER BY country ASC";
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
	});
}

$(document).ready(function(){

	$("#divGif").click(function(){
		//alert("clic");
		$("#ResForInformation").html('<img src="img/indicator.gif" style="width:15px;height:15px">');
	});
});

</script>
<?php	
}
#Datos Profesionales
$iCantCamposNulos=0;
#nick
if($aProfile[0]){
if(!empty($aProfile[0]->nick)){
	$sNick=$aProfile[0]->nick;
}else{
	$sNick=' - ';
	$iCantCamposNulos++;
}
#club
if(!empty($aProfile[0]->otherClub)) 
	$sClub=$aProfile[0]->otherClub;
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




$europass=$aProfile[0]->europass;


#agentName
if(!empty($aProfile[0]->otherAgent))
    $sAgentName=$aProfile[0]->otherAgent;	
else{  
	$sAgentName=' - ';		
	$iCantCamposNulos++;
}

#nationalSelected
if(!empty($aProfile[0]->nationalSelection))
    $sNationalSelected=$aProfile[0]->nationalSelection;	
else{ 
	$sNationalSelected=' - ';	
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

#skillfullLegHand
if(!empty($aProfile[0]->skillfullLegHand))
    $sSkillfullLegHand=$aProfile[0]->skillfullLegHand;	
else { 
	$sSkillfullLegHand=' - ';	
	$iCantCamposNulos++;
}

#namePosition
$sPos=Array();
$sPos = explode(",",$aProfile[0]->position);
$aUsuario['namePosition']=namePosition($sPos[0]);

if(!empty($aUsuario['namePosition']))
{
	if(sizeof($sPos)>2)
		for($i=1;$i<sizeof($sPos);$i++){
			$aUsuario['namePosition'].='/ '.namePosition($sPos[$i]);	
		}
}else{
	$aUsuario['namePosition']=' - ';	
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
	$sAgentName=' - ';		
	$iCantCamposNulos++;
	$sNationalSelected=' - ';	
	$iCantCamposNulos++; 
	$sHeight=' - ';		
	$iCantCamposNulos++; 
	$sWeigth=' - ';
	$iCantCamposNulos++; 
	$sMaritalStatus=' - ';	
	$iCantCamposNulos++; 
	$sSkillfullLegHand=' - ';	
	$iCantCamposNulos++;
	$aUsuario['namePosition']=' - ';	
	$iCantCamposNulos++;
}
if($iUserProfileId==2){#player c/ contract
	$iCantCamposNulos=$iCantCamposNulos-1;#saco los campos(date) de player S/ contract
	$iCantTotal=12;
}
if($iUserProfileId==3){#player S/ contract
	$iCantCamposNulos=$iCantCamposNulos-2;#saco los campos(date) de player c/ contract
	$iCantTotal=11;
}
if($iUserProfileId==5){#player Amateur
	$iCantCamposNulos=$iCantCamposNulos-3;#saco los campos(date) de player profesional
	$iCantTotal=10;
}
if($iUserProfileId==6){#Ex-player 
	$iCantCamposNulos=$iCantCamposNulos-2;#saco los campos(date) de player profesional
	$iCantTotal=10;
}
#Porcentaje
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;


?>
<!-- Group Player-->

<form target="iframeEdit" method="post" action="gestion/modulos/home/perfil/editagProfile.php">
<span id="hideinf">
<?php if($editingProfile){?> 
<a onclick="JS_QuitEdit(); return false;" href="#" style="float: right;font-size: 10px;font-weight: bold;"><?php print $_IDIOMA->traducir("Close"); ?></a>
<?php }else{?>
<span><?php print $_IDIOMA->traducir("HIDE INFO"); ?><a class="menosinf" href="#"></a></span>
<?php }?>
</span>

            <table id="profFields" width="589" border="0">
            	<tr>
              	<td id="lftTD" width="285" valign="top">
              	<ul>
				  <li>
				  <?php
				  switch($iUserProfileId){
					case 2:
						echo '<input type="hidden" value="ppuc" name="agmjc">';
						break;
					
					case 3:
						echo '<input type="hidden" value="ppwc" name="agmjc">';
						break;
					
					case 5:
						echo '<input type="hidden" value="ap" name="agmjc">';
						break;
						
					case 6:
						echo '<input type="hidden" value="ep" name="agmjc">';
						break;
				  }
				  ?>
				  	<span><?php print $_IDIOMA->traducir("Sport Nick Name"); ?>:&nbsp;</span>
				  	<?php if ($editingProfile) {
				  		?>
				  		<input class="editmode f1" name="nick" value="<?php echo $sNick;?>" type="text" />
				  		<?php 
				  	}else{ 
				  		echo $sNick;
				  	}?>
				  	 </li>
				  <?php if($editingProfile){ ?>
				  <li><span><?php print $_IDIOMA->traducir("Date of birth"); ?>:&nbsp;</span>
				  

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
			<div style="clear:both;width: 100%"></div>	  
<select id="dayAndresGrosso" name="dayBirth" onChange="javascript:day();">

		  <?php
		  
		  for ($day = 01; $day <= 31; $day++) {
		  
		  
			if($day==$dayBD){		  		  
			echo "<option selected value='$day'>$day</option>";
				}else{
			echo "<option value='$day'>$day</option>";
			}
		  }
		 
		  ?>
		  </select>
		  
		  <select id="monthAndresGrosso" name="montBirth" onChange="javascript:month();">
		  <option <?php echo ($monthBD==01)? 'selected' : '' ; ?> value="01"><?php print $_IDIOMA->traducir("Jan"); ?></option>
		  <option <?php echo ($monthBD==02)? 'selected' : '' ; ?> value="02"><?php print $_IDIOMA->traducir("Feb"); ?></option>
		  <option <?php echo ($monthBD==03)? 'selected' : '' ; ?> value="03"><?php print $_IDIOMA->traducir("Mar"); ?></option>
		  <option <?php echo ($monthBD==04)? 'selected' : '' ; ?> value="04"><?php print $_IDIOMA->traducir("Apr"); ?></option>
		  <option <?php echo ($monthBD==05)? 'selected' : '' ; ?> value="05"><?php print $_IDIOMA->traducir("May"); ?></option>
		  <option <?php echo ($monthBD==06)? 'selected' : '' ; ?> value="06"><?php print $_IDIOMA->traducir("Jun"); ?></option>
		  <option <?php echo ($monthBD==07)? 'selected' : '' ; ?> value="07"><?php print $_IDIOMA->traducir("Jul"); ?></option>
		  <option <?php echo ($monthBD==08)? 'selected' : '' ; ?> value="08"><?php print $_IDIOMA->traducir("Aug"); ?></option>
		  <option <?php echo ($monthBD==09)? 'selected' : '' ; ?> value="09"><?php print $_IDIOMA->traducir("Sep"); ?></option>
		  <option <?php echo ($monthBD==10)? 'selected' : '' ; ?> value="10"><?php print $_IDIOMA->traducir("Oct"); ?></option>
		  <option <?php echo ($monthBD==11)? 'selected' : '' ; ?> value="11"><?php print $_IDIOMA->traducir("Nov"); ?></option>
		  <option <?php echo ($monthBD==12)? 'selected' : '' ; ?> value="12"><?php print $_IDIOMA->traducir("Dec"); ?></option>
		  </select>
		  
		  <select id="yearAndresGrosso" name="yearBirth" onChange="javascript:year();">
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
				  
				  
				  
				  
				  <?php if($iUserProfileId==2){#player c/ contract
				   if($editingProfile){ ?>
				  		<li>
				  			<span><?php print $_IDIOMA->traducir("Current Club"); ?>:&nbsp;</span>
				  			<input type="text" name="currentClub" class="editmode f3" value="<?php echo $sClub;?>"/>
				  		</li>
                  <?php }else{ ?>
				  		<li>
				  			<span><?php print $_IDIOMA->traducir("Current Club"); ?>:&nbsp;</span>
				  			<?php echo $sClub;?>
				  		</li>
				  <?php } 
				  
				  }else{#player s/ contract
				  
				  if($editingProfile){ ?>
				  		<li>
				  			<span><?php print $_IDIOMA->traducir("Last Club"); ?>:&nbsp;</span>
				  			<input type="text" name="lastClub" class="editmode f3" value="<?php echo $sClub;?>">
				  		</li>
                  <?php }else{ ?>
				  		<li>
				  			<span><?php print $_IDIOMA->traducir("Last Club"); ?>:&nbsp;</span>
				  			<?php echo $sClub;?>
				  		</li>
				  <?php }} ?>
				  
				  
				  
				  <?php 	
                  if($iUserProfileId==2){#player c/ contract
                  ?>	
				 		<!-- BEGIN ENDING CONTRACT DATE -->	
					<?php if($editingProfile){ ?>
				  		<li>
				  			<span><?php print $_IDIOMA->traducir("Ending Contract Date"); ?>:&nbsp;</span>
							<?php 
							$dayECDBD=0;
							$monthECDBD=0;
							$yearECDBD=0;
							if(trim($sBeginContractDate)!=="-"){
							$date3=explode('/',$sEndingContractDate) ;
							var_dump($date3);
							$dayECDBD=(int)$date3[0];
							$monthECDBD=(int)$date3[1];
							$yearECDBD=(int)$date3[2];
							}
							$selectYear='';
							$selectMonth='';
							$selectDay='';
							?>
							<div style="clear:both;width: 100%"></div>	
							<select id="dayAndresGrossoECD" name="dayEnding" onChange="javascript:dayECD();">
							  <?php
								for ($day = 01; $day <= 31; $day++) {
									if($day==$dayECDBD){		  		  
										echo "<option selected value='$day'>$day</option>";
									}else{
										echo "<option value='$day'>$day</option>";
									}
		  						}?>
		  					</select>
							<select id="monthAndresGrossoECD" name="monthEnding" onChange="javascript:monthECD();">
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
							<select id="yearAndresGrossoECD" name="yearEnding" onChange="javascript:yearECD();">
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
						<li>
							<span><?php print $_IDIOMA->traducir("Ending Contract Date"); ?>:&nbsp;</span>
							<?php echo $sEndingContractDate; ?>
						</li>
					<?php } ?>

<!-- END ENDING CONTRACT DATE -->
				 
				 
				 <?php 	
				  }else{
				  	if($iUserProfileId==3 || $iUserProfileId==6){#player S/ contract o ex-player
				  	?>	
				  		
						
						
						
					<!-- BEGIN LAST CONTRACT DATE -->

 <?php /* if($editingProfile){ ?>
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
				<?php } 	*/ ?>

<!-- END LAST CONTRACT DATE -->		
						
						
						
					
				  	
					
					
					
					
					
					<?php 
				  	}
				  }
                  ?>
                 
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
						echo '</select></li>';
				}else{
				?>	<li>
						<span><?php print $_IDIOMA->traducir("Country"); ?>:&nbsp;</span>
						<?php echo $aUsuario['countryName'];?>
					</li><?php
				
				}
				//var_dump($countryList);
				//var_dump($countryCode);
				?>
				<?php if($editingProfile){ ?>
				 	<li>
						<span id=""><?php print $_IDIOMA->traducir("City"); ?>:&nbsp;</span>
						<select name="cityag" class="editmode f11"  id="cityag" onChange="selectedCity();"></select>
				 		<script type="text/javascript">
				 		selectCity();
				 		</script>
				 	</li>
				  <?php }else{ ?>
					<li>
						<span id=""><?php print $_IDIOMA->traducir("City"); ?>:&nbsp;</span>
						<?php echo $aUsuario['cityName'];?>
					</li>
                  <?php } ?>
				  
                  
				   <?php if($editingProfile){ ?>
				  	<li>
				  		<span><?php print $_IDIOMA->traducir("Agent"); ?>:&nbsp;</span>
				  		<input type="text" name="agent" class="editmode f42" value="<?php echo $sAgentName;?>">
				  	</li>
                  <?php }else{ ?>
				  	<li>
				  		<span><?php print $_IDIOMA->traducir("Agent"); ?>:&nbsp;</span>
				  		<?php echo $sAgentName;?>
				  	</li>
				  <?php } ?>
				 				  
                </ul>
                </td>
				<!-- <div id="loadGif"></div> -->
                <td id="ctrTD" width="280" valign="top" style="padding-right: 10px;">
               	<ul>
                  	<li>
                  		<span id=""><?php print $_IDIOMA->traducir("Position"); ?>:&nbsp;</span>
                  		<?php if($editingProfile){?>
                  			<input class="editmode f8" value="<?php echo $aUsuario['namePosition'];?>" type="text" />
                  			<?php }else{
                  				echo $aUsuario['namePosition'];
                  			 }?>
                  		</li>
                   <li>
                   <div style="width:45%;margin-right: 10px;float: left;">
                  			 <?php if($editingProfile){ ?>
				  	
				  		<span id=""><?php print $_IDIOMA->traducir("National Selected"); ?>:&nbsp;</span>
				  		<select name="nationalSelected" name="nationalSelected" id="nationalSelectedag" onClick="javascript:changeNationalSelected();" class="editmode f10">
							<option <?php if ($sNationalSelected == 'No'){ echo 'selected';} ?> value="None"><?php print $_IDIOMA->traducir("No"); ?></option>
							<option <?php if ($sNationalSelected == 'FULL'){ echo 'selected';} ?> value="FULL"><?php print $_IDIOMA->traducir("FULL"); ?></option>
							<option <?php if ($sNationalSelected == 'U-15'){ echo 'selected';} ?> value="U-15"><?php print $_IDIOMA->traducir("U-15"); ?></option>
							<option <?php if ($sNationalSelected == 'U-16'){ echo 'selected';} ?> value="U-16"><?php print $_IDIOMA->traducir("U-16"); ?></option>
							<option <?php if ($sNationalSelected == 'U-17'){ echo 'selected';} ?> value="U-17"><?php print $_IDIOMA->traducir("U-17"); ?></option>
							<option <?php if ($sNationalSelected == 'U-19'){ echo 'selected';} ?> value="U-19"><?php print $_IDIOMA->traducir("U-19"); ?></option>
							<option <?php if ($sNationalSelected == 'U-20'){ echo 'selected';} ?> value="U-20"><?php print $_IDIOMA->traducir("U-20"); ?></option>
							<option <?php if ($sNationalSelected == 'U-21'){ echo 'selected';} ?> value="U-21"><?php print $_IDIOMA->traducir("U-21"); ?></option>
							<option <?php if ($sNationalSelected == 'U-23'){ echo 'selected';} ?> value="U-23"><?php print $_IDIOMA->traducir("U-23"); ?></option>
						</select>
					
				   <?php }else{ ?>
				   	
				   		<span id=""><?php print $_IDIOMA->traducir("National Selected"); ?>:&nbsp;</span><br/>
				   		<?php print $_IDIOMA->traducir($sNationalSelected); ?>
				   	
				   <?php } ?>
				   </div>
				   <div style="width:50%;float: left;">
				   <?php  if($editingProfile){ ?>
				  	
				  		<span id=""><?php print $_IDIOMA->traducir("Marital Status"); ?>:&nbsp;</span>
				  			<select name="maritalStatusag" id="maritalStatusag" onClick="javascript:changeMaritalStatus();" class="editmode f14">
								<option <?php if ($sMaritalStatus == 'Single'){ echo 'selecte';} ?> value="Single"><?php print $_IDIOMA->traducir("Single"); ?></option>
								<option <?php if ($sMaritalStatus == 'Married'){ echo 'selected';} ?> value="Married"><?php print $_IDIOMA->traducir("Married"); ?></option>
							</select> 
					
						 <?php }else{ ?>
					
							<span id=""><?php print $_IDIOMA->traducir("Marital Status"); ?>:&nbsp;</span><br/>
							<?php print $_IDIOMA->traducir($sMaritalStatus); ?>
					 
						<?php  } ?>
						</div>
							</li>
				  			  
				  <li>
				  <div style="float:left;width: 45%;margin-right: 10px;">
				  		<div style="float: left;width: 40%;margin-right: 5px">
				  		<span id=""><?php print $_IDIOMA->traducir("Height"); ?>:&nbsp;</span>
				  		<?php if($editingProfile){?>
				  			<input name="height" class="editmode f12" value="<?php echo $sHeight;?>" type="text" />
				  		<?php }else{
				  			echo '<br/>'.$sHeight;
				  		}?>
				  		</div><div style="float: left;width: 40%;">
				  		<span id=""><?php print $_IDIOMA->traducir("Weigth"); ?>:&nbsp;</span>
				  		<?php if ($editingProfile) {?>
				  			<input name="weigth" class="editmode f13" value="<?php echo $sWeigth;?>" type="text" />
				  		<?php }else{
				  			echo '<br/>'.$sWeigth;
				  		}?></div>
				  		</div>
				  		<div style="float:left;width: 50%;">
				  		<?php if($editingProfile){ ?>
					<span id=""><?php print $_IDIOMA->traducir("Skillful leg/hand"); ?>:&nbsp;</span>
					<select name="skillful" id="skillfulChange" onClick="javascript:changeSkillful();" class="editmofe f9">
																<option <?php if ($sSkillfullLegHand == 'Left'){ echo 'selected';} ?> value="Left"><?php print $_IDIOMA->traducir("Left"); ?></option>
																<option <?php if ($sSkillfullLegHand == 'Right'){ echo 'selected';} ?> value="Right"><?php print $_IDIOMA->traducir("Right"); ?></option>
																<option <?php if ($sSkillfullLegHand == 'Both'){ echo 'selected';} ?> value="Both"><?php print $_IDIOMA->traducir("Both"); ?></option>
															<select>
				  <?php }else{ ?>
					
						<span id=""><?php print $_IDIOMA->traducir("Skillful leg/hand"); ?>:&nbsp;</span><br/>
						<?php print $_IDIOMA->traducir($sSkillfullLegHand); ?>
						
					
				  <?php } ?>
				  		</div>
				  	</li>
                  <li>
				 <?php if($editingProfile){?>
				 
				  		<span><?php print $_IDIOMA->traducir("European Union passport"); ?>:&nbsp;</span>
				  		<div style="clear: both;width: 100%"></div>
				  		<span class="imgceu"></span>
				  		<span style="float: left;margin: 10px 10px 0;"><?php print $_IDIOMA->traducir("No"); ?></span>
				  		<input name="cPassport" <?php echo (isset($europass))?($europass==0)? 'CHECKED' : '' :''; ?> type="radio" value="no" class="spcheck" style="float:left;width: auto;margin-top: 10px;color:black;"/>
				  		<span style="float:left;margin: 10px 10px 0;"><?php print $_IDIOMA->traducir("Yes"); ?></span>
				  		<input name="cPassport" value="yes" <?php echo (isset($europass))?($europass == 1)? 'CHECKED' : '':'' ; ?> class="spcheck" type="radio" style="width:auto;float:left;margin-top: 10px;color:black;"/>
					<?php }else{ ?>
				  		
						<span style="margin-top:6px;"><?php print $_IDIOMA->traducir("EU passport"); ?>:&nbsp;</span>
				  		<?php echo (isset($europass))?($europass==0)? '<span style="margin-top:6px;margin-right:5px;color:black;">'.$_IDIOMA->traducir("No ").'</span>' : '<span style="margin-top:6px;margin-right:5px;color:black;">'.$_IDIOMA->traducir("Yes ")."</span><span class='imgceu'></span>":'-' ; ?>

				  		<?php } ?>
						</li> 
				  	<li>
				 
				 <span><?php print $_IDIOMA->traducir("Another Passport/s"); ?>:&nbsp;</span>
				  		<?php if($editingProfile){?>
				  			<input name="oPassport" class="editmode f6" value="<?php echo $sPassaport;?>" type="text" />
				  		<?php }else{
				  			echo $sPassaport;
				  		}?>
				  	</li> 
				  	
					
						
					
               	</ul>
               	<?php if($editingProfile){?>
            	<input type="submit" id="divGif" class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all" role="button" value="<?php print ($_IDIOMA->traducir("Save"));?>"/>
            <?php }?>
                </td>
                <!--<td id="rgtTD" width="89">
                <div id="advance">
      					<div id="progressbar"><span id="pbyellow"></span></div>
      					<p><?php //echo $iPorcentajeMostrar?>% (?)</p>
  							</div>
                </td>-->
              </tr>
              </table>
	
			  <div id="ResForInformation"></div>
			  </form>    
				
		
            <!----->
        
	
	


