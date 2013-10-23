<?php
require_once ($_SERVER ['DOCUMENT_ROOT'] . "/gestion/lib/share/clases/lib_util.inc.php");
require_once ($_SERVER ['DOCUMENT_ROOT'] . "/gestion/modulos/home/modules/classAndres.php");
require_once ($_SERVER ['DOCUMENT_ROOT'] . "/gestion/lib/share/clases/class_peopleNet.php");

$oDB = new mysql ();
$oDB->connect ();

if (! isset ( $_SESSION ['idUserVisiting'] ) or ($_SESSION ['idUserVisiting'] == 0)) {
	$id = $_SESSION ['iSMuIdKey'];
} else {
	$id = $_SESSION ['idUserVisiting'];
}

if (! isset ( $_GET ['end'] )) {
	$end = 10;
} else {
	$end = $_GET ['end'];
}

function GetVideoIdFromUrl($url) {
	$parts = explode ( '?v=', $url );
	if (count ( $parts ) == 2) {
		$tmp = explode ( '&', $parts [1] );
		if (count ( $tmp ) > 1) {
			return $tmp [0];
		} else {
			return $parts [1];
		}
	} else {
		return $url;
	}
}

function EmbedVideo($retornoEsto, $width = 425, $height = 350) {
	return '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="http://www.youtube.com/v/' . $retornoEsto . '"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/' . $retornoEsto . '" type="application/x-shockwave-flash" wmode="transparent" width="' . $width . '" height="' . $height . '"></embed></object>';
}

function GetImg($videoid, $imgid = 1) {
	return "http://img.youtube.com/vi/$videoid/$imgid.jpg";
}

$sSQL_Select = generateSelect ( 'history_follower', 'ax_follower', "id_user=$id" );
$selectAllMyFollowers = $oDB->query ( $sSQL_Select );

while ( $res = mysql_fetch_array ( $selectAllMyFollowers ) ) {
	$arreglo = $res ['history_follower'] . "<br >";
}
;

$selectAllMyFollowers = array ();
$selectAllMyFollowers = unserialize ( $arreglo );

$iCantTotal = sizeof ( $selectAllMyFollowers ['id'] );
$sSqlId = implode ( "','", $selectAllMyFollowers ['id'] );
$sSqlId = $sSqlId . "','" . $id;
$selectNoActives="select id from ax_generalRegister where active=0";
$wallAct = $oDB->query ( "select * from (
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_agentWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_clubWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_coachWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_companyWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_fanWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_federationWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_journalistWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_lawyerWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_managerWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_medicWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_playerWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time) union
(SELECT g.id, g.name, g.lastName, g.active, g.photo, g.profileId, a.id as publiid, a.user_id,a.user_id_who,a.publication,a.time FROM ax_generalRegister as g, ax_scoutWall as a WHERE g.id in ('" . $sSqlId . "') and g.id=a.user_id_who group by a.id order by a.time)) as publiFriends 
		where user_id_who in ('" . $sSqlId . "') and not user_id_who in ($selectNoActives) order by time desc LIMIT 0 , " . $end );

?>
<div id="top"></div>
<script>
G.util.ready(function(){
$('#home *').tipsy({gravity: 'n'});
(function(a){a.fn.autoResize=function(j){var b=a.extend({onResize:function(){},animate:true,animateDuration:150,animateCallback:function(){},extraSpace:20,limit:1000},j);this.filter('textarea').each(function(){var c=a(this).css({resize:'none','overflow-y':'hidden'}),k=c.height(),f=(function(){var l=['height','width','lineHeight','textDecoration','letterSpacing'],h={};a.each(l,function(d,e){h[e]=c.css(e)});return c.clone().removeAttr('id').removeAttr('name').css({position:'absolute',top:0,left:-9999}).css(h).attr('tabIndex','-1').insertBefore(c)})(),i=null,g=function(){f.height(0).val(a(this).val()).scrollTop(10000);var d=Math.max(f.scrollTop(),k)+b.extraSpace,e=a(this).add(f);if(i===d){return}i=d;if(d>=b.limit){a(this).css('overflow-y','');return}b.onResize.call(this);b.animate&&c.css('display')==='block'?e.stop().animate({height:d},b.animateDuration,b.animateCallback):e.height(d)};c.unbind('.dynSiz').bind('keyup.dynSiz',g).bind('keydown.dynSiz',g).bind('change.dynSiz',g);});return this;};})(jQuery);
$('.yourAnswer').autoResize();
});
textoMuroDefecto="<?php
print $_IDIOMA->traducir ( 'Write a public message on this wall' );
?>";

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
}


