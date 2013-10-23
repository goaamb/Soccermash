//Javascript Document



function add(){//add new profile tab & change backgrounds. limit max tab because layout space
//alert(maxprofile);
		if (maxprofile == 2){
			alert('The maximum number of profiles is 5');
		} else {
			//get .lastli & set regular bgd img. Remove lastli class & set regular tab class 
			$('#holdmenu ul li.lastli').css('background-image','../img/lftBgtbs.jpg').removeClass('lastli').removeClass('yllwEnd').addClass('rgtBkgrd');
			//get the new last li (plus button) & before it, add new li
			$('.plsPrfl').before('<li id="other" class="tabbg lastli yllwEnd"/>'); 
			//only for test purpouse 
			$('.yllwEnd').html('other');//only for test purpouse
			maxprofile =  maxprofile + 1;
		}
} //CLOSER ADD()

function closer(){
				$('#extendedGallery').fadeOut('fast');
				$('#modules').css('margin-top','0px');
} //CLOSER CLOSER()


////SHOW HIDE LANGUAGE SELECTOR////
function mylanguage(){
				$('#chooseLang').hide();
};

////SET HEIGHT///
function setmyheight() {			
				var a = $('#centralcolumn').height();
				//alert(a);
				$('#results').height(a);
				//var b = $('#results').height();
				//alert(b);
	}
	
function SetHeightVPlayer() {	

			//var a = $('#centralcolumn').height();
//			alert(a);
//			var b = a * 60 / 100;
//			alert(b);
//			//$('#videoPlayer').height(a);
//			$('#videoPlayer').height(b);
//			var c = $('#videoPlayer').height();
//			alert(c);
}


/*
 * jQuery autoResize (textarea auto-resizer)
 * @copyright James Padolsey http://james.padolsey.com
 * @version 1.04
 */

(function(a){a.fn.autoResize=function(j){var b=a.extend({onResize:function(){},animate:true,animateDuration:150,animateCallback:function(){},extraSpace:20,limit:1000},j);this.filter('textarea').each(function(){var c=a(this).css({resize:'none','overflow-y':'hidden'}),k=c.height(),f=(function(){var l=['height','width','lineHeight','textDecoration','letterSpacing'],h={};a.each(l,function(d,e){h[e]=c.css(e)});return c.clone().removeAttr('id').removeAttr('name').css({position:'absolute',top:0,left:-9999}).css(h).attr('tabIndex','-1').insertBefore(c)})(),i=null,g=function(){f.height(0).val(a(this).val()).scrollTop(10000);var d=Math.max(f.scrollTop(),k)+b.extraSpace,e=a(this).add(f);if(i===d){return}i=d;if(d>=b.limit){a(this).css('overflow-y','');return}b.onResize.call(this);b.animate&&c.css('display')==='block'?e.stop().animate({height:d},b.animateDuration,b.animateCallback):e.height(d)};c.unbind('.dynSiz').bind('keyup.dynSiz',g).bind('keydown.dynSiz',g).bind('change.dynSiz',g)});return this}})(jQuery);



$(document).unload(function(){
						$("#sL").load('gestion/modulos/home/chkS.php',{out:'out'});														
});

