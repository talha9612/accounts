<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Year;
class AddYearController extends Controller
{
    public function index(Request $request){
        $years = Year::get();
        return view('addyear.index',compact('years'));
    }
    public function create(){
        return view('addyear.create');
    }
    public function save(Request $request){
       
        $year = new Year();
        $year->year_name = $request->start_year .'-'.$request->end_year;
        $year->save();
        return redirect('year');
    }
}
