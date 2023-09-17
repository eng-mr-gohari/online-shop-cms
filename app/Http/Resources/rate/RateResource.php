<?php

namespace App\Http\Resources\rate;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user'=>$this->user,
            'product'=>$this->product,
            'rate'=>$this->rate,
          

        ];
    }
}
