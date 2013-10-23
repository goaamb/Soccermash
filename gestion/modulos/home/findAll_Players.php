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
					
					
					
					
					
					//////filters for player profile/////
					$kind='no';
					if(!empty($_POST['pyundcontr'])){
						$kindIdProfile="AND ( profileId=2 ";
						$kind='si';
					}	
						
					if(!empty($_POST['pywthoutcontr'])){
						if($kind=='si'){
							$andOr='OR';
						}else{
							$andOr='AND (';
						}
						$kindIdProfile=$kindIdProfile. "$andOr profileId=3 ";
						$kind='si';
					}	
					
					if(!empty($_POST['amtpy'])){
						if($kind=='si'){
							$andOr='OR';
						}else{
							$andOr='AND (';
						}
						$kindIdProfile=$kindIdProfile. "$andOr profileId=5 ";
						$kind='si';
					}	
						
					if(!empty($_POST['xply'])){
						if($kind=='si'){
							$andOr='OR';
						}else{
							$andOr='AND (';
						}
						$kindIdProfile=$kindIdProfile. "$andOr profileId=6";		
						$kind='si';
					}
					
					if($kind=='no'){
						$kindIdProfile="AND (profileId BETWEEN 2 AND 6";
					}
					
					
					if(!empty($_POST['clubSearch3'])){	
						$_POST['clubSearch']=$_POST['clubSearch3'];
					}
						
					if(!empty($_POST['endcontdatSearch3'])){
						$_POST['endcontdatSearch']=addslashes($_POST['endcontdatSearch3']);
					}
					
					
					if(!empty($_POST['countrySearch9'])){
						$_POST['countrySearch']=$_POST['countrySearch9'];
					}
					
					if(!empty($_POST['countrySearch'])){
						$countryName="AND countryName='".addslashes($_POST['countrySearch'])."'";
					}else{
						$countryName='';
					}
					
					
					if(!empty($_POST['ageSearch'])){
						$anio=getAnio(addslashes($_POST['ageSearch']));
						$aAnio=$anio.'-'.date('m-d');
						$ageSrch="AND dayOfBirthDay BETWEEN '".$aAnio."' AND '".date('Y-m-d')."'";
					}else{
						$ageSrch='';
					}




				
					////////////////
					$aVar=array();
				
					$searchSex='';
					$orSex='no';
					if(!empty($_POST['sexito02'])){
						$theSex="sex='0'";
						$aVar[22]='2';
						$orSex='si';
						
						$searchSex="AND ($theSex)";
					}
					
					if(!empty($_POST['sexito01'])){
						if($orSex=='si'){
							$theSex.=" or sex='1'";
							$aVar[21]='1';
						}else{
							$theSex="sex='1'";
							$aVar[21]='1';
						}
						$searchSex="AND ($theSex)";
					}
					
					
					
					if(!empty($_POST['eupassp'])){
						$aVar[23]='1';
						$theEPass="And europass = '1'";
					}else{
						$aVar[23]='';
						$theEPass='';
					}
					
					if(!empty($_POST['otherPassP'])){
						$aVar[24]=addslashes($_POST['otherPassP']);
						$thePPass="And passaport Like '%".$_POST['otherPassP']."%'";
					}else{
						$aVar[24]='';
						$thePPass='';
					}
					
					/////////////////
					$pro=new Profile();
					
					//////////set the pagination////////////////////
					if(!empty($_POST['pageNum'])){
						$page=addslashes($_POST['pageNum']);
					}else{
						$page=1;
					} 
					///////////PAGINATION//////////////////////////
					/////////////vars/////////////////////////////
					
					
					
					
					
					////////////Filters for PLAYER CLUB - CONTRACT - POSITION/////////////////////////////
					if(!empty($_POST['clubSearch']) || !empty($_POST['clubSearch3']) || !empty($_POST['endcontdatSearch']) || !empty($_POST['endcontdatSearch3']) || !empty($_POST['position0']) || !empty($_POST['position1']) || !empty($_POST['position2']) || !empty($_POST['position3']) || !empty($_POST['position4']) || !empty($_POST['position5']) || !empty($_POST['position6']) || !empty($_POST['position7']) || !empty($_POST['position8']) || !empty($_POST['position9']) || !empty($_POST['position10']) || !empty($_POST['eupassp']) || !empty($_POST['otherPassP'])){
					
					
					
					//$cant=7;
					/////////Number of items by page - number of adv profile//////////////////
					$advProfile=addslashes($_POST['storeSelectADVProfile']);
					//////////Pagination/////////////////////////////
						///filters for pagination SubQ//
						$filtOR='';
						///club//
						if(!empty($_POST['clubSearch3'])){	
							$_POST['clubSearch']=$_POST['clubSearch3'];
						}
						
						if(!empty($_POST['clubSearch'])){			
							$cClub="(clubName LIKE '%".addslashes($_POST['clubSearch'])."%' OR otherClub LIKE '%".addslashes($_POST['clubSearch'])."%')";
							$filtOR="AND";
						}
						////EndinCd
						
						if(!empty($_POST['endcontdatSearch3'])){
							$_POST['endcontdatSearch']=addslashes($_POST['endcontdatSearch3']);
						}
						
						if(!empty($_POST['endcontdatSearch'])){
							$ddDate=explode('/',addslashes($_POST['endcontdatSearch']));
							$dDate=$ddDate[2].'-'.$ddDate[1].'-'.$ddDate[0];						
							$eEndCd="$filtOR (endingContractDate BETWEEN '".date('Y-m-d')."' AND '".$dDate."')";	
							$filtOR="AND";
						}
						/////position////	
						$pPosi='no';
						$ThePosition='';
						if(!empty($_POST['position0'])){
							$ThePosition=$ThePosition. "position LIKE '1,%' ";
							$pPosi='si';
						}
						
						if(!empty($_POST['position1'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%2,%' ";
							$pPosi='si';
						}
						
						
						if(!empty($_POST['position2'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%3,%' ";
							$pPosi='si';
						}
						
						
						if(!empty($_POST['position3'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%4,%' ";
							$pPosi='si';
						}
						
						
						if(!empty($_POST['position4'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%5,%' ";
							$pPosi='si';
						}
						
					     
						 
						if(!empty($_POST['position5'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%6,%' ";
							$pPosi='si';
						} 
						 
						 
						if(!empty($_POST['position6'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%7,%' ";
							$pPosi='si';
						}
						
						
						
						
						if(!empty($_POST['position7'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%8,%' ";
							$pPosi='si';
						}
						
						
						
						if(!empty($_POST['position8'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%9,%' ";
							$pPosi='si';
						}
						
						
						
						if(!empty($_POST['position9'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%10,%' ";
							$pPosi='si';
						}
						
						
						
						
						if(!empty($_POST['position10'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$ThePosition=$ThePosition. $pOR."position LIKE '%11,%' ";
							$pPosi='si';
						}
						
						
						if($pPosi=='si'){			 
							$pPosition="$filtOR ($ThePosition)";
							$filtOR="AND";
						}else{
							$pPosition='';
						}						
					
					
					
					if(!empty($_POST['eupassp'])){
						$aVar[23]=addslashes($_POST['eupassp']);
						$theEPass=$filtOR." europass=1";
						$filtOR="AND";
					}else{
						$aVar[23]='';
						$theEPass='';
					}
					
					if(!empty($_POST['otherPassP'])){
						$aVar[24]=addslashes($_POST['otherPassP']);
						$thePPass=$filtOR." passaport Like '%".$_POST['otherPassP']."%'";
					}else{
						$aVar[24]='';
						$thePPass='';
					}
					
					
					$subQ="AND id IN (SELECT idUser FROM ax_player WHERE $cClub $eEndCd $pPosition $theEPass $thePPass)";
					
				
					
					//$subQ="AND id IN (SELECT idUser FROM ax_player WHERE otherClub LIKE '%a%')";
					$init=$pro->paginate($idProfile,$page,"WHERE ($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by name",$aVar,$cant,$advProfile);
					////////get the values from pagination////////////
					$ini=explode(',',$init);
					$inicio=$ini[0];
					$paginado=$ini[1];
					//////////////////////////////////////////			
					
					
					
					///club//
					if(!empty($_POST['clubSearch'])){			
						$cClub="AND (clubName LIKE '%".addslashes($_POST['clubSearch'])."%' OR otherClub LIKE '%".addslashes($_POST['clubSearch'])."%')";
					}
					
					////EndinCd
					if(!empty($_POST['endcontdatSearch3'])){
						$_POST['endcontdatSearch']=addslashes($_POST['endcontdatSearch3']);
					}
					
					if(!empty($_POST['endcontdatSearch'])){
						$ddDate=explode('/',addslashes($_POST['endcontdatSearch']));
						$dDate=$ddDate[2].'-'.$ddDate[1].'-'.$ddDate[0];						
						$eEndCd="AND (endingContractDate BETWEEN '".date('Y-m-d')."' AND '".$dDate."')";	
						//echo $eEndCd;
					}
					
					/////position////	
					$pPosi='no';
					$TPosition='';
						if(!empty($_POST['position0'])){
							$TPosition=$TPosition. "position LIKE '1,%' ";
							$pPosi='si';
						}
						
						if(!empty($_POST['position1'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%2,%' ";
							$pPosi='si';
						}
						
						
						if(!empty($_POST['position2'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%3,%' ";
							$pPosi='si';
						}
						
						
						if(!empty($_POST['position3'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%4,%' ";
							$pPosi='si';
						}
						
						
						if(!empty($_POST['position4'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%5,%' ";
							$pPosi='si';
						}
						
					     
						 
						if(!empty($_POST['position5'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%6,%' ";
							$pPosi='si';
						} 
						 
						 
						
						
						if(!empty($_POST['position6'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%7,%' ";
							$pPosi='si';
						}
						
						
						
						
						if(!empty($_POST['position7'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%8,%' ";
							$pPosi='si';
						}
						
						
						
						
						if(!empty($_POST['position8'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%9,%' ";
							$pPosi='si';
						}
						
						
						
						
						if(!empty($_POST['position9'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%10,%' ";
							$pPosi='si';
						}
						
						
						if(!empty($_POST['position10'])){
							if($pPosi=='si'){
								$pOR='OR ';
							}else{
								$pOR='';
							}
							$TPosition=$TPosition. $pOR."position LIKE '%11,%' ";
							$pPosi='si';
						}
						
						if($pPosi=='si'){			 
							$ttPosition="AND ($TPosition)";
						}else{
							$ttPosition='';
						}					
					
					
						//
						$sStr="name LIKE '".$valor."'";
					$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by name");
					
					
					
					if($registros[0]!=''){
							
							 foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
									
									
																											
									if($club[0]!=''){																			
									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
									
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
							
								}//if club
							}//for
						}//if [0]						
						//
						$sStr="name LIKE '".$valor."%'";
					$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by name");
					
					
					
					if($registros[0]!=''){
							
							 foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
									
									
																											
									if($club[0]!=''){																			
									
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
									
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
							
								}//if club
							}//for
						}//if [0]
				
						/////////////////find 3 words ////////////////
							if($totValArr==4){
							$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by name");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
									$totValArr--;
						
								}//4 words
				
						/////////////////find 2 words ////////////////
						if($totValArr==3){
							$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by name");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
									$totValArr--;
						
								}//4 words
						/////////////////find 1 words ////////////////		
						if($totValArr==2){
							$sStr="name LIKE '".$str[0]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by name");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
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
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by name");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
										
								
				
						
						
						//////////////////////////////////////
						$totValArr=sizeof($str);
						////////////lastNames/////////////////
							$sStr="lastName LIKE '".$str[0]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by lastName");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
									//$totValArr--;
							//
							$sStr="lastName LIKE '%".$valor."'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by lastName");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
									//$totValArr--;		
						
						/////////////////find first word ////////////////
							if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by lastName");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by lastName");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
									
							//$totValArr--;
							
							
							}		
						
						/////////////////find last word ////////////////
							if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by lastName");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
								
						//		
						$sStr="lastName LIKE '%".$str[0]."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch $subQ order by lastName");
					
						if($registros[0]!=''){
								
								 foreach($registros as $registro){
										
										////check club//
										$club=$pro->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->id."");
										
										
																												
										if($club[0]!=''){																			
										
											if($registro->profileId==2){
												$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
											}else{
												$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
											}
										$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
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
										
									$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
									}//if club
								}//for
							}//if [0]
								
						//$totValArr--;
						
						
				
					}// if  tot>0
						
				
				
				
				}else{//NORMAL search fot PLAYER 
 					
					/////////////////First find all the Names////////////////
					$sStr="name LIKE '".$valor."'";
					
					$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by name");
					
					
					
					if($registros[0]!=''){
										
										
							foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,endingContractDate,position',"idUser=".$registro->id."");
								
									if($club[0]!=''){																			
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}
									
																									
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
										$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
										
										}//for
										}//[]
					//
					$sStr="name LIKE '".$valor."%'";
					
					$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by name");
					
					
					
					if($registros[0]!=''){
										
										
							foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,endingContractDate,position',"idUser=".$registro->id."");
								
									if($club[0]!=''){																			
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}
									
																									
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
										$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
										
										}//for
										}//[]
					
				
					/////////////////find 3 words ////////////////
					if($totValArr==4){
						$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by name");
					
					
					
					if($registros[0]!=''){
										
										
							foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,endingContractDate,position',"idUser=".$registro->id."");
								
									if($club[0]!=''){																			
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}
									
																									
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
										$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
										
										}//for
									}//[]
								$totValArr--;
					
							}//4 words
					
					/////////////////find 2 words ////////////////
					if($totValArr==3){
						$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by name");
					
					
					
					if($registros[0]!=''){
										
										
							foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,endingContractDate,position',"idUser=".$registro->id."");
								
									if($club[0]!=''){																			
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}
									
																									
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
										$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
										
										}//for
									}//[]
								$totValArr--;
					
							}//3 words
					
					/////////////////find 1 words ////////////////
					if($totValArr==2){
						$sStr="name LIKE '".$str[0]."%'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by name");
					
					
					
					if($registros[0]!=''){
										
										
							foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,endingContractDate,position',"idUser=".$registro->id."");
								
									if($club[0]!=''){																			
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}
									
																									
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
										$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
										
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
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by name");
					
					
					
					if($registros[0]!=''){
										
										
							foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,endingContractDate,position',"idUser=".$registro->id."");
								
									if($club[0]!=''){																			
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}
									
																									
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
										$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
										
										}//for
									}//[]
									
						
							
					
					
					//////////////////////////////////////
					$totValArr=sizeof($str);
					////////////lastNames/////////////////
						$sStr="lastName LIKE '".$valor."'";
						///////////Select////////////////////	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by lastName");
					
					
					
					if($registros[0]!=''){
										
										
							foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,endingContractDate,position',"idUser=".$registro->id."");
								
									if($club[0]!=''){																			
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}
									
																									
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
										$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
										
										}//for
									}//[]
						//
						$sStr="lastName LIKE '%".$valor."'";
						///////////Select////////////////////	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by lastName");
					
					
					
					if($registros[0]!=''){
										
										
							foreach($registros as $registro){
									
									////check club//
									$club=$pro->selectProfile(2,'clubName,otherClub,endingContractDate,position',"idUser=".$registro->id."");
								
									if($club[0]!=''){																			
										if($registro->profileId==2){
											$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
										}else{
											$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
										}
									$posP='<li>POS: '.namePosition($club[0]->position).'</li>';
									$clubB='<li>CLUB: '.$club[0]->otherClub.$club[0]->clubName.'</li>';																		
									}
									
																									
									if(!empty($registro->dayOfBirthDay)){
										$brd=explode('-',$registro->dayOfBirthDay);
									}else{
										$brd[0]=''; $brd[1]=''; $brd[2]='';      
									}
									
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];	
									
										$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
										
										}//for
									}//[]
					
					/////////////////find first word ////////////////
						if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by lastName");
							
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
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by lastName");
							
							
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
									
							//$totValArr--;
							
							
							}
					/////////////////find last word ////////////////
						if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by lastName");
						
						
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
						$sStr="lastName LIKE '%".$str[0]."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch order by lastName");
						
						
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
								
						//$totValArr--;
						
						
				
					}// if  tot>0
						
					
						
					
					
					
					
					
 				}///normal search for player
 					
					
					
					
					///////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////
					//////////////WRITE content//////////
					
					$aAllW=array_unique($aAllWords);
					$aAllLName=array_unique($aAllWordsLName);
					//var_dump($aAllWords);
					//var_dump($aAllWordsLName);
					
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
			
			if(!empty($_POST['pyundcontr'])){//pyundcontr
				$v0="<input type='hidden' name='pyundcontr' value='".$_POST['pyundcontr']."' />";
			}else{
				$v0="";
			}
			if(!empty($_POST['pywthoutcontr'])){
				$v1="<input type='hidden' name='pywthoutcontr' value='".$_POST['pywthoutcontr']."' />";
			}else{
				$v1="";
			}
			if(!empty($_POST['amtpy'])){
				$v2="<input type='hidden' name='amtpy' value='".$_POST['amtpy']."' />";
			}else{
				$v2="";
			}
			if(!empty($_POST['countrySearch'])){
				$v3="<input type='hidden' name='countrySearch' value='".$_POST['countrySearch']."' />";
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
			if(!empty($_POST['xply'])){
				$v7="<input type='hidden' name='xply' value='".$_POST['xply']."' />";
			}else{
				$v7="";
			}
			if(!empty($_POST['clubSearch'])){
				$v8="<input type='hidden' name='clubSearch' value='".$_POST['clubSearch']."' />";
			}else{
				$v8="";
			}
			if(!empty($_POST['endcontdatSearch'])){
				$v9="<input type='hidden' name='endcontdatSearch' value='".$_POST['endcontdatSearch']."' />";
			}else{
				$v9="";
			}
			if(!empty($_POST['position0'])){
				$v10="<input type='hidden' name='position0' value='".$_POST['position0']."' />";
			}else{
				$v10="";
			}
			if(!empty($_POST['position1'])){
				$v11="<input type='hidden' name='position1' value='".$_POST['position1']."' />";
			}else{
				$v11="";
			}
			if(!empty($_POST['position2'])){
				$v12="<input type='hidden' name='position2' value='".$_POST['position2']."' />";
			}else{
				$v12="";
			}
			if(!empty($_POST['position3'])){
				$v13="<input type='hidden' name='position3' value='".$_POST['position3']."' />";
			}else{
				$v13="";
			}
			if(!empty($_POST['position4'])){
				$v14="<input type='hidden' name='position4' value='".$_POST['position4']."' />";
			}else{
				$v14="";
			}
			if(!empty($_POST['position5'])){
				$v15="<input type='hidden' name='position5' value='".$_POST['position5']."' />";
			}else{
				$v15="";
			}
			if(!empty($_POST['position6'])){
				$v16="<input type='hidden' name='position6' value='".$_POST['position6']."' />";
			}else{
				$v16="";
			}
			if(!empty($_POST['position7'])){
				$v17="<input type='hidden' name='position7' value='".$_POST['position7']."' />";
			}else{
				$v17="";
			}
			if(!empty($_POST['position8'])){
				$v18="<input type='hidden' name='position8' value='".$_POST['position8']."' />";
			}else{
				$v18="";
			}
			if(!empty($_POST['position9'])){
				$v19="<input type='hidden' name='position9' value='".$_POST['position9']."' />";
			}else{
				$v19="";
			}
			if(!empty($_POST['position10'])){
				$v20="<input type='hidden' name='position10' value='".$_POST['position10']."' />";
			}else{
				$v20="";
			}
			if(!empty($_POST['sexito01'])){
				$v21="<input type='hidden' name='sexito01' value='".$_POST['sexito01']."' />";
			}else{
				$v21="";
			}
			if(!empty($_POST['sexito02'])){
				$v22="<input type='hidden' name='sexito02' value='".$_POST['sexito02']."' />";
			}else{
				$v22="";
			}
			if(!empty($_POST['eupassp'])){
				$v23="<input type='hidden' name='eupassp' value='".$_POST['eupassp']."' />";
			}else{
				$v23="";
			}
			if(!empty($_POST['otherPassP'])){
				$v24="<input type='hidden' name='otherPassP' value='".$_POST['otherPassP']."' />";
			}else{
				$v24="";
			}
			
			
			

			///Previous results///		
			if($page>0){
			$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page - 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8 $v9 $v10 $v11 $v12 $v12 $v13 $v14 $v15 $v16 $v17 $v18 $v19 $v20 $v21 $v22 $v23 $v24</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>'.$_IDIOMA->traducir("previous").'</a></span>';
			}
			
			///More results////		
			if($page<$paginas){
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 $v6 $v7 $v8 $v9 $v10 $v11 $v12 $v12 $v13 $v14 $v15 $v16 $v17 $v18 $v19 $v20 $v21 $v22 $v23 $v24</form>";
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