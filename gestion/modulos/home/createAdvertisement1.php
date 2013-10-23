<?php

require_once ('../../lib/site_ini.php');

require_once ('../../lib/share/clases/class_site.inc.php');
require_once $_GBASE . '/goaamb/web/tags.php';
require_once $_GBASE . '/goaamb/web/select.php';
$mlpais = ModelLoader::crear ( "ax_country" );
$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
$editar = false;
if (isset ( $_POST ["id"] ) && $ml->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
	$editar = true;
}
?><link href="css/advertisement.css" rel="stylesheet" type="text/css" /><?php

?><div id="closing" onclick="clsAcc();"
	title="<?php
	
	print $_IDIOMA->traducir ( "Close" );
	
	?>"></div>

<div id="content">

	<div id="main">

		<h5><?php
		
		print $_IDIOMA->traducir ( "Advertise type 1" );
		
		?></h5>

		<p class="subtitulos"><?php
		
		print $_IDIOMA->traducir ( "Create your ad:" );
		
		?></p>

		<p class="parrafo"><?php
		
		print $_IDIOMA->traducir ( "Here you can create your ad. Please follow these steps carefully. Make sure your images meet the requirements. In this way we can proceed more quickly to the revision and publication of your campaign." );
		
		?></p>



		<br />



		<p class="subtitulos"><?php
		
		print $_IDIOMA->traducir ( "1. Paste the link to your page." );
		
		?></p>



		<p class="parrafo"><?php
		
		print $_IDIOMA->traducir ( "This space will be shared with other advertisers for the time. It will only be visible to users who connect to SOCCERMASH.com in countries previously ruled by the contract. You can direct traffic or off the network." );
		if ($editar) {
			$url = $ml->url;
			$url = explode ( "::--::", $url );
			if (count ( $url ) > 0) {
				switch ($url [0]) {
					case "http2" :
						$url = $url [1];
						$tipo = 2;
						break;
					default :
						$url = $url [1];
						$tipo = 1;
						break;
				}
			}
		}
		?></p>

		<div id="linkExterno"
			<?php
			if ($editar && $tipo == 2) {
				print "style='display:none;'";
			}
			?>>
			<span class="verde"><?php
			
			print $_IDIOMA->traducir ( "Destination out of SOCCERMASH.com clicking on the ad:" );
			
			?></span><br /> <span>http:// </span> <input type="text" name="http1"
				id="http1" onkeyup="revisarHTTP1.call(this)" style="width: 385px;<?php
				if ($editar && $tipo == 1) {
					print "display:none;";
				}
				?>" /><a
				class="bottomAdvert" href="#"
				onclick="validarURL.call(G.dom.$('http1'));return false;"
				id="http1validate" style="width: 80px;<?php
				if ($editar && $tipo == 1) {
					print "display:none;";
				}
				?>"><?php
				print $_IDIOMA->traducir ( "Validate" );
				?></a> <span id="http1span" onclick="editarHTTP1.call(this)"
				title="<?php
				print $_IDIOMA->traducir ( "Edit" )?>"
				<?php
				if ($editar && $tipo == 1) {
					print "style='display:inline;'";
				}
				?>><?php print $url;?></span> <input
				class="bottomAdvert"
				id="http1edit" value="<?php print $_IDIOMA->traducir("Edit");?>"
				onclick="editarHTTP1.call(G.dom.$('http1span'));" style="height: 15px;width: 100px;margin-top: 15px;
				<?php
				if ($editar && $tipo == 1) {
					print "display:inline;";
				} else {
					print "display:none;";
				}
				?>" /> <br /> <span id="linkExternoError"></span><br />
			<p id="aLinkInternop"
				<?php
				if ($editar && $tipo == 1) {
					print "style='display:none;'";
				}
				?>><?php print $_IDIOMA->traducir("If you want to direct your traffic to your site inside SOCCERMASH.com click on the button below.");?></p>
			<a href="#" onclick="return verLinkInterno();" class="bottomAdvert"
				id="aLinkInterno"
				style="margin-top: 5px; float: left; margin-left: 15px; text-transform: capitalize;<?php
				if ($editar && $tipo == 1) {
					print "display:none;";
				}
				?>"><?php
				print $_IDIOMA->traducir ( "Internal Link" );
				?></a>
		</div>
		<div id="linkInterno"
			<?php
			if ($editar && $tipo == 1) {
				print "style='display:none;'";
			} else if ($editar) {
				print "style='display:block;'";
			} else {
				print "style='display:none;'";
			}
			?>>
			<span class="verde"><?php
			
			print $_IDIOMA->traducir ( "SOCCERMASH.com destination within the ad click:" );
			
			?></span><br /> <span>http://www.soccermash.com/usuario/ </span> <input
				type="text" name="http2" id="http2" style="width: 325px;<?php
				if ($editar && $tipo == 2) {
					print "display:none;";
				}
				?>"
				onkeydown="verificarTeclaHTTP2.call(this,event);"
				onkeyup="revisarHTTP2.call(this);" /><span id="http2span"
				onclick="editarHTTP2.call(this)"
				title="<?php
				print $_IDIOMA->traducir ( "Edit" )?>"
				<?php
				if ($editar && $tipo == 2) {
					print "style='display:inline;'";
				}
				?>><?php if($editar  && $tipo==2){ print $url;}?></span> <input
				class="bottomAdvert"
				id="http2edit" value="<?php print $_IDIOMA->traducir("Edit");?>"
				onclick="editarHTTP2.call(G.dom.$('http2span'));" style="height: 15px;width: 100px;margin-top: 15px;
				<?php
				if ($editar && $tipo == 2) {
					print "display:inline;";
				} else {
					print "display:none;";
				}
				?>
				" /><br /> <a
				href="#" onclick="return verLinkExterno();" class="bottomAdvert"
				id="aLinkExterno"
				style="margin-top: 5px; float: left; margin-left: 15px; text-transform: capitalize;<?php
				if ($editar && $tipo == 2) {
					print "display:none;";
				}
				?>"><?php
				print $_IDIOMA->traducir ( "External Link" );
				?></a>
		</div>


		<br />



		<hr class="verde" />



		<br />



		<p class="subtitulos"><?php
		
		print $_IDIOMA->traducir ( "2. Create your ad" );
		
		?></p>
		<br />
		<div id="todoconte">
			<span class="verde"
				style="clear: both; display: block; margin-bottom: 0; padding-top: 15px;"><?php
				
				print $_IDIOMA->traducir ( "Upload your image:" );
				
				?> </span>

			<style type="text/css">
