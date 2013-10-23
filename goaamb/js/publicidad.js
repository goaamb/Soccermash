var dirgo = "/goaamb/images/publi/thumb/";
var src = "/goaamb/images/publi/full/";
function procesarJSONAnuncio() {
	var c = this.contentWindow.document;
	if (c) {
		var b = G.dom.$$$("body", 0, c);
		if (b) {
			var json;
			try {
				eval("json=" + b.innerHTML);
				if (this.onjsonready) {
					this.onjsonready(json);
				}
			} catch (e) {

			}
		}
	}
	return true;
}
function procesarImagen(i) {
	var text = this["imagen-real"].value;
	var texta = text.split("/");
	if (texta.length > 1) {
		text = texta.pop();
	} else {
		texta = text.split("\\");
		if (texta.length > 1) {
			text = texta.pop();
		}
	}
	this["imagen" + i].value = text;
	var iff = G.dom.$$("iframeFakeAdvertisement");
	for ( var int = 0; int < iff.length; int++) {
		iff[int].who = i;
	}

	this.submit();
	$("#contenidoLoading").show();
	$("#editorContenido").hide();
	$("#prosImage26").hide();
	$("#prosImage26A").hide();
	$("#prosImage36").hide();
	$("#cargando6").show();
}

function formAnuncioReady(json) {
	if (json) {
		if (json.imgdir && !json.exito) {
			var f = G.dom.$("formImagen" + this.who);
			if (f) {
				$("#contenidoLoading").hide();
				$("#cargando6").hide();
				$("#editorContenido").show();
				var ff = G.dom.$("formRevisarAnuncio");
				f.imagedir.value = json.imgdir + "?rand=" + Math.random();
				if (ff) {
					ff["imagen" + this.who].value = f.imagedir.value;
				}
				f["imagen-real"].value = "";
				f["imagen" + this.who].value = "";
				var imgdirbase = "/goaamb/images/publi/full/";
				if (this.who == 6) {
					imgdirbase = "/photoGeneral/";
				}
				$("#editor").cropper({
					image : imgdirbase + f.imagedir.value
				});
				var ec = G.dom.$("editorContenido");
				ec.parentNode.removeChild(ec);
				G.dom.$("contenidoEditor" + this.who).appendChild(ec);
				$("#editorContenido").show();
				$("#imageWidth").val(json.wf);
				$("#imageHeight").val(json.hf);
				$("#imagenEditor").val(f.imagedir.value);
				$("#imageWho").val(this.who);
				$("#prosImage2" + this.who).hide();
				$("#prosImage3" + this.who).show();
				src = "/goaamb/images/publi/full/";
				switch (this.who) {
				case 2:
					imagenAncho = 103;
					imagenAlto = 33;
					break;
				case 3:
					imagenAncho = 45;
					imagenAlto = 45;
					break;
				case 4:
					imagenAncho = 180;
					imagenAlto = 50;
					break;
				case 5:
					imagenAncho = 80;
					imagenAlto = 80;
					$("#todoconte").show();
					$("#botonEdit").hide();
					$("#previewAnuncioTipo21").hide();
					$("#previewAnuncioTipo22").hide();
					$("#title21").hide();
					$("#title22").hide();
					break;
				case 6:
					imagenAncho = 180;
					imagenAlto = 180;
					$("#prosImage2" + this.who + "A").hide();
					src = "/photoGeneral/";
					$("#formRevisarAnuncio").hide();
					break;
				default:
					imagenAncho = 60;
					imagenAlto = 25;
					break;
				}
				if (json.conf) {
					var form = G.dom.$("formEditor");
					if (form) {
						$(form.imageWidth).val(json.conf.iw);
						$(form.imageHeight).val(json.conf.ih)
						$(form.crop_width).val(json.conf.cw);
						$('#crop_area').width(json.conf.cw + 'px');
						$(form.crop_height).val(json.conf.ch);
						$('#crop_area').height(json.conf.ch + 'px');
						$(form.crop_offset_top).val(json.conf.ct);
						$('#crop_area').css('top', json.conf.ct + 'px');
						$(form.crop_offset_left).val(json.conf.cl);
						$('#crop_area').css('left', json.conf.cl + 'px');
					}
				}
				verImagen();
			}
		} else if (json.imgdir && !json.revisar && !json.miAnunciante
				&& !json.miPhotoProfile) {
			$("#editorContenido").hide();
			$("#prosImage2" + this.who).show();
			$("#prosImage3" + this.who).hide();
			var f = G.dom.$("formRevisarAnuncio");
			var iw = f["imagen" + this.who];
			var imgfinal = json.imgdir + "?rand=" + Math.random();
			if (iw) {
				iw.value = imgfinal;
			}

			switch (this.who) {
			case 5:
				var imgfinal = json.imgdir + "?rand=" + Math.random();
				$("#todoconte").hide();
				$("#imagenAnuncioTipo21").attr("src", dirgo + imgfinal).attr(
						"rel", json.imgdir);
				G.dom.$("textoAnuncioTipo21").innerHTML = f.texto.value;
				G.dom.$("tituloAnuncioTipo21").innerHTML = f.titulo.value;
				$("#previewAnuncioTipo21").show();
				$("#title21").show();
				$("#imagenAnuncioTipo22").attr("src", dirgo + imgfinal).attr(
						"rel", json.imgdir);
				G.dom.$("textoAnuncioTipo22").innerHTML = f.texto.value;
				G.dom.$("tituloAnuncioTipo22").innerHTML = f.titulo.value;
				$("#previewAnuncioTipo22").show();
				$("#title22").show();
				$("#botonEdit").show();
				$("#botonEdit").attr("rel", json.imgdir);
				break;
			case 6:
				var imgfinal = json.imgdir;
				$("#imagenFinal" + this.who).attr("src",
						"/photoGeneral/big/" + imgfinal).attr("rel",
						json.imgdir);
				$("#imagenFinalA" + this.who).attr("src",
						"/photoGeneral/small/small_" + imgfinal).attr("rel",
						json.imgdir);
				$("#prosImage2" + this.who + "A").show();
				$("#formRevisarAnuncio").show();
				$("#showPhoto").find("img").attr("src",
						"/photoGeneral/big/" + imgfinal);
				break;

			default:
				$("#imagenFinal" + this.who).attr("src", dirgo + imgfinal)
						.attr("rel", json.imgdir).show();
				break;
			}
		} else if (json.error) {
			$('#Errormsgs').show().html(json.error);
			$('.Errormsgs').show().html(json.error);
			$('#errorPay').show().html(json.error);
			$("#procesandoPago").hide();
			$("#formPago").show();
			$("#loadingEmergente").hide();
		} else if (json.revisar && json.exito) {
			if (this.who === 6) {
			} else if (this.who === 5) {
				$("#accountContent").load(
						'gestion/modulos/home/summaryAdvertisement1.php', {
							'id' : json.id
						}, function() {
							$('body').scrollTop(0);
							$("#loadingEmergente").hide();
						});
			} else {
				$("#accountContent").load(
						'gestion/modulos/home/summaryAdvertisement.php', {
							'id' : json.id
						}, function() {
							$('body').scrollTop(0);
						});
			}
		} else if (json.miAnunciante && json.exito) {
			$('#alertEmergente').hide();
			$('#alertEmergente0').hide();
			var img = G.dom.$("imgMySponsor");
			if (img) {
				img.src = dirgo + json.imgdir + "?rand=" + Math.random();
			}
		} else if (json.miPhotoProfile && json.exito) {
			$('#alertEmergente').hide();
			$('#alertEmergente0').hide();
			var img = G.dom.$("showPhoto");
			if (img) {
				location.href = 'home.php';
			}
		} else if (json.status) {
			if (json.code) {
				$("#alertEmergenteDatos").html('');
				$("#alertEmergenteDatos").load(
						'gestion/modulos/home/payment/approved.php');
				$('#alertEmergente').show();
				$('#alertEmergente0').show();
			}
		}
	}
}

