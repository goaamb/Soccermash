<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/gestion/lib/site_ini.php');
?><span class="verde"><?php
print $_IDIOMA->traducir ( "If you've been able to create an Ad delSPONSOR (type 2), please enter the code here:" );
?></span>
<br />
<form action="/greader.php" method="post" target="iFrameFakeCodigo"><input
	type="hidden" name="__q" value="proceso/anuncio" /> <input
	type="hidden" name="__a" value="verificarCodigo" />
<div id="Errormsgs" style="color: red; display: none;">Codigo
erroneo,contacte con el administrador.</div>
<div class="frmAdvIns"><input type="text" id="codigo" name="codigo" /></div>
<input type="submit" id="butonE"
	class="saveEditingP ui-button ui-widget ui-state-default ui-corner-all"
	onmouseover="$('#butonE').addClass('ui-state-hover');"
	onmouseout="$('#butonE').removeClass('ui-state-hover');" value="Send" /></form>
<iframe id="iFrameFakeCodigo" name="iFrameFakeCodigo"
	onload="procesarJSONAnuncio.call(this);" style="display: none;"></iframe>
<script type="text/javascript">G.dom.$("iFrameFakeCodigo").onjsonready=formCodigoReady;</script>
<div style="clear: both;"></div>