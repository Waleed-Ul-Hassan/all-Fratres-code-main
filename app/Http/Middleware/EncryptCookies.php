<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Closure;
use PragmaRX\Tracker;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'job_box'
    ];

    public function handle($request, Closure $next)
    {

        // $visitor = \Tracker::currentSession();
        // if($visitor){
        //     $visitor->domain = getsubDomain();
        //     $visitor->save();
        // }


        return $next($request);
    }
}
