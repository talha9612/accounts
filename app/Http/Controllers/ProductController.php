<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = \DB::select('SELECT * FROM products');
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pname = $request->input('p_name');
        $psize = $request->input('p_size');
        $pspecs = $request->input('p_specs');
        $sid = $request->input('supplierid');
        $scompany = $request->input('suppliercompany');
        $farmers = array();
        $farmer = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                's_company' => $scompany,
                's_ID' => $sid,
                'p_specs' => $pspecs,
                'p_size' => $psize,
                'p_name' => $pname
            );

            $farmers[] = $farmer;

            Products::insert($farmers);

        return back()->with('success', 'Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        return view('products.edit',compact('product'));
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
          \DB::update('UPDATE products SET p_name = ?, p_size = ?, p_specs = ?, s_ID = ?, s_company = ?, updated_at = ? WHERE p_ID = ?', [$request->input('p_name'), $request->input('p_size'), $request->input('p_specs'), $request->input('supplierid'), $request->input('suppliercompany'), \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d') ,$request->input('p_ID')]);

        return redirect('products')->with('success','Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete();
        return redirect('products')->with('success','Product has been  Deleted!');
    }

    public function addStock($id)
    {
        $products = \DB::select('SELECT * FROM products WHERE p_ID = ?' , [$id]);
        return view('products.addstock', ['products' => $products]);
    }
}
