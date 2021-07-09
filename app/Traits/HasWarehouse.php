<?php

namespace App\Traits;

use App\Models\Warehouse;

/**
 * Accumulate Stock by History
 */
trait HasWarehouse
{
    /**
     * Get this that owns the warehouse.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}