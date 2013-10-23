<?PHP
	# Defino las librerías que deseo cargar
	define ('LOAD_LIB_Http', 		true);
	define ('LOAD_LIB_Date', 		true);
	define ('LOAD_LIB_Util', 		true);
	define ('LOAD_LIB_Ajax', 		true);

	define ('LOAD_CLASS_DataBase', 		true);
	define ('LOAD_CLASS_User', 			true);
	define ('LOAD_CLASS_Image', 		true);
	define ('LOAD_CLASS_Type', 			true);
	define ('LOAD_CLASS_Pdf', 			(SITE_Call == 'panel' ? false : false));
	define ('LOAD_CLASS_Xajax', 		true);

	# Cargo las librerías especificadas
	require(SITE_LIB_Share_class . '/class.inc.php');

	$SITE_oDB = new CLASS_DB;
	$SITE_oDB->Setup('mysql', SITE_DB_Host, NULL, SITE_DB_User, SITE_DB_Pass, SITE_DB_Name, true);
	#$SITE_oDBLB = new CLASS_DB;
	#$SITE_oDBLB->Setup('mysql', SITE_DB_Host, NULL, SITE_DB_User, SITE_DB_Pass, SITE_DB_Name, true);
	
	# Clase template
	require(SITE_LIB_Share . '/SimpleTemplate/class.template.php');
	require(SITE_LIB_Site_class . '/class_template.php');
?>