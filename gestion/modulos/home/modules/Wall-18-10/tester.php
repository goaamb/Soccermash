<?php 

function GetVideoIdFromUrl($url) {
    $parts = explode('?v=',$url);
    if (count($parts) == 2) {
        $tmp = explode('&',$parts[1]);
        if (count($tmp)>1) {
            return $tmp[0];
        } else {
            return $parts[1];
        }
    } else {
        return $url;
    }
}

function EmbedVideo($retornoEsto,$width = 425,$height = 350) {
 
    return '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$retornoEsto.'"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$retornoEsto.'" type="application/x-shockwave-flash" wmode="transparent" width="'.$width.'" height="'.$height.'"></embed></object>';
}


function GetImg($videoid,$imgid = 1) {
 
    return "http://img.youtube.com/vi/$videoid/$imgid.jpg";
}

$arreglito=explode(" ","dasjsl http://www.youtube.com/watch?v=ywhfpQhGsAA djas daskl djaskldjs kljkldas http://www.youtube.com/watch?v=ywhfpQhGsAA das das das");

foreach($arreglito as $arr){
	if($url=preg_match('/youtube\.com\/watch\?v=([A-Za-z0-9._%-]*)[&\w;=\+_\-]*/',$arr)){
		$retornoEsto=GetVideoIdFromUrl($arr);
		$segundoRetorno=EmbedVideo($retornoEsto);
		$tercerRetorno=GetImg($retornoEsto);
		echo $arr;
		echo "<img src='$tercerRetorno' width='130' height='97' border='0'> ";
		echo $segundoRetorno;
	};
}




 





?>