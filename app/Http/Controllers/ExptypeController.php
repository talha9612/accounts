<?php

namespace App\Http\Controllers;
use App\Exptypes;
use Illuminate\Http\Request;

class ExptypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $types = \DB::select('SELECT * FROM exptypes');
        return view('exptypes.index', ['types' => $types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exptypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $titlename = $request->input('tp_name');
        $titletype = $request->input('tp_type');
        $expenses = array();
        
        $exptype = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'tp_type' => $titletype,
                'tp_name' => $titlename
            );

            $exptypes[] = $exptype;

            Exptypes::insert($exptypes);     

        return back()->with('success', 'A New Type has been added, You can use it while creating a new account head');
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
        $exptype = Exptypes::find($id);
        return view('exptypes.edit',compact('exptype','tp_ID'));
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
        // $exptype = Exptypes::find($id);
        // $this->validate(request(), [
        //   'tp_name' => 'required',
        //   'tp_type' => 'required'
        // ]);
        // $exptype->tp_name = $request->get('tp_name');
        // $exptype->tp_type = $request->get('tp_type');
        // $exptype->updated_at = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('d-M-Y g:i A');
        // $exptype->save();
         \DB::update('UPDATE exptypes SET tp_name = ?, tp_type = ?, updated_at = ? WHERE tp_ID = ?', [$request->input('tp_name'), $request->input('tp_type'), \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d') ,$request->input('tp_ID')]);
        return redirect('exptypes')->with('success','Head type has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $exptype = Exptypes::find($id);
        $exptype->delete();
        return redirect('exptypes')->with('success','Head Type has been  Deleted!');
    }
}
