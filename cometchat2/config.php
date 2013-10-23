<?php

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* SOFTWARE SPECIFIC INFORMATION (DO NOT TOUCH) */

include dirname(__FILE__).DIRECTORY_SEPARATOR.'integration.php';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* BASE URL START */

define('BASE_URL','/cometchat2/');

/* BASE URL END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* LANGUAGE START */

$lang = 'en';
$rtl = 0;

/* LANGUAGE END */ 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ICONS START */

$trayicon[] = array('scrolltotop','Scroll To Top','javascript:jqcc.cometchat.scrollToTop();','','','','','','');

/* ICONS END */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* PLUGINS START */

$plugins = array('chattime','clearconversation','chathistory');

/* PLUGINS END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* CHATROOMPLUGINS START */

$crplugins = array('smilies','handwrite','chattime');

/* CHATROOMPLUGINS END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* SMILEYS START */

$smileys = array( 

	':)'	=>	'smiley.png',
	':-)'	=>	'smiley.png',
	':('	=>	'smiley-sad.png',
	':-('	=>	'smiley-sad.png',
	':D'	=>	'smiley-lol.png',
	';-)'	=>	'smiley-wink.png',
	';)'	=>	'smiley-wink.png',
	':o'	=>	'smiley-surprise.png',
	':-o'	=>	'smiley-surprise.png',
	'8-)'	=>	'smiley-cool.png',
	'8)'	=>	'smiley-cool.png',
	':|'	=>	'smiley-neutral.png',
	':-|'	=>	'smiley-neutral.png',
	":'("	=>	'smiley-cry.png',
	":'-("	=>	'smiley-cry.png',
	":p"	=>	'smiley-razz.png',
	":-p"	=>	'smiley-razz.png',
	":s"	=>	'smiley-confuse.png',
	":-s"	=>	'smiley-confuse.png',
	":x"	=>	'smiley-mad.png',
	":-x"	=>	'smiley-mad.png'
);

/* SMILEYS END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* BANNED START */

$bannedWords = array( 'asshole','fuck','bastard','bitch','suck', );
$bannedUserIDs = array();
$bannedMessage = 'Sorry, you have been banned from using this service. Your messages will not be delivered.';

/* BANNED END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADMIN START */

define('ADMIN_USER','admin');
define('ADMIN_PASS','e7ebVvW');

/* ADMIN END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* COOKIE */

$cookiePrefix = 'cc_';				// Modify only if you have multiple CometChat instances on the same site

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* SETTINGS START */

$lightWeight = '1';			// Switch on light-weight chat?
$hideOffline = '0';			// Hide offline users in Whos Online list?
$autoPopupChatbox = '1';			// Auto-open chatbox when a new message arrives
$messageBeep = '1';			// Beep on arrival of message from new user?
$beepOnAllMessages = '1';			// Beep on arrival of all messages?
$barType = 'fluid';			// Bar layout
$barWidth = '960';			// If set to fixed, enter the width of the bar in pixels
$barAlign = 'center';			// If set to fixed, enter alignment of the bar
$barPadding = '20';			// Padding of bar from the end of the window
$minHeartbeat = '3000';			// Minimum poll-time in milliseconds (1 second = 1000 milliseconds)
$maxHeartbeat = '30000';			// Maximum poll-time in milliseconds
$longNameLength = '22';			// The length after which characters will be truncated in long names
$shortNameLength = '11';			// The length after which characters will be truncated in short names
$autoLoadModules = '0';			// If set to yes, modules open in previous page, will open in new page
$fullName = '0';			// If set to yes, both first name and last name will be shown in chat conversations
$searchDisplayNumber = '10';			// The number of users in Whos Online list after which search bar will be displayed
$thumbnailDisplayNumber = '40';			// The number of users in Whos Online list after which thumbnails will be hidden
$typingTimeout = '10000';			// The number of milliseconds after which typing to will timeout
$idleTimeout = '300';			// The number of seconds after which user will be considered as idle
$displayOfflineNotification = '1';			// If yes, user offline notification will be displayed
$displayOnlineNotification = '1';			// If yes, user online notification will be displayed
$displayBusyNotification = '1';			// If yes, user busy notification will be displayed
$notificationTime = '5000';			// The number of milliseconds for which a notification will be displayed
$announcementTime = '15000';			// The number of milliseconds for which an announcement will be displayed
$scrollTime = '1';			// Can be set to 800 for smooth scrolling when moving from one chatbox to another
$armyTime = '1';			// If set to yes, show time plugin will use 24-hour clock format
$disableForIE6 = '0';			// If set to yes, CometChat will be hidden in IE6
$disableForMobileDevices = '1';			// If set to yes, CometChat will be hidden in mobile devices
$iPhoneView = '1';			// iPhone style messages in chatboxes?
$hideBar = '0';			// Hide bar for non-logged in users?
$startOffline = '0';			// Load bar in offline mode for all first time users?
$fixFlash = '0';			// Set to yes, if Adobe Flash animations/ads are appearing on top of the bar (experimental)


/* SETTINGS END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* THEME START */

$theme = 'default';

/* THEME END */

if (!empty($_COOKIE[$cookiePrefix."theme"])) {
	$theme = $_COOKIE[$cookiePrefix."theme"];
}

if ($lightWeight == 1) {
	$theme = 'lite';
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DISPLAYSETTINGS START */

define('DISPLAY_ALL_USERS','0');

/* DISPLAYSETTINGS END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* DISABLEBAR START */

define('BAR_DISABLED','0');

/* DISABLEBAR END */

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* COMET START */

define('USE_COMET','0');
define('COMET_HISTORY_LIMIT','100');
define('KEY_A','');
define('KEY_B','');
define('KEY_C','');
define('SAVE_LOGS','0');

/* COMET END */

define('TRANSPORT','cometservice');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* ADVANCED */

define('REFRESH_BUDDYLIST','1');		// Time in seconds after which the user's "Who's Online" list is refreshed
define('DISABLE_SMILEYS','0');			// Set to 1 if you want to disable smileys
define('DISABLE_LINKING','0');			// Set to 1 if you want to disable auto linking
define('DISABLE_YOUTUBE','0');			// Set to 1 if you want to disable YouTube thumbnail
define('CACHING_ENABLED','0');			// Set to 1 if you would like to cache CometChat
define('GZIP_ENABLED','1');				// Set to 1 if you would like to compress output of JS and CSS
define('DEV_MODE','0');					// Set to 1 only during development
define('ERROR_LOGGING','0');			// Set to 1 to log all errors (error.log file)
define('ONLINE_TIMEOUT',2*60);			
										// Time in seconds after which a user is considered offline
define('DISABLE_ANNOUNCEMENTS','0');	// Reduce server stress by disabling announcements
define('DISABLE_ISTYPING','1');			// Reduce server stress by disabling X is typing feature
define('CROSS_DOMAIN','0');				// Do not activate without consulting the CometChat Team

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Pulls the language file if found
if(isset($_SESSION["lg"])){
	list($lang,)=explode("-", $_SESSION["lg"]);
}
if(!$lang){
	$lang="es";
}

include dirname(__FILE__).DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'en.php';
if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.$lang.'.php')) {
	include dirname(__FILE__).DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.$lang.'.php';
}