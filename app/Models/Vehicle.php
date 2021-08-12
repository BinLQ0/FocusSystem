<?php

namespace App\Models;

use App\Scopes\OrderNameScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new OrderNameScope);
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the vehicle title.
     *
     * @param  string  $value
     * @return string
     */
    public function getFullNameAttribute($value)
    {
        return Str::of(
            "{$this->name} / {$this->plateNumber}" // Full Name
        )->upper();
    }
}
