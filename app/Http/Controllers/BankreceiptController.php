<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bankreceipts;
use App\Brvouchers;
use App\Fpayments;
use Carbon\Carbon;


class BankreceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $vouchers = Brvouchers::all()->toArray();
        // return view('bankreceipts.index', compact('vouchers'));
        $fnl = \DB::table('fnlyear')->first();
        $voucher = \DB::select('SELECT * FROM brvouchers WHERE fyear = ?', [$fnl->fn_name]);
        return view('bankreceipts.index', ['voucher' => $voucher]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('bankreceipts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
       {
        $lastRecord = Bankreceipts::latest()->first();
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
        if(!$request->input('farmercnic') == "")   
        {
    // FOR VOUCHER NUMBER 
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
                'brv_amount' => $titleamount,
                'br_cqdate' => $titlechequedate,
                'br_cqnumber' => $titlechequenumber,
                'acc_number' => $titleName,
                'acc_title' => $title,
                'brv_no' => $titlevoucher
            );

            $vouchers[] = $voucher;

            Brvouchers::insert($vouchers);

        // FOR BANK TRANSACTION
        $titlevoucher = $request->input('voucher');
        $title = $request->input('accounttitle');
        $titleName = $request->input('accountnumber');
         $titlechequenumber = $request->input('cheque_number');
         $titlechequedate = $request->input('cheque_date');
        // $serialArray = $request->input('ct_sno');
        // $headArray = $request->input('head');
        // $typeArray = $request->input('type');
        $nameArray = $request->input('farmername');
        $descArray = $request->input('frdesc');
        $amntArray = $request->input('amnt');
        $balanceArray = $request->input('balance');
        $cnicArray = $request->input('farmercnic');
        $farmeridArray = $request->input('farmerid');
        $preparedby = $request->input('preparedby');

        $items = array();
        for($i = 0; $i < count($amntArray); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'br_preparedby' => $preparedby,
                'br_tag' => 'Receipt',
                'acc_balance' => $balanceArray[$i],
                'br_amount' => $amntArray[$i],
                'br_description' => $descArray[$i],
                'br_name' => $nameArray[$i],
                'br_head' =>0,
                'br_type' => "Asset",
                'br_sno' => 0,
                'br_cqdate' =>$titlechequedate,
                'br_cqnumber' => $titlechequenumber,
                'acc_number' => $titleName,
                'acc_title' => $title,
                'brv_no' => $titlevoucher
            );

            $items[] = $item;
            
        }
        Bankreceipts::insert($items);

        // Update Bank Account After Transaction has Submitted Successfully
        \DB::update('UPDATE accountsbks SET acc_balance = ? WHERE acc_title = ?', [$request->input('r_balance'),$request->input('accounttitle')]);

        // FOR INSERTION OF FARMER PAYMENTS
        for($i = 0; $i < count($amntArray); $i++){
            $farmer = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'vr_number' => $titlevoucher,
                'fp_description' => $descArray[$i],
                'fp_amount' => $amntArray[$i],
                'fr_cnic' => $cnicArray[$i],
                'fr_ID' => $farmeridArray[$i],
                'fr_name' => $nameArray[$i]
            );

            $farmers[] = $farmer;
            \DB::update('UPDATE farmers SET fr_balance = fr_balance - ? WHERE fr_cnic = ?', [$amntArray[$i],$cnicArray[$i]]);
            
        }
         Fpayments::insert($farmers);


         return back()->with('success', 'Bank Receipt has been added');
        }

        elseif(!$request->input('ct_sno') == "")
        {

        // FOR VOUCHER NUMBER
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
                'brv_amount' => $titleamount,
                'br_cqdate' => $titlechequedate,
                'br_cqnumber' => $titlechequenumber,
                'acc_number' => $titleName,
                'acc_title' => $title,
                'brv_no' => $titlevoucher
            );

            $vouchers[] = $voucher;

            Brvouchers::insert($vouchers);


        // FOR BANK RECEIPT
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
                'br_preparedby' => $preparedby,
                'br_tag' => 'Receipt',
                'acc_balance' => $balanceArray[$i],
                'br_amount' => $amntArray[$i],
                'br_description' => $descArray[$i],
                'br_name' => $nameArray[$i],
                'br_head' => $headArray[$i],
                'br_type' => $typeArray[$i],
                'br_sno' => $serialArray[$i],
                'br_cqdate' => $titlechequedate,
                'br_cqnumber' => $titlechequenumber,
                'acc_number' => $titleName,
                'acc_title' => $title,
                'brv_no' => $titlevoucher
            );

            $items[] = $item;

            $amountArray = $request->input('amnt');
            $headidArray = $request->input('head');

            if($typeArray[$i] == 'Liability')
            {
               \DB::update('UPDATE heads SET h_balance = h_balance + ? WHERE h_ID = ?', [$amountArray[$i],$headidArray[$i]]);  
            }
            elseif($typeArray[$i] == 'Income')
            {
                \DB::update('UPDATE heads SET h_balance = h_balance + ? WHERE h_ID = ?', [$amountArray[$i],$headidArray[$i]]);   
            }
            else{
               \DB::update('UPDATE heads SET h_balance = h_balance - ? WHERE h_ID = ?', [$amountArray[$i],$headidArray[$i]]); 
            }
            
        }
        Bankreceipts::insert($items);

        // Update Bank Account After Transaction has Submitted Successfully
        \DB::update('UPDATE accountsbks SET acc_balance = ? WHERE acc_title = ?', [$request->input('r_balance'),$request->input('accounttitle')]);
        }

         return back()->with('success', 'Bank Receipt has been added');
        }
    } else {
        return back()->with('success', 'Bank Receipt has been added');
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
        $detail = \DB::select('SELECT DISTINCT acc_title, created_at, brv_no, br_preparedby FROM bankreceipts WHERE brv_no = ?', [$id]);
        $voucher = \DB::select('SELECT * FROM bankreceipts WHERE brv_no = ?', [$id]);
        return view('bankreceipts.show', ['voucher' => $voucher], ['detail' => $detail]);
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

     public function searchVoucherbr(Request $request)
    {
        if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('brvouchers')
                 ->orderBy('brv_no', 'desc')
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
                ++$row->brv_no;
               }
              }
              else
              {
               $output = 'BR-00000
               ';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }
}
