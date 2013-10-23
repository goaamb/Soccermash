<?php
require_once 'goaamb/web/select.php';
if (function_exists ( $_POST ["__a"] )) {
	call_user_func ( $_POST ["__a"] );
} else {
	print ("La accion no existe") ;
}

function desplegarAdmAnuncio() {
	if (! isset ( $_SESSION ["bSoccerUser"] )) {
		?><form action="/greader.php" method="post" target="iframefake"><input
	name="__q" value="proceso/anuncio" type="hidden" /> <input name="__a"
	value="loginAnuncio" type="hidden" />
<table>
	<tbody>
		<tr>
			<td>Usuario:</td>
			<td><input name="usuario" /></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input name="password" type="password" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="Login" /></td>
		</tr>
	</tbody>
</table>
</form><?php
	} else {
		?>
<center><?php
		if (isset ( $_SESSION ["bSoccerType"] ) && $_SESSION ["bSoccerType"] === "Administrador") {
			?><input type="button" value="Anuncios Tipo1"
	onclick="listarAnunciosTipo1Pendientes();" /> <?php
		}
		?><input type="button" value="Formularios"
	onclick="listarFormulariosPendientes();" /> <input type="button"
	value="Anuncios Tipo2" onclick="listarAnunciosPendientes();" /> <input
	type="button" value="Salir" onclick="salirAdmAnuncio();" /></center>
<div id="lista"></div>
<?php
	}
}

