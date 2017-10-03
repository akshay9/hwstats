<?php

///$db = new PDO('mysql:dbname=traviang_hwstats;host=localhost', 'traviang', 'bquYNxTI10UP6HAM');
include('connection.php');

date_default_timezone_set('Asia/Kolkata');

$time = time() - (60*40);
$time2 = time() - (60*10);

$query = "SELECT id, player_id, team_id, checks FROM `auction` WHERE (`time` BETWEEN ".$time." AND ".$time2.") AND `status`=0 AND `checks`< 3 Limit 0,10";
echo "<pre>".$query;

$stmt = $db->prepare($query);
$stmt->execute();
$result1 = $stmt->fetchAll();
//$id = 485652;
//$result1 = array('485652');
//var_dump($result1);

foreach($result1 as $result){

$id = $result[1];

$data = file_get_contents('http://hitwicket.com/player/transferHistory/'.$id);

$fin_check = str_replace("has not been bought or sold yet.", "", $data, $count);
echo $count;
if($count == 0){
	
	$replace = array("\n","<table class=\"table table-striped footable\">","</table>","<thead>","</thead>",
					"<th data-class=\"expand\">&nbsp;</th>",
					"<th>From</th>","<th>To</th>","<th data-hide=\"phone,smalltab\">Date</th>",
					"<th align=\"right\" data-hide=\"phone,smalltab\">Skill Index</th>",
					"<th align=\"right\">Transfer Fee</th>","<tr>","</tr>");
	$output = explode("<td", str_replace($replace, "", $data));

	$data = array();
	
	$from = explode("\"", str_replace(array("<a href=\"/team/show/",">"), "", $output[2]));
	$data['from'] = $from[0];
	////echo $data['from'] ."----". $result[2] . "<br>";
	if($data['from'] != $result[2]){
		
		echo $result[0]."<br>";
		$stmt = $db->prepare("UPDATE `auction` SET time=:time, checks=:checks WHERE id=:id");
		$stmt->execute(array(
						':id' => $result[0],
						':time' => time(),
						':checks' => $result[3] + 1 ,
						));
						
		continue;
	}
	
	echo $result[0]." BREAK <br>";
	//echo $result[0];
	$to = explode("\"", str_replace("<a href=\"/team/show/", "", $output[3]));
	$data['to'] = str_replace(">", "", strip_tags($to[0]));
	$data['to_name'] = str_replace(">", "", strip_tags($to[1]));
	
	$date = explode("</td>", $output[4]);
	$data['date'] = date_format(date_create_from_format('H:i D d-m-Y', str_replace(">", "", $date[0]), timezone_open("Asia/Kolkata")), 'U');
	
	$price = explode("\"", str_replace(" align=\"right\">", "", $output[6]));
	$data['price'] = str_replace(",", "", $price[0]);
	
	$stmt = $db->prepare("UPDATE `auction` SET time=:time, price=:price, status='1' WHERE id=:id");
	if($stmt->execute(array(
					':id' => $result[0],
					':time' => $data['date'],
					':price' => $data['price']
					))){ echo "";}
					
	$stmt = $db->prepare("UPDATE `players` SET `team_id`=:team WHERE `player_id`=:plyid");
	if($stmt->execute(array(
					':plyid' => $result[1],
					':team' => $data['to'],
					))){ echo "";}
	
	$sql_team = "INSERT INTO teams 
		(`team_id`, `name`) VALUES
		(:team_id, :name)
		ON DUPLICATE KEY UPDATE name=:name";
					
	$stmt = $db->prepare($sql_team);
	if($stmt->execute(array(
					':team_id' => $data['to'],
					':name' => $data['to_name'],
					))){ echo "";}
	/*
	var_dump($to);
	var_dump($data);
	echo $id;
	*/
} else {

	$stmt = $db->prepare("UPDATE `auction` SET `time`=:time, `checks`=:checks WHERE id=:id");
	$stmt->execute(array(
				':id' => $result[0],
				':time' => time(),
				':checks' => $result[3] + 1 ,
				));
	echo $result[0];
	continue;
}
}
?>