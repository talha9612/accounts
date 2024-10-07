<?php

namespace App\Http\Controllers;
use App\Guaranter;
use Illuminate\Http\Request;

class GuaranterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guaranters = \DB::select('SELECT * FROM guaranters');
        return view('guaranters.index', ['guaranters' => $guaranters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('guaranters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Guaranter::where('gr_cnic', '=', $request->input('gr_cnic'))->exists()) {
              return back()->with('warning', 'CNIC already exists, Please Enter a Valid CNIC');
            }

         else{   
        $grname = $request->input('gr_name');
        $grfname = $request->input('gr_fname');
        $grgender = $request->input('gr_gender');
        $graddress = $request->input('gr_address');
        $grcnic = $request->input('gr_cnic');
        $grphone = $request->input('gr_phone');
        $guaranters = array();
        $guaranter = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'gr_address' => $graddress,
                'gr_gender' => $grgender,
                'gr_phone' => $grphone,
                'gr_cnic' => $grcnic,
                'gr_fname' => $grfname,
                'gr_name' => $grname
            );

            $guaranters[] = $guaranter;

            Guaranter::insert($guaranters);

        return back()->with('success', 'Guaranter has been added');
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
        $guaranter = Guaranter::find($id);
        return view('guaranters.edit',compact('guaranter','gr_ID'));
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
         \DB::update('UPDATE guaranters SET gr_name = ?, gr_fname = ?, gr_gender = ?, gr_address = ?, gr_cnic = ?, gr_phone = ?, updated_at = ? WHERE gr_ID = ?', [$request->input('gr_name'), $request->input('gr_fname'), $request->input('gr_gender'), $request->input('gr_address'), $request->input('gr_cnic'), $request->input('gr_phone'), \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d') ,$request->input('gr_ID')]);

        return redirect('guaranters')->with('success','Guaranter has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guaranter = Guaranter::find($id);
        $guaranter->delete();
        return redirect('guaranters')->with('success','Guaranter has been Deleted!');
    }
}
