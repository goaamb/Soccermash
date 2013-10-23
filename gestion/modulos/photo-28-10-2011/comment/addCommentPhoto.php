<?

	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/comment/photoCommentClass.php');

	
	///iUpvNpNc= idUser - idProfile - idPhoto - name - profile name - comment - editProfile
	$iUpvNpNc=$_POST['pUpvNpNc'];
	

		/////////new Comments///////////////////////
		$aFields['idUserCommenting']=$_SESSION["iSMuIdKey"];
		$aFields['idProfileCommenting']=$_SESSION["iSMuProfTypeKey"];
		$aFields['idPhoto']=addslashes(base64_decode($iUpvNpNc[2]));
		$aFields['nameUserCommenting']=$_SESSION["nameUserSM"];
		$aFields['nameProfile']=$_SESSION["namePerfilUserSM"];
		$aFields['comment']=addslashes($iUpvNpNc[5]);
		$aFields['registerDate']=date('Y-m-d');
		
		$phoComm=new PhotoComment();
		$registros=$phoComm->addPhotoComment($aFields);




	/////////get Photo Comments///////////////////////
		$phoUp=new Photo();
		$registros=$phoUp->selectPhoto(addslashes(base64_decode($iUpvNpNc[1])),'comment','id="'.addslashes(base64_decode($iUpvNpNc[2])).'"',"id desc");

	
		#update commment
		$fields['comment']=$registros[0]->comment + 1;
		$phoUp->upPhoto($fields,'id="'.addslashes(base64_decode($iUpvNpNc[2])).'"');
		//echo 'visit';
			
	
		$registros=$phoUp->selectPhoto(addslashes(base64_decode($iUpvNpNc[1])),'comment','id="'.addslashes(base64_decode($iUpvNpNc[2])).'"',"id desc");
		?> 
	
		<script type="text/javascript">
				$("#votaProgress").html('');
				
				var pUpvNpN=new Array();
				pUpvNpN.push("<? echo $iUpvNpNc[0]; ?>");
				pUpvNpN.push("<? echo $iUpvNpNc[1]; ?>");
				pUpvNpN.push("<? echo $iUpvNpNc[2]; ?>");
				pUpvNpN.push("<? echo $iUpvNpNc[3]; ?>");
				pUpvNpN.push("<? echo $iUpvNpNc[4]; ?>");
				pUpvNpN.push("<? echo base64_encode(1); ?>");
				pUpvNpN.push("<? echo $iUpvNpNc[6]; ?>");
				pUpvNpN.push("<? echo $iUpvNpNc[7]; ?>");
				loadCommentPhoto(pUpvNpN);
				
				$("#cantComment").html('<? echo $fields['comment']; ?>');
		</script>
	