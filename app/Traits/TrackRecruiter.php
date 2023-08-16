<?php

namespace App\Traits;

trait TrackRecruiter
{

    public function trackerRecruiter(){

        $tracker = new \App\TrackRecruiter();

        return $tracker->trackActivities();

    }


}