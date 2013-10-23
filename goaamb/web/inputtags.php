<?php
require_once ('tags.php');
class InputTag extends Tag {
	protected $tipo;
	protected $validacion;
	protected $decimal;
	protected $parteentera;
	const NUMERICA = 1;
	const ALFABETICA = 2;
	const ALFANUMERICA = 3;
	const DECIMAL = 4;
	const FECHA = 8;
	const NOVALIDACION = 0;
	const TEXTFIELD = 256;
	const TEXTAREA = 512;
	const PASSWORD = 1024;
	const HIDDEN = 2048;

	function __construct($type = self::TEXTFIELD, $validacion = self::NOVALIDACION) {
		parent::__construct ( "input" );
		$this->tipo ( $type );
		$this->decimal = - 1;
		$this->parteentera = - 1;
		$this->validacion ( $validacion );
	}

	function tipo($tipo = null) {
		if ($tipo != null && $tipo != $this->tipo) {
			$this->tipo = $tipo;
			switch ($tipo) {
				case self::TEXTAREA :
					$this->taghtml = "textarea";
					break;
				case self::PASSWORD :
					$this->setAttribute ( "type", "password" );
					break;
				case self::HIDDEN :
					$this->setAttribute ( "type", "hidden" );
					break;
				default :
					$this->setAttribute ( "type", "text" );
					break;
			}
		}
		return $this->tipo;
	}

	public function validacion($validacion = "") {
		if ($validacion != "" && $this->validacion != $validacion) {
			if ($validacion == self::FECHA) {
				$this->resetEvento ( "onkeyup", $validacion );
				$this->resetEvento ( "onkeydown", $validacion );
				$this->resetEvento ( "onclick", $validacion );
				$this->resetEvento ( "oncontextmenu", $validacion );
			} else {
				$this->resetEvento ( "onkeyup", $validacion );
				$this->resetEvento ( "onkeydown", $validacion );
				$this->resetEvento ( "onclick", $validacion );
				$this->resetEvento ( "oncontextmenu", $validacion );
			}
		}
		return $this->validacion;
	}

	private function resetEvento($evento, $validacion) {
		$eventotexto = $this->getAttribute ( $evento );
		$nuevavalidacion = str_replace ( $this->dartextovalidacion ( $this->validacion, $evento ), "", $eventotexto );
		$this->validacion = $validacion;
		$this->setAttribute ( $evento, $nuevavalidacion );
	}

	private function dartextovalidacion($validacion, $evento) {
		switch ($validacion) {
			case self::NUMERICA :
				switch ($evento) {
					case "onkeyup" :
						if ($this->parteentera != - 1) {
							return "this.value=validador.validarEnteros(this.value,$this->parteentera);";
						}
						return "this.value=validador.validarEnteros(this.value);";
						break;
					default :
						return "";
						break;
				}
				break;
			case self::ALFABETICA :
				switch ($evento) {
					case "onkeyup" :
						return "this.value=validador.validarAlfabetico(this.value);";
						break;
					default :
						return "";
						break;
				}
				break;
			case self::ALFANUMERICA :
				switch ($evento) {
					case "onkeyup" :
						return "this.value=validador.validarAlfaNumerico(this.value);";
						break;
					default :
						return "";
						break;
				}
				break;
			case self::DECIMAL :
				switch ($evento) {
					case "onkeyup" :
						if ($this->decimal != - 1 && $this->parteentera != - 1) {
							return "this.value=validador.validarDecimal(this.value,$this->parteentera,$this->decimal);";
						}
						if ($this->parteentera != - 1) {
							return "this.value=validador.validarDecimal(this.value,$this->parteentera);";
						}
						if ($this->decimal != - 1) {
							return "this.value=validador.validarDecimal(this.value,null,$this->decimal);";
						}
						return "this.value=validador.validarDecimal(this.value);";
						break;
					default :
						return "";
						break;
				}
				break;
			case self::FECHA :
				switch ($evento) {
					case "oncontextmenu" :
						return "return false;";
						break;
					case "onkeydown" :
						return "return false;";
						break;
					default :
						return "";
						break;
				}
				break;
			default :
				return "";
				break;
		}
		return "";
	}

	/**
	 * @see Tag::setAttribute()
	 *
	 * @param string $attr
	 * @param string $valor
	 */
	public function setAttribute($attr, $valor) {
		$attr = strtolower ( $attr );
		if ($attr == "onkeyup" || $attr == "onkeydown" || $attr == "onclick" || $attr == "oncontextmenu") {
			return parent::setAttribute ( $attr, $this->dartextovalidacion ( $this->validacion, $attr ) . $valor );
		} elseif ($attr == "type") {
			$valor = strtolower ( $valor );
			switch ($valor) {
				case "textarea" :
					$this->tipo = self::TEXTAREA;
					break;
				case "password" :
					$this->tipo = self::PASSWORD;
					break;
				case "hidden" :
					$this->tipo = self::HIDDEN;
					break;
				default :
					$this->tipo = self::TEXTFIELD;
					break;
			}
		}
		return parent::setAttribute ( $attr, $valor );
	}
	public function decimal($decimal = "") {
		if ($decimal != "") {
			$this->decimal = $decimal;
		}
		return $this->decimal;
	}
	public function parteEntera($parteEntera = "") {
		if ($parteEntera != "") {
			$this->parteentera = $parteEntera;
		}
		return $this->parteentera;
	}
}

?>