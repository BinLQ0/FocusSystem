<?php

namespace App\Traits;

use App\Models\Warehouse;

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