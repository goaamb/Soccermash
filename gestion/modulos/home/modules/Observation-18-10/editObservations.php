<?php require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>
<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
<script>

function pasaV(val1,val2){
alert("Pasando valor en editObservation");
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}

</script>
<div id="observations"><h4 id="obs"><?php 
if(!isset($_SESSION['idProfileVisiting'])){;
	$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}else{
	$profileVisiting=$_SESSION['idProfileVisiting'];
}
if(isset($profileVisiting) && ($profileVisiting>=25 && $profileVisiting<=27)){
	print $_IDIOMA->traducir("INFORMATION");
}
else{
	print $_IDIOMA->traducir("CURRICULUM VITAE");
}

?><em></em><em class="plus open close"></em></h4>
    <div class="innerContent margLeftCenter obs">
	<p class="editMode txtColorLC hide"><?php print $_IDIOMA->traducir("Example: Won Championships or competitions local and international."); ?></p>
<div id="resultObservation"></div>
<?php require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>

<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->

<?php 
//$iUserIdSM=67;
$iUserIdSM=$_SESSION["iSMuIdKey"];
$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
?>
<script>
var agdate=<?php echo (isset($iUserIdSM)?$iUserIdSM:""); ?>;
var agtime=<?php echo (isset($iUserProfileId)?$iUserProfileId:""); ?>;
//alert($iUserIdSM);
//alert($iUserProfileId);

loadObservation(agdate,agtime);
</script>
</div>
<!--END innerCont..-->
<hr /></div>
