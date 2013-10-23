//Javascript Document

var maxprofile = $('#holdmenu ul li').length;
/////////////////////////MULTIMEDIA SLIDE/////////////////////////
$(document).ready(function(){
													 
//multimedia slider 
var currentPosition = 0;     //posicion actual
var slideWidth = 180;      //ancho cada slide
var slides = $('.slide');     //seleccion todos los .slide
var numberOfSlides = 6;      //cuenta la cantidad de slides
var dir; //direction clicked
//alert(numberOfSlides);     //verificando que cuente bien
// Remove scrollbar in JS
$('#slidesContainer').css('overflow', 'hidden');
// Wrap all .slides with #slideInner div    //Todos los slide rodeado 2 div slideInner, ancho=suma todos anchos y muestra horizontal
slides
.wrapAll('<div id="slideInner"></div>')
// Float left to display horizontally, readjust .slides width
.css({
'float' : 'left',
'width' : slideWidth
});

 // Set #slideInner width equal to total width of all slides
$('#slideInner').css('width', slideWidth * numberOfSlides);
// Insert controls in the DOM.prepend

$('#ctrls')
.append('<span class="control" id="leftControl">Left</span><br/><span class="control" id="rightControl">Right</span>');
 // Create event listeners for .controls clicks
	 
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
$('#extendedGallery').fadeIn('slow');
loadVideos();
}
else if ($('#slidesContainer').hasClass('isphoto'))
{
$('#extendedGallery').fadeIn('slow');
loadPhotos();
}
else{
$('#extendedGallery').fadeIn('slow');
loadVideos();
}; //CLOSER IF
$('#modules').css('margin-top','135px');
});


});   //END doc ready	 FOR MULTIMEDIA 						

$(document).ready(function(){

////ALL TIPSY TOOLTIPS FOR ALL SITE////
//HOME MULTIMEDIA TABS
$('#video').tipsy({gravity: 'n'}); 
$('#photo').tipsy({gravity: 'n'});
$('#audio').tipsy({gravity: 'n'});
$('#notes').tipsy({gravity: 'n'});

//FORM NEW USER @ LOGIN
$('#textShowed').tipsy({ trigger: 'manual', gravity:'e', fallback:'Unselected profile. Choose yours.'});
$('#labTermUse').tipsy({trigger: 'manual', gravity:'n', fallback:'Do you accept Terms of Use?'});
$('#firstName').tipsy({ trigger: 'manual', gravity:'e', fallback:'Name field empty'});
$('#lastName').tipsy({trigger: 'manual', gravity: 'e', fallback:'Last Name field empty'});
$('#emailNewUser').tipsy({trigger: 'manual', gravity: 'e', fallback:'The email has not a valid format'});		
$('#emailNewUser.format').tipsy({trigger: 'manual', gravity: 'e', fallback:'E-mail address empty'}); 
$('#repeatEmail').tipsy({trigger: 'manual', gravity: 'e', fallback:'E-mail is Different!'});		
$('#newUserPass').tipsy({trigger: 'manual', gravity: 'e', fallback:'Password empty'});

//BORRAR ESTO, LOS MUESTRA MARTIN
$('#signUpBttn').click(function(){
$('#textShowed').tipsy('show');
$('#firstName').tipsy('show');
$('#lastName').tipsy('show');
$('#emailNewUser').tipsy('show');
$('#emailNewUser.format').tipsy('show');
$('#repeatEmail').tipsy('show');
$('#newUserPass').tipsy('show');
$('#labTermUse').tipsy('show');
});

//HIDE ALL TOOLTIPS  
$('#firstName').focus(function(){$(this).tipsy('hide');});
$('#lastName').focus(function(){$(this).tipsy('hide');});
$('#emailNewUser').focus(function(){$(this).tipsy('hide');});
$('#emailNewUser.format').focus(function(){$(this).tipsy('hide');});
$('#repeatEmail').focus(function(){$(this).tipsy('hide');});
$('#newUserPass').focus(function(){$(this).tipsy('hide');});

}); //DOC READY CLOSER

////TRADICIONAL JAVASCRIPT FUNCTION////
function add(){//add new profile tab & change backgrounds. limit max tab because layout space
//alert(maxprofile);
if (maxprofile == 2){
alert('The maximum number of profiles is 5');
} else {
//get .lastli & set regular bgd img. Remove lastli class & set regular tab class 
$('#holdmenu ul li.lastli').css('background-image','../img/lftBgtbs.jpg').removeClass('lastli').removeClass('yllwEnd').addClass('rgtBkgrd');
//get the new last li (plus button) & before it, add new li
$('.plsPrfl').before('<li id="other" class="tabbg lastli yllwEnd"/>'); //only for test purpouse 
$('.yllwEnd').html('other');//only for test purpouse
maxprofile =  maxprofile + 1;
}
} //CLOSER ADD()

function closer(){
$('#extendedGallery').fadeOut('fast');
$('#modules').css('margin-top','0px');
} //CLOSER CLOSER()



