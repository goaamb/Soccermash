<?php
require_once $_GBASE . '/goaamb/phpmailer/class.phpmailer.php';
require_once $_GBASE . '/goaamb/bd/modelloader.php';
require_once $_GBASE . '/goaamb/idioma.php';
if (class_exists ( "Idioma" ) && ! isset ( $_IDIOMA )) {
	$_IDIOMA = Idioma::darLenguaje ();
}

class QMailExeption extends Exception {
	/* (non-PHPdoc)
	 * @see Exception::__construct()
	 */
	public function __construct($archivo) {
		// TODO Auto-generated method stub
		parent::__construct ( "El archivo: " . $archivo . ", no existe" );
	}

}

class QMail {
	static function add($tipo, $usuario, $asunto, $archivo, $variables, $prioridad) {
		global $_GBASE;
		$mlu = ModelLoader::crear ( "ax_generalRegister" );
		$mllang = ModelLoader::crear ( "ax_language" );
		$ml = ModelLoader::crear ( "ax_qmail" );
		$ml->tipo = $tipo;
		$extension = "en-US";
		$idioma = new Idioma ( $extension );
		if ($mlu->buscarPorCampo ( array ("id" => $usuario ) )) {
			$ml->mail = $mlu->email;
			if ($mllang->buscarPorCampo ( array ("id" => $mlu->languageid ) )) {
				$extension = $mllang->tag;
				unset ( $idioma );
				$idioma = new Idioma ( $extension );
			}
		} elseif ($usuario == "*") {
			$ml->mail = "*";
		} else {
			$dominio = explode ( "@", $usuario );
			if (count ( $dominio ) > 1 && strtolower ( trim ( $dominio [1] ) ) == "soccermash.com") {
				$ml->mail = $usuario;
			} else {
				$ml->mail = $usuario;
			}
		}
		/*$extension = "";
		if (isset ( $_SESSION ["lg"] )) {
			$extension = $_SESSION ["lg"];
		}*/
		$desglose = explode ( ".", $archivo );
		array_pop ( $desglose );
		$archivo = implode ( ".", $desglose );
		if (is_file ( $_GBASE . $archivo . "." . $extension . ".tpl" )) {
			$archivo = $archivo . "." . $extension . ".tpl";
		} else {
			$archivo = $archivo . ".tpl";
		}
		if (is_file ( $_GBASE . $archivo )) {
			$matches = array ();
			if (preg_match_all ( "|\{([^\}]+)\}|", $asunto, $matches, PREG_SET_ORDER ) !== false && count ( $matches ) > 0) {
				foreach ( $matches as $match ) {
					if (count ( $match ) > 1) {
						$asunto = ereg_replace ( "{" . $match [1] . "}", $idioma->traducir ( $match [1] ), $asunto );
					}
				}
			} else {
				$asunto = $idioma->traducir ( $asunto );
			}
			
			$ml->asunto = $asunto;
			$ml->enviado = "No";
			$ml->prioridad = $prioridad;
			$file = file_get_contents ( $_GBASE . $archivo );
			if ($file) {
				if (! $variables) {
					$variables = array ();
				}
				foreach ( $variables as $var => $val ) {
					$file = str_replace ( "{" . $var . "}", $val, $file );
				}
				$ml->mensaje = $file;
				$ml->fecha = date ( "Y-m-d H:i:s" );
				$ml->prohivido = "No";
				$ml->insertar ();
				
				return true;
			}
		}
		throw new QMailExeption ( $archivo );
		return false;
	}
	
	static function send($prioridad = "Usuario") {
		$mlq = ModelLoader::crear ( "ax_qmail" );
		$mlu = ModelLoader::crear ( "ax_generalRegister" );
		print "Prioridad: $prioridad\n";
		if ($prioridad == "Sistema") {
			$lista = $mlq->listar ( "enviado='No' and prioridad='Sistema' order by fecha asc", 0, 50 );
		} else {
			$lista = $mlq->listar ( "enviado='No' and prioridad='Usuario' order by fecha asc", 0, 50 );
		}
		
		print "Emails por mandar: " . count ( $lista ) . "\n";
		if ($lista && count ( $lista ) > 0) {
			foreach ( $lista as $mail ) {
				switch ($mail->mail) {
					case "*" :
						;
						break;
					default :
						$dominio = explode ( "@", $mail->mail );
						if (count ( $dominio ) > 1 && strtolower ( trim ( $dominio [1] ) ) == "soccermash.com") {
							self::sendPHPMailer ( $mail->mail, $mail->asunto, $mail->mensaje );
							$mail->enviado = "Si";
							$mail->modificar ( "id" );
							print "Caso 1: " . $mail->mail . "\n";
						} elseif ($mlu->buscarPorCampo ( array ("email" => $mail->mail ) )) {
							$privacy = explode ( ",", $mlu->emailPrivacy );
							$enviar = true;
							/*foreach ( $privacy as $prv ) {
								if (intval ( $prv ) == 0) {
									$enviar = false;
									continue;
								}
							}*/
							if ($enviar) {
								self::sendPHPMailer ( $mail->mail, $mail->asunto, $mail->mensaje );
								$mail->enviado = "Si";
								$mail->modificar ( "id" );
								print "Caso 2: " . $mail->mail . "\n";
							}
						} else {
							self::sendPHPMailer ( $mail->mail, $mail->asunto, $mail->mensaje );
							$mail->enviado = "Si";
							$mail->modificar ( "id" );
							print "Caso 3: " . $mail->mail . "\n";
						}
						break;
				}
			}
		}
	
	}
	
	private static function sendPHPMailer($address, $subject, $message) {
		$mail = new PHPMailer ( true );
		try {
			$mail->AddAddress ( $address );
			$mail->From = 'soccermash@soccermash.com';
			$mail->FromName = 'SOCCERMASH Administration';
			$mail->CharSet = "utf8";
			$mail->Subject = $subject;
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
			$mail->IsHTML ( true );
			$mail->Body = $message;
			$mail->Send ();
			sleep ( 1 );
		} catch ( Exception $e ) {
		}
	}
}