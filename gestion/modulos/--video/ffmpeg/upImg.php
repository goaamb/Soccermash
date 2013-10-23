<?
 ////////////////////////Upload the thumb to the website/////////////////////////////
		$dir='/soccermashTest2';
		$imageSave=addslashes($_POST['upImg']);
	    copy('http://50.57.87.252/videos/'.$imageSave,$_SERVER['DOCUMENT_ROOT'].$dir.'/photoVideo/'.$imageSave);
		
		
		
		//call to delete the thumb from server:
		
		echo "<script type='text/javascript'>
			
			/*window.top.window.document.getElementById('delThumb').value='".$imageSave."';
			window.top.window.document.getElementById('saveVideoFile').innerHTML='deleting';
			window.top.window.document.getElementById('delThumbForm').submit();*/
			
		    window.top.window.document.getElementById('saveVideoFile').innerHTML='Video Saved';
			window.top.window.document.getElementById('nameVideo').value='';
			window.top.window.document.getElementById('youtube').value='';
			window.top.window.document.getElementById('fileName').value='';
			
		</script>";
		
		
?>