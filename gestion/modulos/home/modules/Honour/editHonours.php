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
<div id="honours"><h4 id="hnrs"><?php print $_IDIOMA->traducir("HONORS"); ?><em></em><em class="plus open close"></em></h4>
<div class="innerContent margLeftCenter hnrs"><!--paddRightCenter -->
   	<p class="editMode txtColorLC hide"><?php print $_IDIOMA->traducir("Example: Won Championships or competitions local and international."); ?></p>

<div id='resultHonour'></div>
<?php 
if(isset($_SESSION["bEditPlayer"]) && $_SESSION["bEditPlayer"]==true){#Represent Player
								   
	if(isset($_SESSION["iIdPlayer"]) && isset($_SESSION["iPerfilPlayer"]) ){															 
			$iUserIdSM 		= $_SESSION["iIdPlayer"];
			$iUserProfileId = $_SESSION["iPerfilPlayer"];
	}
			
}else{
	$iUserIdSM		= $_SESSION["iSMuIdKey"];
	$iUserProfileId	= $_SESSION["iSMuProfTypeKey"];
}
?>
<script>
var agdate=<?php echo (isset($iUserIdSM)?$iUserIdSM:""); ?>;
var agtime=<?php echo (isset($iUserProfileId)?$iUserProfileId:""); ?>;
//alert($iUserIdSM);
//alert($iUserProfileId);


loadHonour(agdate,agtime);

</script>

</div><!--END innerCont..-->
<hr />
</div>
</body>