<?php
require_once 'goaamb/web/json.php';
require_once 'goaamb/web/xmltag.php';
require_once 'goaamb/mail/qmail.php';
require_once 'goaamb/anuncio.php';
if ($_REQUEST ["__t"] == "xml") {
	$render = new XmlTag ();
} else {
	$render = new JSON ();
}

if (function_exists ( $_REQUEST ["__a"] )) {
	call_user_func ( $_REQUEST ["__a"], $render );
} else {
	$render->add ( "error", "'La accion no existe'" );
}
if ($_REQUEST ["__t"] == "xml") {
	$render->xmlprint ();
} else {
	$render->printJSON ();
}
function eliminarAnuncioTipo1X($json) {
	$anuncio = ModelLoader::crear ( "ax_anuncioTipo1" );
	if ($anuncio->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
		$anuncio->eliminado = "Si";
		$anuncio->activo = "No";
		$anuncio->modificar ( "id" );
		$json->add ( "exito", "true" );
	}
	$json->add ( "exito", "false" );
}
/**
 * @param XmlTag $render
 */
function xmlStat($render) {
	global $_IDIOMA, $conexion;
	$anuncio = ModelLoader::crear ( "ax_anuncioTipo1" );
	if ($anuncio->buscarPorCampo ( array ("id" => $_REQUEST ["anuncio"] ) )) {
		$extra = "";
		if (isset ( $_REQUEST ["inicio"] ) && isset ( $_REQUEST ["fin"] )) {
			$inicio = $_REQUEST ["inicio"];
			$inicio = explode ( "/", $inicio );
			$inicio = array_reverse ( $inicio );
			$inicio = implode ( "-", $inicio );
			$fin = $_REQUEST ["fin"];
			$fin = explode ( "/", $fin );
			$fin = array_reverse ( $fin );
			$fin = implode ( "-", $fin );
			$extra = "and fecha_hora>='$inicio 00:00:00' and fecha_hora<='$fin 23:59:59' ";
		}
		$tipo = "dia";
		if (isset ( $_REQUEST ["tipo"] )) {
			$tipo = $_REQUEST ["tipo"];
		}
		if ($tipo == "dia") {
			$fecha = "date(fecha_hora)";
		} else {
			$fecha = "concat(month(fecha_hora),'/',year(fecha_hora))";
		}
		$render->setTag ( "JSChart" );
		$render->add ( $datasetclick = new XmlTag ( "dataset" ) );
		$datasetclick->type = "line";
		$datasetclick->id = "AdClick";
		
		$render->add ( $datasetprint = new XmlTag ( "dataset" ) );
		$datasetprint->type = "line";
		$datasetprint->id = "AdPrint";
		
		$mlstat = ModelLoader::crear ( "ax_estadisticaAnuncioTipo1" );
		$listas = $conexion->seleccionarAsociado ( "ax_estadisticaAnuncioTipo1", array ("count(1) as cantidad", "tipo", "$fecha as fecha" ), "anuncio='$anuncio->id' $extra group by tipo,fecha order by fecha" );
		$stat = array ();
		$maxv = 0;
		if ($listas && count ( $listas ) > 0) {
			if (count ( $listas ) == 1) {
				$fecha = $listas [0] ["fecha"];
				if ($tipo == "dia") {
					$fecha = date ( "d/m/Y", strtotime ( $fecha ) - 24 * 60 * 60 );
				} else {
					$fecha = array_reverse ( explode ( "/", $fecha ) );
					$fecha [1] = intval ( $fecha [1] ) - 1;
					if ($fecha [1] <= 0) {
						$fecha [1] = 12;
						$fecha [0] --;
					}
					$fecha = date ( "m/Y", strtotime ( implode ( "-", $fecha ) . "-01" ) );
				}
				$stat [$fecha] = array ("click" => 0, "impresion" => 0 );
			}
			foreach ( $listas as $value ) {
				if ($tipo == "dia") {
					$value ["fecha"] = date ( "d/m/Y", strtotime ( $value ["fecha"] ) );
				}
				if (! isset ( $stat [$value ["fecha"]] ["impresion"] )) {
					$stat [$value ["fecha"]] = array ("click" => 0, "impresion" => 0 );
				}
				if ($value ["tipo"] == "Impresion") {
					$stat [$value ["fecha"]] ["impresion"] = $value ["cantidad"];
				}
				if ($value ["tipo"] == "Click") {
					$stat [$value ["fecha"]] ["click"] = $value ["cantidad"];
				}
				if ($maxv < $value ["cantidad"]) {
					$maxv = $value ["cantidad"];
				}
			}
		
		} else {
			if ($tipo == "dia") {
				$stat [date ( "d/m/Y", time () - 24 * 60 * 60 )] = array ("click" => 0, "impresion" => 0 );
				$stat [date ( "d/m/Y" )] = array ("click" => 0, "impresion" => 0 );
			}
			$maxv = 10;
		}
		$arreglo = array_keys ( $stat );
		$maxx = count ( $arreglo );
		
		$count = 1;
		foreach ( $stat as $fecha => $datos ) {
			$datasetprint->add ( $data = new XmlTag ( "data" ) );
			$data->unit = $count;
			$data->value = $datos ["impresion"];
			$datasetclick->add ( $data = new XmlTag ( "data" ) );
			$data->unit = $count;
			$data->value = $datos ["click"];
			$count ++;
		}
		$render->add ( $opgionset = new XmlTag ( "optionset" ) );
		/*$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setAxisName";
		$option->value = $_IDIOMA->traducir ( "quantity" );*/
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setSize";
		$option->value = "550,300";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setAxisValuesNumberY";
		$option->value = 5;
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setIntervalStartY";
		$option->value = "0";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setIntervalEndY";
		$option->value = "$maxv";
		foreach ( $arreglo as $i => $fecha ) {
			$opgionset->add ( $option = new XmlTag ( "option" ) );
			$option->set = "setLabelX";
			$option->value = "[" . ($i + 1) . ",'" . $fecha . "']";
		}
		foreach ( $arreglo as $i => $fecha ) {
			$opgionset->add ( $option = new XmlTag ( "option" ) );
			$option->set = "setTooltip";
			$option->value = "[" . ($i + 1) . ",'" . $_IDIOMA->traducir ( "Click" ) . "," . $stat [$fecha] ["click"] . "','AdClick']";
			$opgionset->add ( $option = new XmlTag ( "option" ) );
			$option->set = "setTooltip";
			$option->value = "[" . ($i + 1) . ",'" . $_IDIOMA->traducir ( "Print" ) . "," . $stat [$fecha] ["impresion"] . "','AdPrint']";
		}
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setAxisValuesNumberX";
		$option->value = "$maxx";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setShowXValues";
		$option->value = "false";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setTitleColor";
		$option->value = "'#454545'";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setAxisValuesColor";
		$option->value = "'#454545'";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setLineColor";
		$option->value = "'#A4D314', 'AdClick'";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setLineColor";
		$option->value = "'#BBBBBB', 'AdPrint'";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setFlagColor";
		$option->value = "'#9D16FC'";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setFlagRadius";
		$option->value = "4";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setAxisPaddingRight";
		$option->value = "100";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setLegendShow";
		$option->value = "true";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setLegendPosition";
		$option->value = "490, 80";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setLegendForLine";
		$option->value = "'AdClick', 'Clicks'";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setLegendForLine";
		$option->value = "'AdPrint', 'Prints'";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setAxisValuesAngle";
		$option->value = "45";
		$opgionset->add ( $option = new XmlTag ( "option" ) );
		$option->set = "setAxisPaddingBottom";
		$option->value = "50";
	
	}
}
function jsonStat($json) {
	global $_IDIOMA, $conexion;
	$anuncio = ModelLoader::crear ( "ax_anuncioTipo1" );
	if ($anuncio->buscarPorCampo ( array ("id" => $_REQUEST ["anuncio"] ) )) {
		$extra = "";
		if (isset ( $_REQUEST ["inicio"] ) && isset ( $_REQUEST ["fin"] )) {
			$inicio = $_REQUEST ["inicio"];
			$inicio = explode ( "/", $inicio );
			$inicio = array_reverse ( $inicio );
			$inicio = implode ( "-", $inicio );
			$fin = $_REQUEST ["fin"];
			$fin = explode ( "/", $fin );
			$fin = array_reverse ( $fin );
			$fin = implode ( "-", $fin );
			$extra = "and fecha_hora>='$inicio 00:00:00' and fecha_hora<='$fin 23:59:59' ";
		}
		$tipo = "dia";
		if (isset ( $_REQUEST ["tipo"] )) {
			$tipo = $_REQUEST ["tipo"];
		}
		if ($tipo == "dia") {
			$fecha = "date(fecha_hora)";
		} else {
			$fecha = "concat(month(fecha_hora),'/',year(fecha_hora))";
		}
		$json->add ( '"JSChart"', $jschart = new JSON () );
		$jschart->add ( '"datasets"', $jsdatam = new JSON ( null, JSON::ARREGLO ) );
		$jsdatam->add ( "", $jsclick = new JSON () );
		$jsclick->add ( '"type"', '"line"' );
		$jsclick->add ( '"id"', '"AdClick"' );
		$jsclick->add ( '"data"', $jsdata = new JSON ( null, JSON::ARREGLO ) );
		$mlstat = ModelLoader::crear ( "ax_estadisticaAnuncioTipo1" );
		$listas = $conexion->seleccionarAsociado ( "ax_estadisticaAnuncioTipo1", array ("count(1) as cantidad", "tipo", "$fecha as fecha" ), "anuncio='$anuncio->id' $extra group by tipo,fecha order by fecha" );
		//$stat = array ("click" => array (), "impresion" => array () );
		$stat = array ();
		//var_dump($listas);
		$maxv = 0;
		if ($listas && count ( $listas ) > 0) {
			if (count ( $listas ) == 1) {
				$fecha = $listas [0] ["fecha"];
				if ($tipo == "dia") {
					$fecha = date ( "d/m/Y", strtotime ( $fecha ) - 24 * 60 * 60 );
				} else {
					$fecha = array_reverse ( explode ( "/", $fecha ) );
					$fecha [1] = intval ( $fecha [1] ) - 1;
					if ($fecha [1] <= 0) {
						$fecha [1] = 12;
						$fecha [0] --;
					}
					$fecha = date ( "m/Y", strtotime ( implode ( "-", $fecha ) . "-01" ) );
				}
				$stat [$fecha] = array ("click" => 0, "impresion" => 0 );
			}
			foreach ( $listas as $value ) {
				if ($tipo == "dia") {
					$value ["fecha"] = date ( "d/m/Y", strtotime ( $value ["fecha"] ) );
				}
				if (! isset ( $stat [$value ["fecha"]] ["impresion"] )) {
					$stat [$value ["fecha"]] = array ("click" => 0, "impresion" => 0 );
				}
				if ($value ["tipo"] == "Impresion") {
					$stat [$value ["fecha"]] ["impresion"] = $value ["cantidad"];
				}
				if ($value ["tipo"] == "Click") {
					$stat [$value ["fecha"]] ["click"] = $value ["cantidad"];
				}
				if ($maxv < $value ["cantidad"]) {
					$maxv = $value ["cantidad"];
				}
			}
		
		} else {
			if ($tipo == "dia") {
				$stat [date ( "d/m/Y", time () - 24 * 60 * 60 )] = array ("click" => 0, "impresion" => 0 );
				$stat [date ( "d/m/Y" )] = array ("click" => 0, "impresion" => 0 );
			}
			$maxv = 10;
		}
		$arreglo = array_keys ( $stat );
		$maxx = count ( $arreglo );
		$jsdatam->add ( "", $jsprint = new JSON () );
		$jsprint->add ( '"type"', '"line"' );
		$jsprint->add ( '"id"', '"AdPrint"' );
		$jsprint->add ( '"data"', $jsdatap = new JSON ( null, JSON::ARREGLO ) );
		$count = 1;
		foreach ( $stat as $fecha => $datos ) {
			$jsdatap->add ( "", $jsdatax = new JSON () );
			$jsdatax->add ( '"unit"', '"' . $count . '"' );
			$jsdatax->add ( '"value"', '"' . $datos ["impresion"] . '"' );
			$jsdata->add ( "", $jsdatax = new JSON () );
			$jsdatax->add ( '"unit"', '"' . $count . '"' );
			$jsdatax->add ( '"value"', '"' . $datos ["click"] . '"' );
			$count ++;
		}
		
		$jschart->add ( '"optionset"', $optionset = new JSON ( null, JSON::ARREGLO ) );
		/*$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setAxisName"' );
		$jsos->add ( '"value"', '"' . $_IDIOMA->traducir ( "quantity" ) . '"' );*/
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setSize"' );
		$jsos->add ( '"value"', "\"550,300\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setAxisValuesNumberY"' );
		$jsos->add ( '"value"', '"5"' );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setIntervalStartY"' );
		$jsos->add ( '"value"', '"0"' );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setIntervalEndY"' );
		$jsos->add ( '"value"', '"' . $maxv . '"' );
		foreach ( $arreglo as $i => $fecha ) {
			$optionset->add ( "", $jsos = new JSON () );
			$jsos->add ( '"set"', '"setLabelX"' );
			$jsos->add ( '"value"', "\"[" . ($i + 1) . ",'" . $fecha . "']\"" );
		}
		foreach ( $arreglo as $i => $fecha ) {
			$optionset->add ( "", $jsos = new JSON () );
			$jsos->add ( '"set"', '"setTooltip"' );
			$jsos->add ( '"value"', "\"[" . ($i + 1) . ",' ']\"" );
		}
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setAxisValuesNumberX"' );
		$jsos->add ( '"value"', '"' . $maxx . '"' );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setShowXValues"' );
		$jsos->add ( '"value"', '"false"' );
		/*$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setTitle"' );
		$jsos->add ( '"value"', '"' . $anuncio->titulo . '"' );*/
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setTitleColor"' );
		$jsos->add ( '"value"', "\"'#454545'\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setAxisValuesColor"' );
		$jsos->add ( '"value"', "\"'#454545'\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setLineColor"' );
		$jsos->add ( '"value"', "\"'#A4D314', 'AdClick'\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setLineColor"' );
		$jsos->add ( '"value"', "\"'#BBBBBB', 'AdPrint'\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setFlagColor"' );
		$jsos->add ( '"value"', "\"'#9D16FC'\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setFlagRadius"' );
		$jsos->add ( '"value"', '"4"' );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setAxisPaddingRight"' );
		$jsos->add ( '"value"', '"100"' );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setLegendShow"' );
		$jsos->add ( '"value"', '"true"' );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setLegendPosition"' );
		$jsos->add ( '"value"', "\"490, 80\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setLegendForLine"' );
		$jsos->add ( '"value"', "\"'AdClick', 'Clicks'\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setLegendForLine"' );
		$jsos->add ( '"value"', "\"'AdPrint', 'Prints'\"" );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setAxisValuesAngle"' );
		$jsos->add ( '"value"', '"45"' );
		$optionset->add ( "", $jsos = new JSON () );
		$jsos->add ( '"set"', '"setAxisPaddingBottom"' );
		$jsos->add ( '"value"', '"50"' );
	
	}
}

/**
 * @param JSON $json
 */
function pagarAnuncio($json) {
	global $_IDIOMA;
	$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
	$mlax = ModelLoader::crear ( "ax_generalRegister" );
	if ($mlax->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) )) {
		if ($ml->buscarPorCampo ( array ("id" => $_POST ["anuncioTipo1"] ) )) {
			include "goaamb/lphp.php";
			$mylphp = new lphp ();
			
			# constants
			$myorder ["host"] = "secure.linkpt.net";
			$myorder ["port"] = "1129";
			$myorder ["keyfile"] = "certificado/1001292885.pem"; # Change this to the name and location of your certificate file
			$myorder ["configfile"] = "1001292885"; # Change this to your store number
			

			# transaction details
			$myorder ["ordertype"] = $_POST ["ordertype"];
			$myorder ["result"] = $_POST ["result"];
			$myorder ["transactionorigin"] = $_POST ["transactionorigin"];
			$myorder ["oid"] = $_POST ["oid"];
			$myorder ["ponumber"] = $_POST ["ponumber"];
			$myorder ["taxexempt"] = $_POST ["taxexempt"];
			$myorder ["terminaltype"] = $_POST ["terminaltype"];
			$myorder ["ip"] = $_POST ["ip"];
			
			# totals
			$myorder ["subtotal"] = $_POST ["subtotal"];
			$myorder ["tax"] = $_POST ["tax"];
			$myorder ["shipping"] = $_POST ["shipping"];
			$myorder ["vattax"] = $_POST ["vattax"];
			$myorder ["chargetotal"] = $_POST ["chargetotal"];
			
			# card info
			$myorder ["cardnumber"] = $_POST ["cardnumber"];
			$myorder ["cardexpmonth"] = $_POST ["cardexpmonth"];
			$myorder ["cardexpyear"] = $_POST ["cardexpyear"];
			$myorder ["cvmindicator"] = $_POST ["cvmindicator"];
			$myorder ["cvmvalue"] = $_POST ["cvmvalue"];
			
			# BILLING INFO
			$myorder ["name"] = $_POST ["name"];
			$myorder ["company"] = $_POST ["company"];
			$myorder ["address1"] = $_POST ["address1"];
			$myorder ["address2"] = $_POST ["address2"];
			$myorder ["city"] = $_POST ["city"];
			$myorder ["state"] = $_POST ["state"];
			$myorder ["country"] = $_POST ["country"];
			$myorder ["phone"] = $_POST ["phone"];
			$myorder ["fax"] = $_POST ["fax"];
			$myorder ["email"] = $_POST ["email"];
			$myorder ["addrnum"] = $_POST ["addrnum"];
			$myorder ["zip"] = $_POST ["zip"];
			
			# ITEMS AND OPTIONS
			# there are several ways to pass items and options; see sample SALE_MAXINFO.php
			

			$myorder ["items"] ["item1"] ["id"] = $_POST ["id"];
			$myorder ["items"] ["item1"] ["description"] = $_POST ["description"];
			$myorder ["items"] ["item1"] ["quantity"] = $_POST ["quantity"];
			$myorder ["items"] ["item1"] ["price"] = $_POST ["price"];
			
			#   Send transaction. Use one of two possible methods
			//	$result = $mylphp->process($myorder);       # use shared library model
			$result = $mylphp->curl_process ( $myorder ); # use curl methods
			$pagado = false;
			if ($result ["r_approved"] != "APPROVED") {
				if ($result ["r_approved"] == "DUPLICATE") {
					$myorder ["oid"] = $_POST ["oid"] . "-" . date ( "Y-m-d-H:i:s" );
					$myorder ["ponumber"] = $myorder ["oid"];
					$json->add ( "oid", "'" . $myorder ["oid"] . "'" );
					$result = $mylphp->curl_process ( $myorder );
					if ($result ["r_approved"] != "APPROVED") {
						$pagado = false;
					} else {
						$pagado = true;
					}
				} else {
					$pagado = false;
				}
			} else {
				$pagado = true;
			}
			$json->add ( "status", "'" . Utilidades::procesarTextoJSON ( $result ["r_approved"] ) . "'" );
			if ($pagado) {
				$json->add ( "code", "'" . Utilidades::procesarTextoJSON ( $result ["r_code"] ) . "'" );
				$json->add ( "pagado", "'Si'" );
				$ml->pagado = "Si";
				$ml->modificar ( "id" );
				$mlfactura = ModelLoader::crear ( "ax_facturaAnuncioTipo1" );
				$mlfactura->numero = $myorder ["oid"];
				$mlfactura->usuario = $mlax->id;
				$mlfactura->codigo = $result ["r_code"];
				$mlfactura->monto = $myorder ["chargetotal"];
				$mlfactura->descripcion = $myorder ["items"] ["item1"] ["description"];
				$other_data = "";
				$other_data .= "Nombre: " . $myorder ["name"] . "\n";
				$other_data .= "Compañia: " . $myorder ["company"] . "\n";
				$other_data .= "Direccion 1: " . $myorder ["address1"] . "\n";
				$other_data .= "Direccion 2: " . $myorder ["address2"] . "\n";
				$other_data .= "Ciudad: " . $myorder ["city"] . "\n";
				$other_data .= "Estado: " . $myorder ["state"] . "\n";
				$other_data .= "Pais: " . $myorder ["country"] . "\n";
				$other_data .= "Telefono: " . $myorder ["phone"] . "\n";
				$other_data .= "Fax: " . $myorder ["phone"] . "\n";
				$other_data .= "Email: " . $myorder ["email"] . "\n";
				$other_data .= "Numero de direccion: " . $myorder ["addrnum"] . "\n";
				$other_data .= "Zip code: " . $myorder ["zip"] . "\n";
				$mlfactura->other_data = $other_data;
				$mlfactura->insertar ();
			} else {
				$json->add ( "error", "'" . Utilidades::procesarTextoJSON ( $result ["r_error"] ) . "'" );
			
			}
		} else {
			$json->add ( "status", "'ERROR'" );
			$json->add ( "error", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( "The Advertisement don't exist" ) ) . "'" );
		}
	} else {
		$json->add ( "status", "'ERROR'" );
		$json->add ( "error", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( "You must logged" ) ) . "'" );
	}
}
function clickedAnuncioTipo1($json) {
	$anuncio = $_POST ["anuncio"];
	$seccion = $_POST ["seccion"];
	$mlanuncio = ModelLoader::crear ( "ax_anuncioTipo1" );
	if ($mlanuncio->buscarPorCampo ( array ("id" => $anuncio ) )) {
		Anuncio::insertarEstadisticaAnuncioTipo1 ( $mlanuncio, "Click", $seccion );
	}
}
function encriptar($usuario, $password) {
	return md5 ( sha1 ( $usuario . md5 ( $password ) ) . $usuario );
}
function logoutAdmAnuncio($json) {
	unset ( $_SESSION ["bSoccerUser"] );
	unset ( $_SESSION ["bSoccerType"] );
}
function loginAnuncio($json) {
	global $_IDIOMA;
	$usuario = $_POST ["usuario"];
	$mlaxpa = ModelLoader::crear ( "ax_usuarioPublicidad" );
	if ($mlaxpa->buscarPorCampo ( array ("usuario" => $usuario ) )) {
		$password = encriptar ( $usuario, $_POST ["password"] );
		if ($password === $mlaxpa->password) {
			$json->add ( "exito", "true" );
			$json->add ( "login", "true" );
			$_SESSION ["bSoccerUser"] = $usuario;
			$_SESSION ["bSoccerType"] = $mlaxpa->tipo;
			return;
		}
	}
	$json->add ( "exito", "false" );
	$json->add ( "error", "'" . $_IDIOMA->traducir ( "User or Password is not correct" ) . "'" );
}
function encriptarPasswordAnuncio($json) {
	$usuario = $_POST ["usuario"];
	$password = $_POST ["password"];
	$json->add ( "password", "'" . encriptar ( $usuario, $password ) . "'" );
}
function validarURL($json) {
	global $_IDIOMA;
	$url = $_POST ["url"];
	if (! preg_match ( '@^http://@', $url ))
		$url = 'http://' . $url; // Eliminamos http:// si viene incluida.
	$a_url = parse_url ( $url ); // Procesamos la URL.
	try {
		$fp = @fsockopen ( $a_url ['host'], 80, $errno, $errstr, 30 ); // Abrimos la conexión.
	} catch ( Exception $e ) {
		$json->add ( "exito", "false" );
		$json->add ( "error", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( $e->getMessage () ) ) . "'" );
		return;
	}
	if (! $fp) {
		$json->add ( "exito", "false" ); // Si no se puede abrir, devuelve FALSE.
		$json->add ( "error", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( "Can't open URL" ) ) . "'" );
		return;
	}
	$page .= isset ( $a_url ['path'] ) ? $a_url ['path'] : ''; // Creamos consulta, añadiendo el path si existe.	
	$page .= isset ( $a_url ['query'] ) ? '?' . $a_url ['query'] : ''; // hacemos lo mismo con el resto de la consulta
	fputs ( $fp, "GET $a_url[path]?$a_url[query] HTTP/1.0\r\nHost: $a_url[host]\r\nConnection: Close\r\n\r\n" );
	$head = fread ( $fp, 128 ); // Leemos la cabecera del fichero
	$response = split ( " ", $head ); // y la descomponemos.
	@fclose ( $fp ); // Cerramos la conexión.
	if (preg_match ( '#^HTTP/.*\s+[200|302|301|303]+\s#i', $head )) { // Comprobamos si contine los codigos de estado HTTP
		$json->add ( "exito", "true" ); //  200 o 302, si es así devolvemos TRUE
		$json->add ( "mensaje", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( "Link OK" ) ) . "'" );
	} else {
		$json->add ( "error", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( "URL not found" ) ) . "'" );
		$json->add ( "exito", "false" ); // en caso contrario devolvemos FALSE.
	}
}

