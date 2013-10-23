<?php
 
 ////////////Check if the file is supported/////////////
 
		if($_FILES['photoFileName']['name']){
		
		$fil=explode('.',$_FILES['photoFileName']['name']);
	
		if($fil[1]!='jpg' && $fil[1]!='gif' && $fil[1]!='png' && $fil[1]!='jpeg' && $fil[1]!='bmp' && $fil[1]!='JPG' && $fil[1]!='GIF' && $fil[1]!='PNG' && $fil[1]!='JPEG' && $fil[1]!='BMP'){
			?>
			<script type="text/javascript">
				
				window.top.window.document.getElementById('savePhotoFile').innerHTML='Photo format not supported';
				
			</script>
	
	      <?
			
			die();
		}
		
		
		}
		
		
		
		if($_FILES['photoFileName']['size'] >2000000){
		
			?>
			<script type="text/javascript">
				
				window.top.window.document.getElementById('savePhotoFile').innerHTML='Photo size must be less than 2 mb';
				
			</script>
	
	      <?
			
			die();
		
		}
//////////////////////////////////////////////////////////////

		

 $dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/site_ini.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/lib/share/clases/getPost.php');
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/uploadPhoto/imageResize/imageresize.class.php');



		
	////////////////////////////////////////////////////////////
	
	$rand=md5(addslashes($_POST['idUserId'])).rand(10,300);
	
	if($_FILES['photoFileName']['name']){
		$thephotoFileName=ereg_replace( "([     ]+)", "", $_FILES['photoFileName']['name']);
		$fields['fileName']=$rand.$thephotoFileName;
	
	//////////////////Save file/////////////////////////
			
			
			
			/////////photo big	
			 $uploaddir = $_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/uploadTemp/';
			 if(move_uploaded_file($_FILES['photoFileName']['tmp_name'],$uploaddir.$rand.$thephotoFileName)){
			 
			 
			 
			 
			
			
			//////////////upload to rack/////////////////
			require_once ($_SERVER['DOCUMENT_ROOT'].$dir.'/rackspace/lib/cloudfiles.php');
			//********** Authentication**********//
			$auth = new CF_Authentication ("soccermash", "92f6ab773351c06f10d29f2a9bbc3999");
			$auth->authenticate ();
			$conn = new CF_Connection ( $auth );
			//********** FIN Authentication**********//
			//********** upload**********//
			$archivo = $uploaddir.$rand.$thephotoFileName;
			$pi = pathinfo ( $archivo );
			//crear un contenedor
			#$comp_cont = ($conn->create_container ( "video" ));
			//get container
			$comp_cont = $conn->get_container('big-file-php');
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
			
			
			
			
			
			////////////////process file to set size to make thumb/////////////////////////////////
			//////small pic path//
			$uploaddir_smallPic = $_SERVER['DOCUMENT_ROOT'].$dir.'/photoPhoto/';
			
			
			$aSize=getimagesize($uploaddir.$rand.$thephotoFileName);
			
				$iVal=119;
				$eVal=180;
			
			if($aSize[0]>$aSize[1]){
				
				
				
						function checaWidth($iVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir){
							$possibleWidth=floor($aSize[0]*$iVal/$aSize[1]);
								if($possibleWidth<180){
									$iVal=$iVal+10;
									checaWidth($iVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir);
								
								}else{
								
									$resize1=new ImageResize($uploaddir.$rand.$thephotoFileName);
									$resize1->resizeHeight($iVal);
									$resize1->save($uploaddir_smallPic.$rand.$thephotoFileName);
									
								}
						}
						
						checaWidth($iVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir);
						
										
						
					
					}else{
					
						
						function checaHeight($eVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir){
							$possibleHeight=floor($aSize[1]*$eVal/$aSize[0]);
								if($possibleHeight<119){
									$eVal=$eVal+10;
									checaHeight($eVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir);
		
								}else{
									
									$resize1=new ImageResize($uploaddir.$rand.$thephotoFileName);
									$resize1->resizeWidth($eVal);
									$resize1->save($uploaddir_smallPic.$rand.$thephotoFileName);		
											
								}	
							
						}
					
						checaHeight($eVal,$aSize,$uploaddir_smallPic,$rand,$thephotoFileName,$uploaddir);
				
				
							
			
				
			
			}// if size
			
			
			
			///////////////deletes the temp file/////////////////////////
			unlink($uploaddir.$rand.$thephotoFileName);
			
								 
	
	
				
				

	//////////////////Get data//////////////////////////////////////////
			$fields['idUser']=addslashes($_POST['idUserVisiting2']);
			$fields['idUserUploading']=addslashes($_POST['idUserId']);
			$fields['idProfile']=addslashes($_POST['idProfileVisiting2']);
			$fields['countryId']=addslashes($_POST['countryId2']);
			$fields['sex']=addslashes($_POST['sex2']);
			$fields['name']=addslashes($_POST['namePhoto']);
			$fields['tagsPhoto']=addslashes($_POST['tagsPhoto']);
			$fields['photo']=addslashes($rand.$thephotoFileName);
			$fields['registerDate']=date('Y-m-d');
			


			//////////////////Save Data///////////////////////////
			$pho=new Photo();
			if(!$pho->addPhoto($fields)){
			
			echo "
			<script type='text/javascript'>
			window.top.window.document.getElementById('savePhotoFile').innerHTML='Error saving data';
			</script>
			";
			}else{
			
			echo "
			<script type='text/javascript'>
			window.top.window.document.getElementById('savePhotoFile').innerHTML='Photo Saved';
			window.top.window.document.getElementById('namePhoto').value='';
			window.top.window.document.getElementById('tagsPhoto').value='';
			window.top.window.document.getElementById('photoFileName').value='';
			window.top.window.document.getElementById('savePhotoFile').innerHTML='';
			window.top.window.hide_me('photoUploader');
			window.top.window.loadPhotoSlider();
			window.top.window.$('#slidesContainer').addClass('isphoto');
			</script>
			";
			}
			
			
			}else{
		
			
				?>
			<script type="text/javascript">
				
				window.top.window.document.getElementById('savePhotoFile').innerHTML='Error uploading file, please try again';
				
			</script>
	
	      <?
			
			die();
			
			
			}//if move file
		
		}//file
	?>	