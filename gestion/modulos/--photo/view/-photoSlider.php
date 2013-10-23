<script type="text/javascript">
        $(document).ready(function(){
						  var currentPosition = 0;     //posicion actual
							var slideWidth = 180;      //ancho cada slide
							var slides = $('.slide');     //seleccion todos los .slide
							var numberOfSlides = slides.length;      //cuenta la cantidad de slides
							var dir; //direction clicked
							// Remove scrollbar in JS
  						$('#slidesContainer').css('overflow', 'hidden');
							// Wrap all .slides with #slideInner div   
							slides
								.wrapAll('<div id="slideInner"></div>')
								// Float left to display horizontally, readjust .slides width
							.css({
									'float' : 'left',
									'width' : slideWidth
								});
							 // Set #slideInner width equal to total width of all slides
  						$('#slideInner').css('width', slideWidth * numberOfSlides);
              });
        </script>

 <?

/////////////////////////////////////////////////////////////////////////////////
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');





//////////////if exists the profile id from de register////////////////////
$iUp=$_POST['pUp_uV_pV_uN_pN_eP'];
$idProfile=addslashes(base64_decode($iUp[3])); //visiting


//if(isset(addslashes(base64_decode($iUp[3])))){
if($idProfile!=0){






$idUser=addslashes(base64_decode($iUp[2]));  //visiting


$idProfileOk=$_SESSION["iSMuProfTypeKey"];
$idUserOk=$_SESSION["iSMuIdKey"];

$userName=$_SESSION["nameUserSM"];
						
$profileName=$_SESSION["namePerfilUserSM"];

if(isset($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
		$editProfile=true;
	}else{
		$editProfile=0;
	}






/////////////////////SELECT Photos/////////////////////////////////////////////




$pho=new Photo();



///////////////////////////Select phoeos from user//////////////////////////////////////////////
$registros=$pho->selectPhoto($idProfile,'*',"idUser='$idUser'","id desc LIMIT 0,6");

	if($registros[0]!=''){
		$i=0;
		foreach($registros as $registro){
						
			
				$imgPhoto='photoPhoto/'.$registro->photo;
				
			
			
			////////set the file path/////////
			$filePath='http://c577808.r8.cf2.rackcdn.com/';
			$file=$filePath.$registro->photo;
			
		
			?>
			<script type="text/javascript">
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>=new Array();
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($file); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfileOk); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUserOk); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->name); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($userName); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($profileName); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProfile); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
				
				///sum view//
				pVpu_pOk_uOk<? echo $i; ?>=new Array();
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfileOk); ?>');
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUserOk); ?>');
				
				
			</script>
			<? 
				 
			
			
			//////Move the img to center thumb//////////
				
				$aSize=getimagesize($_SERVER['DOCUMENT_ROOT'].$dir."/".$imgPhoto);
				//echo $_SERVER['DOCUMENT_ROOT'].$dir."/".$imgPhoto;
				//var_dump($aSize);
				
				if($aSize[0]>180){
					$moveLeft='margin-left:-'.(($aSize[0]-180)/2).';';
				}else{
					$moveLeft='';
				}
				
				
				if($aSize[1]>119){
					$moveTop='margin-top:-'.(($aSize[1]-119)/2).';';
				}else{
					$moveTop='';
					
				}
			
				 
	  echo '

<div class="slide">
<div class="watermark" onclick="loadPhoto(pFvpu_pOkuOk_n_ph_uN_pN'.$i.'); sumViewPhoto(pVpu_pOk_uOk'.$i.');"><img src="img/play.png"/></div>
<div class="screenshot" style="overflow:hidden;"><div style="'.$moveLeft.' '.$moveTop.'"><a href="javascript:;"><img src="'.$imgPhoto.'" /></a></div></div>
</div>


';

		$i++;
		
		
		}//for
	}//if
	   
         
     

         
	 
              
  
   }//if!=0
//}//if exists           
              
  echo '<div id="photoSum"></div>';
              
              
              
?>     