function guardarMiAnunciante($json) {
	if (isset ( $_POST ["imagen4"] )) {
		$mlgr = ModelLoader::crear ( "ax_generalRegister" );
		if ($mlgr->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) )) {
			$mlgr->miAnunciante = $_POST ["imagen4"];
			$mlgr->miAnunciante = array_shift ( explode ( "?", $mlgr->miAnunciante ) );
			$mlgr->modificar ( "id" );
			$json->add ( "exito", "true" );
			$json->add ( "miAnunciante", "1" );
			$json->add ( "imgdir", "'$mlgr->miAnunciante'" );
			return;
		}
	}
	$json->add ( "exito", "false" );
}

function cambiarActivoInactivo($json) {
	$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
	if ($ml->buscarPorCampo ( array ("id" => $_POST ["anuncio"] ) )) {
		$ml->activo = $_POST ["activo"];
		if ($ml->modificar ( "id" )) {
			$json->add ( "exito", "true" );
			return;
		}
	}
	$json->add ( "exito", "false" );
}

function eliminarPaisAnuncio($json) {
	$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
	if ($ml->buscarPorCampo ( array ("id" => $_POST ["anuncio"] ) )) {
		$mlpais = ModelLoader::crear ( "ax_country" );
		if ($mlpais->buscarPorCampo ( array ("code2" => $_POST ["pais"] ) )) {
			if (! $ml->paises) {
				$paises = array ();
			} else {
				$paises = explode ( ",", $ml->paises );
			}
			$pos = array_search ( $_POST ["pais"], $paises );
			if ($pos !== false) {
				array_splice ( $paises, $pos, 1 );
			
			}
			$paises = implode ( ",", $paises );
			if ($paises) {
				$ml->paises = $paises;
			} else {
				$ml->campoLimpio ( "paises" );
			}
			if ($ml->modificar ( "id" )) {
				$json->add ( "exito", "true" );
				return;
			}
		}
	}
	$json->add ( "exito", "false" );
}

