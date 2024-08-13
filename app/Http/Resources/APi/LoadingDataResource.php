<?php

namespace App\Http\Resources\APi;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoadingDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tableName' => $this->resource['tableName'],
            'columns' => TableStructureResource::collection($this->resource['tableStructure']),
            'filters' => TableFiltersResource::collection($this->resource['tableFilters']),
            'data' => [
                'items' =>TableDataResource::collection($this->resource['tableData']),
                'pagination'=> [
                    'meta' => [
                        'total' => $this->resource['tableData']->total(),
                        'per_page' => $this->resource['tableData']->perPage(),
                        'current_page' => $this->resource['tableData']->currentPage(),
                        'last_page' => $this->resource['tableData']->lastPage(),
                    ],
                    'links' => [
                        'self' => $this->resource['tableData']->url(null, $this->resource['tableData']->currentPage()),
                        'prev' => $this->resource['tableData']->previousPageUrl(),
                        'next' => $this->resource['tableData']->nextPageUrl(),
                    ]
                ]
            ]
        ];
    }
}