.subtitulos a {
	color: #0C8141;
	font-family: Verdana;
	font-size: 11px;
}

#http1edit,#http2edit {
	display: none;
}

#http1span,#http2span {
	display: none;
	cursor: pointer;
	margin: 0px;
}

#http1span:hover,#http2span:hover {
	text-decoration: underline;
	color: black;
	font-style: italic;
}

#div-input-file {
	height: 28px;
	width: 385px;
	margin: 0px;
}

#div-input-file #imagen1-real,#div-input-file #imagen2-real,#div-input-file #imagen3-real
	{
	opacity: 0.0;
	-moz-opacity: 0.0;
	filter: alpha(opacity =                         
		                                                         
		                                                         
		                                                         
		                                                                    
		                                                                    
		     00);
	font-size: 18px; *
	z-index: 100000; *
	position: absolute;
	height: 30px !important;
}

#div-input-falso {
	margin-top: -38px; *
	margin-top: 0px;
}

#div-input-falso #imagen1,#div-input-file #imagen2,#div-input-file #imagen3
	{
	width: 265px;
	height: 18px;
	font-size: 14px;
	font-family: Verdana;
}

#editor {
	position: relative;
	background-color: #666;
	border: 1px solid #000;
	background-repeat: no-repeat;
}

.tip {
	color: #aaa;
}

#crop_area {
	width: 50px;
	height: 50px;
	background-image: url('/goaamb/css/images/crop_area.png');
	background-repeat: repeat;
	background-color: transparent;
	float: left;
	cursor: move;
}

#content #main p.subtitulos {
	clear: both;
}

.capaBuscador {
	position: relative;
	clear: both;
	border: 1px solid #E9E9E9;
	margin-left: 15px;
}

#listaPaises {
	display: none;
	position: absolute;
	top: 22px;
	height: 58px;
	left: 0px;
	width: 100%;
	z-index: 1;
	color: #ffffff;
	background-color: #0C8141;
	font-size: 11px;
}

.capaPaises {
	float: left;
	position: relative;
	padding: 0 20px 0 0px;
	border: 1px solid #E9E9E9;
	border-radius: 3px;
	-moz-border-radius: 3px;
	width: auto;
	height: 18px;
	margin-top: 1px;
	margin-left: 2px;
}

#content #main .capaPaises span.cerrar {
	position: absolute;
	padding: 2px;
	right: 2px;
	top: 2px;
	border-radius: 2px;
	-moz-border-radius: 2px;
	cursor: pointer;
	font-size: 0;
	margin: 0px;
	background-image: url(../img/cerrar.jpg);
	height: 10px;
	width: 10px;
	background-repeat: no-repeat;
	background-position: center;
}

#content #main .capaPaises span.nombre {
	margin: 0px;
	height: 15px;
	display: block;
	padding-top: 2px;
	padding-left: 2px;
}

#main #listaAmigos {
	background: white;
	position: absolute;
	z-index: 9999;
}

#main #listaAmigos li {
	height: auto;
	width: 325px;
	float: left;
	cursor: pointer;
}

#main #listaAmigos li:hover {
	background: silver;
}

#main #listaAmigos li span {
	float: left;
	margin: 0px;
}

