<link href="../../../../../css/homestyles.css" type="text/css" rel="stylesheet" media="screen" />
<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 


if(!isset($_SESSION['idUserVisiting'])){;
$idUserVisiting=$_SESSION['iSMuIdKey'];
}else{
$idUserVisiting=$_SESSION['idUserVisiting'];
}
$idProfile=$_SESSION['iSMuProfTypeKey'];
$idUser=$_SESSION['iSMuIdKey'];
?>

<style>

</style>

<script>
function loadPublications(){
//alert("loading =) ");
	var d=new Date();
	$('#publications').load(dir+'Wall/load_publications2.php');
}

$(document).ready(function(){

	$('#wrtMain').focus(function(){
		if($(this).val() == 'Write a public message in this wall'){
			$(this).val('');
		}
	})
	
	
	$('#wrtMain').focusout(function() {
		if($(this).val() == ''){
			$(this).val('Write a public message in this wall');
		}
	})
	

	$("#publish").click(function(){
		var wrtMain=$('#wrtMain').val();
		
		//alert(wrtMain);
		
		$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=insert&value="+wrtMain,
				type: 'POST',
				//dataType : 'json',
				//beforeSend:,
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					$('#wrtMain').val('Write a public message in this wall');
					loadPublications();
				}else{
					loadPublications();
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}
				/*
				//alert(data.msadp239i7u894hlsjr0);
				$.ajax({
					url: dir+"Wall/classWall.php",
					data: "type=selCom&dasjkldasyqwebmasdnmpsa="+dasjkldasyqwebmasdnmpsa+"&fdkjasfdsjakldausoiq="+fdkjasfdsjakldausoiq+"&djkasdjsjdklscxzqwe="+data.msadp239i7u894hlsjr0,
					type: 'POST',
					dataType : 'json',
					//beforeSend:,
					success: function(data2){
						alert(data2.qwerfghjklpoiuhgvc);
						alert(data2.dasjkluaduasdkasla);
						alert(data2.aslqwdsaouiqwieqls);
						alert(data2.dopqwepqwufyuixzvy);
						loadPublications();
					
	}
	})
	}*/
	}})
		
	})
	


$('.yourAnswer').keypress(function(e){

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
				//beforeSend:,
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications();
				}else{
					loadPublications();
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}
				}})
				
	
		}
	})

	//loadPublications();
	
})

</script>
<div id="wall">
<div id="writeArea"><textarea rows="auto" class="writeWall" id="wrtMain" title="Write a public message in this wall" name="writeWall">Write a public message in this wall</textarea>
<input type="submit" value="PUBLISH" name="#" id="publish"  />

<div id="holdComments">
	<div id="wallBar"><span>Wall</span></div>
		<div id="publications"><?php require_once("load_publications2.php"); ?></div>
</div><!--holdComments-->


</div><!-- end wall -->
</div><!-- end wall -->



<?php /*
//require_once($_SERVER['DOCUMENT_ROOT']."/www/soccermashTest16-6/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
$iUserIdSM = $_SESSION["iSMuIdKey"];	
//echo "id: ".$iUserIdSM."<br />";
$fdkjasfdsjakldausoiq=$_SESSION["iSMuProfTypeKey"];
//echo "prfoileId: ".$fdkjasfdsjakldausoiq."<br />";
$dasjkldasyqwebmasdnmpsa		   =dirty($iUserIdSM);
//echo "sucio: ".$dasjkldasyqwebmasdnmpsa."<br />";
$time		   =time();
?>
<script>
function loadPublications(){
//alert("loading =) ");
	var d=new Date();
	$('#publications').load(dir+'Wall/load_publications.php');
}
//alert("asdakjdlasjdls");
var dasjkldasyqwebmasdnmpsa=<?php echo $dasjkldasyqwebmasdnmpsa; ?>;
var fdkjasfdsjakldausoiq=<?php echo $fdkjasfdsjakldausoiq; ?>;
$(document).ready(function(){

	

		$('#publish').click(function(){
			alert("guardando2");
				
			var wrtMain=$('#wrtMain').val();
			alert(wrtMain);
			$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=insert&value="+wrtMain+"&dasjkldasyqwebmasdnmpsa="+dasjkldasyqwebmasdnmpsa+"&fdkjasfdsjakldausoiq="+fdkjasfdsjakldausoiq,
				type: 'POST',
				dataType : 'json',
				//beforeSend:,
				success: function(data){
				//alert(data.msadp239i7u894hlsjr0);
				$.ajax({
					url: dir+"Wall/classWall.php",
					data: "type=selCom&dasjkldasyqwebmasdnmpsa="+dasjkldasyqwebmasdnmpsa+"&fdkjasfdsjakldausoiq="+fdkjasfdsjakldausoiq+"&djkasdjsjdklscxzqwe="+data.msadp239i7u894hlsjr0,
					type: 'POST',
					dataType : 'json',
					//beforeSend:,
					success: function(data2){
						alert(data2.qwerfghjklpoiuhgvc);
						alert(data2.dasjkluaduasdkasla);
						alert(data2.aslqwdsaouiqwieqls);
						alert(data2.dopqwepqwufyuixzvy);
						loadPublications();
					
	}
	})
	}
	})
	})
	})

</script>
<?php
echo "idUserVisiting: ".$_SESSION['idUSerVisiting']."<br />";
//echo $_SESSION['']."<br />";

?>

<div id="wall">
<div id="writeArea"><textarea rows="auto" class="writeWall" id="wrtMain" title="Write a public message in this wall" name="writeWall">Write a public message in this wall</textarea>
<input type="submit" value="PUBLISH" name="#" id="publish"  />
</div>

<div id="holdComments">
	<div id="wallBar"><span>Wall</span></div>
		<div id="publications"><?php require_once("load_publications.php"); ?></div>
</div><!--holdComments-->

<!--ACA LLAMADA A PREVIOUS-->

</div><!--END wall-->

*/?>