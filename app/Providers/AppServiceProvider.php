<?php

namespace App\Providers;

use App\Models\Adjustment;
use App\Models\DeliveryOrder;
use App\Models\History;
use App\Models\InitializeStock;
use App\Models\JobCost;
use App\Models\ProductResult;
use App\Models\ReceiveItem;
use App\Models\ReleaseMaterial;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Relation Morph Map
        Relation::morphMap([
            'Initialisation'    => InitializeStock::class,
            'Adjustment'        => Adjustment::class,
            'Delivery'          => DeliveryOrder::class,
            'JobCost'           => JobCost::class,
            'Receive'           => ReceiveItem::class,
            'Release'           => ReleaseMaterial::class,
            'Result'            => ProductResult::class,
        ]);

        // Macro Collection
        Collection::macro('calculateStock', function () {
            return $this->reduce(function ($last, $current) {
                
                if (!$current instanceof History) {
                    return $this;
                }

                return $last + ($current->quantity * ($current->account == 'DEBIT' ? 1 : -1));
            });
        });
    }
}
