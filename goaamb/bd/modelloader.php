<?php
require_once 'conexion.php';
class ModelLoader {
	protected $__tabla;
	protected $__conected;
	protected $__columnas;
	/**
	 * Conexion con la base de datos
	 *
	 * @var Conexion
	 */
	protected $__conexion;
	protected $__campos;
	protected $__etiquetas;
	const ASCENDENT = 0;
	const DESCENDENT = 1;
	const INCLUYENTE = 2;
	const EXCLUYENTE = 4;
	private static $_modelos = array ();
	
	/**
	 * Singleton Maker for Model Loader
	 * @param string $tabla
	 * @return ModelLoader
	 */
	static function crear($tabla) {
		if (! array_key_exists ( $tabla, self::$_modelos )) {
			self::$_modelos [$tabla] = new ModelLoader ( $tabla );
		}
		return clone (self::$_modelos [$tabla]);
	}
	
	function __construct($tabla, $etiquetas = array()) {
		global $conexion;
		$this->__tabla = $tabla;
		$this->__conected = false;
		$this->__columnas = $conexion->obtenerColumnasTabla ( $tabla );
		$this->__campos = array ();
		foreach ( $this->__columnas as $columna ) {
			$nom = strtolower ( $columna->Nombre () );
			$this->__campos [$nom] = null;
			if (isset ( $etiquetas [$nom] )) {
				$this->__etiquetas [$nom] = htmlentities ( $etiquetas [$nom] );
			} elseif ($columna->Comentario ()) {
				$this->__etiquetas [$nom] = ucfirst ( $columna->Comentario () );
			} else {
				$this->__etiquetas [$nom] = ucfirst ( $nom );
			}
		}
		$this->__conected = $this->__columnas ? true : false;
		$this->__conexion = $conexion;
	}
	
	function beginTrans() {
		if ($this->__conected) {
			$this->__conexion->consulta ( "SET autocommit=0;" );
			$this->__conexion->consulta ( "START TRANSACTION;" );
		
		}
	}
	
	function commit() {
		if ($this->__conected) {
			$this->__conexion->consulta ( "COMMIT;" );
		}
	}
	
	function rollBack() {
		if ($this->__conected) {
			$this->__conexion->consulta ( "ROLLBACK;" );
		}
	}
	
	/**
	 * Devuelve el las especificaciones de un campo de la tabla en la base de datos
	 *
	 * @param string $campo
	 * @return CampoTabla
	 */
	public function buscarColumna($campo) {
		$campo = strtolower ( $campo );
		foreach ( $this->__columnas as $columna ) {
			if (strtolower ( $columna->Nombre () ) == $campo) {
				return $columna;
			}
		}
		return false;
	}
	
	public function etiqueta($campo) {
		if (array_key_exists ( $campo, $this->__etiquetas )) {
			return $this->__etiquetas [$campo];
		}
		return ucfirst ( $campo );
	}
	
	function campoLimpio($campo) {
		$campo = strtolower ( $campo );
		if (array_key_exists ( $campo, $this->__campos )) {
			$this->__campos [$campo] = null;
		}
	}
	
	/**
	 * Enter description here ...
	 * @param string $campo
	 * @param string|integer $valor
	 * @throws MLFieldNotDefinedException
	 */
	function __campo($campo, $valor = null) {
		$valor = $valor === "" ? null : $valor;
		$campo = strtolower ( $campo );
		$mensaje = null;
		if (array_key_exists ( $campo, $this->__campos )) {
			$columna = $this->buscarColumna ( $campo );
			if ($valor !== null && $valor !== $this->__campos [$campo]) {
				if (($campotabla = $this->buscarColumna ( $campo ))) {
					if ($campotabla->esEntero () && ! is_int ( intval ( $valor ) )) {
						$mensaje = "El atributo $campo debe ser entero, valor: $valor";
					} elseif ($campotabla->esPuntoFlotante () && ! is_double ( doubleval ( $valor ) )) {
						$mensaje = "El atributo $campo debe ser decimal, valor: $valor";
					} elseif ($campotabla->esPuntoFlotante () && ! is_double ( doubleval ( $valor ) )) {
						$mensaje = "El atributo $campo debe ser decimal, valor: $valor";
					}
					if ($mensaje == null) {
						$this->__campos [$campo] = $valor;
					}
				}
			}
			if ($mensaje == null) {
				return $this->__campos [$campo];
			}
		}
		throw new MLFieldNotDefinedException ( $this->etiqueta ( $campo ) );
	}
	
