<?

		$videoOwner=addslashes(base64_decode($iCpv[3]));
		
		//////check if I can delete, only in my profile/////////
		if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
			$editProf=true;
		}else{
			$editProf=0;
		}

if($editProf==true && $videoOwner==$_SESSION["iSMuIdKey"]){

	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/comment/videoCommentClass.php');

		///comment - idprofile - idvideo
		$iCpv=$_POST['iCpv'];
		////////delete comment//////////
		$vidComm=new VideoComment();
		$registros=$vidComm->delVideoComment('id='.addslashes(base64_decode($iCpv['0'])));

		
		
		
		
		/////////decrease video Comments///////////////////////
		$vidUp=new Video();
		$registros=$vidUp->selectVideo(addslashes(base64_decode($iCpv[1])),'comment','id="'.addslashes(base64_decode($iCpv[2])).'"',"id desc");

	
		#update commment
		$fields['comment']=$registros[0]->comment - 1;
		$vidUp->upVideo($fields,'id="'.addslashes(base64_decode($iCpv[2])).'"');
		//echo 'visit';
		
		?>
		<script type="text/javascript">
				$("#votaProgress").html('');
				$("#cantComment").html('<? echo $fields['comment']; ?>');
				
		</script>
		<?
		
	}
	?>
		
	