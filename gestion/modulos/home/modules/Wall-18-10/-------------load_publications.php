<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/gestion/lib/site_ini.php"; 
?><script>
G.util.ready(function(){
$('#home *').tipsy({gravity: 'n'});
(function(a){a.fn.autoResize=function(j){var b=a.extend({onResize:function(){},animate:true,animateDuration:150,animateCallback:function(){},extraSpace:20,limit:1000},j);this.filter('textarea').each(function(){var c=a(this).css({resize:'none','overflow-y':'hidden'}),k=c.height(),f=(function(){var l=['height','width','lineHeight','textDecoration','letterSpacing'],h={};a.each(l,function(d,e){h[e]=c.css(e)});return c.clone().removeAttr('id').removeAttr('name').css({position:'absolute',top:0,left:-9999}).css(h).attr('tabIndex','-1').insertBefore(c)})(),i=null,g=function(){f.height(0).val(a(this).val()).scrollTop(10000);var d=Math.max(f.scrollTop(),k)+b.extraSpace,e=a(this).add(f);if(i===d){return}i=d;if(d>=b.limit){a(this).css('overflow-y','');return}b.onResize.call(this);b.animate&&c.css('display')==='block'?e.stop().animate({height:d},b.animateDuration,b.animateCallback):e.height(d)};c.unbind('.dynSiz').bind('keyup.dynSiz',g).bind('keydown.dynSiz',g).bind('change.dynSiz',g);});return this;};})(jQuery);
$('.yourAnswer').autoResize();
});
</script>
<?php


if(!isset($_GET['page'])){
	$page=0;
	$inicio=0;
}else if($_GET['page'] == 0){
	$inicio=0;
	
}else{
	$inicio=$_GET['page']*6;
}



function GetVideoIdFromUrl($url) {
    $parts = explode('?v=',$url);
    if (count($parts) == 2) {
        $tmp = explode('&',$parts[1]);
        if (count($tmp)>1) {
            return $tmp[0];
        } else {
            return $parts[1];
        }
    } else {
        return $url;
    }
}

function EmbedVideo($retornoEsto,$width = 425,$height = 350) {
	return '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$retornoEsto.'"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$retornoEsto.'" type="application/x-shockwave-flash" wmode="transparent" width="'.$width.'" height="'.$height.'"></embed></object>';
}


function GetImg($videoid,$imgid = 1) {
	return "http://img.youtube.com/vi/$videoid/$imgid.jpg";
}
 
 
?>

<div id="top"></div><script>

textoMuroDefecto="<?php print $_IDIOMA->traducir("Write a public message on this wall");?>";

$(document).ready(function(){
	$('.hoverWhitjQueryAg').hover(function () {
        this.src = 'img/tick.png';
    }, function () {
        this.src = 'img/tick_off.png';
    });
	
	$('.hoverUnCheckAg').hover(function () {
        this.src = 'img/unchek.png';
    }, function () {
        this.src = 'img/tick.png';
    });
	
	$('.hoverUnCheckPublicationsAg').hover(function () {
       this.src = 'img/unchek.png';
    }, function () {
        this.src = 'img/tick.png';
    });
	
	$('.hideForMoreResults').css('display','none');
	

})

function seeMoreComments(id){

	$('.hideForMoreResults_'+id).fadeIn('600');
	$('.'+id).fadeOut('0');
	//$('#forHide').hide('100');
}


function checkThisCommentag(id){
	
	


	//alert(id);
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=checkComment&value="+id,
				type: 'POST',
				dataType : 'json',
				//beforeSend:,
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications(<?php echo $page; ?>);
				}else{
					loadPublications(<?php echo $page; ?>);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
			}
		}
	})
}

function unCheckThisCommentag(id){

	//alert("uncheck this id: "+id);
	
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=unCheckComment&value="+id,
				type: 'POST',
				dataType : 'json',
				//beforeSend:,
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications(<?php echo $page; ?>);
				}else{
					loadPublications(<?php echo $page; ?>);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
			}
		}
	})

}

