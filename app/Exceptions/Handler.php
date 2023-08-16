<?php

namespace App\Exceptions;

use App\ActivityLogs;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
//        dd( $exception );
//        if ($exception->getStatusCode() === 500 ) {
            $getActivity = ActivityLogs::where("activity_on", request()->fullUrl())->first();
            if( !$getActivity ){
                $create_activity = new ActivityLogs();
                $create_activity->log_type = 'error_app_running';
                $create_activity->activity_on = request()->fullUrl();
                $create_activity->message = $exception->getMessage(). ' in file '.$exception->getFile().' on Line '.$exception->getLine();
                $create_activity->save();
            }
            // Display Laravel's default error message with appropriate error information
//            return $this->convertExceptionToResponse($exception);
//        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $getActivity = ActivityLogs::where("activity_on", request()->fullUrl())->first();
        if( !$getActivity ) {
            $create_activity = new ActivityLogs();
            $create_activity->log_type = 'error_app_running';
            $create_activity->activity_on = request()->fullUrl();
            $create_activity->message = $exception->getMessage() . ' in file ' . $exception->getFile() . ' on Line ' . $exception->getLine();
            $create_activity->save();
        }

        return parent::render($request, $exception);
    }
}
