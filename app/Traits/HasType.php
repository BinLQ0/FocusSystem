<?php

namespace App\Traits;

use App\Models\ProductType;

trait HasType
{
    /**
     * Get this that owns the warehouse.
     */
    public function type()
    {
        return $this->belongsTo(ProductType::class, 'inventory_id');
    }
}
