<?PHP
require_once(SITE_LIB_Share . '/phpmailer/class.phpmailer.php');


class CLASS_Mail extends PHPMailer
{

	var $CharSet 		= 'utf-8';
	var $ContentType	= "text/html";


	function CLASS_Mail()
	{
		$this->Mailer = "smtp";

		if ($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != 'servidor' && $_SERVER['HTTP_HOST'] != 'localhost:8080')
		{
			
		}
		else
		{
			$this->Host = "mail.aviso-digital.com.ar";
			$this->port = "25";
			$this->SMTPAuth = true;
			$this->Username = "noreply@viso-digital.com.ar";
			$this->Password = "";
		}

		$this->Timeout=50;
		$this->IsHTML(true);
		
	}

}#CLASS_Mail{}

?>