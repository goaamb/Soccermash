<?php
$dir = "/";
require_once $_SERVER ["DOCUMENT_ROOT"] . $dir . 'gbase.php';
require_once $_GBASE . '/goaamb/idioma.php';
require_once $_GBASE . "/goaamb/anuncio.php";
if (class_exists ( "Idioma" ) && ! isset ( $_IDIOMA )) {
	$_IDIOMA = Idioma::darLenguaje ();
}
$uid = $_SESSION ["iSMuIdKey"];
$mlsm = ModelLoader::crear ( "ax_sentMsj" );
$mlrm = ModelLoader::crear ( "ax_replyMsj" );
$mlu = ModelLoader::crear ( "ax_generalRegister" );
$mlu->buscarPorCampo ( array (
		"id" => $uid 
) );
$mlur = ModelLoader::crear ( "ax_generalRegister" );
$mlus = ModelLoader::crear ( "ax_generalRegister" );
$selectNoActives = "select id from ax_generalRegister where active=0";
$sqlBase = "(idUserSend='$uid' and not idUserSend in ($selectNoActives)) or (idUserRecived='$uid'  and not idUserSend in ($selectNoActives))";
$lista = $mlsm->listar ( "$sqlBase order by date desc,idmsj desc", 0, 10 );
$total = $mlsm->contar ( "$sqlBase" );
function processText($text, $reduc = -1) {
	$reduc = intval ( $reduc );
	if (intval ( $reduc ) > 0 && strlen ( $text ) > $reduc) {
		$text = substr ( $text, 0, $reduc ) . "...";
	}
	return nl2br ( htmlentities ( ($text) ) );
}
?>
<div class="theMsgsSPriv">
	<div class="msgsTitle"></div>
