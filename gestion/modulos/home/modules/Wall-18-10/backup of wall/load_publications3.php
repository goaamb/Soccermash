<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/soccermashTest2/gestion/lib/share/clases/lib_util.inc.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/soccermashTest2/gestion/modulos/home/modules/classAndres.php"); 

//if($_SERVER['HTTP_REFERER']!='http://www.soccermash.com.php5-22.dfw1-2.websitetestlink.com/soccermashTest2/index.php'){
//echo "entro en index";
//var_dump($agdate);
//echo "<br />";
//var_dump($agtime);
//echo "<br />";
//$dasjkldasyqwebmasdnmpsa=cleanDirty($agdate);
//$iUserIdSM=$dasjkldasyqwebmasdnmpsa;

//}else if($_SERVER['HTTP_REFERER']!='http://www.soccermash.com.php5-22.dfw1-2.websitetestlink.com/soccermashTest2/home.php'){
//echo "Entro en home";
//$iUserIdSM	   = $_SESSION["iSMuIdKey"];
//$dasjkldasyqwebmasdnmpsa=dirty($iUserIdSM);	
//var_dump($iUserIdSM);
//echo "<br />";
//$fdkjasfdsjakldausoiq=$_SESSION["iSMuProfTypeKey"];
//var_dump($fdkjasfdsjakldausoiq);
//echo "<br />";
//$dasjkldasyqwebmasdnmpsa=cleanDirty($iUserIdSM);
//var_dump($dasjkldasyqwebmasdnmpsa);
//echo "<br />";

//}



/*function ago($time) {
//  $time = strtotime($time);
//echo "Time actule: ".time()."<br />Time guardado en bd: ".$time."<br />";
  $delta = time() - $time;
  if ($delta < 60) {
    return 'less than a minute ago.';
  } else if ($delta < 120) {
    return 'about a minute ago.';
  } else if ($delta < (45 * 60)) {
    return  floor($delta / 60) . ' minutes ago.';
  } else if ($delta < (90 * 60)) {
    return 'about an hour ago.';
  } else if ($delta < (24 * 60 * 60)) {
    return  floor($delta / 3600) . ' hours ago.';
  } else if ($delta < (48 * 60 * 60)) {
    return '1 day ago.';
  } else {
    return  floor($delta / 86400) . ' days ago.';
  }
}
*/
//echo "id: ".$iUserIdSM."<br />";
//echo "prfoileId: ".$fdkjasfdsjakldausoiq."<br />";
//var_dump($iUserIdSM);

//echo "sucio: ".$dasjkldasyqwebmasdnmpsa."<br />";
//echo "<br /> VISITING: ".$_SESSION["idUserVisiting"];
//echo "<br /> id Key: ".$_SESSION["iSMuIdKey"];
//echo "<br /> id Profile: ".$_SESSION["iSMuProfTypeKey"]."<br />";

$time=time();
if(!isset($_SESSION['idUserVisiting']) OR ($_SESSION['idUserVisiting']==0)){
echo "no seteada<br />";
$agdate=$_SESSION['iSMuIdKey'];
}else{
echo "seteada<br />";
$agdate=$_SESSION['idUserVisiting'];
}

echo "idUser: ".$_SESSION['iSMuIdKey']."<br />";
echo "idUserVisiting: ".$_SESSION['idUserVisiting']."<br />";
echo "idVisiting: ".$agdate."<br />";
/*
$oDB3=new mysql;
$oDB3->connect();
$asd5=$oDB3->query("SELECT profileId FROM ax_generalRegister WHERE id=$agdate");
while ($row5 = mysql_fetch_array($asd5)){
	$profileVisiting=$row5['profileId'];
}*/

if(!isset($_SESSION['idProfileVisiting'])){;
$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}else{
$profileVisiting=$_SESSION['idProfileVisiting'];
}
echo "Profilevisiting: ".$profileVisiting."<br />";

$agtime=$profileVisiting;
$table=selectTable($agtime);
$anexo='Wall';
$anexo2='ReceivedComments';
$tableProfile=$table.$anexo;
$tableProfileComments=$table.$anexo2;
echo "tableWall: ".$tableProfile."<br />";
echo "tableReceivedComments: ".$tableProfileComments."<br />";