	function __get($name) {
		return $this->__campo ( $name );
	}
	
	function __set($name, $valor) {
		$this->__campo ( $name, $valor );
	}
	
	function campos() {
		return $this->__campos;
	}
	
	function seleccionar($campos, $condicion = "", $inicio = 0, $fin = -1) {
		$modelos = array ();
		if ($this->__conected) {
			$registros = $this->__conexion->seleccionarAsociado ( $this->__tabla, $campos, $condicion, $inicio, $fin );
			if ($registros) {
				foreach ( $registros as $registro ) {
					$modelo = ModelLoader::crear ( $this->__tabla );
					foreach ( $registro as $campo => $valor ) {
						$modelo->__campo ( $campo, $valor );
					}
					array_push ( $modelos, $modelo );
				}
			}
		}
		return $modelos;
	}
	
	/**
	 * @param string $condicion
	 * @param int $inicio
	 * @param int $fin
	 * @return array
	 */
	function listar($condicion = "", $inicio = 0, $fin = -1) {
		$condicion = str_replace ( "\\'", "'", $condicion );
		return $this->seleccionar ( array ("*" ), $condicion, $inicio, $fin );
	}
	function contar($condicion = "") {
		$filas = $this->__conexion->seleccionar ( $this->__tabla, array ("count(*) " ), $condicion );
		if ($filas) {
			return $filas [0] [0];
		}
		return 0;
	}
	function maximo($campo = "", $condicion = "") {
		if (! $condicion) {
			$condicion = "1";
		}
		$filas = $this->__conexion->seleccionar ( $this->__tabla, array ("max($campo) " ), $condicion );
		if ($filas) {
			return $filas [0] [0];
		}
		return 0;
	}
	function minimo($campo = "", $condicion = "") {
		if (! $condicion) {
			$condicion = "1";
		}
		$filas = $this->__conexion->seleccionar ( $this->__tabla, array ("min($campo) " ), $condicion );
		if ($filas) {
			return $filas [0] [0];
		}
		return 0;
	}
	
	function camposUnicos() {
		$campos = array ();
		//$this->__conexion->obtenerUnicas ( $this->__tabla );
		foreach ( $this->__columnas as $col ) {
			if (($col->esLlavePrimaria () || $col->esUnico ()) && ! $col->esAutoIncremental ()) {
				array_push ( $campos, $col->Nombre () );
			}
		}
		return $campos;
	}
	
	function camposPrimarios() {
		$campos = array ();
		//$this->__conexion->obtenerPrimarias ( $this->__tabla );
		foreach ( $this->__columnas as $col ) {
			if ($col->esLlavePrimaria ()) {
				array_push ( $campos, $col->Nombre () );
			}
		}
		return $campos;
	}
	
	function existe($tipo = ModelLoader::EXCLUYENTE) {
		if ($this->__conected) {
			if ($tipo == ModelLoader::EXCLUYENTE) {
				$tipo = " or ";
			} else {
				$tipo = " and ";
			}
			$campos = array ();
			$unicos = $this->camposUnicos ();
			foreach ( $unicos as $campo ) {
				$campo = strtolower ( $campo );
				array_push ( $campos, "$campo='" . $this->__campos [$campo] . "'" );
			}
			if (count ( $campos ) > 0) {
				return $this->__conexion->seleccionar ( $this->__tabla, array ("*" ), implode ( $tipo, $campos ) );
			}
		}
		return false;
	}
	
	function existePorCampo($campos) {
		$lista = $this->listarPorCampos ( $campos, ModelLoader::ASCENDENT, 0, 1 );
		return count ( $lista ) > 0;
	}
	
