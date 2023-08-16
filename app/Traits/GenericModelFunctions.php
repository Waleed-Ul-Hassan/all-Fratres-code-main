<?php

namespace App\Traits;

use App\JobStat;

Trait GenericModelFunctions{


    public function store_stats($job_id){


       return $stats = JobStat::updateOrCreate(
            [
                'ip_address' => ip_address(),
                'job_id' => $job_id,
            ]);


    }


    public function getStatsDetails(){

        $data = getVisitor(ip_address());
        $data = json_decode($data['content']);

        if(isset($data->status) && $data->status != 'fail') {

            $stats = JobStat::updateOrCreate(
                [
                    'lat' => $data->lat

                ],
                [
//                    'job_id' => $this->id,
                    'ip_address' => ip_address(),
                    'browser' => getBrowser()['name'],
                    'country' => $data->country,
                    'city' => $data->city,
                    'lat' => $data->lat,
                    'lon' => $data->lon,
                    'timezone' => $data->timezone,
                    'isp' => $data->isp,
                    'region' => $data->region,
                    'regionname' => $data->regionName,
                    'countrycode' => $data->countryCode,
                    'zip' => $data->zip,
                ]
            );

//            $stats->increment_views();
        }

    }

}