<?php

namespace App\Traits;

use App\Models\Rack;

trait HasRack
{
    /**
     * Get this that owns the warehouse.
     */
    public function racks()
    {
        return $this->hasMany(Rack::class);
    }

    /**
     * Get this that owns the warehouse.
     */
    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
}
