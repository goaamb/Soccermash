<!-- Group Fans -->
<?php 
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
#ocupation
if(!empty($aProfile[0]->ocupation)) 
	$sOcupation=$aProfile[0]->ocupation;
else{
	$sOcupation=' - ';	
	$iCantCamposNulos++;
}
#maritalStatus
if(!empty($aProfile[0]->maritalStatus))
    $sMaritalStatus=$aProfile[0]->maritalStatus;	
else{  
	$sMaritalStatus=' - ';		
	$iCantCamposNulos++;
}

#porcentaje
$iCantTotal=4;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;
?>	

<!-- Group Fans -->
<span id="hideinf"><span>HIDE INFO<a class="menosinf" href="#"></a></span></span>
            <table id="profFields" height="130" width="589" border="0">
            	<tr>
              	<td  id="lftTD" width="250" valign="top">
              	<ul>
                  <li><span>Sport Nick Name:</span><input class="editmode f1" value="<?php echo $sNick;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Club:</span><input class="editmode f25"           value="<?php echo $sClub;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Country:</span><input class="editmode f5"     value="<?=$aUsuario['countryName'];?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Ocupation:</span><input class="editmode f26"      value="<?php echo $sOcupation;?>" type="text" /><span  class="icon"></span></li>
                </ul>
                </td>
                <td  id="ctrTD" width="250" valign="top">
               	<ul>
                  <li><span id="">Place of birth:</span><input class="editmode f11" value="<?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?>" type="text" /><span id="" class="icon"></span></li>
                  <li><span>Date of birth:</span><input class="editmode f2"         value="<?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']).' ('.$aUsuario['edad'].')';?>" type="text" /><span  class="icon"></span></li>
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