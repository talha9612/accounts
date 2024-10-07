<?php

namespace App\Http\Controllers;

use App\Heads;
use Illuminate\Http\Request;

class ExpenseledgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        // $expense = \DB::select('SELECT * FROM heads WHERE h_type = "Expense"');
        $result = sscanf($fnl->fn_name, '%d-%d');
        // dd($result[1]);
        $from = $result[0];
        $to = $result[1];
        $startMonth = 7; // Replace with the starting month
        $endMonth = 6; // Replace with the ending month
        $startDate = "$from-$startMonth-01";
        $endDate = "$to-$endMonth-30";
        $expense = Heads::where("h_type","Expense")->get();
// dd($expense);
        foreach($expense as $item){
            $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
            $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($voucher as $cashtransactions){
                $totaldebit += $cashtransactions->ct_amount;
            }
            $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($rvoucher as $rcashtransactions){
                $totalcredit += $rcashtransactions->cr_amount;
            }
            $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($bankvoucher as $banktransactions){
                $totaldebit += $banktransactions->bt_amount;
            }
            $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($bankrvoucher as $rbanktransactions){
                $totalcredit += $rbanktransactions->br_amount;
            }
            $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($journalvoucher as $journalvouchers){
                if($journalvouchers->jv_acc_status == 'Debit'){
                    $totaldebit += $journalvouchers->jv_amount;
                }else if($journalvouchers->jv_acc_status == 'Credit') {
                    $totalcredit += $journalvouchers->jv_amount;
                }
            }
            $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            $gst = \DB::select('SELECT DISTINCT fr_name, sq_number, sq_title, sq_totalst, created_at FROM squotations WHERE fyear = ?', [$fnl->fn_name]);
            foreach($assetbalances as $assetorbalance){
                if($assetorbalance->h_name == 'Import GST & A. GST'){
                    foreach ($gst as $saletax){
                        $totalcredit += $saletax->sq_totalst;
                    }
                } else {}
            }
            //    dd($assetbalances);
            foreach ($assetbalances as $orbalance){
                $remaining = 0;
                if($assetbalances ==null){
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->h_name ='';
                    $orbalance->ob_amount = 0;
                    $orbalance->h_opbalance=0;
                    $orbalance->h_balance=0;
                }else{
                    $remaining = $orbalance->ob_amount + $totaldebit;
                }
                array_push($ab_opening_blance,$orbalance->ob_amount);
            }
            $remaining =  $remaining - $totalcredit;
            $item->h_balance = $remaining;
            $item->h_opbalance = array_sum($ab_opening_blance);
            // dd($remaining);
        }
    // End Here Cash Account Table calculation
   

        // dd($expense); 
        return view('expenseledgers.index', ['expense' => $expense]);
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
        $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
        $fnl = \DB::table('fnlyear')->first();
        $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$id, $fnl->fn_name]);


        $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

        $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
        $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$id, $fnl->fn_name]);

        $gst = \DB::select('SELECT DISTINCT fr_name, sq_number, sq_title, sq_totalst, created_at FROM squotations WHERE fyear = ?', [$fnl->fn_name]);
       
          
            // $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($voucher as $cashtransactions){
                $totaldebit += $cashtransactions->ct_amount;
            }
            // $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($rvoucher as $rcashtransactions){
                $totalcredit += $rcashtransactions->cr_amount;
            }
            // $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($bankvoucher as $banktransactions){
                $totaldebit += $banktransactions->bt_amount;
            }
            // $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($bankrvoucher as $rbanktransactions){
                $totalcredit += $rbanktransactions->br_amount;
            }
            // $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            foreach ($journalvoucher as $journalvouchers){
                if($journalvouchers->jv_acc_status == 'Debit'){
                    $totaldebit += $journalvouchers->jv_amount;
                }else if($journalvouchers->jv_acc_status == 'Credit') {
                    $totalcredit += $journalvouchers->jv_amount;
                }
            }
            // $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            // $gst = \DB::select('SELECT DISTINCT fr_name, sq_number, sq_title, sq_totalst, created_at FROM squotations WHERE fyear = ?', [$fnl->fn_name]);
            foreach($assetbalances as $assetorbalance){
                if($assetorbalance->h_name == 'Import GST & A. GST'){
                    foreach ($gst as $saletax){
                        $totalcredit += $saletax->sq_totalst;
                    }
                } else {}
            }
            //    dd($assetbalances);
            foreach ($assetbalances as $orbalance){
                $remaining = 0;
                if($assetbalances ==null){
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->h_name ='';
                    $orbalance->ob_amount = 0;
                    $orbalance->h_opbalance=0;
                    $orbalance->h_balance=0;
                }else{
                    $remaining = $orbalance->ob_amount + $totaldebit;
                }
                array_push($ab_opening_blance,$orbalance->ob_amount);
            }
            $remaining =  $remaining - $totalcredit;
            $assetbalances[0]->h_balance = $remaining;
            $assetbalances[0]->ob_amount = array_sum($ab_opening_blance);
            // dd($remaining);
       
        return view('expenseledgers.show', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'bankvoucher' => $bankvoucher , 'bankrvoucher' => $bankrvoucher , 'assetbalances' => $assetbalances, 'journalvoucher' => $journalvoucher, 'gst' => $gst]);
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
    public function expensereport()
    {
        $fnl = \DB::table('fnlyear')->first();
        $voucher = \DB::select('SELECT cashtransactions.updated_at, cashtransactions.cih_title, cashtransactions.ct_name, cashtransactions.ct_head, cashtransactions.ct_description, cashtransactions.vr_no, cashtransactions.ct_amount, heads.h_stype  FROM cashtransactions LEFT JOIN heads ON cashtransactions.ct_name = heads.h_name WHERE fyear = ?', [$fnl->fn_name]);

        $rvoucher = \DB::select('SELECT cashreceipts.updated_at, cashreceipts.cih_title, cashreceipts.cr_name, cashreceipts.cr_head, cashreceipts.cr_description, cashreceipts.crv_no, cashreceipts.cr_amount, heads.h_stype  FROM cashreceipts LEFT JOIN heads ON cashreceipts.cr_name = heads.h_name WHERE fyear = ?', [$fnl->fn_name]);

        $bankvoucher = \DB::select('SELECT banktransactions.updated_at, banktransactions.acc_title, banktransactions.ex_name, banktransactions.ex_ID, banktransactions.bt_description, banktransactions.bkvr_no, banktransactions.bt_amount, heads.h_stype  FROM banktransactions LEFT JOIN heads ON banktransactions.ex_name = heads.h_name WHERE fyear = ?', [$fnl->fn_name]);

        $bankrvoucher = \DB::select('SELECT bankreceipts.updated_at, bankreceipts.acc_title, bankreceipts.br_name, bankreceipts.br_head, bankreceipts.br_description, bankreceipts.brv_no, bankreceipts.br_amount, heads.h_stype  FROM bankreceipts LEFT JOIN heads ON bankreceipts.br_name = heads.h_name WHERE fyear = ?', [$fnl->fn_name]);

        $journalvoucher = \DB::select('SELECT journalvouchers.updated_at, journalvouchers.jv_acc_name, journalvouchers.jv_acc_ID, journalvouchers.jv_description, journalvouchers.jv_no, journalvouchers.jv_amount, journalvouchers.jv_acc_status, heads.h_stype  FROM journalvouchers LEFT JOIN heads ON journalvouchers.jv_acc_name = heads.h_name WHERE fyear = ?', [$fnl->fn_name]);
        // $assetbalances = \DB::select('SELECT * FROM heads');

        return view('expenseledgers.expensereport', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'bankvoucher' => $bankvoucher , 'bankrvoucher' => $bankrvoucher, 'journalvoucher' => $journalvoucher]);

        // $assetbalances = \DB::select('SELECT * FROM heads');

        // return view('expenseledgers.expensereport', ['assetbalances' => $assetbalances]);
    }
}
