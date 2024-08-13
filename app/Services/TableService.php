<?php

namespace App\Services;

use App\Http\Resources\APi\LoadingDataResource;
use App\Http\Resources\APi\TableStructureResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TableService
{
    public function loadingData($tableName){
        $tableStructure = $this->getTableStructure($tableName);
        $tableFilters = $this->getTableFilters($tableName);
        $tableData = $this->getTableData($tableName, 10/*elements per page*/);

        return response()->json([
            new LoadingDataResource([
                'tableName' => $tableName,
                'tableStructure' => $tableStructure,
                'tableFilters' => $tableFilters,
                'tableData' => $tableData
            ]),
        ]);
    }

    private function getTableStructure($tableName)
    {
        return DB::select('PRAGMA table_info(' . $tableName . ')');
    }

    private function getTableFilters($tableName)
    {
        $model = $this->getModelFromTableName($tableName);
        if(!$model)
            return [];
        $filterable = $model::$filterable;
        $sortable = $model::$sortable;

        $tableFilters = $this->getTableStructure($tableName);
        foreach($tableFilters as $column){
            $column->sortable = false;
            $column->filterable = false;

            if(in_array($column->name, $sortable))
                $column->sortable = true;
            if(in_array($column->name, $filterable))
                $column->filterable = true;
        }

        return $tableFilters;
    }

    private function getTableData($tableName, $elementsPerPage)
    {
        $model = $this->getModelFromTableName($tableName);
        if(!$model)
            return [];
        $query = $model->query();
        return $query->paginate($elementsPerPage);
    }

    private function makeSingle(string $className){
        if (substr($className, -2) == 'es') {
            return substr($className, 0, -2);
        } elseif (substr($className, -1) == 's') {
            return substr($className, 0, -1);
        }elseif (substr($className, -3) == 'ies') {
            $word = substr($className, 0, -2);
            return $word.'y';
        }else {
            return $className; // Handle irregular forms or unknown patterns
        }
    }

    private function getModelFromTableName($tableName)
    {
        $modelName = $this->makeSingle(str_replace('_', '', ucwords($tableName, '_')));
        $modelClass = 'App\\Models\\' . $modelName;
        if(class_exists($modelClass))
            return App::make($modelClass);
        return [];
    }

    public function getTableDataww($tableName, Request $request)
    {
        $model = $this->getModelFromTableName($tableName);
        $query = $model->query();

        $filters = $request->input('filters', ['name' => 'moha']);
        $sorts = $request->input('sorts', ['name' => 'asc']);
        $filterable = $model::$filterable;
        $sortable = $model::$sortable;

        foreach ($filters as $column => $value) {
            if(in_array($column, $filterable)){
                if(is_string($value))
                    $query->where($column, 'like', '%'.$value.'%');
                else
                    $query->where($column, $value);
            }
        }

        foreach ($sorts as $value => $order) {
            if(in_array($column, $sortable))
                $query->orderBy($value, $order);
        }

        $results = $query->get();

        return $results;
    }
}
