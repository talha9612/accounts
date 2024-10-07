<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $orders = \DB::select('SELECT DISTINCT sl_number, sl_title, sl_name, fr_name, updated_at from sales WHERE sl_type = "GST" AND fyear = ?', [$fnl->fn_name]);
        return view('sales.index', ['orders' => $orders]);
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
        $pass = \DB::select('SELECT * FROM sales WHERE sl_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sl_number, sl_title, sl_name, updated_at, fr_name, fr_ID FROM sales WHERE sl_number = ?', [$id]);
        return view('sales.show', ['pass' => $pass], ['details' => $details]);
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
    public function printSl($id)
    {
        $pass = \DB::select('SELECT * FROM sales WHERE sl_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sl_number, sl_title, sl_name, updated_at, fr_name, fr_cnic FROM sales WHERE sl_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfsale', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_SALE.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }
}
