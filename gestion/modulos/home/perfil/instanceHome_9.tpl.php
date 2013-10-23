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
	$sql="SELECT Code,country FROM ax_country ORDER BY country ASC";
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

<!-- Group Journalist -->
<?php }

#Datos Profesionales
$iCantCamposNulos=0;
#companyName
if($aProfile[0]){
if(!empty($aProfile[0]->otherCompany))
	$sCompanyName=$aProfile[0]->otherCompany;
else{
	$sCompanyName=' - ';
	$iCantCamposNulos++;
}
#licenceNumber
if(!empty($aProfile[0]->licenceNumber))
    $sLicenceNumber=$aProfile[0]->licenceNumber;	
else{  
	$sLicenceNumber=' - ';
	$iCantCamposNulos++;
}		
#federationName
if(!empty($aProfile[0]->federationName))
    $sFederationName=$aProfile[0]->federationName;	
else { 
	$sFederationName=' - ';
	$iCantCamposNulos++;
}	
#passaport
if(!empty($aProfile[0]->passaport))
    $sPassaport=$aProfile[0]->passaport;	
else{  
	$sPassaport=' - ';		
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
	$sCompanyName=' - ';
	$iCantCamposNulos++;
	$sLicenceNumber=' - ';
	$iCantCamposNulos++;
	$sFederationName=' - ';
	$iCantCamposNulos++;
	$sPassaport=' - ';		
	$iCantCamposNulos++;
	$sMaritalStatus=' - ';	
	$iCantCamposNulos++;
	
}
#porcentaje
$iCantTotal=5;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;
?>	

<!-- Group Journalist -->
<form target="iframeEdit" method="post" action="gestion/modulos/home/perfil/editagProfile.php">
<span id="hideinf"><?php if($editingProfile){?> 
<a onclick="JS_QuitEdit(); return false;" href="#" style="float: right;font-size: 10px;font-weight: bold;"><?php print $_IDIOMA->traducir("Close"); ?></a>
<?php }else{?>
<span><?php print $_IDIOMA->traducir("HIDE INFO"); ?><a class="menosinf" href="#"></a></span>
<?php }?></span>
            <table id="profFields" width="589" border="0">
            	<tr>
              	<td id="lftTD" width="579" valign="top" style="padding-right: 10px;">
              	<ul>
                  
<input type="hidden" value="jo" name="agmjc">

                  
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
				echo ':&nbsp;</span><select name="countryag" class="editmode f5" onChange="selectCity();" style="float: right; width: 425px;">';
				
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
				
				if($editingProfile){ ?>
				 <li><span id=""><?php print $_IDIOMA->traducir("City"); ?>:&nbsp;</span>
				 <select name="cityag"  class="editmode f11" id="cityag" onChange="selectedCity();" style="float: right; width: 425px;"></select> </li>
				 
					<script type="text/javascript">
					selectCity();
					</script>
					
				  <?php }else{ ?>
					<li><span id=""><?php print $_IDIOMA->traducir("City"); ?>:&nbsp;</span>
					<?php echo $aUsuario['cityName'];?>
					</li>
                  <?php }
				//var_dump($countryList);
				//var_dump($countryCode);
				?>
                   
				
				<?php if($editingProfile){ ?>
				  <li><span><?php print $_IDIOMA->traducir("Company"); ?>:&nbsp;</span>
				  <input type="text" name="company" class="editmode f27" value="<?php echo $sCompanyName;?>"  style="float: right; width: 420px;"/>
				  </li>
				  <?php }else{ ?>
                  <li><span><?php print $_IDIOMA->traducir("Company"); ?>:&nbsp;</span>
                  <?php echo $sCompanyName;?>
                  </li>
				  <?php } ?>
                 <!--  <li><span>Licence number:</span><input class="editmode f19" <?php //echo ($editingProfile)? '' : 'disabled="disabled"' ;?> value="<?php //echo $sLicenceNumber;?>" type="text" /><span  class="icon"></span></li> -->
                   <?php //if($editingProfile){ ?>
				  <!-- <li><span>Pofessional Asociation:</span><div id="association_finder"><a onClick="javascript:asociationFinder('<?php //echo $sFederationName;?>','association_finder');" class="editmode f41" href="javascript:void(0);"><?php //echo $sFederationName;?></a></div><span  class="icon"></span></li>-->
                  <?php //}else{ ?>
				  <!-- <li><span>Pofessional Asociation:</span><input  disabled="disabled" class="editmode f41"         value="<?php //echo $sFederationName;?>" type="text" /><span  class="icon"></span></li>-->
				  <?php //} ?>
                 <!--  <li><span>Passport:</span><input class="editmode f6"     <?php //echo ($editingProfile)? '' : 'disabled="disabled"' ;?>   value="<?php //echo $sPassaport;?>" type="text" /><?php //echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save" onClick="javascript:save(\'f6\');">' : '' ;?><span  class="icon"></span></li> -->
                 <?php // if($editingProfile){ ?>
				  <!-- <li><span id="">Marital Status:</span><select name="maritalStatusag" id="maritalStatusag" onClick="javascript:changeMaritalStatus();" class="editmode f14"> -->
					<!--											<option <?php //if ($sMaritalStatus == 'Single'){ echo 'selecte';} ?> value="Single">Single</option>-->
						<!--										<option <?php //if ($sMaritalStatus == 'Married'){ echo 'selected';} ?> value="Married">Married</option>-->
							<!--								</select> 
															 </li>-->
						 <?php //}else{ ?>
						<!-- <li><span id="">Marital Status:</span><input <?php // echo ($editingProfile)? '' : 'disabled="disabled"' ;?> class="editmode f14"    value="<?php // echo $sMaritalStatus;?>" type="text" /> </li> -->
						<?php // } ?>
						
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

		  <select id="yearAndresGrosso" name="yearBirth" style="float: right; width: 70px; margin-right: 213px;">
	  <?php  for ($year = 2011; $year >= 1905; $year--) { 
	if($year==$yearBD){
		echo "<option selected value='$year'>$year</option>";
	}else{
		echo "<option  value='$year'>$year</option>";
	}
	  } ?>
		  </select>
		  <select id="monthAndresGrosso" name="monthBirth" style="float: right; width: 95px;">
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
		  
		  
		  <select id="dayAndresGrosso" name="dayBirth" style="float: right; width: 45px;">

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
				  

</li>
<?php }else{ ?>
				<li><span><?php print $_IDIOMA->traducir("Date of birth"); ?>:&nbsp;</span>
				<?php if(!empty($aUsuario['dayOfBirthDay'])) echo explodeEdad($aUsuario['dayOfBirthDay']); else echo ' - ';?>
				</li>
				<?php } ?>
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
            <!---
<script type="text/javascript">
	document.getElementById('pbyellow').style.backgroundPosition = '0px <?php //echo $iPorcFinal;?>px';
</script> -->
