<meta name="_token" content="{!! csrf_token() !!}"/>
@extends('layouts.backend')
<script src="{{url('/assets/jQuery/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
@section('breadcrumb')
<a class="navbar-brand" href="#">Home</a>
@endsection('breadcrumb')
@section('content')
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <!-- TEXT -->
              </div>
              <div class="card-body ">
                <div id="map" class="map"></div>
              </div>
            </div>
          </div>
        </div>
@endsection('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $("#home").addClass("active");
      
    });
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var today = new Date();
  var mm = today.getMonth()+1; //January is 0!
  const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
  var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time of Day');
        data.addColumn('number', 'Bath / day');
    
        data.addRows(<?php echo $list; ?>);


        var options = {
          title: 'Spending Rate in '+monthNames[mm],
          hAxis: {
            format: 'M/d/yy',
            gridlines: {count: 8}
          },
          vAxis: {
            gridlines: {color: 'none'},
            minValue: 0
          }
        };

        var chart = new google.visualization.LineChart(document.getElementById('map'));

        chart.draw(data, options);

        var button = document.getElementById('change');
}
</script>
