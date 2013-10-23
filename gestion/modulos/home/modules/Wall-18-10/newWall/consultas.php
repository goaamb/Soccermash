<script>
/*
$('.yourAnswer').focus(function(){
	if($(this).val()=='Write a comment and press Enter to publish'){
		$(this).val('');
	}
})

$('.yourAnswer').focusout(function(){
	if($(this).val() == ''){
	$(this).val('Write a comment and press Enter to publish');
	}
})*/

//$('.yourAnswer').keydown(function(e){

function enter(code){
			var code = code.keyCode;
			if (code === 13){
			
			var asd=$(this).attr("name");
			alert(asd);
			var tam=asd.length;
			alert(tam);
			var askhjdasoljqkwdsanmcxgzh=asd.substr(12,tam);
			alert("id publication: "+askhjdasoljqkwdsanmcxgzh);
			var kasdj=$("[name='writeAnswer_"+askhjdasoljqkwdsanmcxgzh+"']").val();
			alert(kasdj);
			
			
			$.ajax({
				url: dir+"Wall/agWall.php",
				data: "type=insertComment&value="+kasdj+"&askhjdasoljqkwdsanmcxgzh="+askhjdasoljqkwdsanmcxgzh,
				type: 'POST',
				dataType : 'json',
				
				beforeSend: function(){
				alert("#divGif_"+askhjdasoljqkwdsanmcxgzh);
					$("#divGif_"+askhjdasoljqkwdsanmcxgzh).html('<img src="img/indicator.gif" width="15" height="15"/>');
				},
				success: function(data){
				if(data == false){
					//loadPublications();
					alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}else{
					$("#divGif_"+askhjdasoljqkwdsanmcxgzh).html('');
					alert("Data is true: "+data);
					$.ajax({
						url: dir+"Wall/agWall.php",
						data: "type=selectComment&value="+data,
						type: 'POST',
						//dataType : 'json',
						//beforeSend: function(){
						//	$("#divGif").html('<img src="img/indicator.gif" width="15" height="15"/>');
						//},
					success: function(data2){
						if(data2){
							alert("isset: "+data2);
							alert("#forNewComments_"+askhjdasoljqkwdsanmcxgzh);
							var next2=askhjdasoljqkwdsanmcxgzh;
							next2++;
							alert("#forNewComments_: ID PUBLICTION: "+askhjdasoljqkwdsanmcxgzh);
							$("#forNewComments_"+askhjdasoljqkwdsanmcxgzh).addClass('answer').removeAttr('id').html(data2);
							$("#main_"+askhjdasoljqkwdsanmcxgzh).html($("#main_"+askhjdasoljqkwdsanmcxgzh).html()+'<div id="forNewComments_'+askhjdasoljqkwdsanmcxgzh+'"></div>');
							//$("#main_"+askhjdasoljqkwdsanmcxgzh).html('');
							//$("#forNewComments_"+askhjdasoljqkwdsanmcxgzh).removeAttr('class');
							//html(data2+'<div id="forNewComments_'+next2+'"></div>');
							//+'<div id="forNewComments_'+next2+'"></div>'
							
							//
							//
						}else{
							alert("No isset: "+data2);
						}
					}
					})
					//var another=askhjdasoljqkwdsanmcxgzh;
					//another++;
					//$("#forNewComments_"+askhjdasoljqkwdsanmcxgzh).html(data+'<div id="forNewComments_'+another+'"></div>');
					
				}
				}})
				
	
		}
}

</script>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/share/clases/lib_util.inc.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 



if(!isset($_SESSION['idUserVisiting']) OR ($_SESSION['idUserVisiting']==0)){
//echo "no seteada<br />";
$idUser=$_SESSION['iSMuIdKey'];
}else{
//echo "seteada<br />";
$idUser=$_SESSION['idUserVisiting'];
}




if(!isset($_SESSION['idProfileVisiting'])){
$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}else{
$profileVisiting=$_SESSION['idProfileVisiting'];
}

