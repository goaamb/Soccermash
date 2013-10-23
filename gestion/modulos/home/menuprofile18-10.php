  <script>
	$('#edition').toggle(function(){
		$(this).html('<em id="editionI"></em><?php print ($_IDIOMA->traducir("Editable Mode On")); ?>');
	}, function(){
		$(this).html('<em id="editionI"></em>Editable Mode Off').removeClass("now");	
	});
	
	function overFriend(){
		
		$('#myTextFriend').html('<?php print ($_IDIOMA->traducir("Remove Friend")); ?>');
		$('#follow').addClass("remf");
		$('#follow').removeClass("now");
	}
	function mouseleaveFriend(){
	
		
		$('#myTextFriend').html('<?php print ($_IDIOMA->traducir("Friend")); ?>');
		$('#follow').addClass("now");
		$('#follow').removeClass("remf");
	}
	</script>
	
<div id="menuProfile">
  <ul>

  <div id="statusFriend"> 
 <?php
 

if(isset($_SESSION["idUserVisiting"])){
	if(($_SESSION["idUserVisiting"]!=$_SESSION["iSMuIdKey"]) && ($_SESSION["idUserVisiting"] != 0)){
			
			
			
			$myId=(int)$_SESSION["iSMuIdKey"];
			$sSQL_Select=generateSelect('history_follower','ax_follower',"id_user=$myId");
			#var_dump($sSQL_Select);
			
			$selectAllMyFollowers=$oDB->query($sSQL_Select);
			while($res=mysql_fetch_array($selectAllMyFollowers)){
				$arreglo=$res['history_follower']."<br >";
			};
			
			
			$selectAllMyFollowers=array();
			$selectAllMyFollowers=unserialize($arreglo);
			
			$iCantTotal=sizeof($selectAllMyFollowers['id']);

			$idVisiting=(int)$_SESSION['idUserVisiting'];
			$i=0;
			$you=FALSE;
			while($i<$iCantTotal){
				if(isset($selectAllMyFollowers['id'][$i]) &&$idVisiting==$selectAllMyFollowers['id'][$i]){
				$you=TRUE;
				break;
				}else{
				$you=FALSE;
				}
			$i++;
		}?>
		<script>
$(document).ready(function(){
	


	<?php if($you){?>
	$('#follow').hover(function(){
		//alert("hover");
		$('#myTextFriend').html('<?php print ($_IDIOMA->traducir("Remove Friend")); ?>');
		$('#follow').addClass("remf");
		$('#follow').removeClass("now");
	});
	
	$('#follow').mouseleave(function(){
		//alert("out");
		$('#myTextFriend').html('<?php print ($_IDIOMA->traducir("Friend")); ?>');
		$('#follow').addClass("now");
		$('#follow').removeClass("remf");
	});<?php }?>
})
</script>
		<?php 
		if($you){
			echo '  <li><span class="bdBreak"></span><a id="follow" onclick="JS_removeFollower(); return false;" class="now" href="#"><em id="followII"></em><div id="myTextFriend">'.$_IDIOMA->traducir("Friend").'</div></a><span class="bgShdw"></span></li>';
		}else{
			echo '  <li><span class="bdBreak"></span><a id="follow" onclick="JS_addFollower(); return false;" href="#"><em id="followII"></em><div id="myTextFriend">'.$_IDIOMA->traducir("Add Friend").'</div></a><span class="bgShdw"></span></li>';
		}		
	} 
	

	
}
		

 	
 echo '</div>';
 

#Edit profile
 	if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 || $_SESSION["idUserVisiting"]==$_SESSION["iSMuIdKey"] ){#is not idUserVisiting
 		if(!isset($_SESSION["editProfile"]) || $_SESSION["editProfile"]==false){
 		
			echo '<li><span class="bdBreak"></span><a id="edition" href="#" onclick="JS_EditProfile(); return false;"><em id="editionI"></em>'.$_IDIOMA->traducir("Edit this profile").'</a><span class="bgShdw"></span></li>';	
			
 		}else{
		
 			echo '<li><span class="bdBreak"></span><a id="edition" href="#" onclick="JS_QuitEdit(); return false;" class="now"><em id="editionI"></em>'.$_IDIOMA->traducir("Editable Mode On").'</a><span class="bgShdw"></span></li>';
			
 		}
 			
 	}
 #Send Messagge
 	if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 || $_SESSION["idUserVisiting"]==$_SESSION["iSMuIdKey"] ){#is not idUserVisiting
 		
 			echo ' <li><span class="bdBreak"></span><a id="smtgWrong" href="#"><em id="smtgWrongI"></em>'.$_IDIOMA->traducir("Report an error").'</a><span class="bgShdw"></span></li>';	
 	}else{
 			echo '<li><span class="bdBreak"></span><a id="sndMsg" href="#"><em id="sndMsgI"></em>'.$_IDIOMA->traducir("Send message").'</a><span class="bgShdw"></span></li>
        		  <li><span class="bdBreak"></span><a id="smtgWrong" href="#"><em id="smtgWrongI"></em>'.$_IDIOMA->traducir("Report an error").'</a><span class="bgShdw"></span></li>';
 	}
 	
 
 ?>

  </ul>
  <!--<div id="chat"><span id="online">Online($var)</span><span id="config"><h5>Conf.</h5></span><span id="open"><h5>Open</h5></span></div>-->
</div><!--close menuProfile-->













