<?php
require_once 'gbase.php';
$ml = ModelLoader::crear ( "ax_follower" );
$mlu = ModelLoader::crear ( "ax_generalRegister" );
$inicio = 7500;
$cuanto = 500;
$lista = $ml->listar ( "1 order by id_user asc", $inicio, $cuanto );
$tini = time ();
foreach ( $lista as $follow ) {
	if ($mlu->buscarPorCampo ( array ("id" => $follow->id_user ) ) && $mlu->active == "1") {
		
		$follower = unserialize ( $follow->history_follower );
		/*$following = unserialize ( $follow->history_following );
	foreach ( $following["id"] as $f ) {
		if (array_search ( $f, $follower["id"] ) === false) {
			$follower ["id"] [] = $f;
		}
	}
	$follow->history_follower = serialize ( $follower );
	if (count ( $follower ["id"] ) > 9) {
		$follower = array ("id" => array_slice ( $follower ["id"], count ( $follower ["id"] ) - 9 ) );
		if (count ( $follower ["id"] ) < 9) {
			$countfr = (9 - count ( $follower ["id"] ));
			for($i = 0; $i < $countfr; $i ++) {
				$follower ["id"] [] = 0;
			}
		}
	}
	$follow->follower = serialize ( $follower );
	$follow->modificar ( "id_user" );*/
		$nfollower = array ("id" => array () );
		foreach ( $follower ["id"] as $iduser ) {
			if ($mlu->buscarPorCampo ( array ("id" => $iduser ) )) {
				if ($mlu->active == "1") {
					$nfollower ["id"] [] = $iduser;
				}
			}
		}
		$follow->history_follower = serialize ( $nfollower );
		foreach ( $nfollower ["id"] as $iduser ) {
			if ($ml->buscarPorCampo ( array ("id_user" => $iduser ) )) {
				$xfollower = unserialize ( $ml->history_follower );
				if (array_search ( $follow->id_user, $xfollower ["id"] ) === false) {
					$xfollower ["id"] [] = $follow->id_user;
				}
				$ml->history_follower = serialize ( $xfollower );
				if (count ( $xfollower ["id"] ) > 9) {
					$xfollower = array ("id" => array_slice ( $xfollower ["id"], count ( $xfollower ["id"] ) - 9 ) );
				}
				if (count ( $xfollower ["id"] ) < 9) {
					$countfr = (9 - count ( $xfollower ["id"] ));
					for($i = 0; $i < $countfr; $i ++) {
						$xfollower ["id"] [] = 0;
					}
				}
				$ml->follower = serialize ( $xfollower );
				$ml->modificar ( "id_user" );
			}
		}
		
		if (count ( $nfollower ["id"] ) > 9) {
			$nfollower = array ("id" => array_slice ( $nfollower ["id"], count ( $nfollower ["id"] ) - 9 ) );
		}
		if (count ( $nfollower ["id"] ) < 9) {
			$countfr = (9 - count ( $nfollower ["id"] ));
			for($i = 0; $i < $countfr; $i ++) {
				$nfollower ["id"] [] = 0;
			}
		}
		$follow->follower = serialize ( $nfollower );
		$follow->modificar ( "id_user" );
	}
}
$tfin = time ();
print "termino en " . round ( ($tfin - $tini) / 60, 2 ) . " minutos<br/>";
var_dump ( $inicio );
?>