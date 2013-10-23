<? 
//////////////////////////////////////////////////////////
require_once('gestion/modulos/profile/profileClass.php');
////////////////////////////////////////////////////////////

 //////////check the profile visiting///////////////
 if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
		 $idUserVisiting=$_SESSION["iSMuIdKey"];
 }else{
	 $idUserVisiting=$_SESSION["idUserVisiting"];
 }
	 
if(!isset($_SESSION['idProfileVisiting']) || $_SESSION['idProfileVisiting']==0 || $_SESSION['idProfileVisiting']==$_SESSION['iSMuProfTypeKey']){
 	$idProfileVisiting=$_SESSION["iSMuProfTypeKey"];
}else{
 	$idProfileVisiting=$_SESSION["idProfileVisiting"];
}

/////////check if it is player//////
if($idProfileVisiting<7){
	echo '<img src="img/soccerPos6.png" width="141" height="56"/>';
		
	$pro=new Profile();
	$jug=$pro->selectProfile(2,'position',"idUser=".$idUserVisiting."");	
	
	if(count($jug)>0){
	$thePos=explode(',',$jug[0]->position);
	}


	///Editting///
	if(isset($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
		?>
		
		<iframe id="formPosFieldIf" name="formPosFieldIf" src="" style="width:0;height:0;border:none;"></iframe>	
		
		<form method="post" action="gestion/modulos/home/formPosField.php" name="formPosField" id="formPosField" target="formPosFieldIf">
			<div title="<? print $_IDIOMA->traducir("Goalkeeper");?>" class="posField0" id="pP0"><input class="checkPos" type="checkbox"  name="position0" id="position0"  /></div>
			<div title="<? print $_IDIOMA->traducir("Left Back");?>" class="posField1" id="pP1"><input class="checkPos" type="checkbox"  name="position1" id="position1"  /></div>
			<div title="<? print $_IDIOMA->traducir("Central Back Left");?>" class="posField2" id="pP2"><input class="checkPos" type="checkbox"  name="position2" id="position2"  /></div>
			<div title="<? print $_IDIOMA->traducir("Central Back Right");?>" class="posField3" id="pP3"><input class="checkPos" type="checkbox"  name="position3" id="position3"  /></div>
			<div title="<? print $_IDIOMA->traducir("Right Back");?>" class="posField4" id="pP4"><input class="checkPos" type="checkbox"  name="position4" id="position4"  /></div>
			<div title="<? print $_IDIOMA->traducir("Defensive Midfielder");?>" class="posField5" id="pP5"><input class="checkPos" type="checkbox"  name="position5" id="position5"  /></div>
			<div title="<? print $_IDIOMA->traducir("Creative Midfielder");?>" class="posField6"  id="pP6"><input class="checkPos" type="checkbox"  name="position6" id="position6"  /></div>
			<div title="<? print $_IDIOMA->traducir("Left Wing");?>" class="posField7"  id="pP7"><input class="checkPos" type="checkbox"  name="position7" id="position7"  /></div>
			<div title="<? print $_IDIOMA->traducir("Right Wing");?>" class="posField8"  id="pP8"><input class="checkPos" type="checkbox"  name="position8" id="position8"  /></div>
			<div title="<? print $_IDIOMA->traducir("Play Maker / Second Striker");?>" class="posField9"  id="pP9"><input class="checkPos" type="checkbox"  name="position9" id="position9"  /></div>
			<div title="<? print $_IDIOMA->traducir("Target Striker");?>" class="posField10" id="pP10" ><input class="checkPos" type="checkbox"  name="position10" id="position10"  /></div>
		</form>
		
		
		<script type="text/javascript">
		

		///click on checks////////
		
		$('#position0').click(function(){
			if($('#pP0').hasClass('checkPos2')){
				$('.posField0').toggleClass('checkPos2');	
				$("#position0").removeAttr('checked');	
				totalP--;	
			}else{
				if(totalP<3){
					$('.posField0').toggleClass('checkPos2');
					$("#position0").attr('checked','checked');		
					totalP++;			
				}else{
					$("#position0").removeAttr('checked');		
				}
			
			}
															
			
		});
		$('#position1').click(function(){																
			if($('#pP1').hasClass('checkPos2')){
				$('.posField1').toggleClass('checkPos2');	
				$("#position1").removeAttr('checked');	
				totalP--;			
			}else{
				if(totalP<3){
					$('.posField1').toggleClass('checkPos2');	
					$("#position1").attr('checked','checked');	
					totalP++;
							
				}else{
					$("#position1").removeAttr('checked');		
				}
			
			}
		});
		$('#position2').click(function(){																
			if($('#pP2').hasClass('checkPos2')){
				$('.posField2').toggleClass('checkPos2');	
				$("#position2").removeAttr('checked');		
				totalP--;
			}else{
				if(totalP<3){
					$('.posField2').toggleClass('checkPos2');	
					$("#position2").attr('checked','checked');
					totalP++;
					//alert(tot);		
				}else{
					$("#position2").removeAttr('checked');		
				}
			
			}
		});
		$('#position3').click(function(){																
			if($('#pP3').hasClass('checkPos2')){
				$('.posField3').toggleClass('checkPos2');	
				$("#position3").removeAttr('checked');		
				totalP--;	
			}else{
				if(totalP<3){
					$('.posField3').toggleClass('checkPos2');
					$("#position3").attr('checked','checked');		
					totalP++;
					
				}else{
					$("#position3").removeAttr('checked');		
				}
			
			}
		});
		$('#position4').click(function(){																
			if($('#pP4').hasClass('checkPos2')){
				$('.posField4').toggleClass('checkPos2');	
				$("#position4").removeAttr('checked');
				totalP--;
			}else{
				if(totalP<3){
					$('.posField4').toggleClass('checkPos2');
					$("#position4").attr('checked','checked');	
					totalP++;
				}else{
					$("#position4").removeAttr('checked');		
				}
			
			}
		});
		$('#position5').click(function(){																
			if($('#pP5').hasClass('checkPos2')){
				$('.posField5').toggleClass('checkPos2');
				$("#position5").removeAttr('checked');	
				totalP--;
				//alert(totalP);
			}else{
				if(totalP<3){
					$('.posField5').toggleClass('checkPos2');
					$("#position5").attr('checked','checked');
					totalP++;
					//alert(totalP);			
				}else{
					$("#position5").removeAttr('checked');		
				}
			
			}
		});
		$('#position6').click(function(){																
			if($('#pP6').hasClass('checkPos2')){
				$('.posField6').toggleClass('checkPos2');
				$("#position6").removeAttr('checked');	
				totalP--;
				//alert(tot);	
			}else{
				if(totalP<3){
					$('.posField6').toggleClass('checkPos2');
					$("#position6").attr('checked','checked');
					totalP++;
					//alert(tot);		
				}else{
					$("#position6").removeAttr('checked');		
				}
			
			}
		});
		$('#position7').click(function(){																
			if($('#pP7').hasClass('checkPos2')){
				$('.posField7').toggleClass('checkPos2');
				$("#position7").removeAttr('checked');
				totalP--;	
				//alert(tot);
			}else{
				if(totalP<3){
					$('.posField7').toggleClass('checkPos2');
					$("#position7").attr('checked','checked');
					totalP++;
					//alert(tot);		
				}else{
					$("#position7").removeAttr('checked');		
				}
			
			}
		});
		$('#position8').click(function(){																
			if($('#pP8').hasClass('checkPos2')){
				$('.posField8').toggleClass('checkPos2');
				$("#position8").removeAttr('checked');	
				totalP--;	
			}else{
				if(totalP<3){
					$('.posField8').toggleClass('checkPos2');
					$("#position8").attr('checked','checked');
					totalP++;		
						
				}else{
					$("#position8").removeAttr('checked');		
				}
			
			}
		});
		$('#position9').click(function(){																
			if($('#pP9').hasClass('checkPos2')){
				$('.posField9').toggleClass('checkPos2');
				$("#position9").removeAttr('checked');		
				totalP--;
			}else{
				if(totalP<3){
					$('.posField9').toggleClass('checkPos2');
					$("#position9").attr('checked','checked');
					totalP++;
					
				}else{
					$("#position9").removeAttr('checked');		
				}
			
			}
		});
		$('#position10').click(function(){																
			if($('#pP10').hasClass('checkPos2')){
				$('.posField10').toggleClass('checkPos2');	
				$("#position10").removeAttr('checked');
				totalP--;
			}else{
				if(totalP<3){
					$('.posField10').toggleClass('checkPos2');
					$("#position10").attr('checked','checked');	
					totalP++;	
					
				}else{
					$("#position10").removeAttr('checked');		
				}
			
			}
		});
		
		
	
		
		<? 
		$tot=0;
		function checaThePos($thePos,$tot){
		if(!empty($thePos)){
		foreach($thePos as $tPos){
			if(strlen($tPos)>0){
				$tot++;
			}
		
		
			if($tPos=='1'){
				?>
				$('.posField0').toggleClass('checkPos2');
				$('#position0').attr('checked','checked'); 
				<?
			}elseif($tPos=='2'){
				?>
				$('.posField1').toggleClass('checkPos2');
				$('#position1').attr('checked','checked'); 
				<?
			}elseif($tPos=='3'){
				?>
				$('.posField2').toggleClass('checkPos2');
				$('#position2').attr('checked','checked');
				<?
			}elseif($tPos=='4'){
				?>
				$('.posField3').toggleClass('checkPos2');
				$('#position3').attr('checked','checked'); 
				<?
			}elseif($tPos=='5'){
				?>
				$('.posField4').toggleClass('checkPos2');
				$('#position4').attr('checked','checked');
				<?
			}elseif($tPos=='6'){
				?>
				$('.posField5').toggleClass('checkPos2');
				$('#position5').attr('checked','checked'); 
				<?
			}elseif($tPos=='7'){
				?>
				$('.posField6').toggleClass('checkPos2');
				$('#position6').attr('checked','checked'); 
				<?
			}elseif($tPos=='8'){
				?>
				$('.posField7').toggleClass('checkPos2');
				$('#position7').attr('checked','checked');
				<?
			}elseif($tPos=='9'){
				?>
				$('.posField8').toggleClass('checkPos2');
				$('#position8').attr('checked'); 
				<?
			}elseif($tPos=='10'){
				?>
				$('.posField9').toggleClass('checkPos2');
				$('#position9').attr('checked','checked');
				<?
			}elseif($tPos=='11'){
				?>
				$('.posField10').toggleClass('checkPos2');
				$('#position10').attr('checked','checked'); 
				<?
			}	
	
		}
		}//if[0]
		?>
		/////set the total pos///////
		totalP=<? echo $tot ?>;
		<?
		}//func checa
		
		
		///call to check the positions///
		checaThePos($thePos,$tot);		
		?>
		
		
		
		
		
		
		
		/////////send form/////////
		function sPF(){
			$('#formPosField').submit();
			$('#changePosMsg').html('<img src="img/indicator.gif" width="15" height="15"/>');
		}
		////////reset form////////
		function rPF(){
			//totalP=0;
			for(j=0;j<11;j++){
				if($("#pP"+j).hasClass('checkPos2')){
					$(".posField"+j).toggleClass('checkPos2');
					$("#position"+j).removeAttr('checked');	
				}
			}//for
			/////reset to the orig pos///
			<? 
			$tot=0;
			///call to check the positions///
			checaThePos($thePos,$tot); ?>
			
		}//rPF	
		</script>
		
		
		
		
		
		
		<!-- ////////// Save changes ////////////// -->
		<div title="<? print $_IDIOMA->traducir("Save Positions");?>" id="saveChangePos" class="saveChangePos" onclick="sPF();"></div>
		<div title="<? print $_IDIOMA->traducir("Undo");?>" id="resetChangePos" class="resetChangePos" onclick="rPF();"></div>
		<div class="changePosMsg" id="changePosMsg"></div>
		
		
		
		
		
		
		<?
		
		///Not editting///
		}else{
		
		
		
		if(!empty($thePos)){
		
		foreach($thePos as $tPos){
			
			if($tPos=='1'){
				echo '<div class="posField0"><img title="'.$_IDIOMA->traducir("Goalkeeper").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='2'){
				echo '<div class="posField1"><img title="'.$_IDIOMA->traducir("Left Back").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='3'){
				echo '<div class="posField2"><img title="'.$_IDIOMA->traducir("Central Back Left").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='4'){
				echo '<div class="posField3"><img title="'.$_IDIOMA->traducir("Central Back Right").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='5'){
				echo '<div class="posField4"><img title="'.$_IDIOMA->traducir("Right Back").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='6'){
				echo '<div class="posField5"><img title="'.$_IDIOMA->traducir("Defensive Midfielder").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='7'){
				echo '<div class="posField6"><img title="'.$_IDIOMA->traducir("Creative Midfielder").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='8'){
				echo '<div class="posField7"><img title="'.$_IDIOMA->traducir("Left Wing").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='9'){
				echo '<div class="posField8"><img title="'.$_IDIOMA->traducir("Right Wing").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='10'){
				echo '<div class="posField9"><img title="'.$_IDIOMA->traducir("Play Maker / Second Striker").'" src="img/pos0.png"/></div>';
			}elseif($tPos=='11'){
				echo '<div class="posField10"><img title="'.$_IDIOMA->traducir("Target Striker").'" src="img/pos0.png"/></div>';
			}
		
		}
		
		}//if[0]
	
	}///edit




}//if player
	
	


?>
