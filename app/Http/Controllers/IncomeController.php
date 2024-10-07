<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Heads;
use App\Obalances;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expenses = \DB::select('SELECT * FROM heads WHERE h_type = ?', ['Income']);

        return view('incomes.index', ['expenses' => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = \DB::select('SELECT tp_name FROM exptypes WHERE tp_type = ?', ['Income']);
        return view('incomes.create', ['types'=>$types]);
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

        $titlename = $request->input('ex_name');
        $titletype = $request->input('ex_type');
        $titlestype = $request->input('ex_stype');
        $titleopbalance = $request->input('h_opbalance');
        $expenses = array();
        
        $expense = array(
                'updated_at'=> \Carbon\Carbon::now(),
                'created_at'=> \Carbon\Carbon::now(),
                'h_balance' => $titleopbalance,
                'h_opbalance' => $titleopbalance,
                'h_stype' => $titlestype,
                'h_type' => $titletype,
                'h_name' => $titlename
            );

            $expenses[] = $expense;

            Heads::insert($expenses); 

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

        return back()->with('success', 'Income has been added');
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
        $expense = Heads::find($id);
        $types = \DB::select('SELECT tp_name FROM exptypes WHERE tp_type = ?', ['Income']);
        return view('incomes.edit',compact('expense','ex_ID'), ['types'=>$types]);
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

        $expense = Heads::find($id);
        $this->validate(request(), [
          'ex_name' => 'required',
          'ex_type' => 'required'
        ]);
        $expense->h_balance = $request->get('ex_opbalance');
        $expense->h_opbalance = $request->get('ex_opbalance');
        $expense->h_name = $request->get('ex_name');
        $expense->h_stype = $request->get('ex_type');
        $expense->save();

        \DB::update('UPDATE obalances SET sub_name = ?, ob_amount = ? WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$expense->h_name, $expense->h_opbalance, $id, $fnl->fn_name, $expense->h_name]);  

        return redirect('incomes')->with('success','Income has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $expense = Heads::find($id);
        $expense->delete();

        $titlename = $request->input('asname');

         $fnl = \DB::table('fnlyear')->first();
        \DB::update('DELETE from obalances WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$id, $fnl->fn_name, $titlename]); 
        return redirect('incomes')->with('success','Income has been  Deleted!');
    }
}
