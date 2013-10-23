<?php
require_once $_GBASE . '/goaamb/web/jstag.php';
class JSON {
	private $items;
	private $values;
	private $tabs;
	private $tipo;
	private $tag;
	private $parent;
	
	const LLAVES = 0;
	const CORCHETES = 1;
	const OBJETO = self::LLAVES;
	const ARREGLO = self::CORCHETES;
	const UTF8 = 2;
	const NOUTF8 = 4;
	public $codificacion = self::NOUTF8;
	public $renderTab = false;
	public $endLine = false;
	/**
	 * Contructor de la clase
	 *
	 * @param JSTag $tag
	 */
	public function __construct($tag = null, $tipo = self::LLAVES) {
		$this->items = array ();
		$this->values = array ();
		$this->tag = $tag;
		$this->tipo = $tipo;
		if ($tag instanceof JSTag) {
			$this->tabs = $tag->tabs ();
		} else {
			$this->tabs = 0;
		}
		$this->parent = null;
	}
	
	public function setParent($parent = null) {
		if ($parent != $this->parent) {
			$this->parent = $parent;
		}
		return $this->parent;
	}
	
	public function tabs($tabs = null) {
		if ($tabs != $this->tabs) {
			$this->tabs = $tabs;
		}
		return $this->tabs;
	}
	
	public function tipo($tipo = null) {
		if ($tipo != $this->tipo) {
			$this->tipo = $tipo;
		}
		return $this->tipo;
	}
	
	/**
	 * Adiere Items
	 *
	 * @param string $item
	 * @param string|JSTag|JSON $value
	 */
	public function add($item, $value) {
		if (($value instanceof JSTag) || ($value instanceof JSON)) {
			$value->tabs ( $this->tabs + 1 );
		}
		if ($value instanceof JSON) {
			$value->setParent ( $this );
		}
		array_push ( $this->items, $item );
		array_push ( $this->values, $value );
	}
	
	public function join($json) {
		if ($json instanceof JSON) {
			foreach ( $json->items as $i => $item ) {
				array_push ( $this->items, $item );
				array_push ( $this->values, $json->values [$i] );
			}
		}
	}
	
	public function render() {
		$filas = array ();
		foreach ( $this->items as $indice => $item ) {
			$lodelitem = "";
			if (trim ( $item ) != "") {
				$lodelitem = $item . ": ";
			}
			$fila = "";
			if ($this->renderTab) {
				$fila = $this->renderTabs ( 1 );
			}
			$fila .= $lodelitem . $this->values [$indice];
			array_push ( $filas, $fila );
		}
		$separador = ",";
		if ($this->endLine) {
			$separador = ",\n";
		}
		$cadena = implode ( $separador, $filas );
		$cadena = $this->entreLC ( $cadena );
		if ($this->codificacion == self::UTF8) {
			$cadena = utf8_decode ( $cadena );
		}
		return $cadena;
	}
	
	public function printJSON() {
		print $this->render ();
	}
	
	protected function entreLC($contenido) {
		$cadena = "";
		if ($this->parent == null) {
			if ($this->renderTab) {
				$cadena = $this->renderTabs ();
			}
		}
		if ($this->tipo == self::LLAVES) {
			$cadena .= "{";
			if ($this->endLine) {
				$cadena .= "\n";
			}
			$cadena .= $contenido;
			if ($this->endLine) {
				$cadena .= "\n";
			}
			if ($this->renderTab) {
				$cadena .= $this->renderTabs ();
			}
			$cadena .= "}";
		} else {
			$cadena .= "[";
			if ($this->endLine) {
				$cadena .= "\n";
			}
			$cadena .= $contenido;
			if ($this->endLine) {
				$cadena .= "\n";
			}
			if ($this->renderTab) {
				$cadena .= $this->renderTabs ();
			}
			$cadena .= "]";
		}
		return $cadena;
	}
	
	private function renderTabs($tab = 0) {
		$tab = $this->tabs + $tab;
		$cadena = "";
		for($i = 0; $i < $tab; $i ++) {
			$cadena .= "\t";
		}
		return $cadena;
	}
	
	public function __toString() {
		return $this->render ();
	}

}
?>