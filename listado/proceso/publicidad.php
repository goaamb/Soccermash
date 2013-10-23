<?php
require_once 'goaamb/web/json.php';
$json = new JSON ();
$dirgo = "goaamb/images/publi/original/";
$dirgf = "goaamb/images/publi/full/";
$dirgt = "goaamb/images/publi/thumb/";
if (isset ( $_POST ["__accion"] )) {
	switch ($_POST ["__accion"]) {
		case "ingresarAnuncio" :
			$imgdir = "";
			if (isset ( $_POST ["imgdir"] ) && is_file ( $dirgo . $_POST ["imgdir"] )) {
				$imgdir = $_POST ["imgdir"];
			}
			if (! $imgdir && isset ( $_FILES ) && isset ( $_FILES ["imagen"] ) && is_file ( $_FILES ["imagen"] ["tmp_name"] )) {
				$file = $_FILES ["imagen"];
				$jpg = array ("image/jpeg", "image/pjpeg" );
				$png = array ("image/x-png", "image/png" );
				$gif = array ("image/gif" );
				$validmime = array_merge ( $jpg, $png, $gif );
				if (array_search ( strtolower ( $file ["type"] ), $validmime ) !== false) {
					$pi = pathinfo ( $file ["name"] );
					$ext = $pi ["extension"];
					do {
						$rand = date ( "YmdHis" ) . rand ();
						$archivo = "goaamb/images/publi/original/" . $rand . "." . $ext;
					} while ( is_file ( $archivo ) );
					copy ( $_FILES ["imagen"] ["tmp_name"], $archivo );
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
						$wf = 200;
						$hf = 200;
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
								imagepng ( $imagex, "goaamb/images/publi/full/$rand.$ext" );
								break;
							case "gif" :
								imagegif ( $imagex, "goaamb/images/publi/full/$rand.$ext" );
								break;
							default :
								imagejpeg ( $imagex, "goaamb/images/publi/full/$rand.$ext", 100 );
								break;
						}
						imagedestroy ( $imagex );
						$wt = 80;
						$ht = 80;
						if ($wi > $wt) {
							$hi = ceil ( $hi * $wt / $wi );
							$wi = $wt;
						}
						if ($hi > $ht) {
							$wi = ceil ( $wi * $ht / $hi );
							$hi = $ht;
						}
						$json->add ( "wt", $wi );
						$json->add ( "ht", $hi );
						$imagex = imagecreatetruecolor ( $wi, $hi );
						imagecopyresampled ( $imagex, $image, 0, 0, 0, 0, $wi, $hi, $w, $h );
						switch ($tipo) {
							case "png" :
								imagepng ( $imagex, "goaamb/images/publi/thumb/$rand.$ext" );
								break;
							case "gif" :
								imagegif ( $imagex, "goaamb/images/publi/thumb/$rand.$ext" );
								break;
							default :
								imagejpeg ( $imagex, "goaamb/images/publi/thumb/$rand.$ext", 100 );
								break;
						}
						$imgdir = "$rand.$ext";
					}
				}
			}
			$json->add ( "imgdir", "'$imgdir'" );
			$json->add ( "url", "'" . Utilidades::procesarTextoJSON($_POST ["url"]) . "'" );
			$json->add ( "titulo", "'" . Utilidades::procesarTextoJSON($_POST ["titulo"]) . "'" );
			$json->add ( "texto", "'" . Utilidades::procesarTextoJSON($_POST ["texto"]) . "'" );
			break;
		
		default :
			;
			break;
	}
}
$json->printJSON ();
?>