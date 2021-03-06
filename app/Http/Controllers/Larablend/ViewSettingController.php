<?php

namespace App\Http\Controllers\Larablend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Larablend\ViewSetting;
use Illuminate\Support\Str;

class ViewSettingController extends LarablendController
{
    public static function store(Request $request, $model, $api, $model_path)
    {
        //Get all tables
        $tables = \DB::connection()->getDoctrineSchemaManager()->listTableNames();
        foreach($tables as $table){
            if(Str::contains($table, ['migrations', 'failed_jobs', 'password_resets'])){
                //
            }else{
                $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns($table);
                foreach($columns as $column){
                    if(Str::contains($column->getName(), ['_at', 'id', 'remember_token', 'password'])){
                        continue;
                    }
                    $existing = ViewSetting::where('table_name', $table)->where('column_name', $column->getName())->get()->first();
                    if($existing){
                        continue;
                    }
                    $viewSetting = new ViewSetting();
                    $viewSetting->table_name = $table;
                    $viewSetting->column_name = $column->getName();
                    $viewSetting->show = true;
                    $viewSetting->save();
                }
            }
        }// TODO: Change the autogenerated stub

        return response()->redirectTo('/view_setting');
    }

    public static function show($model, $id, $api, $model_path)
    {
        $view_setting = ViewSetting::findOrFail($id);
        $view_setting->show = 1;
        $view_setting->save();
        return response()->redirectTo('/view_setting');
    }

    public static function update(Request $request, $model, $id, $api, $model_path)
    {
        $view_setting = ViewSetting::findOrFail($id);
        $view_setting->show = 0;
        $view_setting->save();
        return response()->redirectTo('/view_setting');
    }
}
