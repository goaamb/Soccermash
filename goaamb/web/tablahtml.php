<?php

require_once ('tags.php');

interface ITabla {
	public function addColumn($data, $row=-1);
	public function addHead($data);
	public function view();

}

/**
 * Clase que representa una Tabla de HTML
 * @author Alvaro Justo Michel Barrera <goaamb@gmail.com>
 * @version 0.1
 */

class Tabla extends Tag implements ITabla {
	protected $nrofilas;
	protected $maxcolumnas;
	protected $thead;
	protected $tbody;

	/**
	 * @see ITabla::view()
	 *
	 */
	public function view() {
		print $this->html ();
	}
	public function __construct() {
		parent::__construct ( "table" );
		$this->nrofilas = 0;
		$this->maxcolumnas = 0;
		$this->add ( $this->thead = new Tag ( "thead" ) );
		$this->add ( $this->tbody = new Tag ( "tbody" ) );
	}
	/**
	 * Adiciona una columna a la Tabla en una determinada fila
	 *
	 * @param string|Tag $data
	 * @param integer $row
	 * @return Tag
	 */
	public function addColumn($data, $row=-1) {
		if($row==-1){
			$row=$this->nrofilas;
		}
		if ($row >= $this->nrofilas) {
			$diferencia = $row - $this->nrofilas + 1;
			for($i = 0; $i < $diferencia; $i ++) {
				$this->tbody->add ( new Tag ( "tr" ) );
				$this->nrofilas += 1;
			}
		}
		$nuevacol = new Tag ( "td", $data );
		$this->tbody->get ( $row )->add ( $nuevacol );
		return $nuevacol;
	}
	/**
	 * Devuelve una columna de la Tabla
	 *
	 * @param int $row
	 * @param int $col
	 * @return Tag
	 */
	public function getColumn($row, $col) {
		if ($row < $this->nrofilas) {
			return $this->tbody->get ( $row )->get ( $col );
		}
		return null;
	}
	public function setColumn($row, $col, $valor) {
		if ($row < $this->nrofilas) {
			return $this->tbody->get ( $row )->set ( $col, $valor );
		}
		return null;
	}
	public function removeColumn($row, $col) {
		if ($row < $this->nrofilas) {
			$this->tbody->get ( $row )->remove ( getColumn ( $row, $col ) );
		}
	}
	public function addHead($data) {
		$nuevacol = new Tag ( "td", $data );
		$this->thead->add ( $nuevacol );
		return $nuevacol;
	}
	public function getHead($posicion) {
		return $this->thead->get ( $posicion );
	}
	public function setHead($posicion, $valor) {
		$unelemento = $this->getHead ( $posicion );
		if ($unelemento) {
			$unelemento->set ( $posicion, $valor );
		}
	}
	public function removeHead($posicion) {
		$this->thead->remove ( getHead ( $posicion ) );
	}

	public function getRow($row) {
		if ($row < $this->nrofilas) {
			return $this->tbody->get ( $row );
		}
		return null;
	}
	public function removeRow($row) {
		if ($row < $this->nrofilas) {
			$this->tbody->remove ( getRow ( $row ) );
		}
	}
}

?>