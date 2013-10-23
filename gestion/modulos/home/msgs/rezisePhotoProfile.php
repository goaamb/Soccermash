<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/gestion/lib/site_ini.php');
require_once $_GBASE . "/goaamb/idioma.php";
$editar = false;
$mlgr=ModelLoader::crear("ax_generalRegister");
$dir="/photoGeneral/big/";
if ($mlgr->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) )) {
	if(is_file($_GBASE.$dir.$mlgr->photo)){
		$editar=true;
	}
}
?>
<style type="text/css">
  hr.verde{
	background-color: #006225;
	height: 1px;
	width: 104%;
	margin-left: -10px;
	margin-top: 15px;
	margin-bottom: 15px;
	float: left;
}
  p.parrafo{
	font-family: Verdana;
	font-size: 11px;
	color:#4D4D4D;
	margin: 10px 0 10px 15px;
}
  p.subtitulos{
	color:#0C8141;
	font-family: Verdana;
	font-size: 11px;
}
 #alertEmergenteDatos span{
	font-family: Verdana;
	font-size: 11px;
	color:#4D4D4D;
	margin: 10px 0 10px 15px;
}
  input#nameanuncio{
	width: 425px;
}
  input#diranuncio{
	width: 507px
}
  input.verde{
	color:#0C8141;
}
  span.verde{
	color:#0C8141;
}
  .bottomSearchAdv{
	background-image: url(../img/botAdv.jpg);
	display: block;
	text-align: center;
	color: white !important;
	height: 19px;
	padding: 2px 20px 0;
	font-size: 12px !important;
	font-family: Verdana;
	width: 70px;
	float: left;
	margin-top: 5px;
	margin-left: 10px;
}
  .selImagen{
	margin-left: 15px;
	float: left;
	margin-top: 5px;
	width: 156px;
	background-color: transparent;
	border: 1px solid #E9E9E9;
}
  .prev11,  .prev12,  .prev13,
  .prev21,  .prev22,  .prev23,
  .prev31,  .prev32,  .prev33{
	width: 156px;
	height: 112px;
	border: 1px solid #E9E9E9;
	float: left;
	margin-right: 30px;
}
  .example{
	color: #0C8141;
	text-align: left;
	padding-bottom: 10px;
	margin: 0px;
	width: 120px;
	display: block;
}
  .prev11 div,  .prev21 div,  .prev31 div{
	background-image: url(../img/prev0.jpg);
	background-repeat: no-repeat;
	width: 106px;
	height: 79px;
	margin: 15px auto 0;
}
  .prev12 div{
	width: 60px;
	height: 25px;
	border: 1px solid #E9E9E9;
	margin: 42px auto 0;
}
  .prev13 div{
	width: 60px;
	height: 25px;
	margin: 42px auto 0;
	background-image: url(../img/prev1.jpg);
	background-repeat: no-repeat;
	background-position: center center;
}
  .prev22 div{
	width: 103px;
	height: 33px;
	border: 1px solid #E9E9E9;
	margin: 42px auto 0;
}
  .prev23 div{
	width: 103px;
	height: 33px;
	margin: 42px auto 0;
	background-image: url(../img/prev2.jpg);
	background-repeat: no-repeat;
	background-position: center center;
}
  .prev32 div{
	width: 45px;
	height: 45px;
	border: 1px solid #E9E9E9;
	margin: 34px auto 0;
}
  .prev33 div{
	width: 45px;
	height: 45px;
	margin: 42px auto 0;
	background-image: url(../img/prev3.jpg);
	background-repeat: no-repeat;
	background-position: center center;
}
  .requisitos{
	float: left;
	padding-left: 15px;
}
  .requisitos div{
	float: left;
	width: 190px;
}
  .requisitos div span{
	color: #0C8141;
	margin: 0;
}
  .requisitos div span span{
	font-family: Verdana;
	font-size: 11px;
	color: #4D4D4D;
	margin: 10px 0 10px 15px;
}
  .requisitos img{
	float: left;
	margin: 10px 0 15px;
}
  .requisitos .saveEditingP {
    color: #FFFFFF;
    font-size: 10px;
    height: 17px;
    margin-right: 3px;
    padding-top: 0;
    text-transform: capitalize;
    top: -6px;
    width: 60px;
    float: right;
}
  .yourAdvertisement{
	border-top: 1px solid #006225;
	padding: 10px 10px 10px 0px;
	margin-top: 10px;
	margin-left: 15px;
	text-align: left;
	float: left;
}
  .yourAdvertisement a{
	display: block;
	color:#000000;
	text-decoration: none;
	font-size: 12px;
	padding: 2px 0;
}
  .yourAdvertisement a:hover,  .yourAdvertisement a.active{
	color:#006225;
	text-decoration: none;
}
  .timeBar{
	border-left: 1px solid #B2B2B2;
	border-right: 1px solid #B2B2B2;
	float: left;
	width: 100%;
}
  .timeBar .start{
	margin: 0;
	font-size: 10px;
	float: left;
	color: black;
}
  .timeBar .end{
	float: right;
	margin: 0;
	font-size: 10px;
	color: black;
}
  .timeBar .bar{
	float: left;
	width: 100%;
	height: 19px;
	background-color: #E8E8E8;
	margin: 15px 0 0;
}
  .timeBar .bar .today{
	font-size: 12px;
	color: #006225;
	margin-top: 0;
	margin-bottom: 0;
	margin-left: 0;
	margin-right: 0;
	position: relative;
	top: -15px;
	left: -105px;
}
  .timeBar .bar div{
	background-image: url(../img/statV.jpg);
	background-position: 100% top;
	height: 19px;
	background-repeat: no-repeat;
	float: left;
	width: 80%;
	background-color: #5CAA7F;
}
  .timeBar .timeSlope{
	font-size: 10px;
	float: right;
	text-align: right;
	margin: 6px 3px 0 0px;
}
  .resumTitle{
	background-image: url(../img/statSummary.png);
	display: block;
	background-repeat: no-repeat;
	margin: 0;
	color: white;
	padding: 3px 0px 3px 15px;
	font-size: 12px;
}
  .resumen{
	border-top: 1px solid #B2B2B2;
}
  .resumen div{
	float: left;
	width: 190px;
}
  .resumen div span{
	display: block;
	font-size: 10px;
}
  .resumen div span.verde{
	font-size: 12px;
}
  .resumen table{
	width: 378px;
}
  .resumen table tbody tr th,  .resumen table tfoot tr td{
	color: #0C8141;
	font-weight: bold;
	padding: 10px 15px;
}
  .resumen table tbody tr td{
	color: #4D4D4D;
	font-size: 10px;
	padding: 5px 15px;
}
  .apply{
	background-image: url(../img/sortApply.jpg);
	background-repeat: no-repeat;
	display: block;
	width: 68px;
	height: 18px;
	color: white;
	font-size: 12px;
	text-align: center;
	padding-top: 2px;
	float: left;
}
.month{
	background-image: url(../img/sort1.png);
	background-repeat: no-repeat;
	float: left;
	display: block;
	padding-top: 2px;
	height: 18px;
	color: white;
	font-size: 12px;
	width: 89px;
	text-align: center;
	margin-left: 2px;
}
.week{
	background-image: url(../img/sort2.png);
	background-repeat: no-repeat;
	float: left;
	display: block;
	height: 18px;
	padding-top: 2px;
	font-size: 12px;
	color: white;
	text-align: center;
	width: 103px;
	margin-left: -9px;
}
.statSearch{
float: left;
height: 18px;
margin-right: 3px;
color: #4D4D4D;
font-size: 10px;
width: 80px;
background-color: transparent;
border: 1px solid #B2B2B2;
z-index: 100;
position: relative;
padding-left: 70px;
}
 .desd{
	color: #0C8141;
	font-size: 10px;
	text-transform: capitalize;
	background-image: url(../img/sortDate.png);
	background-repeat: no-repeat;
	position: absolute;
	left: 1px;
	background-position: right center;
	padding-right: 14px;
	margin-top: 3px;
	z-index: 10;
}
.hasta{
	color: #0C8141;
	font-size: 10px;
	text-transform: capitalize;
	background-image: url(../img/sortDate.png);
	background-repeat: no-repeat;
	position: absolute;
	left: 154px;
	background-position: right center;
	padding-right: 14px;
	margin-top: 3px;
	z-index: 10;
}
.print{
	font-size: 11px;
	color: #0C8141;
}
.clic{
	font-size: 11px;
	color: #FFAD3F;
}
#footer {
	position: initial;
	background-image: none;
	border: none;
	margin-top: 25px;
	width: 100%;
	clear: both;
}
#footMenu, #footMenuDos {
	left: 0;
	position: initial;
}
#availLang {
	bottom: 48px;
}
.ie #lang{
	position:relative;
}
.ie #availLang{
	bottom: 12px;
	left: 170px;
}
.saveEditingP{
	font-size: 12px;
}
#div-input-file {
	height: 28px;
	width: 415px;
	margin: 0px;
}

