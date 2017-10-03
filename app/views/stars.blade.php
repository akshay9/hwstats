@extends('layout.main')

@section('content')
<?php

function isPresent($field, $value){
	if (Input::get($field) !== NULL && Input::get($field) == $value) {
		return "selected";
	} else {
		return "";
	}
}

?>
	<script type="text/javascript">
	function typeSelectedResult (type) {
		var selector = "<option value=\"0\">non-existent</option><option value=\"1\">Horrible</option><option value=\"2\">Hopeless</option><option value=\"3\">Useless</option><option value=\"4\">Mediocre</option><option value=\"5\">Average</option><option value=\"6\">Reliable</option><option value=\"7\">Accomplished</option><option value=\"8\">Remarkable</option><option value=\"9\">Brilliant</option><option value=\"10\">Exemplary</option><option value=\"11\">Prodigious</option><option value=\"12\">Fantastic</option><option value=\"13\">Magnificent</option><option value=\"14\">Masterful</option> <option value=\"15\">Supreme</option><option value=\"16\">Magical</option><option value=\"17\">Legendary</option> <option value=\"18\">Wonderous</option><option value=\"19\">Demigod</option><option value=\"20\">Titan</option></select>";

		

		if (type == "batsman") {

			
			$("#row1").html("<td>Batting vs Spin</td><td><select style=\"width: 20em\" name=\"atri_1\" id=\"atri_1\" class=\"form-control\">" + selector + "</td><td>Batting vs Seam</td><td><select style=\"width: 20em\" name=\"atri_2\" id=\"atri_2\" class=\"form-control\">" + selector + "</td>");
			$("#row2").html("");
			$("#tr-submit").html("<td colspan=4><button  class=\"btn btn-success\" type=\"submit\">Submit</button></td>");

			
		} else if(type == "bowler"){

			
			$("#row1").html("<td>Bowling Main</td><td><select style=\"width: 20em\" name=\"atri_1\" id=\"atri_1\" class=\"form-control\">" + selector + "</td><td>Bowling Variation</td><td><select style=\"width: 20em\" name=\"atri_2\" id=\"atri_2\" class=\"form-control\">" + selector + "</td>");
			$("#row2").html("<td>Bowler Type</td><td><select style=\"width: 20em\" name=\"type2\" id=\"type2\" class=\"form-control\"><option value=\"spin\">Spin Bowler</option><option value=\"seam\">Seam Bowler</option></select></td>");
			$("#tr-submit").html("<td colspan=4><button  class=\"btn btn-success\" type=\"submit\">Submit</button></td>");
		} else {

			$("#row1").html("");
			$("#row2").html("");
			$("#tr-submit").html("");
		}
	}
	</script>
	<div class="col-md-12">
		<h2  style="text-align: center">Star Calculator</h2><br>
		<div class="well well-lg table-responsive">
			<form action="{{ URL::to('stars') }}" method="get">
				<table class="table">
					<tbody id="typeSelected">
						<tr>
							<td>Type</td> 
							<td>
								<select style="width: 20em" onchange="typeSelectedResult(this.value)" name="type" id="type" class="form-control">
									    <option value="">Player Type</option>
									    <option value="batsman"{{ isPresent('type', 'batsman') }}>Batsman</option>
									    <option value="bowler" {{ isPresent('type', 'bowler') }}>Bowler</option>
								</select>
							</td>
							<td>Fitness</td>
							<td>
								<select style="width: 20em" name="fitness" id="fitness" class="form-control">
									    <option value="1" {{ isPresent('fitness', '1') }}>Hopeless</option>
									    <option value="2" {{ isPresent('fitness', '2') }}>Poor</option>
									    <option value="3" {{ isPresent('fitness', '3') }}>Unreliable</option>
									    <option value="4" {{ isPresent('fitness', '4') }}>Decent</option>
									    <option value="5" {{ isPresent('fitness', '5') }}>Good</option>
									    <option value="6" {{ isPresent('fitness', '6') }}>Superb</option>
								</select>
							</td>
						</tr>

						<tr>
							<td>Expierence</td> 
							<td>
								<select style="width: 20em" name="xp" id="xp" class="form-control">
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
							<td>Form</td>
							<td>
								<select style="width: 20em" name="form" id="form" class="form-control">
									    <option value="1" {{ isPresent('form', '1') }}>Hopeless</option>
									    <option value="2" {{ isPresent('form', '2') }}>Poor</option>
									    <option value="3" {{ isPresent('form', '3') }}>Unreliable</option>
									    <option value="4" {{ isPresent('form', '4') }}>Decent</option>
									    <option value="5" {{ isPresent('form', '5') }}>Good</option>
									    <option value="6" {{ isPresent('form', '6') }}>Superb</option>
								</select>
							</td>
						</tr>
						<!--<div id="typeSelected">-->
							<?php 

								if($stars['isset'] === TRUE){
									if(Input::get('type2') === NULL){
									?>
									<tr id="row1">
										<td>Batting vs Spin</td> 
										<td>
										<select style="width: 20em" name="atri_1" id="atri_1" class="form-control">
							                <option value="0" {{ isPresent('atri_1', 0) }}>non-existent</option>
							                <option value="1"  {{ isPresent('atri_1', 1) }}>Horrible</option>
							                <option value="2"  {{ isPresent('atri_1', 2) }}>Hopeless</option>
							                <option value="3"  {{ isPresent('atri_1', 3) }}>Useless</option>
							                <option value="4"  {{ isPresent('atri_1', 4) }}>Mediocre</option>
							                <option value="5"  {{ isPresent('atri_1', 5) }}>Average</option>
							                <option value="6"  {{ isPresent('atri_1', 6) }}>Reliable</option>
							                <option value="7"  {{ isPresent('atri_1', 7) }}>Accomplished</option>
							                <option value="8"  {{ isPresent('atri_1', 8) }}>Remarkable</option>
							                <option value="9"  {{ isPresent('atri_1', 9) }}>Brilliant</option>
							                <option value="10"  {{ isPresent('atri_1', 10) }}>Exemplary</option>
							                <option value="11"  {{ isPresent('atri_1', 11) }}>Prodigious</option>
							                <option value="12"  {{ isPresent('atri_1', 12) }}>Fantastic</option>
							                <option value="13"  {{ isPresent('atri_1', 13) }}>Magnificent</option>
							                <option value="14"  {{ isPresent('atri_1', 14) }}>Masterful</option>
							                <option value="15"  {{ isPresent('atri_1', 15) }}>Supreme</option>
							                <option value="16"  {{ isPresent('atri_1', 16) }}>Magical</option>
							                <option value="17"  {{ isPresent('atri_1', 17) }}>Legendary</option>
							                <option value="18"  {{ isPresent('atri_1', 18) }}>Wonderous</option>
							                <option value="19"  {{ isPresent('atri_1', 19) }}>Demigod</option>
							                <option value="20"  {{ isPresent('atri_1', 20) }}>Titan</option>
										</select>
										</td>
										<td>Batting vs Seam</td> 
										<td>
										<select style="width: 20em" name="atri_2" id="atri_2" class="form-control">
							                <option value="0" {{ isPresent('atri_2', 0) }}>non-existent</option>
							                <option value="1"  {{ isPresent('atri_2', 1) }}>Horrible</option>
							                <option value="2"  {{ isPresent('atri_2', 2) }}>Hopeless</option>
							                <option value="3"  {{ isPresent('atri_2', 3) }}>Useless</option>
							                <option value="4"  {{ isPresent('atri_2', 4) }}>Mediocre</option>
							                <option value="5"  {{ isPresent('atri_2', 5) }}>Average</option>
							                <option value="6"  {{ isPresent('atri_2', 6) }}>Reliable</option>
							                <option value="7"  {{ isPresent('atri_2', 7) }}>Accomplished</option>
							                <option value="8"  {{ isPresent('atri_2', 8) }}>Remarkable</option>
							                <option value="9"  {{ isPresent('atri_2', 9) }}>Brilliant</option>
							                <option value="10"  {{ isPresent('atri_2', 10) }}>Exemplary</option>
							                <option value="11"  {{ isPresent('atri_2', 11) }}>Prodigious</option>
							                <option value="12"  {{ isPresent('atri_2', 12) }}>Fantastic</option>
							                <option value="13"  {{ isPresent('atri_2', 13) }}>Magnificent</option>
							                <option value="14"  {{ isPresent('atri_2', 14) }}>Masterful</option>
							                <option value="15"  {{ isPresent('atri_2', 15) }}>Supreme</option>
							                <option value="16"  {{ isPresent('atri_2', 16) }}>Magical</option>
							                <option value="17"  {{ isPresent('atri_2', 17) }}>Legendary</option>
							                <option value="18"  {{ isPresent('atri_2', 18) }}>Wonderous</option>
							                <option value="19"  {{ isPresent('atri_2', 19) }}>Demigod</option>
							                <option value="20"  {{ isPresent('atri_2', 20) }}>Titan</option>
										</select>
										</td>
									</tr>
									<tr id="row2"></tr>
									<tr  id="tr-submit" style="text-align: center">
										<td colspan=4>
											<button  class="btn btn-success" type="submit">Submit</button>
										</td>
									</tr>
									<?php
									} else {
										?>
										<tr id="row1">
										<td>Bowling Main</td> 
										<td>
										<select style="width: 20em" name="atri_1" id="atri_1" class="form-control">
							                <option value="0" {{ isPresent('atri_1', 0) }}>non-existent</option>
							                <option value="1"  {{ isPresent('atri_1', 1) }}>Horrible</option>
							                <option value="2"  {{ isPresent('atri_1', 2) }}>Hopeless</option>
							                <option value="3"  {{ isPresent('atri_1', 3) }}>Useless</option>
							                <option value="4"  {{ isPresent('atri_1', 4) }}>Mediocre</option>
							                <option value="5"  {{ isPresent('atri_1', 5) }}>Average</option>
							                <option value="6"  {{ isPresent('atri_1', 6) }}>Reliable</option>
							                <option value="7"  {{ isPresent('atri_1', 7) }}>Accomplished</option>
							                <option value="8"  {{ isPresent('atri_1', 8) }}>Remarkable</option>
							                <option value="9"  {{ isPresent('atri_1', 9) }}>Brilliant</option>
							                <option value="10"  {{ isPresent('atri_1', 10) }}>Exemplary</option>
							                <option value="11"  {{ isPresent('atri_1', 11) }}>Prodigious</option>
							                <option value="12"  {{ isPresent('atri_1', 12) }}>Fantastic</option>
							                <option value="13"  {{ isPresent('atri_1', 13) }}>Magnificent</option>
							                <option value="14"  {{ isPresent('atri_1', 14) }}>Masterful</option>
							                <option value="15"  {{ isPresent('atri_1', 15) }}>Supreme</option>
							                <option value="16"  {{ isPresent('atri_1', 16) }}>Magical</option>
							                <option value="17"  {{ isPresent('atri_1', 17) }}>Legendary</option>
							                <option value="18"  {{ isPresent('atri_1', 18) }}>Wonderous</option>
							                <option value="19"  {{ isPresent('atri_1', 19) }}>Demigod</option>
							                <option value="20"  {{ isPresent('atri_1', 20) }}>Titan</option>
										</select>
										</td>
										<td>Bowlling Variation</td> 
										<td>
										<select style="width: 20em" name="atri_2" id="atri_2" class="form-control">
							                <option value="0" {{ isPresent('atri_2', 0) }}>non-existent</option>
							                <option value="1"  {{ isPresent('atri_2', 1) }}>Horrible</option>
							                <option value="2"  {{ isPresent('atri_2', 2) }}>Hopeless</option>
							                <option value="3"  {{ isPresent('atri_2', 3) }}>Useless</option>
							                <option value="4"  {{ isPresent('atri_2', 4) }}>Mediocre</option>
							                <option value="5"  {{ isPresent('atri_2', 5) }}>Average</option>
							                <option value="6"  {{ isPresent('atri_2', 6) }}>Reliable</option>
							                <option value="7"  {{ isPresent('atri_2', 7) }}>Accomplished</option>
							                <option value="8"  {{ isPresent('atri_2', 8) }}>Remarkable</option>
							                <option value="9"  {{ isPresent('atri_2', 9) }}>Brilliant</option>
							                <option value="10"  {{ isPresent('atri_2', 10) }}>Exemplary</option>
							                <option value="11"  {{ isPresent('atri_2', 11) }}>Prodigious</option>
							                <option value="12"  {{ isPresent('atri_2', 12) }}>Fantastic</option>
							                <option value="13"  {{ isPresent('atri_2', 13) }}>Magnificent</option>
							                <option value="14"  {{ isPresent('atri_2', 14) }}>Masterful</option>
							                <option value="15"  {{ isPresent('atri_2', 15) }}>Supreme</option>
							                <option value="16"  {{ isPresent('atri_2', 16) }}>Magical</option>
							                <option value="17"  {{ isPresent('atri_2', 17) }}>Legendary</option>
							                <option value="18"  {{ isPresent('atri_2', 18) }}>Wonderous</option>
							                <option value="19"  {{ isPresent('atri_2', 19) }}>Demigod</option>
							                <option value="20"  {{ isPresent('atri_2', 20) }}>Titan</option>
										</select>
										</td>
									</tr>
									<tr id="row2">
										<td>Bowler Type</td>
										<td>
											<select style="width: 20em" name="type2" id="type2" class="form-control">
							                <option value="spin" {{ isPresent('type2', 'spin') }}>Spin Bowler</option>
							                <option value="seam"  {{ isPresent('type2', 'seam') }}>Seam Bowler</option>
										</select>
										</td>
									</tr>
									<tr id="tr-submit" style="text-align: center">
										<td colspan=4>
											<button class="btn btn-success" type="submit">Submit</button>
										</td>
									</tr>
									<?php
									}
								} else {
									?>
									<tr id="row1"></tr>
									<tr id="row2"></tr>
									<tr id="tr-submit" style="text-align: center"></tr>
									<?php
								}
							?>
						<!--</div>-->
					</tbody>
				</table>
			</form>
		</div>
		<?php if($stars['isset'] === TRUE){
			?>
		<div class="row">
			<table class="table table-striped">
				<thead>
					<tr>
						<td>Pitch</td><td style="width: 60em">
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Sporting</td>
						<td><span data-toggle="tooltip" data-placement="bottom" title="{{ $stars['sporting'] }} Stars" class="stars" style="width: {{ $stars['sporting']*20 }}px"></span></td>
					</tr>
					<tr>
						<td>Crumbling</td>
						<td><span data-toggle="tooltip" data-placement="bottom" title="{{ $stars['crumbling'] }} Stars" class="stars" style="width: {{ $stars['crumbling']*20 }}px"></span></td>
					</tr>
					<tr>
						<td>Green</td>
						<td><span data-toggle="tooltip" data-placement="bottom" title="{{ $stars['green'] }} Stars" class="stars" style="width: {{ $stars['green']*20 }}px"></span></td>
					</tr>
					<tr>
						<td>Flat</td>
						<td><span data-toggle="tooltip" data-placement="bottom" title="{{ $stars['flat'] }} Stars" class="stars" style="width: {{ $stars['flat']*20 }}px"></span></td>
					</tr>
				</tbody>
			</table>
		</div>
		<?php } ?>
	</div>

@stop