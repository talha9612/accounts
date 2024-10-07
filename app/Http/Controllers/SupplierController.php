<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obalances;
use App\Suppliers;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $suppliers = \DB::select('SELECT * FROM suppliers');
        return view('suppliers.index', ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sname = $request->input('s_name');
        $sphone = $request->input('s_phone');
        $scompany = $request->input('s_company');
        $sobalance = $request->input('s_obalance');
        $sduedate = $request->input('s_duedate');
        $farmers = array();
        $farmer = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                's_duedate' => $sduedate,
                's_balance' => $sobalance,
                's_obalance' => $sobalance,
                's_company' => $scompany,
                's_phone' => $sphone,
                's_name' => $sname
            );

            $farmers[] = $farmer;

            Suppliers::insert($farmers);

             $id = \DB::getPdo()->lastInsertId();

                $frname = $request->input('s_company');
                $fropbalance = $request->input('s_obalance');
                $fsclyear = $request->input('fsclyear');
                
                $balances = array();
                $balance = array(
                    'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                    'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                    'ob_fyear' => $fsclyear,
                    'ob_amount' => $fropbalance,
                    'sub_name' => $frname,
                    'sub_ID' => $id
                    );

                    $balances[] = $balance;

                Obalances::insert($balances);

        return back()->with('success', 'Supplier has been added');
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
        $supplier = Suppliers::find($id);
        return view('suppliers.edit',compact('supplier','s_ID'));
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

        $sduedate = $request->input('s_duedate');
        \DB::update('UPDATE suppliers SET s_company = ?, s_name = ?, s_phone = ?, s_obalance = ? , s_balance = ?, s_duedate = ?, updated_at = ?  WHERE s_ID = ?', [$request->input('s_company'), $request->input('s_name'), $request->input('s_phone'), $request->input('s_obalance'), $request->input('s_balance'), \Carbon\Carbon::parse($sduedate)->format('d-M-Y'), \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d') ,$request->input('s_ID')]);

         \DB::update('UPDATE obalances SET sub_name = ?, ob_amount = ? WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$request->input('s_company'), $request->input('s_obalance'), $request->input('s_ID'), $fnl->fn_name, $request->input('s_company')]);

        return redirect('suppliers')->with('success','Supplier has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
       $supplier = Suppliers::find($id);
        $supplier->delete();

        $titlename = $request->input('asname');

        $fnl = \DB::table('fnlyear')->first();
        \DB::update('DELETE from obalances WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$id, $fnl->fn_name, $titlename]); 
        return redirect('suppliers')->with('success','Supplier has been  Deleted!');
    }
}