function checkThisCommentag(id,prof){
	$('.hoverWhitjQueryAg').css('display','none');
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=checkComment&value="+id+"&value2="+prof,
				type: 'POST',
				dataType : 'json',
				success: function(data){
				if(data == true){
					loadActualizaciones(<?php
					echo $end;
					?>);
				}else{
					loadActualizaciones(<?php
					echo $end;
					?>);
			}
		}
	})
}

function unCheckThisCommentag(id,prof){
	$('.hoverUnCheckAg').css('display','none');
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=unCheckComment&value="+id+"&value2="+prof,
				type: 'POST',
				dataType : 'json',
				success: function(data){
				if(data == true){
					loadActualizaciones(<?php
					echo $end;
					?>);
				}else{
					loadActualizaciones(<?php
					echo $end;
					?>);
			}
		}
	})

}

function checkThisPublicationag(id,prof){
	$('.hoverWhitjQueryAg').css('display','none');
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=checkPublication&value="+id+"&value2="+prof,
				type: 'POST',
				dataType : 'json',
				
				
				success: function(data){
				if(data == true){
				
					loadActualizaciones(<?php
					echo $end;
					?>);
				}else{
					loadActualizaciones(<?php
					echo $end;
					?>);
				}
				}})

}


function unCheckThisPublicationsag(id,prof){
	$('.hoverUnCheckPublicationsAg').css('display','none');
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=unCheckPublication&value="+id+"&value2="+prof,
				type: 'POST',
				dataType : 'json',
				success: function(data){
				if(data == true){
				
					loadActualizaciones(<?php
					echo $end;
					?>);
				}else{
					loadActualizaciones(<?php
					echo $end;
					?>);
			}
		}
	})

}

function AddCommentAg(id){
	if($('.'+id).val()=="<?php
	print $_IDIOMA->traducir ( 'Write a comment and press Enter to publish it.' );
	?>"){
	$('.'+id).val('');
	$('.'+id).focus();
	}
	
}


function deleteComment2(id){

	alert("click en eliminar, paso a editar primero");
	var texto='';
	texto=$("#wrotte "+id).val();
	alert(texto);
	$("."+id).html('<textarea>'+texto+'</textarea>');
}



function deleteComment(id,value){
var sinoCom=confirm("<?php
print $_IDIOMA->traducir ( 'you want to remove this comment' );
?>?");
if(sinoCom==true){
$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=deleteComment&value="+id+"&value2="+value,
				type: 'POST',
				dataType : 'json',
				success: function(data){
				if(data == true){
				
					loadActualizaciones(<?php
					echo $end;
					?>);
				}else{
					loadActualizaciones(<?php
					echo $end;
					?>);
				}
				}})
}
}
function deletePublication(id,value){
var sinoPub=confirm("<?php
print $_IDIOMA->traducir ( 'you want to remove this publication' );
?>?");
if(sinoPub==true){
	$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=deletePublication&value="+id+"&value2="+value,
				type: 'POST',
				dataType : 'json',
				success: function(data){
				if(data == true){
					loadActualizaciones(<?php
					echo $end;
					?>);
				}else{
					loadActualizaciones(<?php
					echo $end;
					?>);
				}
				}})
	}
}

$('.yourAnswer').focus(function(){
	if($(this).val()=='<?php
	print $_IDIOMA->traducir ( 'Write a comment and press Enter to publish it.' );
	?>'){
		$(this).val('');
	}
});

