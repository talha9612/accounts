<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Svinvoices;

class SrvinvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
          $requisitions = \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crname, updated_at from svinvoices WHERE fyear = ?', [$fnl->fn_name]);
        return view('srvinvoices.index', ['requisitions' => $requisitions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $srvnumber = $request->input('srv_number');
        $requisition = \DB::select('SELECT * FROM srvrequisitions WHERE srv_number = ?', [$srvnumber]);
        $details = \DB::select('SELECT DISTINCT srv_number, srv_name, srv_crid, srv_crname, srv_crorder, srv_headid, srv_head, srv_headbalance, srv_description, srv_grandtotal, updated_at FROM srvrequisitions WHERE srv_number = ?', [$srvnumber]);
        $saleinvoice = \DB::select('SELECT DISTINCT sl_number FROM sales');
        return view('srvinvoices.create', ['requisition' => $requisition], ['details' => $details, 'saleinvoice' => $saleinvoice]);
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

        $titlenumber = $request->input('svi_number');
        $titlename = $request->input('svi_name');
        $titlecrid = $request->input('svi_crid');
        $titlecrname = $request->input('svi_crname');
        $titleslnumber = $request->input('countryname');
        $titlesltotal = $request->input('country_code');
        $titlecrorder = $request->input('svi_crorder');
        $titleheadbalance = $request->input('svi_headbalance');
        $titleheadid = $request->input('svi_headid');
        $titlehead = $request->input('svi_head');
        $titleiid = $request->input('i_id');
        $titleitem = $request->input('item');
        $titlemodel = $request->input('model');
        $titlequantity = $request->input('quantity');
        $titlecostprice = $request->input('costprice');
        $titlesalesunit = $request->input('sup');
        $titletotalprice = $request->input('totalprice');
        $titlegrandtotal = $request->input('grandtotal');
        $titlesrvgrandtotal = $request->input('srv_grandtotal');
        $titlesvitax = $request->input('svi_tax');
        // $titlestatus = $request->input('sr_size');
        // $titleunitprice = $request->input('pr_unitprice');
        // $titletotalprice = $request->input('pr_totalprice');

        $items = array();
        for($i = 0; $i < count($titleitem); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'svi_status' => '0',
                'svi_tax' => $titlesvitax,
                'srv_grandtotal' => $titlesrvgrandtotal,
                'svi_grandtotal' => $titlegrandtotal,
                'svi_totalprice' => $titletotalprice[$i],
                'svi_sup' => $titlesalesunit[$i],
                'svi_costprice' => $titlecostprice[$i],
                'svi_quantity' => $titlequantity[$i],
                'svi_model' => $titlemodel[$i],
                'svi_item' => $titleitem[$i],
                'svi_i_ID' => $titleiid[$i],
                'svi_head' => $titlehead,
                'svi_headid' => $titleheadid,
                'svi_headbalance' => $titleheadbalance,
                'svi_crorder' => $titlecrorder,
                'svi_sltotal' => $titlesltotal,
                'svi_slnumber' => $titleslnumber,
                'svi_crname' => $titlecrname,
                'svi_crid' => $titlecrid,
                'svi_name' => $titlename,
                'svi_number' => $titlenumber
            );

            $items[] = $item;

            \DB::update('UPDATE srvrequisitions SET srv_status = "1" WHERE srv_number = ?', [$titlenumber]);   
            \DB::update('UPDATE stocks SET ss_quantity = ss_quantity - ? WHERE ss_ID = ?', [$titlequantity[$i], $titleiid[$i]]);   
           
        }

        Svinvoices::insert($items);
        \DB::update('UPDATE farmers SET fr_balance = fr_balance + ? WHERE fr_ID = ?', [$titlegrandtotal, $titlecrid]);
        return redirect('srvinvoices')->with('success','Service Invoice has been added');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requisition = \DB::select('SELECT * FROM svinvoices WHERE svi_number = ?', [$id]);
        $details = \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crid, svi_crname, svi_crorder, svi_slnumber, svi_sltotal, svi_headid, svi_head, svi_headbalance, svi_grandtotal, svi_tax, updated_at FROM svinvoices WHERE svi_number = ?', [$id]);
        return view('srvinvoices.show', ['requisition' => $requisition], ['details' => $details]);
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

     public function searchSale(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('sales');
        if($request->type=='countryname'){
            $countries->where('sl_number','LIKE','%'.$query.'%');
        }
        if($request->type=='country_code'){
            $countries->where('sl_grandtotal','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('sl_number'=>$country->sl_number,'sl_grandtotal'=>$country->sl_grandtotal);
        }
        if(count($data))
             return $data;
        else
            return ['cih_title'=>'','cih_balance'=>''];
    }
}
