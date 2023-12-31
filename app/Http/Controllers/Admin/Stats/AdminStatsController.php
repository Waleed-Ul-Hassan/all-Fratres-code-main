<?php

namespace App\Http\Controllers\Admin\Stats;

use App\Http\Controllers\Controller;
use App\Recruiter;
use App\Seeker;
use Bllim\Datatables\Facade\Datatables;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;
use PragmaRX\Tracker\Vendor\Laravel\Support\Session;

class AdminStatsController extends Controller
{
    public $CreateJobRoute = 'recruiter/job_post';
    public $CreateJobRoutePost = 'recruiter/create_job';

    public function index(Session $session){

        $datatables_data =
            [
                'datatables_ajax_route' => url('admin/track/apiVisits'),
                'datatables_columns'    => '
                { "data" : "id",          "title" : "'.trans('tracker::tracker.id').'", "orderable": true, "searchable": true },
                { "data" : "client_ip",   "title" : "'.trans('tracker::tracker.ip_address').'", "orderable": true, "searchable": true },
                { "data" : "country",     "title" : "'.trans('tracker::tracker.country_city').'", "orderable": true, "searchable": true },
                { "data" : "domain",     "title" : "Domain", "orderable": true, "searchable": true },
                { "data" : "user",        "title" : "'.trans('tracker::tracker.user').'", "orderable": true, "searchable": true },
                { "data" : "device",      "title" : "'.trans('tracker::tracker.device').'", "orderable": true, "searchable": true },
                { "data" : "browser",     "title" : "'.trans('tracker::tracker.browser').'", "orderable": true, "searchable": true },
                { "data" : "language",    "title" : "'.trans('tracker::tracker.language').'", "orderable": true, "searchable": true },
                { "data" : "referer",     "title" : "'.trans('tracker::tracker.referer').'", "orderable": true, "searchable": true },
                { "data" : "pageViews",   "title" : "'.trans('tracker::tracker.page_views').'", "orderable": true, "searchable": true },
                { "data" : "lastActivity","title" : "'.trans('tracker::tracker.last_activity').'", "orderable": true, "searchable": true },
            ',
            ];

        return View::make('admin.stats.index')
            ->with('sessions', Tracker::sessions($session->getMinutes()))
            ->with('title', ''.trans('tracker::tracker.visits').'')
            ->with('username_column', Tracker::getConfig('authenticated_user_username_column'))
            ->with('datatables_data', $datatables_data);

    }

    public function summary()
    {
        return View::make('admin.stats.summary')
            ->with('title', ''.trans('tracker::tracker.page_views_summary').'')
            ->with('stats_template_path', 'asd');
    }

    public function showPage($session, $page)
    {
        $me = $this;

        if (method_exists($me, $page)) {
            return $this->$page($session);
        }
    }

    public function apiPageviews(Session $session)
    {
        return Tracker::pageViews($session->getMinutes())->toJson();
    }

    public function apiPageviewsByCountry(Session $session)
    {
        return Tracker::pageViewsByCountry($session->getMinutes())->toJson();
    }

    public function apiLog($uuid)
    {
        $query = Tracker::sessionLog($uuid, false);

        $query->select([
            'id',
            'session_id',
            'method',
            'path_id',
            'query_id',
            'route_path_id',
            'is_ajax',
            'is_secure',
            'is_json',
            'wants_json',
            'error_id',
            'created_at',
        ]);

        return Datatables::of($query)
            ->edit_column('route_name', function ($row) {
                $path = $row->routePath;

                return    $row->routePath
                    ? $row->routePath->route->name.'<br>'.$row->routePath->route->action
                    : ($row->path ? $row->path->path : '');
            })

            ->edit_column('route', function ($row) {
                $route = null;

                if ($row->routePath) {
                    foreach ($row->routePath->parameters as $parameter) {
                        $route .= ($route ? '<br>' : '').$parameter->parameter.'='.$parameter->value;
                    }
                }

                return $route;
            })

            ->edit_column('query', function ($row) {
                $query = null;

                if ($row->logQuery) {
                    foreach ($row->logQuery->arguments as $argument) {
                        $query .= ($query ? '<br>' : '').$argument->argument.'='.$argument->value;
                    }
                }

                return $query;
            })

            ->edit_column('is_ajax', function ($row) {
                return    $row->is_ajax ? 'yes' : 'no';
            })

            ->edit_column('is_secure', function ($row) {
                return    $row->is_secure ? 'yes' : 'no';
            })

            ->edit_column('is_json', function ($row) {
                return    $row->is_json ? 'yes' : 'no';
            })

            ->edit_column('wants_json', function ($row) {
                return    $row->wants_json ? 'yes' : 'no';
            })

            ->edit_column('error', function ($row) {
                return    $row->error ? 'yes' : 'no';
            })

            ->make(true);
    }

