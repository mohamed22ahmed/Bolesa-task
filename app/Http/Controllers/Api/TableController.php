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

    public function filter(Request $request)
    {
        // $loadingData = $this->tableService->filteringData($request->tableName);
        // return response()->json($loadingData);
    }
}