$(document).ready(function(){

$('#following, #clickFllwr').click(function(){
								setmyheight();
								$('#modules').hide();
});

$('#sndMsg').click(function(){		
							 $('#winContainer, #msgSender').show('slow');
							 return false;
							 });
$('#clsMail').click(function(){
							 $('#winContainer, #msgSender, #msgViewer, #errorRep').hide();
							 return false; 
});
$('#msgIconTop').click(function(){
							  $('#winContainer, #msgViewer').show('slow');
							  return false;
});
$('.headerMsg').click(function(){
									//alert('in');
								  var viewMsg = $(this).attr('id');
									//alert(viewMsg);
									//var z = '.msgholder .' + viewMsg;
									//alert(z);
									$('.' + viewMsg).slideToggle('fast');		
									JS_descMsj(viewMsg);  
									//var dispMsg = '#' +  viewMsg + '.msgholder';
									//$('#msg2 .msgholder').slideToggle('fast');			 
});

$('.replyMsg').click(function(){
							var mid = $(this).attr('id');
							//alert(mid);
							$('.' + mid).slideToggle();
							$('#dontSend2').attr('name', mid);
});
$('.replyMsg').toggle(function(){
														$(this).text('Cancel');	
															 },function(){
																$(this).text('Reply');
																 });
$('#dontSend2').click(function(){
							//var whatClose = $(this).attr('name');
							//alert(whatClose);
							//$('.' + whatClose).slideDown();
});
$('#smtgWrong').click(function(){
							 $('#winContainer, #errorRep').show('slow');	
							 return false;
});


///////////////////////SEARCH/////////////////////////////////////////////////////////////////////
$('#strgToSearch').click(function(){
		
		if($('#strgToSearch').val()=='Search'){
			$('#strgToSearch').val('');
            $('#strgToSearch').css('color','#000');
		}
})
$('#strgToSearch').blur(function(){
		if($('#strgToSearch').val()==''){
			$('#strgToSearch').css('color','#CCC');
			$('#strgToSearch').val('Search');
		}
})


function JS_search(){
				//alert('RECORDAR: poner en case strToSearch la invocacion a funcion de busqueda');
				}
				$('input[type="text"], textarea, input[type="password"]').keypress(function(e)
				{
				var code = e.keyCode;
				var presentInput = $(this).attr('id');
				
				if (code === 13){
				switch(presentInput){
				case 'passwordLoguin':
				JS_checkLoguin(); return false;
				break;
				case 'emailForgot':
				JS_checkForgot(); return false;
				break;
				case 'strgToSearch':
				chkSrch(); return false;
				break;
				default:
				break;
				}
				return false;
				}
});	

////WALL////
$('#wrtMain, #wrtSec').autoResize();
$('.yourAnswer').autoResize();
$('#publish').click(function(){
							$('#wrtMain').height(35);					 
							 });
$('.icheck').toggle(function(){
					$(this).addClass('icheckYes');
					}, function(){
					$(this).removeClass('icheckYes');	 
});
$('.writeWall').click(function(){
						//alert('recibe evento');
						var msg1 = "Write a public message on this wall";
						var mainmsg = $(this).text();
						//alert(mainmsg + secondmsg);
						if (mainmsg == msg1){
						$(this).empty();
						}
});
$('.writeWall').blur(function(){
							var mainmsg = $(this).text();
							var msg1 = "Write a public message on this wall";
							if(mainmsg == ""){
							$(this).text(msg1);
							}						
});

$('.yourAnswer').click(function(){
							//alert('recibe evento');
							var msg2 = "Write a comment and press Enter to publish it.";
							var secondmsg = $(this).text();
							//alert(mainmsg + secondmsg);
							if (secondmsg == msg2){
							$(this).empty();
							}
});
$('.yourAnswer').blur(function(){
							var msg2 = "Write a comment and press Enter to publish it.";
							var secondmsg = $(this).text();
							if(secondmsg == ""){
							$(this).text(msg2);
							}						
});
$('.deleteThis').hover(function(){
																$(this).css('background-color','#5caa7f');
																}, function(){
																$(this).css('background-color','#ffffff');	
																	});
$('.deleteThis2').hover(function(){
																$(this).css('background-color','#5caa7f');
																}, function(){
																$(this).css('background-color','#eaefe8');	
																	});

////SEARCH////
$("#endcontdatSearch").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');
$("#endcontdatSearch2").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');
$("#endcontdatSearch3").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');
$("#endcontdatSearch4").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');
/*********enhanced controls*************/

////FORMS////

var playerCheck = $('.lblField')
playerCheck.click(function(){																
					$(this).toggleClass('lblField2');
});

var radios = $('.lblRadio')
radios.click(function(){
			$(this).toggleClass('lblRadio2');
});

$('#lblman').click(function(){
					$('#lblwoman').removeClass('lblRadio2');
					//if ($('#man').is(':checked')){
					//alert('man is check');
					//}
});

$('#lblwoman').click(function(){
					$('#lblman').removeClass('lblRadio2');
					//if ($('#woman').is(':checked')){
					//alert('woman is check');
					//}
});		

var srchOpt = $('.lblCHK');
srchOpt.click(function(){														
$(this).toggleClass('lblCHK2');
});

		
		
		function hideAllProf(){
		$('#seeAgent, #seeCoach, #seeJournalist, #seeLawyer, #seeScout, #seeDirector, #seeHealth, #seePlayer, #seeFan, #srchInst, #srchMult').hide();	
		}
		
		
		//search profile
		$('#showSelectionStp1').click(function(){
								$('#visibleAreaStp1 ul').toggle();											 
		});
	/*	$('#visibleAreaStp1 ul').mouseleave(function(){
								$('#visibleAreaStp1 ul').toggle();											 
		});*/
		
		$('#visibleAreaStp1 ul li a').click(function(){
	    //$('#visibleAreaStp1 ul').toggle();
		var idSelected = $(this).attr('id');
		var txtSelected = $(this).text();
		$('#storeSelectADVProfile').val(idSelected);
		$('#showSelectionStp1').text(txtSelected);
		$('#visibleAreaStp1 ul').toggle();
  		////hide profiles//
  		hideAllProf();
		
	switch (idSelected){
		case '1':
		$('#seePlayer').show(); 
		$('#storeSelectADVProfile').val('1');
		break;
		case '2':
		$('#seeCoach').show(); 
		$('#storeSelectADVProfile').val('2');
		break;
		case '3':
		$('#seeAgent').show(); 
		$('#storeSelectADVProfile').val('3');
		break;
		case '4':
		$('#seeScout').show(); 
		$('#storeSelectADVProfile').val('4');
		break;
		case '5':
		$('#seeLawyer').show(); 
		$('#storeSelectADVProfile').val('5');
		break;
		case '6':
		$('#seeHealth').show(); 
		$('#storeSelectADVProfile').val('6');
		break;
		case '7':
		$('#seeDirector').show(); 
		$('#storeSelectADVProfile').val('7');
		break;
		case '8':
		$('#seeFan').show(); 
		$('#storeSelectADVProfile').val('8');
		break;
		case '9':
		$('#seeJournalist').show();
		$('#storeSelectADVProfile').val('9');
		break;
		}
		//$('#theAge').show();
		});

//////////////////////////////////


$('#advanced a').click(function(){ 
							$('#advSearcher').fadeToggle();
});

$('#showSelection').click(function(){
								$('#visibleArea ul').toggle();											 
});
$('.opera #showSelection').click(function(){
									var l = $('#lookingfor');
									l.css('visibility','hidden');	
});
$('#searchSelector').mouseleave(function(){																				 
									$('#visibleArea ul').hide();						
});
$('.opera #searchSelector').mouseleave(function(){
										var l = $('#lookingfor');
										l.css('visibility','visible');																				 
										$('#visibleArea ul').hide();						
});




$('#visibleArea ul li a').click(function(){																	 
										var idSelected = $(this).attr('id');
										var txtSelected = $(this).text();
										$('#storeSelectProfile').val(idSelected);
										
										$('#showSelection').text(txtSelected);
										$('#visibleArea ul').toggle();
										//alert(idSelected);
										switch (idSelected){
											
										case '1':
										hideAllProf();
										$("#searchStep1").show();
										$('#storeSelectADVProfile').val('0');
										
										
										break;
										
										case '2':
										
										hideAllProf();
										$("#searchStep1").hide();
										$("#srchInst").show();
										$('#storeSelectADVProfile').val('0');
										break;
										
										case '3':
										hideAllProf();
										$("#searchStep1").hide();
										$("#srchMult").show();
										$('#storeSelectADVProfile').val('0');
										break;
										
										
										case '4':
										hideAllProf();
										$("#searchStep1").hide();
										//$("#srchMult").show();
										$('#storeSelectADVProfile').val('0');
										break;
										}
										
										var l = $('#lookingfor');
										l.css('visibility','visible');
										$('#strgToSearch').focus();
});






////SHOW HIDE NEW USER FORM AT LOGIN////
$("#createIt").click(function(){
						$("#rcBottom").toggleClass("showBgImg");
						$("#newUser").toggleClass("hideNewUser");
});

////SHOW THE FORGOT PASSWRD FORM @ LOGIN////
$("#forgot").click(function() {
						$("#formLogin").hide();
						$("#formForgot").show();
});
												 
var maxprofile = $('#holdmenu ul li').length;

////LOGIN SHOW WINDOWS////
$('#footMenu ul li a').click(function(){
											var winToOpen = $(this).attr('id');	
											//alert(winToOpen);
											switch(winToOpen){
												case 'legalwindow':
													$('#winContainer, #legalContent').fadeIn();
													return false;
												break;
												case 'helpwindow':
													return false;
												break;
												case 'aboutwin':
													$('#winContainer, #aboutContent').fadeIn();
													return false;
												break;
												default:
												return false;
												break;
												}
});

$('.closerText').click(function(){
								 			$('#winContainer, #legalContent, #aboutContent').fadeOut();
											return false;
});

/////////////////////////MULTIMEDIA SLIDE/////////////////////////
var currentPosition = 0;     //posicion actual
var slideWidth = 180;      //ancho cada slide
var slides = $('.slide');     //seleccion todos los .slide
var numberOfSlides = 6;      //cuenta la cantidad de slides

var openGly = 0; //counter					


//alert(numberOfSlides);     //verificando que cuente bien
// Remove scrollbar in JS
$('#slidesContainer').css('overflow', 'hidden');
// Wrap all .slides with #slideInner div    //Todos los slide rodeado 2 div slideInner, ancho=suma todos anchos y muestra horizontal
slides
.wrapAll('<div id="slideInner"></div>').css('float','left');
// Float left to display horizontally, readjust .slides width
//.css({
//'float' : 'left',
//'width' : slideWidth
//});

// Set #slideInner width equal to total width of all slides
//$('#slideInner').css('width', slideWidth * numberOfSlides ); 
//$('#slideInner').width(1000);

// Insert controls in the DOM.prepend

$('#ctrls')
.append('<span class="control" id="leftControl">Left</span><br/><span class="control" id="rightControl">Right</span>');

$('.control')
.bind('click', function(){
dir = $(this).attr('id');

if (dir == 'rightControl'){

if (currentPosition <= (numberOfSlides-5)){ //si la cantidad de elementos a mostrar es dinamica, hay que replantear el 5 dinamicamente

currentPosition = currentPosition + 1;

// Move slideInner using margin-left
$('#slideInner').animate({
'marginLeft' : slideWidth*(-currentPosition)
});
return currentPosition;
}
}else{
//alert('izq');
if (currentPosition > 0){
currentPosition = currentPosition - 1;
//alert('pos saliente' + currentPosition);
// Move slideInner using margin-left
$('#slideInner').animate({
'marginLeft' : slideWidth*(-currentPosition)
});
return currentPosition;
} //CLOSER
}	//CLOSER			
});//END control blind


//show/hide extended gallery
$('#ctrls em').click(function(){
						if ($('#slidesContainer').hasClass('isvideo'))
						{
						//$('#extendedGallery').fadeIn('slow').load('gestion/modulos/home/extVideos.php');
						loadVideos();
						$('#extendedGallery').fadeIn('slow');
						}
						else if ($('#slidesContainer').hasClass('isphoto'))
						{
						//$('#extendedGallery').fadeIn('slow').load('gestion/modulos/home/extPhotos.php');
						loadPhotos();
						$('#extendedGallery').fadeIn('slow');
						}
						else
						{
						//$('#extendedGallery').fadeIn('slow').load('gestion/modulos/home/extVideos.php');
						loadVideos();
						$('#extendedGallery').fadeIn('slow');
						}; //CLOSER IF
					$('#modules').css('margin-top','135px');
});
////TOP RIGHT MENU////
$('#openhelp, .openhelp').click(function(){
										//alert('qqqq');
										$('#help').html('');
										$('#results').hide();
										$('body').scrollTop(0);
										var nowHeight = $(window).height()+'px';
										//alert(nowHeight);
										$('#help').css('min-height',nowHeight);
										$('#help').load('gestion/modulos/home/help.php').fadeIn();
										document.location.href='#header';
										//$('#header').scrollTop(0);
										return false;
});



$('.openhelp').click(function(){
										//alert('qqqq');
										$('#help').html('');
										$('#results').hide();
										$('body').scrollTop(0);
										var nowHeight = $(window).height()+'px';
										//alert(nowHeight);
										$('#help').css('min-height',nowHeight);
										$('#help').load('gestion/modulos/home/help.php').fadeIn();
										document.location.href='#header';
										//$('#header').scrollTop(0);
										return false;
});

$('#openmydata').click(function(){
										$('#help').hide();		
										$("#accountViewer").load('gestion/modulos/account/accountMenu.php');
										//$('#results').load('ajax/personaldata.php').fadeIn();
										//$('#results').load('ajax/personaldata.php').fadeIn();	
										return false;
});
$('#closing').click(function(){
							$('#results').empty().fadeOut();														 
});

///BOTTOM MENU///
$('#openabout').click(function(){
										//alert('qqqq');
										$('#results').hide();
										$('#help').html('');
										$('body').scrollTop(0);
										var nowHeight = $(window).height()+'px';
										//alert(nowHeight);
										$('#help').css('min-height',nowHeight);
										$('#help').load('gestion/modulos/home/about.php').fadeIn();
										document.location.href='#header';
										return false;
});
$('.openlegal').click(function(){
										//alert('qqqq');
										$('#results').hide();
										$('#help').html('');
										$('body').scrollTop(0);
										var nowHeight = $(window).height()+'px';
										//var nowHeight = $('body').css('height');
										//alert(nowHeight);
										$('#help').css('min-height',nowHeight);
										$('#help').load('gestion/modulos/home/legal.php').fadeIn();
										document.location.href='#header';
										return false;
});

////ALL TIPSY TOOLTIPS FOR ALL SITE////

//HOME MULTIMEDIA TABS
//$('#video').tipsy({gravity: 'n'}); 
//$('#photo').tipsy({gravity: 'n'});
//$('#audio').tipsy({gravity: 'n'});
//$('#notes').tipsy({gravity: 'n'});

//TOOLBOX FOR HELP
//$('.visibilityFollows, .visibilityVotes, .icon, .deleteThis, .deleteThis2, .icheck, #upPhotoID, .editmode, #pbyellow, #linktoprev').tipsy({gravity: 'n'});
$('#home *').tipsy({gravity: 'n'});
$('#profFields').tipsy({ trigger: 'manual', gravity:'e', fallback:'Unselected profile. Choose yours.'});//tipsy({title: 'type'});

//FORM NEW USER @ LOGIN
$('#textShowed').tipsy({ trigger: 'manual', gravity:'e', fallback:'Unselected profile. Choose yours.'});
$('#labTermUse').tipsy({trigger: 'manual', gravity:'n', fallback:'Do you accept Terms of Use?'});
$('#firstName').tipsy({ trigger: 'manual', gravity:'e', fallback:'Name field empty'});
$('#toolP').tipsy({ trigger: 'manual', gravity:'e', fallback:'Name'});
$('#lastName').tipsy({trigger: 'manual', gravity: 'e', fallback:'Last Name field empty'});
$('#emailNewUser').tipsy({trigger: 'manual', gravity: 'e', fallback:'The email has not a valid format'});		
$('#emailNewUser.format').tipsy({trigger: 'manual', gravity: 'e', fallback:'E-mail address empty'}); 
$('#repeatEmail').tipsy({trigger: 'manual', gravity: 'e', fallback:'E-mail is Different!'});		
$('#newUserPass').tipsy({trigger: 'manual', gravity: 'e', fallback:'Password empty'});


//HIDE ALL TOOLTIPS  
$('#firstName').focus(function(){$(this).tipsy('hide');});
$('#lastName').focus(function(){$(this).tipsy('hide');});
$('#emailNewUser').focus(function(){$(this).tipsy('hide');});
$('#emailNewUser.format').focus(function(){$(this).tipsy('hide');});
$('#repeatEmail').focus(function(){$(this).tipsy('hide');});
$('#newUserPass').focus(function(){$(this).tipsy('hide');});


////POSITIONING PROGRESSBAR////
$('#progressbar span').css('background-position','0px 50px');  

////EDIT ICON EYES////
//$('.icon').toggle(function(){
//$(this).css('background-position','-149px -79px');
//},function(){
//$(this).css('background-position','-165px -79px');
//});	

////GO TO EDITION VISTA////
/*$('#edition').toggle(function(){
					//$('.icon').css('visibility','visible');
					$('.editmode').css('background-color','#EAEFE8');
					$('#profFields input').removeAttr('disabled','disabled');
					$('#holdmenu ul li:last').after('<li class="plsPrfl"/>');
					$('.plsPrfl').html('<a id="add" onclick="add()" />');
					$('.editMode').removeClass('hide');
					$('.Tbl tr, .Tbl2 tr, .Tbl3 tr, .Tbl4 tr, .Tbl5 tr').css('background-color','#EAEFE8').css('border-bottom','4px solid #FFFFFF');
					$('.Tbl tr:first, .Tbl2 tr:first, .Tbl4 tr:first, .Tbl5 tr:first').css('background-color','#FFFFFF');
					$('.innerContent table tr').css('cursor','pointer');
					$('.pls').addClass('erase');
					$('.publish').show();
					$('.hide').show();
					$('.whitecell').css('background-color','#FFFFFF');
					$('.lastli').addClass('yllwEnd');
					$('.plsPrfl').attr('title','Upgrade your Profile by adding a new one. For example, if you are Player, you can be fan, or coach. Just add the information required and you will be found easely.').tipsy({gravity: 'n'});
},function(){
					//AND EXIT THE EDITION VISTA
					//$('.icon').css('visibility','hidden');
					$('.editmode').css('background-color','#FFFFFF');
					//$('#profFields input').attr('disabled','disabled');	
					$('.plsPrfl').remove();
					$('.editMode').addClass('hide');
					$('.Tbl tr, .Tbl2 tr, .Tbl3 tr, .Tbl4 tr, .Tbl5 tr').css('border-bottom','0px');
					$('.Tbl tr:odd, .Tbl2 tr:odd, .Tbl4 tr:odd, .Tbl5 tr:odd').css('background-color','');
					$('.Tbl tr:even, .Tbl2 tr:even, .Tbl4 tr:even, .Tbl5 tr:even').css('background-color','#e9e9e9');
					$('.Tbl tr:first, .Tbl2 tr:first, .Tbl4 tr:first, .Tbl5 tr:first').css('background-color','#FFFFFF');
					$('.erase').css('background-color','');
					$('.pls').removeClass('erase');
					$('.publish').hide();
					$('.hide').hide();
					$('.lastli').removeClass('yllwEnd');
});*/ //CLOSER EDITION VISTA

//when click on module's title, get its ID & open/close its content (it has the id like class)
$('.content div h4').click(function(e){
									var a = e.target.id;
									var innerCont = $('.'+a);
									innerCont.slideToggle('fast');
									var t = '#'+a+' em.plus'; 
									$(''+t+'').toggleClass('close');
});

//Language selector on home
$('#chooseLang').click(function(){								
								$('#availLang').toggle('fast');
});
$('#availLang ul li a').click(function(){								
								$('#availLang').hide('fast');
});

//hide the personal info at keyprofile
$('#hideinf').toggle(function(){
						$('#profFields').fadeOut();
						$('#hideinf span').html('SHOW INFO <a class="masinf" href="#"></a>');
}, function(){
						$('#profFields').fadeIn();
						$('#hideinf span').html('HIDE INFO <a class="menosinf" href="#"></a>');
});

//Login Tabs:show, hide content & change state of tabs 
//$('#profFields input').attr('disabled','disabled');											 

//LEFT MENU BEHAVIORS
$("#menuProfile ul li a").click(function(){  //left column menu  
										var a = $(this).attr('id');
										//desactivamos seccion y activamos elemento de menu  
										$("#menuProfile ul li a.now").removeClass("now");	
										$("#menuProfile #"+a).attr('class','now');							
});				

////CHANGE TEXT ON LEFT MENU////
$('#edition').toggle(function(){
					$(this).html('<em id="editionI"></em>Save this profile');
}, function(){
					$(this).html('<em id="editionI"></em>Edit this profile').removeClass("now");	
});

////TABS FOR PROFILE - HONOURS, CAREER ETC////
$(".menu > li").click(function(e){    
							var a = e.target.id;  
							//desactivamos seccion y activamos elemento de menu  
							$(".menu li.active").removeClass("active");
							$(".menu #"+a).addClass("active");  
							//ocultamos divisiones, mostramos la seleccionada  
							$(".content").css("display", "none");  
							$("."+a).fadeIn('fast');
});

////TABS FOR SHOW HIDE UPLOADERS MULTIMEDIA////
$(".menuMulti > li em").click(function(){ 
										var f = $(this).parent().attr('id');
										$(".menuMulti > li em").css('color','#666666');
										$('#' + f + ' em').css('color','#000000');
										$('#videoUploader, #photoUploader, #videoPlayer').hide();
										$('#' + f + 'Uploader').show('slow').fadeIn('slow');
										$('#extendedGallery').fadeOut('fast'); //hide gallery 9 shots if is visible
										$('#modules').css('margin-top','40px');
										$('#nameVideo, #namePhoto').focus(); //automatic focus on first input
});
$('#intoUpload a').click(function(){
								$('#modules').css('margin-top','0px');																	
});
////TABS FOR SHOW MULTIMEDIA CONTENT AT SLIDER
$(".menuMulti > li img").click(function(e){  

									//1. recuperamos id li padre de img que recibe el click
									var aId = $(this).parent().attr('id');	
									
									//2. con (1) construimos el path de la nueva imagen (id + On.jpg)
									var newImg = 'img/' + aId + 'On.jpg';
									
									//4. hacer DES SELECTED al viejo elemento
									//4.1 buscamos el elemento que tiene OPEN clase, antes de hacer (3)
									var b = $('.open');
									
									//4.2 como no sabemos CUAL es este elemento, no sabemos CUAL es la IMG que debemos cambiar. Por eso, recuperamos su ID en una variable
									var bId = b.attr('id');     
									//alert('id del elemento a des seleccionar: ' + bId);
									//4.3 construimos en otra VAR el path de la imagen OFF a asignarle
									var oldImg = 'img/' + bId + 'Off.jpg';
									//alert('img a asignar ' + oldImg);
									//4.4 le asignamos la imagen OFF
									$('.open img').removeAttr('src').attr('src', oldImg);
									
									//4.5 seleccionandolo desde su OPEN clase, lo quitamos OPEN clase 
									b.removeClass('open');
									
									//3. hacer SELECTED nuevo elemento
									//3.1 le asignamos la clase OPEN al elemento padre del que recibo CLICK para reconocerlo
									var c =$(this).parent();
									c.addClass('open');
									
									//3.2 le quitamos la img existente y ponemos nueva imagen (selected)
									$(this).removeAttr('src').attr('src', newImg);
									$('#slidesContainer').removeAttr('class','');	
									switch (aId){ //control flow to load slider
									case 'video':
									//alert(a + '4');
									//$('#slidesContainer').load('gestion/modulos/home/video.php').addClass('isvideo');
									$('#slidesContainer').addClass('isvideo');
									loadVideoSlider();
									break;
									case 'audio':
									//alert(a);
									//$('#slidesContainer').load('gestion/modulos/home/audio.php').addClass('isaudio');
									$('#slidesContainer').addClass('isaudio');
									loadAudioSlider();
									break;
									case 'photo':
									//alert(a);
									//$('#slidesContainer').load('gestion/modulos/home/photo.php').addClass('isphoto');
									$('#slidesContainer').addClass('isphoto');
									loadPhotoSlider();
									break;
									case 'notes':
									//alert(a);
									//$('#slidesContainer').load('gestion/modulos/home/notes.php').addClass('isnotes');
									$('#slidesContainer').addClass('isnotes');
									loadNoteSlider();
									break;
									}
									$("."+aId).fadeIn('fast');
									$('#extendedGallery').fadeOut('fast'); //hide gallery 9 shots if is visible
									$('#videoPlayer').hide();//hide video/photo player if is visible
									//$('#modules').css('margin-top',''); //original position for modules
									$('#modules').show();
});


////CREATE ELEMENT FOR TABS MODULES @ HOME////
$('#holdmenu ul li:first').css('width','60px').css('padding-left','19px').addClass('firstli').addClass('active');
$('#holdmenu ul li').not(':first').not(':last').addClass('rgtBkgrd');
$('#holdmenu ul li:last').addClass('lastli');

////SORT MODULES @ HOME/////
/*$('.sortable').sortable();
$('.sortable').disableSelection();*/

////PAINTING ROWS @ MODULES HOME////
$('thead tr').css('background-color','#FFFFFF');
$('.Tbl tbody tr:even').css('background-color','#FFFFFF');
$('.Tbl tbody tr:odd').css('background-color','#e9e9e9');
$('.Tbl2 tbody tr:even').css('background-color','#FFFFFF');
$('.Tbl2 tbody tr:odd').css('background-color','#e9e9e9');
$('.Tbl4 tbody tr:even').css('background-color','#FFFFFF');
$('.Tbl4 tbody tr:odd').css('background-color','#e9e9e9');
$('.Tbl5 tbody tr:even').css('background-color','#FFFFFF');
$('.Tbl5 tbody tr:odd').css('background-color','#e9e9e9');

////DRAGDROP. CHANGES COLOUR ON EVENT (REQUIERE SPECIAL LIBRARY)////
/*$('.content div').bind('draginit', function(event){
$(this).css('background-color','#EAEFE8');
$(this).css('opacity','0.8');
})
.bind('dragend', function(event){
$(this).css('background-color','#FFFFFF');
$(this).css('opacity','1');
})	*///END sort&show

////CREATE BUTTON JQUERY @ ALL SITE////
$("input:submit, input:button, button").button();


////CREATE TOOLTIPS @ LOGIN////
//$(".wrapper").qtip({style:{classes:"ui-tooltip-shadow ui-tooltip-rounded ui-tooltip-green"}, position:{my:"top center", at:"bottom center"}});

////AUTOCOMPLETE JQUERY @ SEACHER////
/*$("#mySearch").autocomplete({source:["Javier Mascherano", "Lionel Messi", "Raul Bobadilla"]});
$("#selCountry").autocomplete({source:["Argentina", "Espa\u00f1a", "Estados Unidos", "Italia"]});
$("#selClub").autocomplete({source:["Barcelona FC", "Real Madrid", "Boca Junior"]});*/

////DATEPICKERS CALLINGS/////

$('.selectDate').datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');		
$("#selDate").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '1900:+nn');//birthday
$("#endingContractDate").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');
$("#foundationDate").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '1800:+nn');//birthday

