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

<!-- Group Club -->
<?php }

#Datos Profesionales
$iCantCamposNulos=0;
#name
if($aProfile[0]){
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

	if(!empty($aProfile[0]->otherFederation)){
		$sFederationName=$aProfile[0]->otherFederation;
	}else{
		$sFederationName	=' - ';
		$iCantCamposNulos++;
	}
	
}else{
	$sName=' - ';
	$iCantCamposNulos++;
	$sNick=' - ';
	$iCantCamposNulos++;
	$sFoundationDate=' - ';	
	$iCantCamposNulos++;
	$sGround=' - ';
	$iCantCamposNulos++;
	$sAddress=' - '; 
	$sCountryName=' - ';
	$iCantCamposNulos++; 
	$sWebsite=' - ';
	$iCantCamposNulos++;
	$sPresidentName=' - ';
	$iCantCamposNulos++;
	$sDtName=' - ';
	$iCantCamposNulos++;
	$sManagerName=' - ';
	$iCantCamposNulos++;
	$sFederationName	=' - ';
	$iCantCamposNulos++;
}
	
#porcentaje
$iCantTotal=11;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;	
?>
<!-- Group Club -->
<form target="iframeEdit" method="post" action="gestion/modulos/home/perfil/editagProfile.php">

<span id="hideinf"><?php if($editingProfile){?> 
<a onclick="JS_QuitEdit(); return false;" href="#" style="float: right;font-size: 10px;font-weight: bold;"><?php print $_IDIOMA->traducir("Close"); ?></a>
<?php }else{?>
<span><?php print $_IDIOMA->traducir("HIDE INFO"); ?><a class="menosinf" href="#"></a></span>
<?php }?></span>
            <table id="profFields" width="589" border="0">
            	<tr>
              	<td id="lftTD" width="285" valign="top">
              	<ul>
              	<input type="hidden" value="cl" name="agmjc">

              	  <li><span><?php print $_IDIOMA->traducir("Club Name"); ?>:&nbsp;</span>
              	  <?php if($editingProfile){?>
              	  <input class="editmode f1" name="club" value="<?php echo $sName;?>" type="text" />
              	  <?php }else{
              	  echo $sName;
              	  }?></li>
                  <li><span><?php print $_IDIOMA->traducir("Sport Nick Name"); ?>:&nbsp;</span>
                  <?php if($editingProfile){?>
                  <input class="editmode f53" name="nickName" value="<?php echo $sNick;?>" type="text" />
                  <?php }else{
                  echo $sNick;
                  }?>
                  </li>
                  
				  
				  
				  
				  
				  <!-- BEGIN Foundation Date -->


<?php if($editingProfile){ ?>
				  <li><span><?php print $_IDIOMA->traducir("Foundation date"); ?>:&nbsp;</span>
				  

<?php $fDate=explode('/',$sFoundationDate);
//var_dump($sFoundationDate);
$dayBD=(int)$fDate[0];
//echo $fDate[1]."<br />";//month
$monthBD=(int)$fDate[1];
//echo $fDate[2]."<br />";//day
$yearBD=(int)$fDate[2];

?>
				  <div style="clear:both;width: 100%"></div>
<select id="dayAndresGrosso" name="dayFoundation">

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
		  
		  <select id="monthAndresGrosso" name="monthFoundation">
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
		  
		  <select id="yearAndresGrosso" name="yearFoundation">
	  <?php  for ($year = 2011; $year >= 1600; $year--) { 
	if($year==$yearBD){
		echo "<option selected value='$year'>$year</option>";
	}else{
		echo "<option  value='$year'>$year</option>";
	}
	  } ?>
		  </select>
				  

</li>
<?php }else{ ?>
				<li><span><?php print $_IDIOMA->traducir("Foundation date"); ?>:&nbsp;</span>
				<?php echo $sFoundationDate; ?>
				</li>
				<?php } ?>

