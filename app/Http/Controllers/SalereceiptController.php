<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salereciepts;
use App\Fpayments;
use Carbon\Carbon;


class SalereceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $vouchers = Brvouchers::all()->toArray();
        // return view('bankreceipts.index', compact('vouchers'));
        $fnl = \DB::table('fnlyear')->first();
        $salereciept = \DB::select('SELECT * FROM salereciepts WHERE fyear = ?', [$fnl->fn_name]);
        return view('salereceipts.index', ['salereceipt' => $salereciept]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salereciepts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // Check if the last record was added in the past 5 seconds to prevent duplicate entries
        $lastRecord = Salereciepts::latest()->first();
        if ($lastRecord) {
            $createdAt = Carbon::parse($lastRecord->created_at)->format('Y-m-d H:i:s');
            $currentTime = Carbon::now('Asia/Karachi');
            $differenceInSeconds = $currentTime->diffInSeconds($createdAt);
    
            if ($differenceInSeconds < 5) {
                return back()->with('success', 'Sale Receipt has already been added recently.');
            }
        }
    
        // Set the fiscal year and date
        $fsclyear = $request->input('fsclyear');
        $date = $request->input('date') ?? now()->setTimezone('Asia/Karachi')->format('Y-m-d');
       // dd($request);
        // Prepare the data for insertion
        $data = [
            'sir_no' => $request->input('receipt'),
            'customer_name' => $request->input('customer_name'),
            'sr_invoice' => $request->input('sq_number'),
            'sr_head' => $request->input('sr_head'),
            'sr_description' => $request->input('sr_description'),
            'rec_amount' => $request->input('amount'),
            'invoice_amount' => $request->input('grandtotal'),
            'sr_preparedby' => $request->input('preparedby'),
            'fyear' => $fsclyear,
            'created_at' => $date,
            'updated_at' => $date
        ];
    
        // Insert data into the salereceipts table
        Salereciepts::create($data);
    
        // Return success message
        return back()->with('success', 'Sale Receipt has been added successfully.');
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

    public function searchCustomer(Request $request)
    {
        if ($request->type == 'customer_name') {
            // Get the search term
            $term = $request->get('term');
    
            // Fetch customers whose names contain the search term, using a case-insensitive LIKE query
            $customers = \DB::table('farmers')
                ->where('fr_name', 'LIKE', '%' . $term . '%') // Search for customers with names that match the term
                ->get();
    
            $data = [];
            foreach ($customers as $customer) {
                // Calculate balance
                $balance = $customer->fr_balance + $customer->fr_opbalance;
                $data[] = [
                    'customer_name' => $customer->fr_name,
                    'balances' => $balance,
                    'fr_ID' => $customer->fr_ID, // ID for further queries
                ];
            }
    
            return response()->json($data);
        }
    
        return response()->json([]); // Return empty if no customer_name type is specified
    }
    
    
    public function getInvoicesByCustomer(Request $request)
    {
        // Fetch invoices for the selected customer
        $invoices = \DB::table('squotations')
            ->where('fr_ID', $request->fr_ID)
            ->get(['sq_number', 'sq_grandtotal']); // Adjust fields as needed
    
        return response()->json($invoices);
    }
    
    // public function searchHead(Request $request)
    // {
    //     $query = $request->get('term','');
    //     $countries=\DB::table('heads');
    //     if($request->type=='name'){
    //         $countries->where('h_name','LIKE','%'.$query.'%');
    //     }
    //     if($request->type=='sr_head'){
    //         $countries->where('h_ID','LIKE','%'.$query.'%');
    //     }
    //     if($request->type=='type'){
    //         $countries->where('h_type','LIKE','%'.$query.'%');
    //     }
    //     if($request->type=='balance'){
    //         $countries->where('h_balance','LIKE','%'.$query.'%');
    //     }
    //        $countries=$countries->get();        
    //     $data=array();
    //     foreach ($countries as $country) {
    //             $data[]=array('h_name'=>$country->h_name,'h_ID'=>$country->h_ID ,'h_type'=>$country->h_type,'h_balance'=>$country->h_balance);
    //     }
        
    //     if(count($data))
    //          return $data;      
    //     else
    //         return ['h_name'=>'','h_ID'=>'','h_type'=>'','h_balance'=>''];
    // }
    public function searchHead(Request $request) 
    {
        $query = $request->get('term', '');
        $countries = \DB::table('heads');
    
        // Apply filtering based on the 'type' provided in the request
        if ($request->type == 'sr_head') {
            $countries->where('h_name', 'LIKE', '%' . $query . '%');
        }
    
        $countries = $countries->get();  // Fetch results
        
        // Prepare data to return
        $data = [];
        foreach ($countries as $country) {
            $data[] = [
                'h_name' => $country->h_name, 
                'h_ID' => $country->h_ID, 
                'h_type' => $country->h_type, 
                'h_balance' => $country->h_balance
            ];
        }
    
        // Return the response as JSON
        return response()->json($data);
    }
     
    
    public function searchReciept(Request $request)
    {
        if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('salereciepts')
                 ->orderBy('sir_no', 'desc')
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
                ++$row->sir_no;
               }
              }
              else
              {
               $output = 'SIR-00000
               ';
              }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }
}
