<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReleaseMaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'date'          => $this->date,
            'lot'           => $this->lot,
            'description'   => optional($this->product)->name,
            'isClosed'      => $this->result ? true : false,

            // Load when Product exists
            'used'          => $this->whenLoaded('products', function () {
                return $this->products->sum('pivot.quantity');
            })
        ];;
    }
}
