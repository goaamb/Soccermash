<?
require_once ($_SERVER ["DOCUMENT_ROOT"] . '/traza.php');
require_once ($_GBASE . '/goaamb/web/json.php');
$json = new JSON ();
function checkStatus($json) {
	$mlu = ModelLoader::crear ( "ax_generalRegister" );
	if ($mlu->buscarPorCampo ( array ("id" => $_SESSION ['iSMuIdKey'] ) )) {
		if ($mlu->active !== "1") {
			$json->add ( "logout", "1" );
			return false;
		}
	}
	return true;
}
function selectTable($profileId) {
	$tableProfile = '';
	if ($profileId < 7) {
		$tableProfile = 'ax_player';
	} elseif ($profileId < 13) {
		$tableProfile = 'ax_coach';
	} elseif ($profileId < 16) {
		$tableProfile = 'ax_agent';
	} elseif ($profileId == 16) {
		$tableProfile = 'ax_scout';
	} elseif ($profileId == 17) {
		$tableProfile = 'ax_lawyer';
	} elseif ($profileId < 20) {
		$tableProfile = 'ax_manager';
	} elseif ($profileId < 23) {
		$tableProfile = 'ax_medic';
	} elseif ($profileId == 23) {
		$tableProfile = 'ax_fan';
	} elseif ($profileId == 24) {
		$tableProfile = 'ax_journalist';
	} elseif ($profileId == 25) {
		$tableProfile = 'ax_federation';
	} elseif ($profileId == 26) {
		$tableProfile = 'ax_club';
	} elseif ($profileId == 27) {
		$tableProfile = 'ax_company';
	}
	
	return $tableProfile;

}
function countWallMessages($json) {
	$id = $_SESSION ["iSMuIdKey"];
	$tabla = selectTable ( $_SESSION ['iSMuProfTypeKey'] );
	$mlsm = ModelLoader::crear ( $tabla . "WallAlert" );
	
	$cuantos = $mlsm->contar ( "id_user=$id AND viewed=1" );
	$json->add ( "wallfaltan", $cuantos );
}
function countPrivateMessages($json) {
	$mlsm = ModelLoader::crear ( "ax_sentMsj" );
	$mlrm = ModelLoader::crear ( "ax_replyMsj" );
	$id = $_SESSION ["iSMuIdKey"];
	$cuantos = $mlsm->contar ( "checkit=0 and  idUserRecived='$id'" );
	$cuantos += $mlrm->contar ( "checkit=0 and ((idUserGetReply='$id' and idUserReply<>'$id')or (idUserReply='$id' and idUserGetReply<>'$id'))" );
	$json->add ( "faltan", $cuantos );
}

////////IF logout//////////////
if (isset ( $_POST ['out'] )) {
	
	$_SESSION ["tiempoUltimaActividad"] = '';
	
	$dir = '';
	require_once ($_SERVER ['DOCUMENT_ROOT'] . $dir . '/gestion/modulos/profile/profileClass.php');
	
	$pro = new Profile ();
	
	$aFields = array ();
	$aFields ['tiempoUtlimaActividad'] = '';
	setcookie ( "SOCSESSIONID", null );
	$pro->upGeneral ( $aFields, 'id=' . $_SESSION ['iSMuIdKey'] );

	//////////Set session//////////////
} else {
	checkStatus ( $json );
	countPrivateMessages ( $json );
	countWallMessages ( $json );
	$json->printJSON ();
}

?>