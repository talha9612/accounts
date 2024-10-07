<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Porders;
use PDF;

class PorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $orders = \DB::select('SELECT DISTINCT po_number, po_title, po_name, po_grandtotal, updated_at from porders WHERE po_status = "0" AND po_type = "local" AND fyear = ?', [$fnl->fn_name]);
        return view('porders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $prnumber = $request->input('pr_number');
        $requisition = \DB::select('SELECT * FROM prequisitions WHERE pr_number = ?', [$prnumber]);
        $details = \DB::select('SELECT DISTINCT pr_number, pr_title, pr_name, updated_at FROM prequisitions WHERE pr_number = ?', [$prnumber]);
        return view('porders.create', ['requisition' => $requisition], ['details' => $details]);
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

        $type = $request->input('optionsType');

         if($type == 'local')
        {

        $titlenumber = $request->input('po_number');
        $title = $request->input('po_title');
        $titlename = $request->input('po_name');
        $titlesname = $request->input('s_name');
        $titlesid = $request->input('s_ID');
        $titlescompany = $request->input('s_company');
        $titlesupplier = $request->input('po_supplier');
        $titleitem = $request->input('po_item');
        $titlesize = $request->input('po_size');
        $titlespecs = $request->input('po_specifications');
        $titledescription = $request->input('po_description');
        $titlequantity = $request->input('po_quantity');
        $titleunitprice = $request->input('po_unitprice');
        $titlegstp = $request->input('po_gstp');
        $titlegst = $request->input('po_gst');
        $titletotalprice = $request->input('po_totalprice');
        $titlegrandtotal = $request->input('po_grandtotal');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'po_status' => 0,
                'po_grandtotal' => $titlegrandtotal,
                'po_totalprice' => $titletotalprice,
                'po_gst' => $titlegst,
                'po_gstp' => $titlegstp,
                'po_conrate' => 0,
                'po_currency' => 0,
                'po_iamount' => 0,
                'po_itype' => 0,
                'po_type' => $type,
                'po_unitpricepkr' => $titleunitprice[$i],
                'po_unitprice' => $titleunitprice[$i],
                'po_quantity' => $titlequantity[$i],
                'po_description' => $titledescription[$i],
                'po_specs' => $titlespecs[$i],
                'po_size' => $titlesize[$i],
                'po_item' => $titleitem[$i],
                'po_supplier' => $titlesupplier[$i],
                's_company' => $titlescompany,
                's_ID' => $titlesid,
                's_name' => $titlesname,
                'po_area' => "-",
                'po_name' => $titlename,
                'po_title' => $title,
                'po_number' => $titlenumber
            );

            $items[] = $item; 
        }

        Porders::insert($items);
        $requisition = \DB::update('UPDATE prequisitions SET pr_status = "2" WHERE pr_number = ?', [$titlenumber]);
        $supplier = \DB::update('UPDATE suppliers SET s_balance = s_balance + ? WHERE s_ID = ?', [$titlegrandtotal, $titlesid]);
       return redirect('porders')->with('success','Purchase Order has been added');

        }

         elseif($type == 'imports')
        {

        $titlenumber = $request->input('po_number');
        $title = $request->input('po_title');
        $titlename = $request->input('po_name');
        $titlesname = $request->input('s_name');
        $titlesid = $request->input('s_ID');
        $titlescompany = $request->input('s_company');
        $titlesupplier = $request->input('po_supplier');
        $titleitem = $request->input('po_item');
        $titlesize = $request->input('po_size');
        $titlespecs = $request->input('po_specifications');
        $titledescription = $request->input('po_description');
        $titlequantity = $request->input('po_quantity');
        $titleunitprice = $request->input('po_unitprice');
        $titleunitpricepkr = $request->input('po_unitpricepkr');
        $titleitype = $request->input('options');
        $titleiamount = $request->input('amounttype');
        $titlecurrency = $request->input('optionsCurrency');
        $titleconrate = $request->input('co_rate');
        $titletotalprice = $request->input('co_unit');
        $titlegrandtotal = $request->input('co_totalprice');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'po_status' => 0,
                'fyear'=> $fsclyear,
                'po_grandtotal' => $titlegrandtotal,
                'po_totalprice' => $titletotalprice,
                'po_gst' => 0,
                'po_gstp' => 0,
                'po_conrate' => $titleconrate,
                'po_currency' => $titlecurrency,
                'po_iamount' => $titleiamount,
                'po_itype' => $titleitype,
                'po_type' => $type,
                'po_unitpricepkr' => $titleunitpricepkr[$i],
                'po_unitprice' => $titleunitprice[$i],
                'po_quantity' => $titlequantity[$i],
                'po_description' => $titledescription[$i],
                'po_specs' => $titlespecs[$i],
                'po_size' => $titlesize[$i],
                'po_item' => $titleitem[$i],
                'po_supplier' => $titlesupplier[$i],
                's_company' => $titlescompany,
                's_ID' => $titlesid,
                's_name' => $titlesname,
                'po_area' => "-",
                'po_name' => $titlename,
                'po_title' => $title,
                'po_number' => $titlenumber
            );

            $items[] = $item; 
        }

        Porders::insert($items);
        $requisition = \DB::update('UPDATE prequisitions SET pr_status = "2" WHERE pr_number = ?', [$titlenumber]);
        $supplier = \DB::update('UPDATE suppliers SET s_balance = s_balance + ? WHERE s_ID = ?', [$request->input('co_totalprice'), $titlesid]);
       return redirect('porders')->with('success','Purchase Order has been added');
             
        }

        else
        {
             return redirect('porders')->with('warning','Please select a valid option');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = \DB::select('SELECT * FROM porders WHERE po_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT po_number, po_title, po_name, po_totalprice, po_status, updated_at, s_name, s_ID, s_company FROM porders WHERE po_number = ?', [$id]);
        return view('porders.show', ['order' => $order], ['details' => $details]);
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

     public function savedPo()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT po_number, po_title, po_name, po_grandtotal, updated_at, po_status from porders WHERE po_status = "1" AND po_type = "local" AND fyear = ?', [$fnl->fn_name]);
        return view('porders.saved', ['requisitions' => $requisitions]);
    }

     public function importPo()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT po_number, po_title, po_name, po_totalprice, updated_at, po_status, po_grandtotal from porders WHERE po_status = "0" AND po_type = "imports"AND fyear = ?', [$fnl->fn_name]);
        return view('porders.import', ['requisitions' => $requisitions]);
    }
    public function importFinal()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT po_number, po_title, po_name, po_grandtotal, updated_at, po_status from porders WHERE po_status = "1" AND po_type = "imports" AND fyear = ?', [$fnl->fn_name]);
        return view('porders.import', ['requisitions' => $requisitions]);
    }

    public function printPo($id)
    {
        $pass = \DB::select('SELECT * FROM porders WHERE po_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT po_number, po_title, po_name, s_name, s_company, updated_at FROM porders WHERE po_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfporder', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_PURCHASE ORDER.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }

    public function printPoimport($id)
    {
        $pass = \DB::select('SELECT * FROM porders WHERE po_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT po_number, po_title, po_name, s_name , s_company, updated_at FROM porders WHERE po_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfporderimport', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_PURCHASE ORDER.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }

    public function showImport($id)
    {
        $order = \DB::select('SELECT * FROM porders WHERE po_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT po_number, po_title, po_name, po_grandtotal, po_status, updated_at, s_name, s_ID, s_company FROM porders WHERE po_number = ?', [$id]);
        return view('porders.showimport', ['order' => $order], ['details' => $details]);
    }

     public function searchSupplier(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('suppliers');
        if($request->type=='farmername'){
            $countries->where('s_name','LIKE','%'.$query.'%');
        }
        if($request->type=='farmerid'){
            $countries->where('s_ID','LIKE','%'.$query.'%');
        }
         if($request->type=='farmercnic'){
            $countries->where('s_company','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('s_name'=>$country->s_name,'s_ID'=>$country->s_ID,'s_company'=>$country->s_company);
        }
        if(count($data))
             return $data;
        else
            return ['s_name'=>'','s_ID'=>'','s_company'=>''];
    }
}
