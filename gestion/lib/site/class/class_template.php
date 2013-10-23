<?PHP
class CLASS_Template extends SimpleTemplate
{
	var $sPageTitle;
	var $sPageKeywords;
	var $sPageDescription;

	var $bSiteInProduction = false;

	var $aCSS 	= array(0 => array(), 1 => array(), 2 => array(), 3 => array(), 4 => array(), 5 => array(), 6 => array(), 7 => array(), 8 => array(), 9 => array());
	var $aJS 		= array();

	var $aWidgets = array();
	var $aFilters = array();

	var $aGlobalVar = array();

	var $aFunctionJS = array();
	
	var $aSubMenues = array();

	function CLASS_Template($sFile = NULL, $sCacheId = NULL)
	{
		if (defined("SITE_TPL_Title"))			$this->setTitle(SITE_TPL_Title);
		if (defined("SITE_TPL_Keywords"))		$this->setTitle(SITE_TPL_Keywords);
		if (defined("SITE_TPL_Description"))	$this->setTitle(SITE_TPL_Description);
		if (defined("SITE_InProduction"))		$this->bSiteInProduction = SITE_InProduction;

		// Chequeo si es una plantilla sin path o con path. Si no tiene algún
		// path, uso el directorio por país
		$aFileInfo = pathinfo($sFile);

		if (empty($aFileInfo['dirname']) OR $aFileInfo['dirname'] == '.')
		{
			$this->setTemplateDir(TPL_Directory);
			//$this->setTemplateDir(TPL_Directory . '/' . SITE_PAIS_Id);
		}
		else
		{
			$this->setTemplateDir(TPL_Directory);
		}

		// 
		if (TPL_CACHE_Enable)
		{
			$this->enableCache();
			$this->setCacheLifeTime(TPL_CACHE_LiteTime);
			/**
			Le agregue "'/' . SITE_PAIS_Id" a la siguiente línea para que guarde los cache
			diferenciando cada país.
			**/
			$this->setCacheDir(TPL_CACHE_Directory);
		}
		else
		{
			$this->disableCache();
		}
		// Llamo al método constructor
		$this->SimpleTemplate($aFileInfo['basename'], $sCacheId);

	}//CLASS_Template()

	function setTitle($sIn = NULL)
	{
		$this->sPageTitle = $sIn;
	}
	
	function addTitle($sIn = NULL)
	{
		$this->sPageTitle .= $sIn;
	}

	function setKeywords($sIn = NULL)
	{
		$this->sPageKeywords = $sIn;
	}

	function addKeywords($sIn = NULL)
	{
		$this->sPageKeywords .= ',' . $sIn;
	}   

	function setDescription($sIn = NULL)
	{
		$this->sPageDescription = $sIn;
	}

	function addDescription($sIn = NULL)
	{
		$this->sPageDescription .= '. ' . $sIn;
	}

	function getTitle()
	{
		return $this->sPageTitle;
	}
	function getKeywords()
	{
		return $this->sPageKeywords;
	}

	function getDescription()
	{
		return $this->sPageDescription;
	}

	/**
	 * Registra las hojas de estilo que se deberán adjuntar a esta página
	 */
	function registerCSS($sUrl, $iPeso = 5)
	{
		$this->aCSS[$iPeso][] = SITE_BASE_Path . $sUrl;
	}#registerCSS()
	
	function changeLang($sLang){
		$_GET['lang'] = $sLang;
		return '?' . Array2Query($_GET);
	}
	
