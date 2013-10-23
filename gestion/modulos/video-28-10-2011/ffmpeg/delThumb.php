<?php
	
	if($_POST['thumbFile']){
					
			///////////////////deletes the generated thumb////////////////////////
			unlink($_POST['thumbFile']);
			unlink('small_'.$_POST['thumbFile']);

	}    
		
		
	
	
	 
?>

