<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_types';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_material' => false,
        'is_goods' => false,
    ];

    /**
     * Set the material value.
     *
     * @param  bool|string  $value
     * @return void
     */
    public function setIsMaterialAttribute($value)
    {
        $this->attributes['is_material'] = $this->getToogleValue($value);
    }

    /**
     * Set the goods value.
     *
     * @param  bool|string  $value
     * @return void
     */
    public function setIsGoodsAttribute($value)
    {
        $this->attributes['is_goods'] = $this->getToogleValue($value);
    }

    /**
     * Method to convert checkbox value => boolean
     */
    public function getToogleValue($value)
    {
        return $value instanceof bool
            ? $value
            : ($value == 'on' ? true : false);
    }
}