#main #listaAmigos li img {
	float: left;
	margin-right: 10px;
	padding: 1px;
	border: 1px solid #383838;
}
</style>

			<form action="/greader.php" method="post" id="formImagen5"
				target="iframeFakeAdvertisement" enctype="multipart/form-data">
				<input type="hidden" name="__q" value="proceso/anuncio" /> <input
					type="hidden" name="__a" value="crearImagen1" /> <input
					name="imagedir" type="hidden"
					value="<?php
					
					if ($editar) {
						print $ml->imagen;
					}
					?>" />

				<div id="div-input-file">
					<input type="file" id="imagen1-real" name="imagen-real"
						onchange="procesarImagen.call(this.form,5);" />

					<div id="div-input-falso">
						<input type="text" id="imagen5" name="imagen" class="selImagen"
							disabled="disabled" /><a class="bottomSearchAdv"
							href="javascript:;" onclick=""><?php
							
							print $_IDIOMA->traducir ( "Browse" );
							
							?></a>
					</div>

				</div>

				<div id="cargando5"
					style="display: none; margin-top: -21px; position: relative; margin-left: 300px;">
					<img src="img/indicator.gif" width="16" />
				</div>

			</form>

			<div id="contenidoEditor5" style="">
				<div id="contenidoLoading" style="display: none;">
					<img src="/img/carga.gif" />
				</div>
				<div id="editorContenido"
					style="margin-left: 15px; margin-top: 10px;<?php
					
					if ($editar) {
						print "display:none";
					}
					?>">
					<span class="example" style="width: auto;"><?php
					
					print $_IDIOMA->traducir ( "Resize your image" );
					
					?></span>

					<div id="editor" style="width: 300px; height: 300px; float: left;">

						<div id="crop_area" class="ui-widget-content"
							style="border: 1px solid black;"></div>

					</div>

					<span class="verde"><?php
					
					print $_IDIOMA->traducir ( "Title:" );
					$titulo = utf8_encode ( $ml->titulo );
					$texto = utf8_encode ( $ml->texto );
					?></span><br /> <input type="text" name="titulo" id="titulo"
						maxlength="25" style="width: 225px; margin-left: 15px;"
						onkeyup="restantesTitulo.call(this)"
						value="<?php print $titulo;?>" /> <br />

					<div class="cantcaract">
						<span id="restantesTituloSpan"><?php print (25-strlen($titulo));?></span> <?php
						
						print $_IDIOMA->traducir ( "characters left" );
						
						?></div>

					<br /> <span class="verde"><?php
					
					print $_IDIOMA->traducir ( "Text:" );
					
					?></span><br />

					<textarea maxlength="135" name="texto" id="Texto"
						style="width: 225px; margin-left: 15px;"
						onkeyup="restantesTexto.call(this)"><?php print $texto;?></textarea>
					<br />

					<div class="cantcaract">
						<span id="restantesTextoSpan"><?php print (135-strlen($texto));?></span> <?php
						
						print $_IDIOMA->traducir ( "characters left" );
						
						?></div>
					<div style="clear: both; width: 100%"></div>
					<span class="verde"
						style="margin-top: 10px; display: block; margin-left: 0;"><?php
						
						print $_IDIOMA->traducir ( "Preview in the right column:" );
						
						?></span>
					<div id="previewAnuncioTipo11" style="display: block;">
						<span id="tituloAnuncioTipo11"><?php print $titulo;?></span>
						<div id="preview"
							style="width: 80px; height: 80px; overflow: hidden; margin-top: 11px; margin-left: -3px; position: absolute; background: white;">
							<div id="croppedPreview"
								style="width: 80px; height: 80px; position: relative; overflow: hidden;">
								<img id="imagePreview"
									style="position: absolute; left: 0px; top: 0px;"
									src="<?php
									
									if ($editar) {
										print "/goaamb/images/publi/thumb/" . $ml->imagen;
									} else {
										print "/goaamb/images/noimagen.png";
									}
									?>" />
							</div>
						</div>
						<img id="imagenAnuncioTipo11" src="/goaamb/images/noimagen.png"
							width="80" height="80" />
						<p id="textoAnuncioTipo11"><?php print $texto;?></p>
						<div style="clear: both;"></div>
					</div>

					<span class="verde"
						style="margin-top: 10px; display: block; margin-left: 0;"><?php
						
						print $_IDIOMA->traducir ( "Blinds preview:" );
						
						?></span>
					<div>
						<div id="previewAnuncioTipo12" style="display: block;">
							<div id="preview2"
								style="width: 80px; height: 80px; overflow: hidden; border: 1px solid black; margin-top: 5px; margin-left: 160px; position: absolute; background: white;">
								<div id="croppedPreview2"
									style="width: 80px; height: 80px; position: relative; overflow: hidden;">
									<img id="imagePreview2"
										style="position: absolute; left: 0px; top: 0px;"
										src="<?php
										
										if ($editar) {
											print "/goaamb/images/publi/thumb/" . $ml->imagen;
										} else {
											print "/goaamb/images/noimagen.png";
										}
										?>" />
								</div>
							</div>
							<img id="imagenAnuncioTipo12" src="/goaamb/images/noimagen.png"
								width="80" height="80" /> <span id="tituloAnuncioTipo12"><?php print $titulo;?></span><br />
							<br />
							<p id="textoAnuncioTipo12"><?php print $texto;?></p>
							<div style="clear: both;"></div>
						</div>
					</div>


					<form id="formEditor" action="/greader.php" method="post"
						target="iframeFakeAdvertisement" enctype="multipart/form-data">
						<input type="hidden" name="__q" value="proceso/anuncio" /><input
							type="hidden" name="__a" value="redimensionarImagen" /><input
							name="crop_width" id="crop_width" type="hidden" /><input
							name="crop_height" id="crop_height" type="hidden" /><input
							name="crop_offset_top" id="crop_offset_top" type="hidden" /><input
							name="crop_offset_left" id="crop_offset_left" type="hidden" /><input
							name="imagenEditor" id="imagenEditor" type="hidden" /><input
							name="imageWidth" id="imageWidth" type="hidden" /><input
							name="imageHeight" id="imageHeight" type="hidden" /><input
							name="imageWho" id="imageWho" type="hidden" />
					</form>

				</div>
			</div>

			<div
				style="display: none; float: left; margin-top: 10px; margin-left: 15px;"
				id="prosImage21">
				<span class="example"><?php
				
				print $_IDIOMA->traducir ( "Final Image" );
				
				?></span> <img id="imagenFinal5"
					style="display: none; border: 1px solid black;"
					onclick="editarImagen.call(this,5,this.getAttribute('rel'));" />
			</div>

			<div style="margin-top: 10px; float: right;<?php
			
			if ($editar) {
				print "display: none;";
			}
			?>" id="prosImage35">
				<span class="example" style="width: auto;"></span> <input
					id="buton5" onclick="guardarImagen('5');" type="button"
					class="bottomAdvert"
					value="<?php
					
					print $_IDIOMA->traducir ( "Send" );
					
					?>" />
			</div>


		</div>
		<span id="title21" class="verde"
			style="margin-top: 10px; <?php
			
			if (! $editar) {
				print "display: none;";
			}
			?>"><?php
			
			print $_IDIOMA->traducir ( "Preview in the right column:" );
			
			?></span>
		<div id="previewAnuncioTipo21" style="<?php
		
		if (! $editar) {
			print "display: none;";
		}
		?>">
			<span id="tituloAnuncioTipo21"><?php print $titulo;?></span> <img
				id="imagenAnuncioTipo21"
				src="<?php
				
				if ($editar) {
					print "/goaamb/images/publi/thumb/" . $ml->imagen;
				} else {
					print "/goaamb/images/noimagen.png";
				}
				?>"
				width="80" height="80" />
			<p id="textoAnuncioTipo21"><?php print $texto;?></p>
			<div style="clear: both;"></div>
		</div>
		<span id="title22" class="verde"
			style="margin-top: 10px; <?php
			
			if (! $editar) {
				print "display: none;";
			}
			?>"><?php
			
			print $_IDIOMA->traducir ( "Blinds preview:" );
			
			?></span>
		<div id="previewAnuncioTipo22" style="<?php
		
		if (! $editar) {
			print "display: none;";
		}
		?>">
			<img id="imagenAnuncioTipo22"
				src="<?php
				
				if ($editar) {
					print "/goaamb/images/publi/thumb/" . $ml->imagen;
				} else {
					print "/goaamb/images/noimagen.png";
				}
				?>"
				width="80" height="80" /> <span id="tituloAnuncioTipo22"><?php print $titulo;?></span><br />
			<br />
			<p id="textoAnuncioTipo22"><?php print $texto;?></p>
			<div style="clear: both;"></div>
		</div>
		<p>
			<input style="<?php
			
			if (! $editar) {
				print "display: none;";
			}
			?>" id="botonEdit"
				onclick="editarImagen.call(this,5,this.getAttribute('rel'));"
				type="button" class="bottomAdvert"
				value="<?php
				
				print $_IDIOMA->traducir ( "Edit" );
				
				?>" <?php
				
				if ($editar) {
					print "rel='$ml->imagen'";
				}
				?>/>
		</p>
		<hr class="verde" />

		<br />

		<p class="subtitulos"><?php
		
		print $_IDIOMA->traducir ( "3. Demographic and Geographic Data" );
		$paises = explode ( "::-::", $ml->paises );
		$jspaises = array_merge ( $paises, array () );
		for($i = 0; $i < count ( $jspaises ); $i ++) {
			$jspaises [$i] = "'" . $jspaises [$i] . "'";
		}
		?></p>
		<p class="parrafo"><?php
		
		print $_IDIOMA->traducir ( "Country/ies where your ad will be published:" );
		
		?></p>

		<label
			class="lblCHK <?php
			
			if ($editar && array_search ( "*", $paises ) !== false) {
				print "lblCHK2";
			}
			?>"
			for="allcountry"
			style="background-position: left 2px; padding-left: 0;"> <input
			type="checkbox" class="spCheck" id="allcountry"
			onclick="seleccionarTodosPaises.call(this)"
			<?php
			
			if ($editar && array_search ( "*", $paises ) !== false) {
				print "checked='checked'";
			}
			?> />

