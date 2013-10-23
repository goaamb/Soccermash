<!-- Group Lawyer -->
<?php 
#Datos Profesionales
$iCantCamposNulos=0;
#asociationName
if(!empty($aProfile[0]->asociationName))
    $sAsociationName=$aProfile[0]->asociationName;	
else{ 
	$sAsociationName=' - ';
	$iCantCamposNulos++;
}
#enterpriseName
if(!empty($aProfile[0]->enterpriseName))
    $sEnterpriseName=$aProfile[0]->enterpriseName;	
else{  
	$sEnterpriseName=' - ';
	$iCantCamposNulos++;
}
#countryName
if(!empty($aProfile[0]->countryName))
    $sCountryName=$aProfile[0]->countryName;	
else { 
	$sCountryName=' - ';
	$iCantCamposNulos++;
}

#porcentaje
$iCantTotal=3;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;
?>	


<!-- Group Lawyer -->
<span id="hideinf"><span>HIDE INFO<a class="menosinf" href="#"></a></span></span>
            <table id="profFields" width="589" height="165" border="0">
            	<tr>
              	<td class="mngtbl2" id="lftTD" width="250" valign="top">
              	<ul>
                  <li><span>Date of birth:</span><input class="editmode f2" value="<?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']).' ('.$aUsuario['edad'].')';?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Place of birth:</span><input class="editmode f11" value="<?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?>" type="text" /><span class="icon"></span></li>
                  <li><span>Country:</span><input class="editmode f5" value="<?=$aUsuario['countryName'];?>" type="text" /><span  class="icon"></span></li>
                </ul>
                </td>
                <td class="mngtbl2" id="ctrTD" width="250" valign="top">
               	<ul>
                  <li><span>Association:</span><input class="editmode f28" value="<?php echo $sAsociationName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Enterprise:</span><input class="editmode f29" value="<?php echo $sEnterpriseName;?>" type="text" /><span class="icon"></span></li>
                  <li><span>Country developing activity:</span><input class="editmode f30" value="<?php echo $sCountryName;?>" type="text" /><span  class="icon"></span></li>
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