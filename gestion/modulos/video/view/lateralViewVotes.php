<?
	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoVoteClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoViewClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoClass.php');

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
					$vidUp = new Video();
					$regVideoRated=$vidUp->selectVideo("","sum(voteValue) as voteValue",$where." and active=1");
						
				
					#views
					$vidView= new VideoView();
					$regPlayer1=$vidView->selectVideoView("SUM(playerView) as plNum",$where,"id desc");
					$regPlayer2=$vidView->selectVideoView("SUM(coachView) as coNum",$where,"id desc");
					$regPlayer3=$vidView->selectVideoView("SUM(agentView) as agNum",$where,"id desc");
					$regPlayer4=$vidView->selectVideoView("SUM(scoutView) as scNum",$where,"id desc");
					$regPlayer5=$vidView->selectVideoView("SUM(managerView) as maNum",$where,"id desc");
					$regPlayer7=$vidView->selectVideoView("SUM(lawyerView) as laNum",$where,"id desc");
					$regPlayer8=$vidView->selectVideoView("SUM(journalistView) as joNum",$where,"id desc");
					
					$totalView=$regPlayer1[0]->plNum + $regPlayer2[0]->coNum + $regPlayer3[0]->agNum + $regPlayer4[0]->scNum + $regPlayer5[0]->maNum + $regPlayer7[0]->laNum + $regPlayer8[0]->joNum;
					
					
					#votes
					$vidVote= new VideoVote();
					$regPlayerVote1=$vidVote->selectVideoVote("SUM(playerVote) as plNum",$where,"id desc");
					$regPlayerVote2=$vidVote->selectVideoVote("SUM(coachVote) as coNum",$where,"id desc");
					$regPlayerVote3=$vidVote->selectVideoVote("SUM(agentVote) as agNum",$where,"id desc");
					$regPlayerVote4=$vidVote->selectVideoVote("SUM(scoutVote) as scNum",$where,"id desc");
					$regPlayerVote5=$vidVote->selectVideoVote("SUM(managerVote) as maNum",$where,"id desc");
					$regPlayerVote7=$vidVote->selectVideoVote("SUM(lawyerVote) as laNum",$where,"id desc");
					$regPlayerVote8=$vidVote->selectVideoVote("SUM(journalistVote) as joNum",$where,"id desc");
			
					$totalVote=$regPlayerVote1[0]->plNum + $regPlayerVote2[0]->coNum + $regPlayerVote3[0]->agNum + $regPlayerVote4[0]->scNum + $regPlayerVote5[0]->maNum + $regPlayerVote7[0]->laNum + $regPlayerVote8[0]->joNum;
				
				

?>					

				<!------- set the values -------->
				<script type="text/javascript">
					$("#plNum").html('<td><? echo $regPlayer1[0]->plNum?$regPlayer1[0]->plNum:0 ?></td><td><? echo $regPlayerVote1[0]->plNum?$regPlayerVote1[0]->plNum:0 ?></td><td><?php echo number_format((floatval($regVideoRated[0]->voteValue)*floatval($regPlayerVote1[0]->plNum))/floatval($totalVote),2) ?></td>');
					$("#coNum").html('<td><? echo $regPlayer2[0]->coNum?$regPlayer2[0]->coNum:0 ?></td><td><? echo $regPlayerVote2[0]->coNum?$regPlayerVote2[0]->coNum:0 ?></td><td><?php echo number_format((floatval($regVideoRated[0]->voteValue)*floatval($regPlayerVote2[0]->coNum))/floatval($totalVote),2) ?></td>');
					$("#agNum").html('<td><? echo $regPlayer3[0]->agNum?$regPlayer3[0]->agNum:0 ?></td><td><? echo $regPlayerVote3[0]->agNum?$regPlayerVote3[0]->agNum:0 ?></td><td><?php echo number_format((floatval($regVideoRated[0]->voteValue)*floatval($regPlayerVote3[0]->agNum))/floatval($totalVote),2) ?></td>');
					$("#scNum").html('<td><? echo $regPlayer4[0]->scNum?$regPlayer4[0]->scNum:0 ?></td><td><? echo $regPlayerVote4[0]->scNum?$regPlayerVote4[0]->scNum:0 ?></td><td><?php echo number_format((floatval($regVideoRated[0]->voteValue)*floatval($regPlayerVote4[0]->scNum))/floatval($totalVote),2) ?></td>');
					$("#maNum").html('<td><? echo $regPlayer5[0]->maNum?$regPlayer5[0]->maNum:0 ?></td><td><? echo $regPlayerVote5[0]->maNum?$regPlayerVote5[0]->maNum:0 ?></td><td><?php echo number_format((floatval($regVideoRated[0]->voteValue)*floatval($regPlayerVote5[0]->maNum))/floatval($totalVote),2) ?></td>');
					$("#laNum").html('<td><? echo $regPlayer7[0]->laNum?$regPlayer7[0]->laNum:0 ?></td><td><? echo $regPlayerVote7[0]->laNum?$regPlayerVote7[0]->laNum:0 ?></td><td><?php echo number_format((floatval($regVideoRated[0]->voteValue)*floatval($regPlayerVote7[0]->laNum))/floatval($totalVote),2) ?></td>');
					$("#joNum").html('<td><? echo $regPlayer8[0]->joNum?$regPlayer8[0]->joNum:0 ?></td><td><? echo $regPlayerVote8[0]->joNum?$regPlayerVote8[0]->joNum:0 ?></td><td><?php echo number_format((floatval($regVideoRated[0]->voteValue)*floatval($regPlayerVote8[0]->joNum))/floatval($totalVote),2) ?></td>');
					$("#total").html('<td><? echo $totalView ?></td><td><? echo $totalVote ?></td><td><strong><?php echo $regVideoRated[0]->voteValue?$regVideoRated[0]->voteValue:0 ?></strong></td>');				
				</script>