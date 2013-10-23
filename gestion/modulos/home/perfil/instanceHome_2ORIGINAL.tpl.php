<!-- Group Coach -->
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
                  <li><span>Sport Nick Name:</span><input class="editmode f1" value="<?php echo $sNick;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Date of birth:</span><input class="editmode f2" value="<?php echo $edad=explodeEdad($aUsuario['dayOfBirthDay']).' ('.$aUsuario['edad'].')';?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Current Club:</span><input class="editmode f3" value="<?php echo $sClub; ?>" type="text" /><span  class="icon"></span></li>
                  <?php 	
                  if($iUserProfileId==7 ||$iUserProfileId==9 ||$iUserProfileId==11){#Coach c/ contract
                  ?>
                  	<li><span>Begin Contract Date:</span><input class="editmode f23" value="<?php echo $sBeginContractDate;?>" type="text" /><span  class="icon"></span></li>
                  	<li><span>Ending contract date:</span><input class="editmode f4" value="<?php echo $sEndingContractDate;?>" type="text" /><span  class="icon"></span></li>
                  <?php 
                  }else{ if($iUserProfileId==8 ||$iUserProfileId==10 ||$iUserProfileId==12){#Coach s/ contract
                  ?>	               
                  	<li><span>Last contract date:</span><input class="editmode f24" value="<?php echo $sLastContractDate;?>" type="text" /><span  class="icon"></span></li>
                  <?php  }
                  }?>	
                </ul>
                </td>
                <td id="ctrTD"  width="250" valign="top">
               	<ul>
                  <li><span id="">Place of birth:</span><input class="editmode f11" value="<?php echo $aUsuario['cityName'].', '.$aUsuario['countryName'];?>" type="text" /><span id="" class="icon"></span></li>
                  <li><span>Country:</span><input class="editmode f5" value="<?=$aUsuario['countryName'];?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Passport:</span><input class="editmode f6" value="<?php echo $sPassaport;?>" type="text" /><span  class="icon"></span></li>
                  <li><span id="">Height:</span><input class="editmode f12" value="<?php echo $sHeight;?>" type="text" /><span id="" class="icon"></span></li>
                  <li><span id="">Weight:</span><input class="editmode f13" value="<?php echo $sWeigth;?>" type="text" /><span id="" class="icon"></span></li>
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