function adicionarPais($json) {
	$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
	if ($_POST ["anuncio"] !== "X") {
		if ($ml->buscarPorCampo ( array ("id" => $_POST ["anuncio"] ) )) {
			$mlpais = ModelLoader::crear ( "ax_country" );
			if ($mlpais->buscarPorCampo ( array ("code2" => $_POST ["pais"] ) )) {
				if (! $ml->paises) {
					$paises = array ();
				} else {
					$paises = explode ( ",", $ml->paises );
				}
				$paises [] = $_POST ["pais"];
				$ml->paises = implode ( ",", $paises );
				if ($ml->modificar ( "id" )) {
					$json->add ( "exito", "true" );
					return;
				}
			}
		}
	} else {
		$json->add ( "exito", "true" );
		return;
	}
	$json->add ( "exito", "false" );
}

function verificarCodigo($json) {
	global $_IDIOMA;
	$mlf = ModelLoader::crear ( "ax_formularioAnuncioTipo2" );
	$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
	if ($mlf->buscarPorCampo ( array ("codigo" => $_POST ["codigo"], "anunciante" => $_SESSION ["iSMuIdKey"], "estado" => "Activo" ) )) {
		if (! $ml->existePorCampo ( array ("codigo" => $mlf->id ) )) {
			$json->add ( "exito", "true" );
			$json->add ( "codigo", "'" . $mlf->id . "'" );
		} else {
			$json->add ( "exito", "false" );
			$json->add ( "error", "'" . $_IDIOMA->traducir ( "Your code has already been used before, please submit a new application." ) . "'" );
		}
	} else {
		$json->add ( "exito", "false" );
		$json->add ( "error", "'" . $_IDIOMA->traducir ( "Your code is incorrect, if you have one please first fill out the contact form" ) . "'" );
	}
}

