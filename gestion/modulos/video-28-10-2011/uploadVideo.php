<html>
<head>
<meta http-equiv="Content-Type" content="text/css; charset=utf-8" />
</head>
<body>
<?php
 
  
 ////translation///////
	 require_once $_SERVER["DOCUMENT_ROOT"]. '/gbase.php';
	 require_once $_GBASE. '/goaamb/idioma.php';
	if(class_exists("Idioma")){
		 $_IDIOMA=Idioma::darLenguaje();
	  }		

	global $_IDIOMA;
 
 ////////////Check if the file is supported/////////////
 
		if($_FILES['fileName']['name']){
		
		$fil=explode('.',$_FILES['fileName']['name']);
	
		if($fil[1]!='flv' && $fil[1]!='mp4' && $fil[1]!='f4v' && $fil[1]!='3gp' && $fil[1]!='mov' && $fil[1]!='FLV' && $fil[1]!='MP4' && $fil[1]!='F4V' && $fil[1]!='3GP' && $fil[1]!='MOV'){
			?>
			<script type="text/javascript">
				
				window.top.window.document.getElementById('saveVideoFile').innerHTML='<? print $_IDIOMA->traducir('Video format not supported'); ?>';
				
			</script>
	
	      <?
			
			die();
		}
		
		
		}
