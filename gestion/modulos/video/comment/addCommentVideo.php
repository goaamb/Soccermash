<?

	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/comment/videoCommentClass.php');

	
	///iUpvNpNc= idUser - idProfile - idVideo - name - profile name - comment - editProfile
	$iUpvNpNc=$_POST['iUpvNpNc'];
	

		/////////new Comments///////////////////////
		$aFields['idUserCommenting']=$_SESSION["iSMuIdKey"];
		$aFields['idProfileCommenting']=$_SESSION["iSMuProfTypeKey"];
		$aFields['idVideo']=addslashes(base64_decode($iUpvNpNc[2]));
		$aFields['nameUserCommenting']=$_SESSION["nameUserSM"];
		$aFields['nameProfile']=$_SESSION["namePerfilUserSM"];
		$aFields['comment']=addslashes($iUpvNpNc[5]);
		$aFields['registerDate']=date('Y-m-d');
		
		
		
		$vidComm=new VideoComment();
		$registros=$vidComm->addVideoComment($aFields);




	/////////get video Comments///////////////////////
		$vidUp=new Video();
		$registros=$vidUp->selectVideo(addslashes(base64_decode($iUpvNpNc[1])),'comment','id="'.addslashes(base64_decode($iUpvNpNc[2])).'"',"id desc");

	
		#update commment
		$fields['comment']=$registros[0]->comment + 1;
		$vidUp->upVideo($fields,'id="'.addslashes(base64_decode($iUpvNpNc[2])).'"');
		//echo 'visit';
			
	
		
		?> 
	
		<script type="text/javascript">
				$("#votaProgress").html('');
				
				var iUpvNpN=new Array();
				iUpvNpN.push("<? echo $iUpvNpNc[0]; ?>");
				iUpvNpN.push("<? echo $iUpvNpNc[1]; ?>");
				iUpvNpN.push("<? echo $iUpvNpNc[2]; ?>");
				iUpvNpN.push("<? echo $iUpvNpNc[3]; ?>");
				iUpvNpN.push("<? echo $iUpvNpNc[4]; ?>");
				iUpvNpN.push("<? echo base64_encode(1); ?>");
				iUpvNpN.push("<? echo $iUpvNpNc[6]; ?>");
				iUpvNpN.push("<? echo $iUpvNpNc[7]; ?>");
				loadComment(iUpvNpN);
				
				$("#cantComment").html('<? echo $fields['comment']; ?>');
		</script>
	