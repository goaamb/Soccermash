<script type="text/javascript" src="/goaamb/js/jscharts.js"></script>
<link href="css/advertisement.css" rel="stylesheet" type="text/css" /><?php
require_once ('../../lib/site_ini.php');
require_once ('../../lib/share/clases/class_site.inc.php');
$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
$lista = $ml->listar ( "anunciante='" . $_SESSION ["iSMuIdKey"] . "' and eliminado='No' order by fecha_inicio desc,titulo asc" );
$dirg = "/goaamb/images/publi/thumb/";
?>
<style>
#content #main .resumen span {
	margin: 0px;
	font-size: 1em;
}
</style>
<div id="closing" onclick="clsAcc();"
	title="<?php
	print $_IDIOMA->traducir ( "Close" );
	?>"></div>
<div id="content">
	<div id="main">

		<h5><?php
		print $_IDIOMA->traducir ( "Advertise type 1" );
		?></h5>



		<p class="parrafo">
<?php
print $_IDIOMA->traducir ( "Manage your ads. Here you can see according to budget the amountof clicks and / or impressions have your listings and so keep track of your campaigns." );
?>
</p>

		<br />

		<hr />

		<br />
<?php
if (count ( $lista ) > 0) {
	$anuncio = $lista [0];
	?>
<div class="previewend">

			<div>
				<span class="title" id="anunciotitulo"><?php
	print utf8_encode ( $anuncio->titulo );
	?></span> <?php
	$url = $anuncio->url;
	$url = explode ( "::--::", $url );
	if (count ( $url ) > 0) {
		switch ($url [0]) {
			case "http2" :
				?><span class="verde"><?php
				print "http://www.soccermash.com/" . $_IDIOMA->traducir ( "user" ) . "/" . $url [1];
				?></span><?php
				break;
			default :
				?><span class="verde" id="anunciourl"><?php
				print "http://" . $url [1];
				?></span><?php
				
				break;
		}
	}
	?> <img src="<?php
	print $dirg . $anuncio->imagen;
	?>"
					id="anuncioimagen" />

				<p id="anunciotexto"><?php
	print utf8_encode ( $anuncio->texto );
	?></p>

			</div>

		</div>

		<span class="verde"
			style="font-weight: bold; width: 50%; float: left;"><?php
	print $_IDIOMA->traducir ( "Your Ad:" )?></span>

		<div class="yourAdvertisement">
			<table>
				<tbody><?php
	foreach ( $lista as $i => $anunciol ) {
		?><tr>
						<td><a
							class="<?php
		if ($i == 0) {
			print "active";
		}
		?>"
							id="aAnuncio<?php
		print $anunciol->id;
		?>"
							href="javascript:;"
							onclick="verAnuncioTipo1('<?php
		print $anunciol->id;
		?>')"> <?php
		print ($i + 1) . ". " . utf8_encode ( $anunciol->titulo );
		if ($anunciol->activo === "No") {
			print "( " . $_IDIOMA->traducir ( "Inactive" ) . " )";
		}
		?> </a></td>
						<td><?php
		
		if ($anunciol->pagado == "No" && $anunciol->activo == "No") {
			?><a href="#"
							onclick="editarAnuncioTipo1(<?php print $anunciol->id; ?>);return false;"><img
								src="/goaamb/iconos/pencil.png" /></a><?php
		}
		?></td>
						<td><?php
		
		if ($anunciol->pagado == "No" && $anunciol->activo == "No") {
			?><a href="#"
							onclick="pagarAnuncioTipo1(<?php print $anunciol->id; ?>);return false;"><img
								src="/goaamb/iconos/cart.png" /></a><?php
		}
		?></td>
						<td><a href="#"
							onclick="eliminarAnuncioTipo1X(<?php print $anunciol->id; ?>);return false;"><img
								src="/goaamb/iconos/delete.png" /></a></td>
					</tr><?php
	}
	?></tbody>
			</table>
		</div>

		<div style="clear: both; width: 100%"></div>

		<hr />

		<br /> <span class="resumTitle"><?php
	print $_IDIOMA->traducir ( "Summary" );
	?></span>

		<div class="resumen">

			<table style="width: auto;" cellpadding="3" cellspacing="0"
				border="0" width="100%">

				<thead>
					<th style="border-right: 1px solid #B2B2B2"><?php
	print $_IDIOMA->traducir ( "Profile Type/s" )?></th>
					<th style="border-right: 1px solid #B2B2B2"><?php
	print $_IDIOMA->traducir ( "Country/s" )?></th>
					<th style="border-right: 1px solid #B2B2B2"><?php
	print $_IDIOMA->traducir ( "Gender" )?></th>
					<th style="border-right: 1px solid #B2B2B2"><?php
	print $_IDIOMA->traducir ( "Age" )?></th>
					<th><?php
	print $_IDIOMA->traducir ( "Ad Type" )?></th>
				</thead>
				<tbody>
					<tr>

						<td valign="top" style="border-right: 1px solid #B2B2B2"
							id="anuncioperfiles"><?php
	$perfiles = explode ( "::-::", $anuncio->perfiles );
	if (count ( $perfiles ) > 0) {
		if ($perfiles [0] === "*") {
			print $_IDIOMA->traducir ( "All Profile types" );
			?><br /><?php
		} else {
			$mlperfil = ModelLoader::crear ( "ax_profile" );
			foreach ( $perfiles as $perfil ) {
				if ($mlperfil->buscarPorCampo ( array ("idprofile" => $perfil ) )) {
					print $_IDIOMA->traducir ( $mlperfil->profile );
					?><br /> <br /><?php
				}
			}
		}
	}
	?></td>
						<td valign="top" style="border-right: 1px solid #B2B2B2"
							id="anunciopaises"><?php
	$paises = explode ( "::-::", $anuncio->paises );
	if (count ( $paises ) > 0) {
		if ($paises [0] === "*") {
			print $_IDIOMA->traducir ( "All Countrys" );
			?><br /> <br /><?php
		} else {
			$mlpais = ModelLoader::crear ( "ax_country" );
			foreach ( $paises as $pais ) {
				if ($mlpais->buscarPorCampo ( array ("code2" => $pais ) )) {
					print $_IDIOMA->traducir ( $mlpais->country );
					?><br /> <br /><?php
				}
			}
		}
	}
	?></td>
						<td valign="top" style="border-right: 1px solid #B2B2B2"
							id="anunciosexo"><?php
	switch ($anuncio->sexo) {
		case "*" :
			print $_IDIOMA->traducir ( "Todos" );
			break;
		default :
			print $anuncio->sexo;
			break;
	}
	?></td>
						<td valign="top" style="border-right: 1px solid #B2B2B2"><span
							id="anunciodesde"><?php print $_IDIOMA->traducir("From")?> <?php
	if (! $anuncio->desde) {
		print $_IDIOMA->traducir ( "Any age" );
	} else {
		print $anuncio->desde;
	}
	?></span> <?php print $_IDIOMA->traducir("to")?> <span
							id="anunciohasta"><?php
	if (! $anuncio->hasta) {
		print $_IDIOMA->traducir ( "Any age" );
	} else {
		print $anuncio->hasta;
	}
	?></span></td>
						<td><span class="verde"><?php
	print $_IDIOMA->traducir ( "Type:" )?></span> <span
							id="anunciotipo_anuncio"><?php
	switch ($anuncio->tipo_anuncio) {
		case "Impresion" :
			print $_IDIOMA->traducir ( "View" );
			break;
		case "Tiempo" :
			print $_IDIOMA->traducir ( "Time" );
			break;
		default :
			print $_IDIOMA->traducir ( "Click" );
			break;
	}
	?></span><br /> <span class="verde"><?php
	print $_IDIOMA->traducir ( "Amount:" );
	?></span> <span id="anunciocantidad"><?php
	print $anuncio->cantidad;
	?></span><br /> <span class="verde"><?php
	print $_IDIOMA->traducir ( "Cost:" );
	?></span> <span id="anunciocosto"><?php
	print $anuncio->costo;
	?> USD</span></td>
					</tr>



				</tbody>

			</table>

		</div>

		<div style="clear: both; width: 100%"></div>

		<hr />

		<br /> <span class="resumTitle"><?php
	print $_IDIOMA->traducir ( "Stats" );
	
	$mlstat = ModelLoader::crear ( "ax_estadisticaAnuncioTipo1" );
	$listas = $mlstat->seleccionar ( array ("count(1) as seccion,pais,tipo" ), "anuncio='$anuncio->id' group by pais,tipo" );
	$stat = array ();
	foreach ( $listas as $value ) {
		if (! isset ( $stat [$value->pais] )) {
			$stat [$value->pais] = array ("click" => 0, "impresion" => 0 );
		}
		if ($value->tipo == "Impresion") {
			$stat [$value->pais] ["impresion"] = $value->seccion;
		}
		if ($value->tipo == "Click") {
			$stat [$value->pais] ["click"] = $value->seccion;
		}
	}
	?></span>
		<div class="resumen">
			<table>
				<thead>
					<tr>
						<th><?php print $_IDIOMA->traducir("Country")?></th>
						<th><?php print $_IDIOMA->traducir("Prints")?></th>
						<th><?php print $_IDIOMA->traducir("Clicks")?></th>
					</tr>
				</thead>
				<tbody id="tablaAnuncioTipo1"><?php
	$mlpais = ModelLoader::crear ( "ax_country" );
	if (count ( $stat ) > 0) {
		foreach ( $stat as $pais => $datos ) {
			if ($mlpais->buscarPorCampo ( array ("code2" => $pais ) )) {
				?><tr>
						<td><?php print $_IDIOMA->traducir($mlpais->country);?></td>
						<td><?php print $datos["impresion"];?></td>
						<td><?php print $datos["click"];?></td>
					</tr><?php
			}
		}
	} else {
		?><tr>
						<td colspan="3" align="center"><?php print $_IDIOMA->traducir("No stat data.");?></td>
					</tr><?php
	}
	?></tbody>

			</table>
		</div>
		<hr />

		<br />
		<div>
			<input class="statSearch" name="start" id="startAd" /> <span
				class="desd"><?php print $_IDIOMA->traducir("from");?></span> <input
				class="statSearch" name="end" id="endAd" /> <span class="hasta"><?php print $_IDIOMA->traducir("to");?></span>
			<a class="apply" href="javascript:;" onclick="statChange();">Aplicar</a>
			<?php
	/*?>
			<a class="month" href="javascript:;"
				onclick="tipoActivo='dia';statChange();"><?php print $_IDIOMA->traducir("Day");?></a>
			<a class="week" href="javascript:;"
				onclick="tipoActivo='mes';statChange();"><?php print $_IDIOMA->traducir("Month");?></a>
*/	?>
			<div style="clear: both; width: 100%; height: 10px"></div>

			<div id="graph"></div>
			<div style="clear: both; width: 100%; height: 20px"></div>

		</div><?php
} else {
	?><p><?php print $_IDIOMA->traducir("There are no ads, please create one.")?></p><?php
}
?><div style="clear: both; width: 100%"></div>

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br />

	</div>



</div>

<div id="footer"><?php
include ('footer.php');
?></div>
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
<?php
if (isset ( $anuncio )) {
	?>
createChart("/greader.php?__q=proceso/anuncio&__a=xmlStat&__t=xml&anuncio=<?php print $anuncio->id;?>","<?php print utf8_encode($anuncio->titulo)?>");

var anuncioActivo='<?php print $anuncio->id;?>';
<?php }?>
var tipoActivo='dia';
$("#startAd").datepicker({formatDate:"d/m/y",changeYear:true,changeMonth:true});
$("#endAd").datepicker({formatDate:"d/m/y",changeYear:true,changeMonth:true});
var anuncioTipo1Texto1="<?php print $_IDIOMA->traducir("Are you sure, to delete this ad?");?>";
</script>