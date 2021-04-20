<?php

namespace App\Http\Controllers\Larablend;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Larablend\ViewSetting;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Schema;

class LarablendController extends Controller
{
    /*
     * Callback Functions
     */

    /* After Destroyed */
    public static function after_destroyed($data = null){
        return response()->redirectTo("/".$data['model']);
    }


    /*
     *  CRUD Functions
     */

    // Index
    public static function index($model, $api, $model_path){
        try{
            $model_name = Str::ucfirst(Str::camel($model));
        }catch (\Exception $e){
            $model_name = Str::ucfirst($model);
        }
        if(class_exists($model_path)){
            $all_entries = $model_path::all();
            if($api){
                if(count($all_entries)>0){
                    $toResponse = new \stdClass();
                    $toResponse->error = false;
                    $toResponse->data = $all_entries;
                    return response()->json($toResponse);
                }else{
                    return "No Entries Found!";
                }
            }else{
                $table = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns(Str::plural($model));
                $props = [];
                foreach ($table as $column){
                    $toShow = ViewSetting::where('table_name', Str::plural($model))->where('column_name', $column->getName())->get()->first();
                    $name = $column->getName();
                    if(!isset($toShow) || !$toShow->show)
                    {
                        continue;
                    }
                    else if(Str::contains($name, '_id')){
                        array_push($props, $name);
                    }
                    else if(Str::contains($name, 'id') || Str::contains($name, '_at') || Str::contains($name, 'remember_token')){
                        //
                    }else{
                        array_push($props, $name);
                    };
                }
                if(view()->exists('Larablend.index.'.$model)){
                    return response()->view('Larablend.index.'.$model, ['data' => $all_entries, 'model' => $model, 'props' => $props]);
                }else{
                    return response()->view("Larablend.default.index", ['data' => $all_entries, 'model' => $model, 'props' => $props]);
                }
            }
        }else{
            return "Model does not exists!";
        }
    }

    // Show
    public static function show($model, $id, $api, $model_path){
        try{
            $model_name = Str::ucfirst(Str::camel($model));
        }catch (\Exception $e){
            $model_name = Str::ucfirst($model);
        }
        $model_path = "App\Models\\".$model_name;
        $functions = get_class_methods($model_path);
        foreach ($functions as $function){
            if($function == '__construct'){
                break;
            }else{
                echo $function."<br>";
            }
        }
        try{
            $toShow = $model_path::findOrFail($id);
            if($api){
                $toResponse = new \stdClass();
                $toResponse->error = false;
                $toResponse->data = [$toShow];
                return response()->json($toResponse);
            }else{
                if(view()->exists('show.'.$model)){
                    return response()->view('Larablend.show.'.$model, ['toShow' => $toShow]);
                }else{
                    return response()->view('Larablend.default.show', ['toShow' => $toShow]);
                }
            }
        }catch(\Exception $e){
            if($api){
                $error = new \stdClass();
                $error->error = "true";
                $error->message = $e->getMessage();
                return response()->json($error);
            }else{
                Session::flash('message', $e->getMessage());
                Session::flash('alert-class', 'alert-danger');
                return response()->redirectTo('/'.$model."/index");
            }
        }
    }

