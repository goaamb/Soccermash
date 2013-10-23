<?php
echo 'as';
	

	 
	 //exec('ffmpeg  -ss 4 -i http://c590104.r4.cf2.rackcdn.com/02.flv -f image2 -vframes 1 warcraft.jpg');
	 exec('fmpeg -i http://c590104.r4.cf2.rackcdn.com/02.flv');
	 
	 $path ="http://c590104.r4.cf2.rackcdn.com/02.flv";
	 $output_filename="algo.jpg";
	 
	 $output = exec("ffmpeg -i $path");
preg_match('/Duration: ([0-9]{2}):([0-9]{2}):([^ ,])+/', $output, $matches);
$time = str_replace("Duration: ", "", $matches[0]);
$time_breakdown = explode(":", $time);
$total_seconds = round(($time_breakdown[0]*60*60) + ($time_breakdown[1]*60) + $time_breakdown[2]);
shell_exec("ffmpeg -y  -i $path -f mjpeg -vframes 1 -ss " . ($total_seconds / 2) . " -s $wx$h $output_filename";
?>

