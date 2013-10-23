<?
	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoVoteClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoViewClass.php');

	/*$_POST['idProfile'];
	$_POST['idUser'];*/
					
				////Profile(not using) - id user - id Video	
				$rPuV=$_POST['rPuV'];
				#if video is active selects the view/vote freom this video
				if(addslashes(base64_decode($rPuV[2]))!=0){
						
						$where='idVideo="'.addslashes(base64_decode($rPuV[2])).'"';
				
				#if video is inactive selects the view/vote from the user
				}else{
						$where='idUser="'.addslashes(base64_decode($rPuV[1])).'"';
				
				}
					//echo $where;
					#views
					$vidView= new VideoView();
					$regPlayer1=$vidView->selectVideoView("SUM(playerView) as plNum",$where,"id desc");
					$regPlayer2=$vidView->selectVideoView("SUM(coachView) as coNum",$where,"id desc");
					$regPlayer3=$vidView->selectVideoView("SUM(agentView) as agNum",$where,"id desc");
					$regPlayer4=$vidView->selectVideoView("SUM(scoutView) as scNum",$where,"id desc");
					$regPlayer5=$vidView->selectVideoView("SUM(managerView) as maNum",$where,"id desc");
					$regPlayer6=$vidView->selectVideoView("SUM(medicView) as meNum",$where,"id desc");
					$regPlayer7=$vidView->selectVideoView("SUM(lawyerView) as laNum",$where,"id desc");
					$regPlayer8=$vidView->selectVideoView("SUM(journalistView) as joNum",$where,"id desc");
					$regPlayer9=$vidView->selectVideoView("SUM(fanView) as faNum",$where,"id desc");
					$regPlayer10=$vidView->selectVideoView("SUM(clubView) as clNum",$where,"id desc");
					$regPlayer11=$vidView->selectVideoView("SUM(selectionView) as seNum",$where,"id desc");
					$regPlayer12=$vidView->selectVideoView("SUM(companyView) as comNum",$where,"id desc");
					
					$totalView=$regPlayer1[0]->plNum + $regPlayer2[0]->coNum + $regPlayer3[0]->agNum + $regPlayer4[0]->scNum + $regPlayer5[0]->maNum + $regPlayer6[0]->meNum + $regPlayer7[0]->laNum + $regPlayer8[0]->joNum + $regPlayer9[0]->faNum + $regPlayer10[0]->clNum + $regPlayer11[0]->seNum + $regPlayer12[0]->comNum;
					
					
					#votes
					$vidVote= new VideoVote();
					$regPlayerVote1=$vidVote->selectVideoVote("SUM(playerVote) as plNum",$where,"id desc");
					$regPlayerVote2=$vidVote->selectVideoVote("SUM(coachVote) as coNum",$where,"id desc");
					$regPlayerVote3=$vidVote->selectVideoVote("SUM(agentVote) as agNum",$where,"id desc");
					$regPlayerVote4=$vidVote->selectVideoVote("SUM(scoutVote) as scNum",$where,"id desc");
					$regPlayerVote5=$vidVote->selectVideoVote("SUM(managerVote) as maNum",$where,"id desc");
					$regPlayerVote6=$vidVote->selectVideoVote("SUM(medicVote) as meNum",$where,"id desc");
					$regPlayerVote7=$vidVote->selectVideoVote("SUM(lawyerVote) as laNum",$where,"id desc");
					$regPlayerVote8=$vidVote->selectVideoVote("SUM(journalistVote) as joNum",$where,"id desc");
					$regPlayerVote9=$vidVote->selectVideoVote("SUM(fanVote) as faNum",$where,"id desc");
					$regPlayerVote10=$vidVote->selectVideoVote("SUM(clubVote) as clNum",$where,"id desc");
					$regPlayerVote11=$vidVote->selectVideoVote("SUM(selectionVote) as seNum",$where,"id desc");
					$regPlayerVote12=$vidVote->selectVideoVote("SUM(companyVote) as comNum",$where,"id desc");
			
					$totalVote=$regPlayerVote1[0]->plNum + $regPlayerVote2[0]->coNum + $regPlayerVote3[0]->agNum + $regPlayerVote4[0]->scNum + $regPlayerVote5[0]->maNum + $regPlayerVote6[0]->meNum + $regPlayerVote7[0]->laNum + $regPlayerVote8[0]->joNum + $regPlayerVote9[0]->faNum + $regPlayerVote10[0]->clNum + $regPlayerVote11[0]->seNum + $regPlayerVote12[0]->comNum;
				
				

?>					

				<!------- set the values -------->
				<script type="text/javascript">
					$("#plNum").html('<? echo $regPlayerVote1[0]->plNum ?>/<? echo $regPlayer1[0]->plNum ?>');
					$("#coNum").html('<? echo $regPlayerVote2[0]->coNum ?>/<? echo $regPlayer2[0]->coNum ?>');
					$("#agNum").html('<? echo $regPlayerVote3[0]->agNum ?>/<? echo $regPlayer3[0]->agNum ?>');
					$("#scNum").html('<? echo $regPlayerVote4[0]->scNum ?>/<? echo $regPlayer4[0]->scNum ?>');
					$("#maNum").html('<? echo $regPlayerVote5[0]->maNum ?>/<? echo $regPlayer5[0]->maNum ?>');
					$("#meNum").html('<? echo $regPlayerVote6[0]->meNum ?>/<? echo $regPlayer6[0]->meNum ?>');
					$("#laNum").html('<? echo $regPlayerVote7[0]->laNum ?>/<? echo $regPlayer7[0]->laNum ?>');
					$("#joNum").html('<? echo $regPlayerVote8[0]->joNum ?>/<? echo $regPlayer8[0]->joNum ?>');
					$("#faNum").html('<? echo $regPlayerVote9[0]->faNum ?>/<? echo $regPlayer9[0]->faNum ?>');
					$("#clNum").html('<? echo $regPlayerVote10[0]->clNum+$regPlayerVote11[0]->seNum ?>/<? echo $regPlayer10[0]->clNum+$regPlayer11[0]->seNum ?>');
					$("#comNum").html('<? echo $regPlayerVote12[0]->comNum ?>/<? echo $regPlayer12[0]->comNum ?>');
					$("#total").html('<? echo $totalVote ?>/<? echo $totalView ?>');				
				</script>