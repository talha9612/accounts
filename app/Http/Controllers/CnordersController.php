<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cnorders;
use App\Newquotes;
class CnordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $records = \DB::select('SELECT DISTINCT QuotationNumber, REV, IssueDate, CustomerName, Grand_total FROM cnorders');
        return view('cnorders.index', ['records' => $records]);
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
      if(isset($request->qview) && !empty($request->qview))
        {
         $qnumber = $request->input('qnumber');  
          $qrev = $request->input('qrev');  
           $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM cnorders WHERE QuotationNumber = ? AND REV = ?', [$qnumber,$qrev]);
                  $items = \DB::select('SELECT * FROM cnorders WHERE QuotationNumber = ? AND REV = ?', [$qnumber,$qrev]);
                  return view('cnorders.show', ['records' => $records], ['items' => $items]);
        }
        
        else
        {
   if(isset($request->idate) && !empty($request->idate))
        {
            $date = $request->input('idate');
            $set = \Carbon\Carbon::parse($date)->format('Y-m-d');
        }
        elseif(empty($request->idate))
        {
            // $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('d-M-Y');
            $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d');
        }
        /////////

     if(isset($request->validtill) && !empty($request->validtill))
        {
            $vdate = $request->input('validtill');
            $vset = \Carbon\Carbon::parse($vdate)->format('Y-m-d');
        }
        elseif(empty($request->validtill))
        {
            // $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('d-M-Y');
            $vset = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d');
        }
         if(isset($request->revise) && !empty($request->revise))
        {
        $qref = $request->input('qref');
        $qid = $request->input('qid');
        $qmonth = $request->input('qmonth');
        $qyear = $request->input('qyear');
        $qrev = $request->input('qrev');
        $qcategory = $request->input('qcategory');
        $cname = $request->input('cname');
        $cattn = $request->input('cattn');
        $cdesignation = $request->input('cdesignation');
        $crfq = $request->input('crfq');
        $carea = $request->input('carea');
        $cnum = $request->input('cnum');
        $cemail = $request->input('cemail');
        $qsubject = $request->input('qsubject');
        // $idate = $request->input('idate');
        $qterms = $request->input('qterms');
        $dperiod = $request->input('dperiod');
        $pterms = $request->input('pterms');
        $currency = $request->input('currency');
        // $validtill = $request->input('validtill');
        $preparedby = $request->input('preparedby');
        $approvedby = $request->input('approvedby');
        $notes = $request->input('notes');
        $pname = $request->input('pname');
        $psize = $request->input('psize');
        $scompany = $request->input('scompany');
        $specs = $request->input('specs');
        $unit = $request->input('unit');
        $qty = $request->input('qty');
        $unitprice = $request->input('unitprice');
        $total = $request->input('total');
        $grandtotal = $request->input('grandtotal');
        $gstp = $request->input('gstp');
        $gstamnt = $request->input('gstamnt');
        $grandtotaligst = $request->input('grandtotaligst');

        $items = array();
        for($i = 0; $i < count($scompany); $i++){
            $item = array(
                'Grand_total'=> $grandtotaligst,
                'Tax_amount'=> $gstamnt,
                'Sale_tax' => $gstp,
                'Totalprice_exc' => $grandtotal,
                'TotalPrice' => $total[$i],
                'UnitPrice' => $unitprice[$i],
                'qty' => $qty[$i],
                'Unit' => $unit[$i],
                'specs' => $specs[$i],
                'make' => $scompany[$i],
                'Model' => $psize[$i],
                'Description' => $pname[$i],
                'AdditionalComments' => $notes,
                'ApprovedBy'=> $approvedby,
                'PreparedBy'=> $preparedby,
                'ValidTill' => $vset,
                'Currency' => $currency,
                'PaymentTerms' => $pterms,
                'DeliveryPeriod' => $dperiod,
                'ShippingTerms' => $qterms,
                'IssueDate' => $set,
                'QuotationSubject' => $qsubject,
                'Email' => $cemail,
                'ContactNum'=> $cnum,
                'Location'=> $carea,
                'CustomerRFQ' => $crfq,
                'Designation' => $cdesignation,
                'Attn' => $cattn,
                'CustomerName' => $cname,
                'category' => $qcategory,
                'REV' => $qrev,
                'QYear' => $qyear,
                'QMonth' => $qmonth,
                'QuotationNumber' => $qid,
                'Ref' => $qref
            );

            $items[] = $item;                        
        }
        Cnorders::insert($items);
            
        }
        elseif(empty($request->revise))
        {
        $snumber = $request->input('snumber');
        $qref = $request->input('qref');
        $qid = $request->input('qid');
        $qmonth = $request->input('qmonth');
        $qyear = $request->input('qyear');
        $qrev = $request->input('qrev');
        $qcategory = $request->input('qcategory');
        $cname = $request->input('cname');
        $cattn = $request->input('cattn');
        $cdesignation = $request->input('cdesignation');
        $crfq = $request->input('crfq');
        $carea = $request->input('carea');
        $cnum = $request->input('cnum');
        $cemail = $request->input('cemail');
        $qsubject = $request->input('qsubject');
        $idate = $request->input('idate');
        $qterms = $request->input('qterms');
        $dperiod = $request->input('dperiod');
        $pterms = $request->input('pterms');
        $currency = $request->input('currency');
        $validtill = $request->input('validtill');
        $preparedby = $request->input('preparedby');
        $approvedby = $request->input('approvedby');
        $notes = $request->input('notes');
        $pname = $request->input('pname');
        $psize = $request->input('psize');
        $scompany = $request->input('scompany');
        $specs = $request->input('specs');
        $unit = $request->input('unit');
        $qty = $request->input('qty');
        $unitprice = $request->input('unitprice');
        $total = $request->input('total');
        $grandtotal = $request->input('grandtotal');
        $gstp = $request->input('gstp');
        $gstamnt = $request->input('gstamnt');
        $grandtotaligst = $request->input('grandtotaligst');

        $items = array();
        for($i = 0; $i < count($scompany); $i++){
            $item = array(
                'Grand_total'=> $grandtotaligst,
                'Tax_amount'=> $gstamnt,
                'Sale_tax' => $gstp,
                'Totalprice_exc' => $grandtotal,
                'TotalPrice' => $total[$i],
                'UnitPrice' => $unitprice[$i],
                'qty' => $qty[$i],
                'Unit' => $unit[$i],
                'specs' => $specs[$i],
                'make' => $scompany[$i],
                'Model' => $psize[$i],
                'Description' => $pname[$i],
                'AdditionalComments' => $notes,
                'ApprovedBy'=> $approvedby,
                'PreparedBy'=> $preparedby,
                'ValidTill' => $validtill,
                'Currency' => $currency,
                'PaymentTerms' => $pterms,
                'DeliveryPeriod' => $dperiod,
                'ShippingTerms' => $qterms,
                'IssueDate' => $set,
                'QuotationSubject' => $qsubject,
                'Email' => $cemail,
                'ContactNum'=> $cnum,
                'Location'=> $carea,
                'CustomerRFQ' => $crfq,
                'Designation' => $cdesignation,
                'Attn' => $cattn,
                'CustomerName' => $cname,
                'category' => $qcategory,
                'REV' => $qrev,
                'QYear' => $qyear,
                'QMonth' => $qmonth,
                'QuotationNumber' => $qid,
                'Ref' => $qref
            );

        
            $items[] = $item;  
       
        $order = Newquotes::find($snumber[$i]);
        $order->delete();
            // \DB::table('newquotes')
                            
        }
        Cnorders::insert($items);

        }


         return back()->with('success', 'Quotation has been Successfully Forwarded to Cancelled Orders');
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
}