function recargarPaginaAnuncio() {
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "ventana/anuncio",
			__a : "desplegarAdmAnuncio"
		},
		accion : function() {
			listarFormulariosPendientes();
		}
	})).recibir("contenidoAnuncio");
}
onResizing = onResizeStop = onDragStop = onDragging = verImagen;
var imagenAncho = 60;
var imagenAlto = 25;
var imagenAnchop = 50;
var imagenAltop = 50;
function verImagen() {
	var form = G.dom.$("formEditor");
	if (form) {
		var w = parseInt(form.imageWidth.value, 10);
		w = (isNaN(w) ? 0 : w);
		var h = parseInt(form.imageHeight.value, 10);
		h = (isNaN(h) ? 0 : h);
		var cw = parseInt(form.crop_width.value, 10);
		cw = (isNaN(cw) ? 0 : cw);
		var ch = parseInt(form.crop_height.value, 10);
		ch = (isNaN(ch) ? 0 : ch);
		var ct = parseInt(form.crop_offset_top.value, 10);
		ct = (isNaN(ct) ? 0 : ct);
		var cl = parseInt(form.crop_offset_left.value, 10);
		cl = (isNaN(cl) ? 0 : cl);
		var auxw = imagenAncho;
		var auxh = imagenAlto;
		var rw = cw;
		var rh = ch;
		var fmx = 1;
		var fmy = 1;
		if (rw > auxw) {
			rw = auxw;
			rh = Math.ceil(auxw * ch / cw);
		}
		if (rh > auxh) {
			rh = auxh;
			rw = Math.ceil(auxh * cw / ch);
		}
		fmx = rw / cw;
		fmy = rh / ch;
		var imgP = G.dom.$("imagePreview");
		var cP = G.dom.$("croppedPreview");
		var dP = G.dom.$("preview");
		imgP.src = src + form.imagenEditor.value;
		imgP.style.left = -Math.ceil(cl * fmx) + "px";
		imgP.style.top = -Math.ceil(ct * fmy) + "px";
		imgP.style.width = Math.ceil(w * fmx) + "px";
		imgP.style.height = Math.ceil(h * fmy) + "px";
		cP.style.width = rw + "px";
		cP.style.height = rh + "px";
		dP.style.width = auxw + "px";
		dP.style.height = auxh + "px";
		if (rw < auxw) {
			cP.style.left = Math.ceil((auxw - rw) / 2) + "px";
		} else {
			cP.style.left = "0px";
		}
		if (rh < auxh) {
			cP.style.top = Math.ceil((auxh - rh) / 2) + "px";
		} else {
			cP.style.top = "0px";
		}
		var imgP = G.dom.$("imagePreview2");
		if (imgP) {
			cP = G.dom.$("croppedPreview2");
			dP = G.dom.$("preview2");
			imgP.src = src + form.imagenEditor.value;
			imgP.style.left = -Math.ceil(cl * fmx) + "px";
			imgP.style.top = -Math.ceil(ct * fmy) + "px";
			imgP.style.width = Math.ceil(w * fmx) + "px";
			imgP.style.height = Math.ceil(h * fmy) + "px";
			cP.style.width = rw + "px";
			cP.style.height = rh + "px";
			dP.style.width = auxw + "px";
			dP.style.height = auxh + "px";
			if (rw < auxw) {
				cP.style.left = Math.ceil((auxw - rw) / 2) + "px";
			} else {
				cP.style.left = "0px";
			}
			if (rh < auxh) {
				cP.style.top = Math.ceil((auxh - rh) / 2) + "px";
			} else {
				cP.style.top = "0px";
			}
		}
		var imgP = G.dom.$("imagePreviewA");
		if (imgP) {
			auxw = 50;
			auxh = 50;
			if (rw > auxw) {
				rw = auxw;
				rh = Math.ceil(auxw * ch / cw);
			}
			if (rh > auxh) {
				rh = auxh;
				rw = Math.ceil(auxh * cw / ch);
			}
			fmx = rw / cw;
			fmy = rh / ch;
			cP = G.dom.$("croppedPreviewA");
			dP = G.dom.$("previewA");
			imgP.src = src + form.imagenEditor.value;
			imgP.style.left = -Math.ceil(cl * fmx) + "px";
			imgP.style.top = -Math.ceil(ct * fmy) + "px";
			imgP.style.width = Math.ceil(w * fmx) + "px";
			imgP.style.height = Math.ceil(h * fmy) + "px";
			cP.style.width = rw + "px";
			cP.style.height = rh + "px";
			dP.style.width = auxw + "px";
			dP.style.height = auxh + "px";
			if (rw < auxw) {
				cP.style.left = Math.ceil((auxw - rw) / 2) + "px";
			} else {
				cP.style.left = "0px";
			}
			if (rh < auxh) {
				cP.style.top = Math.ceil((auxh - rh) / 2) + "px";
			} else {
				cP.style.top = "0px";
			}
		}
	}
}

