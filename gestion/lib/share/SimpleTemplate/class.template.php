<?PHP
  /**
	* SimpleTemplate
	*
	*/

	/**
 
	Sistema de cache
   ================
	Este template engine puede cachear las plantillas generadas con su contenido.
   Cuándo se vuelva a solicitar este mismo archivo, no se volverá a regenerar
   la plantilla, sinó que se devolverá la plantilla ya generada previamente.

   Para activar el sistema de cache que por defecto está desactivado, use
   enableCache() o con el hecho de asignar un CacheId o un tiempo de expiración,
   activarán el sistema de cache automáticamente.
   
   Las plantillas pueden tener un tiempo de vida que se puede indicar a través
   de setCacheLifeTime($iSeconds) donde $iSeconds es el número de segundos por
   el cuál será válida la plantilla.
   
   Las plantillas deben guardarse en un directorio temporal, que tendrá

	Cada plantilla tiene su propio CacheId que está basado en el path
   absoluto del archivo de plantilla convertido en un hash MD5.
   
   Además, por cada plantilla, se puede especificar otro ID adicional a través
   de setCacheId() que será el CachePlusId

	*/
   

   class SimpleTemplate{

		/**
		* Nombre de la plantilla que va a procesarse como Header
		* @type: string
		*/
		var $_sTemplateHeader = 'pg_header.inc.php';

		/**
		* Nombre de la plantilla que va a procesarse como Header
		* @type: string
		*/
		var $_sTemplateFooter = 'pg_footer.inc.php';

	  /**
		* Tabla de variables y referencias.
		* @type: array 
		*/
		var $_mVars = array();
      

     /**
     	* Bandera para indica el modo DEBUG
      * @type: boolean
      */
		var $_bDebug = false;

     /**
      * Array para el log del sistema de debug
      * @type: array
      */
		var $aDebug = array();

	  /**
   	* Nombre de la plantilla que va a procesarse
      * @type: string
   	*/
		var $_sTemplate = '';


	  /**
      * Bandera para indicar si funciona o no el CACHE de Plantillas
      * @type: boolean
      */
		var $_bCache = false;


	  /**
      * Bandera para indicar que se llevó a cabo la comprobación de cache de esta template
      * @type: boolean
      */
		var $_bCached = NULL;


	  /**
   	* String identificador del cache
      * @type: string
   	*/
		var $_sCacheId = NULL;


	  /**
   	* String identificador del cache
      * @type: string
   	*/
		var $_sCacheSubId = NULL;


	  /**
      * Path absoluto del directorio en donde se guardarán los caches
      * @type: string
      */
      var $_sCacheDir = '';


	  /**
      * Tiempo de vida de la plantilla en segundos
      * @type: int
      */ 
		var $_iCacheLifeTime = 0;


	  /**
      * Fecha de expiración de la plantilla
      * @type: utime
      */
		var $_dCacheExpiration = NULL;


     /**
      * Directorio por defecto en donde estarán las plantillas
      * @type: string
      */
		var $_sTemplateDir = '';




	  /**
      * @:
      * Método constructor del objeto. Se le puede indicar el nombre de la 
      * template y el id de cache. Si se indica CacheId automáticamente se
      * activará el cache para la template.
      * :@
      * @param: string $sFile 	Nombre o path abosluto de la template a usar
      * @param: string $sCacheId Identificador del cache.
      */
		function SimpleTemplate($sFile = NULL, $sCacheId = NULL)
		{
			
			$this->setTemplateHeader();
			$this->setTemplateFooter();
			
      	if ($sCacheId)
         {
         	$this->setCacheId($sCacheId);
         }

      	if ($sFile)
         {
         	$this->setTemplate($sFile);
         }

		}



	  /**
      * @:
      * Establece el path del archivo de plantilla para ser usado con este objeto.
      * Si se indica un path relativo (que no comience por /), se buscará la plantilla
      * en el directorio de las plantillas.
      * :@
      * @param: string $sFile
		*/
      function setTemplate($sFile)
      {
			if (substr($sFile, 0, 1) != '/')
	      {
				$sFile = $this->_sTemplateDir . '/' . $sFile;
      	}
			$this->_sTemplate = $sFile;

			/**
         * Si está activo el cache, genero el cach
         */
         if ($this->_bCache)
         {
         	$this->_sCacheId = md5($sFile);
         }
      }




	  /**
      * @:
      * Establece el ID del cache
      * :@ 
      * @param: string $sId : Identificador de la cache
		*/
      function setCacheId($sId)
      {
			if ($sId)
         {
	        	$this->enableCache();
				$this->_sCacheSubId = md5($sId);
         }
      }



     /**
      * Activa el modo depuración de la plantilla
      */
      function enableDebug()
      {
      	$this->_bDebug = true;
      }



	  /**
   	* Establece el directorio de las plantillas
      * @param: $sDir string Path absoluto del directorio de las plantillas
   	*/
		function setTemplateDir($sDir)
   	{
			$this->_sTemplateDir = $sDir;
   	}



	  /**
      * Activa el cache
      */
		function enableCache()
   	{
      	if ($this->_bCache)
         {
         	return;
         }
			if ($this->_sTemplate && !$this->_sCacheId)
         {
				$this->_sCacheId = md5($this->_sTemplate);
         }        
   		$this->_bCache = true;
   	}



	  /**
   	* Desactiva el cache
	   */
		function disableCache()
   	{
   		$this->_bCache = false;
	   }



	  /**
      * Establece el directorio en donde se guardará el cache
      * @param: $sDir string Path absoluto del directorio de plantillas
      */
		function setCacheDir($sDir)
   	{
   		$this->_sCacheDir = $sDir;
	   }



	  /**
      * @:
      * Establece el tiempo de vida de una plantilla en segundos. Si asigna un valor
      * igual o mayor a 0, activará el sistema de cache. Si asigna un valor menor
      * a 0, desactivará el cache. Un valor 0 significa que el cache no expira nunca.
      * :@
      * @param: int $iSeconds Nro de segundos que será valida una plantilla 
      */
	   function setCacheLifeTime($iSeconds = 0)
   	{
			if ($iSeconds >= 0)
         {
         	$this->enableCache();
	   		$this->_iCacheLifeTime = $iSeconds;
         }
         else
         {
         	$this->disableCache();
         }
	   }
   


	  /**
      * @:
      * Establece la fecha y hora en la que debe expirar esta template.
      * :@
      * @param: utime $dExpira Fecha y hora en la que debe expirar esta plantilla 
      */
	   function setCacheExpirationDate($dExpira)
   	{
      	$this->enableCache();
   		$this->_dCacheExpiration = $dExpira;
	   }



     /**
      * Asigna un valor a la tabla de variables por referencias
      * @param: string $sNm Identificador con el que será registrado el valor
      * @param: mixed  $mVar Valor que es pasado por referencia
      */
		function assignByRef($sNm, &$mVar)
		{
			$this->_mVars[$sNm] =& $mVar;
		}



     /**
     	* @:
      * Asigna una valor con identificador a la tabla de variables
      * :@
      * @param: string $sNm Identificador con el que será registrado el valor
      * @param: mixed  $mVar Valor que será guardado con el identificador
      */
		function assign($sNm, $mVar)
		{
			$this->assignByRef($sNm, $mVar);
			//$this->_mVars[$sNm] = $mVar;
		}



		/**
		* @:
		* Devuelve el valor de una variable registrada en la tabla de variables
		* :@
		* @param: string Identificador de Variable
		*/
		function &get($sNm)
		{
			if (!isset($this->_mVars[$sNm]))
			{
				$this->_mVars[$sNm] = NULL;            
			}
			return $this->_mVars[$sNm];
		}




		/**
			* @:
		* Comprueba si existe un cache para la página en cuestión. Si existe
		* el archivo, se valida primero la fecha de expiración de la plantilla,
		* luego se evalúa si corresponde el CacheLifeTime y se determina si el
		* cache es válido o no. De no ser válido, se elimina el archivo de cache.
		* :@
		* @param: string $sFile		Nombre del archivo template
		* @param: string $sCacheId Identidicador del cache
		*/
		function isCached()
   	{
			/**
         * Verifico si ya se comprobó el estado de caché para esta plantilla.
         * Esto se hace para evitar la sobrecarga del objeto y no comprobar
         * inutilmente si existe o no ya un caché.
         */
			$this->debugLog("isCached: verificando el cache");

			if (!is_null($this->_bCached))
         {
	         return $this->_bCached;
         }

			$sFileCache = $this->getCacheFileName();

			//if (file_exists($sFileCache))
			if (false)
         {
         	/**
            * Existe un archivo caché para la plantilla. Ahora tengo que comprobar
            * si el caché no expiró.
            */
            $this->debugLog("isCached: Archivo existe");

				if ($sFileTime = filemtime($sFileCache))
            {
            	/**
					* Tengo la hora. Ahora vemos si el caché expiró
					*/
               if ($this->_dCacheExpiration)
               {
			       	if ($sFileTime < $this->_dCacheExpiration)
   	            {
							$this->debugLog("isCached: Caché aún válido. No expiró la fecha.");
							$this->_bCached = true;
							return true;
						}
                  else
                  {
	                  $this->debugLog("isCached: Expiró la fecha del cache.");
                  }
               }
               elseif ($this->_iCacheLifeTime == 0)
               {
						$this->debugLog("isCached: Caché aún válido. No expira nunca.");
						$this->_bCached = true;
						return true;
               }
               elseif (($sFileTime + $this->_iCacheLifeTime) >= time())
  	            {
              	   $this->debugLog("isCached: Caché válido");
						$this->_bCached = true;
						return true;
					}
					$this->debugLog("isCached: cache timeout - Archivo borrado");
					$this->clearCache();
            }
            else
            {
            	/**
               * No se pude recuperar la hora de modificación del archivo
               */
					$this->debugLog("isCached: No se pudo recuperar la hora de la última modificación.");
            }
         }
         else
         {
			  /**
            * No existe el archivo
            */
				$this->debugLog("isCached: No existe ningún archivo de caché.");         	
         }

			/**
         * La plantilla no tiene ningún cache válido. Se retorna false.
         */
         $this->_bCached = false;
         return false;			
		}



     	/**
		* Elimina el cache para la plantilla
      	* @return: boolean | Retorna true si el cache pudo borrarse, falso si nó.
		*/
      	function clearCache()
		{
	      	$this->debugLog("clearCache: Borrando el cache.");
			return @unlink($this->getCacheFileName());
	   	}

		/**
		* @:
		* Establece el header a mostrar     
		*/
		function setTemplateHeader($sTpl = NULL){
			$this->_sTemplateHeader = SITE_SHARE_Inc . '/' . (($sTpl) ? $sTpl : $this->_sTemplateHeader);
		}
		
		/**
		* @:
		* Establece el footer a mostrar     
		*/
		function setTemplateFooter($sTpl = NULL){
			$this->_sTemplateFooter = SITE_SHARE_Inc . '/' . (($sTpl) ? $sTpl : $this->_sTemplateFooter);
		}
		
		/**
		* @:
		* Genera y devuelve el contenido según la plantilla indicada en $sFile
		* con el contenido existente en la tabla de variables. Opera bajo las
		* condiciones del estado del cache
		* :@
		* @param: string $sFile     Nombre o path absoluto del archivo de plantilla.
		*                           Si es solo el nombre, se buscará la plantilla
		*                           en el directorio de plantillas por defecto.
		* @param: string $sCacheId  Identificador del caché      
		*/
		function fetch()
		{
			global $SITE;
			
			$this->debugLog("fetch:start");

			if ($this->_bCache && $this->isCached())
         	{
				/**
	            * Está activo el cache y existe un cache
	            */
				$this->debugLog("fetch: recuperando desde el cache");
				if (!$tContents = $this->fetchCache())
            	{
					$this->clearCache();
					//die ("ISWL_Template:fetch() error al recuperar el contenido del cache <br /><pre>" . print_r($this->aDebug) . '</pre>');
					die ('Lo siento, hubo un error... vuelve a intentarlo actualizando la página con F5. Gracias!');
            	}
         	}
         	else
         	{
	         	/**
	            * No está activo el caché o el cache no es válido
	            */
				$this->debugLog("fetch: Generando el contenido");
				
				ob_start();							// Inicio un buffer para la salida
				
				# Load menu?
				$this->loadMenuFiles();
				
				include($this->_sTemplateHeader);	// Plantilla Header
				include($this->_sTemplate);			// Leo la plantilla
				include($this->_sTemplateFooter);	// Plantilla Footer
				
				$tContents = ob_get_contents();		// Recupero los contenidos desde el buffer de salida
				ob_end_clean();  					// Cierro y limpio el bufer de salida
	
				/**
	            * Si el cache está activo, guardo la plantilla
	            */
	            if ($this->_bCache)
	            {
					$this->debugLog("fetch: Cacheando el contenido");
					if (!$this->saveCache($tContents))
	               	{
						die ('ISWL_Template:fetch() : Error al guardar el contenido en cache');
	               	}
	            }
			}

			if ($this->_bDebug)
			{
				$tContents .= '<pre>' . $this->getCacheFileName() . "\n" . var_export($this->aDebug, true) . '</pre>';
			}
         
			// Retorno el contenido
			return $tContents;
		}
	
	# SubMenues
	function loadMenuFiles(){
		global $aMenuArray;
		@include(dirname($this->_sTemplateDir) . "/.menu.php");
		
		if(empty($aMenuArray) OR !is_array($aMenuArray)) return false;
		
		$this->aSubMenues = array_merge($this->aSubMenues, $aMenuArray);
	}


	  /**
     	* @:
      * Recupera el contenido del cache de la plantila. Si por alguna razón
      * no puede abrir el archivo, retorna false.
      * :@
      * @return: string Contenido del cache de la plantilla.
      */
      function fetchCache()
		{
			if ($this->_bCached)
         {
				$this->debugLog("fetchCache: Intento leer el cache");
         	$sFileCache = $this->getCacheFileName();
				if ($rFile = @fopen($sFileCache, 'r'))
            {
               if ($iFileSize = @filesize($sFileCache))
               {
					   $tContents = @fread($rFile, $iFileSize);
   	            @fclose($rFile);
                  $this->debugLog("fetchCache: Cache leído");
	               return $tContents;
	            }
				}
            $this->debugLog("fetchCache: No pude leer el cache");
			}
			return false;
      }



	  /**
      * @:
		* Genera y envía a la salida el contenido según la plantilla indicada
      * en $sFile con el contenido existente en la tabla de variables.
      * :@
      * @param: string $sFile     Nombre o path absoluto del archivo de plantilla.
      *                           Si es solo el nombre, se buscará la plantilla
      *                           en el directorio de plantillas por defecto.
      * @param: string $sCacheId  Identificador del caché      
   	*/
		function display()
		{
			$this->debugLog("display:start");
			echo $this->fetch();
			$this->debugLog("display:end");
	   	}




     /**
      * Guarda el contenido generado en un archivo de cache
      * @param: string $sFile
      * @param: string $sCacheId
      * @param: text   $tContents
      */
      function saveCache($tContents)
      {
			$sFileCache = $this->getCacheFileName(); 
			
			/**
         * Bloqueo el archivo ignorando los warning 
         */
			// Lock file, ignore warnings as we might be creating this file
			if ($rFile = @fopen($sFileCache, "w"))
         {
	         $this->debugLog("saveCache: archivo abierto");
	         if (@flock($rFile, LOCK_EX))
   	      {
	            $this->debugLog("saveCache: archivo bloqueado");
					fwrite($rFile, $tContents, strlen($tContents));
	      		@flock($rFile, LOCK_UN);
   		     	@fclose($rFile);
               $this->debugLog("saveCache: contenido guardado");
               return true;
      	   }
            else
            {
	            $this->debugLog("saveCache: no se pudo bloquear el archivo");
            }
         }
         else
         {
	         $this->debugLog("saveCache: no se pudo abrir el archivo");
         }
			return false;
		}



	  /**
     * @:
      * Genera y retorna el nombre de archivo para ser utilizado para el template
      * cacheado. 
      * :@
      * @return string 
      */
		function getCacheFileName()
      {
      	return $this->_sCacheDir . '/cache.' . $this->_sCacheId . ($this->_sCacheSubId ? '-' . $this->_sCacheSubId : '') . '.tpl';
      }



      function debugLog($sLog)
      {
      	$this->aDebug[] = $sLog;
      }
	}

?>