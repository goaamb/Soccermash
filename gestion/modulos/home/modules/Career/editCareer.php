<?php require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>

<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->

<script>

function pasaV(val1,val2){
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}


</script>

</head>



<body>
<div id="career"><h4 id="caree"><?php print $_IDIOMA->traducir("CAREER"); ?><em></em><em class="plus open close"></em></h4>
	<div class="innerContent margLeftCenter caree">
    <p class="editMode txtColorLC hide"><?php print $_IDIOMA->traducir("Example: Won Championships or competitions local and international."); ?></p>
<div id='resultCareer'></div>   	




<?php 
//$iUserIdSM=67;
$iUserIdSM=$_SESSION["iSMuIdKey"];
$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;	
//echo "Userid :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
//echo "<br />edit: ".$_SESSION['editProfile'];
?>
<script>
var agdate=<?php echo (isset($iUserIdSM)?$iUserIdSM:""); ?>;
var agtime=<?php echo (isset($iUserProfileId)?$iUserProfileId:""); ?>;
//alert($iUserIdSM);
//alert($iUserProfileId);


loadCareer(agdate,agtime);

</script>
</div>
</div>
<hr />
