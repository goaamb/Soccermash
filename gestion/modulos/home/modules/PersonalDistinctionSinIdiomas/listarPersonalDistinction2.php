<script>
</script>
<?php 
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php");

	
	?>

<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
<script type="text/javascript" src="../js/jquery.js" ></script>



<?php 
//$iUserIdSM=67;
$iUserIdSM=$_SESSION["iSMuIdKey"];

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

var $iUserIdSM=<?php echo $iUserIdSM; ?>;
var $iUserProfileId=<?php echo $iUserProfileId; ?>;
//alert($iUserIdSM);
//alert($iUserProfileId);

function pasaV(val1,val2){
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}
</script>
</head>
<body>



<?php



//require_once("../gestion/lib/share/clases/search/buscador.php");

$oDB=new mysql;
$oDB->connect();
//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$agdate ORDER BY ID DESC";

//var_dump($sql);
echo '<table border="1"  style="text-align:center">
<tr><td width="150" >Distinction</td><td width="150" >Year</td><td></td></tr>';
/*<td width="150" >Season
</td>
<td width="150">Hidden
</td>*/
echo '<td><input class="insert" type="text" id="addDistinctionag"></td>
	  <td><input class="insert" maxlength="4" onKeyPress="LP_data(event);" type="text" id="addYearag"></td>
	  <td><img src="img/insert.png" onClick="javascript:saveAllPersonalDistinctionag(agdate,agtime)" /></td>
';
/*<select  id="addSeasonag">
<option value="Opening">Opening</option>
<option value="Closing">Closing</option>
</select></td>
<td><select id="addHiddenPersonalDistinctionag">
<option value="Hidden">Hidden</option>
<option value="Visible">Visible</option>
</select></td>*/


$sql2=$oDB->query($sql);
while ($row = mysql_fetch_array($sql2)) {

		echo '<tr><td><div id='.$row['id'].' >';
		//echo "CATEGORY: <a href='#'  id='editCategory'>".$row['category']. " </a>  Title: ".$row['title']. " COUNTRY ". $row['country']. " YEAR OF ".$row['yearOf']. " CLUB OR ASOCIATION ".$row['clubOrAsociation']. " HIDDEN ".$row['hidden']. "</a> <br />";
		//////////////////CATEGORY//////////////////
		echo '<div id="distinction_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputPersonalDistinctionag(\''.$row['id'].'\',\'distinction\',this, \''.$agdate.'\', \''.$agtime.'\')">';
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

	echo '</table>';

echo "<br />Last Update: $date";

?>

</body>
</html>