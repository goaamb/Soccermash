<script type="text/javascript">
	uUsers=new Array();		
	totImg=$(window).width()/50.5;
	//alert(totImg);

</script>



<div id="slideProfile" style="width:100%;">    
	
	
	
  	<?php 
	/*var_dump($aUsuarios);
	die();*/
	
	
	
	
			$dir='';
			$i=0;
		//	$iCant=100;
				foreach($aUsuarios as $idUser=>$aUsuario){
				
					if($i<=$iCant){#10 es la cant. MAX de users q se muestran
			
					
							 
			
				//////Move the img to center thumb//////////
				/*$aSize=@getimagesize($_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/small/small_".$aUsuario['photo'].".jpg");
				
				
				if($aSize[0]>50){
				 $moveLeft='style="margin-left:'.(($aSize[0]-50)/2).'px;"';
				}else{
				 $moveLeft='';
				}*/
				
				
				/*if($aSize[1]>50){
				 $moveTop='margin-top:-'.(($aSize[1]-50)/2).';';
				}else{
				 $moveTop='';
				 
				}*/

     ?>    
     			<div class="slideImg"> 
  	  			<a id="toolP" <?php /*?>onmouseover="clearT();" onmouseout="moveFunc();"<?php */?> href="#" title="<?php echo $aUsuario['name'].' '.$aUsuario['lastName'];?>" >	
						<img <?php /*echo $moveLeft;*/ ?> class="logo imgSlide"  src="photoGeneral/small/small_<?php echo $aUsuario['photo'];?>" />
				</a> 
           		</div>
				
			
				
				
				
				<?php
				/* 
				?>
					<script type="text/javascript">
						duUsers<? echo $i; ?>=new Array();
						duUsers<? echo $i; ?>[0]='<?php echo $aUsuario['photo'];?>';
						duUsers<? echo $i; ?>[1]='<?php echo $aUsuario['name'].' '.$aUsuario['lastName'];?>';
						
					
						uUsers[<? echo $i ?>]=duUsers<? echo $i; ?>;
						
						
						//uUsers[<? //echo $i ?>]['moveLeft']='<? //echo $moveLeft;?>';
					</script>
				<?php
				*/ 
				?>	
				
				
				
				
	 <?php 	
	   	  	  	
				}else break;
	   	  	 	$i++; 				
   	 	}  	
		
		
		
		
		/*  
	?>       	
          	
      
	  			<!--  /////Add the repeated img to start again//////  -->
				<script type="text/javascript">
				

					
					f=0;
					for(i in uUsers){
					
					if(f<totImg){
						
					
						$('#slideProfile').html($('#slideProfile').html()+'<div class="slideImg"><a id="toolP" onmouseover="clearT();" onmouseout="moveFunc();" href="#" title="'+uUsers[i][1]+'" ><img class="logo imgSlide"  src="photoGeneral/small/small_'+uUsers[i][0]+'" /></a></div>');
						
					
					f++;
					
					}else{
						break;
					}
					
					}
					
					
				
					
					
					
					
					
					
					
					//////////////move slider///////////////
					totP=<? echo $iCant; ?>;
					lef=-0.69375;
					
					function clearT(){
						clearTimeout(t);
					}
					
					
					function moveFunc(){
						t=setTimeout("movePhot()",30);
					}	
					moveFunc();
					
					
								
					function movePhot(){
					
						if(totP>0){
							 if(totP==100){
								$('#slideProfile').css('left','0px'); 
							 }
							
								
								$('#slideProfile').css('left',lef);
								lef=lef-0.69375;
								totP=totP-0.0125;
								//$('#val').html(totP+' '+$('#slideProfile').css('left')); 
								moveFunc();
							
								
								
								
								
						}else{
							//totP=-100;
							$('#slideProfile').css('left','0px');
							lef=0;
							//$('#val').html(totP+' '+$('#slideProfile').css('left')); 
							totP=100;
							moveFunc();
						}
					
					}
					
					
					
					
					
					
				</script>
		<?php
		*/
		?>	
				
					
					
	  
	  
</div><!--End slideProfile-->

<script type="text/javascript">
var desp=new G.desplazante({
	capa:"slideProfile",
	intervaloTiempo : 30,
	tiempoDescanso : 30,
	sentido : "horizontal",
	direccion : "negativa",
	incremento : 0.69375,
	detenerSobre : true
});
desp.iniciar();
</script>