function guardarImagen(num) {
	var form = G.dom.$("formEditor");
	if (form && form.imageWho.value == num) {
		form.submit();
	} else {
		$('#Errormsgs').show().html(errorAnuncioTipo21);
	}
}
function editarImagen(who, imgdir) {

	var procesor = "proceso/anuncio";
	if (who == 6) {
		procesor = "proceso/photoprofile";
	}
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : procesor,
			__a : "revisarImagen",
			imagedir : imgdir
		},
		who : who,
		json : true,
		accion : function() {
			var iff = G.dom.$("iframeFakeAdvertisement");
			iff.who = this.who;
			formAnuncioReady.call(iff, this.JSON);
		}
	})).enviar();
}
function revisarAnuncio() {
	var form = G.dom.$("formRevisarAnuncio");
	if (form) {
		var img1 = form.imagen1.value;
		var img2 = form.imagen2.value;
		var img3 = form.imagen3.value;
		var titulo = form.titulo.value;
		if (!titulo) {
			$('#Errormsgs').show().html(errorAnuncioTipo22);
		} else if (img1 && img2 && img3) {
			form.submit();
		} else {
			$('#Errormsgs').show().html(errorAnuncioTipo23);
		}
		src = "/goaamb/images/publi/full/";
	}
}
function revisarMySponsor() {
	var form = G.dom.$("formRevisarAnuncio");
	if (form) {
		var img4 = form.imagen4.value;
		if (img4) {
			form.submit();
		} else {
			$('#Errormsgs').show().html(errorAnuncioTipo24);
		}
		src = "/goaamb/images/publi/full/";
	}
}
function revisarPhotoProfile() {
	cerrarAlertEmergente();
	var dimg = G.dom.$("showPhoto");
	if (dimg) {
		var img = G.dom.$$$("img", 0, dimg);
		img.src = G.url._setGET("rand", Math.random(), img.src);
	}
}

