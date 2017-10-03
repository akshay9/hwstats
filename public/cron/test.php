<?php
error_reporting(E_ALL);


    # don't forget the library
    include_once('simple_html_dom.php');
	//$matchid = "1081988";
        $matchid = "1833317";
    //error_reporting(E_ERROR | E_PARSE);
	
	
    # this is the global array we fill with article information
$teams = array();
$team_id = array();
$score = array();
$overs = array();
$pitch = array();
$inning = array();
$inning1 = array();
$inning2 = array();
$inning3 = array();
$inning4 = array();
$inning5 = array();
$inning6 = array();
$inning7 = array();
	//$span = array();

    # passing in the first page to parse, it will crawl to the end
    # on its own
	getArticles('http://hitwicket.com/match/show/'.$matchid);

echo "worked";


function getArticles($page) {
    global /*$span, $art2,*/ $overs, $score ,$teams, $pitch;
    
    $html = new simple_html_dom();
    $html->load_file($page);
    
    //$items = $html->find('div');  
    $items1 = $html->find('span[class=team_name]');  
    $items2 = $html->find('span[class=current_score]');
    $items3 = $html->find('p[class=match_info]');
    
    foreach($items1 as $post) {
        # remember comments count as nodes
        $teams[] = array($post->children(0)->innertext,
						$post->children(0)->outertext
					);
    }
    foreach($items2 as $post) {
        # remember comments count as nodes
        $score[] = array($post->children(0)->innertext);
    }
    foreach($items2 as $post) {
        # remember comments count as nodes
        $overs[] = array($post->children(1)->innertext);
    }
	foreach($items3 as $post) {
        # remember comments count as nodes
        $pitch[] = array($post->innertext);
    }
}
echo "worked";
$runs1 = explode("/", $score[0][0]);
$runs2 = explode("/", $score[1][0]);
echo "worked";
$overs1 = explode(".", str_replace( " ov", "", $overs[0][0]));
$overs2 = explode(".", str_replace( " ov", "", $overs[1][0]));
echo "worked";
if($runs1[1] == 10){
$runrate1 = $runs1[0] / 20 ;
}else{
$runrate1 = $runs1[0] / ($overs1[0] + ($overs1[1] / 6)) ;
}
echo "worked";
if($runs2[1] == 10){
$runrate2 = $runs2[0] / 20 ;
}else{
$runrate2 = $runs2[0] / ($overs2[0] + ($overs2[1] / 6)) ;
}
echo "worked";
$mat_id = array();
echo "worked3";
$x = new SimpleXMLElement(str_replace($teams[0][0], '', trim($teams[0][1])));
var_dump($x);
$arry = $x->attributes();
preg_match('/\d+/', $arry['href'], $mat_id[0]);

$x = new SimpleXMLElement(str_replace($teams[1][0], '', trim($teams[1][1])));
$arry = $x->attributes();
preg_match('/\d+/', $arry['href'], $mat_id[1]);
echo "worked";
$match_venue = explode(' at ', trim($pitch[0][0]));
$pitch_type = explode(' - ', str_replace(' Wicket', "" ,strip_tags($match_venue[1])));
echo "worked";
$tickets = explode('                    ',trim(str_replace(',', "",strip_tags($pitch[1][0]))));
echo "worked 99";
$match_data = array(
    'team1'=> array(
		'id' => $mat_id[0][0],
        'name' => $teams[0][0],
        'runs' => $runs1[0],
        'wickets' => $runs1[1],
        'runrate' => $runrate1
    ),
    'team2'=> array(
		'id' => $mat_id[1][0],
        'name' => $teams[1][0],
        'runs' => $runs2[0],
        'wickets' => $runs2[1],
        'runrate' => $runrate2
    ),
	'time' => date_format(date_create_from_format('H:i, D d M, Y', $match_venue[0], timezone_open("Asia/Kolkata")), 'U'),
	'pitch' => strtolower($pitch_type[1]),
	'tickets' => trim($tickets[0]),
	'mom' => $tickets[3]
);
echo "Match Loaded";
?>