	function limpiar() {
		foreach ( $this->__campos as $k => $v ) {
			$this->__campos [$k] = null;
		}
	}
	
	function verificarCampos() {
		$campos = array ();
		foreach ( $this->__campos as $campo => $valor ) {
			$col = $this->buscarColumna ( $campo );
			if ($col) {
				if (! $col->esNulo () && ! $col->esAutoIncremental () && $valor === null) {
					throw new MLRequiredFieldException ( $campo, $this );
				}
			}
			if ($valor != null) {
				$campos [$campo] = str_replace ( "'", "\'", $valor );
			}
		}
		return $campos;
	}
	
	function insertar() {
		if ($this->__conected) {
			if (! $this->existe ()) {
				$campos = $this->verificarCampos ();
				if (count ( $campos ) > 0) {
					return $this->__conexion->insertar ( $this->__tabla, $campos );
				}
			} else {
				$unicos = $this->camposUnicos ();
				$pre = "Los datos de los campos " . implode ( " o ", $unicos ) . ", ya existen en el sistema";
				if (count ( $unicos ) == 1) {
					$pre = "El dato del campo " . $unicos [0] . ", ya existe en el sistema";
				}
				throw new MLException ( $pre );
			}
		}
		return false;
	}
	function modificar($id) {
		if ($this->__conected) {
			$valorid = $this->__campo ( $id );
			if ($this->existePorCampo ( array ($id => $valorid ) )) {
				$campos = array ();
				foreach ( $this->__campos as $campo => $valor ) {
					$bcamp = $this->buscarColumna ( $campo );
					if ($valor != null || $bcamp->esNulo ()) {
						$campos [$campo] = str_replace ( "'", "\'", $valor );
					}
				}
				if (count ( $campos ) > 0) {
					return $this->__conexion->modificar ( $this->__tabla, $campos, "$id='$valorid'" );
				}
			} else {
				throw new MLException ( "El " . $this->__tabla . " no existe" );
			}
		}
		return false;
	}
	
	function eliminar($id) {
		if ($this->__conected) {
			$valorid = $this->__campo ( $id );
			if ($this->existePorCampo ( array ($id => $valorid ) )) {
				return $this->__conexion->eliminar ( $this->__tabla, "$id='$valorid'" );
			} else {
				throw new MLException ( "El " . $this->__tabla . " no existe" );
			}
		}
		return false;
	}
	
	public function listarPorCampos($campos, $orden = ModelLoader::ASCENDENT, $inicio = 0, $fin = -1) {
		$tcampos = array ();
		$pricampo = null;
		foreach ( $campos as $c => $v ) {
			$v = str_replace ( "'", "`", $v );
			array_push ( $tcampos, "$c='$v'" );
			if ($pricampo == null) {
				$pricampo = $c;
			}
		}
		if (count ( $tcampos ) > 0) {
			if ($pricampo != null) {
				if ($orden == ModelLoader::ASCENDENT) {
					$orden = " order by " . $pricampo . " asc";
				} else {
					$orden = " order by " . $pricampo . " desc";
				}
			}
			return $this->listar ( implode ( " and ", $tcampos ) . " $orden", $inicio, $fin );
		}
		return array ();
	}
	
	public function buscarPorCampo($campo) {
		$lista = $this->listarPorCampos ( $campo, ModelLoader::ASCENDENT, 0, 1 );
		if (count ( $lista ) > 0) {
			foreach ( $lista [0]->__campos as $c => $v ) {
				if ($v !== null) {
					$this->__campo ( $c, $v );
				} else {
					$this->campoLimpio ( $c );
				}
			}
		} else {
			$this->limpiar ();
		}
		return count ( $lista ) > 0;
	}
	