	/**
	 * Retorna la hoja de estilos para esta página
	 */
	function getCSS()
	{
		$sCacheFile = '';
		$sContent 	= '';

		foreach ($this->aCSS as $aCSS)
		{
			foreach ($aCSS as $sCSS)
			{
				$sCacheFile .= $sCSS;
			}
		}
		$sCacheFile = md5($sCacheFile) . '.css';

		if (TPL_CSS_CACHE_Enabled)
		{
			// Verifico el cache
			if (file_exists(TPL_CSS_CACHE_Dir . '/' . $sCacheFile))
			{
				// Si existe el cache
				if (TPL_CSS_CACHE_TTL != 0)
				{
					if ($iFileTS = fileatime(TPL_CSS_CACHE_Dir . '/' . $sCacheFile))
					{
						// Si se pudo recuperar la hora
						if ($iFileTS < time() + TPL_CSS_CACHE_TTL)
						{
							// Si el cache no ha expirado
							return  '<!-- en _cache -->' . "\n" . '<link href="' . TPL_CSS_CACHE_Url . '/' . $sCacheFile. '" rel="stylesheet" type="text/css" media="screen" />';
						}
					}
				}
			}
		}

		// Concateno el contenido de cada hoja de estilos
		foreach ($this->aCSS as $aCSS)
		{
			foreach ($aCSS as $sCSS)
			{
				$sContent .= file_get_contents($sCSS);
			}
		}

		$sContent = preg_replace('!/\*.*\*/!Us', 	'', $sContent);	// Elimina los comentarios
		$sContent = str_replace("\n\n", 					"", $sContent);	// Elinima los salto de lineas
		$sContent = str_replace("\t", 						"", $sContent);	// Elimina 
		$sContent = str_replace("  ", 						"", $sContent);	// Elimina los espacios en blanco

		$rFile = fopen(TPL_CSS_CACHE_Dir . '/' . $sCacheFile, "w");
		fwrite($rFile, $sContent);
		fclose($rFile);

		return  '<link href="' . TPL_CSS_CACHE_Url . '/' . $sCacheFile. '" rel="stylesheet" type="text/css" media="screen" />';
	}#getCSS()


	/**
	 * Registra los scrips que se deberán adjuntar a esta página
	 */
	function registerJS($sUrl)
	{
		$this->aJS[] = SITE_BASE_Path . $sUrl;
	}#registerJS()


	/**
	 * Retorna los script JS para la página
	 */
	function getJS()
	{
		$sCacheFile = '';

		if (sizeof($this->aJS) > 0)
		{
			foreach ($this->aJS as $sJS)
			{
				$sCacheFile .= $sJS;
			}

			$sCacheFile = md5($sCacheFile) . '.js';

			if (TPL_JAVA_CACHE_Enabled)
			{
				// Si existe el cache
				if (@file_exists(TPL_JAVA_CACHE_Dir . '/' . $sCacheFile))
				{
					return '<!-- js en cache -->' . "\n" . '<script type="text/javascript" language="javascript" src="' . TPL_JAVA_CACHE_Url . '/' . $sCacheFile . '"></script>';
				}
			}
			require(SITE_LIB_Site . '/class/class_jscache.php');
			# Genero la compresión y el cache del archivo
			new CLAS_JS_Cache($this->aJS, TPL_JAVA_CACHE_Dir . '/' . $sCacheFile);

			return "\n" . '<script type="text/javascript" language="javascript" src="' . TPL_JAVA_CACHE_Url . '/' . $sCacheFile . '"></script>';
		}
		return '';
	}#getJS()


