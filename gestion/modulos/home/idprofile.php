<script type="text/javascript">
function changeProfile(id){
	$.ajax({
		url: dir2+"changeProfile.php",
		data: "type=changeProfile&value="+id,
		type: 'POST',
		success: function(data){
			if(data=="good"){
				JS_QuitEdit();
			}
		}
	});
}
</script>




<?php


if(!isset($_SESSION["editProfile"]) or $_SESSION["editProfile"]==0 or $_SESSION["editProfile"]==false){
	
	$editingProfile=false;   
}else{
	$editingProfile=true;
	require_once($_SERVER['DOCUMENT_ROOT']."/gestion/modulos/home/modules/classAndres.php"); 
}

#Distingue si es player o no 
if(($aUsuario['idProfile']==2) ||($aUsuario['idProfile']==3) ||( $aUsuario['idProfile'])==5||($aUsuario['idProfile']==6) || ($aUsuario['idProfile']==7) || ($aUsuario['idProfile']==8) || ($aUsuario['idProfile']==9) || ($aUsuario['idProfile']==10) || ($aUsuario['idProfile']==11) || ($aUsuario['idProfile']==12) || ($aUsuario['idProfile']==13) || ($aUsuario['idProfile']==14) || ($aUsuario['idProfile']==15)){
?>	
<div id="idProfile">
  <h1><?php echo $aUsuario['name'].' '.$aUsuario['lastName'];?> <span id="ageOfProfile">(<?php echo $aUsuario['edad'];?>)</span></h1>
 <h3>
  <?php if($editingProfile){
  $options=profileType($iUserProfileId); ?>
  <select onChange="changeProfile(this.value);"><?php echo $options; ?></select>
  <?php }else{
  echo $aUsuario['nameProfile']; } ?></h3>
  <div id="positionField"><? require_once('gestion/modulos/home/positionField.php'); ?></div>
</div><!--idProfile-->
<?php 	
}
else{
	#si es Company, Federation o Club, no muestra el nombre de la persona
	if(($aUsuario['idProfile']==25) ||($aUsuario['idProfile']==26) ||( $aUsuario['idProfile'])==27){
	?>	
	  <div id="idProfile">
	  <h1 style="width: 570px;"><?php echo $aProfile[0]->name;?></h1>
	  <h3><?php echo $aUsuario['nameProfile']; ?></h3>
	  <div id="positionField"><!--<img src="img/soccerPos6.png" width="141" height="56" title="Position" alt="Player position"/>--></div>
	</div><!--idProfile-->	
	<?php 
	}else{
?>
	  <div id="idProfile">
		  <h1 style="width: 570px;"><?php echo $aUsuario['name'].' '.$aUsuario['lastName'];?></h1>
		  <h3><?php echo $aUsuario['nameProfile']; ?></h3>
		  <div id="positionField"><!--<img src="img/soccerPos6.png" width="141" height="56" title="Position" alt="Player position"/>--></div>
	</div><!--idProfile-->
<?php 	}
}
?>
