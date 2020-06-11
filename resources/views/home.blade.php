@extends('layouts.app')

@section('title', 'Home')

@section('pageheader')
    <h5 class="page-block-title">COVID-19 Coronavirus Tracker</h5>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            {{--   GLOBAL SUMMARY  --}}
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                @include('partials._global_summary', ['data' => $data])
            </div>
            {{--   GLOBAL SUMMARY : END  --}}
            {{--   GEO CHART  --}}
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card card-bordered card-full">
                    <div class="geo-chart-box" id="geo-chart-box">
                    {{--  GEO-CHART CODE IS IN bottom script section  --}}
                    </div>
                </div>
            </div>
            {{--   GEO CHART : END  --}}
            {{--   INDIA SUMMARY  --}}
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
               @include('partials._india_summary', ['data' => $data])
            </div>
            {{--   INDIA SUMMARY : END  --}}
            {{--   GLOBAL TIME SERIES  --}}
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card card-bordered card-full">
                    <div class="new-cases-box">
                        {{-- DAILY GLOBAL CASES CHART CODE IS IN bottom script section --}}
                        <canvas id="line-chart" width="800" height="850"></canvas>
                    </div>
                </div>
            </div>
            {{--   GLOBAL TIME SERIES : END  --}}
            {{--   NEW CASES TOTAL  --}}
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card card-bordered card-full">
                    <div class="total-new-cases-box">
                        {{-- DAILY TOTAL CASES CHART CODE IS IN bottom script section --}}
                        <canvas id="bar-chart-grouped" width="800" height="810"></canvas>
                    </div>
                </div>
            </div>
            {{--   NEW CASES TOTAL : END  --}}
            {{--   MOST AFFECTED  --}}
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                @include('partials._most_affected', ['data' => $data['most_affected_counties']])
            </div>
            {{--   MOST AFFECTED : END  --}}
            {{--   GLOBAL RATIO  --}}
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                @include('partials._global_ratio', ['data' => $data['global_ratio'], 'enableViewButton' => true])
            </div>
            {{--   GLOBAL RATIO : END  --}}
        </div>
    </div>
@endsection

@section('chartScripts')
    <script type="text/javascript">
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
                labels: <?php echo json_encode($data['global_timeserires']['labels'])?>,
                datasets: [{
                    data: <?php echo json_encode($data['global_timeserires']['infected'])?>,
                    label: "Infected",
                    borderColor: "#559bfb",
                    fill: false
                }, {
                    data: <?php echo json_encode($data['global_timeserires']['deaths'])?>,
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

        // GLOBAL TOTAL CASES
        new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($data['global_total_timeseries']['labels'])?>,
                datasets: [
                    {
                        label: "Active",
                        backgroundColor: "#428bca",
                        data: <?php echo json_encode($data['global_total_timeseries']['active'])?>,
                    }, {
                        label: "Recovered",
                        backgroundColor: "#7cc67c",
                        data: <?php echo json_encode($data['global_total_timeseries']['recovered'])?>,
                    }, {
                        label: "Deaths",
                        backgroundColor: "#ffb3ba",
                        data: <?php echo json_encode($data['global_total_timeseries']['deaths'])?>,
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'New cases, recovered, deaths overtime',
                    responsive: true,
                    maintainAspectRatio: true,
                }
            }
        });
    </script>
@endsection