<?PHP
	# Configuraciones generales

	define ('SITE_InProduction', 	true);
	ini_set("display_errors", 		"1");

	define ('SYSTEM_Language', 	'es');
	//define ('GOOGLE_API_KEY', 'ABQIAAAAZClUUKImJLrAkcVbKJyB6xQbtiKj2v8XzIs27iIOSPQyEJhgVBQbNfRsxn61PzL_0NL_1I5UjXL0cg');

	# Configuración del servidor
	define ('SERVER_Name',			$sUrlSite .  PANEL_App . "/");
	define ('SERVER_HOME_Path',		$_SERVER['DOCUMENT_ROOT'] . '/' . PANEL_App . "/");
	define ('SITE_HOME_Path',		$_SERVER['DOCUMENT_ROOT'] . '/' . $sSubDominio);
	define ('SITE_Url', 			$sUrlSite . (!empty($sSubDominio) ? '/' . $sSubDominio : ''));
	
	# WEB SERVER | Configuración de los datos del web server
	define ('SERVER_DOCROOT_Path', 	SERVER_HOME_Path);
	define ('SITE_BASE_Path',		SERVER_DOCROOT_Path);
	define ('SITE_BASE_Url',		SERVER_Name);


	define ('SYSTEM_ACTIVATION_Days', 	30);
	define ('SYSTEM_CODE_Cryp', 		'avsje53gas883d-_kiyz2d0$s8sw47al8w');

  	# Constantes directorio: backup
	define ('SITE_BACKUP_Path',			SERVER_HOME_Path . '/backup' );

  	# Constantes directorio: lib
	define ('SITE_LIB_Path',			SERVER_HOME_Path . '/lib' );
	define ('SITE_LIB_Config',			SITE_LIB_Path . '/config' );
	define ('SITE_LIB_Share',			SITE_LIB_Path . '/share' );
	define ('SITE_LIB_Share_class',		SITE_LIB_Share . '/clases' );
	define ('SITE_LIB_Site',			SITE_LIB_Path . '/site');
	define ('SITE_LIB_Site_class',		SITE_LIB_Site . '/class');

	# Constantes directorio: modulos
	define ('SITE_MODULES_Path',		SERVER_HOME_Path . '/modulos');

	# Constantes directorio: share
	define ('SITE_SHARE_Path',			SERVER_HOME_Path . '/share');
	define ('SITE_SHARE_Inc',			SITE_SHARE_Path . '/inc');
	define ('SITE_SHARE_Ajax',			SITE_SHARE_Path . '/ajax');
	define ('SITE_SHARE_Data',			SITE_SHARE_Path . '/data');
	define ('SITE_SHARE_AjaxUpload',	SITE_SHARE_Ajax . '/upload');
	
	define ('SITE_URL_SHARE_Data',		SERVER_Name		. 'share/data');




	/** Configuración de Usuarios del sistema **/
	define ('SITE_DB_TB_SystemUsuarios',	'ax_generalRegister');
	define ('System_UserNickMinimoChars', 	4);
	define ('System_UserNickMaximoChars', 	15);
	define ('System_UserPassMinimoChars', 	4);
	define ('System_UserPassMaximoChars', 	15);
	
	/** Configuración de Usuarios de LATEST PEOPLE **/
	define ('SITE_DB_TB_SystemLatestPeople',	'ax_latestPeople');
	/** Configuración de Usuarios de MESSAGGES **/
	define ('SITE_DB_TB_SystemSentMsj',	'ax_sentMsj');
	define ('SITE_DB_TB_SystemReplyMsj',	'ax_replyMsj');
	/** Configuración de Usuarios de FOLLOWER **/
	define ('SITE_DB_TB_SystemFollower',	'ax_follower');
	/** Configuración del Status de Usuarios  **/
	define ('SITE_DB_TB_StatusUser','cometchat_status');
	
	/** Configuración de sessiones del sistema **/
	define ('SITE_DB_TB_SystemSessions',		'system_session');
	#define ('SITE_DB_TB_SystemBuckup',			'system_backup');
	#define ('SITE_DB_TB_SystemPaises',			'system_paises');
	#define ('SITE_DB_TB_SystemRegistro',		'system_registro');

	# Formato de fechas
	$aLANG_Format['es']['user'] 		= '#dia#/#mes#/#anio#';
	$aLANG_Format['es']['usertext'] = '#nombre_dia# #dia# de #nombre_mes# del #anio#';
	$aLANG_Format['en']['user'] 		= '#mes#/#dia#/#anio#';
	$aLANG_Format['en']['usertext'] = '#nombre_mes# #dia#, #anio#';


	/** Configuración el sistema de plantillas **/
	# Configuro el sub-sistema de cache
	define ('TPL_CACHE_Enable',				!SITE_InProduction);
	define ('TPL_CACHE_LiteTime',			1);//900);	// 15 Minutos
	define ('TPL_CACHE_Directory',		SITE_HOME_Path . '/cache');

	# Configuro el funcionamiento de los URL (permalink)
	define ('TPL_Permalink',					!SITE_InProduction);

	# Configuración de cache de CSS y JAVASCRIPTS
	define ('TPL_CSS_CACHE_Enabled',	!SITE_InProduction);
	define ('TPL_CSS_Compress',				!SITE_InProduction);
	define ('TPL_CSS_CACHE_TTL',			0);  // Una semana
	define ('TPL_CSS_CACHE_Dir',			SITE_SHARE_Path . '/css/cache');
	define ('TPL_CSS_CACHE_Url',			'share/css/cache');
	define ('TPL_JAVA_CACHE_Enabled',	!SITE_InProduction);
	define ('TPL_JAVA_Compress',			!SITE_InProduction);
	define ('TPL_JAVA_CACHE_TTL',			0);  // Una semana
	define ('TPL_JAVA_CACHE_Dir',			SITE_SHARE_Path . '/js/cache');
	define ('TPL_JAVA_CACHE_Url',			'share/js/cache');
?>
