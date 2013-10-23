<div id="newsmodule"><h4 id="nws"><?php print $_IDIOMA->traducir("NEWS");?><em></em><em class="plus open close"></em></h4>
<div class="innerContent margLeftCenter nws">
    
<?php

if(!isset($_SESSION['idUserVisiting'])){
$VisitingId=(int)$_SESSION['iSMuIdKey'];
}else{
$VisitingId=(int)$_SESSION['idUserVisiting'];
}

$MyID=(int)$_SESSION['iSMuIdKey'];
if(($MyID==$VisitingId) or ($VisitingId==0)){
$canEdit=true;
}else{
$canEdit=false;
}

if(!isset($_SESSION['idUserVisiting'])){
//echo "no seteado!";
	$idUserVisiting =$_SESSION["iSMuIdKey"];
//echo "seteado ahora como :".$idUserVisiting ;
}
//$iUserIdSM=67;

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
//echo "Visiting: ".$_SESSION['idUserVisiting']."<br />";
//echo "Session : ".$_SESSION['iSMuIdKey']."<br />";
$exist='';

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting AND hidden = 'Visible'";





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

	
	echo $_IDIOMA->traducir("Add a description by clicking here with editable mode enabled");
	
}
else
{




while ($row = mysql_fetch_array($sql2)) {

	
							//echo "Exists: ".$exist."<br /><br />";



		echo (($row['description'])==NULL ? 'Add a description by clicking here with editable mode enabled' : str_replace("<a",'<a target="_blank"',$row['description']));
		
		if($date<$row['date']){
		$date=$row['date'];
		}
}
}
echo '</td>
            <td width="14" class="obpls"></td>
          </tr>
         </table>';

echo '<br /><strong>'.$_IDIOMA->traducir("Last Update").' </strong>'.date("d/m/Y",strtotime($date)).'<br /><br />';


?>
</div><!--END innerCont..-->
<hr /></div><!--END observations-->

</body>
</html>