<?php
namespace App\Http\Controllers;

use App\lib\CovidApi;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    const CACHE_TIME = 30;

    /**
     * This function serves the purpose of our home page
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $data = Cache::get('homePageData');

        if(!$data)
        {
            $covidLib = new CovidApi();

            // Global summary
            $globalSummaryArr = $covidLib->apiGET('global-summary');

            // Geo location summary
            $geoLocationArr = $covidLib->apiGET('geolocation-summary');

            // India summary
            $indiaSummaryArr = $covidLib->apiGET('india-summary');

            // Global time series
            $globalTimeSeriesArr = $covidLib->apiGET('global-timeseries');

            // Global total time series
            $globalTotalTimeSeriesArr = $covidLib->apiGET('global-total-timeseries');

            // Most affected countries
            $mostAffectedArr = $covidLib->apiGET('most-affected-countries');

            // Global ratio
            $globalRatioArr = $covidLib->apiGET('global-ratio');

            $data = [
                'global_summary' => ($globalSummaryArr) ? $globalSummaryArr : array(),
                'geo_location_data' => ($geoLocationArr) ? $geoLocationArr : array(),
                'india_summary' => ($indiaSummaryArr) ? $indiaSummaryArr : array(),
                'global_timeserires' => ($globalTimeSeriesArr) ? $globalTimeSeriesArr : array(),
                'global_total_timeseries' => ($globalTotalTimeSeriesArr) ? $globalTotalTimeSeriesArr[0] : array(),
                'most_affected_counties' => ($mostAffectedArr) ? $mostAffectedArr : array(),
                'global_ratio' => ($globalRatioArr) ? $globalRatioArr : array(),
            ];

            if(count(array_filter($data)) > 0) Cache::add('homePageData', $data, now()->addMinutes(self::CACHE_TIME));
        }

        return response()->view('home', ['data' => $data], 200);
    }

    /**
     * This function serves the details page of a country
     *
     * @param [type] $slug
     * @return void
     */
    public function country($slug)
    {
        $slug = strtolower($slug);

        if($slug === 'india') return redirect('india');
        else
        {
            $covidLib = new CovidApi();

            // Country data
            $countryDataArr = $covidLib->apiGET('country-data', $slug);

            if($countryDataArr)
            {
                // Country timeline
                $countryTimeDataArr = $covidLib->apiGET('country-timeline-data', $slug);

                // Country summary
                $countrySummaryArr = $covidLib->apiGET('country-summary', $slug);

                if($countrySummaryArr) $countryMapData =  array(
                    array(
                        'Country',
                        'Infected',
                        'Deaths'
                    ),
                    array(
                        $countryDataArr['iso2'],
                        $countrySummaryArr['infected'],
                        $countrySummaryArr['deaths']
                    )
                );
                else $countryMapData = array(
                    array(
                        'Country',
                        'Infected',
                        'Deaths'
                    ),
                    array(
                        'world',
                        0,
                        0
                    )
                );

                $countryData = [
                    'country_data' => $countryDataArr,
                    'country_timeline' => $countryTimeDataArr,
                    'country_summary' => $countrySummaryArr,
                    'country_map_data' => $countryMapData,
                ];

                return response()->view('country_single', ['slug' => $slug, 'iso2' => $countryDataArr['iso2'], 'countryData' => $countryData], 200);
            }
            else
            {
                abort(404);
            }
        }
    }

    public function india()
    {
        echo "THIS PAGE IS FOR INDIA";
    }

    /**
     * This function serves the functionality of all country page
     *
     * @return void
     */
    public function allCountries()
    {
        $data = Cache::get('allCountriesData');

        if(!$data)
        {
            $covidLib = new CovidApi();

            // Geo location summary
            $geoLocationArr = $covidLib->apiGET('geolocation-summary');

            // Global ratio
            $globalRatioArr = $covidLib->apiGET('global-ratio');

            // Global total time series
            $globalTotalTimeSeriesArr = $covidLib->apiGET('global-total-timeseries');

            // Least affected countries
            $leastAffectedCountries = $covidLib->apiGET('least-affected-countries');

            // Global stat list
            $globalStatList = $covidLib->apiGET('global-stat-list');

            $data = array(
                'geo_location_data' => ($geoLocationArr) ? $geoLocationArr : array(),
                'global_ratio' => ($globalRatioArr) ? $globalRatioArr : array(),
                'global_total_timeseries' => ($globalTotalTimeSeriesArr) ? $globalTotalTimeSeriesArr[0] : array(),
                'least_affected_counties' => ($leastAffectedCountries) ? $leastAffectedCountries : array(),
                'country_list' => ($globalStatList) ? $globalStatList : array()
            );

            if(count(array_filter($data)) > 0) Cache::add('allCountriesData', $data, now()->addMinutes(self::CACHE_TIME));
        }
   
        return response()->view('all_countries', ['data' => $data], 200);
    }
}
