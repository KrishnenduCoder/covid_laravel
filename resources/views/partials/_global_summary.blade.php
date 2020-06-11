<div class="card card-bordered card-full">
    <div class="global-summary-box">
        <div class="card-title">
            <h5 class="box-title">Coronavirus Cases -</h5> <small>WORLDWIDE</small>
        </div>
        {{--   DISPLAY DATA  --}}
        <div class="nk-cov-data">
            <h6 class="overline-title">Total Confirmed Cases</h6>
            <div class="bg-num">
                {{number_format($data['global_summary']['total_confirmed'])}}
            </div>
        </div>
        {{-- PROGRESS BAR --}}
        <div class="nk-cov-wg1-progress">
            <div class="progress progress-reverse progress-md progress-pill progress-bordered covid-progress">
                <div class="progress-bar bg-danger" data-progress="{{number_format($data['global_summary']['death_rate'], 2)}}" data-toggle="tooltip" title="" data-original-title="Deaths : {{number_format($data['global_summary']['death_rate'], 2)}}%" style="width: {{number_format($data['global_summary']['death_rate'], 2)}}%;"></div>
                <div class="progress-bar bg-success" data-progress="{{number_format($data['global_summary']['recovery_rate'], 2)}}" data-toggle="tooltip" title="" data-original-title="Recovered : {{number_format($data['global_summary']['recovery_rate'], 2)}}%" style="width: {{number_format($data['global_summary']['recovery_rate'], 2)}}%;"></div>
                <div class="progress-bar bg-purple" data-progress="{{number_format($data['global_summary']['active_cases_rate'], 2)}}" data-toggle="tooltip" title="" data-original-title="Active Cases : {{number_format($data['global_summary']['active_cases_rate'], 2)}}%" style="width: {{number_format($data['global_summary']['active_cases_rate'], 2)}}%;" aria-describedby="tooltip50808"></div>
            </div>
        </div>
        {{--  TABLE DATA  --}}
        <div class="nk-tab-data">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td><div class="dot dot-lg sq bg-purple"></div></td>
                        <td class="txt-left text-muted">Active Cases</td>
                        <td class="txt-right text-muted">{{number_format($data['global_summary']['total_active'])}}</td>
                    </tr>
                    <tr>
                        <td><div class="dot dot-lg sq bg-success"></div></td>
                        <td class="txt-left text-muted">Recovered</td>
                        <td class="txt-right text-muted">{{number_format($data['global_summary']['total_recovered'])}}</td>
                    </tr>
                    <tr>
                        <td><div class="dot dot-lg sq bg-danger"></div></td>
                        <td class="txt-left text-muted">Deaths</td>
                        <td class="txt-right text-muted">{{number_format($data['global_summary']['total_deaths'])}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="nk-cov-wg-note">Ratio of <span class="text-primary">Recovery ({{number_format($data['global_summary']['recovery_rate'], 2)}}%)</span> &amp;
            <span class="text-primary">Deaths ({{number_format($data['global_summary']['death_rate'], 2)}}%)</span>
        </div>
    </div>
</div>