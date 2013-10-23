<div id="persDistinctions"><h4 id="dist"><?php print $_IDIOMA->traducir("PERSONAL DISTINCTIONS"); ?><em></em><em class="plus open close"></em></h4>
    <div class="innerContent margLeftCenter dist">
    

<?php 
if(isset($_SESSION["bEditPlayer"]) && $_SESSION["bEditPlayer"]==true){#Represent Player
								   
	if(isset($_SESSION["iIdPlayer"]) && isset($_SESSION["iPerfilPlayer"]) ){															 
			$idUserVisiting	= $_SESSION["iIdPlayer"];
			$iUserProfileId = $_SESSION["iPerfilPlayer"];
	}
			
}else{#logic original

	if(!isset($_SESSION['idUserVisiting'])){
		$idUserVisiting =$_SESSION["iSMuIdKey"];
	}
	
	if(!isset($_SESSION['idProfileVisiting'])){;
		$iUserProfileId=$_SESSION['iSMuProfTypeKey'];
	}else{
		$iUserProfileId=$_SESSION['idProfileVisiting'];
	}
}



$iUserIdSM=$_SESSION["iSMuIdKey"];
$date='';

?>

            <table class="Tbl4" width="575" border="0">
			<thead>
			<tr><th width="517"><?php print $_IDIOMA->traducir("Distinction"); ?></th><th width="42"><?php print $_IDIOMA->traducir("Year"); ?></th><th class="whitecell" width="17"></th></tr>
<!-- <th width="100">Season</th>-->
			</thead>
			<tbody>

<?php
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB	=new mysql;
$oDB->connect();
$table	=selectTable($iUserProfileId);
$anexo	='PersonalDistinction';
$tableProfile=$table.$anexo;

$sql	="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting AND hidden = 'Visible'";
$sql2	=$oDB->query($sql) or die(mysql_error());

while ($row = mysql_fetch_array($sql2)) {

	echo '<tr class="greenTr"><td>';
	echo $row['distinction'];
	echo '</td>';
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
