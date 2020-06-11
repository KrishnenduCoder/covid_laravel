<div class="card card-bordered card-full">
    <div class="global-ratio-box">
        <div class="card-title">
            <h5 class="box-title">Global Ratio</h5>
            <br/>
            <h6 class="overline-title">Data shown which country are most affected.</h6>
        </div>

        <div class="table-responsive">
            <table class="table table-borderless global-ratio-tab">
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>
                            <img alt="flag-{{ $item['iso2'] }}" src="{{$item['flag_image']}}" width="15">
                            <span class="country-name">
                               <a href="{{ route('country', ['slug' => $item['slug']]) }}">{{ $item['country'] }}</a>
                            </span>
                        </td>
                        <td>
                            <progress id="file" value="{{ number_format($item['ratio'], 2) }}" max="100" title="{{ number_format($item['ratio'], 2) }}%"> {{ number_format($item['ratio'], 2) }}% </progress>
                        </td>
                        <td>
                            {{ number_format($item['confirmed']) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if($enableViewButton)
        <a class="btn btn-sm btn-outline-primary pull-right" href="{{ url('/all-countries') }}">VIEW ALL</a>
    @endif
</div>