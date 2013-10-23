				
				
				
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
				
				
				
				
				<div class="vidContain">
				
					 
					<div id="vid"></div>


					<script type='text/javascript'>
					  jwplayer('vid').setup({
						'flashplayer': 'gestion/modulos/video/JWPlayer/player.swf',
						'file': '<? echo addslashes(base64_decode($iFv[0])); ?>',
						'image': 'photoVideo/<? echo addslashes(base64_decode($iFv[7])); ?>',
						'controlbar': 'over',
						'width': '589',
						'height': '331'
					  });
				</script>
				
				</div>
				

				
				
				<?php
				require_once('videoVotesViews.php');
				?>


