<?php
function adicionarComodin($item, $key, $data) {
	$comodin = $data [0];
	$pos = $data [1];
	if (is_string ( $item )) {
		if ($comodin != "") {
			if (($pos & Utilidades::ANTES) == Utilidades::ANTES) {
				$item = $comodin . $item;
			}
			if (($pos & Utilidades::DESPUES) == Utilidades::DESPUES) {
				$item .= $comodin;
			}
		}
		$item = strtolower ( $item );
	}
	return $item;
}

final class Utilidades {
	const ARCHIVOSOBREESCRIBIR = 0;
	const ARCHIVOAUMENTARFINAL = 1;
	const ANTES = 2;
	const DESPUES = 4;
	const AMBOS = 6;
	const ESTRICTO = 8;
	const NINGUNO = 0;
	
	public static $correspondencia = array ("a" => "4", "4" => "A", "A" => "a", "b" => "8", "8" => "B", "B" => "b", "c" => "C", "C" => "c", "d" => "D", "D" => "d", "e" => "3", "3" => "E", "E" => "e", "f" => "F", "F" => "f", "g" => "6", "6" => "G", "G" => "g", "h" => "H", "H" => "h", "i" => "1", "1" => "I", "I" => "i", "j" => "J", "J" => "j", "k" => "K", "K" => "k", "l" => "7", "7" => "L", "L" => "l", "m" => "M", "M" => "m", "n" => "N", "N" => "n", "o" => "0", "0" => "O", "O" => "o", "p" => "P", "P" => "p", "q" => "9", "9" => "Q", "Q" => "q", "r" => "R", "R" => "r", "s" => "5", "5" => "S", "S" => "s", "t" => "T", "T" => "t", "u" => "U", "U" => "u", "v" => "V", "V" => "v", "w" => "W", "W" => "w", "x" => "X", "X" => "x", "y" => "Y", "Y" => "y", "z" => "2", "2" => "Z", "Z" => "z" );
	public static function cifrar($texto) {
		$retorno = "";
		for($i = 0; $i < strlen ( $texto ); $i ++) {
			if (isset ( self::$correspondencia [$texto [$i]] )) {
				$retorno .= self::$correspondencia [$texto [$i]];
			} else {
				$retorno .= $texto [$i];
			}
		}
		return base64_encode ( $retorno );
	}
	public static function descifrar($texto) {
		$texto = base64_decode ( $texto );
		$newcorrespondencia = array_combine ( array_values ( self::$correspondencia ), array_keys ( self::$correspondencia ) );
		$retorno = "";
		for($i = 0; $i < strlen ( $texto ); $i ++) {
			if (isset ( $newcorrespondencia [$texto [$i]] )) {
				$retorno .= $newcorrespondencia [$texto [$i]];
			} else {
				$retorno .= $texto [$i];
			}
		}
		return $retorno;
	}
	
	public static function guardarArchivo($contenido, $archivo, $tipo = self::ARCHIVOSOBREESCRIBIR) {
		$modo = "a+";
		if ($tipo == self::ARCHIVOSOBREESCRIBIR) {
			$modo = "w+";
		}
		$file = fopen ( $archivo, $modo );
		fwrite ( $file, $contenido );
		fclose ( $file );
	}
	
	/**
	 * Lee un Archivo XML y devuelve un objeto del tipo DOMDocument
	 *
	 * @param {String} $archivo
	 * @return {DOMDocument}
	 */
	public static function leerXML($archivo) {
		$xmldoc = new DOMDocument ();
		if ($xmldoc->load ( $archivo )) {
			return $xmldoc;
		}
		return false;
	}
	
	public static function estaDentroArreglo($arreglo, $elemento, $comodin = "", $posicion = Utilidades::ANTES) {
		if (is_array ( $arreglo )) {
			if ($comodin != "") {
				if (is_string ( $elemento )) {
					
					$elemento = strtolower ( $elemento );
				}
				array_walk ( $arreglo, "adicionarComodin", array ($comodin, $posicion ) );
			}
			$pos = array_search ( $elemento, $arreglo );
			return $pos === false ? - 1 : $pos;
		}
		return - 1;
	}
	
	public static function estaDentroArregloKeys($arreglo, $elemento, $comodin = "", $posicion = Utilidades::ANTES) {
		if (is_array ( $arreglo )) {
			$arreglokeys = array_keys ( $arreglo );
			$pos = self::estaDentroArreglo ( $arreglokeys, $elemento, $comodin, $posicion );
			if ($pos != - 1) {
				return $arreglo [$arreglokeys [$pos]];
			}
		}
		return - 1;
	}
	
	public static function eliminarElementoDeArreglo($arreglo, $posicion) {
		$nuevoarreglo = array ();
		foreach ( $arreglo as $pos => $item ) {
			if ($pos != $posicion) {
				array_push ( $nuevoarreglo, $item );
			}
		}
		return $nuevoarreglo;
	}
	
