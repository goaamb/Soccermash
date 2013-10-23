// JavaScript Document

	/** INI :: Funciones para el manejo de Cookies **/
	function JS_createCookie(sName, mValue, iExpires, sPath){var sExpires = "";if (iExpires){var oDate = new Date();oDate.setTime(oDate.getTime() + iExpires);sExpires = "; expires=" + oDate.toGMTString();}document.cookie = sName + "=" + mValue + sExpires + "; path=/" + (sPath ? sPath + '/' : '');};
	/** END :: Funciones para el manejo de Cookies **/


	/** INI :: Funciones validación cliente **/
	function JS_isset(v){return ((typeof(v)=='undefined' || v.length==0) ? false : true);}
	function JS_inArray(mValue, aDatos){ for(var iIndex in aDatos) if (aDatos[iIndex] == mValue) return true; return false;}
	/** END :: Funciones validación cliente **/

	/** INI :: Funciones para formatear elementos **/
	function JS_formatAsMoney(iNumero){if (iNumero == 0) return 0.00; iNumero -= 0; iNumero = (Math.round(iNumero * 100)) / 100; return (iNumero == Math.floor(iNumero)) ? iNumero + '.00' : ( (iNumero * 10 == Math.floor(iNumero * 10)) ? iNumero + '0' : iNumero);}
	function JS_formatUserDate(oDate){var iMonth = oDate.getMonth()+1;var iDay = oDate.getDate();return (iDay<10 ? '0' : '') + iDay + '/' + (iMonth<10 ? '0' : '') + iMonth  + '/' + oDate.getFullYear();}
	/** END :: Funciones para formatear elementos **/

	function JS_setMultiselect(sSelectId, sDatos){var aDatos = sDatos.split(','); $('#' + sSelectId + ' > option').each(function (iItem){ if (JS_inArray(this.value, aDatos)) {this.selected = true;}else{this.selected = false;}})}

	/** INI :: Funciones controladoras de ventanas **/
	function makeSublist(parent,child,isSubselectOptional,childVal)
	{
		$("body").append("<select style='display:none' id='"+parent+child+"'></select>");
		$('#'+parent+child).html($("#"+child+" option"));
		var parentValue = $('#'+parent).attr('value');
		$('#'+child).html($("#"+parent+child+" .sub_"+parentValue).clone());

		childVal = (typeof childVal == "undefined")? "" : childVal ;
		$("#"+child+' option[@value="'+ childVal +'"]').attr('selected','selected');

		$('#'+parent).change(
			function()
			{
				var parentValue = $('#'+parent).attr('value');
				$('#'+child).html($("#"+parent+child+" .sub_"+parentValue).clone());
				if(isSubselectOptional) $('#'+child).prepend("<option value='none'> -- Seleccione -- </option>");
				$('#'+child).trigger("change");
				$('#'+child).focus();
			}
		);
	};


	function JS_showSelectBoxes(){var selects = document.getElementsByTagName("select");for (i = 0; i != selects.length; i++){selects[i].style.visibility = "visible";}};
	function JS_hideSelectBoxes(){var selects = document.getElementsByTagName("select");for (i = 0; i != selects.length; i++) {selects[i].style.visibility = "hidden";}};
	function JS_showFlash(){var flashObjects = document.getElementsByTagName("object");for (i = 0; i < flashObjects.length; i++) {flashObjects[i].style.visibility = "visible";}var flashEmbeds = document.getElementsByTagName("embed");for (i = 0; i < flashEmbeds.length; i++) {flashEmbeds[i].style.visibility = "visible";}};
	function JS_hideFlash(){var flashObjects = document.getElementsByTagName("object");for (i = 0; i < flashObjects.length; i++) {flashObjects[i].style.visibility = "hidden";}var flashEmbeds = document.getElementsByTagName("embed");for (i = 0; i < flashEmbeds.length; i++) {flashEmbeds[i].style.visibility = "hidden";}};
	function JS_getPageScroll(){var yScroll;if (self.pageYOffset){yScroll = self.pageYOffset;} else if (document.documentElement && document.documentElement.scrollTop){yScroll = document.documentElement.scrollTop;}else if (document.body){yScroll = document.body.scrollTop;}arrayPageScroll = new Array('',yScroll);return arrayPageScroll;};
	//Retorna un array con el ancho y alto de la ventana
	function JS_getPageSize(){var xScroll, yScroll;if (window.innerHeight && window.scrollMaxY) {xScroll = document.body.scrollWidth;yScroll = window.innerHeight + window.scrollMaxY;} else if (document.body.scrollHeight > document.body.offsetHeight){xScroll = document.body.scrollWidth;yScroll = document.body.scrollHeight;} else {xScroll = document.body.offsetWidth;yScroll = document.body.offsetHeight;}var windowWidth, windowHeight;if (self.innerHeight) {windowWidth = self.innerWidth;windowHeight = self.innerHeight;} else if (document.documentElement && document.documentElement.clientHeight) {windowWidth = document.documentElement.clientWidth;windowHeight = document.documentElement.clientHeight;} else if (document.body) {windowWidth = document.body.clientWidth;windowHeight = document.body.clientHeight;}if(yScroll < windowHeight){pageHeight = windowHeight;} else {pageHeight = yScroll;}if(xScroll < windowWidth){pageWidth = windowWidth;} else {pageWidth = xScroll;}arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight); return arrayPageSize;};
	// Retorna un array con los valores x,y del scroll de la pagina
	function JS_getPageScroll(){var yScroll;if (self.pageYOffset){yScroll = self.pageYOffset;} else if (document.documentElement && document.documentElement.scrollTop){yScroll = document.documentElement.scrollTop;} else if (document.body){yScroll = document.body.scrollTop;}arrayPageScroll = new Array('',yScroll);return arrayPageScroll;};


	function JS_loadingShow(sIdContenido, sText)
	{
		//ocultamos el contenido mientras mostramos el mensaje
		sImg = "<div id='loading' style='padding:120px 20px; text-align:center;'><p style='font-weight:bolder; margin:0px;'>" + sText + "</p><img src='share/img/ajax-loader.gif' /></div>";
		$("#"+sIdContenido).hide("slow").after(sImg);
	}

	function JS_loadingHide(sIdContenido)
	{
		//ocultamos el contenido mientras mostramos el mensaje
		sBox = "#"+sIdContenido;
		$(sBox).show("slow");

		//removemos la imagen
		$("#loading").remove();
	}
	/** END :: Funciones controladoras de ventanas **/

	/** INI :: MESAGES 
	function JS_setMesage(error, sMsg)
	{
		$("#cntMensagePage").html(sMsg).slideDown("slow", function(){
			setTimeout( '$("#cntMensagePage").slideUp("slow");', 12000);
		});
	}**/

	function JS_setMesage(error, sMsg)
	{
		$("#cntMensagePage").html(sMsg).slideDown("slow", function(){
			setTimeout( '$("#cntMensagePage").slideUp("slow");', 5000);
		});
	}
	function JS_setSuccessMessage(sMsg)
	{
		$("#divSuccessMessages").html(sMsg).slideDown("normal", function(){
			setTimeout( function(){
				$("#divSuccessMessages").slideUp("fast");
			}, 2000);
		});
	}
	function JS_setMesageForm(sMsg)
	{
		$(".form-message").html(sMsg).slideDown("normal");
	}
	/** END :: MESAGES **/


	/** INI :: BOX **/
	function JS_closeBox()
	{
		JS_hideCargando();
		JS_showFlash();
		$("#lightBG").hide();
		$("#lightBOX").hide().html('');
	}
	function JS_openBox(sElementId, iWidth)
	{
		var arrayPageScroll = JS_getPageScroll();
		var arrayPageSize 	= JS_getPageSize();
		JS_hideFlash();
		if (!iWidth) iWidth = 300;
		$("#lightBG").css('height', arrayPageSize[1] + 'px').show();
		$("#lightBOX").html($("#" + sElementId).html())
									.css({top: 		arrayPageScroll[1] + (arrayPageSize[3] / 10) + 'px',
												left: 	Math.round((arrayPageSize[2] - iWidth) / 2) + 'px',
												width: 	(iWidth != 0 ? iWidth : 300)+'px'
											 })
									.show();
	}
	/** END :: BOX **/


	/** INI :: GRID **/
	function JS_initGrid()
	{
		if ($("#cntBodyList > tr").length == 0)
		{
			$("#cntBodyList").html('<tr align="center"><td colspan="50" class="ajax-load"><div>Recuperando datos</div></td></tr>');
		}

		if ($("table#cntListHeader tr").get(0))
		{
			$("table#cntListHeader tr").mouseover(function(){
				$(this).children().each(function(i){$(this).addClass("hover");});
			});
		}
		$("table#cntListHeader tr").mouseout(function(){
			$(this).children().each(function(i){$(this).removeClass("hover");});
		});


		/** Coloco cada fila a una altura de 70px **/
		/*
		//$("table#cntListHeader tbody tr").css({'height': '20px'});

		$("table#cntListHeader tbody tr").click(function (){
			agrandarTR(this);
    });
    */
		if ($(".wgtTooltip").get(0))
		{
			$(".wgtTooltip").Tooltip({ delay: 0, track: true, showBody: " ## ", event: "mouseover"});
		}
	};
	function JS_showCargando()
	{
		$("div.loading").fadeIn();
		$("#cntBodyList").addClass('loading');
	}
	function JS_hideCargando()
	{
		$("div.loading").fadeOut("slow");
		$("#cntBodyList").removeClass();
	}
	$(document).ready(function(){JS_initGrid();});
	/** END :: GRID **/


	/*
	function agrandarTR(oTr)
	{
		$(oTr).css({'height': (parseInt($(oTr).css('height'))+20) + 'px'});
		$(oTr).unbind( "click" ).click(function (){achicarTR(this);});
	}
	function achicarTR(oTr)
	{
		$(oTr).css({'height': (parseInt($(oTr).css('height'))-20) + 'px'});
		$(oTr).unbind( "click" ).click(function (){agrandarTR(this);});
	}
	*/

	/** INI :: FUNCTIONS CONFIRM **/
	var sFunctionsConfirm = null;
	var aParamsConfirm = null;
	function JS_confirm(sTitle, sMsg, sFunction, aParams){sFunctionsConfirm = sFunction;aParamsConfirm = aParams;$.prompt('<h3>' + sTitle + '</h3><p>' + sMsg + '</p>',{buttons:{Aceptar:true, Cancelar:false},prefix:'brownJqi',callback: JS_confirmComplete});};
	function JS_confirmComplete(bReturn){if (bReturn){sFunctionsConfirm(aParamsConfirm[0], aParamsConfirm[1]);}}
	function JS_alert(sTitle, sText){$.prompt('<h3>' + sTitle + '</h3><p>' + sText + '</p>', {prefix:'brownJqi'});}
	/** END :: FUNCTIONS CONFIRM **/

	function JS_header(sUrl)
	{
		window.location.href = (typeof(sUrl) == undefined && sUrl == '') ? window.location.href : sUrl;
	}

	/** INI :: FUNCTIONS IMAGE AJAX **/
	function iniInputFile(sInputId)
	{
		var oContent = $("#" + sInputId).parent();
		//var oForm = oContent.parents(".frmContenido");

		//oForm.prepend('<div class="confirmFile"></div>');

		sNewCode = '<input type="file" id="upfilexajax_' + sInputId + '" name="upfilexajax_' + sInputId + '" class="uploads" />';
		sNewCode += '<input type="hidden" id="' + sInputId + '" name="' + sInputId + '" value="" />';

		sProgress = '<div id="upfilexajax_' + sInputId + 'igmLoadingFile" class="upfilexajax_loading"><img src="share/img/small_loading.gif"></div>';

		sDone = '<div id="upfilexajax_' + sInputId + 'result" class="upfilexajax_file"></div>';

		$("#" + sInputId).remove();

		oContent.append(sNewCode + sProgress + sDone);
		$("#upfilexajax_" + sInputId + "igmLoadingFile").fadeOut(1);
		$("#upfilexajax_" + sInputId).change(function(){return ajaxFileUpload('upfilexajax_' + sInputId, sInputId);});
	}
	function ajaxFileUpload(sInputId, sRealInputId)
	{
		//starting setting some animation when the ajax starts and completes
		$("#" + sInputId + "igmLoadingFile").ajaxStart(function(){$(this).fadeIn(200);}).ajaxComplete(function(){$(this).fadeOut(1);});
		/*
			prepareing ajax file upload
			url: the url of script file handling the uploaded files
			fileElementId: the file type of input element id and it will be the index of  $_FILES Array()
			dataType: it support json, xml
			secureuri:use secure protocol
			success: call back function when the ajax complete
			error: callback function when the ajax failed
		*/
		$.ajaxFileUpload
		(
			{
				url:'share/inc/ajaxfileupload.php?fileImputUpload=' + sInputId,
				secureuri:false,
				fileElementId: sInputId,
				dataType: 'json',
				success: function (data, status)
				{
					//alert($('#' + sInputId).val());

					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							$(".confirmFile").addClass('error').html('<strong>Error</strong><p>' + data.error + '</p>').slideToggle("normal").animate({opacity: 0.8}, 6000).slideToggle(1500, function (){$(".confirmFile").removeClass('error')});
							//$.prompt('<h3>Error</h3><p>' + data.error + '</p>', {prefix:'brownJqi'});
						}
						else
						{
							$('#' + sRealInputId).val(data.file);
							//alert('#' + sRealInputId);
							//$(".confirmFile").addClass('ok').html('<strong>Archivo subido</strong><p>' + data.msg + '</p>').slideToggle("normal").animate({opacity: 0.8}, 6000).slideToggle(1500, function (){$(".confirmFile").removeClass('ok')});
							//$('#' + sInputId).val(data.file);
							//alert($('#' + sInputId).val());
							//$.prompt('<h3>Archivo subido</h3><p>' + data.msg + '</p>', {prefix:'brownJqi'});

							$('#' + sInputId + 'result').html(data.file);
						}
					}
				},
				error: function (data, status, e){alert(e);}
			}
		)
		$("#" + sInputId).change(function(){return ajaxFileUpload(sInputId, sRealInputId);});
		return false;

	}

	function iniInputFilePreview(sInputId)
	{
		var oContent = $("#" + sInputId).parent();
		var oForm = oContent.parents("form");
		oForm.prepend('<div class="confirmFile"></div>');


		//var sNewCode = '<input type="file" id="upfilexajax_' + sInputId + '" name="upfilexajax_' + sInputId + '" class="cntFileField" />';
		var sNewCode = '<input type="file" align="left" id="upfilexajax_' + sInputId + '" name="upfilexajax_' + sInputId + '" size="10" />';
		sNewCode += '<input type="hidden" id="' + sInputId + '" name="' + sInputId + '" value="" />';

		$("#" + sInputId).remove();

		oContent.find('img.agregar_imagen').before(sNewCode);
		//oContent.find('img.agregar_imagen').after('<img class="imagen_login" id="upfilexajax_' + sInputId + 'igmLoadingFile" src="http://' + sUrlSite + '/share/img/small_loading.gif" style="display: hidden;">');
		//oContent.before('<span><img id="upfilexajax_' + sInputId + 'igmLoadingFile" src="http://' + sUrlSite + '/share/img/small_loading.gif" style="display: hidden;"></span>');
		$("#upfilexajax_" + sInputId + "igmLoadingFile").fadeOut(1);
		$("#upfilexajax_" + sInputId).change(function(){return ajaxFileUploadPreview('upfilexajax_' + sInputId, sInputId);});
	}
	function ajaxFileUploadPreview(sInputId, sRealInputId)
	{
		$("#" + sInputId + "igmLoadingFile").ajaxStart(function(){$(this).fadeIn(200);}).ajaxComplete(function(){$(this).fadeOut(1);});
		$.ajaxFileUpload
		(
			{
				url:'share/inc/ajaxfileupload.php?fileImputUpload=' + sInputId,
				secureuri:false,
				fileElementId: sInputId,
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else{
							$('#' + sRealInputId).val(data.file);
							$('#' + sRealInputId).next('img').attr('src', sUrlSite + 'share/ajax/upload/' + data.file + '?nocache=' + Math.random());
							//$('#' + sRealInputId).next('img').attr('src', 'http://' + sUrlSite + '/share/ajax/upload/' + data.file + '?nocache=' + Math.random());
						}
					}
				},
				error: function (data, status, e){alert(e);}
			}
		)
		$("#" + sInputId).change(function(){return ajaxFileUploadPreview(sInputId, sRealInputId);});
		return false;
	}





	function menuContenidoTinyMCE (sElement, iAncho, mLinks)
	{
		// O2k7 skin
		tinyMCE.init({
			// General options
			mode : "exact",
			elements : sElement,
			theme : "advanced",
			skin : "o2k7",
			plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,ajaxfilemanager",

			// Theme options
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,pastetext,removeformat",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			//theme_advanced_buttons2 : "pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			//theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			//theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : false,
			width: iAncho + 'px',

			// Example content CSS (should be your site CSS)
			content_css : "css/example.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "js/template_list.js",
			external_link_list_url : "js/link_list.js",
			external_image_list_url : "js/image_list.js",
			media_external_list_url : "js/media_list.js",

			//Ajax File Manager
			file_browser_callback : "ajaxfilemanager",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			},
			lista_links : mLinks
		});
	}

		function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = "http://"+sSiteUrl+"/administrator/share/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?editor=tinymce";
			switch (type) {
				case "image":
					break;
				case "media":
					break;
				case "flash":
					break;
				case "file":
					break;
				default:
					return false;
			}
			tinyMCE.activeEditor.windowManager.open({
				url: "http://"+sSiteUrl+"/administrator/share/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?editor=tinymce",
				width: 782,
				height: 440,
				inline : "yes",
				close_previous : "no"
			},{
				window : win,
				input : field_name
			});
		}

	/** END :: FUNCTIONS IMAGE AJAX **/
