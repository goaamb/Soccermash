<?php
if(!isset($page)){
	$page=0;
}

//echo $_SERVER['DOCUMENT_ROOT']."<br />";
//echo $rootPath=$_SERVER['DOCUMENT_ROOT'].".soccermash.com/gestion/modulos/home/modules/Wall/load_publications.php";
//echo "<br />";
?><script>


$("#publish").click(function(){
	alert("dsa");
	$("#divGifForWall").html('<img src="img/indicator.gif" width="15" height="15"/>');
})
$(document).ready(function(){
	
	$("#Wall").click(function(){
		
	})

	$("#Activities").click(function(){

	})


$("#publications").load("gestion/modulos/home/modules/Wall/load_publications.php");
//alert(rootPath);
})

$('.yourAnswer').keydown(function(e){
	alert("Answer");
			var code = e.keyCode;
			if (code === 13){
			
			var asd=$(this).attr("name");
			//alert(asd);
			var tam=asd.length;
			//alert(tam);
			var askhjdasoljqkwdsanmcxgzh=asd.substr(12,tam);
			//alert(askhjdasoljqkwdsanmcxgzh);
			var kasdj=$("[name='writeAnswer_"+askhjdasoljqkwdsanmcxgzh+"']").val();
			//alert(kasdj);
			
			
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
				
					//alert("Data is true: "+data);
					loadPublications(<?php echo $page; ?>);
				}else{
					loadPublications(<?php echo $page; ?>);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}
				}})
				
	
		}
	})

	
	
</script>

<div id="wall">
<div id="writeArea"><textarea rows="auto" class="writeWall" id="wrtMain" title="Write a public message on this wall" name="writeWall"><?php print $_IDIOMA->traducir("Write a public message on this wall"); ?></textarea>
<input type="submit" value="PUBLISH" name="#" id="publish"  />
	<div id="divGifForWall"></div>
</div>
<div id="holdComments">
	<div id="wallBar"><span id="Wall"><?php print $_IDIOMA->traducir("Wall"); ?></span> <!-- <span id="Activities">Activities</span> --></div> 
	<!-- <div id="publications"><?php //require_once("load_publications.php"); ?></div> -->
	<div id="publications"></div>
	
</div><!--holdComments-->
</div>
