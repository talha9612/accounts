<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cashtransactions;
use App\Cashreceipts;
use App\Banktransactions;
use App\Bankreceipts;
use App\Farmer;
use App\Journalvoucher;

class JvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $jvs = \DB::select('SELECT DISTINCT jv_no, created_at, jv_preparedby FROM journalvouchers WHERE fyear = ? ORDER BY created_at DESC', [$fnl->fn_name]);
        return view('journalvouchers.index', ['jvs' => $jvs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('journalvouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $preparedby = $request->input('jv_preparedby');
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

        $amntArray = $request->input('credit');
        $debitArray = $request->input('debitamount');
        $bkamntArray = $request->input('creditbk');
        $bkdebitArray = $request->input('bkdebitamount');
        $framntArray = $request->input('frcredit');
        $frdebitArray = $request->input('farmerdebitamount');
        $srdebitArray = $request->input('supplierdebitamount');
        $srcreditArray = $request->input('srcredit');
        $addcreditArray = $request->input('addcredit');
        $adddebitArray = $request->input('headdebitamount');


          if(!$amntArray == "")
        {
          for($i = 0; $i < count($amntArray); $i++) {
            $titleArray = $request->input('countryname');
            $vouchernumber = $request->input('voucher');
            $idArray = $request->input('accountid');
            $creditdescArray = $request->input('cihdesc');
            $cashcreditArray = $request->input('credit');
            $creditbalanceArray = $request->input('cihbalance');

            $credit = array(

                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'ct_preparedby' => $preparedby,
                'ct_tag' => 'Payment',
                'cih_balance' => $creditbalanceArray[$i],
                'ct_amount' => $cashcreditArray[$i],
                'ct_description' => $creditdescArray[$i],
                'ct_type' => "Liability",
                'ct_head' => 0,
                'ct_name' => "",
                'ct_sno' => 0,
                'vr_no' => $vouchernumber,
                'cih_title' => $titleArray[$i]
            );
            $credits[] = $credit;

             $cashcreditvoucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $cashcreditArray[$i],
            'jv_description' => $creditdescArray[$i],
            'jv_acc_status' => 'Credit',
            'jv_acc_name' => $titleArray[$i],
            'jv_acc_ID' => $idArray[$i],
            'jv_no' => $vouchernumber
            );

            $cashcreditvouchers= $cashcreditvoucher;

            \DB::update('UPDATE cashinhands SET cih_balance = cih_balance - ? WHERE cih_title = ?', [$cashcreditArray[$i],$titleArray[$i]]);

            Journalvoucher::insert($cashcreditvouchers);

            }
            Cashtransactions::insert($credits);

        }


        if(!$debitArray == "")
        {

        for($j = 0; $j < count($debitArray); $j++) {

        $debittitleArray = $request->input('debitaccountname');
        $vouchernumber = $request->input('voucher');
        $idArray = $request->input('debitaccountid');
        $descArray = $request->input('debitdescription');
        $cashdebitArray = $request->input('debitamount');
        $debitbalanceArray = $request->input('debitbalance');
        $debits = array();

            $debit = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'fyear'=> $fsclyear,
                'cr_preparedby' => $preparedby,
                'cr_tag' => 'Receipt',
                'cih_balance' => $debitbalanceArray[$j],
                'cr_amount' => $cashdebitArray[$j],
                'cr_description' => $descArray[$j],
                'cr_type' => "Asset",
                'cr_head' => 0,
                'cr_name' => "",
                'cr_sno' => 0,
                'crv_no' => $vouchernumber,
                'cih_title' => $debittitleArray[$j]
            );
            $debits[] = $debit;

        \DB::update('UPDATE cashinhands SET cih_balance = cih_balance + ? WHERE cih_title = ?', [$cashdebitArray[$j],$debittitleArray[$j]]);
        Cashreceipts::insert($debits);

         $cashdebitvoucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $cashdebitArray[$j],
            'jv_description' => $descArray[$j],
            'jv_acc_status' => 'Debit',
            'jv_acc_name' => $debittitleArray[$j],
            'jv_acc_ID' => $idArray[$j],
            'jv_no' => $vouchernumber
            );
            $cashdebitvouchers[] = $cashdebitvoucher;

        }
         Journalvoucher::insert($cashdebitvouchers);

        }

          if(!$bkamntArray == "")
        {
          for($i = 0; $i < count($bkamntArray); $i++) {
            $vouchernumber = $request->input('voucher');
            $bktitleArray = $request->input('accountname');
            $bkidArray = $request->input('accountnumber');
            $bkdescArray = $request->input('desc');
            $bkamntArray = $request->input('creditbk');
            $bkcreditbalanceArray = $request->input('accbalance');
            $bkcredits = array();
                $bkcredit = array(
                    'updated_at'=> $set,
                    'created_at'=> $set,
                    'fyear'=> $fsclyear,
                    'bt_preparedby' => $preparedby,
                    'bt_tag' => 'Payment',
                    'acc_balance' => $bkcreditbalanceArray[$i],
                    'bt_amount' => $bkamntArray[$i],
                    'bt_description' => $bkdescArray[$i],
                    'ex_name' => "",
                    'ex_type' => "Liability",
                    'ex_ID' => 0,
                    'bt_sno' => 0,
                    'bt_cqdate' => 0,
                    'bt_cqnumber' => 0,
                    'acc_number' => $bkidArray[$i],
                    'acc_title' => $bktitleArray[$i],
                    'bkvr_no' => $vouchernumber
                );
                $bkcredits[] = $bkcredit;

              $bankcreditvoucher = array(
              'created_at' => $set,
              'updated_at' => $set,
              'fyear'=> $fsclyear,
              'jv_preparedby' => $preparedby,
              'jv_amount' => $bkamntArray[$i],
              'jv_description' => $bkdescArray[$i],
              'jv_acc_status' => 'Credit',
              'jv_acc_name' => $bktitleArray[$i],
              'jv_acc_ID' => $bkidArray[$i],
              'jv_no' => $vouchernumber
              );
            $bankcreditvouchers[] = $bankcreditvoucher;

        \DB::update('UPDATE accountsbks SET acc_balance = acc_balance - ? WHERE acc_title = ?', [$bkamntArray[$i],$bktitleArray[$i]]);
         Banktransactions::insert($bkcredits);
         }

        Journalvoucher::insert($bankcreditvouchers);

        }

          if(!$bkdebitArray == "")
        {
          for($i = 0; $i < count($bkdebitArray); $i++) {
            $bkdebitnameArray = $request->input('bkdebitaccountname');
            $bkdebitnumberArray = $request->input('bkdebitaccountnumber');
            $vouchernumber = $request->input('voucher');
            $bkdebitdescArray = $request->input('bkdebitdescription');
            $bkdebitArray = $request->input('bkdebitamount');
            $bkdebitbalanceArray = $request->input('bkdebitbalance');
            $bkdebits = array();
                $bkdebit = array(
                    'updated_at'=> $set,
                    'created_at'=> $set,
                    'fyear'=> $fsclyear,
                    'br_preparedby' => $preparedby,
                    'br_tag' => 'Receipt',
                    'acc_balance' => $bkdebitbalanceArray[$i],
                    'br_amount' => $bkdebitArray[$i],
                    'br_description' => $bkdebitdescArray[$i],
                    'br_type' => "Asset",
                    'br_head' => 0,
                    'br_name' => "",
                    'br_sno' => 0,
                    'brv_no' => $vouchernumber,
                    'br_cqdate' => 0,
                    'br_cqnumber' => 0,
                    'acc_number' => $bkdebitnumberArray[$i],
                    'acc_title' => $bkdebitnameArray[$i]

                );
            $bkdebits[] = $bkdebit;

             $bankdebitvoucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $bkdebitArray[$i],
            'jv_description' => $bkdebitdescArray[$i],
            'jv_acc_status' => 'Debit',
            'jv_acc_name' => $bkdebitnameArray[$i],
            'jv_acc_ID' => $bkdebitnumberArray[$i],
            'jv_no' => $vouchernumber
            );
            $bankdebitvouchers[] = $bankdebitvoucher;

        \DB::update('UPDATE accountsbks SET acc_balance = acc_balance + ? WHERE acc_title = ?', [$bkdebitArray[$i],$bkdebitnameArray[$i]]);
         Bankreceipts::insert($bkdebits);

      }

          Journalvoucher::insert($bankdebitvouchers);

        }

        if(!$framntArray == "")
        {
          for($i = 0; $i < count($framntArray); $i++) {
          $vouchernumber = $request->input('voucher');
          $farmercreditbalance = $request->input('frbalance');
          $farmercreditid = $request->input('farmerid');
          $farmercreditname = $request->input('farmername');
          $farmercredit = $request->input('frcredit');
          $farmercreditdesc = $request->input('frdesc');

          \DB::update('UPDATE farmers SET fr_balance = fr_balance - ? WHERE fr_ID = ?', [$farmercredit[$i], $farmercreditid[$i]]);

          $farmercreditvoucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $farmercredit[$i],
            'jv_description' => $farmercreditdesc[$i],
            'jv_acc_status' => 'Credit',
            'jv_acc_name' => $farmercreditname[$i],
            'jv_acc_ID' => $farmercreditid[$i],
            'jv_no' => $vouchernumber
            );
            $farmercreditvouchers[] = $farmercreditvoucher;

          }
           Journalvoucher::insert($farmercreditvouchers);

        }

         if(!$frdebitArray == "")
        {
          for($i = 0; $i < count($frdebitArray); $i++) {
          $vouchernumber = $request->input('voucher');
          $farmerdebitbalance = $request->input('debitfarmerbalance');
          $farmerdebitid = $request->input('debitfarmerid');
          $farmerdebit = $request->input('farmerdebitamount');
          $farmerdebitname = $request->input('debitfarmername');
          $farmerdebitdesc = $request->input('frdebitdesc');

          \DB::update('UPDATE farmers SET fr_balance = fr_balance + ? WHERE fr_ID = ?', [$farmerdebit[$i],$farmerdebitid[$i]]);

          $farmerdebitvoucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $farmerdebit[$i],
            'jv_description' => $farmerdebitdesc[$i],
            'jv_acc_status' => 'Debit',
            'jv_acc_name' => $farmerdebitname[$i],
            'jv_acc_ID' => $farmerdebitid[$i],
            'jv_no' => $vouchernumber
            );
            $farmerdebitvouchers[] = $farmerdebitvoucher;

          }
           Journalvoucher::insert($farmerdebitvouchers);

        }

        if(!$srdebitArray == "")
        {
          for($i = 0; $i < count($srdebitArray); $i++) {
          $vouchernumber = $request->input('voucher');
          $supplierdebitbalance = $request->input('debitsupplierbalance');
          $supplierdebitid = $request->input('debitsupplierid');
          $supplierdebit = $request->input('supplierdebitamount');
          $supplierdebitcompany = $request->input('debitsuppliercompany');
          $supplierdebitdesc = $request->input('srdebitdesc');

          \DB::update('UPDATE suppliers SET s_balance = s_balance - ? WHERE s_ID = ?', [$supplierdebit[$i], $supplierdebitid[$i]]);

          $supplierdebitvoucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $supplierdebit[$i],
            'jv_description' => $supplierdebitdesc[$i],
            'jv_acc_status' => 'Debit',
            'jv_acc_name' => $supplierdebitcompany[$i],
            'jv_acc_ID' => $supplierdebitid[$i],
            'jv_no' => $vouchernumber
            );
            $supplierdebitvouchers[] = $supplierdebitvoucher;

          }
          Journalvoucher::insert($supplierdebitvouchers);

        }

        if(!$srcreditArray == "")
        {
          for($i = 0; $i < count($srcreditArray); $i++) {
          $vouchernumber = $request->input('voucher');
          $suppliercreditbalance = $request->input('supplierbalance');
          $suppliercreditid = $request->input('supplierid');
          $suppliercredit = $request->input('srcredit');
          $suppliercreditcompany = $request->input('suppliercompany');
          $supplierdescription = $request->input('srdesc');

          \DB::update('UPDATE suppliers SET s_balance = s_balance + ? WHERE s_ID = ?', [$suppliercredit[$i],$suppliercreditid[$i]]);

          $suppliercreditvoucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $suppliercredit[$i],
            'jv_description' => $supplierdescription[$i],
            'jv_acc_status' => 'Credit',
            'jv_acc_name' => $suppliercreditcompany[$i],
            'jv_acc_ID' => $suppliercreditid[$i],
            'jv_no' => $vouchernumber
            );
            $suppliercreditvouchers[] = $suppliercreditvoucher;

          }
          Journalvoucher::insert($suppliercreditvouchers);

        }

        if(!$addcreditArray == "")
        {
          for($i = 0; $i < count($addcreditArray); $i++) {
          $vouchernumber = $request->input('voucher');
          $addbalance = $request->input('balance');
          $head = $request->input('head');
          $name = $request->input('name');
          $addcredit = $request->input('addcredit');
          $addcreditdesc = $request->input('adddesc');
          $type = $request->input('type');



          $voucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $addcredit[$i],
            'jv_description' => $addcreditdesc[$i],
            'jv_acc_status' => 'Credit',
            'jv_acc_name' => $name[$i],
            'jv_acc_ID' => $head[$i],
            'jv_no' => $vouchernumber
            );
            $vouchers[] = $voucher;

             if($type[$i] == 'Liability' || $type[$i] == 'Income')
            {
              \DB::update('UPDATE heads SET h_balance = h_balance + ? WHERE h_ID = ?', [$addcredit[$i],$head[$i]]);
            }
            else{
              \DB::update('UPDATE heads SET h_balance = h_balance - ? WHERE h_ID = ?', [$addcredit[$i],$head[$i]]);
            }

            // \DB::update('UPDATE heads SET h_balance = ? WHERE h_ID = ?', [$addbalance[$i],$head[$i]]);
          }
          Journalvoucher::insert($vouchers);

        }

        if(!$adddebitArray == "")
        {
          for($i = 0; $i < count($adddebitArray); $i++) {
          $vouchernumber = $request->input('voucher');
          $addbalance = $request->input('headbalance');
          $head = $request->input('headid');
          $name = $request->input('headname');
          $adddebit = $request->input('headdebitamount');
          $adddebitdesc = $request->input('headdesc');
          $headtype = $request->input('headtype');



          $debitvoucher = array(
            'created_at' => $set,
            'updated_at' => $set,
            'fyear'=> $fsclyear,
            'jv_preparedby' => $preparedby,
            'jv_amount' => $adddebit[$i],
            'jv_description' => $adddebitdesc[$i],
            'jv_acc_status' => 'Debit',
            'jv_acc_name' => $name[$i],
            'jv_acc_ID' => $head[$i],
            'jv_no' => $vouchernumber
            );
            $debitvouchers[] = $debitvoucher;

            if($headtype[$i] == 'Liability' || $headtype[$i] == 'Income')
            {
              \DB::update('UPDATE heads SET h_balance = h_balance - ? WHERE h_ID = ?', [$adddebit[$i],$head[$i]]);
            }
            else{
              \DB::update('UPDATE heads SET h_balance = h_balance + ? WHERE h_ID = ?', [$adddebit[$i],$head[$i]]);
            }
          }
          Journalvoucher::insert($debitvouchers);

        }

        return back()->with('success', 'Voucher has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $detail = \DB::select('SELECT DISTINCT created_at, jv_no, jv_preparedby FROM journalvouchers WHERE jv_no = ?', [$id]);

      $voucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_no = ? ORDER BY jv_acc_status DESC', [$id]);

      return view('journalvouchers.show', ['voucher'=> $voucher], ['detail'=> $detail]);
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

     public function searchFarmer(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $query = $request->get('term','');
        $countries=\DB::table('farmers');
        if($request->type=='farmername'){
            $countries->where('fr_name','LIKE','%'.$query.'%');
        }
        if($request->type=='farmerid'){
            $countries->where('fr_ID','LIKE','%'.$query.'%');
        }
        if($request->type=='frbalance'){
            $countries->where('fr_balance','LIKE','%'.$query.'%');
        }
         if($request->type=='farmercnic'){
            $countries->where('fr_cnic','LIKE','%'.$query.'%');
        }
        if($request->type=='farmeraddress'){
            $countries->where('fr_address','LIKE','%'.$query.'%');
        }
        if($request->type=='farmergst'){
            $countries->where('fr_gst','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();
           foreach($countries as $item){
            // dd($item);
            $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
            $voucher =  \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $return =  \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $service =  \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            $fp =  \DB::select('SELECT * FROM fpayments WHERE fr_name = ? AND fyear = ?', [$item->fr_name, $fnl->fn_name]);
            // For Find Debit Vaules
            foreach ($voucher as $cashtransactions){
                $totaldebit += $cashtransactions->sl_grandtotal;
            }
            foreach ($service as $services){
                $totaldebit += $services->svi_grandtotal;
            }
            foreach ($jv as $cashtransactions){
                if($cashtransactions->jv_acc_status == 'Debit'){
                    $totaldebit += $cashtransactions->jv_amount;
                }else  if($cashtransactions->jv_acc_status == 'Credit'){
                    $totalcredit += $cashtransactions->jv_amount;
                }
            }
            // End Here Debit Code
            // For Find Credit Vaules
            foreach ($return as $returns){
                $sale = $returns->slr_saleprice * $returns->slr_quantity;
                $totalcredit += $sale;
            }
            foreach ($fp as $cashtransactions){
                $totalcredit += $cashtransactions->fp_amount;
            }
            // dd($totaldebit);
            // End Here Credit Code
            $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S2.ob_fyear = ? AND S.fr_ID = S2.sub_ID', [$item->fr_name, $fnl->fn_name]);
            // $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($assetbalances);
            $remaining = 0;
            foreach($balances as $orbalance){
                if($balances == null){
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->fr_name ='';
                    $orbalance->ob_amount = 0;
                }else{
                    $remaining = $orbalance->ob_amount + $totaldebit;
                    array_push($ab_opening_blance,$orbalance->ob_amount);
                }
            }
            $remaining =  $remaining - $totalcredit;
            $item->fr_balance = $remaining;
            $item->fr_opbalance = array_sum($ab_opening_blance);
        }
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('fr_name'=>$country->fr_name,'fr_ID'=>$country->fr_ID,'fr_balance'=>$country->fr_balance,'fr_cnic'=>$country->fr_cnic, 'fr_address'=>$country->fr_address, 'fr_gst'=>$country->fr_gst);
        }
        if(count($data))
             return $data;
        else
            return ['fr_name'=>'','fr_ID'=>'','fr_balance'=>'','fr_cnic'=>'','fr_address'=>'','fr_gst'=>''];
    }

   public function searchSupplier(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $query = $request->get('term','');
        $countries=\DB::table('suppliers');
        if($request->type=='suppliercompany'){
            $countries->where('s_company','LIKE','%'.$query.'%');
        }
        if($request->type=='supplierid'){
            $countries->where('s_ID','LIKE','%'.$query.'%');
        }
        if($request->type=='supplierbalance'){
            $countries->where('s_balance','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();
           foreach($countries as $item){
            $name = $item->s_company;
            $id = $item->s_ID;
            $voucher =  \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company, po_grandtotal FROM porders WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND jv_acc_ID = ? AND fyear = ?', [$name,$id, $fnl->fn_name]);
            $sp =  \DB::select('SELECT * FROM spayments WHERE s_ID = ? AND s_company = ? AND fyear = ?', [$id, $name, $fnl->fn_name]);
             $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[]; $remaining = 0;;
             foreach ($voucher as $cashtransactions){
                 $totalcredit += $cashtransactions->po_grandtotal;
             }
             foreach ($jv as $cashtransactions){
                 if($cashtransactions->jv_acc_status == 'Debit'){
                     $totaldebit += $cashtransactions->jv_amount;
                 }else if($cashtransactions->jv_acc_status == 'Credit') {
                     $totalcredit += $cashtransactions->jv_amount;
                 }
             }
             foreach ($sp as $cashtransactions){
                 $totaldebit += $cashtransactions->sp_amount;
             }
             $balances = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_ID = S2.sub_ID AND S.s_company = S2.sub_name  WHERE S.s_ID = ? AND S.s_company = ? AND S2.ob_fyear = ? AND S.s_ID = S2.sub_ID', [$id, $name, $fnl->fn_name]);
            //  dd($balances);
             foreach ($balances as $orbalance){

                 $remaining =  $totalcredit - $totaldebit;
                 if(empty($balances)){
                      $remaining = 0 + $remaining;
                      $orbalance = new \stdClass();
                      $orbalance->s_company ='';
                      $orbalance->s_name ='';
                      $orbalance->ob_amount = 0;
                      $orbalance->s_balance=0;
                      $orbalance->s_duedate=0;
                 }else{
                     $remaining = $orbalance->ob_amount + $remaining;
                 }
                 array_push($ab_opening_blance,$orbalance->ob_amount);
                //  dd($ab_opening_blance);
                //  $item->s_balance= $remaining;
                //  $item->s_obalance = array_sum($ab_opening_blance);
                 $item->s_balance= number_format($remaining, 2, '.', '');
                 $item->s_obalance = number_format(array_sum($ab_opening_blance), 2, '.', '');
             }
        }
        $data=array();
        foreach ($countries as $country) {
              $data[]=array('s_company'=>$country->s_company,'s_ID'=>$country->s_ID,'s_balance'=>$country->s_balance);
        }
        if(count($data))
             return $data;
        else
            return ['s_company'=>'','s_ID'=>'','s_balance'=>''];
    }

    public function searchVoucherjournal(Request $request)
    {
     if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('journalvouchers')
                 ->orderBy('jv_no', 'desc')
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
                ++$row->jv_no;
               }
              }
              else
              {
               $output = 'JV-00000';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
        }
}