	function importWidget($sName)
	{
		$sCode = '';
		switch($sName)
		{
			case 'tooltip':
				$sCode .= "<!-- INI :: Widget Tooltip -->\n";
				$sCode .= '<script language="javascript" type="text/javascript" src="share/js/jquery.dimensions.js"></script>' . "\n";
				$sCode .= '<script language="javascript" type="text/javascript" src="share/js/jquery.tooltip.pack.js"></script>' . "\n";
				$sCode .= '<link rel="stylesheet" type="text/css" href="share/css/jquery.tooltip.css" />' . "\n";
				$sCode .= '<!-- END :: Widget Tooltip -->' . "\n";
				break;

			case 'calendar':
				$sCode .= "<!-- INI :: Widget Calendar -->\n";
				$sCode .= '<script language="javascript" type="text/javascript" src="share/js/jscalendar/jquery.calendar.pack.js"></script>' . "\n";
				$sCode .= '<script language="javascript" type="text/javascript" src="share/js/jscalendar/jquery-calendar-es.js"></script>' . "\n";
				$sCode .= '<link rel="stylesheet" type="text/css" href="share/js/jscalendar/jquery.calendar.css" />' . "\n";
				$sCode .= '<!-- END :: Widget Calendar -->' . "\n";
				break;

			case 'editor':
				$sCode .= "<!-- INI :: Widget Editor TINY-MCE -->\n";
				$sCode .= '<script src="share/js/tiny_mce/tiny_mce.js" type="text/javascript"></script>' . "\n";
				//$sCode .= '<script src="share/js/tiny_mce/tiny_mce_gzip.js" type="text/javascript"></script>' . "\n";
				//$sCode .= '<script type="text/javascript">' . "\n";
				//$sCode .= 'tinyMCE_GZ.init({plugins : "style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras", themes : "simple,advanced", languages : "' . SYSTEM_Language . '", disk_cache : true, debug : false});' . "\n";
				//$sCode .= '</script>' . "\n";
				$sCode .= '<!-- END :: Widget Editor TINY-MCE -->' . "\n";
				break;

			case 'tabs':
				$sCode .= "<!-- INI :: Widget Tabs -->\n";
				$sCode .= '<script src="share/js/jquery.tabs.pack.js" type="text/javascript"></script>' . "\n";
				$sCode .= '<link rel="stylesheet" href="share/css/jquery.tabs.css" type="text/css" media="print, projection, screen">' . "\n";
				$sCode .= '<!-- END :: Widget Tabs -->' . "\n";
				break;
		}
		$this->aWidgets[] = $sCode;
	}#importWidget()


	function getWidgets()
	{
		$sCode = "<!-- INI :: Widget autogenerados -->\n\n";
		$sCode .= implode("\n", $this->aWidgets);
		$sCode .= "\n\n<!-- END :: Widget autogenerados -->";
		echo $sCode;
	}#getWidgets()


	function getGlobalVars()
	{
		return $this->_mVars;
	}#getGlobalVars()


	function registerFilerPage($sKey, $sValue)
	{
		$this->aFilters[$sKey] = $sValue;
	}#registerFiler()


	function getFiltro($sKey)
	{
		return (isset($this->aFilters[$sKey]) ? $this->aFilters[$sKey] : '');
	}#getFiltro()


	function getFilerPage($sTypeEncode)
	{
		$mReturn = false;
		if (sizeof($this->aFilters) > 0)
		{
			switch($sTypeEncode)
			{
				case 'json':
					$aReturn = array();
					foreach ($this->aFilters as $sKey => $sValue)
					{
						$aReturn[] = "$sKey: '$sValue'";
					}
					$mReturn = '{' . implode(', ', $aReturn) . '}';
					break;

				case 'query':
					$aReturn = array();
					foreach ($this->aFilters as $sKey => $sValue)
					{
						$aReturn[] = $sKey . '=' . addslashes($sValue);
					}
					$mReturn = implode('&', $aReturn);
					break;

				case 'array':
					$mReturn = $this->aFilters;
					break;
			}
		}
		return $mReturn;
	}#getFilerPage()


	function insertInitFunctionJS($sNameFunction, $sParams = '')
	{
		$this->aFunctionJS[] = "$sNameFunction($sParams);";
	}

	function generateInitFunctionsJS()
	{
		$sReturn = '';
		if (sizeof($this->aFunctionJS) > 0)
		{
			$sReturn .= '<script language="JavaScript" type="text/javascript">' . "\n";
			$sReturn .= '$(document).ready(function(){' . implode('', $this->aFunctionJS) . '});' . "\n";
			$sReturn .= '</script>' . "\n";
		}
		echo $sReturn;
	}
}//CLASS_Template()
?>