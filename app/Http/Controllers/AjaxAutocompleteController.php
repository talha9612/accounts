<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class AjaxAutocompleteController extends Controller
{
    public function index(Request $request){
        return view('autocomplete');
    }
    public function searchResponse(Request $request){
        $query = $request->get('term','');
        $countries=\DB::table('expenses');
        if($request->type=='name'){
            $countries->where('ex_name','LIKE','%'.$query.'%');
        }
        if($request->type=='head'){
            $countries->where('ex_ID','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('ex_name'=>$country->ex_name,'ex_ID'=>$country->ex_ID);
        }
        if(count($data))
             return $data;
        else
            return ['ex_name'=>'','ex_ID'=>''];
    }
}
