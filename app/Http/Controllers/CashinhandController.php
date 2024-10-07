<?php

namespace App\Http\Controllers;
use App\Cashinhands;
use App\Obalances;
use Illuminate\Http\Request;

class CashinhandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cashinhands = Cashinhands::all()->toArray();

        return view('cashinhands.index', compact('cashinhands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cashinhands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Cashinhands = $this->validate(request(), [
          'cih_title' => 'required',
          'cih_balance' => 'required',
          'cih_obalance' => 'required'
        ]);

        Cashinhands::create($Cashinhands);

        $fsclyear = $request->input('fsclyear');

        $titlename = $request->input('cih_title');
        $titleopbalance = $request->input('cih_obalance');

        $balancess = array();

        $id = \DB::getPdo()->lastInsertId();


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

        return back()->with('success', 'New Record has been added');
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
        $cashinhands = Cashinhands::find($id);
        return view('cashinhands.edit',compact('cashinhands','cih_ID'));
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
      $cashinhands = Cashinhands::find($id);
        $this->validate(request(), [
          'cih_title' => 'required',
          'cih_balance' => 'required'
        ]);
        $cashinhands->cih_title = $request->get('cih_title');
        $cashinhands->cih_balance = $request->get('cih_balance');
        $cashinhands->cih_obalance = $request->get('cih_obalance');
        $cashinhands->save();


        $fnl = \DB::table('fnlyear')->first();

         \DB::update('UPDATE obalances SET sub_name = ?, ob_amount = ? WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$cashinhands->cih_title, $cashinhands->cih_obalance, $id, $fnl->fn_name, $cashinhands->cih_title]);
        return redirect('cashinhands')->with('success','Record has been updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cashinhand = Cashinhands::find($id);
        $cashinhand->delete();

        $titlename = $request->input('asname');

        $fnl = \DB::table('fnlyear')->first();
        \DB::update('DELETE from obalances WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$id, $fnl->fn_name, $titlename]);
        return redirect('cashinhands')->with('success','Record has been  Deleted!');
    }
}