switch($action){
	case 'select';

	$user=$profileVisiting;
	$table=selectTable($user);
	$tableProfile=$table.'Wall';

	$oDB1=new mysql;
	$oDB1->connect();
	$sql="SELECT * FROM $tableProfile WHERE user_id=$idUser LIMIT 0,10";
	
	//echo $sql;
	$res=mysql_query($sql) or die(mysql_error());
	//var_dump($res);
	while($res2=mysql_fetch_array($res)){
	$idPublication=$res2['id'];
	$idUsuarioComenta=$res2['user_id_who'];
	//var_dump($idUsuarioComenta);
	$sql2="SELECT * FROM ax_generalRegister WHERE id=$idUsuarioComenta";
	//var_dump($sql2);
	$res3=mysql_query($sql2);
	while($res4=mysql_fetch_array($res3)){
	$name=$res4['name'];
	$lastName=$res4['lastName'];
	$photoWhoComment=$res4['photo'];
	}
	
	?>
	
	
	<!--
<div class="individualComm">
	<div class="photoSpeaker">-->

		<?php

		$aImPhoto=array();
		$photo=$photoWhoComment;
		$aImPhoto=@getimagesize($_SERVER['DOCUMENT_ROOT']."/photoGeneral/small/small_$photo");

		if($aImPhoto[0]>50){
		$moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).';';
		}else{
		$moveLeft='';
		}


		if($aImPhoto[1]>50){
		$moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).';';
		}else{
		$moveTop='';
		}
		?>

		<!-- <div style="<?php //echo $moveLeft; ?>"> <img src="photoGeneral/small/small_<?php //echo $photo; ?>" width="51" height="51" title="<?php //echo $name.' '.$lastName; ?>" onClick="JS_follower('<?php //echo $res2['user_id']; ?>')" alt="#" /></div>
	</div><!--photoSpeaker-->
	<!--<div class="mainContent">
		<span class="deleteThis" title="Delete this comment"></span> 
		<div class="name">
			<?php //echo $name.' '.$lastName; ?>
		</div>
		<div class="wrotte">
			<?php //echo $res2['publication']; ?>
		</div><!--END WROTTE-->

		<!--<div class="commenTools">
			<span class="date"><?php// echo ago($res2['time']); ?></span>
			<span class="addComment"><a href="#" title="Add a comment"> Comment |</a></span>
			<span class="icheck" title="Check this comment"></span>
		</div>
		
	</div>
</div>



-->





<div class="individualComm">
  	 <div class="photoSpeaker">
                <div style="<?php echo $moveLeft; ?>"><img src="photoGeneral/small/small_<?php echo $photo; ?>" onClick="JS_follower('<?php echo $res2['user_id']; ?>')" title="<?php echo $name.' '.$lastName; ?>" alt="#" /></div>
     </div><!--photoSpeaker-->
     <div class="mainContent" id="main_<?php echo $idPublication; ?>">
     								 <?php if($_SESSION["idUserVisiting"] == $_SESSION['iSMuIdKey']  || $_SESSION["idUserVisiting"] == 0){ ?><span class="deleteThis" onclick="javascript:deletePublication(<?php echo $idPublication; ?>);" title="Delete this comment"></span> <?php } ?>
									 
									 <!-- <span class="deleteThis" title="Delete this comment"></span>  -->
                     <div class="name"><?php echo $name.' '.$lastName; ?></div>
                     <div class="wrotte">
                     	<?php echo $res2['publication']; ?>
                     </div><!--END WROTTE-->
                     
                     <div class="commenTools">
                     	<span class="date"><?php echo ago($res2['time']); ?></span>
                     	<span class="addComment"><a href="#" title="Add a comment"> Comment |</a></span>
                     	<span class="icheck" title="Check this comment"></span>
    								 </div><!--commenTools-->
                     
<div class="whoCheck">
	<span class="imgCheck" title="Who checked it?"></span>
	<p><a class="linkWall" title="See this profile">You</a> and <a class="linkWall" title="See this profile">$user</a> checked it.</p>
</div><!--whocheck-->
                     
                     
                     
<!--<div class="seeComments">
	<span class="imgComment" title="See all comments"></span>
	<p><a class="linkWall" title="Show all comments for this post">See others $N comments.</a></p>
</div>--><!--seecomments-->

