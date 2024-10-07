<?php

namespace App\Http\Controllers;

use App\Heads;
use App\Suppliers;
use Illuminate\Http\Request;

class LiabilityledgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $suppliers = \DB::select('SELECT * FROM suppliers');
        // $liabilities = \DB::select('SELECT * FROM heads WHERE h_type = "Liability"');
        $fnl = \DB::table('fnlyear')->first();
        $result = sscanf($fnl->fn_name, '%d-%d');
        // dd($result[1]);
        $from = $result[0];
        $to = $result[1];
        $startMonth = 7; // Replace with the starting month
        $endMonth = 6; // Replace with the ending month
        $startDate = "$from-$startMonth-01";
        $endDate = "$to-$endMonth-30";
        $suppliers = Suppliers::get();
        $liabilities = Heads::where('h_type','Liability')->get();
        // dd($liabilities);
        foreach($suppliers as $item){
            $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];

            $voucher =  \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company, po_grandtotal FROM porders WHERE s_company = ? AND fyear = ?', [$item->s_company, $fnl->fn_name]);
            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->s_company, $fnl->fn_name]);
            $sp =  \DB::select('SELECT * FROM spayments WHERE s_company = ? AND fyear = ?', [$item->s_company, $fnl->fn_name]);

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
            $balances = \DB::select('SELECT * FROM suppliers S JOIN obalances S2 ON S.s_company = S2.sub_name  WHERE S.s_company = ? AND S2.ob_fyear = ? AND S.s_ID = S2.sub_ID', [$item->s_company, $fnl->fn_name]);
            // dd($balances);
            foreach ($balances as $orbalance){
                $remaining = 0;
                $remaining =  $totalcredit - $totaldebit;
                if($balances ==null){
                     $remaining = 0 + $remaining;
                     $orbalance = new \stdClass();
                     $orbalance->s_company ='';
                     $orbalance->ob_amount = 0;
                     $orbalance->s_balance=0;
                     $orbalance->s_duedate=0;
                }else{
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance,$orbalance->ob_amount);
            }
            $item->s_balance = $remaining;
            $item->s_obalance = array_sum($ab_opening_blance);

        }
        foreach($liabilities as $item){
            // dd($item);
            $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
            $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $bankvoucher =  \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($journalvoucher);
            foreach ($voucher as $cashtransactions){
                $totaldebit += $cashtransactions->ct_amount;
            }
            foreach ($rvoucher as $rcashtransactions){
                $totalcredit += $rcashtransactions->cr_amount;
            }
            foreach ($bankvoucher as $banktransactions){
                $totaldebit += $banktransactions->bt_amount;
            }
            foreach ($bankrvoucher as $rbanktransactions){
                $totalcredit += $rbanktransactions->br_amount;
            }
            foreach ($journalvoucher as $journalvouchers){
                if($journalvouchers->jv_acc_status == 'Debit'){
                    $totaldebit += $journalvouchers->jv_amount;
                }else if($journalvouchers->jv_acc_status == 'Credit') {
                    $totalcredit += $journalvouchers->jv_amount;
                }
            }
            // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
            $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($totalcredit);
            $remaining = 0;
            foreach ($assetbalances as $orbalance){

                if($assetbalances ==null){
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->h_name ='';
                    $orbalance->ob_amount = 0;
                    $orbalance->h_opbalance=0;
                    $orbalance->h_balance=0;
                }else{
                    $remaining = $orbalance->ob_amount + $totalcredit;
                }
                array_push($ab_opening_blance,$orbalance->ob_amount);
            }
            // dd($totaldebit);
            $remaining =  $remaining - $totaldebit;

            $item->h_balance = $remaining;
            $item->h_opbalance = array_sum($ab_opening_blance);
            // dd($totaldebit);
        }
        return view('liabilityledgers.index', ['liabilities' => $liabilities], ['suppliers' => $suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
         $fnl = \DB::table('fnlyear')->first();
        $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

        $bankvoucher =  \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

        $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

        // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
        $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$id, $fnl->fn_name]);
        // dd($assetbalances);
         // Custom Calculation
         $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];

         // dd($journalvoucher);
         foreach ($voucher as $cashtransactions){
             $totaldebit += $cashtransactions->ct_amount;
         }
         foreach ($rvoucher as $rcashtransactions){
             $totalcredit += $rcashtransactions->cr_amount;
         }
         foreach ($bankvoucher as $banktransactions){
             $totaldebit += $banktransactions->bt_amount;
         }
         foreach ($bankrvoucher as $rbanktransactions){
             $totalcredit += $rbanktransactions->br_amount;
         }
         foreach ($journalvoucher as $journalvouchers){
             if($journalvouchers->jv_acc_status == 'Debit'){
                 $totaldebit += $journalvouchers->jv_amount;
             }else if($journalvouchers->jv_acc_status == 'Credit') {
                 $totalcredit += $journalvouchers->jv_amount;
             }
         }
         $remaining = 0;

         foreach ($assetbalances as $orbalance){

             if($assetbalances ==null){
                 $remaining = 0 + $remaining;
                 $orbalance = new \stdClass();
                 $orbalance->h_name ='';
                 $orbalance->ob_amount = 0;
                 $orbalance->h_balance=0;
             }else{
                 $remaining = $orbalance->ob_amount + $totalcredit;
             }
             array_push($ab_opening_blance,$orbalance->ob_amount);
         }
         // dd($totaldebit);
         $remaining =  $remaining - $totaldebit;
        //  dd($assetbalances);
         $assetbalances[0]->h_balance = $remaining;
         $assetbalances[0]->ob_amount = array_sum($ab_opening_blance);
         // dd($totaldebit);
        return view('liabilityledgers.show', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'bankvoucher' => $bankvoucher , 'bankrvoucher' => $bankrvoucher,  'assetbalances' => $assetbalances,  'journalvoucher' => $journalvoucher]);
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
