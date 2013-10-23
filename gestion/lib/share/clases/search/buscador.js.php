<script type="text/javascript">
/////////////////Busca///////////////////////////////	
	  tot=1; //total de buscadores
	  function busca(cual,rellena,tipo,user,hidden){
	 		
	 		var valor=$("#"+cual).val();
			$("#"+rellena).html('');
			$("#"+rellena).load("gestion/lib/share/clases/search/busquedaSba.php",{valor:valor,tipo:tipo,user:user,hidden:hidden,rellena:rellena});
	   			
	  }
	  

///////////////Buscare////////////////////////////////	  
	  function buscare(espacio,user,tipe,hidden){
				//alert(userVal);
				for(i=0;i<tot;i++){
					$("#espacio"+i).html('');
				}	
			$("#"+espacio).load("gestion/lib/share/clases/search/buscador.php",{tipe:tipe,user:user,hidden:hidden});
			//$("#"+user).attr("readonly", "readonly");
			
	 }
//////////////Escribire///////////////////////////////
	  function escribire(buscador,user,hidden){
	  	
			 $("#"+buscador).hide('fast');
			 //$("#"+user).attr("readonly", "");
			 $("#"+hidden).val('');
			 $("#"+user).val('');
	 }

//////////////Borrare///////////////////////////////
	  function borrare(hidden,user){
			 $("#"+hidden).val('');
			 $("#"+user).val('');
	 }
	 
	 


///////////Buscador//////////////////////////////////////
function buscador(espacio,user,valor,hidden,userVal,hiddenVal){
	tot++;
	//document.write('<div>');
	document.write('<input type="text" name="'+user+'" id="'+user+'" class="input" style="width:200px;" value="'+userVal+'" onclick="buscare(\''+espacio+'\',\''+user+'\',\''+valor+'\',\''+hidden+'\'); borrare(\''+hidden+'\',\''+user+'\');" onFocus="buscare(\''+espacio+'\',\''+user+'\',\''+valor+'\',\''+hidden+'\'); borrare(\''+hidden+'\',\''+user+'\');" onkeyup="busca(\''+user+'\',\'user_rellena\',\''+valor+'\',\''+user+'\',\''+hidden+'\');"/></label>');  	
	
	/*document.write('&nbsp;&nbsp;<input type="button" class="right" id="btn_borrar" value="x" onclick="borrare(\''+hidden+'\',\''+user+'\')"/>');
	document.write('&nbsp;&nbsp;<input type="button" class="right" id="btn_buscar" value="search" onclick="buscare(\''+espacio+'\',\''+user+'\',\''+valor+'\',\''+hidden+'\');"/>');*/
	
	document.write('<input type="hidden" name="'+hidden+'" id="'+hidden+'" value="'+hiddenVal+'"/>');
	document.write('<div id="'+espacio+'" style="position:relative"></div>');
	//document.write('</div>');
	}
	
</script>