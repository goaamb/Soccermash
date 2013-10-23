<?
$aSize=getimagesize($uploaddir.$rand.$thephotoFileName);
			
				$iVal=119;
				$eVal=180;
			
			if($aSize[0]>$aSize[1]){
				
				
				
						function checaWidth($iVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir){
							$possibleWidth=floor($aSize[0]*$iVal/$aSize[1]);
								if($possibleWidth<180){
									$iVal=$iVal+10;
									checaWidth($iVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir);
								
								}else{
								
									$resize1=new ImageResize($uploaddir.$rand.$thephotoFileName);
									$resize1->resizeHeight($iVal);
									$resize1->save($uploaddir_smallPic.$rand.$thephotoFileName);
									
								}
						}
						
						checaWidth($iVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir);
						
										
						
					
					}else{
					
						
						function checaHeight($eVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir){
							$possibleHeight=floor($aSize[1]*$eVal/$aSize[0]);
								if($possibleHeight<119){
									$eVal=$eVal+10;
									checaHeight($eVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir);
		
								}else{
									
									$resize1=new ImageResize($uploaddir.$rand.$thephotoFileName);
									$resize1->resizeWidth($eVal);
									$resize1->save($uploaddir_smallPic.$rand.$thephotoFileName);		
											
								}	
							
						}
					
						checaHeight($eVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir);
				
				
							
			
				
			
			}// if size
			
	?>