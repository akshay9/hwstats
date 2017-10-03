@extends('layout.main')


@section('content')
	
<?php

function createBar($value){
	$percent = round(($value / 20) * 100 );
	$Xp_level = Xp_level($value);
	$output = "
	<div class=\"progress progress-striped tooltip2\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$Xp_level."\">
		<div class=\"progress-bar \"  role=\"progressbar\" aria-valuenow=\"".$percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".$percent."%\"> ".$Xp_level."
			<span class=\"sr-only\">".$percent."% Complete</span>
		</div>
	</div>";
	return $output;
}
function Xp_level($string){
	switch($string){
		case 0: 
			$level = "Non-existant"; 
			break;
		case 1:
			$level = "Horrible"; 
			break;
		case 2: 
			$level = "Hopeless"; 
			break;
		case 3: 
			$level = "Useless";
			break;
		case 4: 
			$level = "Mediocre";
			break;
		case 5: 
			$level = "Average"; 
			break;
		case 6: 
			$level = "Reliable"; 
			break;
		case 7: 
			$level = "Accomplished"; 
			break;
		case 8: 
			$level = "Remarkable"; 
			break;
		case 9: 
			$level = "Brilliant"; 
			break;
		case 10: 
			$level = "Exemplary"; 
			break;
		case 11: 
			$level = "Prodigious"; 
			break;
		case 12: 
			$level = "Fantastic"; 
			break;
		case 13: 
			$level = "Magnificent"; 
			break;
		case 14: 
			$level = "Masterful"; 
			break;
		case 15: 
			$level = "Supreme"; 
			break;
		case 16: 
			$level = "Magical"; 
			break;
		case 17: 
			$level = "Legendary"; 
			break;
		case 18: 
			$level = "Wonderous"; 
			break;
		case 19: 
			$level = "Demigod"; 
			break;
		case 20: 
			$level = "Titan"; 
			break;

	}
	return $level;
}
function skill_level($string){
	switch($string){
		case 1:
			$level = "Hopeless";
        break;
		case 2:
			$level = "Poor";
        break;
		case 3:
			$level = "Unreliable";
        break;
		case 4:
			$level = "Decent";
        break;
		case 5:
			$level = "Good";
        break;
		case 6:
			$level = "Superb";
        break;
	}
	return $level;
}

function isPresent($field, $value){
	if (Input::get($field) !== NULL && Input::get($field) == $value) {
		return "selected";
	} else {
		return "";
	}
}

