<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TableService;

class TableController extends Controller
{
    public function __construct(private TableService $tableService) {}

    public function index($tableName)
    {
        $loadingData = $this->tableService->loadingData($tableName);
        return response()->json($loadingData);
    }

    public function filteringData(Request $request)
    {
        $filteredData = $this->tableService->filteringData($request);
        return response()->json($filteredData);
    }
}