function cambiarEstadoFormulario($json) {
	global $_IDIOMA;
	$ml = ModelLoader::crear ( "ax_formularioAnuncioTipo2" );
	$mlgr = ModelLoader::crear ( "ax_generalRegister" );
	if ($ml->buscarPorCampo ( array ("id" => $_POST ["id"] ) ) && $mlgr->buscarPorCampo ( array ("id" => $ml->anunciante ) )) {
		
		$ml->estado = "Activo";
		$ml->modificar ( "id" );
		QMail::add ( "codigoAnuncio", $mlgr->email, "Your Advertisement was Approved", "/templatemail/advertiseApproved.tpl", array ("nombre" => $ml->nombre . " " . $ml->apellidos, "codigo" => $ml->codigo ), "Usuario" );
		$json->add ( "exito", "true" );
	} else {
		$json->add ( "exito", "false" );
		$json->add ( "error", "'" . $_IDIOMA->traducir ( "The user or the ad does not exist" ) . "'" );
	}
}
function ingresarFormulario($json) {
	global $_IDIOMA;
	$ml = ModelLoader::crear ( "ax_formularioAnuncioTipo2" );
	foreach ( $_POST as $k => $v ) {
		try {
			$ml->__campo ( $k, $v );
		} catch ( MLFieldNotDefinedException $e ) {
		}
	}
	if (trim ( $_POST ["extension"] ) != "") {
		$ml->telefono = $_POST ["extension"] . "-" . $ml->telefono;
	}
	$ml->anunciante = $_SESSION ["iSMuIdKey"];
	$ml->fecha = date ( "Y-m-d H:i:s" );
	$ml->codigo = substr ( md5 ( $ml->fecha . time () . rand () ), 0, 10 );
	$ml->estado = 'Inactivo';
	try {
		$ml->insertar ();
	} catch ( MLRequiredFieldException $e ) {
		$json->add ( "exito", "false" );
		$json->add ( "error", "'" . $_IDIOMA->traducir ( $e->getMessage () ) . "'" );
		return;
	}
	$json->add ( "exito", "true" );
}

