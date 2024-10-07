<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Squotations;
use PDF;

class SquotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
         $orders = \DB::select('SELECT DISTINCT sq_number, sq_title, sq_name, updated_at, sq_status from squotations WHERE sq_status = "0" AND fyear = ?', [$fnl->fn_name]);
        return view('squotations.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create(Request $request)
    {
        $prnumber = $request->input('sr_number');
        $requisition = \DB::select('SELECT * FROM srequisitions WHERE sr_number = ?', [$prnumber]);
        $details = \DB::select('SELECT DISTINCT sr_number, sr_title, sr_name, updated_at FROM srequisitions WHERE sr_number = ?', [$prnumber]);
        return view('squotations.create', ['requisition' => $requisition], ['details' => $details]);
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

        $titlenumber = $request->input('po_number');
        $titlefarmerid = $request->input('farmerid');
        $titlefarmername = $request->input('farmername');
        $titlefarmercnic = $request->input('farmercnic');
        $titlefarmergst = $request->input('farmergst');
        $titlefarmeraddress = $request->input('farmeraddress');
        $titleterm = $request->input('sq_term');
        $titlelot = $request->input('lot');
        $title = $request->input('po_title');
        $titlename = $request->input('po_name');
        $titleid = $request->input('id');
        $titleitem = $request->input('item');
        $titlesize = $request->input('size');
        $titlequantity = $request->input('quantity');
        $titlesaleprice = $request->input('saleprice');
            $titlestrate = $request->input('saletaxp');
            $titlestamount = $request->input('saletaxamount');
        $titletotal = $request->input('total');
        $titletotalisaletax = $request->input('totalisaletax');
            $titletotalsaletax = $request->input('totalsaletax');
            $titletotalesaletax = $request->input('grandtotal');
            $titlegrandtotal = $request->input('grandtotali');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'sq_status' => 0,
                    'dc_number' => 0,
                    'sq_grandtotal' => $titlegrandtotal,
                    'sq_totalesaletax' => $titletotalesaletax,
                    'sq_totalst' => $titletotalsaletax,
                'sq_totalprice' => $titletotalisaletax[$i],
                'sq_total' => $titletotal[$i],
                    'sq_stamount' => $titlestamount[$i],
                    'sq_strate' => $titlestrate[$i],
                'sq_saleprice' => $titlesaleprice[$i],
                'sq_quantity' => $titlequantity[$i],
                'sq_size' => $titlesize[$i],
                'sq_item' => $titleitem[$i],
                'sq_i_ID' => $titleid[$i],
                'sq_area' => '-',
                'sq_name' => $titlename,
                'sq_title' => $title,
                'lot_number' => $titlelot[$i],
                'sq_term' => $titleterm,
                'fr_address' => $titlefarmeraddress,
                'fr_gst' => $titlefarmergst,
                'fr_cnic' => $titlefarmercnic,
                'fr_name' => $titlefarmername,
                'fr_ID' => $titlefarmerid,
                'sq_number' => $titlenumber
            );

            $items[] = $item;
        }
        Squotations::insert($items);
        $requisition = \DB::update('UPDATE srequisitions SET sr_status = "2" WHERE sr_number = ?', [$titlenumber]);
        return redirect('squotations')->with('success','Invoice has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pass = \DB::select('SELECT * FROM squotations WHERE sq_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sq_number, sq_title, sq_name, sq_status, sq_totalst, sq_totalesaletax, sq_grandtotal, updated_at FROM squotations WHERE sq_number = ?', [$id]);
        return view('squotations.show', ['pass' => $pass], ['details' => $details]);
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

    public function searchStock(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('stocks');
        if($request->type=='id'){
            $countries->where('ss_ID','LIKE','%'.$query.'%');
        }
        if($request->type=='lot'){
            $countries->where('lot_number','LIKE','%'.$query.'%');
        }
        if($request->type=='item'){
            $countries->where('ss_item','LIKE','%'.$query.'%');
        }
        if($request->type=='size'){
            $countries->where('ss_size','LIKE','%'.$query.'%');
        }
        if($request->type=='quantity'){
            $countries->where('ss_quantity','LIKE','%'.$query.'%');
        }
        if($request->type=='costunit'){
            $countries->where('ss_costunit','LIKE','%'.$query.'%');
        }
        if($request->type=='saleprice'){
            $countries->where('ss_saleprice','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('ss_ID'=>$country->ss_ID,'lot_number'=>$country->lot_number,'ss_item'=>$country->ss_item ,'ss_size'=>$country->ss_size ,'ss_quantity'=>$country->ss_quantity ,'ss_costunit'=>$country->ss_costunit,'ss_saleprice'=>$country->ss_saleprice);
        }
        if(count($data))
             return $data;
        else
            return ['ss_ID'=>'','lot_number'=>'','ss_item'=>'','ss_size'=>'','ss_quantity'=>'','ss_costunit'=>'','ss_saleprice'=>''];
    }

    public function action(Request $request)
    {
         if($request->ajax())
         {
          $output = '';
          $query1 = $request->get('query');
          if($query1 != '')
          {
           $data = \DB::table('stocks')
           ->where('ss_quantity', '!=', 0)
           ->where( function ($query) use($query1) {
            $query->where('ss_size', 'like', '%' . $query1 . '%')
               ->orWhere('ss_specs', 'like', '%' . $query1 . '%');
          })

        //    ->orWhere('ss_specs', 'like', '%'.$query.'%' ,)
        //    ->orWhere('ss_costunit', 'like', '%'.$query.'%')
        //    ->orWhere('lot_number', 'like', '%'.$query.'%')
           ->orderBy('ss_ID', 'desc')
           ->get();

          }
          else
          {
           $data = \DB::table('stocks')
             ->orderBy('ss_ID', 'desc')->Where('ss_quantity', '!=', 0)
             ->limit(5)
             ->get();
          }
          $total_row = $data->count();
          if($total_row > 0)
          {
           foreach($data as $row)
           {
            $output .= '
            <tr>
             <td>'.$row->ss_ID.'</td>
             <td>'.$row->ss_size.'</td>
             <td>'.$row->ss_specs.'</td>
             <td>'.$row->ss_quantity.'</td>
             <td>'.$row->ss_costunit.'</td>
             <td>'.$row->lot_number.'</td>
            </tr>
            ';
           }
          }
          else
          {
           $output = '
           <tr>
            <td align="center" colspan="5">No Data Found</td>
           </tr>
           ';
          }
          $data = array(
           'table_data'  => $output,
           'total_data'  => $total_row
          );

          echo json_encode($data);
         }
    }

    public function finalSq()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT sq_number, sq_title, sq_name, updated_at , sq_status from squotations WHERE sq_status = "1" AND fyear = ?', [$fnl->fn_name]);
        return view('squotations.final', ['requisitions' => $requisitions]);
    }

    public function printSq($id)
    {
        $pass = \DB::select('SELECT * FROM squotations WHERE sq_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sq_number, sq_title, sq_name, updated_at, fr_name, fr_cnic, sq_totalesaletax, sq_totalst, sq_grandtotal, fr_address, sq_term, dc_number FROM squotations WHERE sq_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfsquotation', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_COMMERCIAL INVOICE.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }

    public function printSqst($id)
    {
        $pass = \DB::select('SELECT * FROM squotations WHERE sq_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sq_number, sq_title, sq_name, updated_at, fr_name, fr_cnic, fr_gst, sq_totalesaletax, sq_totalst, sq_grandtotal, fr_address, sq_term FROM squotations WHERE sq_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfsquotationst', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_SALES TAX INVOICE.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }


}