<!-- END Foundation Date -->

				  <!-- <li><span>Foundation date:</span><input id="dataPicker" onChange="javascript:dateOfBirth();" class="editmode f31" value="<?php // echo $sFoundationDate;?>" type="text" /><?php // echo ($editingProfile)? '<img src="img/check_edit_reposo.png" title="Save" onClick="javascript:save(\'f31\');">' : '' ;?></li>            -->
				  
				  
				  
				  
				  
				  
				  <li><span><?php print $_IDIOMA->traducir("Ground"); ?>:&nbsp;</span>
				  <?php if($editingProfile){?>
				  <input class="editmode f54" name="ground" value="<?php echo $sGround;?>" type="text" />
				  <?php }else{
				  echo $sGround;
				  }?></li>
				  <li><span><?php print $_IDIOMA->traducir("Address"); ?>:&nbsp;</span>
				  <?php if($editingProfile){?>
				  <input class="editmode f37" name="address" value="<?php echo $sAddress;?>" type="text" />
				  <?php }else{
				  echo $sAddress;
				  }?></li>
				  
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
				echo ':&nbsp;</span><select name="countryag" class="editmode f55">';
				
				for($cC1=0;$cC--;$cC1++){
					($countryList[$cC1]==$aUsuario['countryName'])? $selected='selected' :  $selected='';
					echo '<option '.$selected.' value="'.$countryCode[$cC1].'|'.$countryList[$cC1].'">'.$countryList[$cC1].'</option>';
				}
				echo '</select> </li>';
				}else{  
				 ?>

				<li><span id=""><?php print $_IDIOMA->traducir("Country"); ?>:&nbsp;</span>
				<?php echo $sCountryName;?>
				</li>
                <?php } ?>
				  
				  <!-- <li><span>Country:</span><select name="countryag" class="editmode f36" onChange="javascript:changeThis();">'; -->
				</ul>
                </td>
                
                <td id="ctrTD" width="280" valign="top" style="padding-right: 10px;">
               	<ul>
               	  <li><span><?php print $_IDIOMA->traducir("Website"); ?>:&nbsp;</span>
               	  <?php if($editingProfile){?>
               	  <input class="editmode f32" name="website" value="<?php echo $sWebsite;?>" type="text" />
               	  <?php }else{
               	  echo $sWebsite;
               	  }?></li>
               	  <li><span><?php print $_IDIOMA->traducir("President"); ?>:&nbsp;</span>
               	  <?php if($editingProfile){?>
               	  <input class="editmode f35" name="president" value="<?php echo $sPresidentName;?>" type="text" />
               	  <?php }else{
               	  echo $sPresidentName;
               	  }?></li>
                  <li><span><?php print $_IDIOMA->traducir("DT"); ?>:&nbsp;</span>
                  <?php if($editingProfile){?>
                  <input class="editmode f33" name="dt" value="<?php echo $sDtName;?>" type="text" />
                  <?php }else{
                  echo $sDtName;
                  }?></li>                   
                  <li><span><?php print $_IDIOMA->traducir("Manager"); ?>:&nbsp;</span>
                  <?php if($editingProfile){?>
                  <input class="editmode f38" name="manager" value="<?php echo $sManagerName;?>" type="text" />
                  <?php }else{
                  echo $sManagerName;
                  }?></li>
                  
				  <?php if($editingProfile){ ?>
				  <li><span><?php print $_IDIOMA->traducir("Federation"); ?>:&nbsp;</span>
				  <input type="test" class="editmode f41" name="federation" value="<?php echo $sFederationName;?>"/>
				  </li>
                  <?php }else{ ?>
				  <li><span><?php print $_IDIOMA->traducir("Federation"); ?>:&nbsp;</span>
				  <?php echo $sFederationName;?>
				  </li>
				  <?php } ?>
				  
				  <!-- <li><span>Federation:</span><input class="editmode f41" value="<?php echo $sFederationName;?>" type="text" /></li> -->
    
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
</script>       -->  
