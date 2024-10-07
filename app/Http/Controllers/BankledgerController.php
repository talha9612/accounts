<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bankledgers;
use App\Accountsbks;
use PDF;

class BankledgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fnl = \DB::table('fnlyear')->first();
        $result = sscanf($fnl->fn_name, '%d-%d');
        // dd($result[1]);
        $from = $result[0];
        $to = $result[1];
        $startMonth = 7; // Replace with the starting month
        $endMonth = 6; // Replace with the ending month
        $startDate = "$from-$startMonth-01";
        $endDate = "$to-$endMonth-30";
        $voucher = Accountsbks::get();
        //  $voucher = \DB::select('SELECT * FROM accountsbks');
        //  dd($voucher);
        foreach($voucher as $item){

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
        // dd($voucher);
        return view('bankledgers.index', ['voucher' => $voucher]);
        // $vouchers = Accountsbks::all()->toArray();
        // return view('bankledgers.index', compact('vouchers'));
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
        // $voucher = \DB::select('SELECT created_at, ex_name, bt_description, bkvr_no, SUM(`bt_amount`) `btamount` FROM banktransactions WHERE acc_number = ? GROUP BY bkvr_no, created_at, ex_name, bt_description', [$id]);
        $fnl = \DB::table('fnlyear')->first();
        $voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? AND fyear = ?', [$id, $fnl->fn_name]);
        // $balances = \DB::select('SELECT * FROM accountsbks WHERE acc_number = ? ORDER BY created_at', [$id]);
        $balances = \DB::select('SELECT * FROM accountsbks S JOIN obalances S2 ON S.acc_number = S2.sub_ID WHERE S.acc_number = ? AND S2.ob_fyear = ?', [$id, $fnl->fn_name]);
        return view('bankledgers.show', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'balances' => $balances]);
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

     public function bankrangeCal(Request $request)
    {
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $title = $request->input('title');

        if(!$fromdate == "" && !$todate == "")
        {
        $voucher =  \DB::select('SELECT * FROM banktransactions WHERE (created_at BETWEEN ? AND  ?) AND (acc_number = ?)', [$fromdate, $todate, $title]);
        $rvoucher = \DB::select('SELECT * from bankreceipts WHERE (created_at BETWEEN ? AND  ?) AND (acc_number = ?)', [$fromdate, $todate, $title]);
        $balances = \DB::select('SELECT * FROM accountsbks WHERE acc_number = ?', [$title]);
        return view('bankledgers.show', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'balances' => $balances]);
        }
        else{
            return back()->with('warning', 'Please enter a valid range');
        }
    }
    public function printBl($id)
    {
        $voucher =  \DB::select('SELECT created_at, bkvr_no, ex_ID, ex_name, bt_description, bt_amount, acc_balance, bt_tag FROM banktransactions WHERE acc_number = ?
            UNION
            SELECT created_at, brv_no, br_head, br_name, br_description, br_amount, acc_balance, br_tag FROM bankreceipts WHERE acc_number = ? ORDER BY created_at
            ', [$id, $id]);

        // $voucher =  \DB::select('SELECT * FROM banktransactions WHERE acc_number = ? ORDER BY created_at', [$id]);
        // $rvoucher = \DB::select('SELECT * FROM bankreceipts WHERE acc_number = ? ORDER BY created_at', [$id]);
        $balances = \DB::select('SELECT * FROM accountsbks WHERE acc_number = ? ORDER BY created_at', [$id]);
        $pdf = PDF::loadView('PDF.pdfbankledger', ['voucher' => $voucher], ['balances' => $balances]);
        return $pdf->stream($id.'_Ledger.pdf');
    }
}
