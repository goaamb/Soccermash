<?PHP

require('lib/site_ini.php');

# ID del módulo y de la página solicitada
$sModId 	= RetrieveGetVar('modid', 	dSTRING, 'home');
$sPgId 		= RetrieveGetVar('pgid', 	dSTRING, 'index');

define ('SITE_CURRENT_Modulo', 	$sModId);
define ('SITE_CURRENT_Page', 	$sPgId);
               
if ($SITE->setUser())
{
	if ($SITE->checkModule())
	{
		define ('TPL_Directory', SITE_MODULES_Path . "/$sModId/tpl");
		require(SITE_MODULES_Path . "/$sModId/$sPgId.php");
                //die("entra");
		
	}
	else
	{                    // die("NOentra");
		if ($sPgId == 'logout')
		{
			define ('TPL_Directory', SITE_MODULES_Path . "/home/tpl");
			require(SITE_MODULES_Path . '/home/logout.php');
		}
		else
		{
			define ('TPL_Directory', SITE_MODULES_Path . "/home/tpl");
			require(SITE_MODULES_Path . '/home/index.php');
		}
	}
}
else
{
	define ('TPL_Directory', SITE_MODULES_Path . "/home/tpl");
	require(SITE_MODULES_Path . '/home/login.php');
}

?>