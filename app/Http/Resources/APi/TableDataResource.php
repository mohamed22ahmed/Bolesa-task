<?php

namespace App\Http\Resources\APi;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->resource->getAttributes();
    }
}
