<?php
require_once $_GBASE . '/goaamb/web/tags.php';
class Anuncio {
	static function insertarEstadisticaAnuncioTipo2($anuncio, $tipo, $seccion) {
		$me2 = ModelLoader::crear ( "ax_estadisticaAnuncioTipo2" );
		$mgr = ModelLoader::crear ( "ax_generalRegister" );
		$me2->anuncio = $anuncio->id;
		if (isset ( $_SESSION ["iSMuIdKey"] )) {
			$me2->interesado = $_SESSION ["iSMuIdKey"];
			$mgr->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) );
			$me2->pais = $mgr->paisReal;
		} else {
			$me2->pais = Idioma::darCodigo2AlfaPais ( Idioma::darIP () );
		}
		$mgr->buscarPorCampo ( array ("id" => $anuncio->anunciante ) );
		$me2->tipo = $tipo;
		$me2->fecha_hora = date ( "Y-m-d H:i:s" );
		$me2->seccion = $seccion;
		$me2->insertar ();
	}
	
	static function imprimirAnuncioTipo2($anuncio, $seccion) {
		global $_IDIOMA;
		$mgr = ModelLoader::crear ( "ax_generalRegister" );
		$dirg = "/goaamb/images/publi/thumb/";
		if ($mgr->buscarPorCampo ( array ("id" => $anuncio->anunciante ) )) {
			$url = "/" . $_IDIOMA->traducir ( "user" ) . "/" . $mgr->id . "-" . Utilidades::normalizarTexto ( $mgr->name . " " . $mgr->lastname ) . "-$anuncio->id-$seccion-" . Utilidades::normalizarTexto ( $anuncio->titulo );
			$a = new Tag ( "a", new Tag ( "img", "", array ("src" => $dirg . $anuncio->__campo ( "imagen" . $seccion ) ) ), array ("href" => $url, "id" => "anuncio$anuncio->id" ) );
			$a->htmlprint ();
		}
	}
	static function insertarEstadisticaAnuncioTipo1($anuncio, $tipo, $seccion) {
		$me2 = ModelLoader::crear ( "ax_estadisticaAnuncioTipo1" );
		$mgr = ModelLoader::crear ( "ax_generalRegister" );
		$me2->anuncio = $anuncio->id;
		if (isset ( $_SESSION ["iSMuIdKey"] )) {
			$me2->interesado = $_SESSION ["iSMuIdKey"];
			$mgr->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) );
			$me2->pais = $mgr->paisReal;
		} else {
			$me2->pais = Idioma::darCodigo2AlfaPais ( Idioma::darIP () );
		}
		$mgr->buscarPorCampo ( array ("id" => $anuncio->anunciante ) );
		$me2->tipo = $tipo;
		$me2->fecha_hora = date ( "Y-m-d H:i:s" );
		$me2->seccion = $seccion;
		$me2->insertar ();
	}
	static function imprimirAnuncioTipo1($anuncio, $seccion) {
		global $_IDIOMA;
		$mgr = ModelLoader::crear ( "ax_generalRegister" );
		$dirg = "/goaamb/images/publi/thumb/";
		if ($mgr->buscarPorCampo ( array ("id" => $anuncio->anunciante ) )) {
			$url = $anuncio->url;
			$url = explode ( "::--::", $url );
			if (count ( $url ) > 0) {
				$url [1]=preg_replace("|^http://|", "", $url [1]);
				switch ($url [0]) {
					case "http2" :
						$url = "http://www.soccermash.com/" . $_IDIOMA->traducir ( "user" ) . "/" . $url [1];
						break;
					default :
						$url = "http://" . $url [1];
						break;
				}
			}
			$anuncio->titulo=utf8_encode($anuncio->titulo);
			$anuncio->texto=utf8_encode($anuncio->texto);
			$aprop = array ("href" => $url, "onclick" => "clickedAnuncioTipo1('$anuncio->id','$seccion');", "target" => "_blank" );
			if ($seccion == 1) {
				$div = new Tag ( "div", new Tag ( "p", new Tag ( "a", $anuncio->titulo, $aprop ), array ("class" => "titleAdvSearch paddingRC" ) ) );
				$div->add ( new Tag ( "a", new Tag ( "img", "", array ("class" => "paddingRC square", "src" => "/goaamb/images/publi/thumb/" . $anuncio->imagen ) ), $aprop ) );
				$div->add ( new Tag ( "p", $anuncio->texto, array ("class" => "advPadd" ) ) );
				$div->htmlprint (Tag::UTF8_ENCODE);
			} else {
				$div = new Tag ( "div" );
				$div->add ( new Tag ( "a", new Tag ( "img", "", array ("class" => "paddingRC square", "src" => "/goaamb/images/publi/thumb/" . $anuncio->imagen ) ), $aprop ) );
				$div->add ( new Tag ( "p", new Tag ( "a", $anuncio->titulo, $aprop ), array ("class" => "titleAdvSearch paddingRC" ) ) );
				$div->add ( new Tag ( "p", $anuncio->texto, array ("class" => "advPadd" ) ) );
				$div->htmlprint (Tag::UTF8_ENCODE);
			}
		}
	}
	static function listarAnuncios($mlaxgen, $cantidad = -1) {
		$mlad1 = ModelLoader::crear ( "ax_anuncioTipo1" );
		$pais = Idioma::darCodigo2AlfaPais ( Idioma::darIP () );
		$perfil = $mlaxgen->profileId;
		$edad = time () - strtotime ( $mlaxgen->dayOfBirthDay ); //segundos
		$edad = intval ( $edad / (365 * 24 * 60 * 60) );
		$sexo = $mlaxgen->sex;
		if ($sexo == 1) {
			$sexo = "Masculino";
		} else {
			$sexo = "Femeninos";
		}
		return $mlad1->listar ( "activo='Si' and pagado='Si' and (paises like '%$pais%' or paises='*') and (perfiles like '$perfil' or perfiles like '$perfil::-::%' or perfiles like '%::-::$perfil' or perfiles like '%::-::$perfil::-::%' or perfiles='*' ) and ((desde<=$edad and hasta>=$edad) or isnull(desde) or desde=0 or isnull(hasta) or hasta=0) and (sexo='*' or sexo ='$sexo') order by rand()", 0, $cantidad );
	}
}