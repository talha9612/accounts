<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Srvrequisitions;

class SrvrequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $requisitions = \DB::select('SELECT DISTINCT srv_number, srv_name, srv_crname, srv_status, updated_at from srvrequisitions WHERE fyear = ?', [$fnl->fn_name]);
        return view('srvrequisitions.index', ['requisitions' => $requisitions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('srvrequisitions.create');
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

        $titlenumber = $request->input('srv_number');
        $titlename = $request->input('srv_name');
        $titlecrid = $request->input('farmerid');
        $titlecrname = $request->input('farmername');
        $titlecrorder = $request->input('crorder');
        $titleheadbalance = $request->input('balance');
        $titleheadid = $request->input('head');
        $titlehead = $request->input('name');
        $titledescription = $request->input('headdescription');
        $titleiid = $request->input('id');
        $titleitem = $request->input('item');
        $titlemodel = $request->input('size');
        $titlequantity = $request->input('quantity');
        $titlecostprice = $request->input('costunit');
        $titlesalesunit = $request->input('saleprice');
        $titletotalprice = $request->input('total');
        $titlegrandtotal = $request->input('grandtotal');
        // $titlestatus = $request->input('sr_size');
        // $titleunitprice = $request->input('pr_unitprice');
        // $titletotalprice = $request->input('pr_totalprice');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'srv_status' => 0,
                'srv_grandtotal' => $titlegrandtotal,
                'srv_totalprice' => $titletotalprice[$i],
                'srv_sup' => $titlesalesunit[$i],
                'srv_costprice' => $titlecostprice[$i],
                'srv_quantity' => $titlequantity[$i],
                'srv_model' => $titlemodel[$i],
                'srv_item' => $titleitem[$i],
                'srv_i_ID' => $titleiid[$i],
                'srv_description' => $titledescription,
                'srv_head' => $titlehead,
                'srv_headid' => $titleheadid,
                'srv_headbalance' => $titleheadbalance,
                'srv_crorder' => $titlecrorder,
                'srv_crname' => $titlecrname,
                'srv_crid' => $titlecrid,
                'srv_name' => $titlename,
                'srv_number' => $titlenumber
            );

            $items[] = $item;
           
        }

        Srvrequisitions::insert($items);
       return redirect('srvrequisitions')->with('success','Service Requisition has been added');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requisition = \DB::select('SELECT * FROM srvrequisitions WHERE srv_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT srv_number, srv_name, srv_crid, srv_crname, srv_crorder, srv_headid, srv_head, srv_description, srv_grandtotal, updated_at FROM srvrequisitions WHERE srv_number = ?', [$id]);
        return view('srvrequisitions.show', ['requisition' => $requisition], ['details' => $details]);
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
    public function searchSrvreqnumber(Request $request)
    {
        if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('srvrequisitions')
                 ->orderBy('srv_number', 'desc')
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
                ++$row->srv_number;
               }
              }
              else
              {
               $output = 'SRV-00000';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }
}
