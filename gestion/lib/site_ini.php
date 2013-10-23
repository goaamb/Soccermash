<?php
	$_DIRBASE=dirname(dirname(__FILE__));
	require ($_DIRBASE . '/config.php');
	require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	require_once $_GBASE. '/goaamb/idioma.php';
	
	$sPanel = 'gestion';
	$sRaiz = '';
	$sSub = '';
	$iCantSub = 0;
	if (!empty($sSubDominio))
	{
		$sSub = "/$sSubDominio";
		$iCantSub = sizeof(explode('/', $sSubDominio));
	}
	define('PANEL_App', $sSub . (!empty($sPanel) ? "/$sPanel" : ''));
	
	require ($_SERVER['DOCUMENT_ROOT'] . PANEL_App . '/lib/config/config_ini.php');
	#require ('usr/local/apache/htdocs/home/soccer/public_html/soccermashTest2/gestion/lib/config/config_ini.php');

	
	# Inicia las librerías del sistema
	$aSitePath = explode('/', $_SERVER['SCRIPT_NAME']); 
	//echo $aSitePath;
	if ($_SERVER['HTTP_HOST'] != 'localhost' && $_SERVER['HTTP_HOST'] != 'servidor' && $_SERVER['HTTP_HOST'] != 'localhost:8080')
	{
		for($iIndex = 1; $iIndex <= 1+$iCantSub; $iIndex++) $sRaiz .= '/' . $aSitePath[$iIndex];
	}
	else
	{
		$sRaiz='/axyoma/soccermashNew/'; 
		#for($iIndex = 1; $iIndex < 2+$iCantSub; $iIndex++) $sRaiz .= '/' . $aSitePath[$iIndex];
	}
	
	define ('SITE_Call', ("$sRaiz" == PANEL_App ? 'panel' : 'web'));

	include_once(SITE_LIB_Share_class . '/plugin.php');
	include_once(SITE_LIB_Share_class . '/streams.php');
	include_once(SITE_LIB_Share_class . '/gettext.php');
	require_once(SITE_LIB_Share_class . '/tras_10n.php');
	
	if(class_exists("Idioma") && !isset($_IDIOMA) && !($_IDIOMA instanceof Idioma)){
     $_IDIOMA=Idioma::darLenguaje();
 	}
	
	# Seteo los lenguages
	if (isset($_GET['lang']) && !empty($_GET['lang']))
	{
		$sLenguaje = $_GET['lang'];
	}
	elseif (isset($_SESSION['lg']))
	{
		$sLenguaje = $_SESSION['lg'];
	}
	else
	{
		$sLenguaje = 'es';
	}
	
	$SITE_aLang["es"] = array("estado" => true, "nombre" => "Español", 	"principal" => true,	"extra"	=> "");
	$SITE_aLang["en"] = array("estado" => true, "nombre" => "Inglés", 	"principal" => false,	"extra"	=> "_en");
	if(empty($SITE_aLang[$sLenguaje])){
		$sLenguaje = "es";
	}
	define ('SITE_LENGUAJE', $sLenguaje);
	
	# Site DB Constants	
	define ('SITE_DB_Host', 	$sDB_Host);
	define ('SITE_DB_User', 	$sDB_User);
	define ('SITE_DB_Pass', 	$sDB_Pass);
	define ('SITE_DB_Name', 	$sDB_Name);
	define ('SITE_DB_Prefix', 	$sDB_Prefix);	
	
	require(SITE_LIB_Config . '/config_site_ini.php'); 
	require(SITE_LIB_Config . '/config_lib_ini.php');
	
	# Modules
	$SITE->ScanModules();
	require ($_SERVER["DOCUMENT_ROOT"] . '/traza.php');	
?>
