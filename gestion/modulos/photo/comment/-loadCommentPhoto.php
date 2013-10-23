<div style="margin-top:15px;"><a href="javascript:;" onclick="$('#loadComment').html('');">Close</a></div>
<?

	$dir='';
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');
	require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/comment/photoCommentClass.php');

	
		///iUpv= idUser - idProfile - idPhoto ..... 6-->editProfile true or false
		$iUpvNpN=$_POST['pUpvNpN'];
		
		$videoOwner=addslashes(base64_decode($iUpvNpN[7]));
		
		//////check if I can delete, only in my profile/////////
		if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
			$editProf=true;
		}else{
			$editProf=0;
		}
			
			////Instance class///////
			$phoUp=new PhotoComment();
		
			
			////paginate/
			$page=addslashes(base64_decode($iUpvNpN[5]));
			
			/////////Number of items by page//////////////////
			$cant=5;
			
			//////////Pagination/////////////////////////////
			$init=$phoUp->paginate($idProfile,$page,"and idPhoto='".addslashes(base64_decode($iUpvNpN[2]))."'",$iUpvNpN,$cant);
			
			////////get the values from pagination////////////
			$ini=explode(',',$init);
			$inicio=$ini[0];
			$paginado=$ini[1];

	
	
	
	
		/////////get Photo Comments///////////////////////
		$registros=$phoUp->selectPhotoComment('*','active="1" AND idPhoto="'.addslashes(base64_decode($iUpvNpN[2])).'"',"id desc LIMIT $inicio,$cant");

		$n=0;
		foreach($registros as $registro){
			
			if($editProf==true && $videoOwner==$_SESSION["iSMuIdKey"]){
			
				?>
				<script type="text/javascript">
					pCpv<? echo $n; ?>=new Array();
					pCpv<? echo $n; ?>.push('<? echo base64_encode($registro->id); ?>');
					pCpv<? echo $n; ?>.push('<? echo $iUpvNpN[1]; ?>');
					pCpv<? echo $n; ?>.push('<? echo $iUpvNpN[2]; ?>');
					pCpv<? echo $n; ?>.push('<? echo $iUpvNpN[7]; ?>');
				</script>
				<?
			
						
				$del='<div class="posDelComment"><a href="javascript:;" onclick="delCommentPhoto(pCpv'.$n.'); $(\'#com'.$registro->id.'\').hide();"><div title="Delete" class="delMulti" id="delComment"></div></a></div>';
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
		<div style="margin-top:15px; margin-bottom:10px;">Leave your comment:</div> 
			
		<textarea id="commentText" style="width: 569px; height: 47px; margin-right:8px;"></textarea>
		';
		
		
		
		?>
			<!-- creates array with all values and the comment-->
			<script type="text/javascript">
			
			function beforeComment(){
				var pUpvNpNc=new Array();
				pUpvNpNc.push("<? echo $iUpvNpN[0]; ?>");
				pUpvNpNc.push("<? echo $iUpvNpN[1]; ?>");
				pUpvNpNc.push("<? echo $iUpvNpN[2]; ?>");
				pUpvNpNc.push("<? echo $iUpvNpN[3]; ?>");
				pUpvNpNc.push("<? echo $iUpvNpN[4]; ?>");
				pUpvNpNc.push($("#commentText").val());
				pUpvNpNc.push("<? echo $iUpvNpN[6]; ?>");
				pUpvNpNc.push("<? echo $iUpvNpN[7]; ?>");
				saveCommentPhoto(pUpvNpNc);
			}
			</script>
		
		<?
		 echo '
			
			
			<div style="margin-right:8px; margin-top:8px;"><a href="javascript:;" onclick="beforeComment();">send</a></div>
			<div id="commProgress" style="margin-right: 54px; margin-top: -14px;"></div>
		
		';
			echo '<div style="margin-top:30px;">';
			require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/paginador.php');
			echo '</div>';
?>



<script type="text/javascript">
			$("#votaProgress").html('');
</script>