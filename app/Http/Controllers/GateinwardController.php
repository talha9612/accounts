<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateinwards;
use PDF;

class GateinwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $orders = \DB::select('SELECT DISTINCT gi_number, gi_title, gi_name, gi_received_by, updated_at from gateinwards WHERE gi_status = "0" AND fyear = ?', [$fnl->fn_name]);
        return view('gateinwards.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ponumber = $request->input('po_number');
        $requisition = \DB::select('SELECT * FROM porders WHERE po_number = ?', [$ponumber]);
        $details = \DB::select('SELECT DISTINCT po_number, po_title, po_name, updated_at, s_name, s_ID, s_company FROM porders WHERE po_number = ?', [$ponumber]);
        return view('gateinwards.create', ['requisition' => $requisition], ['details' => $details]);
        // return view('porders.create');
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

        $titlenumber = $request->input('gi_number');
        $title = $request->input('gi_title');
        $titlename = $request->input('gi_name');
        $titlesname = $request->input('s_name');
        $titlesid = $request->input('s_ID');
        $titlescompany = $request->input('s_company');
        $titlesupplier = $request->input('gi_supplier');
        $titleitem = $request->input('gi_item');
        $titlesize = $request->input('gi_size');
        $titlespecs = $request->input('gi_specifications');
        $titledescription = $request->input('gi_description');
        $titlequantity = $request->input('gi_quantity');
        $titlereceived = $request->input('gi_received_by');
        $titledate = $request->input('created_at');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> \Carbon\Carbon::parse($titledate)->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse($titledate)->format('Y-m-d'),
                'fyear'=> $fsclyear,
                'gi_status' => 0,
                'gi_received_by' => $titlereceived,
                'gi_quantity' => $titlequantity[$i],
                'gi_description' => $titledescription[$i],
                'gi_specs' => $titlespecs[$i],
                'gi_size' => $titlesize[$i],
                'gi_item' => $titleitem[$i],
                'gi_supplier' => $titlesupplier[$i],
                's_company' => $titlescompany,
                's_ID' => $titlesid,
                's_name' => $titlesname,
                'gi_area' => "-",
                'gi_name' => $titlename,
                'gi_title' => $title,
                'gi_number' => $titlenumber
            );

            $items[] = $item;

        }

        Gateinwards::insert($items);
        $requisition = \DB::update('UPDATE porders SET po_status = "1" WHERE po_number = ?', [$titlenumber]);
        return redirect('gateinwards')->with('success','Gate Pass has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pass = \DB::select('SELECT * FROM gateinwards WHERE gi_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT gi_number, gi_title, gi_name, gi_status, gi_received_by, updated_at , gi_status, s_name, s_ID, s_company FROM gateinwards WHERE gi_number = ?', [$id]);
        return view('gateinwards.show', ['pass' => $pass], ['details' => $details]);
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

     public function savedGp()
    {
         $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT gi_number, gi_title, gi_name, updated_at, gi_received_by from gateinwards WHERE gi_status = "1" AND fyear = ?', [$fnl->fn_name]);
        return view('gateinwards.saved', ['requisitions' => $requisitions]);
    }
    public function printGi($id)
    {
        $pass = \DB::select('SELECT * FROM gateinwards WHERE gi_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT gi_number, gi_title, gi_name, updated_at, gi_received_by FROM gateinwards WHERE gi_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfgateinward', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_GATE PASS INWARD.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }
}
