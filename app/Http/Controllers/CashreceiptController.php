<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cashreceipts;
use App\Crvoucher;
use App\Fpayments;
use Carbon\Carbon;

class CashreceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $vouchers = Crvoucher::all()->toArray();
        // return view('cashreceipts.index', compact('vouchers'));
        $fnl = \DB::table('fnlyear')->first();
        $vouchers = \DB::select('SELECT * FROM crvouchers WHERE fyear = ?', [$fnl->fn_name]);
        return view('cashreceipts.index', ['vouchers' => $vouchers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cashreceipts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
            $lastRecord = Cashreceipts::latest()->first();
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
            // $set = \Carbon\Carbon::parse($date)->format('d-M-Y g:i A');
        }
        elseif(empty($request->date))
        {
            // $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('d-M-Y');
           $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d');

        }   

        if(!$request->input('farmercnic') == "")   
        {

            // FOR INSERTION OF VOUCHER NUMBER
        $titlevoucher = $request->input('voucher');
        $title = $request->input('countryname');
        $titleamount = $request->input('vr_amount');
        $vouchers = array();
        
        $voucher = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'crv_amount' => $titleamount,
                'cih_title' => $title,
                'crv_no' => $titlevoucher,
                'fyear'=> $fsclyear
            );

            $vouchers[] = $voucher;

            Crvoucher::insert($vouchers); 


            // FOR INSERTION OF CASH RECEIPT

        $titleName = $request->input('countryname');
        $voucherNumber = $request->input('voucher');
        $nameArray = $request->input('farmername');
        $cnicArray = $request->input('farmercnic');
        $descArray = $request->input('frdesc');
        $amntArray = $request->input('amnt');
        $balanceArray = $request->input('balance');
        $farmeridArray = $request->input('farmerid');
        $preparedby = $request->input('preparedby');

        $items = array();
        for($i = 0; $i < count($amntArray); $i++){
            $item = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'cr_preparedby' => $preparedby,
                'cr_tag' => 'Receipt',
                'cih_balance' => $balanceArray[$i],
                'cr_amount' => $amntArray[$i],
                'cr_description' => $descArray[$i],
                'cr_type' => "Asset",
                'cr_head' => 0,
                'cr_name' => $nameArray[$i],
                'cr_sno' => 0,
                'crv_no' => $voucherNumber,
                'cih_title' => $titleName
            );

            $items[] = $item;
            
        }
        Cashreceipts::insert($items);

        // FOR INSERTION OF FARMER PAYMENTS

        for($i = 0; $i < count($amntArray); $i++){
            $farmer = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'vr_number' => $voucherNumber,
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

        // Update Cash Account After Transaction has Submitted Successfully
        \DB::update('UPDATE cashinhands SET cih_balance = ? WHERE cih_title = ?', [$request->input('r_balance'),$request->input('countryname')]);

         return back()->with('success', 'Cash Receipt has been added');

        } 

        elseif(!$request->input('ct_sno') == "")
        {
        $titlevoucher = $request->input('voucher');
        $title = $request->input('countryname');
        $titleamount = $request->input('vr_amount');
        $vouchers = array();
        
        $voucher = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'crv_amount' => $titleamount,
                'cih_title' => $title,
                'crv_no' => $titlevoucher,
                'fyear'=> $fsclyear
            );

            $vouchers[] = $voucher;

            Crvoucher::insert($vouchers);     

//Loop for insertion of cash transactions       
        $titleName = $request->input('countryname');
        $voucherNumber = $request->input('voucher');
        $serialArray = $request->input('ct_sno');
        $nameArray = $request->input('name');
        $headArray = $request->input('head');
        $typeArray = $request->input('type');
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
                'cr_preparedby' => $preparedby,
                'cr_tag' => 'Receipt',
                'cih_balance' => $balanceArray[$i],
                'cr_amount' => $amntArray[$i],
                'cr_description' => $descArray[$i],
                'cr_type' => $typeArray[$i],
                'cr_head' => $headArray[$i],
                'cr_name' => $nameArray[$i],
                'cr_sno' => $serialArray[$i],
                'crv_no' => $voucherNumber,
                'cih_title' => $titleName
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
        Cashreceipts::insert($items);

        // Update Cash Account After Transaction has Submitted Successfully
        \DB::update('UPDATE cashinhands SET cih_balance = ? WHERE cih_title = ?', [$request->input('r_balance'),$request->input('countryname')]);
    }


        return back()->with('success', 'Cash Receipt has been added');
            }
        } else {
            return back()->with('success', 'Cash Receipt has been added');
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
         
        // $voucher = Cashreceipts::find($id);
        $detail = \DB::select('SELECT DISTINCT cih_title, created_at, crv_no, cr_preparedby FROM cashreceipts WHERE crv_no = ?', [$id]);
        $voucher = \DB::select('SELECT * FROM cashreceipts WHERE crv_no = ?', [$id]);
        return view('cashreceipts.show', ['voucher' => $voucher], ['detail' => $detail]);
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

    public function searchVouchercr(Request $request)
    {
                    if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('crvouchers')
                 ->orderBy('crv_no', 'desc')
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
                ++$row->crv_no;
               }
              }
              else
              {
               $output = 'CR-00000
               ';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }
}
