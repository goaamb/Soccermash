<?php
require_once 'gbase.php';
try {
	$mlaxgr = ModelLoader::crear ( "ax_generalRegister" );
	$mlaxcl = ModelLoader::crear ( "ax_club" );
	$lista = $mlaxgr->listar ( "profileId=26 and email='none'" ); //26=club
	foreach ( $lista as $usuario ) {
		if ($mlaxcl->buscarPorCampo ( array ("iduser" => $usuario->id ) )) {
			$mlaxcl->eliminar ( "id" );
		}
		$usuario->eliminar ( "id" );
	}
} catch ( Exception $ex ) {
	print $ex->getMessage ();
	exit();
}
print "exito clubes";

try {
	$mlaxco = ModelLoader::crear ( "ax_company" );
	$lista = $mlaxco->listar (  ); //26=club
	foreach ( $lista as $company ) {
		if (!$mlaxgr->buscarPorCampo ( array ("id" => $company->iduser,"profileId"=>27 ) )) {
			$company->eliminar ( "id" );
		}
	}
} catch ( Exception $ex ) {
	print $ex->getMessage ();
	exit();
}
print "exito company";



try {
	$mlaxco = ModelLoader::crear ( "ax_federation" );
	$lista = $mlaxco->listar (  ); //26=club
	foreach ( $lista as $company ) {
		if (!$mlaxgr->buscarPorCampo ( array ("id" => $company->iduser,"profileId"=>25 ) )) {
			$company->eliminar ( "id" );
		}
	}
} catch ( Exception $ex ) {
	print $ex->getMessage ();
	exit();
}
print "exito federation";

?>