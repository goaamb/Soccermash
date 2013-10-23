<? 

 ////translation///////
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }		

	global $_IDIOMA;

$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');
				
				
				$iFv=$_POST['iFvpu_pOkuOk_n_ph_uN_pN'];
				
				$idProfile=addslashes(base64_decode($iFv[2]));
				$idUser=addslashes(base64_decode($iFv[3]));
				$idProfileOk=addslashes(base64_decode($iFv[4]));
				$idUserOk=addslashes(base64_decode($iFv[5]));
				$userName=addslashes(base64_decode($iFv[8]));
				$profileName=addslashes(base64_decode($iFv[9]));
				$editProf=addslashes(base64_decode($iFv[10]));
				
				
				//name:
				echo '<div class="titVideo">'.addslashes(base64_decode($iFv[6])).'</div>';
				?>
				
				<script type="text/javascript">
					///ratesVote///
					iPuV=new Array();
					iPuV.push('<? echo base64_encode($idProfile); ?>');
					iPuV.push('<? echo base64_encode($idUser); ?>');
					iPuV.push('<? echo base64_encode(0); ?>');
				</script>
				
				<div class="onright"><a href="javascript:;" onclick="hide_me('videoPlayer'); $('#modules').css('margin-top','0px');"><? print $_IDIOMA->traducir('Close'); ?></a></div> 
				
				
				<?
				$sSiz=getimagesize(addslashes(base64_decode($iFv[0])));
				
				if($sSiz[0]>588){
					$widthTotal='width=\'588\'';
					$imgTop=($sSiz[1]*588/$sSiz[0])/2;
				}else{
					$widthTotal='';
					$moveRi=(589-$sSiz[0])/2;
					$moveRight='padding-left:'.$moveRi.'px;';		
					$imgTop=$sSiz[1]/2;
				}
				
				if($sSiz[1]>700 && $sSiz[0]<588){
					$heightTotal='height=\'700\'';
					$imgTop=700/2;
				}else{
					$heightTotal='';
				}
				
				
				


///////////////get all photos to navigate with the arrows/////////////
	
	$pho=new Photo();
	
///////////////////////////Select photos from user//////////////////////////////////////////////
	if(!isset($iFv[12])){
		$registros=$pho->selectPhoto($idProfile,'*',"idUser='$idUser'","id desc");
		
	}else{
		
		$sStr=base64_decode($iFv[12]);
		$registros=$pho->selectPhoto(2,'*',"($sStr) AND active='1'","name");
		/*var_dump($sStr);
		var_dump($registros);
		die();*/
	}
	if($registros[0]!=''){
	
	
		$i=0;
		foreach($registros as $registro){
			
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
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($editProf); ?>');
				pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($registro->idUser); ?>');
				<? if(isset($iFv[12])){
				?>
					 pFvpu_pOkuOk_n_ph_uN_pN<? echo $i; ?>.push('<? echo base64_encode($sStr); ?>');
				<?
				}
				?>	
				///sum view//
				pVpu_pOk_uOk<? echo $i; ?>=new Array();
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($registro->id); ?>');
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfile); ?>');
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUser); ?>');
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idProfileOk); ?>');
				pVpu_pOk_uOk<? echo $i; ?>.push('<? echo base64_encode($idUserOk); ?>');
				
				
				
				
			</script>
				
				
				
				
				<?
				
				if($registro->id == addslashes(base64_decode($iFv[1]))){
				
					$ee = $i+1; 
					$aa = $i-1;
					
				}
				
				
				$i++;
				}//for
				}//if
				?>
				
									
				</script>
				 
				
				<div style="position:absolute; z-index:1; margin-left:280px; margin-top:150px;"><img src="img/indicator.gif" width="16" height="16" /></div>
				
				<?
				if($ee<$i){
				?>
				<div style="position:absolute; z-index:3; top:<? echo $imgTop; ?>px; left:576px;"><img onclick="loadPhoto(pFvpu_pOkuOk_n_ph_uN_pN<? echo $ee; ?>); <? if(isset($iFv[12])){ ?>upPhotoPlayer();<? } ?>"   src="img/rgtOff.png"/></div>
				<?
				}
				?>
				
				<?
				if($aa>=0){ 
				?>
					<div style="position:absolute; left:556px; z-index:3; top:<? echo $imgTop; ?>px;"><img onclick="loadPhoto(pFvpu_pOkuOk_n_ph_uN_pN<? echo $aa; ?>); <? if(isset($iFv[12])){ ?>upPhotoPlayer();<? } ?>" src="img/lftOff.png"/></div>
				<?
				}
				?>
				<div id="imgPhoto" style="position:relative; z-index:2; <? echo $moveRight; ?>">
				<img src="<? echo addslashes(base64_decode($iFv[0])); ?>?nocache=<? echo rand(20); ?>" <? echo $widthTotal; ?> <? echo $heightTotal; ?> />
				</div>
				 	
				
				
				
				
				<?php
				require_once('photoVotesViews.php');
				?>


