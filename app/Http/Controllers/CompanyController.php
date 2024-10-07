<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = \DB::select('SELECT * FROM companies');
        return view('companies.index', ['records' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cname = $request->input('c_name');
        $cadress = $request->input('c_adress');
        $ccity = $request->input('c_city');
        $carea = $request->input('c_area');
        $ctype = $request->input('c_type');
        $farmers = array();
        $farmer = array(
                'updated_at'=> now(),
                'created_at'=> now(),
                'c_name' => $cname,
                'c_adress' => $cadress,
                'c_city' => $ccity,
                'c_area' => $carea,
                 'c_type' => $ctype
            );

            $farmers[] = $farmer;

          
            if (Companies::where('c_name', '=', $request->input('c_name'))->exists()) 
            {
                return back()->with('warning', 'Company Already Exists, Please Enter a Different Name');
            }                  
            else
            {
            Companies::insert($farmers);
                return back()->with('success', 'Company has been added');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $records = \DB::select('SELECT * FROM companies WHERE c_ID = ?', [$id]);
        $persons = \DB::select('SELECT * FROM cpersons WHERE c_ID = ?', [$id]);
        return view('companies.show', ['records' => $records], ['persons' => $persons]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $farmers = \DB::select('SELECT * FROM companies WHERE c_ID=?', [$id]);
        return view('companies.edit', ['farmers' => $farmers]);
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
         \DB::update('UPDATE companies SET c_name = ?, c_adress = ?, c_area = ?, c_city = ?, c_type = ?  WHERE c_ID = ?', [$request->input('c_name'), $request->input('c_adress'), $request->input('c_area'), $request->input('c_city'), $request->input('c_type'),$request->input('c_ID')]);

        return redirect('companies')->with('success','Company Record has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $farmer = Companies::find($id);
       
        $farmer->delete();
       $person = \DB::select('DELETE FROM cpersons WHERE c_ID=?', [$id]);
        return redirect('companies')->with('success','Record has been  Deleted!');
    }
}
