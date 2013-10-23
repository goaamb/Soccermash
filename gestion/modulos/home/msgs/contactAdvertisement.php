<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/gestion/lib/site_ini.php');
$mlgr = ModelLoader::crear ( "ax_generalRegister" );
if (isset ( $_SESSION ["iSMuIdKey"] ) && $mlgr->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) )) {
	
	?>
<br />

<br />

<br />

<span class="verde"><?php
	print $_IDIOMA->traducir ( "Create an ad for the type SPONSOR, please
See plans and rates by sending a message to our agents." )?></span>

<br />
<form id="formularioAnuncioTipo2" action="/greader.php" method="post"
	target="iframeFakeFormulario"><input type="hidden" name="__q"
	value="proceso/anuncio" /> <input type="hidden" name="__a"
	value="ingresarFormulario" />
<div id="Errormsgs" style="color: red; display: none;"><?php
	print $_IDIOMA->traducir ( "You must fill all fields." )?></div>

<div class="frmAdvCon"><span><?php
	print $_IDIOMA->traducir ( "First Name" )?></span><input type="text"
	id="nombre" name="nombre" value="<?php
	print $mlgr->name;
	?>" /> <span><?php
	print $_IDIOMA->traducir ( "Last Name" )?></span><input type="text"
	id="apellidos" name="apellidos"
	value="<?php
	print $mlgr->lastname;
	?>" /> <span><?php
	print $_IDIOMA->traducir ( "Company" )?></span><input type="text"
	id="compania" name="compania" /> <span><?php
	print $_IDIOMA->traducir ( "Address" )?></span><input type="text"
	id="direccion" name="direccion" /> <span><?php
	print $_IDIOMA->traducir ( "Telephone" )?></span><input type="text"
	id="extencion" name="extencion" /><input type="text" id="telefono"
	name="telefono" /> <span><?php
	print $_IDIOMA->traducir ( "Comments" )?></span><textarea
	id="comentario" name="comentario"></textarea>

<div style="clear: both;"></div>

</div>

<input type="submit" id="butonE"
	class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all"
	onmouseover="$('#butonE').addClass('ui-state-hover');"
	onmouseout="$('#butonE').removeClass('ui-state-hover');"
	value="<?php
	print $_IDIOMA->traducir ( "Send" );
	?>" /></form>
<iframe name="iframeFakeFormulario" id="iframeFakeFormulario"
	onload="procesarJSONAnuncio.call(this)" style="display: none;"></iframe>
<script type="text/javascript">
G.dom.$("iframeFakeFormulario").onjsonready=formFormularioReady;
</script>
<div style="clear: both;"></div><?php
}
?>