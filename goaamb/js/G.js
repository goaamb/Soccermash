/**
 * Copyright © 2009 This file belongs to a series of files that comprise the
 * Framework Goaamb within the area of utilities and javascript.
 * 
 * This file as well as the components of the framework are protected under
 * license LGPLv3 (http://www.gnu.org/licenses/lgpl-3.0.html), being possible to
 * distribute this product but you can not change it without my permission (
 * Goaamb). If this file is changed without authorization or not to preserve the
 * copyrights will break the license of this file or others making up the
 * Framework
 * 
 * @author Goaamb<goaamb@gmail.com>
 * 
 */
/**
 * Container package module belonging to Javascript Framework Goaamb
 */
var G = {
	crypt : {
		corresponde : {
			a : "4",
			4 : "A",
			A : "a",
			b : "8",
			8 : "B",
			B : "b",
			c : "C",
			C : "c",
			d : "D",
			D : "d",
			e : "3",
			3 : "E",
			E : "e",
			f : "F",
			F : "f",
			g : "6",
			6 : "G",
			G : "g",
			h : "H",
			H : "h",
			i : "1",
			1 : "I",
			I : "i",
			j : "J",
			J : "j",
			k : "K",
			K : "k",
			l : "7",
			7 : "L",
			L : "l",
			m : "M",
			M : "m",
			n : "N",
			N : "n",
			o : "0",
			0 : "O",
			O : "o",
			p : "P",
			P : "p",
			q : "9",
			9 : "Q",
			Q : "q",
			r : "R",
			R : "r",
			s : "5",
			5 : "S",
			S : "s",
			t : "T",
			T : "t",
			u : "U",
			U : "u",
			v : "V",
			V : "v",
			w : "W",
			W : "w",
			x : "X",
			X : "x",
			y : "Y",
			Y : "y",
			z : "2",
			2 : "Z",
			Z : "z"
		},
		_corresponder : function(a, b) {
			var r = "";
			for ( var i = 0; i < a.length; i++) {
				if (b[a.charAt(i)]) {
					r += b[a.charAt(i)];
				} else {
					r += a.charAt(i);
				}
			}
			return r;
		},
		encrypt : function(t) {
			return this._corresponder(t, this.corresponde);
		},
		decrypt : function(t) {
			var nc = G.util.keysForValues(this.corresponde);
			return this._corresponder(t, nc);
		}
	},
	base64 : {
		_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
		encode : function(input) {
			var output = "";
			var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
			var i = 0;

			// input = Base64._utf8_encode(input);

			while (i < input.length) {

				chr1 = input.charCodeAt(i++);
				chr2 = input.charCodeAt(i++);
				chr3 = input.charCodeAt(i++);

				enc1 = chr1 >> 2;
				enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
				enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
				enc4 = chr3 & 63;

				if (isNaN(chr2)) {
					enc3 = enc4 = 64;
				} else if (isNaN(chr3)) {
					enc4 = 64;
				}

				output = output + this._keyStr.charAt(enc1)
						+ this._keyStr.charAt(enc2) + this._keyStr.charAt(enc3)
						+ this._keyStr.charAt(enc4);

			}

			return output;
		},
		decode : function(input) {
			var output = "";
			var chr1, chr2, chr3;
			var enc1, enc2, enc3, enc4;
			var i = 0;
			input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
			while (i < input.length) {

				enc1 = this._keyStr.indexOf(input.charAt(i++));
				enc2 = this._keyStr.indexOf(input.charAt(i++));
				enc3 = this._keyStr.indexOf(input.charAt(i++));
				enc4 = this._keyStr.indexOf(input.charAt(i++));

				chr1 = (enc1 << 2) | (enc2 >> 4);
				chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
				chr3 = ((enc3 & 3) << 6) | enc4;

				output = output + String.fromCharCode(chr1);

				if (enc3 != 64) {
					output = output + String.fromCharCode(chr2);
				}
				if (enc4 != 64) {
					output = output + String.fromCharCode(chr3);
				}

			}
			// output = Base64._utf8_decode(output);
			return output;

		}
	},
	cookie : {
		get : function(c_name) {
			if (document.cookie.length > 0) {
				c_start = document.cookie.indexOf(c_name + "=");
				if (c_start != -1) {
					c_start = c_start + c_name.length + 1;
					c_end = document.cookie.indexOf(";", c_start);
					if (c_end == -1)
						c_end = document.cookie.length;
					return unescape(document.cookie.substring(c_start, c_end));
				}
			}
			return "";
		},
		set : function(c_name, value, expiredays, path) {
			var exdate = new Date();
			if (expiredays) {
				exdate.setDate(exdate.getDate() + expiredays);
			}
			var cookie = c_name + "=" + escape(value)
					+ ((!expiredays) ? "" : ";expires=" + exdate.toGMTString())
					+ ((!path) ? "" : ";path=" + path);
			document.cookie = cookie;
			return cookie;
		}
	},
	url : {
		_GET : function(str, url) {
			if (!url) {
				url = location.href;
			}
			url = url.split("?");
			if (url.length > 1) {
				var pars = url[1].split("&");
				for ( var i = 0; i < pars.length; i++) {
					var vari = pars[i].split("=");
					if (vari.length > 1 && vari[0] === str) {
						var varx = vari[1].split("#");
						return varx[0];
					}
				}
			}
			return "";
		},
		_setGET : function(par, val, url) {
			if (!url) {
				url = location.href;
			}
			url = url.split("#");
			url = url[0];
			url = url.split("?");
			if (url.length > 1) {
				var pars = url[1].split("&");
				var entro = false;
				for ( var i = 0; i < pars.length; i++) {
					var vari = pars[i].split("=");
					if (vari.length > 1 && vari[0] === par) {
						var varx = vari[1].split("#");
						varx[0] = val;
						vari[1] = varx.join("#");
						entro = true;
					}
					pars[i] = vari.join("=");
				}

				url[1] = pars.join("&");
				var adicional = "";
				if (!entro) {
					adicional = "&" + par + "=" + val;
				}
				return url.join("?") + adicional;
			}
			return url[0] + "?" + par + "=" + val;
		},
		_HASH : function(str, hash) {
			if (!hash) {
				hash = location.hash;
				if (hash.charAt(0) === "#") {
					hash = hash.substring(1);
				}
			}
			if (hash) {
				var pars = hash.split("&");
				for ( var i = 0; i < pars.length; i++) {
					var vari = pars[i].split("=");
					if (vari.length > 1 && vari[0] === str) {
						return vari[1];
					}
				}
			}
			return "";
		},
		_setHASH : function(par, val, hash) {
			if (!hash) {
				hash = location.hash;
				if (hash.charAt(0) === "#") {
					hash = hash.substring(1);
				}
			}
			if (hash) {
				var pars = hash.split("&");
				var entro = false;
				for ( var i = 0; i < pars.length; i++) {
					var vari = pars[i].split("=");
					if (vari.length > 1 && vari[0] === par) {
						vari[1] = val;
						entro = true;
					}
					pars[i] = vari.join("=");
				}

				hash = pars.join("&");
				var adicional = "";
				if (!entro) {
					adicional = "&" + par + "=" + val;
				}
				return hash + adicional;
			}
			return hash;
		}
	},
	/**
	 * Dom object that lets you work with DOM elements and functions a bit
	 * smaller and optimal
	 */
	dom : {
		/**
		 * function that obtains the DomElement by id
		 * 
		 * @param {String}
		 *            id Id of a tag inside HTML code
		 * @return returns the DomElement that have the ID
		 * @type {Document}
		 */
		$ : function(id) {
			if (!id) {
				return false;
			}
			return document.getElementById(id);

		},
		/**
		 * function that obtains the unique or list of DomElements by name
		 * 
		 * @param {String}
		 *            name Name of the DomElement
		 * @param {Integer}
		 *            position position in the list of DomElements
		 * @return returns the DomElement that have the Name
		 * @type {Array|Document}
		 */
		$$ : function(name, position) {
			if (!name) {
				return false;
			}
			var list = document.getElementsByName(name);
			return position >= 0 ? list[position] : list;
		},
		/**
		 * function that obtains the unique or list of DomElements by the tag
		 * name
		 * 
		 * @param {String}
		 *            tagname the Tag Name of the DomElement
		 * @param {Integer}
		 *            position position in the list of DomElements
		 * @param {Document}
		 *            doc A DomElement container of other DomElements
		 * @return returns the DomElement that have the Tag Name
		 * @type {Array|Document}
		 */
		$$$ : function(tagname, position, doc) {
			if (!tagname) {
				return false;
			}
			if (!doc) {
				doc = document;
			}
			if (doc.getElementsByTagName) {
				var list = doc.getElementsByTagName(tagname);
				return position >= 0 ? list[position] : list;
			}
			return false;
		},
		$$$$ : function(classname, position, doc) {
			if (!classname) {
				return false;
			}
			if (!doc) {
				doc = document;
			}
			if (doc.getElementsByTagName) {
				var Elements = doc.getElementsByTagName('*');
				var list = new Array();
				if (classname) {
					for ( var e = 0; e < Elements.length; e++) {
						if (Elements[e].className) {
							var clases = Elements[e].className.split(" ");
							if (G.util.arraySearch(clases, classname) != -1) {
								list.push(Elements[e]);
							}
						}
					}
				}
				return position >= 0 ? list[position] : list;
			}
			return false;
		},
		/**
		 * function that create a DOMElement by a tagname
		 * 
		 * @param {String}
		 *            tagname the Tag Name for the DomElement
		 * @param {String}
		 *            id identifier of the new DomElement
		 * @param {String}
		 *            name name of the new DomElement
		 * @param {String}
		 *            value name of the new DomElement in case of have value
		 *            attribute
		 * @return returns the new DomElement by Tag Name
		 * @type {Document}
		 */
		create : function(tagname, id, name, value) {
			if (tagname) {
				var el = document.createElement(tagname);
				if (id) {
					el.id = id;
				}
				if (name) {
					el.name = name;
				}
				if (typeof value !== "undefined") {
					el.value = value;
				}
				return el;
			}
			return false;
		},
		createSelect : function(id, name) {
			var s = this.create("select", id, name);
			s.addOption = function(v, t) {
				var o = G.dom.create("option", "", "", v);
				o.innerHTML = t;
				this.appendChild(o);
				return o;
			};
			s.clear = function() {
				this.innerHTML = "";
			};
			s.removeByPos = function(pos) {
				this.removeChild(this.children[pos]);
			};
			s.removeByValue = function(value) {
				var c = this.children;
				for ( var i = 0; i < c.length; i++) {
					if (c[i].value === value) {
						this.removeChild(c[i]);
					}
				}
			};
			return s;
		},
		parseSelect : function(s) {
			if (s) {
				var ss = this.createSelect();
				s.addOption = ss.addOption;
				s.clear = ss.clear;
				s.removeByPos = ss.removeByPos;
				s.removeByValue = ss.removeByValue;
			}
		},
		createTable : function(id, name) {
			var table = this.create("table", id, name);
			table.addColumn = function(el, f, c) {
				if (!this.tbody) {
					this.tbody = G.dom.create("tbody");
					this.appendChild(this.tbody);
				}
				if (!this.rowsx) {
					this.rowsx = G.dom.$$$("tr", -1, this.tbody);
				}
				var rows = this.rowsx;
				if (f === undefined) {
					f = rows.length;
				}
				if (rows.length <= f) {
					var min = rows.length;
					var max = f;
					for ( var i = min; i <= max; i++) {
						this.tbody.appendChild(G.dom.create("tr"));
					}
					this.rowsx = G.dom.$$$("tr", -1, this.tbody);
					rows = this.rowsx;
				}
				if (!rows.colsx) {
					rows[f].colsx = G.dom.$$$("td", -1, rows[f]);
				}
				var cols = rows[f].colsx;
				if (c === undefined) {
					c = cols.length;
				}
				if (cols.length <= c) {
					var min = cols.length;
					var max = c;
					for ( var i = min; i <= max; i++) {
						rows[f].appendChild(G.dom.create("td"));
					}
					rows[f].colsx = G.dom.$$$("td", -1, rows[f]);
					cols = rows[f].colsx;
				}
				G.dom.appendChild(cols[c], el);
				return cols[c];
			};
			return table;
		},
		/**
		 * function that create a TextElement
		 * 
		 * @param {String}
		 *            value of the Text
		 * @return returns the new TextElement
		 * @type {TextElemnt}
		 */
		createText : function(value) {
			if (!value) {
				value = "";
			}
			return document.createTextNode(value);
		},
		/**
		 * function append a child inside the tree of the Element
		 * 
		 * @param {DomElement}
		 *            element Element to append a child
		 * @param {String|DomElement}
		 *            child for append the element
		 */
		appendChild : function(element, child) {
			if (element) {
				if (!child.appendChild) {
					element.appendChild(this.createText(child));
				} else {
					element.appendChild(child);
				}
			}
		},
		_ : function(regla) {
			var st = document.styleSheets;
			if (st) {
				var reglas = [];
				for ( var i = 0; i < st.length; i++) {
					var r=[];
					if (st[i].cssRules) {
						r = st[i].cssRules;
					} else if (st[i].rules) {
						r = st[i].rules;
					}
					for ( var j = 0; j < r.length; j++) {
						if (r[j].style && r[j].selectorText === regla) {
							reglas.push(r[j].style);
						}
					}
				}
				var stylefin = {};
				for ( var i = 0; i < reglas.length; i++) {
					if (!G.nav.isIE) {
						for ( var j = 0; j < reglas[i].length; j++) {
							stylefin[reglas[i][j]] = reglas[i]
									.getPropertyValue(reglas[i][j]);
						}
					} else {
						for ( var nombre in reglas[i]) {
							var valor = reglas[i][nombre];
							var param = nombre.replace(
									/([a-z]+)([A-Z])([a-z])/, "$1-$2$3")
									.toLowerCase();
							stylefin[param] = valor;
						}
					}
				}
				return stylefin;
			}
			return false;
		},
		query : function() {

		}
	},
	util : {
		setDate : function(field, type) {
			if (this.form && this.form[field]) {
				var v = this.value >= 10 ? this.value : "0" + this.value;
				var f = this.form[field].value;
				var p = /\d{4}\-\d{2}\-\d{2} \d{2}:\d{2}/;
				if (!p.test(f)) {
					this.form[field].value = f = "0000-00-00 00:00";
				}
				switch (type) {
				case "d":
					f = f.substring(0, 8) + v + f.substring(10);
					break;
				case "m":
					f = f.substring(0, 5) + v + f.substring(7);
					break;
				case "y":
					f = v + f.substring(4);
					break;
				case "h":
					f = f.substring(0, 11) + v + f.substring(13);
					break;
				case "i":
					f = f.substring(0, 14) + v;
					break;
				}
				this.form[field].value = f;
			}
		},
		explodeDate : function(fday, fmonth, fyear, fhour, fminute) {
			if (this.form) {
				var v = this.value;
				var p = /(\d{4})\-(\d{2})\-(\d{2}) (\d{2}):(\d{2})/;
				if (!p.test(v)) {
					return true;
				}
				var $res = v.match(p);
				if (this.form[fday]) {
					this.form[fday].value = parseInt($res[3], 10);
				}
				if (this.form[fmonth]) {
					this.form[fmonth].value = parseInt($res[2], 10);
				}
				if (this.form[fyear]) {
					this.form[fyear].value = parseInt($res[1], 10);
				}
				if (this.form[fhour]) {
					this.form[fhour].value = parseInt($res[4], 10);
				}
				if (this.form[fminute]) {
					this.form[fminute].value = parseInt($res[5], 10);
				}
				return true;
			}
			return true;
		},
		parse : function(source, target, notreplace) {
			if (source && target) {
				try {
					for ( var i in source) {
						if (target[i] && notreplace) {
							continue;
						}
						target[i] = source[i];
					}
					return true;
				} catch (e) {
					return false;
				}
			}
			return false;
		},
		listAtt : function(obj) {
			if (obj) {
				var text = "";
				for ( var id in obj) {
					text += "<b>" + id + "</b>: " + obj[id] + "<br/>";
				}
				ventana = window.open("", "",
						"width=300,height=300,scrollbars=yes");
				ventana.document
						.write("<html><head><title>Looking a object</title></head><body>"
								+ text + "<body></html>");
				ventana.focus();
			}
		},
		ready : function(fn) {
			if (fn) {
				G.event.addEvent(window, "load", fn);
			}
		},
		trim : function(t) {
			return t ? t.replace(/^\s+/, "").replace(/\s+$/, "") : "";
		},
		getExt : function(t) {
			var pos = t.lastIndexOf(".");
			return t.substring(pos + 1);
		},
		arraySearch : function(a, t, c) {
			for ( var i = 0; i < a.length; i++) {
				if (c) {
					a[i] = a[i].toLowerCase();
					t = t.toLowerCase();
				}
				if (a[i] == t) {
					return i;
				}
			}
			return -1;
		},
		includeJS : function(src, onload) {
			var h = G.dom.$$$("head", 0);
			if (h) {
				var scrs = G.dom.$$$("script", -1, h);
				if (scrs) {
					var pos = -1;
					for ( var i = 0; i < scrs.length && pos === -1; i++) {
						if (scrs[i].src === src) {
							pos = i;
						}
					}
					if (pos === -1) {
						var tscr = G.dom.create("script");
						tscr.src = src;
						tscr.setAttribute("type", "text/javascript");
						h.appendChild(tscr);
						onload ? (G.nav.isIE ? G.event.addEvent(tscr,
								"readystatechange", function() {
									if (this.readyState === "loaded") {
										onload.call(this);
									}
								}) : G.event.addEvent(tscr, "load", onload))
								: "";
					}
				} else {
					var tscr = G.dom.create("script");
					tscr.src = src;
					tscr.setAttribute("type", "text/javascript");
					h.appendChild(tscr);
					onload ? (G.nav.isIE ? G.event.addEvent(tscr,
							"readystatechange", function() {
								if (this.readyState === "loaded") {
									onload.call(this);
								}
							}) : G.event.addEvent(tscr, "load", onload)) : "";
				}
			}
		},
		includeCSS : function(src) {
			var h = G.dom.$$$("head", 0);
			if (h) {
				var scrs = G.dom.$$$("link", -1, h);
				if (scrs) {
					var pos = -1;
					for ( var i = 0; i < scrs.length && pos === -1; i++) {
						if (scrs[i].href === src) {
							pos = i;
						}
					}
					if (pos === -1) {
						var tscr = G.dom.create("link");
						tscr.href = src;
						tscr.setAttribute("rel", "stylesheet");
						tscr.setAttribute("type", "text/css");
						h.appendChild(tscr);
					}
				} else {
					var tscr = G.dom.create("link");
					tscr.href = src;
					tscr.setAttribute("rel", "stylesheet");
					tscr.setAttribute("type", "text/css");
					h.appendChild(tscr);
				}
			}
		},
		keysForValues : function(o) {
			var arr = {};
			for ( var i in o) {
				arr[o[i]] = i;
			}
			return arr;
		}
	},
	ajax : function(object) {
		this.accion = undefined;
		this.erroraccion = undefined;
		this.TEXT = undefined;
		this.XML = undefined;
		this.JSON = undefined;
		this.pagina = undefined;
		this.post = undefined;
		this.json = false;
		this.el = undefined;
		if (object) {
			G.util.parse(object, this);
		}

		this.darObjectoAJAX = function() {
			var xmlhttp = false;
			if (typeof ActiveXObject != 'undefined') {
				try {
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (E) {
						xmlhttp = false;
					}
				}
			}
			if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
				xmlhttp = new XMLHttpRequest();
			}
			return xmlhttp;
		};
		this.xmlhttp = this.darObjectoAJAX();

		this.direccionLocal = function() {
			var dirlocal = document.location.href.split("http://");
			if (dirlocal.length > 1) {
				dirlocal = dirlocal[1].split("/");
				if (dirlocal.length > 0) {
					dirlocal = dirlocal[0].toLowerCase();
				} else {
					return false;
				}
				var dirpagina = this.pagina.split("http://");
				if (dirpagina.length > 1) {
					dirpagina = dirpagina[1].split("/");
					if (dirpagina.length > 0) {
						dirpagina = dirpagina[0].toLowerCase();
						if (dirpagina === dirlocal) {
							return true;
						} else {
							window.open(this.pagina);
						}
					}
				} else {
					return true;
				}
			}
			return false;
		};
		this.cancelar = function() {
			if (this.enviado) {
				this.xmlhttp.abort();
			}
		};

		this.enviar = function() {
			if (this.pagina && this.direccionLocal()) {
				var method = "post";
				if (this.get) {
					method = "get";
				}
				var envio = false;
				if (this.post) {
					envio = "";
					for ( var el in this.post) {
						envio += "&" + el + "=" + this.post[el];
					}
				}
				if (this.get) {
					this.pagina += "?";
					for ( var el in this.get) {
						this.pagina += "&" + el + "=" + this.get[el];
					}
				}
				this.xmlhttp.open(method, this.pagina, true);
				if (method === "post") {
					this.xmlhttp.setRequestHeader("Content-Type",
							"application/x-www-form-urlencoded");
				}
				if (envio) {
					this.xmlhttp.send(envio);
					this.enviado = true;
				} else {
					this.xmlhttp.send("");
					this.enviado = true;
				}
			}
		};
		this.recibir = function(id) {
			var el;
			if (typeof id === "string") {
				el = G.dom.$(id);
			} else if (id && id.appendChild) {
				el = id;
			}
			if (el) {
				this.el = el;
				this.viejaAccion = this.accion;
				this.accion = function() {
					this.el.innerHTML = this.TEXT;
					if (this.viejaAccion) {
						this.viejaAccion();
					}
				};
				this.enviar();
			}
		};
		this.conectado = false;
		this.error = 0;
		this.enviado = false;
		var AJAX = this;
		var xmlhttp = this.xmlhttp;
		this.xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState === 4) {
				if (xmlhttp.status === 200) {
					AJAX.TEXT = xmlhttp.responseText;
					if (AJAX.json) {
						try {
							eval("AJAX.JSON=" + AJAX.TEXT + ";");
						} catch (e) {
						}
					} else {
						AJAX.XML = this.responseXML;
					}
					if (AJAX.accion) {
						AJAX.accion();
					}
					AJAX.conectado = true;
				} else {
					AJAX.error = this.status;
					if (AJAX.erroraccion) {
						AJAX.erroraccion();
					}
				}
			}
		};
	},
	event : {
		getTarget : function(e) {
			if (!e) {
				e = window.event;
			}
			if (G.nav.isIE) {
				return e.srcElement;
			} else {
				return e.target;
			}
		},
		getKey : function(e) {
			var key = e.which;
			if (G.nav.isIE) {
				key = window.event.keyCode;
			}
			return key;
		},
		getType : function(e) {
			e = e ? e : window.event;
			return e.type;
		},
		getPos : function(e) {
			var x = 0, y = 0;
			if (G.nav.isIE) {
				e = window.event;
				var d = document;
				var dd = d.documentElement;
				x = e.clientX + dd.scrollLeft + d.body.scrollLeft;
				y = e.clientY + dd.scrollTop + d.body.scrollTop;
			} else {
				x = e.clientX + window.scrollX;
				y = e.clientY + window.scrollY;
			}
			return {
				x : x,
				y : y
			};
		},
		addEvent : function(el, type, fn) {
			if (el && fn) {
				if (el.addEventListener) {
					el.addEventListener(type, fn, false);
					return true;
				} else if (el.attachEvent) {
					var elx = el;
					var fnx = fn;
					return el.attachEvent("on" + type, function() {
						return fnx.call(elx, window.event);
					});
				}
			}
			return false;
		},
		removeEvent : function(el, type, fn) {
			if (el) {
				if (el.removeEventListener) {
					el.removeEventListener(type, fn, false);
					return true;
				} else if (el.detachEvent) {
					return el.detachEvent("on" + type, fn);
				}
			}
			return false;
		}
	},
	valid : {
		int : function(e) {
			return G.valid.test(e, /^[\+\-\d]$/);
		},
		float : function(e) {
			return G.valid.test(e, /^[\+\-\d\.\,]$/);
		},
		email : function(e) {
			return G.valid.test(e, /^[a-zA-Z0-9\_\-\.\@]$/);
		},
		hour : function(e) {
			return G.valid.test(e, /[\d\:]$/);
		},
		test : function(e, p) {
			if (this.controlKey(e))
				return true;
			var k = G.event.getKey(e);
			k = String.fromCharCode(k);

			return p.test(k);
		},
		controlKey : function(e) {
			var k = G.event.getKey(e);
			switch (G.event.getType(e)) {
			case "keypress":
				return this.controlKeyOKP(k);
				break;
			case "keyup":
			case "keydown":
				return this.controlKeyOKD(k);
				break;
			}
		},
		controlKeyOKD : function(k) {
			return (k >= 35 && k <= 40) || k === 8 || k === 27 || k === 13
					|| k === 9 || k === 45 || k === 46 || (k >= 16 && k <= 20)
					|| k === 0;
		},
		controlKeyOKP : function(k) {
			return k === 8 || k === 13 || k === 0;
		},
		isInt : function(t) {
			return G.valid.validar(t, /^[\+\-]{0,1}\d+$/);
		},
		isFloat : function(t) {
			return G.valid.validar(t, /^[\+\-]{0,1}\d*[\.\,]{0,1}\d+$/);
		},
		isEmail : function(t) {
			return G.valid
					.validar(t,
							/^[a-zA-Z0-9\_\-\.]{2,}\@[a-zA-Z0-9\_\-\.]{2,}\.[a-zA-Z0-9\_\-\.]{2,6}$/);
		},
		isEmpty : function(t) {
			return G.util.trim(t) === "";
		},
		isURL : function(t) {
			return G.valid.validar(t, /^http\:\/\/.*/);
		},
		isHour : function(t) {
			return G.valid.validar(t, /^\d{1,2}(\:\d{2}){1,2}$/);
		},
		areEquals : function(a) {
			for ( var i = 0; i < a.length; i++) {
				for ( var j = i + 1; j < a.length; j++) {
					if (a[i].value !== a[j].value) {
						return false;
					}
				}
			}
			return true;
		},
		validar : function(t, p) {
			return t ? p.test(t) : false;
		}
	},
	nav : {
		isIE : false,
		isNS : false,
		isOP : false,
		isSA : false,
		isCH : false,
		version : null,
		load : function() {
			ua = navigator.userAgent;
			s = "MSIE";
			if ((i = ua.indexOf(s)) >= 0) {
				this.isIE = true;
				this.version = parseFloat(ua.substr(i + s.length));
			} else {
				s = "Netscape6/";
				if ((i = ua.indexOf(s)) >= 0) {
					this.isNS = true;
					this.version = parseFloat(ua.substr(i + s.length));
				} else {
					s = "Netscape/8";
					if ((i = ua.indexOf(s)) >= 0) {
						this.isNS = true;
						this.version = 8;
					} else {
						s = "Firefox";
						if ((i = ua.indexOf(s)) >= 0) {
							this.isNS = true;
							this.version = parseFloat(ua.substr(i + s.length));
						} else {
							s = "Opera";
							if ((i = ua.indexOf(s)) >= 0) {
								this.isOP = true;
								this.version = parseFloat(ua.substr(i
										+ s.length));
							} else {
								s = "Chrome";
								if ((i = ua.indexOf(s)) >= 0) {
									this.isCH = true;
								} else {
									s = "Safari";
									if ((i = ua.indexOf(s)) >= 0) {
										this.isSA = true;
									} else {
										s = "Gecko";
										if ((i = ua.indexOf(s)) >= 0) {
											this.isNS = true;
										} else {
											this.isIE = true;
										}
									}
								}
							}
						}
					}
				}
			}
		}
	},
	Desplazantes : {
		lista : [],
		add : function(d) {
			if (d instanceof G.desplazante) {
				return this.lista.push(d) - 1;
			}
			return false;
		},
		search : function(idcapa) {
			for ( var i = 0; i < this.lista.length; i++) {
				if (this.lista[i].idcapa === idcapa) {
					return this.lista[i];
				}
			}
			return {};
		}
	},
	desplazante : function(obj) {
		this.error = function() {
			throw ("No se pudo iniciar el desplazante");
		};
		!obj ? this.error() : "";
		this.settings = {
			capa : false,
			intervaloTiempo : 10,
			tiempoDescanso : 10,
			sentido : "horizontal",
			direccion : "negativa",
			posicion : 0,
			timeHander : false,
			incremento : 10,
			idcapa : false,
			detenerSobre : true,
			exceso : 0
		};
		G.util.parse(obj, this.settings);
		G.util.parse(this.settings, this);
		!this.capa ? this.error() : "";
		typeof this.capa == "string" ? this.capa = G.dom.$(this.capa) : "";
		this.capa.id ? (this.idcapa = this.capa.id) : "";

		!this.capa.children ? this.error() : "";
		var c = this.capa;
		var cch = this.capa.children;
		cch.length <= 0 ? this.error() : "";
		this.contenedor = G.dom.create("div");
		var cco = this.contenedor;
		cco.id = this.idcapa + "contenedor";
		this.iniciar = function() {
			this.timeHander = setTimeout("G.Desplazantes.search('"
					+ this.idcapa + "').animar();", this.tiempoDescanso);
		};
		this.detener = function() {
			clearTimeout(this.timeHander);
		};
		this.animar = function() {
			var fc;
			var d = this.direccion === "negativa" ? false : true;
			if (!d) {
				fc = cco.firstChild;
			} else {
				fc = cco.lastChild;
			}
			if (this.sentido === "horizontal") {
				var w = fc.offsetWidth;
				if (w != fc.oldoW) {
					cco.style.width = (cco.offsetWidth - fc.oldoW + w) + "px";
					fc.realoW = fc.realoW - fc.oldoW + w;
					fc.oldoW = w;
				}
				if (cco.offsetWidth >= c.offsetWidth) {
					if (this.posicion != cco.offsetLeft) {
						cco.style.left = this.posicion + "px";
					}
					var tiempo = this.intervaloTiempo;
					if (!d) {
						if (this.posicion > fc.realoW * (-1)) {
							this.posicion -= this.incremento;
							cco.style.left = this.posicion + "px";
						} else {
							cco.removeChild(fc);
							cco.appendChild(fc);
							this.posicion = 0;
							cco.style.left = this.posicion + "px";
							tiempo = this.tiempoDescanso;
						}
						this.timeHander = setTimeout("G.Desplazantes.search('"
								+ this.idcapa + "').animar();", tiempo);
					} else {
						if (this.posicion >= 0) {
							cco.removeChild(fc);
							cco.insertBefore(fc, cco.firstChild);
							this.posicion = -w;
							cco.style.left = this.posicion + "px";
							tiempo = this.tiempoDescanso;
						} else {
							this.posicion += this.incremento;
							if (this.posicion > 0) {
								this.posicion = 0;
							}
							cco.style.left = this.posicion + "px";
						}
						this.timeHander = setTimeout("G.Desplazantes.search('"
								+ this.idcapa + "').animar();", tiempo);
					}
				}
			} else {
				var h = fc.offsetHeight;
				if (cco.offsetHeight >= c.offsetHeight) {
					if (this.posicion != cco.offsetTop) {
						cco.style.top = this.posicion + "px";
					}
					var tiempo = this.intervaloTiempo;
					if (!d) {
						if (this.posicion > h * (-1)) {
							this.posicion -= this.incremento;
							cco.style.top = this.posicion + "px";
						} else {
							cco.removeChild(fc);
							cco.appendChild(fc);
							this.posicion = 0;
							cco.style.top = this.posicion + "px";
							tiempo = this.tiempoDescanso;
						}
						this.timeHander = setTimeout("G.Desplazantes.search('"
								+ this.idcapa + "').animar();", tiempo);
					} else {
						if (this.posicion >= 0) {
							cco.removeChild(fc);
							cco.insertBefore(fc, cco.firstChild);
							this.posicion = -h;
							cco.style.top = this.posicion + "px";
							tiempo = this.tiempoDescanso;
						} else {
							this.posicion += this.incremento;
							if (this.posicion > 0) {
								this.posicion = 0;
							}
							cco.style.top = this.posicion + "px";
						}
						this.timeHander = setTimeout("G.Desplazantes.search('"
								+ this.idcapa + "').animar();", tiempo);
					}
				}
			}
		};
		this.irPositivo = function() {
			this.direccion = "positiva";
			this.detener();
			this.animar();
		};
		this.irNegativo = function() {
			this.direccion = "negativa";
			this.detener();
			this.animar();
		};
		G.util.parse({
			position : "relative"
		}, c.style);
		var totalw = 0;
		var top = 0;
		var left = 0;
		var max = 0;
		for ( var i = 0; i < cch.length; i++) {
			var ccx = cch[i];
			if (i === 0 && this.sentido === "horizontal") {
				left = ccx.offsetLeft;
			} else {
				top = ccx.offsetTop;
			}
			G.util.parse({
				cssFloat : "left",
				styleFloat : "left"/*
									 * , marginLeft : "5px", marginRight : "5px"
									 */
			}, ccx.style);
			ccx.oldoW = ccx.offsetWidth;
			ccx.oldoH = ccx.offsetHeight;
			if (max < ccx.oldoH) {
				max = ccx.oldoH;
			}
			cco.appendChild(ccx);
			ccx.desplazante = this;
			var marginLeft = 0;
			var marginRight = 0;
			if (ccx.className) {
				var listaclass = ccx.className.split(" ");
				for ( var x = 0; x < listaclass.length; x++) {
					if (listaclass[x]) {
						var styleX = G.dom._("." + listaclass[x]);
						if (styleX) {
							if (styleX["margin-left"]) {
								marginLeft = styleX["margin-left"];
							} else if (styleX["margin-left-value"]) {
								marginLeft = styleX["margin-left-value"];
							}
							if (styleX["margin-right"]) {
								marginRight = styleX["margin-right"];
							} else if (styleX["margin-right-value"]) {
								marginRight = styleX["margin-right-value"];
							}
						}
					}
				}
				marginLeft = parseInt(marginLeft);
				marginLeft = isNaN(marginLeft) ? 0 : marginLeft;
				marginRight = parseInt(marginRight);
				marginRight = isNaN(marginRight) ? 0 : marginRight;
			}
			ccx.realoW = ccx.oldoW + marginLeft + marginRight;
			totalw += ccx.realoW;
			if (this.detenerSobre) {
				G.event.addEvent(ccx, "mouseover", function() {
					var d = this.desplazante;
					if (d) {
						d.detener();
					}
				});
				G.event.addEvent(ccx, "mouseout", function() {
					var d = this.desplazante;
					if (d) {
						d.animar();
					}
				});
			}
			i--;
		}
		totalw += 3;
		c.appendChild(cco);
		G.util.parse({
			position : "absolute",
			left : left + "px",
			top : top + "px"
		}, cco.style);
		if (this.sentido === "horizontal") {
			cco.style.width = totalw + "px";
		} else {
			c.style.height = max + "px";
		}
		var idPos = G.Desplazantes.add(this);
		if (!this.idcapa) {
			this.idcapa = idPos;
			cco.id = this.idcapa + "contenedor";
		}
	},
	OwnTextBox : {
		create : function(id, name, value, textodefecto) {
			var otb = G.dom.create("input", id, name, value);
			this.convert(otb, textodefecto);
			return otb;
		},
		convert : function(el, textodefecto) {
			if (typeof el === "string") {
				el = G.dom.$(el);
			}
			if (el) {
				el.defaultText = textodefecto;
				if (!G.util.trim(el.value)) {
					el.value = textodefecto;
				}
				G.event.addEvent(el, "focus", function() {
					if (this.value === this.defaultText) {
						this.value = "";
					}
				});
				G.event.addEvent(el, "blur", function() {
					if (G.util.trim(this.value) === "") {
						this.value = this.defaultText;
					}
				});
			}
		}
	},
	image : {
		loader : function(lista) {
			if (lista && lista.length > 0) {
				this.imgs = lista;
			}
			this.ownImgs = [];
			this.lista = [];
			this.progress = 0;
			this.start = function() {
				for ( var i = 0; i < this.imgs.length; i++) {
					if (this.imgs[i].tagName == "IMG") {
						this.imgs[i].style.display = "none";
						this.lista[i] = this.imgs[i].getAttribute("rel");
						this.imgs[i].src = "";
					} else {
						this.lista[i] = this.imgs[i];
					}
				}
				this.next();
			};
			this.onProgress = function() {
			};
			this.next = function() {
				if (this.lista.length > this.progress) {
					var i = this.progress;
					this.ownImgs[i] = new Image();
					if (this.imgs[i].tagName == "IMG") {
						this.ownImgs[i].imageReal = this.imgs[i];
					}
					this.ownImgs[i].Gloader = this;
					this.ownImgs[i].onload = function() {
						this.Gloader.progress++;
						if (this.Gloader.onProgress) {
							this.Gloader.onProgress(this.Gloader.progress);
						}
						if (this.imageReal) {
							this.imageReal.src = this.src;
							this.imageReal.style.display = "block";
						}
						this.Gloader.next();
					};
					this.ownImgs[i].src = this.lista[i];
				}
			};
		}
	},
	// Copyright 2001 by Mike Hall.
	// See http://www.brainjar.com for terms of use.
	//
	// modified by Goaamb(goaamb@gmail.com) 2008
	// using own dom object
	// changed dragObj.elNode.style.left by drag.elNode.offsetLeft
	// Inserted into G library on 2011 for goaamb
	Dragdrop : {
		dragStart : function(event, id) {
			G.Dragdrop.dragObj.zIndex = 0;

			if (id instanceof String) {
				id = G.dom.$(id);
			}
			if (!id) {
				if (G.nav.isIE)
					id = window.event.srcElement;
				else
					id = event.target;
				if (id.nodeType == 3)
					id.elNode = id.parentNode;
			}
			G.util.parse({
				position : "absolute",
				cursor : "move"
			}, id.style);
			G.Dragdrop.dragObj.elNode = id;
			var xy = G.event.getPos(event);
			G.Dragdrop.dragObj.cursorStartX = xy.x;
			G.Dragdrop.dragObj.cursorStartY = xy.y;
			G.Dragdrop.dragObj.elStartLeft = parseInt(id.offsetLeft, 10);
			G.Dragdrop.dragObj.elStartTop = parseInt(id.offsetTop, 10);
			if (isNaN(G.Dragdrop.dragObj.elStartLeft))
				G.Dragdrop.dragObj.elStartLeft = 0;
			if (isNaN(G.Dragdrop.dragObj.elStartTop))
				G.Dragdrop.dragObj.elStartTop = 0;
			id.style.zIndex = ++G.Dragdrop.dragObj.zIndex;
			if (G.nav.isIE) {
				document.attachEvent("onmousemove", G.Dragdrop.dragGo);
				document.attachEvent("onmouseup", G.Dragdrop.dragStop);
				window.event.cancelBubble = true;
				window.event.returnValue = false;
			} else {
				document.addEventListener("mousemove", G.Dragdrop.dragGo, true);
				document.addEventListener("mouseup", G.Dragdrop.dragStop, true);
				event.preventDefault();
			}
		},
		dragGo : function(event) {

			var xy = G.event.getPos(event);

			var resux = G.Dragdrop.dragObj.elStartLeft + xy.x
					- G.Dragdrop.dragObj.cursorStartX;
			var resuy = G.Dragdrop.dragObj.elStartTop + xy.y
					- G.Dragdrop.dragObj.cursorStartY;

			if (resux >= 0 && resuy >= 0) {
				G.util.parse({
					left : resux + "px",
					top : resuy + "px"
				}, G.Dragdrop.dragObj.elNode.style);
				if (G.Dragdrop.dragObj.elNode.onDragGo) {
					G.Dragdrop.dragObj.elNode.onDragGo(resux, resuy);
				}
				if (G.nav.isIE) {
					window.event.cancelBubble = true;
					window.event.returnValue = false;
				} else
					event.preventDefault();
			}
		},
		dragStop : function(event) {
			if (G.nav.isIE) {
				document.detachEvent("onmousemove", G.Dragdrop.dragGo);
				document.detachEvent("onmouseup", G.Dragdrop.dragStop);
			} else {
				document.removeEventListener("mousemove", G.Dragdrop.dragGo,
						true);
				document.removeEventListener("mouseup", G.Dragdrop.dragStop,
						true);
			}
		}
	}

};
G.Dragdrop.dragObj = new Object();
G.nav.load();
