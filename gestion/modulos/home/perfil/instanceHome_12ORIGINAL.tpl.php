<!-- Group Company -->
<?php 
#Datos Profesionales
$iCantCamposNulos=0;
#Name
if(!empty($aProfile[0]->name))
    $sName=$aProfile[0]->name;	
else{  
	$sName=' - ';
	$iCantCamposNulos++;
}
#foundationDate
if(!empty($aProfile[0]->foundationDate))
    $sFoundationDate=explodeEdad($aProfile[0]->foundationDate);	
else { 
	$sFoundationDate=' - ';	
	$iCantCamposNulos++;
}	
#countryName
if(!empty($aProfile[0]->countryName))
    $sCountryName=$aProfile[0]->countryName;	
else{  
	$sCountryName=' - ';
	$iCantCamposNulos++;
}	
#website
if(!empty($aProfile[0]->website))
    $sWebsite=$aProfile[0]->website;	
else{  
	$sWebsite=' - ';
	$iCantCamposNulos++;
}	
#address
if(!empty($aProfile[0]->address))
    $sAddress=$aProfile[0]->address;	
else  
	$sAddress=' - ';	
#porcentaje
$iCantTotal=5;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;	
?>
<!-- Group Company -->
<span id="hideinf"><span>HIDE INFO<a class="menosinf" href="#"></a></span></span>
            <table height="165" id="profFields" width="589" border="0">
            	<tr>
              	<td class="mngtbl2" id="lftTD" width="250" valign="top">
              	<ul>
                  <li><span>Name:</span><input class="editmode f7" value="<?php echo $sName;?>" type="text" /><span class="icon"></span></li>
                  <li><span id="">Foundation Date:</span><input class="editmode f37" value="<?php echo $sFoundationDate;?>" type="text" /><span id="" class="icon"></span></li>
                  <li><span id="">Country:</span><input class="editmode f35" value="<?php echo $sCountryName;?>" type="text" /><span id="" class="icon"></span></li>
                </ul>
                </td>
                
                <td class="mngtbl2" id="ctrTD" width="250" valign="top">
               	<ul>
                  <li><span>Website:</span><input class="editmode f37" value="<?php echo $sWebsite;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Address:</span><input class="editmode f35" value="<?php echo $sAddress;?>" type="text" /><span  class="icon"></span></li>
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