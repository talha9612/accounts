<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prequisitions;
use PDF;

class PrequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT pr_number, pr_title, pr_name, updated_at from prequisitions WHERE pr_status = "1" AND fyear = ?', [$fnl->fn_name]);
        return view('prequisitions.index', ['requisitions' => $requisitions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('prequisitions.create');
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

        $titlereq = $request->input('pr_req');

        if(!$titlereq == "")
        {
        $titlenumber = $request->input('pr_number');
        $title = $request->input('pr_title');
        $titlename = $request->input('pr_name');
        $titlesupplier = $request->input('pr_supplier');
        $titleitem = $request->input('pr_item');
        $titlesize = $request->input('pr_size');
        $titlespecs = $request->input('pr_specifications');
        $titledescription = $request->input('pr_description');
        $titlequantity = $request->input('pr_quantity');
        // $titleunitprice = $request->input('pr_unitprice');
        // $titletotalprice = $request->input('pr_totalprice');
        $requisition = \DB::delete('DELETE FROM prequisitions WHERE pr_number = ?', [$titlenumber]); 
        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                // 'pr_totalprice' => $titletotalprice,
                // 'pr_unitprice' => $titleunitprice[$i],
                'fyear'=> $fsclyear,
                'pr_status' => 0,
                'pr_quantity' => $titlequantity[$i],
                'pr_description' => $titledescription[$i],
                'pr_specs' => $titlespecs[$i],
                'pr_size' => $titlesize[$i],
                'pr_item' => $titleitem[$i],
                's_company' => $titlesupplier[$i],
                'pr_area' => "-",
                'pr_name' => $titlename,
                'pr_title' => $title,
                'pr_number' => $titlenumber
            );

            $items[] = $item;
           
        }

        Prequisitions::insert($items);
        return back()->with('success', 'Purchase Requisition updated successfully');
        }

        else{
        $titlenumber = $request->input('pr_number');
        $title = $request->input('pr_title');
        $titlename = $request->input('pr_name');
        $titlesupplier = $request->input('pr_supplier');
        $titleitem = $request->input('pr_item');
        $titlesize = $request->input('pr_size');
        $titlespecs = $request->input('pr_specifications');
        $titledescription = $request->input('pr_description');
        $titlequantity = $request->input('pr_quantity');
        // $titleunitprice = $request->input('pr_unitprice');
        // $titletotalprice = $request->input('pr_totalprice');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                // 'pr_totalprice' => $titletotalprice,
                // 'pr_unitprice' => $titleunitprice[$i],
                'fyear'=> $fsclyear,
                'pr_status' => 1,
                'pr_quantity' => $titlequantity[$i],
                'pr_description' => $titledescription[$i],
                'pr_specs' => $titlespecs[$i],
                'pr_size' => $titlesize[$i],
                'pr_item' => $titleitem[$i],
                's_company' => $titlesupplier[$i],
                'pr_area' => "-",
                'pr_name' => $titlename,
                'pr_title' => $title,
                'pr_number' => $titlenumber
            );

            $items[] = $item;
        }

        Prequisitions::insert($items);
       return redirect('SavedPr')->with('success','Purchase Requisition has been added and Posted');
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
        $requisition = \DB::select('SELECT * FROM prequisitions WHERE pr_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT pr_number, pr_title, pr_name, updated_at FROM prequisitions WHERE pr_number = ?', [$id]);
        return view('prequisitions.show', ['requisition' => $requisition], ['details' => $details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisition = \DB::select('SELECT * FROM prequisitions WHERE pr_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT pr_number, pr_title, pr_name, updated_at FROM prequisitions WHERE pr_number = ?', [$id]);
        return view('prequisitions.edit', ['requisition' => $requisition], ['details' => $details]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requisition = \DB::delete('DELETE FROM prequisitions WHERE pr_number = ?', [$id]);
        return back()->with('success', 'Purchase Requisition has been Deleted');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function savedPr()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT pr_number, pr_title, pr_name, updated_at from prequisitions WHERE pr_status = "0" AND fyear = ?', [$fnl->fn_name]);
        return view('prequisitions.saved', ['requisitions' => $requisitions]);
    }

    public function savePr(Request $request)
    {
        $number = $request->input('pr_number');
        $requisition = \DB::update('UPDATE prequisitions SET pr_status = "1" WHERE pr_number = ?', [$number]);
        return back()->with('success', 'Purchase Requisition has been posted!');
    }

    public function unpostPr(Request $request)
    {
        $number = $request->input('pr_number');
        $requisition = \DB::update('UPDATE prequisitions SET pr_status = "0" WHERE pr_number = ?', [$number]);
        return back()->with('success', 'Purchase Requisition has been Unposted');
    }

    public function finalPr()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT pr_number, pr_title, pr_name, updated_at from prequisitions WHERE pr_status = "2" AND fyear = ?', [$fnl->fn_name]);
        return view('prequisitions.final', ['requisitions' => $requisitions]);
    }

     public function printPr($id)
    {
        $pass = \DB::select('SELECT * FROM prequisitions WHERE pr_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT pr_number, pr_title, pr_name, updated_at FROM prequisitions WHERE pr_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfprequisition', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_PURCHASE REQUISITION.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }

     public function searchProduct(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('products');
        if($request->type=='id'){
            $countries->where('p_ID','LIKE','%'.$query.'%');
        }
        if($request->type=='item'){
            $countries->where('p_name','LIKE','%'.$query.'%');
        }
        if($request->type=='size'){
            $countries->where('p_size','LIKE','%'.$query.'%');
        }
        if($request->type=='specifications'){
            $countries->where('p_specs','LIKE','%'.$query.'%');
        }
        if($request->type=='supplier'){
            $countries->where('s_company','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('p_ID'=>$country->p_ID,'p_name'=>$country->p_name, 'p_size'=>$country->p_size, 'p_specs'=>$country->p_specs, 's_company'=>$country->s_company);
        }
        if(count($data))
             return $data;
        else
            return ['p_name'=>'','p_size'=>'','p_ID'=>'','p_specs'=>'','s_company'=>''];
    }

    public function searchReqnumber(Request $request)
    {
         if($request->ajax())
         {
          $output = '';
          $query = $request->get('query');
          if($query != '')
          {
           $data = \DB::table('prequisitions')
             ->orderBy('pr_number', 'desc')
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
            ++$row->pr_number;
           }
          }
          else
          {
           $output = 'PR-00000';
          }
          $data = array(
           'table_data'  => $output
          );

          echo json_encode($data);
         }
    }
}
