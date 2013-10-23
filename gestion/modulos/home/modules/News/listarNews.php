<script type="text/javascript">
	/*tinyMCE.init({
		forced_root_block : false,
		force_br_newlines : true,
		force_p_newlines : false,

		mode : "specific_textareas",
        editor_selector : "newsTextArea",
		theme : "advanced",
		//plugins : "autoresize",
		theme_advanced_fonts : "Verdana=verdana",
        theme_advanced_font_sizes : '11pt',
		theme_advanced_text_colors : "999999",
		//theme_advanced_buttons1 : "bold,italic,underline",
		theme_advanced_buttons1 : "",
		theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
	});*/
CKEDITOR.replace('newsTextArea',{
	toolbar:[
		 		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList','-','Cut','Copy','Paste','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Undo','Redo', '-', 'Link', 'Unlink','-','Table','SpecialChar']
		 	],
	extraPlugins : 'autogrow,specialchar,undo',
	removePlugins : 'resize,about,a11yhelp'
});
	
	//$(".nwsButton").click(function(){
		//alert($("#mce_2_tbl").val());
		//$("#GetInVal").html($("#mce_2_tbl").val());
		//$("#GetOut").hide('400');
		//$("#GetIn").show('400');
	//})
	
	$("#editNws").click(function(){
		$("#GetIn").hide('400');
		$("#GetOut").show('400');
		
		
	})

	
</script>

<script>
G.util.ready(function(){
$('#home *').tipsy({gravity: 'n'});
(function(a){a.fn.autoResize=function(j){var b=a.extend({onResize:function(){},animate:true,animateDuration:150,animateCallback:function(){},extraSpace:20,limit:1000},j);this.filter('textarea').each(function(){var c=a(this).css({resize:'none','overflow-y':'hidden'}),k=c.height(),f=(function(){var l=['height','width','lineHeight','textDecoration','letterSpacing'],h={};a.each(l,function(d,e){h[e]=c.css(e)});return c.clone().removeAttr('id').removeAttr('name').css({position:'absolute',top:0,left:-9999}).css(h).attr('tabIndex','-1').insertBefore(c)})(),i=null,g=function(){f.height(0).val(a(this).val()).scrollTop(10000);var d=Math.max(f.scrollTop(),k)+b.extraSpace,e=a(this).add(f);if(i===d){return}i=d;if(d>=b.limit){a(this).css('overflow-y','');return}b.onResize.call(this);b.animate&&c.css('display')==='block'?e.stop().animate({height:d},b.animateDuration,b.animateCallback):e.height(d)};c.unbind('.dynSiz').bind('keyup.dynSiz',g).bind('keydown.dynSiz',g).bind('change.dynSiz',g);});return this;};})(jQuery);
$('.newsTextArea').autoResize();
});

function loadingSave1(){
	G.dom.$("loadingSaveTd1").style.display="block";
	G.dom.$("GetOut").style.display="none";
	location.href="#nws";
}
</script>

<iframe style="width:0;height:0;border:none;display:none;" src="" name="iframeNws" id="iframeNws"></iframe>
<?php

	

require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/lib/site_ini.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/modulos/home/modules/classAndres.php';
$date = date ('d/m/Y');
/*
if (!isset($_SESSION['idUserVisiting'])){
	$idUserVisiting = $_SESSION ['iSMuIdKey'];
	$idProfileVisiting = $_SESSION['iSMuProfTypeKey'];
}else{
	$idUserVisiting = $_SESSION ['idUserVisiting'];
	$idProfileVisiting = $_SESSION ['iSMuProfTypeKey'];
}
*/
if(isset($_SESSION["bEditPlayer"])&& $_SESSION["bEditPlayer"]==true){#si la edicion del perfil q se kiere guardar 
																		 #es la de player x su representante
	if(isset($_SESSION["iIdPlayer"]) && isset($_SESSION["iPerfilPlayer"])){															 
			$idUserVisiting		 = $_SESSION["iIdPlayer"];
			$idProfileVisiting 	 = $_SESSION['iPerfilPlayer'];
	}
			
}else{#sigue como era la logica original

	if (!isset($_SESSION['idUserVisiting'])){
		$idUserVisiting = $_SESSION ['iSMuIdKey'];
		$idProfileVisiting = $_SESSION['iSMuProfTypeKey'];
	}else{
		$idUserVisiting = $_SESSION ['idUserVisiting'];
		$idProfileVisiting = $_SESSION ['iSMuProfTypeKey'];
	}

}


$table = selectTable ($idProfileVisiting);
$anexo = 'New';
$tableProfile = $table.$anexo;

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting";
$query=mysql_query($sql);
if(mysql_num_rows($query)>0){
while($res=mysql_fetch_array($query)){
	$nw=str_replace("<a",'<a target="_blank"',$res['description']);
}
}else{
	$nw=' ';
}

if(($nw=='') or (!$nw) or (!isset($nw)) or ($nw==null) or (trim($nw)=="")){
	$nw=' ';
}

?>
<div id="GetIn" style="display:none;">
	<div id="GetInVal"><?php echo $nw; ?></div><input type="button" id="editNws" value="<?php print $_IDIOMA->traducir('Edit'); ?>"  class="saveBotton ui-button ui-widget ui-state-default ui-corner-all" role="button" />
</div>
<div id="loadingSaveTd1" style="display:none;"><img src="img/carga.gif" alt="loading..."/></div>
<form target="iframeNws" method="post" id="GetOut" action="gestion/modulos/home/modules/News/sNw.php" onsubmit="loadingSave1();">
<table width="575" class="Tbl3" border="0"><!--la clase .onedit da background color de edicion-->
			<tr>
            <td id="obsvTxt" width="560">
			<textarea class="newsTextArea" name="value" id="newsTextArea" style="width:96%"><?php echo $nw; ?></textarea> 
			<input type="hidden" value="update" name="type">
			</td>
			</tr>
</table>

<input type="submit" id="save" name="#" value="<?php print $_IDIOMA->traducir("Save")?>" class="saveBotton ui-button ui-widget ui-state-default ui-corner-all nwsButton" role="button"/>

<div id="ResForNws"></div>

</form>
<?php
if(!isset($_SESSION["editProfile"]) || (isset($_SESSION["editProfile"]) && !$_SESSION["editProfile"])){
	?><script language="javascript">
	$("#GetIn").show();
	$("#GetOut").hide();
	</script><?php
}
?>
