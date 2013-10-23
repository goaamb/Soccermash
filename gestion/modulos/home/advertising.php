<div><?php

function dateDifference($startDate, $endDate) {
	if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate)
		return 0;
	
	$years = date ( 'Y', $endDate ) - date ( 'Y', $startDate );
	
	$endMonth = date ( 'm', $endDate );
	$startMonth = date ( 'm', $startDate );
	
	// Calculate months
	$months = $endMonth - $startMonth;
	if ($months <= 0) {
		$months += 12;
		$years --;
	}
	if ($years < 0)
		return 0;
	
		// Calculate the days
	$offsets = array ();
	if ($years > 0)
		$offsets [] = $years . (($years == 1) ? ' year' : ' years');
	if ($months > 0)
		$offsets [] = $months . (($months == 1) ? ' month' : ' months');
	$offsets = count ( $offsets ) > 0 ? '+' . implode ( ' ', $offsets ) : 'now';
	
	$days = $endDate - strtotime ( $offsets, $startDate );
	$days = date ( 'z', $days );
	
	return $years;
}
$mlaxgen = ModelLoader::crear ( "ax_generalRegister" );
if ($mlaxgen->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) )) {
	$mlad1 = ModelLoader::crear ( "ax_anuncioTipo1" );
	$pais = Idioma::darCodigo2AlfaPais ( Idioma::darIP () );
	$perfil = $mlaxgen->profileId;
	$edad = time () - strtotime ( $mlaxgen->dayOfBirthDay ); //segundos
	$edad = intval ( $edad / (365 * 24 * 60 * 60) );
	$sexo = $mlaxgen->sex;
	if ($sexo == 1) {
		$sexo = "Masculino";
	} else {
		$sexo = "Femeninos";
	}
	$lista = $mlad1->listar ( "activo='Si' and pagado='Si' and (paises like '%$pais%' or paises='*') and (perfiles like '$perfil' or perfiles like '$perfil::-::%' or perfiles like '%::-::$perfil' or perfiles like '%::-::$perfil::-::%' or perfiles='*' ) and ((desde<=$edad and hasta>=$edad) or isnull(desde) or desde=0 or isnull(hasta) or hasta=0) and (sexo='*' or sexo ='$sexo') order by rand()",0,3);
	if (count ( $lista ) > 0) {
		?><p class="greyTitles paddingRC">
		<span style="float: left; margin: 0px;font-weight: bold;color: #000000;"><?php
		print $_IDIOMA->traducir ( "Advertising" );
		?></span><a href="#" onclick="advertismentOpen();return false;"
			style="float: right; margin: 0px 10px 0 0;color: #0C8141;text-decoration: underline;"><?php
		print $_IDIOMA->traducir ( "Create" );
		?></a>
	</p>
	<hr /><?php
	}
	foreach ( $lista as $anuncio ) {
		Anuncio::insertarEstadisticaAnuncioTipo1 ( $anuncio, "Impresion", 1 );
		Anuncio::imprimirAnuncioTipo1 ( $anuncio, 1 );
		print "<div style='clear: both;'></div>";
	}
}
?></div>