<?php
class CLASS_IMAGE{
	
	#function ResizeImage($sFileSource = NULL, $sFileTarget = NULL, $iWidth = 100, $iHeight = 100, $sWaterMarkPath = NULL, $sPosition = 'C')
	
	function ResizeImage($sFileSource = NULL, $sFileTarget = NULL, $iWidth = 0, $iHeight = 0, $bRelscale = true)
	{
		$iHeight = @intval($iHeight);
		$iWidth = @intval($iWidth);
		
		// Recupero la info del archivo original
		if (!$aSourceInfo = @getimagesize($sFileSource)){
			return NULL;
		}

		if (!$aSourceInfo){
			return false;
		}
		
		// Creo una nueva imagen a partir de la original dependiendo del formato
		switch($aSourceInfo[2]){
			case 1: // GIF
				$gSource = imagecreatefromgif($sFileSource);
				$sFileTarget = $sFileTarget;
				break;
			case 2: // JPG
				$gSource = imagecreatefromjpeg($sFileSource);
				$sFileTarget = $sFileTarget;
				break;
			case 3: // PNG
				$gSource = imagecreatefrompng($sFileSource);
				$sFileTarget = $sFileTarget;
				break;

			default:
				return false;
		}
		
		list($iSourceWidth, $iSourceHeight) = $aSourceInfo;
		
		if ($iSourceWidth > $iWidth){
			$iTargetWidth  = $iWidth;
			$iTargetHeight = ($iTargetWidth * $iSourceHeight) / $iSourceWidth;
		}else{
			$iTargetWidth = $iSourceWidth;
			$iTargetHeight = $iSourceHeight;
		}
		
		// Calculo el alto
		if(empty($iHeight)){
			$iTargetHeight = $iTargetHeight;
		}else{
			if ($iTargetHeight > $iHeight){
				$iTargetHeight = $iHeight;
			}
		}
		
		// Creo ahora la imagen nueva con el ancho y alto deseado
		$gTarget = imagecreatetruecolor($iTargetWidth, $iTargetHeight);
		// Copio la imagen gSource in gTarget
		imagecopyresampled($gTarget, $gSource, 0, 0, 0, 0, $iTargetWidth, $iTargetHeight, imagesx($gSource), imagesy($gSource));

		switch($aSourceInfo[2]){
			case 1: // GIF
				if (is_null($sFileTarget)){
					header("Content-type: image/gif");
					imagegif($gTarget);
				}else{
					imagegif($gTarget, $sFileTarget);
				}
				break;

			case 2: // JPG
				if (is_null($sFileTarget)){
					header("Content-type: image/jpeg");
					imagejpeg($gTarget, '', 100);
				}else{
					imagejpeg($gTarget, $sFileTarget, 100);
				}
				break;

			case 3: // PNG
				if (is_null($sFileTarget)){
					header("Content-type: image/png");
					imagepng($gTarget);
				}else{
					imagepng($gTarget, $sFileTarget);
				}
				break;
		}#switch
		//
		imagedestroy($gTarget);
		imagedestroy($gSource);
		#
		
		/*
		if (!is_null($sWaterMarkPath))
		{
			CLASS_IMAGE::AddWaterMark($sFileTarget, $sWaterMarkPath, $sPosition);
		}
		*/
		
		return $sFileTarget;
	}#END ResizeImage()
	
	function CropImage($sFileSource = NULL, $sFileTarget = NULL, $iWidth = 100, $iHeight = 100)
	{
		$iHeight = @intval($iHeight);
		$iWidth = @intval($iWidth);
		
		// Recupero la info del archivo original
		if (!$aSourceInfo = @getimagesize($sFileSource)){
			return NULL;
		}

		if (!$aSourceInfo){
			return false;
		}
		
		// Creo una nueva imagen a partir de la original dependiendo del formato
		switch($aSourceInfo[2]){
			case 1: // GIF
				$gSource = imagecreatefromgif($sFileSource);
				$sFileTarget = $sFileTarget;
				break;
			case 2: // JPG
				$gSource = imagecreatefromjpeg($sFileSource);
				$sFileTarget = $sFileTarget;
				break;
			case 3: // PNG
				$gSource = imagecreatefrompng($sFileSource);
				$sFileTarget = $sFileTarget;
				break;

			default:
				return false;
		}
		
		list($iSourceWidth, $iSourceHeight) = $aSourceInfo;

		$iFinalPosicionX = ($iSourceWidth 	== $iWidth) 	? 0 : ($iSourceWidth/2)	-($iWidth/2);
		$iFinalPosicionY = ($iSourceHeight 	== $iHeight) 	? 0 : ($iSourceHeight/2)-($iHeight/2);

		// Creo ahora la imagen nueva con el ancho y alto deseado
		$gTarget = imagecreatetruecolor($iWidth, $iHeight);

		imagecopy($gTarget, $gSource, 0, 0, 0, 0, $iWidth, $iHeight);

		switch($aSourceInfo[2]){
			case 1: // GIF
				if (is_null($sFileTarget)){
					header("Content-type: image/gif");
					imagegif($gTarget);
				}else{
					imagegif($gTarget, $sFileTarget);
				}
				break;

			case 2: // JPG
				if (is_null($sFileTarget)){
					header("Content-type: image/jpeg");
					imagejpeg($gTarget, '', 100);
				}else{
					imagejpeg($gTarget, $sFileTarget, 100);
				}
				break;

			case 3: // PNG
				if (is_null($sFileTarget)){
					header("Content-type: image/png");
					imagepng($gTarget);
				}else{
					imagepng($gTarget, $sFileTarget);
				}
				break;
		}#switch
		//
		imagedestroy($gTarget);
		imagedestroy($gSource);
		
		return $sFileTarget;
	}#END CropImage()


