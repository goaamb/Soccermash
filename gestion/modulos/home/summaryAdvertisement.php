<?php
require_once ('../../lib/site_ini.php');
require_once ('../../lib/share/clases/class_site.inc.php');
$ml = new ModelLoader ( "ax_anuncioTipo2" );
if (isset ( $_POST ["id"] ) && $ml->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
	$dirg = "/goaamb/images/publi/thumb/";
	?>
<link href="css/advertisement.css" rel="stylesheet" type="text/css" />



<!--<script type="text/javascript" src="js/jquery-1.6.1.js"></script>-->



<?php
	
	?>

<div id="closing" onclick="clsAcc();"
	title="<?php
	print $_IDIOMA->traducir ( "Close" );
	?>"></div>



<div id="content">





<div id="main">

<h5><?php
	print $_IDIOMA->traducir ( "Resumen" );
	?></h5>



<span class="verde"> <?php print $_IDIOMA->traducir("Name of your Advertise:")?> <span><?php
	print $ml->titulo;
	?></span>

</span>

<hr class="verde" />

<br />

<span class="verde"> <?php print $_IDIOMA->traducir("Contract period:")?> <span><?php
	$ahora = strtotime ( $ml->fecha_inicio );
	print date ( "d/m/Y", $ahora );
	?> - <?php
	$despues = strtotime ( $ml->fecha_fin );
	print date ( "d/m/Y", $despues );
	?>
<?php

	if ($ml->activo == "No") {
		print $_IDIOMA->traducir("(to be confirmed)");
	}
	?></span> </span>

<hr class="verde" />

<div
	style="float: left; border-right: 1px solid #E9E9E9; padding: 0 10px 0 14px">

<span class="verde" style="margin: 0px;"><?php print $_IDIOMA->traducir("1. Ad on page LOGIN")?></span>

<br />
<br />
<br />
<br />
<br />

<div class="prev12" style="margin: 0px; float: none;">
<div><?php
	$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $ml->imagen1;
	if (is_file ( $archivo )) {
		?><img src="<?php
		print $dirg . $ml->imagen1;
		?>" /><?php
	}
	?></div>
</div>

<br />
<br />

<img src="img/advertismentT201.jpg" /></div>

<div
	style="float: left; border-right: 1px solid #E9E9E9; padding: 0 10px 0 14px;">

<span class="verde" style="margin: 0px;"><?php print $_IDIOMA->traducir("2. Notice of publication")?><br />
<?php print $_IDIOMA->traducir("above the search engine and")?><br />
<?php print $_IDIOMA->traducir("below the menu bar.")?></span> <br />
<br />
<br />

<div class="prev22" style="margin: 0px; float: none;">
<div><?php
	$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $ml->imagen2;
	if (is_file ( $archivo )) {
		?><img src="<?php
		print $dirg . $ml->imagen2;
		?>" /><?php
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
	$archivo = $_SERVER ["DOCUMENT_ROOT"] . $dirg . $ml->imagen3;
	if (is_file ( $archivo )) {
		?><img src="<?php
		print $dirg . $ml->imagen3;
		?>" /><?php
	}
	?></div>
</div>

<br />
<br />

<img src="img/advertismentT203.jpg" /></div>

<div style="clear: both; width: 100%"></div>

<hr class="verde" />

<a style="text-transform: inherit;" class="bottomAdvert"
	href="javascript:;" onclick="confirmarAnuncio('<?php print $ml->id?>');"><?php print $_IDIOMA->traducir("Confirm")?></a><a
	style="text-transform: inherit;" class="bottomAdvert"
	href="javascript:;" onclick="editarAnuncio('<?php print $ml->id?>');"><?php print $_IDIOMA->traducir("Edit Ad")?></a> <br />
<br />

<br />
<br />

<p class="parrafo"><?php print $_IDIOMA->traducir("When you click Confirm, I agree with the
rights and responsibilities including my obligation SOCCERMASH.com
to comply with advertising rules.")?> <br />
<br />

<?php print $_IDIOMA->traducir("I understand that any breach of such rules may result in standards
several consequences including forfeiture of any advertising
you have made and the removal of my account.")?> <br />
<br />

<?php print $_IDIOMA->traducir("I am also giving consent for the images pass to the process
Review by SOCCERMASH.com for a period of 48 hours at 72
hours.")?> <br />
<br />

<?php print $_IDIOMA->traducir("Should SOCCERMASH.com specialists find no
error or inconsistency in any of the images submitted,
receive an email notification with the date and time of high and
finalization. Otherwise, the process of publication will be
canceled.")?></p>



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
	header ( "location:/gestion/modulos/home/createAdvertisement.php" );
}
?>