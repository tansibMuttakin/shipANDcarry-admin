<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class SortController extends LarablendCrudController{

    public static function sort_table(Request $request, $model, $id){
        dd('in sort');
    }
    
}
