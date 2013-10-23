<link href="css/advertisement.css" rel="stylesheet" type="text/css" />

<?php
require_once ('../../lib/site_ini.php');
require_once ('../../lib/share/clases/class_site.inc.php');
$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
$lista = $ml->listar ( "anunciante='" . $_SESSION ["iSMuIdKey"] . "' order by fecha_inicio desc,titulo asc" );
$dirg = "/goaamb/images/publi/thumb/";
?><div id="closing" onclick="clsAcc();"
	title="<?php
	print $_IDIOMA->traducir ( "Close" );
	?>"></div>
<div id="content">
<div id="main">
<h5><?php
print $_IDIOMA->traducir ( "Estadísiticas de tus anuncios" );
?></h5>
<p class="parrafo"><?php print $_IDIOMA->traducir("Here you can see according to budget
eltiempo remaining for the completion of your campaigns. as well as
alsothe number of clicks and / or impressions that you have your advert
enSOCCERMASH.com and thus take control of your campaigns.")?></p>
<br />
<hr />
<br />
<span class="verde" style="font-weight: bold;"><?php print $_IDIOMA->traducir("Your Ads:")?></span>
<div style="clear: both; width: 100%"></div>
<div class="yourAdvertisement"><?php
if (count ( $lista ) > 0) {
	foreach ( $lista as $i => $anuncio ) {
		?><a <?php
		if ($i == 0) {
			print "class='active'";
		}
		?>
	id="aAnuncio<?php
		print $anuncio->id;
		?>" href="javascript:;"
	onclick="verAnuncio(<?php
		print $anuncio->id;
		?>)"><?php
		print ($i + 1) . ". " . $anuncio->titulo;
		?></a><?php
	}
} else {
	print $_IDIOMA->traducir("You do not have ads");
}
?></div>
<div style="clear: both; width: 100%"></div>
<hr /><?php
if (count ( $lista ) > 0) {
	$anuncio = $lista [0];
	$ahora = time ();
	$inicio = strtotime ( $anuncio->fecha_inicio );
	$fin = strtotime ( $anuncio->fecha_fin . " 23:59:59" );
	?><br />
<div class="timeBar"><span class="start" id="anunciofecha_inicio"><?php
	print date ( "d/m/Y", $inicio );
	?></span> <span class="end" id="anunciofecha_fin"><?php
	print date ( "d/m/Y", $fin );
	?></span><?php
	$resto = $fin - $ahora;
	$dias = intval ( $resto / (24 * 60 * 60) );
	$horas = intval ( ($resto / (60 * 60)) % 24 );
	$minutos = ($resto / (60 * 24)) % 60;
	$total = $fin - $inicio;
	$presto = $ahora - $inicio;
	$presto = ceil ( $presto * 568 / $total ); //568 el tamaño total de la barra	
	$izqt = - 105;
	if ($presto + $izqt < 0) {
		$izqt = 0;
	}
	?><div class="bar"><span class="today" style="left:<?php
	print $izqt;
	?>px;" id="anuncioahora">hoy: <?php
	print date ( "d/m/Y", $ahora );
	?></span>
<div style="width:<?php
	print $presto;
	?>px;"></div>
</div>
<span class="timeSlope">TIEMPO PENDIENTE:<br /><?php
	
	print "<span id='anunciodias'>$dias</span> ".$_IDIOMA->traducir("days")." - <span id='anunciohoras'>$horas</span> ".$_IDIOMA->traducir("hours")." - <span id='anunciominutos'>$minutos</span> ".$_IDIOMA->traducir("minutes")?></span></div>
<div style="clear: both; width: 100%"></div>
<hr />
<br />
<span class="resumTitle"><?php print $_IDIOMA->traducir("Summary")?></span>
<div class="resumen">
<div><span class="verde" style="font-weight: bold;"><?php print $_IDIOMA->traducir("Time")?></span> <span><?php print $_IDIOMA->traducir("From")?>
el <em id="anunciofecha_inicio2"><?php
	print date ( "d/m/Y", $inicio );
	?></em> </span><span><?php print $_IDIOMA->traducir("to")?> <em id="anunciofecha_fin2"><?php
	print date ( "d/m/Y", $inicio );
	?></em> </span><span><?php print $_IDIOMA->traducir("Left")?>: </span><span> <em id="anunciodias2"><?php
	print $dias;
	?></em> <?php print $_IDIOMA->traducir("days")?> </span><span> <em id="anunciohoras2"><?php
	print $horas;
	?></em> <?php print $_IDIOMA->traducir("hours")?> </span><span> <em id="anunciominutos2"><?php
	print $minutos;
	?></em> <?php print $_IDIOMA->traducir("minutes")?></span></div>
<table cellpadding="3" cellspacing="0" border="1" bordercolor="#B2B2B2">
	<tbody>
		<tr>
			<th><?php print $_IDIOMA->traducir("Country/s")?></th>
			<th><?php print $_IDIOMA->traducir("Prints")?></th>
			<th><?php print $_IDIOMA->traducir("Clicks")?></th>
		</tr>
		<tr>
			<td>Panamá</td>
			<td>125.254</td>
			<td>125.254</td>
		</tr>
		<tr>
			<td>Colombia</td>
			<td>232.555</td>
			<td>32.555</td>
		</tr>
		<tr>
			<td>Bolivia</td>
			<td>212.211</td>
			<td>22.211</td>
		</tr>
		<tr>
			<td>Ecuador</td>
			<td>122.266</td>
			<td>1.266</td>
		</tr>
		<tr>
			<td>Honduras</td>
			<td>85.655</td>
			<td>855</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td>Total</td>
			<td>974.567</td>
			<td>189.586</td>
		</tr>
	</tfoot>
</table>
</div>
<div style="clear: both; width: 100%"></div>
<hr />
<br />
<div id="anuncioEstadisticaGrafico" style="display:none;">
<input class="statSearch" name="start" id="start" /> <span class="desd"><?php print $_IDIOMA->traducir("from")?></span><input
	class="statSearch" name="end" id="end" /> <span class="hasta"><?php print $_IDIOMA->traducir("to")?></span><a
	class="apply" href="javascript:;"><?php print $_IDIOMA->traducir("Apply")?></a> <a class="month"
	href="javascript:;"><?php print $_IDIOMA->traducir("Month")?></a> <a class="week" href="javascript:;"><?php print $_IDIOMA->traducir("Week")?></a>
<div style="clear: both; width: 100%; height: 10px"></div>
<img src="img/statG.jpg">
<div style="clear: both; width: 100%; height: 20px"></div>
<label style="margin-left: 15px;" class="lblCHK" id="mmans1"><input
	class="spCheck" type="checkbox" /><span class="print"><?php print $_IDIOMA->traducir("Prints")?>________</span></label>
<br />
<br />
<label style="margin-left: 15px;" class="lblCHK" id="mmans1"><input
	class="spCheck" type="checkbox" /><span class="clic"><?php print $_IDIOMA->traducir("Clicks")?> ________</span></label>
</div>
<hr />
<div
	style="float: left; border-right: 1px solid #E9E9E9; padding: 0 10px 0 14px"><span
	class="verde" style="margin: 0px;"><?php print $_IDIOMA->traducir("1. Ad on page LOGIN")?></span><br />
<br />
<br />
<br />
<br />
<div class="prev12" style="margin: 0px; float: none;">
<div><?php
	$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $anuncio->imagen1;
	if (is_file ( $archivo )) {
		?><img src="<?php
		print $dirg . $anuncio->imagen1;
		?>"
	id="anuncioimagen1" /><?php
	}
	?></div>
</div>
<br />
<br />
<img src="img/advertismentT201.jpg" /></div>
<div
	style="float: left; border-right: 1px solid #E9E9E9; padding: 0 10px 0 14px;"><span
	class="verde" style="margin: 0px;"><?php print $_IDIOMA->traducir("2. Notice of publication")?><br />
<?php print $_IDIOMA->traducir("above the search engine and")?><br />
<?php print $_IDIOMA->traducir("below the menu bar.")?></span> <br />
<br />
<br />
<div class="prev22" style="margin: 0px; float: none;">
<div><?php
	$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $anuncio->imagen2;
	if (is_file ( $archivo )) {
		?><img src="<?php
		print $dirg . $anuncio->imagen2;
		?>"
	id="anuncioimagen2" /><?php
	}
	?></div>
</div>
<br />
<br />
<img src="img/advertismentT202.jpg" /></div>
<div style="float: left; padding: 0 10px 0 14px;"><span class="verde"
	style="margin: 0px;"><?php print $_IDIOMA->traducir("3. Notice of publication")?><br />
<?php print $_IDIOMA->traducir("permanent in column")?><br />
<?php print $_IDIOMA->traducir("right, below advertise type 1")?></span> <br />
<br />
<div class="prev32" style="margin: 0px; float: none;">
<div><?php
	$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $anuncio->imagen3;
	if (is_file ( $archivo )) {
		?><img src="<?php
		print $dirg . $anuncio->imagen3;
		?>"
	id="anuncioimagen3" /><?php
	}
	?></div>
</div>
<br />
<br />
<img src="img/advertismentT203.jpg" /></div><?php
}
?>
<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
<div style="clear: both; width: 100%"></div>
</div>
</div>
<div id="footer">
          <?php
										include ('footer.php');
										?>
</div>
<!--END footer-->
<script type="text/javascript">
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
</script>