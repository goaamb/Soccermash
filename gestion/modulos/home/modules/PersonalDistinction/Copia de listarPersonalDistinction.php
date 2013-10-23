
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
</script>


<?php
//$Visiting=(int)$_SESSION['idUserVisiting'];
//$Session=(int)$_SESSION["iSMuIdKey"];

//echo "Visiting: ".$Visiting."<br />";
//echo "Session: ".$Session."<br />";
if($idUserVisiting == $_SESSION["iSMuIdKey"]){



//require_once("../gestion/lib/share/clases/search/buscador.php");

$oDB=new mysql;
$oDB->connect();
//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$agdate ORDER BY ID DESC";
$date='';
//var_dump($sql);
?>
	<span class="icon iposition" id="personalDistinctionHiddenAg"></span>
			  <table class="Tbl4" width="575" border="0">
			  <thead>
              <tr><th width="517"><?php print $_IDIOMA->traducir("Distinction"); ?></th><th width="42"><?php print $_IDIOMA->traducir("Year"); ?></th><th class="whitecell" width="17"></th></tr>
              </thead>
              <tbody>
			 <tr>
			
			<td><input type="text" class="insert br" id="addDistinctionag"></td>
			<td><input maxlength="4" class="insert br" onKeyPress="LP_data(event);" type="text" id="addYearag"></td>
			<td><img src="img/insert.png" onClick="javascript:saveAllPersonalDistinctionag(agdate,agtime)" /></td></tr>




<?php
$sql2=$oDB->query($sql);
while ($row = mysql_fetch_array($sql2)) {

		//echo '<tr><td><div id='.$row['id'].' >';
		//echo "CATEGORY: <a href='#'  id='editCategory'>".$row['category']. " </a>  Title: ".$row['title']. " COUNTRY ". $row['country']. " YEAR OF ".$row['yearOf']. " CLUB OR ASOCIATION ".$row['clubOrAsociation']. " HIDDEN ".$row['hidden']. "</a> <br />";
		//////////////////CATEGORY//////////////////
		echo '<tr class="greenTr"><td><div id="distinction_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputPersonalDistinctionag(\''.$row['id'].'\',\'distinction\',this, \''.$agdate.'\', \''.$agtime.'\')">';
		echo (($row['distinction'])==NULL ? 'Add an observation clicking here' : $row['distinction']);
		echo '</a></div></td>';

		//////////////////Season//////////////////																								 
		//echo '<td width="150"><div id="season_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToSelectSeasonPersonalDistinctionag(\''.$row['id'].'\',\'season\',\''.$row['season'].'\', \''.$agdate.'\', \''.$agtime.'\')">';
		//echo $row['season'];
	//	echo '</a></div></td>';
		
		//////////////////Year//////////////////
		echo '<td width="150"><div id="year_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputYearPersonalDistinctionag(\''.$row['id'].'\',\'year\',this, \''.$agdate.'\', \''.$agtime.'\')">';
		echo $row['year'];
		echo '</a></div></td>';
		
		
		//////////////////Hidden//////////////////
	//	echo '<td width="150"><div id="hidden_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToSelectHiddenPersonalDistinctionag(\''.$row['id'].'\',\'hidden\',\''.$row['hidden'].'\', \''.$agdate.'\', \''.$agtime.'\')">';
	//	echo $row['hidden'];
	//	echo '</a></div></td>';
		

		//////////////////DeleteAg//////////////////
		echo '<td width="150"><div><img src="img/cancel.png" onClick="deletePersonalDistinctionag(\''.$row['id'].'\',\''.$agdate.'\', \''.$agtime.'\')" /></div></div></td></tr>';

if($date<$row['date']){
		$date=$row['date'];
		}
}
?>
</tbody>
</table>       
<?php }else{
print $_IDIOMA->traducir("You can not edit this profile, only can edit your own profile");
}
?>