function listarFormulariosPendientes() {
	$ml = ModelLoader::crear ( "ax_formularioAnuncioTipo2" );
	$lista = $ml->listar ( "1 order by estado desc,fecha desc" );
	$tabla = $ml->aTabla ( $lista, array ("id" ) );
	$tabla->cellpadding = "5";
	$tabla->border = "1";
	$tabla->width = "80%";
	$tabla->align = "center";
	$mlgr = ModelLoader::crear ( "ax_generalRegister" );
	foreach ( $lista as $i => $item ) {
		$col = $tabla->getColumn ( $i, 2 );
		$col->clear ();
		if ($mlgr->buscarPorCampo ( array ("id" => $item->anunciante ) )) {
			$col->add ( $mlgr->name . " " . $mlgr->lastname . " - " . $mlgr->email );
		} else {
			$col->add ( "{No Existente}" );
		}
		if ($item->estado == 'Inactivo') {
			$col = $tabla->getColumn ( $i, 9 );
			$col->clear ();
			$select = new Select ( array ("Inactivo", "Activo" ) );
			$select->onchange = "cambiarEstadoFormulario.call(this,$item->id);";
			$col->add ( $select );
		}
	}
	
	$tabla->htmlprint ( Tag::NOUTF8_ENCODE );
}
function listarAnunciosPendientes() {
	$ml = ModelLoader::crear ( "ax_anuncioTipo2" );
	$lista = $ml->listar ( "1 order by activo desc,fecha_inicio desc" );
	$tabla = $ml->aTabla ( $lista, array ("id", "codigo" ) );
	$mlgr = ModelLoader::crear ( "ax_generalRegister" );
	$mlpais = ModelLoader::crear ( "ax_country" );
	$listapaises = $mlpais->listar ( "1 order by country asc" );
	$dir = "/goaamb/images/publi/thumb/";
	$tabla->cellpadding = "5";
	$tabla->border = "1";
	$tabla->width = "80%";
	$tabla->align = "center";
	$tabla->addHead ( "Accion" );
	foreach ( $lista as $i => $item ) {
		$col = $tabla->getColumn ( $i, 4 );
		$col->clear ();
		if ($mlgr->buscarPorCampo ( array ("id" => $item->anunciante ) )) {
			$col->add ( $mlgr->name . " " . $mlgr->lastname . " - " . $mlgr->email );
		} else {
			$col->add ( "{No Existente}" );
		}
		$col = $tabla->getColumn ( $i, 1 );
		$col->clear ();
		$file = $dir . $item->imagen1;
		if (is_file ( $_SERVER ["DOCUMENT_ROOT"] . $file )) {
			$col->add ( new Tag ( "img", "", array ("src" => $file ) ) );
		} else {
			$col->add ( "{Ninguno}" );
		}
		$col = $tabla->getColumn ( $i, 2 );
		$col->clear ();
		$file = $dir . $item->imagen2;
		if (is_file ( $_SERVER ["DOCUMENT_ROOT"] . $file )) {
			$col->add ( new Tag ( "img", "", array ("src" => $file ) ) );
		} else {
			$col->add ( "{Ninguno}" );
		}
		$col = $tabla->getColumn ( $i, 3 );
		$col->clear ();
		$file = $dir . $item->imagen3;
		if (is_file ( $_SERVER ["DOCUMENT_ROOT"] . $file )) {
			$col->add ( new Tag ( "img", "", array ("src" => $file ) ) );
		} else {
			$col->add ( "{Ninguno}" );
		}
		
		$col = $tabla->getColumn ( $i, 5 );
		$col->clear ();
		$select = new Select ( array ("Si", "No" ), Select::SAMEVALUES, $item->activo );
		$select->onchange = "cambiarActivoInactivo.call(this,$item->id);";
		$col->add ( $select );
		
		$col = $tabla->getColumn ( $i, 8 );
		$col->clear ();
		$paises = explode ( ",", $item->paises );
		$col->add ( $div = new Tag ( "div", "", array ("id" => "capaPaises$item->id" ) ) );
		foreach ( $paises as $paisid ) {
			if ($mlpais->buscarPorCampo ( array ("code2" => $paisid ) )) {
				$div->add ( $div2 = new Tag ( "div", "", array ("class" => "capaPaises" ) ) );
				$div2->add ( new Tag ( "span", $mlpais->country, array ("class" => "nombre" ) ) );
				$div2->add ( new Tag ( "span", "x", array ("onclick" => "eliminarPais.call(this,'$mlpais->code2','$item->id');", "class" => "cerrar" ) ) );
			}
		}
		$col->add ( new Tag ( "div", new Tag ( "input", "", array ("value" => "", "id" => "buscarPais$item->id", "onkeyup" => "buscarPais.call(this,'$item->id');", "class" => "buscarPais" ) ), array ("class" => "capaBuscador" ) ) );
		$tabla->addColumn ( new Tag ( "input", "", array ("type" => "button", "value" => "Eliminar", "onclick" => "eliminarAnuncio.call(this,'$item->id')" ) ), $i );
	}
	$select = $mlpais->aSelect ( $listapaises, "listaPaises", "code2", "country", "", true, "Seleccione un pais" );
	$tabla->htmlprint ( Tag::NOUTF8_ENCODE );
	$select->multiple = "multiple";
	$select->onchange = "seleccionarPais.call(this)";
	$select->htmlprint ( Tag::NOUTF8_ENCODE );
}
function listarAnunciosTipo1Pendientes() {
	global $_IDIOMA;
	$ml = ModelLoader::crear ( "ax_anuncioTipo1" );
	$lista = $ml->listar ( "1 order by activo desc,fecha_inicio desc" );
	$tabla = $ml->aTabla ( $lista, array ("id" ) );
	$mlgr = ModelLoader::crear ( "ax_generalRegister" );
	$mlpais = ModelLoader::crear ( "ax_country" );
	$dir = "/goaamb/images/publi/thumb/";
	$tabla->cellpadding = "5";
	$tabla->border = "1";
	$tabla->width = "80%";
	$tabla->align = "center";
	$mlperfil = ModelLoader::crear ( "ax_profile" );
	$tabla->addHead ( "Accion" );
	foreach ( $lista as $i => $item ) {
		$col = $tabla->getColumn ( $i, 0 );
		$col->clear ();
		$col->add(($item->titulo));
		$col = $tabla->getColumn ( $i, 2 );
		$col->clear ();
		$file = $dir . $item->imagen;
		if (is_file ( $_SERVER ["DOCUMENT_ROOT"] . $file )) {
			$col->add ( new Tag ( "img", "", array ("src" => $file ) ) );
		} else {
			$col->add ( "{Ninguno}" );
		}
		$col = $tabla->getColumn ( $i, 3 );
		$col->clear ();
		$url = $item->url;
		$url = explode ( "::--::", $url );
		if (count ( $url ) > 0) {
			switch ($url [0]) {
				case "http2" :
					$col->add ( "http://www.soccermash.com/" . $_IDIOMA->traducir ( "user" ) . "/" . $url [1] );
					break;
				default :
					$col->add ( "http://" . $url [1] );
					break;
			}
		}
		
		$col = $tabla->getColumn ( $i, 4 );
		$col->clear ();
		if ($mlgr->buscarPorCampo ( array ("id" => $item->anunciante ) )) {
			$col->add ( $mlgr->name . " " . $mlgr->lastname . " - " . $mlgr->email );
		} else {
			$col->add ( "{No Existente}" );
		}
		$col = $tabla->getColumn ( $i, 5 );
		$col->clear ();
		switch ($item->sexo) {
			case "*" :
				$col->add ( $_IDIOMA->traducir ( "Todos" ) );
				break;
			default :
				$col->add ( $item->sexo );
				break;
		}
		
		$col = $tabla->getColumn ( $i, 6 );
		$col->clear ();
		$select = new Select ( array ("Si", "No" ), Select::SAMEVALUES, $item->activo );
		$select->onchange = "cambiarActivoInactivoAnuncioTipo1.call(this,$item->id);";
		$col->add ( $select );
		
		$col = $tabla->getColumn ( $i, 9 );
		$col->clear ();
		if ($item->paises != "*") {
			$paises = explode ( ",", $item->paises );
			$col->add ( $div = new Tag ( "div", "", array ("id" => "capaPaises$item->id" ) ) );
			foreach ( $paises as $paisid ) {
				if ($mlpais->buscarPorCampo ( array ("code2" => $paisid ) )) {
					$div->add ( $div2 = new Tag ( "div", $mlpais->country, array ("class" => "capaPaises" ) ) );
				}
			}
		} else {
			$col->add ( "Todos" );
		}
		
		$col = $tabla->getColumn ( $i, 10 );
		$col->clear ();
		if (! $item->desde) {
			$col->add ( $_IDIOMA->traducir ( "Any age" ) );
		} else {
			$col->add ( $item->desde );
		}
		$col = $tabla->getColumn ( $i, 11 );
		$col->clear ();
		if (! $item->hasta) {
			$col->add ( $_IDIOMA->traducir ( "Any age" ) );
		} else {
			$col->add ( $item->hasta );
		}
		$col = $tabla->getColumn ( $i, 12 );
		$col->clear ();
		$perfiles = explode ( "::-::", $item->perfiles );
		if (count ( $perfiles ) > 0) {
			if ($perfiles [0] === "*") {
				$col->add ( $_IDIOMA->traducir ( "All Profile types" ) );
			} else {
				foreach ( $perfiles as $perfil ) {
					if ($mlperfil->buscarPorCampo ( array ("idprofile" => $perfil ) )) {
						$col->add ( $_IDIOMA->traducir ( $mlperfil->profile ) );
					}
				}
			}
		}
		$col = $tabla->getColumn ( $i, 16 );
		$col->clear ();
		$select = new Select ( array ("Si", "No" ), Select::SAMEVALUES, $item->pagado );
		$select->onchange = "cambiarPagadoAnuncioTipo1.call(this,$item->id);";
		$col->add ( $select );
		$tabla->addColumn ( new Tag ( "input", "", array ("type" => "button", "value" => "Eliminar", "onclick" => "eliminarAnuncioTipo1.call(this,'$item->id')" ) ), $i );
	}
	$tabla->htmlprint ( Tag::NOUTF8_ENCODE );
}
?>