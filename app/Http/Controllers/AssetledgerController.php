<?php

namespace App\Http\Controllers;

use App\Heads;
use App\Accountsbks;
use App\Cashinhands;
use App\Farmer;
use Illuminate\Http\Request;

class AssetledgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd('h');
        $fnl = \DB::table('fnlyear')->first();
        $result = sscanf($fnl->fn_name, '%d-%d');
        // dd($result[1]);
        $from = $result[0];
        $to = $result[1];
        $startMonth = 7; // Replace with the starting month
        $endMonth = 6; // Replace with the ending month
        $startDate = "$from-$startMonth-01";
        $endDate = "$to-$endMonth-30";
        $cashaccount = Cashinhands::get(); // $item->cih_title
        $bankaccount =Accountsbks::get(); // $item->acc_title
        $assets = Heads::where("h_type" , "Asset")->get(); // $item->h_name
        $farmers =Farmer::get(); // $item->fr_name
        // dd($bankaccount);
        // For Cash Account Table calculation
            foreach($cashaccount as $item){
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
                foreach ($balances as $orbalance){
                    $remaining = 0;
                    if($balances ==null){
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->cih_title ='';
                        $orbalance->ob_amount = 0;
                        $orbalance->acc_balance=0;
                        $orbalance->cih_balance=0;
                    }else{
                        $remaining = $orbalance->ob_amount + $totaldebit;
                    }
                    array_push($ab_opening_blance,$orbalance->ob_amount);
                }
                $remaining =  $remaining - $totalcredit;
                $item->cih_balance = $remaining;
                $item->cih_obalance = array_sum($ab_opening_blance);
                // dd($ab_opening_blance);
            }
        // End Here Cash Account Table calculation
        // For Bank Account Table Calculation
            foreach($bankaccount as $item){
                $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                $voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
                $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? AND fyear = ?', [$item->acc_number, $fnl->fn_name]);
                foreach ($voucher as $cashtransactions){
                    $totalcredit += $cashtransactions->bt_amount;
                }
                foreach ($rvoucher as $rcashtransactions){
                    $totaldebit += $rcashtransactions->br_amount;
                }
                $balances = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_number = S2.sub_ID WHERE S.acc_number = ? AND S2.ob_fyear = ?', [$item->acc_number, $fnl->fn_name]);
                // dd($balances);
                $remaining = 0;
                foreach($balances as $orbalance){
                    if($balances ==null){
                        $remaining = 0 + $remaining;
                        $orbalance = new \stdClass();
                        $orbalance->acc_title ='';
                        $orbalance->ob_amount = 0;
                        $orbalance->acc_balance=0;
                   }else{
                       $remaining = $orbalance->ob_amount + $totaldebit;
                   }
                   array_push($ab_opening_blance,$orbalance->ob_amount);
                }
                // dd($totalcredit);
                $remaining =  $remaining - $totalcredit;
                $item->acc_balance = $remaining;
                $item->acc_opbalance = array_sum($ab_opening_blance);
            }
        // End Here Bank Account Table Calculation
        // For Assets Table Calculation
            foreach($assets as $item){
                // dd($item);
                $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
                $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
                // For Find Debit Vaules
                foreach ($voucher as $cashtransactions){
                    $totaldebit += $cashtransactions->ct_amount;
                }
                foreach ($bankvoucher as $banktransactions){
                    $totaldebit += $banktransactions->bt_amount;
                }
                foreach ($journalvoucher as $journalvouchers){
                    if($journalvouchers->jv_acc_status == 'Debit'){
                        $totaldebit += $journalvouchers->jv_amount;
                    }else if($journalvouchers->jv_acc_status == 'Credit'){
                        $totalcredit += $journalvouchers->jv_amount;
                    }
                }
                // End Here Debit Code
                // For Find Credit Vaules
                foreach ($rvoucher as $rcashtransactions){
                    $totalcredit += $rcashtransactions->cr_amount;
                }
                foreach ($bankrvoucher as $rbanktransactions){
                    $totalcredit += $rbanktransactions->br_amount;
                }
                // End Here Credit Code
                $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
                // dd($assetbalances);
                $remaining = 0;
                foreach($assetbalances as $orbalance) {
                    if($assetbalances == null){
                        $remaining = 0 + $remaining;
                            $orbalance = new \stdClass();
                            $orbalance->h_name ='';
                            $orbalance->h_opbalance = 0;
                            $orbalance->h_balance=0;
                            $orbalance->ob_amount=0;
                    }else{
                        $remaining = $orbalance->ob_amount + $totaldebit;
                        array_push($ab_opening_blance,$orbalance->ob_amount);
                    }
                }
                $remaining =  $remaining - $totalcredit;
                $item->h_balance = $remaining;
                $item->h_opbalance = array_sum($ab_opening_blance);
            }
        // End Here Assets Table Calculation
        // For Farmers Table Calculation
            foreach($farmers as $item){
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
        // End Here Farmers Table Calculation
        // $cashaccount = \DB::select('SELECT * FROM cashinhands');
        // $bankaccount = \DB::select('SELECT * FROM accountsbks');
        // $assets = \DB::select('SELECT * FROM heads WHERE h_type = "Asset"');
        // $farmers = \DB::select('SELECT * FROM farmers');
        return view('assetledgers.index', ['cashaccount' => $cashaccount], ['bankaccount' => $bankaccount, 'assets' => $assets, 'farmers' => $farmers]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fnl = \DB::table('fnlyear')->first();
        $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

        $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

        $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
        $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$id, $fnl->fn_name]);
        // dd($assetbalances);

        $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
        // For Find Debit Vaules
        foreach ($voucher as $cashtransactions){
            $totaldebit += $cashtransactions->ct_amount;
        }
        foreach ($bankvoucher as $banktransactions){
            $totaldebit += $banktransactions->bt_amount;
        }
        foreach ($journalvoucher as $journalvouchers){
            if($journalvouchers->jv_acc_status == 'Debit'){
                $totaldebit += $journalvouchers->jv_amount;
            }else if($journalvouchers->jv_acc_status == 'Credit'){
                $totalcredit += $journalvouchers->jv_amount;
            }
        }
        // End Here Debit Code
        // For Find Credit Vaules
        foreach ($rvoucher as $rcashtransactions){
            $totalcredit += $rcashtransactions->cr_amount;
        }
        foreach ($bankrvoucher as $rbanktransactions){
            $totalcredit += $rbanktransactions->br_amount;
        }
        // End Here Credit Code
        $remaining =  $totaldebit - $totalcredit;
        foreach($assetbalances as $orbalance) {
        if($assetbalances == null){
            $remaining = 0 + $remaining;
                $orbalance = new \stdClass();
                $orbalance->h_name ='';
                $orbalance->h_opbalance = 0;
                $orbalance->h_balance=0;
                $orbalance->ob_amount=0;

        }else{
            $remaining = $orbalance->ob_amount + $remaining;
            array_push($ab_opening_blance,$orbalance->ob_amount);
        }
    }

        $assetbalances[0]->h_balance = $remaining;


        return view('assetledgers.show', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'bankvoucher' => $bankvoucher , 'bankrvoucher' => $bankrvoucher , 'assetbalances' => $assetbalances, 'journalvoucher' => $journalvoucher]);
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
}
