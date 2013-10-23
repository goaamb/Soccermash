<div id="observations"><h4 id="obs">NEWS<em><input type="button" class="publish" value="PUBLISH" /></em><em class="plus open close"></em></h4>
<div class="innerContent margLeftCenter obs">
    <p class="editMode txtColorLC hide">Example: Won Championships or competitions local and international.</p>
<?php
//$iUserIdSM=67;
$iUserIdSM=$_SESSION["iSMuIdKey"];
$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
$date='';


//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
$oDB=new mysql;
$oDB->connect();
	$table=selectTable($iUserProfileId);
	$anexo='New';
	$tableProfile=$table.$anexo;

?>
<script>

</script>
<?php
$exist='';

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$iUserIdSM AND hidden = 'Visible'";

echo '<table width="575" class="Tbl3" border="0"><!--la clase .onedit da background color de edicion-->
          <tr>
            <td id="obsvTxt" width="560">
';

$sql2=$oDB->query($sql) or die(mysql_error());

if (mysql_num_rows($sql2)==0)
{
	$exist='No hay datos = 0';
} else {
	$exist='Hay datos = 1';
}

if ($exist=='No hay datos = 0'){

	
	echo "Add a description clicking here on the editable mode";
	
}
else
{




while ($row = mysql_fetch_array($sql2)) {

	
							//echo "Exists: ".$exist."<br /><br />";



		echo (($row['description'])==NULL ? 'Add a description clicking here on the editable mode' : $row['description']);
		
		if($date<$row['date']){
		$date=$row['date'];
		}
}
}
echo '</td>
            <td width="14" class="obpls"></td>
          </tr>
         </table>';

echo '<br /><strong>Last Update </strong>'.$date.'<br /><br />';


?>
</div><!--END innerCont..-->
<hr /></div><!--END observations-->

</body>
</html>