//echo "TableProfile: ".$tableProfile;
//echo "TableProfile: ".$tableProfileComments;
//var_dump($tableProfile);
//die('muerto');
//echo "tableProfile: ".$tableProfile;
//$agdate=$_SESSION["iSMuIdKey"];
?>

<?php 
//if(!isset($_POST['page'])){
//	$pagina=1;
//}else{
//	$pagina=$_POST['page'];
//}

$showOnly=5;

$oDB=new mysql;
$oDB2=new mysql;
$oDB->connect();
$oDB2->connect();

//echo "SELECT * FROM $tableProfile WHERE user_id=$iUserIdSM ORDER BY ID DESC";
$asd=$oDB->query("SELECT * FROM $tableProfile WHERE user_id=$agdate ORDER BY ID DESC");
echo "SELECT * FROM $tableProfile WHERE user_id=$agdate ORDER BY ID DESC";
$allReg = mysql_num_rows($asd);
$totalPages = ceil($allReg / $showOnly);


?><script>
function loadPublications(){
//alert("loading =) ");
	var d=new Date();
	$('#publications').load(dir+'Wall/load_publications.php');
}
function moreResults(){
	//alert("clicked");
}

function AddCommentAg(id){
	$('.'+id).val('');
	$('.'+id).focus();
}

function deleteComment(id){
//alert(id);
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=deleteComment&value="+id,
				type: 'POST',
				dataType : 'json',
				//beforeSend:,
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications();
				}else{
					loadPublications();
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}
				}})
}

function deletePublication(id){
//alert(id);
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=deletePublication&value="+id,
				type: 'POST',
				dataType : 'json',
				//beforeSend:,
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
					loadPublications();
				}else{
					loadPublications();
				}
				}})
}


//function loadComments(dkjqwoidsal){
//$('#dsakjhjkjkWKEQJKDOsd').load(dir+'Wall/load_comments.php?dkjqwoidsal='+dkjqwoidsal);
//}

$('.yourAnswer').keypress(function(e){

			var code = e.keyCode;
			if (code === 13){
			var asd=$(this).attr("name");
			//alert(asd);
			var tam=asd.length;
			//alert(tam);
			var askhjdasoljqkwdsanmcxgzh=asd.substr(12,tam);
			//alert(askhjdasoljqkwdsanmcxgzh);
			var kasdj=$("[name='writeAnswer_"+askhjdasoljqkwdsanmcxgzh+"']").val();
			//alert(kasdj);
			
			
			$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=insertComment&value="+kasdj+"&askhjdasoljqkwdsanmcxgzh="+askhjdasoljqkwdsanmcxgzh,
				type: 'POST',
				dataType : 'json',
				//beforeSend:,
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications();
				}else{
					loadPublications();
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}
				}})
				
	
		}
	})
</script>
<?php
//echo "Mostrando la página " . $pagina . " de " . $totalPages . "<p>"; 


