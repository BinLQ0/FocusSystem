<?php

namespace App\Models;

use App\Traits\HasProduct;
use App\Traits\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseMaterial extends Model
{
    use HasFactory, HasProduct, Transaction;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['type'];
    
    /**
     * Determine the transaction type.
     *
     * @return bool
     */
    public function getTypeAttribute()
    {
        return 'CREDIT';
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'releases';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get Production Result Details
     */
    public function result()
    {
        return $this->hasOne(ProductResult::class, 'lot');
    }
}