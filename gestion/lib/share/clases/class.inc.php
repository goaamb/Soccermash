<?PHP
/**
Framework 
Desc...: Inicia todas las librerías del Framework
**/

# PHP RunTime configuration
//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL);
//set_magic_quotes_runtime(0);
//ini_set('session.use_trans_sid', 	1);
ini_set('magic_quotes_runtime', 	0);

ini_set('memory_limit','64M');

@session_start();

# Constants sobre el Framework 
define ('SITE_EngineVersion', 	'1');
define ('SITE_EnginRevision', 	'0');
define ('SITE_DEBUG_Mode', 		true);

# Error de Niveles
define ('ERROR_System',    1);
define ('ERROR_Warning',   2);
define ('ERROR_Notice',    3);
define ('ERROR_User',      4);

# Carga las clases principales
require (SITE_LIB_Share_class . '/class_main.inc.php');
require (SITE_LIB_Share_class . '/class_main_error.inc.php');
require (SITE_LIB_Share_class . '/class_registro.inc.php');

# Clases
if (LOAD_CLASS_Type) 		require (SITE_LIB_Share_class . '/class_types.inc.php');
if (LOAD_CLASS_DataBase) 	require (SITE_LIB_Share_class . '/class_db.inc.php');
#if (LOAD_CLASS_User) 		require (SITE_LIB_Share_class . '/class_user.inc.php');
if (LOAD_CLASS_Image) 		require (SITE_LIB_Share_class . '/class_image.inc.php');
if (LOAD_CLASS_Pdf) 		require (SITE_LIB_Share_class . '/class_pdf.inc.php');
if (LOAD_CLASS_Xajax) 		require (SITE_LIB_Share_class . '/xajax_core/xajax.inc.php');

require (SITE_LIB_Share_class . '/class_dbobject.php');

# Librerías
if (LOAD_LIB_Http) 			require (SITE_LIB_Share_class . '/lib_http.inc.php');
if (LOAD_LIB_Date) 			require (SITE_LIB_Share_class . '/lib_date.inc.php');
if (LOAD_LIB_Util) 			require (SITE_LIB_Share_class . '/lib_util.inc.php');
if (LOAD_LIB_Ajax) 			require (SITE_LIB_Share_class . '/lib_ajax.inc.php');

# Instanci todas las clases
$SITE_oError = new CLASS_MainError;
$SYSTEM_oRegistro = new SYSTEM_Registro();

# Manages the User & System Modules
require (SITE_LIB_Share_class . '/class_site.inc.php');
$SITE	= new CLASS_Site();

?>
