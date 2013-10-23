<?php

class Launcher {

	protected $handlers;

	function __construct($requestHandler) {
		$this->handlers = array ( );
		if (( $requestHandler instanceof BaseRequestHandler )) {
			array_push ( $this->handlers, $requestHandler );
		}
		if (is_array ( $requestHandler )) {
			if (count ( $requestHandler ) > 0) {
				foreach ( $requestHandler as $item ) {
					if (( $item instanceof BaseRequestHandler )) {
						array_push ( $this->handlers, $item );
					}
				}
			}
		}
	}

	function run() {
		foreach ($this->handlers as $handler) {
			$handler->process();
		}

	}
}

?>