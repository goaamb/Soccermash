<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/site_ini.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/share/clases/class_site.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/gestion/lib/share/clases/class_peopleNet.php');
require_once $_GBASE . "/goaamb/anuncio.php";
$iIdUser	 = $_SESSION["iSMuIdKey"];

#Friend Request
global  $oFollower;
$oFollower   = new PeopleNet();	
$aInvitation = $oFollower->getInvitation($iIdUser);
#User Data 
global $SITE; 
$SITE        = new SITE();
$iEstado     ='active=1';
$iComplete   ='complete=1';
if(is_array( $aInvitation) && count($aInvitation)>0){
	$sSqlId =  implode(",", $aInvitation);
}
else{
	$sSqlId="0";
}
$aRequestes = $SITE->getUsuarios(NULL, "id IN ($sSqlId)". " AND ". $iEstado. " AND ".$iComplete);
	

?><!-- //////////////All the Friends Notifications ////////////// -->

<div class="theMsgsS" id="theMsgsS">
	<div class="msgsTitle" style="background: none;"><?php print $_IDIOMA->traducir("Friends");?></div>
	<?php
		$i=0;
		$iCountFrd=count($aRequestes);
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
				<div class="flwCont flwContNew" id="flwCont<?php echo $i;?>">
					<div class="borMsg"></div>

					<div>
					
					<div class="fotPeqF"  style="<?php echo $moveLeft;?>">
						<img class="bordersRed" title="<?php echo $aRequest['name'].' ',$aRequest['lastName'];?>" src="photoGeneral/small/small_<?php echo $aRequest['photo'];?> " >
					</div>
				
					</div>

					<div class="theMsgText">
					<div class="nameMsg" onclick="JS_User(); return false;" title="<?php echo $aRequest['name'].' ',$aRequest['lastName'];?>"><?php echo $aRequest['name'].' ',$aRequest['lastName'];?></div>
					<?php print $_IDIOMA->traducir("added you as a friend");?>.
					</div><!-- <div class="dateMsg">Less than a minute ago</div> -->
					<a class="linksF decline" onclick="JS_hideInvitationFriend('flwCont<?php echo $i;?>');JS_deleteInvitation(<?php echo $aRequest['id'];?>); JS_removeFriend(<?php echo $aRequest['id'];?>);return false;" href="javascript:;"><?php print $_IDIOMA->traducir("Remove Friend");?></a>
					<a class="linksF accept" onclick="JS_hideInvitationFriend('flwCont<?php echo $i;?>');JS_deleteInvitation(<?php echo $aRequest['id'];?>); return false;" href="javascript:;"><?php print $_IDIOMA->traducir("OK");?></a>
					</div>

<?php $i++; }#foreach?>
	
	<input type="hidden" name="cantMSjFrd" id="cantMSjFrd" value="<?=$iCountFrd;?>"/>
	<!-- ///Footer for msg with advices/// -->
	<div class="footMsg">
    	 <!-- <div class="seeAllMsg"><a href="javascript:;" onClick="">View more messages</a></div> --> 

		
		<!-- ///Start Advice/// (max 2 advices) -->
      <div class="advMsg"><?php
			$mlaxgen = ModelLoader::crear ( "ax_generalRegister" );
			if ($mlaxgen->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) )) {
				$lista = Anuncio::listarAnuncios ( $mlaxgen, 1 );
				if (count ( $lista ) > 0) {
					Anuncio::insertarEstadisticaAnuncioTipo1 ( $lista [0], "Impresion", "2" );
					Anuncio::imprimirAnuncioTipo1 ( $lista [0], "2" );
				}
			}
			?></div>
	   <!-- ///End advice/// -->


	</div>	
	<!-- ///End Footer/// -->
	
	<div class="shadMsg"></div>
	
	
	
	
	
	
	
</div>
<!-- //////////////End All messenges////////////// -->



<script type="text/javascript">
$(".flwCont").mouseover(function(){
		$(this).removeClass("flwContNew");
});

function JS_hideInvitationFriend(iIdMsjFriend){
	
	if( $('#cantMSjFrd').val()==1){
		$("#"+iIdMsjFriend).hide(); $('.bgMsgsFL').css('display','none'); $('#alertsMsgs').hide();
	}else{
		$("#"+iIdMsjFriend).hide();
	}
	
}
</script>

