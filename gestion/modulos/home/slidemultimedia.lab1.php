<script type="text/javascript">
 $(document).ready(function (){
	$("#photoFileName").change(function(){
		var g = $("#photoFileName").val();
		$("#ruta").text(g);
	});
 });
</script>
<div id="slideMultimedia">

<? /////////////////////////////////////////////////////////////////////////////////
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoClass.php');
////////////////////////////////////////////////////////////////////////////////////////



	//hides the uploading buttons
	if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
		$hideUpload='style="display:block;"';
		$widthVid="style='width:146px;'";
		$idv="video";
		$idp="photo";	
	}else{
		$hideUpload='style="display:none;"';
		$widthVid="style='width:60px;'";
		$idv="videof";
		$idp="photof";
	}
	
	if(isset($_SESSION['editProfile']) && $_SESSION['editProfile']==true){
		$editProfile=true;
	}else{
		$editProfile=0;
	}
	
?>

<div id="holdmultimedia">
    <ul class="menuMulti">
      <li title="<? print $_IDIOMA->traducir("Videos"); ?>" class="<?php print $idv;?> tabbg open" id="video" <? echo $widthVid; ?>><img src="img/videoOn.jpg" width="20" height="20"/><em <? echo $hideUpload ?>><? print $_IDIOMA->traducir("Upload video"); ?></em></li>
      <li title="<? print $_IDIOMA->traducir("Photos"); ?>" class="<?php print $idp;?> tabbg"  id="photo" <? echo $widthVid; ?>><img src="img/photoOff.jpg" width="20" height="20"/><em <? echo $hideUpload ?>><? print $_IDIOMA->traducir("Upload photo"); ?></em></li>
      <li style="display:none;" title="Audio" class="tabbg" id="audio"><img src="img/audioOff.jpg" width="20" height="20"/><em>Upload audio</em></li>
      <li style="display:none;" title="Notes" class="tabbg" id="notes"><img src="img/notesOff.jpg" width="20" height="20"/><em>Upload note</em></li>
    </ul>
</div><!--END hold-->

                   
          <div id="loadcontent" class="container">  
                <div id="pageContainer" >     
                  <!-- Slideshow HTML -->
                  <div id="slideshow">
                     <div id="slidesContainer">    
        					
					<!-- ////////////////////// VIDEOS Slider ////////////////////////////// -->
					    
					
					<script type="text/javascript">
					function loadVideoSlider(){
						iUp_uV_pV_uN_pN_eP=new Array();
						iUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
						iUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
						iUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($idUserVisiting); ?>');
						iUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($idProfileVisiting); ?>');
						iUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
						iUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
						iUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($editProfile); ?>');
						$("#slidesContainer").html('');	
						$("#slidesContainer").html('<img src="img/indicator.gif" width="16" height="16"/>');
						$("#slidesContainer").load('gestion/modulos/video/view/videoSlider.php',{iUp_uV_pV_uN_pN_eP:iUp_uV_pV_uN_pN_eP});
					}
					
						
						
						
						//////////photo slider/////////
					
					function loadPhotoSlider(){
						pUp_uV_pV_uN_pN_eP=new Array();
						pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
						pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
						pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($idUserVisiting); ?>');
						pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($idProfileVisiting); ?>');
						pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
						pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
						pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($editProfile); ?>');
						$("#slidesContainer").html('');	
						$("#slidesContainer").html('<img src="img/indicator.gif" width="16" height="16"/>');
						$("#slidesContainer").load('gestion/modulos/photo/view/photoSlider.php',{pUp_uV_pV_uN_pN_eP:pUp_uV_pV_uN_pN_eP});
					}
						
						
						
					</script>
				 	
      
	  
                     </div><!--END slidesContainer-->
                     <div id="ctrls"><em>[+]</em></div>
                  </div><!-- Slideshow HTML -->
              </div><!--END pageContainer-->
         </div><!--END content-->         
          
</div><!--slideMultimedia-->

