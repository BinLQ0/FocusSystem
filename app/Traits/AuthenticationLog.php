<?php

namespace App\Traits;

use Carbon\Carbon;

trait AuthenticationLog
{
    /**
     * @return string
     */
    public function getlastSeenAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
