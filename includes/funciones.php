<?php
// Función para redireccionar
	function redireccionar($url)
	{
		header("Location: " . $url);	
		die();
	}
// Función mensajes de error
	function mensajeError($error)
	{
		include("mensajes.php");
		$salida = "<div class='menasjeError'>".$mensaje[$error]."</div>";
		echo $salida;
	}
// Función mensajes correcto
	function mensajeCorrecto($correcto)
	{
		include("mensajes.php");
		$salida = "<div class='mensajeCorrecto'>".$mensaje[$correcto]."</div>";
		echo $salida;
	}
// Función de mensajes
	function mensajes()
	{
		if (isset($_GET['error']))
		{
			mensajeError($_GET['error']);
		} 
		if (isset($_GET['correcto']))
		{
			mensajeCorrecto($_GET['correcto']);
		}
	}
// Función enviar E-mail
	function enviarEmail($destino,$asunto,$mensaje)
	{
		$cabeceras = 'Content-type: text/html; charset=iso-8859-1'. "\r\n" .'From: Alta Cocina <'.$destino.'>'."\r\n".'Reply-To:'.$destino."\r\n";
		$abroHTML = "<html><head><style type='text/css'>body{font-family: Arial, Helvetica, sans-serif;	font-size: 12px;} h1{font-size: 18px;} h2{font-size: 14px;}</style></head><body>";
		$abroHTML .= "<h1>$asunto</h1>";
		$abroHTML .= $mensaje;
		$cieroHTML = "</body></html>";
		$mensaje .= $cieroHTML;
		
		@mail($destino,$asunto,$mensaje,$cabeceras);
	}
// Agregar la posición del registro
	function agregarPosicion($tabla)
	{
		$bd = new conexion();
		$id = mysql_insert_id();
		$bd->query("UPDATE " . DB_PREFIJO . "$tabla SET posicion='$id' WHERE id='$id'");
		return $id;
	}
// Agregar la posición del registro paso conexión
	function agregarPosicion2($tabla,$bd)
	{
		$id = mysql_insert_id();
		$bd->query("UPDATE " . DB_PREFIJO . "$tabla SET posicion='$id' WHERE id='$id'");
		return $id;
	}
// Mostrar icono de activo o inactivo
	function activoInactivo($variable)
	{
		if ($variable)
		{
			print "<img src='" . DIR_PLANTILLA . "img/si.png' align='absmiddle'>";
		}
		else
		{
			print "<img src='" . DIR_PLANTILLA . "img/no.png' align='absmiddle'>";
		}
	}	
// Función borrar registro
	function eliminarRegistro($tabla,$campoId,$id)
	{
		$bd = new conexion();
		$bd->query("DELETE FROM " . DB_PREFIJO . "$tabla WHERE $campoId = '$id'");
	}		
// Función borrar registro
	function eliminarArchivo($tabla,$campo,$campoId,$id)
	{
		$bd = new conexion();
		$archivo = $bd->query("SELECT $campo FROM " . DB_PREFIJO . $tabla . " WHERE $campoId = '$id'");		
		@unlink(DIR_ARCHIVOS . $archivo[0]->$campo);
		@unlink(DIR_IMAGENES . $archivo[0]->$campo);
		@unlink(DIR_IMAGENES_THUMBS_ADMIN . $archivo[0]->$campo);
		@unlink(DIR_IMAGENES_THUMBS_ADMIN2 . $archivo[0]->$campo);
		@unlink(DIR_IMAGENES_THUMBS1 . $archivo[0]->$campo);
		@unlink(DIR_IMAGENES_THUMBS2 . $archivo[0]->$campo);
		@unlink(DIR_IMAGENES_THUMBS3 . $archivo[0]->$campo);
		@unlink(DIR_IMAGENES_THUMBS4 . $archivo[0]->$campo);
		@unlink(DIR_VIDEOS . $archivo[0]->$campo);
	}
// Función marcar casilla
	function checked($variable)
	{
		if ($variable)
		{
			print "checked";
		}
	}	
// Función marcar select
	function selected($value,$consulta)
	{
		if ($value == $consulta)
		{
			print 'selected="selected"';
		}
	}
