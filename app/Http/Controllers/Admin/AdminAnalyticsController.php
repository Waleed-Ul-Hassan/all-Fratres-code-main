<?php

namespace App\Http\Controllers\Admin;

use Analytics;
use App;
use App\Http\Controllers\Controller;
use Config;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Request;
use Spatie\Analytics\Period;

class AdminAnalyticsController extends Controller
{

    public function index(Request $request) {


            $days = 6;
            if (isset($_GET['days']) && $_GET['days'] != '') {
                $days = $_GET['days'];

            }

            if (isset($_GET['startDate']) && $_GET['startDate'] != '' || isset($_GET['endDate']) && $_GET['endDate'] != '') {
                $start_date = $_GET['startDate'];
                $endDate = $_GET['endDate'];
                $start_date = new \DateTime($start_date);
                $endDate = new \DateTime($endDate);

                $bounce_rate = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:bounceRate',
                    [

                    ]
                );


                $sessions = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:sessions',
                    [

                    ]
                );

                $sessionDuration = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:avgSessionDuration',
                    [

                    ]
                );

                $users = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:users',
                    [

                    ]
                );

                $returnedUsers = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:users',
                    [
                        'dimensions' => 'ga:userType'
                    ]
                );

                $country = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:sessions',
                    [
                        'dimensions' => 'ga:country'
                    ]
                );


                $country = $country->rows;
                if ($country)
                {
                    foreach ($country as $value) {

                        $val[] = [$value[0], (int)$value[1]];

                    }
                }

                $locations = ['Country', 'Popularity'];

                array_unshift($val, $locations);

                $country = json_encode($val);

                $devices = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:sessions',
                    [
                        'dimensions' => 'ga:deviceCategory'
                    ]
                );

                $devicess = $devices->rows;

                foreach ($devices as $device1) {

                    $device2[] = [$device1[0], (int)$device1[1]];

                }

                $device1 = ['Effort', 'Amount given'];

                array_unshift($device2, $device1);

                $devices = json_encode($device2);

                $pageTracking = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:pageValue',
                    [
                        'dimensions' => 'ga:pagePath,ga:pageTitle'
                    ]
                );



                $visitorsDataa = Analytics::performQuery(
                    Period::months(12),
                    'ga:users',
                    [
                        'dimensions' => 'ga:date'
                    ]
                );

                $mobileUsers = collect($visitorsDataa['rows'] ?? [])->map(function (array $dateRow) {
                    return [
                        'date' => Carbon::createFromFormat('Ymd', $dateRow[0]),
                        'users' => (int) $dateRow[1]
                    ];
                });

                foreach ($mobileUsers as $key => $value){
                    $mobileUsersDate[] = $value['date']->format('d-M');
                    $mobileUsersUsers[] = $value['users'];

                }

                $mobileUsersDate = json_encode($mobileUsersDate);
                $mobileUser = json_encode($mobileUsersUsers);



                //retrieve visitors and pageview data for the current day and the last seven days
                $pagevisitors = $this->fetchVisitorsAndPageViewsExtended(Period::create($start_date, $endDate));

                //retrieve visitors and pageviews since the 6 months ago
                $visitedPages = Analytics::fetchMostVisitedPages(Period::create($start_date, $endDate), 50);

                $refererrs = Analytics::fetchTopReferrers(Period::create($start_date, $endDate), 50);

                $topBrowsers = Analytics::fetchTopBrowsers(Period::create($start_date, $endDate));

                $countries = $this->fetchVisitorsCountry(Period::create($start_date, $endDate));

                $topBrowsers_names = $topBrowsers->pluck('browser')->toArray();
                $topBrowsers_data = $topBrowsers->pluck('sessions')->toArray();
                $topBrowsers_data = implode(",", $topBrowsers_data);

                $output = '';
                foreach ($topBrowsers_names as $topBrowser) {
                    $output .= '"' . $topBrowser . '",';
                }
                $topBrowsers = $output;

                $timeUsers = Analytics::performQuery(
                    Period::create($start_date, $endDate),
                    'ga:users',
                    [
                        'dimensions' => 'ga:sourceMedium'
                    ]
                );
                return view('admin.analytics.index', compact('mobileUser', 'mobileUsersDate','devicess','devices','country', 'sessionDuration', 'visitedPages', 'pagevisitors', 'topBrowsers', 'topBrowsers_data', 'topBrowsers_names', 'sessions', 'refererrs', 'bounce_rate', 'countries', 'users', 'returnedUsers'));

            }

        $bounce_rate = Analytics::performQuery(
            Period::days($days),
            'ga:bounceRate',
            [

            ]
        );


        $sessions = Analytics::performQuery(
            Period::days($days),
            'ga:sessions',
            [

            ]
        );

        $sessionDuration = Analytics::performQuery(
            Period::days($days),
            'ga:avgSessionDuration',
            [

            ]
        );

        $users = Analytics::performQuery(
            Period::days($days),
            'ga:users',
            [

            ]
        );

        $returnedUsers = Analytics::performQuery(
            Period::days($days),
            'ga:users',
            [
                'dimensions' => 'ga:userType'
            ]
        );

        $country = Analytics::performQuery(
            Period::days($days),
            'ga:sessions',
            [
                'dimensions' => 'ga:country'
            ]
        );
        $country = $country->rows;
        if ($country)
        {
            foreach ($country as $value) {

                $val[] = [$value[0], (int)$value[1]];

            }
        }

        $locations = ['Country', 'Popularity'];

        array_unshift($val, $locations);

        $country = json_encode($val);

        $devices = Analytics::performQuery(
            Period::days($days),
            'ga:sessions',
            [
                'dimensions' => 'ga:deviceCategory'
            ]
        );

        $devicess = $devices->rows;

        foreach ($devices as $device1) {

            $device2[] = [$device1[0], (int)$device1[1]];

        }

        $device1 = ['Effort', 'Amount given'];

        array_unshift($device2, $device1);

        $devices = json_encode($device2);

        $pageTracking = Analytics::performQuery(
            Period::days($days),
            'ga:pageValue',
            [
                'dimensions' => 'ga:pagePath,ga:pageTitle'
            ]
        );



        $visitorsDataa = Analytics::performQuery(
            Period::months(12),
            'ga:users',
            [
                'dimensions' => 'ga:date'
            ]
        );

        $mobileUsers = collect($visitorsDataa['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0]),
                'users' => (int) $dateRow[1]
            ];
        });

        foreach ($mobileUsers as $key => $value){
            $mobileUsersDate[] = $value['date']->format('d-M');
            $mobileUsersUsers[] = $value['users'];

        }

        $mobileUsersDate = json_encode($mobileUsersDate);
        $mobileUser = json_encode($mobileUsersUsers);


        //retrieve visitors and pageview data for the current day and the last seven days
        $pagevisitors = $this->fetchVisitorsAndPageViewsExtended(Period::days($days));

        //retrieve visitors and pageviews since the 6 months ago
        $visitedPages = Analytics::fetchMostVisitedPages(Period::days($days), 50);

        $refererrs = Analytics::fetchTopReferrers(Period::days($days), 50);

        $topBrowsers = Analytics::fetchTopBrowsers(Period::days($days));

        $countries = $this->fetchVisitorsCountry(Period::days($days));

        $topBrowsers_names = $topBrowsers->pluck('browser')->toArray();
        $topBrowsers_data = $topBrowsers->pluck('sessions')->toArray();
        $topBrowsers_data = implode(",", $topBrowsers_data);

        $output = '';
        foreach ($topBrowsers_names as $topBrowser) {
            $output .= '"' . $topBrowser . '",';
        }
        $topBrowsers = $output;

        $timeUsers = Analytics::performQuery(
            Period::days($days),
            'ga:users',
            [
                'dimensions' => 'ga:sourceMedium'
            ]
        );

            return view('admin.analytics.index', compact('mobileUser', 'mobileUsersDate','devicess','devices','country', 'sessionDuration', 'visitedPages', 'pagevisitors', 'topBrowsers', 'topBrowsers_data', 'topBrowsers_names', 'sessions', 'refererrs', 'bounce_rate', 'countries', 'users', 'returnedUsers'));



    }

    public function locationOverview(Request $request) {

        $days = 7;
        if (isset($_GET['days']) && $_GET['days'] != '') {
            $days = $_GET['days'];
        }
        if (isset($_GET['startDate']) && $_GET['startDate'] != '' || isset($_GET['endDate']) && $_GET['endDate'] != '') {
            $start_date = $_GET['startDate'];
            $endDate = $_GET['endDate'];
            $start_date = new \DateTime($start_date);
            $endDate = new \DateTime($endDate);

            $city = Analytics::performQuery(
                Period::create($start_date, $endDate),
                'ga:sessions',
                [
                    'metrics' => 'ga:users,ga:newUsers,ga:sessions,ga:bounceRate,ga:pageviewsPerSession,ga:avgSessionDuration',
                    'dimensions' => 'ga:country,ga:city'
                ]
            );

            foreach ($city as $value) {

                $val[] = [(float)$value[6], (float)$value[3],$value[1].':'.$value[2]];

            }

            $locations = ['Lat', 'Long', 'Name'];

            array_unshift($val, $locations);

            $cities = json_encode($val);

//            echo '<pre>';
//print_r($cities);
            return view('admin.analytics.location-overview', compact('city', 'cities'));


        }

        $city = Analytics::performQuery(
            Period::days($days),
            'ga:sessions',
            [
                'metrics' => 'ga:users,ga:newUsers,ga:sessions,ga:bounceRate,ga:pageviewsPerSession,ga:avgSessionDuration',
                'dimensions' => 'ga:country,ga:city'
            ]
        );

        foreach ($city as $value) {

            $val[] = [(float)$value[6], (float)$value[3],$value[1].':'.$value[2]];

        }

        $locations = ['Lat', 'Long', 'Name'];

        array_unshift($val, $locations);

        $cities = json_encode($val);


        return view('admin.analytics.location-overview', compact('city', 'cities'));

    }

    public function mobileOverview(Request $request) {

        $days = 7;
        if (isset($_GET['days']) && $_GET['days'] != '') {
            $days = $_GET['days'];
        }
        if (isset($_GET['startDate']) && $_GET['startDate'] != '' || isset($_GET['endDate']) && $_GET['endDate'] != '') {
            $days = Carbon::parse($_GET['startDate'])->diffInDays(Carbon::parse($_GET['endDate']));
        }

        $devices = Analytics::performQuery(
            Period::days($days),
            'ga:sessions',
            [
                'metrics' => 'ga:users,ga:newUsers,ga:sessions,ga:bounceRate,ga:pageviewsPerSession,ga:avgSessionDuration',
                'dimensions' => 'ga:deviceCategory'
            ]
        );

        $visitorsDataa = Analytics::performQuery(
            Period::days($days),
            'ga:users',
            [
                'dimensions' => 'ga:date'
            ]
        );
        $mobileUsers = collect($visitorsDataa['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0]),
                'users' => (int) $dateRow[1]
            ];
        });

        foreach ($mobileUsers as $key => $value){
            $mobileUsersDate[] = $value['date']->format('d-M');
            $mobileUsersUsers[] = $value['users'];

        }

        $mobileUsersDate = json_encode($mobileUsersDate);
        $mobileUser = json_encode($mobileUsersUsers);


        return view('admin.analytics.mobile-overview', compact('devices','mobileUsersDate','mobileUser'));

    }

    public function pagesReport(Request $request) {

        $days = 7;
        if (isset($_GET['days']) && $_GET['days'] != '') {
            $days = $_GET['days'];
        }
        if (isset($_GET['startDate']) && $_GET['startDate'] != '' || isset($_GET['endDate']) && $_GET['endDate'] != '') {
            $days = Carbon::parse($_GET['startDate'])->diffInDays(Carbon::parse($_GET['endDate']));
        }

        $extendedVisitedPages = Analytics::extendedFetchMostVisitedPages(Period::days($days), 50);

        $extendedVisitedPagesCount = Analytics::performQuery(
            Period::days($days),
            'ga:pageviews,ga:pageValue,ga:uniquePageviews,ga:avgTimeOnPage,ga:entrances,ga:bounceRate,ga:exitRate',
            [
                'dimensions' => 'ga:pagePath'
            ]
        );

        $visitorsDataa = Analytics::performQuery(
            Period::days($days),
            'ga:pageviews',
            [
                'dimensions' => 'ga:date'
            ]
        );
        $mobileUsers = collect($visitorsDataa['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0]),
                'pageviews' => (int) $dateRow[1]
            ];
        });

        foreach ($mobileUsers as $key => $value){
            $mobileUsersDate[] = $value['date']->format('d-M');
            $mobileUsersUsers[] = $value['pageviews'];

        }

        $mobileUsersDate = json_encode($mobileUsersDate);
        $mobileUser = json_encode($mobileUsersUsers);




        return view('admin.analytics.pages-view-detail', compact('extendedVisitedPages','extendedVisitedPagesCount','mobileUsersDate','mobileUser'));

    }

    public function test_analytics() {
        //retrieve visitors and pageview data for the current day and the last seven days
        $pagevisitors = Analytics::fetchVisitorsAndPageViews(Period::days(15));

        //retrieve visitors and pageviews since the 6 months ago
//        $visitedPages = Analytics::fetchMostVisitedPages(Period::days(17), 30);

        $analyticsData = Analytics::fetchTopReferrers(Period::days(17), 30);

        $analyticsData = Analytics::fetchUserTypes(Period::days(15));

//        $analyticsData = Analytics::fetchTopBrowsers(Period::days(17));


        //retrieve sessions and pageviews with yearMonth dimension since 1 year ago
        $response = $this->fetchVisitorsCountry(Period::days(70));

        pre($response, 1);

    }

    public function fetchBounceRate($days) {
        return Analytics::performQuery(
            Period::days($days),
            'ga:sessions',
            [
                'metrics' => 'ga:bounceRate',
                'dimensions' => 'ga:yearMonth'
            ]
        );
    }


    public function fetchVisitorsAndPageViewsExtended(Period $period): Collection {
        $response = Analytics::performQuery(
            $period,
            'ga:users,ga:pageviews',
            ['dimensions' => 'ga:date,ga:pageTitle,ga:pagePath']
        );

        return collect($response['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0]),
                'pageTitle' => $dateRow[1],
                'pageURL' => $dateRow[2],
                'visitors' => (int)$dateRow[3],
                'pageViews' => (int)$dateRow[4],
            ];
        });
    }

    public function fetchVisitorsCountry(Period $period): Collection {
        $response = Analytics::performQuery(
            $period,
            'ga:users,ga:pageviews',
            ['dimensions' => 'ga:country', 'sort' => '-ga:users']
        );

        return collect($response['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'country' => $dateRow[0],
                'users' => $dateRow[1],
                'pageviews' => $dateRow[2],


            ];
        });
    }


}