function verAnuncio($json) {
	$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
	if (isset ( $_POST ["id"] ) && $ml->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
		$anuncio = $ml->aJSON ( array ("fecha_inicio", "fecha_fin" ) );
		$json->add ( "anuncio", $anuncio );
		$ahora = time ();
		$inicio = strtotime ( $ml->fecha_inicio );
		$fin = strtotime ( $ml->fecha_fin );
		$resto = $fin - $ahora;
		$dias = intval ( $resto / (24 * 60 * 60) );
		$anuncio->add ( "dias", $dias );
		$horas = intval ( ($resto / (60 * 60)) % 24 );
		$anuncio->add ( "horas", $horas );
		$minutos = ($resto / (60 * 24)) % 60;
		$anuncio->add ( "minutos", $minutos );
		$total = $fin - $inicio;
		$presto = $ahora - $inicio;
		$presto = ceil ( $presto * 568 / $total ); //568 el tamaño total de la barra
		$anuncio->add ( "presto", $presto );
		$izqt = - 105;
		if ($presto + $izqt < 0) {
			$izqt = 0;
		}
		$anuncio->add ( "izqt", $izqt );
		$anuncio->add ( "fecha_inicio", "'" . date ( "d/m/Y", $inicio ) . "'" );
		$anuncio->add ( "fecha_fin", "'" . date ( "d/m/Y", $fin ) . "'" );
		$anuncio->add ( "ahora", "'" . date ( "d/m/Y", $ahora ) . "'" );
	}
}

