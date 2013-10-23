<?PHP
	######################################
	## Funciones para el manejo de HTML ##
	######################################

	/**
	 * Retorna el URL transformado para ser usado en la página
	 * @param $sModId:	String con el ID del módulo al que pertenece la página
	 * @param $sPageId:	String con el ID del nombre de la página a retornar
	 * @param $sParam:	String con la lista de parámetros para la página
	 * @return String con el URL generado para la página correspondiente a los parámetros
	 */
	function getPermalink($sModId, $sPageId = NULL, $sParam = NULL)
	{
		global $SITE;
		$sPageId = ((is_null($sPageId)) ? 'index' : $sPageId);
		
		return "index.php?modid=$sModId&pgid=$sPageId" . (!empty($sParam) ? '&' . $sParam : '');
	}
	
	/**
	 * Retorna el URL de las llamadas AJAX
	 * @param $sModId:	String con el ID del módulo al que pertenece la página
	 * @param $sPageId:	String con el ID del nombre de la página a retornar
	 * @param $sParam:	String con la lista de parámetros para la página
	 * @return String con el URL generado para la página correspondiente a los parámetros
	 */
	function getAjaxPermalink($sModId, $sPageId = NULL, $sParam = NULL)
	{
		return "share/ajax/common.php?modid=$sModId&ajaxid=$sPageId&pgid=" . SITE_CURRENT_Page . (!empty($sParam) ? '&' . $sParam : '');
	}


	# Retorna una variable pasada por parámetro (GET / POST)
	function RetrieveVar($sVar = NULL, $sType = dSTRING, $mDefault = NULL, $sTypeChild = dSTRING)
	{
		$mVl = NULL;
		if (is_null($sType)) $sType = dSTRING;
		$mVl = RetrievePostVar($sVar, $sType, NULL, $sTypeChild);
		if (is_null($mVl)) $mVl = RetrieveGetVar($sVar, $sType, $mDefault, $sTypeChild);
		return $mVl;
	}#RetrieveVar()


	# Retorna una variable pasada por parámetro (POST)
	function RetrievePostVar($sVar = NULL, $sType = NULL, $mDefault = NULL, $sTypeChild = dSTRING)
	{
		global $HTTP_POST_VARS;
		return ((isset($_POST[$sVar])) ? _ParseVar($_POST[$sVar], $sType, $sTypeChild) : ((isset($HTTP_POST_VARS[$sVar])) ? _ParseVar($HTTP_POST_VARS[$sVar], $sType, $sTypeChild) : $mDefault));
	}#RetrievePostVar()


	# Retorna una variable pasada por parámetro (GET)
	function RetrieveGetVar($sVar = NULL, $sType = NULL, $mDefault = NULL, $sTypeChild = dSTRING)
	{
		global $HTTP_GET_VARS;
		return ((isset($_GET[$sVar])) ? _ParseVar($_GET[$sVar], $sType, $sTypeChild) : ((isset($HTTP_GET_VARS[$sVar])) ? _ParseVar($HTTP_GET_VARS[$sVar], $sType, $sTypeChild) : $mDefault));
	}#RetrieveGetVar()


	# Formatea una variable
	function _ParseVar($mValue = NULL, $sType = dSTRING, $sTypeChild = dSTRING)
	{
		if ($sType != dARRAY)	$mValue = (get_cfg_var('magic_quotes_gpc') ? stripslashes($mValue) : $mValue);

		switch($sType)
		{
			case dSTRING: 	return DATE_Types::FILTER_AsString($mValue); 							break;
			case dTEXT: 		return DATE_Types::FILTER_AsText($mValue); 								break;
			case dINTEGER: 	return DATE_Types::FILTER_AsInteger($mValue); 						break;
			case dFLOAT: 		return DATE_Types::FILTER_AsFloat($mValue); 							break;
			case dBOOLEAN: 	return DATE_Types::FILTER_AsBoolean($mValue); 						break;
			case dDATE: 		return DATE_Types::FILTER_AsDate($mValue); 								break;
			case dTIME: 		return DATE_Types::FILTER_AsTime($mValue); 								break;
			case dDATETIME: return DATE_Types::FILTER_AsDataTime($mValue); 						break;
			case dARRAY: 		return DATE_Types::FILTER_AsArray($mValue, $sTypeChild); 	break;
		}
		return NULL;
	}#_ParseVar()


	# Retorna el valor de una variable almacenada en una Cookie
	function SiteRetrieveCookieVar($sVar = NULL, $sType = false, $mDefault = NULL)
	{
		global $HTTP_COOKIE_VARS;
		return ((isset($_COOKIE[$sVar])) ? _ParseVar($_COOKIE[$sVar], $sType) : ((isset($HTTP_COOKIE_VARS[$sVar])) ? _ParseVar($HTTP_COOKIE_VARS[$sVar], $sType) : $mDefault));
	}#RetrieveCookieVar()


	# Guarda valores en una Cookie
	function SiteSetCookie($sNm = '', $sValue = '', $iDaysToExpire = 0, $sPath = NULL, $sDomain = NULL, $bSecure = 0)
	{
		return setcookie($sNm, $sValue, (time() + 60 * 60 * 24 * $iDaysToExpire), $sPath, $sDomain, $bSecure);
	}#SetCookie()


	# Elimina los  valores de una Cookie guardada
	function SiteDestroyCookieVar($sNm = NULL)
	{
		return setcookie($sNm, '', -30);
	}#DestroyCookie()


	# Retorna los valores de un archivo pasado como parámetro a una página
	function RetrieveFile($sNm = NULL)
	{
		global $HTTP_POST_FILES;

		$aFile = array();

		if (isset($_FILES[$sNm]))
		{
			$aFile['name'] = $_FILES[$sNm]['name'];
			$aFile['size'] = $_FILES[$sNm]['size'];
			$aFile['type'] = $_FILES[$sNm]['type'];
			$aFile['path'] = $_FILES[$sNm]['tmp_name'];
		}
		elseif (isset($HTTP_POST_FILES[$sNm]))
		{
			$aFile['name'] = $HTTP_POST_FILES[$sNm]['name'];
			$aFile['size'] = $HTTP_POST_FILES[$sNm]['size'];
			$aFile['type'] = $HTTP_POST_FILES[$sNm]['type'];
			$aFile['path'] = $HTTP_POST_FILES[$sNm]['tmp_name'];
		}
		else
		{
			return NULL;
		}
		return $aFile;
	}#RetrieveFile()


	# Redirecciona una página al Url indicado
	function Redirect($sUrl = NULL)
	{
		if ($sUrl)
		{
			header("Location: $sUrl\n\n"); exit;
		}
		return false;
	}#HTTP_Redirect()


	# Redirecciona una página al Url indicado mostrando "Si su navegador no cambia de página automáticamente, haga..."
	function RedirectPage($sUrl = false, $sTitle = 'Redireccionado')
	{
		?>
		<html>
			<head>
				<title><?=$sTitle;?></title>
				<meta http-equiv="refresh" content="0;URL=<?=$sUrl;?>">
			</head>
			<body>
				<div align="center" style="padding: 100px 0;">
					<?=$sTitle;?><br />
					<?=__('Si su navegador no cambia de página automáticamente, haga un ') . '<a href="' . $sUrl . '" target="_self">' . __('click aquí') . '</a>.';?>
				</div>
			</body>
		</html>
		<?php
	}#PageRedir()
?>