<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Srequisitions;
use PDF;

class SrequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $fnl = \DB::table('fnlyear')->first();
         $requisitions = \DB::select('SELECT DISTINCT sr_number, sr_title, sr_name, updated_at from srequisitions WHERE sr_status = "1" AND fyear = ?', [$fnl->fn_name]);
        return view('srequisitions.index', ['requisitions' => $requisitions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('srequisitions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $titlereq = $request->input('sr_req');

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

        if(!$titlereq == "")
        {
        $titlenumber = $request->input('sr_number');
        $title = $request->input('sr_title');
        $titlename = $request->input('sr_name');
        $titlesupplier = $request->input('sr_supplier');
        $titleitem = $request->input('sr_item');
        $titlesize = $request->input('sr_size');
        $titlespecs = $request->input('sr_specifications');
        $titledescription = $request->input('sr_description');
        $titlequantity = $request->input('sr_quantity');
        // $titleunitprice = $request->input('pr_unitprice');
        // $titletotalprice = $request->input('pr_totalprice');
        $requisition = \DB::delete('DELETE FROM srequisitions WHERE sr_number = ?', [$titlenumber]); 
        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                // 'pr_totalprice' => $titletotalprice,
                // 'pr_unitprice' => $titleunitprice[$i],
                'fyear'=> $fsclyear,
                'sr_status' => 0,
                'sr_quantity' => $titlequantity[$i],
                'sr_description' => $titledescription[$i],
                'sr_specs' => $titlespecs[$i],
                'sr_size' => $titlesize[$i],
                'sr_item' => $titleitem[$i],
                'sr_supplier' => $titlesupplier[$i],
                'sr_area' => '-',
                'sr_name' => $titlename,
                'sr_title' => $title,
                'sr_number' => $titlenumber
            );

            $items[] = $item;
           
        }

        Srequisitions::insert($items);
        return back()->with('success', 'Purchase Requisition updated successfully');
        }

        else
        {
        $titlenumber = $request->input('sr_number');
        $title = $request->input('sr_title');
        $titlename = $request->input('sr_name');
        $titlesupplier = $request->input('sr_supplier');
        $titleitem = $request->input('sr_item');
        $titlesize = $request->input('sr_size');
        $titlespecs = $request->input('sr_specifications');
        $titledescription = $request->input('sr_description');
        $titlequantity = $request->input('sr_quantity');
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
                'sr_status' => 1,
                'sr_quantity' => $titlequantity[$i],
                'sr_description' => $titledescription[$i],
                'sr_specs' => $titlespecs[$i],
                'sr_size' => $titlesize[$i],
                'sr_item' => $titleitem[$i],
                'sr_supplier' => $titlesupplier[$i],
                'sr_area' => '-',
                'sr_name' => $titlename,
                'sr_title' => $title,
                'sr_number' => $titlenumber
            );

            $items[] = $item;
           
        }

        Srequisitions::insert($items);
       return redirect('srequisitions')->with('success','Sale Requisition has been added and Posted');
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
       $requisition = \DB::select('SELECT * FROM srequisitions WHERE sr_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sr_number, sr_title, sr_name, updated_at FROM srequisitions WHERE sr_number = ?', [$id]);
        return view('srequisitions.show', ['requisition' => $requisition], ['details' => $details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requisition = \DB::select('SELECT * FROM srequisitions WHERE sr_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sr_number, sr_title, sr_name, updated_at FROM srequisitions WHERE sr_number = ?', [$id]);
        return view('srequisitions.edit', ['requisition' => $requisition], ['details' => $details]) ;
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
        $requisition = \DB::delete('DELETE FROM srequisitions WHERE sr_number = ?', [$id]);
        return back()->with('success', 'Sale Requisition has been Deleted');
    }
    public function searchSreqnumber(Request $request)
    {
        if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('srequisitions')
                 ->orderBy('sr_number', 'desc')
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
                ++$row->sr_number;
               }
              }
              else
              {
               $output = 'SR-00000';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }
     public function savedSr()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT sr_number, sr_title, sr_name, updated_at from srequisitions WHERE sr_status = "0" AND fyear = ?', [$fnl->fn_name]);
        return view('srequisitions.saved', ['requisitions' => $requisitions]);
    }
     public function finalSr()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT sr_number, sr_title, sr_name, updated_at from srequisitions WHERE sr_status = "2" AND fyear = ?', [$fnl->fn_name]);
        return view('srequisitions.final', ['requisitions' => $requisitions]);
    }
    public function unpostSr(Request $request)
    {
        $number = $request->input('sr_number');
        $requisition = \DB::update('UPDATE srequisitions SET sr_status = "0" WHERE sr_number = ?', [$number]);
        return back()->with('success', 'Sale Requisition has been Unposted');
    }
    public function saveSr(Request $request)
    {
        $number = $request->input('sr_number');
        $requisition = \DB::update('UPDATE srequisitions SET sr_status = "1" WHERE sr_number = ?', [$number]);
        return back()->with('success', 'Sale Requisition has been posted!');
    }

    public function printSr($id)
    {
        $pass = \DB::select('SELECT * FROM srequisitions WHERE sr_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT sr_number, sr_title, sr_name, updated_at FROM srequisitions WHERE sr_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfsrequisition', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_SALE REQUISITION.pdf');
    }
}