<?php

print $_IDIOMA->traducir ( "In all countries" );

?></label>
		<div id="specificCountry"
			<?php
			
			if ($editar && array_search ( "*", $paises ) !== false) {
				print "style='display:none;'";
			}
			?>>
			<p class="parrafo"><?php
			
			print $_IDIOMA->traducir ( "Country / is specific:" );
			
			?></p>
			<div class="capaBuscador">
				<div id="capaPaisesX"><?php
				if ($editar && array_search ( "*", $paises ) === false) {
					foreach ( $paises as $pais ) {
						if ($mlpais->buscarPorCampo ( array ("code2" => $pais ) )) {
							?><div class="capaPaises">
						<span class="nombre"><?php print $_IDIOMA->traducir($mlpais->country);?></span><span
							class="cerrar"
							onclick="eliminarPais.call(this, '<?php print $mlpais->code2;?>', 'X');">x</span>
					</div><?php
						}
					}
				}
				?></div>
				<input type="text"
					style="height: 22px; border: none; margin-left: 2px; width: 100px;"
					id="buscarPaisX" onkeyup="buscarPais.call(this,'X');" />
			</div><?php
			if ($editar) {
				?><script type="text/javascript">
		G.dom.$('capaPaisesX').arreglo=[<?php
				print implode ( ",", $jspaises );
				?>];</script><?php
			}
			?>
		</div>
		<hr />

		<span class="verde"><?php
		
		print $_IDIOMA->traducir ( "Age" );
		
		?></span>

		<div>
			<span class="verd"><?php
			
			print $_IDIOMA->traducir ( "From" );
			
			?></span><?php
			$arreglo = array ($_IDIOMA->traducir ( "Any Age" ) );
			$arreglo = array_merge ( $arreglo, range ( 12, 99 ) );
			$desde = new Select ( $arreglo, Select::SAMEVALUES, $ml->desde );
			$desde->onclick = "seleccionarDesde.call(this)";
			$desde->htmlprint ();
			?><span class="verd"><?php
			
			print $_IDIOMA->traducir ( "Until" );
			
			?></span><?php
			$desde = new Select ( $arreglo, Select::SAMEVALUES, $ml->hasta );
			$desde->onclick = "seleccionarHasta.call(this)";
			$desde->htmlprint ();
			?></div>

		<hr />
		<form>
			<span class="verde"><?php
			
			print $_IDIOMA->traducir ( "Sex" );
			
			?></span> <label class=""> <input type="radio" class=""
				name="sexoAnuncio1" onclick="seleccionarSexoTodos.call(this);"
				<?php
				if (! $editar || $ml->sexo == "*") {
					print 'checked="checked"';
				}
				?>
				style="top: 4px; position: relative;" />

