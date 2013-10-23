<?php
/*
	RSS Extractor and Displayer
	(c) 2007-2010  Scriptol.com - Licence Mozilla 1.1.
	rsslib.php
	
	Requirements:
	- PHP 5.
	- A RSS feed.
	
	Using the library:
	Insert this code into the page that displays the RSS feed:
	
	<?php
	require_once("rsslib.php");
	echo RSS_Display("http://www.xul.fr/rss.xml", 15);
	? >
	
*/

$RSS_Content = array();

function RSS_Tags($item, $type)
{
		$y = array();
		$tnl = $item->getElementsByTagName("title");
		$tnl = $tnl->item(0);
		$title = $tnl->firstChild->textContent;
		
		$tnl = $item->getElementsByTagName("link");
		$tnl = $tnl->item(0);
		$link = $tnl->firstChild->textContent;
		
		
		////////img/////////////
		if($item->getElementsByTagName("enclosure")){
			$tnl = $item->getElementsByTagName("enclosure");
			if($tnl = $tnl->item(0)){
				if($tnl->getAttribute("url")){
					$url = $tnl->getAttribute("url");
				}else{
					$url = '';
				}
			}	
		
		}
		
		if($item->getElementsByTagName("media")){
			$tnl = $item->getElementsByTagName("media");
			if($tnl = $tnl->item(0)){
				if($tnl->getAttribute("url")){
					$url = $tnl->getAttribute("url");
				}else{
					$url = '';
				}
			}	
		
		}
		
		///////////////////////////
		
				
		$tnl = $item->getElementsByTagName("pubDate");
		$tnl = $tnl->item(0);
		$date = $tnl->firstChild->textContent;		

		$tnl = $item->getElementsByTagName("description");
		$tnl = $tnl->item(0);
		$description = $tnl->firstChild->textContent;

		$y["title"] = $title;
		$y["link"] = $link;
		$y["date"] = $date;		
		$y["description"] = $description;
		$y["type"] = $type;
		
		if(isset($url)){
			$y["thumbnail"] = $url;
		/*}elseif(is_string($url2)){
			$y["thumbnail"] = $url2;
		}else{
			$y["thumbnail"] ='';*/
		}
		
		return $y;
}


function RSS_Channel($channel)
{
	global $RSS_Content;

	$items = $channel->getElementsByTagName("item");
	
	// Processing channel
	
	$y = RSS_Tags($channel, 0);		// get description of channel, type 0
	array_push($RSS_Content, $y);
	
	// Processing articles
	
	foreach($items as $item)
	{
		$y = RSS_Tags($item, 1);	// get description of article, type 1
		array_push($RSS_Content, $y);
	}
}

function RSS_Retrieve($url)
{
	global $RSS_Content;

	$doc  = new DOMDocument();
	$doc->load($url);

	$channels = $doc->getElementsByTagName("channel");
	
	$RSS_Content = array();
	
	foreach($channels as $channel)
	{
		 RSS_Channel($channel);
	}
	
}


function RSS_RetrieveLinks($url)
{
	global $RSS_Content;

	$doc  = new DOMDocument();
	$doc->load($url);

	$channels = $doc->getElementsByTagName("channel");
	
	$RSS_Content = array();
	
	foreach($channels as $channel)
	{
		$items = $channel->getElementsByTagName("item");
		foreach($items as $item)
		{
			$y = RSS_Tags($item, 1);	// get description of article, type 1
			array_push($RSS_Content, $y);
		}
		 
	}

}


function RSS_Links($url, $size = 15)
{
	global $RSS_Content;

	$page = "<ul>";

	RSS_RetrieveLinks($url);
	if($size > 0)
		$recents = array_slice($RSS_Content, 0, $size + 1);

	foreach($recents as $article)
	{
		$type = $article["type"];
		if($type == 0) continue;
		$title = $article["title"];
		$link = $article["link"];
		$page .= "<li><a href=\"$link\">$title</a></li>\n";			
	}

	$page .="</ul>\n";

	return $page;
	
}


