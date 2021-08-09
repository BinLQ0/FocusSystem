<?php

namespace App\Models;

use App\Traits\HasRack;
use Illuminate\Database\Eloquent\Relations\Pivot;

class History extends Pivot
{
    use HasRack;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'histories';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the parent historyable model.
     */
    public function historyable()
    {
        return $this->morphTo('histories', 'histories_type', 'histories_id')->orderBy('date');
    }
}
