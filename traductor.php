<?php
require_once "gbase.php";
$mltraduccion = ModelLoader::crear ( "ax_traduccion" );
$mlidioma = ModelLoader::crear ( "ax_language" );
$npag = 50;
$inicio = 0;
$pagina = 0;
if (isset ( $_GET ["p"] )) {
	$pagina = intval ( $_GET ["p"] );
}
$inicio = $pagina * $npag;
$where = "1";
if (isset ( $_GET ["filtro"] )) {
	$filtro=str_replace("'", "\\'", $_GET ["filtro"]);
	$where = "original like '%$filtro%'";
}
$condicion = "$where group by original order by original asc";
$listaoriginales = $mltraduccion->listar ( $condicion, $inicio, $npag );
$tabla = $mltraduccion->aTabla ( $listaoriginales, array ("id", "language", "traduccion", "traducido", "hash" ) );
if ($tabla->getTag () == "table") {
	$tabla->addHead ( "Ingles" );
	$tabla->addHead ( "Español" );
	$tabla->addHead ( "Portugues" );
	$tabla->addHead ( "Aleman" );
	$tabla->addHead ( "Frances" );
	$tabla->addHead ( "Chino" );
	$tabla->addHead ( "Griego" );
	$tabla->addHead ( "Arabe" );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/css; charset=utf-8" />
<script type="text/javascript" src="goaamb/js/G.js"></script>
<script type="text/javascript" src="goaamb/js/traductor.js"></script>
<link href="goaamb/css/traductor.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<form method="get">
		Texto a Buscar en el campo Original<input name="filtro"
			value="<?php
			if (isset ( $_GET ["filtro"] )) {
				print $_GET ["filtro"];
			}
			?>" /> <input type="submit" value="buscar" />
	</form>
<?php
function addColumnTraduccion($i, $mltraduccion, $tabla, $item, $language) {
	$texto = $item->original;
	if ($mltraduccion->buscarPorCampo ( array ("hash" => $item->hash, "language" => $language ) )) {
		$texto = $mltraduccion->traduccion;
	}
	if ($language != 79 && $language != 25 && $language != 20) {
		$col = $tabla->addColumn ( htmlentities ( utf8_decode ( $texto ) ), $i );
	} else {
		$col = $tabla->addColumn ( $texto, $i );
	}
	$col->valign = "top";
	$col->onclick = "editar.call(this,'$item->hash','$language')";
}

foreach ( $listaoriginales as $i => $item ) {
	addColumnTraduccion ( $i, $mltraduccion, $tabla, $item, "2" );
	addColumnTraduccion ( $i, $mltraduccion, $tabla, $item, "4" );
	addColumnTraduccion ( $i, $mltraduccion, $tabla, $item, "24" );
	addColumnTraduccion ( $i, $mltraduccion, $tabla, $item, "1" );
	addColumnTraduccion ( $i, $mltraduccion, $tabla, $item, "23" );
	addColumnTraduccion ( $i, $mltraduccion, $tabla, $item, "79" );
	addColumnTraduccion ( $i, $mltraduccion, $tabla, $item, "20" );
	addColumnTraduccion ( $i, $mltraduccion, $tabla, $item, "25" );
}
$tabla->border = "1";
$tabla->cellpadding = "5";
$total = $conexion->seleccionarAsociado ( "(select id from ax_traduccion where $condicion) as t", array ("count(1) as total" ) );
if ($total && isset ( $total [0] ) && isset ( $total [0] ["total"] )) {
	$total = $total [0] ["total"];
} else {
	$total = 0;
}
if ($total > $npag) {
	$ul = new Tag ( "ul" );
	$tpag = ceil ( $total / $npag );
	for($i = 0; $i < $tpag; $i ++) {
		$class = "";
		if ($i == $pagina) {
			$class = "activo";
		}
		$ul->add ( new Tag ( "li", new Tag ( "a", $i + 1, array ("href" => "#", "onclick" => "location.href=G.url._setGET('p','$i');return false;", "class" => $class ) ) ) );
	}
	$ul->htmlprint ();
}
$tabla->htmlprint ();
if ($total > $npag) {
	$ul->htmlprint ();
}
?><form id="editor" action="greader.php" method="post"
		target="iframefake" style="display: none;">
		<input type="hidden" name="__q" value="proceso/traductor" /> <input
			type="hidden" name="__a" value="guardar" /> <input type="hidden"
			name="hash" value="" /> <input type="hidden" name="language" value="" />
		<textarea name="traduccion" rows="10"></textarea>
		<input type="submit" value="Guardar" /> <input type="button"
			value="Cancelar" onclick="resetForm.call(this.form);" />
	</form>
	<iframe name="iframefake" id="iframefake" style="display: none;"
		onload="return processJSON.call(this)"></iframe>
</body>
</html>