<?php

print $_IDIOMA->traducir ( "All" );

?></label> <label class="" id="lblCHK1"> <input type="radio"
				name="sexoAnuncio1" class=""
				onclick="seleccionarSexoMasculino.call(this);"
				style="top: 4px; position: relative;"
				<?php
				if ($ml->sexo == "Masculino") {
					print 'checked="checked"';
				}
				?> />

<?php

print $_IDIOMA->traducir ( "Men" );

?></label> <label class="" id="lblCHK2"> <input type="radio"
				name="sexoAnuncio1" class=""
				onclick="seleccionarSexoFemenino.call(this);"
				style="top: 4px; position: relative;"
				<?php
				if ($ml->sexo == "Femeninos") {
					print 'checked="checked"';
				}
				?> />

<?php

print $_IDIOMA->traducir ( "Women" );

?></label>
		</form>
		<hr class="verde" />



		<p class="subtitulos"><?php
		
		print $_IDIOMA->traducir ( "4. Types of profiles to whom your ad will be displayed:" );
		$perfiles = explode ( "::-::", $ml->perfiles );
		?></p>

		<label
			class="lblCHK <?php
			if ($editar && array_search ( "*", $perfiles ) !== false) {
				print "lblCHK2";
			}
			?>"
			style="display: block; width: 100%;"> <input
			<?php
			if ($editar && array_search ( "*", $perfiles ) !== false) {
				print "checked='checked'";
			}
			?>
			id="allProfileType" type="checkbox" class="spCheck"
			onclick="seleccionarTodosPerfiles.call(this);"
			style="margin-left: -17px;" /><?php
			print $_IDIOMA->traducir ( "All profile type" );
			?></label>
<?php
$mlperfiles = ModelLoader::crear ( "ax_profile" );
$listaPerfiles = $mlperfiles->listar ( "activo='Si' order by orderProfile" );
$divm = new Tag ( "div" );
if ($editar && array_search ( "*", $perfiles ) !== false) {
	$divm->style = "display:none;";
}
$divm->add ( $div = new Tag ( "div", "", array ("style" => "float: left; width: 190px;" ) ) );
foreach ( $listaPerfiles as $i => $perfil ) {
	if ($i % 9 === 0 && $i !== 0) {
		$divm->add ( $div = new Tag ( "div", "", array ("style" => "float: left; width: 180px" ) ) );
	}
	$div->add ( $label = new Tag ( "label", $inpx = new Tag ( "input", "", array ("name" => "perfilesAnuncio1", "type" => "checkbox", "class" => "spCheck", "onclick" => "seleccionarPerfiles.call(this,'$perfil->idProfile');", "style" => "margin-left:-17px;" ) ), array ("class" => "lblCHK", "style" => "display:block;width:90%;" ) ) );
	if ($editar && array_search ( "" . $perfil->idprofile, $perfiles ) !== false) {
		$label->class = $label->class . " lblCHK2";
		$inpx->checked = "checked";
	}
	$label->add ( " " . $_IDIOMA->traducir ( $perfil->profile ) );
}
$divm->id = "capaPerfiles";
$divm->htmlprint ();
if ($editar) {
	?><script type="text/javascript">
	
	arregloPerfiles=["<?php print implode(",",$perfiles);?>"];
	</script><?php
}
?>




<hr class="verde" />



		<p class="subtitulos"><?php
		
		print $_IDIOMA->traducir ( "5. Define the Cost of Ad." );
		
		?></p>

		<p class="parrafo">

<?php

print $_IDIOMA->traducir ( "For your ad budget has three modes," );
?>

<br /> <span><?php

print $_IDIOMA->traducir ( "A. Cost per-click" );
?>
</span>

<?php
print $_IDIOMA->traducir ( " is when you are done click on your ad." );
?>

<br /> <span><?php

print $_IDIOMA->traducir ( "B. Total cost for screen printing," );
?>

</span>

<?php
print $_IDIOMA->traducir ( " or the times your ad is displayed." );
?>

<br /> <span><?php

print $_IDIOMA->traducir ( "C. For publication period" );
?>

</span>

<?php
print $_IDIOMA->traducir ( " is the time your ad appears on the network." );
?>

<br /> <br />

<?php