<?php
foreach ( $lista as $mensaje ) {
	$prevmsj = processText ( $mensaje->txtmsj, 50 );
	$mensaje->txtmsj = processText ( $mensaje->txtmsj );
	$contar = $mlrm->contar ( "checkit=0 and idMsjSent='$mensaje->idmsj' and idUserReply<>'" . $uid . "'" );
	if ($contar > 0) {
		$mensaje->checkit = 0;
	}
	if ($mensaje->idUserSend == $uid) {
		unset ( $mlus );
		$mlus = clone $mlu;
		$mlur->buscarPorCampo ( array (
				"id" => $mensaje->idUserRecived 
		) );
	} else {
		unset ( $mlur );
		$mlur = clone $mlu;
		$mlus->buscarPorCampo ( array (
				"id" => $mensaje->idUserSend 
		) );
	}
	$username = utf8_encode ( $mlus->name . " " . $mlus->lastname );
	$usernamer = utf8_encode ( $mlur->name . " " . $mlur->lastname );
	?>
<div class="privMsgGral"
		id="privMsgGral<?php
	print $mensaje->idmsj;
	?>">
		<div
			class="msgContPriv<?php
	if ($mensaje->checkit == 0) {
		print " msgContNew";
	}
	?>"
			id="msgContPriv<?php
	print $mensaje->idmsj;
	?>"
			onclick="desplegMsgPriv('<?php
	print $mensaje->idmsj;
	?>');<?php
	if ($mensaje->checkit == 0) {
		print "sendNoNew('$mensaje->idmsj')";
	}
	?>">
			<div class="borMsg"></div>

			<div class="fotPeq">
				<img class="bordersRed" width="50"
					src="<?php
	print "photoGeneral/small/small_" . $mlus->photo;
	?>"
					onclick="location.href='<?php
	print "/" . $_IDIOMA->traducir ( "user" ) . "/" . $mlus->id . "-" . Utilidades::normalizarTexto ( $username )?>'">
			</div>

			<div class="theMsgText"
				id="theMsgTextMsg<?php
	print $mensaje->idmsj;
	?>">
				<div class="nameMsg" onclick=""><?php
	if ($mensaje->idUserSend == $uid) {
		print "( " . $_IDIOMA->traducir ( "Sent" ) . " ) ";
	} else {
		print "( " . $_IDIOMA->traducir ( "Received" ) . " ) ";
	}
	print ($username) ;
	?> -&gt; <?php
	print ($usernamer) ;
	?></div>
				<div class="prevMsj"><?php
	print $prevmsj;
	?></div>
				<div class="fullMsj" style="display: none;"><?php
	print $mensaje->txtMsj;
	?></div>
			</div>
			<div class="dateMsg"><?php
	print date ( "d/m/Y", strtotime ( $mensaje->date ) );
	?></div>
			<div class="closeMsgPriv" title="Delete"
				onclick="sendDelete('<?php
	print $mensaje->idmsj;
	?>');"></div>
		</div>
		<!-- //replies + input // -->
		<div class="slideUp"
			id="repliesMsgPriv<?php
	print $mensaje->idmsj;
	?>"
			style="display: none;">

			<div class="inputReplyMsgPriv">
				<textarea class="inpRplyPriv"
					id="inpRplyPriv<?php
	print $mensaje->idmsj;
	?>"></textarea>
			</div>

			<div class="repliBtnPriv"
				onclick="sendReply('<?php
	print $mensaje->idmsj;
	?>');">Reply</div>
		</div>
<?php
	$listarep = $mlrm->listar ( "idMsjSent='$mensaje->idmsj' order by date desc, idMsjReply desc", 0, 10 );
	$totalrep = $mlrm->contar ( "idMsjSent='$mensaje->idmsj'" );
	foreach ( $listarep as $reply ) {
		$mlus->buscarPorCampo ( array (
				"id" => $reply->idUserReply 
		) )?>

<div class="replyMsgPriv"
			id="replyMsgPriv<?php
		print $reply->idMsjReply;
		?>"
			onclick="desplegRplPriv('<?php
		print $reply->idMsjReply;
		?>');">
			<div class="borMsg"></div>
			<div class="fotPeq">
				<img width="50"
					onclick="location.href='<?php
		print "/" . $_IDIOMA->traducir ( "user" ) . "/" . $mlus->id . "-" . Utilidades::normalizarTexto ( $username )?>'"
					class="bordersRed"
					src="<?php
		print "photoGeneral/small/small_" . $mlus->photo;
		?>">
			</div>

			<div style="color: rgb(187, 187, 187);" class="theMsgText">
				<div class="nameMsg" onclick=""><?php
		print htmlentities ( $username );
		?></div>
<?php
		print nl2br ( htmlentities ( $reply->txtMsjReply ) );
		?></div>
			<div class="dateMsg"><?php
		print date ( "Y-m-d", strtotime ( $reply->date ) );
		?></div>
		</div>
<?php
	}
	?>
<?php

	if ($totalrep > count ( $listarep )) {
		?>
<div class="moreResReply"
			class="moreResReply<?php
		print $mensaje->idmsj;
		?>"
			onclick="verMasReply.call(this,'<?php
		print $mensaje->idmsj;
		?>');"
			rel="<?php
		print count ( $listarep );
		?>">More results</div>
<?php
	}
	?>

</div>
<?php
}
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<!-- ///Footer for msg with advices/// -->
	<div class="footMsg">
		<!-- <div class="seeAllMsg"><a href="javascript:;" onClick="">See All Messages</a></div> -->


		<!-- ///Start Advice/// (max 2 advices) -->
		<div class="advMsg"><?php
		$mlaxgen = ModelLoader::crear ( "ax_generalRegister" );
		if ($mlaxgen->buscarPorCampo ( array (
				"id" => $_SESSION ["iSMuIdKey"] 
		) )) {
			$lista = Anuncio::listarAnuncios ( $mlaxgen, 1 );
			if (count ( $lista ) > 0) {
				Anuncio::insertarEstadisticaAnuncioTipo1 ( $lista [0], "Impresion", "3" );
				Anuncio::imprimirAnuncioTipo1 ( $lista [0], "3" );
			}
		}
		?></div>
		<!-- ///End advice/// -->


	</div>
	<!-- ///End Footer/// -->
	<div class="advertisingWord">Advertising</div>
	<div class="shadMsg"></div>
</div>
<script src="goaamb/js/G.js" type="text/javascript"></script>
<script type="text/javascript">
$(".msgContPriv").mouseover(function(){
		$(this).find('.theMsgText').css('color','#FFFFFF');
								
});
$(".msgContPriv").mouseleave(function(){
		$(this).find('.theMsgText').css('color','#BBBBBB');								
});	
totalMsg=20;
function desplegMsgPriv(idNum){
	for(i=0;i<totalMsg;i++){
		if(i!=idNum){
			$("#repliesMsgPriv"+i).hide();
			$("#theMsgTextMsg"+i).css('height','30px');
			$("#msgContPriv"+i).css('height','64px');
		}
	}
	
	var rsup=$("#repliesMsgPriv"+idNum+".slideUp");
	var rsdo=$("#repliesMsgPriv"+idNum+".slideDown");
	rsup.slideDown("slow",function(){$(this).removeClass("slideUp").addClass("slideDown");});
	rsdo.slideUp("slow",function(){$(this).removeClass("slideDown").addClass("slideUp");});
}


$(".msgContPriv").click(function(){
	
		if($(this).css('height')=='64px'){
			$(this).find('.theMsgText').css('height','auto');
			$(this).find('.prevMsj').css('display','none');
			$(this).find('.fullMsj').css('display','block');
			$(this).css('height','auto');
			$(this).css('overflow','visible');
			
		}else{
			$(this).find('.theMsgText').css('height','30px');
			$(this).find('.prevMsj').css('display','block');
			$(this).find('.fullMsj').css('display','none');
			$(this).css('height','64px');
			$(this).css('overflow','hidden');	
			$(this).find(".repliesMsgPriv").slideUp();
		}
});	


