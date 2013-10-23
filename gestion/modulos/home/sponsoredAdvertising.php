<?php
require_once $_GBASE . '/goaamb/anuncio.php';
$ma2 = ModelLoader::crear ( "ax_anuncioTipo2" );
$pais = Idioma::darCodigo2AlfaPais ( Idioma::darIP () );
$lista = $ma2->listar ( "activo='Si' and paises like '%$pais%' order by rand()", 0, 3 );
if (count ( $lista ) > 0) {
	$dirg = "/goaamb/images/publi/thumb/";
	?><span>
<p class="greyTitles paddingRC"><?php
	print $_IDIOMA->traducir ( "Sponsor" )?></p>
<hr /><?php
	foreach ( $lista as $anuncio ) {
		$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $anuncio->imagen3;
		if (is_file ( $archivo )) {
			Anuncio::insertarEstadisticaAnuncioTipo2 ( $anuncio, "Impresion", 3 );
			?><div style="padding: 5px; float: left;"><?php
			Anuncio::imprimirAnuncioTipo2 ( $anuncio, 3 );
			?></div><?php
		}
	}
	?></span><?php
}
?>