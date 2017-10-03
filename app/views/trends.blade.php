@extends('layout.main')


@section('content')

<div class="col-md-12">
	<?php
	/*
	<table class="table">
		<thead>
			<tr></tr>
			<tr colspan="8"> Dates </tr>
			<tr>
				<?php $date = date("j"); ?>
				<th></th>
				<th>{{ $date - 7}}</th>
				<th>{{ $date - 6}}</th>
				<th>{{ $date - 5}}</th>
				<th>{{ $date - 4}}</th>
				<th>{{ $date - 3}}</th>
				<th>{{ $date - 2}}</th>
				<th>{{ $date - 1}}</th>
				<th>{{ $date - 0}}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($output as $hour => $days)
				<tr>
					<td>{{$hour}}</td>
					@foreach ($days as $day => $value)
						<td></td>
					@endforeach
				</tr>
			@endforeach
		</tbody>
	</table>
	*/
	?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawVisualization);
      function drawA() {
        var options = {
          title: 'Selling price per Skill Index',
          hAxis: {titleTextStyle: {color: '#333'}},
          curveType: 'function'
        };

        var data = google.visualization.arrayToDataTable({{ $priceVsSi }});
        var chart = new google.visualization.LineChart(document.getElementById('priceVsSi'));
        chart.draw(data, options);

      }
      function drawB() {
        var options = {
          title: 'Selling price Per Hour',
          hAxis: {titleTextStyle: {color: '#333'}},
          curveType: 'function'
        };

        var data2 = google.visualization.arrayToDataTable({{ $priceVsHr }});
        var chart2 = new google.visualization.LineChart(document.getElementById('priceVsHr'));
        chart2.draw(data2, options);
        
        //var data3 = google.visualization.arrayToDataTable({{ $SiVsNo }});
		//var chart3 = new google.visualization.LineChart(document.getElementById('SiVsNo'));
        //chart3.draw(data3, options);
      }
      function drawC() {
        var options = {
          title: 'Skill Index Per Player',
          hAxis: {titleTextStyle: {color: '#333'}},
          curveType: 'function'
        };

        var data3 = google.visualization.arrayToDataTable({{ $SiVsNo }});
		var chart3 = new google.visualization.LineChart(document.getElementById('SiVsNo'));
        chart3.draw(data3, options);
      }

      function drawVisualization() {
        drawA();
        drawB();
        drawC();
	  }

    </script>
    <div class="row"><div id="priceVsSi" class="col-md-11" style="height: 600px"></div></div><hr>
    <div class="row"><div id="priceVsHr" class="col-md-11" style="height: 600px"></div></div><hr>
    <div class="row"><div id="SiVsNo" class="col-md-11" style="height: 600px"></div></div>
</div>

@stop