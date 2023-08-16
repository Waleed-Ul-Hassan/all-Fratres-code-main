<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use App\ValidateTokens;
use Closure;

class ValidateMobile
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
        if($authorization){
            $token = new ValidateTokens();
            $seeker = $token->seeker($authorization);
            if(!$seeker){
                return $this->loginRequired("Please Login to continue");
            }
            $request['seekerIs'] = $seeker;
        }else{
            return $this->loginRequired("Please Login to continue");
        }

        return $next($request);
    }
}
