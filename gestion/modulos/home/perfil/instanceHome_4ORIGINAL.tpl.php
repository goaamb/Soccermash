<!-- Group Scouting -->
<?php 
#Datos Profesionales
$iCantCamposNulos=0;
#passaport
if(!empty($aProfile[0]->passaport))
    $sPassaport=$aProfile[0]->passaport;	
else{  
	$sPassaport=' - ';		
	$iCantCamposNulos++;
};	
#maritalStatus
if(!empty($aProfile[0]->maritalStatus))
    $sMaritalStatus=$aProfile[0]->maritalStatus;	
else{  
	$sMaritalStatus=' - ';	
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

#porcentaje
$iCantTotal=3;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;
?>
<!-- Group Scouts -->
<span id="hideinf"><span>HIDE INFO<a class="menosinf" href="#"></a></span></span>
            <table id="profFields" height="120" width="589" border="0">
            	<tr>
              	<td class="mngtbl" id="lftTD" width="250" valign="top">
              	<ul>
                  <li><span>Country:</span><input class="editmode f5" value="<?=$aUsuario['countryName'];?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Passport:</span><input class="editmode f6"    value="<?php echo $sPassaport;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Club:</span><input class="editmode f25"       value="<?php echo $sClub;?>" type="text" /><span  class="icon"></span></li>
                </ul>
                </td>
                <td class="mngtbl" id="ctrTD" width="250" valign="top">
               	<ul>
                  <li><span>Date of birth:</span><input class="editmode f2"   value="<?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']).' ('.$aUsuario['edad'].')';?>" type="text" /><span  class="icon"></span></li> 
                  <li><span>Place of birth:</span><input class="editmode f11" value="<?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?>" type="text" /><span class="icon"></span></li>
                  <li><span>Marital Status:</span><input class="editmode f14" value="<?php echo $sMaritalStatus;?>" type="text" /><span class="icon"></span></li>
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
