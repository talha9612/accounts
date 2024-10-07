<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scvaluations;
use App\Stocks;
use PDF;


class ScvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $orders = \DB::select('SELECT DISTINCT sc_number, sc_title, sc_name, updated_at , lot_number from scvaluations WHERE sc_status = "0" AND fyear = ?', [$fnl->fn_name]);
        return view('scvaluations.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $prnumber = $request->input('pr_number');
        $requisition = \DB::select('SELECT * FROM porders WHERE po_number = ?', [$prnumber]);
        $requisition[0]->po_iamount = 0;
        $details = \DB::select('SELECT DISTINCT po_number, po_title, po_name, po_iamount, po_conrate, po_itype, updated_at, s_name, s_ID, s_company FROM porders WHERE po_number = ?', [$prnumber]);
        $lot = \DB::select('SELECT DISTINCT lot_number FROM mrreports WHERE mr_number = ?', [$prnumber]);
        return view('scvaluations.create', ['requisition' => $requisition], ['details' => $details, 'lot' => $lot]);
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

        if(isset($request->addstock) && !empty($request->addstock))
        {
                $titlename = $request->input('ss_name');
                $titlesname = $request->input('s_name');
                $titlesid = $request->input('s_ID');
                $titlescompany = $request->input('s_company');
                $titlesupplier = $request->input('ss_supplier');
                $titleitem = $request->input('ss_item');
                $titlesize = $request->input('ss_size');
                $titlespecs = $request->input('ss_specs');
                $titledescription = $request->input('ss_description');
                $titlequantity = $request->input('ss_quantity');
                // $titleunitprice = $request->input('ss_unitprice');
                // $titletotalprice = $request->input('total');
                $titlecostunit = $request->input('ss_costunit');
                // $titlelotnumber = $request->input('lot_number');

                $items = array();
                
                    $item = array(
                        'updated_at'=> $set,
                        'created_at'=> $set,
                        'ss_saleprice' => 0,
                        'ss_costunit' => $titlecostunit,
                        'lot_number' => 'LT-00000',
                        'ss_unitprice' => 0,
                        'ss_quantity' => $titlequantity,
                        'ss_description' => $titledescription,
                        'ss_specs' => $titlespecs,
                        'ss_size' => $titlesize,
                        'ss_item' => $titleitem,
                        'ss_supplier' => $titlesupplier,
                        's_company' => $titlescompany,
                        's_ID' => $titlesid,
                        's_name' => $titlesname,
                        'ss_area' => '-',
                        'ss_title' => 'Added from Products',
                        'ss_name' => $titlename,
                        'ss_number' => 0
                    );

                    $items[] = $item;
                   
                Stocks::insert($items);
                return redirect('products')->with('success','Products are added to the stock');
        }

        else
            {
                $titlenumber = $request->input('po_number');
                $title = $request->input('po_title');
                $titlename = $request->input('po_name');
                $titlesname = $request->input('s_name');
                $titlesid = $request->input('s_ID');
                $titlescompany = $request->input('s_company');
                $titlesupplier = $request->input('sc_supplier');
                $titleitem = $request->input('po_item');
                $titlesize = $request->input('po_size');
                $titlespecs = $request->input('sc_specifications');
                $titledescription = $request->input('po_description');
                $titlequantity = $request->input('po_quantity');
                $titleunitprice = $request->input('po_unitprice');
                $titletotalprice = $request->input('total');
                    $titleexppu = $request->input('exp_pu');
                    $titleucp = $request->input('ucp');
                $titlefreight = $request->input('sc_freight');
                $titlelabour = $request->input('sc_labour');
                $titlemiscellaneous = $request->input('sc_misc');
                $titlecostunit = $request->input('costunit');
                    $titletotalunits = $request->input('totalunits');
                    $titletotalexpense = $request->input('totalexpenses');
                    $titleppexpense = $request->input('perpeiceexpenses');
                    $titlegrandtotal = $request->input('sc_grandtotal');
                $titlelotnumber = $request->input('lot_number');

                $items = array();
                for($i = 0; $i < count($titleitem); $i++){
                    $item = array(
                        'updated_at'=> $set,
                        'created_at'=> $set,
                        'fyear'=> $fsclyear,
                        'sc_status' => 0,
                            'sc_grandtotal' => $titlegrandtotal,
                            'sc_ppexpense' => $titleppexpense,
                            'sc_totalexpense' => $titletotalexpense,
                            'sc_totalunits' => $titletotalunits,
                        'sc_costunit' => $titlecostunit[$i],
                        'sc_miscellaneous' => $titlemiscellaneous,
                        'sc_labour' => $titlelabour,
                        'sc_freight' => $titlefreight,
                        'lot_number' => $titlelotnumber,
                            'sc_ucp' => $titleucp[$i],
                            'sc_exppu' => $titleexppu[$i],
                        'sc_totalprice' => $titletotalprice[$i],
                        'sc_unitprice' => $titleunitprice[$i],
                        'sc_quantity' => $titlequantity[$i],
                        'sc_description' => $titledescription[$i],
                        'sc_specs' => $titlespecs[$i],
                        'sc_size' => $titlesize[$i],
                        'sc_item' => $titleitem[$i],
                        'sc_supplier' => $titlesupplier[$i],
                        's_company' => $titlescompany,
                        's_ID' => $titlesid,
                        's_name' => $titlesname,
                        'sc_area' => "-",
                        'sc_title' => $title,
                        'sc_name' => $titlename,
                        'sc_number' => $titlenumber
                    );

                    $items[] = $item;
                   
                }

                Scvaluations::insert($items);
                $requisition = \DB::update('UPDATE mrreports SET mr_status = "1" WHERE mr_number = ?', [$titlenumber]);


                $titlenumber = $request->input('po_number');
                $title = $request->input('po_title');
                $titlename = $request->input('po_name');
                $titlesname = $request->input('s_name');
                $titlesid = $request->input('s_ID');
                $titlescompany = $request->input('s_company');
                $titlesupplier = $request->input('sc_supplier');
                $titleitem = $request->input('po_item');
                $titlesize = $request->input('po_size');
                $titlespecs = $request->input('sc_specifications');
                $titledescription = $request->input('po_description');
                $titlequantity = $request->input('po_quantity');
                $titleunitprice = $request->input('po_unitprice');
                $titletotalprice = $request->input('total');
                $titlecostunit = $request->input('ucp');
                $titlelotnumber = $request->input('lot_number');

                $items = array();
                for($i = 0; $i < count($titleitem); $i++){
                    $item = array(
                        'updated_at'=> $set,
                        'created_at'=> $set,
                        'ss_saleprice' => 0,
                        'ss_costunit' => $titlecostunit[$i],
                        'lot_number' => $titlelotnumber,
                        'ss_unitprice' => $titleunitprice[$i],
                        'ss_quantity' => $titlequantity[$i],
                        'ss_description' => $titledescription[$i],
                        'ss_specs' => $titlespecs[$i],
                        'ss_size' => $titlesize[$i],
                        'ss_item' => $titleitem[$i],
                        'ss_supplier' => $titlesupplier[$i],
                        's_company' => $titlescompany,
                        's_ID' => $titlesid,
                        's_name' => $titlesname,
                        'ss_area' => "-",
                        'ss_title' => $title,
                        'ss_name' => $titlename,
                        'ss_number' => $titlenumber
                    );

                    $items[] = $item;
                   
                }

                Stocks::insert($items);
                return redirect('scvaluations')->with('success','Cost Valuation has been added');
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
        $pass = \DB::select('SELECT * FROM scvaluations WHERE sc_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sc_number, sc_title, sc_name, updated_at, lot_number, s_name, s_ID, s_company FROM scvaluations WHERE sc_number = ?', [$id]);
        return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
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
    public function printSc($id)
    {
        $pass = \DB::select('SELECT * FROM scvaluations WHERE sc_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sc_number, sc_title, sc_name, updated_at , lot_number FROM scvaluations WHERE sc_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfscvaluation', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_COST VALUATION.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }
}
