<div class="card card-bordered card-full">
    <div class="global-list-box">
        <div class="table-responsive">
            <table id="allcountry-stat-list">
                <thead>
                    <tr>
                        <th>COUNTRY</th>
                        <th>INFECTED</th>
                        <th>RECOVERED</th>
                        <th>DEATHS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                <img alt="flag-{{ $item['iso2'] }}" src="{{$item['flag_image']}}" width="15">
                                <span class="country-name">
                                    <a href="{{ route('country', ['slug' => $item['slug']]) }}">{{ $item['country'] }}</a>
                                </span>
                            </td>
                            <td>{{ number_format($item['confirmed']) }}</td>
                            <td>{{ number_format($item['recovered']) }}</td>
                            <td>{{ number_format($item['deaths']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
