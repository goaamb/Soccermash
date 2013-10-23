<script type="text/javascript">
	
CKEDITOR.replace('hnTextArea',{
	toolbar:"Basic",
	extraPlugins : 'autogrow,specialchar,undo',
	removePlugins : 'resize,about,a11yhelp'
});
	

	
	$("#editHN").click(function(){
		$("#GetInHN").hide('400');
		$("#GetOutHN").show('400');
		
		
	})

	
</script>

<script>
$('#honourHiddenAg').toggle(function(){
	$.ajax({
		url: dir+"Honour/classHonour.php",
		data: "type=editHidden&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			$("#honourHiddenAg").css('background-position','-149px -79px');
		}
	});
		
	},function(){
		$.ajax({
		url: dir+"Honour/classHonour.php",
		data: "type=editVisible&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){

			$("#honourHiddenAg").css('background-position','-165px -79px');
		}
	});
		
	});
	

	

	</script>
<iframe style="width:0;height:0;border:none;display:none;" src="" name="iframeHN" id="iframeHN"></iframe>

<?php 
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/lib/site_ini.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/gestion/modulos/home/modules/classAndres.php';

if(isset($_SESSION["bEditPlayer"]) && $_SESSION["bEditPlayer"]==true){#Represent Player
								   
	if(isset($_SESSION["iIdPlayer"]) && isset($_SESSION["iPerfilPlayer"]) ){															 
			$idUserVisiting    = $_SESSION["iIdPlayer"];
			$idProfileVisiting = $_SESSION["iPerfilPlayer"];
			$bAgentByPlayer	   = true;
	}
			
}else{#logicA ORIG
	if(!isset($_SESSION['idUserVisiting']) OR ($_SESSION['idUserVisiting']==0)){
		$idUserVisiting = $_SESSION['iSMuIdKey'];
	}else{
		$idUserVisiting = $_SESSION['idUserVisiting'];
	}
	$bAgentByPlayer	=false;
}

$agdate=$_GET['agdate'];
$agtime=$_GET['agtime'];

$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
?>
<script>

var $iUserIdSM='<?php echo (isset($iUserIdSM)?$iUserIdSM:""); ?>';
var $iUserProfileId='<?php echo (isset($iUserProfileId)?$iUserProfileId:""); ?>';

function pasaV(val1,val2){
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
}
</script>

<?php

$table			= selectTable($agtime);
$anexo 			= 'Honour';
$tableProfile 	= $table.$anexo;

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting";
$query=mysql_query($sql);
if(mysql_num_rows($query)>0){
	while($res=mysql_fetch_array($query)){
		$nw=$res['honour'];
	}
}else{
	$nw=' ';
}

if(($nw=='') or (!$nw) or (!isset($nw)) or ($nw==null) or (trim($nw)=="")){
	$nw=' ';
}

?>
<div id="GetInHN" style="display:none;">
	<div id="GetInValHN"></div><input type="button" id="editHN" value="<?php print $_IDIOMA->traducir('Edit'); ?>"  class="saveBotton ui-button ui-widget ui-state-default ui-corner-all" role="button" />
</div>
<form target="iframeHN" method="post" id="GetOutHN" action="gestion/modulos/home/modules/Honour/sNw.php">
<table width="575" class="Tbl3" border="0"><!--la clase .onedit da background color de edicion-->
			<tr>
            <td id="obsvTxt" width="560">
			<textarea class="newsTextArea" name="value" id="hnTextArea" style="width:96%"><?php echo $nw; ?></textarea> 
			<input type="hidden" value="update" name="type">
			</td>
			</tr>
</table>

<input type="submit" id="save" name="#" value="<?php print $_IDIOMA->traducir("Save")?>" class="saveBotton ui-button ui-widget ui-state-default ui-corner-all nwsButton" role="button"/>

<div id="ResForNws"></div>

</form>
