<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'location' => $this->location,
            'country' => new CountryResource( $this->country ),
            'role' => new RoleResource( $this->role ),
            'gardener' => new UserResource( $this->whenLoaded('gardener') ),
            'customers' => UserResource::collection( $this->whenLoaded('customers') ),
            'dateJoined' => $this->created_at,
        ];
    }
}
