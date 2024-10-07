<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Newquotes;
use PDF;
class QuotationController extends Controller
{
    /**
     * Display a listing of the Resource.
     *
     * @return \Illuminate\Http\Response.
     */
    public function index(Request $request)
    {
        $records = \DB::select('SELECT DISTINCT(QuotationNumber),REV, IssueDate, CustomerName,Location,Grand_total FROM newquotes ORDER BY QuotationNumber DESC');
        return view('quotes.index', ['records' => $records]);
    }
    /**
     * Show the form for creating a new Resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
  {
        $records = \DB::select('SELECT DISTINCT(AdditionalComments) FROM newquotes WHERE QuotationNumber = (SELECT MAX(QuotationNumber) FROM newquotes)');
        return view('quotes.create', ['records' => $records]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    if(isset($request->qview) && !empty($request->qview))
        {
        $qnumber = $request->input('qnumber');
        $qrev = $request->input('qrev');
        $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM newquotes WHERE QuotationNumber = ? AND REV = ?', [$qnumber,$qrev]);
        $items = \DB::select('SELECT * FROM newquotes WHERE QuotationNumber = ? AND REV = ?', [$qnumber,$qrev]);
        return view('quotes.show', ['records' => $records], ['items' => $items]);
        }
    elseif(isset($request->qedit) && !empty($request->qedit))
        {
        $editqnumber = $request->input('editqnumber');
        $editqrev = $request->input('editqrev');
        $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM newquotes WHERE QuotationNumber = ? AND REV = ?', [$editqnumber,$editqrev]);
        $items = \DB::select('SELECT * FROM newquotes WHERE QuotationNumber = ? AND REV = ?', [$editqnumber,$editqrev]);
        return view('quotes.edit', ['records' => $records], ['items' => $items]);
        }
    elseif(isset($request->qrevise) && !empty($request->qrevise))
        {
        $reviseqnumber = $request->input('reviseqnumber');
        $reviseqrev = $request->input('reviseqrev');
        $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM newquotes WHERE QuotationNumber = ? AND REV = ?', [$reviseqnumber,$reviseqrev] );
        $items = \DB::select('SELECT * FROM newquotes WHERE QuotationNumber = ? AND REV = ?', [$reviseqnumber,$reviseqrev]);
        return view('quotes.revise', ['records' => $records], ['items' => $items]);
        }
    elseif(isset($request->qprint) && !empty($request->qprint))
        {
        $printnumber = $request->input('printnumber');
        $printrev = $request->input('printrev');
        $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM newquotes WHERE QuotationNumber = ? AND REV = ?', [$printnumber,$printrev]);
        $items = \DB::select('SELECT * FROM newquotes WHERE QuotationNumber = ? AND REV = ?', [$printnumber,$printrev]);
        $pdf = PDF::loadView('PDF.pdfnewquote', ['records' => $records], ['items' => $items]);
        return $pdf->stream($printnumber.' .pdf');
        }
    elseif(isset($request->scat) && !empty($request->scat))
        {
        $scat = $request->input('scat');
        $sfdate = $request->input('sfdate');
        $stdate = $request->input('stdate');
        $records = \DB::select('SELECT COUNT(DISTINCT QuotationNumber) as totalq FROM newquotes WHERE category=? AND IssueDate BETWEEN ? AND ?', [$scat, $sfdate, $stdate]);
        $recordo = \DB::select('SELECT COUNT(DISTINCT QuotationNumber) as totalo FROM orders WHERE category=? AND IssueDate BETWEEN ? AND ?',
        [$scat, $sfdate, $stdate]);
        $recordc = \DB::select('SELECT COUNT(DISTINCT QuotationNumber) as totalc FROM cnorders WHERE category=? AND IssueDate BETWEEN ? AND ?', [$scat, $sfdate, $stdate]);
        return view('quotes.summary', ['records' => $records], ['recordo' => $recordo, 'recordc' => $recordc] );
        }
    elseif(isset($request->cat) && ($request->cat != 'ALL'))
        {
        $cat = $request->input('cat');
        $fdate = $request->input('fdate');
        $tdate = $request->input('tdate');
        $records = \DB::select('SELECT DISTINCT QuotationNumber, IssueDate, CustomerName,Grand_total FROM newquotes INNER JOIN (SELECT QuotationNumber AS qn, MAX(REV) AS Maxrv FROM newquotes GROUP BY QuotationNumber) topscore ON newquotes.QuotationNumber = topscore.qn
    AND newquotes.REV = topscore.Maxrv WHERE category=? AND IssueDate BETWEEN ? AND ?', [$cat, $fdate, $tdate]);
      return view('quotes.reports', ['records' => $records, $cat, $fdate, $tdate]);
        }
    elseif(isset($request->cat) && ($request->cat == 'ALL'))
        {
        $cat = $request->input('cat');
        $fdate = $request->input('fdate');
        $tdate = $request->input('tdate');
        $records = \DB::select('SELECT DISTINCT QuotationNumber, IssueDate, CustomerName,Grand_total FROM newquotes INNER JOIN (SELECT QuotationNumber AS qn, MAX(REV) AS Maxrv FROM newquotes GROUP BY QuotationNumber) topscore ON newquotes.QuotationNumber = topscore.qn
    AND newquotes.REV = topscore.Maxrv WHERE IssueDate BETWEEN ? AND ?', [$fdate, $tdate]);
        return view('quotes.reports', ['records' => $records, $cat, $fdate, $tdate]);
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
        $qterms = $request->input('qterms');
        $dperiod = $request->input('dperiod');
        $pterms = $request->input('pterms');
        $currency = $request->input('currency');
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
        Newquotes::insert($items);
        return back()->with('success', 'New Quotation has been Saved Successfully');
        }
        elseif(empty($request->revise))
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
        }
        Newquotes::insert($items);
        }
        return redirect()->action('QuotationController@index');
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
// $records = \DB::select('SELECT DISTINCT(QuotationNumber), IssueDate, CustomerName,Grand_total FROM newquotes ORDER BY QuotationNumber DESC');
        $records = \DB::select('SELECT DISTINCT QuotationNumber, IssueDate, CustomerName,Grand_total FROM newquotes INNER JOIN (SELECT QuotationNumber AS qn, MAX(REV) AS Maxrv FROM newquotes GROUP BY QuotationNumber) topscore ON newquotes.QuotationNumber = topscore.qn
    AND newquotes.REV = topscore.Maxrv ORDER BY QuotationNumber DESC');
        return view('quotes.reports', ['records' => $records]);
    }
  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
      public function showSreport(Request $request,$id)
    {
        $records = \DB::select('SELECT COUNT(DISTINCT QuotationNumber) as totalq FROM newquotes');
        $recordo = \DB::select('SELECT COUNT(DISTINCT QuotationNumber) as totalo FROM orders');
        $recordc = \DB::select('SELECT COUNT(DISTINCT QuotationNumber) as totalc FROM cnorders');
        return view('quotes.summary', ['records' => $records], ['recordo' => $recordo, 'recordc' => $recordc] );
    }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
    public function edit($id)
    {
        $records = \DB::select('SELECT QuotationNumber,REV, IssueDate, CustomerName,Model, UnitPrice FROM newquotes ORDER BY QuotationNumber DESC');
        $recordo = \DB::select('SELECT QuotationNumber,REV, IssueDate, CustomerName,Model, UnitPrice FROM orders ORDER BY QuotationNumber DESC');
        $recordc = \DB::select('SELECT QuotationNumber,REV, IssueDate, CustomerName,Model, UnitPrice FROM cnorders ORDER BY QuotationNumber DESC');
        return view('quotes.modelreport', ['records' => $records] ,['recordo' => $recordo, 'recordc' => $recordc]);
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
            $set = \Carbon\Carbon::parse($date)->format('d-M-Y');
        }
        elseif(empty($request->date))
        {
        $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('d-M-Y');
        }
        $snumber = $request->input('snumber');
        $qref = $request->input('qref');
        $qmonth = $request->input('qmonth');
        $qid = $request->input('qid');
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
    \DB::update('UPDATE newquotes SET Ref = ?, QuotationNumber = ?,QMonth = ?,QYear = ?,REV = ?,category = ?,CustomerName = ?,Attn = ?,Designation = ?,CustomerRFQ = ?,Location = ?,ContactNum = ?,Email = ?,QuotationSubject = ?,IssueDate = ?,ShippingTerms = ?,DeliveryPeriod = ?,PaymentTerms = ?,Currency = ?,ValidTill = ?,PreparedBy = ?,ApprovedBy = ?,AdditionalComments = ?,Description = ?,Model = ?,make = ?,specs = ?,Unit = ?,qty = ?,UnitPrice = ?,TotalPrice = ?,Totalprice_exc = ?,Sale_tax = ? ,Tax_amount = ?,Grand_total = ? WHERE SrNo = ?',[$qref,$qid,$qmonth,$qyear,$qrev,$qcategory,$cname,$cattn,$cdesignation,$crfq,$carea,$cnum,$cemail,$qsubject,$idate,$qterms,$dperiod,$pterms,$currency,$validtill,$preparedby,$approvedby,$notes,$pname[$i],$psize[$i],$scompany[$i],$specs[$i],$unit[$i],$qty[$i],$unitprice[$i],$total[$i],$grandtotal,$gstp,$gstamnt,$grandtotaligst,$snumber[$i]]);
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
                   $data1 = \DB::table('newquotes')
                     ->orderBy('QuotationNumber', 'desc')
                     ->limit(1)
                     ->get();
                     $data2 = \DB::table('orders')
                     ->orderBy('QuotationNumber', 'desc')
                     ->limit(1)
                     ->get();
                     $data3 = \DB::table('cnorders')
                     ->orderBy('QuotationNumber', 'desc')
                     ->limit(1)
                     ->get();
                     foreach($data1 as $row1)
                        $record1 = $row1->QuotationNumber;
                    

                    foreach($data2 as $row2)
                        $record2 = $row2->QuotationNumber;
                    

                    foreach($data3 as $row3)
                        $record3 = $row3->QuotationNumber;
                    

                     $data = max($record1, $record2, $record3);
                  }
                  else
                  {
                    $data = 0;
                  }
                    $output .=
                    ++$data;
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
        $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM newquotes WHERE QuotationNumber = ? AND REV = 0', [$id]  );
        $items = \DB::select('SELECT * FROM newquotes WHERE QuotationNumber = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfnewquote', ['records' => $records], ['items' => $items]);
        return $pdf->stream($id.'_New Quote.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }
       public function printDIB($id)
    {
        $records = \DB::select('SELECT DISTINCT Ref,QuotationNumber,QMonth,QYear,REV,category,CustomerName, Attn,Designation,CustomerRFQ,Location,ContactNum,Email,QuotationSubject,IssueDate,ShippingTerms,DeliveryPeriod,PaymentTerms,Currency,ValidTill,PreparedBy,ApprovedBy,AdditionalComments,Totalprice_exc,Sale_tax,Tax_amount,Grand_total FROM newquotes' );
        $items = \DB::select('SELECT * FROM newquotes ');
        $pdf = PDF::loadView('PDF.pdfdibreport', ['records' => $records], ['items' => $items]);
        return $pdf->stream('_DIB Report.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }
}
