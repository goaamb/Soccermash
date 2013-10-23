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
$iUp=$_POST['sUp_uV_pV_uN_pN_eP'];
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

//////////set the pagination////////////////////

	
	$page=addslashes(base64_decode($iUp[7]));
	
/////////Number of items by page//////////////////
$cant=9;

//////////Pagination/////////////////////////////
$can=$vid->selectVideo($idProfile,'id',"idUser='$idUser'","id desc LIMIT 0,6");
$cant=count($can);

$init=$vid->paginate($idProfile,$page,"and idUser=$idUser",$iUp,$cant);

////////get the values from pagination////////////
$ini=explode(',',$init);
$inicio=$ini[0];
$paginado=$ini[1];
//////////////////////////////////////////


///////////////////////////Select videos from user//////////////////////////////////////////////
$registros=$vid->selectVideo($idProfile,'*',"idUser='$idUser'","id desc LIMIT $inicio,$cant");

echo '<div id="extGlryTop" class="onright"><em class="onright" onclick="closer(); loadVideoSlider();" id="minusGllry">[-]</em></div>';
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
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>=new Array();
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($file); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->name); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProf); ?>');
					iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
					
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
<div class="watermark" onclick="loadVideo(iFvpu_pOkuOk_n_ph_uN_pN'.$i.'); sumView(iVpu_pOk_uOk'.$i.'); ratesVote(rPuV'.$i.');">'; 
if($noimg==false){
echo '<img src="img/play.png"/></div>';
}else{
echo '<img src="img/playEmpty.png"/></div>';
}
echo '<div class="screenshot"><img src="'.$imgVid.'" width="180" height="119" /></div>
</div>';

/*onclick="loadVideo(iFvpu_pOkuOk_n_ph_uN_pN'.$i.'); sumView(\''.$registro->id.'\',\''.$idProfile.'\',\''.$idUser.'\',\''.$idProfileOk.'\',\''.$idUserOk.'\'); ratesVote(\''.$idProfile.'\',\''.$idUser.'\',\''.$registro->id.'\');"*/
		$i++;
		}//for
	}//if






////////Check if there are empty photos, puts the default one//////

//////check if I can delete, only in my profile/////////
if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
		$res=9-$cant;
	if(($res)>0){
		for($i=0;$i<$res;$i++){
			echo '

			<div class="slide">
			<div class="watermark" onclick="$(\'#videoUploader\').show(\'slow\').fadeIn(\'slow\'); $(\'#extendedGallery\').fadeOut(\'slow\');"></div>
			<div class="screenshot" style="overflow:hidden;"><a href="javascript:;"><img src="img/videoprv1.png"/></a></div>
			</div>
			';

		}
	}	   
		
	}else{
		
	$res=9-$cant;
	if(($res)>0){
		for($i=0;$i<$res;$i++){
			echo '

			<div class="slide">
			<div class="watermark"></div>
			<div class="screenshot" style="overflow:hidden;"><a href="javascript:;"><img src="img/videoprv.png"/></a></div>
			</div>
			';

		}
	}
	
	}//if session
	
	
  




require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/paginador.php');


}//if!=0


?>