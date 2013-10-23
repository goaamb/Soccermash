<?php
//////////////////////////////////////////////////////////////
///  phpThumb() by James Heinrich <info@silisoftware.com>   //
//        available at http://phpthumb.sourceforge.net     ///
//////////////////////////////////////////////////////////////
///                                                         //
// See: phpthumb.readme.txt for usage instructions          //
//                                                         ///
//////////////////////////////////////////////////////////////

ob_start();
if (!include_once(dirname(__FILE__).'/phpthumb.functions.php')) {
	ob_end_flush();
	die('failed to include_once("'.realpath(dirname(__FILE__).'/phpthumb.functions.php').'")');
}
ob_end_clean();

class phpthumb {

	// public:
	// START PARAMETERS (for object mode and phpThumb.php)
	// See phpthumb.readme.txt for descriptions of what each of these values are
	var $src  = null;     // SouRCe filename
	var $new  = null;     // NEW image (phpThumb.php only)
	var $w    = null;     // Width
	var $h    = null;     // Height
	var $wp   = null;     // Width  (Portrait Images Only)
	var $hp   = null;     // Height (Portrait Images Only)
	var $wl   = null;     // Width  (Landscape Images Only)
	var $hl   = null;     // Height (Landscape Images Only)
	var $ws   = null;     // Width  (Square Images Only)
	var $hs   = null;     // Height (Square Images Only)
	var $f    = null;     // output image Format
	var $q    = 75;       // jpeg output Quality
	var $sx   = null;     // Source crop top-left X position
	var $sy   = null;     // Source crop top-left Y position
	var $sw   = null;     // Source crop Width
	var $sh   = null;     // Source crop Height
	var $zc   = null;     // Zoom Crop
	var $bc   = null;     // Border Color
	var $bg   = null;     // BackGround color
	var $fltr = array();  // FiLTeRs
	var $goto = null;     // GO TO url after processing
	var $err  = null;     // default ERRor image filename
	var $xto  = null;     // extract eXif Thumbnail Only
	var $ra   = null;     // Rotate by Angle
	var $ar   = null;     // Auto Rotate
	var $aoe  = null;     // Allow Output Enlargement
	var $far  = null;     // Fixed Aspect Ratio
	var $iar  = null;     // Ignore Aspect Ratio
	var $maxb = null;     // MAXimum Bytes
	var $down = null;     // DOWNload thumbnail filename
	var $md5s = null;     // MD5 hash of Source image
	var $sfn  = 0;        // Source Frame Number
	var $dpi  = 150;      // Dots Per Inch for vector source formats
	var $sia  = null;     // Save Image As filename

	var $file = null;     // >>>deprecated, DO NOT USE, will be removed in future versions<<<

	var $phpThumbDebug = null;
	// END PARAMETERS


	// public:
	// START CONFIGURATION OPTIONS (for object mode only)
	// See phpThumb.config.php for descriptions of what each of these settings do

	// * Directory Configuration
	var $config_cache_directory                      = null;
	var $config_cache_directory_depth                = 0;
	var $config_cache_disable_warning                = true;
	var $config_cache_source_enabled                 = false;
	var $config_cache_source_directory               = null;
	var $config_temp_directory                       = null;
	var $config_document_root                        = null;

	// * Default output configuration:
	var $config_output_format                        = 'jpeg';
	var $config_output_maxwidth                      = 0;
	var $config_output_maxheight                     = 0;
	var $config_output_interlace                     = true;

	// * Error message configuration
	var $config_error_image_width                    = 400;
	var $config_error_image_height                   = 100;
	var $config_error_message_image_default          = '';
	var $config_error_bgcolor                        = 'CCCCFF';
	var $config_error_textcolor                      = 'FF0000';
	var $config_error_fontsize                       = 1;
	var $config_error_die_on_error                   = false;
	var $config_error_silent_die_on_error            = false;
	var $config_error_die_on_source_failure          = true;

	// * Anti-Hotlink Configuration:
	var $config_nohotlink_enabled                    = true;
	var $config_nohotlink_valid_domains              = array();
	var $config_nohotlink_erase_image                = true;
	var $config_nohotlink_text_message               = 'Off-server thumbnailing is not allowed';
	// * Off-server Linking Configuration:
	var $config_nooffsitelink_enabled                = false;
	var $config_nooffsitelink_valid_domains          = array();
	var $config_nooffsitelink_require_refer          = false;
	var $config_nooffsitelink_erase_image            = true;
	var $config_nooffsitelink_watermark_src          = '';
	var $config_nooffsitelink_text_message           = 'Off-server linking is not allowed';

	// * Border & Background default colors
	var $config_border_hexcolor                      = '000000';
	var $config_background_hexcolor                  = 'FFFFFF';

	// * TrueType Fonts
	var $config_ttf_directory                        = './fonts';

	var $config_max_source_pixels                    = null;
	var $config_use_exif_thumbnail_for_speed         = false;
	var $allow_local_http_src                        = false;

	var $config_imagemagick_path                     = null;
	var $config_prefer_imagemagick                   = true;
	var $config_imagemagick_use_thumbnail            = true;

	var $config_cache_maxage                         = null;
	var $config_cache_maxsize                        = null;
	var $config_cache_maxfiles                       = null;
	var $config_cache_source_filemtime_ignore_local  = false;
	var $config_cache_source_filemtime_ignore_remote = true;
	var $config_cache_default_only_suffix            = false;
	var $config_cache_force_passthru                 = true;
	var $config_cache_prefix                         = '';    // default value set in the constructor below

	// * MySQL
	var $config_mysql_query                          = null;
	var $config_mysql_hostname                       = null;
	var $config_mysql_username                       = null;
	var $config_mysql_password                       = null;
	var $config_mysql_database                       = null;

	// * Security
	var $config_high_security_enabled                = false;
	var $config_high_security_password               = null;
	var $config_disable_debug                        = false;
	var $config_allow_src_above_docroot              = false;
	var $config_allow_src_above_phpthumb             = true;
	var $config_allow_parameter_file                 = false;
	var $config_allow_parameter_goto                 = false;

	// * HTTP fopen
	var $config_http_fopen_timeout                   = 10;
	var $config_http_follow_redirect                 = true;

	// * Compatability
	var $config_disable_pathinfo_parsing             = false;
	var $config_disable_imagecopyresampled           = false;
	var $config_disable_onlycreateable_passthru      = false;

	var $config_http_user_agent                      = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7';

	// END CONFIGURATION OPTIONS


	// public: error messages (read-only; persistant)
	var $debugmessages = array();
	var $debugtiming   = array();
	var $fatalerror    = null;


	// private: (should not be modified directly)
	var $thumbnailQuality = 75;
	var $thumbnailFormat  = null;

	var $sourceFilename   = null;
	var $rawImageData     = null;
	var $IMresizedData    = null;
	var $outputImageData  = null;

	var $useRawIMoutput   = false;

	var $gdimg_output     = null;
	var $gdimg_source     = null;

	var $getimagesizeinfo = null;

	var $source_width  = null;
	var $source_height = null;

	var $thumbnailCropX = null;
	var $thumbnailCropY = null;
	var $thumbnailCropW = null;
	var $thumbnailCropH = null;

	var $exif_thumbnail_width  = null;
	var $exif_thumbnail_height = null;
	var $exif_thumbnail_type   = null;
	var $exif_thumbnail_data   = null;
	var $exif_raw_data         = null;

	var $thumbnail_width        = null;
	var $thumbnail_height       = null;
	var $thumbnail_image_width  = null;
	var $thumbnail_image_height = null;

	var $cache_filename         = null;

	var $AlphaCapableFormats = array('png', 'ico', 'gif');
	var $is_alpha = false;

	var $iswindows = null;

	var $phpthumb_version = '1.7.9-200712090829';

	//////////////////////////////////////////////////////////////////////

