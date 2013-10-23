<?php

require_once ($_GBASE.'/goaamb/web/tags.php');

class Select extends Tag {
	
	protected $items;
	protected $keys;
	protected $default;
	const SAMEVALUES = 2;
	const KEYVALUES = 3;
	
	public function __construct($items = null, $keys = self::SAMEVALUES, $default = false) {
		parent::__construct ( "select" );
		$this->default = $default;
		$this->keys = $keys;
		$this->items = array ();
		$this->items ( $items );
	}
	
	/**
	 * Devuelve los items dentro el select
	 *
	 * @param array $items
	 * @return array
	 */
	public function items($items = null) {
		if ($items != null) {
			if (is_array ( $items )) {
				$this->items = $items;
				$this->contenido = array ();
				foreach ( $this->items as $key => $item ) {
					switch ($this->keys) {
						case Select::SAMEVALUES :
							$this->add ( $o = new Option ( $item, $item ) );
							if ($this->default == $item) {
								$o->selected = "selected";
							}
							break;
						default :
							$this->add ( $o = new Option ( $item, $key ) );
							if ($this->default == $key) {
								$o->selected = "selected";
							}
							break;
					}
				}
			}
		}
		return $this->items;
	}
	
	public function readFromTable($tabla, $keys, $values = null, $conexionbd = null) {
		if ($conexionbd == null) {
			global $conexion;
			$conexionbd = $conexion;
		}
		if ($conexionbd->estaConectado ()) {
			
			if ($values == null) {
				$registro = $conexionbd->seleccionar ( $tabla, array ($keys ) );
				if ($registro) {
					$keys = array ();
					foreach ( $registro as $row ) {
						array_push ( $keys, $row [0] );
					}
					$this->keys = self::SAMEVALUES;
					$this->items ( $keys );
				}
			} else {
				$registro = $conexionbd->seleccionar ( $tabla, array ($keys, $values ) );
				if ($registro) {
					$keys = array ();
					$values = array ();
					foreach ( $registro as $row ) {
						array_push ( $keys, $row [0] );
						array_push ( $values, $row [1] );
					}
					$items = array_combine ( $keys, $values );
					$this->keys = self::KEYVALUES;
					$this->items ( $items );
				}
			}
		}
	}
}

class Option extends Tag {
	public function __construct($contenido = "", $value = "") {
		parent::__construct ( "option", $contenido );
		$this->setAttribute ( "value", $value );
	}
	public function value($value = null) {
		if ($value != null) {
			if ($value != $this->getAttribute ( "value" )) {
				$this->setAttribute ( "value", $value );
			}
		}
		return $this->getAttribute ( "value" );
	}
}
?>