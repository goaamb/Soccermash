<?php

require_once ('goaamb/php/web/maphtml.php');
require_once ('tags.php');

/**
 * Clase encargada de generar los un Mapa en HTML
 *
 */
class Mapa extends Tag {

	/**
	 * Constructor que instacia un Objeto de la Clase Map
	 * requiere un nombre
	 *
	 * @param string $nombre
	 */
	public function __construct($nombre) {
		parent::__construct ( "map" );
		$this->setAttribute ( "name", $nombre );

	}

	/**
	 * @see Tag::add()
	 *
	 * Añade un Area al mapa
	 *
	 * @param Area $algo
	 * @return bool
	 */
	public function add($algo) {
		return parent::add ( $algo );
	}

}

class Area extends Tag {

	/**
	 * Coordenadas de los diferentes puntos que constituyen el area
	 *
	 * @var Poligono
	 */
	protected $coords;

	function __construct($coords = "") {
		parent::__construct ( "area" );
		$this->coords = new Poligono ( );
		if (is_string ( $coords )) {
			$coords = explode ( ",", $coords );
		}
		if (is_array ( $coords )) {
			$this->coords->add ( $coords );
			$this->setAttribute ( "coords", $this->coords->toString () );
		}
	}
	/**
	 * funcion que permite modificar el campo coords
	 * y tambien sirve para obtener su valor
	 *
	 * @param Poligono $coords
	 * @return Poligono
	 */
	public function coords($coords = null) {
		if ($coords != null && ! $this->coords->equal ( $coords )) {
			$this->coords->set ( $coords );
			$this->setAttribute ( "coords", $this->coords->toString () );
		}
		return $this->coords;
	}
}

class PolygonArea extends Area {
	public function __construct($coords = "") {
		parent::__construct ( $coords );
		$this->setAttribute ( "shape", "poly" );
	}
}

class Punto {
	protected $x;
	protected $y;
	/**
	 * Instacia un objeto de la clase Punto
	 *
	 * @param Punto|int $x
	 * @param int $y
	 */
	public function __construct($x = 0, $y = 0) {
		$this->set ( $x, $y );
	}

