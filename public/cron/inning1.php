<?php

    # don't forget the library
    include_once('simple_html_dom.php');
	//$matchid = "1081988";
        //$matchid = "1835874";
	
	
    # this is the global array we fill with article information
$teams = array();
$team_id = array();
$score = array();
$overs = array();
$inning = array();
$inning1 = array();
$inning2 = array();
$inning3 = array();
$inning4 = array();
$inning5 = array();
$inning6 = array();
$inning7 = array();
$inning8 = array();
	//$span = array();

    # passing in the first page to parse, it will crawl to the end
    # on its own
	getMatch('http://hitwicket.com/match/scoreCard/'.$matchid.'?inning=1');


function getMatch($page) {
    global $inning,$inning1,$inning2,$inning3,$inning4,$inning5,$inning6,$inning7, $inning8 ;
    
    $html = new simple_html_dom();
    $html->load_file($page);
    
    $items1 = $html->find('tr');
	$items2 = $html->find('h3');
    $items3 = $html->find('div[class=fielding_card]');

    foreach($items1 as $post) {
        # remember comments count as nodes
        $inning[] = array($post->children(0)->innertext);
    }
	foreach($items1 as $post) {
        # remember comments count as nodes
        $inning1[] = array($post->children(1)->innertext);
    }
    foreach($items1 as $post) {
        # remember comments count as nodes
        $inning2[] = array($post->children(2)->innertext);
    }
    foreach($items1 as $post) {
        # remember comments count as nodes
        $inning3[]= array($post->children(3)->outertext);
    }
    foreach($items1 as $post) {
        # remember comments count as nodes
        $inning4[] = array($post->children(4)->innertext);
    }
    foreach($items1 as $post) {
        # remember comments count as nodes
        $inning5[] = array($post->children(5)->innertext);
    }
    
    foreach($items1 as $post) {
        # remember comments count as nodes
        $inning6[] = array($post->children(7)->innertext);
    }
    
    foreach($items3 as $post) {
        # remember comments count as nodes
        $inning7[] = array($post->innertext);
    }
    
	foreach($items2 as $post) {
        # remember comments count as nodes
        $inning8[] = array($post->plaintext);
    }
    
}

function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
            return $current_key;
        }
    }
    return false;
}

function player_data($array, $runs, $balls, $type, $rating){
    $atri= str_replace(array('(wk)','(c)','*', trim(strip_tags(str_replace(array('(wk)','(c)','*'), "", $array))),'></a>','<a'), "", $array);

    $x = new SimpleXMLElement("<element $atri />");    
    $arry = $x->attributes();
    
    $player_data = explode("<br />", str_replace(array('<strong>','</strong>','<span>','</span>','Skill Index: ','Age: ','Batting Style: ','Bowling Style: ','Experience: ','Form: ','Fitness: '),"",$arry['data-content']));
    $plryd = explode(",", $player_data[0], 2);
    if($type['type'] == 'batsman'){
        $plyr_data = array(
        'info' => array(
            'id' => str_replace('/player/show/', "", $arry['href'][0]),
            'name' => $arry['data-title'][0],
            'age' => age_calc(trim($plryd[0])),
            'SI' => str_replace(',', "",trim($plryd[1])),
            'bat_type' => $player_data[1],
            'bowl_type' => $player_data[2],
            'experience' => Xp_level($player_data[3]),
            'form' => skill_level($player_data[4]),
            'fitness' => skill_level($player_data[5])
            ),
        'match' => array(
            'type' => 'batsman',
			'runs' => ($runs=="" ? "0":$runs),
			'balls' => $balls,
            '6s' => $type['6s'],
            '4s' => $type['4s'],
            'rating' => $rating
            )
        );
    } elseif($type['type'] == 'bowler'){
        $plyr_data = array(
        'info' => array(
            'id' => str_replace('/player/show/', "", $arry['href'][0]),
            'name' => $arry['data-title'][0],
            'age' => age_calc(trim($plryd[0])),
            'SI' => str_replace(',', "",trim($plryd[1])),
            'bat_type' => $player_data[1],
            'bowl_type' => $player_data[2],
            'experience' => Xp_level($player_data[3]),
            'form' => skill_level($player_data[4]),
            'fitness' => skill_level($player_data[5])
        ),
        'match' => array(
            'type' => 'bowler',
			'runs' => $runs,
			'balls' => $balls,
            'wickets' => $type['wickets'],
            'rating' => $rating
        )
    );
    }
    
    
    return $plyr_data;
}

