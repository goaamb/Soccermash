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
	function addNotiRepresent(){
		$('#alertEmergenteDatos').html('');
		$('#alertEmergenteDatos').load('gestion/modulos/home/msgs/sendRepresent.php');
		$('#alertEmergente').show();
		$('#alertEmergente0').show();
	}
	</script>
	
<div id="menuProfile">
  <ul>
<?php
  if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 || $_SESSION["idUserVisiting"]==$_SESSION["iSMuIdKey"] ){#is not idUserVisiting
 		?><li style="margin-bottom: 20px;height: auto;padding: 0px;left: 0;position: relative;width: auto;"><div style="text-align: left;margin-left: 5px;color: #4D4D4D;font-size: 11px;position: absolute;margin-top: -16px;"><?php print $_IDIOMA->traducir("Sponsor/s");?></div><a id="aMySponsor" href="#" onclick="ventanaMiAuspiciante(); return false;" style="width: auto;height: auto;padding: 0;"><img id="imgMySponsor" src="<?php
 		 $mlgr=ModelLoader::crear("ax_generalRegister");
 		 $mlgr->buscarPorCampo(array("id"=>$_SESSION["iSMuIdKey"] ));
 		 $dir="/goaamb/images/publi/thumb/";
 		 if(is_file($_GBASE.$dir.$mlgr->miAnunciante)){
 		 	print $dir.$mlgr->miAnunciante;
 		 }else{
 		 	print "img/sponsor.jpg";
 		 }
 		?>"/></a></li><?php
 }else{
 		$mlgr=ModelLoader::crear("ax_generalRegister");
 		 $mlgr->buscarPorCampo(array("id"=>$_SESSION["idUserVisiting"] ));
 		 $dir="/goaamb/images/publi/thumb/";
 		 if(is_file($_GBASE.$dir.$mlgr->miAnunciante)){
 			?><li style="margin-bottom: 20px;height: auto;padding: 0px;left: 0;position: relative;width: auto;"><div style="text-align: left;margin-left: 5px;color: #4D4D4D;font-size: 11px;position: absolute;margin-top: -16px;"><?php print $_IDIOMA->traducir("Sponsor/s");?></div><img id="imgMySponsor" src="<?php
 		 		print $dir.$mlgr->miAnunciante;
 		 	?>"/></li><?php
 		 } 		
 	} 
?>
  <div id="statusFriend"> 
 <?php
 

if(isset($_SESSION["idUserVisiting"])){
	if(($_SESSION["idUserVisiting"]!=$_SESSION["iSMuIdKey"]) && ($_SESSION["idUserVisiting"] != 0)){#user visitante
			
			
			
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
		

	}#user visitante
	
	
}#$_SESSION["idUserVisiting"]
 	
 echo '</div>';

 /*  ******* NEW modulo Agent ++++ */
 if(isset($_SESSION["idUserVisiting"])){
	if(($_SESSION["idUserVisiting"]!=$_SESSION["iSMuIdKey"]) && ($_SESSION["idUserVisiting"] != 0)){#user visitante
		
		
		if(isset($_SESSION["isAgent"])&&($_SESSION["isAgent"]==1)&&isset($_SESSION["playerAgent"])&&($_SESSION["playerAgent"]==1)&&isset($_SESSION["sentRepresented"])&&($_SESSION["sentRepresented"]==1)){#si un agent esta visitando un player sin representante
					#todas las var de session estan definidas en el home	
					echo '<li><span class="bdBreak"></span><a id="represent" href="#" onclick="addNotiRepresent(); return false;"><em id="representI"></em><div id="myText">'.$_IDIOMA->traducir("Represent").'</div></a><span class="bgShdw"></span></li>';
		}
		
	}
 }	
 /*  ******* NEW modulo Agent ++++ */
#Edit profile
 	if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 || $_SESSION["idUserVisiting"]==$_SESSION["iSMuIdKey"] ){#is not idUserVisiting
 		if(!isset($_SESSION["editProfile"]) || $_SESSION["editProfile"]==false){
 		
			echo '<li><span class="bdBreak"></span><a id="edition" href="#" onclick="JS_EditProfile(); return false;"><em id="editionI"></em>'.$_IDIOMA->traducir("Edit this profile").'</a><span class="bgShdw"></span></li>';	
			
 		}else{
		
 			echo '<li><span class="bdBreak"></span><a id="edition" href="#" onclick="JS_QuitEdit(); return false;" class="now"><em id="editionI"></em>'.$_IDIOMA->traducir("Editable Mode On").'</a><span class="bgShdw"></span></li>';
			
 		}
 		
 	}
 	if(isset($_SESSION["bSavedPlayer"]) && $_SESSION["bSavedPlayer"]==true){
 		echo '<li><span class="bdBreak"></span><a style="background-image: none;background-color: #F6B720;color: white;" id="edition" href="#" onclick="JS_EditProfilePlayer(); return false;"><em id="editionI"></em>'.$_IDIOMA->traducir("Edit this profile").'</a><span class="bgShdw"></span></li>';
 		
 	}
 #Send Messagge
 	if( !isset($_SESSION["idUserVisiting"]) || $_SESSION["idUserVisiting"]==0 || $_SESSION["idUserVisiting"]==$_SESSION["iSMuIdKey"] ){#is not idUserVisiting
 		
 			?>
 			<li><span class="bdBreak"></span><a id="advertis" href="#" onclick="advertismentOpen();return false;"><em id="advertisI"></em><?php print $_IDIOMA->traducir("Advertisement");?></a><span class="bgShdw"></span></li>
		<li><span class="bdBreak"></span><a href="#" onclick="InviteFriendsOpen(); return false;"><em id="inviteBtn"></em><?php print $_IDIOMA->traducir("Invite your Friends");?></a><span class="bgShdw"></span></li>
 			<li><span class="bdBreak"></span><a id="smtgWrong" href="#"><em id="smtgWrongI"></em><?php print $_IDIOMA->traducir("Report an error");?></a><span class="bgShdw"></span></li><?php	
 	}else{
 			echo '<li><span class="bdBreak"></span><a id="sndMsg" href="#"><em id="sndMsgI"></em>'.$_IDIOMA->traducir("Send message").'</a><span class="bgShdw"></span></li>
        		  <li><span class="bdBreak"></span><a id="smtgWrong" href="#"><em id="smtgWrongI"></em>'.$_IDIOMA->traducir("Report an error").'</a><span class="bgShdw"></span></li>';
 	}
 	
 ?>
  </ul>
  </div>