function checkThisPublicationag(id){
	
	//alert(id);	
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=checkPublication&value="+id,
				type: 'POST',
				dataType : 'json',
				
				
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications(<?php echo $page; ?>);
				}else{
					loadPublications(<?php echo $page; ?>);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}
				}})

}


function unCheckThisPublicationsag(id){

	//alert("uncheck this id: "+id);
	
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=unCheckPublication&value="+id,
				type: 'POST',
				dataType : 'json',
				//beforeSend:,
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications(<?php echo $page; ?>);
				}else{
					loadPublications(<?php echo $page; ?>);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
			}
		}
	})

}


function loadPublications(page){
//alert("loading =) ");
	
	$('#publications').load(dir+'Wall/load_publications.php?page='+page);
}
function moreResults(){
	//alert("clicked");
}

function AddCommentAg(id){
	if($('.'+id).val()=="<?php print $_IDIOMA->traducir('Write a comment and press Enter to publish it.');?>"){
	$('.'+id).val('');
	$('.'+id).focus();
	}
	
}

function deleteComment(id){
var sinoCom=confirm("<?php print $_IDIOMA->traducir('you want to remove this comment');?>");
if(sinoCom==true){
//$("#mainContent").html('<img src="img/indicator.gif" width="15" height="15"/>');
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=deleteComment&value="+id,
				type: 'POST',
				dataType : 'json',
				/*beforeSend:function(){
					$("#mainContent").html('<img src="img/indicator.gif" width="15" height="15"/>');
				},*/
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications(<?php echo $page; ?>);
				}else{
					loadPublications(<?php echo $page; ?>);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}
				}})
}
}
function deletePublication(id){
var sinoPub=confirm("<?php print $_IDIOMA->traducir('you want to remove this publication');?>");
if(sinoPub==true){
//$("#mainContent").html('<img src="img/indicator.gif" width="15" height="15"/>');
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=deletePublication&value="+id,
				type: 'POST',
				dataType : 'json',
				/*beforeSend:function(){
					$("#mainContent").html('<img src="img/indicator.gif" width="15" height="15"/>');
				},*/
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
					loadPublications(<?php echo $page; ?>);
				}else{
					loadPublications(<?php echo $page; ?>);
				}
				}})
	}
}

//function loadComments(dkjqwoidsal){
//$('#dsakjhjkjkWKEQJKDOsd').load(dir+'Wall/load_comments.php?dkjqwoidsal='+dkjqwoidsal);
//}

$('.yourAnswer').focus(function(){
	if($(this).val()=='<?php print $_IDIOMA->traducir('Write a comment and press Enter to publish it.');?>'){
		$(this).val('');
	}
})

$('.yourAnswer').focusout(function(){
	if($(this).val() == ''){
	$(this).val('<?php print $_IDIOMA->traducir('Write a comment and press Enter to publish it.');?>');
	}
})

$('.yourAnswer').keydown(function(e){

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
				beforeSend: function(){
					$("#divGif_"+askhjdasoljqkwdsanmcxgzh).html('<img src="img/indicator.gif" width="15" height="15"/>');
				},
				success: function(data){
				if(data == true){
				
					//alert("Data is true: "+data);
					loadPublications(<?php echo $page; ?>);
				}else{
					loadPublications(<?php echo $page; ?>);
					//alert("For some reason we have a problem saving your publication, please try again, if this problem persist, so contact us");
				}
				}})
				
	
		}
	})
</script>


<?php 
$nameOfThis='';
$nameOfThis2='';
$lastNameOfThis='';
$lastNameOfThis2='';
$idOfThis='';
$idOfThis2='';
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/lib/share/clases/lib_util.inc.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 

//if($_SERVER['HTTP_REFERER']!='http://www.soccermash.com.php5-22.dfw1-2.websitetestlink.com/index.php'){
//echo "entro en index";
//var_dump($agdate);
//echo "<br />";
//var_dump($agtime);
//echo "<br />";
//$dasjkldasyqwebmasdnmpsa=cleanDirty($agdate);
//$iUserIdSM=$dasjkldasyqwebmasdnmpsa;

