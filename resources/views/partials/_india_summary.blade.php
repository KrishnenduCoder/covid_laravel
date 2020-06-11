<div class="card card-bordered card-full">
    <div class="india-summary-box">
        <div class="card-title">
            <h5 class="box-title">Coronavirus Cases -</h5> <small>INDIA</small>
            {{--<a class="left link-left" target="_blank" href="javascript:void(0)" title="VIEW MORE">VIEW MORE</a>--}}
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-4">
                {{--  CONFIRMED   --}}
                <h6 class="overline-title">CONFIRMED</h6>
                <div class="text-dark2">{{number_format($data['india_summary']['total_confirmed'])}}</div>
            </div>
            <div class="col-lg-4 col-md-4">
                {{--  RECOVERED   --}}
                <h6 class="overline-title">RECOVERED</h6>
                <div class="text-success2">{{number_format($data['india_summary']['total_recovered'])}}</div>
            </div>
            <div class="col-lg-4 col-md-4">
                {{-- DEATHS --}}
                <h6 class="overline-title">DEATHS</h6>
                <div class="text-danger2">{{number_format($data['india_summary']['total_deaths'])}}</div>
            </div>
        </div>
        <hr/>
        {{--  SECOND  --}}
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <h6 class="sub-text">Active Patients</h6>
                <div class="text-dark2">97,799</div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="bordered-box">
                    <ul class="list-group info-list">
                        <li>
                            <div class="dot dot-lg sq bg-primary"></div>
                            <span class="text-sm-generic text-sm-center">NEWLY CONFIRMED</span>
                            <span class="li-num">{{ $data['india_summary']['new_confirmed'] }}</span>
                        </li>
                        <li>
                            <div class="dot dot-lg sq bg-success"></div>
                            <span class="text-sm-generic text-sm-center">NEWLY RECOVERED</span>
                            <span class="li-num">{{ $data['india_summary']['new_recovered'] }}</span>
                        </li>
                        <li>
                            <div class="dot dot-lg sq bg-danger"></div>
                            <span class="text-sm-generic text-sm-center">NEWLY DEATHS</span>
                            <span class="li-num">{{ $data['india_summary']['new_deaths'] }}</span>
                        </li>
                        <li>
                            <div class="dot dot-lg sq bg-danger"></div>
                            <span class="text-sm-generic text-sm-center">TOTAL TESTS</span>
                            <span class="li-num">{{ $data['india_summary']['total_tests'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="box-footer-note">
            <div class="nk-cov-wg-note">RATIO OF <span class="text-primary">RECOVERY ({{ number_format($data['india_summary']['recovery_rate'], 2) }}%) </span> & <span class="text-primary"> DEATHS ({{ number_format($data['india_summary']['death_rate'], 2) }}%)</span></div>
        </div>
    </div>
    <a class="btn btn-sm btn-outline-primary pull-right" href="javascript:void(0)">VIEW DETAILS</a>
</div>