    // Create
    public static function create($model, $model_path){
        try{
            $model_name = Str::ucfirst(Str::camel($model));
        }catch (\Exception $e){
            $model_name = Str::ucfirst($model);
        }
        $table = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns(Str::plural($model));
        $data = new \stdClass();
        $data->action = "/".$model."/store";
        $fields = [];
        foreach($table as $column){
            if(Str::contains($column->getName(), '_id')){
                try{
                    $model_name = Str::ucfirst(Str::camel(Str::substr($column->getName(), 0, strlen($column->getName())-3)));
                }catch (\Exception $e){
                    $model_name = Str::ucfirst(Str::substr($column->getName(), 0, strlen($column->getName())-3));
                }
                $model_path = "\App\\Models\\".$model_name;
                $field = new \stdClass();
                $field->type = 'select';
                $field->name = $column->getName();
                $field->required = $column->getNotnull();
                $field->label = Str::ucfirst(str_replace('_', ' ', Str::substr($column->getName(), 0, strlen($column->getName())-3)));
                $field->options = $model_path::all();
                array_push($fields, $field);
            }
            else if(Str::contains($column->getName(), '_at') || Str::contains($column->getName(), 'remember_token') || Str::contains($column->getName(), 'id'))
            {

            }
            else if(Str::contains($column->getName(), '_file'))
            {
                $data->enctype = "multipart/form-data";
                $field = new \stdClass();
                $field->type = 'file';
                $field->required = $column->getNotnull();
                $field->name = $column->getName();
                array_push($fields, $field);
            }
            else if(Str::contains($column->getName(), 'password'))
            {
                $field = new \stdClass();
                $field->type = 'password';
                $field->name = 'password';
                $field->label = "Password";
                $field->required = $column->getNotnull();
                $field->placeholder = "Enter your password here...";
                array_push($fields, $field);
            }
            else {
                $field = new \stdClass();
                switch ($column->getType()->getName()){
                    case 'string':
                        $field = new \stdClass();
                        $field->type = 'text';
                        $field->name = $column->getName();
                        $field->required = $column->getNotnull();
                        $field->label = Str::ucfirst($column->getName());
                        $field->placeholder = "Enter your ".$column->getName()." here...";
                        break;
                    case 'integer':
                    case 'float':
                        $field = new \stdClass();
                        $field->type = 'number';
                        $field->name = $column->getName();
                        $field->required = $column->getNotnull();
                        $field->label = Str::ucfirst($column->getName());
                        $field->placeholder = "Enter your ".$column->getName()." here...";
                        break;
                    case 'text':
                        $field = new \stdClass();
                        $field->type = 'textarea';
                        $field->name = $column->getName();
                        $field->required = $column->getNotnull();
                        $field->label = Str::ucfirst($column->getName());
                        $field->placeholder = "Enter your ".$column->getName()." here...";
                        break;
                    case 'boolean':
                        $field = new \stdClass();
                        $field->type = 'checkbox';
                        $field->name = $column->getName();
                        $field->required = $column->getNotnull();
                        $field->label = Str::ucfirst($column->getName());
                        break;
                    case 'datetime':
                        $field = new \stdClass();
                        $field->type = 'datetime';
                        $field->name = $column->getName();
                        $field->required = $column->getNotnull();
                        $field->label = Str::ucfirst($column->getName());
                        break;
                    default:
                        dd($column->getType()->getName());
                        break;
                }
                array_push($fields, $field);
            }
        }
        $data->fields = $fields;
        if(view()->exists('Larablend.create.'.$model)){
            return response()->view('Larablend.create.'.$model, ['data' => $data, 'model' => str_replace('_', ' ', $model)]);
        }else{
            return response()->view('Larablend.default.create', ['data' => $data, 'model' => str_replace('_', ' ', $model)]);
        }
    }

    // Store
    public static function store(Request $request, $model, $api, $model_path){
        $all = $request->except('_token');
        try{
            $model_name = Str::ucfirst(Str::camel($model));
        }catch (\Exception $e){
            $model_name = Str::ucfirst($model);
        }
        $model_path = "App\Models\\".$model_name;
        $inputObject = new $model_path();
        foreach ($all as $key => $value){
            $inputObject->$key = $value;
        }
        foreach($request->files as $name => $x){
            $file = $request->file($name)->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $today = date("Ymd");
            $path = $request->file($name)->storeAs('public/files', $filename.$today.".".$extension);
            $inputObject->$name = $path;
        }
        try{
            $inputObject->save();
            if($api){
                $res = new \stdClass();
                $res->error = false;
                $res->data = [$inputObject];
                return response()->json($res);
            }else{
                return response()->redirectTo('/'.$model.'/index');
            }
        }catch (\Exception $e){
            $error = new \stdClass();
            $error->error = "true";
            $error->message = $e->getMessage();
            return response()->json($error);
        }
    }

