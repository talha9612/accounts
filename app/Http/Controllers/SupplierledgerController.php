<?php

    namespace App\Http\Controllers;

use App\Suppliers;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Input;
    use PDF;

    class SupplierledgerController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
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
            $user = Auth::user();
            $date = Input::get("date");
            if ($date==null){
                $date = date('Y-m-d H:i:s');
            }
            $dates = $date." 23:59:59";
            $requisitions = Suppliers::where('updated_at','<=', $dates)->get();
            // $requisitions = \DB::select("SELECT * from suppliers WHERE updated_at<='$dates'");
            // dd($requisitions);
            foreach($requisitions as $item){
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
                     $item->s_balance= $remaining;
                     $item->s_obalance = array_sum($ab_opening_blance);
                 }
            }


            return view('supplierledgers.index', ['requisitions' => $requisitions, 'date'=>$dates]);
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
            $requisition = \DB::select("SELECT * from suppliers WHERE s_ID='$id'");
            // dd($requisition);
            $name = $requisition[0]->s_company;
            $fnl = \DB::table('fnlyear')->first();
            // $voucher =  \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company, po_grandtotal FROM porders WHERE s_company = ? AND fyear = ?', [$id, $fnl->fn_name]);
            // $jv =  \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? AND fyear = ?', [$id, $fnl->fn_name]);
            // $sp =  \DB::select('SELECT * FROM spayments WHERE s_company = ? AND fyear = ?', [$id, $fnl->fn_name]);
            // $balances = \DB::select('SELECT * FROM suppliers WHERE s_company = ?', [$id]);

            //  dd($balances);
            // Custom Calculation
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
                 $balances[0]->s_balance = $remaining;
                 $balances[0]->ob_amount = array_sum($ab_opening_blance);
             }
            //   dd($balances);
            
            return view('supplierledgers.show', ['voucher' => $voucher], ['balances' => $balances, 'jv' => $jv, 'sp' => $sp]);
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
        public function printSpl($id)
        {
            $pass = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? ORDER BY updated_at', [$id]);
            $details = \DB::select('SELECT DISTINCT po_number, po_name, po_title, po_totalprice, created_at, s_ID, s_company FROM porders WHERE s_company = ? ORDER BY po_ID', [$id]);
            $balances = \DB::select('SELECT * FROM suppliers WHERE s_company = ? ORDER BY updated_at', [$id]);
            $sp =  \DB::select('SELECT * FROM spayments WHERE s_company = ? ORDER BY updated_at', [$id]);
            $pdf = PDF::loadView('PDF.pdfsupplierledger', ['pass' => $pass], ['details' => $details, 'balances' => $balances, 'sp' => $sp]);
            return $pdf->stream($id.'_SupplierLedger.pdf');
        }
    }
