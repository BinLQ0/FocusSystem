<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username'      => $this->username,
            'last_seen_at'  => $this->last_seen_at,
            'attempt_ip'    => $this->attempt_ip
        ];
    }
}