#div-input-file #imagen6-real{
	opacity: 0.0;
	width: 450px;
	height: 28px;
	-moz-opacity: 0.0;
	filter: alpha(opacity =                                         00);
	font-size: 18px;
	*z-index: 100000;
	*position: absolute;
	cursor: pointer;
}

#div-input-falso {
	margin-top: -28px;
	*margin-top: 0px;
}

#div-input-falso #imagen6{
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
<form action="/greader.php" method="post" id="formImagen6"
	target="iframeFakeAdvertisement" enctype="multipart/form-data"><input
	type="hidden" name="__q" value="proceso/photoprofile" /> <input
	type="hidden" name="__a" value="crearImagen1" /> <input name="imagedir"
	type="hidden"
	<?php
	if ($editar) {
		print "value='$mlgr->photo'";
	}
	?> />
<div id="div-input-file"><input type="file" id="imagen6-real"
	name="imagen-real" style="width: 100%;" onchange="procesarImagen.call(this.form,6);" />
<div id="div-input-falso"><input type="text" id="imagen6" name="imagen"
	class="selImagen" disabled="disabled" /><a class="bottomSearchAdv"
	href="javascript:;" onclick=""><?php
	print $_IDIOMA->traducir ( "Browse" );
	?></a></div>
</div>
<div id="cargando6" style="display:none;margin-top: -21px;position: relative;margin-left: 406px;"><img src="img/indicator.gif" width="16"/></div>
</form>
<div id="contenidoEditor6" style="margin-left: -20px;margin-top: 10px;width: 539px;"></div>
<div
	style="<?php
	if (! $editar) {
		print "display: none;";
	}
	?> float: left; margin-top: 10px; margin-left: 15px;"
	id="prosImage26"><span class="example"><?php
	print $_IDIOMA->traducir ( "Final Image Profile" );
	?></span> <img src="<?php
	if ($editar) {
		print "photoGeneral/big/" . $mlgr->photo;
	}
	?>" id="imagenFinal6"
	style="<?php
	if (! $editar) {
		print "display: none;";
	}
	?> border: 1px solid black;"
	onclick="editarImagen.call(this,6,this.getAttribute('rel'));" rel="<?php
	if ($editar) {
		print $mlgr->photo;
	}
	?>" /></div>
	<div
	style="<?php
	if (! $editar) {
		print "display: none;";
	}
	?> float: left; margin-top: 10px; margin-left: 15px;"
	id="prosImage26A"><span class="example"><?php
	print $_IDIOMA->traducir ( "Final Image Avatar" );
	?></span> <img src="<?php
	if ($editar) {
		print "photoGeneral/small/small_" . $mlgr->photo;
	}
	?>" id="imagenFinalA6"
	style="<?php
	if (! $editar) {
		print "display: none;";
	}
	?> border: 1px solid black;"
	onclick="editarImagen.call(this,6,this.getAttribute('rel'));" rel="<?php
	if ($editar) {
		print $mlgr->photo;
	}
	?>" /></div>
