<!-- Group Federation(Selection) -->
<?php 
#Datos Profesionales
$iCantCamposNulos=0;
#name
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
#fifaCode
if(!empty($aProfile[0]->fifaCode))
    $sFifaCode=$aProfile[0]->fifaCode;	
else  
	$sFifaCode=' - ';
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
#worldCup
if(!empty($aProfile[0]->worldCup))
    $sWorldCup=$aProfile[0]->worldCup;	
else{  
	$sWorldCup=' - ';
	$iCantCamposNulos++;
}	
#olimpicGames
if(!empty($aProfile[0]->olimpicGames))
    $sOlimpicGames=$aProfile[0]->olimpicGames;	
else{  
	$sOlimpicGames=' - ';
	$iCantCamposNulos++;
}	

/* segunda columna */	
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

#topScorerName
if(!empty($aProfile[0]->topScorerName))
    $sTopScorerName=$aProfile[0]->topScorerName;	
else{  
	$sTopScorerName=' - ';
	$iCantCamposNulos++;
}	
#topScore
if(!empty($aProfile[0]->topScorer))
    $sTopScorer=$aProfile[0]->topScorer;	
else{  
	$sTopScorer=' - ';
	$iCantCamposNulos++;
}	
#mostParticipationName
if(!empty($aProfile[0]->mostParticipationName))
    $sMostParticipationName=$aProfile[0]->mostParticipationName;	
else{  
	$sMostParticipationName=' - ';
	$iCantCamposNulos++;
}		
#$sMostParticipation
if(!empty($aProfile[0]->mostParticipation))
    $sMostParticipation=$aProfile[0]->mostParticipation;	
else{  
	$sMostParticipation=' - ';
	$iCantCamposNulos++;
}	
#firstInternationalMatch		
if(!empty($aProfile[0]->firstInternationalMatch))
    $sFirstInternationalMatch=$aProfile[0]->firstInternationalMatch;	
else{  
	$sFirstInternationalMatch=' - ';
	$iCantCamposNulos++;
}	

/*	
#euroCup	
if(!empty($aProfile[0]->euroCup))
    $sEuroCup=$aProfile[0]->euroCup;	
else{  
	$sEuroCup=' - ';
	$iCantCamposNulos++;
}	
*/


#porcentaje
$iCantTotal=17;
$iPorcentajeMostrar=100-porcentajeDatos($iCantCamposNulos,$iCantTotal);
$iPorcFinal=100-$iPorcentajeMostrar;
?>
<!-- Group Selection -->
<span id="hideinf"><span>HIDE INFO<a class="menosinf" href="#"></a></span></span>
            <table id="profFields" width="589" height="130" border="0">
            	<tr>
              	<td id="lftTD" width="250" valign="top">
              	<ul>
              	  <li><span>Name:</span><input class="editmode f47" value="<?php echo $sName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Sport Nick Name:</span><input class="editmode f1" value="<?php echo $sNick;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Foundation date:</span><input class="editmode f31" value="<?php echo $sFoundationDate;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>FIFA code:</span><input class="editmode f39" value=<?php echo $sFifaCode;?> type="text" /><span  class="icon"></span></li>
                  <li><span>Address:</span><input class="editmode f37" value="<?php echo $sAddress;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Country:</span><input class="editmode f34" value="<?php echo $sCountryName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>World Cup:</span><input class="editmode f44" value="<?php echo $sWorldCup;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Olimpic Games:</span><input class="editmode f46" value="<?php echo $sOlimpicGames;?>" type="text" /><span  class="icon"></span></li>                  
                  
                </ul>
                </td>
                <td id="ctrTD" width="250" valign="top">
               	<ul>
               	  <li><span>Website:</span><input class="editmode f32" value="<?php echo $sWebsite;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>President:</span><input class="editmode f35" value="<?php echo $sPresidentName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Manager:</span><input class="editmode f38" value="<?php echo $sManagerName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>DT:</span><input class="editmode f33"      value="<?php echo $sDtName;?>" type="text" /><span class="icon"></span></li>
                  <li><span>Top scorer Name:</span><input class="editmode f48" value="<?php echo $sTopScorerName;?>" type="text" /><span  class="icon"></span></li>                                 
                  <li><span>Top scorer:</span><input class="editmode f49" value="<?php echo $sTopScorer;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Most Participation Name:</span><input class="editmode f50" value="<?php echo $sMostParticipationName;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>Most Participation:</span><input class="editmode f51" value="<?php echo $sMostParticipation;?>" type="text" /><span  class="icon"></span></li>
                  <li><span>First International Match:</span><input class="editmode f52" value="<?php echo $sFirstInternationalMatch;?>" type="text" /><span  class="icon"></span></li>


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