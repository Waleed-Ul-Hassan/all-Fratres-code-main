<?php

namespace App\Providers;

use App\Events\JobAlertCreating;
use App\Events\JobAlertDeleting;
use App\Events\JobSaving;
use App\Events\JobUpdated;
use App\Events\JobUpdating;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        JobSaving::class => [
            \App\Listeners\JobSaving::class,
        ],
        JobUpdating::class => [
            \App\Listeners\JobUpdating::class,
        ],
        JobUpdated::class => [
            \App\Listeners\JobUpdated::class,
        ],
        JobAlertCreating::class => [
            \App\Listeners\JobAlertCreating::class,
        ],
        JobAlertDeleting::class => [
            \App\Listeners\JobAlertDeleting::class,
        ],




    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
