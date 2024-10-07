<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mrreports;
use PDF;


class MrreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $reports = \DB::select('SELECT DISTINCT mr_number, mr_title, mr_name, mr_status, mr_received_by, updated_at , lot_number from mrreports WHERE mr_status = "0" AND fyear = ?', [$fnl->fn_name]);
        return view('mrreports.index', ['reports' => $reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ginumber = $request->input('gi_number');
        $requisition = \DB::select('SELECT * FROM gateinwards WHERE gi_number = ?', [$ginumber]);
        $details = \DB::select('SELECT DISTINCT gi_number, gi_title, gi_name, updated_at, gi_received_by, created_at, s_name, s_ID, s_company FROM gateinwards WHERE gi_number = ?', [$ginumber]);
        return view('mrreports.create', ['requisition' => $requisition], ['details' => $details]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lotnumber = $request->input('lot_number');
        $fsclyear = $request->input('fsclyear');

        if(!$lotnumber == "")
        {
        $titlenumber = $request->input('mr_number');
        $title = $request->input('mr_title');
        $titlename = $request->input('mr_name');
        $titlesname = $request->input('s_name');
        $titlesid = $request->input('s_ID');
        $titlescompany = $request->input('s_company');
        $titlesupplier = $request->input('mr_supplier');
        $titleitem = $request->input('mr_item');
        $titlesize = $request->input('mr_size');
        $titlespecs = $request->input('mr_specifications');
        $titledescription = $request->input('mr_description');
        $titlequantity = $request->input('mr_quantity');
        $titlereceived = $request->input('mr_received_by');
        $titlelot = $request->input('lot_number');
        $titledate = $request->input('created_at');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> \Carbon\Carbon::parse($titledate)->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse($titledate)->format('Y-m-d'),
                'fyear'=> $fsclyear,
                'mr_status' => 0,
                'lot_number' => $titlelot,
                'mr_received_by' => $titlereceived,
                'mr_quantity' => $titlequantity[$i],
                'mr_description' => $titledescription[$i],
                'mr_specs' => $titlespecs[$i],
                'mr_size' => $titlesize[$i],
                'mr_item' => $titleitem[$i],
                'mr_supplier' => $titlesupplier[$i],
                's_company' => $titlescompany,
                's_ID' => $titlesid,
                's_name' => $titlesname,
                'mr_area' => "-",
                'mr_name' => $titlename,
                'mr_title' => $title,
                'mr_number' => $titlenumber
            );

            $items[] = $item;
           
        }

        Mrreports::insert($items);
        $requisition = \DB::update('UPDATE gateinwards SET gi_status = "1" WHERE gi_number = ?', [$titlenumber]);
        $lot = \DB::insert('INSERT into lotnumber (lot_number, created_at, updated_at) VALUES (?, ?, ?)', [$titlelot, \Carbon\Carbon::parse($titledate)->format('Y-m-d'), \Carbon\Carbon::parse($titledate)->format('Y-m-d')]);
       return redirect('mrreports')->with('success','MRR has been added');
        }
        else
        {
           return back()->with('success', 'Error! Lot Number must be filled!'); 
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
        $pass = \DB::select('SELECT * FROM mrreports WHERE mr_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT mr_number, mr_title, mr_name, mr_status, mr_received_by, updated_at , lot_number, s_name, s_ID, s_company FROM mrreports WHERE mr_number = ?', [$id]);
        return view('mrreports.show', ['pass' => $pass], ['details' => $details]);
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
    public function searchLotnumber(Request $request)
    {
         if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('lotnumber')
                 ->orderBy('lot_number', 'desc')
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
                ++$row->lot_number;
               }
              }
              else
              {
               $output = 'LT-00001
               ';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }

      public function finalRp()
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT mr_number, mr_title, mr_name, mr_status, mr_received_by, updated_at, lot_number from mrreports WHERE mr_status = "1" AND fyear = ?', [$fnl->fn_name]);
        return view('mrreports.saved', ['requisitions' => $requisitions]);
    }
    public function printMr($id)
    {
        $pass = \DB::select('SELECT * FROM mrreports WHERE mr_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT mr_number, mr_title, mr_name, updated_at, mr_received_by, lot_number FROM mrreports WHERE mr_number = ?', [$id]);
        $pdf = PDF::loadView('PDF.pdfmrreport', ['pass' => $pass], ['details' => $details]);
        return $pdf->stream($id.'_MATERIAL REPORT.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }

}
