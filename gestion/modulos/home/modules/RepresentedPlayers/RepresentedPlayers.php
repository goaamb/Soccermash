<div id="represented"><h4 id="rep"><?php print $_IDIOMA->traducir("REPRESENTED PLAYERS"); ?><em></em><em class="plus open close"></em></h4>
    <div class="innerContent rep" style="width: 585px;">
    <div id="contentRepresented">
	</div>
		<!-- paginacion, para la paginacion utiliza ajax.. para q carge el contenido 
		el id del div contentRepresented puedes utilizar para borrar y cargar contenido-->
		<div class="pagRepresented" id="paginadorAgente">


		</div>
		<!-- end paginacion -->
	</div><!--END innerCont..-->
<hr /></div><!--END Represented-->
<script>
function adminPlayer(url,name,lstname){
	$("#alertEmergenteDatos").load('gestion/modulos/home/msgs/admRepresent.php?url='+url+'&name='+name+'&lstname='+lstname);
	$('#alertEmergente').show();
	$('#alertEmergente0').show();
}
function deletePlayer(id){
	$("#alertEmergenteDatos").load('gestion/modulos/home/msgs/removePlayer.php?id='+id);
	$('#alertEmergente').show();
	$('#alertEmergente0').show();
}
function JS_representedPlayers(page){
	//alert('llama');
	xajax_representedPlayers(page);
	return false;
}
JS_representedPlayers(1);
</script>
