<?php

abstract class RequestHandler {
	protected static $_request;
	protected static $_get;
	protected static $_post;
	protected static $_files;
	protected static $_cookie;
	protected static $_session;
	public function __construct() {
		global $_GET;
		global $_POST;
		global $_REQUEST;
		self::$_request = $_REQUEST;
		self::$_get = $_GET;
		self::$_post = $_POST;
		self::$_files = $_FILES;
		self::$_cookie = $_COOKIE;
		if (isset ( $_SESSION )) {
			self::$_session = $_SESSION;
		}
	}

	public final function run() {
		$json = new JSON ( );
		$res = $this->process ( $json );
		if (is_array ( $res )) {
			$success = $res [0];
			$mensaje = $res [1];
			$json->add ( "success", $success ? "true" : "false" );
			if ($success) {
				$json->add ( "mensaje", "'" . $mensaje . "'" );
			} else {
				$json->add ( "error", "'" . $mensaje . "'" );
			}
			$json->printJSON ();
			return;
		}
		if ($res instanceof Tag) {
			$res->htmlprint ();
			return;
		}
	}

	/**
	 * funcion que procesa todo lo que se encuentre en $_REQUEST ,$_POST, $_GET, $_COOKIE, $_SESSION, $_FILES
	 * @param JSON $json
	 * @return Array|Tag
	 */
	protected abstract function process($json);

	public function __call($name, $arguments) {
		$elemento = null;
		switch ($name) {
			case "get" :
				$elemento = self::$_get;
				break;
			case "post" :
				$elemento = self::$_post;
				break;
			case "request" :
				$elemento = self::$_request;
				break;
			case "files" :
				$elemento = $this->_files;
				break;
			case "cookie" :
				$elemento = self::$_cookie;
				break;
			case "session" :
				$elemento = self::$_session;
				break;
		}
		if (count ( $arguments ) > 0) {
			return $elemento [$arguments [0]];
		} else {
			return $elemento;
		}
	}
}

?>