	/**
	 * Convierte a formato JSON la estructura y datos de una tabla capturados por el ModelLoader
	 * @param $novisibles Array
	 * @param $prefijo string
	 * @return JSON
	 */
	public function aJSON($novisibles = array(), $prefijo = "", $utf = false) {
		if (! is_array ( $novisibles )) {
			$novisibles = array ();
		}
		$json = new JSON ();
		foreach ( $this->__campos as $c => $v ) {
			if (Utilidades::estaDentroArreglo ( $novisibles, $c ) == - 1) {
				$colcamp = $this->buscarColumna ( $c );
				if ($colcamp->esFechaTiempo ()) {
					$v = date ( "d/m/Y H:i:s", strtotime ( $v ) );
				} elseif ($colcamp->esFecha ()) {
					$v = date ( "d/m/Y", strtotime ( $v ) );
				}
				if (! $utf) {
					$v = utf8_encode ( $v );
				}
				$json->add ( $prefijo . $c, "'" . Utilidades::procesarTextoJSON ( $v ) . "'" );
			}
		}
		return $json;
	}
	
	/**
	 * @param Array $tablas
	 * @param Array $visibles
	 * @return Tag|Tabla
	 */
	public function aTabla($tablas, $novisibles = array(), $fn = "", $truncado = 0, $utf = false, $filtro = false, $fnf = "", $tval = "", $cval = "") {
		require_once 'goaamb/web/tablahtml.php';
		if ($filtro && $fnf) {
			$caption = new Tag ( "caption" );
			$caption->add ( "Filtrar por:" );
			$caption->add ( $select = new Tag ( "select", "", array ("id" => "filtroBusqueda" ) ) );
			foreach ( $this->__etiquetas as $camp => $val ) {
				if (Utilidades::estaDentroArreglo ( $novisibles, $camp ) == - 1) {
					if (! $utf) {
						$val = utf8_encode ( $val );
					}
					$select->add ( $opc = new Tag ( "option", $val, array ("value" => $camp ) ) );
					if ($tval == $camp) {
						$opc->selected = "selected";
					}
				}
			}
			$caption->add ( new Tag ( "input", "", array ("id" => "criterioBusqueda", "value" => $cval ) ) );
			$caption->add ( new Tag ( "input", "", array ("id" => "criterioBusqueda", "type" => "button", "value" => "Filtrar", "onclick" => "$fnf('$this->__tabla',0,true)" ) ) );
		}
		if (count ( $tablas ) > 0) {
			$t = new Tabla ();
			$t->setAttribute ( "width", "100%" );
			$t->setAttribute ( "cellpadding", "0" );
			$t->setAttribute ( "cellspacing", "0" );
			if ($filtro && $fnf) {
				$t->add ( $caption );
			}
			foreach ( $this->__etiquetas as $camp => $val ) {
				if (Utilidades::estaDentroArreglo ( $novisibles, $camp ) == - 1) {
					if (! $utf) {
						$val = utf8_encode ( $val );
					}
					$t->addHead ( $val );
				}
			}
			for($i = 0; $i < count ( $tablas ); $i ++) {
				$pri = false;
				foreach ( $tablas [$i]->__campos as $camp => $val ) {
					if (! $pri) {
						$pri = $val;
					}
					if (Utilidades::estaDentroArreglo ( $novisibles, $camp ) == - 1) {
						$colcamp = $tablas [$i]->buscarColumna ( $camp );
						if ($colcamp->esFechaTiempo ()) {
							$val = date ( "d/m/Y H:i:s", strtotime ( $val ) );
						} elseif ($colcamp->esFecha ()) {
							$val = date ( "d/m/Y", strtotime ( $val ) );
						} elseif ($colcamp->esText ()) {
							$val = nl2br ( htmlentities ( $val ) );
						}
						if (intval ( $truncado ) > 0 && strlen ( $val ) > $truncado) {
							$val = substr ( $val, 0, $truncado - 3 ) . "...";
						}
						if (! $utf) {
							$val = utf8_encode ( $val );
						}
						$c = $t->addColumn ( strlen ( "" . $val ) > 0 ? $val : "{Ninguno}", $i );
						$fx = "";
						if ($fn != "") {
							$fx = "$fn(\"" . $pri . "\")";
						}
						$c->onclick = $fx;
					
		//$c->getParent ()->setAttribute ( "onclick", $fx );
					}
				}
			}
			return $t;
		} else {
			$p = new Tag ( "p", "No hay registros para desplegar " );
			if ($filtro && $fnf) {
				$caption->setTag ( "div" );
				$p->insert ( $caption, 0 );
			}
			
			return $p;
		}
	}
	
