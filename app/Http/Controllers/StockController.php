<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Sales;
use App\Stocks;
use App\Salesprices;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    public function index()
    {
        $orders = \DB::select('SELECT * from stocks WHERE ss_quantity <> "0"');
        return view('stocks.index', ['orders' => $orders]);
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
        \DB::select('TRUNCATE TABLE salesprices');
       
        $set = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d');
        $id = $request->input('id');
        $make = $request->input('make');
        $item = $request->input('item');
        $model = $request->input('model');
        $quantity = $request->input('quantity');
        $lot = $request->input('lot');
        $cp = $request->input('cp');
        $salesprice = $request->input('salesprice');
        $cce = $request->input('cce');
        $ep = $request->input('ep');
        $newsalesprice = $request->input('newsalesprice');

        $cceall = $request->input('cceall');

        for($i = 0; $i < count($newsalesprice); $i++){
            $stock = array(
                'updated_at'=> $set,
                'created_at'=> $set,
                'slp_newsalesprice' => $newsalesprice[$i],
                'slp_ep' => $ep[$i],
                'slp_cce' => $cce[$i],
                'slp_cceall' => $cceall,
                'slp_sp' => $salesprice[$i],
                'slp_cp' => $cp[$i],
                'slp_lot' => $lot[$i],
                'slp_quantity' => $quantity[$i],
                'slp_model' => $model[$i],
                'slp_item' => $item[$i],
                'slp_make' => $make[$i],
                'slp_ID' => $id[$i]
            );

            $stocks[] = $stock;
            \DB::update('UPDATE stocks SET ss_saleprice = ? WHERE ss_ID = ?', [$salesprice[$i], $id[$i]]);
        }
        Salesprices::insert($stocks);
        return back()->with('success', 'Sale Prices are Updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales = \DB::select("SELECT * FROM sales WHERE sl_i_ID = ?", [$id]);
        $purchase = \DB::select("SELECT * FROM stocks WHERE ss_ID = ?", [$id]);
        $return = \DB::select("SELECT * FROM salereturns WHERE slr_i_ID = ?", [$id]);
        $service = \DB::select("SELECT * FROM svinvoices WHERE svi_i_ID = ?", [$id]);
        return view('stocks.show',['sales'=>$sales], ['purchase'=>$purchase, 'return'=>$return, 'service'=>$service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Stocks::find($id);
        return view('stocks.edit',compact('product','ss_ID'));
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
        \DB::update('UPDATE stocks SET ss_number = ?, ss_name = ?, ss_title = ?, ss_area = ? , s_name = ?, s_ID = ?, s_company = ?, ss_supplier = ?, ss_item = ?,  ss_size = ?, ss_specs = ?, ss_description = ?, ss_quantity = ?, ss_unitprice = ?, lot_number = ?, ss_costunit = ?, ss_saleprice = ?, updated_at = ?  WHERE ss_ID = ?', [$request->input('ss_number'), $request->input('ss_name'), $request->input('ss_title'), '-', $request->input('s_name'), $request->input('s_ID'), $request->input('s_company'), $request->input('ss_supplier'), $request->input('ss_item'), $request->input('ss_size'), $request->input('ss_specs'), $request->input('ss_description'), $request->input('ss_quantity'), $request->input('ss_unitprice'),$request->input('lot_number'), $request->input('ss_costunit'),'0', \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d') ,$request->input('ss_i_ID')]);

        return redirect('stocks')->with('success','Stock has been updated');
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
    public function printSt()
    {
        $pass = \DB::select('SELECT * FROM stocks');
        $pdf = PDF::loadView('PDF.pdfstock', ['pass' => $pass]);
        return $pdf->stream('STOCK REPORT.pdf');
        // return view('scvaluations.show', ['pass' => $pass], ['details' => $details]);
    }

    public function salesprice()
    {
        $orders = \DB::select('SELECT * from stocks WHERE ss_quantity > 0');
        return view('stocks.salesprice', ['orders' => $orders]);
    }

    public function viewsalesprice()
    {
        $orders = \DB::select('SELECT * from salesprices');
        return view('stocks.viewsalesprice', ['orders' => $orders]);
    }
}
