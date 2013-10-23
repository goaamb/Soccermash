<?php
$dir = "/";
require_once $_SERVER ["DOCUMENT_ROOT"] . $dir . 'gbase.php';
require_once $_GBASE . '/goaamb/web/json.php';
$json = new JSON ();
$success = false;

function darReplyHTML($mlrm, $mlu) {
	ob_start ();
	?><div class="replyMsgPriv"
	id="replyMsgPriv<?php
	print $mlrm->idMsjReply;
	?>"
	onclick="desplegRplPriv('<?php
	print $mlrm->idMsjReply;
	?>');">
<div original-title="" class="borMsg"></div>
<div original-title="" class="fotPeq"><img width="50" original-title=""
	class="bordersRed"
	src="<?php
	print "photoGeneral/small/small_" . $mlu->photo;
	?>"></div>

<div style="color: rgb(187, 187, 187);" original-title=""
	class="theMsgText">
<div original-title="" class="nameMsg" onclick=""><?php
	print $mlu->name . " " . $mlu->lastname;
	?></div>
<?php
	print nl2br ( $mlrm->txtMsjReply );
	?></div>
<div class="dateMsg" original-title=""><?php
	print date ( "Y-m-d", strtotime ( $mlrm->date ) );
	?></div>
</div><?php
	return ob_get_clean ();
}

if (isset ( $_POST ["accion"] )) {
	switch ($_POST ["accion"]) {
		case "delete" :
			$id = $_POST ["id"];
			$mlsm = ModelLoader::crear ( "ax_sentMsj" );
			$mlrm = ModelLoader::crear ( "ax_replyMsj" );
			if ($mlsm->buscarPorCampo ( array ("idMsj" => $_POST ["id"] ) )) {
				$listarep = $mlrm->listar ( "idMsjSent='$mlsm->idmsj'" );
				foreach ( $listarep as $reply ) {
					$reply->eliminar ( "idMsjReply" );
				}
				$mlsm->eliminar ( "idMsj" );
				$success = true;
			}
			break;
		case "noNuevo" :
			$id = $_POST ["id"];
			$mlsm = ModelLoader::crear ( "ax_sentMsj" );
			$mlrm = ModelLoader::crear ( "ax_replyMsj" );
			if ($mlsm->buscarPorCampo ( array ("idMsj" => $_POST ["id"] ) )) {
				$mlsm->checkit = 1;
				$mlsm->modificar ( "idMsj" );
				$listarep = $mlrm->listar ( "checkit=0 and idMsjSent='$mlsm->idmsj'" );
				foreach ( $listarep as $reply ) {
					$reply->checkit = 1;
					$reply->modificar ( "idMsjReply" );
				}
				$id=$_SESSION["iSMuIdKey"];
				$cuantos=$mlsm->contar("checkit=0 and ( idUserRecived='$id')");
				$cuantos+=$mlrm->contar("checkit=0 and ( idUserGetReply='$id')");
				$json->add("faltan",$cuantos);
				$success = true;
			}
			break;
		case "verNuevos":
			break;
		case "reply" :
			$uid = $_SESSION ["iSMuIdKey"];
			$id = $_POST ["id"];
			$value = $_POST ["value"];
			$mlsm = ModelLoader::crear ( "ax_sentMsj" );
			if ($mlsm->buscarPorCampo ( array ("idMsj" => $_POST ["id"] ) )) {
				$mlsm->checkit = 1;
				$mlsm->modificar ( "idMsj" );
				$mlrm = ModelLoader::crear ( "ax_replyMsj" );
				$mlrm->idMsjSent = $_POST ["id"];
				$mlrm->idUserGetReply = $mlsm->idUserRecived;
				$mlrm->idUserReply = $uid;
				
				$mlrm->txtMsjReply = $value;
				$mlrm->date = date ( "Y-m-d" );
				$mlrm->checkit = "0";
				$id = $mlrm->insertar ();
				if ($id) {
					$mlu = ModelLoader::crear ( "ax_generalRegister" );
					if ($mlu->buscarPorCampo ( array ("id" => $uid ) )) {
						$resultado = darReplyHTML ( $mlrm, $mlu );
						$json->add ( "resultado", "'" . Utilidades::procesarTextoJSON ( $resultado ) . "'" );
						$success = true;
					}
				}
			}
			break;
		case "more" :
			$uid = $_SESSION ["iSMuIdKey"];
			$id = $_POST ["id"];
			$inicio = intval ( $_POST ["i"] );
			$mlrm = ModelLoader::crear ( "ax_replyMsj" );
			$lista = $mlrm->listar ( "idMsjSent='$id' order by date desc, idMsjReply desc", $inicio, 10 );
			$total=$mlrm->contar( "idMsjSent='$id'");
			$mlu = ModelLoader::crear ( "ax_generalRegister" );
			$resultado = "";
			foreach ( $lista as $mensaje ) {
				if ($mlu->buscarPorCampo ( array ("id" => $mensaje->idUserReply ) )) {
					$resultado .= darReplyHTML ( $mensaje, $mlu );
				
				}
			}
			$json->add ( "inicio", "'" . $inicio . "'" );
			$json->add ( "resultado", "'" . Utilidades::procesarTextoJSON ( $resultado ) . "'" );
			$json->add ( "total", $total );
			$success = true;
			break;
		default :
			;
			break;
	}
}
$json->add ( "success", $success ? "true" : "false" );
$json->printJSON ();
?>