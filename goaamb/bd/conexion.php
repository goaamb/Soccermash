<?php
/**
 * Inclusion de una clase abstracta que permite
 *
 */
if (! isset ( $_GBASE )) {
	$_GBASE = "";
}
require_once "campotabla.php";
require_once $_GBASE . "/goaamb/util/util.php";

class GConexion {
	private $hostname;
	private $user;
	private $password;
	private $bdname;
	public $__conexion;
	
	public function __construct($hostname, $user, $password, $bdname) {
		$this->hostname = $hostname;
		$this->user = ($user);
		$this->password = ($password);
		$this->bdname = $bdname;
	}
	
	public function estaConectado() {
		if ($this->conexion) {
			return true;
		}
		return false;
	}
	
	public function abrir() {
		$this->conexion = @mysql_connect ( $this->hostname, $this->user, $this->password );
		if ($this->conexion) {
			//mysql_set_charset ( 'utf8' );
			return @mysql_select_db ( $this->bdname );
		}
		return false;
	}
	
	public function cerrar() {
		if ($this->conexion) {
			mysql_close ( $this->conexion );
		}
	}

	public function consulta($query) {
		if ($this->conexion) {
			$query = str_replace ( "'", '\'', $query );
			//$query = str_replace ( "\\'", '\'', $query );
			
			$resultado = @mysql_query ( $query, $this->conexion );
			if ($resultado) {
				return $resultado;
			}
			//var_dump($this->conexion );
			$query = str_ireplace ( "\n", '\\n', $query );
			$error = mysql_error ( $this->conexion );
			$error = str_ireplace ( "'", '\'', $error );
			$error = str_ireplace ( "\n", '\\n', $error );
			throw new Exception ( "Error en la Consulta: \"" . substr ( $query, 0, 200 ) . "\", " . $error );
		}
		return false;
	}
	
