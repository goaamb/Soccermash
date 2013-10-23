
<script>
</script>
<?php // require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>

<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
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
?>
<script>

var $iUserIdSM=<?php echo $iUserIdSM; ?>;
var $iUserProfileId=<?php echo $iUserProfileId; ?>;
//alert($iUserIdSM);
//alert($iUserProfileId);


/////////////////////////////LA RE PUTA MADRE DE ESTE CODIGO CHOTO!////////////////////////	



		/////////////////////////////LA RE PUTA MADRE DE ESTE CODIGO CHOTO!////////////////////////			



$(document).ready(function(){

$("#saveCareera").click(function(){


	})
	
})
//fuera


/////////////////////////////LA RE PUTA MADRE DE ESTE CODIGO CHOTO!////////////////////////	














		/////////////////////////////LA RE PUTA MADRE DE ESTE CODIGO CHOTO!////////////////////////			




function pasaV(val1,val2){
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}



</script>

</head>


<body>



<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php");
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php");

	$table=selectTable($agtime);
	$anexo='Career';
	$tableProfile=$table.$anexo;

//require_once("../gestion/lib/share/clases/search/buscador.php");


$oDB=new mysql;
$oDB->connect();


//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test");
//$sql="SELECT * FROM $tableProfile WHERE idPlayer=$iUserIdSM ORDER BY ID DESC";

echo "<h1>Player Career</h1><br />";
echo '<table border="1"  style="text-align:center" width="100%">
<tr>
<td width="2%" >Category
</td>
<td width="20%">Club
</td>
<td width="20%">Other Club
</td>
<td width="2%">Matches
</td>
<td width="2%">Titular
</td>
<td width="2%">Goals
</td>
<td width="2%">Goals Passes
</td>
<td width="2%">Yellow Cards
</td>
<td width="2%">Red Cards
</td>
<td width="9%">Season
</td>
';
//<td width="9%">hidden</td>
echo '<td>
</td>
</tr>
<tr>
<td><input class="insert" type="text" onkeypress="LP_data(event);" maxlength="4" id="addCategoryCareerag">
</td>						   
<td>
<div id="club_a1b1"><input id="CountryCareerAg" type="text" value="Editme" onClick="convertToFinderCareerag(\'a1b1\',\'club\',this, \''.$agdate.'\', \''.$agtime.'\');" class="insert" ></div></td>
<td><input class="insert" type="text" id="addOtherClubCareerag">
</td>
<td><input class="insert" type="text" onkeypress="LP_data(event);" maxlength="4" id="addMatchesCareerag">
</td>
<td><input class="insert" type="text" onkeypress="LP_data(event);" maxlength="4" id="addTitularCareerag">
</td>
<td><input class="insert" type="text" onkeypress="LP_data(event);" maxlength="4" id="addGoalsCareerag">
</td>
<td><input class="insert" type="text" onkeypress="LP_data(event);" maxlength="4" id="addAssistsCareerag">
</td>
<td><input class="insert" type="text" onkeypress="LP_data(event);" maxlength="4" id="addYellowCardsCareerag">
</td>
<td><input class="insert" type="text" onkeypress="LP_data(event);" maxlength="4" id="addRedCardsCareerag">
</td>';
//<select id="addSeasonCareerag">
//<option value="Opening">Opening</option>
//<option value="Closing">Closing</option>
//</select>

echo '<td><input type="text" class="insert" onkeypress="LP_data(event);" maxlength="4" id="addYearOfSeasonCareerag">
</td>';

//<td><select id="addHiddenCareerag">
//<option value="Hidden">Hidden</option>
//<option value="Visible">Visible</option>
//</select></td>

echo '<td><img src="img/insert.png" onClick="javascript:saveAllCareerag(agdate,agtime);" />
</td>
</tr>';

$asd=$oDB->query("SELECT * FROM $tableProfile WHERE idPlayer=$agdate ORDER BY ID DESC");


