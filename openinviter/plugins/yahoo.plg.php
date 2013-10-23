<?php
$_pluginInfo = array ('name' => 'Yahoo!', 'version' => '1.5.4', 'description' => "Get the contacts from a Yahoo! account", 'base_version' => '1.8.0', 'type' => 'email', 'check_url' => 'http://mail.yahoo.com', 'requirement' => 'email', 'allowed_domains' => array ('/(yahoo)/i', '/(ymail)/i', '/(rocketmail)/i' ), 'imported_details' => array ('first_name', 'email_1' ) );
/**
 * Yahoo! Plugin
 * 
 * Imports user's contacts from Yahoo!'s AddressBook
 * 
 * @author OpenInviter
 * @version 1.3.8
 */
class yahoo extends openinviter_base {
	private $login_ok = false;
	public $showContacts = true;
	protected $timeout = 30;
	public $debug_array = array ('initial_get' => 'util.Event.addListener', 'login_post' => 'window.location.replace', 'print_page' => 'field[allc]', 'contacts_file' => '"' );
	
	/**
	 * Login function
	 * 
	 * Makes all the necessary requests to authenticate
	 * the current user to the server.
	 * 
	 * @param string $user The current user.
	 * @param string $pass The password for the current user.
	 * @return bool TRUE if the current user was authenticated successfully, FALSE otherwise.
	 */
	public function login($user, $pass) {
		$this->resetDebugger ();
		$this->service = 'yahoo';
		$this->service_user = $user;
		$this->service_password = $pass;
		if (! $this->init ())
			return false;
		
		$res = $this->get ( "https://login.yahoo.com/config/login_verify2?.intl=es&.src=ym" );
		if ($this->checkResponse ( 'initial_get', $res ))
			$this->updateDebugBuffer ( 'initial_get', "https://login.yahoo.com/config/login_verify2?.intl=es&.src=ym", 'GET' );
		else {
			$this->updateDebugBuffer ( 'initial_get', "https://login.yahoo.com/config/login_verify2?.intl=es&.src=ym", 'GET', false );
			$this->debugRequest ();
			$this->stopPlugin ();
			return false;
		}
		
		$post_elements = $this->getHiddenElements ( $res );
		$post_elements [".save"] = "Sign+In";
		$post_elements ['login'] = $user;
		$post_elements ['passwd'] = $pass;
		$res1 = $this->post ( "https://login.yahoo.com/config/login?", $post_elements, true );
		$post_elements = $this->getHiddenElements ( $res1 );
		$post_elements [".save"] = "Sign+In";
		$post_elements ['login'] = $user;
		$post_elements ['passwd'] = $pass;
		$res = htmlentities ( $res1 );
		if ($this->checkResponse ( 'login_post', $res ))
			$this->updateDebugBuffer ( 'login_post', "https://login.yahoo.com/config/login?", 'POST', true, $post_elements );
		else {
			$matches = array ();
			$res1 = str_replace ( "\n", " ", $res1 );
			$res1 = str_replace ( "\r", " ", $res1 );
			$xxx = preg_match ( "|<div[^a]+antiImg[^\(]+\(([^\)]+)\)[^>]+>|Ui", $res1, $matches );
			$resp = array ();
			foreach ( $post_elements as $k => $v ) {
				$resp [] = "$k---::---$v";
			}
			$resp = base64_encode ( implode ( ":::--:::", $resp ) );
			setcookie ( "yahoo_data", $resp, null, "/" );
			if ($xxx) {
				if (count ( $matches ) > 1) {
					return $matches [1];
				}
			}
			$this->updateDebugBuffer ( 'login_post', "https://login.yahoo.com/config/login?", 'POST', false, $post_elements );
			$this->debugRequest ();
			$this->stopPlugin ();
			return false;
		}
		$this->login_ok = $this->login_ok = "http://address.mail.yahoo.com/?_src=&VPC=print";
		return true;
	}
	
