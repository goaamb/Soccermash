<script type="text/javascript">
	CKEDITOR.replace('personalTextArea',{
		toolbar:[
			 		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList','-','Cut','Copy','Paste','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Undo','Redo', '-', 'Link', 'Unlink','-','Table','SpecialChar']
			 	],
		extraPlugins : 'autogrow,specialchar,undo',
		removePlugins : 'resize,about,a11yhelp'
	});
	

	$("#editPrs").click(function(){
		$("#GetInPD").hide('400');
		$("#GetOutPD").show('400');
	})
</script>


<script>
$('#personalDistinctionHiddenAg').toggle(function(){
	$.ajax({
		url: dir+"PersonalDistinction/classPersonalDistinction.php",
		data: "type=editHidden&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			$("#personalDistinctionHiddenAg").css('background-position','-149px -79px');
		}
	});
		
	},function(){
		$.ajax({
		url: dir+"PersonalDistinction/classPersonalDistinction.php",
		data: "type=editVisible&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){

			$("#personalDistinctionHiddenAg").css('background-position','-165px -79px');
		}
	});
		
	});
	</script>
	
<iframe style="width:0;height:0;border:none;display:none;" src="" name="iframePD" id="iframePD"></iframe>
	
<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");
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

$agdate			= $_GET['agdate'];
$agtime			= $_GET['agtime'];

$iUserProfileId	= $_SESSION["iSMuProfTypeKey"];
$table			= selectTable($agtime);
$anexo			= 'PersonalDistinction';
$tableProfile	= $table.$anexo;
?>

<script>

var $iUserIdSM		='<?php echo (isset($iUserIdSM)?$iUserIdSM:""); ?>';
var $iUserProfileId ='<?php echo (isset($iUserProfileId)?$iUserProfileId:""); ?>';


function pasaV(val1,val2){
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}
function loadingSave3(){
	G.dom.$("loadingSaveTd3").style.display="block";
	G.dom.$("GetOutPD").style.display="none";
}
</script>


<?php

$oDB=new mysql;
$oDB->connect();
$date='';

?>
	<span class="icon iposition" id="personalDistinctionHiddenAg"></span>

<div id="GetInPD" style="display:none;">
	<div id="GetInValPD"></div><input type="button" id="editPrs" value="<?php print $_IDIOMA->traducir('Edit'); ?>"  class="saveBotton ui-button ui-widget ui-state-default ui-corner-all" role="button" />
</div>
<div id="loadingSaveTd3" style="display:none;"><img src="img/carga.gif" alt="loading..."/></div>
<form target="iframePD" method="post" id="GetOutPD" action="gestion/modulos/home/modules/PersonalDistinction/sNw.php" onsubmit="loadingSave3();">

<? 
$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting";
$query=mysql_query($sql);
if(mysql_num_rows($query)>0){
	while($res=mysql_fetch_array($query)){
		$nw=$res['distinction'];
	}
}else{
	$nw=' ';
}

if(($nw=='') or (!$nw) or (!isset($nw)) or ($nw==null) or (trim($nw)=="")){
	$nw=' ';
}
?> 

			<table width="575" class="Tbl3" border="0"><!--la clase .onedit da background color de edicion-->
			<tr>
            <td id="obsvTxt2" width="560">

			<textarea class="newsTextArea" name="value" id="personalTextArea" style="width:96%"><?php echo $nw; ?></textarea> 
			<input type="hidden" value="update" name="type">
			</td>
			</tr>
</table>


 
<input type="submit" id="save" name="#" value="<?php print $_IDIOMA->traducir("Save")?>" class="saveBotton ui-button ui-widget ui-state-default ui-corner-all nwsButton" role="button"/>

<div id="ResForNws"></div>

</form> 
 

</tbody>
</table>       
