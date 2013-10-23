<div id="persDistinctions"><h4 id="dist">PERSONAL DISTINCTIONS<em><input type="button" class="publish" value="PUBLISH" /></em><em class="plus open close"></em></h4>
    <div class="innerContent margLeftCenter dist">
     <p class="editMode txtColorLC hide">Example: Won Championships or competitions local and international.</p>
<?php 
//$iUserIdSM=67;
$iUserIdSM=$_SESSION["iSMuIdKey"];
$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
$date='';

?>

<table class="Tbl4" width="575" border="0">
<thead>
<tr><th width="417">Distinction</th>
<!-- <th width="100">Season</th>-->
<th width="42">Year</th><th class="whitecell" width="17"></th></tr>
</thead>
<tbody>
<tr>



<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();
	$table=selectTable($iUserProfileId);
	$anexo='PersonalDistinction';
	$tableProfile=$table.$anexo;
	
//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");
$sql="SELECT * FROM $tableProfile WHERE idPlayer=$iUserIdSM AND hidden='Visible'";

$sql2=$oDB->query($sql) or die(mysql_error());


while ($row = mysql_fetch_array($sql2)) {


	echo '<tr class="greenTr"><td>';
	echo $row['distinction'];
	echo '</td>';
	//echo '<td>';
	//echo $row['season'];
	//echo '</td>';
	echo '<td>';
	echo $row['year'];
	echo '</td></tr>';

	if($date<$row['date']){
		$date=$row['date'];
		}
	
}
?>
</tbody>
</table>       
<?php	echo '<br /><strong>Last Update </strong>'.$date.'<br /><br />'; ?>
</div><!--END innerCont..-->
<hr /></div>