<div
	style="display: none;clear:both;align: right;margin-top: 40px;"
	id="prosImage36"><span class="example" style="width: auto;"></span> <input
	id="buton1" onclick="guardarImagen('6');" type="button"
	class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all"
	onmouseover="$('#buton1').addClass('ui-state-hover');"
	onmouseout="$('#buton1').removeClass('ui-state-hover');"
	value="<?php
	print $_IDIOMA->traducir ( "Send" );
	?>" /></div>
<div>
<div id="editorContenido" style="display: none;"><span class="example"
	style="width: auto;margin: 0;"><?php
	print $_IDIOMA->traducir ( "Resize your image" );
	?></span>
<div id="editor" style="width: 300px; height: 300px; float: left;">
<div id="crop_area" class="ui-widget-content"
	style="border: 1px solid black;"></div>
</div>
<div id="preview"
	style="overflow: hidden; border: 1px solid black; float: left; margin-top: 0; margin-left: 30px; width: 180px; height: 180px;">
<span class="example"
	style="margin-top: -23px; position: absolute; margin-left: -2px;"><?php
	print $_IDIOMA->traducir ( "Profile" );
	?></span>
<div id="croppedPreview"
	style="width: 180px; height: 180px; position: relative; overflow: hidden;"><img
	id="imagePreview" style="position: absolute; left: 0px; top: 0px;" /></div>
