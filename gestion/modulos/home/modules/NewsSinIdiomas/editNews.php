<?php require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>

<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->

<script>

function pasaV(val1,val2){
alert("Pasando valor en editCareer");
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}

</script>
</head>



<body>
<div id="newsmodule"><h4 id="nws">NEWS<em></em><em class="plus open close"></em></h4>
    <div class="innerContent margLeftCenter nws">
	<p class="editMode txtColorLC hide">Example: Won Championships or competitions local and international.</p>
<div id="resultNews"></div>
<?php require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>

<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
<?php 
//$iUserIdSM=67;
//echo "THIS IS :".$_SESSION['idUserVisiting'];
$iUserIdSM=$_SESSION["iSMuIdKey"];
$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
//$iUserProfileId=2;
//echo "Userid2 :".$_SESSION["iSMuIdKey"];
//echo "<br />UserProfile :".$_SESSION["iSMuProfTypeKey"]."<br />";
?>
<script>
var agdate=<?php echo $iUserIdSM; ?>;
var agtime=<?php echo $iUserProfileId; ?>;
//alert($iUserIdSM);
//alert($iUserProfileId);

loadNews(agdate,agtime);
</script>
</div>
<!--END innerCont..-->
<hr /></div>
</body>
</html>
