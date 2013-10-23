<?php
require_once $_GBASE . '/goaamb/anuncio.php';
$ma2 = ModelLoader::crear ( "ax_anuncioTipo2" );
$pais = Idioma::darCodigo2AlfaPais ( Idioma::darIP () );
$lista = $ma2->listar ( "activo='Si' and paises like '%$pais%' order by rand()", 0, 1 );
if (count ( $lista ) > 0) {
	$dirg = "/goaamb/images/publi/thumb/";
	foreach ( $lista as $anuncio ) {
		$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $anuncio->imagen2;
		if (is_file ( $archivo )) {
			Anuncio::insertarEstadisticaAnuncioTipo2 ( $anuncio, "Impresion", 2 );
			?><div style="padding:12px 56px 11px 56px;"><?php
			Anuncio::imprimirAnuncioTipo2 ( $anuncio, 2 );
			?></div><?php
		}
	}
} else {
	?><span><?
	print $_IDIOMA->traducir ( "Welcome to the premier social 
						network for professional soccer
						players!!! For all of us!!!" );
	?></span><?php
}
?>