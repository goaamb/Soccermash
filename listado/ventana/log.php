<?php
$mllog = ModelLoader::crear ( "ax_trace" );
$mlu = ModelLoader::crear ( "ax_generalRegister" );
$lista = $mllog->listar ( "1 order by tiempo desc", 0, 100 );

$tabla = $mllog->aTabla ( $lista, array (), "", 0, false );
$tabla->border = "1";
$tabla->cellspacing = "1";
$tabla->cellpadding = "3";
foreach ( $lista as $i => $log ) {
	if ($log->user && $mlu->buscarPorCampo ( array ("id" => $log->user ) )) {
		$col = $tabla->getColumn ( $i, 2 );
		$col->clear();
		$col->add("($mlu->id) $mlu->name $mlu->lastname");
	}

}
$tabla->htmlprint ();
?>