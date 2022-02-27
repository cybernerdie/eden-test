<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'customers' => UserResource::collection( $this->whenLoaded('customers') ),
        ];
    }
}
