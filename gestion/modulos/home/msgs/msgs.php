<?php
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");
require_once $_GBASE . "/goaamb/anuncio.php";








$oDB=new mysql;
$oDB->connect();
$oDB2=new mysql;
$oDB2->connect();

$MyProfileId=(int)$_SESSION['iSMuProfTypeKey'];
$MyUserId=(int)$_SESSION['iSMuIdKey'];

$table=selectTable($MyProfileId);
$anexo='WallAlert';
$tableWallAlert=$table.$anexo;
$sSQL_Select=GenerateSelect('*',$tableWallAlert,"id_user=$MyUserId and viewed=1");
if($DB_Result = $oDB->query($sSQL_Select)){
		$total=mysql_num_rows($DB_Result);
}
//var_dump($sSQL_Select);
//echo "Total $total";

if($total == 0){
	$sSQL_Select1=GenerateSelect('*',$tableWallAlert,"id_user=$MyUserId AND viewed=0 AND hidden=1 ORDER BY time DESC limit 0,5");
//var_dump($sSQL_Select1);
	//echo "entro en 1";
}else if($total > 0){
	//echo "entro en 0";
	$sSQL_Select1=GenerateSelect('*',$tableWallAlert,"id_user=$MyUserId AND viewed=1 ORDER BY time DESC");
//var_dump($sSQL_Select1);
}

?><!-- //////////////All the messenges////////////// -->

<div class="theMsgsS">
	<div class="msgsTitle"></div>
<?php

$mlgr=new ModelLoader("ax_generalRegister");
$mlrc=new ModelLoader($table."ReceivedComments");
$mlpub=new ModelLoader($table."Wall");
		if($result=$oDB->query($sSQL_Select1)){
		
		while($res = mysql_fetch_array($result)){
			ob_start();
			$UIWMC=$res['id_userWhoMakeComment'];
			$SelectDFUWMC=GenerateSelect('id,name,lastName,photo','ax_generalRegister',"id=$UIWMC");
			$result2=$oDB->query($SelectDFUWMC);
			//var_dump($SelectDFUWMC);
			
			$pubCom="";
		if(false)//ya no se muestran los contenidos de los mensajes
		{
					if(($res['id_comment']==NULL) OR ($res['id_comment']==0)){
					//echo "idComment<br />";
					//var_dump($res['id_comment']);
					//echo "idPublication<br />";
					//var_dump($res['id_publication']);
						$idpub=$res['id_publication'];
						$sSQL_Publication=generateSelect('*',$table.'Wall',"id=$idpub");
						$DB_Result = $oDB->query($sSQL_Publication);
						while($ResOfPublication=mysql_fetch_array($DB_Result)){
							$pubCom=$ResOfPublication['publication'];
						}
						if(!$pubCom){
							$idotro=$res["id_user"];
							if($idotro==$MyUserId){
								$idotro=$res["id_userWhoMakeComment"];
							}
							if($mlgr->buscarPorCampo(array("id"=>$idotro))){
								$tablax=selectTable($mlgr->profileid);
								$mlrc=new ModelLoader($tablax."Wall");
								$cuenta=$mlrc->listar("id='$idpub' order by id desc",0,1);
								if(count($cuenta)>0){
									$pubCom=$cuenta[0]->publication;
								}
							}
							if(!$pubCom){
								$tables=array("ax_agent","ax_club","ax_coach","ax_company","ax_fan","ax_federation","ax_journalist","ax_lawyer","ax_manager","ax_medic","ax_player","ax_scout");
								foreach ($tables as $tablax) {
									$mlrc=new ModelLoader($tablax."ReceivedComments");
									$cuenta=$mlrc->listar("idComment='$idcom' order by id desc",0,1);
									if(count($cuenta)>0){
										$pubCom=$cuenta[0]->comment;
										break;
									}
									unset($mlrc);
								}
							}
						}
					}else{
						$idcom=$res['id_comment'];
					//echo "idCom<br />";
					//var_dump($idcom);
						$sSQL_Comment=generateSelect('*',$table.'ReceivedComments',"idComment=$idcom and idUserWhoMakeComment='$UIWMC'");
						//var_dump($sSQL_Comment);
						$DB_Result = $oDB->query($sSQL_Comment);
						while($ResOfComment=mysql_fetch_array($DB_Result)){
							$pubCom=$ResOfComment['comment'];
						}
						if(!$pubCom){
							$idotro=$res["id_user"];
							if($idotro==$MyUserId){
								$idotro=$res["id_userWhoMakeComment"];
							}
							if($mlgr->buscarPorCampo(array("id"=>$idotro))){
								$tablax=selectTable($mlgr->profileid);
								$mlrc=new ModelLoader($tablax."ReceivedComments");
								$cuenta=$mlrc->listar("idComment='$idcom' and idUserWhoMakeComment='$UIWMC' order by id desc",0,1);
								if(count($cuenta)>0){
									$pubCom=$cuenta[0]->comment;
								}
							}
							if(!$pubCom){
								$tables=array("ax_agent","ax_club","ax_coach","ax_company","ax_fan","ax_federation","ax_journalist","ax_lawyer","ax_manager","ax_medic","ax_player","ax_scout");
								foreach ($tables as $tablax) {
									$mlrc=new ModelLoader($tablax."ReceivedComments");
									$cuenta=$mlrc->listar("idComment='$idcom' and idUserWhoMakeComment='$UIWMC' order by id desc",0,1);
									if(count($cuenta)>0){
										$pubCom=$cuenta[0]->comment;
									}
									unset($mlrc);
								}
							}
						}
					}
		}
			if(true ||(isset($pubCom) && $pubCom)){
			if($res2 = mysql_fetch_array($result2)){
				?>
				
				<!-- //////////////Start msg//////////////////// -->
				<div class="msgCont msgCont_<?php echo $res['id']; ?>" onclick="">
					<div class="borMsg"></div>
	
	<?php 
	#Photo procces
	$aImPhoto=array();
	$photo=$res2['photo'];
    $aImPhoto=@getimagesize($_SERVER['DOCUMENT_ROOT']."/photoGeneral/small/small_$photo");
    
    if($aImPhoto[0]>50){
     $moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).';';
    }else{
     $moveLeft='';
    }
    
    
    if($aImPhoto[1]>50){
     $moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).';';
    }else{
     $moveTop='';
    }
	
	
	?>
	
	

					<!-- ///Photo small. Aply the "move-left" function/// -->
					<div style="<?php echo ''.$moveLeft.'';?>">
					<div class="fotPeq"><img class="bordersRed" title="<?php echo $res2['name'].' '.$res2['lastName']; ?>" onclick="location.href='<?php print "/".$_IDIOMA->traducir("user")."/".$res2["id"]."-".Utilidades::normalizarTexto($res2["name"]." ".$res2["lastName"]);?>'" src="photoGeneral/small/small_<?php echo $res2['photo']; ?>"></div>
					</div>

					<div class="theMsgText">
					<div class="nameMsg"  onclick="location.href='<?php print "/".$_IDIOMA->traducir("user")."/".$res2["id"]."-".Utilidades::normalizarTexto($res2["name"]." ".$res2["lastName"]);?>'" title="<?php echo $res2['name'].' '.$res2['lastName'].' '; ?>"><?php echo $res2['name'].' '.$res2['lastName'].' '; ?></div>
				<?php
			}
					switch($res['activity']){
						case 1:
							echo $_IDIOMA->traducir("Publish this")." ".substr($pubCom,0,35); if(strlen($pubCom) >= 36){ echo "..."; };
							echo " ".$_IDIOMA->traducir("On Your Wall");
						break;
						case 2:
							echo $_IDIOMA->traducir("Comment this")." ".substr($pubCom,0,35); if(strlen($pubCom) >= 36){ echo "..."; };
							echo " ".$_IDIOMA->traducir("On A Publication");
							break;
						case 3:
							echo $_IDIOMA->traducir("Checked your Publication")." ".substr($pubCom,0,35); if(strlen($pubCom) >= 36){ echo "..."; };
							break;
						case 4:
							echo $_IDIOMA->traducir("Checked your Comment")." ".substr($pubCom,0,35); if(strlen($pubCom) >= 36){ echo "..."; };
							break;
					
					}
					
				
					
					?></div><?php
			}
						
					
								
				?><div class="dateMsg"><?php echo ago($res['time']);?></div><?php
					
					?><div class="closeMsg" onClick="javascript:del(<?php echo $res['id']; ?>)" title="<?php print $_IDIOMA->traducir("Delete this notification");?>"></div></div>

	<!--<div class="readMsg"></div>-->					<?php
	$notificacion=ob_get_clean();
	if(true || $pubCom){
		print $notificacion;
	}
		}
	}