	public function insertar($tabla, $campos) {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			$listakeys = array_keys ( $campos );
			foreach ( $listakeys as $i => $campo ) {
				$listakeys [$i] = "`" . $campo . "`";
			}
			$listacampos = implode ( ",", $listakeys );
			
			foreach ( $campos as $campo => $valor ) {
				if ($valor == "" || $valor == null) {
					$campos [$campo] = "NULL";
				} else {
					$campos [$campo] = "'" . $valor . "'";
				}
			}
			$listavalores = implode ( ",", $campos );
			$consulta = "insert into $tabla($listacampos) values($listavalores);";
			if ($this->consulta ( $consulta )) {
				return mysql_insert_id ( $this->conexion );
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida, por esto no se pudo ingresar" );
	}
	
	public function seleccionarAsociado($tabla, $campos = "", $where = "", $inicio = 0, $limite = -1) {
	  	return $this->seleccionar ( $tabla, $campos, $where, $inicio, $limite, true );
	}
	
	public function seleccionar($tabla, $campos = "", $where = "", $inicio = 0, $limite = -1, $asociado = false) {
		if ($this->conexion) {
			if ($campos != "") {
				$listacampos = "";
				$listacampos = implode ( ",", $campos );
			} else {
			$listacampos = "*";
			}
			if ($where != "") {
				$where = "where $where";
			}
			$limit = "";
			if ($limite != - 1) {
				$limit = "limit $inicio,$limite";
			}
			$tabla = $this->minimizarTablas ( $tabla );
			$consulta = "select $listacampos from $tabla $where $limit";
			$resultado = $this->consulta ( $consulta );
			if ($resultado) {
				$filas = array ();
				do {
					if (! $asociado) {
						$unafila = @mysql_fetch_row ( $resultado );
					} else {
						$unafila = @mysql_fetch_assoc ( $resultado );
					}
					if ($unafila) {
						array_push ( $filas, $unafila );
					}
				
				} while ( $unafila );
				if (count ( $filas ) > 0) {
					return $filas;
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida, por esto no se pudo seleccionar" );
	}
	
	public function existe($tabla, $campo, $condicion = "") {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			if (is_array ( $campo )) {
				$campos = implode ( ",", $campo );
			} else {
				$campos = $campo;
			}
			if ($condicion != "") {
				$condicion = "where $condicion";
			}
			$resultado = $this->consulta ( "select $campos from $tabla $condicion" );
			if ($resultado) {
				$unafila = @mysql_fetch_row ( $resultado );
				if ($unafila) {
					if (is_array ( $campo )) {
						$devolucion = null;
						for($i = 0; $i < count ( $campo ); $i ++) {
							array_push ( $devolucion, $unafila [$i] );
						}
						return $devolucion;
					} else {
						return $unafila [0];
					}
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	
	private function minimizarTablas($tablas) {
		$tablas = explode ( ",", $tablas );
		foreach ( $tablas as $indice => $unatabla ) {
			$tablas [$indice] = Utilidades::priMinuscula ( trim ( $unatabla ) );
		}
		$tablas = implode ( ",", $tablas );
		return $tablas;
	}
	
	public function modificar($tabla, $campos, $where = "") {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			$listavalores = "";
			$listakeys = array_keys ( $campos );
			$tamcampos = count ( $campos );
			foreach ( $campos as $campo => $valor ) {
				if ($valor == "" || $valor == null) {
					$campos [$campo] = "NULL";
				} else {
					$campos [$campo] = "'" . $valor . "'";
				}
			}
			for($i = 0; $i < $tamcampos; $i ++) {
				$listavalores .= $listakeys [$i] . "=" . $campos [$listakeys [$i]];
				if ($i < $tamcampos - 1) {
					$listavalores .= ",";
				}
			}
			if ($where != "") {
				$where = "where $where";
			}
			$consulta = "update $tabla set $listavalores $where";
			return $this->consulta ( $consulta );
		}
		throw new Exception ( "La conexion no fue establecida, por esto no se pudo modificar" );
	}
	
	public function eliminar($tabla, $where = "") {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			if ($where != "") {
				$where = "where $where";
			}
			$consulta = "delete from $tabla $where";
			return $this->consulta ( $consulta );
		}
		throw new Exception ( "La conexion no fue establecida, por esto no se pudo eliminar" );
	}
	
	public function obtenerColumnasTabla($tabla) {
		if ($this->conexion) {
			$unicas = $this->obtenerUnicas ( $tabla );
			$tabla = $this->minimizarTablas ( $tabla );
			$foraneas = $this->obtenerForaneas ( $tabla );
			$comentarios = $this->obtenerComentarios ( $tabla );
			$listaforaneas = array ();
			if ($foraneas) {
				foreach ( $foraneas as $i => $fora ) {
					$listaforaneas [$fora ["campoOrigen"]] = $i;
				}
			}
			$resultado = $this->consulta ( "SHOW COLUMNS FROM $tabla" );
			if ($resultado) {
				$listacampos = array ();
				do {
					$unafila = @mysql_fetch_object ( $resultado, "CampoTabla", array ($tabla ) );
					if ($unafila && $unafila instanceof CampoTabla) {
						if (array_search ( $unafila->Nombre (), $unicas ) !== false) {
							$unafila->Llave ( "UNI" );
							$unafila->Unico ( true );
						}
						$pos = isset ( $listaforaneas [$unafila->Nombre ()] ) ? $listaforaneas [$unafila->Nombre ()] : false;
						if ($pos !== false) {
							$unafila->Llave ( "MUL" );
							$unafila->llaveForanea ( array ("tabla" => $foraneas [$pos] ["tablaDestino"], "campo" => $foraneas [$pos] ["campoDestino"] ) );
						}
						if (array_key_exists ( $unafila->Nombre (), $comentarios )) {
							$unafila->Comentario ( $comentarios [$unafila->Nombre ()] );
						}
						array_push ( $listacampos, $unafila );
					}
				} while ( $unafila );
				if (count ( $listacampos ) > 0) {
					return $listacampos;
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	
	public function obtenerColumna($tabla, $columna) {
		if ($this->conexion) {
			$unicas = $this->obtenerUnicas ( $tabla );
			$tabla = $this->minimizarTablas ( $tabla );
			$resultado = $this->consulta ( "SHOW COLUMNS FROM $tabla" );
			if ($resultado) {
				do {
					$unafila = @mysql_fetch_object ( $resultado, "CampoTabla", array ($tabla ) );
					if ($unafila && strcasecmp ( $unafila->Nombre (), $columna ) == 0) {
						if (array_search ( $unafila->Nombre (), $unicas ) != - 1) {
							$unafila->Llave ( "UNI" );
						}
						return $unafila;
					}
				} while ( $unafila );
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	
	public function obtenerTablas() {
		if ($this->conexion) {
			$resultado = @mysql_list_tables ( $this->bdname );
			if ($resultado) {
				$listatbls = array ();
				do {
					$unafila = @mysql_fetch_row ( $resultado );
					if ($unafila) {
						array_push ( $listatbls, $unafila [0] );
					}
				} while ( $unafila );
				if (count ( $listatbls ) > 0) {
					return $listatbls;
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	
	public function obtenerUnicas($tabla) {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			$resultado = $this->consulta ( "show create table $tabla" );
			if ($resultado) {
				$createtable = @mysql_fetch_row ( $resultado );
				if ($createtable) {
					$listaux = explode ( ",\n", $createtable [1] );
					$listafinal = array ();
					foreach ( $listaux as $elemento ) {
						$listaux2 = array ();
						$patron = "/UNIQUE KEY\s*`[a-zA-Z0-9\_\-\.]*`\s*\(([a-zA-Z0-9\_\-\.`\,]*)\)/";
						$match = array ();
						if (preg_match ( $patron, $elemento, $match )) {
							$list = explode ( "`,`", $match [1] );
							if ($list > 0) {
								$list [0] = str_replace ( "`", "", $list [0] );
								$list [count ( $list ) - 1] = str_replace ( "`", "", $list [count ( $list ) - 1] );
							}
							foreach ( $list as $el ) {
								array_push ( $listafinal, $el );
							}
						}
					}
					return ($listafinal);
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	
	public function obtenerPrimarias($tabla) {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			$resultado = $this->consulta ( "show create table $tabla" );
			if ($resultado) {
				$createtable = @mysql_fetch_row ( $resultado );
				if ($createtable) {
					$listaux = explode ( ",\n", $createtable [1] );
					$listafinal = array ();
					foreach ( $listaux as $elemento ) {
						$listaux2 = array ();
						$patron = "/PRIMARY KEY\s*`[a-zA-Z0-9\_\-\.]*`\s*\(([a-zA-Z0-9\_\-\.`\,]*)\)/";
						$match = array ();
						if (preg_match ( $patron, $elemento, $match )) {
							$list = explode ( "`,`", $match [1] );
							if ($list > 0) {
								$list [0] = str_replace ( "`", "", $list [0] );
								$list [count ( $list ) - 1] = str_replace ( "`", "", $list [count ( $list ) - 1] );
							}
							foreach ( $list as $el ) {
								array_push ( $listafinal, $el );
							}
						}
					}
					return ($listafinal);
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	
	public function obtenerComentarios($tabla) {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			$resultado = $this->consulta ( "show create table $tabla" );
			if ($resultado) {
				$createtable = @mysql_fetch_row ( $resultado );
				if ($createtable) {
					$listaux = explode ( ",\n", $createtable [1] );
					$listafinal = array ();
					foreach ( $listaux as $elemento ) {
						$listaux2 = array ();
						$patron = "/`([a-zA-Z0-9\_\-\.]*)`.*COMMENT\s*'(.*)'/";
						$match = array ();
						if (preg_match ( $patron, $elemento, $match )) {
							$campo = $match [1];
							$comment = $match [2];
							$listafinal [$campo] = $comment;
						}
					}
					return ($listafinal);
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	
	public function obtenerForaneas($tabla) {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			$engine = strtolower ( $this->obtenerMotorTabla ( $tabla ) );
			if ($engine == "innodb") {
				$resultado = $this->consulta ( "show create table $tabla" );
				if ($resultado) {
					$createtable = @mysql_fetch_row ( $resultado );
					if ($createtable) {
						$listaux = explode ( ",\n", $createtable [1] );
						$listafinal = array ();
						foreach ( $listaux as $elemento ) {
							if (strpos ( strtoupper ( $elemento ), "CONSTRAINT" ) > 0) {
								$listaux2 = array ();
								$pos1 = strpos ( strtoupper ( $elemento ), "FOREIGN KEY" ) + 14;
								$sobra = substr ( $elemento, $pos1 );
								$pos2 = strpos ( strtoupper ( $sobra ), "`" );
								$listaux2 ["campoOrigen"] = substr ( $elemento, $pos1, $pos2 );
								$pos1 += $pos2 + 1;
								$sobra = substr ( $elemento, $pos1 );
								$pos1 += strpos ( strtoupper ( $sobra ), "`" ) + 1;
								$sobra = substr ( $elemento, $pos1 );
								$pos2 = strpos ( strtoupper ( $sobra ), "`" );
								$listaux2 ["tablaDestino"] = substr ( $elemento, $pos1, $pos2 );
								$pos1 += $pos2 + 1;
								$sobra = substr ( $elemento, $pos1 );
								$pos1 += strpos ( strtoupper ( $sobra ), "`" ) + 1;
								$sobra = substr ( $elemento, $pos1 );
								$pos2 = strpos ( strtoupper ( $sobra ), "`" );
								$listaux2 ["campoDestino"] = substr ( $elemento, $pos1, $pos2 );
								array_push ( $listafinal, $listaux2 );
							}
						}
						return ($listafinal);
					}
				}
			} else {
				$foraneosfile = "xml/relations.xml";
				if (is_file ( $foraneosfile )) {
					$xml = simplexml_load_file ( $foraneosfile );
					$tablax = $xml->xpath ( "/relations/$tabla" );
					if ($tablax) {
						$listafinal = array ();
						$tablax = $tablax [0];
						foreach ( $tablax->foraneo as $foraneo ) {
							$listaux2 = array ();
							$listaux2 ["campoOrigen"] = ( string ) $foraneo->campoOrigen;
							$listaux2 ["tablaDestino"] = ( string ) $foraneo->tablaDestino [0];
							$listaux2 ["campoDestino"] = ( string ) $foraneo->campoDestino [0];
							array_push ( $listafinal, $listaux2 );
						}
						return $listafinal;
					}
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	public function obtenerMotorTabla($tabla) {
		if ($this->conexion) {
			$tabla = $this->minimizarTablas ( $tabla );
			$resultado = $this->consulta ( "show create table $tabla" );
			if ($resultado) {
				$createtable = @mysql_fetch_row ( $resultado );
				if ($createtable) {
					$createtable = str_replace ( "\n", "", $createtable [1] );
					$match = array ();
					if (preg_match ( "/.*\s+engine\s*=\s*([^\s]+)\s+/i", $createtable, $match )) {
						return $match [1];
					}
				}
			}
			return false;
		}
		throw new Exception ( "La conexion no fue establecida" );
	}
	public function obtenerBaseDatos() {
		if ($this->conexion) {
			$resultado = @mysql_list_dbs ( $this->conexion );
			if ($resultado) {
				$listabds = array ();
				do {
					$unafila = @mysql_fetch_object ( $resultado );
					if ($unafila) {
						array_push ( $listabds, $unafila->Database );
					}
				} while ( $unafila );
				if (count ( $listabds ) > 0) {
					return $listabds;
				}
			}
		}
		return false;
	}

}
?>
