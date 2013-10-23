<?

	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');	
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoViewClass.php');
	//require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoUserVoteClass.php');
	//require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoVoteClass.php');

	
	
	/// id Photo - idProfile - idUser - profileOk - userOk
	$iVp=$_POST['pVpu_pOk_uOk'];
		
	/////////Update Photo Votes or Views///////////////////////
		$phoUp=new Photo();
		//$registros=$phoUp->selectPhoto(addslashes(base64_decode($iVp[1])),'visit,vote,voteValue','id="'.addslashes(base64_decode($iVp[0])).'"',"id desc");
		$registros=$phoUp->selectPhoto(addslashes(base64_decode($iVp[1])),'visit','id="'.addslashes(base64_decode($iVp[0])).'"',"id desc");
	

	
	//if(addslashes($_POST['action']=='visit')){
		
		#update visits
		$fields['visit']=$registros[0]->visit + 1;
		$phoUp->upPhoto($fields,'id="'.addslashes(base64_decode($iVp[0])).'"');
		//echo 'visit';
		
			#select the profile form the user who is viewing
			$idProfileOk=addslashes(base64_decode($iVp[3]));
			
			if($idProfileOk<7){
				$profile='playerView';
			}elseif($idProfileOk<13){
				$profile='coachView';
			}elseif($idProfileOk<16){
				$profile='agentView';
			}elseif($idProfileOk==16){
				$profile='scoutView';
			}elseif($idProfileOk==17){
				$profile='lawyerView';
			}elseif($idProfileOk<20){
				$profile='managerView';
			}elseif($idProfileOk<23){
				$profile='medicView';
			}elseif($idProfileOk==23){
				$profile='fanView';
			}elseif($idProfileOk==24){
				$profile='journalistView';
			}elseif($idProfileOk==25){
				$profile='selectionView';
			}elseif($idProfileOk==26){
				$profile='clubView';
			}elseif($idProfileOk==27){
				$profile='companyView';
			}
			
			
			////////checks if the Photo has been voted///////////////
			$phoView= new PhotoView();
			$registrosView=$phoView->selectPhotoView("$profile",'idPhoto="'.addslashes(base64_decode($iVp[0])).'"',"id desc");
		

			
			if($registrosView[0]!=''){
				#update an existing view in ax_PhotoView
				$fields4[$profile]=$registrosView[0]->$profile + 1;
				//$fields2['idUser']=$_POST['idUser'];
				$phoView->upPhotoView($fields4,'idPhoto="'.addslashes(base64_decode($iVp[0])).'"');
			
			}else{
				#adds view in ax_PhotoView
				$fields4['idPhoto']=addslashes(base64_decode($iVp[0]));
				$fields4[$profile]= 1;
				$fields4['idUser']=addslashes(base64_decode($iVp[2]));
				$phoView->addPhotoView($fields4);
				
			}
			
			
			
			
			
		
		
		
		
	
	/*}elseif(addslashes($_POST['action']=='vote')){
		//File - idPhoto - idProfile - idUser - idProfileOk - idUserOk - Photo name - Photo photo - vote value	- user name - profile name
		$vFv=$_POST['vFvpu_pOkuOk_n_ph_va_uN_pN'];
	
		//echo 'vote???';
		#update votes
		$fields['vote']=$registros[0]->vote + 1;
		$fields['voteValue']=$registros[0]->voteValue + addslashes(base64_decode($vFv[8]));
		$phoUp->upPhoto($fields,'id="'.addslashes(base64_decode($vFv[1])).'"');
			
			$idProfOk=addslashes(base64_decode($vFv[4]));
			#select the profile form the user who is voting
			if($idProfOk<7){
				$profile='playerVote';
			}elseif($idProfOk<13){
				$profile='coachVote';
			}elseif($idProfOk<16){
				$profile='agentVote';
			}elseif($idProfOk==16){
				$profile='scoutVote';
			}elseif($idProfOk==17){
				$profile='lawyerVote';
			}elseif($idProfOk<20){
				$profile='managerVote';
			}elseif($idProfOk<23){
				$profile='medicVote';
			}elseif($idProfOk==23){
				$profile='fanVote';
			}elseif($idProfOk==24){
				$profile='journalistVote';
			}elseif($idProfOk==25){
				$profile='selectionVote';
			}elseif($idProfOk==26){
				$profile='clubVote';
			}elseif($idProfOk==27){
				$profile='companyVote';
			}
			
			
		////////checks if the video has been voted///////////////
		$vidVote= new VideoVote();
		$registrosVote=$vidVote->selectVideoVote("$profile",'idVideo="'.addslashes(base64_decode($vFv[1])).'"',"id desc");
		

			
			if($registrosVote[0]!=''){
				#update an existing vote in ax_videoVote
				//echo 'resulado: ', $registrosVote[0]->$profile;
				$fields2[$profile]=$registrosVote[0]->$profile + 1;
				//$fields2['idUser']=$_POST['idUser'];
				$vidVote->upVideoVote($fields2,'idVideo="'.addslashes(base64_decode($vFv[1])).'"');
			
			}else{
				#adds votes in ax_videoVote
				$fields2['idVideo']=addslashes(base64_decode($vFv[1]));
				$fields2[$profile]= 1;
				$fields2['idUser']=addslashes(base64_decode($vFv[3]));
				$vidVote->addVideoVote($fields2);
				
			}
			


		///////////checks if the user has voted at least once - in ax_userVote ////////////////////	
				
		$vidUserVote= new VideoUserVote();
		$registrosUserVote=$vidUserVote->selectVideoUserVote("idVideo",'idUser="'.addslashes(base64_decode($vFv[5])).'"',"id desc");
		
			
			
			if($registrosUserVote[0]!=''){
				#update an existing vote in ax_videoUserVote
				$fields3['idVideo']=$registrosUserVote[0]->idVideo.','.addslashes(base64_decode($vFv[1]));
				$vidUserVote->upVideoUserVote($fields3,'idUser="'.addslashes(base64_decode($vFv[5])).'"');
				//echo 'update';
			
			}else{
				#adds votes in ax_videoUserVote
				$fields3['idVideo']=addslashes(base64_decode($vFv[1]));
				$fields3['idUser']= addslashes(base64_decode($vFv[5]));
				$vidUserVote->addVideoUserVote($fields3);
				//echo 'add';
			}
	
		?> 
		<script type="text/javascript">
			$("#votaProgress").html('');
			
			var iFvpu_pOkuOk_n_ph_uN_pN=new Array();
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[0] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[1] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[2] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[3] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[4] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[5] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[6] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[7] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[9] ?>');
			iFvpu_pOkuOk_n_ph_uN_pN.push('<? echo $vFv[10] ?>');
		
			loadVideo(iFvpu_pOkuOk_n_ph_uN_pN);
		</script>
		<?
	}//vote*/
	

		
?>