function confirmarAnuncio() {
	confirmAdvertisement();
}
function editarAnuncio(id) {
	$("#accountContent").load('gestion/modulos/home/createAdvertisement.php', {
		id : id
	}, function() {
		$('body').scrollTop(0);
	});
}
function editarAnuncioTipo1(id) {
	$("#loadingEmergente").show();
	$("#accountContent").load('gestion/modulos/home/createAdvertisement1.php',
			{
				id : id
			}, function() {
				$('body').scrollTop(0);
				$("#loadingEmergente").hide();
			});
}

function verAnuncio(id) {
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "verAnuncio",
			id : id
		},
		json : true,
		accion : function() {
			if (this.JSON && this.JSON.anuncio) {
				$(".yourAdvertisement a.active").removeClass("active");
				var anuncio = this.JSON.anuncio;
				$(".yourAdvertisement a#aAnuncio" + anuncio.id).addClass(
						"active");
				for ( var campo in anuncio) {
					var el = G.dom.$("anuncio" + campo);
					if (el) {
						if (el.nodeName !== "IMG") {
							el.innerHTML = anuncio[campo];
						} else {
							el.src = dirgo + anuncio[campo] + "?rand"
									+ Math.random();
						}
					}
					el = G.dom.$("anuncio" + campo + "2");
					if (el) {
						el.innerHTML = anuncio[campo];
					}
				}
			}
		}
	})).enviar();
}

function verAnuncioTipo1(id) {
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "verAnuncioTipo1",
			id : id
		},
		json : true,
		accion : function() {
			if (this.JSON && this.JSON.anuncio) {
				$(".yourAdvertisement a.active").removeClass("active");
				var anuncio = this.JSON.anuncio;
				$(".yourAdvertisement a#aAnuncio" + anuncio.id).addClass(
						"active");
				for ( var campo in anuncio) {
					var el = G.dom.$("anuncio" + campo);
					if (el) {
						if (el.nodeName !== "IMG") {
							el.innerHTML = anuncio[campo];
						} else {
							el.src = dirgo + anuncio[campo] + "?rand"
									+ Math.random();
						}
					}
					el = G.dom.$("anuncio" + campo + "2");
					if (el) {
						el.innerHTML = anuncio[campo];
					}
				}
				var tbody = G.dom.$("tablaAnuncioTipo1");
				tbody.innerHTML = "";
				if (this.JSON.anuncio.stat) {
					var s = this.JSON.anuncio.stat;
					if (s.nodata) {
						tbody.innerHTML = "<tr><td colspan='3' align='center'>"
								+ s.nodata + "</td></tr>";
					} else {
						for ( var pais in s) {
							var tr = G.dom.create("tr");
							tbody.appendChild(tr);
							var td = G.dom.create("td");
							td.innerHTML = s[pais].nombre;
							tr.appendChild(td);
							td = G.dom.create("td");
							td.innerHTML = s[pais].impresion;
							tr.appendChild(td);
							td = G.dom.create("td");
							td.innerHTML = s[pais].click;
							tr.appendChild(td);
						}

					}
					createChart(
							"/greader.php?__q=proceso/anuncio&__a=xmlStat&__t=xml&anuncio="
									+ this.post.id, this.JSON.anuncio.titulo);
				}
				anuncioActivo = this.post.id;
			}
		}
	})).enviar();
}

function formFormularioReady(json) {
	if (json.exito) {
		$("#alertEmergenteDatos").load(
				'gestion/modulos/home/msgs/confirmAdvertisement.php');
	} else {
		$("#Errormsgs").html(json.error).show();
	}
}

function formAdmAnuncioReady(json) {
	if (json.login) {
		recargarPaginaAnuncio();
	}
}
function listarPendientes(q) {
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "ventana/anuncio",
			__a : "listar" + q + "Pendientes"
		}
	})).recibir("lista");
}
function listarFormulariosPendientes() {
	listarPendientes("Formularios");
}
function listarAnunciosPendientes() {
	listarPendientes("Anuncios");
}
function listarAnunciosTipo1Pendientes() {
	listarPendientes("AnunciosTipo1");
}

function cambiarEstadoFormulario(id) {
	var padre = this.parentNode;
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "cambiarEstadoFormulario",
			id : id
		},
		select : this,
		padre : padre,
		json : true,
		accion : function() {
			if (this.JSON.exito) {
				this.padre.innerHTML = errorAnuncioTipo25;
			} else {
				this.padre.innerHTML = "";
				this.padre.appendChild(this.select);
			}
		}
	})).enviar();
	padre.innerHTML = "Actualizando...";
}

