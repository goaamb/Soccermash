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
					
					
					
					
					
					//////filters for coach profile/////
					$kind='no';
					if(!empty($_POST['coachUC'])){
						$kindIdProfile="AND ( profileId=7 ";
						$kind='si';
					}	
						
					if(!empty($_POST['coachWOC'])){
						if($kind=='si'){
							$andOr='OR';
						}else{
							$andOr='AND (';
						}
						$kindIdProfile=$kindIdProfile. "$andOr profileId=8 ";
						$kind='si';
					}	
					
					if(!empty($_POST['gkeeperUC'])){
						if($kind=='si'){
							$andOr='OR';
						}else{
							$andOr='AND (';
						}
						$kindIdProfile=$kindIdProfile. "$andOr profileId=9 ";
						$kind='si';
					}	
						
					if(!empty($_POST['gkeeperWC'])){
						if($kind=='si'){
							$andOr='OR';
						}else{
							$andOr='AND (';
						}
						$kindIdProfile=$kindIdProfile. "$andOr profileId=10 ";		
						$kind='si';
					}
					
					if(!empty($_POST['physUC'])){
						if($kind=='si'){
							$andOr='OR';
						}else{
							$andOr='AND (';
						}
						$kindIdProfile=$kindIdProfile. "$andOr profileId=11 ";		
						$kind='si';
					}
					
					if(!empty($_POST['physWOC'])){
						if($kind=='si'){
							$andOr='OR';
						}else{
							$andOr='AND (';
						}
						$kindIdProfile=$kindIdProfile. "$andOr profileId=12";		
						$kind='si';
					}
					
					
					
					if($kind=='no'){
						$kindIdProfile="AND ( profileId BETWEEN 7 AND 12";
					}
					
					
					
					
					if(!empty($_POST['countrySearch16'])){
						$_POST['countrySearch8']=$_POST['countrySearch16'];
					}
					
					
					if(!empty($_POST['countrySearch8'])){
						$countryName="AND countryName='".addslashes($_POST['countrySearch8'])."'";
					}else{
						$countryName='';
					}
					
					
					if(!empty($_POST['clubSearch4'])){			
						$_POST['clubSearch2']=addslashes($_POST['clubSearch4']);
					}
					
					
					if(!empty($_POST['endcontdatSearch4'])){
						$_POST['endcontdatSearch2']=addslashes($_POST['endcontdatSearch4']);
					}
					
					
					
					
					
					if(!empty($_POST['ageSearch'])){
						$anio=getAnio(addslashes($_POST['ageSearch']));
						$aAnio=$anio.'-'.date('m-d');
						$ageSrch="AND dayOfBirthDay BETWEEN '".$aAnio."' AND '".date('Y-m-d')."'";
					}else{
						$ageSrch='';
					}




				
					////////////////
					/////////////vars/////////////////////////////
					$aVar=array();
					
					
					$searchSex='';
					$orSex='no';
					if(!empty($_POST['sexito02'])){
						$theSex="sex='0'";
						$aVar[12]='2';
						$orSex='si';
						
						$searchSex="AND ($theSex)";
					}
					
					if(!empty($_POST['sexito01'])){
						if($orSex=='si'){
							$theSex.=" or sex='1'";
							$aVar[13]='1';
						}else{
							$theSex="sex='1'";
							$aVar[13]='1';
						}
						$searchSex="AND ($theSex)";
					}
					
					
					
					
					
					////////////Filters for COACH CLUB - CONTRACT - POSITION/////////////////////////////
					///filter search for coach, club and ecd///
						if(!empty($_POST['clubSearch2']) || !empty($_POST['clubSearch4']) || !empty($_POST['endcontdatSearch2']) || !empty($_POST['endcontdatSearch4'])){				
					
					
					
					/////////Number of items by page - number of adv profile//////////////////
						///
						$advProfile=addslashes($_POST['storeSelectADVProfile']);
						//////////Pagination/////////////////////////////
						///filters for pagination SubQ//
						$filtOR='';
						///club//
						if(!empty($_POST['clubSearch4'])){			
							$_POST['clubSearch2']=$_POST['clubSearch4'];
						}
						if(!empty($_POST['clubSearch2'])){			
							$cClub="(clubName LIKE '%".addslashes($_POST['clubSearch2'])."%' OR otherClub LIKE '%".addslashes($_POST['clubSearch2'])."%')";
							$filtOR="AND";
						}
						////EndinCd
						if(!empty($_POST['endcontdatSearch4'])){
							$_POST['endcontdatSearch2']=addslashes($_POST['endcontdatSearch4']);
						}
						
						if(!empty($_POST['endcontdatSearch2'])){
							$ddDate=explode('/',addslashes($_POST['endcontdatSearch2']));
							$dDate=$ddDate[2].'-'.$ddDate[1].'-'.$ddDate[0];						
							$eEndCd="$filtOR endingContractDate BETWEEN '".date('Y-m-d')."' AND '".$dDate."'";	
							//echo $eEndCd;
						}
						
					
						$subQ="AND id IN (SELECT idUser FROM ax_coach WHERE $cClub $eEndCd)";
						
						
						if(!empty($_POST['clubSearch4'])){			
							$_POST['clubSearch2']=$_POST['clubSearch4'];
						}
						
						if(!empty($_POST['clubSearch2'])){			
							$cClub="AND (clubName LIKE '%".addslashes($_POST['clubSearch2'])."%' OR otherClub LIKE '%".addslashes($_POST['clubSearch2'])."%')";
						}
					
						////EndinCd
						if(!empty($_POST['endcontdatSearch4'])){
							$_POST['endcontdatSearch2']=addslashes($_POST['endcontdatSearch4']);
						}
						
						if(!empty($_POST['endcontdatSearch2'])){
							$ddDate=explode('/',addslashes($_POST['endcontdatSearch2']));
							$dDate=$ddDate[2].'-'.$ddDate[1].'-'.$ddDate[0];						
							$eEndCd="AND endingContractDate BETWEEN '".date('Y-m-d')."' AND '".$dDate."'";	
							//echo $eEndCd;
						}
					
						
					
					
					
					
						//
						$sStr="name LIKE '".$valor."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]						
						//
						$sStr="name LIKE '".$valor."%'";
					$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]						
				
						/////////////////find 3 words ////////////////
						if($totValArr==4){
							$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]						
									$totValArr--;
						
								}//4 words
				
						/////////////////find 2 words ////////////////
						if($totValArr==3){
							$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]						
									$totValArr--;
						
								}//4 words
						/////////////////find 1 words ////////////////		
						if($totValArr==2){
							$sStr="name LIKE '".$str[0]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]						
									$totValArr--;
						
								}//1 words
						/////////////////all words ////////////////		
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
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]						
									

						
				
						
						
						//////////////////////////////////////
						$totValArr=sizeof($str);
						////////////lastNames/////////////////
							$sStr="lastName LIKE '".$str[0]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]						
									//$totValArr--;
							//
							$sStr="lastName LIKE '%".$valor."'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]	
									//$totValArr--;		
						
						/////////////////find first word ////////////////
							if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]	
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]	
									
							//$totValArr--;
							
							
							}		
						
						/////////////////find last word ////////////////
							if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]	
								
						//		
						$sStr="lastName LIKE '%".$str[0]."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ");
	 
						//echo $pPosition;
						
					
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(8,'clubName,otherClub,endingContractDate',"idUser=".$registro->id." $cClub $eEndCd");
										
																			
										
										
										if($club[0]!=''){																			
											if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
											
											$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
										
										
																	
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
								}//if club[0]
							}//for
						}//if [0]	
								
						//$totValArr--;
						
						
				
					}// if  tot>0
						
				
				
				
				}else{//NORMAL search fot coach 
 					
					/////////////////First find all the Names////////////////
					$sStr="name LIKE '".$valor."'";
					$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
					//
					$sStr="name LIKE '".$valor."%'";
					$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
					
				
					/////////////////find 3 words ////////////////
					if($totValArr==4){
						$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
								$totValArr--;
					
							}//4 words
					
					/////////////////find 2 words ////////////////
					if($totValArr==3){
						$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
								$totValArr--;
					
							}//3 words
					
					/////////////////find 1 words ////////////////
					if($totValArr==2){
						$sStr="name LIKE '".$str[0]."%'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
								$totValArr--;
					
							}//2 words
					/////////////////all words ////////////////
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
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
								
							
							
					
					
					//////////////////////////////////////
					$totValArr=sizeof($str);
					////////////lastNames/////////////////
						$sStr="lastName LIKE '".$valor."'";
						///////////Select////////////////////	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
						//
						$sStr="lastName LIKE '%".$valor."'";
						///////////Select////////////////////	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
										
					/////////////////find first word ////////////////
						if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
							
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
											$clubB='<li>'.$registro->cityName.'</li>';
											$posP='';
										}
									
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
										$moveLeft=$a[0];
										$moveTop=$a[1];
									
										
										
										
										
										$aAllWordsLName[$registro->id]='<div onclick="JS_follower('.$registro->id.'); return false;" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.$registro->name.' '.$registro->lastName.'" /></div><h4>'.$registro->name.' '.$registro->lastName.'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.$posP.''.$clubB.''.$ecDD.'</ul></div>';
										
										
									}//for
									}//if [0]
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
									
							//$totValArr--;
							
							
							}
						
					/////////////////find last word ////////////////
						if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
								
						//		
						$sStr="lastName LIKE '%".$str[0]."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						
						
						if($registros[0]!=''){
								 foreach($registros as $registro){
										
										//club
										$club=$pro->selectProfile(7,'clubName,otherClub,endingContractDate',"idUser=".$registro->id."");
								
								if($club[0]!=''){																			
									if($registro->profileId==7 || $registro->profileId==9 || $registro->profileId==11){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}else{
										$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									}
								
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='<li>'.str_replace("\n","<br/>",$registro->cityName).'</li>';
									
								}
																										
										if(!empty($registro->dayOfBirthDay)){
											$brd=explode('-',$registro->dayOfBirthDay);
										}else{
											$brd[0]=''; $brd[1]=''; $brd[2]='';      
										}
										
										//////////Centers the IMG///////////
										$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($clubB.''.$ecDD).'</ul></div>';
									
									}//for
								}//[]
								
						//$totValArr--;
						
						
				
					}// if  tot>0
						
					
						
					
					
					
					
					
 				}///normal search for coach
 					
					
					
					
					
					
					
					
					///////////////////////////////////////////////////////////
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
					
					//var_dump($aAboth);
					////Merges Name and Last Name
					foreach($aAllLName as $nk => $nv){
								
									$aMergeNameLName[$nk]=$nv;		
				
						}
					foreach($aAllW as $kk => $vv){
						$aMergeNameLName[$kk]=$vv;
					}
						
					
					//$aMergeNameLName=array_merge($aAllW,$aAllLName);
					//var_dump($aMergeNameLName);
					
					////Merges te coincidences and the merged arrays
					foreach($aAboth as $kk => $vv){
						$aCoincidences[$kk]=$vv;
					}
						foreach($aMergeNameLName as $nk => $nv){
								
									$aCoincidences[$nk]=$nv;		
							
						}
					
					//$aCoincidences=array_merge($aAboth,$aMergeNameLName);
					//var_dump($aCoincidences);
								
					
					///Deletes duplications//
					//$aAll=array_unique($aCoincidences);
					$aAll=array_unique($aCoincidences);
					
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
			
			if(!empty($_POST['coachUC'])){//pyundcontr
				$v0="<input type='hidden' name='coachUC' value='".$_POST['coachUC']."' />";
			}else{
				$v0="";
			}
			if(!empty($_POST['coachWOC'])){
				$v1="<input type='hidden' name='coachWOC' value='".$_POST['coachWOC']."' />";
			}else{
				$v1="";
			}
			if(!empty($_POST['gkeeperUC'])){
				$v2="<input type='hidden' name='gkeeperUC' value='".$_POST['gkeeperUC']."' />";
			}else{
				$v2="";
			}
			
			if(!empty($_POST['countrySearch8'])){
				$v3="<input type='hidden' name='countrySearch8' value='".$_POST['countrySearch8']."' />";
			}else{
				$v3="";
			}
			if(!empty($_POST['ageSearch'])){
				$v4="<input type='hidden' name='ageSearch' value='".$_POST['ageSearch']."' />";
			}else{
				$v4="";
			}
			if(!empty($_POST['strgToSearch'])){
				$v5="<input type='hidden' name='strgToSearch' value='".$_POST['strgToSearch']."' />";
			}else{
				$v5="";
			}
			if(!empty($_POST['storeSelectADVProfile'])){
				$v6="<input type='hidden' name='storeSelectADVProfile' value='".$_POST['storeSelectADVProfile']."' />";
			}else{
				$v6="";
			}
			if(!empty($_POST['gkeeperWC'])){
				$v7="<input type='hidden' name='gkeeperWC' value='".$_POST['gkeeperWC']."' />";
			}else{
				$v7="";
			}
			if(!empty($_POST['physUC'])){
				$v8="<input type='hidden' name='physUC' value='".$_POST['physUC']."' />";
			}else{
				$v8="";
			}
			if(!empty($_POST['physWOC'])){
				$v9="<input type='hidden' name='physWOC' value='".$_POST['physWOC']."' />";
			}else{
				$v9="";
			}
			if(!empty($_POST['clubSearch2'])){
				$v10="<input type='hidden' name='clubSearch2' value='".$_POST['clubSearch2']."' />";
			}else{
				$v10="";
			}
			if(!empty($_POST['endcontdatSearch2'])){
				$v11="<input type='hidden' name='endcontdatSearch2' value='".$_POST['endcontdatSearch2']."' />";
			}else{
				$v11="";
			}
			if(!empty($_POST['sexito01'])){
				$v12="<input type='hidden' name='sexito01' value='".$_POST['sexito01']."' />";
			}else{
				$v12="";
			}
			if(!empty($_POST['sexito02'])){
				$v13="<input type='hidden' name='sexito02' value='".$_POST['sexito02']."' />";
			}else{
				$v13="";
			}
			
			
			

			///Previous results///		
			if($page>0){
			$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page - 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8 $v9 $v10 $v11 $v12 $v13</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>'.$_IDIOMA->traducir("previous").'</a></span>';
			}
			
			///More results////		
			if($page<$paginas){
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8 $v9 $v10 $v11 $v12 $v13</form>";
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
									
					
					
					
					
					
					
					
				
  
?>