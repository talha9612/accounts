<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banktransactions;
use App\Bkvouchers;
use App\Spayments;
use Carbon\Carbon;


class BanktransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $vouchers = Bkvouchers::all()->toArray();
        // return view('banktransactions.index', compact('vouchers'));
        $fnl = \DB::table('fnlyear')->first();
        $voucher = \DB::select('SELECT * FROM bkvouchers WHERE fyear = ?', [$fnl->fn_name]);
        return view('banktransactions.index', ['voucher' => $voucher]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banktransactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $lastRecord = Banktransactions::latest()->first();
        if ($lastRecord) {
            $createdAt = Carbon::parse($lastRecord->created_at)->format('Y-m-d H:i:s');
            $currentTime = Carbon::now('Asia/Karachi');
            $differenceInSeconds = $currentTime->diffInSeconds($createdAt);
            // dd($differenceInSeconds);
            if ($differenceInSeconds < 5) {
                return back()->with('success', 'Cash Receipt has been added');
            } else {
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

        $titlevoucher = $request->input('voucher');
        $title = $request->input('accounttitle');
        $titleName = $request->input('accountnumber');
        $titlechequenumber = $request->input('cheque_number');
        $titlechequedate = $request->input('cheque_date');
        $titleamount = $request->input('vr_amount');
        

        $vouchers = array();
        
        $voucher = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'bkvr_amount' => $titleamount,
                'bt_cqdate' => $titlechequedate,
                'bt_cqnumber' => $titlechequenumber,
                'acc_number' => $titleName,
                'acc_title' => $title,
                'bkvr_no' => $titlevoucher
            );

            $vouchers[] = $voucher;

            Bkvouchers::insert($vouchers);



        $titlevoucher = $request->input('voucher');
        $title = $request->input('accounttitle');
        $titleName = $request->input('accountnumber');
        $titlechequenumber = $request->input('cheque_number');
        $titlechequedate = $request->input('cheque_date');
        // $serialArray = $request->input('ct_sno');
        // $headArray = $request->input('head');
        // $typeArray = $request->input('type');
        $nameArray = $request->input('suppliercompany');
        $descArray = $request->input('srdesc');
        $amntArray = $request->input('amnt');
        $balanceArray = $request->input('balance');
        $sidArray = $request->input('supplierid');
        $preparedby = $request->input('preparedby');


        $items = array();
        for($i = 0; $i < count($amntArray); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'bt_preparedby' => $preparedby,
                'bt_tag' => 'Payment',
                'acc_balance' => $balanceArray[$i],
                'bt_amount' => $amntArray[$i],
                'bt_description' => $descArray[$i],
                'ex_name' => $nameArray[$i],
                'ex_type' => 0,
                'ex_ID' => 0,
                'bt_sno' => 1,
                'bt_cqdate' => $titlechequedate,
                'bt_cqnumber' => $titlechequenumber,
                'acc_number' => $titleName,
                'acc_title' => $title,
                'bkvr_no' => $titlevoucher
            );

            $items[] = $item;
            
        }
        Banktransactions::insert($items);

        // Update Bank Account After Transaction has Submitted Successfully
        \DB::update('UPDATE accountsbks SET acc_balance = ? WHERE acc_title = ?', [$request->input('r_balance'),$request->input('accounttitle')]);

        $amountArray = $request->input('amnt');
        $supplieridArray = $request->input('supplierid');
        $spayments = array();
        for($i = 0; $i < count($amntArray); $i++){
            $spayment = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'vr_no' => $titlevoucher,
                'sp_description' => $descArray[$i],
                'sp_amount' => $amntArray[$i],
                's_company' => $nameArray[$i],
                's_ID' => $sidArray[$i],
                's_name' => 0
            );

            $spayments[] = $spayment;
         \DB::update('UPDATE suppliers SET s_balance = s_balance - ? WHERE s_ID = ?', [$amountArray[$i],$supplieridArray[$i]]);   
           
        }
        Spayments::insert($spayments);



        }
        elseif(!$request->input('head') == "")
        {
        $titlevoucher = $request->input('voucher');
        $title = $request->input('accounttitle');
        $titleName = $request->input('accountnumber');
        $titlechequenumber = $request->input('cheque_number');
        $titlechequedate = $request->input('cheque_date');
        $titleamount = $request->input('vr_amount');
        

        $vouchers = array();
        
        $voucher = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'bkvr_amount' => $titleamount,
                'bt_cqdate' => $titlechequedate,
                'bt_cqnumber' => $titlechequenumber,
                'acc_number' => $titleName,
                'acc_title' => $title,
                'bkvr_no' => $titlevoucher
            );

            $vouchers[] = $voucher;

            Bkvouchers::insert($vouchers);

        $titlevoucher = $request->input('voucher');
        $title = $request->input('accounttitle');
        $titleName = $request->input('accountnumber');
        $titlechequenumber = $request->input('cheque_number');
        $titlechequedate = $request->input('cheque_date');
        $serialArray = $request->input('ct_sno');
        $headArray = $request->input('head');
        $typeArray = $request->input('type');
        $nameArray = $request->input('name');
        $descArray = $request->input('desc');
        $amntArray = $request->input('amnt');
        $balanceArray = $request->input('balance');
        $preparedby = $request->input('preparedby');

        $items = array();
        for($i = 0; $i < count($amntArray); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'bt_preparedby' => $preparedby,
                'bt_tag' => 'Payment',
                'acc_balance' => $balanceArray[$i],
                'bt_amount' => $amntArray[$i],
                'bt_description' => $descArray[$i],
                'ex_name' => $nameArray[$i],
                'ex_type' => $typeArray[$i],
                'ex_ID' => $headArray[$i],
                'bt_sno' => $serialArray[$i],
                'bt_cqdate' => $titlechequedate,
                'bt_cqnumber' => $titlechequenumber,
                'acc_number' => $titleName,
                'acc_title' => $title,
                'bkvr_no' => $titlevoucher
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
        Banktransactions::insert($items);

        // Update Bank Account After Transaction has Submitted Successfully
        \DB::update('UPDATE accountsbks SET acc_balance = ? WHERE acc_title = ?', [$request->input('r_balance'),$request->input('accounttitle')]);
    }

        return back()->with('success', 'Bank Transaction has been added');
            }
    } else {
        return back()->with('success', 'Bank Transaction has been added');
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(request $request, $id)
    {
        // $vnumber = $request->$id;
        $detail = \DB::select('SELECT DISTINCT acc_title, created_at, bkvr_no, bt_preparedby FROM banktransactions WHERE bkvr_no = ?', [$id]);
        $voucher = \DB::select('SELECT * FROM banktransactions WHERE bkvr_no = ?', [$id]);
        return view('banktransactions.show', ['voucher' => $voucher], ['detail' => $detail]);
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
        $countries=\DB::table('accountsbks');
        if($request->type=='accounttitle'){
            $countries->where('acc_title','LIKE','%'.$query.'%');
        }
        if($request->type=='accountbalance'){
            $countries->where('acc_balance','LIKE','%'.$query.'%');
        }
        if($request->type=='accountnumber'){
            $countries->where('acc_number','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();
           foreach($countries as $item){

            $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
            $ab_voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
            // dd($voucher);
            foreach ($ab_voucher as $cashtransactions){
                $totalcredit += $cashtransactions->bt_amount;
            }
            $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
            // dd($rvoucher);
            foreach ($rvoucher as $rcashtransactions){
                $totaldebit += $rcashtransactions->br_amount;
            }

            $balances = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_number = S2.sub_ID WHERE S.acc_number = ? AND S2.ob_fyear = ?', [$item->acc_number, $fnl->fn_name]);
            // dd($balances);
            foreach ($balances as $orbalance){
                $remaining =  $totaldebit - $totalcredit;
                if($balances ==null){
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->acc_title ='';
                    $orbalance->ob_amount = 0;
                    $orbalance->acc_balance=0;
                }else{
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance,$orbalance->ob_amount);
            }
            $item->acc_balance = $remaining;
            $item->acc_opbalance = array_sum($ab_opening_blance);
            // dd($ab_opening_blance);
        }
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('acc_title'=>$country->acc_title,'acc_balance'=>$country->acc_balance,'acc_number'=>$country->acc_number);
        }
        if(count($data))
             return $data;
        else
            return ['acc_title'=>'','acc_balance'=>'','acc_number'=>''];
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
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('h_name'=>$country->h_name,'h_ID'=>$country->h_ID,'h_type'=>$country->h_type);
        }
        if(count($data))
             return $data;
        else
            return ['h_name'=>'','h_ID'=>'','h_type'=>''];
    }
        public function searchVoucherbk(Request $request)
    {
        if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('bkvouchers')
                 ->orderBy('bkvr_no', 'desc')
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
                ++$row->bkvr_no;
               }
              }
              else
              {
               $output = 'BT-00000
               ';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }
}
// ALTER TABLE bankreceipts ADD fyear varchar(40) NOT NULL BEFORE created_at;

