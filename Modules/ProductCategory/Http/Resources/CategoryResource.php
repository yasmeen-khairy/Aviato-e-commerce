<?php

// namespace App\Http\Resources;
namespace Modules\ProductCategory\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image'=>$this->image,
            'name'=>$this->name,
            'description'=>$this->description
            
        ];
    }
}
