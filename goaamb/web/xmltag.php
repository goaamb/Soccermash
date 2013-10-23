<?php

require_once $_GBASE . '/goaamb/web/tags.php';

class XmlTag extends Tag {
	protected $version;
	protected $encoding;
	public function __construct($tag = "contenido", $contenido = "", $version = "1.0", $encoding = "ISO-8859-1") {
		parent::__construct ( $tag, $contenido );
		$this->version = $version;
		$this->encoding = $encoding;
	}

	public function addCDATA($contenido){
		$this->add("<![CDATA[$contenido]]>");
	}

	public function xml() {
		return $this->header () . $this->html ();
	}

	public function xmlprint(){
		header("Content-type: text/xml");
		print $this->xml();
	}
	private function header() {
		return '<?xml version="' . $this->version . '" encoding="' . $this->encoding . '" ?>';
	}

	protected function intag($contenido) {
		$atributos = $this->attributos ();
		return "<$this->taghtml$atributos>$contenido</$this->taghtml>";
	}
}

?>