<?php
	$idComment=$res2['id'];
	//var_dump($idComment);
	$tableProfileComments=$table.'ReceivedComments';
	$sql3="SELECT * FROM $tableProfileComments WHERE idUserWhoReceiveAComment=$idUser and idComment=$idComment ORDER BY ID ASC";
	//var_dump($sql3);
	$res5=mysql_query($sql3);
	while($res6=mysql_fetch_array($res5)){
	$idUserWhoMakeComment=$res6['idUserWhoMakeComment'];
	$publicationWhoMakeComment=$res6['comment'];
	$timeWhoMakeComment=$res6['time'];
	$idComment=$res6['id'];
?>

<div class="answer">
<!---------------------------------------------------------------->
<div class="SUBindividualComm">
  <div class="photoSpeaker pSSUB">
  <?php
  

  
	$sql4="SELECT * FROM ax_generalRegister WHERE id=$idUserWhoMakeComment";
	$res7=mysql_query($sql4);
	while($res8=mysql_fetch_array($res7)){
		$nameWhoMakeComment=$res8['name'];
		$lastNameWhoMakeComment=$res8['lastName'];
		$photoWhoMakeComment=$res8['photo'];
	}
  
  
    	$aImPhoto=array();
		$photo=$photoWhoMakeComment;
		$aImPhoto=@getimagesize($_SERVER['DOCUMENT_ROOT']."/photoGeneral/small/small_$photo");

		if($aImPhoto[0]>50){
		$moveLeft='margin-left:-'.(($aImPhoto[0]-50)/2).';';
		}else{
		$moveLeft='';
		}


		if($aImPhoto[1]>50){
		$moveTop='margin-top:-'.(($aImPhoto[1]-50)/2).';';
		}else{
		$moveTop='';
		}
  
  
  ?>
<div style="<?php echo $moveLeft; ?>"><img src="photoGeneral/small/small_<?php echo $photo; ?>" onClick="JS_follower('<?php echo $idUserWhoMakeComment; ?>')" title="<?php echo $nameWhoMakeComment.' '.$lastNameWhoMakeComment; ?>" alt="#" /></div>
									  
  </div><!--photoSpeaker-->
  <div class="mainContent mCSUB">
    
    <?php if($_SESSION["idUserVisiting"] == $_SESSION['iSMuIdKey']  || $_SESSION["idUserVisiting"] == 0){ ?><span class="deleteThis2" onclick="javascript:deleteComment(<?php echo $idComment; ?>);" title="Delete this comment"></span> <?php } ?>
	<!-- <span class="deleteThis2" title="Delete this comment"></span>  -->
    <div class="name"><?php echo $nameWhoMakeComment.' '.$lastNameWhoMakeComment; ?></div>
    <div class="wrotte"> 
       <?php echo $publicationWhoMakeComment; ?>
    </div>
    <div class="commenTools">
      <span class="date"><?php echo ago($timeWhoMakeComment); ?></span>
      <span class="addComment"><a href="#" title="Add a comment"> Comment |</a></span>
      <span class="icheck" title="Check this comment"></span>
    </div>
  </div><!--SUBmainContent-->
</div><!--SUBindividualComm-->
<!---------------------------------------------------------------->
</div><!--answer-->
<?php } ?>					
<div id="forNewComments_<?php echo $idPublication; ?>"></div>                  
<div class="writeAnswer" id="writeAnswerDiv_<?php echo $idPublication; ?>">				
<!-- <div class="writeAnswer"> -->
<div id="writeArea">
  <textarea  title="Write a comment" onKeyPress="javascript:enter(event);" class="yourAnswer <?php echo $idPublication; ?>" id="wrtSec"  name="writeAnswer_<?php echo $idPublication; ?>">Write a comment and press Enter to publish</textarea>
  <div id="divGif_<?php echo $idPublication; ?>"></div>
  <div class="spacer"></div>
</div>
</div><!--writeAns--> 
                    
                    
    </div><!--maincontent--> 
    <div class="setClear"></div>                
  </div><!--individualComm-->
  <!--////-->



	<?php
	
		
	}
	

	
}
?>


































