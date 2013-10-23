<?php

function checaWidth($iVal,$iMedida,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big){
	$possibleWidth=floor($aSize[0]*$iVal/$aSize[1]);
	if($possibleWidth<$iMedida){
		$iVal=$iVal+10;
		checaWidth($iVal,$iMedida,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
	}else{
		$resize1=new ImageResize($imagen_origenTemp_b);
		$resize1->resizeHeight($iVal);
		$resize1->save($imagen_destinoTemp_big);
	}
}#checaWidth

function checaHeight($eVal,$iMedida,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big){
	$possibleHeight=floor($aSize[1]*$eVal/$aSize[0]);
	if($possibleHeight<$iMedida){
		$eVal=$eVal+10;
		checaHeight($eVal,$iMedida,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
	}else{
		$resize1=new ImageResize($imagen_origenTemp_b);
		$resize1->resizeWidth($eVal);
		$resize1->save($imagen_destinoTemp_big);		
	}	
}#checaHeight

function redisenar($iVal,$eVal,$iMedida,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big){

	$aSize=@getimagesize($imagen_origenTemp_b);
	
	if($aSize[0]>$aSize[1]){

		checaWidth($iVal,$iMedida,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
	}else{

		checaHeight($eVal,$iMedida,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
	}// if size

}#redisenar
require_once $_SERVER["DOCUMENT_ROOT"].'/traza.php';
$uploaddir = 'uploadsTemp/';
$fileName=$_FILES['userfile']['name'];

if(isset($_SESSION['iSMuIdKey'])){
	$iIdUSer				 =$_SESSION['iSMuIdKey'];
 	$sNamePhotoUser   	     ='photoPerfil_SM_'.$iIdUSer;
 	$sNamePhotoUserMedium    ='medium_photoPerfil_SM_'.$iIdUSer;
 	$sNamePhotoUserSmall   	 ='small_photoPerfil_SM_'.$iIdUSer;
 	
    #si identifica al user realiza el proceso
	$uploadfile =  basename($_FILES['userfile']['name']);
	$uploadfile =$uploaddir .$uploadfile;
	
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	 
	  		require_once("imageResize/imageresize.class.php");
			
	  		#Path Destinos
			$imagen_origenTemp_b 	= 'uploadsTemp/'.$fileName;	  		
			$imagen_origenTemp_m 	= 'uploadsTemp/'.$fileName;	
			$imagen_origenTemp_s 	= 'uploadsTemp/'.$fileName;	  		
	
			#Photo Big temporal ::uploads
			$imagen_destinoTemp_big	= '../photoGeneral/'.$fileName;
			$iMedidaBig=180;
			#Redisena tamaño Img
			$aSize=@getimagesize($imagen_origenTemp_b);
			$iVal=$iMedidaBig;$eVal=$iMedidaBig;
			redisenar($iVal,$eVal,$iMedidaBig,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
			
			
			/*
			if($aSize[0]>$aSize[1]){
				function checaWidth($iVal,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big){
					$possibleWidth=floor($aSize[0]*$iVal/$aSize[1]);
					if($possibleWidth<180){
						$iVal=$iVal+10;
						checaWidth($iVal,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
					}else{
						$resizeB=new ImageResize($imagen_origenTemp_b);
						$resizeB->resizeHeight($iVal);
						$resizeB->save($imagen_destinoTemp_big);
					}
				}
				
				checaWidth($iVal,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
				
			}else{
				function checaHeight($eVal,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big){
					$possibleHeight=floor($aSize[1]*$eVal/$aSize[0]);
					if($possibleHeight<180){
						$eVal=$eVal+10;
						checaHeight($eVal,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
					}else{
						$resizeB=new ImageResize($imagen_origenTemp_b);
						$resizeB->resizeWidth($eVal);
						$resizeB->save($imagen_destinoTemp_big);
					}	
				}
				
				checaHeight($eVal,$aSize,$imagen_origenTemp_b,$imagen_destinoTemp_big);
				
			}// if size
			
			#
			
			
			
			$resizeB=new ImageResize($imagen_origenTemp_b);#Get Original Img
			$resizeB->resizeWidthHeight(180, 180);#Big Img
			$resizeB->save($imagen_destinoTemp_big);
			*/
			
			#Photo Medium temporal ::uploads
			$imagen_destinoTemp_medium	= '../photoGeneral/medium/'.$fileName;
			$iMedidaMedium=150;
			#Redisena tamaño Img
			$aSize=@getimagesize($imagen_origenTemp_m);
			$iVal=$iMedidaMedium;$eVal=$iMedidaMedium;
			redisenar($iVal,$eVal,$iMedidaMedium,$aSize,$imagen_origenTemp_m,$imagen_destinoTemp_medium);
			/*
			$resizeM=new ImageResize($imagen_origenTemp_m);#Get Original Img
			$resizeM->resizeWidthHeight(150, 150);#Medium Img
			$resizeM->save($imagen_destinoTemp_medium);
			*/
			
			
			
			
			#Photo Small temporal ::uploads
			$imagen_destinoTemp_small	=  '../photoGeneral/small/'.$fileName;
			/*$resizeS=new ImageResize($imagen_origenTemp_s);
			$resizeS->resizeWidthHeight(50, 50);#Small Img
			$resizeS->save($imagen_destinoTemp_small);*/
			
			$iMedidaChica=50;
			#Redisena tamaño Img
			$aSize=@getimagesize($imagen_origenTemp_s);
			$iVal=$iMedidaChica;$eVal=$iMedidaChica;
			redisenar($iVal,$eVal,$iMedidaChica,$aSize,$imagen_origenTemp_s,$imagen_destinoTemp_small);
			
			
			
		
				///////////Centers the preview img//////
				$aSize=@getimagesize($imagen_destinoTemp_big);
				//echo $aSize[0],$aSize[1];
				if($aSize[0]>206){
					$moveLeft='margin-left:-'.(($aSize[0]-206)/2).';';
				}else{
					$moveLeft='';
				}
				
				
				if($aSize[1]>180){
					$moveTop='margin-top:-'.(($aSize[1]-180)/2).';';
				}else{
					$moveTop='';
				}
			
			
			
			
			
			
			$rand = rand (1,10000);
			#renombra la img Big p/ identificarla con el user
			if (!rename($imagen_destinoTemp_big,'../photoGeneral/big/'.$sNamePhotoUser)) {
					rename($imagen_destinoTemp_big,'../photoGeneral/big/'.$sNamePhotoUser);
			}
			#renombra la img Medium p/ identificarla con el user
			if (!rename($imagen_destinoTemp_medium,'../photoGeneral/medium/'.$sNamePhotoUserMedium)) {
					rename($imagen_destinoTemp_medium,'../photoGeneral/medium/'.$sNamePhotoUserMedium);
			}
			#renombra la img Small p/ identificarla con el user
			if (!rename($imagen_destinoTemp_small,'../photoGeneral/small/'.$sNamePhotoUserSmall)) {
					rename($imagen_destinoTemp_small,'../photoGeneral/small/'.$sNamePhotoUserSmall);
			}
			echo '<div style="'.$moveLeft.'"><img class="add_img" id="add_img" src="photoGeneral/big/'.$sNamePhotoUser.'?noc='.$rand.'"></div>';		
			//echo '<img class="add_img" id="add_img" src="photoGeneral/big/'.$sNamePhotoUser.'?noc='.$rand.' height="260">';		
			
	} else {
	  		echo'Error Uploaded Photo';
	}
}# no pude identificar al user
else echo 'Error Uploaded Photo';



?>
