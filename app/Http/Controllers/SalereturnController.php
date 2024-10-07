<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salereturns;

class SalereturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $fnl = \DB::table('fnlyear')->first();
        $orders = \DB::select('SELECT slr_number, slr_title, slr_item, slr_quantity, fr_name, updated_at from salereturns WHERE fyear = ?', [$fnl->fn_name]);
        return view('salereturns.index', ['orders' => $orders]);
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
                // FOR SALES TABLE
        $titleID = $request->input('slr_i_ID');
        $titlenumber = $request->input('slr_number');
        $titlefarmerid = $request->input('fr_ID');
        $titlefarmername = $request->input('slr_crname');
        $titlefarmercnic = $request->input('fr_cnic');
        $title = $request->input('slr_title');
        $titlename = $request->input('slr_name');
        $titlelotnumber = $request->input('lot_number');
        $titleitem = $request->input('slr_item');
        $titlesize = $request->input('slr_size');
        $titlequantity = $request->input('slr_quantity');
        $titlesaleprice = $request->input('slr_saleprice');    



        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'slr_saleprice' => $titlesaleprice[$i],
                'slr_quantity' => $titlequantity[$i],
                'slr_size' => $titlesize[$i],
                'slr_item' => $titleitem[$i],
                'slr_i_ID' => $titleID[$i],
                'lot_number' => $titlelotnumber[$i],
                'slr_name' => $titlename,
                'slr_title' => $title,
                'fr_cnic' => $titlefarmercnic,
                'fr_name' => $titlefarmername,
                'fr_ID' => $titlefarmerid,
                'slr_number' => $titlenumber
            );

            $items[] = $item;  
            $farmer = \DB::update('UPDATE stocks SET ss_quantity = ss_quantity + ?, updated_at = ? WHERE ss_ID = ?', 
            [$titlequantity[$i], \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'), $titleID[$i]]);

            $farmer = \DB::update('UPDATE farmers SET fr_balance = fr_balance - ?, updated_at = ? WHERE fr_ID = ?', 
            [$titlequantity[$i] * $titlesaleprice[$i], \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'), $titlefarmerid]);
        }
        Salereturns::insert($items);
        return redirect('salereturns')->with('success','Sale Return has been added');
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
        $details = \DB::select('SELECT DISTINCT sl_number, sl_title, sl_name, updated_at, fr_name, fr_ID, fr_cnic FROM sales WHERE sl_number = ?', [$id]);
        return view('salereturns.show', ['pass' => $pass], ['details' => $details]);
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
}