function formCodigoReady(json) {
	if (json.exito) {
		$("#accountContent").load(
				'gestion/modulos/home/createAdvertisement.php', {
					"codigo" : json.codigo
				}, function() {
					$('body').scrollTop(0);
				});
		$('#alertEmergente').hide();
		$('#alertEmergente0').hide();
	} else {
		$("#Errormsgs").html(json.error).show();
	}
}

function eliminarPais(pais, anuncio) {
	if (anuncio !== "X") {
		(new G.ajax({
			pagina : "/greader.php",
			post : {
				__q : "proceso/anuncio",
				__a : "eliminarPaisAnuncio",
				pais : pais,
				anuncio : anuncio
			}
		})).enviar();
	}
	var p = this.parentNode;
	p.parentNode.removeChild(p);
	var d = G.dom.$("capaPaises" + anuncio);
	if (d) {

		if (!d.arreglo) {
			d.arreglo = [];
		}
		var pos = G.util.arraySearch(d.arreglo, pais, true);
		if (pos !== -1) {
			d.arreglo.splice(pos, 1);
		}
	}
}
function buscarPais(anuncio) {
	if (this.value.length >= 0) {
		var p = this.parentNode;
		var s = G.dom.$("listaPaises");
		s.anuncio = anuncio;
		var o = s.options;
		var patron = new RegExp("^" + this.value + ".*$", "i");
		if (!s.hiddenOptions) {
			s.hiddenOptions = [];
			for ( var i = 1; i < o.length; i++) {
				s.hiddenOptions[i - 1] = o[i];
			}
		}
		var so = s.hiddenOptions;
		for ( var i = 0; i < so.length; i++) {
			if (patron.test(so[i].innerHTML)) {
				so[i].ver = true;
			} else {
				so[i].ver = false;
			}
		}
		for ( var i = 1; i < o.length; i++) {
			s.removeChild(o[i]);
			i--;
		}

		for ( var i = 0; i < so.length; i++) {
			if (so[i].ver) {
				s.appendChild(so[i]);
			}
		}
		if (!p.tieneSelect) {
			p.tieneSelect = true;
			s.parentNode.tieneSelect = false;
			p.appendChild(s);
			s.selectedIndex = 0;
			s.style.display = "block";
		}
	}
}

function buscarUsuario() {
	var s = G.dom.$("listaAmigos");
	if (this.value.length > 0) {
		var p = this.parentNode;
		var o = s.children;
		var patron = new RegExp("^" + this.value + ".*$", "i");
		if (!s.hiddenChildren) {
			s.hiddenChildren = [];
			for ( var i = 0; i < o.length; i++) {
				s.hiddenChildren[i] = o[i];
			}
		}
		var so = s.hiddenChildren;
		for ( var i = 0; i < so.length; i++) {
			var span = G.dom.$$$("span", 0, so[i]);
			if (patron.test(G.util.trim(span.innerHTML))) {
				so[i].ver = true;
			} else {
				so[i].ver = false;
			}
		}
		for ( var i = 0; i < o.length; i++) {
			s.removeChild(o[i]);
			i--;
		}

		for ( var i = 0; i < so.length; i++) {
			if (so[i].ver) {
				s.appendChild(so[i]);
			}
		}
		if (!p.tieneSelect) {
			p.tieneSelect = true;
			s.parentNode.tieneSelect = false;
			p.appendChild(s);
			var x = this.offsetLeft;
			var y = this.offsetTop;
			var w = this.offsetWidth;
			var h = this.offsetHeight;
			s.style.left = (x) + "px";
			s.style.top = (y + h) + "px";
		}
		s.style.display = "block";
	} else {
		s.style.display = "none";
	}
}

