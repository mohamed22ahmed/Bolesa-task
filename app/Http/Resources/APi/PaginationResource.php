<?php

namespace App\Http\Resources\APi;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meta' => [
                    'total' => $this->resource->total(),
                    'per_page' => $this->resource->perPage(),
                    'current_page' => $this->resource->currentPage(),
                    'last_page' => $this->resource->lastPage(),
                ],
                'links' => [
                    'self' => $this->resource->url(null, $this->resource->currentPage()),
                    'prev' => $this->resource->previousPageUrl(),
                    'next' => $this->resource->nextPageUrl(),
                ]
        ];
    }
}
