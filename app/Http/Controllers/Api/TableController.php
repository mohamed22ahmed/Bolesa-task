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
        $loadingData = $this->tableService->LoadingData($tableName);
        return response()->json($loadingData);
    }

    public function filter(Request $request)
    {
        // Handle filter parameters and call TableService::getTableData()
    }
}