function seleccionarPais() {
	var si = this.selectedIndex;
	if (si >= 0) {
		var o = this.options[si];
		if (o.value) {
			var d = G.dom.$("capaPaises" + this.anuncio);
			if (d) {
				if (!d.arreglo) {
					d.arreglo = [];
				}
				if (G.util.arraySearch(d.arreglo, o.value, true) === -1) {
					d.arreglo.push(o.value);
					var dd = G.dom.create("div");
					dd.className = "capaPaises";
					var span = G.dom.create("span");
					span.className = "nombre";
					span.innerHTML = o.innerHTML;
					dd.appendChild(span);
					span = G.dom.create("span");
					span.innerHTML = "x";
					span.className = "cerrar";
					span.pais = o.value;
					span.anuncio = this.anuncio;
					d.appendChild(dd);
					this.style.display = "none";
					this.parentNode.tieneSelect = false;
					G.dom.$("buscarPais" + this.anuncio).value = "";
					if (this.anuncio !== "X") {
						(new G.ajax({
							pagina : "/greader.php",
							post : {
								__q : "proceso/anuncio",
								__a : "adicionarPais",
								pais : o.value,
								anuncio : this.anuncio
							},
							json : true,
							span : span,
							dd : dd,
							accion : function() {
								if (this.JSON && this.JSON.exito) {
									this.span.onclick = function() {
										eliminarPais.call(this, this.pais,
												this.anuncio);
									};
									this.dd.appendChild(this.span);
								}
							}
						})).enviar();
					} else {
						span.onclick = function() {
							eliminarPais.call(this, this.pais, this.anuncio);
						};
						dd.appendChild(span);
					}
				}
			}

		}
	}
}
function eliminarAnuncio(anuncio) {
	var padre = this.parentNode;
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "eliminarAnuncio",
			anuncio : anuncio
		},
		input : this,
		padre : padre,
		json : true,
		accion : function() {
			this.padre.innerHTML = "";
			this.padre.appendChild(this.input);
			var tr = this.padre.parentNode;
			var tbody = tr.parentNode;
			tbody.removeChild(tr);
		}
	})).enviar();
	padre.innerHTML = errorAnuncioTipo26;
}
function eliminarAnuncioTipo1(anuncio) {
	var padre = this.parentNode;
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "eliminarAnuncioTipo1",
			anuncio : anuncio
		},
		input : this,
		padre : padre,
		json : true,
		accion : function() {
			this.padre.innerHTML = "";
			this.padre.appendChild(this.input);
			var tr = this.padre.parentNode;
			var tbody = tr.parentNode;
			tbody.removeChild(tr);
		}
	})).enviar();
	padre.innerHTML = errorAnuncioTipo26;
}

function cambiarPagadoAnuncioTipo1(anuncio) {
	var padre = this.parentNode;
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "cambiarPagadoAnuncioTipo1",
			anuncio : anuncio,
			activo : this.value
		},
		select : this,
		padre : padre,
		json : true,
		accion : function() {
			this.padre.innerHTML = "";
			this.padre.appendChild(this.select);
		}
	})).enviar();
	padre.innerHTML = errorAnuncioTipo26;
}
function cambiarActivoInactivoAnuncioTipo1(anuncio) {
	var padre = this.parentNode;
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "cambiarActivoInactivoAnuncioTipo1",
			anuncio : anuncio,
			activo : this.value
		},
		select : this,
		padre : padre,
		json : true,
		accion : function() {
			this.padre.innerHTML = "";
			this.padre.appendChild(this.select);
		}
	})).enviar();
	padre.innerHTML = errorAnuncioTipo26;
}
function cambiarActivoInactivo(anuncio) {
	var padre = this.parentNode;
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "cambiarActivoInactivo",
			anuncio : anuncio,
			activo : this.value
		},
		select : this,
		padre : padre,
		json : true,
		accion : function() {
			this.padre.innerHTML = "";
			this.padre.appendChild(this.select);
		}
	})).enviar();
	padre.innerHTML = errorAnuncioTipo26;
}

function ventanaMiAuspiciante() {
	$("#alertEmergenteDatos").html('');
	$("#alertEmergenteDatos").load('gestion/modulos/home/msgs/mySponsor.php');
	$('#alertEmergente').show();
	$('#alertEmergente0').show();
}

function verLinkExterno() {
	G.dom.$('linkExterno').style.display = 'block';
	G.dom.$('http1').value = '';
	G.dom.$('linkInterno').style.display = 'none';
	G.dom.$('http2').value = '';
	G.dom.$("formRevisarAnuncio").url.value = "";
	return false;
}

function verLinkInterno() {
	G.dom.$('linkExterno').style.display = 'none';
	G.dom.$('http1').value = '';
	G.dom.$('linkInterno').style.display = 'block';
	G.dom.$('http2').value = '';
	G.dom.$("formRevisarAnuncio").url.value = "";
	return false;
}

function restantesTitulo() {
	var tama = this.value.length;
	G.dom.$("restantesTituloSpan").innerHTML = (25 - tama);
	G.dom.$("formRevisarAnuncio").titulo.value = this.value;
	$("#previewAnuncioTipo11").show();
	G.dom.$("tituloAnuncioTipo11").innerHTML = this.value;
	$("#previewAnuncioTipo12").show();
	G.dom.$("tituloAnuncioTipo12").innerHTML = this.value;

}
function revisarHTTP1() {
	G.dom.$("formRevisarAnuncio").url.value = "http1::--::" + this.value;
}
function revisarHTTP2() {
	buscarUsuario.call(this);
}
function verificarTeclaHTTP2(e) {
	var key = G.event.getKey(e);
	if (key === 27) {
		esconderListaAmigos();
	}
}
function restantesTexto() {
	var tama, value;
	if (G.nav.isIE && G.nav.version < 7) {
		value = this.innerHTML;
	} else {
		value = this.value;
	}
	tama = value.length;
	G.dom.$("formRevisarAnuncio").texto.value = value;
	G.dom.$("restantesTextoSpan").innerHTML = (135 - tama);
	$("#previewAnuncioTipo11").show();
	G.dom.$("textoAnuncioTipo11").innerHTML = value;
	$("#previewAnuncioTipo12").show();
	G.dom.$("textoAnuncioTipo12").innerHTML = value;
}

