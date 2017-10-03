@extends('layout.main')


@section('content')
	
<?php

function createBar($value){
	$percent = round(($value / 20) * 100 );
	$Xp_level = Xp_level($value);
	$output = "
	<div class=\"progress progress-striped tooltip2\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"".$Xp_level."\">
		<div class=\"progress-bar \"  role=\"progressbar\" aria-valuenow=\"".$percent."\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ".$percent."%\">
			<span class=\"sr-only\">".$percent."% Complete</span>
		</div>
	</div>
	</td>
	<td style=\"width: 10em\">
		<span data-toggle=\"popover\" data-trigger=\"hover\" data-original-title=\"Skill Levels\" class=\"skill_popover skill_".$value."\"><strong>".$Xp_level."</strong></span>
	</td>";
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

function atriFinder($age,$bowl,$xp,$si,$wk,$batSeam,$batSpin,$bowlMain,$bowlVar){

	$score['wk'] = $wk * 100 ;
	$score['bat'] = ($batSeam + $batSpin)/2 * 75 ;
	$score['bowl'] = ($bowlMain * 50) + ($bowlVar * 100);

	if($score['wk'] >= $score['bowl']){ ///is wk or/and batsman (Surely a hopeless bowler)

		if ($score['wk'] >= $score['bat'] ) { ///is wk only

			if(($score['wk'] - $score['bat']) >= 200){
				$link = "si=".$si."&xp=".$xp."&age=".$age."&wicketkeeping=".$wk ;
			} else {
				$link = "si=".$si."&xp=".$xp."&age=".$age."&wicketkeeping=".$wk."&bat_seam=".$batSeam."&bat_spin=".$batSpin ;
			}

		} elseif($score['wk'] < $score['bat']) { //is batsman only

			if(($score['bat'] - $score['wk']) >= 200){ //Only Batsman
				$link = "si=".$si."&xp=".$xp."&age=".$age."&bat_seam=".$batSeam."&bat_spin=".$batSpin ;
			} else {
				$link = "si=".$si."&xp=".$xp."&age=".$age."&wicketkeeping=".$wk."&bat_seam=".$batSeam."&bat_spin=".$batSpin ;
			}
		} 

	} elseif ($score['wk'] < $score['bowl']) { /// a Bowler or Batsman (surely Hopeless wk)

		if ($score['bowl'] >= $score['bat']) { // is a Bowler

			if(($score['bowl'] - $score['bat']) >= 200){ //Only Bowler
				$link = "si=".$si."&xp=".$xp."&age=".$age."&bowl_main=".$bowlMain."&bowl_var=".$bowlVar ;
			} else {
				$link = "si=".$si."&xp=".$xp."&age=".$age."&bowl_main=".$bowlMain."&bowl_var=".$bowlVar."&bat_seam=".$batSeam."&bat_spin=".$batSpin ;
			}

		} elseif($score['bowl'] < $score['bat']) { // is a batsman)
			
			if(($score['bat'] - $score['bowl']) >= 200){ //Only Bowler
				$link = "si=".$si."&xp=".$xp."&age=".$age."&bat_seam=".$batSeam."&bat_spin=".$batSpin ;
			} else {
				$link = "si=".$si."&xp=".$xp."&age=".$age."&bowl_main=".$bowlMain."&bowl_var=".$bowlVar."&bat_seam=".$batSeam."&bat_spin=".$batSpin ;
			}
		}
		
	} else { /// suprising one 
		$link = "";
	}

	return $link;
}

function stars($type, $atri_1, $atri_2, $fitness, $type2 = '0'){
	$penlty = array();
	$penlty = array(
			'spin' => array(
						'0' => (32  / 100), 
						'1' => (20  / 100), 
						'2' => (12  / 100), 
						'3' => (8  / 100), 
						'4' => (4  / 100), 
						'5' => (0  / 100), 
						),
			'seam' => array(
						'0' => (50  / 100), 
						'1' => (30  / 100), 
						'2' => (20  / 100), 
						'3' => (14  / 100), 
						'4' => (6  / 100), 
						'5' => (0  / 100), 
						),	
			'bat' => array(
						'0' => (32  / 100), 
						'1' => (25  / 100), 
						'2' => (16  / 100), 
						'3' => (10  / 100), 
						'4' => (4  / 100), 
						'5' => (0  / 100),
						),		
			);

	if($type == "bowler"){

	$stars = $atri_1 / 3 ;
	$stars = $stars + $atri_2 ;

	if($type2 == "spin"){

		if($fitness < 5){
			$stars = $stars - ($stars * $penlty['spin'][($fitness - 1)]) ;
		}

	} elseif ($type2 == "seam") {

		$stars = $stars - ($stars * $penlty['seam'][($fitness - 1)]) ;

	}
	
	} elseif ($type == "batsman") {
	
	$stars = (($atri_1 + $atri_2) / 2) - 1 ;
	$stars = $stars - ($stars * $penlty['bat'][($fitness - 1)]) ;
	}


	return abs(round($stars * 2) / 2);
}

function typeFinder($string){

	$string = strtolower($string);

	if (strpos($string, 'medium') !== FALSE || strpos($string, 'fast') !== FALSE) {
    	return 'seam';
	} else {
		return 'spin';
	}

}

?>
	<div class="col-md-12">
		<h2 style="text-align: center">Auction</h2><br>
		<?php
		/*
		<div class="well well-sm">
			<h3 style="text-align: center">Quick Links</h3><br>
			<table class="table">
				<tbody>
					<tr style="text-align: center">
						<td style="text-align: left"><h4>U20 Eligible Upto</h4></td>
						<td><a href="{{ URL::to('auction/index') }}?u20=9&Search=Submit"><button type="button" class="btn btn-danger">U20 IX</button></a></td>
						<td><a href="{{ URL::to('auction/index/') }}?u20=8&Search=Submit"><button type="button" class="btn btn-warning">U20 VIII</button></a></td>
						<td><a href="{{ URL::to('auction/index/') }}?u20=7&Search=Submit"><button type="button" class="btn btn-primary">U20 VII</button></a></td>
					</tr>
					<tr style="text-align: center">
						<td style="text-align: left"><h4>Batting Trainies</h4></td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?sort_by=time&age=18&fitness=4&bat_seam=7&bat_spin=7&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Accom/Accom<br> 17yrs<br> Good Fitness">
								<button type="button" class="btn btn-danger">Class 1</button>
							</a>
						</td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?sort_by=time&age=18&fitness=3&bat_seam=6&bat_spin=6&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Reliable/Reliable<br> 17yrs<br> Decent Fitness">
								<button type="button" class="btn btn-warning">Class 2</button>
							</a>
						</td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?sort_by=time&age=19&fitness=3&bat_seam=6&bat_spin=6&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Reliable/Reliable<br> 18yrs<br> Decent Fitness">
								<button type="button" class="btn btn-primary">Class 3</button>
							</a>
						</td>
					</tr>
					<tr style="text-align: center">
						<td style="text-align: left"><h4>Spin Bowling Trainies</h4></td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?age=18&bowl_style=1&fitness=3&bowl_main=7&bowl_var=3&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Accom/Useless<br> 17yrs<br> Decent Fitness">
								<button type="button" class="btn btn-danger">Class 1</button>
							</a>
						</td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?age=18&bowl_style=1&fitness=3&bowl_main=6&bowl_var=3&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Reliable/Useless<br> 17yrs<br> Decent Fitness">
								<button type="button" class="btn btn-warning">Class 2</button>
							</a>
						</td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?age=19&bowl_style=1&fitness=2&bowl_main=6&bowl_var=2&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Reliable/Hopeless<br> 18yrs<br> Unreliable Fitness">
								<button type="button" class="btn btn-primary">Class 3</button>
							</a>
						</td>
					</tr>
					<tr style="text-align: center">
						<td style="text-align: left"><h4>Seam Bowling Trainies</h4></td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?age=18&bowl_style=2&fitness=4&bowl_main=7&bowl_var=3&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Accom/Useless<br> 17yrs<br> Good Fitness">
								<button type="button" class="btn btn-danger">Class 1</button>
							</a>
						</td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?age=18&bowl_style=2&fitness=3&bowl_main=6&bowl_var=3&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Reliable/Useless<br> 17yrs<br> Decent Fitness">
								<button type="button" class="btn btn-warning">Class 2</button>
							</a>
						</td>
						<td>
							<a href="{{ URL::to('auction/index/') }}?age=19&bowl_style=2&fitness=3&bowl_main=6&bowl_var=2&Search=Submit" class="tooltip1" data-placement="left" data-toggle="tooltip" title="Reliable/Hopeless<br> 18yrs<br> Decent Fitness">
								<button type="button" class="btn btn-primary">Class 3</button>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		*/
		?>
		<div class="well well-sm table-responsive">
		<h3 style="text-align: center">Auction Filters</h3><br>
		{{ Form::open(array('action' => 'AuctionController@getIndex', 'method' => 'get')) }}
		<table class="table">
			<tbody>
				<tr style="text-align:center">
					<td></td><td>Sort By</td><td>Age Max.</td><td>Batting Style</td><td>Bowling Style</td><td></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<select name="sort_by" class="form-control">
							<option value="time">Sort by: Deadline</option>
							<!--<option value="time">Newest</option>-->
							<option value="price" {{ isPresent('sort_by', 'price') }}>Price</option>
							<option value="age" {{ isPresent('sort_by', 'age') }}>Age</option>
							<option value="si" {{ isPresent('sort_by', 'si') }}>Skill Index</option>
			    			<option value="salary" {{ isPresent('sort_by', 'salary') }}>Salary</option>
			    			<!--<option value="bowl_style">Bowling Style</option>-->
			    			<option value="experience" {{ isPresent('sort_by', 'experience') }}>Experience</option>
							<optgroup label="Skills">
								<option value="fielding" {{ isPresent('sort_by', 'fielding') }}>Fielding</option>
								<option value="wicket" {{ isPresent('sort_by', 'wicket') }}>Wicket Keeping</option>
								<option value="bat_seam" {{ isPresent('sort_by', 'bat_seam') }}>Batting vs Seam Bowlers</option>
								<option value="bat_spin" {{ isPresent('sort_by', 'bat_spin') }}>Batting vs Spin Bowlers</option>
								<option value="bowl_main" {{ isPresent('sort_by', 'bowl_main') }}>Main Bowling</option>
								<option value="bowl_var" {{ isPresent('sort_by', 'bowl_var') }}>Bowling Variation</option>
							</optgroup>
						</select>
					</td>
					<td>
						<select name="age" id="age" class="form-control">
							<option value="35">Max.</option>
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
							<option value="0" {{ isPresent('bat_style', 0) }}>Batting Style</option>
							<option value="1" {{ isPresent('bat_style', 1) }}>Right-hand Batsman</option>
							<option value="2" {{ isPresent('bat_style', 2) }}>Left-hand Batsman</option>
						</select>
					</td>
					<td>
						<select name="bowl_style" id="bowl_style" class="form-control">
							<option value="0" {{ isPresent('bowl_style', 0) }}>Bowling Style</option>
							<option value="1" {{ isPresent('bowl_style', 1) }}>Spin Bowler</option>
							<option value="2" {{ isPresent('bowl_style', 2) }}>Seam Bowler</option>
						</select>
					</td>
					<td></td>
				</tr>
				<tr><td><br><td></tr>
				<tr style="text-align:center">
					<td></td><td>Experience</td><td>Form</td><td>Fitness</td><td>Price Max</td><td></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<select name="xp" id="xp" class="form-control">
							<option value="0">Min.</option>
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
					<td>
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
					</td>
					<td>
						<div class="input-group" style="width: 15em">
							<span class="input-group-addon">Rs.</span>
							<input name="max_price" type="number" class="form-control" id="max_price" value="{{ Input::get('max_price') }}">
						</div>
					</td>
					<td></td>
				</tr>
				<tr><td><br><td></tr>
				<tr>
					<td colspan="2"><div style="text-align:center">
						U20 Eligible Upto :
						<select id="u20" name="u20" class="form-control" style="width: 15em; margin: 0 auto;">
							<option value="0">Any</option>
							<option value="7" {{ isPresent('u20', 7) }}> U20 7</option>
							<option value="8" {{ isPresent('u20', 8) }}> U20 8</option>
							<option value="9" {{ isPresent('u20', 9) }}> U20 9</option>
							<option value="10" {{ isPresent('u20', 10) }}> U20 10</option>
						</select></div>
					</td>
					<td colspan="2"><div style="text-align:center">
						Min Batting Stars :
						<select id="bat_stars" name="bat_stars" class="form-control" style="width: 15em; margin: 0 auto;">
							<option value="0">Min</option>
							<option value="1" {{ isPresent('bat_stars', 1) }}> 1 star</option>
							<option value="2" {{ isPresent('bat_stars', 2) }}> 2 stars</option>
							<option value="3" {{ isPresent('bat_stars', 3) }}> 3 stars</option>
							<option value="4" {{ isPresent('bat_stars', 4) }}> 4 stars</option>
							<option value="5" {{ isPresent('bat_stars', 5) }}> 5 stars</option>
							<option value="6" {{ isPresent('bat_stars', 6) }}> 6 stars</option>
							<option value="7" {{ isPresent('bat_stars', 7) }}> 7 stars</option>
							<option value="8" {{ isPresent('bat_stars', 8) }}> 8 stars</option>
							<option value="9" {{ isPresent('bat_stars', 9) }}> 9 stars</option>
							<option value="10" {{ isPresent('bat_stars', 10) }}> 10 stars</option>
							<option value="11" {{ isPresent('bat_stars', 11) }}> 11 stars</option>
							<option value="12" {{ isPresent('bat_stars', 12) }}> 12 stars</option>
							<option value="13" {{ isPresent('bat_stars', 13) }}> 13 stars</option>
							<option value="14" {{ isPresent('bat_stars', 14) }}> 14 stars</option>
						</select></div>
					</td>
					<td colspan="2"><div style="text-align:center">
						Min Bowling Stars :
						<select id="bowl_stars" name="bowl_stars" class="form-control" style="width: 15em; margin: 0 auto;">
							<option value="0">Min</option>
							<option value="1" {{ isPresent('bowl_stars', 1) }}> 1 star</option>
							<option value="2" {{ isPresent('bowl_stars', 2) }}> 2 stars</option>
							<option value="3" {{ isPresent('bowl_stars', 3) }}> 3 stars</option>
							<option value="4" {{ isPresent('bowl_stars', 4) }}> 4 stars</option>
							<option value="5" {{ isPresent('bowl_stars', 5) }}> 5 stars</option>
							<option value="6" {{ isPresent('bowl_stars', 6) }}> 6 stars</option>
							<option value="7" {{ isPresent('bowl_stars', 7) }}> 7 stars</option>
							<option value="8" {{ isPresent('bowl_stars', 8) }}> 8 stars</option>
							<option value="9" {{ isPresent('bowl_stars', 9) }}> 9 stars</option>
							<option value="10" {{ isPresent('bowl_stars', 10) }}> 10 stars</option>
							<option value="11" {{ isPresent('bowl_stars', 11) }}> 11 stars</option>
							<option value="12" {{ isPresent('bowl_stars', 12) }}> 12 stars</option>
							<option value="13" {{ isPresent('bowl_stars', 13) }}> 13 stars</option>
							<option value="14" {{ isPresent('bowl_stars', 14) }}> 14 stars</option>
						</select></div>
					</td>
				</tr>
				<tr style="text-align:center">
					<td>Fielding</td><td>Wicket Keeping</td><td>Batting Vs Seam</td><td>Batting Vs Spin</td><td>Bowling Main</td><td>Bowling Variation</td>
				</tr>
				<tr>
					<td>
						<select name="fielding" id="fielding" class="form-control">
							<option value="0">Min.</option>
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
							<option value="0">Min.</option>
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
							<option value="0">Min.</option>
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
							<option value="0">Min.</option>
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
							<option value="0">Min.</option>
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
							<option value="0">Min.</option>
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
					<td colspan="6" style="text-align:center"><input type="submit" name="Search" class="btn btn-success"><br><br><a href="{{ URL::to('auction') }}" >Reset</a></form></td>
				</tr>
			</tbody>
		</table>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 	   <div class="modal-dialog modal-lg">
 	       <div class="modal-content">
 	           <div class="modal-header">
  	              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    	             <h4 class="modal-title">Market Research</h4>

    	        </div>
    	        <div class="modal-body">Loading</div>
    	        <div class="modal-footer">
    	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	        </div>
    	    </div>
    	    <!-- /.modal-content -->
   		</div>
    	<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<div class="col-md-10">
		@foreach($auction as $row)
		@if($row->time > time())
		<div class="panel panel-default">
 		 	<div class="panel-heading"><strong class="panel-title"><a href="http://www.hitwicket.com/player/show/{{ $row->player_id }}" target="_blank">{{ $row->playername}}</span></a></strong>
 		 		<a 
 		 		data-target="#myModal"
 		 		style="color: #000000;"
 		 		href="{{ URL::to('auction/quoteapi')."?".atriFinder($row->age,$row->bowl_type,$row->experience,$row->si,$row->wicket,$row->bat_seam,$row->bat_spin,$row->bowl_main,$row->bowl_var) }}" 
 		 		data-toggle="modal"><div class="pull-right"> Market Research
 		 		<span class="glyphicon glyphicon-globe tooltip1" data-container="body" data-trigger="hover" data-toggle="tooltip" data-placement="bottom" title="Market Research"></span></a></strong></div></div>

  			<div class="panel-body">
  				Owned By <a href="http://hitwicket.com/team/show/{{ $row->team_id }}">{{ $row->teamname }}</a> <br>
   				Age: <strong>{{ round(($row->age / 70) - 0.5)." yrs  ".($row->age % 70)." days"}}</strong> , 
   				Batting Style = <strong>{{ $row->bat_type}}</strong> , 
   				Bowling style = <strong>{{ $row->bowl_type}}</strong> , <br>
   				<span data-toggle="popover" data-trigger="hover" data-original-title="Skill Levels" class="skill_popover skill_{{ $row->experience }}"><strong>{{ Xp_level($row->experience) }}</strong></span> Experince,
   				<span data-toggle="popover" data-trigger="hover" data-original-title="Skill Levels" class="secondary_skill_popover secondary_skill_{{ $row->form }}"><strong>{{ skill_level($row->form) }}</strong></span> Form, 
   				<span data-toggle="popover" data-trigger="hover" data-original-title="Skill Levels" class="secondary_skill_popover secondary_skill_{{ $row->fitness }}"><strong>{{ skill_level($row->fitness) }}</strong></span> Fitness. <br>
   				Skill Index: <strong>{{ number_format($row->si) }}</strong>, 
   				Salary: <strong>{{ number_format($row->salary) }}</strong>.<br><br>
   				<div class="row">
					<div style="display: inline-block" class="col-md-6">
						<table style="margin: 0" class="table">
						<tr>
							<td style="text-align:right; width: 10em">Fielding</td><td style="width: 10em">{{ createBar($row->fielding) }}</td>
						</tr>
						</table>
   					</div>
   					<div style="display: inline-block" class="col-md-6">
   						<table style="margin: 0" class="table">
						<tr>
							<td style="text-align:right; width: 10em">Wicket keeping</td><td style="width: 10em">{{ createBar($row->wicket) }}</td>
						</tr>
						</table>
   					</div>
   				</div>
   				<div class="row">
   					<div style="display: inline-block" class="col-md-6">
   						<table style="margin: 0" class="table">
						<tr>
   						<td style="text-align:right; width: 10em">Batting vs Seam</td><td style="width: 10em">{{ createBar($row->bat_seam) }}</td>
   						</tr>
   						<tr>
   					 	<td style="text-align:right; width: 10em">Batting vs Spin</td><td style="width: 10em">{{ createBar($row->bat_spin) }}</td>
   					 	</tr>
   					 	<tr>
   					 	<?php 
   					 	$stars = (isset($row->bat_stars)) ? ($row->bat_stars) : (stars('batsman', $row->bat_seam, $row->bat_spin, $row->fitness)); 
   					 	?>
   					 	<td style="text-align:right; width: 10em">Batting Rating</td><td colspan=2 style="width: 10em"><span data-toggle="tooltip" data-placement="bottom" title="{{ $stars }} Stars on Sporting Wicket" class="stars" style="width:{{ $stars*20 }}px"></span></td>
   					 	</tr>
						</table>
   					</div>
   					<div style="display: inline-block" class="col-md-6">
   						<table style="margin: 0" class="table">
						<tr>
   					 	<td style="text-align:right; width: 10em">Bowling Main</td><td style="width: 10em">{{ createBar($row->bowl_main) }}</td>
   					 	</tr>
   						<tr>
   					 	<td style="text-align:right; width: 10em">Bowling Variation</td><td style="width: 10em">{{ createBar($row->bowl_var) }}</td>
   					 	</tr>
   					 	<tr>
   					 	<?php 
   					 	//$stars = stars('bowler', $row->bowl_main, $row->bowl_var, $row->fitness, typeFinder($row->bowl_type)); 
   					 	$stars = (isset($row->bowl_stars)) ? ($row->bowl_stars) : (stars('bowler', $row->bowl_main, $row->bowl_var, $row->fitness, typeFinder($row->bowl_type)));
   					 	?>
   					 	<td style="text-align:right; width: 10em">Bowling Rating</td><td colspan=2 style="width: 10em"><span data-toggle="tooltip" data-placement="bottom" title="{{ $stars }} Stars on Sporting Wicket" class="stars" style="width:{{ $stars*20 }}px"></span></td>
   					 	</tr>
						</table>
   					</div>
   				</div>
   				Current Bid: <strong>{{ number_format($row->price) }}</strong> <br>
   				 				Deadline : <strong>{{ date('H:i, D d M, Y',$row->time) }} ({{ abs(round((( $row->time - time())/(60*60)) - 0.5))." hrs ".abs(round(((($row->time - time())%(60*60))/60) - 0.5))." mins" }})</strong>
  			</div>
		</div>
		@endif
		@endforeach
		<div class="center-block"><?php unset($_GET['page']); echo $auction->appends($_GET)->links(); ?></div>
		<div id="popover_content_wrapper" style="display: none">
  			<div style="padding: 9px 14px;">
  				<ol style="padding-left: 1em;" start="0">
		  			<li class="skill_0">Non-existant</li>
		  			<li class="skill_1">Horrible</li>
		  			<li class="skill_2">Hopeless</li>
		  			<li class="skill_3">Useless</li>
		  			<li class="skill_4">Mediocre</li>
		  			<li class="skill_5">Average</li>
		  			<li class="skill_6">Reliable</li>
		  			<li class="skill_7">Accomplished</li>
		  			<li class="skill_8">Remarkable</li>
		  			<li class="skill_9">Brilliant</li>
		  			<li class="skill_10">Exemplary</li>
		  			<li class="skill_11">Prodigious</li>
		  			<li class="skill_12">Fantastic</li>
		  			<li class="skill_13">Magnificent</li>
		  			<li class="skill_14">Masterful</li>
		  			<li class="skill_15">Supreme</li>
		  			<li class="skill_16">Magical</li>
		  			<li class="skill_17">Legendary</li>
		  			<li class="skill_18">Wonderous</li>
		  			<li class="skill_19">Demigod</li>
		  			<li class="skill_20">Titan</li>
				</ol>
			</div>
		</div>
		<div id="popover_content_wrapper_2" style="display: none">
			<ol style="padding-left: 1em;">
				<li class="secondary_skill_1">Hopeless</li>
				<li class="secondary_skill_2">Poor</li>
				<li class="secondary_skill_3">Unreliable</li>
				<li class="secondary_skill_4">Decent</li>
				<li class="secondary_skill_5">Good</li>
				<li class="secondary_skill_6">Superb</li>
			</ol>
		</div>
	</div>

@stop