$('.yourAnswer').focusout(function(){
	if($(this).val() == ''){
	$(this).val('<?php
	print $_IDIOMA->traducir ( 'Write a comment and press Enter to publish it.' );
	?>');
	}
});

$('.yourAnswer').keydown(function(e){

			var code = e.keyCode;
			if (code === 13){
			
			var asd=$(this).attr("name");
			var tam=asd.length;
			var askhjdasoljqkwdsanmcxgzh=asd.substr(12,tam);
			var kasdj=$("[name='writeAnswer_"+askhjdasoljqkwdsanmcxgzh+"']").val();
			var value2=$('#PwriteAnswer_'+askhjdasoljqkwdsanmcxgzh).val();
			var value3=$('#VwriteAnswer_'+askhjdasoljqkwdsanmcxgzh).val();		
			
			$.ajax({
				url: dir+"Wall/classWall.php",
				data: "type=insertComment&value="+kasdj+"&askhjdasoljqkwdsanmcxgzh="+askhjdasoljqkwdsanmcxgzh+"&value2="+value2+"&value3="+value3,
				type: 'POST',
				dataType : 'json',
				beforeSend: function(){
					$("#divGif_"+askhjdasoljqkwdsanmcxgzh).html('<img src="img/indicator.gif" width="15" height="15"/>');
				},
				success: function(data){
				if(data == true){
				
					loadActualizaciones(<?php
					echo $end;
					?>);
				}else{
					loadActualizaciones(<?php
					echo $end;
					?>);
				}
				}})
		}
	});
</script>
<?php
while ( $ResWallAct = mysql_fetch_array ( $wallAct ) ) {
	
	?>

<div class="individualComm">
<?php
	$aImPhoto = array ();
	$photo = $ResWallAct ['photo'];
	$aImPhoto = @getimagesize ( $_SERVER ['DOCUMENT_ROOT'] . "/photoGeneral/small/small_$photo" );
	
	if ($aImPhoto [0] > 50) {
		$moveLeft = 'margin-left:-' . (($aImPhoto [0] - 50) / 2) . ';';
	} else {
		$moveLeft = '';
	}
	
	if ($aImPhoto [1] > 50) {
		$moveTop = 'margin-top:-' . (($aImPhoto [1] - 50) / 2) . ';';
	} else {
		$moveTop = '';
	}
	echo '<div class="photoSpeaker">';
	echo '<div style="' . $moveLeft . '"><img src="photoGeneral/small/small_' . $ResWallAct ['photo'] . '" title="' . $ResWallAct ['name'], " ", $ResWallAct ['lastName'] . '" onClick="location.href=\'/' . $_IDIOMA->traducir ( "user" ) . '/' . $ResWallAct ['id'] . '-' . Utilidades::normalizarTexto ( $ResWallAct ["name"] . " " . $ResWallAct ["lastName"] ) . '\';" alt="#" /></div>';
	echo '</div>';
	?>
	<div class="mainContent">
                         <?php
	echo '<div  style="float:left;margin-right:5px;" class="name" onClick="location.href=\'/' . $_IDIOMA->traducir ( "user" ) . '/' . $ResWallAct ['id'] . '-' . Utilidades::normalizarTexto ( $ResWallAct ["name"] . " " . $ResWallAct ["lastName"] ) . '\';">';
	echo $ResWallAct ['name'], " ", $ResWallAct ['lastName'];
	echo '</div>';
	if ($ResWallAct ['user_id_who'] !== $ResWallAct ['user_id']) {
		$userpostpubli = $oDB->query ( "select * from  ax_generalRegister where id=" . $ResWallAct ['user_id'] );
		while ( $UserPubli = mysql_fetch_array ( $userpostpubli ) ) {
			echo '<div style="float:left;margin-right:5px;margin-bottom: 5px;">';
			echo $_IDIOMA->traducir ( ">>" );
			echo '</div>';
			echo '<div style="float:left;margin-right:5px;" class="name" onClick="location.href=\'/' . $_IDIOMA->traducir ( "user" ) . '/' . $UserPubli ['id'] . '-' . Utilidades::normalizarTexto ( $UserPubli ["name"] . " " . $UserPubli ["lastName"] ) . '\';">';
			echo $UserPubli ['name'], " ", $UserPubli ['lastName'];
			echo '</div>';
			$profileidpub = $UserPubli ["profileId"];
		}
	} else {
		$profileidpub = $ResWallAct ['profileId'];
	}
	$table = selectTable ( $profileidpub );
	$anexo2 = 'ReceivedComments';
	$anexo3 = 'PubComChecks';
	$tableProfileComments = $table . $anexo2;
	$tableProfilePubComChecks = $table . $anexo3;
	?>
	 								 <?php
	if ($_SESSION ['iSMuIdKey'] == $ResWallAct ['id'] || $_SESSION ['iSMuIdKey'] == 0) {
		?><span class="deleteThis" style="top: -17px;"
	onclick="javascript:deletePublication(<?php
		echo $ResWallAct ['id'];
		?>,<?php
		print $profileidpub;
		?>);"
	title="<?php
		print $_IDIOMA->traducir ( 'Delete this comment' );
		?>"></span> <?php
	}
	?>
	<div style="width: 475px; clear: both;"></div>
<div class="wrotte">
                     
<?php
	echo htmlentities(utf8_decode($ResWallAct ['publication']));
	?>
                      </div>
<div class="commenTools"><span class="date"><?php
	echo ago ( $ResWallAct ['time'] );
	?></span> <span class="addComment"><a href="javascript:;"
	onClick="javascript:AddCommentAg(<?php
	echo $ResWallAct ['publiid'];
	?>);"
	title="<?php
	print $_IDIOMA->traducir ( 'Add a comment' );
	?>"> <?php
	print $_IDIOMA->traducir ( 'Comment' );
	?> |</a></span>
							<?php
	$usersCheck = NULL;
	$you = false;
	$resProfiles = NULL;
	$count = 0;
	$valOfAll = NULL;
	$oDB70 = new mysql ();
	$oDB70->connect ();
	$commentForRow = $ResWallAct ['publiid'];
	$asd70 = $oDB->query ( "SELECT * FROM $tableProfilePubComChecks WHERE id_publication=$commentForRow" );
	
	while ( $rowChecks = mysql_fetch_array ( $asd70 ) ) {
		
		$usersCheck .= $rowChecks ['id_user_who_check'] . ',';
	
	}
	
	if ($usersCheck != NULL) {
		
		$results = explode ( ',', $usersCheck );
		foreach ( $results as $res ) {
			$valOfAll [] = $res;
			$count ++;
			if ($res == $_SESSION ['iSMuIdKey']) {
				$you = true;
			}
		}
	}
	?>
								
								
								<?php
	$idForChecksUncheks = $ResWallAct ['publiid'];
	?>
								<img
	src="<?php
	echo ($you) ? "img/tick.png" : "img/tick_off.png";
	?>"
	<?php
	echo ($you) ? "class='hoverUnCheckPublicationsAg' onClick='unCheckThisPublicationsag($idForChecksUncheks,$profileidpub);' title='Uncheck this publication'" : "class='hoverWhitjQueryAg' onClick='javascript:checkThisPublicationag($idForChecksUncheks,$profileidpub);' title='" . $_IDIOMA->traducir ( 'Check this publication' ) . "'";
	?>
	id="<?php
	echo $ResWallAct ['publiid'];
	?>" /></div>
