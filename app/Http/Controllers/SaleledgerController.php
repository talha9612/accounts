<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class SaleledgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $fnl = \DB::table('fnlyear')->first();
       $orders = \DB::select('SELECT sl_number, sl_title, sl_item, sl_size, sl_quantity, fr_name, fr_cnic, sl_saleprice , lot_number, sl_total, updated_at, sl_totalprice FROM sales WHERE fyear = ? ORDER BY sl_ID DESC', [$fnl->fn_name]);
        return view('saleledgers.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function printPrsl()
    {
        $pass =\DB::select('SELECT * FROM sales ORDER BY updated_at DESC');
        $pdf = PDF::loadView('PDF.pdfsaleledger', ['pass' => $pass]);
        return $pdf->stream('SaleLedger.pdf');
    }
}
