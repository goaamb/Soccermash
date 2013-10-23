

<p class="greyTitles paddingRC"><a href="javascript:void();" onclick='JS_getAllSugested(1);'><? print $_IDIOMA->traducir("Suggested People"); ?></a></p>
 <img class="posBreak" src="img/break.png" width="200" height="3" />
      <ul>
      <?php 
      		$iCantMax=3;$iCantNow=0;
      		if(sizeof($aSugestedPeoples)>0){
				foreach($aSugestedPeoples as $iIdSugestedPeople => $aSugestedPeople){
					if($iCantNow<$iCantMax){#a lo sumo se muestra 9 sugeridos

					    //////Move the img to center thumb//////////
					    $aImPhoto=array();
					    $aImPhoto=@getimagesize('photoGeneral/small/small_'.$aSugestedPeople["photo"]);
					    
					    if($aImPhoto[0]>50){
					     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).';';
					    }else{
					     $moveLeft='';
					    }
					    
					    
					    if($aImPhoto[1]>50){
					     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).';';
					    }else{
					     $moveTop='';
					    }
				    
					?>	<li><div class="imgProfileBorder" style="overflow:hidden;">
						 	   	
						  <a  style=" <?php echo $moveLeft; echo $moveTop; ?>" href="/<?php print $_IDIOMA->traducir("user")."/".$aSugestedPeople["id"]."-".Utilidades::normalizarTexto($aSugestedPeople["name"]." ".$aSugestedPeople["lastName"]);?>" title="<?php echo $aSugestedPeople['name'];?>">
					   		<img src="photoGeneral/small/small_<?php echo $aSugestedPeople["photo"];?>"  />
					    	  </a></div>
						</li>
				<?php    
					} 
					$iCantNow++;
				}
      		}
		?>
        
        <!-- <li><img src="img/SM.jpg"/>  
        <li><img src="img/SM.jpg"/>  </li>
        <li><img src="img/SM.jpg"/>  </li>
        <li><img src="img/SM.jpg"/>  </li>
        <li><img src="img/SM.jpg"/>  </li>
        <li><img src="img/SM.jpg"/>  </li>
        <li><img src="img/SM.jpg"/>  </li>
		<li><img src="img/SM.jpg"/>  </li> -->
      </ul>
