<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'form_attribute' => new FormAttributeResource($this->form_attribute),
            'scanning_name'=> $this->scanning_name,
            'ward_id'=> $this->ward_id,
            'create_by'=> $this->created_by,
            'completed_by'=>$this->completed_by,
            'created_at'=> $this->created_at

        ];
    }
}
