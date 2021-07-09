<?php

namespace App\Traits;

use App\Models\Rack;

/**
 * Accumulate Stock by History
 */
trait HasRack
{
    /**
     * Get this that owns the warehouse.
     */
    public function racks()
    {
        return $this->hasMany(Rack::class);
    }
}
