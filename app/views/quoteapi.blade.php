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



?>
<div class="modal-dialog modal-lg">
 	       <div class="modal-content">
 	           <div class="modal-header">
  	              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    	             <h4 class="modal-title">Market Research</h4>

    	        </div>
    	        <div class="modal-body table-responsive">
    	        	<div style="text-align: center;" class="alert alert-info"><strong>Average Price:</strong> Rs. {{ $avg_price }}</div>
<table class="table table-striped table-condensed">
			<thead>
				<tr>
					<th>Price</th>
					<th>SI</th>
					<th>Age</th>
					<th>Fielding</th>
					<th>Wicket Keeping</th>
					<th>Batting Seam</th>
					<th>Batting Spin</th>
					<th>Bowling Main</th>
					<th>Bowling Variation</th>
				</tr>
			</thead>
			<tbody style="font-size: 0.85em; text-align: center;">
				@foreach($auction as $row)
				<tr>
					<td style="text-align: left;"><strong>Rs. {{ number_format($row->price) }} <?php if($row->status == 0 || $row->checks > 2) { ?><span data-toggle="tooltip" data-placement="bottom" data-title="Auction Not Finished Yet OR The player went Unsold." class="glyphicon glyphicon-time tooltip1"></span><?php } ?></strong></td>
					<td><strong>{{ number_format($row->si) }}</strong></td>
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
    	        <div class="modal-footer">
    	        	<div class="pull-left">
    	        		<span class="glyphicon glyphicon-time"></span> - Auction not finished
    	        	</div>
    	            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    	        </div>
    	    </div>
    	    <!-- /.modal-content -->
   		</div>
   		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49507971-1', 'hwstats.tk');
  ga('send', 'pageview');

</script>