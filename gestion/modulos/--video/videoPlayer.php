				
				
				
				<? 
				$iFv=$_POST['iFvpu_pOkuOk_n_ph_uN_pN'];
				
				$idProfile=addslashes(base64_decode($iFv[2]));
				$idUser=addslashes(base64_decode($iFv[3]));
				echo '<div class="titVideo">'.addslashes(base64_decode($iFv[6])).'</div>';
				?>
				
				<script type="text/javascript">
					///ratesVote///
					iPuV=new Array();
					iPuV.push('<? echo base64_encode($idProfile); ?>');
					iPuV.push('<? echo base64_encode($idUser); ?>');
					iPuV.push('<? echo base64_encode(0); ?>');
				</script>
				
				<div class="onright"><a href="javascript:;" onclick="hide_me('videoPlayer'); ratesVote(iPuV); $('#modules').css('margin-top','0px');">Close</a></div> 
				
				<div id="vid"></div>
				
				<script type="text/javascript">
	   
	   
				 
    			 var flashvars = { file:'<? echo addslashes(base64_decode($iFv[0])); ?>&image=photoVideo/<? echo addslashes(base64_decode($iFv[7])); ?>&logo=img/logoSoccermashLOW.png&logo.position=top-right&logo.hide=false&logo.link=http://www.soccermash.com/&streching=exactfit'};
				 var params = { allowfullscreen:'true', allowscriptaccess:'always' };
				 var attributes = { id:'player1', name:'player1' };
					
				 swfobject.embedSWF('gestion/modulos/video/JWPlayer/player-licensed.swf','vid','589','331','9.0.115','false',
				 flashvars, params, attributes);
				 
				 
				 /*
				 flowplayer("vid", "gestion/modulos/video/flowplayer-3.2.7.swf",{
					clip:'<? //echo $_POST['file']; ?>'
				 });*/
				 
				 </script>
				 
				 	
				
				
				
				
				<?php
				require_once('videoVotesViews.php');
				?>