	public static function obtenerImagen($files) {
		$mimetypes = array ("image/jpeg", "image/pjpeg", "image/gif", "image/png", "image/bmp" );
		$lista = array ();
		$imagennombres = array_keys ( $files );
		for($i = 0; $i < count ( $imagennombres ); $i ++) {
			$name = $files [$imagennombres [$i]] ["name"];
			$type = $files [$imagennombres [$i]] ["type"];
			$tmp_name = $files [$imagennombres [$i]] ["tmp_name"];
			$size = $files [$imagennombres [$i]] ["size"];
			$tipocorrecto = true;
			if (! in_array ( $type, $mimetypes )) {
				$tipocorrecto = false;
			}
			if ($tipocorrecto) {
				$fp = fopen ( $tmp_name, "rb" );
				$tfoto = fread ( $fp, filesize ( $tmp_name ) );
				$tfoto = addslashes ( $tfoto );
				fclose ( $fp );
				$aux = array ();
				$aux ["mime"] = $type;
				$aux ["nombre"] = $name;
				$aux ["imagen"] = $tfoto;
				$aux ["peso"] = $size;
				$lista [$imagennombres [$i]] = $aux;
			}
		}
		return $lista;
	}
	public static function priMayuscula($cadena) {
		return strtoupper ( substr ( $cadena, 0, 1 ) ) . strtolower ( substr ( $cadena, 1 ) );
	}
	public static function priMinuscula($cadena) {
		return strtolower ( substr ( $cadena, 0, 1 ) ) . substr ( $cadena, 1 );
	}
	
	public static function unirDirecciones($direccion1, $direccion2) {
		$direccion2 = explode ( "/", $direccion2 );
		if (count ( $direccion2 ) > 0) {
			$direccion1 = explode ( "/", $direccion1 );
			array_pop ( $direccion1 );
			if ($direccion2 [0] == "..") {
				array_pop ( $direccion1 );
				$direccion2 = Utilidades::eliminarElementoDeArreglo ( $direccion2, 0 );
			}
			$direccion2 = array_merge ( $direccion1, $direccion2 );
		}
		$direccion2 = implode ( "/", $direccion2 );
		return $direccion2;
	}
	public static function encriptacion($palabra1, $palabra2) {
		return md5 ( md5 ( $palabra2 ) . $palabra1 );
	}
	public static function generadorPase($usuario, $Key) {
		$enc = sha1 ( $usuario . sha1 ( $Key ) );
		$enc = sha1 ( $enc );
		return $enc;
	}
	
	public static function generarKey() {
		if (! isset ( $_COOKIE ["keypass"] )) {
			setcookie ( "keypass", sha1 ( rand ( 0, time () ) ), time () + 3600 * 24 );
		}
	}
	public static function getCookieKey() {
		if (! isset ( $_COOKIE ["keypass"] )) {
			return "";
		}
		return $_COOKIE ["keypass"];
	}
	
	public static function obtenerNumero($cadena) {
		$tama = strlen ( $cadena );
		if ($tama > 0) {
			$numero = "";
			for($i = 0; $i < $tama; $i ++) {
				$caracter = $cadena [$tama - $i - 1];
				if (is_numeric ( $caracter )) {
					$numero += $caracter;
				} else {
					break;
				}
			}
			return intval ( $numero );
		}
		return - 1;
	}
	
	/**
	 * Funcion que busca si un texto esta en una cadena tiene 2 modos Estricto y Ninguno
	 * En modo estricto busca un texto y este puede tener mas caracteres antes o despues del buscado
	 * En modo ninguno busca el
	 *
	 * @param string $cadena
	 * @param string $buscado
	 * @param int $tipo
	 * @return boolean
	 */
	public static function enCadena($cadena, $buscado, $tipo = Utilidades::NINGUNO) {
		$tama = strlen ( $buscado );
		$resultado = (substr ( $cadena, 0, $tama ) == $buscado);
		if ($tipo == Utilidades::ESTRICTO) {
			$resultado = ($resultado && (strlen ( $cadena ) > $tama));
		}
		return $resultado;
	}
	
