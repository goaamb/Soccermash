<?
	$videoOwner=addslashes(base64_decode($iCpv[3]));
		
		if(isset($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
			$editProfile=true;
		}else{
			$editProfile=0;
		}

	if($editProfile==true && $videoOwner==$_SESSION["iSMuIdKey"]){

	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/comment/photoCommentClass.php');

		///comment - idprofile - idPhoto
		$iCpv=$_POST['pCpv'];
		////////delete comment//////////
		$phoComm=new PhotoComment();
		$registros=$phoComm->delPhotoComment('id='.addslashes(base64_decode($iCpv['0'])));

		
		
		
		
		/////////decrease Photo Comments///////////////////////
		$phoUp=new Photo();
		$registros=$phoUp->selectPhoto(addslashes(base64_decode($iCpv[1])),'comment','id="'.addslashes(base64_decode($iCpv[2])).'"',"id desc");

	
		#update commment
		$fields['comment']=$registros[0]->comment - 1;
		$phoUp->upPhoto($fields,'id="'.addslashes(base64_decode($iCpv[2])).'"');
		//echo 'visit';
		
		
		
	
		?> 
	
		<script type="text/javascript">
				$("#votaProgress").html('');
				$("#cantComment").html('<? echo $fields['comment']; ?>');
				
		</script>
	<?
	}
	?>