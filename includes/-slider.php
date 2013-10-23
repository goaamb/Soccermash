
<div id="slideProfiles">    
	<div id="outerContainer">
    	<div id="imageScroller">
        	<div id="viewer" class="js-disabled">
  	<?php 
			$dir='/soccermashTest2';
			$i=0;
				foreach($aUsuarios as $idUser=>$aUsuario){
							if($i<=$iCant){#10 es la cant. MAX de users q se muestran
			
			
							//////Move the img to center thumb//////////
			
			
			$aSize=@getimagesize("photoGeneral/small/small_".$aUsuario['photo']);
			//echo $_SERVER['DOCUMENT_ROOT'].$dir."/".$imgPhoto;
			//var_dump($aSize);
			
			if($aSize[0]>50){
			 $moveLeft='margin-left:-'.(($aSize[0]-50)/2).';';
			}else{
			 $moveLeft='';
			}
			
			
			if($aSize[1]>50){
			 $moveTop='margin-top:-'.(($aSize[1]-50)/2).';';
			}else{
			 $moveTop='';
			 
			}

     ?>    
     			<div style="width:50px; height:50px; overflow:hidden; float:left; margin-right:5px;">   
  	  			<a class="wrapper" href="#" title="<?php echo $aUsuario['name'];?>" >	
						<img style="'.$moveLeft.' '.$moveTop.'" class="logo" id="" src="photoGeneral/small/small_<?php echo $aUsuario['photo'];?>" alt="" />
					</a>
          </div>
	 <?php 	
	   	  	  	}else break;
	   	  	 	$i++; 				
   	 	}  	  
	?>       	
          	
            </div>
        </div>
    </div>
    <!--End Slider-->
</div><!--End slideProfile-->
