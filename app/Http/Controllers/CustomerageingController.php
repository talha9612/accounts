<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Squotations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;



class CustomerageingController extends Controller
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
    
        // Default to current date if none provided
        if ($date == null) {
            $date = date('Y-m-d H:i:s');
        }
    
        // Set the query end date time
        $dates = $date . " 23:59:59";
    
        $saleInvoices = DB::table('squotations as sq')
            ->select(
                'sq.fr_name',
                'sq.sq_number as invoice_number',
                'sq.created_at as issue_date',
                'sq.sq_grandtotal as debit_amount',
                'sq.sq_term',
                DB::raw('DATEDIFF(NOW(), sq.created_at) as days_ago') // Calculate days ago
            )
            ->groupBy('sq.sq_number')
            ->simplePaginate(100); // Use pagination
    
        // Return the view with all the farmers' data
        return view('customerageing.index', [
            'saleInvoices' => $saleInvoices,
            'date' => $date,
        ]);
    }
    
    // public function index(Request $request)
    // {
    //     $user = Auth::user();
    //     $date = $request->input("date");

    //     // Default to current date if none provided
    //     if ($date == null) {
    //         $date = date('Y-m-d H:i:s');
    //     }

    //     // Set the query end date time
    //     $dates = $date . " 23:59:59";

    //     // Retrieve all requisitions (farmers) whose `updated_at` is before the provided date
    //     $requisitions = \DB::select("SELECT * from farmers");

    //     // Initialize an array to store results for all farmers
    //     $farmersData = [];

    //     // Loop through each farmer (requisition) and calculate their total debit and credit
    //     foreach ($requisitions as $farmer) {
    //         $totaldebit = 0;
    //         $totalcredit = 0;
    //         $ab_opening_balance = [];

    //         // Fetch voucher data for the current farmer
    //         $voucher = \DB::select('SELECT DISTINCT sl_number, sl_name, sl_title, sl_grandtotal, created_at, fr_ID FROM sales WHERE fr_name = ?', [$farmer->fr_name]);

    //         // Fetch sales return data for the current farmer
    //         $return = \DB::select('SELECT DISTINCT slr_number, slr_name, slr_item, slr_saleprice, slr_quantity, created_at, fr_ID FROM salereturns WHERE fr_name = ?', [$farmer->fr_name]);

    //         // Fetch service invoice data for the current farmer
    //         $service = \DB::select('SELECT DISTINCT svi_number, svi_name, svi_crorder, svi_grandtotal, created_at, svi_crid FROM svinvoices WHERE svi_crname = ? ', [$farmer->fr_name]);

    //         // Fetch journal vouchers data for the current farmer
    //         $jv = \DB::select('SELECT * FROM journalvouchers WHERE jv_acc_name = ? ', [$farmer->fr_name]);

    //         // Fetch payment data for the current farmer
    //         $fp = \DB::select('SELECT * FROM fpayments WHERE fr_name = ?', [$farmer->fr_name]);

    //         // Calculate Debit values
    //         foreach ($voucher as $cashtransactions) {
    //             $totaldebit += $cashtransactions->sl_grandtotal;
    //         }

    //         foreach ($service as $services) {
    //             $totaldebit += $services->svi_grandtotal;
    //         }

    //         foreach ($jv as $cashtransactions) {
    //             if ($cashtransactions->jv_acc_status == 'Debit') {
    //                 $totaldebit += $cashtransactions->jv_amount;
    //             } elseif ($cashtransactions->jv_acc_status == 'Credit') {
    //                 $totalcredit += $cashtransactions->jv_amount;
    //             }
    //         }

    //         // Calculate Credit values
    //         foreach ($return as $returns) {
    //             $sale = $returns->slr_saleprice * $returns->slr_quantity;
    //             $totalcredit += $sale;
    //         }

    //         foreach ($fp as $cashtransactions) {
    //             $totalcredit += $cashtransactions->fp_amount;
    //         }

    //         // Fetch the farmer's opening balance and other balance details
    //         $balances = \DB::select('SELECT * FROM farmers S JOIN obalances S2 ON S.fr_name = S2.sub_name WHERE S.fr_name = ? AND S.fr_ID = S2.sub_ID', [$farmer->fr_name]);

    //         $remaining = 0;
    //         if (!empty($balances)) {
    //             foreach ($balances as $orbalance) {
    //                 $remaining = $orbalance->ob_amount + $totaldebit;
    //                 $ab_opening_balance[] = $orbalance->ob_amount;
    //             }
    //         }

    //         $remaining = $totalcredit - $totaldebit;
    //         $farmer_balance = isset($balances[0]) ? $balances[0] : null;
    //         if ($farmer_balance) {
    //             $farmer_balance->fr_balance = $remaining;
    //             $farmer_balance->fr_opbalance = array_sum($ab_opening_balance);
    //         }

    //         // Prepare data for this farmer
    //         $farmersData[] = [
    //             'customer_name' => $farmer->fr_name,
    //             'totaldebit' => $totaldebit,
    //             'totalcredit' => $totalcredit,
    //             'remaining' => $remaining,
    //             'balances' => $farmer_balance,
    //             'jv' => $jv
    //         ];
    //     }
    //     // $currentPage = LengthAwarePaginator::resolveCurrentPage();

    //     // // Define how many farmers you want per page
    //     // $perPage = 10;

    //     // // Convert the array into a collection
    //     // $collection = collect($farmersData);

    //     // // Slice the collection to get the farmers to display in the current page
    //     // $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

    //     // // Create the paginator instance
    //     // $paginatedFarmers = new LengthAwarePaginator(
    //     //     $currentPageItems, // Items for the current page
    //     //     $collection->count(), // Total items
    //     //     $perPage, // Items per page
    //     //     $currentPage, // Current page
    //     //     ['path' => request()->url(), 'query' => request()->query()] // Preserve URL query parameters
    //     // );
    //     // Return the view with all the farmers' data and paginator
    //     return view('customerageing.index', [
    //         'farmersData' => $farmersData,
    //         'date' => $date,
    //         'requisitions' => $requisitions,
    //     ]);
    // }
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


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
        return $pdf->stream($id . '_Ledger.pdf');
    }
}
