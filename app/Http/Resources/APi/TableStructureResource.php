<?php

namespace App\Http\Resources\APi;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableStructureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->resource == null)
            return [];
        
        return [
            'primary key' => $this->resource->pk,
            'name' => $this->resource->name,
            'type' => $this->resource->type,
            'required' => $this->resource->notnull ? true : false,
            'default value' => $this->resource->dflt_value,
        ];
    }
}
