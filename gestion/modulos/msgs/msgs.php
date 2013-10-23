<?php
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/site_ini.php");









$oDB=new mysql;
$oDB->connect();
$oDB2=new mysql;
$oDB2->connect();

$MyProfileId=$_SESSION['iSMuProfTypeKey'];
$MyUserId=$_SESSION['iSMuIdKey'];

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


		if($result=$oDB->query($sSQL_Select1)){
		
		while($res = mysql_fetch_array($result)){
			$UIWMC=$res['id_userWhoMakeComment'];
			$SelectDFUWMC=GenerateSelect('id,name,lastName,photo','ax_generalRegister',"id=$UIWMC");
			$result2=$oDB->query($SelectDFUWMC);
			//var_dump($SelectDFUWMC);
			
			
		
					if(($res['id_comment']==NULL) OR ($res['id_comment']==0)){
						//echo "<br />Entro en id_publication<br />";
						
						$idpub=$res['id_publication'];
						$sSQL_Publication=generateSelect('*',$table.'Wall',"id=$idpub");
						//echo "<br />Consulta<br />";
						//var_dump($sSQL_Publication);
						//$DB_Result = $oDB->query($sSQL_Publication);
						while($ResOfPublication=mysql_fetch_array($DB_Result)){
							$pubCom=$ResOfPublication['publication'];
						//	echo "<br />PubCom<br />";
						//	var_dump($pubCom);
						}
					}else{
						//echo "<br />Entro en id_commen<br />";
						$idcom=$res['id_comment'];
						$sSQL_Comment=generateSelect('*',$table.'ReceivedComments',"idComment=$idcom");
						
						//echo "<br />Consulta<br />";
						//var_dump($sSQL_Comment);
						
						$DB_Result = $oDB->query($sSQL_Comment);
						while($ResOfComment=mysql_fetch_array($DB_Result)){
							$pubCom=$ResOfComment['comment'];
						//	echo "<br />PubCom<br />";
						//	var_dump($pubCom);
						}
					}
				
			
			while($res2 = mysql_fetch_array($result2)){
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
					<?php echo '<div style="'.$moveLeft.'">';?>
					<div class="fotPeq"><img class="bordersRed" title="<?php echo $res2['name'].' '.$res2['lastName']; ?>" onclick="JS_follower(<?php echo $res2['id']; ?>)" src="photoGeneral/small/small_<?php echo $res2['photo']; ?>"></div>
					<?php echo '</div>';?>

					<div class="theMsgText">
					<div class="nameMsg" onclick="JS_follower(<?php echo $res2['id']; ?>)" title="<?php echo $res2['name'].' '.$res2['lastName'].' '; ?>"><?php echo $res2['name'].' '.$res2['lastName'].' '; ?></div>
				<?php
			}
					switch($res['activity']){
						case 1:
							echo "Public this: ".substr($pubCom,0,35); if(strlen($pubCom) >= 36){ echo "..."; };
							echo " On Your Wall";
						break;
						case 2:
							echo "Comment this: ".substr($pubCom,0,35); if(strlen($pubCom) >= 36){ echo "..."; };
							echo " On A Publication";
							break;
						case 3:
							echo "Like Your Publication: ".substr($pubCom,0,35); if(strlen($pubCom) >= 36){ echo "..."; };
							break;
						case 4:
							echo "Like Your Comment: ".substr($pubCom,0,35); if(strlen($pubCom) >= 36){ echo "..."; };
							break;
					
					}
					
				
					
					?></div><?php
			
						
					
								
				?><div class="dateMsg"><?php echo ago($res['time']);?></div><?php
					
					?><div class="closeMsg" onClick="javascript:del(<?php echo $res['id']; ?>)" title="Delete this notification"></div></div>

	<!--<div class="readMsg"></div>-->					<?php
		}
	}

//onclick mostrar div con el viewalerts dentro, el cual ya esta cargado

?>


	
	
	
	
	
	
	<!-- ///Footer for msg with advices/// -->
	<div class="footMsg">
    	<!-- <div class="seeAllMsg"><a href="javascript:;" onClick="">See All Messages</a></div> -->

		
		<!-- ///Start Advice/// (max 2 advices) -->
      <div class="advMsg">
  <!--          <div class="imgAdv"><img class="bordersRed" width="50" src="img/fto-msg.png"></div>
 <div class="titAdv"><a href="javascript:;" onClick="">Liga BVWA</a></div>
<div class="txtAdv"><a href="javascript:;" onClick="">www.ligabvwa.com</a></div>
<div class="txtAdv2"><a href="javascript:;" onClick="">Juega con MArca</a></div>-->
<div class="borderMsgAdv"></div>
       </div>
	   <!-- ///End advice/// -->


	</div>	
	<!-- ///End Footer/// -->
	
	<div class="advertisingWord">Advertising</div>
	<div class="shadMsg"></div>
	
	
	
	
	
	
	
</div>
<!-- //////////////End All messenges////////////// -->



<script type="text/javascript">
/////////////////Messenges/////////////////////////////////////////
function del(id){
var ask=confirm("Really you want to delete this notifaction?");

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