function seleccionarTodosPaises() {
	var d = G.dom.$("capaPaisesX");
	d.innerHTML = "";
	if (this.checked) {
		G.dom.$("specificCountry").style.display = "none";
		d.arreglo = [ "*" ];
	} else {
		G.dom.$("specificCountry").style.display = "block";
		d.arreglo = [];
	}
}

function seleccionarDesde() {
	G.dom.$("formRevisarAnuncio").desde.value = this.value;
}
function seleccionarHasta() {
	G.dom.$("formRevisarAnuncio").hasta.value = this.value;
}

function seleccionarSexoTodos() {
	if (this.checked) {
		G.dom.$("formRevisarAnuncio").sexo.value = "*";
	}
}

function seleccionarSexoMasculino() {
	if (this.checked) {
		G.dom.$("formRevisarAnuncio").sexo.value = "Masculino";
	}
}
function seleccionarSexoFemenino() {
	if (this.checked) {
		G.dom.$("formRevisarAnuncio").sexo.value = "Femeninos";
	}
}
var arregloPerfiles = [];
function seleccionarTodosPerfiles() {
	if (this.checked) {
		arregloPerfiles = [ "*" ];
		G.dom.$("capaPerfiles").style.display = "none";
		$("input[name=perfilesAnuncio1]").attr("checked", false).parent()
				.removeClass("lblCHK2");
	} else {
		arregloPerfiles = [];
		G.dom.$("capaPerfiles").style.display = "block";
	}
}

function seleccionarPerfiles(perfil) {
	var pos = G.util.arraySearch(arregloPerfiles, perfil);
	if (this.checked) {
		if (pos === -1) {
			arregloPerfiles.push(perfil);
		}
	} else {
		if (pos !== -1) {
			arregloPerfiles.splice(pos, 1);
		}
	}
	var cks = G.dom.$$("perfilesAnuncio1");
	var todos = true;
	for ( var i = 0; i < cks.length; i++) {
		if (!cks[i].checked) {
			todos = false;
			break;
		}
	}
	if (todos) {
		var ckt = G.dom.$("allProfileType");
		ckt.checked = "checked";
		ckt.parentNode.className = "lblCHK lblCHK2";
		seleccionarTodosPerfiles.call(ckt);
	}
}
var tipoAnuncio1 = "Click";
function verPorClick() {
	$("#anuncioPorClick").show();
	$("#anuncioPorImpresion").hide();
	$("#anuncioPorTiempo").hide();
	tipoAnuncio1 = "Click";
	return false;
}
function verPorImpresion() {
	$("#anuncioPorClick").hide();
	$("#anuncioPorImpresion").show();
	$("#anuncioPorTiempo").hide();
	tipoAnuncio1 = "Impresion";
	return false;
}

function verPorTiempo() {
	$("#anuncioPorClick").hide();
	$("#anuncioPorImpresion").hide();
	$("#anuncioPorTiempo").show();
	tipoAnuncio1 = "Tiempo";
	return false;
}

function revisarAnuncioTipo1() {
	$("#loadingEmergente").show();
	var d = G.dom.$("capaPaisesX");
	var f = G.dom.$("formRevisarAnuncio");
	if (f) {
		var url = f.url.value;
		url = url.split("::--::");
		if (url.length < 2) {
			$(".Errormsgs").html(errorAnuncionTipo13);
			$("#loadingEmergente").hide();
			return;
		}
		if (d) {
			if (d.arreglo && d.arreglo.length > 0) {
				f.paises.value = d.arreglo.join("::-::");
			} else {
				$(".Errormsgs").html(errorAnuncionTipo11);
				$("#loadingEmergente").hide();
				return;
			}
		}
		if (arregloPerfiles && arregloPerfiles.length > 0) {
			f.perfiles.value = arregloPerfiles.join("::-::");
		} else {
			$(".Errormsgs").html(errorAnuncionTipo12);
			$("#loadingEmergente").hide();
			return;
		}

		f.tipo_anuncio.value = tipoAnuncio1;
		switch (tipoAnuncio1) {
		case "Impresion":
			f.cantidad.value = G.dom.$("cantidadImpresion").value;
			break;
		case "Tiempo":
			f.cantidad.value = G.dom.$("cantidadTiempo").value;
			break;
		default:
			f.tipo_anuncio.value = "Click";
			f.cantidad.value = G.dom.$("cantidadClick").value;
			break;
		}
		f.submit();
		src = "/goaamb/images/publi/full/";
	}
}

