<?php
 
require('simple_html_dom.php'); 
$input = str_replace(' ','+',$_POST['query']);
$myUrl = "https://www.youtube.com/results?search_query=" . $input;
$html = file_get_html($myUrl);

$videos = array();
$mostViewed =  array();

foreach ($html->find('div.yt-lockup-content') as $video) {

		$title = $video->find('h3.yt-lockup-title a', 0)->plaintext;
		$title = str_replace('^',' ',$title);
		$title = str_replace('|',' ',$title);
		$url = "https://www.youtube.com" . $video->find('h3.yt-lockup-title a', 0)->href;
		$duration = $video->find('h3.yt-lockup-title span', 0);
        $views = $video->find('ul.yt-lockup-meta-info li', 1);
		
		if($duration != null && $views != null){
			$views = preg_replace("/[^0-9]/","",$views);
			$videos[] = array("title"=>$title, "duration"=>$duration, "url"=>$url, "views"=>$views);
			array_push($mostViewed,$views);	
		}
						
}
$finalVideos = array();
rsort($mostViewed);
$i = 0;
foreach( $mostViewed as $el) {
    if( $i >= 4) break;
	$key = array_search($el, array_column($videos, 'views'));
	$finalVideos[] = implode('^',$videos[$key]);
    $i++;
}


   echo implode('|',$finalVideos);

	
 

?>