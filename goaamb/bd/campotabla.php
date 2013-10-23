<?php
/**
 * Clase que sirve para volcar un campo con de una tabla
 *
 */
class CampoTabla {
	/**
	 * Nombre del Campo
	 *
	 * @var string
	 */
	protected $Field;
	/**
	 * Tipo del Campo
	 *
	 * @var string
	 */
	protected $Type;
	protected $Null;
	protected $Key;
	protected $Default;
	protected $Extra;
	protected $Tabla;
	protected $ForeignKey;
	protected $Comment;
	protected $Unico;
	
	/**
	 * Constructor
	 *
	 * @param string $Tabla nombre de la tabla
	 */
	public function __construct($Tabla) {
		$this->Tabla = $Tabla;
		$this->ForeignKey = null;
		$this->Unico = false;
	}
	
	/**
	 * Devuelve o modifica el Nombre del Campo
	 *
	 * @param sintr $Nombre
	 * @return string
	 */
	public function Nombre($Nombre = "") {
		if ($this->Field != $Nombre && $Nombre != "") {
			$this->Field = $Nombre;
		}
		return $this->Field;
	}
	
	public function Tabla($Tabla = "") {
		if ($this->Tabla != $Tabla && $Tabla != "") {
			$this->Tabla = $Tabla;
		}
		return $this->Tabla;
	}
	
	public function Tipo($Tipo = "") {
		if ($this->Type != $Tipo && $Tipo != "") {
			$this->Type = $Tipo;
		}
		return $this->Type;
	}
	
	public function Nulo($Nulo = "") {
		if ($this->Null != $Nulo && $Nulo != "") {
			$this->Null = $Nulo;
		}
		return $this->Null;
	}
	
	public function esNulo() {
		return $this->Null == "YES";
	}
	
	public function Llave($Llave = "") {
		if ($this->Key != $Llave && $Llave != "") {
			$this->Key = $Llave;
		}
		return $this->Key;
	}
	public function Unico($Unico = "") {
		if ($this->Unico != $Unico && $Unico != "") {
			$this->Unico = $Unico;
		}
		return $this->Unico;
	}
	
	public function Comentario($Comentario = "") {
		if ($this->Comment != $Comentario && $Comentario != "") {
			$this->Comment = $Comentario;
		}
		return $this->Comment;
	}
	
	public function ValorDefecto($ValorDefecto = "") {
		if ($this->Default != $ValorDefecto && $ValorDefecto != "") {
			$this->Default = $ValorDefecto;
		}
		return $this->Default;
	}
	
	public function Extra($Extra = "") {
		if ($this->Extra != $Extra && $Extra != "") {
			$this->Extra = $Extra;
		}
		return $this->$Extra;
	}
	
	public function llaveForanea($llaveforanea = "") {
		if ($this->ForeignKey != $llaveforanea && $llaveforanea != "") {
			$this->ForeignKey = $llaveforanea;
		}
		return $this->ForeignKey;
	}
	
	public function esLlavePrimaria() {
		if (strtoupper ( $this->Key ) == "PRI") {
			return true;
		}
		return false;
	}
	
	public function esUnico() {
		if (strtoupper ( $this->Key ) == "UNI" || $this->Unico) {
			return true;
		}
		return false;
	}
	
	public function esLlaveForanea() {
		if (strtoupper ( $this->Key ) == "MUL" || is_array ( $this->ForeignKey )) {
			return true;
		}
		return false;
	}
	
	public function esAutoIncremental() {
		if (strtolower ( stristr ( $this->Extra, "AUTO_INCREMENT" ) ) == "auto_increment") {
			return true;
		}
		return false;
	}
	public function esEnum() {
		if (strstr ( $this->Type, "enum" )) {
			return true;
		}
		return false;
	}
	
	public function esNumerico() {
		if ($this->esEntero () || $this->esFloat () || $this->esDouble () || $this->esDecimal ()) {
			return true;
		}
		return false;
	}
	
	public function esPuntoFlotante() {
		if ($this->esFloat () || $this->esDouble () || $this->esDecimal ()) {
			return true;
		}
		return false;
	}
	
	public function esDecimal() {
		if (strstr ( $this->Type, "decimal" )) {
			return true;
		}
		return false;
	}
	
	public function permiteNegativo() {
		if (strstr ( $this->Type, "unsigned" )) {
			return false;
		}
		return true;
	}
	
	public function esFloat() {
		if (strstr ( $this->Type, "float" )) {
			return true;
		}
		return false;
	}
	
	public function esDouble() {
		if (strstr ( $this->Type, "double" )) {
			return true;
		}
		return false;
	}
	
	public function esEntero() {
		if (strstr ( $this->Type, "int(" )) {
			return true;
		}
		return false;
	}
	
	public function esText() {
		if (strstr ( $this->Type, "text" )) {
			return true;
		}
		return false;
	}
	
	public function esFechaTiempo() {
		if (strstr ( $this->Type, "datetime" ) || strstr ( $this->Type, "timestamp" )) {
			return true;
		}
		return false;
	}
	public function esTiempo() {
		if (strstr ( $this->Type, "time" ) && ! $this->esFechaTiempo ()) {
			return true;
		}
		return false;
	}
	public function esFecha() {
		if (strstr ( $this->Type, "date" )) {
			return true;
		}
		return false;
	}
	public function esBlob() {
		if (strstr ( $this->Type, "blob" )) {
			return true;
		}
		return false;
	}
	public function enumItems() {
		if ($this->esEnum ()) {
			$elementos = preg_replace ( '/^(enum\()(.+)\)$/', "$2", $this->Type );
			$elementos = explode ( ",", $elementos );
			foreach ( $elementos as $index => $elemento ) {
				$elementos [$index] = preg_replace ( '/^\'(.+)\'$/', "$1", $elemento );
			}
			return $elementos;
		}
		return false;
	}
	public function dimension() {
		$dimension = preg_replace ( '/^(.*\()(.+)\)$/', "$2", $this->Type );
		$elementos = explode ( ",", $dimension );
		foreach ( $elementos as $indice => $elemento ) {
			$elementos [$indice] = intval ( trim ( $elemento ) );
		}
		return $elementos;
	}
}
?>