while ($row = mysql_fetch_array($asd)) {
$user_id_who=$row['user_id_who'];
?>
  <!--////-->
  <div class="individualComm">
  	 <div class="photoSpeaker">
	  <?php $asd2=$oDB2->query("SELECT name,lastName,photo FROM ax_generalRegister WHERE id=$user_id_who");
	  echo "SELECT name,lastName,photo FROM ax_generalRegister WHERE id=$user_id_who";
	  
while ($row2 = mysql_fetch_array($asd2)){
echo '<img src="photoGeneral/small/small_'.$row2['photo'].'" width="51" height="51" title="'.$row2['name']," ",$row2['lastName'].'" alt="#" />';
?>
     </div><!--photoSpeaker-->
     <div class="mainContent">
     								 <span class="deleteThis" onclick="javascript:deletePublication(<?php echo $row['id']; ?>);" title="Delete this comment"></span> 
                     <div class="name"><?php
					 
					
echo $row2['name']," ",$row2['lastName'];
} ?></div>
                     <div class="wrotte">
                     
<?php
echo $row['publication'];
?>
                      </div><!--END WROTTE-->
                     
                     <div class="commenTools">
                     	<span class="date"><?php
echo ago($row['time']);
?></span>
                     	<span class="addComment"><a href="javascript:;" onClick="javascript:AddCommentAg(<?php echo $row['id']; ?>);" title="Add a comment"> Comment |</a></span>
                     	<span class="icheck" title="Check this comment"></span>
    								 </div><!--commenTools-->
                     
                     <!--ACA LLAMA A WHO CHECK--->
                     
                     
                     
                     <!---ACA LLAMA A SEE COMMENTS--->
                     
 											
                      <!---ACA LLAMA A ANSWER--->
 										
                     
                    <!--ACA LLAMA A WRITEANSWER, 2 TEXTAREA-->
					<?PHP
					$oDB58=new mysql;
					$oDB58->connect();
					$idComment=$row['id'];
					$asd58=$oDB->query("SELECT * FROM $tableProfileComments WHERE idUserWhoReceiveAComment=$agdate and idComment=$idComment ORDER BY ID ASC");
					echo "SELECT * FROM $tableProfileComments WHERE idUserWhoReceiveAComment=$agdate and idComment=$idComment ORDER BY ID ASC";
					
					//echo "Num Rows: ".$num_rows;
					
					while ($row58 = mysql_fetch_array($asd58)) {
					
					
					?><div  class="answer">
<!---------------------------------------------------------------->
						<div class="SUBindividualComm">
						  <div class="photoSpeaker pSSUB">
					<?php
					$whoMake=$row58['idUserWhoMakeComment'];
					$oDB59=new mysql;
					$oDB59->connect();
					$asd59=$oDB->query("SELECT name,lastName,photo FROM ax_generalRegister WHERE id=$whoMake");
					echo "SELECT name,lastName,photo FROM ax_generalRegister WHERE id=$whoMake";
					while ($row59 = mysql_fetch_array($asd59)) {
						$nameWhoMakeComment=$row59['name'];
						//echo "<br />nameWhoMakeComment ".$nameWhoMakeComment;
						$lastNameWhoMakeComment=$row59['lastName'];
						//echo "<br />lastNameWhoMakeComment ".$lastNameWhoMakeComment;
						$photoWhoMakeComment=$row59['photo'];
						//echo "<br />photoWhoMakeComment ".$photoWhoMakeComment;
					}
					?>
							<img src="photoGeneral/small/small_<?php echo $photoWhoMakeComment; ?>" width="51" height="51" title="<?php echo $nameWhoMakeComment." ".$lastNameWhoMakeComment; ?>" alt="#" />
						  </div><!--photoSpeaker-->
						  <div class="mainContent mCSUB">
							<?php if($_SESSION['iSMuIdKey']===$whoMake){ ?><span class="deleteThis2" onclick="javascript:deleteComment(<?php echo $row58['id']; ?>);" title="Delete this comment"></span> <?php } ?>
							<div class="name"><?php echo $nameWhoMakeComment." ".$lastNameWhoMakeComment; ?></div>
							<div class="wrotte"> 
							   <?php echo $row58['comment']; ?>
							</div>
							<div class="commenTools">
							  <span class="date"><?php echo ago($row58['time']); ?></span>
							  <!-- <span class="addComment"><a href="#" title="Add a comment"> Comment |</a></span> -->
							  <span class="icheck" title="Check this comment"></span>
							</div>
						  </div><!--SUBmainContent-->
						</div><!--SUBindividualComm-->
</div>
						<?php } ?>
						
					<div class="writeAnswer" id="writeAnswerDiv_<?php echo $row['id'];?>">
<div id="writeArea">
  <textarea  title="Write a comment" class="yourAnswer <?php echo $row['id']; ?>" id="wrtSec"  name="writeAnswer_<?php echo $row['id']; ?>">Write a comment and press Enter to publish</textarea>
  <div class="spacer"></div>
</div>
</div><!--writeAns--> 
                    
                    
    </div><!--maincontent--> 
    <div class="setClear"></div>                
  </div><!--individualComm-->
  <!--////--><!--commenTools-->
<?php 
}

?>
<div id="seePrevious"><p><a title="See previous messages" href="javascript:;" onclick="javascript:moreResults();">Previous</a></p></div>  
  