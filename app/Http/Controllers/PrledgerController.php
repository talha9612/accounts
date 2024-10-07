<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PrledgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $orders = \DB::select('SELECT DISTINCT po_number, po_name, po_title, s_company, po_grandtotal, updated_at FROM porders WHERE fyear = ?', [$fnl->fn_name]);
        return view('prledgers.index', ['orders' => $orders]);
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
    public function printPrl()
    {
        $pass = \DB::select('SELECT DISTINCT po_number, po_name, po_title, s_company, po_grandtotal, updated_at FROM porders ORDER BY po_number ASC');
        $pdf = PDF::loadView('PDF.pdfpurchaseledger', ['pass' => $pass]);
        return $pdf->stream('PurchaseLedger.pdf');
    }
}