	function CopyImage($sFileSource = NULL, $sDestino = NULL)
	{
		if (!$aSourceInfo = @getimagesize($sFileSource)){
			return NULL;
		}
		switch($aSourceInfo[2]){
			case 1: $sDestino .= '.gif'; break;
			case 2: $sDestino .= '.jpg'; break;
			case 3: $sDestino .= '.png'; break;
			default: return false;
		}
		if (copy($sFileSource, $sDestino))
		{
			return $sDestino;
		} 
		return NULL;
	}#END CopyImage()


	function AddWaterMark($sImagePath = NULL, $sImageWaterPath = NULL, $sPosition = 'C', $bRepeat = false)
	{
		//$sImageWaterPath = "water.png";
		$sNewImageWater = imagecreatefrompng($sImageWaterPath);

		// Recupero la info del archivo original
		if (!$aSourceInfo = @getimagesize($sImagePath)){
			return NULL;
		}

		switch($aSourceInfo[2]){
			case 1: // GIF
				$sNewImage = imagecreatefromgif($sImagePath);
				break;

			case 2: // JPG
				$sNewImage = imagecreatefromjpeg($sImagePath);
				break;

			case 3: // PNG
				$sNewImage = imagecreatefrompng($sImagePath);
				break;
		}#switch

		switch($sPosition)
		{
			case 'BR': case 'RB': $iDestinoX = imagesx($sNewImage)-imagesx($sNewImageWater); $iDestinoY = imagesy($sNewImage)-imagesy($sNewImageWater); break;
			case 'BL': case 'LB': $iDestinoX = 0; $iDestinoY = imagesy($sNewImage)-imagesy($sNewImageWater); break;
			case 'TR': case 'RT': $iDestinoX = imagesx($sNewImage)-imagesx($sNewImageWater); $iDestinoY = 0; break;
			case 'TL': case 'LT': $iDestinoX = 0; $iDestinoY = 0; break;
			case 'CR': case 'RC': $iDestinoX = imagesx($sNewImage)-imagesx($sNewImageWater); $iDestinoY = (imagesy($sNewImage)/2)-imagesy($sNewImageWater); break;
			case 'CL': case 'LC': $iDestinoX = 0; $iDestinoY = (imagesy($sNewImage)/2)-(imagesy($sNewImageWater)/2); break;
			case 'CT': case 'TC': $iDestinoX = (imagesx($sNewImage)/2)-(imagesx($sNewImageWater)/2); $iDestinoY = 0; break;
			case 'CB': case 'BC': $iDestinoX = (imagesx($sNewImage)/2)-(imagesx($sNewImageWater)/2); $iDestinoY = imagesy($sNewImage)-imagesy($sNewImageWater); break;
			case 'C': default : $iDestinoX = (imagesx($sNewImage)/2)-(imagesx($sNewImageWater)/2); $iDestinoY = (imagesy($sNewImage)/2)-(imagesy($sNewImageWater)/2); break;
		}
		imagecopy($sNewImage, $sNewImageWater, $iDestinoX, $iDestinoY, 0, 0, imagesx($sNewImageWater), imagesy($sNewImageWater));

		if ($bRepeat)
		{
			$iImageWaterLess = imagesx($sNewImage) - imagesx($sNewImageWater);
			$iDiferencia = ceil($iImageWaterLess / imagesx($sNewImageWater)/2);
			
			for($iIndex=1; $iIndex<=$iDiferencia; $iIndex++)
			{
				imagecopy($sNewImage, $sNewImageWater, $iDestinoX-(imagesx($sNewImageWater)*$iIndex), $iDestinoY, 0, 0, imagesx($sNewImageWater), imagesy($sNewImageWater));
				imagecopy($sNewImage, $sNewImageWater, $iDestinoX+(imagesx($sNewImageWater)*$iIndex), $iDestinoY, 0, 0, imagesx($sNewImageWater), imagesy($sNewImageWater));
			}
		}

		switch($aSourceInfo[2]){
			case 1: // GIF
				imagegif($sNewImage, $sImagePath);
				break;

			case 2: // JPG
				imagejpeg($sNewImage, $sImagePath, 100);
				break;

			case 3: // PNG
				imagepng($sNewImage, $sImagePath);
				break;
		}#switch

		imagedestroy($sNewImageWater);
		imagedestroy($sNewImage);
		#
		//return $sImagePath;
	}#END ResizeImage()

}#END CLASS_IMAGE
?>