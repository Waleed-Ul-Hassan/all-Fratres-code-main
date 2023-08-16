<?php

namespace App\Http\Middleware;

use App\AdminSetting;
use App\Traits\ApiResponse;
use App\ValidateTokens;
use Closure;

class ValidateMobileRecruiter
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authorization = $request->bearerToken();
        $settings = AdminSetting::first();
        if($authorization){
            $token = new ValidateTokens();
            $recruiter = $token->recruiter($authorization);
            if(!$recruiter){
                return $this->loginRequired("Please Login to continue");
            }
            $request['recruiterIs'] = $recruiter;
            $request->recruiterIs->website_is_free = $settings->website_is_free;
        }else{
            return $this->loginRequired("Please Login to continue");
        }


        return $next($request);
    }
}
