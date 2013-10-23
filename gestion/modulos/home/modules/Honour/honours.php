<div id="honours"><h4 id="hnrs"><?php print $_IDIOMA->traducir("HONORS"); ?><em></em><em class="plus open close"></em></h4>
<div class="innerContent margLeftCenter hnrs"><!--paddRightCenter -->

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

require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

$oDB=new mysql;
$oDB->connect();


?>


<!--  -->
<table class="Tbl2 margin" width="575">
<caption><?php //print $_IDIOMA->traducir("National Championship:"); ?></caption>
<thead>
<tr><th width="200"><?php //print $_IDIOMA->traducir("Title"); ?></th><th width="182"><?php //print $_IDIOMA->traducir("Club"); ?></th><th width="139"><?php //print $_IDIOMA->traducir("Country"); ?></th><th width="38"><?php //print $_IDIOMA->traducir("Year"); ?></th><th class="whitecell" width="17"></th></tr>

</thead>
<tbody>

<?php 
$table=selectTable($iUserProfileId);
$anexo='Honour';
$tableProfile=$table.$anexo;

$sql="SELECT * FROM $tableProfile WHERE idPlayer=$idUserVisiting";
$query=mysql_query($sql);
if(mysql_num_rows($query)>0){
	while($res=mysql_fetch_array($query)){
		$nw=$res['honour'];
		$date=$res['date'];
		
	}
}else{
	$nw=' ';
}

if(($nw=='') or (!$nw) or (!isset($nw)) or ($nw==null) or (trim($nw)=="")){
	$nw=$_IDIOMA->traducir("Add a description by clicking here with editable mode enabled");
}

echo '<tr>'.str_replace("<a",'<a target="_blank"',$nw).'</tr>';

?>

</tbody>
</table>   
<br /><br />
<?php print $_IDIOMA->traducir("Last Update:").' '; ?>
<?php echo date("d/m/Y",strtotime($date)); ?>
<br /><br />
</div><!--END innerCont..-->
<hr /></div><!--END honours-->