	/**
	 * @param Array $tablas
	 * @param String $id
	 * @param String $value
	 * @return Tag
	 */
	public function aSelect($tablas, $nombre, $id, $value, $defecto = false, $dump = false, $texto = false, $pretexto = array()) {
		if (count ( $tablas ) > 0) {
			$s = new Tag ( "select" );
			$s->setAttribute ( "id", $nombre );
			$s->setAttribute ( "name", $nombre );
			if ($dump) {
				$s->add ( $o = new Tag ( "option", $texto ) );
				$o->setAttribute ( "value", "" );
				if (! $defecto) {
					$o->selected = "selected";
				}
			}
			
			foreach ( $tablas as $item ) {
				if ($item instanceof ModelLoader) {
					$pre = "";
					if (is_array ( $pretexto ) && count ( $pretexto ) > 0) {
						$keys = array_keys ( $pretexto );
						$columna = $item->buscarColumna ( $keys [0] );
						if ($columna->esLlaveForanea ()) {
							$ff = $columna->llaveForanea ();
							$idf = $ff ["campo"];
							$tablaf = $ff ["tabla"];
							$MLP = ModelLoader::crear ( $tablaf );
							if ($MLP->buscarPorCampo ( array ($idf => $item->__campo ( $keys [0] ) ) )) {
								$pre = $MLP->__campo ( $pretexto [$keys [0]] ) . " - ";
							}
						}
					}
					if (is_string ( $pretexto ) && trim ( $pretexto ) != "") {
						$pre = $item->__campo ( $pretexto ) . " - ";
					}
					$s->add ( $o = new Tag ( "option", $pre . $item->__campo ( $value ) ) );
					$o->setAttribute ( "value", $item->__campo ( $id ) );
					if ($defecto == $item->__campo ( $id )) {
						$o->setAttribute ( "selected", "selected" );
					}
				}
			}
			return $s;
		} else {
			$p = new Tag ( "p", "No hay registros" );
			return $p;
		}
	}
	
