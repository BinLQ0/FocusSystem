<?php

namespace App\Traits;

use App\Models\History;

trait HasHistory
{
    /**
     * Get All history.
     */
    public function history()
    {
        return $this->hasMany(History::class);
    }

    /**
     * Scope history
     * @param string  $column
     * @param string  $value
     */
    public function scopeFilterHistory($query, string $column, string ...$value){
        $query->whereHas('history', function ($query) use($column, $value){
            return $query->whereIn($column, $value);
        })->with(['history' => function ($query) use($column, $value){
            return $query->whereIn($column, $value);
        }]);
    }
}
