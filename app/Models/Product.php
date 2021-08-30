<?php

namespace App\Models;

use App\Traits\HasHistory;
use App\Traits\HasType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasType, HasHistory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Scope products by Product Type
     * @param mixed  $type
     */
    public function scopeOfType($query, $type)
    {
        $query->whereHas('type', function ($query) use ($type) {

            // if pass by ID
            if (is_numeric($type)) {
                $query->where('id', $type);
                return;
            }

            // else if 'String'
            $query->where('name', 'like', '%' . $type . '%');
        });
    }

    /**
     * Get unique value from relation
     */
    public function calculateUniqueOf($column, $relation)
    {
        return $this->history
            ->load($relation)
            ->groupBy($column)
            ->mapWithKeys(function ($group, $key) {
                return [
                    $key => $group->calculateStock()
                ];
            });
    }
}