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

function JS_mostrarPlayers(page){
	//alert('llama');
	xajax_mostrarPlayers(page);
	return false;
}
JS_mostrarPlayers(1);
</script>