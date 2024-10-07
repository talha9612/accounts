<?php

namespace App\Http\Controllers;
use App\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banks = Bank::all()->toArray();
        return view('banks.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $Bank = $this->validate(request(), [
          'bk_name' => 'required',
          'bk_branch_code' => 'required',
          'bk_address' => 'required',
          'bk_phone' => 'required'
        ]);
        
        Bank::create($Bank);

        return back()->with('success', 'Bank has been added');
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
        $bank = Bank::find($id);
        return view('banks.edit',compact('bank','bk_ID'));
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
        $bank = Bank::find($id);
        $this->validate(request(), [
          'bk_name' => 'required',
          'bk_branch_code' => 'required',
          'bk_phone' => 'required',
          'bk_address' => 'required'
        ]);
        $bank->bk_name = $request->get('bk_name');
        $bank->bk_branch_code = $request->get('bk_branch_code');
        $bank->bk_phone = $request->get('bk_phone');
        $bank->bk_address = $request->get('bk_address');
        $bank->save();
        return redirect('banks')->with('success','Bank has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();
        return redirect('banks')->with('success','Bank has been  Deleted!');
    }
}