    public function users(Session $session)
    {
        return View::make('admin.stats.users')
            ->with('users', Tracker::users($session->getMinutes()))
            ->with('title', ''.trans('tracker::tracker.users').'')
            ->with('username_column', Tracker::getConfig('authenticated_user_username_column'));
    }


    private function events(Session $session)
    {
        return View::make('admin.stats.events')
            ->with('events', Tracker::events($session->getMinutes()))
            ->with('title', ''.trans('tracker::tracker.events').'');
    }

    public function errors(Session $session)
    {
        return View::make('pragmarx/tracker::errors')
            ->with('error_log', Tracker::errors($session->getMinutes()))
            ->with('title', ''.trans('tracker::tracker.errors').'');
    }

    public function apiErrors(Session $session)
    {
        $query = Tracker::errors($session->getMinutes(), false);

        $query->select([
            'id',
            'error_id',
            'session_id',
            'path_id',
            'updated_at',
        ]);

        return Datatables::of($query)
            ->edit_column('updated_at', function ($row) {
                return "{$row->updated_at->diffForHumans()}";
            })
            ->make(true);
    }

    public function apiEvents(Session $session)
    {
        $query = Tracker::events($session->getMinutes(), false);

        return Datatables::of($query)->make(true);
    }

    public function apiUsers(Session $session)
    {
        $username_column = Tracker::getConfig('authenticated_user_username_column');

        return Datatables::of(Tracker::users($session->getMinutes(), false))
            ->edit_column('user_id', function ($row) use ($username_column) {
                return "{$row->user->$username_column}";
            })
            ->edit_column('updated_at', function ($row) {
                return "{$row->updated_at->diffForHumans()}";
            })
            ->make(true);
    }

    public function apiVisits(Session $session)
    {
        $username_column = Tracker::getConfig('authenticated_user_username_column');

        $query = Tracker::sessions($session->getMinutes(), false);

        $query->select([
            'id',
            'uuid',
            'user_id',
            'domain',
            'device_id',
            'agent_id',
            'client_ip',
            'referer_id',
            'cookie_id',
            'geoip_id',
            'language_id',
            'is_robot',
            'updated_at',
        ]);



        return Datatables::of($query)
            ->edit_column('id', function ($row) {
                $uri = route('tracker.stats.log', $row->uuid);

                return '<a href="'.$uri.'">'.$row->id.'</a>';
            })

            ->add_column('country', function ($row) {
                $cityName = $row->geoip && $row->geoip->city ? ' - '.$row->geoip->city : '';

                $countryName = ($row->geoip ? $row->geoip->country_name : '').$cityName;

                $countryCode = strtolower($row->geoip ? $row->geoip->country_code : '');

                $flag = $countryCode
                    ? "<span class=\"f16\"><span class=\"flag $countryCode\" alt=\"$countryName\" /></span></span>"
                    : '';

                return "$flag $countryName";
            })

            ->add_column('user', function ($row) use ($username_column) {
                return $row->user ? $row->user->$username_column : 'guest';
            })

            ->add_column('device', function ($row) {
                $model = ($row->device && $row->device->model && $row->device->model !== 'unavailable' ? '['.$row->device->model.']' : '');

                $platform = ($row->device && $row->device->platform ? ' ['.trim($row->device->platform.' '.$row->device->platform_version).']' : '');

                $mobile = ($row->device && $row->device->is_mobile ? ' [mobile device]' : '');

                return $model || $platform || $mobile
                    ? $row->device->kind.' '.$model.' '.$platform.' '.$mobile
                    : '';
            })

            ->add_column('browser', function ($row) {
                return $row->agent && $row->agent
                    ? $row->agent->browser.' ('.$row->agent->browser_version.')'
                    : '';
            })

            ->add_column('language', function ($row) {
                return $row->language && $row->language
                    ? $row->language->preference
                    : '';
            })

            ->add_column('referer', function ($row) {
                return $row->referer ? $row->referer->domain->name : '';
            })

            ->add_column('pageViews', function ($row) {
                return $row->page_views;
            })

            ->add_column('lastActivity', function ($row) {
                return $row->updated_at->diffForHumans();
            })
            ->add_column('domain', function ($row) {
                return $row->domain;
            })

            ->make(true);
    }

