/*function loadPublications(){
//alert("loading =) ");
	$('#publications').load(dir+'Wall/load_publications.php');
}*/

var dir3='gestion/modulos/home/';

function moreResults(){
	//alert("clicked");
}

function AddCommentAg(id){
	$('.'+id).val('');
	$('.'+id).focus();
}





	
	/*
function loadPublications(){
//alert("loading =) ");
	var d=new Date();
	$('#publications').load(dir+'Wall/load_publications.php');
}*/



var textoMuroDefecto='Write a public message on this wall';
$(document).ready(function(){

	$('#wrtMain').focus(function(){
		if($(this).val() == textoMuroDefecto){
			$(this).val('');
		}
	})
	
	
	$('#wrtMain').focusout(function() {
		if($(this).val() == ''){
			$(this).val(textoMuroDefecto);
		}
	})
	

	$("#publish").click(function(){
		var wrtMain=$('#wrtMain').val();
		
		if(wrtMain == textoMuroDefecto)
		{
			return false;
		}
		//alert(wrtMain);
		
		$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=insert&value="+wrtMain,
				type: 'POST',
				//dataType : 'json',
				
				
				beforeSend: function(){
					$("#divGifForWall").html('<img src="img/indicator.gif" width="15" height="15"/>');
				},
				
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					$('#wrtMain').val(textoMuroDefecto);
					$("#divGifForWall").html('');
					loadPublications();
				}else{					$('#wrtMain').val(textoMuroDefecto);					$("#divGifForWall").html('');				
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
	
})