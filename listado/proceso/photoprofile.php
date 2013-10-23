<?php

require_once 'goaamb/web/json.php';

$json = new JSON ();

$dirgo = "photoGeneral/";

$dirgf = "photoGeneral/big/";

$dirgt = "photoGeneral/small/";

if (function_exists ( $_POST ["__a"] )) {
	
	call_user_func ( $_POST ["__a"], $json );

} else {
	
	$json->add ( "error", "'La accion no existe'" );

}

$json->printJSON ();

function revisarImagen($json) {
	
	if (isset ( $_POST ["imagedir"] )) {
		$ml = ModelLoader::crear ( "ax_imagenConfiguracion" );
		$imgdir = $_POST ["imagedir"];
		$basedir = $_SERVER ["DOCUMENT_ROOT"] . "/photoGeneral/";
		
		$archivo = $basedir . $imgdir;
		if (! is_file ( $archivo )) {
			copy ( $basedir . "big/" . $imgdir, $archivo );
		}
		if (is_file ( $archivo )) {
			
			list ( $w, $h, $type, $attr ) = getimagesize ( $archivo );
			
			$json->add ( "w", $w );
			
			$json->add ( "h", $h );
			if (! $ml->buscarPorCampo ( array ("nombre" => $imgdir ) )) {
				$ml->iw = $w;
				$ml->ih = $h;
				$ml->cw = 50;
				$ml->ch = 50;
				$ml->ct = 0;
				$ml->cl = 0;
			}
			$json->add ( "conf", $ml->aJSON ( array ("id", "nombre" ) ) );
		}
		
		$archivo = $basedir . $imgdir;
		
		if (is_file ( $archivo )) {
			
			list ( $w, $h, $type, $attr ) = getimagesize ( $archivo );
			
			$json->add ( "wf", $w );
			
			$json->add ( "hf", $h );
		
		}
		
		$archivo = $basedir . "small/small_$imgdir";
		
		if (is_file ( $archivo )) {
			
			list ( $w, $h, $type, $attr ) = getimagesize ( $archivo );
			
			$json->add ( "wt", $w );
			
			$json->add ( "ht", $h );
		
		}
		
		$json->add ( "imgdir", "'$imgdir'" );
	
	}

}

function crearImagen1($json) {
	
	$iIdUSer = $_SESSION ['iSMuIdKey'];
	
	$sNamePhotoUser = 'photoPerfil_SM_' . $iIdUSer;
	
	$imgdir = $sNamePhotoUser;
	
	if (isset ( $_POST ["imagedir"] ) && is_file ( $dirgo . $_POST ["imagedir"] )) {
		
		$imgdir = $_POST ["imagedir"];
	
	}
	
	if (isset ( $_FILES ) && isset ( $_FILES ["imagen-real"] ) && is_file ( $_FILES ["imagen-real"] ["tmp_name"] )) {
		
		$file = $_FILES ["imagen-real"];
		
		$jpg = array ("image/jpeg", "image/pjpeg" );
		
		$png = array ("image/x-png", "image/png" );
		
		$gif = array ("image/gif" );
		
		$validmime = array_merge ( $jpg, $png, $gif );
		
		if (array_search ( strtolower ( $file ["type"] ), $validmime ) !== false) {
			
			$archivo = "photoGeneral/" . $sNamePhotoUser;
			
			copy ( $file ["tmp_name"], $archivo );
			$tipo = "jpg";
			if (array_search ( strtolower ( $file ["type"] ), $jpg ) !== false) {
				$image = imagecreatefromjpeg ( $archivo );
				$tipo = "jpg";
			} elseif (array_search ( strtolower ( $file ["type"] ), $png ) !== false) {
				$image = imagecreatefrompng ( $archivo );
				$tipo = "png";
			} elseif (array_search ( strtolower ( $file ["type"] ), $gif ) !== false) {
				$image = imagecreatefromgif ( $archivo );
				$tipo = "gif";
			}
			
			if (image) {
				
				$w = imagesx ( $image );
				
				$h = imagesy ( $image );
				
				$wf = 300;
				
				$hf = 300;
				
				$wi = $w;
				
				$hi = $h;
				
				if ($wi > $wf) {
					
					$wi = $wf;
					
					$hi = ceil ( $hi * $wf / $w );
				
				}
				
				if ($hi > $hf) {
					
					$wi = ceil ( $wi * $hf / $hi );
					
					$hi = $hf;
				
				}
				
				$json->add ( "w", $w );
				
				$json->add ( "h", $h );
				
				$json->add ( "wf", $wi );
				
				$json->add ( "hf", $hi );
				
				$imagex = imagecreatetruecolor ( $wi, $hi );
				
				imagecopyresampled ( $imagex, $image, 0, 0, 0, 0, $wi, $hi, $w, $h );
				switch ($tipo) {
					case "png" :
						imagepng ( $imagex, "photoGeneral/$sNamePhotoUser" );
						break;
					case "gif" :
						imagegif ( $imagex, "photoGeneral/$sNamePhotoUser" );
						break;
					default :
						imagejpeg ( $imagex, "photoGeneral/$sNamePhotoUser", 100 );
						break;
				}
				
				imagedestroy ( $imagex );
				$_POST ["imagenEditor"] = $sNamePhotoUser;
				$_POST ["imageWidth"] = $wi;
				$_POST ["imageHeight"] = $hi;
				
				$_POST ["crop_width"] = $_POST ["imageWidth"];
				$_POST ["crop_height"] = $_POST ["imageHeight"];
				
				$_POST ["crop_offset_top"] = 0;
				$_POST ["crop_offset_left"] = 0;
				redimensionarImagen ( new JSON () );
				$imgdir = "$sNamePhotoUser";
				$ml = ModelLoader::crear ( "ax_imagenConfiguracion" );
				if (! $ml->buscarPorCampo ( array ("nombre" => $imgdir ) )) {
					$ml->iw = $wi;
					$ml->ih = $hi;
					$ml->cw = 50;
					$ml->ch = 50;
					$ml->ct = 0;
					$ml->cl = 0;
				}
				$json->add ( "conf", $ml->aJSON ( array ("id", "nombre" ) ) );
			}
		
		}
	
	}
	
	$json->add ( "imgdir", "'$imgdir'" );

}