while ($row = mysql_fetch_array($asd)) {

		echo '<tr><td><div id='.$row['id'].' >';
		//echo "CATEGORY: <a href='#'  id='editCategory'>".$row['category']. " </a>  Title: ".$row['title']. " COUNTRY ". $row['country']. " YEAR OF ".$row['yearOf']. " CLUB OR ASOCIATION ".$row['clubOrAsociation']. " HIDDEN ".$row['hidden']. "</a> <br />";
		//////////////////CATEGORY//////////////////
		echo '<div id="category_'.$row['id'].'" ><a href="javascript:void(0);" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'category\',this, \''.$agdate.'\', \''.$agtime.'\');">';
		echo $row['category']."</a> ".utf8_encode("º");
		echo '</div></td>';
		
		//////////////////ClubOrAsociation//////////////////
		
		
		
		
		$sql5="SELECT * FROM ax_club WHERE id=".$row['clubOrAsociation']."";
		$sql6=mysql_query($sql5) or die(mysql_error());
		$row3=mysql_fetch_array($sql6);
		$club=$row3['name'];
		
		
		echo '<td><div id="clubOrAsociation_'.$row['id'].'"><a  href="javascript:void(0);" onClick="convertToClubInputCareerag(\''.$row['id'].'\',\'clubOrAsociation\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo (($club=='')? '...' : $club) .'</a></div></td>';
		//echo ($row['clubOrAsociation']==0) ? $row4['otherClub']  : $row4['name'];
		//echo $club.'</a></div></td>';
		
		
		//////////////////otherClub//////////////////
		echo '<td><div id="otherClub_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputCareerag(\''.$row['id'].'\',\'otherClub\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo ($row['otherClub']==NULL) ?  '...' : $row['otherClub'];
		echo '</a></div></td>';
	
		////////////////////echo ($row['country']==NULL) ? '...' : $row['country'];//////////////////

		echo '<td><div id="matches_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'matches\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo $row['matches'];
		echo '</a></div></td>';
				
		
		//////////////////titular //////////////////
		echo '<td><div id="titular_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'titular\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo $row['titular'];
		echo '</a></div></td>';
		//////////////////goals//////////////////
		
		echo '<td><div id="goals_'.$row['id'].'"><a  href="javascript:void(0);" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'goals\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo $row['goals'];
		echo '</a></div></td>';
		
		//////////////////assists //////////////////
		echo '<td><div id="assists_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'assists\',this, \''.$agdate.'\', \''.$agtime.'\')">';
		echo $row['assists'];
		echo '</a></div></td>';
		
		//////////////////yellowCards  //////////////////
		echo '<td><div id="yellowCards_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'yellowCards\',this, \''.$agdate.'\', \''.$agtime.'\')">';
		echo $row['yellowCards'];
		echo '</a></div></td>';
		
		//////////////////redCards   //////////////////
		echo '<td><div id="redCards_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'redCards\',this, \''.$agdate.'\', \''.$agtime.'\')">';
		echo $row['redCards'];
		echo '</a></div></td>';
		
		//////////////////season  //////////////////
//		echo '<td><div id="season_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToSelectSeasonCareerag(\''.$row['id'].'\',\'season\',this, \''.$agdate.'\', \''.$agtime.'\')">';
	//	echo $row['season'];
		//echo '</a></div>';
		
		//////////////////year  //////////////////
		echo '<td><div id="year_'.$row['id'].'" ><a  href="javascript:void(0);" maxlenght="4" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'year\',this, \''.$agdate.'\', \''.$agtime.'\')">';
		echo $row['year'];
		echo '</a></div></td>';
		
		//////////////////hidden  //////////////////
		//echo '<td><div id="hidden_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToSelectHiddenCareerag(\''.$row['id'].'\',\'hidden\',this, \''.$agdate.'\', \''.$agtime.'\')">';
		//echo $row['hidden'];
		//echo '</a></div></td>';
		
		//////////////////DeleteAg//////////////////
		echo '<td><div><img src="img/cancel.png" onClick="deleteCareerag(\''.$row['id'].'\', \''.$agdate.'\', \''.$agtime.'\')" /></div></div></td></tr>';
		//echo '<td><div><a href="javascript:void(0);" onClick="deleteCareerag(\''.$row['id'].'\')">Eliminar?</a></div></div></td></tr>';

if($date<$row['date']){
		$date=$row['date'];
		}
}



echo '</table>';

echo "<br />Last Update: $date";

?>

</body>
</html>