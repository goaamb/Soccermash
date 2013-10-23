<script type="text/javascript">
        //$(document).ready(function(){
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
             // });
        </script>

 <?

/////////////////////////////////////////////////////////////////////////////////
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoClass.php');
//require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/youApi/youClass.php');


	////translation///////
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }		

	global $_IDIOMA;

//////////////if exists the profile id from de register////////////////////
$iUp=$_POST['iUp_uV_pV_uN_pN_eP'];
$idProfile=addslashes(base64_decode($iUp[3])); //visiting


//if(isset(addslashes(base64_decode($iUp[3])))){
if($idProfile!=0){






$idUser=addslashes(base64_decode($iUp[2]));  //visiting


$idProfileOk=$_SESSION["iSMuProfTypeKey"];
$idUserOk=$_SESSION["iSMuIdKey"];

$userName=$_SESSION["nameUserSM"];
						
$profileName=$_SESSION["namePerfilUserSM"];

//////check if I can delete, only in my profile/////////
if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
		$editProf=true;
	}else{
		$editProf=0;
	}





/////////////////////SELECT videos/////////////////////////////////////////////




$vid=new Video();



///////////////////////////Select videos from user//////////////////////////////////////////////
$can=$vid->selectVideo($idProfile,'id',"idUser='$idUser'","id desc LIMIT 0,6");
$cant=count($can);

$registros=$vid->selectVideo($idProfile,'*',"idUser='$idUser'","id desc LIMIT 0,6");

	if($registros[0]!=''){
		$i=0;
		foreach($registros as $registro){
						
			//if($registro->photo!='' && $registro->fileName!=''){
			//	$imgVid=$registro->photo;
			//}elseif($registro->youtube){
				$noimg=false;
				$imgVid='photoVideo/small_'.$registro->photo;
				if(!is_file($_SERVER["DOCUMENT_ROOT"]."/".$imgVid)){
					$imgVid="/img/playvideocaratula.png";
					$noimg=true;
				}
				
			//}
			
			
			
			////////check if has file or youtube/////////
			$filePath='http://c590104.r4.cf2.rackcdn.com/';
			
			if($registro->fileName!=''){
				$file=$filePath.$registro->fileName;
			}else{
				$file=$registro->youtube;
			}
			
		
		
		
		
		
		/////////check if its editable///////////
			
				if($editProf==true){
					
					if(empty($registro->fileName)){
						$regFilename=0;
					}else{
						$regFilename=$registro->fileName;
					}
					?>
					
					<script type="text/javascript">
						iVpuF_ph<? echo $i; ?>=new Array();
						iVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
						iVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
						iVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
						iVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($regFilename); ?>');
						iVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
						iVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
						iVpuF_ph<? echo $i; ?>.push('<? echo base64_encode('setThisToDelete'); ?>');
											
					</script>
					<?
				
				$delVid= '<div class="posDelMulti"><a href="javascript:;" onclick="delVideo(iVpuF_ph'.$i.');"><div title="'.$_IDIOMA->traducir("Delete").'" id="delMulti" class="delMulti"></div></a></div>';
				//$editName='<div style="position:absolute; z-index:20;"><input type="text" style="border:thin solid #ccc;" value="'.$registro->name.'" onclick="actName=this.value;" onBlur="if(actName!=this.value){upVideo(\''.base64_encode($registro->id).'\',this.value);}" /></div>';
				
			}else{
				$delVid='';
				//$editName='';
				
			}
		
		
		
		
		
		
		
		
		
		
		
		
		
			?>
			<script type="text/javascript">
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>=new Array();
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($file); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->name); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProf); ?>');
				sFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
				
				///sum view//
				iVpu_pOk_uOk<? echo $i; ?>=new Array();
				iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
				iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
				iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
				iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
				iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
				
				///ratesVote///
				rPuV<? echo $i; ?>=new Array();
				rPuV<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
				rPuV<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
				rPuV<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
			</script>
			<? 
				 
				 
	  
echo '
<div class="slide">
'.$delVid.'
<div class="watermark" onclick="loadVideo(sFvpu_pOkuOk_n_ph_uN_pN'.$i.'); sumView(iVpu_pOk_uOk'.$i.'); ratesVote(rPuV'.$i.');">'; 
if($noimg==false){
echo '<img src="img/play.png"/></div>';
}else{
echo '<img src="img/playEmpty.png"/></div>';
}
echo'<div class="screenshot"><a href="javascript:;"><img src="'.$imgVid.'" width="180" height="119" /></a></div>
</div>
';
/*onclick="loadVideo(sFvpu_pOkuOk_n_ph_uN_pN'.$i.'); sumView(\''.$registro->id.'\',\''.$idProfile.'\',\''.$idUser.'\',\''.$idProfileOk.'\',\''.$idUserOk.'\'); ratesVote(\''.$idProfile.'\',\''.$idUser.'\',\''.$registro->id.'\');"*/
		$i++;
		
		
		}//for
	}//if
	   
         
  ////////Check if there are empty photos, puts the default one//////

//////check if I can delete, only in my profile/////////
if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
		$res=6-$cant;
	if(($res)>0){
		for($i=0;$i<$res;$i++){
			echo '

			<div class="slide">
			<div class="watermark" onclick="$(\'#videoUploader\').fadeIn(\'slow\');"></div>
			<div class="screenshot"><a href="javascript:;"><img src="img/videoprv1.png"/></a></div>
			</div>
			';

		}
	}	   
		
	}else{
		
	$res=6-$cant;
	if(($res)>0){
		for($i=0;$i<$res;$i++){
			echo '

			<div class="slide">
			<div class="watermark"></div>
				<div class="screenshot"><a href="javascript:;"><img src="img/videoprv.png"/></a></div>
			</div>
			';

		}
	}
	
	}//if session

         
	 
              
  
   }//if!=0
//}//if exists           
              
  echo '<div id="videoSum"></div>';
              
              
              
?>     