<?php
	
	//echo "you: ".$you;
	$count = -- $count;
	
	if (($count == 1) and ($you)) {
		
		echo '<div class="whoCheck">';
		echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
		echo '<p><a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $_SESSION ['iSMuIdKey'] . '-' . Utilidades::normalizarTexto ( $ResWallAct ['name'] . " " . $ResWallAct ['lastName'] ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">' . $_IDIOMA->traducir ( "You" ) . '</a> ' . $_IDIOMA->traducir ( "checked it." ) . '</p>';
		echo '</div>';
	}
	
	if (($count == 1) and (! $you)) {
		
		$ress = $valOfAll [0];
		$oDB61 = new mysql ();
		$oDB61->connect ();
		
		$asd61 = $oDB61->query ( "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$ress" );
		while ( $asd61Rows = mysql_fetch_array ( $asd61 ) ) {
			$idOfThis = $asd61Rows ['id'];
			$nameOfThis = $asd61Rows ['name'];
			$lastNameOfThis = $asd61Rows ['lastName'];
		}
		
		echo '<div class="whoCheck">';
		echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
		echo '<p><a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $idOfThis . '-' . Utilidades::normalizarTexto ( $nameOfThis . " " . $lastNameOfThis ) . '"	class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
		echo $nameOfThis . " " . $lastNameOfThis;
		echo '</a> ' . $_IDIOMA->traducir ( "checked it." ) . '</p>';
		echo '</div>';
	}
	
	if (($count == 2) and ($you)) {
		if ($valOfAll [0] == $_SESSION ['iSMuIdKey']) {
			$valForQuery = $valOfAll [1];
		} else {
			$valForQuery = $valOfAll [0];
		}
		$oDB62 = new mysql ();
		$oDB62->connect ();
		$asd62 = $oDB62->query ( "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery" );
		while ( $asd62Rows = mysql_fetch_array ( $asd62 ) ) {
			$idOfThis2 = $asd62Rows ['id'];
			$nameOfThis2 = $asd62Rows ['name'];
			$lastNameOfThis2 = $asd62Rows ['lastName'];
		}
		
		echo '<div class="whoCheck">';
		echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
		echo '<p><a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $_SESSION ['iSMuIdKey'] . '-' . Utilidades::normalizarTexto ( $ResWallAct ['name'] . " " . $ResWallAct ['lastName'] ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">' . $_IDIOMA->traducir ( "you" ) . '</a> ' . $_IDIOMA->traducir ( "and" ) . ' <a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $idOfThis2 . '-' . Utilidades::normalizarTexto ( $nameOfThis2 . " " . $lastNameOfThis2 ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
		echo $nameOfThis2 . " " . $lastNameOfThis2;
		echo '</a> ' . $_IDIOMA->traducir ( "have checked." ) . '</p>';
		echo '</div>';
	
	}
	
	if (($count == 2) and (! $you)) {
		

		$valForQuery1 = $valOfAll [0];
		$valForQuery2 = $valOfAll [1];
		$oDB63 = new mysql ();
		$oDB63->connect ();
		$asd63 = $oDB63->query ( "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery1" );
		while ( $asd63Rows = mysql_fetch_array ( $asd63 ) ) {
			$idOfThis3 = $asd63Rows ['id'];
			$nameOfThis3 = $asd63Rows ['name'];
			$lastNameOfThis3 = $asd63Rows ['lastName'];
		}
		
		$oDB64 = new mysql ();
		$oDB64->connect ();
		$asd64 = $oDB64->query ( "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery2" );
		while ( $asd64Rows = mysql_fetch_array ( $asd64 ) ) {
			$idOfThis4 = $asd64Rows ['id'];
			$nameOfThis4 = $asd64Rows ['name'];
			$lastNameOfThis4 = $asd64Rows ['lastName'];
		}
		
		echo '<div class="whoCheck">';
		echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
		echo "<p>";
		if (isset ( $nameOfThis3 )) {
			echo '<a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $idOfThis3 . '-' . Utilidades::normalizarTexto ( $nameOfThis3 . " " . $lastNameOfThis3 ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
			echo $nameOfThis3 . " " . $lastNameOfThis3;
			echo '</a> ' . $_IDIOMA->traducir ( "and" );
		}
		echo ' <a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $idOfThis4 . '-' . Utilidades::normalizarTexto ( $nameOfThis4 . " " . $lastNameOfThis4 ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
		echo $nameOfThis4 . " " . $lastNameOfThis4;
		echo ' </a> ' . $_IDIOMA->traducir ( "checked it." ) . '</p>';
		echo '</div>';
	
	}
	
	if (($count >= 3) and ($you)) {
		echo '<div class="whoCheck">';
		echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
		echo '<p><a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $_SESSION ["iSMuIdKey"] . '-' . Utilidades::normalizarTexto ( $ResWallAct ['name'] . " " . $ResWallAct ['lastName'] ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">' . $_IDIOMA->traducir ( "You" ) . '</a> ' . $_IDIOMA->traducir ( "and" ) . ' <a class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
		echo -- $count . '</a> ' . $_IDIOMA->traducir ( "have checked." ) . '</p>';
		echo '</div>';
	}
	
	if (($count >= 3) and (! $you)) {
		echo '<div class="whoCheck">';
		echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
		echo '<p><a class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '"></a><a class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
		echo $count . '</a> ' . $_IDIOMA->traducir ( "have checked." ) . '</p>';
		echo '</div>';
	}
	$count = 0;
	$you = false;
	$count = 0;
	$usersCheck = NULL;
	$resProfiles = NULL;
	$valOfAll = NULL;
	$oDB58 = new mysql ();
	$oDB58->connect ();
	$idComment = $ResWallAct ['publiid'];
	$asd58 = $oDB->query ( "SELECT * FROM $tableProfileComments WHERE idUserWhoReceiveAComment=" . $ResWallAct ['user_id'] . " and idComment=$idComment ORDER BY ID ASC" );
	$numero = mysql_num_rows ( $asd58 );
	$llegar = 0;
	$others = $numero - 2;
	if ($numero >= 3) {
		?><div class="seeComments <?php
		echo $idComment;
		?>1"><span class="imgComment"
	title="<?php
		print $_IDIOMA->traducir ( "See all comments" );
		?>"></span>
<p><a class="linkWall"
	title="<?php
		print $_IDIOMA->traducir ( "Show all comments for this post" );
		?>"
	onClick="javascript:seeMoreComments(<?php
		echo $idComment;
		?>1);"><?php
		print $_IDIOMA->traducir ( "See others" );
		?> <?php
		echo $others;
		?> <?php
		print $_IDIOMA->traducir ( "comments" );
		?>.</a></p>
