<?php
$dir='';
require_once($_SERVER['DOCUMENT_ROOT'].$dir.'/gestion/modulos/photo/photoClass.php');




/////////////if there is a file, deletes it////////////
$iVpuF_ph=$_POST['pVpuF_ph'];

if(addslashes(base64_decode($iVpuF_ph['4']))!=0){

			require_once ($_SERVER['DOCUMENT_ROOT'].$dir.'/rackspace/lib/cloudfiles.php');
			//********** Autenticacion**********//
			$auth = new CF_Authentication ("soccermash", "92f6ab773351c06f10d29f2a9bbc3999");
			$auth->authenticate ();
			$conn = new CF_Connection ( $auth );
			//********** FIN Autenticacion**********//
			//********** Subir Archivo**********//
			
			$comp_cont = $conn->get_container('big-file-php');
			$comp_cont->delete_object(addslashes(base64_decode($iVpuF_ph['4'])));
			
			
			
			/////////////delete thumb///////
			unlink($_SERVER['DOCUMENT_ROOT'].$dir.'/photoPhoto/'.addslashes(base64_decode($iVpuF_ph['4'])));
			
			
			/////////////delete register/////////////////////
$pho=new Photo();
$pho->delPhoto('id='.addslashes(base64_decode($iVpuF_ph['0'])));

		?>
		<script type="text/javascript">
			loadPhotos();
		</script>
		<?			

}//if fileName

			
?>