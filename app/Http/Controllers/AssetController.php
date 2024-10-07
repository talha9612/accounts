<?php

namespace App\Http\Controllers;
use App\Heads;
use App\Obalances;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $assets = \DB::select('SELECT * FROM heads WHERE h_type = ?', ['Asset']);
        return view('assettypes.index', ['assets' => $assets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assets = \DB::select('SELECT tp_name FROM exptypes WHERE tp_type = ?', ['Asset']);
        return view('assettypes.create', ['assets' => $assets]);
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

        $titlename = $request->input('as_name');
        $titletype = $request->input('as_type');
        $titlestype = $request->input('as_stype');
        $titleopbalance = $request->input('as_opbalance');
        $expenses = array();

        $asset = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'h_balance' => $titleopbalance,
                'h_opbalance' => $titleopbalance,
                'h_stype' => $titlestype,
                'h_type' => $titletype,
                'h_name' => $titlename
            );

            $assets[] = $asset;

            Heads::insert($assets);

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

        return back()->with('success', 'Asset has been added');
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
        $asset = Heads::find($id);
        $assets = \DB::select('SELECT tp_name FROM exptypes WHERE tp_type = ?', ['Asset']);
        return view('assettypes.edit',compact('asset','as_ID'), ['assets' => $assets]);
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

        $asset = Heads::find($id);
        $this->validate(request(), [
          'as_name' => 'required',
          'as_type' => 'required',
          'as_opbalance' => 'required'
        ]);
        $asset->h_name = $request->get('as_name');
        $asset->h_stype = $request->get('as_type');
        $asset->h_opbalance = $request->get('as_opbalance');
        $asset->h_balance = $request->get('as_opbalance');
        $asset->save();

         \DB::update('UPDATE obalances SET sub_name = ?, ob_amount = ? WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$asset->h_name, $asset->h_opbalance, $id, $fnl->fn_name, $asset->h_name]);

        return redirect('assettypes')->with('success','Asset has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $asset = Heads::find($id);
        $asset->delete();

        $titlename = $request->input('asname');

        $fnl = \DB::table('fnlyear')->first();
        \DB::update('DELETE from obalances WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$id, $fnl->fn_name, $titlename]);

        return redirect('assettypes')->with('success','Asset has been  Deleted!');
    }
}
