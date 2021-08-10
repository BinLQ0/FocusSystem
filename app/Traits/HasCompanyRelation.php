<?php

namespace App\Traits;

use App\Models\Company;

trait HasCompanyRelation
{
    /**
     * Get Company Details
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
