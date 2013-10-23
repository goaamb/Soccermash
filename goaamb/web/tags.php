<?php

/**
 * Clase que maneja tags de HTML
 * @author Alvaro Justo Michel Barrera <goaamb@gmail.com>
 * @version 0.1
 */
class Tag {
	const UTF8_ENCODE = 0;
	const NOUTF8_ENCODE = 1;
	/**
	 * Tag que se imprimira
	 *
	 * @var string
	 */
	protected $taghtml;
	/**
	 * Contenido que tendra dentro el Tag
	 * es un arreglo de objetos instanciados de la Clase Tag
	 *
	 * @var array
	 */
	protected $contenido;
	/**
	 * Arreglo de atributos que tendra el presente Tag
	 *
	 * @var array
	 */
	protected $atributos;
	/**
	 * Atributo que nos indica que tag es el padre del presente Tag
	 *
	 * @var Tag
	 */
	protected $parent;
	
	/**
	 * @param Tag $parent
	 */
	public function setParent($parent) {
		$this->parent = $parent;
	}
	/**
	 * @return Tag
	 */
	public function getParent() {
		return $this->parent;
	}
	/**
	 * Constructor que Instancia a un objeto de la Clase Tag
	 *
	 * @param string $tag tag de html que se imprimira
	 * @param Tag|string $contenido contenido del tag
	 */
	public function __construct($tag = "p", $contenido = "", $atributes = array()) {
		$this->taghtml = $tag;
		$this->contenido = array ();
		$this->add ( $contenido );
		if (! is_array ( $atributes )) {
			$atributes = array ();
		}
		$this->atributos = $atributes;
	}
	
	public function getContent() {
		return $this->contenido;
	}
	
	public function addContent($content, $pre = false) {
		foreach ( $content as $item ) {
			if ($item instanceof Tag) {
				$item->setParent ( $this );
			}
		}
		if (! $pre) {
			$this->contenido = array_merge ( $this->contenido, $content );
		} else {
			$this->contenido = array_merge ( $content, $this->contenido );
		}
		return $this;
	}
	
	protected function validate(&$algo) {
		if (is_string ( $algo )) {
			if ($algo != "") {
				return true;
			}
		}
		if (is_numeric ( $algo )) {
			return true;
		}
		if ($algo instanceof Tag) {
			if ($algo != null) {
				if ($algo->getParent () == null) {
					$algo->setParent ( $this );
					return true;
				} else {
					throw new Exception ( "Un Tag no puede tener mas de un padre" );
				}
			}
		}
		return false;
	}
	
	/**
	 * Funcion que a&ntilde;ade elementos al Tag
	 *
	 * @param Tag|string $algo un elemento que se a�adira
	 * @return Tag retornara true si se pudo a&ntilde;adir o false si no
	 */
	public function add($algo) {
		if ($this->validate ( $algo )) {
			array_push ( $this->contenido, $algo );
			return $this;
		}
		return false;
	}
	
	/**
	 * Inserta en una posicion una cadena o un tag.
	 * @param $algo string|Tag
	 * @param $pos int
	 * @return Tag
	 */
	public function insert($algo, $pos) {
		$aceptado = false;
		if (count ( $this->contenido ) < $pos) {
			return $this->add ( $algo );
		}
		if ($pos < 0) {
			$pos = 0;
		}
		if ($this->validate ( $algo )) {
			$nuevo_contenido = array ();
			foreach ( $this->contenido as $i => $v ) {
				if ($i == $pos) {
					array_push ( $nuevo_contenido, $algo );
					array_push ( $nuevo_contenido, $v );
				} else {
					array_push ( $nuevo_contenido, $v );
				}
			}
			$this->contenido = $nuevo_contenido;
			return $this;
		}
		return false;
	}
	
	/**
	 * Quita un elemento del contenido del Tag
	 *
	 * @param Tag|string $algo Elemento a ser removido
	 */
	public function remove($algo) {
		$akey = array_search ( $algo, $this->contenido );
		return $this->removeForPos ( $akey );
	}
	
	public function removeForPos($akey) {
		if ($akey !== false) {
			$newcontenido = array ();
			$old = $this->contenido [$akey];
			foreach ( $this->contenido as $index => $elemento ) {
				if ($index != $akey) {
					array_push ( $newcontenido, $elemento );
				}
			}
			$this->contenido = $newcontenido;
			return $old;
		}
		return false;
	}
	/**
	 * Funcion que devuelve una cadena que representa el contenido en HTML del tag
	 *
	 * @return string
	 */
	public function html($encode = Tag::UTF8_ENCODE) {
		if ($this->taghtml == "html") {
			return $this->docType () . $this->intag ( $this->innerHTML ( $encode ) );
		} else {
			return $this->intag ( $this->innerHTML ( $encode ) );
		}
	}
	
