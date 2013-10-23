<div id="persDistinctions"><h4 id="dist"><?php print $_IDIOMA->traducir("PERSONAL DISTINCTIONS"); ?><em></em><em class="plus open close"></em></h4>
    <div class="innerContent margLeftCenter dist">
    

<?php 
if(!isset($_SESSION['idUserVisiting'])){
//echo "no seteado!";
	$idUserVisiting =$_SESSION["iSMuIdKey"];
//echo "seteado ahora como :".$idUserVisiting ;
}
//$iUserIdSM=67;
$iUserIdSM=$_SESSION["iSMuIdKey"];
//$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
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

?>

            <table class="Tbl4" width="575" border="0">
			<thead>
			<tr><th width="517"><?php print $_IDIOMA->traducir("Distinction"); ?></th><th width="42"><?php print $_IDIOMA->traducir("Year"); ?></th><th class="whitecell" width="17"></th></tr>
<!-- <th width="100">Season</th>-->
			</thead>
			<tbody>

<?php
//echo "Visiting: ".$_SESSION['idUserVisiting']."<br />";
//echo "Session : ".$_SESSION['iSMuIdKey']."<br />";

//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();
	$table=selectTable($iUserProfileId);
	$anexo='PersonalDistinction';
	$tableProfile=$table.$anexo;
	
//mysql_connect("localhost","root","");
//mysql_select_db("soccermash_test2");


$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting AND hidden = 'Visible'";



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
<br /><strong><?php print $_IDIOMA->traducir("Last Update "); ?></strong> <?php echo date("d/m/Y",strtotime($date)); ?><br /><br />


</div><!--END innerCont..-->
<hr /></div>