//////////
function RSS_Display($url, $size = 15, $site = 0, $withdate = 0)
{
	global $RSS_Content;

	$opened = false;
	$page = "";
	$site = (intval($site) == 0) ? 1 : 0;

	RSS_Retrieve($url);
	if($size > 0)
		$recents = array_slice($RSS_Content, $site, $size + 1 - $site);
	
		$ii=0;	
	 foreach($recents as $article){
		if($ii==0){
			$page.='<div class=\'new\'>';
		}
		$type = $article["type"];
		
		////////img////////
		$img = $article["thumbnail"];
		if($img != false){
			$page.='<img width="135" style="cursor:default;" src="'.$img.'" />';
		}else{
			$page.='<img width="135" height="134" style="cursor:default;" src="'.$_SERVER['DOCUMENT_ROOT'].'/img/rssDefault.jpg" />';

		}
		
		$title =$article["title"]; 
		
		$link = $article["link"];
		$page .= '<p><span style="font-weight:bold;">'.$title.'</span><br>';
		
		
		
		
		
					
		/////////description/////////
		/*$description = str_replace('"','\\"',$article["description"]);
		$description = str_replace("'","\\'",$description);
		$description = str_replace("--","",$description);
		//$description=ereg_replace( "([     ]+)", " ", $description);
		eregi_replace("^(\r\n)+|^(\n)+|^(\r)+|^(\n\r)+",' ',$description);
		*/
		$description=strip_tags(substr($article["description"],0,900));
		
		
		
		
		
		if($description != false)
		{
			$page .= $description.'</p>';
		}
		
		
	    ///////////////////////
	    $date="";
		if(isset($article["date"]) && $article["date"]!=''){
			  $date=$article["date"];
			  $dedate = explode(',',$date);
			  $expdedate=explode(' ',$dedate[1]);
			  $ddMonth=$expdedate[2];
			  
			  if($ddMonth=="Jan" || $ddMonth=="jan"){
			  		$ddMonth='01';
			  }elseif($ddMonth=="Feb" || $ddMonth=="feb"){
			  		$ddMonth='02';
			  }elseif($ddMonth=="Mar" || $ddMonth=="mar"){
			  		$ddMonth='03';
			  }elseif($ddMonth=="Apr" || $ddMonth=="apr"){
			  		$ddMonth='04';
			  }elseif($ddMonth=="May" || $ddMonth=="may"){
			  		$ddMonth='05';
			  }elseif($ddMonth=="Jun" || $ddMonth=="jun"){
			  		$ddMonth='06';
			  }elseif($ddMonth=="Jul" || $ddMonth=="jul"){
			  		$ddMonth='07';
			  }elseif($ddMonth=="Aug" || $ddMonth=="aug"){
			  		$ddMonth='08';
			  }elseif($ddMonth=="Sep" || $ddMonth=="sep"){
			  		$ddMonth='09';
			  }elseif($ddMonth=="Oct" || $ddMonth=="oct"){
			  		$ddMonth='10';
			  }elseif($ddMonth=="Nov" || $ddMonth=="nov"){
			  		$ddMonth='11';
			  }elseif($ddMonth=="Dec" || $ddMonth=="dec"){
			  		$ddMonth='12';
			  }
			  
			  $date=$expdedate[1].'/'.$ddMonth.'/'.$expdedate[3];
			  
			  //$page .='<span class="date">'.$date.'</span>';
		  }
    	

		if($ii==2){
			$page.='<div class="linea" style="background-color: transparent;"><span class="date">'.$date.'</span></div>';
			$page.='</div>';
			$ii=0;
		}else{
			$page.='<div class="linea"><span class="date">'.$date.'</span></div>';
			$ii++;
		}
		
	}//for 
	
	return $page;
		
}

/*function RSS_Display($url, $size = 15, $site = 0, $withdate = 0)
{
	global $RSS_Content;

	$opened = false;
	$page = "";
	$site = (intval($site) == 0) ? 1 : 0;

	//RSS_Retrieve($url);
	if($size > 0)
	//	$recents = array_slice($RSS_Content, $site, $size + 1 - $site);

	/* foreach($recents as $article){
		$page.='<div class="new">';
	
		$type = $article["type"];
		
		$title = $article["title"];
		$link = $article["link"];
		$page .= '<p><span><a href="'.$link.'">'.$title.'</a></span>';
		
		////////img////////
		$page.='<img src="'.$_SERVER['DOCUMENT_ROOT'].'/img/news.jpg" />';
		
		
		/////////description/////////
		$description = $article["description"];
		if($description != false)
		{
			$page .= $description.'</p>';
		}
		
		
	    ///////////////////////
		if($withdate)
		{
		  $date = $article["date"];
		  $page .='<span class="date">'.$date.'</span>';
    	}
		
		$page.='</div>';
		
	}//for 
	
	return $page;
	
}*/


/*function RSS_Display($url, $size = 15, $site = 0, $withdate = 0)
{
	global $RSS_Content;

	$opened = false;
	$page = "";
	$site = (intval($site) == 0) ? 1 : 0;

	RSS_Retrieve($url);
	if($size > 0)
		$recents = array_slice($RSS_Content, $site, $size + 1 - $site);

	foreach($recents as $article)
	{
		$type = $article["type"];
		if($type == 0)
		{
			if($opened == true)
			{
				$page .="</ul>\n";
				$opened = false;
			}
			$page .="<b>";
		}
		else
		{
			if($opened == false) 
			{
				$page .= "<ul>\n";
				$opened = true;
			}
		}
		$title = $article["title"];
		$link = $article["link"];
		$page .= "<li><a href=\"$link\">$title</a>";
		if($withdate)
		{
      $date = $article["date"];
      $page .=' <span class="rssdate">'.$date.'</span>';
    }
		$description = $article["description"];
		if($description != false)
		{
			$page .= "<div class='desc'>$description</div>";
		}
		$page .= "</li>\n";			
		
		if($type==0)
		{
			$page .="</b><br />";
		}

	}

	if($opened == true)
	{	
		$page .="</ul>\n";
	}
	return $page."\n";
	
}
*/

?>