</div>
<div id="previewA"
	style="width: 50px; height: 50px; overflow: hidden; border: 1px solid black; float: left; margin-top: 205px; margin-left: -182px;">
<span class="example"
	style="margin-top: -23px; position: absolute; margin-left: -2px;"><?php
	print $_IDIOMA->traducir ( "Avatar" );
	?></span>
<div id="croppedPreviewA"
	style="width: 50px; height: 50px; position: relative; overflow: hidden;"><img
	id="imagePreviewA" style="position: absolute; left: 0px; top: 0px;" /></div>
</div>
<form id="formEditor" action="/greader.php" method="post"
	target="iframeFakeAdvertisement" enctype="multipart/form-data"><input
	type="hidden" name="__q" value="proceso/photoprofile" /><input type="hidden"
	name="__a" value="redimensionarImagen" /><input name="crop_width"
	id="crop_width" type="hidden" value="50"/><input name="crop_height"
	id="crop_height" type="hidden" value="50"/><input name="crop_offset_top"
	id="crop_offset_top" type="hidden" value="0"/><input name="crop_offset_left"
	id="crop_offset_left" type="hidden" value="0"/><input name="imagenEditor"
	id="imagenEditor" type="hidden" /><input name="imageWidth"
	id="imageWidth" type="hidden" /><input name="imageHeight"
	id="imageHeight" type="hidden" /><input name="imageWho" id="imageWho"
	type="hidden" /></form>
</div>
</div>

<form style="clear: both;float: right;" action="/greader.php" method="post" id="formRevisarAnuncio"
	target="iframeFakeAdvertisement" enctype="multipart/form-data"><input
	type="hidden" name="__q" value="proceso/photoprofile" /> <input
	type="hidden" name="__a" value="guardarMiPhoto" /> <input type="hidden"
	name="imagen6"
	value="<?php
	if ($editar) {
		print $mlgr->photo;
	}
	?>" />
<div id="Errormsgs"></div>
<a style="text-transform: inherit;width: 125px;padding: 2px 5px 0;" class="bottomSearchAdv"
	href="javascript:;" onclick="revisarPhotoProfile();"><?php
	print $_IDIOMA->traducir ( "Close" );
	?></a>

</form>
<iframe id="iframeFakeAdvertisement" name="iframeFakeAdvertisement"
	src="" style="display: none;" onload="procesarJSONAnuncio.call(this);"></iframe>
<script type="text/javascript">
G.dom.$("iframeFakeAdvertisement").onjsonready = formAnuncioReady;
</script>
<div style="clear:both;width: 90%;"></div>