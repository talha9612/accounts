<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cashtransactions;
use App\Ctvoucher;
use App\Spayments;
use Carbon\Carbon;

class CashtransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $fnl = \DB::table('fnlyear')->first();
       $vouchers = \DB::select('SELECT * FROM ctvouchers WHERE fyear = ?', [$fnl->fn_name]);
        return view('cashtransactions.index', ['vouchers' => $vouchers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cashtransactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
     {
         $lastRecord = Cashtransactions::latest()->first();
        if ($lastRecord) {
            $createdAt = Carbon::parse($lastRecord->created_at)->format('Y-m-d H:i:s');
            $currentTime = Carbon::now('Asia/Karachi');
            $differenceInSeconds = $currentTime->diffInSeconds($createdAt);
            // dd($differenceInSeconds);
            if ($differenceInSeconds < 5) {
                return back()->with('success', 'Cash Receipt has been added');
            } else {
//Loop for insertion of cash transactions 
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
        
        if(!$request->input('supplierid') == "")
        {
        $titleName = $request->input('countryname');
        $voucherNumber = $request->input('voucher');
        $serialArray = $request->input('ct_sno');
        $companyArray = $request->input('suppliercompany');
        $descArray = $request->input('srdesc');
        $amntArray = $request->input('amnt');
        $balancearray = $request->input('balance');
        $sidarray = $request->input('supplierid');
        $preparedby = $request->input('preparedby');

        

        $items = array();

        for($i = 0; $i < count($amntArray); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'ct_preparedby' => $preparedby,
                'ct_tag' => 'Payment',
                'cih_balance' => $balancearray[$i],
                'ct_amount' => $amntArray[$i],
                'ct_description' => $descArray[$i],
                'ct_type' => "Liability",
                'ct_head' => 0,
                'ct_name' => $companyArray[$i],
                'ct_sno' => 1,
                'vr_no' => $voucherNumber,
                'cih_title' => $titleName
            );

            $items[] = $item;
           
        }
        $supplieridarray = $request->input('supplierid');
        $amountArray = $request->input('amnt');
        $spayments = array();
        for($i = 0; $i < count($amntArray); $i++){
            $spayment = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'vr_no' => $voucherNumber,
                'sp_description' => $descArray[$i],
                'sp_amount' => $amntArray[$i],
                's_company' => $companyArray[$i],
                's_ID' => $sidarray[$i],
                's_name' => 0
            );

            $spayments[] = $spayment;
         \DB::update('UPDATE suppliers SET s_balance = s_balance - ? WHERE s_ID = ?', [$amountArray[$i], $supplieridarray[$i]]);   
           
        }
        Cashtransactions::insert($items);
        Spayments::insert($spayments);
         //For insertion of Voucher ID  
        $vramount = $request->input('vr_amount');
        $vnumbers = array();
        $vnumber = array(
            'updated_at'=> $set,
            'created_at'=> $set,
            'vr_no' => $voucherNumber,
            'vr_amount' => $vramount,
            'fyear'=> $fsclyear
        );
        $vnumbers[] = $vnumber;
        Ctvoucher::insert($vnumbers);

// Update Cash Account After Transaction has Submitted Successfully
        \DB::update('UPDATE cashinhands SET cih_balance = ? WHERE cih_title = ?', [$request->input('r_balance'),$request->input('countryname')]);

        }    

        elseif(!$request->input('head') == "") {
        $titleName = $request->input('countryname');
        $voucherNumber = $request->input('voucher');
        $serialArray = $request->input('ct_sno');
        $nameArray = $request->input('name');
        $headArray = $request->input('head');
        $typeArray = $request->input('type');
        $descArray = $request->input('desc');
        $amntArray = $request->input('amnt');
        $balancearray = $request->input('balance');
        $preparedby = $request->input('preparedby');

        $items = array();
        for($i = 0; $i < count($amntArray); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'ct_preparedby' => $preparedby,
                'ct_tag' => 'Payment',
                'cih_balance' => $balancearray[$i],
                'ct_amount' => $amntArray[$i],
                'ct_description' => $descArray[$i],
                'ct_type' => $typeArray[$i],
                'ct_head' => $headArray[$i],
                'ct_name' => $nameArray[$i],
                'ct_sno' => $serialArray[$i],
                'vr_no' => $voucherNumber,
                'cih_title' => $titleName
            );

            $items[] = $item;


            $amountArray = $request->input('amnt');
            $headidArray = $request->input('head');

            if($typeArray[$i] == 'Liability')
            {
            \DB::update('UPDATE heads SET h_balance = h_balance - ? WHERE h_ID = ?', [$amountArray[$i],$headidArray[$i]]);  
            }
            elseif($typeArray[$i] == 'Income')
            {
            \DB::update('UPDATE heads SET h_balance = h_balance - ? WHERE h_ID = ?', [$amountArray[$i],$headidArray[$i]]);   
            }
            else{
            \DB::update('UPDATE heads SET h_balance = h_balance + ? WHERE h_ID = ?', [$amountArray[$i],$headidArray[$i]]); 
            }

        }
    //For insertion of Voucher ID    
        Cashtransactions::insert($items);

        $vramount = $request->input('vr_amount');
        $vnumbers = array();
        $vnumber = array(
            'updated_at'=> $set,
            'created_at'=> $set,
            'vr_no' => $voucherNumber,
            'vr_amount' => $vramount,
            'fyear'=> $fsclyear
        );
        $vnumbers[] = $vnumber;
        Ctvoucher::insert($vnumbers);

// Update Cash Account After Transaction has Submitted Successfully
        \DB::update('UPDATE cashinhands SET cih_balance = ? WHERE cih_title = ?', [$request->input('r_balance'),$request->input('countryname')]);

            }

        return back()->with('success', 'Cash Transaction has been added');
            }
        } else {
            return back()->with('success', 'Cash Transaction has been added');
        }
    }       
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show(Request $request, $id)
    {    
        //$vnumber = $request->$id;
        $detail = \DB::select('SELECT DISTINCT cih_title, created_at, vr_no, ct_preparedby FROM cashtransactions WHERE vr_no = ?', [$id]);
        $voucher = \DB::select('SELECT * FROM cashtransactions WHERE vr_no = ?', [$id]);
        return view('cashtransactions.show', ['voucher' => $voucher], ['detail' => $detail]);
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
     public function searchAccount(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $query = $request->get('term','');
        $countries=\DB::table('cashinhands');
        if($request->type=='countryname'){
            $countries->where('cih_title','LIKE','%'.$query.'%');
        }
        if($request->type=='country_code'){
            $countries->where('cih_balance','LIKE','%'.$query.'%');
        }
        if($request->type=='accountid'){
            $countries->where('cih_ID','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();
            foreach($countries as $item){
            // dd($item->cih_title);
            $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
            $voucher =  \DB::select('SELECT * from cashtransactions WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
            foreach ($voucher as $cashtransactions){
                $totalcredit += $cashtransactions->ct_amount;
            }
            $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cih_title = ? AND fyear = ?', [$item->cih_title, $fnl->fn_name]);
            foreach ($rvoucher as $rcashtransactions){
                $totaldebit += $rcashtransactions->cr_amount;
            }
            $balances = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S.cih_title = ? AND S2.ob_fyear = ?', [$item->cih_title, $fnl->fn_name]);
            // dd($balances);
            $remaining =0;
            foreach ($balances as $orbalance){
                $remaining =  $totaldebit - $totalcredit;
                if($balances ==null){
                     $remaining = 0 + $remaining;
                     $orbalance = new \stdClass();
                     $orbalance->cih_title ='';
                    //  $orbalance->ob_amount = 0;
                    //  $orbalance->acc_balance=0;
                     $orbalance->cih_balance=0;
                }else{
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance,$orbalance->ob_amount);
            }
            $item->cih_balance = $remaining;
            // $item->cih_obalance = array_sum($ab_opening_blance);
            // dd($ab_opening_blance);
        }
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('cih_title'=>$country->cih_title,'cih_balance'=>$country->cih_balance,'cih_ID'=>$country->cih_ID);
        }
        if(count($data))
             return $data;
        else
            return ['cih_title'=>'','cih_balance'=>'','cih_ID'=>''];
    }

     public function searchHead(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('heads');
        if($request->type=='name'){
            $countries->where('h_name','LIKE','%'.$query.'%');
        }
        if($request->type=='head'){
            $countries->where('h_ID','LIKE','%'.$query.'%');
        }
        if($request->type=='type'){
            $countries->where('h_type','LIKE','%'.$query.'%');
        }
        if($request->type=='balance'){
            $countries->where('h_balance','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('h_name'=>$country->h_name,'h_ID'=>$country->h_ID ,'h_type'=>$country->h_type,'h_balance'=>$country->h_balance);
        }
        if(count($data))
             return $data;
        else
            return ['h_name'=>'','h_ID'=>'','h_type'=>'','h_balance'=>''];
    }
     public function searchVoucher(Request $request)
    {
            if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('ctvouchers')
                 ->orderBy('vr_no', 'desc')
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
                ++$row->vr_no;
               }
              }
              else
              {
               $output = 'CT-00000
               ';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }

}