    public function apiRecruiters(Session $session)
    {
        $username_column = Tracker::getConfig('authenticated_user_username_column');

        $query = Tracker::sessions($session->getMinutes(), false)->where("is_seeker", 0)->where("user_id", "!=", null);

        $query->select([
            'id',
            'uuid',
            'domain',
            'user_id',
            'referer_id',
            'is_seeker',
            'cookie_id',
            'geoip_id',
            'is_robot',
            'updated_at',
        ]);



        return Datatables::of($query)
            ->edit_column('id', function ($row) {
                $uri = route('tracker.stats.log', $row->uuid);

                return '<a href="'.$uri.'">'.$row->id.'</a>';
            })

            ->add_column('country', function ($row) {
                $cityName = $row->geoip && $row->geoip->city ? ' - '.$row->geoip->city : '';

                $countryName = ($row->geoip ? $row->geoip->country_name : '').$cityName;

                $countryCode = strtolower($row->geoip ? $row->geoip->country_code : '');

                $flag = $countryCode
                    ? "<span class=\"f16\"><span class=\"flag $countryCode\" alt=\"$countryName\" /></span></span>"
                    : '';

                return "$flag $countryName";
            })

            ->add_column('user', function ($row) use ($username_column) {

                if($row->user_id){
                    if($row->is_seeker == 0){
                        $recruiter = Recruiter::find($row->user_id);
                        if($recruiter){
                            return $recruiter->company_name.'<br>'.$recruiter->email;
                        }
                    }
                }
                return 'guest';
            })

            ->add_column('create_job_page', function ($row) {

//                return $row->log[0]->routePath['path'];
                if ($row->log) {
                    $counter = 0;
                    foreach ($row->log as $path) {
                        if($path->routePath['path'] == $this->CreateJobRoute){
                            $counter++;
                        }
                    }
                }

                return $counter;
            })

            ->add_column('created_job', function ($row) {
                if ($row->log) {
                    $counter = 0;
                    foreach ($row->log as $path) {
                        if($path->routePath['path'] == $this->CreateJobRoutePost){
                            $counter++;
                        }
                    }
                }

                return $counter;

            })



            ->add_column('pageViews', function ($row) {
                return $row->page_views;
            })

            ->add_column('lastActivity', function ($row) {
                return $row->updated_at->diffForHumans();
            })
            ->add_column('domain', function ($row) {
                return $row->domain;
            })

            ->make(true);

//        dd($dd);
    }



    public function TrackRecruiters(Session $session){

        $datatables_data =
            [
                'datatables_ajax_route' => url('admin/track/apiRecruiters'),
                'datatables_columns'    => '
                { "data" : "id",          "title" : "'.trans('tracker::tracker.id').'", "orderable": true, "searchable": true },
                { "data" : "user",   "title" : "User", "orderable": true, "searchable": true },
                { "data" : "domain",   "title" : "Domain", "orderable": true, "searchable": true },
                { "data" : "country",     "title" : "'.trans('tracker::tracker.country_city').'", "orderable": true, "searchable": true },
                { "data" : "create_job_page",        "title" : "'.trans('tracker::tracker.create_job_page').'", "orderable": true, "searchable": true },
                { "data" : "created_job",      "title" : "'.trans('tracker::tracker.created_job').'", "orderable": true, "searchable": true },
                { "data" : "pageViews",   "title" : "'.trans('tracker::tracker.page_views').'", "orderable": true, "searchable": true },
                { "data" : "lastActivity","title" : "'.trans('tracker::tracker.last_activity').'", "orderable": true, "searchable": true },
            ',
            ];

//        dd($datatables_data);
        return View::make('admin.stats.recruiters')
            ->with('sessions', Tracker::sessions($session->getMinutes()))
            ->with('title', ''.trans('tracker::tracker.visits').'')
            ->with('username_column', Tracker::getConfig('authenticated_user_username_column'))
            ->with('datatables_data', $datatables_data);


    }


}
