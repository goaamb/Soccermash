<?php

require_once ('../../lib/site_ini.php');

require_once ('../../lib/share/clases/class_site.inc.php');

$dirg = "/goaamb/images/publi/thumb/";
$mlanuncio = ModelLoader::crear ( "ax_anuncioTipo1" );
if ($_POST ["id"] && $mlanuncio->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
	?>
<link href="css/advertisement.css" rel="stylesheet" type="text/css" />
<div id="closing" onclick="clsAcc();"
	title="<?php
	
	print $_IDIOMA->traducir ( "Close" );
	
	?>"></div>
<div id="content">
	<div id="main">



		<h5 style="margin-bottom: 0px;"><?php
	
	print $_IDIOMA->traducir ( "ADVERTISE TYPE 1" );
	
	?></h5>

		<span class="verde" style="margin: 0 0 5px; font-size: 14px;"><strong><?php
	
	print $_IDIOMA->traducir ( "Summary" );
	
	?></strong></span> <br /> <br />

		<table cellpadding="0" cellspacing="0" border="0" width="100%">

			<tr>

				<td width="55%" align="right" valign="top"><span class="verde"><?php
	
	print $_IDIOMA->traducir ( "Link your site:" );
	
	?></span><br /> <br /> <span class="verde"><?php
	
	print $_IDIOMA->traducir ( "Preview:" );
	
	?></span></td>

				<td><span><?php
	$url = $mlanuncio->url;
	$url = explode ( "::--::", $url );
	if (count ( $url ) > 0) {
		switch ($url [0]) {
			case "http2" :
				print "http://www.soccermash.com/" . $_IDIOMA->traducir ( "user" ) . "/" . $url [1];
				break;
			default :
				print "http://" . $url [1];
				break;
		}
	}
	?></span><br /> <br />

					<div id="previewAnuncioTipo11">
						<span id="tituloAnuncioTipo11"><?php
	print utf8_encode($mlanuncio->titulo)?></span>
							<img id="imagenAnuncioTipo11"
								src="<?php
	print $dirg . $mlanuncio->imagen;
	?>" width="80"
								height="80" />
						
							<p id="textoAnuncioTipo11"><?php
	print utf8_encode($mlanuncio->texto)?></p>
						
					</div>
			
			</tr>

		</table>

		<hr class="verde" />

		<br />

		<table cellpadding="0" cellspacing="0" border="0" width="100%">

			<tr>

				<td width="55%" align="right" valign="top"><span class="verde"><?php
	
	print $_IDIOMA->traducir ( "Target public (geographic and demographic data)" );
	
	?></span><br /> <br /></td><td></td></tr><tr><td valign="top" align="right"><span class="verde"><?php
	
	print $_IDIOMA->traducir ( "Country / ies where your ad will be published:" );
	
	?></span> <br /></td><td>
	<?php
	$paises = explode ( "::-::", $mlanuncio->paises );
	if (count ( $paises ) > 0) {
		if ($paises [0] === "*") {
			?><span><?php
			print $_IDIOMA->traducir ( "All Countrys" );
			?></span><br />
			<?php
		} else {
			$mlpais = ModelLoader::crear ( "ax_country" );
			foreach ( $paises as $pais ) {
				if ($mlpais->buscarPorCampo ( array ("code2" => $pais ) )) {
					?><span><?php
					print $_IDIOMA->traducir ( $mlpais->country );
					?></span><br /><?php
				}
			}
		}
	}
	?>
	</td></tr><tr><td valign="top" align="right"><br /> <br /><span class="verde"><?php
	
	print $_IDIOMA->traducir ( "Age:" );
	
	?></span> <br /></td><td><br /> <br />
	<span><?php
	if (! $mlanuncio->desde) {
		print $_IDIOMA->traducir ( "Any age" );
	} else {
		print $mlanuncio->desde;
	}
	print " - ";
	if (! $mlanuncio->hasta) {
		print $_IDIOMA->traducir ( "Any age" );
	} else {
		print $mlanuncio->hasta;
	}
	?></span></td></tr><tr><td valign="top" align="right"><br /> <br /><span class="verde"><?php
	
	print $_IDIOMA->traducir ( "Sex:" );
	
	?></span></td>
				<td><br /> <br />
<span><?php
	switch ($mlanuncio->sexo) {
		case "*" :
			print $_IDIOMA->traducir ( "Todos" );
			break;
		default :
			print $mlanuncio->sexo;
			break;
	}
	?></span></td>

			</tr>

		</table>

		<hr class="verde" />

		<br />

		<table cellpadding="0" cellspacing="0" border="0" width="100%">

			<tr>

				<td width="55%" align="right" valign="top"><span class="verde"><?php
	
	print $_IDIOMA->traducir ( "Types of profiles:" );
	
	?></span></td>

				<td><?php
	$perfiles = explode ( "::-::", $mlanuncio->perfiles );
	if (count ( $perfiles ) > 0) {
		if ($perfiles [0] === "*") {
			?><span><?php
			print $_IDIOMA->traducir ( "All Profile types" );
			?></span><br />
			<?php
		} else {
			$mlperfil = ModelLoader::crear ( "ax_profile" );
			foreach ( $perfiles as $perfil ) {
				if ($mlperfil->buscarPorCampo ( array ("idprofile" => $perfil ) )) {
					?><span><?php
					print $_IDIOMA->traducir ( $mlperfil->profile );
					?></span><br /><?php
				}
			}
		}
	}
	?></td>

			</tr>

		</table>

		<hr class="verde" />

		<br />

		<table cellpadding="0" cellspacing="0" border="0" width="100%">

			<tr>

				<td width="55%" align="right" valign="top"><span class="verde"><?php
	
	print $_IDIOMA->traducir ( "Publishing data and Ad Cost" );
	
	?></span> <br /> <br /><?php
	switch ($mlanuncio->tipo_anuncio) {
		case "Impresion" :
			?><span class="verde"><?php
			print $_IDIOMA->traducir ( "Limit of views:" );
			?></span> <br /> <br /><?php
			break;
		case "Tiempo" :
			?><span class="verde"><?php
			print $_IDIOMA->traducir ( "Time Limit:" );
			?></span> <br /> <br /><?php
			break;
		default :
			?><span class="verde"><?php
			print $_IDIOMA->traducir ( "Limit click:" );
			?></span> <br /> <br /><?php
			break;
	}
	?></td>

				<td><br /> <br /> <span class="verde"><?php
	print $mlanuncio->cantidad . " ";
	switch ($mlanuncio->tipo_anuncio) {
		case "Impresion" :
			print $_IDIOMA->traducir ( "views" );
			break;
		case "Tiempo" :
			print $_IDIOMA->traducir ( "days" );
			break;
		default :
			print $_IDIOMA->traducir ( "clicks" );
			break;
	}
	?></span> <br /> <br /></td>

			</tr>

		</table>

		<hr class="verde" />

		<table cellpadding="0" cellspacing="0" border="0" width="100%">

			<tr>

				<td width="55%" align="right"><span class="verde"><?php
	
	print $_IDIOMA->traducir ( "budget:" );
	
	?></span> <br /> <br /> <a style="text-transform: inherit;"
					class="bottomAdvert" href="javascript:;"
					onclick="editarAnuncioTipo1('<?php
	print $mlanuncio->id?>');"><?php
	
	print $_IDIOMA->traducir ( "edit ad" );
	
	?></a></td>

				<td><span><strong><?php
	print $mlanuncio->costo;
	?> USD</strong></span> <br /> <br /> <a
					style="text-transform: inherit; float: left;" class="bottomAdvert"
					href="javascript:;"
					onclick="pagarAnuncioTipo1('<?php
	print $mlanuncio->id?>');"><?php
	
	print $_IDIOMA->traducir ( "Checkout" );
	
	?></a> <br /></td>

			</tr>

		</table>

		<br />

		<p class="parrafo"><?php
	
	print $_IDIOMA->traducir ( 'By clicking the "Realizar pedido" button, I agree to the Declaración de derechos y responsabilidades de Facebook including my obligation to comply with the Normas de publicidad de SOCCERMASH.com. I understand that failure to comply with the Terms and Conditions and the Advertising Guidelines may result in a variety of consequences, including the cancellation of any advertisements I have placed, and termination of my account.' );
	
	?></p>

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br /><br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />

		<br /> <br /> <br />

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
</script><?php
} else {
	header ( "location: /gestion/modules/home/advertisemenHome.php" );
}
?>