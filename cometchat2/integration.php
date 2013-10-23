<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DATABASE */

define('_JEXEC',1);
define('DS',DIRECTORY_SEPARATOR);
define('JPATH_BASE',dirname(dirname(__FILE__)));
/*session_start();
require_once dirname(dirname(__FILE__))."/configuration.php";
require_once dirname(dirname(__FILE__)).'/includes/defines.php';
require_once dirname(dirname(__FILE__)).'/includes/framework.php';*/
require_once $_SERVER["DOCUMENT_ROOT"] . '/gbase.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/goaamb/idioma.php';
if(class_exists("Idioma") && !isset($_IDIOMA)){
	$_IDIOMA=Idioma::darLenguaje();
}
//$config = new JConfig;

// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW
// DO NOT EDIT DATABASE VALUES BELOW

/*define('DB_SERVER',					$config->host							);
define('DB_PORT',					'3306'									);
define('DB_USERNAME',				$config->user							);
define('DB_PASSWORD',				$config->password						);
define('DB_NAME',					$config->db								);
define('TABLE_PREFIX',				$config->dbprefix						);
define('DB_USERTABLE',				'users'									);
define('DB_USERTABLE_NAME',			'name'									);
define('DB_USERTABLE_USERID',		'id'									);
define('DB_USERTABLE_LASTACTIVITY',	'lastvisitDate'							);
*/
define ( 'DB_SERVER', $sDB_Host );
define ( 'DB_PORT', '3306' );
define ( 'DB_USERNAME', "$sDB_User" );
define ( 'DB_PASSWORD', "$sDB_Pass" );
define ( 'DB_NAME', "$sDB_Name" );
define ( 'TABLE_PREFIX', "" );
define ( 'DB_USERTABLE', 'ax_generalRegister' );
define ( 'DB_USERTABLE_NAME', 'name' );
define ( 'DB_USERTABLE_USERID', 'id' );
define ( 'DB_USERTABLE_LASTACTIVITY', 'tiempoUtlimaActividad' );


/*$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();*/

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('SET_SESSION_NAME','');			// Session name
define('DO_NOT_START_SESSION','1');		// Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','1');	// Set to 1 if you do not want to destroy session on logout
define('SWITCH_ENABLED','1');		
define('INCLUDE_JQUERY','1');	
define('FORCE_MAGIC_QUOTES','0');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* FUNCTIONS */

function getUserID() {
	$userid = 0;
	
	if (isset ( $_SESSION ["iSMuIdKey"] ) && ! empty ( $_SESSION ["iSMuIdKey"] )) {
		$userid = $_SESSION ["iSMuIdKey"];
	}
	return $userid;
}

function getFriendsList($userid, $time) {
	global $conexion;
	$mlaxfol = ModelLoader::crear ( "ax_follower" );
	$mlaxfol->buscarPorCampo ( array ("id_user" => $userid ) );
	
	$followers = unserialize ( utf8_decode ( $mlaxfol->history_follower ) );
	if (count ( $followers ["id"] ) <= 0) {
		$followers ["id"] = array (0 );
	}
	/*$following = unserialize ( utf8_decode ( $mlaxfol->history_following ) );
	if (count ( $following ["id"] ) <= 0) {
		$following ["id"] = array (0 );
	}*/
	/*var_dump ( $following );
	var_dump ( $followers );
	exit ();*/
	$ahora=time();
	$antes=$ahora-5*24*60*60;
	//$antes=$ahora-2*60;
	$ahora=date("Y-m-d H:i:s",$ahora);
	$antes=date("Y-m-d H:i:s",$antes);
	$sql = "select DISTINCT axgr.id userid, CONCAT(axgr.name,' ',axgr.lastname) username,axgr.tiempoUtlimaActividad lastactivity,axgr.photo avatar,axgr.id link,axgr.id id,axgr.name name,axgr.lastName lastName,chs.status message,chs.status status
    from ax_generalRegister axgr left join cometchat_status chs on axgr.id=chs.userid
    where (axgr.id in(" . implode ( ",", $followers ["id"] ) . ") and axgr.tiempoUtlimaActividad>'$antes')
	order by username asc";
	
	//print $sql;
	/*$res=$conexion->consulta("select count(axgr.id userid)
    from ax_generalRegister axgr left join cometchat_status chs on axgr.id=chs.userid
    where (axgr.id in(" . implode ( ",", $followers ["id"] ) . ")) 
	order by username asc");
	
	if($res){
		$res=mysql_fetch_assoc($res);
		var_dump($res);
	}*/
	
	/*var_dump( $followers ["id"]);
	var_dump( $following ["id"]);*/
	/*print $sql;
	var_dump($userid);
	exit();*/
	return $sql;
}

function getUserDetails($userid) {
	$sql = ("select " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " userid, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_NAME . " username, " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_LASTACTIVITY . " lastactivity,  " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " link,  " . TABLE_PREFIX . "community_users.thumb avatar, cometchat_status.message, cometchat_status.status from " . TABLE_PREFIX . DB_USERTABLE . " left join cometchat_status on " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " = cometchat_status.userid  left join " . TABLE_PREFIX . "community_users on " . TABLE_PREFIX . "community_users.userid = " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " where " . TABLE_PREFIX . DB_USERTABLE . "." . DB_USERTABLE_USERID . " = '" . mysql_real_escape_string ( $userid ) . "'");
	return $sql;
}

function updateLastActivity($userid) {
	$today = date ( "Y-m-d H:i:s" );
	$sql = ("update ax_generalRegister set tiempoUtlimaActividad = '$today' where id = '" . mysql_real_escape_string ( $userid ) . "'");
	return $sql;
}

function getUserStatus($userid) {
	
	$sql = ("select cometchat_status.status from cometchat_status where cometchat_status.userid = " . mysql_real_escape_string ( $userid ));
	return $sql;
}

function getLink($link) {
	global $_IDIOMA;
	return "/".$_IDIOMA->traducir("user")."/$link";
}

function getAvatar($image) {
	if (empty ( $image )) {
		$image = 'photoGeneral/default_thumb.jpg';
	} else {
		$image = "photoGeneral/small/small_$image";
	}
	return BASE_URL . '../' . $image;
}

function getTimeStamp() {
	return time ();
}

function processTime($time) {
	return strtotime ( $time );
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


/* HOOKS */

function hooks_statusupdate($userid, $statusmessage) {

}

function hooks_forcefriends() {

}

function hooks_activityupdate($userid, $status) {
	if($status=="offline"){
		$ahora_5=date("Y-m-d H:i:s",time()-2*60);
		$sql="update ax_generalRegister set tiempoutlimaactividad='$ahora_5' where id='$userid'";
		mysql_query($sql);
	}
}

function hooks_message($userid, $unsanitizedmessage) {

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LICENSE */

include_once(dirname(__FILE__).'/license.php');
$x="\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
eval($x('JHI9ZXhwbG9kZSgnLScsJGxpY2Vuc2VrZXkpOyRwXz0wO2lmKCFlbXB0eSgkclsyXSkpJHBfPWludHZhbChwcmVnX3JlcGxhY2UoIi9bXjAtOV0vIiwnJywkclsyXSkpOw'));

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////