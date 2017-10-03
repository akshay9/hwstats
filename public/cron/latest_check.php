<?php
include_once('simple_html_dom.php');
date_default_timezone_set('Asia/Kolkata');
///$db = new PDO('mysql:dbname=traviang_hwstats;host=localhost', 'traviang', 'bquYNxTI10UP6HAM');
include('connection.php');

echo"<pre>";
	getMatch('http://hitwicket.com/transfer/applyAdvancedFilters?FavoriteTransferCriteria');


function getMatch($page) {
    global $names,$data,$skills,$name,$mdata,$inning5,$inning6,$inning7, $inning8 ;

    $html = new simple_html_dom();
    $html->load_file($page);

    //$items1 = $html->find('section[class="small_skill_bars"]');
	$items2 = $html->find('h2[class="player_name"]');
    $items3 = $html->find('div[class=player_info2]');

    foreach($items2 as $post) {
        # remember comments count as nodes
        //$names[] = explode("\"", preg_replace( '/<!--(.|\s)*?-->/' , '' , $post->children(0)->innertext));
        //$names[] = explode("\"", preg_replace( '/<!--(.|\s)*?-->/' , '' , $post->children(0)->outertext));
        $names[] = trim(str_replace("</span>", "", preg_replace( '/<!--(.|\s)*?-->/' , '' , preg_replace("/<span[^>]+\>/i", "", $post->innertext))));
    }
	
	foreach($items3 as $post) {
        # remember comments count as nodes
        //$data[] = array(str_replace(array("strong","</>","<>"), "", $post->innertext));
        
		$data[] = array(explode("\">", str_replace(array("<a href=\"/team/show/", "</a>"), "", $post->children(0)->outertext)), //team name
						strip_tags($post->children(2)->outertext), // Age
						strip_tags($post->children(3)->outertext), // Batting Style
						strip_tags($post->children(4)->outertext), // Bowling Style
						trim(strip_tags($post->children(6)->outertext)), // Expereince
						trim(strip_tags($post->children(7)->outertext)), // Form
						trim(strip_tags($post->children(8)->outertext)), // Fitness
						str_replace(",", "",strip_tags($post->children(11)->outertext)), //skill Index
						str_replace(",", "",strip_tags($post->children(12)->outertext)), //salary
						str_replace(",", "",strip_tags($post->children(15)->outertext)), //Asking Price
						explode("&nbsp;(", strip_tags($post->children(17)->outertext)), // Deadline
						explode("&nbsp;(", strip_tags($post->children(18)->outertext)), // Deadline
						explode("          ", str_replace(array("	","\n"), " ", strip_tags($post->children(14)->outertext))), //Main
						);
						
	/**/
    }
	
	foreach($names as $row){
	$name1 = explode("/", $row);
	$name2['id'] = $name1[3]; 
	$name12 = explode("\">", $name1[4]);
	$name2['name'] = str_replace("<", "", $name12[1]); 
	$name[] = $name2;
	}
	
	foreach($data as $row){
	$ply = $row[12];
	if(strlen($row[10][0]) > 5){
		$tm= $row[10][0] ;
	}else{
		$tm= $row[11][0] ;
	}
	$mdata[] = array("team" => array("id" => $row[0][0], "name" => $row[0][1] ),
					 "Age" => age_calc($row[1]) ,
					 "Batting_Style" => $row[2],
					 "Bowling_Style" => $row[3],
					 "Expereince" => Xp_level($row[4]),
					 "Form" => skill_level($row[5]),
					 "Fitness" => skill_level($row[6]),
					 "SI" => $row[7] ,
					 "Salary" => $row[8] ,
					 "Price" => $row[9] ,
					 "Time" => date_format(date_create_from_format('H:i D d-m-Y', trim(str_replace("\n", "", $tm)), timezone_open("Asia/Kolkata")), 'U') ,
					 "Skills" => array(
									"Fielding" => Xp_level(trim($ply[1])),
									"Wicket" => Xp_level(trim($ply[3])),
									"Batting_Seam" => Xp_level(trim($ply[9])),
									"Batting_Spin" => Xp_level(trim($ply[6])),
									"Bowling_Main" => Xp_level(trim($ply[12])),
									"Bowling_Variation" => Xp_level(trim($ply[15]))
								)
					);
	//var_dump(str_replace("\n", "", $row[10][0]));
	}
	
	var_dump($mdata[0]);

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
		case "non-existent": 
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
		default: 
			$level = 99999999999999999999999999999999999999999999999999999999999999999999999999999999;
			break;

	}
	return $level;
}

