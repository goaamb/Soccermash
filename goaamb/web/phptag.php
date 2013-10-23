<?php
require_once $_GBASE.'/goaamb/web/tags.php';

class PhpTag extends Tag {
	const PUBLICO = 0;
	const PRIVADO = 1;
	const PROTEGIDO = 2;
	const ABSTRACTO = 4;
	const ESTATICO = 8;
	const NINGUNO = 16;
	protected $tags;
	private $tabs;

	/**
	 * @see Tag::setParent()
	 *
	 * @param Tag $parent
	 */
	public function setParent($parent) {
		parent::setParent ( $parent );
		if ($this->parent != null) {
			if (($this->parent instanceof PhpTag) || ! ($this->parent instanceof Tag)) {
				$this->tabs = $this->parent->tabs () + 1;
			}
		}
	}
	public function __construct($contenido = "", $tags = true, $tabs = 0) {
		$this->contenido = array ();
		$this->addTabbed ( $contenido, $tabs );
		$this->tags = $tags;
		$this->tabs ( $tabs );
	}

	public function tabs($tabs = null) {
		if ($tabs != null && $this->tabs != $tabs) {
			$this->tabs = intval ( $tabs );
		}
		return intval ( $this->tabs );
	}

	public function tags($tags = null) {
		if ($tags != null && $this->tags != $tags) {
			$this->tags = $tags;
		}
		return $this->tags;
	}

	public function addLine($contenido = "") {
		$this->add ( $contenido );
		$this->add ( "\n" );
	}

	public function addTabbed($contenido = "", $tabs = null) {
		if ($tabs == null) {
			$tabs = $this->tabs;
		}
		if (! ($contenido instanceof PhpTag)) {
			$this->add ( $this->owntabs ( $tabs ) );
		}
		$this->add ( $contenido );
	}

	public function addTabbedLine($contenido = "", $tabs = null) {
		$this->addTabbed ( $contenido, $tabs );
		$this->add ( "\n" );
	}

	protected function owntabs($tabs = 1) {
		$tabu = "";
		for($i = 0; $i < intval ( $tabs ); $i ++) {
			$tabu .= "\t";
		}
		return $tabu;
	}

