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
                'pagination'=> new PaginationResource($this->resource['tableData'])
            ]
        ];
    }
}
