<?PHP
	# Configuraciones generales

	define ('SITE_Id',		' Soccer Mash');
	define ('SITE_Name',	(SITE_Call == 'panel' ? ' Soccer Mash ' . __('[ Panel ]') : ' Soccer Mash'));

	define ('SITE_Theme', 'gray');

	/**
	 * Contiene la cantidad de links mostrados en el paginador.
	 * La cantidad de páginas entre los "[1][2] ... - x páginas - ... [n-1][n]"
	 * La cantidad debe ser un número impar
	 */
	define ('SITE_BAS_INSIDE_Page',	5);

	# Defino el lenguaje
	define ('SYSTEM_DATE_FormatUser', 		$aLANG_Format[SYSTEM_Language]['user']);
	define ('SYSTEM_DATE_FormatUserText', 	$aLANG_Format[SYSTEM_Language]['usertext']);

	define ('FOTOS_PERFILGENERAL_Path', 	SITE_HOME_Path . '/photoProfile');
	define ('FOTOS_PERFILGENRAL_Url', 	    SITE_Url . '/photoProfile');



	$aProductosImagenes = array('grande'  => 	array('ancho' => 180, 'alto' => 180),
						       'mediana' => 	array('ancho' => 50, 'alto' => 50),
							'chica'   => 	array('ancho' => 30, 'alto' => 30));

	define ('EMAIL_NOREPLY', 			'noreply@soccermash.com');
	define ('EMAIL_TEMPLATES_PATH', 	SITE_HOME_Path . '/templates/');

	# Tipos de imágenes permitidas para los banners
	$SITE_aImagenesPermitidas[1] 	= 'GIF';
	$SITE_aImagenesPermitidas[2] 	= 'JPG';
	$SITE_aImagenesPermitidas[3] 	= 'PNG';

?>
