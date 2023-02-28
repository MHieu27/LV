<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $swap = 'product';
    public function toArray($request)
    {
        return parent::toArray([
            'name' => $this->name,
            'img' => $this->img,
            'description',
        ]);
    }
}