function age_calc($string){
	$age_raw = explode(' ',$string);
	$age = ($age_raw[0] * 70) + $age_raw[2];
	return $age;
}

function skill_level($string){
	switch($string){
		case "Hopeless":
			$level = 1;
        break;
		case "Poor":
			$level = 2;
        break;
		case "Unreliable":
			$level = 3;
        break;
		case "Decent":
			$level = 4;
        break;
		case "Good":
			$level = 5;
        break;
		case "Superb":
			$level = 6;
        break;
	}
	return $level;
}

function Xp_level($string){
	switch($string){
		case "Non-existant": 
			$level = 0; 
			break;
		case "Horrible":
			$level = 1; 
			break;
		case "Hopeless": 
			$level = 2; 
			break;
		case "Useless": 
			$level = 3;
			break;
		case "Mediocre": 
			$level = 4;
			break;
		case "Average": 
			$level = 5; 
			break;
		case "Reliable": 
			$level = 6; 
			break;
		case "Accomplished": 
			$level = 7; 
			break;
		case "Remarkable": 
			$level = 8; 
			break;
		case "Brilliant": 
			$level = 9; 
			break;
		case "Exemplary": 
			$level = 10; 
			break;
		case "Prodigious": 
			$level = 11; 
			break;
		case "Fantastic": 
			$level = 12; 
			break;
		case "Magnificent": 
			$level = 13; 
			break;
		case "Masterful": 
			$level = 14; 
			break;
		case "Supreme": 
			$level = 15; 
			break;
		case "Magical": 
			$level = 16; 
			break;
		case "Legendary": 
			$level = 17; 
			break;
		case "Wonderous": 
			$level = 18; 
			break;
		case "Demigod": 
			$level = 19; 
			break;
		case "Titan": 
			$level = 20; 
			break;

	}
	return $level;
}

$fielding = explode(" ", strip_tags(str_replace(array('<span class="fielding_main"><strong>Team Fielding Ability:</strong></span>',
    '<span class="red_stars" style="width:','px"></span><br />',
        '<span class="fielding_main"><strong>Wicket Keeper Ability:</strong></span>',
    '<span class="red_stars" style="width','px"></span><br />','&nbsp;','Runs saved by good fielding','Runs conceded due to Misfields','Byes','   ',''
    . ''),"",$inning7[0][0])));

$fielding = array(
    'fielding' => trim($fielding[2]/20),
    'wicketkeeping' => trim($fielding[5]/20),
    'runs_saved' => trim($fielding[8]),
    'misfields' => trim($fielding[11]),
    'byes' => trim($fielding[12]),
);

$nm = explode(" - ", $inning8[0][0]);

if($match_data['team1']['name'] == trim($nm[0])){
$tm_id = $match_data['team1']['id'];
$tm_idb = $match_data['team2']['id'];
}else{
$tm_id = $match_data['team2']['id'];
$tm_idb = $match_data['team1']['id'];
}

$len = count($inning) ;
$bowl = recursive_array_search('Bowler', $inning);

$i = 0;
//echo "<table><tbody>";
while ($i <= ($len - 1) ){
if($i != $bowl && $i != 0){
    if($i < $bowl){
        $type = array(
            'type' => 'batsman',
            '4s' => trim(strip_tags($inning4[$i][0])),
            '6s' => trim(strip_tags($inning5[$i][0]))
        );
        $player_dat[$i] = player_data($inning[$i][0], trim(strip_tags($inning2[$i][0])), trim(strip_tags($inning3[$i][0])), $type, trim(strip_tags($inning6[$i][0])));
    }
    elseif($i > $bowl){
        $ov = explode(".", trim(strip_tags($inning1[$i][0])));
        $balls = ($ov[0] * 6) + $ov[1];
        $type = array(
            'type' => 'bowler',
            'wickets' => trim(strip_tags($inning3[$i][0]))
        );
        $player_dat[$i] = player_data($inning[$i][0], trim(strip_tags($inning2[$i][0])),$balls, $type, trim(strip_tags($inning5[$i][0])));
    }
}

//echo "<tr><td>".trim(strip_tags($inning[$i][0]))."</td><td>".trim(strip_tags($inning1[$i][0]))."</td><td>".trim(strip_tags($inning2[$i][0]))."</td><td>".trim(strip_tags($inning3[$i][0]))."</td><td>".trim(strip_tags($inning4[$i][0]))."</td><td>".trim(strip_tags($inning5[$i][0]))."</td></tr>";
$i++;
}
//echo "</tbody></table><pre>";

?>