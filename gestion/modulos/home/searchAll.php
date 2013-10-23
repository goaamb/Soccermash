<?

 					$aAll=array();	
					//////////////////////////////
					$cant=15;
	
		
					$valor=addslashes($_POST['strgToSearch']);
			
					////get string///		
					$str=explode(' ',addslashes($_POST['strgToSearch']));
					$sStr='';
					//$valArr=count($str);
					
					$i=1;
				
				
				
		
				
				////////player text///////////////
					
					
					
					$totValArr=sizeof($str);
										
					$pro=new Profile();
					
					
					/////////number of adv profile//////////////////
					$storeProfile=addslashes($_POST['storeSelectProfile']);
					$aAllWords=array();	
					$aAllWordsLName=array();		
					
					
					
					
					
					/////////////vars/////////////////////////////
					$aVar=array();
					
					$searchSex='';
					$orSex='no';
					if(!empty($_POST['sexito02'])){
						$theSex="sex='0'";
						$aVar[7]='2';
						$orSex='si';
						
						$searchSex="AND ($theSex)";
					}
					
					if(!empty($_POST['sexito01'])){
						if($orSex=='si'){
							$theSex.=" or sex='1'";
							$aVar[8]='1';
						}else{
							$theSex="sex='1'";
							$aVar[8]='1';
						}
						$searchSex="AND ($theSex)";
					}
					
					
								
								
										

						$sStr="name LIKE '".$valor."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
						if($registros[0]!=''){
						
							$e=0;
							foreach($registros as $registro){
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
								
								
							
									
									if($registro->profileId<7){	
									
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}
										$posP='<li>'.namePosition($club[0]->position).'</li>';
										$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
										$posP='';
									}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];
								
									
										
								$aAllWords[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[0]	
						//
						$sStr="name LIKE '".$valor."%'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWords[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
				
						/////////////////find 3 words ////////////////
						if($totValArr==4){
							$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWords[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									$totValArr--;
						
								}//4 words
				
						/////////////////find 2 words ////////////////
						if($totValArr==3){
							$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWords[$registro->id."people"]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									$totValArr--;
						
								}//4 words
						/////////////////find 1 words ////////////////		
						if($totValArr==2){
							$sStr="name LIKE '".$str[0]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWords[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									$totValArr--;
						
								}//1 words
						/////////all the words///////////////////////
						$sStr='';
				
						foreach ($str as $st){
						
						if($i<$valArr){
							$or=" OR ";
						}else{
							$or='';
						}
						
						//if($st!='-' && $st!='de' && $st!='of' && $st!='for') //st.lenght > 2
						
							$sStr=$sStr . "name LIKE '%".$st."%' OR lastName LIKE '%".$st."%'".$or;
							$i++;
						
					
						}
							
						
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
						
						
						//////////////////////////////////////
						$totValArr=sizeof($str);
						////////////lastNames/////////////////
							$sStr="lastName LIKE '".$str[0]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWordsLName[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									//$totValArr--;
							//
							$sStr="lastName LIKE '%".$valor."'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWordsLName[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									//$totValArr--;		
						
							/////////////////find first word ////////////////
							if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWordsLName[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWordsLName[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									
							//$totValArr--;
							
							
							}		
						
						/////////////////find last word ////////////////
							if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWordsLName[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
								
						//		
						$sStr="lastName LIKE '%".$str[0]."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWordsLName[$registro->id."people"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
								
						//$totValArr--;
						
						
				
					}// if  tot>0
					
					
					
				
					
					
					
				
					
					
					
					
					
					
					
					
					
					///////////////////////CLUB//////////////////////////////////////////
					
					
					
					$pros=new Institution();
					
					
						//
						$sStr="name LIKE '".$valor."'";
						$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWords[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
							
						//
						$sStr="name LIKE '".$valor."%'";
						$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWords[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
				
						/////////////////find 3 words ////////////////
						if($totValArr==4){
							$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
							$registros=$pros->selectGen('*',"($sStr) $searchSex AND active='1' AND complete='1' AND profileId < 25");
					
					
					
					if($registros[0]!=''){
					
						
						foreach($registros as $registro){
								if(!empty($registro->dayOfBirthDay)){
									$brd=explode('-',$registro->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
							
							
						
								
								if($registro->profileId<7){	
								
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");	
																									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}
									$posP='<li>'.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									$posP='';
								}
							
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];
							
								
                                    
							$aAllWords[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									$totValArr--;
						
								}//4 words
				
						/////////////////find 2 words ////////////////
						if($totValArr==3){
							$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
							$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWords[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]	
								$totValArr--;
						
								}//4 words
						/////////////////find 1 words ////////////////		
						if($totValArr==2){
							$sStr="name LIKE '".$str[0]."%'";
							$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								

							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWords[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									$totValArr--;
						
								}//1 words
						///////al words///////////////////////////
						$sStr='';
						foreach ($str as $st){
						
						if($i<$valArr){
							$or=" OR ";
						}else{
							$or='';
						}
						
							$sStr=$sStr . "name LIKE '%".$st."%'".$or;
							$i++;
											
						}
								
						$registros=$pro->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
				
						
						
						//////////////////////////////////////
						$totValArr=sizeof($str);
						////////////lastNames/////////////////
							$sStr="lastName LIKE '".$str[0]."%'";
							$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWordsLName[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									//$totValArr--;
							//
							$sStr="lastName LIKE '%".$valor."'";
							$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWordsLName[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									//$totValArr--;		
						
							/////////////////find first word ////////////////
							if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
							$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWordsLName[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
							$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWordsLName[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									
							//$totValArr--;
							
							
							}		
						
						/////////////////find last word ////////////////
							if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWordsLName[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
								
						//		
						$sStr="lastName LIKE '%".$str[0]."'";
						$registros=$pros->selectProfile(26,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
						
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
							//////////Centers the IMG///////////
							$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
							$moveLeft=$a[0];
							$moveTop=$a[1];	
								
								
							$aAllWordsLName[$registro->id."club"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
								
						//$totValArr--;
						
						
				
					}// if  tot>0
					
					
					
					
					
					
					
					///////////////////////COMPANY//////////////////////////////////////////
				
						
						
					$com=new Institution();
					//
						$sStr="name LIKE '".$valor."'";
						$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWords[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
							
						//
						$sStr="name LIKE '".$valor."%'";
						$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWords[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
				
						/////////////////find 3 words ////////////////
						if($totValArr==4){
							$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
							$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWords[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
									$totValArr--;
						
								}//4 words
				
						/////////////////find 2 words ////////////////
						if($totValArr==3){
							$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
							$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWords[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
								$totValArr--;
						
								}//4 words
						/////////////////find 1 words ////////////////		
						if($totValArr==2){
							$sStr="name LIKE '".$str[0]."%'";
							$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWords[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
									$totValArr--;
						
								}//1 words
						/////////all words///////////////////////////
						$sStr='';
							foreach ($str as $st){
							
							if($i<$valArr){
								$or=" OR ";
							}else{
								$or='';
							}
	
							
								$sStr=$sStr . "name LIKE '%".$st."%'".$or;
								$i++;
							
						
							}		
								$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
						
								
						if($registros[0]!=''){
									
							foreach($registros as $registro){
								
								$prof=new Profile();
								$phot=$prof->selectGen('photo',"id=".$registro->idUser);
									
									if(!empty($registro->foundationDate)){
										$brd=explode('-',$registro->foundationDate);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
								
									
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
				
						
						
						//////////////////////////////////////
						$totValArr=sizeof($str);
						////////////lastNames/////////////////
							$sStr="lastName LIKE '".$str[0]."%'";
							$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWordsLName[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
									//$totValArr--;
							//
							$sStr="lastName LIKE '%".$valor."'";
							$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWordsLName[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
									//$totValArr--;		
						
							/////////////////find first word ////////////////
							if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
							$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWordsLName[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
							$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWordsLName[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
									
							//$totValArr--;
							
							
							}		
						
						/////////////////find last word ////////////////
							if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWordsLName[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
								
						//		
						$sStr="lastName LIKE '%".$str[0]."'";
						$registros=$com->selectProfile(27,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
								
						foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								
							
								
							$aAllWordsLName[$registro->id."company"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
								
						//$totValArr--;
						
						
				
					}// if  tot>0
					
					
					
					
					
					///////////////////////FEDERATION//////////////////////////////////////////
					
					
					
						
						$fed=new Institution();
						
						
						
						
							
						$sStr="name LIKE '".$valor."'";
						$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWords[$registro->id."fed"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
							
						//
						$sStr="name LIKE '".$valor."%'";
						$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWords[$registro->id."fed"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
				
						/////////////////find 3 words ////////////////
						if($totValArr==4){
							$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
							$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWords[$registro->id."fed"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
									$totValArr--;
						
								}//4 words
				
						/////////////////find 2 words ////////////////
						if($totValArr==3){
							$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
							$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWords[$registro->id."fed"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
								$totValArr--;
						
								}//4 words
						/////////////////find 1 words ////////////////		
						if($totValArr==2){
							$sStr="name LIKE '".$str[0]."%'";
							$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWords[$registro->id."fed"]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
									$totValArr--;
						
								}//1 words
						/////////all words//////////////////
						foreach ($str as $st){
						
						if($i<$valArr){
							$or=" OR ";
						}else{
							$or='';
						}
						
						
							$sStr=$sStr . "name LIKE '%".$st."%'".$or;
							$i++;
						
					
						}		
						$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
				
						
						
						//////////////////////////////////////
						$totValArr=sizeof($str);
						////////////lastNames/////////////////
							$sStr="lastName LIKE '".$str[0]."%'";
							$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWordsLName[$registro->id."fed"]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
									//$totValArr--;
							//
							$sStr="lastName LIKE '%".$valor."'";
							$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWordsLName[$registro->id."fed"]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
									//$totValArr--;		
						
							/////////////////find first word ////////////////
							if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
							$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWordsLName[$registro->id."fed"]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
							$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWordsLName[$registro->id."fed"]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
									
							//$totValArr--;
							
							
							}		
						
						/////////////////find last word ////////////////
							if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
					
					
					
					if($registros[0]!=''){
					
					
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('photo',"id=".$registro->idUser);
								
								if(!empty($registro->foundationDate)){
									$brd=explode('-',$registro->foundationDate);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
							
								$aAllWordsLName[$registro->id."fed"]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
									}//for
								}//[]
								
							//		
							$sStr="lastName LIKE '%".$str[0]."'";
							$registros=$fed->selectProfile(25,'*',"($sStr) AND active='1'");
						
						
						
						if($registros[0]!=''){
						
						
								foreach($registros as $registro){
								
								$prof=new Profile();
								$phot=$prof->selectGen('photo',"id=".$registro->idUser);
									
									if(!empty($registro->foundationDate)){
										$brd=explode('-',$registro->foundationDate);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
								
									$aAllWordsLName[$registro->id."fed"]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
									
										}//for
									}//[]
									
							//$totValArr--;
						
						
				
					}// if  tot>0
						
					
					
					
				
					
					
					
					
					/*
					
					///////////////////////VIDEOS//////////////////////////////////////////
					$sStr='';
				
					foreach ($str as $st){
					
					if($i<$valArr){
						$or=" OR ";
					}else{
						$or='';
					}
					
					//if($st!='-' && $st!='de' && $st!='of' && $st!='for') //st.lenght > 2
					
						$sStr=$sStr . "name LIKE '%".$st."%' OR tagsVideo LIKE '%".$st."%'".$or;
						$i++;
					
				
				}
			
					$pro=new Video();	
					$registros=$pro->selectVideo(2,'*',"($sStr) AND active='1'","name");
					
					
					
						if($registros[0]!=''){
					//session comprobation//
					if(!empty($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
						$editProfile=true;
					}else{
						$editProfile=0;
					}
					
					 if(!empty($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
								 $idUserVisiting=$_SESSION["iSMuIdKey"];
					 }else{
						 $idUserVisiting=$_SESSION["idUserVisiting"];
					 }
					 
					 if(!empty($_SESSION['idProfileVisiting']) || $_SESSION['idProfileVisiting']==0 || $_SESSION['idProfileVisiting']==$_SESSION['iSMuProfTypeKey']){
						 $idProfileVisiting=$_SESSION["iSMuProfTypeKey"];
					 }else{
						 $idProfileVisiting=$_SESSION["idProfileVisiting"];
					 }
					
					
						////create arrays for load video//////////
						$i=0;
						foreach($registros as $registro){
						
							$imgVid='photoVideo/small_'.$registro->photo;
				
							////////check if has file or youtube/////////
							$filePath='http://c590104.r4.cf2.rackcdn.com/';
							
							if($registro->fileName!=''){
								$file=$filePath.$registro->fileName;
							}else{
								$file=$registro->youtube;
							}
										
						?>
						
							<script type="text/javascript">
							 <!-- ////////////////////// VIDEOS ////////////////////////////// -->
								
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>=new Array();
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($file); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->name); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProfile); ?>');
								window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
							
								///sum view//
								window.top.window.iVpu_pOk_uOk<? echo $i; ?>=new Array();
								window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
								window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
								window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
								window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
								window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
								
								///ratesVote///
								window.top.window.rPuV<? echo $i; ?>=new Array();
								window.top.window.rPuV<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
								window.top.window.rPuV<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
								window.top.window.rPuV<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
								
							
							</script>
							
							<?
							$i++;
							}
							?>
						
						
						<? $i=0;		
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('id,photo,name,lastName,profileId,dayOfBirthDay,countryName,destacado',"id=".$registro->idUser);
								
								if(!empty($phot[0]->dayOfBirthDay)){
									$brd=explode('-',$phot[0]->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								if($phot[0]->profileId<7){
									
									
									$club=$prof->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->idUser."");
									
									if($phot[0]->profileId==2){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}
									$posP=namePosition($club[0]->position);
									$clubB='Club: '.$club[0]->clubName.$club[0]->otherClub;																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='';
									$posP='';
								}
								
														 
								
							$aAllWords[$registro->id."video"]='<div class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');"><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><a href="#"><img onclick="loadVideo(iFvpu_pOkuOk_n_ph_uN_pN'.$i.'); upPlayer(); sumView(iVpu_pOk_uOk'.$i.'); ratesVote(rPuV'.$i.');" width="180" height="119" src="photoVideo/small_'.$registro->photo.'" title="'.$registro->name.'" /></a></div><h4 onclick="JS_follower('.$phot[0]->id.'); return false;">'.$phot[0]->name.' '.$phot[0]->lastName.'('.edad($phot[0]->dayOfBirthDay).')</h4><ul><li>'.nameProfile($phot[0]->profileId).'</li>'.$ecDD.'<li>'.$posP.'</li><li>'.$phot[0]->countryName.'</li><li>'.$clubB.'</li></ul></div>';
							
							$i++;
							
							}//for
							
					
					
					}//if [0]
					
					
					
					
					///////////////////////PHOTOS//////////////////////////////////////////
					$sStr='';
					
						foreach ($str as $st){
						
						if($i<$valArr){
							$or=" OR ";
						}else{
							$or='';
						}
						
						
							$sStr='';
							$sStr=$sStr . "name LIKE '%".$st."%' OR tagsPhoto LIKE '%".$st."%'".$or;
							$i++;
						
					
						}
					
					$pho=new Photo();
					$registros=$pho->selectPhoto(2,'*',"($sStr) AND active='1'","name");
					
					
					
					if($registros[0]!=''){
					//session comprobation//
					if(!empty($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
						$editProfile=true;
					}else{
						$editProfile=0;
					}
					
					 if(!empty($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
								 $idUserVisiting=$_SESSION["iSMuIdKey"];
					 }else{
						 $idUserVisiting=$_SESSION["idUserVisiting"];
					 }
					 
					 if(!empty($_SESSION['idProfileVisiting']) || $_SESSION['idProfileVisiting']==0 || $_SESSION['idProfileVisiting']==$_SESSION['iSMuProfTypeKey']){
						 $idProfileVisiting=$_SESSION["iSMuProfTypeKey"];
					 }else{
						 $idProfileVisiting=$_SESSION["idProfileVisiting"];
					 }
					
					
						////create arrays for load photo//////////
						$i=0;
						foreach($registros as $registro){
						
							$imgPho='photoPhoto/'.$registro->photo;
				
							$filePath='http://c577808.r8.cf2.rackcdn.com/';
							$file=$filePath.$registro->photo;
							
										
						?>
						
						<script type="text/javascript">
						 <!-- ////////////////////// PHOTOS ////////////////////////////// -->
					    	
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>=new Array();
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($file); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->name); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProfile); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($sStr); ?>');
							
							
						
							///sum view//
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>=new Array();
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
							
						
						</script>
						
						<?
						$i++;
						}
						?>
						
						
						<? $i=0;		
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('id,photo,name,lastName,profileId,dayOfBirthDay,countryName,destacado',"id=".$registro->idUser);
								
								if(!empty($phot[0]->dayOfBirthDay)){
									$brd=explode('-',$phot[0]->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								if($phot[0]->profileId<7){
									
									
									$club=$prof->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->idUser."");
									
									if($phot[0]->profileId==2){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}
									$posP=namePosition($club[0]->position);
									$clubB='Club: '.$club[0]->clubName.$club[0]->otherClub;																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='';
									$posP='';
								}
								
							
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoPhoto/".$registro->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								 
								
							$aAllWords[$registro->id."fotos"]='<div class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><a href="#"><img '.$moveLeft.' onclick="loadPhoto(pFvpu_pOkuOk_n_ph_uN_pN'.$i.'); upPhotoPlayer(); sumViewPhoto(pVpu_pOk_uOk'.$i.');"  src="photoPhoto/'.$registro->photo.'" title="'.$registro->name.'" /></a></div><h4 onclick="JS_follower('.$phot[0]->id.'); return false;">'.$phot[0]->name.' '.$phot[0]->lastName.'('.edad($phot[0]->dayOfBirthDay).')</h4><ul><li>'.nameProfile($phot[0]->profileId).'</li>'.$ecDD.'<li>'.$posP.'</li><li>'.$phot[0]->countryName.'</li><li>'.$clubB.'</li></ul></div>';
							
							$i++;
							
							}//for
							
					
					
					}//if [0]
					
					*/
					
					
					
					
					
					
					///////////////////////////////////////////////////////////////////////////////////
					//////////////WRITE content//////////
					$aAllW=array_unique($aAllWords);
					$aAllLName=array_unique($aAllWordsLName);
					$aAboth=array();
					$aMergeNameLName=array();
					$aCoincidences=array();
					
					
					
					//check coincidences between name and lastName
					foreach($aAllW as $kk => $vv){
						
						foreach($aAllLName as $nk => $nv){
								if($kk==$nk){
									$aAboth[$kk]=$nv;		
								}
						}
					}
					
					////Merges Name and Last Name
					$aMergeNameLName=array_merge($aAllW,$aAllLName);
					
					////Merges te coincidences and the merged arrays
					$aCoincidences=array_merge($aAboth,$aMergeNameLName);
				
					
					///Deletes duplications//
					//$aAll=array_unique($aCoincidences);
					$aAll=array_unique($aCoincidences);
					
					//var_dump($aAllW);
					//echo '///////////////////////////////////////////////////////////////////////////////';
					//var_dump($aAll);
					//die();
					
					/////count////////
					$cantR=count($aAll);
					
					
					
					//asort($aAll); //order by key name
					
					//////////set the pagination////////////////////
					if(!empty($_POST['pageNum'])){
						$page=addslashes($_POST['pageNum']);
					}else{
						$page=0;
					}
					
					
					//////how many pages/////
					$paginas = floor($cantR/15);
					$inicio=$page*15;
					
			
			
			
			
			

			
			///vars//
			$aVar=array();
					
				
					
			if(!empty($_POST['storeSelectProfile'])){
				$v0="<input type='hidden' name='storeSelectProfile' value='".$_POST['storeSelectProfile']."' />";
			}else{
				$v0="";
			}
			if(!empty($_POST['strgToSearch'])){
				$v1="<input type='hidden' name='strgToSearch' value='".$_POST['strgToSearch']."' />";
			}else{
				$v1="";
			}
				
			if(!empty($_POST['sexito01'])){
				$v6="<input type='hidden' name='sexito01' value='".$_POST['sexito01']."' />";
			}else{
				$v6="";
			}
			if(!empty($_POST['sexito02'])){
				$v7="<input type='hidden' name='sexito02' value='".$_POST['sexito02']."' />";
			}else{
				$v7="";
			}
			
						
			/////////////vars/////////////////////////////
					
			
			
			

			///Previous results///		
			if($page>0){
			$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page - 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>'.$_IDIOMA->traducir("previous").'</a></span>';
			}
			
			///More results////		
			if($page<$paginas){
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"e3\").submit();\'>'.$_IDIOMA->traducir("more results").'</a></span>';
			}
					
					
					
					if($cantR>0){
						?>
						
						<script type='text/javascript'>
							window.top.window.$('#results').fadeIn('slow');
						</script>	
						
						<?
						$i=1;
						foreach($aAll as $all){
							if($i>$inicio && $i<($inicio+16)){
						
						
						?>
							<script type='text/javascript'>
								window.top.window.$('#results').html(window.top.window.$('#results').html()+'<ul id="condition"><li></li></ul><? echo $all; ?>');
							</script>
						<?
							}
							$i++;
						}//for
						
							
							
						
						?>
						<script type='text/javascript'>
							window.top.window.$('#results').html(window.top.window.$('#results').html()+"<div class='paginador'><? echo $paginado; ?></div>");
						</script>
						<?
					}// cant>0
									
					
					
					
		
		
		
		
		//if gral
?>