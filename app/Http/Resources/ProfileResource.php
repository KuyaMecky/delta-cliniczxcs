<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProfileResource extends JsonResource
{
    /**
     * @param Request $request
     *
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'profile_image' => $this->image_url,
        ];
    }
}
