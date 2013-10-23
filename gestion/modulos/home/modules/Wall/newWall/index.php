<script>


$(document).ready(function(){



	$.ajax({
				url: dir+"Wall/consultas.php",
				data: "action=select",
				type: 'POST',
				//dataType : 'json',
				//beforeSend:,
				success: function(data){
					$("#publicationsAg").html(data);
				}
	})
	
})


</script>
<div id="wall">
<div id="writeArea"><textarea rows="auto" class="writeWall" id="wrtMain" title="Write a public message in this wall" name="writeWall">Write a public message in this wall</textarea>
<input type="submit" value="PUBLISH" name="#" id="#"  />
</div>

<div id="holdComments">
	<div id="wallBar"><span>Wall</span></div>
	<div id="publicationsAg"></div>
</div><!--holdComments-->

<!--ACA LLAMADA A PREVIOUS-->

</div><!--END wall-->