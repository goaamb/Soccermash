<?php
class CLAS_JS_Cache
{
	var $aJsNames 			= '';
	var $sDestinoCache 	= '';

	function CLAS_JS_Cache(&$aJsNames, $sDestinoCache)
	{
		$this->aJsNames 		= &$aJsNames;
		$this->sDestinoCache = &$sDestinoCache;
		$this->generateCache();
	}#CLAS_JS_Cache()


	function generateCache()
	{
		$aFilePacked = array();

		if (sizeof($this->aJsNames) > 0)
		{
			require('JavaScriptCompressor.class.php');
			$oJavaCompress = new JavaScriptCompressor();

			foreach ($this->aJsNames as $sJS)
			{
				if (file_exists($sJS))
				{
					$aFilePacked[] = array( 'code' => file_get_contents($sJS),
													'name' => basename($sJS)
												  );
				}
			}

			if($fp = fopen($this->sDestinoCache, "w"))
			{
				@flock($fp, LOCK_EX);
				fwrite($fp, ($oJavaCompress->getPacked($aFilePacked)));
				@flock($fp, LOCK_UN);
				fclose($fp);
			}
			else
			{
				return false;
			}
		}
	}#generateCache()

}#CLAS_JS_Cache
?>