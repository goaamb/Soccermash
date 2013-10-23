<?php
require_once 'gbase.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script type="text/javascript"
	src="<?php
	print $_GBASE;
	?>/goaamb/js/G.js"></script>
<script type="text/javascript"
	src="<?php
	print $_GBASE;
	?>/goaamb/js/publicidad.js"></script>
<link rel="stylesheet" href="/goaamb/css/publicidad.css" type="text/css" />
</head>
<body>
<div id="contenidoAnuncio"></div>
<iframe id="iframeFake" name="iframefake"
	onload="procesarJSONAnuncio.call(this);" style="display: none;"></iframe>
<script type="text/javascript">
G.dom.$("iframeFake").onjsonready=formAdmAnuncioReady;
recargarPaginaAnuncio();
var errorAnuncioTipo25="Activo";
var errorAnuncioTipo26="Actualizando...";
</script>
</body>
</html>