	// public: constructor
	function phpThumb() {
		$this->DebugTimingMessage('phpThumb() constructor', __FILE__, __LINE__);
		$this->DebugMessage('phpThumb() v'.$this->phpthumb_version, __FILE__, __LINE__);
		$this->config_max_source_pixels = round(max(intval(ini_get('memory_limit')), intval(get_cfg_var('memory_limit'))) * 1048576 * 0.20); // 20% of memory_limit
		$this->iswindows = (bool) (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
		$this->config_document_root = (@$_SERVER['DOCUMENT_ROOT'] ? $_SERVER['DOCUMENT_ROOT'] : $this->config_document_root);
		$this->config_cache_prefix = 'phpThumb_cache_'.@$_SERVER['SERVER_NAME'];

		$php_sapi_name = strtolower(function_exists('php_sapi_name') ? php_sapi_name() : '');
		if ($php_sapi_name == 'cli') {
			$this->config_allow_src_above_docroot = true;
		}
	}

	// public:
	function setSourceFilename($sourceFilename) {
		//$this->resetObject();
		//$this->rawImageData   = null;
		$this->sourceFilename = $sourceFilename;
		$this->src            = $sourceFilename;
		if (is_null($this->config_output_format)) {
			$sourceFileExtension = strtolower(substr(strrchr($sourceFilename, '.'), 1));
			if (ereg('^[a-z]{3,4}$', $sourceFileExtension)) {
				$this->config_output_format = $sourceFileExtension;
				$this->DebugMessage('setSourceFilename('.$sourceFilename.') set $this->config_output_format to "'.$sourceFileExtension.'"', __FILE__, __LINE__);
			} else {
				$this->DebugMessage('setSourceFilename('.$sourceFilename.') did NOT set $this->config_output_format to "'.$sourceFileExtension.'" because it did not seem like an appropriate image format', __FILE__, __LINE__);
			}
		}
		$this->DebugMessage('setSourceFilename('.$sourceFilename.') set $this->sourceFilename to "'.$this->sourceFilename.'"', __FILE__, __LINE__);
		return true;
	}

	// public:
	function setSourceData($rawImageData, $sourceFilename='') {
		//$this->resetObject();
		//$this->sourceFilename = null;
		$this->rawImageData   = $rawImageData;
		$this->DebugMessage('setSourceData() setting $this->rawImageData ('.strlen($this->rawImageData).' bytes; magic="'.substr($this->rawImageData, 0, 4).'" ('.phpthumb_functions::HexCharDisplay(substr($this->rawImageData, 0, 4)).'))', __FILE__, __LINE__);
		if ($this->config_cache_source_enabled) {
			$sourceFilename = ($sourceFilename ? $sourceFilename : md5($rawImageData));
			if (!is_dir($this->config_cache_source_directory)) {
				$this->ErrorImage('$this->config_cache_source_directory ('.$this->config_cache_source_directory.') is not a directory');
			} elseif (!@is_writable($this->config_cache_source_directory)) {
				$this->ErrorImage('$this->config_cache_source_directory ('.$this->config_cache_source_directory.') is not writable');
			}
			$this->DebugMessage('setSourceData() attempting to save source image to "'.$this->config_cache_source_directory.DIRECTORY_SEPARATOR.urlencode($sourceFilename).'"', __FILE__, __LINE__);
			if ($fp = @fopen($this->config_cache_source_directory.DIRECTORY_SEPARATOR.urlencode($sourceFilename), 'wb')) {
				fwrite($fp, $rawImageData);
				fclose($fp);
			} elseif (!$this->phpThumbDebug) {
				$this->ErrorImage('setSourceData() failed to write to source cache ('.$this->config_cache_source_directory.DIRECTORY_SEPARATOR.urlencode($sourceFilename).')');
			}
		}
		return true;
	}

	// public:
	function setSourceImageResource($gdimg) {
		//$this->resetObject();
		$this->gdimg_source = $gdimg;
		return true;
	}

	// public:
	function setParameter($param, $value) {
		if ($param == 'src') {
			$this->setSourceFilename($this->ResolveFilenameToAbsolute($value));
		} elseif (@is_array($this->$param)) {
			if (is_array($value)) {
				foreach ($value as $arraykey => $arrayvalue) {
					array_push($this->$param, $arrayvalue);
				}
			} else {
				array_push($this->$param, $value);
			}
		} else {
			$this->$param = $value;
		}
		return true;
	}

	// public:
	function getParameter($param) {
		//if (property_exists('phpThumb', $param)) {
			return $this->$param;
		//}
		//$this->DebugMessage('setParameter() attempting to get non-existant parameter "'.$param.'"', __FILE__, __LINE__);
		//return false;
	}


	// public:
	function GenerateThumbnail() {

		$this->setOutputFormat();
			$this->phpThumbDebug('8a');
		$this->ResolveSource();
			$this->phpThumbDebug('8b');
		$this->SetCacheFilename();
			$this->phpThumbDebug('8c');
		$this->ExtractEXIFgetImageSize();
			$this->phpThumbDebug('8d');
		if ($this->useRawIMoutput) {
			$this->DebugMessage('Skipping rest of GenerateThumbnail() because ($this->useRawIMoutput == true)', __FILE__, __LINE__);
			return true;
		}
			$this->phpThumbDebug('8e');
		if (!$this->SourceImageToGD()) {
			$this->DebugMessage('SourceImageToGD() failed', __FILE__, __LINE__);
			return false;
		}
			$this->phpThumbDebug('8f');
		$this->Rotate();
			$this->phpThumbDebug('8g');
		$this->CreateGDoutput();
			$this->phpThumbDebug('8h');

		switch ($this->far) {
			case 'L':
			case 'TL':
			case 'BL':
				$destination_offset_x = 0;
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
				break;
			case 'R':
			case 'TR':
			case 'BR':
				$destination_offset_x =  round($this->thumbnail_width  - $this->thumbnail_image_width);
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
				break;
			case 'T':
			case 'TL':
			case 'TR':
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y = 0;
				break;
			case 'B':
			case 'BL':
			case 'BR':
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y =  round($this->thumbnail_height - $this->thumbnail_image_height);
				break;
			case 'C':
			default:
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
		}

//		// copy/resize image to appropriate dimensions
//		$borderThickness = 0;
//		if (!empty($this->fltr)) {
//			foreach ($this->fltr as $key => $value) {
//				if (ereg('^bord\|([0-9]+)', $value, $matches)) {
//					$borderThickness = $matches[1];
//					break;
//				}
//			}
//		}
//		if ($borderThickness > 0) {
//			//$this->DebugMessage('Skipping ImageResizeFunction() because BorderThickness="'.$borderThickness.'"', __FILE__, __LINE__);
//			$this->thumbnail_image_height /= 2;
//		}
		$this->ImageResizeFunction(
			$this->gdimg_output,
			$this->gdimg_source,
			$destination_offset_x,
			$destination_offset_y,
			$this->thumbnailCropX,
			$this->thumbnailCropY,
			$this->thumbnail_image_width,
			$this->thumbnail_image_height,
			$this->thumbnailCropW,
			$this->thumbnailCropH
		);

		$this->DebugMessage('memory_get_usage() after copy-resize = '.(function_exists('memory_get_usage') ? @memory_get_usage() : 'n/a'), __FILE__, __LINE__);
		ImageDestroy($this->gdimg_source);
		$this->DebugMessage('memory_get_usage() after ImageDestroy = '.(function_exists('memory_get_usage') ? @memory_get_usage() : 'n/a'), __FILE__, __LINE__);

			$this->phpThumbDebug('8i');
		$this->AntiOffsiteLinking();
			$this->phpThumbDebug('8j');
		$this->ApplyFilters();
			$this->phpThumbDebug('8k');
		$this->AlphaChannelFlatten();
			$this->phpThumbDebug('8l');
		$this->MaxFileSize();
			$this->phpThumbDebug('8m');

		$this->DebugMessage('GenerateThumbnail() completed successfully', __FILE__, __LINE__);
		return true;
	}


	// public:
	function RenderOutput() {
		if (!$this->useRawIMoutput && !is_resource($this->gdimg_output)) {
			$this->DebugMessage('RenderOutput() failed because !is_resource($this->gdimg_output)', __FILE__, __LINE__);
			return false;
		}
		if (!$this->thumbnailFormat) {
			$this->DebugMessage('RenderOutput() failed because $this->thumbnailFormat is empty', __FILE__, __LINE__);
			return false;
		}
		if ($this->useRawIMoutput) {
			$this->DebugMessage('RenderOutput copying $this->IMresizedData ('.strlen($this->IMresizedData).' bytes) to $this->outputImage', __FILE__, __LINE__);
			$this->outputImageData = $this->IMresizedData;
			return true;
		}

		$builtin_formats = array();
		if (function_exists('ImageTypes')) {
			$imagetypes = ImageTypes();
			$builtin_formats['wbmp'] = (bool) ($imagetypes & IMG_WBMP);
			$builtin_formats['jpg']  = (bool) ($imagetypes & IMG_JPG);
			$builtin_formats['gif']  = (bool) ($imagetypes & IMG_GIF);
			$builtin_formats['png']  = (bool) ($imagetypes & IMG_PNG);
		}
		$this->DebugMessage('RenderOutput() attempting Image'.strtoupper(@$this->thumbnailFormat).'($this->gdimg_output)', __FILE__, __LINE__);
		ob_start();
		switch ($this->thumbnailFormat) {
			case 'wbmp':
				if (!@$builtin_formats['wbmp']) {
					$this->DebugMessage('GD does not have required built-in support for WBMP output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				ImageJPEG($this->gdimg_output, null, $this->thumbnailQuality);
				$this->outputImageData = ob_get_contents();
				break;

			case 'jpeg':
			case 'jpg':  // should be "jpeg" not "jpg" but just in case...
				if (!@$builtin_formats['jpg']) {
					$this->DebugMessage('GD does not have required built-in support for JPEG output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				ImageJPEG($this->gdimg_output, null, $this->thumbnailQuality);
				$this->outputImageData = ob_get_contents();
				break;

			case 'png':
				if (!@$builtin_formats['png']) {
					$this->DebugMessage('GD does not have required built-in support for PNG output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				ImagePNG($this->gdimg_output);
				$this->outputImageData = ob_get_contents();
				break;

			case 'gif':
				if (!@$builtin_formats['gif']) {
					$this->DebugMessage('GD does not have required built-in support for GIF output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				ImageGIF($this->gdimg_output);
				$this->outputImageData = ob_get_contents();
				break;

			case 'bmp':
				$ImageOutFunction = '"builtin BMP output"';
				if (!@include_once(dirname(__FILE__).'/phpthumb.bmp.php')) {
					$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.bmp.php" which is required for BMP format output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				$phpthumb_bmp = new phpthumb_bmp();
				$this->outputImageData = $phpthumb_bmp->GD2BMPstring($this->gdimg_output);
				unset($phpthumb_bmp);
				break;

			case 'ico':
				$ImageOutFunction = '"builtin ICO output"';
				if (!@include_once(dirname(__FILE__).'/phpthumb.ico.php')) {
					$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.ico.php" which is required for ICO format output', __FILE__, __LINE__);
					ob_end_clean();
					return false;
				}
				$phpthumb_ico = new phpthumb_ico();
				$arrayOfOutputImages = array($this->gdimg_output);
				$this->outputImageData = $phpthumb_ico->GD2ICOstring($arrayOfOutputImages);
				unset($phpthumb_ico);
				break;

			default:
				$this->DebugMessage('RenderOutput failed because $this->thumbnailFormat "'.$this->thumbnailFormat.'" is not valid', __FILE__, __LINE__);
				ob_end_clean();
				return false;
		}
		ob_end_clean();
		if (!$this->outputImageData) {
			$this->DebugMessage('RenderOutput() for "'.$this->thumbnailFormat.'" failed', __FILE__, __LINE__);
			ob_end_clean();
			return false;
		}
		$this->DebugMessage('RenderOutput() completing with $this->outputImageData = '.strlen($this->outputImageData).' bytes', __FILE__, __LINE__);
		return true;
	}


	// public:
	function RenderToFile($filename) {
		if (eregi('^(f|ht)tps?\://', $filename)) {
			$this->DebugMessage('RenderToFile() failed because $filename ('.$filename.') is a URL', __FILE__, __LINE__);
			return false;
		}
		// render thumbnail to this file only, do not cache, do not output to browser
		//$renderfilename = $this->ResolveFilenameToAbsolute(dirname($filename)).DIRECTORY_SEPARATOR.basename($filename);
		$renderfilename = $filename;
		if (($filename{0} != '/') && ($filename{0} != '\\') && ($filename{1} != ':')) {
			$renderfilename = $this->ResolveFilenameToAbsolute($renderfilename);
		}
		if (!@is_writable(dirname($renderfilename))) {
			$this->DebugMessage('RenderToFile() failed because "'.dirname($renderfilename).'/" is not writable', __FILE__, __LINE__);
			return false;
		}
		if (@is_file($renderfilename) && !@is_writable($renderfilename)) {
			$this->DebugMessage('RenderToFile() failed because "'.$renderfilename.'" is not writable', __FILE__, __LINE__);
			return false;
		}

		if ($this->RenderOutput()) {
			if (file_put_contents($renderfilename, $this->outputImageData)) {
				$this->DebugMessage('RenderToFile('.$renderfilename.') succeeded', __FILE__, __LINE__);
				return true;
			}
			if (!@file_exists($renderfilename)) {
				$this->DebugMessage('RenderOutput ['.$this->thumbnailFormat.'('.$renderfilename.')] did not appear to fail, but the output image does not exist either...', __FILE__, __LINE__);
			}
		} else {
			$this->DebugMessage('RenderOutput ['.$this->thumbnailFormat.'('.$renderfilename.')] failed', __FILE__, __LINE__);
		}
		return false;
	}


	// public:
	function OutputThumbnail() {
		if (!$this->useRawIMoutput && !is_resource($this->gdimg_output)) {
			$this->DebugMessage('OutputThumbnail() failed because !is_resource($this->gdimg_output)', __FILE__, __LINE__);
			return false;
		}
		if (headers_sent()) {
			return $this->ErrorImage('OutputThumbnail() failed - headers already sent');
			exit;
		}

		$downloadfilename = phpthumb_functions::SanitizeFilename(is_string($this->sia) ? $this->sia : ($this->down ? $this->down : 'phpThumb_generated_thumbnail'.'.'.$this->thumbnailFormat));
		$this->DebugMessage('Content-Disposition header filename set to "'.$downloadfilename.'"', __FILE__, __LINE__);
		if ($downloadfilename) {
			header('Content-Disposition: '.($this->down ? 'attachment' : 'inline').'; filename="'.$downloadfilename.'"');
		} else {
			$this->DebugMessage('failed to send Content-Disposition header because $downloadfilename is empty', __FILE__, __LINE__);
		}

		if ($this->useRawIMoutput) {

			header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
			echo $this->IMresizedData;

		} else {

			$this->DebugMessage('ImageInterlace($this->gdimg_output, '.intval($this->config_output_interlace).')', __FILE__, __LINE__);
			ImageInterlace($this->gdimg_output, intval($this->config_output_interlace));
			switch ($this->thumbnailFormat) {
				case 'jpeg':
					header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
					$ImageOutFunction = 'image'.$this->thumbnailFormat;
					@$ImageOutFunction($this->gdimg_output, '', $this->thumbnailQuality);
					break;

				case 'png':
				case 'gif':
					header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
					$ImageOutFunction = 'image'.$this->thumbnailFormat;
					@$ImageOutFunction($this->gdimg_output);
					break;

				case 'bmp':
					if (!@include_once(dirname(__FILE__).'/phpthumb.bmp.php')) {
						$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.bmp.php" which is required for BMP format output', __FILE__, __LINE__);
						return false;
					}
					$phpthumb_bmp = new phpthumb_bmp();
					if (is_object($phpthumb_bmp)) {
						$bmp_data = $phpthumb_bmp->GD2BMPstring($this->gdimg_output);
						unset($phpthumb_bmp);
						if (!$bmp_data) {
							$this->DebugMessage('$phpthumb_bmp->GD2BMPstring() failed', __FILE__, __LINE__);
							return false;
						}
						header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
						echo $bmp_data;
					} else {
						$this->DebugMessage('new phpthumb_bmp() failed', __FILE__, __LINE__);
						return false;
					}
					break;

				case 'ico':
					if (!@include_once(dirname(__FILE__).'/phpthumb.ico.php')) {
						$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.ico.php" which is required for ICO format output', __FILE__, __LINE__);
						return false;
					}
					$phpthumb_ico = new phpthumb_ico();
					if (is_object($phpthumb_ico)) {
						$arrayOfOutputImages = array($this->gdimg_output);
						$ico_data = $phpthumb_ico->GD2ICOstring($arrayOfOutputImages);
						unset($phpthumb_ico);
						if (!$ico_data) {
							$this->DebugMessage('$phpthumb_ico->GD2ICOstring() failed', __FILE__, __LINE__);
							return false;
						}
						header('Content-Type: '.phpthumb_functions::ImageTypeToMIMEtype($this->thumbnailFormat));
						echo $ico_data;
					} else {
						$this->DebugMessage('new phpthumb_ico() failed', __FILE__, __LINE__);
						return false;
					}
					break;

				default:
					$this->DebugMessage('OutputThumbnail failed because $this->thumbnailFormat "'.$this->thumbnailFormat.'" is not valid', __FILE__, __LINE__);
					return false;
					break;
			}

		}
		return true;
	}


	// public:
	function CleanUpCacheDirectory() {
		$this->DebugMessage('skipping CleanUpCacheDirectory() set to purge ('.number_format($this->config_cache_maxage / 86400, 1).' days; '.number_format($this->config_cache_maxsize / 1048576, 2).'MB; '.number_format($this->config_cache_maxfiles).' files)', __FILE__, __LINE__);
		$DeletedKeys = array();
		$AllFilesInCacheDirectory = array();
		if (($this->config_cache_maxage > 0) || ($this->config_cache_maxsize > 0) || ($this->config_cache_maxfiles > 0)) {
			$CacheDirOldFilesAge  = array();
			$CacheDirOldFilesSize = array();
			$AllFilesInCacheDirectory = phpthumb_functions::GetAllFilesInSubfolders($this->config_cache_directory);
			foreach ($AllFilesInCacheDirectory as $fullfilename) {
				if (eregi('^phpThumb_cache_', basename($fullfilename)) && file_exists($fullfilename)) {
					$CacheDirOldFilesAge[$fullfilename] = @fileatime($fullfilename);
					if ($CacheDirOldFilesAge[$fullfilename] == 0) {
						$CacheDirOldFilesAge[$fullfilename] = @filemtime($fullfilename);
					}
					$CacheDirOldFilesSize[$fullfilename] = @filesize($fullfilename);
				}
			}
			if (empty($CacheDirOldFilesSize)) {
				return true;
			}
			$DeletedKeys['zerobyte'] = array();
			foreach ($CacheDirOldFilesSize as $fullfilename => $filesize) {
				// purge all zero-size files more than an hour old (to prevent trying to delete just-created and/or in-use files)
				$cutofftime = time() - 3600;
				if (($filesize == 0) && ($CacheDirOldFilesAge[$fullfilename] < $cutofftime)) {
					if (@unlink($fullfilename)) {
						$DeletedKeys['zerobyte'][] = $fullfilename;
						unset($CacheDirOldFilesSize[$fullfilename]);
						unset($CacheDirOldFilesAge[$fullfilename]);
					}
				}
			}
			$this->DebugMessage('CleanUpCacheDirectory() purged '.count($DeletedKeys['zerobyte']).' zero-byte files', __FILE__, __LINE__);
			asort($CacheDirOldFilesAge);

			if ($this->config_cache_maxfiles > 0) {
				$TotalCachedFiles = count($CacheDirOldFilesAge);
				$DeletedKeys['maxfiles'] = array();
				foreach ($CacheDirOldFilesAge as $fullfilename => $filedate) {
					if ($TotalCachedFiles > $this->config_cache_maxfiles) {
						if (@unlink($fullfilename)) {
							$TotalCachedFiles--;
							$DeletedKeys['maxfiles'][] = $fullfilename;
						}
					} else {
						// there are few enough files to keep the rest
						break;
					}
				}
				$this->DebugMessage('CleanUpCacheDirectory() purged '.count($DeletedKeys['maxfiles']).' files based on (config_cache_maxfiles='.$this->config_cache_maxfiles.')', __FILE__, __LINE__);
				foreach ($DeletedKeys['maxfiles'] as $fullfilename) {
					unset($CacheDirOldFilesAge[$fullfilename]);
					unset($CacheDirOldFilesSize[$fullfilename]);
				}
			}

			if ($this->config_cache_maxage > 0) {
				$mindate = time() - $this->config_cache_maxage;
				$DeletedKeys['maxage'] = array();
				foreach ($CacheDirOldFilesAge as $fullfilename => $filedate) {
					if ($filedate > 0) {
						if ($filedate < $mindate) {
							if (@unlink($fullfilename)) {
								$DeletedKeys['maxage'][] = $fullfilename;
							}
						} else {
							// the rest of the files are new enough to keep
							break;
						}
					}
				}
				$this->DebugMessage('CleanUpCacheDirectory() purged '.count($DeletedKeys['maxage']).' files based on (config_cache_maxage='.$this->config_cache_maxage.')', __FILE__, __LINE__);
				foreach ($DeletedKeys['maxage'] as $fullfilename) {
					unset($CacheDirOldFilesAge[$fullfilename]);
					unset($CacheDirOldFilesSize[$fullfilename]);
				}
			}

			if ($this->config_cache_maxsize > 0) {
				$TotalCachedFileSize = array_sum($CacheDirOldFilesSize);
				$DeletedKeys['maxsize'] = array();
				foreach ($CacheDirOldFilesAge as $fullfilename => $filedate) {
					if ($TotalCachedFileSize > $this->config_cache_maxsize) {
						if (@unlink($fullfilename)) {
							$TotalCachedFileSize -= $CacheDirOldFilesSize[$fullfilename];
							$DeletedKeys['maxsize'][] = $fullfilename;
						}
					} else {
						// the total filesizes are small enough to keep the rest of the files
						break;
					}
				}
				$this->DebugMessage('CleanUpCacheDirectory() purged '.count($DeletedKeys['maxsize']).' files based on (config_cache_maxsize='.$this->config_cache_maxsize.')', __FILE__, __LINE__);
				foreach ($DeletedKeys['maxsize'] as $fullfilename) {
					unset($CacheDirOldFilesAge[$fullfilename]);
					unset($CacheDirOldFilesSize[$fullfilename]);
				}
			}

		} else {
			$this->DebugMessage('skipping CleanUpCacheDirectory() because config set to not use it', __FILE__, __LINE__);
		}
		$totalpurged = 0;
		foreach ($DeletedKeys as $key => $value) {
			$totalpurged += count($value);
		}
		$this->DebugMessage('CleanUpCacheDirectory() purged '.$totalpurged.' files (from '.count($AllFilesInCacheDirectory).') based on config settings', __FILE__, __LINE__);
		if ($totalpurged > 0) {
			$empty_dirs = array();
			foreach ($AllFilesInCacheDirectory as $fullfilename) {
				if (is_dir($fullfilename)) {
					$empty_dirs[realpath($fullfilename)] = 1;
				} else {
					unset($empty_dirs[realpath(dirname($fullfilename))]);
				}
			}
			krsort($empty_dirs);
			$totalpurgeddirs = 0;
			foreach ($empty_dirs as $empty_dir => $dummy) {
				if ($empty_dir == $this->config_cache_directory) {
					// shouldn't happen, but just in case, don't let it delete actual cache directory
					continue;
				} elseif (@rmdir($empty_dir)) {
					$totalpurgeddirs++;
				} else {
					$this->DebugMessage('failed to rmdir('.$empty_dir.')', __FILE__, __LINE__);
				}
			}
			$this->DebugMessage('purged '.$totalpurgeddirs.' empty directories', __FILE__, __LINE__);
		}
		return true;
	}

	//////////////////////////////////////////////////////////////////////

	// private: re-initializator (call between rendering multiple images with one object)
	function resetObject() {
		$class_vars = get_class_vars(get_class($this));
		foreach ($class_vars as $key => $value) {
			// do not clobber debug or config info
			if (!eregi('^(config_|debug|fatalerror)', $key)) {
				$this->$key = $value;
			}
		}
		$this->phpThumb(); // re-initialize some class variables
		return true;
	}

	//////////////////////////////////////////////////////////////////////

	function ResolveSource() {
		if (is_resource($this->gdimg_source)) {
			$this->DebugMessage('ResolveSource() exiting because is_resource($this->gdimg_source)', __FILE__, __LINE__);
			return true;
		}
		if ($this->rawImageData) {
			$this->sourceFilename = null;
			$this->DebugMessage('ResolveSource() exiting because $this->rawImageData is set ('.number_format(strlen($this->rawImageData)).' bytes)', __FILE__, __LINE__);
			return true;
		}
		if ($this->sourceFilename) {
			$this->sourceFilename = $this->ResolveFilenameToAbsolute($this->sourceFilename);
			$this->DebugMessage('$this->sourceFilename set to "'.$this->sourceFilename.'"', __FILE__, __LINE__);
		} elseif ($this->src) {
			$this->sourceFilename = $this->ResolveFilenameToAbsolute($this->src);
			$this->DebugMessage('$this->sourceFilename set to "'.$this->sourceFilename.'" from $this->src ('.$this->src.')', __FILE__, __LINE__);
		} else {
			return $this->ErrorImage('$this->sourceFilename and $this->src are both empty');
		}
		if ($this->iswindows && ((substr($this->sourceFilename, 0, 2) == '//') || (substr($this->sourceFilename, 0, 2) == '\\\\'))) {
			// Windows \\share\filename.ext
		} elseif (eregi('^(f|ht)tps?\://', $this->sourceFilename)) {
			// URL
			if ($this->config_http_user_agent) {
				ini_set('user_agent', $this->config_http_user_agent);
			}
		} elseif (!@file_exists($this->sourceFilename)) {
			return $this->ErrorImage('"'.$this->sourceFilename.'" does not exist');
		} elseif (!@is_file($this->sourceFilename)) {
			return $this->ErrorImage('"'.$this->sourceFilename.'" is not a file');
		}
		return true;
	}

	function setOutputFormat() {
		static $alreadyCalled = false;
		if ($this->thumbnailFormat && $alreadyCalled) {
			return true;
		}
		$alreadyCalled = true;

		$AvailableImageOutputFormats = array();
		$AvailableImageOutputFormats[] = 'text';
		if (@is_readable(dirname(__FILE__).'/phpthumb.ico.php')) {
			$AvailableImageOutputFormats[] = 'ico';
		}
		if (@is_readable(dirname(__FILE__).'/phpthumb.bmp.php')) {
			$AvailableImageOutputFormats[] = 'bmp';
		}

		$this->thumbnailFormat = 'ico';

		// Set default output format based on what image types are available
		if (function_exists('ImageTypes')) {
			$imagetypes = ImageTypes();
			if ($imagetypes & IMG_WBMP) {
				$this->thumbnailFormat         = 'wbmp';
				$AvailableImageOutputFormats[] = 'wbmp';
			}
			if ($imagetypes & IMG_GIF) {
				$this->thumbnailFormat         = 'gif';
				$AvailableImageOutputFormats[] = 'gif';
			}
			if ($imagetypes & IMG_PNG) {
				$this->thumbnailFormat         = 'png';
				$AvailableImageOutputFormats[] = 'png';
			}
			if ($imagetypes & IMG_JPG) {
				$this->thumbnailFormat         = 'jpeg';
				$AvailableImageOutputFormats[] = 'jpeg';
			}
		} else {
			//return $this->ErrorImage('ImageTypes() does not exist - GD support might not be enabled?');
			$this->DebugMessage('ImageTypes() does not exist - GD support might not be enabled?',  __FILE__, __LINE__);
		}
		if ($this->ImageMagickVersion()) {
			$IMformats = array('jpeg', 'png', 'gif', 'bmp', 'ico', 'wbmp');
			$this->DebugMessage('Addding ImageMagick formats to $AvailableImageOutputFormats ('.implode(';', $AvailableImageOutputFormats).')', __FILE__, __LINE__);
			foreach ($IMformats as $key => $format) {
				$AvailableImageOutputFormats[] = $format;
			}
		}
		$AvailableImageOutputFormats = array_unique($AvailableImageOutputFormats);
		$this->DebugMessage('$AvailableImageOutputFormats = array('.implode(';', $AvailableImageOutputFormats).')', __FILE__, __LINE__);

		$this->f = ereg_replace('[^a-z]', '', strtolower($this->f));
		if (strtolower($this->config_output_format) == 'jpg') {
			$this->config_output_format = 'jpeg';
		}
		if (strtolower($this->f) == 'jpg') {
			$this->f = 'jpeg';
		}
		if (phpthumb_functions::CaseInsensitiveInArray($this->config_output_format, $AvailableImageOutputFormats)) {
			// set output format to config default if that format is available
			$this->DebugMessage('$this->thumbnailFormat set to $this->config_output_format "'.strtolower($this->config_output_format).'"', __FILE__, __LINE__);
			$this->thumbnailFormat = strtolower($this->config_output_format);
		} elseif ($this->config_output_format) {
			$this->DebugMessage('$this->thumbnailFormat staying as "'.$this->thumbnailFormat.'" because $this->config_output_format ('.strtolower($this->config_output_format).') is not in $AvailableImageOutputFormats', __FILE__, __LINE__);
		}
		if ($this->f && (phpthumb_functions::CaseInsensitiveInArray($this->f, $AvailableImageOutputFormats))) {
			// override output format if $this->f is set and that format is available
			$this->DebugMessage('$this->thumbnailFormat set to $this->f "'.strtolower($this->f).'"', __FILE__, __LINE__);
			$this->thumbnailFormat = strtolower($this->f);
		} elseif ($this->f) {
			$this->DebugMessage('$this->thumbnailFormat staying as "'.$this->thumbnailFormat.'" because $this->f ('.strtolower($this->f).') is not in $AvailableImageOutputFormats', __FILE__, __LINE__);
		}

		// for JPEG images, quality 1 (worst) to 99 (best)
		// quality < 25 is nasty, with not much size savings - not recommended
		// problems with 100 - invalid JPEG?
		$this->thumbnailQuality = max(1, min(99, ($this->q ? $this->q : 75)));
		$this->DebugMessage('$this->thumbnailQuality set to "'.$this->thumbnailQuality.'"', __FILE__, __LINE__);

		return true;
	}

	function setCacheDirectory() {
		// resolve cache directory to absolute pathname
		$this->DebugMessage('setCacheDirectory() starting with config_cache_directory = "'.$this->config_cache_directory.'"', __FILE__, __LINE__);
		if (substr($this->config_cache_directory, 0, 1) == '.') {
			if (eregi('^(f|ht)tps?\://', $this->src)) {
				if (!$this->config_cache_disable_warning) {
					$this->ErrorImage('$this->config_cache_directory ('.$this->config_cache_directory.') cannot be used for remote images. Adjust "cache_directory" or "cache_disable_warning" in phpThumb.config.php');
				}
			} elseif ($this->src) {
				// resolve relative cache directory to source image
				$this->config_cache_directory = dirname($this->ResolveFilenameToAbsolute($this->src)).DIRECTORY_SEPARATOR.$this->config_cache_directory;
			} else {
				// $this->new is probably set
			}
		}
		if (substr($this->config_cache_directory, -1) == '/') {
			$this->config_cache_directory = substr($this->config_cache_directory, 0, -1);
		}
		if ($this->iswindows) {
			$this->config_cache_directory = str_replace('/', DIRECTORY_SEPARATOR, $this->config_cache_directory);
		}
		if ($this->config_cache_directory) {
			$real_cache_path = realpath($this->config_cache_directory);
			if (!$real_cache_path) {
				$this->DebugMessage('realpath($this->config_cache_directory) failed for "'.$this->config_cache_directory.'"', __FILE__, __LINE__);
				if (!is_dir($this->config_cache_directory)) {
					$this->DebugMessage('!is_dir('.$this->config_cache_directory.')', __FILE__, __LINE__);
				}
			}
			if ($real_cache_path) {
				$this->DebugMessage('setting config_cache_directory to realpath('.$this->config_cache_directory.') = "'.$real_cache_path.'"', __FILE__, __LINE__);
				$this->config_cache_directory = $real_cache_path;
			}
		}
		if (!is_dir($this->config_cache_directory)) {
			if (!$this->config_cache_disable_warning) {
				$this->ErrorImage('$this->config_cache_directory ('.$this->config_cache_directory.') does not exist. Adjust "cache_directory" or "cache_disable_warning" in phpThumb.config.php');
			}
			$this->DebugMessage('$this->config_cache_directory ('.$this->config_cache_directory.') is not a directory', __FILE__, __LINE__);
			$this->config_cache_directory = null;
		} elseif (!@is_writable($this->config_cache_directory)) {
			$this->DebugMessage('$this->config_cache_directory is not writable ('.$this->config_cache_directory.')', __FILE__, __LINE__);
		}

		$this->InitializeTempDirSetting();
		if (!@is_dir($this->config_temp_directory) && !@is_writable($this->config_temp_directory) && @is_dir($this->config_cache_directory) && @is_writable($this->config_cache_directory)) {
			$this->DebugMessage('setting $this->config_temp_directory = $this->config_cache_directory ('.$this->config_cache_directory.')', __FILE__, __LINE__);
			$this->config_temp_directory = $this->config_cache_directory;
		}
		return true;
	}


	function ResolveFilenameToAbsolute($filename) {
		if (!$filename) {
			return false;
		}

		//if (eregi('^(f|ht)tps?\://', $filename)) {
		if (eregi('^[a-z0-9]+\:/{1,2}', $filename)) {
			// eg: http://host/path/file.jpg (HTTP URL)
			// eg: ftp://host/path/file.jpg  (FTP URL)
			// eg: data1:/path/file.jpg      (Netware path)

			//$AbsoluteFilename = $filename;
			return $filename;

		} elseif ($this->iswindows && ($filename{1} == ':')) {

			// absolute pathname (Windows)
			$AbsoluteFilename = $filename;

		} elseif ($this->iswindows && ((substr($filename, 0, 2) == '//') || (substr($filename, 0, 2) == '\\\\'))) {

			// absolute pathname (Windows)
			$AbsoluteFilename = $filename;

		} elseif ($filename{0} == '/') {

			if (@is_readable($filename) && !@is_readable($this->config_document_root.$filename)) {

				// absolute filename (*nix)
				$AbsoluteFilename = $filename;

			} elseif ($filename{1} == '~') {

				// /~user/path
				if ($ApacheLookupURIarray = phpthumb_functions::ApacheLookupURIarray($filename)) {
					$AbsoluteFilename = $ApacheLookupURIarray['filename'];
				} else {
					$AbsoluteFilename = realpath($filename);
					if (@is_readable($AbsoluteFilename)) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.$filename.'", but the correct filename ('.$AbsoluteFilename.') seems to have been resolved with realpath($filename)', __FILE__, __LINE__);
					} elseif (is_dir(dirname($AbsoluteFilename))) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname($filename).'", but the correct directory ('.dirname($AbsoluteFilename).') seems to have been resolved with realpath(.)', __FILE__, __LINE__);
					} else {
						return $this->ErrorImage('phpthumb_functions::ApacheLookupURIarray() failed for "'.$filename.'". This has been known to fail on Apache2 - try using the absolute filename for the source image (ex: "/home/user/httpdocs/image.jpg" instead of "/~user/image.jpg")');
					}
				}

			} else {

				// relative filename (any OS)
				if (ereg('^'.preg_quote($this->config_document_root), $filename)) {
					$AbsoluteFilename = $filename;
					$this->DebugMessage('ResolveFilenameToAbsolute() NOT prepending $this->config_document_root ('.$this->config_document_root.') to $filename ('.$filename.') resulting in ($AbsoluteFilename = "'.$AbsoluteFilename.'")', __FILE__, __LINE__);
				} else {
					$AbsoluteFilename = $this->config_document_root.$filename;
					$this->DebugMessage('ResolveFilenameToAbsolute() prepending $this->config_document_root ('.$this->config_document_root.') to $filename ('.$filename.') resulting in ($AbsoluteFilename = "'.$AbsoluteFilename.'")', __FILE__, __LINE__);
				}

			}

		} else {

			// relative to current directory (any OS)
			$AbsoluteFilename = $this->config_document_root.dirname(@$_SERVER['PHP_SELF']).DIRECTORY_SEPARATOR.$filename;
			//if (!@file_exists($AbsoluteFilename) && @file_exists(realpath($this->DotPadRelativeDirectoryPath($filename)))) {
			//	$AbsoluteFilename = realpath($this->DotPadRelativeDirectoryPath($filename));
			//}

			if (substr(dirname(@$_SERVER['PHP_SELF']), 0, 2) == '/~') {
				if ($ApacheLookupURIarray = phpthumb_functions::ApacheLookupURIarray(dirname(@$_SERVER['PHP_SELF']))) {
					$AbsoluteFilename = $ApacheLookupURIarray['filename'].DIRECTORY_SEPARATOR.$filename;
				} else {
					$AbsoluteFilename = realpath('.').DIRECTORY_SEPARATOR.$filename;
					if (@is_readable($AbsoluteFilename)) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname(@$_SERVER['PHP_SELF']).'", but the correct filename ('.$AbsoluteFilename.') seems to have been resolved with realpath(.)/$filename', __FILE__, __LINE__);
					} elseif (is_dir(dirname($AbsoluteFilename))) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname(@$_SERVER['PHP_SELF']).'", but the correct directory ('.dirname($AbsoluteFilename).') seems to have been resolved with realpath(.)', __FILE__, __LINE__);
					} else {
						return $this->ErrorImage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname(@$_SERVER['PHP_SELF']).'". This has been known to fail on Apache2 - try using the absolute filename for the source image');
					}
				}
			}

		}
		if (is_link($AbsoluteFilename)) {
			$this->DebugMessage('is_link()==true, changing "'.$AbsoluteFilename.'" to "'.readlink($AbsoluteFilename).'"', __FILE__, __LINE__);
			$AbsoluteFilename = readlink($AbsoluteFilename);
		}
		if (realpath($AbsoluteFilename)) {
			$AbsoluteFilename = realpath($AbsoluteFilename);
		}
		if ($this->iswindows) {
			$AbsoluteFilename = eregi_replace('^'.preg_quote(realpath($this->config_document_root)), realpath($this->config_document_root), $AbsoluteFilename);
			$AbsoluteFilename = str_replace(DIRECTORY_SEPARATOR, '/', $AbsoluteFilename);
		}
		if (!$this->config_allow_src_above_docroot && !ereg('^'.preg_quote(str_replace(DIRECTORY_SEPARATOR, '/', realpath($this->config_document_root))), $AbsoluteFilename)) {
			$this->DebugMessage('!$this->config_allow_src_above_docroot therefore setting "'.$AbsoluteFilename.'" (outside "'.realpath($this->config_document_root).'") to null', __FILE__, __LINE__);
			return false;
		}
		if (!$this->config_allow_src_above_phpthumb && !ereg('^'.preg_quote(str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__))), $AbsoluteFilename)) {
			$this->DebugMessage('!$this->config_allow_src_above_phpthumb therefore setting "'.$AbsoluteFilename.'" (outside "'.dirname(__FILE__).'") to null', __FILE__, __LINE__);
			return false;
		}
		return $AbsoluteFilename;
	}

	function ImageMagickWhichConvert() {
		static $WhichConvert = null;
		if (is_null($WhichConvert)) {
			if ($this->iswindows) {
				$WhichConvert = false;
			} else {
				$WhichConvert = trim(phpthumb_functions::SafeExec('which convert'));
			}
		}
		return $WhichConvert;
	}

	function ImageMagickCommandlineBase() {
		static $commandline = null;
		if (is_null($commandline)) {
			$commandline = (!is_null($this->config_imagemagick_path) ? $this->config_imagemagick_path : '');

			if ($this->config_imagemagick_path && ($this->config_imagemagick_path != realpath($this->config_imagemagick_path))) {
				if (@is_executable(realpath($this->config_imagemagick_path))) {
					$this->DebugMessage('Changing $this->config_imagemagick_path ('.$this->config_imagemagick_path.') to realpath($this->config_imagemagick_path) ('.realpath($this->config_imagemagick_path).')', __FILE__, __LINE__);
					$this->config_imagemagick_path = realpath($this->config_imagemagick_path);
				} else {
					$this->DebugMessage('Leaving $this->config_imagemagick_path as ('.$this->config_imagemagick_path.') because !is_execuatable(realpath($this->config_imagemagick_path)) ('.realpath($this->config_imagemagick_path).')', __FILE__, __LINE__);
				}
			}
			$this->DebugMessage('  file_exists('.$this->config_imagemagick_path.') = '.intval(  @file_exists($this->config_imagemagick_path)), __FILE__, __LINE__);
			$this->DebugMessage('is_executable('.$this->config_imagemagick_path.') = '.intval(@is_executable($this->config_imagemagick_path)), __FILE__, __LINE__);
			if (@file_exists($this->config_imagemagick_path)) {
				$this->DebugMessage('using ImageMagick path from $this->config_imagemagick_path ('.$this->config_imagemagick_path.')', __FILE__, __LINE__);
				if ($this->iswindows) {
					$commandline = substr($this->config_imagemagick_path, 0, 2).' && cd "'.str_replace('/', DIRECTORY_SEPARATOR, substr(dirname($this->config_imagemagick_path), 2)).'" && '.basename($this->config_imagemagick_path);
				} else {
					$commandline = '"'.$this->config_imagemagick_path.'"';
				}
				return $commandline;
			}

			$which_convert = $this->ImageMagickWhichConvert();
			$IMversion     = $this->ImageMagickVersion();

			if ($which_convert && ($which_convert{0} == '/') && @file_exists($which_convert)) {

				// `which convert` *should* return the path if "convert" exist, or nothing if it doesn't
				// other things *may* get returned, like "sh: convert: not found" or "no convert in /usr/local/bin /usr/sbin /usr/bin /usr/ccs/bin"
				// so only do this if the value returned exists as a file
				$this->DebugMessage('using ImageMagick path from `which convert` ('.$which_convert.')', __FILE__, __LINE__);
				$commandline = 'convert';

			} elseif ($IMversion) {

				$this->DebugMessage('setting ImageMagick path to $this->config_imagemagick_path ('.$this->config_imagemagick_path.') ['.$IMversion.']', __FILE__, __LINE__);
				$commandline = $this->config_imagemagick_path;

			} else {

				$this->DebugMessage('ImageMagickThumbnailToGD() aborting because cannot find convert in $this->config_imagemagick_path ('.$this->config_imagemagick_path.'), and `which convert` returned ('.$which_convert.')', __FILE__, __LINE__);
				$commandline = '';

			}
		}
		return $commandline;
	}

	function ImageMagickVersion($returnRAW=false) {
		static $versionstring = null;
		if (is_null($versionstring)) {
			$commandline = $this->ImageMagickCommandlineBase();
			$commandline = (!is_null($commandline) ? $commandline : '');

			$versionstring = array(0=>'', 1=>'');
			if ($commandline) {
				$commandline .= ' --version';
				$this->DebugMessage('ImageMagick version checked with "'.$commandline.'"', __FILE__, __LINE__);
				$versionstring[1] = trim(phpthumb_functions::SafeExec($commandline));
				if (eregi('^Version: [^0-9]*([ 0-9\\.\\:Q/]+) (http|file)\:', $versionstring[1], $matches)) {
					$versionstring[0] = $matches[1];
				} else {
					$versionstring[0] = false;
					$this->DebugMessage('ImageMagick did not return recognized version string ('.$versionstring[1].')', __FILE__, __LINE__);
				}
				$this->DebugMessage('ImageMagick convert --version says "'.$matches[0].'"', __FILE__, __LINE__);
			}
		}
		return @$versionstring[intval($returnRAW)];
	}

	function ImageMagickSwitchAvailable($switchname) {
		static $IMoptions = null;
		if (is_null($IMoptions)) {
			$IMoptions = array();
			$commandline = $this->ImageMagickCommandlineBase();
			if (!is_null($commandline)) {
				$commandline .= ' -help';
				$IMhelp_lines = explode("\n", phpthumb_functions::SafeExec($commandline));
				foreach ($IMhelp_lines as $line) {
					if (ereg('^[\+\-]([a-z\-]+) ', trim($line), $matches)) {
						$IMoptions[$matches[1]] = true;
					}
				}
			}
		}
		if (is_array($switchname)) {
			$allOK = true;
			foreach ($switchname as $key => $value) {
				if (!isset($IMoptions[$value])) {
					$allOK = false;
					break;
				}
			}
			$this->DebugMessage('ImageMagickSwitchAvailable('.implode(';', $switchname).') = '.intval($allOK).'', __FILE__, __LINE__);
		} else {
			$allOK = isset($IMoptions[$switchname]);
			$this->DebugMessage('ImageMagickSwitchAvailable('.$switchname.') = '.intval($allOK).'', __FILE__, __LINE__);
		}
		return $allOK;
	}

	function ImageMagickFormatsList() {
		static $IMformatsList = null;
		if (is_null($IMformatsList)) {
			$IMformatsList = '';
			$commandline = $this->ImageMagickCommandlineBase();
			if (!is_null($commandline)) {
				$commandline = dirname($commandline).DIRECTORY_SEPARATOR.str_replace('convert', 'identify', basename($commandline));
				$commandline .= ' -list format';
				$IMformatsList = phpthumb_functions::SafeExec($commandline);
			}
		}
		return $IMformatsList;
	}

	function ImageMagickThumbnailToGD() {
		// http://www.imagemagick.org/script/command-line-options.php

		if (ini_get('safe_mode')) {
			$this->DebugMessage('ImageMagickThumbnailToGD() aborting because safe_mode is enabled', __FILE__, __LINE__);
			$this->useRawIMoutput = false;
			return false;
		}
		$this->useRawIMoutput = true;
		if (phpthumb_functions::gd_version()) {
			// if GD is not available, must use whatever ImageMagick can output

			// $UnAllowedParameters contains options that can only be processed in GD, not ImageMagick
			// note: 'fltr' *may* need to be processed by GD, but we'll check that in more detail below
			$UnAllowedParameters = array('xto', 'ar', 'bg', 'bc');
			// 'ra' may be part of this list, if not a multiple of 90°
			foreach ($UnAllowedParameters as $parameter) {
				if (isset($this->$parameter)) {
					$this->DebugMessage('$this->useRawIMoutput=false because "'.$parameter.'" is set', __FILE__, __LINE__);
					$this->useRawIMoutput = false;
					break;
				}
			}
		}
		$this->DebugMessage('$this->useRawIMoutput='.($this->useRawIMoutput ? 'true' : 'false').' after checking $UnAllowedParameters', __FILE__, __LINE__);
		$outputFormat = $this->thumbnailFormat;
		if (phpthumb_functions::gd_version()) {
			if ($this->useRawIMoutput) {
				switch ($this->thumbnailFormat) {
					case 'gif':
						$ImageCreateFunction = 'ImageCreateFromGIF';
						$this->is_alpha = true;
						break;
					case 'png':
						$ImageCreateFunction = 'ImageCreateFromPNG';
						$this->is_alpha = true;
						break;
					case 'jpg':
					case 'jpeg':
						$ImageCreateFunction = 'ImageCreateFromJPEG';
						break;
					default:
						$this->DebugMessage('Forcing output to PNG because $this->thumbnailFormat ('.$this->thumbnailFormat.' is not a GD-supported format)', __FILE__, __LINE__);
						$outputFormat = 'png';
						$ImageCreateFunction = 'ImageCreateFromPNG';
						$this->is_alpha = true;
						$this->useRawIMoutput = false;
						break;
				}
				if (!function_exists(@$ImageCreateFunction)) {
					// ImageMagickThumbnailToGD() depends on ImageCreateFromPNG/ImageCreateFromGIF
					//$this->DebugMessage('ImageMagickThumbnailToGD() aborting because '.@$ImageCreateFunction.'() is not available', __FILE__, __LINE__);
					$this->useRawIMoutput = true;
					//return false;
				}
			} else {
				$outputFormat = 'png';
				$ImageCreateFunction = 'ImageCreateFromPNG';
				$this->is_alpha = true;
				$this->useRawIMoutput = false;
			}
		}

		if (!$this->sourceFilename && $this->rawImageData) {
			if ($IMtempSourceFilename = $this->phpThumb_tempnam()) {
				$IMtempSourceFilename = realpath($IMtempSourceFilename);
				$this->sourceFilename = $IMtempSourceFilename;
				$this->DebugMessage('ImageMagickThumbnailToGD() setting $this->sourceFilename to "'.$IMtempSourceFilename.'" from $this->rawImageData ('.strlen($this->rawImageData).' bytes)', __FILE__, __LINE__);
			}
		}
		if (!$this->sourceFilename) {
			$this->DebugMessage('ImageMagickThumbnailToGD() aborting because $this->sourceFilename is empty', __FILE__, __LINE__);
			$this->useRawIMoutput = false;
			return false;
		}

		$commandline = $this->ImageMagickCommandlineBase();
		if ($commandline) {
			if ($IMtempfilename = $this->phpThumb_tempnam()) {
				$IMtempfilename = realpath($IMtempfilename);

				$IMuseExplicitImageOutputDimensions = false;
				if ($this->ImageMagickSwitchAvailable('thumbnail') && $this->config_imagemagick_use_thumbnail) {
					$IMresizeParameter = 'thumbnail';
				} else {
					$IMresizeParameter = 'resize';

					// some (older? around 2002) versions of IM won't accept "-resize 100x" but require "-resize 100x100"
					$commandline_test = $this->ImageMagickCommandlineBase().' logo: -resize 1x "'.$IMtempfilename.'" 2>&1';
					$IMresult_test = phpthumb_functions::SafeExec($commandline_test);
					$IMuseExplicitImageOutputDimensions = eregi('image dimensions are zero', $IMresult_test);
					$this->DebugMessage('IMuseExplicitImageOutputDimensions = '.intval($IMuseExplicitImageOutputDimensions), __FILE__, __LINE__);
					if ($fp_im_temp = @fopen($IMtempfilename, 'wb')) {
						// erase temp image so ImageMagick logo doesn't get output if other processing fails
						fclose($fp_im_temp);
					}
				}


				if (!is_null($this->dpi) && $this->ImageMagickSwitchAvailable('density')) {
					// for raster source formats only (WMF, PDF, etc)
					$commandline .= ' -density '.$this->dpi;
				}
				ob_start();
				$getimagesize = GetImageSize($this->sourceFilename);
				$GetImageSizeError = ob_get_contents();
				ob_end_clean();
				if (is_array($getimagesize)) {
					$this->DebugMessage('GetImageSize('.$this->sourceFilename.') SUCCEEDED: '.serialize($getimagesize), __FILE__, __LINE__);
				} else {
					$this->DebugMessage('GetImageSize('.$this->sourceFilename.') FAILED with error "'.$GetImageSizeError.'"', __FILE__, __LINE__);
				}
				if (is_array($getimagesize)) {
					$this->DebugMessage('GetImageSize('.$this->sourceFilename.') returned [w='.$getimagesize[0].';h='.$getimagesize[1].';f='.$getimagesize[2].']', __FILE__, __LINE__);
					$this->source_width  = $getimagesize[0];
					$this->source_height = $getimagesize[1];
					$this->DebugMessage('source dimensions set to '.$this->source_width.'x'.$this->source_height, __FILE__, __LINE__);
					$this->SetOrientationDependantWidthHeight();

					if (!eregi('('.implode('|', $this->AlphaCapableFormats).')', $outputFormat)) {
						// not a transparency-capable format
						$commandline .= ' -background "#'.($this->bg ? $this->bg : 'FFFFFF').'"';
						if ($getimagesize[2] == 1) {
							// GIF
							$commandline .= ' -flatten';
						}
					}
					if ($getimagesize[2] == 1) {
						// GIF
						$commandline .= ' -coalesce'; // may be needed for animated GIFs
					}
					if ($this->source_width || $this->source_height) {
						if ($this->zc) {

							$borderThickness = 0;
							if (!empty($this->fltr)) {
								foreach ($this->fltr as $key => $value) {
									if (ereg('^bord\|([0-9]+)', $value, $matches)) {
										$borderThickness = $matches[1];
										break;
									}
								}
							}
							$wAll = intval(max($this->w, $this->wp, $this->wl, $this->ws)) - (2 * $borderThickness);
							$hAll = intval(max($this->h, $this->hp, $this->hl, $this->hs)) - (2 * $borderThickness);
							$imAR = $this->source_width / $this->source_height;
							$zcAR = (($wAll && $hAll) ? $wAll / $hAll : 1);
							$side  = phpthumb_functions::nonempty_min($this->source_width, $this->source_height, max($wAll, $hAll));
							$sideX = phpthumb_functions::nonempty_min($this->source_width,                       $wAll, round($hAll * $zcAR));
							$sideY = phpthumb_functions::nonempty_min(                     $this->source_height, $hAll, round($wAll / $zcAR));

							$thumbnailH = round(max($sideY, ($sideY * $zcAR) / $imAR));
							if ($IMuseExplicitImageOutputDimensions) {
								$commandline .= ' -'.$IMresizeParameter.' '.$thumbnailH.'x'.$thumbnailH;
							} else {
								$commandline .= ' -'.$IMresizeParameter.' x'.$thumbnailH;
							}

							switch (strtoupper($this->zc)) {
								case 'T':
									$commandline .= ' -gravity north';
									break;
								case 'B':
									$commandline .= ' -gravity south';
									break;
								case 'L':
									$commandline .= ' -gravity west';
									break;
								case 'R':
									$commandline .= ' -gravity east';
									break;
								case 'TL':
									$commandline .= ' -gravity northwest';
									break;
								case 'TR':
									$commandline .= ' -gravity northeast';
									break;
								case 'BL':
									$commandline .= ' -gravity southwest';
									break;
								case 'BR':
									$commandline .= ' -gravity southeast';
									break;
								case '1':
								case 'C':
								default:
									$commandline .= ' -gravity center';
									break;
							}

							if (($wAll > 0) && ($hAll > 0)) {
								$commandline .= ' -crop '.$wAll.'x'.$hAll.'+0+0';
							} else {
								$commandline .= ' -crop '.$side.'x'.$side.'+0+0';
							}
							if ($this->ImageMagickSwitchAvailable('repage')) {
								$commandline .= ' +repage';
							} else {
								$this->DebugMessage('Skipping "+repage" because ImageMagick (v'.$this->ImageMagickVersion().') does not support it', __FILE__, __LINE__);
							}

						} elseif ($this->sw || $this->sh || $this->sx || $this->sy) {

							$commandline .= ' -crop '.($this->sw ? $this->sw : $this->source_width).'x'.($this->sh ? $this->sh : $this->source_height).'+'.$this->sx.'+'.$this->sy;
							// this is broken for aoe=1, but unsure how to fix. Send advice to info@silisoftware.com
							if ($this->w || $this->h) {
								if ($this->ImageMagickSwitchAvailable('repage')) {
									$commandline .= ' -repage';
								} else {
									$this->DebugMessage('Skipping "-repage" because ImageMagick (v'.$this->ImageMagickVersion().') does not support it', __FILE__, __LINE__);
								}
								if ($IMuseExplicitImageOutputDimensions) {
									if ($this->w && !$this->h) {
										$this->h = ceil($this->w / ($this->source_width / $this->source_height));
									} elseif ($this->h && !$this->w) {
										$this->w = ceil($this->h * ($this->source_width / $this->source_height));
									}
								}
								$commandline .= ' -'.$IMresizeParameter.' '.$this->w.'x'.$this->h;
							}

						} else {

							if ($this->iar && (intval($this->w) > 0) && (intval($this->h) > 0)) {
								//$commandline .= ' -'.$IMresizeParameter.' '.$this->w.'x'.$this->h.'!';
								list($nw, $nh) = phpthumb_functions::TranslateWHbyAngle($this->w, $this->h, $this->ra);
								$nw = ((round($nw) != 0) ? round($nw) : '');
								$nh = ((round($nh) != 0) ? round($nh) : '');
								$commandline .= ' -'.$IMresizeParameter.' '.$nw.'x'.$nh.'!';
							} else {
								$this->w = ((($this->aoe || $this->far) && $this->w) ? $this->w : ($this->w ? phpthumb_functions::nonempty_min($this->w, $getimagesize[0]) : ''));
								$this->h = ((($this->aoe || $this->far) && $this->h) ? $this->h : ($this->h ? phpthumb_functions::nonempty_min($this->h, $getimagesize[1]) : ''));
								if ($this->w || $this->h) {
									if ($IMuseExplicitImageOutputDimensions) {
										if ($this->w && !$this->h) {
											$this->h = ceil($this->w / ($this->source_width / $this->source_height));
										} elseif ($this->h && !$this->w) {
											$this->w = ceil($this->h * ($this->source_width / $this->source_height));
										}
									}
									//$commandline .= ' -'.$IMresizeParameter.' '.$this->w.'x'.$this->h;
									list($nw, $nh) = phpthumb_functions::TranslateWHbyAngle($this->w, $this->h, $this->ra);
									$nw = ((round($nw) != 0) ? round($nw) : '');
									$nh = ((round($nh) != 0) ? round($nh) : '');
									$commandline .= ' -'.$IMresizeParameter.' '.$nw.'x'.$nh;
								}
							}
						}
					}

				} else {

					$this->DebugMessage('GetImageSize('.$this->sourceFilename.') failed', __FILE__, __LINE__);
					if ($this->w || $this->h) {
						if ($IMuseExplicitImageOutputDimensions) {
							// unknown source aspect ration, just put large number and hope IM figures it out
							$commandline .= ' -'.$IMresizeParameter.' '.($this->w ? $this->w : '9999').'x'.($this->h ? $this->h : '9999');
						} else {
							$commandline .= ' -'.$IMresizeParameter.' '.$this->w.'x'.$this->h;
						}
						if ($this->iar && (intval($this->w) > 0) && (intval($this->h) > 0)) {
							$commandline .= '!';
						}
					}

				}

				if ($this->ra) {
					$this->ra = intval($this->ra);
					if ($this->ImageMagickSwitchAvailable('rotate')) {
						if (!eregi('('.implode('|', $this->AlphaCapableFormats).')', $outputFormat) || phpthumb_functions::version_compare_replacement($this->ImageMagickVersion(), '6.3.7', '>=')) {
							$this->DebugMessage('Using ImageMagick rotate', __FILE__, __LINE__);
							$commandline .= ' -rotate '.$this->ra;
							if (($this->ra % 90) != 0) {
								if (eregi('('.implode('|', $this->AlphaCapableFormats).')', $outputFormat)) {
									// alpha-capable format
									$commandline .= ' -background rgba(255,255,255,0)';
								} else {
									$commandline .= ' -background "#'.($this->bg ? $th