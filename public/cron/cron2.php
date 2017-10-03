<?php

$match_string = explode("-", file_get_contents('donetill'));

if(($match_string[0] + $match_string[1]) < 1872275 && $match_string[1] < 89){
$matchid = $match_string[0] + $match_string[1];
}
elseif(($match_string[0] + $match_string[1]) >= 1872275){
$match_string[0] = 1749603 ;
$match_string[1]++;
$matchid = $match_string[0] + $match_string[1];
}
elseif($match_string[1] >= 89){
exit("END");
}

//$matchid = (file_get_contents('donetill')) + 1;

/*
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$memory = memory_get_usage();
$start = $time;

$matchid = $_GET['id'];
//$matchid = "1053421";
//done till 1055158 | VI end @ 1175739
//error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL ^ E_NOTICE);
*/

echo "<pre>";

///$db = new PDO('mysql:dbname=traviang_hwstats;host=localhost', 'traviang', 'bquYNxTI10UP6HAM');
include('connection.php');


include('match.php');

	print_r($match_data);
	//var_dump($pitch_type);
	
if($match_data['time'] < time()){
/*
$sql = "INSERT INTO teams 
	(team_id, name) VALUES
	(:team_id, :name)
	ON DUPLICATE KEY UPDATE name=:name";
*/

$sql = "INSERT IGNORE INTO teams 
	(team_id, name) VALUES
	(:team_id, :name)";
$stmt = $db->prepare($sql);
$stmt->execute(array(
	':team_id' => $match_data['team1']['id'],
	':name' => $match_data['team1']['name']
	));
$stmt = $db->prepare($sql);
$stmt->execute(array(
	':team_id' => $match_data['team2']['id'],
	':name' => $match_data['team2']['name']
	));

$sql = "INSERT IGNORE INTO matches 
 (match_id,team1_id,team1_runs,team1_wickets,team1_runrate,team2_id,team2_runs,team2_wickets,team2_runrate,time,tickets,pitch,mom) VALUES 
 (:match_id,:team1_id, :team1_runs, :team1_wickets, :team1_runrate, :team2_id, :team2_runs, :team2_wickets, :team2_runrate, :time, :tickets, :pitch, :mom)";
$stmt = $db->prepare($sql);
$stmt->execute(array(
	':match_id' => $matchid,
	':team1_id' => $match_data['team1']['id'],
	':team1_runs' => $match_data['team1']['runs'],
	':team1_wickets' => $match_data['team1']['wickets'],
	':team1_runrate' => $match_data['team1']['runrate'],
	':team2_id' => $match_data['team2']['id'],
	':team2_runs' => $match_data['team2']['runs'],
	':team2_wickets' => $match_data['team2']['wickets'],
	':team2_runrate' => $match_data['team2']['runrate'],
	':time' => $match_data['time'],
	':tickets' => $match_data['tickets'],
	':pitch' => $match_data['pitch'],
	':mom' => $match_data['mom']
	));

include('inning1.php');

	print_r($fielding);

$sql_feild = "INSERT IGNORE INTO fielding 
	(match_id, inning, team_id, fielding, wicketkeeping, runs_saved, misfields, byes) Values 
	(:match_id, :inning, :team_id, :fielding, :wk, :runs_saved, :misfields, :byes)";
$stmt = $db->prepare($sql_feild);
$stmt->execute(array(
	':match_id' => $matchid,
	':inning' => 1,
	':team_id' => $tm_id,
	':fielding' => $fielding['fielding'],
	':wk' => $fielding['wicketkeeping'],
	':runs_saved' => $fielding['runs_saved'],
	':misfields' => $fielding['misfields'],
	':byes' => $fielding['byes']
	));
	
	//print_r($player_dat);
	
	$sql_bat = "INSERT IGNORE INTO `bat_perfo`
	(`match_id`, `team_id`, `inning`, `player_id`, `runs`, `balls`, `6s`, `4s`, `ratting`) Values 
	(:match_id, :team_id, :inning, :player_id, :runs, :balls, :6s, :4s, :rating)";
	
	$sql_bowl = "INSERT IGNORE INTO `bowl_perfo`
	(`match_id`, `team_id`, `inning`, `player_id`, `runs`, `balls`, `wickets`, `rating`) Values 
	(:match_id, :team_id, :inning, :player_id, :runs, :balls, :wickets, :rating)";
	
	$sql_ply_data = "INSERT INTO `players`
	(`team_id`, `player_id`, `name`, `age`, `SI`, `bat_type`, `bowl_type`, `experience`, `form`, `fitness`) VALUES 
	(:team_id, :player_id, :name, :age, :si, :bat_type, :bowl_type, :xp, :form, :fitness)
	ON DUPLICATE KEY UPDATE `age`=:age , `SI`=:si , `experience`=:xp , `form`=:form , `fitness`=:fitness";
	
	foreach($player_dat as $data){
		
	if($data['match']['type'] == "batsman"){
			
	$array_tp = array(
		':match_id' => $matchid,
		':team_id' => $tm_id,
		':inning' => 1,
		':player_id' => $data['info']['id'],
		':runs' => $data['match']['runs'],
		':balls' => $data['match']['balls'],
		':6s' => $data['match']['6s'],
		':4s' => $data['match']['4s'],
		':rating' => $data['match']['rating']
	);
		$sql_tp = $sql_bat;	
	} else{
		
	$array_tp = array(
		':match_id' => $matchid,
		':team_id' => $tm_idb,
		':inning' => 1,
		':player_id' => $data['info']['id'],
		':runs' => $data['match']['runs'],
		':balls' => $data['match']['balls'],
		':wickets' => $data['match']['wickets'],
		':rating' => $data['match']['rating']
	);	
	$sql_tp = $sql_bowl;	
	}
		$stmt = $db->prepare($sql_tp);
		$stmt->execute($array_tp);
	/*
	$stmt = $db->query("SELECT * FROM players Where `player_id`=".$data['info']['id']."");
	if($stmt->rowCount() > 0){
		$stmt1 = $db->query('SELECT * FROM `players_updated` WHERE `player_id`='.$data['info']['id'].' ORDER BY updated DESC');
		if($stmt1->rowCount > 0){
		$res1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		if($res1['SI'] != $data['info']['SI'] || $res1['expereince'] != $data['info']['experience'] || $res1['form'] != $data['info']['form'] || $res1['fitness'] != $data['info']['fitness'] ){
		$db->exec("INSERT INTO `players_updated` 
		(`player_id`, `age`, `SI`, `expereince`, `form`, `fitness`, `updated`) VALUES 
		('".$data['info']['id']."', '".$data['info']['age']."', '".$data['info']['SI']."', '".$data['info']['experience']."', '".$data['info']['form']."', '".$data['info']['fitness']."')");
		}
		} else {
			$db->exec("INSERT INTO `players_updated` 
		(`player_id`, `age`, `SI`, `expereince`, `form`, `fitness`, `updated`) VALUES 
		('".$data['info']['id']."', '".$data['info']['age']."', '".$data['info']['SI']."', '".$data['info']['experience']."', '".$data['info']['form']."', '".$data['info']['fitness']."')");
		}
	} else {
		*/
	$stmt = $db->prepare($sql_ply_data);
	$stmt->execute(array(
		':team_id' => $tm_id,
		':player_id' => $data['info']['id'],
		':name' => $data['info']['name'][0],
		':age' => $data['info']['age'],
		':si' => $data['info']['SI'],
		':bat_type' => $data['info']['bat_type'],
		':bowl_type' => $data['info']['bowl_type'],
		':xp' => $data['info']['experience'],
		':form' => $data['info']['form'],
		':fitness' => $data['info']['fitness']
	));
	//}
	}
unset($player_dat);
include('inning2.php');

	//print_r($fielding);
	
		
$stmt = $db->prepare($sql_feild);
$stmt->execute(array(
	':match_id' => $matchid,
	':inning' => 2,
	':team_id' => $tm_id,
	':fielding' => $fielding['fielding'],
	':wk' => $fielding['wicketkeeping'],
	':runs_saved' => $fielding['runs_saved'],
	':misfields' => $fielding['misfields'],
	':byes' => $fielding['byes']
	));
	
	//print_r($player_dat);
	
	foreach($player_dat as $data){
		
	if($data['match']['type'] == "batsman"){
			
	$array_tp = array(
		':match_id' => $matchid,
		':team_id' => $tm_id,
		':inning' => 2,
		':player_id' => $data['info']['id'],
		':runs' => $data['match']['runs'],
		':balls' => $data['match']['balls'],
		':6s' => $data['match']['6s'],
		':4s' => $data['match']['4s'],
		':rating' => $data['match']['rating']
	);
		$sql_tp = $sql_bat;	
	} 
	else{
		
	$array_tp = array(
		':match_id' => $matchid,
		':team_id' => $tm_idb,
		':inning' => 2,
		':player_id' => $data['info']['id'],
		':runs' => $data['match']['runs'],
		':balls' => $data['match']['balls'],
		':wickets' => $data['match']['wickets'],
		':rating' => $data['match']['rating']
	);	
	$sql_tp = $sql_bowl;	
	}
	
	$stmt = $db->prepare($sql_tp);
	$stmt->execute($array_tp);
		
	/*
	$stmt = $db->query("SELECT * FROM players Where `player_id`=".$data['info']['id']."");
	if($stmt->rowCount() > 0){
		$stmt1 = $db->query('SELECT * FROM `players_updated` WHERE `player_id`='.$data['info']['id'].' ORDER BY updated DESC');
		if($stmt1->rowCount > 0){
		$res1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		if($res1['SI'] != $data['info']['SI'] || $res1['expereince'] != $data['info']['experience'] || $res1['form'] != $data['info']['form'] || $res1['fitness'] != $data['info']['fitness'] ){
		$db->exec("INSERT INTO `players_updated` 
		(`player_id`, `age`, `SI`, `expereince`, `form`, `fitness`, `updated`) VALUES 
		('".$data['info']['id']."', '".$data['info']['age']."', '".$data['info']['SI']."', '".$data['info']['experience']."', '".$data['info']['form']."', '".$data['info']['fitness']."')");
		}
		} else {
			$db->exec("INSERT INTO `players_updated` 
		(`player_id`, `age`, `SI`, `expereince`, `form`, `fitness`, `updated`) VALUES 
		('".$data['info']['id']."', '".$data['info']['age']."', '".$data['info']['SI']."', '".$data['info']['experience']."', '".$data['info']['form']."', '".$data['info']['fitness'].", ".time()."')");
		}
	} else {
		*/
	$stmt = $db->prepare($sql_ply_data);
	$stmt->execute(array(
		':team_id' => $tm_id,
		':player_id' => $data['info']['id'],
		':name' => $data['info']['name'][0],
		':age' => $data['info']['age'],
		':si' => $data['info']['SI'],
		':bat_type' => $data['info']['bat_type'],
		':bowl_type' => $data['info']['bowl_type'],
		':xp' => $data['info']['experience'],
		':form' => $data['info']['form'],
		':fitness' => $data['info']['fitness']
	));
	//}
	}
}

/*
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
$memory = round( ((memory_get_peak_usage() - $memory) / 1024) / 1024, 2);
echo 'Page generated in '.$total_time.' seconds. And consumed '.$memory.' Mb';
echo " <meta http-equiv='refresh' content='100; URL=main.php?id=".($matchid + 1)."'>";
*/

//file_put_contents('donetill', $matchid);
$match_put = ($match_string[0]+90)."-".$match_string[1];
file_put_contents('donetill', $match_put);

?>