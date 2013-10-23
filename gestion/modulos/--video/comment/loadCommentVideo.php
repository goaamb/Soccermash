<div class="onright"><a href="javascript:;" onclick="$('#loadComment').html('');">Close</a></div>
<?

	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/comment/videoCommentClass.php');

	
		///iUpv= idUser - idProfile - idVideo ..... 6-->editProfile true or false
		$iUpvNpN=$_POST['iUpvNpN'];
		
		$videoOwner=addslashes(base64_decode($iUpvNpN[7]));
		
		if(isset($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
			$editProfile=true;
		}else{
			$editProfile=0;
		}
			
			////Instance class///////
			$vidUp=new VideoComment();
		
			
			////paginate/
			$page=addslashes(base64_decode($iUpvNpN[5]));
			
			/////////Number of items by page//////////////////
			$cant=5;
			
			//////////Pagination/////////////////////////////
			$init=$vidUp->paginate($idProfile,$page,"and idVideo='".addslashes(base64_decode($iUpvNpN[2]))."'",$iUpvNpN,$cant);
			
			////////get the values from pagination////////////
			$ini=explode(',',$init);
			$inicio=$ini[0];
			$paginado=$ini[1];

	
	
	
	
		/////////get video Comments///////////////////////
		$registros=$vidUp->selectVideoComment('*','active="1" AND idVideo="'.addslashes(base64_decode($iUpvNpN[2])).'"',"id desc LIMIT $inicio,$cant");

		$n=0;
		foreach($registros as $registro){
			
			if($editProfile==true && $videoOwner==$_SESSION["iSMuIdKey"]){
			
				?>
				<script type="text/javascript">
					iCpv<? echo $n; ?>=new Array();
					iCpv<? echo $n; ?>.push('<? echo base64_encode($registro->id); ?>');
					iCpv<? echo $n; ?>.push('<? echo $iUpvNpN[1]; ?>');
					iCpv<? echo $n; ?>.push('<? echo $iUpvNpN[2]; ?>');
					iCpv<? echo $n; ?>.push('<? echo $iUpvNpN[7]; ?>');
				</script>
				<?
			
						
				$del='<div style="float:right; padding-right:8px;"><a title="delete" href="javascript:;" onclick="delComment(iCpv'.$n.'); $(\'#com'.$registro->id.'\').hide();"><img src="img/cancel.png"></a></div>';
			}
			
			$dat=explode('-',$registro->registerDate);
			
			echo '<div id="com'.$registro->id.'" style="margin-top:15px;padding-left:5px; border:thin solid #EEE; padding-top:5px; padding-bottom:5px;">'.$del.'
			<div style="float:left; font-size:12px; font-weight:bold; font-color:#000; padding-left:5px;">'.html_entity_decode($registro->nameUserCommenting).'</div>  <div style="float:right; margin-top:1px; font-size:11px; padding-right:12px;">'.$dat[2].'/'.$dat[1].'/'.$dat[0].'</div> <div style="float:right; font-size:11px; padding-right:20px; margin-top:1px;">'.html_entity_decode($registro->nameProfile).'</div>
			
			
			<div style="font-size:11px; margin-top:34px; margin-left:14px; width:573px; text-align:left;">'.html_entity_decode($registro->comment).'</div></div>
			';	
			$n++;
		
		}
		
		
		////////////leave your comment/////////////
		echo'
		<div id="leaveComm">Leave your comment:</div> 
			
		<textarea id="commentText" style="width: 569px; height: 47px; margin-right:8px;"></textarea>
		';
		
		
		
		?>
			<!-- creates array with all values and the comment-->
			<script type="text/javascript">
			
			function beforeComment(){
				var iUpvNpNc=new Array();
				iUpvNpNc.push("<? echo $iUpvNpN[0]; ?>");
				iUpvNpNc.push("<? echo $iUpvNpN[1]; ?>");
				iUpvNpNc.push("<? echo $iUpvNpN[2]; ?>");
				iUpvNpNc.push("<? echo $iUpvNpN[3]; ?>");
				iUpvNpNc.push("<? echo $iUpvNpN[4]; ?>");
				iUpvNpNc.push($("#commentText").val());
				iUpvNpNc.push("<? echo $iUpvNpN[6]; ?>");
				iUpvNpNc.push("<? echo $iUpvNpN[7]; ?>");
				saveComment(iUpvNpNc);
			}
			</script>
		
		<?
		 echo '
			
			
			<div style="margin-right:8px; margin-top:8px;"><a id="sendComment" href="javascript:;" onclick="beforeComment();">SEND</a></div>
			<div id="commProgress" style="margin-right: 54px; margin-top: -14px;"></div>
		
		';
			echo '<div style="margin-top:30px;">';
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/paginador.php');
			echo '</div>';
?>



<script type="text/javascript">
			$("#votaProgress").html('');
			 $('#sendComment').button();
</script>