//}else if($_SERVER['HTTP_REFERER']!='http://www.soccermash.com.php5-22.dfw1-2.websitetestlink.com/home.php'){
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
//echo "no seteada<br />";
$agdate=$_SESSION['iSMuIdKey'];
}else{
//echo "seteada<br />";
$agdate=$_SESSION['idUserVisiting'];
}

//echo "idUser: ".$_SESSION['iSMuIdKey']."<br />";
//echo "idUserVisiting: ".$_SESSION['idUserVisiting']."<br />";
//echo "idVisiting: ".$agdate."<br />";
/*
$oDB3=new mysql;
$oDB3->connect();
$asd5=$oDB3->query("SELECT profileId FROM ax_generalRegister WHERE id=$agdate");
while ($row5 = mysql_fetch_array($asd5)){
	$profileVisiting=$row5['profileId'];
}*/

if(!isset($_SESSION['idProfileVisiting'])){
$profileVisiting=$_SESSION['iSMuProfTypeKey'];
}else{
$profileVisiting=$_SESSION['idProfileVisiting'];
}
//echo "Profilevisiting: ".$profileVisiting."<br />";

$agtime=$profileVisiting;
$table=selectTable($agtime);
$anexo='Wall';
$anexo2='ReceivedComments';
$anexo3='PubComChecks';
$tableProfile=$table.$anexo;
$tableProfileComments=$table.$anexo2;
$tableProfilePubComChecks=$table.$anexo3;
//echo "tableWall: ".$tableProfile."<br />";
//echo "tableReceivedComments: ".$tableProfileComments."<br />";

//echo "TableProfile: ".$tableProfile;
//echo "TableProfile: ".$tableProfileComments;
//var_dump($tableProfile);
//die('muerto');
//echo "tableProfile: ".$tableProfile;
//$agdate=$_SESSION["iSMuIdKey"];
?>

<?php 


$showOnly=6;
$oDB=new mysql;
$oDB->connect();
$oDB2=new mysql;
$oDB2->connect();
$oDBpag=new mysql;
$oDBpag->connect();

//echo "SELECT * FROM $tableProfile WHERE user_id=$iUserIdSM ORDER BY ID DESC";

$asd=$oDB->query("SELECT * FROM $tableProfile WHERE user_id=$agdate ORDER BY ID DESC LIMIT $inicio,$showOnly");

$paginator=$oDBpag->query("SELECT * FROM $tableProfile WHERE user_id=$agdate");
$allReg = mysql_num_rows($paginator);
$totalPages = ceil($allReg / $showOnly);

$paginas=$page;
++$paginas;
//echo  "$paginas/$totalPages";

//echo "SELECT * FROM $tableProfile WHERE user_id=$agdate ORDER BY ID DESC";



