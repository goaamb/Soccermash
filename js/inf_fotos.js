/**
 * encargado de mostrar la inforcacion de las fotos de la busqueda
 */
		
 	/*	function subir(id){
		 
			ini = parseInt(document.getElementById("imagen"+id).style.height.substring(0,3))-5;
			fin = 120;
			if(ini > fin){
				//for(i = ini ; i>fin; i = i-5){
					document.getElementById("imagen"+id).style.height = ini+"px";
					setTimeout (function(){subir(id);}, 80); 
				//}
			}else{
				document.getElementById("imagen"+id).style.height = fin+"px";
			}
		}*/
		function subir(id){
			document.getElementById("imagen"+id).style.height = "100px";
		 }
		
		function bajar(id){
			document.getElementById("imagen"+id).style.height = '190px';
		}
		
	/*	function bajar(id){
			ini = parseInt(document.getElementById("imagen"+id).style.height.substring(0,3))+5;
			fin = 190;
			if(ini < fin){
				//for(i = ini ; i>fin; i = i-5){
					document.getElementById("imagen"+id).style.height = ini+"px";
					setTimeout (function(){bajar(id);}, 80); 
				//}
			}else{
				document.getElementById("imagen"+id).style.height = fin+"px";
			}
		}*/
		
		function subir2(id){
			document.getElementById("imagen"+id).style.height = "80px";
		 }
		
		function bajar2(id){
			document.getElementById("imagen"+id).style.height = '145px';
		}
		