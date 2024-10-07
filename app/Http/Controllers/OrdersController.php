<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Orders;
use App\Newquotes;
use PDF;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	$records = \DB::select('SELECT DISTINCT QuotationNumber, REV, IssueDate, CustomerName, Grand_total FROM orders');
        return view('orders.index', ['records' => $records]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('quotes.create');
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
           $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM orders WHERE QuotationNumber = ? AND REV = ?', [$qnumber,$qrev]);
                  $items = \DB::select('SELECT * FROM orders WHERE QuotationNumber = ? AND REV = ?', [$qnumber,$qrev]);
                  return view('orders.show', ['records' => $records], ['items' => $items]);
        }
        elseif(isset($request->qedit) && !empty($request->qedit))
        {
         $editqnumber = $request->input('editqnumber');  
          $editqrev = $request->input('editqrev');  
            $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM orders WHERE QuotationNumber = ? AND REV = ?', [$editqnumber,$editqrev]);
        $items = \DB::select('SELECT * FROM orders WHERE QuotationNumber = ? AND REV = ?', [$editqnumber,$editqrev]);
        return view('quotes.edit', ['records' => $records], ['items' => $items]);
        }

        elseif(isset($request->qrevise) && !empty($request->qrevise))
        {
         $reviseqnumber = $request->input('reviseqnumber');  
          $reviseqrev = $request->input('reviseqrev');  
             $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM orders WHERE QuotationNumber = ? AND REV = ?', [$reviseqnumber,$reviseqrev] );
        $items = \DB::select('SELECT * FROM orders WHERE QuotationNumber = ? AND REV = ?', [$reviseqnumber,$reviseqrev]);
        return view('quotes.revise', ['records' => $records], ['items' => $items]);
        }
         elseif(isset($request->qprint) && !empty($request->qprint))
        {
         $printnumber = $request->input('printnumber');  
          $printrev = $request->input('printrev');  
            $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM orders WHERE QuotationNumber = ? AND REV = ?', [$printnumber,$printrev]);
        $items = \DB::select('SELECT * FROM orders WHERE QuotationNumber = ? AND REV = ?', [$printnumber,$printrev]);
        $pdf = PDF::loadView('PDF.pdfnewquote', ['records' => $records], ['items' => $items]);
        return $pdf->stream($printnumber.' .pdf');
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
        Orders::insert($items);
            
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
        Orders::insert($items);

        }


         return back()->with('success', 'Quotation has been Successfully Forwarded to Orders');
   }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
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

     
    for($i = 0; $i < count($scompany); $i++){
    \DB::update('UPDATE orders SET Ref = ?, QuotationNumber = ?,QMonth = ?,QYear = ?,REV = ?,category = ?,CustomerName = ?,Attn = ?,Designation = ?,CustomerRFQ = ?,Location = ?,ContactNum = ?,Email = ?,QuotationSubject = ?,IssueDate = ?,ShippingTerms = ?,DeliveryPeriod = ?,PaymentTerms = ?,Currency = ?,ValidTill = ?,PreparedBy = ?,ApprovedBy = ?,AdditionalComments = ?,Description = ?,Model = ?,make = ?,specs = ?,Unit = ?,qty = ?,UnitPrice = ?,TotalPrice = ?,Totalprice_exc = ?,Sale_tax = ? ,Tax_amount = ?,Grand_total = ? WHERE SrNo = ?',[$qref,$qid,$qmonth,$qyear,$qrev,$qcategory,$cname,$cattn,$cdesignation,$crfq,$carea,$cnum,$cemail,$qsubject,$idate,$qterms,$dperiod,$pterms,$currency,$validtill,$preparedby,$approvedby,$notes,$pname[$i],$psize[$i],$scompany[$i],$specs[$i],$unit[$i],$qty[$i],$unitprice[$i],$total[$i],$grandtotal,$gstp,$gstamnt,$grandtotaligst,$snumber[$i]]);   
        }
        
         return back()->with('success', 'Quotation updated Successfully');
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
public function revise($id)
    {
        // 
    }
     public function searchQuote(Request $request)
    {
            if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('orders')
                 ->orderBy('QuotationNumber', 'desc')
                 ->limit(1)
                 ->get(); 
              }
              else
              {
              }
              $total_row = $data->count();
              if($total_row > 0)
              {
               foreach($data as $row)
               {
                $output .=
                ++$row->QuotationNumber;
               }
              }
              else
              {
               $output = '0';
              }
              $data = array(
               'table_data'  => $output
              );
              echo json_encode($data);
        }
    }
     public function searchAttn(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('cpersons');
        if($request->type=='customername'){
            $countries->where('c_name','LIKE','%'.$query.'%');
        }
        if($request->type=='attn'){
            $countries->where('cp_name','LIKE','%'.$query.'%');
        }

           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('c_name'=>$country->c_name,'cp_name'=>$country->cp_name,'cp_designation'=>$country->cp_designation,'cp_cell'=>$country->cp_cell,'cp_email'=>$country->cp_email);
        }
        if(count($data))
             return $data;
        else
            return ['c_name'=>'','cp_name'=>'','cp_designation'=>'','cp_cell'=>'','cp_email'=>''];
    }
         public function searchproductQuote(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('products');
        if($request->type=='pname'){
            $countries->where('p_name','LIKE','%'.$query.'%');
        }
        if($request->type=='psize'){
            $countries->where('p_size','LIKE','%'.$query.'%');
        }
        if($request->type=='scompany'){
            $countries->where('s_company','LIKE','%'.$query.'%');
        }
        if($request->type=='specs'){
            $countries->where('p_specs','LIKE','%'.$query.'%');
        }
      $countries=$countries->get();        
      $data=array();
      foreach ($countries as $country) {
        $data[]=array('p_name'=>$country->p_name,'p_size'=>$country->p_size ,'s_company'=>$country->s_company,'p_specs'=>$country->p_specs);
        }
        if(count($data))
             return $data;
        else
        return ['p_name'=>'','p_size'=>'','s_company'=>''];
    }
     public function printQuote($id)
    {
        $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM orders WHERE QuotationNumber = ? AND REV = 0', [$id]  );
        $items = \DB::select('SELECT * FROM orders WHERE QuotationNumber = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfnewquote', ['records' => $records], ['items' => $items]);
        return $pdf->stream($id.'_New Quote.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }
}
