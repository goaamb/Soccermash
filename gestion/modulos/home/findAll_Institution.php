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
					
					/////Cant resultados////////		
					if(empty($_POST['club']) && empty($_POST['company']) && !empty($_POST['federation'])){
					$cant=15;
				}elseif(empty($_POST['club']) && !empty($_POST['company']) && empty($_POST['federation'])){
					$cant=15;
				}elseif(!empty($_POST['club']) && empty($_POST['company']) && empty($_POST['federation'])){
					$cant=15;
				}else{
					$cant=3;	
				}		
					
					
					
					
				//check if both are selected///////
				if(!empty($_POST['club']) && !empty($_POST['company']) && !empty($_POST['federation'])){
					$both=true;
				}else{
					$both=0;
				}
					
				/////////////searchs club//////////////
				if((empty($_POST['company']) && empty($_POST['federation'])) || $both==true || (!empty($_POST['company']) && !empty($_POST['club'])) || (!empty($_POST['federation']) && !empty($_POST['club'])))
				{
					
						
					//////////
									
					
					
						//
						$sStr="name LIKE '".$valor."'";
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
							
						//
						$sStr="name LIKE '".$valor."%'";
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
							
								
                                    
							$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->id."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult"  onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name.' '.$registro->lastName).'('.edad($registro->dayOfBirthDay).')</h4><ul><li>'.nameProfile($registro->profileId).'</li><li>'.$registro->countryName.'</li>'.($posP.''.$clubB.''.$ecDD).'</ul></div>';
								
								}//for
							}//[0]
									$totValArr--;
						
								}//4 words
				
						/////////////////find 2 words ////////////////
						if($totValArr==3){
							$sStr="name LIKE '".$str[0]." ".$str[1]."%'";
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
								$totValArr--;
						
								}//4 words
						/////////////////find 1 words ////////////////		
						if($totValArr==2){
							$sStr="name LIKE '".$str[0]."%'";
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
								
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									//$totValArr--;
							//
							$sStr="lastName LIKE '%".$valor."'";
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
								
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									//$totValArr--;		
						
							/////////////////find first word ////////////////
							if($totValArr>0){
							$sStr="lastName LIKE '".$str[$totValArr-1]."%'";	
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
								
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									
							//		
							$sStr="lastName LIKE '%".$str[$totValArr-1]."'";	
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
								
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
									
							//$totValArr--;
							
							
							}		
						
						/////////////////find last word ////////////////
							if($totValArr>0){
						$sStr="lastName LIKE '".$str[0]."%'";	
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
								
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
								
						//		
						$sStr="lastName LIKE '%".$str[0]."'";
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
								
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;" ><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Club</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->federationName.' '.$registro->otherFederation) .'</li></ul></div>';
							
								}//for
							}//[]
								
						//$totValArr--;
						
						
				
					}// if  tot>0
						
				
				
				
				
				
				
				}//club



				/////////////searchs company//////////////
				if((empty($_POST['club']) && empty($_POST['federation'])) || $both==true || (!empty($_POST['company']) && !empty($_POST['club'])) || (!empty($_POST['company']) && !empty($_POST['federation'])))
				{

				
					
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
								
							
								
							$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
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
								
							
								
							$aAllWordsLName[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Company</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
							
								}//for
							}//[]
								
						//$totValArr--;
						
						
				
					}// if  tot>0
					
					
					
					
					
					
					
					
					
					}//	company 
					
				
				
				/////////////searchs federation//////////////
				if((empty($_POST['company']) && empty($_POST['club'])) || $both==true || (!empty($_POST['federation']) && !empty($_POST['club'])) || (!empty($_POST['company']) && !empty($_POST['federation'])))
				{
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
							
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWords[$registro->id]='<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
							
								$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
								
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
								
									$aAllWordsLName[$registro->id]= '<div onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$registro->idUser."-".Utilidades::normalizarTexto($registro->name." ".$registro->lastName).'\\\'" class="itemResult" onmouseover="subir('.$registro->idUser.');" onmouseout="bajar('.$registro->idUser.');" ><div id="imagen'.$registro->idUser.'" style="height:190px; overflow:hidden;"><img '.$moveLeft.' src="photoGeneral/big/'.$phot[0]->photo.'"  title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'" /></div><h4>'.str_replace(array("'","\n","\r"),array("\\'"," "," "), $registro->name).'</h4><ul><li>Federation</li><li>Foundated: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li><!--<li>Defensive midfielder</li>--><li>'.$registro->countryName.'</li><li>'.$registro->website.'</li></ul></div>';
									
										}//for
									}//[]
									
							//$totValArr--;
						
						
				
					}// if  tot>0
					
					
					
					
					
					}///institutions
					
					
					
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
					
					if(!empty($_POST['club'])){
						$v2="<input type='hidden' name='club' value='".$_POST['club']."' />";
					}else{
						$v2="";
					}
					if(!empty($_POST['federation'])){
						$v3="<input type='hidden' name='federation' value='".$_POST['federation']."' />";
					}else{
						$v3="";
					}
					
					if(!empty($_POST['company'])){
						$v4="<input type='hidden' name='company' value='".$_POST['company']."' />";
					}else{
						$v4="";
					}
			
						
			/////////////vars/////////////////////////////
					
			
			
			

			///Previous results///		
			if($page>0){
			$paginado .="<form name='f2' id='f2' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page - 1)."' />$v0 $v1 $v2 $v3 $v4</form>";
			$paginado .= '<span><a href=\'javascript:;\' onclick=\'document.getElementById(\"f2\").submit();\'>'.$_IDIOMA->traducir("previous").'</a></span>';
			}
			
			///More results////		
			if($page<$paginas){
			$paginado .="<form name='e3' id='e3' target='iframeSearch' method='POST' action='gestion/modulos/home/findAll.php'><input type='hidden' name='pageNum' value='".($page + 1)."' />$v0 $v1 $v2 $v3 $v4</form>";
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