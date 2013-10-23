<?php
	
	if($_POST['thumbFile']){
					
			//////////////////////Create thumb from video/////////////////////////////////////////////
			$imName=explode('.',$_POST['thumbFile']);
			$imgName=$imName[0].'.jpg';
				
			exec('ffmpeg  -ss 4 -i http://c590104.r4.cf2.rackcdn.com/'.$_POST['thumbFile'].' -s 100x100 -f image2 -vframes 1 small_'.$imgName);
			
			exec('ffmpeg  -ss 4 -i http://c590104.r4.cf2.rackcdn.com/'.$_POST['thumbFile'].' -s 589x354 -f image2 -vframes 1 '.$imgName);
		
		    echo $imgName;
	
	
	}
		
		
	
	
	 
?>