	/**
	 * @param Array $novisibles
	 * @param Array $hidden
	 * @param Array $foreaneos
	 * @param Array $condicionF
	 * @param Array $prefijo
	 * @return Tag
	 */
	public function aForm($novisibles = array(), $hidden = array(), $foraneos = array(), $condicionF = array(), $prefijo = "") {
		
		if (! is_array ( $novisibles )) {
			$novisibles = array ();
		}
		if (! is_array ( $hidden )) {
			$hidden = array ();
		}
		if (! is_array ( $foraneos )) {
			$foraneos = array ();
		}
		if (! is_array ( $condicionF )) {
			$condicionF = array ();
		}
		
		$form = new Tag ( "form" );
		$form->setAttribute ( "id", "Form" . $this->__tabla )->setAttribute ( "name", "Form" . $this->__tabla );
		foreach ( $this->__campos as $campo => $valor ) {
			$inp = null;
			if (Utilidades::estaDentroArreglo ( $novisibles, $campo ) == - 1 && Utilidades::estaDentroArreglo ( $hidden, $campo ) == - 1) {
				$form->add ( $div = new Tag ( "div" ) );
				$div->add ( $ss = new Tag ( "span", $this->__etiquetas [$campo] . ":" ) );
				$columna = $this->buscarColumna ( $campo );
				if (! $columna->esNulo ()) {
					$ss->add ( "*" );
				}
				if ($columna->esLlaveForanea () && isset ( $foraneos [$campo] )) {
					$foranea = $columna->llaveForanea ();
					$MLP = ModelLoader::crear ( $foranea ["tabla"] );
					$dump = false;
					if ($columna->esNulo ()) {
						$dump = true;
					}
					$idcampo = $foranea ["campo"];
					$valcampo = $foranea ["campo"];
					$prevalor = array ();
					if (Utilidades::estaDentroArregloKeys ( $foraneos, $campo ) != - 1) {
						$idcampo = $foraneos [$campo] ["id"];
						$valcampo = $foraneos [$campo] ["valor"];
						$prevalor = $foraneos [$campo] ["prevalor"];
					}
					$cond = "";
					if (Utilidades::estaDentroArregloKeys ( $condicionF, $campo )) {
						$cond = $condicionF [$campo];
					}
					$s = $this->aSelect ( $MLP->listar ( $cond ), $campo, $idcampo, $valcampo, $valor, $dump, "Ninguno", $prevalor );
					$s->setAttribute ( "id", $prefijo . $campo )->setAttribute ( "name", $prefijo . $campo );
					$div->add ( $s );
					if ($s->getTag () != "select") {
						$div->add ( $inp = new Tag ( "input" ) );
						$inp->setAttribute ( "type", "hidden" );
					}
				} elseif ($columna->esText ()) {
					$div->add ( $inp = new Tag ( "textarea" ) );
					$inp->add ( $valor );
				} elseif ($columna->esEnum ()) {
					$div->add ( $inp = new Tag ( "select" ) );
					$opts = $columna->enumItems ();
					if ($opts) {
						foreach ( $opts as $opt ) {
							$inp->add ( $opti = new Tag ( "option", $opt ) );
							$opti->setAttribute ( "value", $opt );
						}
					}
				} elseif ($columna->esTiempo ()) {
					$div->add ( $inp = new Tag ( "select" ) );
					for($i = 0; $i < 24; $i ++) {
						$horax = str_pad ( $i, 2, "0", STR_PAD_LEFT );
						$auxh = $horax . ":00:00";
						$inp->add ( $opti = new Tag ( "option", $auxh ) );
						$opti->setAttribute ( "value", $auxh );
						if ($auxh == $valor) {
							$opti->selected = "selected";
						}
						$auxh = $horax . ":30:00";
						$inp->add ( $opti = new Tag ( "option", $auxh ) );
						$opti->setAttribute ( "value", $auxh );
						if ($auxh == $valor) {
							$opti->selected = "selected";
						}
					}
				} else {
					$div->add ( $inp = new Tag ( "input" ) );
					if ($columna->esEntero ()) {
						$inp->onkeypress = "return G.valid.int.call(this,event);";
					}
					if ($columna->esPuntoFlotante ()) {
						$inp->onkeypress = "return G.valid.float.call(this,event);";
					}
				}
			} elseif (Utilidades::estaDentroArreglo ( $hidden, $campo ) != - 1) {
				$form->add ( $inp = new InputTag ( InputTag::HIDDEN ) );
			}
			if ($inp != null) {
				if ($valor && isset ( $columna ) && ($columna instanceof CampoTabla) && $columna->esFecha ()) {
					$valor = date ( "d/m/Y", strtotime ( $valor ) );
				}
				$inp->setAttribute ( "id", $prefijo . $campo )->setAttribute ( "name", $prefijo . $campo )->setAttribute ( "value", $valor );
			}
		}
		return $form;
	}
	
	public function tabla() {
		return $this->__tabla;
	}
}

/**
 * Enter description here ...
 * @author alvaro
 *
 */
class MLRequiredFieldException extends MLException {
	public $tabla;
	public $campo;
	public function __construct($campo, $tabla) {
		$this->tabla = $tabla;
		$this->campo = $campo;
		$etiqueta = $this->tabla ? $tabla->etiqueta ( $campo ) : ucfirst ( $campo );
		parent::__construct ( "Field: $etiqueta is required", 0 );
	}
}
class MLException extends Exception {
	public function __construct($mensaje, $code = 0) {
		parent::__construct ( $mensaje, $code );
	}
}
class MLFieldNotDefinedException extends MLException {
	public function __construct($campo, $code = 0) {
		parent::__construct ( "Field: $campo is not defined", $code );
	}
}
?>