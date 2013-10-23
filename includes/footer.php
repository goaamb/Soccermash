<div id="foot1">
<div id="footSponsors">
<ul><?php
require_once $_GBASE . '/goaamb/anuncio.php';
$ma2 = ModelLoader::crear ( "ax_anuncioTipo2" );
$pais = Idioma::darCodigo2AlfaPais ( Idioma::darIP () );
$lista = $ma2->listar ( "activo='Si' and paises like '%$pais%' order by rand()", 0, 4 );
if (count ( $lista ) > 0) {
	$dirg = "/goaamb/images/publi/thumb/";
	foreach ( $lista as $anuncio ) {
		$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $anuncio->imagen1;
		if (is_file ( $archivo )) {
			Anuncio::insertarEstadisticaAnuncioTipo2 ( $anuncio, "Impresion", 1 );
			?><li><?php
			Anuncio::imprimirAnuncioTipo2 ( $anuncio, 1 );
			?></li><?php
		}
	}
}
?>
</ul>
</div>
<div id="footMenu">
<ul>
	<li><a class="openlegal" onclick="openlegal();" href="#"><?
	print $_IDIOMA->traducir ( "Legal notice" );
	?></a></li>
	<!--  <li><a class="openhelp" href="#"><?
	print $_IDIOMA->traducir ( "Help" );
	?></a></li> -->
	<!--  <li><a href="#">Developers </a></li> -->
	<!--  <li><a href="#">Blog</a></li> -->
	<!--  <li><a href="#">Press</a></li> -->
	<!-- <li><a href="mailto:soccermash@soccermash.com"><?
	print $_IDIOMA->traducir ( "Advertise" );
	?></a></li> -->
	<!--  <li><a href="#">Jobs</a></li>-->
	<li><a id="openabout" onclick="openabout();" href="#"><?
	print $_IDIOMA->traducir ( "About" );
	?></a></li>
	<!--  <li><a href="#">Mobile</a></li>-->
</ul>
</div>
</div>
<!--End foot1-->
<hr />
<div id="foot2">
<div id="copy"><span>SOCCERMASH &copy; <?
echo date ( 'Y' )?></span></div>

<div id="lang">
<p><a id="language"><?
print $_IDIOMA->traducir ( "Choose your language" );
?></a></p>
<ul id="listOfLanguages">
	<li><a href="?lang=en-US">English</a></li>
	<li><a href="?lang=es-ES">Espa&ntilde;ol</a></li>
	<li><a href="?lang=pt-PT">Portugu&ecirc;s</a></li>
</ul>
<!--<div id="chooseLanguage">
              </div>--></div>

</div>
<!--End foot2-->