// Función subir orden registro
	function subirRegistro($tabla,$redireccion)
	{
		if (isset($_GET['subir']))
		{			
			$bd = new conexion();
			$orden = $bd->query("SELECT id,posicion FROM " . DB_PREFIJO . "$tabla WHERE posicion > '" . $_GET['subir'] . "' ORDER BY posicion ASC LIMIT 0,1");
			if ($bd->n)
			{
				$bd->query("UPDATE " . DB_PREFIJO . "$tabla SET posicion='" . $orden[0]->posicion . "' WHERE id='" . $_GET['id'] . "'");
				$bd->query("UPDATE " . DB_PREFIJO . "$tabla SET posicion='" . $_GET['subir'] . "' WHERE id='" . $orden[0]->id . "'");
			}
			redireccionar($redireccion);
		}
	}
// Función subir orden registro
	function bajarRegistro($tabla,$redireccion)
	{
		if (isset($_GET['bajar']))
		{
			$bd = new conexion();
			$orden = $bd->query("SELECT id,posicion FROM " . DB_PREFIJO . "$tabla WHERE posicion < '" . $_GET['bajar'] . "' ORDER BY posicion DESC LIMIT 0,1");
			if ($bd->n)
			{
				$bd->query("UPDATE " . DB_PREFIJO . "$tabla SET posicion='" . $orden[0]->posicion . "' WHERE id='" . $_GET['id'] . "'");
				$bd->query("UPDATE " . DB_PREFIJO . "$tabla SET posicion='" . $_GET['bajar'] . "' WHERE id='" . $orden[0]->id . "'");
			}
			redireccionar($redireccion);
		}
	}
	
	
	
	
	/////////////////////////////////////Mostrar Paginado seba////////////////////////////
	function mostrarPaginadoSeba($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
		if ($variablesGet)
		{
			//$variablesGet = "&" . $variablesGet;
			$varGet=explode("&",$variablesGet);
			
			$var0=$varGet[0];
			$var1=$varGet[1];
			/*$var2=$varGet[2];
			
			$var3=$varGet[3];
			$var4=$varGet[4];
			$var5=$varGet[5];
			$var6=$varGet[6];*/
				
					
			
			
			
			$variablesG="&$var0=$var1";
			
		}
		if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "$paginaActual ";
				}
				else
				{
					$paginado .= " <a href='?pagina=$i" . $variablesG . "'>$i</a> ";
				}
			}
		}
		if (($paginaActual - 1) > 0)
		{
			$paginado .= "<a href='?" . "pagina=" . ($paginaActual - 1) . $variablesG . "'> Anterior </a>  ";
		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			$paginado .= "<a href='?" . "pagina=" . ($paginaActual + 1) . $variablesG . "'> Siguiente </a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}

	
	
	
	
	
	
// Función paginado
	function mostrarPaginado($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
		if ($variablesGet)
		{
			$variablesGet = "&" . $variablesGet;
		}
		if ($totalPaginas >= 1)
		{
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= "<strong>$paginaActual</strong>";
				}
				else
				{
					$paginado .= " <a href='?pagina=$i" . $variablesGet . "'>$i</a> ";
				}
			}
		}
		if (($paginaActual - 1) > 0)
		{
			$paginado .= "<a href='?" . "pagina=" . ($paginaActual - 1) . $variablesGet . "'> Anterior </a>";
		}
		if (($paginaActual + 1) <= $totalPaginas)
		{
			$paginado .= "<a href='?" . "pagina=" . ($paginaActual + 1) . $variablesGet . "'> Siguiente </a>";
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
// Función paginado 2
	function mostrarPaginado2($totalRegistros,$paginaActual,$limiteRegistros,$variablesGet)
	{
		if (!$paginaActual)
		{
			$inicio = 0;
			$paginaActual = 1;
		}
		else
		{
			$inicio = ($paginaActual - 1) * $limiteRegistros;
		}
		
		$totalPaginas = ceil($totalRegistros / $limiteRegistros);
		
		if ($variablesGet)
		{
			$variablesGet = "&" . $variablesGet;
		}
		if ($totalPaginas >= 1)
		{
		
			if (($paginaActual - 1) > 0)
			{
				$paginado .= "<a href='#' class='first' onClick=\"javascript:document.filtros.pag.defaultValue = '" . ($paginaActual - 1) . $variablesGet . "'; document.filtros.submit();\"><span>primero</span></a>";
			}
					
			if ($paginaActual == $totalPaginas && $totalPaginas > 3)
			{
				$paginado .= " <a href='#' onClick=\"javascript:document.filtros.pag.defaultValue = '1'; document.filtros.submit();\" class='numbers'>1</a> ... ";
			}
			
			for ($i=1; $i<=$totalPaginas; $i++)
			{
				if ($paginaActual == $i)
				{
					$paginado .= " <a href='#' onClick=\"javascript:document.filtros.pag.defaultValue = '$i'; document.filtros.submit();\" class='numbers activo'>$i</a> ";
				}
				else
				{
					if ($totalPaginas <= 3)
					{
						$paginado .= " <a href='#' onClick=\"javascript:document.filtros.pag.defaultValue = '$i'; document.filtros.submit();\" class='numbers'>$i</a> ";
					}
					else
					{
						if (($paginaActual + 1) == $i && $i != $totalPaginas)
						{
							$paginado .= " <a href='#' onClick=\"javascript:document.filtros.pag.defaultValue = '$i'; document.filtros.submit();\" class='numbers'>$i</a> ";
						}
						else if(($paginaActual - 2) == $i && ($paginaActual + 1) == $totalPaginas)
						{
							$paginado .= " <a href='#' onClick=\"javascript:document.filtros.pag.defaultValue = '$i'; document.filtros.submit();\" class='numbers'>$i</a> ...";
						}
						else if(($paginaActual - 1) == $i && $i != 1 && $paginaActual == $totalPaginas)
						{
							$paginado .= " <a href='#' onClick=\"javascript:document.filtros.pag.defaultValue = '$i'; document.filtros.submit();\" class='numbers'>$i</a> ";
						}
					
						if ($i == $totalPaginas && ($totalPaginas - 1) == $paginaActual)
						{
							$paginado .= " <a href='#' onClick=\"javascript:document.filtros.pag.defaultValue = '$i'; document.filtros.submit();\" class='numbers'>$i</a> ";
						}
						else if ($i == $totalPaginas)
						{
							$paginado .= "... <a href='#' onClick=\"javascript:document.filtros.pag.defaultValue = '$i'; document.filtros.submit();\" class='numbers'>$i</a> ";
						}
					
					}
				}
			}
			
			if (($paginaActual + 1) <= $totalPaginas)
			{
				$paginado .= "<a href='#' class='last' onClick=\"javascript:document.filtros.pag.defaultValue = '" . ($paginaActual + 1) . $variablesGet . "'; document.filtros.submit();\"><span>último</span></a>";
			}
			
		}
		
		$array = array($paginado,$inicio);
		return $array;
	}
// Función categorias
	function mostrarCategorias($idInput,$tabla,$id)
	{
		$bd = new conexion();
		print "<select name=\"" . $idInput . "\" id=\"" . $idInput . "\" class='campo'>
      	<option value=\"\">Seleccione</option>";
		$categorias = $bd->query("SELECT id FROM " . DB_PREFIJO . $tabla . " WHERE activo = '1' ORDER BY posicion DESC");
		if ($bd->n)
		{
			foreach ($categorias as $categoria)
			{
				$categoria_idioma = $bd->query("SELECT nombre FROM " . DB_PREFIJO . $tabla . "_idiomas WHERE $idInput = '" . $categoria->id . "' AND idIdioma='" . IDIOMA_DEFECTO . "'");
				if ($categoria->id==$id)
				{
     			print "<option value=\"" . $categoria->id . "\" selected=\"selected\">" . $categoria_idioma[0]->nombre . "</option>";
				}
				else
				{
     			print "<option value=\"" . $categoria->id . "\">" . $categoria_idioma[0]->nombre . "</option>";
				}
			}
		}
		print "</select>";
	}
// Función categorias
	function mostrarCategorias2($idInput,$tabla,$id)
	{
		$bd = new conexion();
		print "<select name=\"" . $idInput . "\" id=\"" . $idInput . "\" class='campo'>
      	<option value=\"\">Seleccione</option>";
		$categorias = $bd->query("SELECT id FROM " . DB_PREFIJO . $tabla . " WHERE activo = '1' ORDER BY posicion DESC");
		if ($bd->n)
		{
			foreach ($categorias as $categoria)
			{
				$categoria_idioma = $bd->query("SELECT nombre FROM " . DB_PREFIJO . $tabla . "_idiomas WHERE $idInput = '" . $categoria->id . "'");
				if ($categoria->id==$id)
				{
     			print "<option value=\"" . $categoria->id . "\" selected=\"selected\">" . $categoria_idioma[0]->nombre . "</option>";
				}
				else
				{
     			print "<option value=\"" . $categoria->id . "\">" . $categoria_idioma[0]->nombre . "</option>";
				}
			}
		}
		print "</select>";
	}
// Función subcategorias
	function mostrarSubcategorias($idInput,$tabla,$id)
	{
		$bd = new conexion();
		print "<select name=\"" . $idInput . "\" id=\"" . $idInput . "\" class='campo'>
      	<option value=\"\">Seleccione</option>";
		$categorias = $bd->query("SELECT id,idCategoria FROM " . DB_PREFIJO . $tabla . " WHERE activo = '1' ORDER BY posicion DESC");
		if ($bd->n)
		{
			foreach ($categorias as $categoria)
			{
				$categoria_idioma = $bd->query("SELECT nombre FROM " . DB_PREFIJO . $tabla . "_idiomas WHERE $idInput = '" . $categoria->id . "' AND idIdioma='" . IDIOMA_DEFECTO . "'");
				
				$categoria1_idioma = $bd->query("SELECT nombre FROM " . DB_PREFIJO . "_productos_categorias_idiomas WHERE idCategoria = '" . $categoria->idCategoria . "' AND idIdioma='" . IDIOMA_DEFECTO . "'");
				if ($categoria->id==$id)
				{
     			print "<option value=\"" . $categoria->id . "\" selected=\"selected\">" . $categoria1_idioma[0]->nombre . " -> " . $categoria_idioma[0]->nombre . "</option>";
				}
				else
				{
     			print "<option value=\"" . $categoria->id . "\">" . $categoria1_idioma[0]->nombre . " -> " . $categoria_idioma[0]->nombre . "</option>";
				}
			}
		}
		print "</select>";
	}
// Función subcategorias 2
	function mostrarSubcategorias2($idInput,$tabla,$id)
	{
		$bd = new conexion();
		print "<select name=\"" . $idInput . "\" id=\"" . $idInput . "\" class='campo'>
      	<option value=\"\">Ninguna</option>";
		$categorias = $bd->query("SELECT id,idCategoria FROM " . DB_PREFIJO . $tabla . " WHERE activo = '1' ORDER BY posicion DESC");
		if ($bd->n)
		{
			foreach ($categorias as $categoria)
			{
				$categoria_idioma = $bd->query("SELECT nombre FROM " . DB_PREFIJO . $tabla . "_idiomas WHERE $idInput = '" . $categoria->id . "' AND idIdioma='" . IDIOMA_DEFECTO . "'");
				
				$categoria1_idioma = $bd->query("SELECT nombre FROM " . DB_PREFIJO . "_productos_categorias_idiomas WHERE idCategoria = '" . $categoria->idCategoria . "' AND idIdioma='" . IDIOMA_DEFECTO . "'");
				if ($categoria->id==$id)
				{
     			print "<option value=\"" . $categoria->id . "\" selected=\"selected\">" . $categoria1_idioma[0]->nombre . " -> " . $categoria_idioma[0]->nombre . "</option>";
				}
				else
				{
     			print "<option value=\"" . $categoria->id . "\">" . $categoria1_idioma[0]->nombre . " -> " . $categoria_idioma[0]->nombre . "</option>";
				}
			}
		}
		print "</select>";
	}
// Función select
	function mostrarSelect($idInput,$campo,$tabla,$id)
	{
		$bd = new conexion();
		print "<select name=\"" . $idInput . "\" id=\"" . $idInput . "\" class='campo'>
      	<option value=\"\">Seleccione</option>";
		$categorias = $bd->query("SELECT id,$campo FROM " . DB_PREFIJO . $tabla . " WHERE activo = '1' ORDER BY posicion DESC");
		if ($bd->n)
		{
			foreach ($categorias as $categoria)
			{
				if ($categoria->id==$id)
				{
     			print "<option value=\"" . $categoria->id . "\" selected=\"selected\">" . $categoria->$campo . "</option>";
				}
				else
				{
     			print "<option value=\"" . $categoria->id . "\">" . $categoria->$campo . "</option>";
				}
			}
		}
		print "</select>";
	}
// Función extension de los archivos
	function extensionArchivo($archivo)
	{
		$extension = strstr($archivo, '.');
		$extension = str_replace('.', '', $extension); 
		$extension = strtolower($extension);
		return $extension;
	}
// Función imagen de la extension
	function imagenExtension($extension)
	{
	  switch ($extension)
	  {
			// IMAGENES
	    case 'jpeg': print "<img src='" . DIR_PLANTILLA . "img/extensiones/img.png' alt='JPEG' title='Extension - JPEG' />"; break;
	    case 'jpg' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/img.png' alt='JPG' title='Extension - JPG' />"; break;
	    case 'png' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/img.png' alt='PNG' title='Extension - PNG' />"; break;
	    case 'gif' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/img.png' alt='GIF' title='Extension - GIF' />"; break;
	    case 'bmp' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/img.png' alt='BMP' title='Extension - BMP' />"; break;
			// COMPRESION
	    case 'rar' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/compress.png' alt='RAR' title='Extension - RAR' />"; break;
	    case 'zip' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/compress.png' alt='ZIP' title='Extension - ZIP' />"; break;
			// XLS
	    case 'xls' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/excel.png' alt='XLS' title='Extension - XLS' />"; break;
	    case 'xlsx': print "<img src='" . DIR_PLANTILLA . "img/extensiones/excel.png' alt='XLSX' title='Extension - XLSX' />"; break;
			// POWERPOINT
	    case 'ppt' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/powerpoint.png' alt='PPT' title='Extension - PPT' />"; break;
	    case 'pptx': print "<img src='" . DIR_PLANTILLA . "img/extensiones/powerpoint.png' alt='PPTX' title='Extension - PPTX' />"; break;
			// ADOBE ACROBAT
	    case 'pdf' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/acrobat.png' alt='PDF' title='Extension - PDF' />"; break;
			// TEXTO
	    case 'doc' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/text.png' alt='DOC' title='Extension - DOC' />"; break;
	    case 'txt' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/text.png' alt='TXT' title='Extension - TXT' />"; break;
	    case 'rtf' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/text.png' alt='RTF' title='Extension - RTF' />"; break;
	    case 'docx': print "<img src='" . DIR_PLANTILLA . "img/extensiones/text.png' alt='DOCX' title='Extension - DOCX' />"; break;
			// MUSICA
	    case 'mp3' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/sound.png' alt='MP3' title='Extension - MP3' />"; break;
	    case 'ogg' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/sound.png' alt='OGG' title='Extension - OGG' />"; break;
	    case 'wav' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/sound.png' alt='WAV' title='Extension - WAV' />"; break;
	    case 'wma' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/sound.png' alt='WMA' title='Extension - WMA' />"; break;
			// VIDEO
			case 'avi' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/video.png' alt='AVI' title='Extension - AVI' />"; break;
	    case 'flv' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/video.png' alt='FLV' title='Extension - FLV' />"; break;
	    case 'mp4' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/video.png' alt='MP4' title='Extension - MP4' />"; break;
	    case 'wmv' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/video.png' alt='WMV' title='Extension - WMV' />"; break;
	    case 'mpg' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/video.png' alt='MPG' title='Extension - MPG' />"; break;
	    case 'mpeg': print "<img src='" . DIR_PLANTILLA . "img/extensiones/video.png' alt='MPEG' title='Extension - MPEG' />"; break;
	    case 'mov' : print "<img src='" . DIR_PLANTILLA . "img/extensiones/video.png' alt='MOV' title='Extension - MOV' />"; break;
			// EXTENSION DESCONOCIDA
			default    : print "<img src='" . DIR_PLANTILLA . "img/extensiones/unknown.png' alt='UNKNOWN' title='Extension - Desconocida' />"; break;
	  }
	}
	
	
// Definicion de constantes
    define ('SITE_HOME_Path', 'gestion/modulos/generalRegister');
	define ('PHOTOS_PERFIL_Path', 			SITE_HOME_Path . '/photosProfile');
	define ('PHOTOS_THUMBS1_PERFIL_Path', 	SITE_HOME_Path . '/thumbsProfile/thumbsProfile1');	
	define ('PHOTOS_THUMBS2_PERFIL_Path', 	SITE_HOME_Path . '/thumbsProfile/thumbsProfile2');	
	define ('PHOTOS_THUMBS3_PERFIL_Path', 	SITE_HOME_Path . '/thumbsProfile/thumbsProfile3');		
	
	
// Función peso de los archivos
	function pesoArchivo($peso)
	{
		$bytes = $peso;
		$peso = $bytes / 1024;
		$peso = round($peso);
		$peso = $peso . " KB";
		return $peso;
	}
	
// Función subir imagen
	function subirImagen($foto,$fototmp,$idUser,$ancho,$alto,$anchoThumb,$altoThumb,$anchoThumb2,$altoThumb2,$anchoThumb3,$altoThumb3,$anchoThumb4,$altoThumb4)
	{
		//global $nombreModulo;
		$sNameModulo='generalRegister';
		$foto = limpiarCaracteres($foto);
		$codigo = substr( md5(microtime()), 1, 6);
		$nombreFoto = $sNameModulo . "_" . $idUser . "_" . $foto;
		$extension = strstr($nombreFoto, '.');
		copy($fototmp, PHOTOS_PERFIL_Path . $nombreFoto);	
		include_once("imageresize.class.php");
		$imagen_origen = PHOTOS_PERFIL_Path . $nombreFoto;
		$o=new ImageResize($imagen_origen);

		$imagen_destino = PHOTOS_PERFIL_Path . $nombreFoto;
		
		if ($ancho && $alto)
		{	
			/*
			if ($o->width_s > $o->height_s) 
			{
				echo 'ancho';
				$o->resizeWidth($ancho);
			}else{ 
				echo 'alto';
				$o->resizeHeight($alto);
			}*/
			
			$o->resizeWidthHeight($ancho,$alto);
			
			$o->save($imagen_destino);			
			
		}
		elseif ($ancho)
		{
			$o->resizeWidth($ancho);
			$o->save($imagen_destino);
		}
		elseif ($alto)
		{
			$o->resizeHeight($alto);
			$o->save($imagen_destino);
		}
		
		// THUMB 1
		
		$o=new ImageResize($imagen_origen);
		
		$imagen_destino = PHOTOS_THUMBS1_PERFIL_Path . $nombreFoto;
		
		if ($ancho && $alto)
		{
			if ($o->width_s > $o->height_s) 
			{
				$o->resizeWidth($anchoThumb);
			}else{ 
				$o->resizeHeight($altoThumb);
			}

			$o->save($imagen_destino);
		}
		elseif ($anchoThumb)
		{
			$o->resizeWidth($anchoThumb);
			$o->save($imagen_destino);
		}
		elseif ($altoThumb)
		{
			$o->resizeHeight($altoThumb);
			$o->save($imagen_destino);
		}
		
		// THUMB 2
		
		$o=new ImageResize($imagen_origen);
		
		$imagen_destino = PHOTOS_THUMBS2_PERFIL_Path . $nombreFoto;
		
		if ($anchoThumb2 && $altoThumb2)
		{
			if ($o->width_s > $o->height_s) 
			{
				$o->resizeWidth($anchoThumb2);
			}else{ 
				$o->resizeHeight($altoThumb2);
			}

			$o->save($imagen_destino);
		}
		elseif ($anchoThumb2)
		{
			$o->resizeWidth($anchoThumb2);
			$o->save($imagen_destino);
		}
		elseif ($altoThumb2)
		{
			$o->resizeHeight($altoThumb2);
			$o->save($imagen_destino);
		}
		
		// THUMB 3
		
		$o=new ImageResize($imagen_origen);
		
		$imagen_destino = PHOTOS_THUMBS3_PERFIL_Path . $nombreFoto;
		
		if ($anchoThumb3 && $altoThumb3)
		{
			if ($o->width_s > $o->height_s) 
			{
				$o->resizeWidth($anchoThumb3);
			}else{ 
				$o->resizeHeight($altoThumb3);
			}

			$o->save($imagen_destino);
		}
		elseif ($anchoThumb3)
		{
			$o->resizeWidth($anchoThumb3);
			$o->save($imagen_destino);
		}
		elseif ($altoThumb3)
		{
			$o->resizeHeight($altoThumb3);
			$o->save($imagen_destino);
		}
		
		// THUMB 4
		
		$o=new ImageResize($imagen_origen);
		
		$imagen_destino = DIR_IMAGENES_THUMBS4 . $nombreFoto;
		
		if ($anchoThumb4 && $altoThumb4)
		{
			if ($o->width_s > $o->height_s) 
			{
				$o->resizeWidth($anchoThumb4);
			}else{ 
				$o->resizeHeight($altoThumb4);
			}

			$o->save($imagen_destino);
		}
		elseif ($anchoThumb4)
		{
			$o->resizeWidth($anchoThumb4);
			$o->save($imagen_destino);
		}
		elseif ($altoThumb4)
		{
			$o->resizeHeight($altoThumb4);
			$o->save($imagen_destino);
		}

		// THUMBS ADMIN 1

		$o=new ImageResize($imagen_origen);
		$imagen_destino = DIR_IMAGENES_THUMBS_ADMIN . $nombreFoto;
		if ($o->width_s > $o->height_s) 
		{
		  $o->resizeWidth(70);
		}else{ 
		  $o->resizeHeight(70);
		}
		$o->save($imagen_destino);
		
		// THUMBS ADMIN 2
		
		$o=new ImageResize($imagen_origen);
		$imagen_destino = DIR_IMAGENES_THUMBS_ADMIN2 . $nombreFoto;
		if ($o->width_s > $o->height_s) 
		{
		  $o->resizeWidth(215);
		}else{ 
		  $o->resizeHeight(215);
		}
		$o->save($imagen_destino);

		return $nombreFoto;
	}
	
// Función subir imagen
	function subirArchivo($archivo,$archivotmp)
	{
		global $nombreModulo;
		$archivo = limpiarCaracteres($archivo);
		$codigo = substr( md5(microtime()), 1, 6);
		$nombreArchivo = $nombreModulo . "_" . $codigo . "_" . $archivo;
		copy($archivotmp, DIR_ARCHIVOS . $nombreArchivo);
				
		return $nombreArchivo;
	}
	
// Función para consultar un campo rapidamente
	function consultarCampo($tabla,$campo,$campoId,$id)
	{
		$bd = new conexion();
		$consultaCampo = $bd->query("SELECT $campo FROM " . DB_PREFIJO . "$tabla WHERE $campoId = '$id'");
		if ($bd->n)
		{
			$campo = $consultaCampo[0]->$campo;
		}
		return $campo;
	}
// Función cambiar caracteres especiales
	function limpiarCaracteres($cadena)
	{
		$cadena = str_replace(array("À","Á","Â","Ã","Ä","Å","à","á","â","ã","ä","å","Ò","Ó","Ô","Õ","Ö","Ø","ò","ó","ô","õ","ö","ø","È","É","Ê","Ë","è","é","ê","ë","Ç","ç","Ì","Í","Î","Ï","ì","í","î","ï","Ù","Ú","Û","Ü","ù","ú","û","ü","ÿ","Ñ","ñ"),array("A","A","A","A","A","A","a","a","a","a","a","a","O","O","O","O","O","O","o","o","o","o","o","o","E","E","E","E","e","e","e","e","C","c","I","I","I","I","i","i","i","i","U","U","U","U","u","u","u","u","y","N","n"), $cadena);
		$cadena = str_replace(" ","-",$cadena);
		$cadena = strtolower($cadena);
		return $cadena;
	}
	function alza5($numero, $separa = ".")
	{
		if(strpos($numero, $separa) === false)
		{
			return $numero;
		}
		else
		{
			$ultimaCifra = substr($numero, strlen($numero) - 1, strlen($numero));
			
			$temp = explode($separa,$numero);
			$temp = $temp[1];
			$penultimaCifra = substr($temp, 0, strlen($temp) - 1);
			
			if($ultimaCifra < 5 && $ultimaCifra >= 3)
			{
				$numero = substr($numero, 0, strlen($numero) - 1) . "5";
			}
			else if($ultimaCifra < 5)
			{
				$numero = substr($numero, 0, strlen($numero) - 1) . "0";
			}
			else if($ultimaCifra < 8  && $ultimaCifra > 5)
			{
				$numero = substr($numero, 0, strlen($numero) - 1) . "5";
			}
			else if($ultimaCifra >= 8)
			{
				$numero = substr($numero, 0, strlen($numero) - 2) . ($penultimaCifra + 1) . "0";
			}
			
			return $numero;
		}
	}
	function calcularDescuento($precio,$descuento)
	{
		$resultado = $precio * $descuento / 100;
		$resultado = $precio - $resultado;
		$resultado = number_format($resultado,2);
		$resultado = alza5($resultado);
		return $resultado;
	}
	

///////////////////////strip_tag+substr/////////////////////
	function sub($texto,$fin){
		$cadena=strip_tags(substr($texto,0,$fin)) . "...";
		return $cadena;
	}	
	
	
?>