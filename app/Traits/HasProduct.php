<?php

namespace App\Traits;

use App\Models\Product;

trait HasProduct
{
    /**
     * Get the Product associated with the Release Material.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
