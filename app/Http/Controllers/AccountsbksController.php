<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accountsbks;
use App\Obalances;

class AccountsbksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $account = \DB::select('SELECT * FROM accountsbks');
        return view('accountsbks.index', ['account' => $account]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('accountsbks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fsclyear = $request->input('fsclyear');

        $title = $request->input('acc_title');
        $titlenumber = $request->input('acc_number');
        $titletype = $request->input('acc_type');
        $titlebalance = $request->input('acc_balance');
        $titlebranchcode = $request->input('branchcode');
        $titlebankname = $request->input('bankname');

        $vouchers = array();
        $voucher = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'bk_name' => $titlebankname,
                'bk_branch_code' => $titlebranchcode,
                'acc_opbalance' => $titlebalance,
                'acc_balance' => $titlebalance,
                'acc_type' => $titletype,
                'acc_number' => $titlenumber,
                'acc_title' => $title
            );

            $vouchers[] = $voucher;

            Accountsbks::insert($vouchers);

            $balancess = array();

        $balance = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'ob_fyear' => $fsclyear,
                'ob_amount' => $titlebalance,
                'sub_name' => $title,
                'sub_ID' => $titlenumber
            );

            $balances[] = $balance;

            Obalances::insert($balances);
            return back()->with('success', 'Bank Account has been created');
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
        $accounts = Accountsbks::find($id);
        return view('accountsbks.edit',compact('accounts','acc_ID'));
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
        //  $accounts = Accountsbks::find($id);
        // $this->validate(request(), [
        //   'acc_title' => 'required',
        //   'acc_number' => 'required',
        //   'acc_type' => 'required',
        //   'acc_balance' => 'required',
        //   'branchcode' => 'required',
        //   'bankname' => 'required'
        // ]);
        // $accounts->acc_title = $request->get('acc_title');
        // $accounts->acc_number = $request->get('acc_number');
        // $accounts->acc_type = $request->get('acc_type');
        // $accounts->acc_balance = $request->get('acc_balance');
        // $accounts->acc_balance = $request->get('acc_balance');
        // $accounts->bk_branch_code = $request->get('branchcode');
        // $accounts->bk_name = $request->get('bankname');
        // $accounts->updated_at = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('d-M-Y');
        // $accounts->created_at = \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('d-M-Y');
        // $accounts->save();
        $fnl = \DB::table('fnlyear')->first();

        \DB::update('UPDATE accountsbks SET acc_title = ?, acc_number = ?, acc_type = ?, acc_balance = ? , acc_opbalance = ?, bk_branch_code = ?, bk_name = ?, updated_at = ?  WHERE acc_ID = ?', [$request->input('acc_title'), $request->input('acc_number'), $request->input('acc_type'), $request->input('acc_balance'), $request->input('acc_balance'), $request->input('branchcode'), $request->input('bankname'), \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'), $request->input('acc_ID')]);

         \DB::update('UPDATE obalances SET sub_name = ?, ob_amount = ? WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$request->input('acc_title'), $request->input('acc_balance'), $request->input('acc_number'), $fnl->fn_name, $request->input('acc_title')]);

        return redirect('accountsbks')->with('success','Account has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $accounts = Accountsbks::find($id);
        $accounts->delete();

        $titlename = $request->input('asname');
        $titlenumber = $request->input('asnumber');

        $fnl = \DB::table('fnlyear')->first();
        \DB::update('DELETE from obalances WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$titlenumber, $fnl->fn_name, $titlename]);

        return redirect('accountsbks')->with('success','Account has been  Deleted!');
    }

     public function searchBank(Request $request)
     {
        $query = $request->get('term','');
        $countries=\DB::table('banks');
        if($request->type=='accounttitle'){
            $countries->where('bk_name','LIKE','%'.$query.'%');
        }
        if($request->type=='accountbalance'){
            $countries->where('bk_branch_code','LIKE','%'.$query.'%');
        }
        if($request->type=='accountnumber'){
            $countries->where('bk_address','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('bk_name'=>$country->bk_name,'bk_branch_code'=>$country->bk_branch_code,'bk_address'=>$country->bk_address);
        }
        if(count($data))
             return $data;
        else
            return ['bk_name'=>'','bk_branch_code'=>'','bk_address'=>''];
    }
}
