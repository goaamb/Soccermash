<?php
$gbase = '/goaamb/bd.php';
$dbase = dirname ( __FILE__ );
$file = $dbase . $gbase;
while ( trim ( $dbase ) !== "" && ! is_file ( $file ) ) {
	$dbase = dirname ( $dbase );
	$file = $dbase . $gbase;
}
if (is_file ( $file )) {
	$_GBASE = $dbase;
	require_once $_GBASE . "/gestion/lib/site_ini.php";
	require_once $file;
	?>
<script type="text/javascript" src="goaamb/js/G.js"></script>
<style>
#form-anuncio {
	font-family: arial;
	font-size: 10px;
}

#form-anuncio table {
	font-size: 11px;
}

#anuncio-preview {
	width: 183px;
	padding: 5px;
	background: white;
	border: 1px solid #026127;
	float: left;
}

#titulo-anuncio {
	color: #026127;
	font-weight: bold;
	padding-bottom: 3px;
	display: block;
}

.contenedor #imagen-anuncio {
	float: left;
	padding: 5px 5px 5px 0px;
	width: 80px;
}

#loading-preview {
	display: none;
}
#hintHelp{
	display:none;
	padding:10px;
	border:1px solid #026127;
	background: white;
	position:absolute;
}
</style>
<script type="text/javascript">
function jsonProccess(){
	var c=this.contentWindow.document;
	if (c) {
		var b = G.dom.$$$("body", 0, c);
		if (b) {
			var json;
			try {
				eval("json=" + b.innerHTML);
				if (this.onjsonready) {
					this.onjsonready(json);
				}
			} catch (e) {

			}
		}
	}
	return true;
}

function formAnuncioReady(json){
	if(json){
		if(json.titulo){
			G.dom.$("titulo-anuncio").innerHTML=json.titulo;
		}
		if(json.texto){
			G.dom.$("texto-anuncio").innerHTML=json.texto;
		}
		if(json.imgdir){
			G.dom.$("imagen-anuncio").src="goaamb/images/publi/thumb/"+json.imgdir;
			var f=G.dom.$("form-anuncio");
			if(f){
				f.imgdir.value=json.imgdir;
				f.imagen.value="";
			}
		}
	}
	G.dom.$("loading-preview").style.display="none";
	G.dom.$("anuncio-preview").style.display="block";
}
G.util.ready(function(){
	G.dom.$("iframefake").onjsonready=formAnuncioReady;
	var f=G.dom.$("form-anuncio");
	if(f){
		f.url.onchange=function(){
			G.dom.$("loading-preview").style.display="block";
			G.dom.$("anuncio-preview").style.display="none";
			this.form.submit();
		};
		f.titulo.onchange=f.url.onchange;
		f.texto.onchange=f.url.onchange;
		f.imagen.onchange=function(){
			this.form.imgdir.value="";
			this.form.url.onchange();
		};
	}
});
</script>
<form id="form-anuncio" action="ajaxpublicidad.php" method="post"
	target="iframefake" enctype="multipart/form-data"><input name="__accion"
	value="ingresarAnuncio" type="hidden" /> <input name="imgdir" value=""
	type="hidden" />
<table>
	<tr>
		<td>URL:</td>
		<td><input name="url" /></td>
	</tr>
	<tr>
		<td>Título:</td>
		<td><input name="titulo" /></td>
	</tr>
	<tr>
		<td>Texto:</td>
		<td><textarea name="texto"></textarea></td>
	</tr>
	<tr>
		<td>Imagen:</td>
		<td><input name="imagen" type="file" /></td>
	</tr>
	<tr>
		<td valign="top">Vista Previa:</td>
		<td>
		<div id="anuncio-preview"><span id="titulo-anuncio">Título Anuncio de
		ejemplo</span>
		<div class="contenedor"><img id="imagen-anuncio"
			src="goaamb/images/noimagen.png" />
		<div id="texto-anuncio">El texto del anuncio va aquí.</div>
		</div>
		</div>
		<div id="loading-preview"><img src="goaamb/images/loading.gif"
			alt="loading" /></div>
		</td>
	</tr>
</table>
</form>
<div id="hintHelp"></div>
<iframe src="" onload="return jsonProccess.call(this);" name="iframefake" 
	style="display: none;" id="iframefake"></iframe><?php
}
?>