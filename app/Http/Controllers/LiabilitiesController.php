<?php

namespace App\Http\Controllers;
use App\Heads;
use App\Obalances;
use Illuminate\Http\Request;

class LiabilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $liabilities = \DB::select('SELECT * FROM heads WHERE h_type = ?', ['Liability']);
        return view('liabilities.index', ['liabilities' => $liabilities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $liabilities = \DB::select('SELECT tp_name FROM exptypes WHERE tp_type = ?', ['Liability']);
        return view('liabilities.create', ['liabilities'=>$liabilities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fsclyear = $request->input('fsclyear');

        $titlename = $request->input('lb_name');
        $titletype = $request->input('lb_type');
        $titlestype = $request->input('lb_stype');
        $titleopbalance = $request->input('lb_opbalance');
        $expenses = array();
        
        $liability = array(
                'updated_at'=> \Carbon\Carbon::now(),
                'created_at'=> \Carbon\Carbon::now(),
                'h_balance' => $titleopbalance,
                'h_opbalance' => $titleopbalance,
                'h_stype' => $titlestype,
                'h_type' => $titletype,
                'h_name' => $titlename
            );

            $liabilities[] = $liability;

            Heads::insert($liabilities);  

         $balancess = array();

        $id = \DB::getPdo()->lastInsertId();;
        
        
        $balance = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'ob_fyear' => $fsclyear,
                'ob_amount' => $titleopbalance,
                'sub_name' => $titlename,
                'sub_ID' => $id
            );

            $balances[] = $balance;

            Obalances::insert($balances);            

        return back()->with('success', 'Liability has been added');
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
        $liabilities = Heads::find($id);
        $list = \DB::select('SELECT tp_name FROM exptypes WHERE tp_type = ?', ['Liability']);
        return view('liabilities.edit',compact('liabilities','lb_ID'), ['list'=>$list]);
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
        $fnl = \DB::table('fnlyear')->first();

        $liabilities = Heads::find($id);
        $this->validate(request(), [
          'lb_name' => 'required',
          'lb_type' => 'required',
          'lb_opbalance' => 'required'
        ]);
        $liabilities->h_name = $request->get('lb_name');
        $liabilities->h_stype = $request->get('lb_type');
        $liabilities->h_opbalance = $request->get('lb_opbalance');
        $liabilities->h_balance = $request->get('lb_opbalance');
        $liabilities->save();

         \DB::update('UPDATE obalances SET sub_name = ?, ob_amount = ? WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$liabilities->h_name, $liabilities->h_opbalance, $id, $fnl->fn_name, $liabilities->h_name]);   

        return redirect('liabilities')->with('success','Liability has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $liabilities = Heads::find($id);
        $liabilities->delete();

        $titlename = $request->input('asname');

        $fnl = \DB::table('fnlyear')->first();
        \DB::update('DELETE from obalances WHERE sub_ID = ? AND ob_fyear = ?', [$id, $fnl->fn_name, $titlename]); 
        return redirect('liabilities')->with('success','Liability has been  Deleted!');
    }
}