<!-- ////////////////////// VIDEO UPLOADER ////////////////////////////// -->
						<div id="videoUploader" style="background:#FFF;"> 
							<div id="intoUpload" class="onright"><a href="javascript:;" onclick="hide_me('videoUploader');"><? print $_IDIOMA->traducir("Close"); ?></a></div> 
							
							<?
							if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
							?>
							<form id="videoForm" name="videoForm" method="post" target="iframeVideo" action="gestion/modulos/video/uploadVideo.php" enctype="multipart/form-data">
							
								<input type="hidden" name="idUserVisiting" id="idUserVisiting" value="<? echo $idUserVisiting;?>" />
								<input type="hidden" name="idProfileVisiting" id="idProfileVisiting" value="<? echo $idProfileVisiting;?>" />
								<input type="hidden" name="idUser" id="idUser" value="<? echo $_SESSION["iSMuIdKey"];?>" />
								<input type="hidden" name="idProfile" id="idProfile" value="<? echo $_SESSION["iSMuProfTypeKey"];?>" />
								<input type="hidden" name="countryId" id="countryId" value="<? echo $aUsuario['countryId'];?>" />
								<input type="hidden" name="sex" id="sex" value="<? echo $aUsuario['sex'];?>" />								
								
								<label for="nameVideo"><? print $_IDIOMA->traducir("Video Name"); ?>:
								<input type="text" name="nameVideo" tabindex="1" id="nameVideo" />
                </label>		
								<div id="nameAdvisorVideo" class="alerts"></div>

								<label for="tagsVideo" style="display:none;"><? //print $_IDIOMA->traducir("Tags"); ?>:
								<input type="text" name="tagsVideo" tabindex="2" id="tagsVideo" value="." />
				</label>
                
								
								<div id="tagsAdvisorVideo" class="alerts"></div>
                
								<label id="youVid" for="youtube"><? print $_IDIOMA->traducir("Video url (from Youtube)"); ?>:
								<input type="text" name="youtube" tabindex="3" id="youtube" />
								<div class="uploaderPos"><a href="javascript:;" onclick="hide_me('youVid'); unhide_me('fileVid');" ><? print $_IDIOMA->traducir("Upload video file from your computer"); ?></a></div>
                </label>
                
				
								<label id="fileVid" style="display:none;" for="fileName"><? print $_IDIOMA->traducir("Video File: (supported formats: flv, mp4, f4v, 3gp, mov)"); ?>
								<!--<input type="text" name="fileName" tabindex="4" id="nameVideo" value="" />-->
								<div id="uplMultimedia"><input type="file" name="fileName" tabindex="4" id="fileName" multiple=""/></div> 
								<div class="uploaderPos" style="padding-top:25px;"><a href="javascript:;" onclick="hide_me('fileVid'); unhide_me('youVid');" ><? print $_IDIOMA->traducir("Upload from Youtube: (URL)"); ?> </a></div>
                </label>		
								
                
								<div id="fileAdvisorVideo" class="alerts"></div>
                
								<input id="upVideoBttn" type="button" class="onright" tabindex="5" onclick="saveVideoFile('saveFile');" value="<? print $_IDIOMA->traducir("UPLOAD"); ?>" />
							</form>
							
							<iframe id="iframeVideo" name="iframeVideo" src="" style="width:0;height:0;border:none;"></iframe>	
							
							<? 
              				}else{
							
								echo '<div class="alerts">'.$_IDIOMA->traducir("Please, click on \"Edit this profile\" to upload a file").'</div>';
							}
							 ?>
												
							<div id="saveVideoFile"></div>
																			  
              												  
						</div><!--END videoUploader-->
            
			
			
			
			
<!-- ////////////////////// PHOTO UPLOADER ////////////////////////////// -->
						<div id="photoUploader"> 
							<div id="intoUpload" class="onright"><a href="javascript:;" onclick="hide_me('photoUploader');"><? print $_IDIOMA->traducir("Close"); ?></a></div> 
							
							<?
							if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
							?>
							
							<form id="photoForm" name="photoForm" method="post" target="iframePhoto" action="gestion/modulos/photo/uploadPhoto.php" enctype="multipart/form-data">
							
								<input type="hidden" name="idUserVisiting2" id="idUserVisiting2" value="<? echo $idUserVisiting;?>" />
								<input type="hidden" name="idProfileVisiting2" id="idProfileVisiting2" value="<? echo $idProfileVisiting;?>" />
								<input type="hidden" name="idUserId" id="idUserId" value="<? echo $_SESSION["iSMuIdKey"];?>" />
								<input type="hidden" name="idProfileId" id="idProfileId" value="<? echo $_SESSION["iSMuProfTypeKey"];?>" />
								<input type="hidden" name="countryId2" id="countryId2" value="<? echo $aUsuario['countryId'];?>" />
								<input type="hidden" name="sex2" id="sex2" value="<? echo $aUsuario['sex'];?>" />				
								
								<label for="nameVideo"><? print $_IDIOMA->traducir("Photo Name"); ?>:
								<input type="text" name="namePhoto" tabindex="1" id="namePhoto" /> 
                </label>
                
								<div id="nameAdvisorPhoto" class="alerts"></div>
                
				
								<label for="tagsPhoto" style="display:none;"><? //print $_IDIOMA->traducir("Tags"); ?>:	
								<input type="text" name="tagsPhoto" tabindex="2" id="tagsPhoto" value="."/>
				</label>
                
								
								<div id="tagsAdvisorPhoto" class="alerts"></div>
				
								               
								<label for="fileNamePhoto"><? print $_IDIOMA->traducir("Photo File: (jpg, jpeg, bmp, png or gif)"); ?>
