@extends('layouts.app')

@section('title', $slug)

@section('pageheader')
    <div class="country-header-box">
        <img class="img-thumbnail" src="{{ $countryData['country_data']['flag_image'] }}" alt="flag-{{ $countryData['country_data']['iso2'] }}" width="30"><span class="page-block-title country-header">{{ $countryData['country_data']['country'] }} - Coronavirus Cases</span>
    </div>
@endsection

@section('content')
    <div class="container country-details-box">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="card card-bordered card-full">
                    {{-- Country Num box --}}
                    <div class="country-num-box">
                        <div class="card-title">
                            <h5 class="box-title">Global Position: <b class="text-danger">{{ $countryData['country_summary']['global_rank'] }}</b></h5>
                        </div>
                        <div class="nk-cov-data">
                            <h6 class="overline-title">Total Confirmed Cases </h6>
                            <div class="bg-num">
                                {{ number_format($countryData['country_summary']['infected']) }}
                            </div>
                        </div>
                        {{-- Row --}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="nk-cov-data">
                                    <h6 class="overline-title-sm">Recovery</h6>
                                    <div class="box-amnt-num text-success2">
                                        {{ number_format($countryData['country_summary']['recovered']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="nk-cov-data">
                                    <h6 class="overline-title-sm">Recovery Rate</h6>
                                    <div class="box-amnt-num text-info2">
                                        {{ number_format($countryData['country_summary']['recovery_rate'], 2) }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <div class="card card-bordered card-full">
                    {{-- Country stat box --}}
                    <div class="country-stat-box">
                        <div class="card-title">
                            <h5 class="box-title">Currently Active Cases</h5>
                        </div>
                        <div class="nk-cov-data">
                            <br/>
                            <div class="bg-num">
                                {{ number_format($countryData['country_summary']['active']) }}
                            </div>
                        </div>
                        {{-- Row --}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="nk-cov-data">
                                    <h6 class="overline-title-sm">Deaths</h6>
                                    <div class="box-amnt-num text-danger2">
                                        {{ number_format($countryData['country_summary']['deaths']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="nk-cov-data">
                                    <h6 class="overline-title-sm">Death Rate</h6>
                                    <div class="box-amnt-num text-info2">
                                        {{ number_format($countryData['country_summary']['death_rate'], 2) }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="card card-bordered card-full">
                    <div class="country-map-box" id="country-map-box"></div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                <div class="card card-bordered card-full">
                    <div class="country-chart-box" id="country-chart-box">
                        <canvas id="bar-chart-grouped" width="800" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('chartScripts')
    <script type="text/javascript">
        var analytics =  <?php echo json_encode($countryData['country_map_data'])?>;

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
                region: '<?php echo $iso2?>',
                keepAspectRatio: true,
                height: 244,
                colorAxis: {colors: ['#b2d5ff', '#66acff', '#3290ff']},
                backgroundColor: '#F5F6FA',
                datalessRegionColor: '#e1e1e1',
                defaultColor: '#f5f5f5',
                
            };

            var chart = new google.visualization.GeoChart(document.getElementById('country-map-box'));

            chart.draw(data, options);
        }

        // Bar chart
        new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($countryData['country_timeline']['labels'])?>,
                datasets: [
                    {
                        label: "Infected",
                        backgroundColor: "#3e95cd",
                        data: <?php echo json_encode($countryData['country_timeline']['infected'])?>,
                    },{
                        label: "Recovered",
                        backgroundColor: "#88d8b0",
                        data: <?php echo json_encode($countryData['country_timeline']['recovered'])?>,
                    },{
                        label: "Deaths",
                        backgroundColor: "#ff6f69",
                        data: <?php echo json_encode($countryData['country_timeline']['deaths'])?>,
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions)'
                }
            }
        });
    </script>
@endsection