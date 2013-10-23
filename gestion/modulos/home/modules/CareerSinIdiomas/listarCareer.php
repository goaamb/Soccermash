<script>
$('#careerHiddenAg').toggle(function(){
	$.ajax({
		url: dir+"Career/classCareer.php",
		data: "type=editHidden&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){
			$("#careerHiddenAg").css('background-position','-149px -79px');
		}
	});
		
	},function(){
		$.ajax({
		url: dir+"Career/classCareer.php",
		data: "type=editVisible&idUser="+agdate+"&idProfile="+agtime,
		type: 'POST',
		success: function(){

			$("#careerHiddenAg").css('background-position','-165px -79px');
		}
	});
		
	});
	</script>

<?php // require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>

<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
<?php 
if(!isset($_SESSION['idUserVisiting'])){

//echo "<br />Id User Visiting no esta seteado: ".$_SESSION['idUserVisiting'];

$idUserVisiting = $_SESSION['iSMuIdKey'];

//echo "<br />Ahora el valor de idUserVisiting es $idUserVisiting";

}else{

//echo "<br />Id User Visiting estaba seteado como: ".$_SESSION['idUserVisiting'];
$idUserVisiting = $_SESSION['idUserVisiting'];
//echo "<br />Ahora el valor de idUserVisiting es $idUserVisiting";

}




//$_SESSION["iSMuProfTypeKey"];//profile
//$_SESSION["iSMuIdKey"];//id user

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
//echo "<br />edit: ".$_SESSION['editProfile'];
?>
<script>

var $iUserIdSM=<?php echo $iUserIdSM; ?>;
var $iUserProfileId=<?php echo $iUserProfileId; ?>;

//alert($iUserIdSM);
//alert($iUserProfileId);




$(document).ready(function(){

$("#saveCareera").click(function(){


	})
	
	
	
})
//fuera



/////////////////////////////LA RE PUTA MADRE DE ESTE CODIGO CHOTO!////////////////////////	


function pasaV(val1,val2){
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}</script>

</head>


<body>



<?php



if($idUserVisiting == $_SESSION["iSMuIdKey"]){

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

$Visiting=(int)$_SESSION['idUserVisiting'];
$Session=(int)$_SESSION["iSMuIdKey"];

//echo "Visiting: ".$Visiting."<br />";
//echo "Session: ".$Session."<br />";



?>
<span class='icon iposition' id="careerHiddenAg"></span>
		      <table class="Tbl5" width="575">
			  <thead>
			<tr><th width="79">Category</th><th width="78">Club</th><th width="65">Matches</th><th width="65">Titular</th><th width="54">Goals Scored</th><th width="54">Assists</th><th width="63">Yellow <br />Cards</th><th width="61">Red <br />Cards</th><th width="37">Seasons</th><th class="whitecell" width="17"></th></tr>
</thead>
<tbody>
<tr>
<td>
<select id="addCategoryCareerag" class="insert">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
</select>
<!-- <input class="insert br" type="text" onkeypress="LP_data(event);" maxlength="4" id="addCategoryCareerag"> -->
</td>						   
<td>
<?php echo '<div id="club_a1b1"><input id="CountryCareerAg" type="text" readonly value="Editme" onClick="convertToFinderCareerag(\'a1b1\',\'club\',this, \''.$agdate.'\', \''.$agtime.'\');" class="insert br" ></div></td>'; ?>
<td><input class="insert br" type="text" onkeypress="LP_data(event);" maxlength="4" id="addMatchesCareerag">
</td>
<td><input class="insert br" type="text" onkeypress="LP_data(event);" maxlength="4" id="addTitularCareerag">
</td>
<td><input class="insert br" type="text" onkeypress="LP_data(event);" maxlength="4" id="addGoalsCareerag">
</td>
<td><input class="insert br" type="text" onkeypress="LP_data(event);" maxlength="4" id="addAssistsCareerag">
</td>
<td><input class="insert br" type="text" onkeypress="LP_data(event);" maxlength="4" id="addYellowCardsCareerag">
</td>
<td><input class="insert br" type="text" onkeypress="LP_data(event);" maxlength="4" id="addRedCardsCareerag">
</td>
<td><input class="insert br" type="text" onkeypress="LP_data(event);" maxlength="4" id="addYearOfSeasonCareerag">
</td>
<td><img src="img/insert.png" onClick="javascript:saveAllCareerag(agdate,agtime);" />
</td>
</tr>


<?php 



$asd=$oDB->query("SELECT * FROM $tableProfile WHERE idPlayer=$agdate ORDER BY ID DESC");


while ($row = mysql_fetch_array($asd)) {

		echo '<tr class="greenTr"><td><div id='.$row['id'].' >';
		//echo "CATEGORY: <a href='#'  id='editCategory'>".$row['category']. " </a>  Title: ".$row['title']. " COUNTRY ". $row['country']. " YEAR OF ".$row['yearOf']. " CLUB OR ASOCIATION ".$row['clubOrAsociation']. " HIDDEN ".$row['hidden']. "</a> <br />";
		//////////////////CATEGORY//////////////////
		echo '<div id="category_'.$row['id'].'" ><a href="javascript:void(0);" onClick="convertToInputCareerNumbersag(\''.$row['id'].'\',\'category\',this, \''.$agdate.'\', \''.$agtime.'\');">';
		echo $row['category']."</a> ".utf8_encode("º");
		echo '</div></td>';
		
		//////////////////ClubOrAsociation//////////////////
		
		
		
		
		$sql5="SELECT * FROM ax_club WHERE id=".$row['clubOrAsociation']."";
		$sql6=mysql_query($sql5) or die(mysql_error());
		$row3=mysql_fetch_array($sql6);
		$club=$row3['name'].' - '.$row3['federationName'];;
		
		
		echo '<td><div id="clubOrAsociation_'.$row['id'].'"><a  href="javascript:void(0);" onClick="convertToClubInputCareerag(\''.$row['id'].'\',\'clubOrAsociation\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo (($club=='')? '...' : $club) .'</a></div></td>';
		//echo ($row['clubOrAsociation']==0) ? $row4['otherClub']  : $row4['name'];
		//echo $club.'</a></div></td>';
		
		
		//////////////////otherClub//////////////////
		//echo '<td><div id="otherClub_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputCareerag(\''.$row['id'].'\',\'otherClub\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		//echo ($row['otherClub']==NULL) ?  '...' : $row['otherClub'];
		//echo '</a></div></td>';
	
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

?>
		</tbody>
		</table>  
<br />Last Update: <?php echo $date; ?>

<?php }else{
echo "You can not edit this profile, only can edit your own profile";
} ?>