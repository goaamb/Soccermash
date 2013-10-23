<?

unlink(addslashes($_POST['delThumb']));

//delete the thumb from server:
		
		echo "<script type='text/javascript'>
			
		    window.top.window.document.getElementById('saveVideoFile').innerHTML='Video Saved';
			window.top.window.document.getElementById('nameVideo').value='';
			window.top.window.document.getElementById('youtube').value='';
			window.top.window.document.getElementById('fileName').value='';
			
		</script>";
?>