<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cashledgers;
use App\Cashinhands;
use PDF;
use DB;

class CashledgerController extends Controller
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
        $vouchers = Cashinhands::get();

        foreach($vouchers as $item){
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
                     $orbalance->ob_amount = 0;
                     $orbalance->acc_balance=0;
                     $orbalance->cih_balance=0;
                }else{
                    $remaining = $orbalance->ob_amount + $remaining;
                }
                array_push($ab_opening_blance,$orbalance->ob_amount);
            }
            // dd($ab_opening_blance);
            $item->cih_balance = $remaining;
            $item->cih_obalance = array_sum($ab_opening_blance);
            // dd($ab_opening_blance);
        }

        // dd($vouchers);
        // $vouchers = Cashinhands::all()->toArray();
        return view('cashledgers.index', compact('vouchers'));
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
    public function show(Request $request, $id)
    {

        // $voucher =  \DB::select('CALL SelectCashtransactionsParam(?)', [$id]);
        // $rvoucher = \DB::select('CALL SelectCashreceiptsParam(?)', [$id]);
        $fnl = \DB::table('fnlyear')->first();

        $voucher =  \DB::select('SELECT * from cashtransactions WHERE cih_title = ? AND fyear = ?', [$id, $fnl->fn_name]);
        $rvoucher = \DB::select('SELECT * from cashreceipts WHERE cih_title = ? AND fyear = ?', [$id, $fnl->fn_name]);
        // $balances = \DB::select('SELECT * FROM cashinhands WHERE cih_title = ?', [$id]);
        $balances = \DB::select('SELECT * FROM cashinhands S JOIN obalances S2 ON S.cih_title = S2.sub_name WHERE S.cih_title = ? AND S2.ob_fyear = ?', [$id, $fnl->fn_name]);
        return view('cashledgers.show', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'balances' => $balances]);


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

    public function rangeCal(Request $request)
    {
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $title = $request->input('title');

        if(!$fromdate == "" && !$todate == "")
        {
        $voucher =  \DB::select('SELECT * FROM cashtransactions WHERE (created_at BETWEEN ? AND  ?) AND (cih_title = ?)', [$fromdate, $todate, $title]);
        $rvoucher = \DB::select('SELECT * FROM cashreceipts WHERE (created_at BETWEEN ? AND  ?) AND (cih_title = ?)', [$fromdate, $todate, $title]);
        $balances = \DB::select('SELECT * FROM cashinhands WHERE cih_title = ?', [$title]);
        return view('cashledgers.show', ['voucher' => $voucher], ['rvoucher' => $rvoucher, 'balances' => $balances]);

        }
        else{
            return back()->with('warning', 'Please enter a valid range');
        }
    }

}
