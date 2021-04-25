<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Models\Shipper;
use App\Models\Profile;
use Carbon\Carbon;

use Duoneos\Larablend\Http\Controllers\LarablendCrudController;

class ShippersController extends LarablendCrudController
{
    public static function history(){
        $bookings = BookingRequest::with('shipper','carrier','driver','pickup_address','dropoff_address')->get();
        return view('shippers.history',['bookings' => $bookings]);
    }
    public static function status(){
        $shippers = Shipper::all();
        return view('shippers.status',['shippers' => $shippers]);
    }
    public static function statusDisapprove($model, $id){
        $profile = Profile::findOrfail($id);
        $profile->active = 0;
        $profile->save();
        return redirect()->back()->with('message','Status Updated');
    }
    public static function statusApprove($model, $id){
        $profile = Profile::findOrfail($id);
        $profile->active = 1;
        $profile->save();
        return redirect()->back()->with('message','Status Updated');
    }
    public static function sort_table(Request $request, $model, $id){
        $max_date = $request->max_date;
        $min_date = $request->min_date;

        $shippers = Shipper::join('users As user','user.id','shippers.user_id')
        ->join('profiles As profile','profile.id','shippers.profile_id')
        ->join('addresses As address','address.id','shippers.address_id')
        ->where('shippers.created_at','>=',$min_date)
        ->where('shippers.created_at','<=',$max_date)
        ->get(['name','profile.email','gender','nid_no','address_line_1','shippers.type','shippers.created_at']);
        $request->session()->flash('data', $shippers);
        $request->session()->flash('model', 'shipper');
        return redirect()->back();

        // $yesterday = Carbon::yesterday();

        // $previous_week = strtotime("-1 week +1 day");
        // $start_week = strtotime("last sunday midnight",$previous_week);
        // $end_week = strtotime("next saturday",$start_week);
        // $start_week = date("Y-m-d",$start_week);
        // $end_week = date("Y-m-d",$end_week);

        // $last_month = Carbon::now()->subMonth()->month;
        // $last_year = Carbon::now()->subYear()->year;


        // switch ($id) {
        //     case 'last_day':
        //         $shippers = Shipper::where('created_at','>=',$yesterday)->get();
        //         dd($shippers);
        //         break;
            
        //     case 'last_week':
        //         $shippers = Shipper::whereBetween('created_at',[$start_week,$end_week])->get();
        //         dd($shippers);
        //         break;
            
        //     case 'last_month':
        //         $shippers = Shipper::whereMonth('created_at','=',$last_month)->get();
        //         dd($shippers);
        //         break;
            
        //     case 'last_year':
        //         $shippers = Shipper::whereYear('created_at','=',$last_year)->get();
        //         dd($shippers);
        //         break;
        // }
    }
}