</div><?php
	}
	
	while ( $row58 = mysql_fetch_array ( $asd58 ) ) {
		$llegar ++;
		
		?><div
	class="answer<?
		if ($llegar < $numero - 1) {
			echo " hideForMoreResults hideForMoreResults_" . $idComment . "1";
		}
		?> ">
<div class="SUBindividualComm">
<div class="photoSpeaker pSSUB">
					<?php
		$whoMake = $row58 ['idUserWhoMakeComment'];
		$oDB59 = new mysql ();
		$oDB59->connect ();
		$asd59 = $oDB->query ( "SELECT id,name,lastName,photo FROM ax_generalRegister WHERE id=$whoMake" );
		while ( $row59 = mysql_fetch_array ( $asd59 ) ) {
			$nameWhoMakeComment = $row59 ['name'];
			$lastNameWhoMakeComment = $row59 ['lastName'];
			$photoWhoMakeComment = $row59 ['photo'];
			$idWhoMakeComment = $row59 ['id'];
		
		}
		
		$aImPhoto = array ();
		$aImPhoto = @getimagesize ( $_SERVER ['DOCUMENT_ROOT'] . "/photoGeneral/small/small_$photoWhoMakeComment" );
		
		if ($aImPhoto [0] > 50) {
			$moveLeft = 'margin-left:-' . (($aImPhoto [0] - 50) / 2) . ';';
		} else {
			$moveLeft = '';
		}
		
		if ($aImPhoto [1] > 50) {
			$moveTop = 'margin-top:-' . (($aImPhoto [1] - 50) / 2) . ';';
		} else {
			$moveTop = '';
		}
		
		echo '<div style="' . $moveLeft . '"><img src="photoGeneral/small/small_' . $photoWhoMakeComment . '" onClick="location.href=\'/' . $_IDIOMA->traducir ( "user" ) . '/' . $idWhoMakeComment . '-' . Utilidades::normalizarTexto ( $nameWhoMakeComment . " " . $lastNameWhoMakeComment ) . '\'" title="' . $nameWhoMakeComment . ' ' . $lastNameWhoMakeComment . '" alt="#" /></div>';
		?>
						  </div>
<!--photoSpeaker-->
<div class="mainContent mCSUB">
							
							<?php
		if ($_SESSION ['iSMuIdKey'] == $row58 ['idUserWhoReceiveAComment'] || $_SESSION ['iSMuIdKey'] == $idWhoMakeComment || $_SESSION ['iSMuIdKey'] == 0) {
			?><span class="deleteThis2"
	onclick="javascript:deleteComment(<?php
			echo $row58 ['id'];
			?>,<?php
			print $profileidpub;
			?>);"
	title="<?php
			print $_IDIOMA->traducir ( "Delete this comment" );
			?>?"></span> <?php
		}
		?>
							<?php
		echo '<div class="name" onClick="location.href=\'/' . $_IDIOMA->traducir ( "user" ) . '/' . $idWhoMakeComment . '-' . Utilidades::normalizarTexto ( $nameWhoMakeComment . " " . $lastNameWhoMakeComment ) . '\'" >  ' . $nameWhoMakeComment . ' ' . $lastNameWhoMakeComment . '</div>';
		?>
							 
							<div class="wrotte <?php
		echo $row58 ['id'];
		?>"> 
							   <?php
		echo htmlentities(utf8_decode($row58 ['comment']));
		?>
							</div>
