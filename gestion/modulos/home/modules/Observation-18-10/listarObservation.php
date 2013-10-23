<script type="text/javascript">
	/*tinyMCE.init({
		forced_root_block : false,
		force_br_newlines : true,
		force_p_newlines : false,
		
		mode : "specific_textareas",
        editor_selector : "obsTextArea",
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
	
CKEDITOR.replace('obsTextArea',{
	toolbar:[
		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList','-','Cut','Copy','Paste','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Undo','Redo', '-', 'Link', 'Unlink','-','Table','SpecialChar']
	],
	extraPlugins : 'autogrow',
	removePlugins : 'resize,about',
	width:'545'
	//readOnly:'true'
});
	
	
	

	
	
	$("#editObs").click(function(){
		$("#GetIn2").hide('400');
		$("#GetOut2").show('400');
		
		
	})
function loadingSave2(){
	G.dom.$("loadingSaveTd2").style.display="block";
	G.dom.$("GetOut2").style.display="none";
	location.href="#observations";
}	
	
</script>
<iframe style="width:0;height:0;border:none;display:none;" src="" name="iframeObs" id="iframeObs"></iframe>
<?php
	

require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/lib/site_ini.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/modulos/home/modules/classAndres.php';
$date = date ('d/m/Y');

if (!isset($_SESSION['idUserVisiting'])){
	$idUserVisiting = $_SESSION ['iSMuIdKey'];
	$idProfileVisiting = $_SESSION['iSMuProfTypeKey'];
}else{
	$idUserVisiting = $_SESSION ['idUserVisiting'];
	$idProfileVisiting = $_SESSION ['iSMuProfTypeKey'];
}



$table = selectTable ($idProfileVisiting);
$anexo = 'Observation';
$tableProfile = $table.$anexo;

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting";
$query=mysql_query($sql);
if(mysql_num_rows($query)>0){
	while($res=mysql_fetch_array($query)){
		$cv=str_replace("<a",'<a target="_blank"',$res['observation']);
	}
}else{
	$cv=' ';
}



?>
<div id="GetIn2" style="display:none;">
	<div id="GetInVal2"><?php echo $cv; ?></div><input type="button" id="editObs" value="<?php print $_IDIOMA->traducir('Edit'); ?>"  class="saveBotton ui-button ui-widget ui-state-default ui-corner-all" role="button" />
</div>
<div id="loadingSaveTd2" style="display:none;"><img src="img/carga.gif" alt="loading..."/></div>
<form target="iframeObs" method="post" id="GetOut2" action="gestion/modulos/home/modules/Observation/sOb.php" onsubmit="loadingSave2();">
<!-- <span class="icon iposition" id="observationHiddenAg"></span> -->
<table width="575" class="Tbl3" border="0">
	<!--la clase .onedit da background color de edicion-->
	<tr>
		<td id="obsvTxt" width="560">
		<textarea name="value" class="obsTextArea" id="obsTextArea" style="width:96%"><?php echo $cv; ?></textarea> 
		<input type="hidden" value="update" name="type">
		</td>
	</tr>
</table>
<input type="submit" id="save" name="#" value="<?php print $_IDIOMA->traducir("Save")?>" class="saveBotton ui-button ui-widget ui-state-default ui-corner-all obsButton" role="button"/>
<div id="ResForObs"></div>
</form>
<?php
if(!isset($_SESSION["editProfile"]) || (isset($_SESSION["editProfile"]) && !$_SESSION["editProfile"])){
	?><script language="javascript">
	$("#GetIn2").show();
	$("#GetOut2").hide();
	</script><?php
}
?>