<?php
require_once ('../../lib/site_ini.php');

require_once ('../../lib/share/clases/class_site.inc.php');
$mlf = ModelLoader::crear ( "ax_formularioAnuncioTipo2" );
$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
$editar = false;
if (isset ( $_POST ["id"] ) && $ml->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
	$editar = true;
	$_POST ["codigo"] = $ml->codigo;
}
if (isset ( $_POST ["codigo"] ) && $mlf->buscarPorCampo ( array ("id" => $_POST ["codigo"], "anunciante" => $_SESSION ["iSMuIdKey"], "estado" => "Activo" ) ) && (! $ml->existePorCampo ( array ("codigo" => $mlf->id ) ) || $editar)) {
	?><link href="css/advertisement.css" rel="stylesheet" type="text/css" /><?php
	
	?><div id="closing" onclick="clsAcc();"
	title="<?php
	print $_IDIOMA->traducir ( "Close" );
	?>"></div>
<div id="content">
<div id="main">
<h5><?php
	print $_IDIOMA->traducir ( "Crear anuncio" );
	?></h5>
<p class="parrafo"><?php
	print $_IDIOMA->traducir ( "Here you can create your ad. Please follow
carefully the following steps. Make sure your logos
conform to the requirements of each of the 3 different formats prior
sending each image. Remember, the kit including the
ads consists of 3 images with different formats. So
we can proceed more quickly to the revision and publication of
his campaign." );
	?></p>

<br />

<p class="subtitulos"><?php
	print $_IDIOMA->traducir ( "1. Place your ad title." );
	?></p>

<p class="parrafo"><?php
	print $_IDIOMA->traducir ( "Give a name to your post, so you
identify your campaigns." );
	?></p>

<span>Nombre del anuncio: </span> <input type="text" name="nameanuncio"
	id="nameanuncio"
	onchange="G.dom.$('formRevisarAnuncio').titulo.value=this.value"
	<?php
	if ($editar) {
		print "value='$ml->titulo'";
	}
	?> /> <br />

<br />

<hr class="verde" />

<br />

<p class="subtitulos"><?php
	print $_IDIOMA->traducir ( "2. Ad on page LOGIN" );
	?></p>

<p class="parrafo"><?php
	print $_IDIOMA->traducir ( "This image appears on the page, both
for registered users as not registered according to the source
Your IP is, their country of origin. For example, if a user
connecting from Japan and you have a contract in this country, only appear
for advertisers to connect from there." );
	?> <br />
<br />

<?php
	print $_IDIOMA->traducir ( "This is a space that will be shared with other advertisers
had scheduled the announcement time. It will only be visible
for users who connect to SOCCERMASH.com in countries
ruled in your contract." );
	?> <br />
<br />

<?php
	print $_IDIOMA->traducir ( "Upload your image and attach it as the format following the example of
the right. Once you consider to be correct and similar to the example
according to the specified format and color click Send." );
	?></p>
<div class="requisitos">
<div><span><?php
	print $_IDIOMA->traducir ( "Requirements:" );
	?></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "1. Logo background:" );
	?> <br />
<span><?php
	print $_IDIOMA->traducir ( "White" );
	?></span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "2. The logo in gray:" );
	?> <br />
<span>#999999</span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "3. Dimensions:" );
	?> <br />
<span><?php
	print $_IDIOMA->traducir ( "60 pixels wide." );
	?> <br />
&nbsp;&nbsp;&nbsp;<?php
	print $_IDIOMA->traducir ( "25 pixels high.." );
	?></span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "4. File type:" );
	?> <br />
<span>.jpg</span></span></div>
</div>

<div style="float: left"><span class="example"> <?php
	print $_IDIOMA->traducir ( "Example" );
	?> </span>
<div class="prev13">
<div></div>
</div>
</div>
<div style="float: left"><span class="example"> <?php
	print $_IDIOMA->traducir ( "Context" );
	?> </span> <img src="img/advertismentT201.jpg" /></div>

<span class="verde"
	style="clear: both; display: block; margin-bottom: 0; padding-top: 30px;"><?php
	print $_IDIOMA->traducir ( "Upload your image:" );
	?> </span>
<style type="text/css">
#div-input-file {
	height: 28px;
	width: 385px;
	margin: 0px;
}

#div-input-file #imagen1-real,#div-input-file #imagen2-real,#div-input-file #imagen3-real
	{
	opacity: 0.0;
	-moz-opacity: 0.0;
	filter: alpha(opacity =                                         00);
	font-size: 18px;
	*z-index: 100000;
	*position: absolute;
}

#div-input-falso {
	margin-top: -28px;
	*margin-top: 0px;
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
</style>
<form action="/greader.php" method="post" id="formImagen1"
	target="iframeFakeAdvertisement" enctype="multipart/form-data"><input
	type="hidden" name="__q" value="proceso/anuncio" /> <input
	type="hidden" name="__a" value="crearImagen1" /> <input name="imagedir"
	type="hidden"
	<?php
	if ($editar) {
		print "value='$ml->imagen1'";
	}
	?> />
<div id="div-input-file"><input type="file" id="imagen1-real"
	name="imagen-real" onchange="procesarImagen.call(this.form,1);" />
<div id="div-input-falso"><input type="text" id="imagen1" name="imagen"
	class="selImagen" disabled="disabled" /><a class="bottomSearchAdv"
	href="javascript:;" onclick=""><?php
	print $_IDIOMA->traducir ( "Browse" );
	?></a></div>
</div>
<div id="cargando1"
	style="display: none; margin-top: -21px; position: relative; margin-left: 300px;"><img
	src="img/indicator.gif" width="16" /></div>
</form>
<div id="contenidoEditor1" style="margin-left: 15px; margin-top: 10px;"></div>
<div
	style="<?php
	if (! $editar) {
		print "display: none;";
	}
	?> float: left; margin-top: 10px; margin-left: 15px;"
	id="prosImage21"><span class="example"><?php
	print $_IDIOMA->traducir ( "Final Image" );
	?></span> <img src="<?php
	if ($editar) {
		print "/goaamb/images/publi/thumb/" . $ml->imagen1;
	}
	?>" id="imagenFinal1"
	style="<?php
	if (! $editar) {
		print "display: none;";
	}
	?> border: 1px solid black;"
	onclick="editarImagen.call(this,1,this.getAttribute('rel'));" rel="<?php
	if ($editar) {
		print $ml->imagen1;
	}
	?>" /></div>
<div
	style="display: none; float: left; margin-top: -10px; margin-left: 40px;"
	id="prosImage31"><span class="example" style="width: auto;"></span> <input
	id="buton1" onclick="guardarImagen('1');" type="button"
	class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all"
	onmouseover="$('#buton1').addClass('ui-state-hover');"
	onmouseout="$('#buton1').removeClass('ui-state-hover');"
	value="<?php
	print $_IDIOMA->traducir ( "Send" );
	?>" /></div>

<hr class="verde" />
<br />
<p class="subtitulos"><?php
	print $_IDIOMA->traducir ( "3. Ad on home page" );
	?></p>

<p class="parrafo"><?php
	print $_IDIOMA->traducir ( "Image that appears alternately with news
internal network in all the pages that navigate the user. this
space will be shared with other advertisers and distributed in
equal the number of impressions, ie the time that the
mark appears on page aprecerá equally for all
users." );
	?> <br />
<br />

<?php
	print $_IDIOMA->traducir ( "It will only be visible to users who connect to
SOCCERMASH.com in countries previously ruled by the contract and
during the stipulated time." );
	?></p>

<div class="requisitos">
<div><span><?php
	print $_IDIOMA->traducir ( "Requirements:" );
	?></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "1. Logo background:" );
	?> <br />
<span><?php
	print $_IDIOMA->traducir ( "Must be" );
	?> #c4c3c4</span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "2. The gray logo:" );
	?> <br />
<span><?php
	print $_IDIOMA->traducir ( "White Color" );
	?></span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "3. Dimensions:" );
	?> <br />
<span><?php
	print $_IDIOMA->traducir ( "103 pixels wide." );
	?> <br />
&nbsp;&nbsp;&nbsp;<?php
	print $_IDIOMA->traducir ( "33 pixels high." );
	?></span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "4. File Type:" );
	?> <br />
<span>.jpg</span></span></div>
</div>

<div style="float: left"><span class="example"> <?php
	print $_IDIOMA->traducir ( "Example" );
	?> </span>
<div class="prev23">
<div></div>
</div>
</div>
<div style="float: left"><span class="example"> <?php
	print $_IDIOMA->traducir ( "Context" );
	?> </span> <img src="img/advertismentT202.jpg" /></div>

<span class="verde"
	style="clear: both; display: block; margin-bottom: 0; padding-top: 30px;"><?php
	print $_IDIOMA->traducir ( "Upload your image:" );
	?> </span>

<form action="/greader.php" method="post" id="formImagen2"
	target="iframeFakeAdvertisement" enctype="multipart/form-data"><input
	type="hidden" name="__q" value="proceso/anuncio" /> <input
	type="hidden" name="__a" value="crearImagen1" /> <input name="imagedir"
	type="hidden"
	<?php
	if ($editar) {
		print "value='$ml->imagen2'";
	}
	?> />
<div id="div-input-file"><input type="file" id="imagen2-real"
	name="imagen-real" onchange="procesarImagen.call(this.form,2);" />
<div id="div-input-falso"><input type="text" id="imagen2" name="imagen"
	class="selImagen" disabled="disabled" /><a class="bottomSearchAdv"
	href="javascript:;" onclick=""><?php
	print $_IDIOMA->traducir ( "Browse" );
	?></a></div>
</div>
<div id="cargando2"
	style="display: none; margin-top: -21px; position: relative; margin-left: 300px;"><img
	src="img/indicator.gif" width="16" /></div>
</form>
<div id="contenidoEditor2" style="margin-left: 15px; margin-top: 10px;"></div>
<div
	style="<?php
	if (! $editar) {
		print "display: none;";
	}
	?> float: left; margin-top: 10px; margin-left: 15px;"
	id="prosImage22"><span class="example"><?php
	print $_IDIOMA->traducir ( "Final Image" );
	?></span> <img src="<?php
	if ($editar) {
		print "/goaamb/images/publi/thumb/" . $ml->imagen2;
	}
	?>" id="imagenFinal2"
	style="<?php
	if (! $editar) {
		print "display:none;";
	}
	?> border: 1px solid black;"
	onclick="editarImagen.call(this,2,this.getAttribute('rel'));" rel="<?php
	if ($editar) {
		print "$ml->imagen2";
	}
	?>" /></div>
<div
	style="display: none; float: left; margin-top: -10px; margin-left: 40px;"
	id="prosImage32"><span class="example" style="width: auto;"></span> <input
	onclick="guardarImagen('2');" type="button" id="buton2"
	class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all"
	onmouseover="$('#buton2').addClass('ui-state-hover');"
	onmouseout="$('#buton2').removeClass('ui-state-hover');"
	value="<?php
	print $_IDIOMA->traducir ( "Send" );
	?>" /></div>
<hr class="verde" />

<p class="subtitulos"><?php
	print $_IDIOMA->traducir ( "4. Permanent release announcement column
right under the advertising type 1." );
	?></p>

<p class="parrafo"><?php
	print $_IDIOMA->traducir ( "Image is permanently displayed on all
pages of the users identified with the country of the ad." );
	?> <br />
<br />

<?php
	print $_IDIOMA->traducir ( "It will only be visible to users who connect to
SOCCERMASH.com in countries previously ruled by the contract and
during the stipulated time. So if the pattern is hired by
example in Spain, the logo will only appear to users in Spain." );
	?></p>

<div class="requisitos">
<div><span><?php
	print $_IDIOMA->traducir ( "Requirements:" );
	?></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "1. Logo background:" );
	?> <br />
<span><?php
	print $_IDIOMA->traducir ( "Must be" );
	?> #F2F2F2</span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "2. The gray Logo:" );
	?> <br />
<span>#999999</span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "3. Dimensions:" );
	?> <br />
<span><?php
	print $_IDIOMA->traducir ( "45 pixels wide." );
	?> <br />
&nbsp;&nbsp;&nbsp;<?php
	print $_IDIOMA->traducir ( "45 pixels high." );
	?></span></span> <br />
<br />

<span><?php
	print $_IDIOMA->traducir ( "4. File type:" );
	?> <br />
<span>.jpg</span></span></div>
</div>

<div style="float: left"><span class="example"> <?php
	print $_IDIOMA->traducir ( "Example" );
	?> </span>
<div class="prev33">
<div></div>
</div>
</div>
<div style="float: left"><span class="example"> <?php
	print $_IDIOMA->traducir ( "Context" );
	?> </span> <img src="img/advertismentT203.jpg" /></div>

<span class="verde"
	style="clear: both; display: block; margin-bottom: 0; padding-top: 30px;"><?php
	print $_IDIOMA->traducir ( "Upload your image:" );
	?> </span>

<form action="/greader.php" method="post" id="formImagen3"
	target="iframeFakeAdvertisement" enctype="multipart/form-data"><input
	type="hidden" name="__q" value="proceso/anuncio" /> <input
	type="hidden" name="__a" value="crearImagen1" /> <input name="imagedir"
	type="hidden"
	<?php
	if ($editar) {
		print "value='$ml->imagen3'";
	}
	?> />
<div id="div-input-file"><input type="file" id="imagen3-real"
	name="imagen-real" onchange="procesarImagen.call(this.form,3);" />
<div id="div-input-falso"><input type="text" id="imagen3" name="imagen"
	class="selImagen" disabled="disabled" /><a class="bottomSearchAdv"
	href="javascript:;" onclick=""><?php
	print $_IDIOMA->traducir ( "Browse" );
	?></a></div>
</div>
<div id="cargando3"
	style="display: none; margin-top: -21px; position: relative; margin-left: 300px;"><img
	src="img/indicator.gif" width="16" /></div>
</form>
<div id="contenidoEditor3" style="margin-left: 15px; margin-top: 10px;"></div>
<div
	style="<?php
	if (! $editar) {
		print "display: none;";
	}
	?> float: left; margin-top: 10px; margin-left: 15px;"
	id="prosImage23"><span class="example"><?php
	print $_IDIOMA->traducir ( "Final Image" );
	?></span> <img src="<?php
	if ($editar) {
		print "/goaamb/images/publi/thumb/" . $ml->imagen3;
	}
	?>" id="imagenFinal3"
	style="<?php
	if (! $editar) {
		print "display:none;";
	}
	?>;border : 1px solid black;"
	onclick="editarImagen.call(this,3,this.getAttribute('rel'));" rel="<?php
	if ($editar) {
		print "$ml->imagen3";
	}
	?>" /></div>
<div
	style="display: none; float: left; margin-top: -10px; margin-left: 40px;"
	id="prosImage33"><span class="example" style="width: auto;"></span> <input
	onclick="guardarImagen('3');" type="button" id="buton3"
	class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all"
	onmouseover="$('#buton3').addClass('ui-state-hover');"
	onmouseout="$('#buton3').removeClass('ui-state-hover');"
	value="<?php
	print $_IDIOMA->traducir ( "Send" );
	?>" /></div>
<hr class="verde" />
<form action="/greader.php" method="post" id="formRevisarAnuncio"
	target="iframeFakeAdvertisement" enctype="multipart/form-data"><input
	type="hidden" name="__q" value="proceso/anuncio" /> <input
	type="hidden" name="__a" value="revisarAnuncio" /> <input type="hidden"
	name="imagen1"
	value="<?php
	if ($editar) {
		print $ml->imagen1;
	}
	?>" /> <input type="hidden" name="imagen2"
	value="<?php
	if ($editar) {
		print $ml->imagen2;
	}
	?>" /> <input type="hidden" name="imagen3"
	value="<?php
	if ($editar) {
		print $ml->imagen3;
	}
	?>" /><input type="hidden" name="titulo"
	value="<?php
	if ($editar) {
		print $ml->titulo;
	}
	?>" /> <input type="hidden" name="codigo"
	value="<?php
	print $mlf->id;
	?>" />
	<?php
	if ($editar) {
		?><input type="hidden" name="id" value="<?php
		print $ml->id;
		?>" /><?php
	}
	?>
<div id="Errormsgs"></div>
<a style="text-transform: inherit;" class="bottomAdvert"
	href="javascript:;" onclick="revisarAnuncio();"><?php
	print $_IDIOMA->traducir ( "Ad Review" );
	?></a></form>
</div>

</div>

<div id="footer">

          <?php
	include ('footer.php');
	?>

</div>
<!--END footer-->





<div>
<div id="editorContenido" style="display: none;"><span class="example"
	style="width: auto;"><?php
	print $_IDIOMA->traducir ( "Resize your image" );
	?></span>
<div id="editor" style="width: 300px; height: 300px; float: left;">
<div id="crop_area" class="ui-widget-content"
	style="border: 1px solid black;"></div>
</div>
<div id="preview"
	style="width: 60px; height: 25px; overflow: hidden; border: 1px solid black; float: left; margin-top: 0px; margin-left: 25px;">
<span class="example"
	style="margin-top: -23px; position: absolute; margin-left: -2px;"><?php
	print $_IDIOMA->traducir ( "Final Image" );
	?></span>
<div id="croppedPreview"
	style="width: 60px; height: 25px; position: relative; overflow: hidden;"><img
	id="imagePreview" style="position: absolute; left: 0px; top: 0px;" /></div>
</div>
<form id="formEditor" action="/greader.php" method="post"
	target="iframeFakeAdvertisement" enctype="multipart/form-data"><input
	type="hidden" name="__q" value="proceso/anuncio" /><input type="hidden"
	name="__a" value="redimensionarImagen" /><input name="crop_width"
	id="crop_width" type="hidden" /><input name="crop_height"
	id="crop_height" type="hidden" /><input name="crop_offset_top"
	id="crop_offset_top" type="hidden" /><input name="crop_offset_left"
	id="crop_offset_left" type="hidden" /><input name="imagenEditor"
	id="imagenEditor" type="hidden" /><input name="imageWidth"
	id="imageWidth" type="hidden" /><input name="imageHeight"
	id="imageHeight" type="hidden" /><input name="imageWho" id="imageWho"
	type="hidden" /></form>
</div>
</div>
<iframe id="iframeFakeAdvertisement" name="iframeFakeAdvertisement"
	src="" style="display: none;" onload="procesarJSONAnuncio.call(this);"></iframe>
<script type="text/javascript">
G.dom.$("iframeFakeAdvertisement").onjsonready = formAnuncioReady;
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
var errorAnuncioTipo21="Debe colocar una imagen en este apartado";
var errorAnuncioTipo22="Debe colocar un titulo";
var errorAnuncioTipo23="Debe colocar todas las imagen";
var errorAnuncioTipo24="Debe colocar una imagen";
var errorAnuncioTipo25="Activo";
var errorAnuncioTipo26="Actualizando...";
</script>
<?php
} else {
	header ( "location:/gestion/modulos/home/advertisementHome.php" );
}
?>