<div class="commenTools"><span class="date"><?php
		echo ago ( $row58 ['time'] );
		?></span> 
							  
							 <?php
		$usersCheck = NULL;
		$you = false;
		$resProfiles = NULL;
		$count = 0;
		$valOfAll2 = NULL;
		$oDB60 = new mysql ();
		$oDB60->connect ();
		$commentForRow = $row58 ['id'];
		$asd60 = $oDB->query ( "SELECT * FROM $tableProfilePubComChecks WHERE id_coment=$commentForRow" );
		while ( $rowChecks = mysql_fetch_array ( $asd60 ) ) {
			
			$usersCheck .= $rowChecks ['id_user_who_check'] . ',';
		}
		if ($usersCheck != NULL) {
			$results = explode ( ',', $usersCheck );
			foreach ( $results as $res ) {
				$valOfAll2 [] = $res;
				$count ++;
				if ($res == $_SESSION ['iSMuIdKey']) {
					$you = true;
				}
			}
		}
		?>
								<?php
		$id = $row58 ['id'];
		?>   
							  <img
	src="<?php
		echo ($you) ? "img/tick.png" : "img/tick_off.png";
		?>"
	<?php
		echo ($you) ? "class='hoverUnCheckAg' onClick='javascript:unCheckThisCommentag($id,$profileidpub);' title='" . $_IDIOMA->traducir ( "Uncheck this comment" ) . "'" : "class='hoverWhitjQueryAg' onClick='javascript:checkThisCommentag($id,$profileidpub);' title='" . $_IDIOMA->traducir ( "Check this comment" ) . "'";
		?>
	title="<?php
		print $_IDIOMA->traducir ( "Check this comment" );
		?>"
	id="<?php
		echo $row58 ['id'];
		?>" /></div>
