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
$idProfOk=$_SESSION["iSMuProfTypeKey"];
			#select the profile form the user who is voting
			if($idProfOk<7){
				$profileViewsOk=true;
			}elseif($idProfOk<13){
				$profileViewsOk=true;
			}elseif($idProfOk<16){
				$profileViewsOk=true;
			}elseif($idProfOk==16){
				$profileViewsOk=true;
			}elseif($idProfOk==17){
				$profileViewsOk=true;
			}elseif($idProfOk<20){
				$profileViewsOk=true;
			}elseif($idProfOk<23){
				$profileViewsOk=false;
			}elseif($idProfOk==23){
				$profileViewsOk=false;
			}elseif($idProfOk==24){
				$profileViewsOk=true;
			}elseif($idProfOk==25){
				$profileViewsOk=false;
			}elseif($idProfOk==26){
				$profileViewsOk=false;
			}elseif($idProfOk==27){
				$profileViewsOk=false;
			}

?>				
				
				
				<div id="votesHolder">
					
					<? 
					$vid2=new Video();
					$registros=$vid2->selectVideo($idProfile,'id,vote,voteValue,visit,comment',"id='".addslashes(base64_decode($iFv[1]))."' and active=1","id desc");
					$entero=intval($registros[0]->voteValue);
					#sets the width of the green stars div
					if($entero == 0){
						$width=0;
					}elseif($entero == 1){
					
						$width=24;
						
					}elseif($entero == 2){
					
						$width=46;
						
					}elseif($entero == 3){
					
						$width=68;
						
					}elseif($entero == 4){
					
						$width=91;
						
					}else{
						$width=107;
					}
					
					$decimal=$registros[0]->voteValue-$entero;
					if($decimal>0){
						$width=$width+8;
					}
					?>
					
					
					<!-- /////////Stars from Votes///////////// -->
					<?php if($profileViewsOk){?>
					<div id="voteTitle"><?php print $_IDIOMA->traducir("Rate it");?></div>
					<div id="starsBlack"></div>
					<div id="stars" style="width:<? echo $width; ?>px;"></div>
					<?php }?>
			
			
			
			
			
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
			<?php if($profileViewsOk){?>
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
			
					<?php }?>
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
					<?php if($profileViewsOk){?>
					<div><span id="numRate"><?php print $_IDIOMA->traducir("Points average");?>:<? echo $registros[0]->voteValue;?></span><span id="videoVotes"><?php print $_IDIOMA->traducir("Votes");?>:<? echo $registros[0]->vote;?> </span><span id="videoViews"><?php print $_IDIOMA->traducir("Views");?>:<? echo $registros[0]->visit;?></span></div>
					<?php }?>
					<a style="color:#000000;margin-right: 10px;text-decoration: none;font-size: 12px;margin-top: 5px;margin-bottom: 5px;display: block;" href="javascript:;" onclick="loadComment(iUpvNpN)"><?php print $_IDIOMA->traducir("See comments");?></a>
					<div id="saveComment"></div>
					<div id="loadComment"></div>
				
				
				
				
				</div><!-- div all -->
				

