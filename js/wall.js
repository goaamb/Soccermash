function prueba(){
	//alert("hola");
}

function seePublications(){
	$.ajax({
		url: dir+"Wall/classWall.php",
		data: "type=seePublications",
		type: 'POST',
		success: function(data){
			if(data){
				alert("Result data "+data);
			}else{
				alert("bad data "+data);
			}
		}
	})
}