</div>
<!--SUBmainContent--></div>
<!--SUBindividualComm-->

						<?php
		
		$count = -- $count;
		
		//Cuando yo chekeo
		if (($count == 1) and ($you)) {
			echo '<div class="whoCheck">';
			echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
			echo '<p><a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $_SESSION ["iSMuIdKey"] . '-' . Utilidades::normalizarTexto ( $ResWallAct ['name'] . " " . $ResWallAct ['lastName'] ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">' . $_IDIOMA->traducir ( "You" ) . '</a> ' . $_IDIOMA->traducir ( "checked it." ) . '</p>';
			echo '</div>';
		} else if (($count == 1) and (! $you)) {
			$ress = $valOfAll2 [0];
			$oDB61 = new mysql ();
			$oDB61->connect ();
			$asd61 = $oDB61->query ( "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$ress" );
			while ( $asd61Rows = mysql_fetch_array ( $asd61 ) ) {
				$idOfThis = $asd61Rows ['id'];
				$nameOfThis = $asd61Rows ['name'];
				$lastNameOfThis = $asd61Rows ['lastName'];
			}
			
			echo '<div class="whoCheck">';
			echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
			echo '<p><a  href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $idOfThis . '-' . Utilidades::normalizarTexto ( $nameOfThis . " " . $lastNameOfThis ) . '"
								class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
			echo $nameOfThis . " " . $lastNameOfThis;
			echo '</a> ' . $_IDIOMA->traducir ( "checked it." ) . '</p>';
			echo '</div>';
		} else if (($count == 2) and ($you)) {
			if ($valOfAll2 [0] == $_SESSION ['iSMuIdKey']) {
				$valForQuery = $valOfAll2 [1];
			} else {
				$valForQuery = $valOfAll2 [0];
			}
			$oDB62 = new mysql ();
			$oDB62->connect ();
			//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery";
			$asd62 = $oDB62->query ( "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery" );
			while ( $asd62Rows = mysql_fetch_array ( $asd62 ) ) {
				$idOfThis2 = $asd62Rows ['id'];
				$nameOfThis2 = $asd62Rows ['name'];
				$lastNameOfThis2 = $asd62Rows ['lastName'];
			}
			
			echo '<div class="whoCheck">';
			echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
			echo '<p><a  href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $_SESSION ["iSMuIdKey"] . '-' . Utilidades::normalizarTexto ( $ResWallAct ['name'] . " " . $ResWallAct ['lastName'] ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">' . $_IDIOMA->traducir ( "You" ) . '</a> ' . $_IDIOMA->traducir ( "and" ) . ' <a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $idOfThis2 . '-' . Utilidades::normalizarTexto ( $nameOfThis2 . " " . $lastNameOfThis2 ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
			echo $nameOfThis2 . " " . $lastNameOfThis2;
			echo '</a> ' . $_IDIOMA->traducir ( "have checked." ) . '</p>';
			echo '</div>';
		
		} else if (($count == 2) and (! $you)) {
			//echo "entro en 2-you";
			

			$valForQuery1 = $valOfAll2 [0];
			$valForQuery2 = $valOfAll2 [1];
			$oDB63 = new mysql ();
			$oDB63->connect ();
			//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery1";
			$asd63 = $oDB63->query ( "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery1" );
			while ( $asd63Rows = mysql_fetch_array ( $asd63 ) ) {
				$idOfThis3 = $asd63Rows ['id'];
				$nameOfThis3 = $asd63Rows ['name'];
				$lastNameOfThis3 = $asd63Rows ['lastName'];
			}
			
			$oDB64 = new mysql ();
			$oDB64->connect ();
			//echo "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery2";
			$asd64 = $oDB64->query ( "SELECT id,name,lastName FROM ax_generalRegister WHERE id=$valForQuery2" );
			while ( $asd64Rows = mysql_fetch_array ( $asd64 ) ) {
				$idOfThis4 = $asd64Rows ['id'];
				$nameOfThis4 = $asd64Rows ['name'];
				$lastNameOfThis4 = $asd64Rows ['lastName'];
			}
			
			echo '<div class="whoCheck">';
			echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
			echo '<p><a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $idOfThis3 . '-' . Utilidades::normalizarTexto ( $nameOfThis3 . " " . $lastNameOfThis3 ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
			echo $nameOfThis3 . " " . $lastNameOfThis3;
			echo '</a> ' . $_IDIOMA->traducir ( "and" ) . ' <a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $idOfThis4 . '-' . Utilidades::normalizarTexto ( $nameOfThis4 . " " . $lastNameOfThis4 ) . '" class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
			echo $nameOfThis4 . " " . $lastNameOfThis4;
			echo ' </a> ' . $_IDIOMA->traducir ( "have checked." ) . '</p>';
			echo '</div>';
		
		} else if (($count >= 3) and ($you)) {
			//echo "entro en 3+you";
			echo '<div class="whoCheck">';
			echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
			echo '<p><a href="/' . $_IDIOMA->traducir ( "user" ) . '/' . $_SESSION ['iSMuIdKey'] . '-' . Utilidades::normalizarTexto ( $ResWallAct ['name'] . " " . $ResWallAct ['lastName'] ) . '"
								class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">' . $_IDIOMA->traducir ( "You" ) . '</a> ' . $_IDIOMA->traducir ( "and" ) . ' <a class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
			echo -- $count . '</a> ' . $_IDIOMA->traducir ( "have checked." ) . '</p>';
			echo '</div>';
		} else if (($count >= 3) and (! $you)) {
			//echo "entro en 3-you";
			echo '<div class="whoCheck">';
			echo '<span class="imgCheck" title="' . $_IDIOMA->traducir ( "Who checked it?" ) . '"></span>';
			echo '<p><a class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '"></a><a class="linkWall" title="' . $_IDIOMA->traducir ( "See this profile" ) . '">';
			echo $count . '</a> ' . $_IDIOMA->traducir ( "have checked." ) . '</p>';
			echo '</div>';
		}
		
		/*if ($usersCheck == NULL) {
			echo '';
		}*/
		
		$count = 0;
		$you = false;
		$valOfAll2 = NULL;
		$count = 0;
		$usersCheck = NULL;
		$resProfiles = NULL;
		?></div><?php
	}
	?>
						
					<div class="writeAnswer"
	id="writeAnswerDiv_<?php
	echo $ResWallAct ['publiid'];
	?>">
