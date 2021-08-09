<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name'          => $this->name,

            $this->mergeWhen(!request('option', false), [
                'description'   => $this->description,
                'quantity'      => $this->history->calculateStock(),
                'unit'          => $this->unit,
            ]),
        ];
    }
}