	/**
	 * Devuelve el contenido HTML del tag
	 *
	 * @return string
	 */
	public function innerHTML($encode = Tag::UTF8_ENCODE) {
		$retorno = "";
		foreach ( $this->contenido as $elemento ) {
			if (is_string ( $elemento ) || is_numeric ( $elemento )) {
				$retorno .= $encode == self::UTF8_ENCODE ? $elemento : utf8_encode ( $elemento );
			}
			if (($elemento instanceof Tag)) {
				$retorno .= $elemento->html ( $encode );
			}
		}
		return $retorno;
	}
	/**
	 * funcion que a&ntilde;ade el tag al contenido: <tag>contenido</tag>
	 *
	 * @param string $contenido
	 * @return string
	 */
	protected function intag($contenido) {
		$atributos = $this->attributos ();
		return "<$this->taghtml$atributos>$contenido</$this->taghtml>";
	}
	/**
	 * Funcion que a&ntilde;ade o modifica un atributo del Tag
	 *
	 * @param string $attr Atributo a modificar
	 * @param string $valor Valor que tendra el Atributo
	 * @return Tag 
	 */
	public function setAttribute($attr, $valor) {
		if ($attr != "") {
			$attr = strtolower ( $attr );
			$this->atributos [$attr] = $valor;
		}
		return $this;
	}
	/**
	 * Funcion que devuelve el valor de un atributo dentro el Tag
	 *
	 * @param string $attr Nombre del Atributo que se quiere obtener
	 * @return string
	 */
	public function getAttribute($attr) {
		return $this->atributos [$attr];
	}
	
	public function __get($name) {
		return $this->getAttribute ( $name );
	}
	
	public function __set($name, $value) {
		return $this->setAttribute ( $name, $value );
	}
	
	/**
	 * Funcion que devuelve una cadena con todos los atributos del Tag con fines de impresion
	 *
	 * @return string
	 */
	protected function attributos() {
		$retorno = "";
		if ($this->atributos != null) {
			foreach ( $this->atributos as $index => $atributo ) {
				$atributo = str_replace ( "'", "\"", $atributo );
				$retorno .= " $index='$atributo'";
			}
		}
		return $retorno;
	}
	/**
	 * devuelve un tag o cadena en una posicion dentro de la instancia de la presente clase
	 *
	 * @param int $posicion posicion del elemento que se quiere obtener
	 * @return Tag|string
	 */
	public function get($posicion) {
		if ($posicion < count ( $this->contenido )) {
			return $this->contenido [$posicion];
		}
		return null;
	}
	
	public function getTags($tag) {
		$resultantes = array ();
		foreach ( $this->contenido as $otag ) {
			if ($otag instanceof Tag) {
				if ($otag->taghtml == $tag) {
					array_push ( $resultantes, $otag );
				}
				$array = $otag->getTags ( $tag );
				$resultantes = array_merge ( $resultantes, $array );
			}
		}
		return $resultantes;
	}
	
	public function setAttributeAll($list, $attr, $val) {
		if (! is_array ( $list )) {
			$list = array ();
		}
		foreach ( $list as $el ) {
			if ($el instanceof Tag) {
				$el->setAttribute ( $attr, $val );
			}
		}
		return $this;
	}
	
	/**
	 * Modifica el contenido de alguno de los elementos del tag
	 *
	 * @param int $posicion
	 * @param Tag|string $valor
	 */
	public function set($posicion, $valor) {
		if ($posicion < count ( $this->contenido )) {
			$this->contenido [$posicion] = $valor;
		}
		return $this;
	}
	
	public function __toString() {
		return $this->html ();
	}
	
	/**
	 * Retorna el Tipo de Documento
	 *
	 * @return string
	 */
	private function docType() {
		return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
	}
	
	public function htmlprint($encode = Tag::UTF8_ENCODE) {
		print $this->html ( $encode );
	}
	public function getTag() {
		return $this->taghtml;
	}
	public function setTag($tag) {
		$this->taghtml = $tag;
	}
	
	public function clear() {
		$old = $this->contenido;
		$this->contenido = array ();
		return $old;
	}
}

?>