?>
	<div class="col-md-12">
		<h2  style="text-align: center">Price Quote</h2><br>
		<div id="adv_search" <?php if(isset($_GET['age'])){ echo "style=\"display:none\"";} ?>>
		<div class="well well-lg table-responsive">
		<form action="{{ URL::to('auction/quote') }}" method="get">
		<table class="table">
			<tbody>
				<tr style="text-align:center">
					<td class="tooltip2" data-container="body" data-toggle="hover" data-toggle="tooltip" title="Approx ±20%">Skill Index</td><td>Age</td><td>Batting Style</td><td>Bowling Style</td><td>Experience</td><!--<td>Form</td><td>Fitness</td>--><td></td>
				</tr>
				<tr>
					
					<td>
						<div class="input-group" style="width: 15em">
							<span class="input-group-addon">SI</span>
							<input name="si" type="number" class="form-control" id="max_price" value="{{ Input::get('si') <1 ? 0:Input::get('si') }}">
						</div>
					</td>
					<td>
						<select name="age" id="age" class="form-control">
							<option value="16">Any.</option>
							<option value="17" {{ isPresent('age', 17) }}>17 yrs</option>
							<option value="18" {{ isPresent('age', 18) }}>18 yrs</option>
							<option value="19" {{ isPresent('age', 19) }}>19 yrs</option>
							<option value="20" {{ isPresent('age', 20) }}>20 yrs</option>
							<option value="21" {{ isPresent('age', 21) }}>21 yrs</option>
							<option value="22" {{ isPresent('age', 22) }}>22 yrs</option>
							<option value="23" {{ isPresent('age', 23) }}>23 yrs</option>
							<option value="24" {{ isPresent('age', 24) }}>24 yrs</option>
							<option value="25" {{ isPresent('age', 25) }}>25 yrs</option>
							<option value="26" {{ isPresent('age', 26) }}>26 yrs</option>
							<option value="27" {{ isPresent('age', 27) }}>27 yrs</option>
							<option value="28" {{ isPresent('age', 28) }}>28 yrs</option>
							<option value="29" {{ isPresent('age', 29) }}>29 yrs</option>
							<option value="30" {{ isPresent('age', 30) }}>30 yrs</option>
							<option value="31" {{ isPresent('age', 31) }}>31 yrs</option>
							<option value="32" {{ isPresent('age', 32) }}>32 yrs</option>
							<option value="33" {{ isPresent('age', 33) }}>33 yrs</option>
							<option value="34" {{ isPresent('age', 34) }}>34 yrs</option>
							<option value="35" {{ isPresent('age', 35) }}>35 yrs</option>
						</select>
					</td>
					<td>
						<select name="bat_style" id="bat_style" class="form-control">
							<option value="0" {{ isPresent('bat_style', 0) }}>Any</option>
							<option value="1" {{ isPresent('bat_style', 1) }}>Right-hand Batsman</option>
							<option value="2" {{ isPresent('bat_style', 2) }}>Left-hand Batsman</option>
						</select>
					</td>
					<td>
						<select name="bowl_style" id="bowl_style" class="form-control">
							<option value="0" {{ isPresent('bowl_style', 0) }}>Any</option>
							<option value="1" {{ isPresent('bowl_style', 1) }}>Spin Bowler</option>
							<option value="2" {{ isPresent('bowl_style', 2) }}>Seam Bowler</option>
						</select>
					</td>
				
					<td>
						<select name="xp" id="xp" class="form-control">
							<option value="-1">Any</option>
							<option value="0" {{ isPresent('xp', 0) }}>non-existent</option>
							<option value="1"  {{ isPresent('xp', 1) }}>Horrible</option>
							<option value="2"  {{ isPresent('xp', 2) }}>Hopeless</option>
							<option value="3"  {{ isPresent('xp', 3) }}>Useless</option>
							<option value="4"  {{ isPresent('xp', 4) }}>Mediocre</option>
							<option value="5"  {{ isPresent('xp', 5) }}>Average</option>
							<option value="6"  {{ isPresent('xp', 6) }}>Reliable</option>
							<option value="7"  {{ isPresent('xp', 7) }}>Accomplished</option>
							<option value="8"  {{ isPresent('xp', 8) }}>Remarkable</option>
							<option value="9"  {{ isPresent('xp', 9) }}>Brilliant</option>
							<option value="10"  {{ isPresent('xp', 10) }}>Exemplary</option>
							<option value="11"  {{ isPresent('xp', 11) }}>Prodigious</option>
							<option value="12"  {{ isPresent('xp', 12) }}>Fantastic</option>
							<option value="13"  {{ isPresent('xp', 13) }}>Magnificent</option>
							<option value="14"  {{ isPresent('xp', 14) }}>Masterful</option>
							<option value="15"  {{ isPresent('xp', 15) }}>Supreme</option>
							<option value="16"  {{ isPresent('xp', 16) }}>Magical</option>
							<option value="17"  {{ isPresent('xp', 17) }}>Legendary</option>
							<option value="18"  {{ isPresent('xp', 18) }}>Wonderous</option>
							<option value="19"  {{ isPresent('xp', 19) }}>Demigod</option>
							<option value="20"  {{ isPresent('xp', 20) }}>Titan</option>
						</select>
					</td>
					<!--<td>
						<select name="form" id="form" class="form-control">
							<option value="0">Min.</option>
							<option value="0" {{ isPresent('form', 0) }}>Hopeless</option>
							<option value="1" {{ isPresent('form', 1) }}>Poor</option>
							<option value="2" {{ isPresent('form', 2) }}>Unreliable</option>
							<option value="3" {{ isPresent('form', 3) }}>Decent</option>
							<option value="4" {{ isPresent('form', 4) }}>Good</option>
							<option value="5" {{ isPresent('form', 5) }}>Superb</option>
						</select>
					</td>
					<td>
						<select name="fitness" id="fitness" class="form-control">
							<option value="0">Min.</option>
							<option value="0" {{ isPresent('fitness', 0) }}>Hopeless</option>
							<option value="1" {{ isPresent('fitness', 1) }}>Poor</option>
							<option value="2" {{ isPresent('fitness', 2) }}>Unreliable</option>
							<option value="3" {{ isPresent('fitness', 3) }}>Decent</option>
							<option value="4" {{ isPresent('fitness', 4) }}>Good</option>
							<option value="5" {{ isPresent('fitness', 5) }}>Superb</option>
						</select>
					</td> -->
					<!--<td>
						<div class="input-group" style="width: 15em">
							<span class="input-group-addon">Rs.</span>
							<input name="max_price" type="number" class="form-control" id="max_price" value="{{ Input::get('max_price') }}">
						</div>
					</td>-->
					<td></td>
				</tr>
				<tr><td colspan="6"><br></td></tr>
				<!---<tr>
					<td colspan="6"><div style="text-align:center">
						U20 Eligible Upto :
						<select id="u20" name="u20" class="form-control" style="width: 15em; margin: 0 auto;">
							<option value="0">Any</option>
							<option value="6" {{ isPresent('u20', 6) }}> U20 6</option>
							<option value="7" {{ isPresent('u20', 7) }}> U20 7</option>
							<option value="8" {{ isPresent('u20', 8) }}> U20 8</option>
							<option value="9" {{ isPresent('u20', 9) }}> U20 9</option>
						</select></div>
					<td>
				</tr> -->
				<tr style="text-align:center">
					<td>Fielding</td><td>Wicket Keeping</td><td>Batting Vs Seam</td><td>Batting Vs Spin</td><td>Bowling Main</td><td>Bowling Variation</td>
				</tr>
				<tr>
					<td>
						<select name="fielding" id="fielding" class="form-control">
							<option value="-1" >Any</option>
							<option value="0" {{ isPresent('fielding', 0) }}>non-existent</option>
							<option value="1"  {{ isPresent('fielding', 1) }}>Horrible</option>
							<option value="2"  {{ isPresent('fielding', 2) }}>Hopeless</option>
							<option value="3"  {{ isPresent('fielding', 3) }}>Useless</option>
							<option value="4"  {{ isPresent('fielding', 4) }}>Mediocre</option>
							<option value="5"  {{ isPresent('fielding', 5) }}>Average</option>
							<option value="6"  {{ isPresent('fielding', 6) }}>Reliable</option>
							<option value="7"  {{ isPresent('fielding', 7) }}>Accomplished</option>
							<option value="8"  {{ isPresent('fielding', 8) }}>Remarkable</option>
							<option value="9"  {{ isPresent('fielding', 9) }}>Brilliant</option>
							<option value="10"  {{ isPresent('fielding', 10) }}>Exemplary</option>
							<option value="11"  {{ isPresent('fielding', 11) }}>Prodigious</option>
							<option value="12"  {{ isPresent('fielding', 12) }}>Fantastic</option>
							<option value="13"  {{ isPresent('fielding', 13) }}>Magnificent</option>
							<option value="14"  {{ isPresent('fielding', 14) }}>Masterful</option>
							<option value="15"  {{ isPresent('fielding', 15) }}>Supreme</option>
							<option value="16"  {{ isPresent('fielding', 16) }}>Magical</option>
							<option value="17"  {{ isPresent('fielding', 17) }}>Legendary</option>
							<option value="18"  {{ isPresent('fielding', 18) }}>Wonderous</option>
							<option value="19"  {{ isPresent('fielding', 19) }}>Demigod</option>
							<option value="20"  {{ isPresent('fielding', 20) }}>Titan</option>
						</select>
					</td>
					<td>
						<select name="wicketkeeping" id="wicketkeeping" class="form-control">
							<option value="-1" >Any</option>
							<option value="0" {{ isPresent('wicketkeeping', 0) }}>non-existent</option>
							<option value="1"  {{ isPresent('wicketkeeping', 1) }}>Horrible</option>
							<option value="2"  {{ isPresent('wicketkeeping', 2) }}>Hopeless</option>
							<option value="3"  {{ isPresent('wicketkeeping', 3) }}>Useless</option>
							<option value="4"  {{ isPresent('wicketkeeping', 4) }}>Mediocre</option>
							<option value="5"  {{ isPresent('wicketkeeping', 5) }}>Average</option>
							<option value="6"  {{ isPresent('wicketkeeping', 6) }}>Reliable</option>
							<option value="7"  {{ isPresent('wicketkeeping', 7) }}>Accomplished</option>
							<option value="8"  {{ isPresent('wicketkeeping', 8) }}>Remarkable</option>
							<option value="9"  {{ isPresent('wicketkeeping', 9) }}>Brilliant</option>
							<option value="10"  {{ isPresent('wicketkeeping', 10) }}>Exemplary</option>
							<option value="11"  {{ isPresent('wicketkeeping', 11) }}>Prodigious</option>
							<option value="12"  {{ isPresent('wicketkeeping', 12) }}>Fantastic</option>
							<option value="13"  {{ isPresent('wicketkeeping', 13) }}>Magnificent</option>
							<option value="14"  {{ isPresent('wicketkeeping', 14) }}>Masterful</option>
							<option value="15"  {{ isPresent('wicketkeeping', 15) }}>Supreme</option>
							<option value="16"  {{ isPresent('wicketkeeping', 16) }}>Magical</option>
							<option value="17"  {{ isPresent('wicketkeeping', 17) }}>Legendary</option>
							<option value="18"  {{ isPresent('wicketkeeping', 18) }}>Wonderous</option>
							<option value="19"  {{ isPresent('wicketkeeping', 19) }}>Demigod</option>
							<option value="20"  {{ isPresent('wicketkeeping', 20) }}>Titan</option>
						</select>
					</td>
					<td>
						<select name="bat_seam" id="bat_seam" class="form-control">
							<option value="-1" >Any</option>
							<option value="0" {{ isPresent('bat_seam', 0) }}>non-existent</option>
							<option value="1"  {{ isPresent('bat_seam', 1) }}>Horrible</option>
							<option value="2"  {{ isPresent('bat_seam', 2) }}>Hopeless</option>
							<option value="3"  {{ isPresent('bat_seam', 3) }}>Useless</option>
							<option value="4"  {{ isPresent('bat_seam', 4) }}>Mediocre</option>
							<option value="5"  {{ isPresent('bat_seam', 5) }}>Average</option>
							<option value="6"  {{ isPresent('bat_seam', 6) }}>Reliable</option>
							<option value="7"  {{ isPresent('bat_seam', 7) }}>Accomplished</option>
							<option value="8"  {{ isPresent('bat_seam', 8) }}>Remarkable</option>
							<option value="9"  {{ isPresent('bat_seam', 9) }}>Brilliant</option>
							<option value="10"  {{ isPresent('bat_seam', 10) }}>Exemplary</option>
							<option value="11"  {{ isPresent('bat_seam', 11) }}>Prodigious</option>
							<option value="12"  {{ isPresent('bat_seam', 12) }}>Fantastic</option>
							<option value="13"  {{ isPresent('bat_seam', 13) }}>Magnificent</option>
							<option value="14"  {{ isPresent('bat_seam', 14) }}>Masterful</option>
							<option value="15"  {{ isPresent('bat_seam', 15) }}>Supreme</option>
							<option value="16"  {{ isPresent('bat_seam', 16) }}>Magical</option>
							<option value="17"  {{ isPresent('bat_seam', 17) }}>Legendary</option>
							<option value="18"  {{ isPresent('bat_seam', 18) }}>Wonderous</option>
							<option value="19"  {{ isPresent('bat_seam', 19) }}>Demigod</option>
							<option value="20"  {{ isPresent('bat_seam', 20) }}>Titan</option>
						</select>
					</td>
					<td>
						<select name="bat_spin" id="bat_spin" class="form-control">
							<option value="-1" >Any</option>
							<option value="0" {{ isPresent('bat_spin', 0) }}>non-existent</option>
							<option value="1"  {{ isPresent('bat_spin', 1) }}>Horrible</option>
							<option value="2"  {{ isPresent('bat_spin', 2) }}>Hopeless</option>
							<option value="3"  {{ isPresent('bat_spin', 3) }}>Useless</option>
							<option value="4"  {{ isPresent('bat_spin', 4) }}>Mediocre</option>
							<option value="5"  {{ isPresent('bat_spin', 5) }}>Average</option>
							<option value="6"  {{ isPresent('bat_spin', 6) }}>Reliable</option>
							<option value="7"  {{ isPresent('bat_spin', 7) }}>Accomplished</option>
							<option value="8"  {{ isPresent('bat_spin', 8) }}>Remarkable</option>
							<option value="9"  {{ isPresent('bat_spin', 9) }}>Brilliant</option>
							<option value="10"  {{ isPresent('bat_spin', 10) }}>Exemplary</option>
							<option value="11"  {{ isPresent('bat_spin', 11) }}>Prodigious</option>
							<option value="12"  {{ isPresent('bat_spin', 12) }}>Fantastic</option>
							<option value="13"  {{ isPresent('bat_spin', 13) }}>Magnificent</option>
							<option value="14"  {{ isPresent('bat_spin', 14) }}>Masterful</option>
							<option value="15"  {{ isPresent('bat_spin', 15) }}>Supreme</option>
							<option value="16"  {{ isPresent('bat_spin', 16) }}>Magical</option>
							<option value="17"  {{ isPresent('bat_spin', 17) }}>Legendary</option>
							<option value="18"  {{ isPresent('bat_spin', 18) }}>Wonderous</option>
							<option value="19"  {{ isPresent('bat_spin', 19) }}>Demigod</option>
							<option value="20"  {{ isPresent('bat_spin', 20) }}>Titan</option>
						</select>
					</td>
					<td>
						<select name="bowl_main" id="bowl_main" class="form-control">
							<option value="-1" >Any</option>
							<option value="0" {{ isPresent('bowl_main', 0) }}>non-existent</option>
							<option value="1"  {{ isPresent('bowl_main', 1) }}>Horrible</option>
							<option value="2"  {{ isPresent('bowl_main', 2) }}>Hopeless</option>
							<option value="3"  {{ isPresent('bowl_main', 3) }}>Useless</option>
							<option value="4"  {{ isPresent('bowl_main', 4) }}>Mediocre</option>
							<option value="5"  {{ isPresent('bowl_main', 5) }}>Average</option>
							<option value="6"  {{ isPresent('bowl_main', 6) }}>Reliable</option>
							<option value="7"  {{ isPresent('bowl_main', 7) }}>Accomplished</option>
							<option value="8"  {{ isPresent('bowl_main', 8) }}>Remarkable</option>
							<option value="9"  {{ isPresent('bowl_main', 9) }}>Brilliant</option>
							<option value="10"  {{ isPresent('bowl_main', 10) }}>Exemplary</option>
							<option value="11"  {{ isPresent('bowl_main', 11) }}>Prodigious</option>
							<option value="12"  {{ isPresent('bowl_main', 12) }}>Fantastic</option>
							<option value="13"  {{ isPresent('bowl_main', 13) }}>Magnificent</option>
							<option value="14"  {{ isPresent('bowl_main', 14) }}>Masterful</option>
							<option value="15"  {{ isPresent('bowl_main', 15) }}>Supreme</option>
							<option value="16"  {{ isPresent('bowl_main', 16) }}>Magical</option>
							<option value="17"  {{ isPresent('bowl_main', 17) }}>Legendary</option>
							<option value="18"  {{ isPresent('bowl_main', 18) }}>Wonderous</option>
							<option value="19"  {{ isPresent('bowl_main', 19) }}>Demigod</option>
							<option value="20"  {{ isPresent('bowl_main', 20) }}>Titan</option>
						</select>
					</td>
					<td>
						<select name="bowl_var" id="bowl_var" class="form-control">
							<option value="-1" >Any</option>
							<option value="0" {{ isPresent('bowl_var', 0) }}>non-existent</option>
							<option value="1"  {{ isPresent('bowl_var', 1) }}>Horrible</option>
							<option value="2"  {{ isPresent('bowl_var', 2) }}>Hopeless</option>
							<option value="3"  {{ isPresent('bowl_var', 3) }}>Useless</option>
							<option value="4"  {{ isPresent('bowl_var', 4) }}>Mediocre</option>
							<option value="5"  {{ isPresent('bowl_var', 5) }}>Average</option>
							<option value="6"  {{ isPresent('bowl_var', 6) }}>Reliable</option>
							<option value="7"  {{ isPresent('bowl_var', 7) }}>Accomplished</option>
							<option value="8"  {{ isPresent('bowl_var', 8) }}>Remarkable</option>
							<option value="9"  {{ isPresent('bowl_var', 9) }}>Brilliant</option>
							<option value="10"  {{ isPresent('bowl_var', 10) }}>Exemplary</option>
							<option value="11"  {{ isPresent('bowl_var', 11) }}>Prodigious</option>
							<option value="12"  {{ isPresent('bowl_var', 12) }}>Fantastic</option>
							<option value="13"  {{ isPresent('bowl_var', 13) }}>Magnificent</option>
							<option value="14"  {{ isPresent('bowl_var', 14) }}>Masterful</option>
							<option value="15"  {{ isPresent('bowl_var', 15) }}>Supreme</option>
							<option value="16"  {{ isPresent('bowl_var', 16) }}>Magical</option>
							<option value="17"  {{ isPresent('bowl_var', 17) }}>Legendary</option>
							<option value="18"  {{ isPresent('bowl_var', 18) }}>Wonderous</option>
							<option value="19"  {{ isPresent('bowl_var', 19) }}>Demigod</option>
							<option value="20"  {{ isPresent('bowl_var', 20) }}>Titan</option>
						</select>
					</td>
				</tr>
				<tr><td><br><td></tr>
				<tr>
					<td colspan="6" style="text-align:center"><input type="submit" name="Search" class="btn btn-success"></td>
				</tr>
			</tbody>
		</table>
		</form>
		</div>
		</div>
		<div style="text-align: center;"><button id="adv_filer_show" class="btn btn-success" {{ isset($_GET['age'])  ? "":"style=\"display:none\"" }}>Show Advanced Filters</button></div>
		<br><div style="text-align: center;" class="alert alert-danger"><strong>Average Price:</strong> Rs. {{ $avg_price }}</div><br>

	<div class="table-responsive">
		<table class="table table-striped">
			<thead><style>th{text-align: center;}</style>
				<tr>
					<th style="text-align: left;">Player</th>
					<th>Price</th>
					<th>Age</th>
					<th>Fielding</th>
					<th>Wicket Keeping</th>
					<th>Batting Seam</th>
					<th>Batting Spin</th>
					<th>Bowling Main</th>
					<th>Bowling Var</th>
				</tr>
			</thead>
			<tbody style="font-size: 0.85em; text-align: center;">
				@foreach($auction as $row)
				<tr>
					<td style="text-align: left;" class="popover1" data-container="body"  data-trigger="hover"  data-original-title="Info" data-toggle="popover" data-html="true" data-placement="right" 
						data-content=
						"
						<strong>Experience</strong> : <span class='skill_{{ $row->experience }}'><strong>{{ Xp_level($row->experience) }}</strong></span><br>
						<strong>Batting Style</strong> : {{ $row->bat_type }}<br>
						<strong>Bowling Style</strong> : {{ $row->bowl_type }}<br>
						<strong>Form</strong> : <span class='secondary_skill_{{ $row->form }}'><strong>{{ skill_level($row->form) }}</strong></span><br>
						<strong>Fitness</strong> : <span class='secondary_skill_{{ $row->fitness }}'><strong>{{ skill_level($row->fitness) }}</strong></span><br>
						<strong>Skill Index</strong> : {{ number_format($row->si) }}<br>
						"
						><a href="http://www.hitwicket.com/player/show/{{ $row->player_id }}" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a> {{ $row->playername }}</td>
					<td><strong>Rs. {{ number_format($row->price) }} <?php if($row->status == 0 || $row->checks > 2) { ?><span data-toggle="tooltip" data-placement="bottom" title="Auction Not Finished Yet OR The player went Unsold." class="glyphicon glyphicon-time tooltip1"></span><?php } ?></strong></td>
					<td>{{ round(($row->age / 70) - 0.5)." yrs  ".($row->age % 70)." days"}}</td>
					<td><span class="skill_{{ $row->fielding }}"><strong>{{ Xp_level($row->fielding) }}</strong></span></td>
					<td><span class="skill_{{ $row->wicket }}"><strong>{{ Xp_level($row->wicket) }}</strong></span></td>
					<td><span class="skill_{{ $row->bat_seam }}"><strong>{{ Xp_level($row->bat_seam) }}</strong></span></td>
					<td><span class="skill_{{ $row->bat_spin }}"><strong>{{ Xp_level($row->bat_spin) }}</strong></span></td>
					<td><span class="skill_{{ $row->bowl_main }}"><strong>{{ Xp_level($row->bowl_main) }}</strong></span></td>
					<td><span class="skill_{{ $row->bowl_var }}"><strong>{{ Xp_level($row->bowl_var) }}</strong></span></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
		<div class="center-block"><?php //unset($_GET['page']); echo $auction->appends($_GET)->links(); ?></div>
	</div>

@stop