function age_calc($string){
	$age_raw = explode(' ',$string);
	$age = ($age_raw[0] * 70) + $age_raw[2];
	return $age;
}

/*
$sql_check = "SELECT COUNT(*) FROM `auction` WHERE `player_id` = :player_id AND `time` = :time";

$sql_team = "INSERT INTO teams 
	(team_id, name) VALUES
	(:team_id, :name)
	ON DUPLICATE KEY UPDATE name=:name";
	
$sql_player = "INSERT INTO players 
	(`team_id`, `player_id`, `name`, `age`, `SI`, `bat_type`, `bowl_type`, `experience`, `form`, `fitness`) VALUES
	(:team_id, :player_id, :name, :age, :si, :bat_type, :bowl_type, :xp, :form, :fitness)
	ON DUPLICATE KEY UPDATE age=:age, SI=:si, experience=:xp, form=:form, fitness=:fitness";

$sql_auction = "INSERT INTO `auction`
	(`player_id`, `team_id`, `age`, `experience`, `form`, `fitness`, `si`, `salary`, `price`, `time`, `fielding`, `wicket`, `bat_seam`, `bat_spin`, `bowl_main`, `bowl_var`) VALUES 
	(:player_id, :team_id, :age, :xp, :form, :fitness, :si, :salary, :price, :time, :fielding, :wicket, :bat_seam, :bat_spin, :bowl_main, :bowl_var)";
*/
$sql_auction = "UPDATE `auction` SET 
		`age`=:age, `price`=:price,`time`=:time 
		WHERE (`time` BETWEEN ".(time() - (60*30))." AND ".(time() + (60*30)).") AND `player_id`=:player_id AND `team_id`=:team_id AND `status`=0";
echo $sql_auction;	
$tids =  count($mdata);
$i =0;
while($i < $tids){
	//var_dump($name[$i]);
	echo $i."\n";
	//var_dump($mdata[$i]);
	
	//$sql= "SELECT COUNT(*) FROM `auction` WHERE `player_id` = ".$name[$i]['id']." AND `time` = ".$mdata[$i]['Time'];
	//echo $sql;
	
	//$stmt = $db->query("SELECT COUNT(*) FROM `auction` WHERE `player_id` = ".$name[$i]['id'].", `time` = ".$mdata[$i]['Time']);
	/*
	$stmt = $db->prepare($sql_check);
	$stmt->execute(array(
		':player_id' => $name[$i]['id'],
		':time' => $mdata[$i]['Time']
	));
	if($stmt->fetchColumn() > 0){
	exit;
	}
	
	$stmt = $db->prepare($sql_team);
	$stmt->execute(array(
		':team_id' => $mdata[$i]['team']['id'],
		':name' => $mdata[$i]['team']['name']
	));
	
	$stmt = $db->prepare($sql_player);
	$stmt->execute(array(
		':team_id' => $mdata[$i]['team']['id'],
		':player_id' => $name[$i]['id'],
		':name' => $name[$i]['name'],
		':age' => $mdata[$i]['Age'],
		':si' => $mdata[$i]['SI'],
		':bat_type' => $mdata[$i]['Batting_Style'],
		':bowl_type' => $mdata[$i]['Bowling_Style'],
		':xp' => $mdata[$i]['Expereince'],
		':form' => $mdata[$i]['Form'],
		':fitness' => $mdata[$i]['Fitness'],
	));
	*/
	$stmt = $db->prepare($sql_auction);
	$stmt->execute(array(
		':player_id' => $name[$i]['id'],
		':team_id' => $mdata[$i]['team']['id'],
		':age' => $mdata[$i]['Age'],
	/*	':xp' => $mdata[$i]['Expereince'],
		':form' => $mdata[$i]['Form'],
		':fitness' => $mdata[$i]['Fitness'],
		':si' => $mdata[$i]['SI'],
		':salary' => $mdata[$i]['Salary'],*/
		':price' => $mdata[$i]['Price'],
		':time' => $mdata[$i]['Time'],
	/*	':fielding' => $mdata[$i]['Skills']['Fielding'],
		':wicket' => $mdata[$i]['Skills']['Wicket'],
		':bat_seam' => $mdata[$i]['Skills']['Batting_Seam'],
		':bat_spin' => $mdata[$i]['Skills']['Batting_Spin'],
		':bowl_main' => $mdata[$i]['Skills']['Bowling_Main'],
		':bowl_var' => $mdata[$i]['Skills']['Bowling_Variation'],*/
	));
	
	$i++;
}

//var_dump($mdata);
?>