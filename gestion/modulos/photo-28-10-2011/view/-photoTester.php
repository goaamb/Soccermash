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

//////check if I can delete, only in my profile/////////
if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
		$editProf=true;
	}else{
		$editProf=0;
	}





/////////////////////SELECT photos/////////////////////////////////////////////




$pho=new Photo();

//////////set the pagination////////////////////

	
	$page=addslashes(base64_decode($iUp[7]));
	
/////////Number of items by page//////////////////
$cant=9;

//////////Pagination/////////////////////////////
$init=$pho->paginate($idProfile,$page,"and idUser=$idUser",$iUp,$cant);

////////get the values from pagination////////////
$ini=explode(',',$init);
$inicio=$ini[0];
$paginado=$ini[1];
//////////////////////////////////////////


///////////////////////////Select photos from user//////////////////////////////////////////////
$can=$pho->selectPhoto($idProfile,'id',"idUser='$idUser'","id desc LIMIT $inicio,$cant");
$cant=count($can);

$registros=$pho->selectPhoto($idProfile,'*',"idUser='$idUser'","id desc LIMIT $inicio,$cant");

	if($registros[0]!=''){
		$i=0;
		
		echo '<div id="extGlryTop" class="onright"><em class="onright" onclick="closer(); loadPhotoSlider();" id="minusGllry">[-]</em></div>';
		
		foreach($registros as $registro){
						
			//if($registro->photo!='' && $registro->fileName!=''){
			//	$imgpho=$registro->photo;
			//}elseif($registro->youtube){
				$imgPho='photoPhoto/'.$registro->photo;
				
			//}
			
			
			
			////////check if has file or youtube/////////
			$filePath='http://c577808.r8.cf2.rackcdn.com/';
			$file=$filePath.$registro->photo;
		
			
			/////////check if its editable///////////
			
				if($editProf==true){
					
					$regFilename=$registro->photo;
				
					?>
					
					<script type="text/javascript">
						pVpuF_ph<? echo $i; ?>=new Array();
						pVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
						pVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
						pVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
						pVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($regFilename); ?>');
						pVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
						pVpuF_ph<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
						
											
					</script>
					<?
				
				$delPho= '<div class="posDelMulti"><a href="javascript:;" onclick="delPhoto(pVpuF_ph'.$i.');"><div title="Delete" id="delMulti" class="delMulti"></div></a></div>';
				//$editName='<div style="position:absolute; z-index:20;"><input type="text" style="border:thin solid #ccc;" value="'.$registro->name.'" onclick="actName=this.value;" onBlur="if(actName!=this.value){upPhoto(\''.base64_encode($registro->id).'\',this.value);}" /></div>';
				
			}else{
				$delPho='';
				//$editName='';
				
				
			}
						
						
				?>
				<script type="text/javascript">
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>=new Array();
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($file); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfileOk); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUserOk); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->name); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($userName); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($profileName); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProf); ?>');
					hpFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
					
					///sum view//
					hpVpu_pOk_uOk<? echo $i; ?>=new Array();
					hpVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
					hpVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
					hpVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
					hpVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfileOk); ?>');
					hpVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUserOk); ?>');
					
					
				</script>
				<?		
						
			//////Move the img to center thumb//////////
				
				$aSize=getimagesize($_SERVER['DOCUMENT_ROOT'].$dir."/".$imgPho);
				//echo $_SERVER['DOCUMENT_ROOT'].$dir."/".$imgPhoto;
				//var_dump($aSize);
				
				if($aSize[0]>180){
					$moveLeft='margin-left:-'.(($aSize[0]-180)/2).'px;';
				}else{
					$moveLeft='';
				}
				
				
				if($aSize[1]>119){
					$moveTop='margin-top:-'.(($aSize[1]-119)/2).'px;';
				}else{
					$moveTop='';
					
				}			

echo '



<div class="slide">
'.$delPho.'
<div class="watermark" onclick="loadPhoto(hpFvpu_pOkuOk_n_ph_uN_pN'.$i.'); sumViewPhoto(hpVpu_pOk_uOk'.$i.');"><img src="img/playPhoto.png"/></div>
<div class="screenshot" style="overflow:hidden; height:119px; width:180px;"><div style="'.$moveLeft.'"><img src="'.$imgPho.'" /></div></div>
</div>


';

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
			<div class="watermark" onclick="$(\'#photoUploader\').show(\'slow\').fadeIn(\'slow\'); $(\'#extendedGallery\').fadeOut(\'slow\');"></div>
			<div class="screenshot" style="overflow:hidden;"><a href="javascript:;"><img src="img/photoprv1.png"/></a></div>
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
			<div class="screenshot" style="overflow:hidden;"><a href="javascript:;"><img src="img/photoprv.png"/></a></div>
			</div>
			';

		}
	}
	
	}//if session







require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/paginador.php');


}//if!=0


?>