<?php

require_once ('goaamb/php/web/tags.php');

/**
 * Clase que muestra una estructura HTML
 *
 */
class HtmlTag extends Tag {
	/**
	 * Elemento Head de la estructura HTML
	 *
	 * @var Tag
	 */
	protected $head;
	/**
	 * Elemento Body de la estructura HTML
	 *
	 * @var Tag
	 */
	protected $body;
	/**
	 * Constructor de la Clase
	 *
	 */
	public function __construct() {
		parent::__construct ("html",$this->head=new Tag("head"));
		$this->add($this->body=new Tag("body"));
	}

	/**
	 * Devuelve el elemento Head
	 *
	 * @return Tag
	 */
	public function head(){
		return $this->head;
	}
	/**
	 * Devuelve el elemento Body
	 *
	 * @return Tag
	 */
	public function body(){
		return $this->body;
	}
}

?>