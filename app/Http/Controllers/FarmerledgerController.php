<?php

    namespace App\Http\Controllers;

use App\Farmer;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Input;
    use PDF;

    class FarmerledgerController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
           
            $user = Auth::user();
            $date = $request->input("date");
            if ($date==null){
                $date = date('Y-m-d H:i:s');
            }
            $dates = $date." 23:59:59";
            $requisitions = \DB::select("SELECT * from farmers WHERE updated_at<='$dates'");
            return view('farmerledgers.index', ['requisitions' => $requisitions, 'date'=>$date]);
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
            $voucher =  \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

            $return =  \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ? AND fyear = ?', [$id, $fnl->fn_name]);

            $service =  \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? AND fyear = ?', [$id, $fnl->fn_name]);

            $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
            $fp =  \DB::select('SELECT * FROM fpayments WHERE fr_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
            // $balances = \DB::select('SELECT * FROM farmers WHERE fr_name = ?', [$id]);
// dd($voucher);
            $totaldebit = 0; $totalcredit = 0;$ab_opening_blance=[];
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
            $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S2.ob_fyear = ? AND S.fr_ID = S2.sub_ID', [$id, $fnl->fn_name]);
            // dd($balances);
            $remaining = 0;
            foreach($balances as $orbalance){
                if($balances == null){
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->fr_name ='';
                    $orbalance->ob_amount = 0;
                    $orbalance->fr_balance = 0;
                    $orbalance->fr_duedate = 0;
                }else{
                    $remaining = $orbalance->ob_amount + $totaldebit;
                    array_push($ab_opening_blance,$orbalance->ob_amount);
                }
            }
            $remaining =  $remaining - $totalcredit;
            $balances[0]->fr_balance = $remaining;
            $balances[0]->fr_opbalance = array_sum($ab_opening_blance);
            return view('farmerledgers.show', ['voucher' => $voucher], ['balances' => $balances, 'jv' => $jv, 'fp' => $fp, 'return' => $return, 'service' => $service]);
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

        public function printFl($id)
        {
            $pass = \DB::select('
            SELECT jv_no, jv_acc_name, jv_acc_status, jv_amount, created_at FROM journalvouchers WHERE jv_acc_name = ?
                UNION
            SELECT vr_number, fr_name, fp_description, fp_amount, created_at FROM fpayments WHERE fr_name = ?
                UNION
            SELECT sl_number, fr_name, sl_title, sl_totalprice, created_at FROM sales WHERE fr_name = ? ORDER BY created_at DESC', [$id, $id, $id]);
            $balances = \DB::select('SELECT * FROM farmers WHERE fr_name = ? ORDER BY updated_at', [$id]);
            $pdf = PDF::loadView('PDF.pdffarmerledger', ['pass' => $pass], ['balances' => $balances]);
            return $pdf->stream($id.'_Ledger.pdf');
        }
    }