$(".replyMsgPriv").mouseover(function(){
		$(this).find('.theMsgText').css('color','#FFFFFF');
								
});
$(".replyMsgPriv").mouseleave(function(){
		$(this).find('.theMsgText').css('color','#BBBBBB');								
});	


/////// Hide and Show replies /////////////
totalReplies=4;
function desplegRplPriv(idNum){
	for(i=1;i<totalReplies;i++){
		if(i!=idNum){
			$("#replyMsgPriv"+i).css('height','64px');
			$("#theMsgText"+i).css('height','30px');
		}
	}
	
}
$(".closeMsgPriv").click(function(e){return false;});
/*$(".repliBtnPriv").click(function(e){return false;});*/

//////////////show this reply////////////
var lfxrmp=function(e){
	if($(this).css('height')=='64px'){
		$(this).find('.theMsgText').css('height','auto');
		$(this).css('height','auto');
		$(this).css('height','auto');
	}else{
		$(this).css('height','64px');	
		$(this).find('.theMsgText').css('height','30px');
	}
};
$(".replyMsgPriv").click(lfxrmp);	

function sendNoNew(id){
	var a=new G.ajax({
		pagina:"ajax/msjprivados.php",
		post:{
			id:id,
			accion:"noNuevo"
		},
		json:true,
		accion:function(){
			if(this.JSON.success==true){
				$("#msgContPriv"+this.post.id).removeClass("msgContNew");
				$("#msgContPriv"+this.post.id).attr("onclick","desplegMsgPriv('"+this.post.id+"');");
				var counter=G.dom.$("numPrivMsgReceived");
				if(this.JSON.faltan>0){
					counter.innerHTML=this.JSON.faltan;
					counter.style.display="block";
					$(".privMsgNone").removeClass("privMsgNone").addClass("privMsgReceived");
				}
				else{
					counter.style.display="none";
					$(".privMsgReceived").removeClass("privMsgReceived").addClass("privMsgNone");
				}
			}
		}
	});
	a.enviar();
}

function sendReply(id){
	var t=G.dom.$("inpRplyPriv"+id);
	if(t){
		var val;
		if(G.nav.isIE && G.nav.version<7){
			val=t.innerHTML;
		}else{
			val=t.value;
		}
		if(G.util.trim(val)!==""){
		var a=new G.ajax({
			pagina:"ajax/msjprivados.php",
			post:{
				id:id,
				value:val,
				accion:"reply"
			},
			json:true,
			t:t,
			accion:function(){
				if(this.JSON.success==true){
					if(G.nav.isIE && G.nav.version<7){
						this.t.innerHTML="";
					}else{
						t.value="";
					}
					var mr=G.dom.$("moreResReply"+this.post.id);
					if(mr){
						mr.parentNode.removeChild(mr);
					}
					var replys=$("#repliesMsgPriv"+this.post.id+" .replyMsgPriv");
					for ( var i = 0; i < replys.length; i++) {
						replys[i].parentNode.removeChild(replys[i]);
						
					}
					var padre=G.dom.$("repliesMsgPriv"+this.post.id);
					padre.innerHTML+=this.JSON.resultado;
					$(".replyMsgPriv").click(lfxrmp);
					for ( var i = 0; i < replys.length; i++) {
						padre.appendChild(replys[i]);
					}
					if(mr){
						padre.appendChild(mr);
					}
				}
			}
		});
		a.enviar();
		}
	}
}

function sendDelete(id){
	var a=new G.ajax({
		pagina:"ajax/msjprivados.php",
		post:{
			id:id,
			accion:"delete"
		},
		json:true,
		accion:function(){
			if(this.JSON.success==true){
				$("#privMsgGral"+this.post.id).fadeOut("slow",function(){
					this.parentNode.removeChild(this);
				});
			}
		}
	});
	a.enviar();
}

function verMasReply(id){
	var a=new G.ajax({
		pagina:"ajax/msjprivados.php",
		post:{
			id:id,
			i:this.getAttribute("rel"),
			accion:"more"
		},
		json:true,
		vmas:this,
		accion:function(){
			if(this.JSON.success==true){
				if(this.JSON.success==true){
					this.vmas.parentNode.removeChild(this.vmas);
					var padre=G.dom.$("repliesMsgPriv"+this.post.id);
					$(".replyMsgPriv").click(lfxrmp);
					padre.innerHTML+=this.JSON.resultado;
					var total=parseInt(this.JSON.total,10);
					total=(isNaN(total)?0:total);
					var inicio=parseInt(this.vmas.getAttribute("rel"),10);
					total=Math.ceil(total/10)*10;
					if((inicio+10)<=total){
					padre.appendChild(this.vmas);
					inicio=(isNaN(inicio)?0:inicio );
					inicio+=10;
					this.vmas.setAttribute("rel",inicio);
					}
				}
			}
		}
	});
	a.enviar();
}

</script>