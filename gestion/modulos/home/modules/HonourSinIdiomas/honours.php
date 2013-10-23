<div id="honours"><h4 id="hnrs">HONORS<em></em><em class="plus open close"></em></h4>
<div class="innerContent margLeftCenter hnrs"><!--paddRightCenter -->

<?php
if(!isset($_SESSION['idUserVisiting'])){
//echo "no seteado!";
	$idUserVisiting =$_SESSION["iSMuIdKey"];
//echo "seteado ahora como :".$idUserVisiting ;
}

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();

if(!isset($_SESSION['idProfileVisiting'])){;
$iUserProfileId=$_SESSION['iSMuProfTypeKey'];
}else{
$iUserProfileId=$_SESSION['idProfileVisiting'];
}

$iUserIdSM=$_SESSION["iSMuIdKey"];
//$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
$date='';

//$iUserIdSM=67;
$iUserIdSM=$_SESSION["iSMuIdKey"];
//$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";


	
	$table=selectTable($iUserProfileId);
	$anexo='Honour';
	$tableProfile=$table.$anexo;


//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");



?>
<table class="Tbl" width="575" border="0">
<caption>International Championship:</caption>
<thead>
<tr><th width="200">Title</th><th width="182">Club</th><th width="139">Country</th><th width="38">Year</th><th class="whitecell" width="17"></th></tr>
</thead>
<tbody>

<?
//echo "Visiting: ".$_SESSION['idUserVisiting']."<br />";
//echo "Session : ".$_SESSION['iSMuIdKey']."<br />";


$sql="SELECT * FROM $tableProfile WHERE category='International' AND hidden='Visible' AND idPlayer=$idUserVisiting ORDER BY id DESC";




//$sql="SELECT * FROM $tableProfile WHERE category='International' AND hidden='Visible' AND idPlayer=$iUserIdSM ORDER BY id DESC";



$sql1=$oDB->query($sql) or die(mysql_error());

while ($row = mysql_fetch_array($sql1)) {

echo "<tr class='greenTr'><td>";
echo ($row['title']==NULL) ?  '...' : $row['title'];
echo "</td><td>";


if($row['clubOrAsociation']==0){
		$club=$row['otherClub'];
		}else{
		$sql5="SELECT * FROM ax_club WHERE id=".$row['clubOrAsociation']."";
		$sql6=mysql_query($sql5) or die(mysql_error());
		$row3=mysql_fetch_array($sql6);
		$club=$row3['name'];
		}
echo $club;

$sql2="SELECT * FROM ax_country WHERE Code='".$row['country']."'";
		$sql3=mysql_query($sql2) or die(mysql_error());
		$row1=mysql_fetch_array($sql3);

echo "</td><td>".$row1['country']."</td><td>";


echo ($row['yearOf']==NULL) ?  '...' : $row['yearOf'];
echo "</td><td>";


echo "</td><td class='pls apply'></td></tr>";
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
<tr><th width="200">Title</th><th width="182">Club</th><th width="139">Country</th><th width="38">Year</th><th class="whitecell" width="17"></th></tr>

</thead>
<tbody>

<?php 

//echo "Visiting: ".$_SESSION['idUserVisiting']."<br />";
//echo "Session : ".$_SESSION['iSMuIdKey']."<br />";




$sql4="SELECT * FROM $tableProfile WHERE category='National' AND hidden='Visible' AND idPlayer=$idUserVisiting ORDER BY id DESC";




$sql5=$oDB->query($sql4) or die(mysql_error());
while ($row2 = mysql_fetch_array($sql5)) {

echo "<tr class='greenTr'><td>";
echo ($row2['title']==NULL) ?  '...' : $row2['title'];
echo "</td><td>";

if($row2['clubOrAsociation']==0){
		$club=$row2['otherClub'];
		
		}else{
		
		$sql7="SELECT * FROM ax_club WHERE id=".$row2['clubOrAsociation']."";
		$sql8=mysql_query($sql7) or die(mysql_error());
		$row4=mysql_fetch_array($sql8);
		$club=$row4['name'];
		}
echo $club;

$sql6="SELECT * FROM ax_country WHERE Code='".$row2['country']."'";
		$sql7=mysql_query($sql6) or die(mysql_error());
		$row1=mysql_fetch_array($sql7);

echo "</td><td>".$row1['country']."</td><td>";
echo ($row2['yearOf']==NULL) ?  '...' : $row2['yearOf'];
echo "</td><td>";

echo "</td><td class='pls apply'></td></tr>";

if($date<$row2['date']){
		$date=$row2['date'];
		}
}


?>

</tbody>
</table>   
<br /><br />
<?php echo "Last Update: $date"; ?>
<br /><br />
</div><!--END innerCont..-->
<hr /></div><!--END honours-->