<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateoutwards;
use App\Sales;
use PDF;

class GateoutwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $orders = \DB::select('SELECT DISTINCT go_number, go_title, go_name, fr_name, updated_at from gateoutwards WHERE fyear = ?', [$fnl->fn_name]);
        return view('gateoutwards.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sqnumber = $request->input('sq_number');
        $pass = \DB::select('SELECT * FROM squotations WHERE sq_number = ?', [$sqnumber]);
        $details = \DB::select('SELECT DISTINCT sq_number, sq_title, sq_name, updated_at, fr_name, fr_cnic, fr_gst, fr_ID, sq_grandtotal FROM squotations WHERE sq_number = ?', [$sqnumber]);
        return view('gateoutwards.create', ['pass' => $pass], ['details' => $details]);
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
        if(isset($request->date) && !empty($request->date))
        {
            $date = $request->input('date');
            $set = \Carbon\Carbon::parse($date)->format('Y-m-d');
        }
        elseif(empty($request->date))
        {
            // $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('d-M-Y');
            $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d');

        }

        $titleID = $request->input('go_i_ID');
        $titlenumber = $request->input('go_number');
        $titledc = $request->input('dc_number');
        $titlefarmerid = $request->input('fr_ID');
        $titlefarmername = $request->input('fr_name');
        $titlefarmercnic = $request->input('fr_cnic');
        $title = $request->input('go_title');
        $titlename = $request->input('go_name');
        $titlelotnumber = $request->input('lot_number');
        $titleitem = $request->input('go_item');
        $titlesize = $request->input('go_size');
        $titlequantity = $request->input('go_quantity');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'go_quantity' => $titlequantity[$i],
                'go_size' => $titlesize[$i],
                'go_item' => $titleitem[$i],
                'lot_number' => $titlelotnumber[$i],
                'go_area' => '-',
                'go_name' => $titlename,
                'go_title' => $title,
                'fr_cnic' => $titlefarmercnic,
                'fr_name' => $titlefarmername,
                'fr_ID' => $titlefarmerid,
                'dc_number' => $titledc,
                'go_number' => $titlenumber
            );
           
            $items[] = $item; 

            $sales = \DB::update('UPDATE stocks SET ss_quantity = ss_quantity - ?, updated_at = ? WHERE ss_ID = ?', [$titlequantity[$i], \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'), $titleID[$i]]);

        }
        Gateoutwards::insert($items);
        $requisition = \DB::update('UPDATE squotations SET sq_status = "1", dc_number = ? WHERE sq_number = ?', [$titledc, $titlenumber]);

        // FOR SALES TABLE
        $titleID = $request->input('go_i_ID');
        $titlenumber = $request->input('go_number');
        $titlefarmerid = $request->input('fr_ID');
        $titlefarmername = $request->input('fr_name');
        $titlefarmercnic = $request->input('fr_cnic');
        $title = $request->input('go_title');
        $titlename = $request->input('go_name');
        $titlelotnumber = $request->input('lot_number');
        $titleitem = $request->input('go_item');
        $titlesize = $request->input('go_size');
        $titlequantity = $request->input('go_quantity');
        $titlesaleprice = $request->input('sq_saleprice');
        $titletotal = $request->input('sq_total');
        $titletotalprice = $request->input('sq_totalprice');
        $totalprice = $request->input('totalprice');
        $grandtotal = $request->input('sq_grandtotal');        



        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'sl_type' => 'GST',
                'sl_grandtotal' => $grandtotal[$i],
                'sl_totalprice' => $titletotalprice[$i],
                'sl_total' => $titletotal[$i],
                'sl_saleprice' => $titlesaleprice[$i],
                'sl_quantity' => $titlequantity[$i],
                'sl_size' => $titlesize[$i],
                'sl_item' => $titleitem[$i],
                'sl_i_ID' => $titleID[$i],
                'lot_number' => $titlelotnumber[$i],
                'sl_area' => '-',
                'sl_name' => $titlename,
                'sl_title' => $title,
                'fr_cnic' => $titlefarmercnic,
                'fr_name' => $titlefarmername,
                'fr_ID' => $titlefarmerid,
                'sl_number' => $titlenumber
            );

            $items[] = $item;  
        }
        Sales::insert($items);
        $farmer = \DB::update('UPDATE farmers SET fr_balance = fr_balance + ?, updated_at = ? WHERE fr_ID = ?', 
            [$totalprice, \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'), $titlefarmerid]);


        return redirect('gateoutwards')->with('success','Gate Pass has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pass = \DB::select('SELECT * FROM gateoutwards WHERE go_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT go_number, go_title, go_name, updated_at, fr_ID , fr_name, fr_cnic  FROM gateoutwards WHERE go_number = ?', [$id]);
        return view('gateoutwards.show', ['pass' => $pass], ['details' => $details]);
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
    public function printGo($id)
    {
        $pass = \DB::select('SELECT * FROM gateoutwards WHERE go_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT go_number, go_title, go_name, updated_at, fr_name, fr_cnic FROM gateoutwards WHERE go_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfgateoutward', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_OUTWARD GATEPASS.pdf');
    }
}
