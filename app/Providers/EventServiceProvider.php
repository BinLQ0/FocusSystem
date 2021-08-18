<?php

namespace App\Providers;

use App\Events\UserActivityEvent;
use App\Listeners\UpdateDataListener;
use App\Models\Adjustment;
use App\Models\DeliveryOrder;
use App\Models\InitializeStock;
use App\Models\JobCost;
use App\Models\ProductResult;
use App\Models\ReceiveItem;
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
        InitializeStock::observe(TransactionObserver::class);

        ReleaseMaterial::observe(TransactionObserver::class);
        ProductResult::observe(TransactionObserver::class);
        JobCost::observe(TransactionObserver::class);

        ReceiveItem::observe(TransactionObserver::class);
        DeliveryOrder::observe(TransactionObserver::class);
        Adjustment::observe(TransactionObserver::class);
    }
}