	/**
	 * Funcion que devuelve una cadena como vista previa de una cadena mas larga
	 * @param string $texto es la cadena original de la que se quiere la vista previa.
	 * @param int $nroCaracteresPorFila es el numero de caracteres por fila.
	 * @param int $nroFilas el numero de filas que se quiere para la vista previa.
	 * La ultima fila lleva puntos suspensivos, esto solo si es necesario.
	 */
	public static function getPreview($texto, $nroCaracteresPorFila, $nroFilas) {
		$textPreview = '';
		$res = array ();
		$tamanioValido = true;
		for($i = 0; $i < $nroFilas - 1; $i ++) {
			$textAux = substr ( $texto, strlen ( $textPreview ), $nroCaracteresPorFila );
			if (strlen ( substr ( $texto, strlen ( $textPreview ) + $nroCaracteresPorFila ) ) > 0) {
				$lastSpace = strrpos ( $textAux, ' ' );
				$textAux = substr ( $texto, strlen ( $textPreview ), $lastSpace + 1 );
				$textPreview .= $textAux;
				$res [] = $textAux;
			} else {
				$textPreview .= $textAux;
				$res [] = $textAux;
			}
			if (strlen ( substr ( $texto, strlen ( $textPreview ) ) ) <= 0) {
				$tamanioValido = false;
				break;
			}
		}
		$textAux = substr ( $texto, strlen ( $textPreview ), $nroCaracteresPorFila / 3 * 2 );
		$lastSpace = strrpos ( $textAux, ' ' );
		if (strlen ( substr ( $texto, strlen ( $textPreview ) + strlen ( $textAux ) ) ) > 0) {
			$res [] = substr ( $texto, strlen ( $textPreview ), $lastSpace + 1 ) . '...';
		} elseif (! $tamanioValido) {
			$res [] = substr ( $texto, strlen ( $textPreview ), $lastSpace + 1 );
		}
		$textPreview = htmlspecialchars ( implode ( $res, "\n" ) );
		return substr ( $textPreview, 0, strlen ( $textPreview ) - 1 );
	}
	public static function listarDirectorio($dir, $ext = false) {
		if (is_dir ( $dir )) {
			if ($dir [strlen ( $dir ) - 1] != "/") {
				$dir .= "/";
			}
			$ext = strtolower ( $ext );
			$dire = dir ( $dir );
			$arregloarhs = array ();
			while ( false != ($item = $dire->read ()) ) {
				if ($item != "." && $item != "..") {
					if ($ext) {
						$file = $dir . "" . $item;
						if (is_file ( $file )) {
							$ip = pathinfo ( $file );
							$extx = strtolower ( $ip ["extension"] );
							if ($extx == $ext) {
								array_push ( $arregloarhs, $item );
							}
						}
					} else {
						array_push ( $arregloarhs, $item );
					}
				}
			}
			return $arregloarhs;
		}
		return false;
	}
	public static function formatPath($direccion) {
		$direccion = str_replace ( "/", DIRECTORY_SEPARATOR, $direccion );
		$direccion = explode ( DIRECTORY_SEPARATOR, $direccion );
		if ($direccion [count ( $direccion ) - 1] != '') {
			array_push ( $direccion, '' );
		}
		$direccion = implode ( DIRECTORY_SEPARATOR, $direccion );
		return $direccion;
	}
	public static function darExtension($direccion) {
		$extension = pathinfo ( $direccion );
		return $extension ["extension"];
	}
	public static function DirTemp() {
		if (! empty ( $_ENV ['TMP'] )) {
			$tempdir = $_ENV ['TMP'];
		} elseif (! empty ( $_ENV ['TMPDIR'] )) {
			$tempdir = $_ENV ['TMPDIR'];
		} elseif (! empty ( $_ENV ['TEMP'] )) {
			$tempdir = $_ENV ['TEMP'];
		} else {
			$tempdir = dirname ( tempnam ( "", 'na' ) );
		}
		if (empty ( $tempdir )) {
			return false;
		}
		$tempdir = rtrim ( $tempdir, '/' );
		$tempdir .= '/';
		if (is_writable ( $tempdir ) == false) {
			return false;
		}
		return $tempdir;
	}
	public static function leerArchivo($dirarchivo) {
		$archivo = fopen ( $dirarchivo, "r" );
		if ($archivo) {
			$retorno = "";
			try {
				while ( ! feof ( $archivo ) ) {
					$retorno .= fgets ( $archivo, 1024 );
				}
			} catch ( Exception $ex ) {
				print $ex->getTrace ();
			}
			;
			fclose ( $archivo );
			if ($retorno !== "") {
				return $retorno;
			}
		}
		return false;
	}
	public static function procesarTextoJSON($texto) {
		$texto = str_replace ( "'", "\\'", $texto );
		$texto = str_replace ( "\n", "\\n", $texto );
		$texto = str_replace ( "\r", "", $texto );
		return $texto;
	}
	
	public static function fileSize($file) {
		$size = filesize ( $file );
		$filesizename = array (" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB" );
		return $size ? round ( $size / pow ( 1024, ($i = floor ( log ( $size, 1024 ) )) ), 2 ) . $filesizename [$i] : '0 Bytes';
	}
	
	public static function normalizarTexto($texto) {
		$texto = htmlentities(utf8_decode($texto ));
		$texto = preg_replace ( "/&([\w])acute;/", "$1", $texto );
		$texto = preg_replace ( "/&([\w])tilde;/", "$1", $texto );
		$texto = ereg_replace ( "/", "-", $texto );
		$texto = ereg_replace ( ",", "_", $texto );
		$texto = ereg_replace ( " ", "_", $texto );
		$texto = ereg_replace ( "__", "_", $texto );
		$texto = ereg_replace ( "_-_", "-", $texto );
		$texto = preg_replace ( "/[\W^-^_]/", "_", $texto );
		$texto = strtr ( strtolower ( "$texto" ),
"ÀÁÂÃÄÅàáâãäåÈÉÊËèéêëÌÍÎÏìíîïÒÓÔÕÖØòóôõöøÙÚÛÜùúûüÇçÑñÿ", "aaaaaaaaaaaaeeeeeeeeiiiiiiiioooooooooooouuuuuuuuccnny" );
		return $texto; 
	}
}
?>
