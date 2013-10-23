<?php require_once("gestion/lib/share/clases/search/buscador.js.php"); ?>

<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->

<script>

function pasaV(val1,val2){
//alert("Pasando valor en editPersonalDistinction");
	$("#fhidden").val(val1);
	$("#finder").val(val2);
	$("#hideShow").hide(300);
		
}

</script>

</head>



<body>
 <div id="persDistinctions"><h4 id="dist"><?php print $_IDIOMA->traducir("PERSONAL DISTINCTIONS"); ?><em></em><em class="plus open close"></em></h4>
    <div class="innerContent margLeftCenter dist">
    <p class="editMode txtColorLC hide"><?php print $_IDIOMA->traducir("Example: Won Championships or competitions local and international."); ?></p>
<div id="resultPersonalDistinction"></div>


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

$(document).ready(function(){

	$('#addag').click(function(){
		//alert("Click");
			if($('#addDistinctionag').val()==''){
				alert('Please insert the distinction');
				$('#addDistinctionag').css('backgroundColor','blue');
				return false;
			}else{
				$('#addDistinctionag').css('backgroundColor','');
			}
			
			if($('#addYearag').val()==''){
				alert('Please insert the year of the distinction');
				$('#addYearag').css('backgroundColor','blue');
				return false;
			}else{
				$('#addYearag').css('backgroundColor','');
			}
			
			if ($('#addDistinctionag').val() != '' && $('#addYearag').val() != '') {
			$.post("modules/PersonalDistinction/classPersonalDistinction.php", { 
									type: 'add',
									addDistinctionag: $('#addDistinctionag').val(),
									addSeasonag: $('#addSeasonag').val(),
									addYearag: $('#addYearag').val(),
									addHiddenag: $('#addHiddenag').val()									
								 });
			
}
			


})})



//NO BORRAR; ESTE ESTA EN EL OTRO TMB AIS QUE ESTE QUEDA
loadPersonalDistinction(agdate,agtime);
//NO BORRAR; ESTE ESTA EN EL OTRO TMB AIS QUE ESTE QUEDA
</script>
</div><!--END innerCont..-->
<hr /></div><!--END persDist..-->