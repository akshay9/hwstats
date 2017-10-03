<?php

    # don't forget the library
    include_once('simple_html_dom.php');
	//$matchid = "1081988";
        //$matchid = "1835874";
    //error_reporting(E_ERROR | E_PARSE);
	
	
    # this is the global array we fill with article information
unset($nm);
unset($teams);
unset($team_id);
unset($score);
unset($overs);
unset($inning);
unset($inning1);
unset($inning2);
unset($inning3);
unset($inning4);
unset($inning5);
unset($inning6);
unset($inning7);
unset($inning8);
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
	getMatch('http://hitwicket.com/match/scoreCard/'.$matchid.'?inning=2');


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