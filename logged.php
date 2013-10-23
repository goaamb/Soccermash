<?php
require_once 'gbase.php';

$mllo = ModelLoader::crear ( "ax_loged" );
$mlgr = ModelLoader::crear ( "ax_generalRegister" );
$total = $mllo->contar ();
$lista = $mllo->listar ( "1 order by rand()", 0, ceil ( $total * 0.8 ) );
foreach ( $lista as $user ) {
	if ($mlgr->buscarPorCampo ( array (
			"email" => $user->email 
	) )) {
		$mlgr->tiempoUtlimaActividad = date ( "Y-m-d H:i:s" );
		print "$mlgr->email: $mlgr->tiempoUtlimaActividad<br/>";
		$mlgr->modificar ( "id" );
	}
}
?>