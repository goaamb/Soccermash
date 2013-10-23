<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	// function detect language 
	$languages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];// HTTP_ACCEPT_LANGUAGE
	$language = substr($languages, 0, 2);
	//echo $language;
	if ($language=="es"){
		define('LANGUAGE',2);//Spanish
	}elseif($language=="en"){
		define('LANGUAGE', 1);//English
	}
	if($language <> "es" && $language <> "en"){// language default 
		define('LANGUAGE', 1);
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="robots" content="index, follow" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<title>Welcome! to &quot;The premier social network for soccer players&quot;</title>
<link href="css/logincss.css" type="text/css" rel="stylesheet"  />
<link href="css/custom-theme/jquery-ui-1.8.11.custom.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/reset-min.css" type="text/css" rel="stylesheet" media="screen" />
<link href="Plugins/slider/imageScroller.css" type="text/css" rel="stylesheet" media="screen" />
<link href="Plugins/tooltipsLogin/jquery.qtip.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/ico" />
<link href="Plugins/tipsy/src/stylesheets/tipsy.css" type="text/css" rel="stylesheet" />
<link href="css/homestylesLegal.css" type="text/css" rel="stylesheet"  />

<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>
<script src="Plugins/slider/slideLogin.js" type="text/javascript"></script>
<script src="js/scripts.js" type="text/javascript"></script>
<script src="js/css_browser_selector.js" type="text/javascript"></script>
<script src="Plugins/tooltipsLogin/jquery.qtip.js" type="text/javascript"></script>
<script src="Plugins/tooltipsLogin/jquery.qtip.pack.js" type="text/javascript"></script>
<script src="Plugins/tipsy/src/javascripts/jquery.tipsy.js" type="text/javascript"></script>
</head>