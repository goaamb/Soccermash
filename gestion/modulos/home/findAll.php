<?
$dir='/soccermashTest3';
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/video/videoClass.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/photo/photoClass.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/profile/profileClass.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/modulos/institution/institutionClass.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/share/clases/lib_util.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/share/clases/nucleo/funciones.php');

	////translation///////
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }		

global $_IDIOMA;

///////////////Check if the string is a valid character//////////
function stisOK($val)
{
		$str=explode(' ',addslashes($val));
		$valor=' ';
		
	foreach ($str as $st){
	
		if(strlen($st)>3){
			//echo $st,' es mayor';	
			//if ($st!='las' && $st!='los' && $st!='les' && $st!='the') {	
				$valor.= $st.' ';
		//	}//if
		
		}//if len
	}//for			
	$valor=trim($valor);
	if($valor==''){
		$valor=' ';
	}
	return $valor;
 }//func
 
 
////////////////////// 
    $val=addslashes($_POST['strgToSearch']);
	$valor=stisOK($val);	
 //////////////////////////////////

if(!empty($_POST['dDate']) && !empty($_POST['dMonth'])  && !empty($_POST['dYear'])){
	$_POST['endcontdatSearch'] = $_POST['dDate'].'/'.$_POST['dMonth'].'/'.$_POST['dYear'];
}

if(!empty($_POST['dDate2']) && !empty($_POST['dMonth2'])  && !empty($_POST['dYear2'])){
	$_POST['endcontdatSearch2'] = $_POST['dDate2'].'/'.$_POST['dMonth2'].'/'.$_POST['dYear2'];
}
 
 
 


//////////////////////////////////////////////////////////////////////min-height: 1500px;
			   

?>
							
							
							<script type="text/javascript"> 
								window.top.window.$('#results').fadeIn('slow');
								window.top.window.$('#centralcolumn').css('min-height','1450px');
								window.top.window.$('#modules').hide();
								window.top.window.$('#wall').hide();
								window.top.window.$('#results').html('<span><a href="javascript:;" onclick="$(\'#results\').fadeOut(\'slow\'); $(\'#videoPlayer\').hide(); $(\'#modules\').show(); $(\'#centralcolumn\').css(\'min-height\',\'0px\'); window.top.window.$(\'#modules\').show(); window.top.window.$(\'#wall\').show();" title="<? print $_IDIOMA->traducir('Close search results'); ?>"><? print $_IDIOMA->traducir('Close'); ?></a></span><h2><? if(addslashes($_POST['storeSelectProfile'])==3){print $_IDIOMA->traducir('Multimedia');}else{ print $_IDIOMA->traducir('Your search results for');} ?>: <? echo $valor; ?></h2>');
							</script>
						
						<?


