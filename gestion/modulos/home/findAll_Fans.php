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
				
				
				
		
				
				//////filters for Agent profile/////
					$kindIdProfile="AND ( profileId ='23'";
					
										
					//ctry//
					if(!empty($_POST['countrySearch15'])){
						$_POST['countrySearch7']=$_POST['countrySearch15'];
					}
					
					if(!empty($_POST['countrySearch7'])){
						$countryName="AND countryName='".addslashes($_POST['countrySearch7'])."'";
					}else{
						$countryName='';
					}
					
					//age//
					if(!empty($_POST['ageSearch'])){
						$anio=getAnio(addslashes($_POST['ageSearch']));
						$aAnio=$anio.'-'.date('m-d');
						$ageSrch="AND dayOfBirthDay BETWEEN '".$aAnio."' AND '".date('Y-m-d')."'";
					}else{
						$ageSrch='';
					}
					
					
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
					
					
					
					//////////
									
					
					
						//
						$sStr="name LIKE '".$valor."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWords[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
							
						//
						$sStr="name LIKE '".$valor."%'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWords[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
				
						/////////////////find 3 words ////////////////
						if($totValArr==4){
							$sStr="name LIKE '".$str[0]." ".$str[1]." ".$str[2]."%'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWords[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
									$totValArr--;
						
								}//4 words
				
						/////////////////find 2 words ////////////////
						if($totValArr==3){
							$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWords[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
									$totValArr--;
						
								}//4 words
						/////////////////find 1 words ////////////////		
						if($totValArr==2){
							$sStr="name LIKE '".$str[0]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWords[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]				$totValArr--;
						
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
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWords[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]				
				
						
						
						//////////////////////////////////////
						$totValArr=sizeof($str);
						////////////lastNames/////////////////
							$sStr="lastName LIKE '".$str[0]."%'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
									//$totValArr--;
							//
							$sStr="lastName LIKE '%".$valor."'";
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
									//$totValArr--;		
						
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
										
									//////////Centers the IMG///////////
									$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoGeneral/big/'.$registro->photo);
									//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
									$moveLeft=$a[0];
									$moveTop=$a[1];
										
									$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
							$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
									
							//$totValArr--;
							
							
							}		
						
						/////////////////find last word ////////////////
							if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
								
						//		
						$sStr="lastName LIKE '%".$str[0]."'";
						$registros=$pro->selectGen('*',"($sStr) $searchSex AND active='1' $kindIdProfile ) $countryName $ageSrch");
						
						if($registros[0]!=''){
								foreach($registros as $registro){
										
																										
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
										
									$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace("\n","<br/>",$registro->cityName).'</li></ul></div>';
									
									}//for
							}//[0]
								
						//$totValArr--;
						
						
				
					}// if  tot>0
						
				
				
				
				
 					
					
					
					
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
					
				
										
				
				
			/////////////vars/////////////////////////////
			if(!empty($_POST['storeSelectADVProfile'])){
				$v0="<input type='hidden' name='storeSelectADVProfile' value='".$_POST['storeSelectADVProfile']."' />";
			}else{
				$v0="";
			}
			if(!empty($_POST['strgToSearch'])){
				$v1="<input type='hidden' name='strgToSearch' value='".$_POST['strgToSearch']."' />";
			}else{
				$v1="";
			}
			if(!empty($_POST['ageSearch'])){
				$v2="<input type='hidden' name='ageSearch' value='".$_POST['ageSearch']."' />";
			}else{
				$v2="";
			}
			
			
			if(!empty($_POST['sexito01'])){
				$v3="<input type='hidden' name='sexito01' value='".$_POST['sexito01']."' />";
			}else{
				$v3="";
			}
			if(!empty($_POST['sexito02'])){
				$v4="<input type='hidden' name='sexito02' value='".$_POST['sexito02']."' />";
			}else{
				$v4="";
			}
			if(!empty($_POST['countrySearch7'])){
				$v5="<input type='hidden' name='countrySearch7' value='".$_POST['countrySearch7']."' />";
			}else{
				$v5="";
			}
						
			
					
			
			
			

			///Previous results///		
			if($page>0){
			$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page - 1)."' />$v0 $v1 $v2 $v3 $v4 $v5</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>'.$_IDIOMA->traducir("previous").'</a></span>';
			}
			
			///More results////		
			if($page<$paginas){
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page + 1)."' />$v0 $v1 $v2 $v3 $v4 $v5 </form>";
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