//////////////////////////////////////////////////////////////

		

 $dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/site_ini.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/videoClass.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/getPost.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/youApi/youClass.php');


		
	////////////////////////////////////////////////////////////
	#Para subir foto como agent de un player
	if(isset($_SESSION["bEditPlayer"]) && ($_SESSION["bEditPlayer"]==true) && ($_SESSION["sNameAgent"]!=false) ) {
		if(isset($_SESSION["iIdPlayer"]) && isset($_SESSION["iPerfilPlayer"]) ){
			$rand=md5(addslashes($_SESSION["iIdPlayer"])).rand(10,300);
		}
	}else{#en otro caso
		$rand=md5(addslashes($_POST['idUserId'])).rand(10,300);
	}
	
	if($_FILES['fileName']['name']){
		$theFileName=ereg_replace( "([     ]+)", "", $_FILES['fileName']['name']);
		$fields['fileName']=$rand.$theFileName; 
	
	//////////////////Save file/////////////////////////
			
				
			 $uploaddir = $_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/video/uploadTemp/';
			 move_uploaded_file($_FILES['fileName']['tmp_name'],$uploaddir.$rand.$theFileName);
			 
			
			
			
			require_once ($_SERVER['DOCUMENT_ROOT'].$dir.'/rackspace/lib/cloudfiles.php');
			//********** Authentication**********//
			$auth = new CF_Authentication ("soccermash", "92f6ab773351c06f10d29f2a9bbc3999");
			$auth->authenticate ();
			$conn = new CF_Connection ( $auth );
			//********** FIN Authentication**********//
			//********** upload**********//
			$archivo = $uploaddir.$rand.$theFileName;
			$pi = pathinfo ( $archivo );
			//crear un contenedor
			#$comp_cont = ($conn->create_container ( "video" ));
			//get container
			$comp_cont = $conn->get_container('videos');
			//upload
			$md5_orig = md5_file ( $archivo );
			$filesize_orig = filesize ( $archivo );
			$obj = $comp_cont->create_object ( $pi ['basename'] );
			$obj->content_type = "application/octet-stream";
			$obj->set_etag ( $md5_orig );
			$fp = fopen ( $archivo, "rb" );
			$obj->write ( $fp );
			fclose ( $fp );
			//********** FIN upload**********//
			
			
			
			///////////////deletes the temp file/////////////////////////
			unlink($uploaddir.$rand.$theFileName);
			
			
			////////////creates the img name////////////////////////////////////
			$imName=explode('.',$rand.$theFileName);
			$imgName=$imName[0].'.jpg';
			
			
			
						////////////curl to generate thumb//////////
						$url = "http://50.57.87.252/videos/vid.php";   
						$valor=$rand.$theFileName;
						$parameter = 'thumbFile='.urlencode($valor); 
						
						$sesion = curl_init($url);  
						// set POST  
						curl_setopt ($sesion, CURLOPT_POST, true);   
						// set parameters  
						curl_setopt ($sesion, CURLOPT_POSTFIELDS, $parameter);   
						// only get the response  
						curl_setopt($sesion, CURLOPT_HEADER, false);   
						curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);  
						// ejecute  (returns the thumb name)
						$response = curl_exec($sesion);   
						// close
						curl_close($sesion);  
	
						
						
						/////////////copy the thumb to this server/////////////////////
						if(copy('http://50.57.87.252/videos/'.$imgName,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoVideo/'.$imgName)){
							
							if(copy('http://50.57.87.252/videos/small_'.$imgName,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoVideo/small_'.$imgName)){

							/////////deletes the thumb generated from cloud server///////////
							$url = "http://50.57.87.252/videos/delThumb.php";   
							$valor2 = $imgName;
							$parameter2 = 'thumbFile='.urlencode($valor2); 
							
							$sesion = curl_init($url);  
							// set POST  
							curl_setopt ($sesion, CURLOPT_POST, true);   
							// set parameters  
							curl_setopt ($sesion, CURLOPT_POSTFIELDS, $parameter2);   
							// only get the response  
							curl_setopt($sesion, CURLOPT_HEADER, false);   
							curl_setopt($sesion, CURLOPT_RETURNTRANSFER, true);  
							// ejecute  (returns the thumb name)
							$response2 = curl_exec($sesion);   
							// close
							curl_close($sesion);
							
							}
						
						}		 
	
	}else{
	
			///////////////tomar thumb de youtube..//////////////
			
					/////if it is embedded/////
					if (preg_match("/youtu.be/i", $_POST['youtube'])) {
						$youExp=explode('http://youtu.be/',$_POST['youtube']);
						$_POST['youtube']='http://www.youtube.com/watch?v='.$youExp[1].'&feature=related';
						
						$youtube = new youtube($_POST['youtube']);
						$randoImg=md5(addslashes($_POST['idUserVisiting'])).rand(400,5000).'.jpg';
						copy($youtube->getUrlImage('default'),$_SERVER['DOCUMENT_ROOT'].$dir.'/photoVideo/small_'.$randoImg);
						copy($youtube->getUrlImage('grande'),$_SERVER['DOCUMENT_ROOT'].$dir.'/photoVideo/'.$randoImg);	
						$imgName=$randoImg;	
				
					} elseif(preg_match("/www.youtube.com\/watch/i", $_POST['youtube']))  {
						
						$youtube = new youtube($_POST['youtube']);
						$randoImg=md5(addslashes($_POST['idUserVisiting'])).rand(400,5000).'.jpg';
						copy($youtube->getUrlImage('default'),$_SERVER['DOCUMENT_ROOT'].$dir.'/photoVideo/small_'.$randoImg);
						copy($youtube->getUrlImage('grande'),$_SERVER['DOCUMENT_ROOT'].$dir.'/photoVideo/'.$randoImg);	
						$imgName=$randoImg;	
					
					}	else{
							
							
							?>
							<script type="text/javascript">
								window.top.window.document.getElementById('saveVideoFile').innerHTML='';
								window.top.window.document.getElementById('fileAdvisorVideo').innerHTML='<? print $_IDIOMA->traducir('Url format not supported'); ?>';
								
								
							</script>
					
	   					   <?
							
							die();
					
					}
			
			
			
			
	
	
	}//if filename
				
				

	//////////////////Get data//////////////////////////////////////////
		#Si Edicion Agent-Player
		if(isset($_SESSION["bEditPlayer"]) && ($_SESSION["bEditPlayer"]==true) && ($_SESSION["sNameAgent"]!=false) ) {
				if(isset($_SESSION["iIdPlayer"]) && isset($_SESSION["iPerfilPlayer"]) && isset($_SESSION["iSexPlayer"]) && isset($_SESSION["iCountryPlayer"]) && isset($_SESSION["iProfileAgent"]) ){
						
					$fields['idUserUploading']	=addslashes($_SESSION["iIdPlayer"]);
					$fields['idUser']			=addslashes($_SESSION["iIdPlayer"]);
					$fields['idProfile']		=addslashes($_SESSION["iPerfilPlayer"]);
					$fields['countryId']		=addslashes($_SESSION["iCountryPlayer"]);
					$fields['sex']				=addslashes($_SESSION["iSexPlayer"]);
					$fields['name']				=addslashes($_POST['nameVideo']);
					$fields['tagsVideo']		=".";
					$fields['photo']			=addslashes($imgName);
					$fields['registerDate']		=time();
				}
		}else{		
					$fields['idUser']			=addslashes($_POST['idUserVisiting']);
					$fields['idUserUploading']	=addslashes($_POST['idUser']);
					$fields['idProfile']		=addslashes($_POST['idProfileVisiting']);
					$fields['countryId']		=addslashes($_POST['countryId']);
					$fields['sex']				=addslashes($_POST['sex']);
					$fields['name']				=addslashes($_POST['nameVideo']);
					$fields['tagsVideo']		=".";
					$fields['photo']			=addslashes($imgName);
					$fields['registerDate']		=time();
		}	
		
		if(addslashes($_POST['youtube'])){
				$fields['youtube']=addslashes($_POST['youtube']);
	
					///////////////////Save Data with ytb dta///////////////////////////
					$vid=new Video();
					if(!$vid->addVideo($fields)){
				
					echo "
						<script type='text/javascript'>
							window.top.window.document.getElementById('saveVideoFile').innerHTML='".$_IDIOMA->traducir('Error saving data')."';
						</script>
					";
					
					}else{
					
					echo "
						<script type='text/javascript'>
							window.top.window.document.getElementById('saveVideoFile').innerHTML='".$_IDIOMA->traducir('Video Saved')."';
							window.top.window.document.getElementById('nameVideo').value='';
						
							window.top.window.document.getElementById('youtube').value='';
							window.top.window.document.getElementById('fileName').value='';
							window.top.window.document.getElementById('saveVideoFile').innerHTML='';
							window.top.window.hide_me('videoUploader');
							window.top.window.loadVideoSlider();
							window.top.window.$('#slidesContainer').addClass('isvideo');
						</script>
						";
					}
	
	
		}else{//youtube
		
					//////////////////Save Data///////////////////////////
					$vid=new Video();
					if(!$vid->addVideo($fields)){
				
					echo "
						<script type='text/javascript'>
							window.top.window.document.getElementById('saveVideoFile').innerHTML='".$_IDIOMA->traducir('Error saving data')."';
						</script>
					";
					}else{
					
					echo "
						<script type='text/javascript'>
							window.top.window.document.getElementById('saveVideoFile').innerHTML='".$_IDIOMA->traducir('Video Saved')."';
							window.top.window.document.getElementById('nameVideo').value='';
						
							window.top.window.document.getElementById('youtube').value='';
							window.top.window.document.getElementById('fileName').value='';
							window.top.window.document.getElementById('saveVideoFile').innerHTML='';						
							window.top.window.hide_me('videoUploader');
							window.top.window.loadVideoSlider();
							window.top.window.$('#slidesContainer').addClass('isvideo');
							
						</script>
						";
					}
		
		
		}//file
	?>	</body></html>