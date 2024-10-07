<?php

namespace App\Http\Controllers;

use App\Heads;
use Illuminate\Http\Request;

class IncomeledgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        // $income = \DB::select('SELECT * FROM heads WHERE h_name = "Advance Sales" AND h_type = "Income" AND fyear = ');
        $result = sscanf($fnl->fn_name, '%d-%d');
        // dd($result[1]);
        $from = $result[0];
        $to = $result[1];
        $startMonth = 7; // Replace with the starting month
        $endMonth = 6; // Replace with the ending month
        $startDate = "$from-$startMonth-01";
        $endDate = "$to-$endMonth-30";
        $income = Heads::where('h_type','Income')->get();
        // dd($income);
        foreach($income as $item){
           
            $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);

            $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);

            $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$item->h_name, $fnl->fn_name]);
            // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
            $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
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
                }else  if($journalvouchers->jv_acc_status == 'Credit') {
                    $totalcredit += $journalvouchers->jv_amount;
                }
            }
            // dd($totalcredit);
            $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$item->h_name, $fnl->fn_name]);
            // dd($assetbalances);
            foreach ($assetbalances as $orbalance){
                $remaining = 0;
                $remaining =  $totalcredit - $totaldebit;
                if($assetbalances ==null){
                     $remaining = 0 + $remaining;
                     $orbalance = new \stdClass();
                     $orbalance->h_name ='';
                     $orbalance->ob_amount = 0;
                     $orbalance->h_opbalance= 0;
                     $orbalance->h_balance= 0;
                }else{
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance,$orbalance->ob_amount);
            }
            $item->h_balance = $remaining;
            $item->h_opbalance = array_sum($ab_opening_blance);
        }
        return view('incomeledgers.index', ['income' => $income]);
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
        $fnl = \DB::table('fnlyear')->first();
        $voucher = \DB::select('SELECT * FROM cashtransactions WHERE ct_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE cr_name = ? AND fyear = ?', [$id, $fnl->fn_name]);


        $bankvoucher = \DB::select('SELECT * FROM banktransactions WHERE ex_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $bankrvoucher = \DB::select('SELECT * FROM bankreceipts WHERE br_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

        $journalvoucher = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
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
            }else  if($journalvouchers->jv_acc_status == 'Credit') {
                $totalcredit += $journalvouchers->jv_amount;
            }
        }
        // $assetbalances = \DB::select('SELECT * FROM heads WHERE h_name = ?', [$id]);
        $assetbalances = \DB::select('SELECT * FROM heads S JOIN obalances S2 ON S.h_name = S2.sub_name WHERE S.h_name = ? AND S2.ob_fyear = ?', [$id, $fnl->fn_name]);
       
        foreach ($assetbalances as $orbalance){
            $remaining = 0;
            $remaining =  $totalcredit - $totaldebit;
            if($assetbalances ==null){
                 $remaining = 0 + $remaining;
                 $orbalance = new \stdClass();
                 $orbalance->h_name ='';
                 $orbalance->ob_amount = 0;
                 $orbalance->h_opbalance= 0;
                 $orbalance->h_balance= 0;
            }else{
                $remaining = $orbalance->ob_amount + $remaining;
            }
            array_push($ab_opening_blance,$orbalance->ob_amount);
        }
        $assetbalances[0]->h_balance = $remaining;
        $assetbalances[0]->ob_amount = array_sum($ab_opening_blance);

        return view('incomeledgers.show', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'bankvoucher' => $bankvoucher , 'bankrvoucher' => $bankrvoucher , 'assetbalances' => $assetbalances, 'journalvoucher' => $journalvoucher]);
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
