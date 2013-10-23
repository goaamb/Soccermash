<?php
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/gestion/lib/site_ini.php');
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/gestion/lib/share/clases/class_site.inc.php');
require_once $_GBASE . '/goaamb/web/select.php';
$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
if (isset ( $_POST ["id"] ) && $ml->buscarPorCampo ( array ("id" => $_POST ["id"] ) )) {
	$mlaxG = ModelLoader::crear ( "ax_generalRegister" );
	$mlaxG->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) );
	$publiid = str_pad ( $_POST ["id"], 21, "0", STR_PAD_LEFT );
	$orderinfo = $publiid . "-PUBLI-T1";
	$description = $_IDIOMA->traducir ( "Purchase of advertising space" );
	$price = $ml->costo;
	?>
<style>
#tablaPago td {
	margin: auto;
	padding: 5px;
}
</style>
<link href="css/advertisement.css" rel="stylesheet" type="text/css" />
<form method="post" action="/greader.php"
	target="iframeFakeAdvertisement" id="formPago">
	<input name="__q" value="proceso/anuncio" type="hidden" /> <input
		name="__a" value="pagarAnuncio" type="hidden" /> <input
		name="ordertype" value="SALE" type="hidden"> <input type="hidden"
		name="result" value="LIVE"> <input name="transactionorigin"
		type="hidden" value="ECI"> <input name="oid"
		value="<?php print $orderinfo?>" type="hidden"> <input name="ponumber"
		value="<?php print $orderinfo?>" type="hidden"><input name="taxexempt"
		value="Y" type="hidden"> <input name="terminaltype"
		value="UNSPECIFIED" type="hidden"> <input name="ip"
		value="<?php Idioma::darIP();?>" type="hidden"><input
		name="chargetotal" type="hidden" value="<?php print $price ;?>"><input
		name="cvmindicator" value="provided" type="hidden"><input name="id"
		value="<?php print $publiid;?>" type="hidden"><input
		name="description" value="<?php print $description;?>" type="hidden"><input
		name="quantity" value="1" type="hidden"><input name="price"
		value="<?php print $price ;?>" type="hidden"><input
		name="anuncioTipo1" value="<?php print $ml->id ;?>" type="hidden">
	<table id="tablaPago">
		<tr>
			<td valign="top">
				<table>
					<tr>
						<th><?php print $_IDIOMA->traducir("Card Information")?></th>
					</tr>

					<tr>
						<td align="left">* <?php print $_IDIOMA->traducir("Card Number")?><br />
							<input name="cardnumber" value=""></td>
					</tr>
					<tr>
						<td align="left">* <?php print $_IDIOMA->traducir("Expiration Month, Ej: March to 03")?><br /><?php
	$arreglo = range ( 1, 12 );
	for($i = 0; $i < count ( $arreglo ); $i ++) {
		$arreglo [$i] = str_pad ( $arreglo [$i], 2, "0", STR_PAD_LEFT );
	}
	$selectexpnum = new Select ( $arreglo, Select::SAMEVALUES );
	$selectexpnum->name = "cardexpmonth";
	$selectexpnum->htmlprint ();
	?></td>
					</tr>
					<tr>
						<td align="left">* <?php print $_IDIOMA->traducir("Expiration Year, Ej: 2012 to 12")?><br /><?php
	$arreglo = range ( date ( "y" ), 99 );
	for($i = 0; $i < count ( $arreglo ); $i ++) {
		$arreglo [$i] = str_pad ( $arreglo [$i], 2, "0", STR_PAD_LEFT );
	}
	$keys = range ( date ( "Y" ), 2099 );
	$selectexpnum = new Select ( array_combine ( $arreglo, $keys ), Select::KEYVALUES );
	$selectexpnum->name = "cardexpyear";
	$selectexpnum->htmlprint ();
	?>
					
					</tr>
					<tr>
						<td align="left">* <?php
	
	print $_IDIOMA->traducir ( "Numeric Value printed in front or back of your
							card" )?><br /> <input name="cvmvalue" value=""></td>
					</tr>

					<tr>
						<th><?php print $_IDIOMA->traducir("Detail")?></th>
					</tr>
					<tr>
						<td align="left"><?php print $_IDIOMA->traducir("Description")?><br /><?php print $description?></td>
					</tr>
					<tr>
						<td align="left"><?php print $_IDIOMA->traducir("Amount")?><br /><?php print $price;?> $us</td>
					</tr>
				</table>
			</td>

			<td></td>

			<td valign="top">
				<table>
					<tr>
						<th colspan=4><?php print $_IDIOMA->traducir("Billing Information")?></th>
					</tr>
					<tr>
						<td align="left" colspan=4>* <?php print $_IDIOMA->traducir("Name")?><br />
							<input name="name" value=""></td>
					</tr>
					<tr>
						<td align="left" colspan=4>* <?php print $_IDIOMA->traducir("Company")?><br />
							<input name="company" value=""></td>
					</tr>
					<tr>
						<td align="left" colspan=3>* <?php print $_IDIOMA->traducir("Address 1")?><br />
							<input name="address1" value="" style="width: 215px;"></td>
						<td align="left"><?php print $_IDIOMA->traducir("Address Number")?><br />
							<input name="addrnum" value="" style="width: 45px;"></td>
					</tr>
					<tr>
						<td align="left" colspan=4>* <?php print $_IDIOMA->traducir("City")?><br />
							<input name="city" value=""></td>
					</tr>
					<tr>
						<td align="left" colspan=4>* <?php print $_IDIOMA->traducir("State")?><br />
							<input name="state" value=""></td>
					</tr>
					<tr>
						<td align="left" colspan=4>* <?php print $_IDIOMA->traducir("Country")?><br /><?php
	$mlpais = ModelLoader::crear ( "ax_country" );
	$listapaises = $mlpais->listar ( "1 order by country asc" );
	$keys = array ();
	$values = array ();
	foreach ( $listapaises as $pais ) {
		$pais->country = $_IDIOMA->traducir ( $pais->country );
		$keys [] = $pais->code2;
		$values [] = $_IDIOMA->traducir ( $pais->country );
	}
	for($i = 0; $i < count ( $values ); $i ++) {
		for($j = $i + 1; $j < count ( $values ); $j ++) {
			if ($values [$i] > $values [$j]) {
				$auxv = $values [$i];
				$auxk = $keys [$i];
				$values [$i] = $values [$j];
				$keys [$i] = $keys [$j];
				$values [$j] = $auxv;
				$keys [$j] = $auxk;
			}
		}
	}
	$keys = array_merge ( array ("" ), $keys );
	$values = array_merge ( array ($_IDIOMA->traducir ( "Select your Country" ) ), $values );
	$select = new Select ( array_combine ( $keys, $values ), Select::KEYVALUES, $mlaxG->paisReal );
	$select->name = "country";
	$select->htmlprint ( Tag::UTF8_ENCODE );
	?></td>
					</tr>
					<tr>
						<td align="left" colspan=2>* <?php print $_IDIOMA->traducir("Phone")?><br />
							<input name="phone" value="" style="width: 130px;"></td>
						<td align="left" colspan=2>* <?php print $_IDIOMA->traducir("Zip Code")?><br />
							<input name="zip" value="" style="width: 130px;"></td>
					</tr>
					<tr>
						<td align="left" colspan=4>* <?php print $_IDIOMA->traducir("E-mail")?><br />
							<input name="email" value="<?php print $mlaxG->email?>"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="left" colspan=3><?php print $_IDIOMA->traducir("Valid cards")?><br />
				<img src="img/amex_ic.png" style="margin: 3px" /> <img
				src="img/diners_ic.png" style="margin: 3px" /> <img
				src="img/discover_ic.png" style="margin: 3px" /> <img
				src="img/jcb_ic.png" style="margin: 3px" /> <img
				src="img/visaelectron_ic.png" style="margin: 3px" /> <img
				src="img/master_ic.png" style="margin: 3px" /> <img
				src="img/visa_ic.png" style="margin: 3px" /></td>
		</tr>
		<tr>
			<td id="errorPay" colspan=2 style="color: red;"></td>
			<td colspan=1 align="center"><input
				style="width: 100px; padding-bottom: 3px; height: 20px;"
				type="submit"
				value="<?php print $_IDIOMA->traducir("Make Payment")?>"
				onclick="verProcesandoPago();" class="bottomAdvert"></td>
		</tr>
	</table>
</form>
<div id="procesandoPago"
	style="display: none; width: 50px; margin: 200px auto 0;">
	<img src="/img/carga.gif" />
</div>
<iframe id="iframeFakeAdvertisement" name="iframeFakeAdvertisement"
	src="" style="display: none;" onload="procesarJSONAnuncio.call(this);"></iframe>
<script type="text/javascript">
G.dom.$("iframeFakeAdvertisement").onjsonready = formAnuncioReady;
</script>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<div id="footer"><?php
	include ('../footer.php');
	?></div><?php

} else {
	header ( "location: /gestion/modulos/home/advertisementHome.php" );
}
?>