//ALTER TABLE banktransactions MODIFY updated_at DATE;

//UPDATE banktransactions SET updated_at = STR_TO_DATE(created_at,'%d-%M-%Y %h:%i:%s');

// INSERT INTO table2 (st_id,uid,changed,status,assign_status)
// SELECT st_id,from_uid,now(),'Pending','Assigned'
// FROM table1

// ALTER TABLE bankreceipts MODIFY created_at DATE;
// ALTER TABLE bankreceipts MODIFY updated_at DATE;

// ALTER TABLE banks MODIFY created_at DATE;
// ALTER TABLE banks MODIFY updated_at DATE;

// ALTER TABLE banktransactions MODIFY created_at DATE;
// ALTER TABLE banktransactions MODIFY updated_at DATE;

// ALTER TABLE bkvouchers MODIFY created_at DATE;
// ALTER TABLE bkvouchers MODIFY updated_at DATE;

// ALTER TABLE brvouchers MODIFY created_at DATE;
// ALTER TABLE brvouchers MODIFY updated_at DATE;

// ALTER TABLE cashinhands MODIFY created_at DATE;
// ALTER TABLE cashinhands MODIFY updated_at DATE;

// ALTER TABLE cashreceipts MODIFY created_at DATE;
// ALTER TABLE cashreceipts MODIFY updated_at DATE;

