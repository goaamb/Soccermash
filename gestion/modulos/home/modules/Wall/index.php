<?php
if (! isset ( $page )) {
	$page = 0;
}
?><script>
$("#publish").click(function(){
	$("#divGifForWall").html('<img src="img/indicator.gif" width="15" height="15"/>');
});
$(document).ready(function(){
	$("#publications").html('<img src="img/indicator.gif" width="15" height="15"/>');
	$("#Wall").click(function(){
		$("#Wall").addClass("act");
		$('#Activities').removeClass("act");
		$("#publications").html('<img src="img/indicator.gif" width="15" height="15"/>');
		$("#publications").load("gestion/modulos/home/modules/Wall/load_publications.php");		
	});

	$("#Activities").click(function(){
		$("#Activities").addClass("act");
		$('#Wall').removeClass("act");
		$("#publications").html('<img src="img/indicator.gif" width="15" height="15"/>');
		$("#publications").load("gestion/modulos/home/modules/Wall/load_activities.php");
	});
	<?php
	if (! isset ( $_SESSION ["idUserVisiting"] ) || $_SESSION ["idUserVisiting"] == 0 || $_SESSION ["idUserVisiting"] == $_SESSION ["iSMuIdKey"]) {
		?>
		$("#Activities").addClass("act");
		$("#publications").load("gestion/modulos/home/modules/Wall/load_activities.php");
<?php
	} else {
		?>
$("#Wall").addClass("act");
$("#publications").load("gestion/modulos/home/modules/Wall/load_publications.php");
<?php
	}
	?>
});

$('.yourAnswer').keydown(function(e){
	alert("Answer");
			var code = e.keyCode;
			if (code === 13){
			
			var asd=$(this).attr("name");
			var tam=asd.length;
			var askhjdasoljqkwdsanmcxgzh=asd.substr(12,tam);
			var kasdj=$("[name='writeAnswer_"+askhjdasoljqkwdsanmcxgzh+"']").val();
			
			$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=insertComment&value="+kasdj+"&askhjdasoljqkwdsanmcxgzh="+askhjdasoljqkwdsanmcxgzh,
				type: 'POST',
				dataType : 'json',
				beforeSend: function(){
					$("#divGif_"+askhjdasoljqkwdsanmcxgzh).html('<img src="img/indicator.gif" width="15" height="15"/>');
				},
				success: function(data){
				if(data == true){
					loadPublications(<?php
					echo $page;
					?>);
				}else{
					loadPublications(<?php
					echo $page;
					?>);
				}
				}});
		}
	});
$('textarea#wrtMain').autoResize({
    // On resize:
    onResize : function() {
        $(this).css({opacity:0.8});
    },
    // After resize:
    animateCallback : function() {
        $(this).css({opacity:1});
    },
    // Quite slow animation:
    animateDuration : 300,
    // More extra space:
    extraSpace : 40
});
$('textarea#wrtSec').autoResize({
    // On resize:
    onResize : function() {
        $(this).css({opacity:0.8});
    },
    // After resize:
    animateCallback : function() {
        $(this).css({opacity:1});
    },
    // Quite slow animation:
    animateDuration : 300,
    // More extra space:
    extraSpace : 40
});

</script>

<div id="wall">
<div id="writeArea"><textarea rows="auto" class="writeWall" id="wrtMain"
	title="<?php
	print $_IDIOMA->traducir ( "Write a public message on this wall" );
	?>"
	name="writeWall"><?php
	print $_IDIOMA->traducir ( "Write a public message on this wall" );
	?></textarea> <input type="submit"
	value="<?php
	print $_IDIOMA->traducir ( "PUBLISH" );
	?>" name="#"
	id="publish" />
<div id="divGifForWall"></div>
</div>
<div id="holdComments">
<div id="wallBar"><span id="Wall" class=""><?php
print $_IDIOMA->traducir ( "Wall" );
?></span> <?php
if (! isset ( $_SESSION ["idUserVisiting"] ) || $_SESSION ["idUserVisiting"] == 0 || $_SESSION ["idUserVisiting"] == $_SESSION ["iSMuIdKey"]) {
	?>
	<span id="Activities" class=""><?php
	print $_IDIOMA->traducir ( "updates" );
	?></span>
	<?php
}
?>

</div>
<div id="publications"></div>

</div>
<!--holdComments--></div>
