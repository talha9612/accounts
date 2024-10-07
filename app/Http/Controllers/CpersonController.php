<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cpersons;

class CpersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $records = \DB::select('SELECT * FROM cpersons');
        $records = \DB::select('SELECT * FROM cpersons C JOIN companies C2 ON C.c_ID = C2.c_ID');
        
        return view('cpersons.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('cpersons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
       {
        
        $c_ID = $request->input('country_code');
        $cname = $request->input('countryname');
        $cp_name = $request->input('cp_name');
        $cp_designation = $request->input('cp_designation');
        $cp_cell = $request->input('cp_cell');
        $cp_tel = $request->input('cp_tel');
        $cp_ext = $request->input('cp_ext');
        $cp_email = $request->input('cp_email');
        $farmers = array();
        $farmer = array(
                'updated_at'=> now(),
                'created_at'=> now(),
                'c_ID' => $c_ID,
                'cp_name' => $cp_name,
                'c_name' => $cname,
                'cp_designation' => $cp_designation,
                'cp_cell' => $cp_cell,
                'cp_tel' => $cp_tel,
                'cp_ext' => $cp_ext,
                'cp_email' => $cp_email,
            );

            $farmers[] = $farmer;
            Cpersons::insert($farmers);
            return back()->with('success', 'Contact Person has been added');       
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $farmers = \DB::select('SELECT * FROM cpersons WHERE cp_ID=?', [$id]);
        return view('cpersons.edit', ['farmers' => $farmers]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \DB::update('UPDATE cpersons SET cp_name = ?, c_name =?, c_ID =?, cp_designation = ?, cp_cell = ?, cp_tel = ?, cp_ext = ?, cp_email = ?  WHERE cp_ID = ?', [$request->input('cp_name'),$request->input('countryname'),$request->input('country_code') ,$request->input('cp_designation'), $request->input('cp_cell'), $request->input('cp_tel'), $request->input('cp_ext'),$request->input('cp_email'),$request->input('cp_ID')]);

        return redirect('cpersons')->with('success','Contact Person Record has been updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $farmer = Cpersons::find($id);
        $farmer->delete();
        return redirect('cpersons')->with('success','Record has been Deleted!');

    }
    
    public function searchCompany(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('companies');
        if($request->type=='countryname'){
            $countries->where('c_name','LIKE','%'.$query.'%');
        }
        if($request->type=='country_code'){
            $countries->where('c_ID','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('c_name'=>$country->c_name,'c_ID'=>$country->c_ID);
        }
        if(count($data))
            return $data;
        else
            return ['c_name'=>'','c_ID'=>''];
    }
}
