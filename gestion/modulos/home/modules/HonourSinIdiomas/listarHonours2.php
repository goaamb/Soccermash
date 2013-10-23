
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
	$anexo='Honour';
	$tableProfile=$table.$anexo;

//require_once("../gestion/lib/share/clases/search/buscador.php");


$oDB=new mysql;
$oDB->connect();


?>
<table class="Tbl" width="575" border="0">
<caption>International Championship:</caption>
<thead>
<tr><th width="100">Category</th><th width="100">Title</th><th width="139">Club</th><th width="100">OtherClub</th><th width="38">Country</th><th width="182">Year</th><th width="15"></th><th class="whitecell" width="18"></th></tr>
<?php
//<td><div id="country_a1b2"><a  href="javascript:void(0);" id="country" onClick="convertToFinderHonourag(\'a1b2\',\'country\',this);" class="insert" value="Editme">Editme</a></div></td>
//<td><div id="country_a1b2"><a  href="javascript:void(0);" id="country" onClick="convertToFinderHonourag(\'a1b2\',\'country\',this);" class="insert" value="Editme">Editme</a></div></td>
echo '<tr>
<td><input class="insert" type="text" id="addCategoryag" readOnly value="International"></td>
<td><input class="insert" type="text" id="addTitleag"></td>
<td><div id="country_a1b2"><input id="CountryAg" type="text" value="Editme" onClick="convertToFinderHonourag(\'a1b2\',\'country\',this,\''.$agdate.'\', \''.$agtime.'\');" class="insert" ></div></td>
<td><input type="text" class="insert" onkeypress="LP_data(event);" maxlength="4" id="addYearOfag"></td>
<td><div id="club_a1b22"><input id="ClubAg" type="text" value="Editme" onClick="convertToFinderHonourag(\'a1b22\',\'club\',this,\''.$agdate.'\', \''.$agtime.'\');" class="insert" ></div></td>
<td><input class="insert" type="text" id="addOtherClubag"></td>';
//<td><select id="addHiddenag"><option value="Hidden">Hidden</option><option value="Visible">Visible</option></select></td>
echo '<td><img src="img/insert.png" class="saveHonour" onClick="javascript:saveAllHonourag(\'International\',agdate,agtime)" />
</td></tr>';
?>
</thead>
<tbody>
<?
$sql="SELECT * FROM $tableProfile WHERE category='International' AND idPlayer=$agdate ORDER BY ID DESC";

$sql1=$oDB->query($sql) or die(mysql_error());
while ($row = mysql_fetch_array($sql1)) {


echo '<tr class="greenTr"><td><div id='.$row['id'].' >';
echo '<div id="category_'.$row['id'].'" ><a href="javascript:void(0);" onClick="convertToSelectHonourag(\''.$row['id'].'\',\'category\',\''.$row['category'].'\', \''.$agdate.'\', \''.$agtime.'\')">';
echo $row['category'];
echo '</a></div></td>';

echo '<td><div id="title_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputHonourag(\''.$row['id'].'\',\'title\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
echo ($row['title']==NULL) ?  '...' : $row['title'];
echo '</a></div></td>';

	$sql5="SELECT * FROM ax_club WHERE id=".$row['clubOrAsociation']."";
	$sql6=mysql_query($sql5) or die(mysql_error());
	$row3=mysql_fetch_array($sql6);
	$club=$row3['name'];


echo '<td><div id="clubOrAsociation_'.$row['id'].'"><a  href="javascript:void(0);" onClick="convertToClubInputHonourag(\''.$row['id'].'\',\'clubOrAsociation\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo (($club=='')? '...' : $club) .'</a></div></td>';


		
echo '<td><div id="otherClub_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputHonourag(\''.$row['id'].'\',\'otherClub\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
echo ($row['otherClub']==NULL) ?  '...' : $row['otherClub'];
echo '</a></div></td>';

$sql2="SELECT * FROM ax_country WHERE Code='".$row['country']."'";
		$sql3=mysql_query($sql2) or die(mysql_error());
		$row1=mysql_fetch_array($sql3);
		
echo '<td><div id="country_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToFinderHonourag(\''.$row['id'].'\',\'country\',this, \''.$agdate.'\', \''.$agtime.'\');" >'.$row1['country'].'</a>';
echo '</div></td>';

echo '<td><div id="yearOf_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputYearHonourag(\''.$row['id'].'\',\'yearOf\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
echo ($row['yearOf']==NULL) ?  '...' : $row['yearOf'];
echo '</a></div></td>';

//echo '<td><div id="hidden_'.$row['id'].'" ><a  href="javascript:void(0);" onClick="convertToSelectHiddenHonourag(\''.$row['id'].'\',\'hidden\',this, \''.$agdate.'\', \''.$agtime.'\')">';
//echo $row['hidden'];
//echo '</a></div></td>';

echo '<td><div><img src="img/cancel.png" onClick="deleteHonourag(\''.$row['id'].'\', \''.$agdate.'\', \''.$agtime.'\')" /></div></div></td></tr>';


if($date<$row['date']){
		$date=$row['date'];
		}
}
?>
</tbody>
</table>

