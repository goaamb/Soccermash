<?php
ini_set ( "error_reporting", E_ALL & ~ E_WARNING & ~ E_NOTICE );
require_once 'httplogin.php';
require_once 'gbase.php';
require_once 'goaamb/idioma.php';
require_once 'goaamb/bd/modelloader.php';
require_once 'goaamb/web/tablahtml.php';
//date_default_timezone_set ( "Europe/Madrid" );
$mlusers = ModelLoader::crear ( "ax_generalRegister" );
$mlip = ModelLoader::crear ( "ax_ip_pais" );
$mlpais = ModelLoader::crear ( "ax_country" );
$mlprofile = ModelLoader::crear ( "ax_profile" );
$ahora = time ();
$antes = $ahora - 2 * 60;

$row = $conexion->seleccionarAsociado ( "
(SELECT count(1) as bloqueados FROM `ax_generalRegister` as a WHERE a.active=0 and (a.active='' or isnull(a.active)) and a.email not like ('%@hgisport.com%')) as y,
(SELECT count(1) as registrados FROM `ax_generalRegister` as a WHERE a.active=1 and a.email not like ('%@hgisport.com%')) as x,
(SELECT count(1) as registradosu FROM `ax_generalRegister` as a WHERE a.active=1 and (profileid<=24 or profileid>=28) and a.email not like ('%@hgisport.com%')) as x1,
(SELECT count(1) as registradoscl FROM `ax_generalRegister` as a WHERE a.active=1 and profileid=26 and a.email not like ('%@hgisport.com%')) as x2,
(SELECT count(1) as registradosco FROM `ax_generalRegister` as a WHERE a.active=1 and profileid=27 and a.email not like ('%@hgisport.com%')) as x3,
(SELECT count(1) as registradosfu FROM `ax_generalRegister` as a WHERE a.active=1 and profileid=25 and a.email not like ('%@hgisport.com%')) as x4,
(select count(1) as hoy from ax_generalRegister where  registerdate>='" . date ( "Y-m-d 00:00:00" ) . "' and registerdate<='" . date ( "Y-m-d 23:59:59" ) . "' and email not like ('%@hgisport.com%')) as v,
(select count(1) as enlinea from ax_generalRegister as a where not isnull(a.tiempoutlimaactividad) and tiempoutlimaactividad>='" . date ( "Y-m-d H:i:s", $antes ) . "' and tiempoutlimaactividad<='" . date ( "Y-m-d H:i:s", $ahora ) . "')as t " );
if (count ( $row ) > 0) {
	$row = $row [0];
}
$table = new Tabla ();
$table->border = "1";
$table->cellpadding = "3";
$table->cellspacing = "1";
$table->align = "center";
$table->class = "general";
$table->addHead ( "Total" )->onclick = "filtrar('activos');";
$table->addHead ( "Personas" )->onclick = "filtrar('activosu');";
$table->addHead ( "Company" )->onclick = "filtrar('activosco');";
$table->addHead ( "Club" )->onclick = "filtrar('activoscl');";
$table->addHead ( "Federation" )->onclick = "filtrar('activosfu');";
$table->addHead ( "Bloqueados" )->onclick = "filtrar('bloqueados');";
$table->addHead ( "Registrados hoy" )->onclick = "filtrar('hoy');";
$table->addHead ( "Usuarios En Linea" )->onclick = "filtrar('enlinea');";

$table->addColumn ( $row ["registrados"], 0 )->style = "background-color:lime;";
$table->addColumn ( $row ["registradosu"], 0 )->style = "background-color:lime;";
$table->addColumn ( $row ["registradosco"], 0 )->style = "background-color:lime;";
$table->addColumn ( $row ["registradoscl"], 0 )->style = "background-color:lime;";
$table->addColumn ( $row ["registradosfu"], 0 )->style = "background-color:lime;";
$table->addColumn ( $row ["bloqueados"], 0 )->style = "background-color:red;";
$table->addColumn ( $row ["hoy"], 0 )->style = "background-color:#AAF;";
$table->addColumn ( $row ["enlinea"], 0 )->style = "background-color:yellow;";
function nombreTipoPerfil($idperfil) {
	switch ($idperfil) {
		case 2 :
		case 3 :
		case 4 :
		case 5 :
			return "player";
			break;
		case 7 :
		case 8 :
		case 9 :
		case 10 :
		case 11 :
		case 12 :
			return "coach";
			break;
		case 13 :
		case 14 :
		case 15 :
			return "agent";
			break;
		case 16 :
			return "scout";
			break;
		case 17 :
			return "lawyer";
			break;
		case 18 :
		case 19 :
			return "manager";
			break;
		case 20 :
		case 21 :
		case 22 :
			return "medic";
			break;
		case 23 :
			return "fan";
			break;
		case 24 :
			return "journalist";
			break;
		case 25 :
			return "federation";
			break;
		case 26 :
			return "club";
			break;
		case 27 :
			return "company";
			break;
	}
	return "";
}
$criterio = "";
$p = (isset ( $_REQUEST ["p"] ) ? intval ( $_REQUEST ["p"] ) : 0);
$tama = 100;
if (isset ( $_POST ["destacados"] )) {
	$destacados = explode ( ",", $_POST ["destacados"] );
	$mlfollower = ModelLoader::crear ( "ax_follower" );
	for($i = 0; $i < count ( $destacados ); $i ++) {
		if ($mlusers->buscarPorCampo ( array ("id" => $destacados [$i] ) )) {
			if ($_REQUEST ["modo"] !== "eliminar") {
				switch ($_REQUEST ["modo"]) {
					case "destacar" :
						$mlusers->destacado = "1";
						$mlusers->fecha_destacado = date ( "Y-m-d H:i:s" );
						break;
					case "nodestacar" :
						$mlusers->destacado = "0";
						break;
					case "bloquear" :
						$mlusers->active = "0";
						if ($mlfollower->buscarPorCampo ( array ("id_user" => $mlusers->id ) )) {
							$strlen = strlen ( "" . $mlusers->id );
							$lista = $mlfollower->listar ( "history_follower like '%i:$mlusers->id;%' or history_follower like '%s:$strlen:\"$mlusers->id\";%'" );
							foreach ( $lista as $amigo ) {
								$follower = unserialize ( $amigo->history_follower );
								$pos = array_search ( $mlusers->id, $follower ["id"] );
								if ($pos === false) {
									$pos = array_search ( intval ( $mlusers->id ), $follower ["id"] );
								}
								if ($pos !== false) {
									array_splice ( $follower ["id"], $pos, 1 );
								}
								$amigo->history_follower = serialize ( $follower );
								
								if (count ( $follower ["id"] ) > 9) {
									$follower = array ("id" => array_slice ( $follower ["id"], count ( $follower ["id"] ) - 9 ) );
								}
								if (count ( $follower ["id"] ) < 9) {
									$countfr = (9 - count ( $follower ["id"] ));
									for($i = 0; $i < $countfr; $i ++) {
										$follower ["id"] [] = 0;
									}
								}
								$amigo->follower = serialize ( $follower );
								$amigo->modificar ( "id_user" );
							}
							$mlfollower->history_follower = serialize ( array ("id" => array () ) );
							$mlfollower->follower = serialize ( array ("id" => array (0, 0, 0, 0, 0, 0, 0, 0, 0 ) ) );
							$mlfollower->modificar ( "id_user" );
						}
						
						break;
					case "habilitar" :
						$mlusers->active = "1";
						break;
					default :
						;
						break;
				}
				$mlusers->modificar ( "id" );
			} else {
				$profile = nombreTipoPerfil ( $mlusers->profileid );
				if ($mlfollower->buscarPorCampo ( array ("id_user" => $mlusers->id ) )) {
					$strlen = strlen ( "" . $mlusers->id );
					$contador = 0;
					do {
						$lista = $mlfollower->listar ( "history_follower like '%i:$mlusers->id;%' or history_follower like '%s:$strlen:\"$mlusers->id\";%'", 0, 100 );
						$contador = count ( $lista );
						foreach ( $lista as $amigo ) {
							$follower = unserialize ( $amigo->history_follower );
							$pos = array_search ( $mlusers->id, $follower ["id"] );
							if ($pos === false) {
								$pos = array_search ( intval ( $mlusers->id ), $follower ["id"] );
							}
							if ($pos !== false) {
								array_splice ( $follower ["id"], $pos, 1 );
							}
							$amigo->history_follower = serialize ( $follower );
							
							if (count ( $follower ["id"] ) > 9) {
								$follower = array ("id" => array_slice ( $follower ["id"], count ( $follower ["id"] ) - 9 ) );
							}
							if (count ( $follower ["id"] ) < 9) {
								$countfr = (9 - count ( $follower ["id"] ));
								for($i = 0; $i < $countfr; $i ++) {
									$follower ["id"] [] = 0;
								}
							}
							$amigo->follower = serialize ( $follower );
							$amigo->modificar ( "id_user" );
							unset ( $amigo );
						}
					} while ( $contador != 0 );
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "Career" );
					if ($mlmodules->buscarPorCampo ( array ("idPlayer" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "id" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "Career<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "Honour" );
					if ($mlmodules->buscarPorCampo ( array ("idPlayer" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "id" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "Honour<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "Observation" );
					if ($mlmodules->buscarPorCampo ( array ("idPlayer" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "id" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "Observation<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "PersonalDistinction" );
					if ($mlmodules->buscarPorCampo ( array ("idPlayer" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "id" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "PersonalDistinction<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "New" );
					if ($mlmodules->buscarPorCampo ( array ("idPlayer" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "id" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "New<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "PubComChecks" );
					if ($mlmodules->buscarPorCampo ( array ("id_user" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "id_user" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "PubComChecks<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "PubComChecks" );
					if ($mlmodules->buscarPorCampo ( array ("id_user_who_check" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "id_user_who_check" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "PubComChecks<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "ReceivedComments" );
					if ($mlmodules->buscarPorCampo ( array ("idUserWhoReceiveAComment" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUserWhoReceiveAComment" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "ReceivedComments<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "ReceivedComments" );
					if ($mlmodules->buscarPorCampo ( array ("idUserWhoMakeComment" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUserWhoMakeComment" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "ReceivedComments<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "Wall" );
					if ($mlmodules->buscarPorCampo ( array ("user_id" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "user_id" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "Wall<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "Wall" );
					if ($mlmodules->buscarPorCampo ( array ("user_id_who" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "user_id_who" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "Wall<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_" . $profile . "WallAlert" );
					if ($mlmodules->buscarPorCampo ( array ("id_user" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "id_user" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_" . $profile . "WallAlert<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_replyMsj" );
					if ($mlmodules->buscarPorCampo ( array ("idUserReply" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUserReply" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_replyMsj<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_replyMsj" );
					if ($mlmodules->buscarPorCampo ( array ("idUserGetReply" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUserGetReply" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_replyMsj<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_sentMsj" );
					if ($mlmodules->buscarPorCampo ( array ("idUserSend" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUserSend" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_sentMsj<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_sentMsj" );
					if ($mlmodules->buscarPorCampo ( array ("idUserRecived" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUserRecived" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_sentMsj<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_videoAlbum" );
					if ($mlmodules->buscarPorCampo ( array ("idUser" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUser" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_videoAlbum<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_videoComment" );
					if ($mlmodules->buscarPorCampo ( array ("idUserCommenting" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUserCommenting" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_videoComment<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_videoComment" );
					if ($mlmodules->buscarPorCampo ( array ("idUserCommenting" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUserCommenting" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_videoComment<br/>";
				}
				
				try {
					$mlmodules = ModelLoader::crear ( "ax_videoUpload" );
					if ($mlmodules->buscarPorCampo ( array ("idUser" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUser" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_videoUpload<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_videoUserVote" );
					if ($mlmodules->buscarPorCampo ( array ("idUser" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUser" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_videoUserVote<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_videoView" );
					if ($mlmodules->buscarPorCampo ( array ("idUser" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUser" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_videoView<br/>";
				}
				try {
					$mlmodules = ModelLoader::crear ( "ax_videoVote" );
					if ($mlmodules->buscarPorCampo ( array ("idUser" => $mlusers->id ) )) {
						$mlmodules->eliminar ( "idUser" );
					}
				} catch ( Exception $ex ) {
					//print "Error: " . "ax_videoVote<br/>";
				}
				$mlperfil = ModelLoader::crear ( "ax_" . $profile );
				if ($mlperfil->buscarPorCampo ( array ("iduser" => $mlusers->id ) )) {
					$mlperfil->eliminar ( "iduser" );
				}
				$mlusers->eliminar ( "id" );
			}
		}
	}

}
$_REQUEST ["modo"] = "listarUsuarios";
$condicionand = array ("1" );
$condicionor = array ("1" );
$perfilesSelect = "";
if ($_REQUEST ["modo"] == "listarUsuarios") {
	if (isset ( $_REQUEST ["criterio"] ) && trim ( $_REQUEST ["criterio"] ) !== "") {
		$condicionor = array ();
		$condicionor [] = "email like '%" . $_REQUEST ["criterio"] . "%'";
		$criterio = str_replace ( "'", '\'', $_REQUEST ["criterio"] );
		$criterio = explode ( " ", $criterio );
		foreach ( $criterio as $cri ) {
			if (trim ( $cri ) != "") {
				$condicionor [] = "name like '%$cri%' ";
				$condicionor [] = "lastname like '%$cri%' ";
			}
		}
		$criterio = implode ( " ", $criterio );
	
	}
	
	if (isset ( $_REQUEST ["perfilesSelect"] ) && trim ( $_REQUEST ["perfilesSelect"] ) !== "") {
		$perfilesSelect = $_REQUEST ["perfilesSelect"];
		$condicionand [] = "profileid='$perfilesSelect'";
	}
}
if (isset ( $_REQUEST ["filtro"] )) {
	switch ($_REQUEST ["filtro"]) {
		case "activos" :
			$condicionand [] = "active=1";
			break;
		case "bloqueados" :
			$condicionand [] = "active=0";
			break;
		case "hoy" :
			$condicionand [] = "registerdate>='" . date ( "Y-m-d 00:00:00" ) . "' and registerdate<='" . date ( "Y-m-d 23:59:59" ) . "'";
			break;
		case "enlinea" :
			$condicionand [] = "not isnull(tiempoutlimaactividad) and tiempoutlimaactividad>='" . date ( "Y-m-d H:i:s", $antes ) . "' and tiempoutlimaactividad<='" . date ( "Y-m-d H:i:s", $ahora ) . "'";
			break;
		case "usuarios" :
			$condicionand [] = "profileid>=2 and profileid<=23 and email not like ('%@hgisport.com%')";
			break;
		case "company" :
			$condicionand [] = "(profileid<2 or profileid>23) and email not like ('%@hgisport.com%')";
			break;
		case "activosu" :
			$condicionand [] = "active=1 and (profileid<=24 or profileid>=28) and email not like ('%@hgisport.com%')";
			break;
		case "activosco" :
			$condicionand [] = "active=1 and profileid=27 and email not like ('%@hgisport.com%')";
			break;
		case "activoscl" :
			$condicionand [] = "active=1 and profileid=26 and email not like ('%@hgisport.com%')";
			break;
		case "activosfu" :
			$condicionand [] = "active=1 and profileid=25 and email not like ('%@hgisport.com%')";
			break;
		default :
			$condicionand [] = "1";
			break;
	}
	$condicionand [] = "email not like ('%@hgisport.com%')";
} else {
	$condicionand [] = "email not like ('%@hgisport.com%')";
}

$condicionand = implode ( " and ", $condicionand );
$condicionor = "(" . implode ( " or ", $condicionor ) . ")";

$condicion = $condicionor . " and " . $condicionand;

if (! isset ( $_REQUEST ["asc"] )) {
	$_REQUEST ["asc"] = "desc";
}
if (isset ( $_REQUEST ["order"] )) {
	switch ($_REQUEST ["order"]) {
		case "registerDate" :
			$order = " order by RegisterDate " . $_REQUEST ["asc"] . ", id " . $_REQUEST ["asc"];
			break;
		default :
			$order = " order by " . $_REQUEST ["order"] . " " . $_REQUEST ["asc"];
			break;
	}

} else {
	$order = " order by id desc";
}

$listaprofiles = $mlprofile->listar ( "1 order by profile asc" );
$selectprofile = $mlprofile->aSelect ( $listaprofiles, "perfilesSelect", "idProfile", "profile", $perfilesSelect, true, "Todos" );

$lista = $mlusers->listar ( $condicion . $order, $p * $tama, $tama );
//print $condicion.$order;
$novisibles = array ("passworduser", "countryid", "cityid", "cityname", "languageid", "profileid", "hidden", "complete", "joomla", "emailprivacy" );
$tabla = $mlusers->aTabla ( $lista, $novisibles, "", 0, true );
$ul = new Tag ( "ul" );
$ul->class = "paginacion";
if ($tabla->getTag () == "table") {
	$tabla->border = 1;
	$tabla->cellpadding = "5";
	$tabla->align = "center";
	$tabla->addHead ( "Enlinea" );
	$tabla->addHead ( "Check" );
	$total = $mlusers->contar ( $condicion );
	$paginas = ceil ( $total / $tama );
	if ($paginas > 1) {
		for($i = 0; $i < $paginas; $i ++) {
			$ul->add ( new Tag ( "li", new Tag ( "a", "" . ($i + 1), array ("href" => "#", "onclick" => "return irPagina($i);" ) ) ) );
		}
	}
	$campos = $mlusers->campos ();
	$index = 0;
	foreach ( $campos as $campo => $valor ) {
		if (array_search ( $campo, $novisibles ) === false) {
			$columna = $mlusers->buscarColumna ( $campo );
			if ($columna instanceof CampoTabla) {
				$td = $tabla->getHead ( $index );
				$td->clear ();
				$td->add ( new Tag ( "a", $columna->Comentario () ? $columna->Comentario () : ucfirst ( $columna->Nombre () ), array ("href" => "#", "onclick" => "return order('" . $columna->Nombre () . "');" ) ) );
				$index ++;
			}
		}
	}
	$hoy = date ( "Y-m-d" );
	$count = $p * $tama;
	$thead = $tabla->getHead ( 0 )->getParent ();
	$thead->insert ( new Tag ( "td", "Nº" ), 0 );
	$thead->insert ( new Tag ( "td", "Tipo Perfil" ), 5 );
	$thead->insert ( new Tag ( "td", "País Real" ), 10 );
	$tparray = array ();
	foreach ( $lista as $i => $item ) {
		$row = $tabla->getRow ( $i );
		$row->insert ( new Tag ( "td", "" . ($count + $i + 1) ), 0 );
		$tipoperfil = "Indefinido";
		if (isset ( $tparray [$item->profileid] )) {
			$tipoperfil = $tparray [$item->profileid];
		} else if ($mlprofile->buscarPorCampo ( array ("idProfile" => $item->profileid ) )) {
			$tipoperfil = $mlprofile->profile;
			$tparray [$item->profileid] = $mlprofile->profile;
		}
		$row->insert ( new Tag ( "td", $tipoperfil ), 5 );
		
		$col = $tabla->getColumn ( $i, 4 );
		$col->clear ();
		if ($item->sex === "1") {
			$col->add ( "Hombre" );
		} else {
			$col->add ( "Mujer" );
		}
		if ($item->registerdate == $hoy) {
			$col = $tabla->getColumn ( $i, 8 );
			$col->clear ();
			$col->add ( "Hoy" );
		}
		
		$tabla->getColumn ( $i, 9 )->setAttribute ( "style", "cursor:pointer;text-decoration:underline;" )->onclick = "desgloseIP('$item->ipAddress');";
		
		$pais = "Indefinido";
		if (trim ( $item->ipAddress ) !== "") {
			if (! $mlip->buscarPorCampo ( array ("ip" => $item->ipAddress ) )) {
				$mlip->ip = $item->ipAddress;
				$mlip->pais = Idioma::darCodigo2AlfaPais ( $item->ipAddress );
				$mlip->insertar ();
			}
			if ($mlpais->buscarPorCampo ( array ("Code2" => $mlip->pais ) )) {
				$pais = $mlpais->country;
			}
		}
		$row->insert ( new Tag ( "td", $pais ), 10 );
		
		$imagen = "photoGeneral/small/small_" . $item->photo;
		$col = $tabla->getColumn ( $i, 11 );
		$col->clear ();
		if (is_file ( $imagen )) {
			$col->add ( new Tag ( "img", "", array ("src" => $imagen ) ) );
		} else {
			$col->add ( "{Ninguno}" );
		}
		$col = $tabla->getColumn ( $i, 12 );
		$col->clear ();
		if ($item->active === "1") {
			$col->add ( "Si" );
		} else {
			$col->add ( "No" );
		}
		
		$col = $tabla->getColumn ( $i, 14 );
		$col->clear ();
		if ($item->destacado === "1") {
			$col->add ( "Si" );
		} else {
			$col->add ( "No" );
		}
		$tiempo = strtotime ( $item->tiempoutlimaactividad );
		if ($tiempo >= $antes && $tiempo <= $ahora) {
			$tabla->addColumn ( "Si", $i );
		} else {
			$tabla->addColumn ( "No", $i );
		}
		$tabla->addColumn ( new Tag ( "input", "", array ("type" => "checkbox", "value" => $item->id, "name" => "IdUser" ) ), $i );
	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style>
.paginacion {
	list-style: none;
	padding: 0px;
	margin: 0px;
}

.paginacion li {
	float: left;
}

.paginacion li a {
	float: left;
	text-decoration: none;
	padding: 3px 5px;
	border: 1px solid black;
	color: black;
	margin: 1px;
}

.paginacion li a:hover {
	background: silver;
}

table {
	font-size: 1em;
}

table td {
	text-align: center;
}

table thead td {
	color: white;
	font-weight: bold;
	background: black;
}

table thead td a {
	text-decoration: none;
	color: white;
}

table thead td a:hover {
	text-decoration: underline;
}

table.general thead td:hover {
	cursor: pointer;
	text-decoration: underline;
}

body {
	font-family: arial;
	font-size: 11px;
}
</style>
<script type="text/javascript" src="goaamb/js/G.js"></script>
<script type="text/javascript" src="goaamb/js/publicidad.js"></script>
<script type="text/javascript" src="goaamb/js/jquery.js"></script>
<script type="text/javascript" src="goaamb/js/jquery-ui.js"></script>
<script type="text/javascript" src="goaamb/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="goaamb/css/ui-darkness/jquery-ui.css" />
<script type="text/javascript">
function accion(accion){
	var adicion=G.dom.$$("IdUser");
	if(adicion){
		var add=[];
		for ( var i = 0; i < adicion.length; i++) {
			if(adicion[i].checked){
				add.push(adicion[i].value);
			}
		}
		this.destacados.value=add.join(",");
		this.modo.value=accion;
		this.submit();
	}
}
function irPagina(n){
	location.href=G.url._setGET("p", n);
	return false;
}
function order(order){
	var orderx=G.url._GET("order");
	var url=G.url._setGET("order", order);
	if(order===orderx){
		if(G.url._GET("asc", url)=="desc"){
			location.href=G.url._setGET("asc", "asc",url);
			return false;
		}
	}
	location.href=G.url._setGET("asc", "desc",url);
	return false;
}
function filtrar(filtro){
	var url=G.url._setGET("p", "0");
	url=G.url._setGET("asc", "desc",url);
	location.href=G.url._setGET("filtro", filtro,url);
}
function ventanaMasivo(){
	var a=new G.ajax({
			pagina:"greader.php",
			post:{
				__q:"ventana/masivo"
			},
			accion:function(){
				$("#ventanaEmergente").dialog({title:"Envio Masivo de Mails",width:1000,height:500});
				activarEditor("editorMensaje");
			}
		});
	a.recibir("ventanaEmergente");
}

function enviarMailMasivo(){
	if(this.asunto && this.mensaje && this.mensaje.editor){
		this.mensaje.value=this.mensaje.editor.getData();
		if(G.util.trim(this.asunto.value)===""){
			this.asunto.focus();
			return;
		}
		if(G.util.trim(this.mensaje.value)===""){
			this.mensaje.focus();
			return;
		}
		var a=new G.ajax({
			pagina:"greader.php",
			post:{
				__q:"proceso/masivo",
				asunto:this.asunto.value,
				mensaje:this.mensaje.value
			},
			json:true,
			accion:function(){
				$("#ventanaEmergente").dialog("close");
			}
		});
		a.enviar();
	}
}

function activarEditor( idEditor ) {
	var e = G.dom.$(idEditor);
	if (e) {
		if (G.nav.isIE && G.nav.version < 7) {
			setTimeout(
					'mensaje("El editor no se puede ver en el presente navegador, por que su motor de renderizado es muy antiguo, actualicelo o descargue Google Chrome: <a href=\'http://www.google.com/chrome?hl=es\'>Google chrome</a>",true);',
					1000);
		} else {
			var desc2 = G.dom.$("descricionX2");
			if (!desc2) {
				desc2 = G.dom.create("div", "descricionX2");
			}
			var d = e;
			d.style.display = "none";
			desc2.style.display = "block";
			d.parentNode.appendChild(desc2);
			d.editor = CKEDITOR.appendTo('descricionX2', {
				skin : 'office2003',
				filebrowserBrowseUrl : 'goaamb/filemanager/index.html'
			});
			d.editor.setData(d.value);
		}
	}
}
function removerEditor(idEditor) {
	var e = G.dom.$(idEditor);
	if (e) {
		var desc2 = G.dom.$("descricionX2");
		if (desc2) {
			var d = e;
			d.style.display = "block";
			desc2.style.display = "none";
			desc2.innerHTML = "";
			CKEDITOR.remove(d.editor);
			d.editor = null;
		}
	}
}
function ventanaLog(){
	var a=new G.ajax({
		pagina:"greader.php",
		post:{
			__q:"ventana/log"
		},
		accion:function(){
			$("#ventanaEmergente").dialog({title:"Historial Ultimas Actividades",width:1000,height:600});
		}
	});
	a.recibir("ventanaEmergente");
}
function ventanaSeguimiento(){
	var a=new G.ajax({
		pagina:"greader.php",
		post:{
			__q:"ventana/seguimiento"
		},
		accion:function(){
			$("#ventanaEmergente").dialog({title:"Seguimiento IP",width:1000,height:600});
		}
	});
	a.recibir("ventanaEmergente");
}
function desgloseIP(ip){
	var a=new G.ajax({
		pagina:"greader.php",
		post:{
			__q:"ventana/seguimiento",
			__a:"desgloseIP",
			ip:ip
		},
		accion:function(){
			$("#ventanaEmergente").dialog({title:"Seguimiento IP: "+this.post.ip,width:1000,height:600});
		}
	});
	a.recibir("ventanaEmergente");
}

function traducirGoogle(){
	var a=new G.ajax({
		pagina:"greader.php",
		post:{
			__q:"proceso/translate",
			__a:"translateAll"
		},
		json:true,
		boton:this,
		accion:function(){
			this.boton.value="Traducir con Google";
			this.boton.disabled=null;
			if(this.JSON && this.JSON.success){
				alert("Se Tradujo con exito");
			}
			else{
				alert("Ocurrio un error vuelva a Intentarlo");
			}
		}
	});
	this.disabled="disabled";
	this.value="traduciendo...";
	a.enviar();
}

function eliminar(){
	if(confirm("¿En realidad deseas eliminar este usuario?, todos sus datos se perderan.")){
		accion.call(this,'eliminar');
	}
}
function verAnuncios(){
	(new G.ajax({
		pagina:"admAnuncio.php",
		post:{},
		accion:function(){
			$("#ventanaEmergente").dialog({title:"Anuncios dentro SOCCERMASH.com",width:1000,height:600});
			G.dom.$("iframeFake").onjsonready=formAdmAnuncioReady;
			recargarPaginaAnuncio();
		}
	})).recibir("ventanaEmergente");
}
</script>
</head>
<body><?php
$table->htmlprint ();
?><form action="" method="get"><input name="modo" value="listarUsuarios"
	type="hidden"> <input name="criterio"
	value="<?php
	print $criterio;
	?>" /><?php
	$selectprofile->htmlprint ();
	?><input type="submit" value="Buscar" /><input type="button"
	value="Todos" onclick="this.form.criterio.value='';this.form.submit();" /></form>
<?php
ob_start ();
?><form action="" method="post"><input name="modo" value="destacar"
	type="hidden"><input name="destacados" type="hidden"> <input
	name="criterio" value="<?php
	print $_REQUEST ["criterio"];
	?>"
	type="hidden" /><input type="button" value="Eliminar Usuarios"
	onclick="eliminar.call(this.form);" /><input type="button"
	value="Destacar" onclick="accion.call(this.form,'destacar');" /><input
	type="button" value="Quitar Destacado"
	onclick="accion.call(this.form,'nodestacar');" /><input type="button"
	value="Bloquear" onclick="accion.call(this.form,'bloquear');" /><input
	type="button" value="Habilitar"
	onclick="accion.call(this.form,'habilitar');" /> <input
	value="Envio Masivo" onclick="ventanaMasivo();" type="button" /><input
	value="Historial" onclick="ventanaLog();" type="button" /><input
	value="Seguimiento IP" onclick="ventanaSeguimiento();" type="button" /><input
	value="Traducir con Google" type="button"
	onclick="traducirGoogle.call(this)" /><input value="Anuncios"
	type="button" onclick="verAnuncios();" /></form><?php
	$formaccion = ob_get_clean ();
	$divclear = new Tag ( "div", "", array ("style" => "clear:both;margin:10px 0px;" ) );
	print $formaccion;
	$ul->htmlprint ();
	$divclear->htmlprint ();
	$tabla->htmlprint ( Tag::NOUTF8_ENCODE );
	$ul->htmlprint ();
	$divclear->htmlprint ();
	print $formaccion;
	?><div id="ventanaEmergente" style="display: none;"></div>
</body>
</html>