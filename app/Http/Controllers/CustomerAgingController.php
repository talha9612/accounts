<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CustomerAgingController extends Controller
{
    public function index(Request $request){
        return view('customeraging.index');
    }
    public function AgingDaysSearch(Request $request){
        // dd($request->all());
        $string = $request->agingdays;
        $ages = [];
        if($string != 0){
            $integers = preg_split('/-/', $string);
            $startDay = $integers[0];
            $endDay = $integers[1];
            $ages =  DB::select("SELECT * FROM squotations WHERE created_at BETWEEN DATE_SUB(NOW(), INTERVAL '$endDay' DAY) AND DATE_SUB(NOW(), INTERVAL '$startDay' DAY)");
            dd($ages[0]);
        }
        return response()->json([
            'ages'=>$ages
        ]);
    }
}