function verAnuncioTipo1($json) {
	global $_IDIOMA;
	$json->codificacion = JSON::UTF8;
	$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
	if (isset ( $_POST ["id"] ) && $ml->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
		$perfiles = explode ( "::-::", $ml->perfiles );
		if (count ( $perfiles ) > 0) {
			ob_start ();
			if ($perfiles [0] === "*") {
				?><span><?php
				print $_IDIOMA->traducir ( "All Profile types" );
				?></span>
<br />
<?php
			} else {
				$mlperfil = ModelLoader::crear ( "ax_profile" );
				foreach ( $perfiles as $perfil ) {
					if ($mlperfil->buscarPorCampo ( array ("idprofile" => $perfil ) )) {
						?><span><?php
						print $_IDIOMA->traducir ( $mlperfil->profile );
						?></span>
<br /><?php
					}
				}
			}
			$ml->perfiles = ob_get_clean ();
		}
		$url = $ml->url;
		$url = explode ( "::--::", $url );
		if (count ( $url ) > 0) {
			switch ($url [0]) {
				case "http2" :
					$ml->url = "http://www.soccermash.com/" . $_IDIOMA->traducir ( "user" ) . "/" . $url [1];
					break;
				default :
					$url [1] = preg_replace ( "|^(http://)(.*)|i", "$2", $url [1] );
					$ml->url = "http://" . $url [1];
					break;
			}
		}
		$paises = explode ( "::-::", $ml->paises );
		ob_start ();
		if (count ( $paises ) > 0) {
			if ($paises [0] === "*") {
				print $_IDIOMA->traducir ( "All Countrys" );
				?><br />
<br /><?php
			} else {
				$mlpais = ModelLoader::crear ( "ax_country" );
				foreach ( $paises as $pais ) {
					if ($mlpais->buscarPorCampo ( array ("code2" => $pais ) )) {
						print $_IDIOMA->traducir ( $mlpais->country );
						?><br />
<br /><?php
					}
				}
			}
		}
		$ml->paises = ob_get_clean ();
		if (! $ml->desde) {
			$ml->desde = $_IDIOMA->traducir ( "Any age" );
		}
		if (! $ml->hasta) {
			$ml->hasta = $_IDIOMA->traducir ( "Any age" );
		}
		switch ($ml->sexo) {
			case "*" :
				$ml->sexo = $_IDIOMA->traducir ( "Todos" );
				break;
		}
		switch ($ml->tipo_anuncio) {
			case "Impresion" :
				$ml->tipo_anuncio = $_IDIOMA->traducir ( "View" );
				break;
			case "Tiempo" :
				$ml->tipo_anuncio = $_IDIOMA->traducir ( "Time" );
				break;
			default :
				$ml->tipo_anuncio = $_IDIOMA->traducir ( "Click" );
				break;
		}
		$ml->titulo = utf8_encode ( $ml->titulo );
		$ml->texto = utf8_encode ( $ml->texto );
		$anuncio = $ml->aJSON ();
		$mlstat = ModelLoader::crear ( "ax_estadisticaAnuncioTipo1" );
		$listas = $mlstat->seleccionar ( array ("count(1) as seccion,pais,tipo" ), "anuncio='$ml->id' group by pais,tipo" );
		$anuncio->add ( "stat", $statJSON = new JSON () );
		$stat = array ();
		foreach ( $listas as $value ) {
			if (! isset ( $stat [$value->pais] )) {
				$stat [$value->pais] = array ("click" => 0, "impresion" => 0 );
			}
			if ($value->tipo == "Impresion") {
				$stat [$value->pais] ["impresion"] = $value->seccion;
			}
			if ($value->tipo == "Click") {
				$stat [$value->pais] ["click"] = $value->seccion;
			}
		}
		$mlpais = ModelLoader::crear ( "ax_country" );
		if (count ( $stat ) > 0) {
			foreach ( $stat as $pais => $datos ) {
				if ($mlpais->buscarPorCampo ( array ("code2" => $pais ) )) {
					$statJSON->add ( $pais, $dpais = new JSON () );
					$dpais->add ( "nombre", "'" . Utilidades::procesarTextoJSON ( utf8_encode ( $_IDIOMA->traducir ( $mlpais->country ) ) ) . "'" );
					$dpais->add ( "click", $datos ["click"] );
					$dpais->add ( "impresion", $datos ["impresion"] );
				}
			}
		} else {
			$statJSON->add ( "nodata", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( "No stat data." ) ) . "'" );
		}
		$json->add ( "anuncio", $anuncio );
	
	}
}

