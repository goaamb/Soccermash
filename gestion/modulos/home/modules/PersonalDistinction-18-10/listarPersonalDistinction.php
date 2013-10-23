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
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");
	
	?>


<?php 
if(!isset($_SESSION['idUserVisiting']) OR ($_SESSION['idUserVisiting']==0)){

//echo "<br />Id User Visiting no esta seteado: ".$_SESSION['idUserVisiting'];

$idUserVisiting = $_SESSION['iSMuIdKey'];

//echo "<br />Ahora el valor de idUserVisiting es $idUserVisiting";

}else{

//echo "<br />Id User Visiting estaba seteado como: ".$_SESSION['idUserVisiting'];
$idUserVisiting = $_SESSION['idUserVisiting'];
//echo "<br />Ahora el valor de idUserVisiting es $idUserVisiting";

}
//$iUserIdSM=67;
//$iUserIdSM=$_SESSION["iSMuIdKey"];

$agdate=$_GET['agdate'];
$agtime=$_GET['agtime'];

//echo "agdata: ".$agdate;
//echo "<br />agtime: ".$agtime;
//echo "<br />";

$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";

$table=selectTable($agtime);
$anexo='PersonalDistinction';
$tableProfile=$table.$anexo;
?>

<script>

var $iUserIdSM='<?php echo (isset($iUserIdSM)?$iUserIdSM:""); ?>';
var $iUserProfileId='<?php echo (isset($iUserProfileId)?$iUserProfileId:""); ?>';
//alert($iUserIdSM);
//alert($iUserProfileId);

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
//$Visiting=(int)$_SESSION['idUserVisiting'];
//$Session=(int)$_SESSION["iSMuIdKey"];

//echo "Visiting: ".$Visiting."<br />";
//echo "Session: ".$Session."<br />";
if (!isset($_SESSION['idUserVisiting'])){
	$idUserVisiting = $_SESSION ['iSMuIdKey'];
	$idProfileVisiting = $_SESSION['iSMuProfTypeKey'];
}else{
	$idUserVisiting = $_SESSION ['idUserVisiting'];
	$idProfileVisiting = $_SESSION ['iSMuProfTypeKey'];
}



//require_once("../gestion/lib/share/clases/search/buscador.php");

$oDB=new mysql;
$oDB->connect();
//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");

//$sql="SELECT * FROM $tableProfile WHERE idPlayer=$agdate ORDER BY ID DESC";
$date='';
//var_dump($sql);
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
<?php /*}else{
print $_IDIOMA->traducir("You can not edit this profile, only can edit your own profile");
}*/
?>