	public function addFunction($nombre, $atributos = "", $contenido = ";", $acceso = self::PUBLICO, $adicional = self::NINGUNO, $anonimo = false) {
		switch ($acceso) {
			case self::PRIVADO :
				$this->addTabbed ( "private " );
				break;
			case self::PROTEGIDO :
				$this->addTabbed ( "protected " );
				break;
			case self::PUBLICO :
				$this->addTabbed ( "public " );
				break;
			default :
				if (! $anonimo) {
					$this->addTabbed ();
				}
				break;
		}

		switch ($adicional) {
			case self::ABSTRACTO :
				$this->add ( "abstract " );
				break;
			case self::ESTATICO :
				$this->add ( "static " );
				break;
		}
		if (! $anonimo) {
			$this->addLine ( "function $nombre($atributos)" );
		} else {
			if($nombre!=""){
				$this->add($nombre."=");
			}
			$this->addLine ( "function($atributos)" );
		}
		$this->addTabbedLine ( "{" );
		if (($contenido instanceof PhpTag)) {
			$this->addTabbed ( $contenido, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenido, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "}" );
	}

	public function addClass($nombre, $contenido = ";", $extiende = "", $implementa = "", $adicional = self::NINGUNO) {
		if ($extiende != "") {
			$extiende = "extends $extiende";
		}
		if ($implementa != "") {
			$implementa = "implements $implementa";
		}
		switch ($adicional) {
			case self::ABSTRACTO :
				$this->addTabbedLine ( "abstract class $nombre $extiende $implementa", $this->tabs );
				break;
			default :
				$this->addTabbedLine ( "class $nombre $extiende $implementa", $this->tabs );
				break;
		}

		$this->addTabbedLine ( "{", $this->tabs );
		if (($contenido instanceof PhpTag)) {
			$this->addTabbed ( $contenido, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenido, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "}", $this->tabs );
	}

	public function addIf($condicion = "true", $contenido = ";") {
		$this->addTabbedLine ( "if($condicion)", $this->tabs );
		$this->addTabbedLine ( "{", $this->tabs );
		if (($contenido instanceof PhpTag)) {
			$this->addTabbed ( $contenido, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenido, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "}", $this->tabs );
	}

	public function addIfElse($condicion = "true", $contenidoif = ";", $contenidoelse = ";") {
		$this->addIf ( $condicion, $contenidoif, $this->tabs );
		$this->addTabbedLine ( "else", $this->tabs );
		$this->addTabbedLine ( "{", $this->tabs );
		if (($contenidoelse instanceof PhpTag)) {
			$this->addTabbed ( $contenidoelse, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenidoelse, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "}", $this->tabs );
	}

	public function addTryCatch($contenidotry = ";", $contenidocatch = ";") {
		$this->addTabbedLine ( "try", $this->tabs );
		$this->addTabbedLine ( "{", $this->tabs );
		if (($contenidotry instanceof PhpTag)) {
			$this->addTabbed ( $contenidotry, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenidotry, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "}catch(Exception \$exception)", $this->tabs );
		$this->addTabbedLine ( "{", $this->tabs );
		if (($contenidocatch instanceof PhpTag)) {
			$this->addTabbed ( $contenidocatch, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenidocatch, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "}", $this->tabs );
	}

	public function addForEach($sentencia = "\$arreglo as \$index=>\$elemento", $contenido = ";") {
		$this->addTabbedLine ( "foreach($sentencia)", $this->tabs );
		$this->addTabbedLine ( "{", $this->tabs );
		if (($contenido instanceof PhpTag)) {
			$this->addTabbed ( $contenido, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenido, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "}", $this->tabs );
	}

	public function addSwitch($variable = "\$var", $contenido = ";") {
		$this->addTabbedLine ( "switch ($variable)", $this->tabs );
		$this->addTabbedLine ( "{", $this->tabs );
		if (($contenido instanceof PhpTag)) {
			$this->addTabbed ( $contenido, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenido, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "}", $this->tabs );
	}
	public function addCase($valor = "0", $contenido = ";") {
		$this->addTabbedLine ( "case $valor:", $this->tabs );
		if (($contenido instanceof PhpTag)) {
			$this->addTabbed ( $contenido, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenido, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "break;", $this->tabs );
	}
	public function addDefault($contenido = ";") {
		$this->addTabbedLine ( "default:", $this->tabs );
		if (($contenido instanceof PhpTag)) {
			$this->addTabbed ( $contenido, $this->tabs + 1 );
		} else {
			$this->addTabbedLine ( $contenido, $this->tabs + 1 );
		}
		$this->addTabbedLine ( "break;", $this->tabs );
	}

	public function remove($posicion = -1) {
		if ($posicion < $this->size ()) {
			$elemento = $this->contenido [$posicion];
			$nuevoarreglo = array ();
			foreach ( $this->contenido as $index => $nuevoelemento ) {
				if ($index != $posicion) {
					array_push ( $nuevoarreglo, $nuevoelemento );
				}
			}
			$this->contenido = $nuevoarreglo;
			return $elemento;

		}
		return null;
	}

	public function get($posicion = -1) {
		if ($posicion < $this->size ()) {
			return $this->contenido [$posicion];
		}
		return null;
	}

	public function set($posicion = -1, $contenido = "") {
		if ($posicion < $this->size () && $contenido != "") {
			$this->contenido [$posicion] = $contenido;
		}
	}

	public function size() {
		return count ( $this->contenido );
	}

	public function html() {
		return $this->addTag ( $this->innerHTML () );
	}

	public function innerHTML() {
		$retorno = "";
		foreach ( $this->contenido as $elemento ) {
			$retorno .= $this->processElement ( $elemento );
		}
		return $retorno;
	}
	/**
	 * @see PhpTag::processElement()
	 *
	 * @param string|Tag $elemento
	 * @return string
	 */
	protected function processElement($elemento) {
		if (($elemento instanceof Tag) && ! ($elemento instanceof PhpTag)) {
			return $this->addForHTML ( $elemento );
		} else {
			return $elemento;
		}
	}

	protected function addTag($contenido = "") {
		if ($this->tags) {
			if ((($this->parent instanceof Tag) && ! ($this->parent instanceof PhpTag)) || $this->parent == null) {
				return "<?php $contenido?>";
			} elseif (($this->parent instanceof Tag) && is_subclass_of ( $this->parent, "PhpTag" )) {
				return "<?php $contenido?>";
			}
		}
		return $contenido;
	}

	protected function addForHTML($contenido = "") {
		return "?>$contenido<?php ";
	}
}

?>