//onclick mostrar div con el viewalerts dentro, el cual ya esta cargado

?>


	
	
	
	
	
	
	<!-- ///Footer for msg with advices/// -->
	<div class="footMsg">
    	<!-- <div class="seeAllMsg"><a href="javascript:;" onClick="">See All Messages</a></div> -->

		
		<!-- ///Start Advice/// (max 2 advices) -->
      <div class="advMsg"><?php
			$mlaxgen = ModelLoader::crear ( "ax_generalRegister" );
			if ($mlaxgen->buscarPorCampo ( array ("id" => $_SESSION ["iSMuIdKey"] ) )) {
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
	
	<div class="advertisingWord"><?php print $_IDIOMA->traducir("Advertising");?></div>
	<div class="shadMsg"></div>
	
	
	
	
	
	
	
</div>
<!-- //////////////End All messenges////////////// -->



<script type="text/javascript">
/////////////////Messenges/////////////////////////////////////////
function del(id){
var ask=confirm("<?php print $_IDIOMA->traducir("Really you want to delete this notification?");?>");

if(ask){
	$.ajax({
		url: dir3+"seeWallAlerts.php",
		data: 'type=delete&id='+id,
		type: 'POST',
		//dataType: 'json',
		success: function(data){
			if(data){
				$(".msgCont_"+id).fadeOut('800');
			}
		}
	});
}
}
$(".msgCont").mouseover(function(){
		$(this).find('.theMsgText').css('color','#FFFFFF');
		//alert('a ver');
									
});
$(".msgCont").mouseleave(function(){
		$(this).find('.theMsgText').css('color','#BBBBBB');
		//alert('out');							
});	

seeReceivedPublicationsOnWall();
</script>