function redimensionarImagen($json) {
	$mlgr = ModelLoader::crear ( "ax_generalRegister" );
	if ($mlgr->buscarPorCampo ( array ("id" => $_SESSION ['iSMuIdKey'] ) )) {
		$imagen = explode ( "?", $_POST ["imagenEditor"] );
		$imagen = $imagen [0];
		$archivo = "photoGeneral/" . $imagen;
		
		$w = intval ( $_POST ["imageWidth"] );
		
		$h = intval ( $_POST ["imageHeight"] );
		
		$cw = intval ( $_POST ["crop_width"] );
		
		$ch = intval ( $_POST ["crop_height"] );
		
		$ct = intval ( $_POST ["crop_offset_top"] );
		
		$cl = intval ( $_POST ["crop_offset_left"] );
		
		$ml = ModelLoader::crear ( "ax_imagenConfiguracion" );
		$editar = $ml->buscarPorCampo ( array ("nombre" => $imagen ) );
		$ml->iw = $w;
		$ml->ih = $h;
		$ml->cw = $cw;
		$ml->ch = $ch;
		$ml->ct = $ct;
		$ml->cl = $cl;
		$ml->nombre = $imagen;
		$mlgr->photo = $imagen;
		$mlgr->modificar ( "id" );
		if ($editar) {
			$ml->modificar ( "id" );
		} else {
			$ml->insertar ();
		}
		
		$imagenAncho = 180;
		
		$imagenAlto = 180;
		
		$auxw = $imagenAncho;
		
		$auxh = $imagenAlto;
		
		$rw = $cw;
		
		$rh = $ch;
		
		$fmx = 1;
		
		$fmy = 1;
		
		if ($rw > $auxw) {
			
			$rw = $auxw;
			
			$rh = ceil ( $auxw * $ch / $cw );
		
		}
		
		if ($rh > $auxh) {
			
			$rh = $auxh;
			
			$rw = ceil ( $auxh * $cw / $ch );
		
		}
		
		$fmx = $rw / $cw;
		
		$fmy = $rh / $ch;
		$image = false;
		$tipo = "jpg";
		if (is_file ( $archivo )) {
			$image = imagecreatefromjpeg ( $archivo );
			if (! $image) {
				$image = imagecreatefromgif ( $archivo );
				$tipo = "gif";
			}
			if (! $image) {
				$image = imagecreatefrompng ( $archivo );
				$tipo = "png";
			}
		}
		$bandera = false;
		if ($image) {
			
			$cp = imagecreatetruecolor ( $rw, $rh );
			
			imagecopyresampled ( $cp, $image, 0, 0, $cl, $ct, $rw, $rh, $cw, $ch );
			
			imagedestroy ( $image );
			
			$cpx = imagecreatetruecolor ( $imagenAncho, $imagenAlto );
			
			$white = imagecolorallocate ( $cpx, 255, 255, 255 );
			
			imagefilledrectangle ( $cpx, 0, 0, $imagenAncho, $imagenAlto, $white );
			
			$cpl = 0;
			
			$cpt = 0;
			
			if ($rw < $auxw) {
				
				$cpl = ceil ( ($auxw - $rw) / 2 );
			
			}
			
			if ($rh < $auxh) {
				
				$cpt = ceil ( ($auxh - $rh) / 2 );
			
			}
			
			imagecopyresampled ( $cpx, $cp, $cpl, $cpt, 0, 0, $rw, $rh, $rw, $rh );
			$endfile = "photoGeneral/big/" . $imagen;
			switch ($tipo) {
				case "png" :
					imagepng ( $cpx, $endfile );
					break;
				case "gif" :
					imagegif ( $cpx, $endfile );
					break;
				default :
					imagejpeg ( $cpx, $endfile, 100 );
					break;
			}
			imagedestroy ( $cpx );
			imagedestroy ( $cp );
			$bandera = true;
		
		}
		if ($bandera) {
			$imagenAncho = 50;
			
			$imagenAlto = 50;
			
			$auxw = $imagenAncho;
			
			$auxh = $imagenAlto;
			
			if ($rw > $auxw) {
				
				$rw = $auxw;
				
				$rh = ceil ( $auxw * $ch / $cw );
			
			}
			
			if ($rh > $auxh) {
				
				$rh = $auxh;
				
				$rw = ceil ( $auxh * $cw / $ch );
			
			}
			
			$fmx = $rw / $cw;
			
			$fmy = $rh / $ch;
			
			$tipo = "jpg";
			if (is_file ( $archivo )) {
				$image = imagecreatefromjpeg ( $archivo );
				if (! $image) {
					$image = imagecreatefromgif ( $archivo );
					$tipo = "gif";
				}
				if (! $image) {
					$image = imagecreatefrompng ( $archivo );
					$tipo = "png";
				}
			}
			
			if ($image) {
				
				$cp = imagecreatetruecolor ( $rw, $rh );
				
				imagecopyresampled ( $cp, $image, 0, 0, $cl, $ct, $rw, $rh, $cw, $ch );
				
				imagedestroy ( $image );
				
				$cpx = imagecreatetruecolor ( $imagenAncho, $imagenAlto );
				
				$white = imagecolorallocate ( $cpx, 255, 255, 255 );
				
				imagefilledrectangle ( $cpx, 0, 0, $imagenAncho, $imagenAlto, $white );
				
				$cpl = 0;
				
				$cpt = 0;
				
				if ($rw < $auxw) {
					
					$cpl = ceil ( ($auxw - $rw) / 2 );
				
				}
				
				if ($rh < $auxh) {
					
					$cpt = ceil ( ($auxh - $rh) / 2 );
				
				}
				imagecopyresampled ( $cpx, $cp, $cpl, $cpt, 0, 0, $rw, $rh, $rw, $rh );
				$endfile = "photoGeneral/small/small_" . $imagen;
				switch ($tipo) {
					case "png" :
						imagepng ( $cpx, $endfile );
						break;
					case "gif" :
						imagegif ( $cpx, $endfile );
						break;
					default :
						imagejpeg ( $cpx, $endfile, 100 );
						break;
				}
				imagedestroy ( $cpx );
				imagedestroy ( $cp );
			}
		}
		
		if ($bandera) {
			
			$json->add ( "who", "'" . $_POST ["imageWho"] . "'" );
			
			$json->add ( "imgdir", "'" . $imagen . "'" );
			
			$json->add ( "exito", "true" );
		
		} else {
			
			$json->add ( "exito", "false" );
		
		}
	} else {
		
		$json->add ( "exito", "false" );
	
	}

}

?>