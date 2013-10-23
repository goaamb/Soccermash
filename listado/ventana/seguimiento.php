<?php
$mllog = ModelLoader::crear ( "ax_trace" );
$mlu = ModelLoader::crear ( "ax_generalRegister" );
$hoy=date("Y-m-d");
$ayer=date("Y-m-d",time()-24*3600);
if (! isset ( $_POST ["__a"] )) {
	$lista = $mllog->listar ( "tiempo>='$ayer 00:00:00' and tiempo<='$hoy 23:59:59' group by ip order by ip asc " );
	
	$tabla = $mllog->aTabla ( $lista, array ("id", "user", "tiempo", "url", "navegador", "so", "post", "get", "cookie", "session" ), "", 0, false );
	$tabla->border = "1";
	$tabla->cellspacing = "1";
	$tabla->cellpadding = "3";
	$tabla->addHead("Tiempo Estadia");
	foreach ( $lista as $i => $log ) {
		$listat = $mllog->listar ("ip='$log->ip' and tiempo>='$ayer 00:00:00' and tiempo<='$hoy 23:59:59' order by tiempo asc" );
		if(count($listat)>0){
			$tini=strtotime($listat[0]->tiempo);
			$suma=0;
			foreach ($listat as $logt) {
				$tfin=strtotime($logt->tiempo);
				$tx=$tfin-$tini;
				if($tx<=5*60 && $tx>0){
					$suma+=$tx;
				}
				$tini=$tfin;
			}
		}
		$tabla->getColumn ( $i, 0 )->onclick = "desgloseIP('$log->ip');";
		$hora=intval(suma/3600);
		$minuto=((suma%3600)/60);
		$segundo=(suma%60);
		$tabla->addColumn("$suma",$i);
	}
	$tabla->htmlprint ();
} else {
	switch ($_POST ["__a"]) {
		case "desgloseIP" :
			$ip = $_POST ["ip"];
			$lista = $mllog->listar ( "ip='$ip' and tiempo>='$ayer 00:00:00' and tiempo<='$hoy 23:59:59' order by tiempo desc" );
			$tabla = $mllog->aTabla ( $lista, array ( ), "", 0, false );
			$tabla->border = "1";
			$tabla->cellspacing = "1";
			$tabla->cellpadding = "3";
			if ($tabla->getTag () == "table") {
				foreach ( $lista as $i => $log ) {
					if ($log->user && $mlu->buscarPorCampo ( array ("id" => $log->user ) )) {
						$col = $tabla->getColumn ( $i, 2 );
						$col->clear ();
						$col->add ( "($mlu->id) $mlu->name $mlu->lastname" );
					}
				}
			}
			$tabla->htmlprint ();
			break;
		
		default :
			;
			break;
	}
}
?>