function seleccionarUsuario(link) {
	var d = G.dom.$("listaAmigos");
	if (d) {
		d.style.display = "none";
		G.dom.$("http2edit").style.display = "inline";
		var h2s = G.dom.$("http2span");
		h2s.innerHTML = link;
		h2s.style.display = "inline";
		var ih2 = G.dom.$("http2");
		ih2.value = "";
		ih2.style.display = "none";
		G.dom.$("aLinkExterno").style.display = "none";
		G.dom.$("formRevisarAnuncio").url.value = "http2::--::" + link;
	}
}
function esconderListaAmigos() {
	var d = G.dom.$("listaAmigos");
	if (d) {
		d.style.display = "none";
		G.dom.$("http2").blur();
	}
}
function editarHTTP1() {
	this.style.display = "none";
	G.dom.$("http1edit").style.display = "none";
	var input = G.dom.$("http1");
	input.value = this.innerHTML;
	input.onkeyup();
	input.style.display = "inline";
	input.focus();
	G.dom.$("aLinkInterno").style.display = "inline";
	G.dom.$("aLinkInternop").style.display = "block";
	G.dom.$("http1validate").style.display = "inline";
	G.dom.$("linkExternoError").innerHTML = "";
}
function editarHTTP2() {
	this.style.display = "none";
	G.dom.$("http2edit").style.display = "none";
	var input = G.dom.$("http2");
	input.style.display = "inline";
	input.focus();
	G.dom.$("aLinkExterno").style.display = "inline";
}
function validarURL() {
	if (G.util.trim(this.value) !== "") {
		this.value = this.value.replace(/^http:\/\//, "");
		var l = G.dom.$("linkExternoError");
		(new G.ajax({
			pagina : "/greader.php",
			post : {
				__q : "proceso/anuncio",
				__a : "validarURL",
				url : this.value
			},
			json : true,
			l : l,
			input : this,
			accion : function() {
				if (this.l) {
					if (this.JSON.exito) {
						this.l.innerHTML = this.JSON.mensaje;
						var hs = G.dom.$("http1span");
						hs.style.display = "inline";
						hs.innerHTML = this.post.url;
						G.dom.$("http1edit").style.display = "inline";
						this.input.style.display = "none";
						G.dom.$("aLinkInterno").style.display = "none";
						G.dom.$("aLinkInternop").style.display = "none";
						G.dom.$("http1validate").style.display = "none";
						G.dom.$("formRevisarAnuncio").url.value = "http1::--::"
								+ this.input.value;
					} else if (this.JSON.error) {
						this.l.innerHTML = this.JSON.error;
					}
				}
			}
		})).enviar();
		l.innerHTML = errorAnuncionTipo14;
	}
}
function salirAdmAnuncio() {
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "logoutAdmAnuncio"
		},
		accion : function() {
			recargarPaginaAnuncio();
		}
	})).enviar();
}

function clickedAnuncioTipo1(anuncio, seccion) {
	(new G.ajax({
		pagina : "/greader.php",
		post : {
			__q : "proceso/anuncio",
			__a : "clickedAnuncioTipo1",
			anuncio : anuncio,
			seccion : seccion
		}
	})).enviar();
}
function pagarAnuncioTipo1(anuncio) {
	$("#loadingEmergente").show();
	$("#accountContent").load('gestion/modulos/home/payment/payment.php', {
		'id' : anuncio
	}, function() {
		$('body').scrollTop(0);
		$("#loadingEmergente").hide();
	});
}
function verProcesandoPago() {
	$("#procesandoPago").show();
	$("#formPago").hide();
}

function statChange() {
	var s = G.dom.$("startAd");
	var e = G.dom.$("endAd");
	if (G.util.trim(s.value) !== "" && G.util.trim(e.value)) {
		createChart(
				"/greader.php?__q=proceso/anuncio&__a=xmlStat&__t=xml&anuncio="
						+ anuncioActivo + "&inicio=" + s.value + "&fin="
						+ e.value + "&tipo=" + tipoActivo, "")
	}
}

function createChart(url, titulo) {
	var myChart = new JSChart('graph', 'bar',
			"e2103c6d845f30c90b784742e22ecb72");
	myChart.setErrors(false);
	myChart.setDataXML(url);
	myChart.setTitle(titulo);
	myChart.draw();
}

function eliminarAnuncioTipo1X(anuncio) {
	if (confirm(anuncioTipo1Texto1))
		(new G.ajax({
			pagina : "/greader.php",
			post : {
				__q : "proceso/anuncio",
				__a : "eliminarAnuncioTipo1X",
				id : anuncio
			},
			json : true,
			accion : function() {
				ltyP();
			}
		})).enviar();
}