print $_IDIOMA->traducir ( "IMPORTANT: If you want to advertise in more than one mode and at the same time, you must create

another announcement once you have completed the process with some of the other two." );

?>

</p>



		<hr class="verde" />
<?php
$mlclick = ModelLoader::crear ( "ax_tarifa" );
$mlimpresion = ModelLoader::crear ( "ax_tarifa" );
$mltiempo = ModelLoader::crear ( "ax_tarifa" );
$mlclick->buscarPorCampo ( array ("tipo" => "Click" ) );
$mlimpresion->buscarPorCampo ( array ("tipo" => "Impresion" ) );
$mltiempo->buscarPorCampo ( array ("tipo" => "Tiempo" ) );
if (($editar && $ml->pagado == "No") || ! $editar) {
	
	?>
<p class="subtitulos">
			<a href="#" onclick="return verPorClick()"><?php
	
	print $_IDIOMA->traducir ( "6. Cost of Ad defined by quantities of Click." );
	
	?></a>
		</p>
		<div id="anuncioPorClick" style="<?php
	if ($editar && $ml->tipo_anuncio == "Click") {
		print "display: block;";
	} else {
		print "display: none;";
	}
	?>">
			<div style="width: 100%;">
				<span class="verde"
					style="float: right; margin: 0; margin-right: 50px;">

	<?php
	
	print $_IDIOMA->traducir ( "budget" );
	?>

	</span> <span class="verde"
					style="float: right; margin: 0; width: 118px;">

	<?php
	
	print $_IDIOMA->traducir ( "Click Limit

(Unit: 1,000)" );
	?>

	</span>
			</div>

			<div style="float: right; width: 518px; margin-bottom: 10px;">
				<span style="float: left; margin: 0; margin-top: 2px;">

	<?php
	
	print $_IDIOMA->traducir ( "Cost of Click / U.S. Dollar" );
	$cantidad = 500;
	if ($editar) {
		$cantidad = $ml->cantidad;
	}
	?></span>

				<div class="cost"><?php
	print round ( $mlclick->precio, 2 );
	?></div>

				<div class="time">
					<input type="text" class="calc" value="<?php print $cantidad;?>"
						id="cantidadClick" />
				</div>

				<div class="price">
					<input type="text" class="calc"
						value="<?php
	print ceil($mlclick->precio * $cantidad*10)/10 ;
	?>"
						id="totalClick" /> USD
				</div>

			</div>

			<div style="clear: both; width: 100%;"></div>

			<div class="Errormsgs"></div>

			<a style="text-transform: inherit;" class="bottomAdvert"
				href="javascript:;" onclick="revisarAnuncioTipo1();"><?php
	
	print $_IDIOMA->traducir ( "Ad Review" );
	
	?></a>
		</div>
		<hr class="verde" />

		<p class="subtitulos">
			<a href="#" onclick="return verPorImpresion()"><?php
	
	print $_IDIOMA->traducir ( "7. Define Cost per Total Ad Impressions." );
	
	?></a>
		</p>
		<div id="anuncioPorImpresion" style="<?php
	if ($editar && $ml->tipo_anuncio == "Impresion") {
		print "display: block;";
	} else {
		print "display: none;";
	}
	?>">
			<div style="width: 100%;">
				<span class="verde"
					style="float: right; margin: 0; margin-right: 50px;">

	<?php
	
	print $_IDIOMA->traducir ( "budget" );
	?>

	</span> <span class="verde"
					style="float: right; margin: 0; width: 118px;">

	<?php
	
	print $_IDIOMA->traducir ( "Impression Limit

(Unit: 1,000)" );
	?>

	</span>
			</div>

			<div style="float: right; width: 563px; margin-bottom: 10px;">
				<span style="float: left; margin: 0; margin-top: 2px;">

	<?php
	
	print $_IDIOMA->traducir ( "Cost of Printing / U.S. Dollar" );
	?></span>

				<div class="cost"><?php
	print round ( $mlimpresion->precio, 3 );
	$cantidad = 1000;
	if ($editar) {
		$cantidad = $ml->cantidad;
	}
	?></div>

				<div class="time">
					<input type="text" class="calc" value="<?php print $cantidad;?>"
						id="cantidadImpresion" />
				</div>

				<div class="price">
					<input type="text" class="calc"
						value="<?php
	
	print ceil($mlimpresion->precio * $cantidad*10)/10 ;
	?>"
						id="totalImpresion" /> USD
				</div>

			</div>

			<p class="parrafo" style="float: right; font-size: 10px;">

	<?php
	print $_IDIOMA->traducir ( "What is the maximum amount you spend per day? (The minimum is $ 1.00.)" );
	?>

	</p>

			<div style="clear: both; width: 100%;"></div>

			<div class="Errormsgs"></div>

			<a style="text-transform: inherit;" class="bottomAdvert"
				href="javascript:;" onclick="revisarAnuncioTipo1();"><?php
	
	print $_IDIOMA->traducir ( "Ad Review" );
	
	?></a>
		</div>
		<hr class="verde" />

		<p class="subtitulos">
			<a href="#" onclick="return verPorTiempo()"><?php
	
	print $_IDIOMA->traducir ( "8. Define Ad Cost by period of publication." );
	
	?></a>
		</p>
		<div id="anuncioPorTiempo" style="<?php
	if ($editar && $ml->tipo_anuncio == "Tiempo") {
		print "display: block;";
	} else {
		print "display: none;";
	}
	?>">
			<p class="parrafo"><?php
	
	print $_IDIOMA->traducir ( "Period starts from approving the ad within the post 72horas

Shipping and once reviewed and approved images and text will receive a confirmation email." );
	
	?></p>

			<div style="width: 100%;">
				<span class="verde"
					style="float: right; margin: 0; margin-right: 50px;">

	<?php
	
	print $_IDIOMA->traducir ( "budget" );
	?>

	</span>
			</div>

			<div style="float: right; width: 503px; margin-bottom: 10px;">
				<span style="float: left; margin: 0; margin-top: 2px;">

	<?php
	
	print $_IDIOMA->traducir ( "Cost per day / U.S. Dollar" );
	?></span>

				<div class="cost"><?php
	print round ( $mltiempo->precio, 2 );
	$cantidad = 20;
	if ($editar) {
		$cantidad = $ml->cantidad;
	}
	?> USD</div>

				<div class="time">
					<input type="text" class="calc" value="<?php print $cantidad;?>"
						id="cantidadTiempo" /> <span
						style="position: absolute; margin-left: -35px; margin-top: 3px;"><?php
	
	print $_IDIOMA->traducir ( "Days" );
	?></span>
				</div>

				<div class="price">
					<input type="text" class="calc"
						value="<?php
	
	print ceil($mltiempo->precio * $cantidad*10)/10 ;
	?>"
						id="totalTiempo" /> USD
				</div>

			</div>

			<div style="clear: both; width: 100%;"></div>

			<div class="Errormsgs"></div>

			<a style="text-transform: inherit;" class="bottomAdvert"
				href="javascript:;" onclick="revisarAnuncioTipo1();"><?php
	
	print $_IDIOMA->traducir ( "Ad Review" );
	
	?></a>
		</div>
		<?php

} else {
	?><a style="text-transform: inherit;" class="bottomAdvert"
			href="javascript:;" onclick="revisarAnuncioTipo1();"><?php
	print $_IDIOMA->traducir ( "Ad Review" );
	?></a><?php
}
?>
		<hr class="verde" />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
	</div>

</div>
<div id="footer"><?php
include ('footer.php');
?></div>

<div>


	<form action="/greader.php" method="post" id="formRevisarAnuncio"
		class="precio" target="iframeFakeAdvertisement"
		enctype="multipart/form-data"><?php if($editar){?><input type="hidden"
			name="id" value="<?php print $ml->id;?>" /><?php }?>
		<input type="hidden" name="__q" value="proceso/anuncio" /> <input
			type="hidden" name="__a" value="revisarAnuncioTipo1" /> <input
			type="hidden" name="imagen5"
			value="<?php if($editar){print $ml->imagen;}?>" /><input
			type="hidden" name="titulo"
			value="<?php if($editar){print $titulo;}?>" /> <input
			type="hidden" name="texto"
			value="<?php if($editar){print $texto;}?>" /><input type="hidden"
			name="url" value="<?php if($editar){print $ml->url;}?>" /> <input
			type="hidden" name="paises"
			value="<?php if($editar){print $ml->paises;}?>" /> <input
			type="hidden" name="desde"
			value="<?php if($editar){print $ml->desde;}?>" /> <input
			type="hidden" name="hasta"
			value="<?php if($editar){print $ml->hasta;}?>" /> <input
			type="hidden" name="sexo"
			value="<?php if($editar){print $ml->sexo;}else{print "*";}?>" /> <input type="hidden"
			name="perfiles" value="<?php if($editar){print $ml->perfiles;}?>" />
		<input type="hidden" name="tipo_anuncio"
			value="<?php if($editar){print $ml->tipo_anuncio;}?>" /> <input
			type="hidden" name="cantidad"
			value="<?php if($editar){print $ml->cantidad;}?>" />
	</form>
</div>

<iframe id="iframeFakeAdvertisement" name="iframeFakeAdvertisement"
	src="" style="display: none;" onload="procesarJSONAnuncio.call(this);"></iframe>

<script type="text/javascript">
var ifa=G.dom.$("iframeFakeAdvertisement");
ifa.onjsonready = formAnuncioReady;
ifa.who=5;
$(document).ready(function(){
	var srchOpt = $('.lblCHK');
	srchOpt.click(function() {
		$(this).toggleClass('lblCHK2');
	});	
});
function clsAcc(){
	$('#accountContent').fadeOut();
	$('#accountViewer').fadeOut('slow', function() {
		$('#accountViewer').html('');
		$('#accountContent').html('');
		$('#accountViewer').show();
  });
	$('#footMenu').show();
	$('#footMenuDos').show();
	$('#wall').show();
	$('#acountLeft').hide();
}

var cc=G.dom.$("cantidadClick");
if(cc){
cc.onkeypress=G.valid.int;
cc.onkeyup=function(){
	var total=0;
	var val=parseInt(this.value,10);
	if(!isNaN(val)){
		var total=(val*<?php
		print $mlclick->precio?>);
		total=Math.ceil(total*10)/10;
	}
	G.dom.$("totalClick").value=total;
};}
var tc=G.dom.$("totalClick");
if(tc){
tc.onkeypress=G.valid.float;
tc.onkeyup=function(){
	var total=0;
	var val=parseFloat(this.value.replace(",","."));
	if(!isNaN(val)){
		var total=Math.floor(val/<?php
		print $mlclick->precio?>);
	}
	G.dom.$("cantidadClick").value=total;
};}
var cp=G.dom.$("cantidadImpresion");
if(cp){
cp.onkeypress=G.valid.int;
cp.onkeyup=function(){
	var total=0;
	var val=parseInt(this.value,10);
	if(!isNaN(val)){
		var total=(val*<?php
		print $mlimpresion->precio?>);
		total=Math.ceil(total*10)/10;
	}
	G.dom.$("totalImpresion").value=total;
};}
var tp=G.dom.$("totalImpresion");
if(tp){
tp.onkeypress=G.valid.float;
tp.onkeyup=function(){
	var total=0;
	var val=parseFloat(this.value.replace(",","."));
	if(!isNaN(val)){
		var total=Math.floor(val/<?php
		print $mlimpresion->precio?>);
	}
	G.dom.$("cantidadImpresion").value=total;
};}
var ct=G.dom.$("cantidadTiempo");
if(ct){
ct.onkeypress=G.valid.int;
ct.onkeyup=function(){
	var total=0;
	var val=parseInt(this.value,10);
	if(!isNaN(val)){
		var total=(val*<?php
		print $mltiempo->precio?>);
		total=Math.ceil(total*10)/10;
	}
	G.dom.$("totalTiempo").value=total;
};}
var tt=G.dom.$("totalTiempo");
if(tt){
tt.onkeypress=G.valid.float;
tt.onkeyup=function(){
	var total=0;
	var val=parseFloat(this.value.replace(",","."));
	if(!isNaN(val)){
		var total=Math.floor(val/<?php
		print $mltiempo->precio?>,10);
	}
	G.dom.$("cantidadTiempo").value=total;
};}
$(".lblCHK").click(function(){
	 var chk=$(this).find("input[type=checkbox]");
	 if(chk.length>0){
	  chk=chk[0];
	  if(chk.checked){
	   $(this).addClass("lblCHK2");
	  }else{
	   $(this).removeClass("lblCHK2");
	  }
	 }
	});

<?php if(!$editar){?>
arregloPerfiles=[];
<?php }?>
tipoAnuncio1="<?php
if($editar){
	print $ml->tipo_anuncio;
} else{
	print "Click";
}
?>";
var errorAnuncionTipo11="<?php
print $_IDIOMA->traducir ( "Please enter some country." );
?>";
var errorAnuncionTipo12="<?php
print $_IDIOMA->traducir ( "Please select some profile type." );
?>";
var errorAnuncionTipo13="<?php
print $_IDIOMA->traducir ( "The link external o internal is required." );
?>";
var errorAnuncionTipo14="<?php
print $_IDIOMA->traducir ( "Validating url..." );
?>";
</script>
<?php
$listapaises = $mlpais->listar ( "1 order by country asc" );
$keys = array ();
$values = array ();
foreach ( $listapaises as $pais ) {
	$pais->country = $_IDIOMA->traducir ( $pais->country );
	$keys [] = $pais->code2;
	$values [] = $_IDIOMA->traducir ( $pais->country );
}
for($i = 0; $i < count ( $values ); $i ++) {
	for($j = $i + 1; $j < count ( $values ); $j ++) {
		if ($values [$i] > $values [$j]) {
			$auxv = $values [$i];
			$auxk = $keys [$i];
			$values [$i] = $values [$j];
			$keys [$i] = $keys [$j];
			$values [$j] = $auxv;
			$keys [$j] = $auxk;
		}
	}
}
$keys = array_merge ( array ("" ), $keys );
$values = array_merge ( array ($_IDIOMA->traducir ( "Select your Country" ) ), $values );
//$select = $mlpais->aSelect ( $listapaises, "listaPaises", "code2", "country", "", true, "Seleccione un pais" );
$select = new Select ( array_combine ( $keys, $values ), Select::KEYVALUES );
$select->id = "listaPaises";
$select->multiple = "multiple";
$select->style = "display:none;";
$select->onchange = "seleccionarPais.call(this)";
$select->htmlprint ( Tag::UTF8_ENCODE );

$mlfollower = ModelLoader::crear ( "ax_follower" );
if ($mlfollower->buscarPorCampo ( array ("id_user" => $_SESSION ["iSMuIdKey"] ) )) {
	$followers = unserialize ( $mlfollower->history_follower );
	$ul = new Tag ( "ul", "", array ("id" => "listaFollowers" ) );
	$mlaxgeneral = ModelLoader::crear ( "ax_generalRegister" );
	$ids = array ();
	$nombres = array ();
	$photos = array ();
	$followers ["id"] [] = $_SESSION ["iSMuIdKey"];
	foreach ( $followers ["id"] as $follower ) {
		if ($mlaxgeneral->buscarPorCampo ( array ("id" => $follower ) )) {
			$ids [] = $mlaxgeneral->id;
			$nombres [] = $mlaxgeneral->name . " " . $mlaxgeneral->lastname;
			$photos [] = "/photoGeneral/small/small_" . $mlaxgeneral->photo;
		}
	}
	for($i = 0; $i < count ( $nombres ); $i ++) {
		for($j = $i + 1; $j < count ( $nombres ); $j ++) {
			if ($nombres [$j] < $nombres [$i]) {
				$aux = $nombres [$i];
				$nombres [$i] = $nombres [$j];
				$nombres [$j] = $aux;
				$aux = $ids [$i];
				$ids [$i] = $ids [$j];
				$ids [$j] = $aux;
				$aux = $photos [$i];
				$photos [$i] = $photos [$j];
				$photos [$j] = $aux;
			}
		}
	}
	for($i = 0; $i < count ( $nombres ); $i ++) {
		$archivo = $photos [$i];
		if (! file_exists ( $_GBASE . $archivo )) {
			$archivo = "/photoGeneral/photoDefault.jpg";
		}
		$ul->add ( $li = new Tag ( "li", new Tag ( "img", "", array ("src" => $archivo, "width" => "50", "height" => "50" ) ), array ("onclick" => "seleccionarUsuario('" . $ids [$i] . "-" . Utilidades::normalizarTexto ( utf8_encode ( $nombres [$i] ) ) . "');", "rel" => str_replace ( "\"", "\\\"", $nombres [$i] ) ) ) );
		$li->add ( new Tag ( "span", $nombres [$i] ) );
	}
	$ul->id = "listaAmigos";
	$ul->style = "display:none;";
	$ul->htmlprint ( Tag::NOUTF8_ENCODE );
}

?>
