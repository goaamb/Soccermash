<!-- Group Medic -->
<?php 
#Datos Profesionales
$iCantCamposNulos=0;
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

#porcentaje
$iCantTotal=5;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;
		
?>
<!-- Group Medic -->
<span id="hideinf"><span>HIDE INFO<a class="menosinf" href="#"></a></span></span>
            <table id="profFields" height="120" width="589" border="0">
            	<tr>
              	<td id="lftTD" width="250" valign="top">
              	<ul>
                  <li><span>Current Club:</span><input class="editmode f3" value="<?php echo $sClub?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Country:</span><input class="editmode f5"  value="<?=$aUsuario['countryName'];?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Passport:</span><input class="editmode f6"     value="<?php echo $sPassaport;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Federation:</span><input class="editmode f20"  value="<?php echo $sFederationName;?>" type="text" /><span class="icon"></span></li>
                </ul>
                </td>
                <td id="ctrTD" width="250" valign="top">
               	<ul>
                	<li><span>Licence number:</span><input class="editmode f19"     value="<?php echo $sLicenceNumber;?>" type="text" /><span class="icon"></span></li>
                  <li><span>Date of birth:</span><input class="editmode f2"         value="<?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']).' ('.$aUsuario['edad'].')';?>" type="text" /><span  class="icon"></span></li>
                  <li><span id="">Place of birth:</span><input class="editmode f11" value="<?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?>" type="text" /><span id="" class="icon"></span></li>
                  <li><span id="">Marital Status:</span><input class="editmode f14" value="<?php echo $sMaritalStatus;?>" type="text" /><span id="" class="icon"></span></li>
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