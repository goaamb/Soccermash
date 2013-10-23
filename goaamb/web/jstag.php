<?php

require_once ($_GBASE.'/goaamb/web/phptag.php');

class JSTag extends PhpTag {

	public function __construct($contenido = "", $tags = true, $tabs = 0) {
		parent::__construct ( $contenido, $tags, $tabs );
	}

	/**
	 * @see PhpTag::html()
	 *
	 * @return unknown
	 */
	public function html() {
		return $this->intag ( $this->innerHTML () );
	}

	/**
	 * @see Tag::intag()
	 *
	 * @param string $contenido
	 * @return string
	 */
	protected function intag($contenido) {
		if ($this->tags ()) {
			if ((( $this->parent instanceof Tag ) && ! ( $this->parent instanceof JSTag )) || $this->parent == null) {
				$atributos = $this->attributos ();
				return "<script $atributos>$contenido</script>\n";
			}
		}
		return $contenido;
	}

	/**
	 * @see PhpTag::addFunction()
	 *
	 * @param string $nombre
	 * @param string $atributos
	 * @param string $contenido
	 */
	public function addFunction($nombre, $atributos="", $contenido=";",$anonimo=false) {
		return parent::addFunction($nombre,$atributos,$contenido,self::NINGUNO,self::NINGUNO,$anonimo);
	}

	public function addBranches($contenido=";"){
		$this->addTabbedLine("{");
		$this->addTabbedLine($contenido,$this->tabs()+1);
		$this->addTabbedLine("}");
	}
}

?>