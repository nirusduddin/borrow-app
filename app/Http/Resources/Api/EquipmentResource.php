<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array {
        return [
            'id'    => $this->id,
            'category' => ['id'=>$this->category->id,'name'=>$this->category->name],
            'code'  => $this->code,
            'name'  => $this->name,
            'stock' => (int) $this->stock,
            'photo_url' => $this->photo_path ? asset('storage/'.$this->photo_path) : null,
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
