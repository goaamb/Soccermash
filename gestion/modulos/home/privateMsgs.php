<?php
$dir = "/";
require_once $_SERVER ["DOCUMENT_ROOT"] . $dir . 'gbase.php';
$uid = $_SESSION ["iSMuIdKey"];
$mlsm = ModelLoader::crear ( "ax_sentMsj" );
$mlrm = ModelLoader::crear ( "ax_replyMsj" );
$mlu = ModelLoader::crear ( "ax_generalRegister" );
$mlu->buscarPorCampo ( array ("id" => $uid ) );
$mlur = ModelLoader::crear ( "ax_generalRegister" );
$mlus = ModelLoader::crear ( "ax_generalRegister" );
$lista = $mlsm->listar ( "idUserSend='$uid' or idUserRecived='$uid' order by date desc,idmsj desc", 0, 10 );
$total = $mlsm->contar ( "idUserSend='$uid' or idUserRecived='$uid'" );
function processText($text, $reduc = -1) {
	$reduc = intval ( $reduc );
	if (intval ( $reduc ) > 0 && strlen ( $text ) > $reduc) {
		$text = substr ( $text, 0, $reduc ) . "...";
	}
	return nl2br ( htmlentities ( utf8_decode ( $text ) ) );
}
?>
<div class="theMsgsSPriv">
<div class="msgsTitle"></div>
<?php
foreach ( $lista as $mensaje ) {
	$prevmsj = processText ( $mensaje->txtmsj, 50 );
	$mensaje->txtmsj = processText ( $mensaje->txtmsj );
	if ($mlrm->existePorCampo ( array ("checkit" => "0", "idMsjSent" => $mensaje->idmsj ) )) {
		$mensaje->checkit = 0;
	}
	if ($mensaje->idUserSend == $uid) {
		unset ( $mlus );
		$mlus = clone $mlu;
		$mlur->buscarPorCampo ( array ("id" => $mensaje->idUserRecived ) );
	} else {
		unset ( $mlur );
		$mlur = clone $mlu;
		$mlus->buscarPorCampo ( array ("id" => $mensaje->idUserSend ) );
	}
	
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

<div class="fotPeq"><img class="bordersRed" width="50"
	src="<?php
	print "photoGeneral/small/small_" . $mlus->photo;
	?>"
	onclick="return JS_follower(<?php
	print $mlus->id;
	?>);"></div>

<div class="theMsgText"
	id="theMsgTextMsg<?php
	print $mensaje->idmsj;
	?>">
<div class="nameMsg" onclick=""><?php
	if ($mensaje->idUserSend == $uid) {
		print "( Sent ) ";
	} else {
		print "( Received ) ";
	}
	print $mlus->name . " " . $mlus->lastname;
	?> -> <?php
	print $mlur->name . " " . $mlur->lastname;
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

<div class="inputReplyMsgPriv"><textarea class="inpRplyPriv"
	id="inpRplyPriv<?php
	print $mensaje->idmsj;
	?>"></textarea></div>

<div class="repliBtnPriv"
	onclick="sendReply('<?php
	print $mensaje->idmsj;
	?>');">Reply</div>
<?php
	$listarep = $mlrm->listar ( "idMsjSent='$mensaje->idmsj' order by date desc, idMsjReply desc", 0, 10 );
	$totalrep = $mlrm->contar ( "idMsjSent='$mensaje->idmsj'" );
	foreach ( $listarep as $reply ) {
		$mlus->buscarPorCampo ( array ("id" => $reply->idUserReply ) )?>

<div class="replyMsgPriv"
	id="replyMsgPriv<?php
		print $reply->idMsjReply;
		?>"
	onclick="desplegRplPriv('<?php
		print $reply->idMsjReply;
		?>');">
<div original-title="" class="borMsg"></div>
<div original-title="" class="fotPeq"><img width="50" original-title=""
	onclick="return JS_follower(<?php
		print $mlus->id;
		?>);"
	class="bordersRed"
	src="<?php
		print "photoGeneral/small/small_" . $mlus->photo;
		?>"></div>

<div style="color: rgb(187, 187, 187);" original-title=""
	class="theMsgText">
<div original-title="" class="nameMsg" onclick=""><?php
		print $mlus->name . " " . $mlus->lastname;
		?></div>
<?php
		print nl2br ( htmlentities ( $reply->txtMsjReply ) );
		?></div>
<div class="dateMsg" original-title=""><?php
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
<!-- end reply + input --></div>
<!-- ////////End msg/////// END REPEAT THIS ////////// -->
<?php
}
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<!-- ///Footer for msg with advices/// -->
<div class="footMsg">
<div class="seeAllMsg"><a href="javascript:;" onClick="">See All
Messages</a></div>


<!-- ///Start Advice/// (max 2 advices) -->
<div class="advMsg">
<div class="imgAdv"><img class="bordersRed" width="50"
	src="img/fto-msg.png"></div>
<div class="titAdv"><a href="javascript:;" onClick="">Liga BVWA</a></div>
<div class="txtAdv"><a href="javascript:;" onClick="">www.ligabvwa.com</a></div>
<div class="txtAdv2"><a href="javascript:;" onClick="">Juega con MArca</a></div>
<div class="borderMsgAdv"></div>
</div>
<!-- ///End advice/// --></div>
<!-- ///End Footer/// -->

<div class="advertisingWord">Advertising</div>
<div class="shadMsg"></div>







</div>
<!-- //////////////End All messenges////////////// -->










<script src="goaamb/js/G.js" type="text/javascript"></script>
<script type="text/javascript">
/////////////////Messenges/////////////////////////////////////////
$(".msgContPriv").mouseover(function(){
		$(this).find('.theMsgText').css('color','#FFFFFF');
								
});
$(".msgContPriv").mouseleave(function(){
		$(this).find('.theMsgText').css('color','#BBBBBB');								
});	






/////// Hide and Show replies /////////////
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


//////////////////////////////////////////////////////////////////
/////////////////Replies/////////////////////////////////////////
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
					padre.appendChild(this.vmas);
					var inicio=parseInt(this.vmas.getAttribute("rel"),10);
					inicio=(isNaN(inicio)?0:inicio );
					var total=parseInt(this.JSON.total,10);
					total=(isNaN(total)?0:total);
					this.vmas.setAttribute("rel",total);
				}
			}
		}
	});
	a.enviar();
}

</script>