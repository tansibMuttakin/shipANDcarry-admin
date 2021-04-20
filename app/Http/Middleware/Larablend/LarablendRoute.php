<?php

namespace App\Http\Middleware\Larablend;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class LarablendRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $model = $request->route('model');
        $action = $request->route('action') ? $request->route('action') : 'index';
        $id = $request->route('id') ? $request->route('id') : null;
        $model_name = Str::ucfirst(Str::camel($model));
        if($model_name == 'ViewSetting'){
            $model_path = "\App\\Models\\Larablend\\".$model_name;
        }else{
            $model_path = "\App\\Models\\".$model_name;
        }
        $controller_path = "\App\\Http\\Controllers\\Larablend\\LarablendController";
        if(class_exists($model_path)){
            $api = false;
            if(Str::contains($request->path(), 'api')){
                $api = true;
            }
            $custom_controller = "\App\\Http\\Controllers\\Larablend\\".$model_name."Controller";
            if(class_exists($custom_controller)){
                return app()->call($custom_controller."::".$action, [
                    'request' => $request,
                    'model' => $model,
                    'action' => $action,
                    'id' => $id,
                    'api' => $api,
                    'model_path' => $model_path,
                ]);
            }
            $custom_controller = "\App\\Http\\Controllers\\Larablend\\".Str::plural($model_name)."Controller";
            if(class_exists($custom_controller)){
                return app()->call($custom_controller."::".$action, [
                    'request' => $request,
                    'model' => $model,
                    'action' => $action,
                    'id' => $id,
                    'api' => $api,
                    'model_path' => $model_path,
                ]);
            }
            return app()->call($controller_path."::".$action, [
                'request' => $request,
                'model' => $model,
                'action' => $action,
                'id' => $id,
                'api' => $api,
                'controller_path' => $controller_path,
                'model_path' => $model_path,
            ]);
        }else{
            return $next($request, $next);
        }
    }
}