function revisarImagen($json) {
	if (isset ( $_POST ["imagedir"] )) {
		$ml = ModelLoader::crear ( "ax_imagenConfiguracion" );
		$imgdir = $_POST ["imagedir"];
		$basedir = $_SERVER ["DOCUMENT_ROOT"] . "/goaamb/images/publi";
		$archivo = $basedir . "/original/$imgdir";
		if (is_file ( $archivo )) {
			list ( $w, $h, $type, $attr ) = getimagesize ( $archivo );
			$json->add ( "w", $w );
			$json->add ( "h", $h );
		
		}
		
		$archivo = $basedir . "/full/$imgdir";
		if (is_file ( $archivo )) {
			list ( $w, $h, $type, $attr ) = getimagesize ( $archivo );
			$json->add ( "wf", $w );
			$json->add ( "hf", $h );
			
			if (! $ml->buscarPorCampo ( array ("nombre" => $imgdir ) )) {
				$ml->cw = 50;
				$ml->ch = 50;
				$ml->ct = 0;
				$ml->cl = 0;
			}
			$ml->iw = $w;
			$ml->ih = $h;
			$json->add ( "conf", $ml->aJSON ( array ("id", "nombre" ) ) );
		}
		$archivo = $basedir . "/thumb/$imgdir";
		if (is_file ( $archivo )) {
			list ( $w, $h, $type, $attr ) = getimagesize ( $archivo );
			$json->add ( "wt", $w );
			$json->add ( "ht", $h );
		
		}
		$json->add ( "imgdir", "'$imgdir'" );
	}
}

function revisarAnuncio($json) {
	global $_IDIOMA;
	$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
	$mlx = ModelLoader::crear ( "ax_anuncioTipo2" );
	$editar = false;
	foreach ( $_POST as $k => $v ) {
		try {
			$ml->__campo ( $k, $v );
		} catch ( MLFieldNotDefinedException $e ) {
		}
	}
	$ml->imagen1 = array_shift ( explode ( "?", $ml->imagen1 ) );
	$ml->imagen2 = array_shift ( explode ( "?", $ml->imagen2 ) );
	$ml->imagen3 = array_shift ( explode ( "?", $ml->imagen3 ) );
	if ($ml->id && $mlx->existePorCampo ( array ("id" => $ml->id ) )) {
		$editar = true;
	}
	if (! $editar) {
		$ml->anunciante = $_SESSION ["iSMuIdKey"];
		$ahora = time ();
		$despues = $ahora + 365 * 24 * 60 * 60;
		$ml->fecha_inicio = date ( "Y-m-d", $ahora );
		$ml->fecha_fin = date ( "Y-m-d", $despues );
		$ml->activo = "No";
	}
	try {
		if (! $editar) {
			$ml->titulo = ($ml->titulo);
			$json->add ( "id", $ml->insertar () );
		} else {
			if ($mlx->titulo !== $ml->titulo) {
				$ml->titulo = ($ml->titulo);
			}
			$ml->modificar ( "id" );
			$json->add ( "id", $ml->id );
		}
	} catch ( MLRequiredFieldException $e ) {
		$json->add ( "exito", "false" );
		$json->add ( "error", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( $e->getMessage () ) ) . "'" );
		return;
	}
	$json->add ( "exito", "true" );
	$json->add ( "revisar", "1" );
}
function revisarAnuncioTipo1($json) {
	global $_IDIOMA;
	$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
	$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
	$editar = false;
	if (isset ( $_POST ["id"] ) && $ml->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
		$editar = true;
	}
	
	foreach ( $_POST as $k => $v ) {
		try {
			$ml->__campo ( $k, $v );
		} catch ( MLFieldNotDefinedException $e ) {
		}
	}
	if (intval ( $ml->cantidad ) <= 0) {
		$json->add ( "exito", "false" );
		$json->add ( "error", "'" . $_IDIOMA->traducir ( "The amount is required" ) . "'" );
		return;
	}
	
	if (! $editar) {
		$ml->imagen = $_POST ["imagen5"];
		$ml->imagen = array_shift ( explode ( "?", $ml->imagen ) );
		$ml->anunciante = $_SESSION ["iSMuIdKey"];
		$ahora = time ();
		$despues = $ahora + 365 * 24 * 60 * 60;
		$ml->fecha_inicio = date ( "Y-m-d", $ahora );
		$ml->fecha_fin = date ( "Y-m-d", $despues );
		$ml->activo = "No";
		$ml->pagado = "No";
	
	}
	$mltarifa = ModelLoader::crear ( "ax_tarifa" );
	if ($mltarifa->buscarPorCampo ( array ("tipo" => $ml->tipo_anuncio ) )) {
		$ml->costo = ceil ( $mltarifa->precio * $ml->cantidad * 10 ) / 10;
	}
	$ml->texto = htmlentities ( iconv ( "UTF-8", "ISO-8859-15", $ml->texto ), ENT_COMPAT, 'ISO-8859-15' );
	$ml->titulo = htmlentities ( iconv ( "UTF-8", "ISO-8859-15", $ml->titulo ), ENT_COMPAT, 'ISO-8859-15' );
	try {
		if (! $editar) {
			$json->add ( "id", $ml->insertar () );
		} else {
			$ml->modificar ( "id" );
			$json->add ( "id", $ml->id );
		}
	} catch ( MLRequiredFieldException $e ) {
		$json->add ( "exito", "false" );
		$json->add ( "error", "'" . Utilidades::procesarTextoJSON ( $_IDIOMA->traducir ( $e->getMessage () ) ) . "'" );
		return;
	}
	$json->add ( "exito", "true" );
	$json->add ( "revisar", "1" );
}
function crearImagen1($json) {
	$dirgo = "goaamb/images/publi/original/";
	$dirgf = "goaamb/images/publi/full/";
	$dirgt = "goaamb/images/publi/thumb/";
	$imgdir = "";
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
			$pi = pathinfo ( $file ["name"] );
			$ext = $pi ["extension"];
			if (! $imgdir) {
				do {
					$rand = date ( "YmdHis" ) . rand ();
					$archivo = "goaamb/images/publi/original/" . $rand . "." . $ext;
				} while ( is_file ( $archivo ) );
			} else {
				$rand = array_shift ( explode ( ".", $imgdir ) );
				$archivo = "goaamb/images/publi/original/" . $rand . "." . $ext;
			}
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
				$ml = ModelLoader::crear ( "ax_imagenConfiguracion" );
				
				if (! $ml->buscarPorCampo ( array ("nombre" => $imgdir ) )) {
					$ml->cw = 50;
					$ml->ch = 50;
					$ml->ct = 0;
					$ml->cl = 0;
				}
				$ml->iw = $wi;
				$ml->ih = $hi;
				$json->add ( "conf", $ml->aJSON ( array ("id", "nombre" ) ) );
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
}

