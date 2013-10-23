<?php
//////////////Require necesary files//////////////
$dir='';

//require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/VideoClass.php');
//require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoUserVoteClass.php');

require_once('videoClass.php');
require_once('videoUserVoteClass.php');


/*echo $_POST['idUser'];
echo $_POST['idUserOk'];
echo $_POST['idProfile'];
echo $_POST['idProfileOk'];*/


?>				
				
				
				<div id="votesHolder">
					
					<? 
					$vid2=new Video();
					$registros=$vid2->selectVideo($idProfile,'id,vote,voteValue,visit,comment',"id='".addslashes(base64_decode($iFv[1]))."'","id desc");

					#sets the width of the green stars div
					if(round($registros[0]->voteValue/$registros[0]->vote) == 0){
					
					}elseif(round($registros[0]->voteValue/$registros[0]->vote) < 2){
					
						$width='21px';
						
					}elseif(round($registros[0]->voteValue/$registros[0]->vote) < 3){
					
						$width='42px';
						
					}elseif(round($registros[0]->voteValue/$registros[0]->vote) < 4){
					
						$width='63px';
						
					}elseif(round($registros[0]->voteValue/$registros[0]->vote) < 5){
					
						$width='84px';
						
					}else{
					
						$width='107px';
						
					}
					
					?>
					
					
					<!-- /////////Stars from Votes///////////// -->
					<div id="voteTitle">VOTE</div>
					<div id="starsBlack"></div>
					<div id="stars" style="width:<? echo $width; ?>;"></div>
					
			
			
			
			
			
			<?	
			/////////////////Check if the user has voted this video//////////////////
			$vidUserVote= new VideoUserVote();
			$registrosUserVote=$vidUserVote->selectVideoUserVote("idVideo",'idUser="'.$_SESSION["iSMuIdKey"].'"',"id desc");

			$voted='no';
			if($registrosUserVote[0]!=''){
				
				
				 $serialVid=explode(',',$registrosUserVote[0]->idVideo);
				 
					foreach($serialVid as $serVid){
						
						if($serVid==addslashes(base64_decode($iFv[1]))){
							$voted='yes';
						}
					}//for
				
			}///if
			
			//echo 'voted: ',$voted;
			/////////check if voted///////////////
			if($voted=='no'){
			//$iFv=$_POST['iFvpu_pOkuOk_n_ph_uN_pN'];
			?>
			
			<script type="text/javascript">
			function beforeVoting(val){
				if(val==1){
					valore='<? echo base64_encode(1); ?>';
				}else if(val==2){
					valore='<? echo base64_encode(2); ?>';
				}else if(val==3){
					valore='<? echo base64_encode(3); ?>';
				}else if(val==4){
					valore='<? echo base64_encode(4); ?>';
				}else if(val==5){
					valore='<? echo base64_encode(5); ?>';
				}
				
				var vFvpu_pOkuOk_n_ph_va_uN_pN=new Array();
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[0] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[1] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[2] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[3] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[4] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[5] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[6] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[7] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push(valore);
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[8] ?>');
				vFvpu_pOkuOk_n_ph_va_uN_pN.push('<? echo $iFv[9] ?>');
				
				voteVideo(vFvpu_pOkuOk_n_ph_va_uN_pN);
			}
			</script>
					
			<!-- ////////Stars for voting ///////////// -->
			<div id="star1" onmouseover="showStar('star1');" onmouseout="hideStar('star1');" onclick="beforeVoting(1);"></div>
			
			<div id="star2" onmouseover="showStar('star2');" onmouseout="hideStar('star2');" onclick="beforeVoting(2)"></div>
			
			<div id="star3"  onmouseover="showStar('star3');" onmouseout="hideStar('star3');" onclick="beforeVoting(3)"></div>
			
			<div id="star4"  onmouseover="showStar('star4');" onmouseout="hideStar('star4');" onclick="beforeVoting(4)"></div>
			
			<div id="star5"  onmouseover="showStar('star5');" onmouseout="hideStar('star5');" onclick="beforeVoting(5)"></div>
			
					
			<!-- vota progress -->		
			<div id="votaProgress"></div>		
					
			
			<?
			}//if voted
			?>
			
			
					<!-- vota progress -->		
					<div id="votaProgress"></div>		
					
					<script type="text/javascript">
					
					var iUpvNpN=new Array();
					iUpvNpN.push('<? echo $iFv[5]; ?>');
					iUpvNpN.push('<? echo $iFv[4]; ?>');
					iUpvNpN.push('<? echo $iFv[1]; ?>');
					iUpvNpN.push('<? echo $iFv[8]; ?>');
					iUpvNpN.push('<? echo $iFv[9]; ?>');
					iUpvNpN.push('<? echo base64_encode(1); ?>');
					iUpvNpN.push('<? echo $iFv[10]; ?>');
					iUpvNpN.push('<? echo $iFv[11]; ?>');
					</script>
					
					<div><a style="color:#000000;" href="javascript:;" onclick="loadComment(iUpvNpN)">COMMENTS</a> <span id="cantComment"><? echo $registros[0]->comment;?></span><span id="videoFoot">/ VOTES <? echo $registros[0]->vote;?> / VIEWS <? echo $registros[0]->visit;?></span></div>
					
					<div id="saveComment"></div>
					<div id="loadComment"></div>
				
				
				
				
				</div><!-- div all -->
				