// ALTER TABLE cashtransactions MODIFY created_at DATE;
// ALTER TABLE cashtransactions MODIFY updated_at DATE;

// ALTER TABLE crvouchers MODIFY created_at DATE;
// ALTER TABLE crvouchers MODIFY updated_at DATE;

// ALTER TABLE ctvouchers MODIFY created_at DATE;
// ALTER TABLE crvouchers MODIFY updated_at DATE;

// ALTER TABLE exptypes MODIFY created_at DATE;
// ALTER TABLE exptypes MODIFY updated_at DATE;

// ALTER TABLE farmers MODIFY created_at DATE;
// ALTER TABLE farmers MODIFY updated_at DATE;

// ALTER TABLE fpayments MODIFY created_at DATE;
// ALTER TABLE fpayments MODIFY updated_at DATE;

// ALTER TABLE gateinwards MODIFY created_at DATE;
// ALTER TABLE gateinwards MODIFY updated_at DATE;

// ALTER TABLE gateoutwards MODIFY created_at DATE;
// ALTER TABLE gateoutwards MODIFY updated_at DATE;

// ALTER TABLE heads MODIFY created_at DATE;
// ALTER TABLE heads MODIFY updated_at DATE;

// ALTER TABLE journalvouchers MODIFY created_at DATE;
// ALTER TABLE journalvouchers MODIFY updated_at DATE;

// ALTER TABLE lotnumber MODIFY created_at DATE;
// ALTER TABLE lotnumber MODIFY updated_at DATE;

// ALTER TABLE mrreports MODIFY created_at DATE;
// ALTER TABLE mrreports MODIFY updated_at DATE;

// ALTER TABLE porders MODIFY created_at DATE;
// ALTER TABLE porders MODIFY updated_at DATE;

// ALTER TABLE prequisitions MODIFY created_at DATE;
// ALTER TABLE prequisitions MODIFY updated_at DATE;

// ALTER TABLE products MODIFY created_at DATE;
// ALTER TABLE products MODIFY updated_at DATE;

// ALTER TABLE salereturns MODIFY created_at DATE;
// ALTER TABLE salereturns MODIFY updated_at DATE;

// ALTER TABLE sales MODIFY created_at DATE;
// ALTER TABLE sales MODIFY updated_at DATE;

// ALTER TABLE salesprices MODIFY created_at DATE;
// ALTER TABLE salesprices MODIFY updated_at DATE;

// ALTER TABLE scvaluations MODIFY created_at DATE;
// ALTER TABLE scvaluations MODIFY updated_at DATE;

// ALTER TABLE stocks MODIFY created_at DATE;
// ALTER TABLE stocks MODIFY updated_at DATE;

// ALTER TABLE suppliers MODIFY created_at DATE;
// ALTER TABLE suppliers MODIFY updated_at DATE;

// ALTER TABLE svinvoices MODIFY created_at DATE;
// ALTER TABLE svinvoices MODIFY updated_at DATE;