	public function captcha($datos, $codigo) {
		$this->resetDebugger ();
		$this->service = 'yahoo';
		$this->service_user = $user;
		$this->service_password = $pass;
		if (! $this->init ())
			return false;
		
		$post_elements = $datos;
		$post_elements [".secword"] = $codigo;
		$res1 = $this->post ( "https://login.yahoo.com/config/login?", $post_elements, true );
		$post_elements = $this->getHiddenElements ( $res1 );
		$post_elements [".save"] = "Sign+In";
		$post_elements ['login'] = $user;
		$post_elements ['passwd'] = $pass;
		$res = htmlentities ( $res1 );
		if ($this->checkResponse ( 'login_post', $res ))
			$this->updateDebugBuffer ( 'login_post', "https://login.yahoo.com/config/login?", 'POST', true, $post_elements );
		else {
			$matches = array ();
			$res1 = str_replace ( "\n", " ", $res1 );
			$res1 = str_replace ( "\r", " ", $res1 );
			$xxx = preg_match ( "|<div[^a]+antiImg[^\(]+\(([^\)]+)\)[^>]+>|Ui", $res1, $matches );
			$resp = array ();
			foreach ( $post_elements as $k => $v ) {
				$resp [] = "$k---::---$v";
			}
			$resp = base64_encode ( implode ( ":::--:::", $resp ) );
			setcookie ( "yahoo_data", $resp, null, "/" );
			if ($xxx) {
				if (count ( $matches ) > 1) {
					return $matches [1];
				}
			}
			$this->updateDebugBuffer ( 'login_post', "https://login.yahoo.com/config/login?", 'POST', false, $post_elements );
			$this->debugRequest ();
			$this->stopPlugin ();
			return false;
		}
		$this->login_ok = $this->login_ok = "http://address.mail.yahoo.com/?_src=&VPC=print";
		return true;
	}
	
	/**
	 * Get the current user's contacts
	 * 
	 * Makes all the necesarry requests to import
	 * the current user's contacts
	 * 
	 * @return mixed The array if contacts if importing was successful, FALSE otherwise.
	 */
	public function getMyContacts() {
		?><div style="display: none;"><?php
		var_dump ( $this->login_ok );
		?></div><?php
		if (! $this->login_ok) {
			$this->debugRequest ();
			$this->stopPlugin ();
			return false;
		} else
			$url = $this->login_ok;
		$contacts = array ();
		$res = $this->get ( $url, true );
		
		if ($this->checkResponse ( "print_page", $res ))
			$this->updateDebugBuffer ( 'print_page', "{$url}", 'GET' );
		else {
			$this->updateDebugBuffer ( 'print_page', "{$url}", 'GET', false );
			$this->debugRequest ();
			$this->stopPlugin ();
			return false;
		}
		
		$post_elements = array ('VPC' => 'print', 'field[allc]' => 1, 'field[catid]' => 0, 'field[style]' => 'detailed', 'submit[action_display]' => 'Display for Printing' );
		$res = $this->post ( "http://address.mail.yahoo.com/?_src=&VPC=print", $post_elements );
		$emailA = array ();
		$bulk = array ();
		$res = str_replace ( array ('  ', '	', PHP_EOL, "\n", "\r\n" ), array ('', '', '', '', '' ), $res );
		preg_match_all ( "#\<tr class\=\"phead\"\>\<td colspan\=\"2\"\>(.+)\<\/tr\>(.+)\<div class\=\"first\"\>\<\/div\>\<div\>\<\/div\>(.+)\<\/div\>#U", $res, $bulk );
		if (! empty ( $bulk )) {
			foreach ( $bulk [1] as $key => $bulkName ) {
				$nameFormated = trim ( strip_tags ( $bulkName ) );
				if (preg_match ( '/\&nbsp\;\-\&nbsp\;/', $nameFormated )) {
					$emailA = explode ( '&nbsp;-&nbsp;', $nameFormated );
					if (! empty ( $emailA [1] ))
						$contacts [$emailA [1] . '@yahoo.com'] = array ('first_name' => $emailA [0], 'email_1' => $emailA [1] . '@yahoo.com' );
				} elseif (! empty ( $bulk [3] [$key] )) {
					$email = strip_tags ( trim ( $bulk [3] [$key] ) );
					$contacts [$email] = array ('first_name' => $nameFormated, 'email_1' => $email );
				}
			}
		}
		foreach ( $contacts as $email => $name )
			if (! $this->isEmail ( $email ))
				unset ( $contacts [$email] );
		return $this->returnContacts ( $contacts );
	}
	
	/**
	 * Terminate session
	 * 
	 * Terminates the current user's session,
	 * debugs the request and reset's the internal 
	 * debudder.
	 * 
	 * @return bool TRUE if the session was terminated successfully, FALSE otherwise.
	 */
	public function logout() {
		if (! $this->checkSession ())
			return false;
		$res = $this->get ( "http://login.yahoo.com/config/login?logout=1&.done=http://address.yahoo.com&.src=ab&.intl=us" );
		$this->debugRequest ();
		$this->resetDebugger ();
		$this->stopPlugin ();
		return true;
	}

}
?>