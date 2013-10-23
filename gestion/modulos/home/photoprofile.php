<? 
if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
$mostrarOcultar=true;
?>
 <script type="text/javascript">
//////////////show hide photo uploader////////////////////////////
function mostrar(){
	document.getElementById("divUpload").style.display = "block";
}

function ocultar(){
	document.getElementById("divUpload").style.display = "none";
}



//////////////////check format////////////////////

function checkFormat(file , ext){
	  if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
	   // extensiones permitidas
	   alert("Error: Solo se permiten imagenes");
	   // cancela upload
	   return false;
	  } else {	   
	   document.getElementById("showPhoto").innerHTML='<div class="divUploadGif"><img src="img/carga.gif"  width="15" height="15" /></div> ';
	  }
	  }


/////////change the photo/////////////
function chgMyPht(){
    document.getElementById("showPhoto").innerHTML='<div class="divUploadGif"><img src="img/carga.gif"  width="15" height="15" /></div> ';
	$('#frmPProfile').submit();
}



</script>
<?
}
?>

<div id="photoProfile">
	<?
   //////Move the img to center thumb//////////
				$aImPhoto=array();
				$aImPhoto=@getimagesize("photoGeneral/big/".$aUsuario['photo']);
				
				if($aImPhoto[0]>180){
					$moveLeft='style="margin-left:-'.(($aImPhoto[0]-180)/2).'px;"';
				}else{
					$moveLeft='';
				}
				
				
				/*if($aImPhoto[1]>180){
					$moveTop='margin-top:-'.(($aImPhoto[1]-180)/2).';';
				}else{
					$moveTop='';
				}*/
				

   $rand = rand (1,10000);
   ?>

  
   
     <div id="showPhoto" <? echo $moveLeft; ?> <? if(isset($mostrarOcultar)){ ?>onmouseover="mostrar()" onmouseout="ocultar()" <? } ?>><img src="photoGeneral/big/<?=$aUsuario['photo'];?>?nocache=<? echo $rand; ?>"  alt="<? print $_IDIOMA->traducir("Profile Photo"); ?>" /></div>
 <?php 
 if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
 	echo '
	<iframe id="ifrmPProfile" name="ifrmPProfile" src="" style="width:0;height:0;border:none;"></iframe>	
	<div id="divUpload" class="divUpload" for="inpUpload" onmouseover="mostrar()" onclick="emergenteRedimencion()" ><!--div for change photo-->
           
		   
     </div>';
 	
	 }
 
 
 ?>   
 <!-- <form id="frmPProfile" name="frmPProfile" action="uploadPhoto/uploadFromHome.php" method="post" enctype="multipart/form-data"  target="ifrmPProfile">
		   <input id="inpUpload" name="inpUpload" type="file" onchange="chgMyPht();"> 
		   <input id="fromHome" name="fromHome" type="hidden" value="fromHome">                 
		   </form> -->

</div><!--close photoProfile-->
<div id="underPhoto">
    <span id="itemPfl"><img src="img/itemProfile.png" width="10" height="26"  /></span>
    <div id="footPhotoprofile" >
    		<ul class="paddingLC">
        	<!-- <li><img  src="img/sponsorKeyProfTEMP.png" alt="Sponsor" title="Sponsor" width="82" height="27"  /></li> -->
          <li class="bold"><? print $_IDIOMA->traducir("Administrator"); ?>:</li>
          <li class="txtColorLC">
		
		<?php 
		$mlagent=new ModelLoader("ax_generalRegister");
		if(isset($aUsuario["myAgent"])&&$aUsuario["myAgent"] &&$mlagent->buscarPorCampo(array("id"=>$aUsuario["myAgent"]))){
			$sAgentName=$mlagent->name." ".$mlagent->lastname;
		?><a class="" href="/<?php print $_IDIOMA->traducir("user")."/".$mlagent->id.'-'.Utilidades::normalizarTexto($mlagent->name." ".$mlagent->lastname);?>"> <?php print $mlagent->name." ".$mlagent->lastname;?></a><?php	
		}else{
			echo $aUsuario['name'].' '.$aUsuario['lastName'];
		}?>
	</li>
        </ul>
    </div>
</div><!--txtRight-->