    // Edit
    public static function edit($model, $id, $model_path){
        try{
            $model_name = Str::ucfirst(Str::camel($model));
        }catch (\Exception $e){
            $model_name = Str::ucfirst($model);
        }
        $model_path = '\App\\Models\\'.$model_name;
        $entry = $model_path::findOrFail($id);
        $table = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns(Str::plural($model));
        $data = new \stdClass();
        $data->action = "/".$model."/update/".$entry->id;
        $fields = [];
        foreach($table as $column){
            $name = $column->getName();
            if(Str::contains($name, '_id')){
                try{
                    $model_name = Str::ucfirst(Str::camel(Str::substr($name, 0, strlen($name)-3)));
                }catch (\Exception $e){
                    $model_name = Str::ucfirst(Str::substr($name, 0, strlen($name)-3));
                }
                $model_path = "\App\\Models\\".$model_name;
                $field = new \stdClass();
                $field->type = 'select';
                $field->name = $name;
                $field->required = $column->getNotnull();
                $field->label = Str::ucfirst(str_replace('_', ' ', Str::substr($name, 0, strlen($name)-3)));
                $field->options = $model_path::all();
                $field->value = $entry->$name;
                array_push($fields, $field);
            }
            else if(Str::contains($name, '_at') || Str::contains($name, 'remember_token') || Str::contains($name, 'id'))
            {

            }
            else if(Str::contains($name, 'password'))
            {
                $field = new \stdClass();
                $field->type = 'password';
                $field->name = 'password';
                $field->required = $column->getNotnull();
                $field->label = "Password";
                $field->placeholder = "Enter your password here...";
                array_push($fields, $field);
            }
            else {
                switch ($column->getType()->getName()){
                    case 'string':
                        $field = new \stdClass();
                        $field->type = 'text';
                        $field->name = $name;
                        $field->required = $column->getNotnull();
                        $field->label = Str::ucfirst($name);
                        $field->value = $entry->$name;
                        $field->placeholder = "Enter your ".$name." here...";
                        break;
                    case 'integer':
                    case 'float':
                        $field = new \stdClass();
                        $field->type = 'number';
                        $field->name = $name;
                        $field->required = $column->getNotnull();
                        $field->label = Str::ucfirst($name);
                        $field->value = $entry->$name;
                        $field->placeholder = "Enter your ".$name." here...";
                        break;
                    case 'text':
                        $field = new \stdClass();
                        $field->type = 'textarea';
                        $field->name = $name;
                        $field->required = $column->getNotnull();
                        $field->value = $entry->$name;
                        $field->label = Str::ucfirst($name);
                        $field->placeholder = "Enter your ".$name." here...";
                        break;
                    case 'boolean':
                        $field = new \stdClass();
                        $field->type = 'checkbox';
                        $field->name = $name;
                        $field->required = $column->getNotnull();
                        $field->value = $entry->$name;
                        $field->label = Str::ucfirst($name);
                        break;
                    case 'datetime':
                        $field = new \stdClass();
                        $field->type = 'datetime';
                        $field->name = $column->getName();
                        $field->required = $column->getNotnull();
                        $field->value = $entry->$name;
                        $field->label = Str::ucfirst($column->getName());
                        break;
                    default:
                        break;
                }
                array_push($fields, $field);
            }
        }
        $data->fields = $fields;
        if(view()->exists('Larablend.edit.'.$model)){
            return response()->view('Larablend.edit.'.$model, ['data' => $data, 'model' => str_replace('_', ' ', $model), 'entry' => $entry]);
        }else{
            return response()->view('Larablend.default.edit', ['data' => $data, 'model' => str_replace('_', ' ', $model), 'entry' => $entry]);
        }
    }

    // Update
    public static function update(Request $request, $model, $id, $api, $model_path){
        $all = $request->except('_token');
        try{
            $model_name = Str::ucfirst(Str::camel($model));
        }catch (\Exception $e){
            $model_name = Str::ucfirst($model);
        }
        $model_path = "App\Models\\".$model_name;
        try {
            $toUpdate = $model_path::findOrFail($id);
        }catch (\Exception $e){
            $error = new \stdClass();
            $error->error = "true";
            $error->message = $e->getMessage();
            return response()->json($error);
        }
        foreach ($all as $key => $value){
            $toUpdate->$key = $value;
        }
        try{
            $toUpdate->save();
            if($api){
                $toReturn = new \stdClass();
                $toReturn->error = false;
                $toReturn->data = [$toUpdate];
                return response()->json($toReturn);
            }else{
                return response()->redirectTo('/'.$model.'/index');
            }
        }catch (\Exception $e){
            $error = new \stdClass();
            $error->error = "true";
            $error->message = $e->getMessage();
            return response()->json($error);
        }
    }

    // Destroy
    public static function delete($model, $id, $api, $controller_path, $model_path){
        try{
            $toDelete = $model_path::findOrFail($id);
            $toDelete->delete();
            if($api){
                $json = new \stdClass();
                $json->error = false;
                $json->message = "Successfully deleted!";
                return response()->json($json);
            }else{
                return $controller_path::after_destroyed($data = ['model' => $model]);
            }
        }catch (\Exception $e){
            if($api){
                $error = new \stdClass();
                $error->error = "true";
                $error->message = $e->getMessage();
                return response()->json($error);
            }else{
                $error = $e->getMessage();
                Session::push('errors', $error);
                return $controller_path::after_destroyed($data = ['model' => $model]);
            }
        }
    }

    // Search
    public static function search(Request $request, $model, $api, $model_path){
        $queries = $request->except('extended');
        $finalQueries = [];
        $results = [];
        foreach ($queries as $key => $value){
            $finalQuery = [];
            if(Str::contains($key, 'min_')){
                $key = substr($key, 4);
                array_push($finalQuery, $key, '>=', $value);
            }else if(Str::contains($key, 'max_')){
                array_push($finalQuery, $key, '<=', $value);
            }else{
                array_push($finalQuery, $key, 'like', '%'.$value.'%');
            }
            array_push($finalQueries, $finalQuery);
        }
        if($request->extended == true){
            $results = $model_path::where('id', '>', 0)->orWhere($finalQueries)->get();
        }else{
            $results = $model_path::where($finalQueries)->get();
        }
        dd($results);
    }

}