	public function x($x = null) {
		if ($x != null && $x != $this->x) {
			$this->x = $x;
		}
		return $this->x;
	}
	public function y($y = null) {
		if ($y != null && $y != $this->y) {
			$this->y = $y;
		}
		return $this->y;
	}
	/**
	 * Verifica si otro punto es igual
	 *
	 * @param Punto $punto
	 * @return bool
	 */
	public function equals($punto) {
		if ($punto != null && ( $punto instanceof Punto )) {
			if ($this->x == $punto->x () && $this->y == $punto->y ()) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Asigna nuevos valores a 'x' y 'y'
	 *
	 * @param Punto|int $x
	 * @param int $y
	 */
	public function set($x = 0, $y = 0) {
		if (( $x instanceof Punto )) {
			$this->x = $x->x ();
			$this->y = $x->y ();
		} else {
			$this->x = intval ( $x );
			$this->y = intval ( $y );
		}
	}

	public function toString() {
		return $this->x . "," . $this->y;
	}
}

class Poligono {
	protected $puntos;
	function __construct() {
		$this->puntos = array ( );
	}
	/**
	 * Añade un punto al poligono
	 *
	 * @param Punto|array $punto
	 */
	public function add($punto) {
		if (( $punto instanceof Punto )) {
			array_push ( $this->puntos, $punto );
		} else {
			if (is_array ( $punto )) {
				if (count ( $punto ) > 0) {
					$unarreglo = $this->splitDualPoint ( $punto );
					$this->puntos = array_merge ( $this->puntos, $unarreglo );
				}
			}
		}
	}

	private function splitDualPoint($arreglo) {
		if (is_array ( $arreglo )) {
			$salida = array ( );
			if (count ( $arreglo ) > 0) {
				if (( $arreglo [0] instanceof Punto )) {
					foreach ( $arreglo as $punto ) {
						array_push ( $salida, $punto );
					}
				} else {
					for($i = 0; $i < count ( $arreglo ); $i += 2) {
						$x = 0;
						if ($arreglo [$i]) {
							$x = intval ( $arreglo [$i] );
						}
						$y = 0;
						if ($arreglo [$i + 1]) {
							$y = intval ( $arreglo [$i + 1] );
						}
						array_push ( $salida, new Punto ( $x, $y ) );
					}
				}
			}
			return $salida;
		}
		return null;
	}
	public function getPunto($posicion) {
		if (intval ( $posicion ) < count ( $this->puntos )) {
			return $this->puntos [$posicion];
		}
		return null;
	}

	/**
	 * Cambia el valor de un determinado punto en una posicion
	 *
	 * @param int $posicion
	 * @param Punto|int $x
	 * @param int $y
	 */
	public function setPunto($posicion, $x = 0, $y = 0) {
		if (intval ( $posicion ) < count ( $this->puntos )) {
			$this->puntos [$posicion]->set ( $x, $y );
		}
	}

	public function removePunto($posicion) {
		if (intval ( $posicion ) < count ( $this->puntos )) {
			$elpunto = $this->getPunto ( $posicion );
			$nuevospuntos = array ( );
			foreach ( $this->puntos as $index => $punto ) {
				if ($index != $posicion) {
					array_push ( $nuevospuntos, $punto );
				}
			}
			$this->puntos = $nuevospuntos;
			return $elpunto;
		}
		return null;
	}
	public function size() {
		return count ( $this->puntos );
	}

	/**
	 * Compara un poligono con otro
	 *
	 * @param Poligono $poligono
	 * @return bool
	 */
	public function equal($poligono) {
		if (( $poligono instanceof Poligono )) {
			if ($poligono->size () == $this->size ()) {
				for($i = 0; $i < $poligono->size (); $i ++) {
					if (! $this->puntos [$i]->equals ( $poligono->getPunto ( $i ) )) {
						return false;
					}
				}
				return true;
			}
		}
		return false;
	}

	/**
	 * Reasigna los valores del Poligono
	 *
	 * @param Poligono $poligono
	 */
	public function set($poligono) {
		if (( $poligono instanceof Poligono )) {
			$this->puntos = array ( );
			for($i = 0; $i < $poligono->size (); $i ++) {
				array_push ( $this->puntos, $poligono->getPunto ( $i ) );
			}
		} else {
			if (is_array ( $poligono )) {
				if (count ( $poligono ) > 0) {
					$this->puntos = $this->splitDualPoint ( $poligono );
				}
			}
		}
	}

	/**
	 * Convierte en String el Poligono
	 *
	 * @return string
	 */
	public function toString() {
		$retorno = "";
		foreach ( $this->puntos as $index => $punto ) {
			$retorno .= $punto->toString ();
			if ($index < $this->size () - 1) {
				$retorno .= ",";
			}
		}
		return $retorno;
	}

}

class RectangleArea extends Area {

	/**
	 * Constructor de la Clase
	 *
	 * @param string|array|Poligono $coords
	 */
	public function __construct($coords = "") {
		parent::__construct ();
		$this->setAttribute ( "shape", "rect" );
		$this->coords ( $coords );
	}

	/**
	 * @see Area::coords()
	 *
	 * @param string|array|Poligono $coords
	 * @return Poligono
	 */
	public function coords($coords = null) {
		if (is_string ( $coords )) {
			$coords = explode ( ",", $coords );
		}
		if (is_array ( $coords )) {
			$nuevopoligono = new Poligono ( );
			$nuevopoligono->add ( $coords );
			$coords = $nuevopoligono;
		}
		if (( $coords instanceof Poligono )) {
			$nuevopoligono = new Poligono ( );
			if ($coords->size () > 4) {
				$nuevopoligono = new Poligono ( );
				for($i = 0; $i < 4; $i ++) {
					$nuevopoligono->add ( $coords->getPunto ( $i ) );
				}
			} else {
				$nuevopoligono = new Poligono ( );
				for($i = 0; $i < $coords->size (); $i ++) {
					$nuevopoligono->add ( $coords->getPunto ( $i ) );
				}
			}
			$coords = $nuevopoligono;
		}
		parent::coords ( $coords );
	}
}

class Circle extends Area {

	/**
	 * Centro de la circunferencia
	 *
	 * @var Punto
	 */
	protected $centro;
	/**
	 * Radio de la Circunferencia
	 *
	 * @var int
	 */
	protected $radio;
	/**
	 * Contructor de la clase
	 *
	 * @param int $radio
	 * @param int|Punto $x
	 * @param int $y
	 */
	public function __construct($radio, $x = 0, $y = 0) {
		if (( $x instanceof Punto )) {
			parent::__construct ( array ($x->x (), $x->y (), $radio ) );
		} else {
			parent::__construct ( array (intval ( $x ), intval ( $y ), $radio ) );
		}
		$this->radio = intval ( $radio );
		$this->centro ( $x, $y );
		$this->setAttribute ( "shape", "circle" );
	}
	/**
	 * Devuelvo o modifica el centro de la circunferencia
	 *
	 * @param int|Punto $x
	 * @param int $y
	 * @return Punto
	 */
	public function centro($x = null, $y = null) {
		if ($this->centro == null) {
			$this->centro = new Punto ( );
		}
		if (( $x instanceof Punto )) {
			if (! $this->centro->equals ( $x )) {
				$this->centro->set ( $x );
				$this->coords->setPunto ( 0, $x );
				$this->setAttribute ( "coords", $this->centro->toString () . "," . $this->radio );
			}
		} else {
			$this->centro->set ( $x, $y );
			$this->coords->setPunto ( 0, $x, $y );
			$this->setAttribute ( "coords", $this->centro->toString () . "," . $this->radio );
		}
		return $this->centro;
	}
	/**
	 * Devuelvo o modifica radio de la circunferencia
	 *
	 * @param int $radio
	 */
	public function radio($radio = null) {
		if ($radio != null) {
			$unpunto = new Punto ( $radio, 0 );
			$elradio = $this->coords->getPunto ( 1 );
			if (! $unpunto->equals ( $elradio )) {
				$this->radio = $radio;
				$this->coords->setPunto ( 1, $unpunto );
				$this->setAttribute ( "coords", $this->centro->toString () . "," . $this->radio );
			}
		}
		return $this->radio;
	}
}
?>