<div id="ruta" style="font-size: 12px; margin-top: 10px; display:block; "></div>							
								<div id="uplMultimediaPhoto"><input type="file" name="photoFileName" tabindex="2" id="photoFileName" multiple=""/> </div>
								
                </label>
                
								<div id="fileAdvisorPhoto" class="alerts"></div>
               
								<input type="button" class="onright" tabindex="3" onclick="savePhotoFile('saveFile');" value="<? print $_IDIOMA->traducir("UPLOAD"); ?>" />
							</form>
							
							<iframe id="iframePhoto" name="iframePhoto" src="" style="width:0;height:0;border:none;"></iframe>		
												
							<div id="savePhotoFile"></div>
							
							<? 
              				}else{
							
								echo '<div class="alerts">'.$_IDIOMA->traducir("Please, click on \"Edit this prifile\" to upload a file").'</div>';
							}
							 ?>
																			  
</div>
							


<!-- ------------------------------------------------------------------------------------ -->							

							<!-- delete video -->			
							<div id="delVideo"></div>
							
							<!-- delete photo -->			
							<div id="delPhoto"></div>

	
					
					 <!-- ////////////////////// Multimedia ////////////////////////////// -->
	
	
					<div id="extendedGallery">
					<script type="text/javascript">
						 <!-- ////////////////////// VIDEOS ////////////////////////////// -->
					    
						function loadVideos(){
							sUp_uV_pV_uN_pN_eP=new Array();
							sUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
							sUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
							sUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($idUserVisiting); ?>');
							sUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($idProfileVisiting); ?>');
							sUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
							sUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
							sUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($editProfile); ?>');
							sUp_uV_pV_uN_pN_eP.push('<? echo base64_encode(1); ?>');
							
						$("#extendedGallery").html('');	
						$("#extendedGallery").html('<img src="img/indicator.gif" width="16" height="16"/>');
						$("#extendedGallery").load('gestion/modulos/video/view/videoTester.php',{sUp_uV_pV_uN_pN_eP:sUp_uV_pV_uN_pN_eP});
						}
						
						
						function loadPhotos(){
							pUp_uV_pV_uN_pN_eP=new Array();
							pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["iSMuIdKey"]); ?>');
							pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["iSMuProfTypeKey"]); ?>');
							pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($idUserVisiting); ?>');
							pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($idProfileVisiting); ?>');
							pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["nameUserSM"]); ?>');
							pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($_SESSION["namePerfilUserSM"]); ?>');
							pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode($editProfile); ?>');
							pUp_uV_pV_uN_pN_eP.push('<? echo base64_encode(1); ?>');
							
						$("#extendedGallery").html('');	
						$("#extendedGallery").html('<img src="img/indicator.gif" width="16" height="16"/>');
						$("#extendedGallery").load('gestion/modulos/photo/view/photoTester.php',{pUp_uV_pV_uN_pN_eP:pUp_uV_pV_uN_pN_eP});
						}
					</script>
				 	</div>
     
	 
	 <?
	 //////////////////Check if opens video or photo///////////////////
	  if(!isset($_SESSION['idUserVisiting']) || $_SESSION['idUserVisiting']==0 || $_SESSION['idUserVisiting']==$_SESSION['iSMuIdKey']){
		 $idUserVisiting=$_SESSION["iSMuIdKey"];
	 }else{
		 $idUserVisiting=$_SESSION["idUserVisiting"];
	 }
		$vid=new Video();
		 $registros=$vid->selectVideo(0,'*',"idUser='$idUserVisiting'","id desc LIMIT 0,6");

	if($registros[0]!=''){
		echo '
			<script type="text/javascript">
				loadVideoSlider();
			</script>
		';
		
		
	}else{
		echo '
			<script type="text/javascript">
				$("#slidesContainer").addClass("isphoto");
				loadPhotoSlider();
			</script>
		';
	
	}//
	 
	 ?>				


				