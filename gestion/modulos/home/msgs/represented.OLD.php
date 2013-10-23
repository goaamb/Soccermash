<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/site_ini.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/share/clases/class_site.inc.php');


$iIdUser	 = $_SESSION["iSMuIdKey"];
global $SITE; 
$SITE        = new SITE();
$iEstado     ='active=1';
$iComplete   ='complete=1';
$aUsuario = $SITE->getUsuario(NULL, "id='$iIdUser'");
$aNotification = $SITE->getRepresentedPlayer($iIdUser);

if($aNotification!=false){
	$sSqlId =  implode("','", $aNotification);
	$aRequestes = $SITE->getUsuarios(NULL, "id IN ('$sSqlId')". " AND ". $iEstado. " AND ".$iComplete);

			

?><!-- //////////////All the Represented Notifications ////////////// -->

<div class="theMsgsS" id="theMsgsS">
	<div class="msgsTitle" style="background: none;"><?php print 'Represent';//$_IDIOMA->traducir("Agent");?></div>
	<?php
		$i=0;
		$iCountRepre=count($aRequestes);
		foreach($aRequestes as $aRequest){
				
				/////Move the img to center thumb//////////
				$aImPhoto=array();
				$aImPhoto=@getimagesize('../photoGeneral/small/small_'.$aRequest['photo']);
								    
				if($aImPhoto[0]>50){
					$moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).'px;';
				}else{
				     $moveLeft='';
				}
								    
								    
				if($aImPhoto[1]>50){
				     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).'px;';
				}else{
				     $moveTop='';
				}	
	?>
				
				<!-- //////////////Start msg//////////////////// -->
				<div class="flwCont flwContNew" id="flwContII<?php echo $i;?>">
					<div class="borMsg"></div>

					<div>
					
					<div class="fotPeqF"  style="<?php echo $moveLeft;?>">
						<img class="bordersRed" title="<?php echo $aRequest['name'].' ',$aRequest['lastName'];?>" src="photoGeneral/small/small_<?php echo $aRequest['photo'];?> " >
					</div>
				
					</div>

					<div class="theMsgText">
					<div class="nameMsg" onclick="JS_User(); return false;" title="<?php echo $aRequest['name'].' ',$aRequest['lastName'];?>"><?php echo $aRequest['name'].' ',$aRequest['lastName'];?></div>
					, wants to be your agent.
					</div><!-- <div class="dateMsg">Less than a minute ago</div> -->
					<a class="linksF decline" onclick="JS_hideInvitationRepre('flwContII<?php echo $i;?>'); JS_removeNotiAgent(<?php echo $aRequest['id'];?>);return false;" href="javascript:;"><?php print 'Reject';//$_IDIOMA->traducir("Reject");?></a>
					<a class="linksR accept" onclick="acceptNotiRepresent(<?php echo $aRequest['id'];?>,<?php echo $i;?>,'<?php echo $aRequest['name'];?>','<? echo $aRequest['lastName'];?>'); return false;" href="javascript:;"><?php print 'Terms';//$_IDIOMA->traducir("OK");?></a>
					</div>

<?php $i++; }#foreach?>
	
	<input type="hidden" name="cantMSjRepre" id="cantMSjRepre" value="<?=$iCountRepre;?>"/>
	<!-- ///Footer for msg with advices/// -->
	<div class="footMsg">
    	 <!-- <div class="seeAllMsg"><a href="javascript:;" onClick="">View more messages</a></div> --> 

		
		<!-- ///Start Advice/// (max 2 advices) -->
      <div class="advMsg">
      		<!-- 
            <div class="imgAdv"><img class="bordersRed" width="50" src="img/fto-msg.png"></div>
			<div class="titAdv"><a href="javascript:;" onClick="">Liga BVWA</a></div>
			<div class="txtAdv"><a href="javascript:;" onClick="">www.ligabvwa.com</a></div>
			<div class="txtAdv2"><a href="javascript:;" onClick="">Juega con Marca</a></div>
			<div class="borderMsgAdv"></div>
			-->
       </div>
	   <!-- ///End advice/// -->


	</div>	
	<!-- ///End Footer/// -->
	
	<div class="advertisingWord"></div>
	<div class="shadMsg"></div>
	
	
	
	
	
	
	
</div>
<!-- //////////////End All messenges////////////// -->



<script type="text/javascript">
$(".flwCont").mouseover(function(){
		$(this).removeClass("flwContNew");
});

function JS_hideInvitationRepre(iIdMsjRepre){
	
	if( $('#cantMSjRepre').val()==1){
		$("#"+iIdMsjRepre).hide(); 
		$('.bgMsgsRp').hide(); 
		$('#alertsMsgs').hide();
		$('#numReceivedMsgFollowII').hide();
		$("#receivedMsgFollowII").removeClass('receivedMsgRepresent');
		$("#receivedMsgFollowII").addClass('noneMsgRepresent');
	}else{
		$("#"+iIdMsjRepre).hide();
		iCant=$('#numReceivedMsgFollowII').val();
		iCant--;
		$('#numReceivedMsgFollowII').val(iCant);
	}
	
}
function JS_hideAllNoti(){
	$('.bgMsgsRp').hide(); 
	$('#alertsMsgs').hide();
	$('#theMsgsS').hide();$('#numReceivedMsgFollowII').hide();
	$("#receivedMsgFollowII").removeClass('receivedMsgRepresent');
	$("#receivedMsgFollowII").addClass('noneMsgRepresent');
}	
function acceptNotiRepresent(id,n,name,last){
		$('#alertEmergenteDatos').html('');
		$('#alertEmergenteDatos').load('gestion/modulos/home/msgs/acceptRepresent.php?id='+id+'&n='+n+'&name='+name+'&last='+last);
		$('#alertEmergente').show();
		$('#alertEmergente0').show();
}
</script>

<?php }	//if($aNotification!=false)?>

