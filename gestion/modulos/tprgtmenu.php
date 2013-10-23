

<script>
function seeReceivedPublicationsOnWall(){

	$.ajax({
		url: dir3+"seeWallAlerts.php",
		data: 'type=seeViewed',
		type: 'POST',
		//dataType: 'json',
		success: function(data){
			if(data){
			
			$(".receivedMsgWallS").addClass('noneMsgWallS');
			$(".noneMsgWallS").removeClass('receivedMsgWallS');
			$(".numReceivedMsgWallS").css('display','none');
			}
		}
	});
}

$("#imgWallAlert").mouseover(function(){
  var newSrc = $(this).attr("src").replace("image.gif", "imageover.gif");
  $(this).attr("src", newSrc); 
});
$("#imgWallAlert").mouseout(function(){
  var newSrc = $(this).attr("src").replace("imageover.gif", "image.gif");
  $(this).attr("src", newSrc); 
});




	function opMsgW(){
		$("#privateMsgs").html('');
		$(".privBgMsgsWS").hide();
		$(".bgMsgsWS").toggle();
		
		if($("#alertsMsgs").html()!=''){
			$("#alertsMsgs").html('');
		}else{
			$("#alertsMsgs").load('gestion/modulos/home/msgs/msgs.php');
		}
		
	}
	
	function opMsgWPriv(){
		$("#alertsMsgs").html('');
		$(".bgMsgsWS").hide();
		$(".privBgMsgsWS").toggle();
		
		if($("#privateMsgs").html()!=''){
			$("#privateMsgs").html('');
		}else{
			$("#privateMsgs").load('gestion/modulos/home/msgs/privateMsgs.php');
		}
			
	}
</script>



 <!-- <div onclick="JS_User(); return false;"> -->
  <div id="tprgtmenu">
  
  <!--<span class="divisorMnu" id="divisorMnu1"></span>
  <span class="divisorMnu" id="divisorMnu2"></span>
  <span class="divisorMnu" id="divisorMnu3"></span>-->
  
	<a href="#" onclick="JS_User(); return false;"><div class="logo-div"></div></a>
	
	<?php 
		require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

	
		
		
	
	     if(isset($iCantMSj)){
		if($iCantMSj>0){
		  echo '<span class="privMsgReceived" title="'.$_IDIOMA->traducir("Received messages").'" onclick="opMsgWPriv();"></span>';
		  echo '<span class="numPrivMsgReceived" id="numPrivMsgReceived" title="'.$_IDIOMA->traducir("Received messages").'">'.$iCantMSj.'</span>';
		  echo '<span class="privBgMsgsWS"></span>';
		}else{
			 echo '<span class="privMsgNone" title="'.$_IDIOMA->traducir("Received messages").'" onclick="opMsgWPriv();"></span>';
			 echo '<span class="numPrivMsgReceived" id="numPrivMsgReceived"  title="'.$_IDIOMA->traducir("Received messages").'" style="display:none;">0</span>';
			  echo '<span class="privBgMsgsWS"></span>';
		}
	     }

	?>
	<!--<a href="#" onClick="javascript:seeReceivedPublicationsOnWall();" title="Comments on wall">-->
	<?php
	
	$oDB=new mysql;
	$oDB->connect();
	
	$MyProfileId=$_SESSION['iSMuProfTypeKey'];
	$MyUserId=$_SESSION['iSMuIdKey'];
	
	$table=selectTable($MyProfileId);
	$anexo='WallAlert';
	$tableWallAlert=$table.$anexo;
	
	$sSQL_Select=GenerateSelect('*',$tableWallAlert,'id_user='.$_SESSION['iSMuIdKey'].' AND viewed=1');
	if($DB_Result = $oDB->query($sSQL_Select)){
		$total=mysql_num_rows($DB_Result);
			if($total != 0 ){
				echo '<span title="'.$_IDIOMA->traducir("Wall messeges").'" class="receivedMsgWallS" onclick="opMsgW();"></span>';
				echo '<span class="numReceivedMsgWallS">'.$total.'</span>';//Number of new messeges inside the div
				echo '<span class="bgMsgsWS"></span>';
			}else{
				echo '<span title="'.$_IDIOMA->traducir("Wall messeges").'" class="noneMsgWallS" onclick="opMsgW();"></span>';
				echo '<span class="bgMsgsWS"></span>';
			}
	
	}
	?>
	

       
      
      
      
      <ul id="nav">
	   <li><a href="#" onclick="setSearchMulti();"><? print $_IDIOMA->traducir("Multimedia"); ?></a></li>
      <li><a href="#"  onclick="JS_User(); return false;"><? print $_IDIOMA->traducir("Home"); ?></a>
      </li>
      <li><a href="#"><? print $_IDIOMA->traducir("Account"); ?></a>
        <ul>
		 
          <li><a id="openmydata" class="roundedcorners" href="#" ><? print $_IDIOMA->traducir("Preferences"); ?></a></li>
		  <li><a id="openhelp" href="#" ><? print $_IDIOMA->traducir("Help"); ?></a></li>
		  
        </ul>
      </li>
      <li><a href="#"  onclick="JS_logout(); return false;"><? print $_IDIOMA->traducir("Logout"); ?></a>
      </li>
	 
      </ul>   
  </div>
  <div id="alertsWall"></div>
  
  
  
  
  <script type="text/javascript">
	function setSearchMulti(){
		$("#storeSelectProfile").val('3');
		//hideAllProf();
		//$("#searchStep1").hide();
		//$("#srchMult").show();
		$('#storeSelectADVProfile').val('0');
		chkSrch();
	}
	function setSearchMultiPho(){
		$("#photoS").attr('checked','checked');
		$("#photoS").val('on');
		$("#videoS").removeAttr('checked');
		$("#storeSelectProfile").val('3');
		$('#storeSelectADVProfile').val('0');
		chkSrch();
	}
	function setSearchMultiVid(){
		$("#videoS").attr('checked','checked');
		$("#videoS").val('on');
		$("#photoS").removeAttr('checked');
		$("#storeSelectProfile").val('3');
		$('#storeSelectADVProfile').val('0');
		chkSrch();
	}
	
	function eraseChecked(){
			$("#photoS").removeAttr('value');
			$("#photoS").removeAttr('checked');
			$("#videoS").removeAttr('value');
			$("#videoS").removeAttr('checked');
	}
  </script>
