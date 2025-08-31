<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array {
    return [
        'id' => $this->id,
        'user' => ['id'=>$this->user->id,'name'=>$this->user->name],
        'equipment' => [
            'id'=>$this->equipment->id,'code'=>$this->equipment->code,'name'=>$this->equipment->name
        ],
        'borrowed_at' => $this->borrowed_at?->toISOString(),
        'due_at'      => $this->due_at?->toISOString(),
        'returned_at' => $this->returned_at?->toISOString(),
        'status'      => $this->status,
        'note'        => $this->note,
    ];
    }
}