<div id="writeArea"><textarea
	title="<?php
	print $_IDIOMA->traducir ( "Write a comment and press Enter to publish it." );
	?>"
	class="yourAnswer <?php
	echo $ResWallAct ['publiid'];
	?>"
	id="wrtSec"
	name="writeAnswer_<?php
	echo $ResWallAct ['publiid'];
	?>"><?php
	print $_IDIOMA->traducir ( "Write a comment and press Enter to publish it." );
	?></textarea> <input type="hidden"
	name="PwriteAnswer_<?php
	echo $ResWallAct ['publiid'];
	?>"
	id="PwriteAnswer_<?php
	echo $ResWallAct ['publiid'];
	?>"
	value="<?php
	print $profileidpub;
	?>" /> <input type="hidden"
	name="VwriteAnswer_<?php
	echo $ResWallAct ['publiid'];
	?>"
	id="VwriteAnswer_<?php
	echo $ResWallAct ['publiid'];
	?>"
	value="<?php
	print $ResWallAct ['user_id'];
	?>" />

<div id="divGif_<?php
	echo $ResWallAct ['publiid'];
	?>"></div>
<div class="spacer"></div>
</div>
</div>
<!--writeAns--></div>
<!--maincontent-->
<div class="setClear"></div>
</div>
<!--individualComm-->
<?php
}

?>
<span id="loadingA" style="display: none;"><img src="img/indicator.gif"
	width="15" height="15" /></span>
<div id="seePrevious">
<p><a title="<?php
print $_IDIOMA->traducir ( "Go To Top" );
?>"
	href="#header"><?php
	print $_IDIOMA->traducir ( "Go To Top" );
	?></a>
<?php
if (mysql_num_rows ( $wallAct ) > 0) {
	?>
<a title="More Results"
	href="javascript:loadActualizaciones(<?php
	print $end + 10;
	?>);"><?php
	print $_IDIOMA->traducir ( "More Result" );
	?></a> <input type="hidden" name="end" id="end"
	value="<?php
	print $end + 10;
	?>)" />
<?php
}
?>
</p>
</div><?php
?>