$cant=15;
if(empty($_POST['storeSelectADVProfile'])){
	
	///////////busca por texto/////////////
	//if(empty($_POST['strgToSearch'])){
	
					
	
	
	
	
	
	
	//}else{//////////////check if searchs people, institutions or media/////////
		
			
			
			
			if(!empty($_POST['storeSelectProfile'])){	
			
				
					////get string///		
					$str=explode(' ',$valor);
					$sStr='';
					$valArr=sizeof($str);
					$i=1;
				
				
				
					if(addslashes($_POST['storeSelectProfile'])==1)
					{
						////////search people text///////////////
					
						require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_People.php");
			
						
				
				}elseif(addslashes($_POST['storeSelectProfile'])==2){
				
				
				
		           ////search institution text///////////
					
					require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Institution.php");
					
					
					
				
				
				}elseif(addslashes($_POST['storeSelectProfile'])==3)
				
						
				
				{
				////////search multimedia text///////////////

						
				if(empty($_POST['photo']) && !empty($_POST['video'])){
					$cant=15;
				}elseif(!empty($_POST['photo']) && empty($_POST['video'])){
					$cant=15;
				}else{
					$cant=6;	
				}	
						
				//check if both are selected///////
				if(!empty($_POST['photo']) && !empty($_POST['video'])){
					$both=true;
				}else{
					$both=0;
				}
				
			
				
				///////////VIDEOS/////////////
				if(empty($_POST['photo']) || $both==true)
				{
				
				
					
						//string//
						foreach ($str as $st){
						
						if($i<$valArr){
							$or=" OR ";
						}else{
							$or='';
						}
						
						//if($st!='-' && $st!='de' && $st!='of' && $st!='for') //st.lenght > 2
						
							$sStr=$sStr . "name LIKE '%".$st."%' OR tagsVideo LIKE '%".$st."%'".$or;
							$i++;
						
					
					}
					
					
					
					$pro=new Video();
					
					//////////set the pagination////////////////////
					if(!empty($_POST['pageNum'])){
						$page=addslashes($_POST['pageNum']);
					}else{
						$page=1;
					} 
					/////////////vars/////////////////////////////
					$aVar=array();
					
					if(!empty($_POST['photo'])){
						$aVar[3]=addslashes($_POST['photo']);
					}else{
						$aVar[3]='';
					}
					if(!empty($_POST['video'])){
						$aVar[4]=addslashes($_POST['video']);
					}else{
						$aVar[4]='';
					}
					if(!empty($_POST['strgToSearch'])){
						$aVar[5]=addslashes($_POST['strgToSearch']);
					}else{
						$aVar[5]='';
					}
					if(!empty($_POST['storeSelectProfile'])){
						$aVar[6]=addslashes($_POST['storeSelectProfile']);
					}else{
						$aVar[6]='';
					}
					if(!empty($_POST['orderVideo'])){
						$orderVid=addslashes($_POST['orderVideo']);
						$aVar[7]=$orderVid;
						if($orderVid=="voteValue"){
							$bla=" and idProfile in ('2','3','5','6')";
						}
						else{
							$bla='';
						}
					}else{
						$aVar[7]='';
						$orderVid='id';
					}
					/*if(!empty($_POST['mviewed'])){
						$aVar[8]='1');
						$mViewed='si';
					}else{
						$aVar[8]='';
						$mViewed='no';
					}*/
					
					
					
					/////////number of adv profile//////////////////
					$storeProfile=addslashes($_POST['storeSelectProfile']);
					//////////Pagination/////////////////////////////
					$init=$pro->paginateSearchVideos(0,$page,"WHERE ($sStr) $bla AND active='1' order by $orderVid desc",$aVar,$cant);
					////////get the values from pagination////////////
					$ini=explode(',',$init);
					$inicio=$ini[0];
					$paginado=$ini[1];
					//////////////////////////////////////////
					
					
					$registros=$pro->selectVideo(2,'*',"($sStr) $bla AND active='1'","$orderVid desc LIMIT $inicio,$cant");
					
					
					if($registros[0]!=''){
					//session comprobation//
					if(!empty($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
						$editProfile=true;
					}else{
						$editProfile=0;
					}
					
					 if(!empty($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
								 $idUserVisiting=$_SESSION["iSMuIdKey"];
					 }else{
						 $idUserVisiting=$_SESSION["idUserVisiting"];
					 }
					 
					 if(!empty($_SESSION['idProfileVisiting']) || $_SESSION['idProfileVisiting']==0 || $_SESSION['idProfileVisiting']==$_SESSION['iSMuProfTypeKey']){
						 $idProfileVisiting=$_SESSION["iSMuProfTypeKey"];
					 }else{
						 $idProfileVisiting=$_SESSION["idProfileVisiting"];
					 }
					
					
						////create arrays for load video//////////
						$i=0;
						foreach($registros as $registro){
						
							$imgVid='photoVideo/small_'.$registro->photo;
				
							////////check if has file or youtube/////////
							$filePath='http://c590104.r4.cf2.rackcdn.com/';
							
							if($registro->fileName!=''){
								$file=$filePath.$registro->fileName;
							}else{
								$file=$registro->youtube;
							}
										
						?>
						
						<script type="text/javascript">
						 <!-- ////////////////////// VIDEOS ////////////////////////////// -->
					    	
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>=new Array();
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($file); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->name); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProfile); ?>');
							window.top.window.iFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
						
							///sum view//
							window.top.window.iVpu_pOk_uOk<? echo $i; ?>=new Array();
							window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
							window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
							window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
							window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
							window.top.window.iVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
							
							///ratesVote///
							window.top.window.rPuV<? echo $i; ?>=new Array();
							window.top.window.rPuV<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
							window.top.window.rPuV<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
							window.top.window.rPuV<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
							
						
						</script>
						
						<?
						$i++;
						}
						?>
						
						<script type='text/javascript'>
							window.top.window.$('#results').fadeIn('slow');
							window.top.window.$('#results').html(window.top.window.$('#results').html()+'<br/><div class="titVideo" id="buttonColor" onclick="setSearchMultiVid();">VIDEOS</div><ul id="condition"><li></li></ul><div><a class="Multmed firstMmd <? if($orderVid=='id'){echo 'active';} ?>" href="javascript:;" onclick="$(\'#theOrderVid\').val(\'id\'); setSearchMultiVid();"><?php print $_IDIOMA->traducir('Lastest videos');?></a> <a class="Multmed <? if($orderVid=='voteValue'){echo 'active';} ?>" href="javascript:;" onclick="$(\'#theOrderVid\').val(\'voteValue\'); setSearchMultiVid();"><?php print $_IDIOMA->traducir('Most rated');?></a> <a class="Multmed <? if($orderVid=='visit'){echo "active";} ?>" href="javascript:;" onclick="$(\'#theOrderVid\').val(\'visit\'); setSearchMultiVid();"><?php print $_IDIOMA->traducir('Most viewed');?></a> <a class="Multmed <? if($orderVid=='comment'){echo "active";} ?>" href="javascript:;" onclick="$(\'#theOrderVid\').val(\'comment\'); setSearchMultiVid();"><?php print $_IDIOMA->traducir('Most commented');?></a></div><? $i=0;		
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('id,photo,name,lastName,profileId,dayOfBirthDay,countryName,destacado',"id=".$registro->idUser);
								
								if(!empty($phot[0]->dayOfBirthDay)){
									$brd=explode('-',$phot[0]->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								if($phot[0]->profileId<7){
									
									
									$club=$prof->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->idUser."");
									
									if($phot[0]->profileId==2){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}
									$posP=namePosition($club[0]->position);
									$clubB='Club: '.$club[0]->clubName.$club[0]->otherClub;																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='';
									$posP='';
								}
								
														 
								
							echo '<div class="itemResult" onmouseover="subir2('.$registro->id.');" onmouseout="bajar2('.$registro->id.');" style="height: 185px;"><div id="imagen'.$registro->id.'" style="height:145px; overflow:hidden;"><a href="#"><img onclick="loadVideo(iFvpu_pOkuOk_n_ph_uN_pN'.$i.'); upPlayer(); sumView(iVpu_pOk_uOk'.$i.'); ratesVote(rPuV'.$i.');" width="180" height="119" src="photoVideo/small_'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name).'" /></a></div><h4 onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$phot[0]->id."-".Utilidades::normalizarTexto($phot[0]->name." ".$phot[0]->lastName).'\\\'">'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$phot[0]->name.' '.$phot[0]->lastName).'('.edad($phot[0]->dayOfBirthDay).')</h4><ul><li>'.nameProfile($phot[0]->profileId).'</li>'.$ecDD.'<li>'.$posP.'</li><li>'.$phot[0]->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$clubB).'</li></ul></div>';$i++;}//for?>');
							window.top.window.$('#results').html(window.top.window.$('#results').html()+"<div class='paginador'><? echo $paginado; ?></div><hr style='border:thin #0c8141 solid;'/>");
							window.top.window.eraseChecked();
						</script>
					<?
					
					
					
					
					}else{
					
						echo "
						<script type='text/javascript'>
							window.top.window.$('#results').html(window.top.window.$('#results').html()+'No results for videos ');
						</script>
						";
					
					
					}//if
				
				
				
				
				
				}//Video
				
				
				
				
				
				
				
				///////////PHOTOS/////////////
				if(empty($_POST['video']) || $both==true)
				{
				
				
						
						//string//
						foreach ($str as $st){
						
						if($i<$valArr){
							$or=" OR ";
						}else{
							$or='';
						}
						
						//if($st!='-' && $st!='de' && $st!='of' && $st!='for') //st.lenght > 2
							$sStr='';
							$sStr=$sStr . "name LIKE '%".$st."%' OR tagsPhoto LIKE '%".$st."%'".$or;
							$i++;
						
					
					}
					
					
					
					$pho=new Photo();
					
					//////////set the pagination////////////////////
					if(!empty($_POST['pageNumPhoto'])){
						$pages=addslashes($_POST['pageNumPhoto']);
					}else{
						$pages=1;
					} 
					/////////////vars/////////////////////////////
					$aVar=array();
					
					if(!empty($_POST['photo'])){
						$aVar[3]=addslashes($_POST['photo']);
					}else{
						$aVar[3]='';
					}
					if(!empty($_POST['video'])){
						$aVar[4]=addslashes($_POST['video']);
					}else{
						$aVar[4]='';
					}
					if(!empty($_POST['strgToSearch'])){
						$aVar[5]=addslashes($_POST['strgToSearch']);
					}else{
						$aVar[5]='';
					}
					if(!empty($_POST['storeSelectProfile'])){
						$aVar[6]=addslashes($_POST['storeSelectProfile']);
					}else{
						$aVar[6]='';
					}
					
					
					
					/////////number of adv profile//////////////////
					$storeProfile=addslashes($_POST['storeSelectProfile']);
					//////////Pagination/////////////////////////////
					$init=$pho->paginateSearchPhotos(0,$pages,"WHERE ($sStr) AND active='1' order by name",$aVar,$cant);
					////////get the values from pagination////////////
					$ini=explode(',',$init);
					$inicio=$ini[0];
					$paginado=$ini[1];
					//////////////////////////////////////////
					
					
					$registros=$pho->selectPhoto(2,'*',"($sStr) AND active='1'","name LIMIT $inicio,$cant");
					
					
					if($registros[0]!=''){
					//session comprobation//
					if(!empty($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
						$editProfile=true;
					}else{
						$editProfile=0;
					}
					
					 if(!empty($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
								 $idUserVisiting=$_SESSION["iSMuIdKey"];
					 }else{
						 $idUserVisiting=$_SESSION["idUserVisiting"];
					 }
					 
					 if(!empty($_SESSION['idProfileVisiting']) || $_SESSION['idProfileVisiting']==0 || $_SESSION['idProfileVisiting']==$_SESSION['iSMuProfTypeKey']){
						 $idProfileVisiting=$_SESSION["iSMuProfTypeKey"];
					 }else{
						 $idProfileVisiting=$_SESSION["idProfileVisiting"];
					 }
					
					
						////create arrays for load photo//////////
						$i=0;
						foreach($registros as $registro){
						
							$imgPho='photoPhoto/'.$registro->photo;
				
							$filePath='http://c577808.r8.cf2.rackcdn.com/';
							$file=$filePath.$registro->photo;
							
										
						?>
						
						<script type="text/javascript">
						 <!-- ////////////////////// PHOTOS ////////////////////////////// -->
					    	
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>=new Array();
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($file); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->name); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->photo); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProfile); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
							window.top.window.pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($sStr); ?>');
							
							
						
							///sum view//
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>=new Array();
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfileVisiting); ?>');
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUserVisiting); ?>');
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
							window.top.window.pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
							
						
						</script>
						
						<?
						$i++;
						}
						?>
						
						<script type='text/javascript'>
							window.top.window.$('#results').fadeIn('slow');
							window.top.window.$('#results').html(window.top.window.$('#results').html()+'<br/><div class="titVideo" id="buttonColor" onclick="setSearchMultiPho();">PHOTOS</div><ul id="condition"><li></li></ul><? $i=0;		
							foreach($registros as $registro){
							
							$prof=new Profile();
							$phot=$prof->selectGen('id,photo,name,lastName,profileId,dayOfBirthDay,countryName,destacado',"id=".$registro->idUser);
								
								if(!empty($phot[0]->dayOfBirthDay)){
									$brd=explode('-',$phot[0]->dayOfBirthDay);
								}else{
									$brd[0]=''; $brd[1]=''; $brd[2]='';      
								}
								
								if($phot[0]->profileId<7){
									
									
									$club=$prof->selectProfile(2,'clubName,otherClub,position,endingContractDate',"idUser=".$registro->idUser."");
									
									if($phot[0]->profileId==2){
										$ecDD='<li>ECD: '.$club[0]->endingContractDate.'</li>';
									}
									$posP=namePosition($club[0]->position);
									$clubB='Club: '.$club[0]->clubName.$club[0]->otherClub;																		
								}else{
									$ecDD='<li>BRD: '.$brd[2].'/'.$brd[1].'/'.$brd[0].'</li>';
									$clubB='';
									$posP='';
								}
								
							
								//////////Centers the IMG///////////
								$a=moveImg(180,180,$_SERVER['DOCUMENT_ROOT'].$dir."/photoPhoto/".$registro->photo);
								//echo $_SERVER['DOCUMENT_ROOT'].$dir."/photoGeneral/big/".$phot[0]->photo;
								$moveLeft=$a[0];
								$moveTop=$a[1];	
								 
								
							echo '<div class="itemResult" onmouseover="subir('.$registro->id.');" onmouseout="bajar('.$registro->id.');" ><div id="imagen'.$registro->id.'" style="height:190px; overflow:hidden;"><a href="#"><img '.$moveLeft.' onclick="loadPhoto(pFvpu_pOkuOk_n_ph_uN_pN'.$i.'); upPhotoPlayer(); sumViewPhoto(pVpu_pOk_uOk'.$i.');"  src="photoPhoto/'.$registro->photo.'" title="'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$registro->name).'" /></a></div><h4 onclick="location.href=\\\'/'.$_IDIOMA->traducir("user")."/".$phot[0]->id."-".Utilidades::normalizarTexto($phot[0]->name." ".$phot[0]->lastName).'\\\'">'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$phot[0]->name.' '.$phot[0]->lastName).'('.edad($phot[0]->dayOfBirthDay).')</h4><ul><li>'.nameProfile($phot[0]->profileId).'</li>'.$ecDD.'<li>'.$posP.'</li><li>'.$phot[0]->countryName.'</li><li>'.str_replace(array("'","\n","\r"),array("\\'"," "," "),$clubB).'</li></ul></div>';$i++;}//for?>');
							window.top.window.$('#results').html(window.top.window.$('#results').html()+"<div class='paginador'><? echo $paginado; ?></div>");
							window.top.window.eraseChecked();
						</script>
					<?
					
					
					
					
					}else{
					
						echo "
						<script type='text/javascript'>
							window.top.window.$('#results').html(window.top.window.$('#results').html()+' No results for photos');
						</script>
						";
					
					
					}//if
				
				
				
				
				
				}//Photo
				
				
				
				
				
				
				//Search ALL	
				}elseif(addslashes($_POST['storeSelectProfile'])==4){
				
					require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/home/searchAll.php');
				
				}//Search all
			
			
			}else{///select type
				
			
			}//
	
	//}
	




}else{
  /////////Advanced search for people/////////
  
					
			////if player///////
			if(addslashes($_POST['storeSelectADVProfile'])==1){
			
				
				
				
					require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Players.php");
 
 
 
 
 
 
 			//////////////////Coach ADV search/////////////////////////////
 			}elseif(addslashes($_POST['storeSelectADVProfile'])==2){
			
					
						require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Coachs.php");
					
										
				
			
			
			//////////////////Agent ADV search/////////////////////////////
 			}elseif(addslashes($_POST['storeSelectADVProfile'])==3){
			
					
				
					require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Agents.php");
			
			
			
			
			
			
			
			//////////////SCOUT Adv Search/////////////////////////////
			}elseif(addslashes($_POST['storeSelectADVProfile'])==4){
				
				require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Scoutings.php");
				
				
 
 			//////////////LAWYER Adv Search/////////////////////////////
			}elseif(addslashes($_POST['storeSelectADVProfile'])==5){
				
			
			
				require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Lawyers.php");
				
								
 
 			//////////////Health Adv Search/////////////////////////////
			}elseif(addslashes($_POST['storeSelectADVProfile'])==6){
				
				
				require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Healths.php");
					
			
			
			//////////////Director Adv Search/////////////////////////////
			}elseif(addslashes($_POST['storeSelectADVProfile'])==7){
				
				
				require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Directors.php");
				
				
			
			//////////////FAN Adv Search/////////////////////////////
					
					}elseif(addslashes($_POST['storeSelectADVProfile'])==8){
				
							require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Fans.php");
				
					
					
			
			
			//////////////Journalist Adv Search/////////////////////////////
					
					}elseif(addslashes($_POST['storeSelectADVProfile'])==9){
				
				
						require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/findAll_Journalists.php");
				
						
 
 			}//end journalist
 
 
 
 }//advanced
  
?>