$(document).ready(function(){

////POSITIONING PROGRESSBAR////
$('#progressbar span').css('background-position','0px 50px');  

////EDIT ICON EYES////
$('.icon').toggle(function(){
$(this).css('background-position','-149px -79px');
},function(){
$(this).css('background-position','-165px -79px');
});	

////GO TO EDITION VISTA////
$('#edition').toggle(function(){
$('.icon').css('visibility','visible');
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
},function(){
	//AND EXIT THE EDITION VISTA
$('.icon').css('visibility','hidden');
$('.editmode').css('background-color','#FFFFFF');
$('#profFields input').attr('disabled','disabled');	
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
}); //CLOSER EDITION VISTA

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
$('#profFields input').attr('disabled','disabled');											 

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
$('#modules').css('margin-top','25px');
$('#nameVideo, #namePhoto').focus(); //automatic focus on first input
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
$('#slidesContainer').addClass('isvideo');
loadVideoSlider();
break;
case 'audio':
//alert(a);
$('#slidesContainer').addClass('isaudio');
break;
case 'photo':
//alert(a);
$('#slidesContainer').addClass('isphoto');
loadPhotoSlider();
break;
case 'notes':
//alert(a);
$('#slidesContainer').addClass('isnotes');
break;
}
$("."+aId).fadeIn('fast');
$('#extendedGallery').fadeOut('fast'); //hide gallery 9 shots if is visible
});
$('.watermark').click(function(){ //open video player
$('#videoPlayer').fadeIn();
$('#modules').css('margin-top','135px');
});
$('.slide').click(function(){ //open video player
$('#videoPlayer').fadeIn();
$('#modules').css('margin-top','135px');
});
$(".closer").click(function(){ //close video player
$('#videoPlayer').hide('fast').fadeOut();
$('#modules').css('margin-top','');
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
$(".wrapper").qtip({style:{classes:"ui-tooltip-shadow ui-tooltip-rounded ui-tooltip-green"}, position:{my:"top center", at:"bottom center"}});

////AUTOCOMPLETE JQUERY @ SEACHER////
$("#mySearch").autocomplete({source:["Javier Mascherano", "Lionel Messi", "Raul Bobadilla"]});
$("#selCountry").autocomplete({source:["Argentina", "Espa\u00f1a", "Estados Unidos", "Italia"]});
$("#selClub").autocomplete({source:["Barcelona FC", "Real Madrid", "Boca Junior"]});

////DATEPICKERS CALLINGS/////
$('.selectDate').datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');		
$("#selDate").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '1900:+nn');//birthday
$("#endingContractDate").datepicker({changeMonth: true, changeYear: true}).datepicker("option", "yearRange", '2011:2100');

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
});//End doc.ready 

////SHOW HIDE LANGUAGE SELECTOR////
function mylanguage(){
$('#chooseLang').hide();
};								

////SPECIAL LAYOUT RULE FOR HIGH HEIGHT RESOLUTIONS////
$(document).ready(function() {
screen.height >= 900 && $("#holder").css("margin-top", "6%")
});

////SHOW HIDE NEW USER FORM AT LOGIN////
$(function() {
$("#createIt").click(function() {
$("#rcBottom").toggleClass("showBgImg");
$("#newUser").toggleClass("hideNewUser");
});

////SHOW THE FORGOT PASSWRD FORM @ LOGIN////
$(function() {
$("#forgot").click(function() {
$("#formLogin").hide();
$("#formForgot").show()
})

}); //CLOSER
}); //CLOSER

////BEHAVIOR FO SELECT////
$(document).ready(function() {
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

////VALIDATION NEW USER////
$('#signUpBttn').click(function(){							
var a = $("#textShowed").text(), b = $("#firstName"), c = $("#lastName"), e = $("#emailNewUser"), f = $("#repeatEmail"), g = $("#newUserPass"),
h = $("#sample-check");
if (a == '') {
//alert(e1);
$('#selectMenu').css('background-color','#fdefd0');
$("#error").text(e1);
}
else if (b.val().length < 2){
//alert('nombre nulo');
b.css('background-color','#fdefd0');
$("#error").text(e2);
}
else if (c.val().length < 2){
//alert('apellido nulo');
c.css('background-color','#fdefd0');
$("#error").text(e3);
}
else if (e.val() < 6){
//alert('email nulo');
e.css('background-color','#fdefd0');
$("#error").text(e4);
}
else if (!(e.val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i))){
//alert('email forma error');
e.css('background-color','#fdefd0');
$("#error").text(e4);
}
else if (e.val() != f.val()){
//alert('no conciden mails');
f.css('background-color','#fdefd0');
$("#error").text(e7);
}
else if(g.val() <= 4){
//alert('error cantidad letras pass');
g.css('background-color','#fdefd0');
$("#error").text(e5);
}
else if (!(h.is(':checked'))){
//alert('no acepto terminos');
$('#labTerms').css('color','#f2b431');
$("#error").text(e6);
}
else{
alert('datos pasan a validacion en servidor');
return true;
};
});

////Empty validations effects////
$(':text').blur(function(){
$(this).css('background-color','#ffffff');
$('#error').text('');
});
$('#labTermUse').click(function(){
$('#labTerms').css('color','#979696');	
$('#error').text('');
});

////SHOW CAPTCHA IF ALL FIELDS ARE COMPLETES////
$(document).keyup(function() {
$("#textShowed").text();
var a = $("#firstName"), b = $("#lastName"), c = $("#emailNewUser"), e = $("#repeatEmail"), f = $("#newUserPass");
$("#sample-check");
return a.val().length < 2 ? !1 : b.val().length < 2 ? !1 : c.val().length < 5 ? !1 : c.val().match(/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i) ? c.val() != e.val() ? !1 : f.val() <= 4 ? !1 : ($("#captcha").show(), $('#captcha').mousemove(function() {
$("#recaptcha_response_field").focus()
}), !0) : !1
});

////FRIENDLY REGISTER FORMS////
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
});//END doc.ready2







/////////////////////////////////////////////////////////////////////
//////////hide me - hides elements by id/////////////////
function hide_me(val){

$("#"+val).hide('fast');

}


//////////unhide me - unhides elements by id/////////////////
function unhide_me(val){

$("#"+val).show('fast');

}	

			
/*Made by Rodrigo Berlochi-Martin Cantero-Sebastian Volta for Axyoma/Jaque. 2011, Argentine*/



			

