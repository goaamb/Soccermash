
<?php

require_once($_SERVER['DOCUMENT_ROOT']."/soccermashTest2/gestion/lib/share/clases/lib_util.inc.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/soccermashTest2/gestion/modulos/home/modules/classAndres.php"); 

$valueOfIdVisiging=setIdUserVisiting();
//echo "<strong>idVisiting: </strong>".$valueOfIdVisiging."<br />";
$valueOfProfileVisiting=setProfileId();
//echo "<strong>Profilevisiting: </strong>".$valueOfProfileVisiting."<br />";
//echo "idUser: ".$_SESSION['iSMuIdKey']."<br />";
//echo "idUserVisiting: ".$_SESSION['idUserVisiting']."<br />";

$tableWall=createTableWall($valueOfProfileVisiting);
//echo "<strong>tableWall:</strong> ".$tableWall."<br />";
$tableReceivedComments=crateTableReceivedComments($valueOfProfileVisiting);
//echo "<strong>tableWall:</strong> ".$tableReceivedComments."<br />";


$oDB=new mysql;
$oDB->connect();
/*$asd=$oDB->query("SELECT * FROM $tableProfile WHERE user_id=$agdate ORDER BY ID DESC");*/
/*busco todo lo de este usuario en la tabla ax_perfilWall*/

?>		
	
<?php
$wall=GenerateSelect('*',$tableWall,"user_id=$valueOfIdVisiging");
$wall=$oDB->query($wall);
while ($rowWall = mysql_fetch_array($wall)) {
	//echo "<strong>User_id_Who: </strong>".$rowWall['user_id_who']."<br />";
	//echo "<strong>User_id: </strong>".$rowWall['user_id']."<br />";
	//echo "<strong>id: </strong>".$rowWall['id']."<br />";
	//echo "<strong>publication: </strong>".$rowWall['publication']."<br />";
	//echo "<strong>time: </strong>".ago($rowWall['time'])."<br />";
	$oDB2=new mysql;
	$oDB2->connect();
	$generalRegister=GenerateSelect('name,lastName,photo','ax_generalRegister','id='.$rowWall['user_id_who']);
	$generalRegister=$oDB->query($generalRegister);
	while ($rowGeneralRegister = mysql_fetch_array($generalRegister)){
		?>
		<div class="individualComm">
			<div class="photoSpeaker">
				<?php
				echo '<img src="photoGeneral/small/small_'.$rowGeneralRegister['photo'].'" width="51" height="51" title="'.$rowGeneralRegister['name']," ",$rowGeneralRegister['lastName'].'" alt="#" />';
				?>
			</div><!--photoSpeaker-->
			<div class="mainContent">
				<span class="deleteThis" title="Delete this comment"></span> 
			<div class="name">
				<?php echo $rowGeneralRegister['name']," ",$rowGeneralRegister['lastName']; } ?>
			</div>
			<div class="wrotte">
				<?php echo $rowWall['publication'];	?>
			</div>
			<div class="commenTools">
				<span class="date">
				<?php echo ago($rowWall['time']); ?>
				</span>
				<span class="addComment"><a href="javascript:;" onClick="javascript:AddCommentAg(<?php echo $rowWall['id']; ?>);" title="Add a comment"> Comment |</a></span>
				<span class="icheck" title="Check this comment"></span>
			</div>
			
			</div><!-- MainContent -->
			<div class="setClear"></div>                
		
		<!-- Who check -->
		<!--
		<div class="whoCheck">
		<span class="imgCheck" title="Who checked it?"></span>
		<p><a class="linkWall" title="See this profile">You</a> and <a class="linkWall" title="See this profile">$user</a> checked it.</p>
		</div>
		<!-- Who check -->
		
		<!--seecomments -->
		<!--
		<div class="seeComments">
		<span class="imgComment" title="See all comments"></span>
		<p><a class="linkWall" title="Show all comments for this post">See others $N comments.</a></p>
		</div><!--seecomments -->
		
		
				
					<?php $oDB3=new mysql;
					$oDB3->connect();
					$comments=GenerateSelect('*',$tableReceivedComments,'idUserWhoReceiveAComment='.$valueOfIdVisiging.' AND idComment='.$rowWall['id']);
					//echo "CommentQuery: ".$comments."<br />";
					$comments=$oDB->query($comments);
					while ($rowComments = mysql_fetch_array($comments)){ 
					$oDB4=new mysql;
					$oDB4->connect();
					$registerGeneralComments=GenerateSelect('name,lastName,photo','ax_generalRegister','id='.$rowComments['idUserWhoMakeComment']);
					//echo "CommentQuery: ".$comments."<br />";
					$registerGeneralComments=$oDB->query($registerGeneralComments);
					while ($rowGeneralComments = mysql_fetch_array($registerGeneralComments)){

					?>
				<div class="answer">
				<div class="SUBindividualComm">
				<div class="photoSpeaker pSSUB">
				<img src="photoGeneral/small/small_<?php echo $rowGeneralComments['photo']; ?>" width="51" height="51" title="<?php echo $rowGeneralComments['name']." ".$rowGeneralComments['lastName']; ?>" alt="#" />
				</div>
				<div class="mainContent mCSUB">
					<span class="deleteThis2" title="Delete this comment"></span> 
					<div class="name"><?php echo $rowGeneralComments['name']." ".$rowGeneralComments['lastName']; ?>
					</div>
					<div class="wrotte"> 
					<?php echo $rowComments['comment']; ?>
					</div><!--END WROTTE -->
					<div class="commenTools">
						<span class="date">
						<?php echo ago($rowComments['time']); ?>
						</span>
						<span class="addComment"><a href="javascript:;" onClick="javascript:AddCommentAg(<?php echo $rowComments['id']; ?>);" title="Add a comment"> Comment |</a></span>
						<span class="icheck" title="Check this comment"></span>
					</div><!-- END COMMENTOOLS -->
				</div>
			</div>
		</div>

			<?php		}
		
	}
	?><div class="writeAnswer" id="writeAnswerDiv_<?php echo $row['id'];?>">
			<div id="writeArea">
			<textarea  title="Write a comment" class="yourAnswer <?php echo $rowWall['id']; ?>" id="wrtSec"  name="writeAnswer_<?php echo $rowWall['id']; ?>">Write a comment and press Enter to publish</textarea>
			<div class="spacer"></div>
			</div>
		<?php
}
?>
<div class="setClear"></div>