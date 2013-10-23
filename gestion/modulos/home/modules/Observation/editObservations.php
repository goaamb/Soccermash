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
<div id="observations"><h4 id="obs">
<?php
 
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
if(isset($_SESSION["bEditPlayer"])&& $_SESSION["bEditPlayer"]==true){#si la edicion del perfil q se kiere guardar 
								    #es la de player x su representante
	if(isset($_SESSION["iIdPlayer"])&&isset($_SESSION["iPerfilPlayer"])){															 
			$iUserIdSM = $_SESSION["iIdPlayer"];
			$iUserProfileId = $_SESSION['iPerfilPlayer'];
	}
			
}else{
	$iUserIdSM=$_SESSION["iSMuIdKey"];
	$iUserProfileId=$_SESSION["iSMuProfTypeKey"];
}
?>
<script>
var agdate=<?php echo (isset($iUserIdSM)?$iUserIdSM:""); ?>;
var agtime=<?php echo (isset($iUserProfileId)?$iUserProfileId:""); ?>;


loadObservation(agdate,agtime);
</script>
</div>
<!--END innerCont..-->
<hr /></div>

