<?php

namespace App\Providers;

use App\Events\UserActivityEvent;
use App\Listeners\UpdateDataListener;
use App\Models\JobCost;
use App\Models\ProductResult;
use App\Models\ReleaseMaterial;
use App\Observers\TransactionObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserActivityEvent::class => [
            UpdateDataListener::class,
        ],
    ];

    /** 
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Register Observer
        ReleaseMaterial::observe(TransactionObserver::class);
        ProductResult::observe(TransactionObserver::class);
        JobCost::observe(TransactionObserver::class);
    }
}
