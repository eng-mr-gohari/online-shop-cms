<?php

namespace App\Http\Resources\banner;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title'=>$this->title,
            'image'=>$this->image,
            'url'=>$this->url,
            'status'=>$this->status,
        ];
    }
}