<!--  -->
<table class="Tbl2 margin" width="575">
<caption>National Championship:</caption>
<thead>
<tr><th width="100">Category</th><th width="100">Title</th><th width="139">Club</th><th width="100">OtherClub</th><th width="38">Country</th><th width="182">Year</th><th width="15"></th><th class="whitecell" width="18"></th></tr>

<?php
echo '<tr><td><input class="insert" type="text" id="addNationalCategoryag" readOnly value="National"></td>
<td><input class="insert" type="text" id="addNationalTitleag"></td>
<td><div id="country_a1b3"><input id="CountryNationalAg" type="text" value="Editme" onClick="convertToFinderHonourag(\'a1b3\',\'country\',this,\''.$agdate.'\', \''.$agtime.'\');" class="insert" ></div></td>
<td><input class="insert" type="text" onkeypress="LP_data(event);" maxlength="4" id="addNationalYearOfag"></td>
<td><div id="club_a1b33"><input id="ClubNationalAg" type="text" value="Editme" onClick="convertToFinderHonourag(\'a1b33\',\'club\',this,\''.$agdate.'\', \''.$agtime.'\');" class="insert" ></div></td>
<td><input class="insert" type="text" id="addNationalOtherClubag"></td>
';
//<td><select id="addNationalHiddenag"><option value="Hidden">Hidden</option><option value="Visible">Visible</option></select></td>
echo '
<td><img src="img/insert.png" onClick="javascript:saveAllHonourag(\'National\',agdate,agtime)" />
</td></tr>';
?>
</thead>
<tbody>

<?php 


$sql4="SELECT * FROM $tableProfile WHERE category='National' AND idPlayer=$agdate ORDER BY id DESC";
$sql5=$oDB->query($sql4) or die(mysql_error());
while ($row3 = mysql_fetch_array($sql5)) {

echo '<tr class="greenTr"><td><div id='.$row3['id'].' >';
echo '<div id="category_'.$row3['id'].'" ><a href="javascript:void(0);" onClick="convertToSelectHonourag(\''.$row3['id'].'\',\'category\',\''.$row3['category'].'\', \''.$agdate.'\', \''.$agtime.'\')">';
echo $row3['category'];
echo '</a></div></td>';

	
echo '<td><div id="title_'.$row3['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputHonourag(\''.$row3['id'].'\',\'title\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
echo ($row3['title']==NULL) ?  '...' : $row3['title'];
echo '</a></div></td>';


		

		$sql7="SELECT * FROM ax_club WHERE id=".$row3['clubOrAsociation']."";
		$sql8=mysql_query($sql7) or die(mysql_error());
		$row4=mysql_fetch_array($sql8);
		$club2=$row4['name'];
		
		
echo '<td><div id="clubOrAsociation_'.$row3['id'].'"><a  href="javascript:void(0);" onClick="convertToClubInputHonourag(\''.$row3['id'].'\',\'clubOrAsociation\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo (($club2=='')? '...' : $club2) .'</a></div></td>';
		
echo '<td><div id="otherClub_'.$row3['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputHonourag(\''.$row3['id'].'\',\'otherClub\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
echo ($row3['otherClub']==NULL) ?  '...' : $row3['otherClub'];
echo '</a></div></td>';
		

	$sql6="SELECT * FROM ax_country WHERE Code='".$row3['country']."'";
		$sql7=mysql_query($sql6) or die(mysql_error());
		$row1=mysql_fetch_array($sql7);
		
echo '<td><div id="country_'.$row3['id'].'" ><a  href="javascript:void(0);" onClick="convertToFinderHonourag(\''.$row3['id'].'\',\'country\',this, \''.$agdate.'\', \''.$agtime.'\');" >'.$row1['country'].'</a>';
echo '</div></td>';



echo '<td><div id="yearOf_'.$row3['id'].'" ><a  href="javascript:void(0);" onClick="convertToInputYearHonourag(\''.$row3['id'].'\',\'yearOf\',this, \''.$agdate.'\', \''.$agtime.'\');" >';
		echo ($row3['yearOf']==NULL) ?  '...' : $row3['yearOf'];
		echo '</a></div></td>';

		
//echo '<td><div id="hidden_'.$row3['id'].'" ><a  href="javascript:void(0);" onClick="convertToSelectHiddenHonourag(\''.$row3['id'].'\',\'hidden\',this, \''.$agdate.'\', \''.$agtime.'\')">';
//echo $row3['hidden'];
//echo '</a></div></td>';

echo '<td><div><img src="img/cancel.png" onClick="deleteHonourag(\''.$row3['id'].'\', \''.$agdate.'\', \''.$agtime.'\')" /></div></div></td></tr>';

if($date<$row3['date']){
		$date=$row3['date'];
		}
}


echo '</table>';

echo "<br />Last Update: $date";
?>