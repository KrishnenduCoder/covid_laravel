@extends('layouts.app')

@section('title', 'All Countries')

@section('pageheader')
    <div>
        <h5 class="page-block-title">COVID-19 Coronavirus Tracker</h5>
        <h6 class="sub-text-sm">Confirmed Cases and Deaths by Country, Territory, or Conveyance</h6>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{--  GEO CHART  --}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-bordered card-full">
                    <div class="geo-chart-box" id="geo-chart-box">
                        GEO MAP CHART
                        {{--  GEO-CHART CODE IS IN bottom script section  --}}
                    </div>
                </div>
            </div>
            {{--  GEO CHART:END  --}}
            {{--  GLOBAL RATIO  --}}
            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                @include('partials._global_ratio', ['data' => $data['global_ratio'], 'enableViewButton' => false])
            </div>
            {{--  GLOBAL RATIO:END  --}}
            {{--  LEAST AFFECTED  --}}
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                @include('partials._least_affected', ['data' => $data['least_affected_counties']])
            </div>
            {{--  LEAST AFFECTED:END  --}}
            {{--  GLOBAL LIST  --}}
            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                @include('partials._global_stat_list', ['data' => $data['country_list']])
            </div>
            {{--  GLOBAL LIST:END  --}}
            {{--  TOTAL TIME SERIES CHART  --}}
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-bordered card-full">
                    <div class="new-cases-box">
                        {{-- DAILY GLOBAL CASES CHART CODE IS IN bottom script section --}}
                        <canvas id="line-chart" width="800" height="850"></canvas>
                    </div>
                </div>
            </div>
            {{--  TOTAL TIME SERIES CHART:END  --}}
        </div>
    </div>
@endsection

@section('chartScripts')
    @if(count($data['geo_location_data']) > 0 && count($data['global_total_timeseries']) > 0)
    <script type="text/javascript">
        // Geo location chart
        var analytics =  <?php echo json_encode($data['geo_location_data'])?>;

        google.charts.load('current', {
            'packages':['geochart'],
            // Note: you will need to get a mapsApiKey for your project.
            // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable(analytics);

            var options = {
                keepAspectRatio: true,
                height: 300,
                colorAxis: {colors: ['#b3cde0', '#6497b1', '#005b96', '#03396c', '#011f4b']},
                backgroundColor: '#F5F6FA',
                datalessRegionColor: '#e1e1e1',
                defaultColor: '#f5f5f5',
            };

            var chart = new google.visualization.GeoChart(document.getElementById('geo-chart-box'));

            chart.draw(data, options);
        }

        // Global daily cases
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($data['global_total_timeseries']['labels'])?>,
                datasets: [{
                        data: <?php echo json_encode($data['global_total_timeseries']['active'])?>,
                        label: "Active",
                        borderColor: "#559bfb",
                        fill: false
                    },{
                        data: <?php echo json_encode($data['global_total_timeseries']['recovered'])?>,
                        label: "Recovered",
                        borderColor: "#88d8b0",
                        fill: false
                    },{
                        data: <?php echo json_encode($data['global_total_timeseries']['deaths'])?>,
                        label: "Deaths",
                        borderColor: "#e85347",
                        fill: false
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'DAILY GLOBAL CASES',
                    responsive: true,
                    maintainAspectRatio: true,
                }
            }
        });
    </script>
    @endif
@endsection