////AUTOCUS @ LOGIN PAGE////
$("#emailLogin").focus();

////CHANGING LANGUAGE////	
$("#language").click(function() {
$("#language").hide("fast");
$("#listOfLanguages").show("fast");
});
$("#listOfLanguages").click(function() {
$("#listOfLanguages").hide("fast");
$("#language").show("fast");
});

////BEHAVIORS FORMS @ LOGIN////
$("#enterForgot").click(function() {
							$("#formForgot").hide();
							$("#formLogin").show();
							$("#forgot").hide();
							$("#msjPassw").show()
}); //CLOSER			

////BEHAVIOR FOR CUSTOM SELECTS////
$('#selDate').click(function(){
					$("#showIT").hide("fast");
					$("#showIT3").hide("fast");	
});								 
$("#textShowed").click(function() {
						$("#showIT").toggle();
});
$("#selector li").click(function() {
							var idSel = $(this).attr("id");
							var a = $(this).text();	
							//profileType
							$('#profileType').attr('value',idSel);  
							//Nationality
							$('#countryId').attr('value',idSel);		
							$('#countryName').attr('value',a);
							$("#textShowed").text(a);
							$("#showIT").hide("fast");
							$("#firstName").focus();
							//empty validation effect if
							$('#selectMenu').css('background-color','#ffffff');
							$("#error").text('');
							$("#city").load('gestion/lib/share/clases/cityListLoad.php',{country:idSel});
});
$("#textShowed2").click(function() {
							$("#showIT2").toggle()
});
$("#selector2 li").click(function() {
							var idSel2 = $(this).attr("id");
							var a2 = $(this).text();	
							//Nationality
							$('#hcountry').attr('value',idSel2);		
							$("#textShowed2").text(a2);
							$("#showIT2").hide("fast");
							$("#firstName").focus();
});


});////END DOCUMENT READY////




//////////////////////////////////////////////




/*Made by Rodrigo Berlochi-Martin Cantero-Sebastian Volta-Andres Grosso for Axyoma/Jaque. 2011, Argentine*/





