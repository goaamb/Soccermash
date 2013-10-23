<?php
ini_set ( "error_reporting", 22517 );
$file = $_GBASE . '/goaamb/bd.php';
if (is_file ( $file )) {
	class Idioma {
		public $diccionario = array ();
		public $language = 0;
		
		public static $instancia = array ();
		
		public static $mllanguage = null;
		/**
		 * Model of Traduccion
		 * @var ModelLoader
		 */
		public static $mltraduccion = null;
		
		/**
		 * Singleton function for Idioma
		 * @param String
		 * @return Idioma
		 */
		public static function darInstancia($lang = "en-US") {
			if (! isset ( self::$instancia [$lang] )) {
				self::$instancia [$lang] = new Idioma ( $lang );
			}
			return self::$instancia [$lang];
		}
		
		public function __construct($lang = "en-US") {
			if (self::$mllanguage == null) {
				self::$mllanguage = ModelLoader::crear ( "ax_language" );
			}
			if (self::$mltraduccion == null) {
				self::$mltraduccion = ModelLoader::crear ( "ax_traduccion" );
			}
			if (self::$mllanguage->buscarPorCampo ( array ("tag" => $lang ) )) {
				$this->language = self::$mllanguage->id;
				$traducciones = self::$mltraduccion->listar ( "language='$this->language'" );
				foreach ( $traducciones as $trad ) {
					$traducc = trim ( $trad->traduccion );
					if ($traducc !== "") {
						$this->diccionario [$trad->hash] = $traducc;
					} else {
						$this->diccionario [$trad->hash] = $trad->original;
					}
				}
			}
		}
		public function traducir($texto) {
			$texto = trim ( $texto );
			$hash = md5 ( $texto );
			if (isset ( $this->diccionario [$hash] )) {
				return $this->diccionario [$hash];
			} else {
				self::$mltraduccion->limpiar ();
				self::$mltraduccion->original = $texto;
				self::$mltraduccion->traduccion = $texto;
				self::$mltraduccion->language = $this->language;
				self::$mltraduccion->hash = $hash;
				self::$mltraduccion->insertar ();
				$this->diccionario [$hash] = $texto;
			}
			return $texto;
		}
		
		public function traducirF($texto) {
			return $texto;
		}
		
		public static function darCodigo2AlfaPais($ip) {
			if (! isset ( $_SESSION ["paisReal" . $ip] )) {
				try {
					$ip = explode ( ",", $ip );
					if (count ( $ip ) > 0) {
						$ip = trim ( $ip [0] );
					}
					ip2long ( $ip ) == - 1 || ip2long ( $ip ) === false ? trigger_error ( "Invalid IP", E_USER_ERROR ) : "";
				} catch ( Exception $e ) {
					$country = "US";
				}
				try {
					$country = strtoupper ( trim ( @file_get_contents ( "http://api.wipmania.com/" . $ip ) ) );
				} catch ( Exception $e ) {
					$country = "XX";
				}
				if (strtolower ( $country ) == "xx") {
					try {
						$country = strtoupper ( trim ( @file_get_contents ( "http://ip2.cc/?api=cc&ip=" . $ip ) ) );
					} catch ( Exception $e ) {
						$country = "XX";
					}
				}
				if (strtolower ( $country ) == "xx") {
					try {
						$doc = simplexml_load_file ( "http://api.hostip.info/?ip=" . $ip );
						$result = $doc->xpath ( '/HostipLookupResultSet/gml:featureMember/Hostip/countryAbbrev' );
						list ( , $country ) = each ( $result );
					} catch ( Exception $e ) {
						$country = "US";
					}
				}
				//ini_set ( "error_reporting", $val );
				$_SESSION ["paisReal" . $ip] = ($country ? $country : "US");
				return $_SESSION ["paisReal" . $ip];
			} else {
				return $_SESSION ["paisReal" . $ip];
			}
		}
		public static function darIP() {
			$ip = isset ( $_SERVER ["HTTP_CLIENT_IP"] ) ? $_SERVER ["HTTP_CLIENT_IP"] : (isset ( $_SERVER ["HTTP_X_FORWARDED_FOR"] ) ? $_SERVER ["HTTP_X_FORWARDED_FOR"] : $_SERVER ["REMOTE_ADDR"]);
			$ip = explode ( ",", $ip );
			if (count ( $ip ) > 0) {
				$ip = trim ( $ip [0] );
			}
			return $ip;
		}
		public static function darLenguaje() {
			$mllanguage = ModelLoader::crear ( "ax_language" );
			srand ( time () );
			$rand = rand ( 0, 10000 );
			$lg = "es-ES";
			$ip = self::darIP ();
			if (isset ( $_GET ["lang"] )) {
				$lg = $_GET ["lang"];
			} elseif (isset ( $_COOKIE ["lang"] )) {
				$lg = $_COOKIE ["lang"];
			} elseif (isset ( $_SESSION ["lg"] )) {
				$lg = $_SESSION ["lg"];
			} else {
				$codigo = self::darCodigo2AlfaPais ( $ip );
				$mlcountry = ModelLoader::crear ( "ax_country" );
				if ($mlcountry->buscarPorCampo ( array ("code2" => $codigo ) )) {
					$mlcl = ModelLoader::crear ( "ax_countrylanguage" );
					$listamlcl = $mlcl->listar ( "countrycode='$mlcountry->code' and Percentage=(select max(Percentage) from ax_countrylanguage where countrycode='$mlcountry->code')", 0, 1 );
					if (count ( $listamlcl ) > 0) {
						$listamlcl = $listamlcl [0];
						if ($mllanguage->buscarPorCampo ( array ("id" => $listamlcl->language ) )) {
							$lg = $mllanguage->tag;
						}
					}
				}
			}
			if (! $mllanguage->buscarPorCampo ( array ("tag" => $lg ) )) {
				$mllanguage->buscarPorCampo ( array ("tag" => "es-ES" ) );
			}
			if (! isset ( $_SESSION ["lg"] )) {
				$_SESSION ["lg"] = $mllanguage->tag;
			} else {
				$_SESSION ["lg"] = $mllanguage->tag;
			}
			$idioma = new Idioma ( $mllanguage->tag );
			return $idioma;
		}
		
		static function saveLog($lg, $ip, $otro) {
			$filex = file_get_contents ( $_SERVER ["DOCUMENT_ROOT"] . "/idioma.log" );
			if (! $filex) {
				$filex = "";
			}
			$filex = date ( "Y-m-d H:i:s " ) . $_SERVER ["REQUEST_URI"] . " '" . $_SESSION ["lg"] . "' '" . $lg . "' '" . $ip . "' '" . $otro . "'\n" . $filex;
			file_put_contents ( $_SERVER ["DOCUMENT_ROOT"] . "/idioma.log", $filex );
		}
	}
}
?>