function redimensionarImagen($json) {
	$jpg = array ("jpeg", "jpg" );
	$png = array ("png" );
	$gif = array ("gif" );
	$validmime = array_merge ( $jpg, $png, $gif );
	$w = intval ( $_POST ["imageWidth"] );
	$h = intval ( $_POST ["imageHeight"] );
	$cw = intval ( $_POST ["crop_width"] );
	$ch = intval ( $_POST ["crop_height"] );
	$ct = intval ( $_POST ["crop_offset_top"] );
	$cl = intval ( $_POST ["crop_offset_left"] );
	
	switch (intval ( $_POST ["imageWho"] )) {
		case 2 :
			$imagenAncho = 103;
			$imagenAlto = 33;
			break;
		case 3 :
			$imagenAncho = 45;
			$imagenAlto = 45;
			break;
		case 4 :
			$imagenAncho = 180;
			$imagenAlto = 50;
			break;
		case 5 :
			$imagenAncho = 80;
			$imagenAlto = 80;
			break;
		default :
			$imagenAncho = 60;
			$imagenAlto = 25;
			break;
	}
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
	$tipo = "jpg";
	$imagen = explode ( "?", $_POST ["imagenEditor"] );
	$imagen = $imagen [0];
	$archivo = "goaamb/images/publi/full/" . $imagen;
	$pi = pathinfo ( $archivo );
	$ext = $pi ["extension"];
	if (array_search ( strtolower ( $ext ), $jpg ) !== false) {
		$image = imagecreatefromjpeg ( $archivo );
		$tipo = "jpg";
	} elseif (array_search ( strtolower ( $ext ), $png ) !== false) {
		$image = imagecreatefrompng ( $archivo );
		$tipo = "png";
	} elseif (array_search ( strtolower ( $ext ), $gif ) !== false) {
		$image = imagecreatefromgif ( $archivo );
		$tipo = "gif";
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
		$endfile = "goaamb/images/publi/thumb/" . $imagen;
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
		$json->add ( "who", "'" . $_POST ["imageWho"] . "'" );
		$json->add ( "imgdir", "'" . $imagen . "'" );
		$json->add ( "exito", "true" );
		$ml = ModelLoader::crear ( "ax_imagenConfiguracion" );
		$editar = $ml->buscarPorCampo ( array ("nombre" => $imagen ) );
		$ml->iw = "" . $w;
		$ml->ih = "" . $h;
		$ml->cw = "" . $cw;
		$ml->ch = "" . $ch;
		$ml->ct = "" . $ct;
		$ml->cl = "" . $cl;
		$ml->nombre = $imagen;
		if ($editar) {
			$ml->modificar ( "id" );
		} else {
			$ml->insertar ();
		}
	} else {
		$json->add ( "exito", "false" );
	}
}
function cambiarActivoInactivoAnuncioTipo1($json) {
	$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
	if ($ml->buscarPorCampo ( array ("id" => $_POST ["anuncio"] ) )) {
		$ml->activo = $_POST ["activo"];
		if ($ml->modificar ( "id" )) {
			$json->add ( "exito", "true" );
			return;
		}
	}
	$json->add ( "exito", "false" );
}

function cambiarPagadoAnuncioTipo1($json) {
	$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
	if ($ml->buscarPorCampo ( array ("id" => $_POST ["anuncio"] ) )) {
		$ml->pagado = $_POST ["activo"];
		if ($ml->modificar ( "id" )) {
			$json->add ( "exito", "true" );
			return;
		}
	}
	$json->add ( "exito", "false" );
}
function eliminarAnuncioTipo1($json) {
	$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
	if ($ml->buscarPorCampo ( array ("id" => $_POST ["anuncio"] ) )) {
		if ($ml->eliminar ( "id" )) {
			$json->add ( "exito", "true" );
			return;
		}
	}
	$json->add ( "exito", "false" );
}
function eliminarAnuncio($json) {
	$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
	if ($ml->buscarPorCampo ( array ("id" => $_POST ["anuncio"] ) )) {
		if ($ml->eliminar ( "id" )) {
			$json->add ( "exito", "true" );
			return;
		}
	}
	$json->add ( "exito", "false" );
}
?>