while ($row = mysql_fetch_array($asd)) {
$user_id_who=$row['user_id_who'];
?>
  <!--////-->
  <div class="individualComm">
  	 <div class="photoSpeaker">
	  <?php $asd2=$oDB2->query("SELECT id,name,lastName,photo FROM ax_generalRegister WHERE id=$user_id_who");
	  //echo "SELECT name,lastName,photo FROM ax_generalRegister WHERE id=$user_id_who";
	  
while ($row2 = mysql_fetch_array($asd2)){



	$aImPhoto=array();
	$photo=$row2['photo'];
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
//var_dump($moveTop);
//var_dump($moveLeft);

	
echo '<div style="'.$moveLeft.'"><img src="photoGeneral/small/small_'.$row2['photo'].'" title="'.$row2['name']," ",$row2['lastName'].'" onClick="JS_follower('.$row2['id'].');" alt="#" /></div>';
?>
     </div><!--photoSpeaker-->
     <div class="mainContent">
     								 <?php if($_SESSION['iSMuIdKey'] == $agdate || $_SESSION['iSMuIdKey'] == 0){ ?><span class="deleteThis" onclick="javascript:deletePublication(<?php echo $row['id']; ?>);" title="<?php print $_IDIOMA->traducir('Delete this comment');?>"></span> <?php } ?>
                     <?php echo '<div class="name" onClick="JS_follower('.$row2['id'].');">'; ?>
					 
					 <?php				 
					
echo $row2['name']," ",$row2['lastName'];
} ?></div>
                     <div class="wrotte">
                     
<?php

						/*Incrustar videos de youtube*/
//$arreglito=explode(" ",$row['publication']);

//foreach($arreglito as $arr){
	
	//if($url=preg_match('/youtube\.com\/watch\?v=([A-Za-z0-9._%-]*)[&\w;=\+_\-]*/',$arr)){
		//$retornoEsto=GetVideoIdFromUrl($arr);
		//$segundoRetorno=EmbedVideo($retornoEsto);
		//$tercerRetorno=GetImg($retornoEsto);
		
		//echo "<img src='$tercerRetorno' width='130' height='97' border='0'> ";
		//echo $segundoRetorno;
	//}else{
		//echo $arr." ";
	//}
//};
						/*End incrustar videos de youtube*/
echo $row['publication'];
?>
                      </div><!--END WROTTE-->
                     
                     <div class="commenTools">
                     	<span class="date"><?php
echo ago($row['time']);
?></span>
                     	<span class="addComment"><a href="javascript:;" onClick="javascript:AddCommentAg(<?php echo $row['id']; ?>);" title="<?php print $_IDIOMA->traducir('Add a comment');?>"> <?php print $_IDIOMA->traducir('Comment');?> |</a></span>
                     	
    								 
									

							<?php
							$usersCheck=NULL;
							 $you=false;
							 $resProfiles=NULL;
							 $count=0;
							 $valOfAll=NULL;
								   $oDB70=new mysql;
								   $oDB70->connect();
								   $commentForRow=$row['id'];
								   //var_dump($commentForRow);
								   
								   $asd70=$oDB->query("SELECT * FROM $tableProfilePubComChecks WHERE id_publication=$commentForRow");
								   
								   while ($rowChecks= mysql_fetch_array($asd70)){
										
										$usersCheck.=$rowChecks['id_user_who_check'].',';
										
										
								   }		
								
									
								//var_dump($usersCheck);
								if($usersCheck != NULL){
								
								$results = explode(',',$usersCheck);
								foreach($results as $res){
								$valOfAll[]=$res;
								$count++;
								if($res==$_SESSION['iSMuIdKey']){
								$you=true;
								}
								}
								//echo " count ".$count;

								//var_dump($valOfAll);
								}
								?>
								
								
								
								<img src="<?php echo ($you) ? "img/tick.png" : "img/tick_off.png" ; ?>" <?php echo ($you) ? "class='hoverUnCheckPublicationsAg' onClick='javascript:unCheckThisPublicationsag(id);' title='Uncheck this publication'" : "class='hoverWhitjQueryAg' onClick='javascript:checkThisPublicationag(id);' title='". $_IDIOMA->traducir('Check this publication')."'" ; ?> id="<?php echo $row['id']; ?>" />
								
								
								
								<!-- <span class="icheck" title="Check this comment" onClick="javascript:checkThisPublicationag(id);" id="<?php echo $row['id']; ?>"></span> -->
							</div>	 
							
									



							<?php
								
								
								//echo "you: ".$you;
								$count=--$count;
								
								if(($count==1) AND ($you)){
								
								//echo "entro en 1+you";
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $_SESSION['iSMuIdKey'];
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">'.$_IDIOMA->traducir("You").'</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div>';
							}
							
								if(($count == 1) AND (!$you)){
								
								//echo "entro en 1-you";
								/*$valueOfsomething=strlen($resProfiles);
								$valueOfsomething=$valueOfsomething-2;
								$valueOfsomething=substr($resProfiles,0,$valueOfsomething);*/
								//echo 
								$ress=$valOfAll[0];
								$oDB61=new mysql;
								$oDB61->connect();
								
								$asd61=$oDB61->query("SELECT id,name,lastName FROM ax_generalRegister WHERE id=$ress");
								//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$ress";
								while($asd61Rows = mysql_fetch_array($asd61)){
								$idOfThis=$asd61Rows['id'];
								$nameOfThis=$asd61Rows['name'];
								$lastNameOfThis=$asd61Rows['lastName'];
								}
								
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $idOfThis;
								echo '); return false;"	class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $nameOfThis." ".$lastNameOfThis;
								echo '</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div>';							
							}
							
							if(($count == 2) AND ($you)){
								//echo "entro en 2+you";
								if($valOfAll[0]==$_SESSION['iSMuIdKey']){
								$valForQuery=$valOfAll[1];
								}else{
								$valForQuery=$valOfAll[0];
								}
								//echo "valofall0";
								//var_dump($valOfAll[0]);
								//echo "<br />valofall1";
								//var_dump($valOfAll[1]);
								//echo "<br />idkey";
								//var_dump($_SESSION['iSMuIdKey']);
								//echo "<br />";
								$oDB62=new mysql;
								$oDB62->connect();
								//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery";
								$asd62=$oDB62->query("SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery");
								while($asd62Rows = mysql_fetch_array($asd62)){
								$idOfThis2=$asd62Rows['id'];
								$nameOfThis2=$asd62Rows['name'];
								$lastNameOfThis2=$asd62Rows['lastName'];
								}

								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $_SESSION['iSMuIdKey'];
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">'.$_IDIOMA->traducir("you").'</a> '.$_IDIOMA->traducir("you").' <a onClick="JS_follower(';
								echo $idOfThis2;
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $nameOfThis2." ".$lastNameOfThis2;
								echo '</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div>';	
								
							}
							
							
							if(($count == 2) AND (!$you)){
								//echo "entro en 2-you";
								
								$valForQuery1=$valOfAll[0];
								$valForQuery2=$valOfAll[1];
								$oDB63=new mysql;
								$oDB63->connect();
								//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery1";
								$asd63=$oDB63->query("SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery1");
								while($asd63Rows = mysql_fetch_array($asd63)){
								$idOfThis3=$asd63Rows['id'];
								$nameOfThis3=$asd63Rows['name'];
								$lastNameOfThis3=$asd63Rows['lastName'];
								}
								
								$oDB64=new mysql;
								$oDB64->connect();
								//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery2";
								$asd64=$oDB64->query("SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery2");
								while($asd64Rows = mysql_fetch_array($asd64)){
								$idOfThis4=$asd64Rows['id'];
								$nameOfThis4=$asd64Rows['name'];
								$lastNameOfThis4=$asd64Rows['lastName'];
								}

								
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $idOfThis3;
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $nameOfThis3." ".$lastNameOfThis3;
								echo '</a> '.$_IDIOMA->traducir("and").' <a onClick="JS_follower(';
								echo $idOfThis4;
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $nameOfThis4." ".$lastNameOfThis4;
								echo ' </a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div>';		
								
							}
							
							if(($count >= 3) AND ($you)){
								//echo "entro en 3+you";
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $_SESSION['iSMuIdKey'];
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">'.$_IDIOMA->traducir("You").'</a> '.$_IDIOMA->traducir("and").' <a class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo --$count.'</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div>';
							}
							
							
							if(($count >= 3) AND (!$you)){
								//echo "entro en 3-you";
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'"></a><a class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $count.'</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div>';
							}
							$count=0;
							$you=false;
							$count=0;
							$usersCheck=NULL; 
							$resProfiles=NULL;
							$valOfAll=NULL;
									 ?>
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
			 
								
					<?PHP
					$oDB58=new mysql;
					$oDB58->connect();
					$idComment=$row['id'];
					$asd58=$oDB->query("SELECT * FROM $tableProfileComments WHERE idUserWhoReceiveAComment=$agdate and idComment=$idComment ORDER BY ID ASC");
					// "SELECT * FROM $tableProfileComments WHERE idUserWhoReceiveAComment=$agdate and idComment=$idComment ORDER BY ID ASC";
					
					//echo "Num Rows: ".$num_rows;
					$numero = mysql_num_rows($asd58);
					//echo "total ".$numero;
					$llegar=0;
					
					$others=$numero-2;
					
					if($numero >= 3){
					?><div class="seeComments <?php echo $idComment; ?>1">
						<span class="imgComment" title="<?php print $_IDIOMA->traducir("See all comments");?>"></span>
						<p><a class="linkWall" title="<?php print $_IDIOMA->traducir("Show all comments for this post");?>" onClick="javascript:seeMoreComments(<?php echo $idComment; ?>1);"><?php print $_IDIOMA->traducir("See others");?> <?php echo $others; ?> <?php print $_IDIOMA->traducir("comments");?>.</a></p>
					</div><?php }
					
					while ($row58 = mysql_fetch_array($asd58)) {
					$llegar++;
					
					?><div  class="answer<? if($llegar < $numero-1){echo " hideForMoreResults hideForMoreResults_".$idComment.'1';} ?> ">
<!---------------------------------------------------------------->
						<div class="SUBindividualComm">
						  <div class="photoSpeaker pSSUB">
					<?php
					$whoMake=$row58['idUserWhoMakeComment'];
					$oDB59=new mysql;
					$oDB59->connect();
					$asd59=$oDB->query("SELECT id,name,lastName,photo FROM ax_generalRegister WHERE id=$whoMake");
					//echo "SELECT name,lastName,photo FROM ax_generalRegister WHERE id=$whoMake";
					while ($row59 = mysql_fetch_array($asd59)) {
						$nameWhoMakeComment=$row59['name'];
						//echo "<br />nameWhoMakeComment ".$nameWhoMakeComment;
						$lastNameWhoMakeComment=$row59['lastName'];
						//echo "<br />lastNameWhoMakeComment ".$lastNameWhoMakeComment;
						$photoWhoMakeComment=$row59['photo'];
						//echo "<br />photoWhoMakeComment ".$photoWhoMakeComment;
						$idWhoMakeComment=$row59['id'];
						
					}
					
					
					
					
	$aImPhoto=array();
    $aImPhoto=@getimagesize($_SERVER['DOCUMENT_ROOT']."/photoGeneral/small/small_$photoWhoMakeComment");
    
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
	
//var_dump($aImPhoto);	
	echo '<div style="'.$moveLeft.'"><img src="photoGeneral/small/small_'.$photoWhoMakeComment.'" onClick="JS_follower('.$idWhoMakeComment.');" title="'.$nameWhoMakeComment.' '.$lastNameWhoMakeComment.'" alt="#" /></div>';
					?>
						  </div><!--photoSpeaker-->
						  <div class="mainContent mCSUB">
							
							<?php if($_SESSION['iSMuIdKey'] == $agdate || $_SESSION['iSMuIdKey'] == 0){ ?><span class="deleteThis2" onclick="javascript:deleteComment(<?php echo $row58['id']; ?>);" title="<?php print $_IDIOMA->traducir("Delete this comment");?>"></span> <?php } ?>
							<?php echo '<div class="name" "onClick="JS_follower('.$idWhoMakeComment.');" >  '.$nameWhoMakeComment.' '.$lastNameWhoMakeComment.'</div>'; ?>
							 
							<div class="wrotte"> 
							   <?php echo $row58['comment']; ?>
							</div>
							<div class="commenTools">
							  <span class="date"><?php echo ago($row58['time']); ?></span>
							  <!-- <span class="addComment"><a href="#" title="Add a comment"> Comment |</a></span> -->
							  
							 <?php 
							 $usersCheck=NULL;
							 $you=false;
							 $resProfiles=NULL;
							 $count=0;
							 $valOfAll2=NULL;
								   $oDB60=new mysql;
								   $oDB60->connect();
								   $commentForRow=$row58['id'];
								   $asd60=$oDB->query("SELECT * FROM $tableProfilePubComChecks WHERE id_coment=$commentForRow");
								   while ($rowChecks= mysql_fetch_array($asd60)){
										
										$usersCheck.=$rowChecks['id_user_who_check'].',';
								   }
								   
							//Begin Check 
							
							//var_dump($usersCheck);
							if($usersCheck != NULL){
								$results = explode(',',$usersCheck);
								foreach($results as $res){
								$valOfAll2[]=$res;
								$count++;
								if($res==$_SESSION['iSMuIdKey']){
								$you=true;
								}
								}
								
								//echo " count ".$count;

								//var_dump($valOfAll2);
								}
								?>
								   
							  <img src="<?php echo ($you) ? "img/tick.png" : "img/tick_off.png" ; ?>" <?php echo ($you) ? "class='hoverUnCheckAg' onClick='javascript:unCheckThisCommentag(id);' title='". $_IDIOMA->traducir("Uncheck this comment")."'" : "class='hoverWhitjQueryAg' onClick='javascript:checkThisCommentag(id);' title='". $_IDIOMA->traducir("Check this comment")."'" ; ?> title="<?php print $_IDIOMA->traducir("Check this comment");?>"  id="<?php echo $row58['id']; ?>"  />
							  
							  <!-- <span class="icheck" title="Check this comment" onClick="javascript:checkThisCommentag(id);" id="<?php echo $row58['id']; ?>"></span>-->
							</div>
						  </div><!--SUBmainContent-->
						</div><!--SUBindividualComm-->

						<?php 
							
								
								//echo "you: ".$you;
								$count=--$count;
							
							//Cuando yo chekeo
							if(($count==1) AND ($you)){
								//echo "entro en 1+you";
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $_SESSION['iSMuIdKey'];
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">'.$_IDIOMA->traducir("You").'</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div></div>';
							}else if(($count == 1) AND (!$you)){
								//echo "entro en 1-you";
								/*$valueOfsomething=strlen($resProfiles);
								$valueOfsomething=$valueOfsomething-2;
								$valueOfsomething=substr($resProfiles,0,$valueOfsomething);*/
								//echo 
								$ress=$valOfAll2[0];
								$oDB61=new mysql;
								$oDB61->connect();
								
								$asd61=$oDB61->query("SELECT id,name,lastName FROM ax_generalRegister WHERE id=$ress");
								//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$ress";
								while($asd61Rows = mysql_fetch_array($asd61)){
								$idOfThis=$asd61Rows['id'];
								$nameOfThis=$asd61Rows['name'];
								$lastNameOfThis=$asd61Rows['lastName'];
								}
								
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $idOfThis;
								echo '); return false;"	class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $nameOfThis." ".$lastNameOfThis;
								echo '</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div></div>';							
							}else if(($count == 2) AND ($you)){
								//echo "entro en 2+you";
								if($valOfAll2[0]==$_SESSION['iSMuIdKey']){
								$valForQuery=$valOfAll2[1];
								}else{
								$valForQuery=$valOfAll2[0];
								}
								$oDB62=new mysql;
								$oDB62->connect();
								//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery";
								$asd62=$oDB62->query("SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery");
								while($asd62Rows = mysql_fetch_array($asd62)){
								$idOfThis2=$asd62Rows['id'];
								$nameOfThis2=$asd62Rows['name'];
								$lastNameOfThis2=$asd62Rows['lastName'];
								}

								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $_SESSION['iSMuIdKey'];
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">'.$_IDIOMA->traducir("You").'</a> '.$_IDIOMA->traducir("and").' <a onClick="JS_follower(';
								echo $idOfThis2;
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $nameOfThis2." ".$lastNameOfThis2;
								echo '</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div></div>';	
								
							}else if(($count == 2) AND (!$you)){
								//echo "entro en 2-you";
								
								$valForQuery1=$valOfAll2[0];
								$valForQuery2=$valOfAll2[1];
								$oDB63=new mysql;
								$oDB63->connect();
								//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery1";
								$asd63=$oDB63->query("SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery1");
								while($asd63Rows = mysql_fetch_array($asd63)){
								$idOfThis3=$asd63Rows['id'];
								$nameOfThis3=$asd63Rows['name'];
								$lastNameOfThis3=$asd63Rows['lastName'];
								}
								
								$oDB64=new mysql;
								$oDB64->connect();
								//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery2";
								$asd64=$oDB64->query("SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery2");
								while($asd64Rows = mysql_fetch_array($asd64)){
								$idOfThis4=$asd64Rows['id'];
								$nameOfThis4=$asd64Rows['name'];
								$lastNameOfThis4=$asd64Rows['lastName'];
								}

								
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $idOfThis3;
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $nameOfThis3." ".$lastNameOfThis3;
								echo '</a> '.$_IDIOMA->traducir("and").' <a onClick="JS_follower(';
								echo $idOfThis4;
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $nameOfThis4." ".$lastNameOfThis4;
								echo ' </a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div></div>';		
								
							}else if(($count >= 3) AND ($you)){
								//echo "entro en 3+you";
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a onClick="JS_follower(';
								echo $_SESSION['iSMuIdKey'];
								echo '); return false;" class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">'.$_IDIOMA->traducir("You").'</a> '.$_IDIOMA->traducir("and").' <a class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo --$count.'</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div></div>';
							}else if(($count >= 3) AND (!$you)){
								//echo "entro en 3-you";
								echo '<div class="whoCheck">';
								echo '<span class="imgCheck" title="'.$_IDIOMA->traducir("Who checked it?").'"></span>';
								echo '<p><a class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'"></a><a class="linkWall" title="'.$_IDIOMA->traducir("See this profile").'">';
								echo $count.'</a> '.$_IDIOMA->traducir("checked it.").'</p>';
								echo '</div></div>';
							}
							
							if($usersCheck==NULL){
							echo '</div>';
							}
							
							
							$count=0;
							$you=false;
							$valOfAll2=NULL;
							$count=0;
							$usersCheck=NULL; 
							$resProfiles=NULL;


														
} ?>
						
					<div class="writeAnswer" id="writeAnswerDiv_<?php echo $row['id'];?>">
<div id="writeArea">
  <textarea  title="<?php print $_IDIOMA->traducir("Write a comment and press Enter to publish it.");?>" class="yourAnswer <?php echo $row['id']; ?>" id="wrtSec"  name="writeAnswer_<?php echo $row['id']; ?>"><?php print $_IDIOMA->traducir("Write a comment and press Enter to publish it.");?></textarea>
  
  <div id="divGif_<?php echo $row['id'];?>"></div>
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
<?php
$final=$totalPages-1;
//echo "Final: ".$final."<br />";
//echo "Total: ".$totalPages."<br />";
//echo "Page: ".$page."<br />";
//echo 'page '.$page.' of '.$final; 
?>
<div id="seePrevious"><p><a title="See previous messages" href="#header" ><?php print $_IDIOMA->traducir("Go To Top");?></a>
<?php if($totalPages!=0){ ?>
<?php if($page!=$totalPages-1){?><a title="More Results" href="javascript:loadPublications(<?php echo $page+1; ?>);"><?php print $_IDIOMA->traducir("More Result");?></a><?php } ?><?php if($page!=0){?> <a title="<?php print $_IDIOMA->traducir("Previous Results");?>" href="javascript:loadPublications(<?php echo ($page-1 == 0) ? 0 : $page-1 ; ?>);"><?php print $_IDIOMA->traducir("Previous Results");?></a><?php } ?>
<?php } ?>
</p></div>

<!-- <div id="seePrevious"><p><a title="See previous messages" href="javascript:;" onclick="javascript:moreResults();">Previous</a></p></div> -->  
  