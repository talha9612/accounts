<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obalances;
use App\Farmer;

class DirectfarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $farmers = \DB::select('SELECT * FROM farmers');
        return view('directfarmers.index', ['farmers' => $farmers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('directfarmers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $frname = $request->input('fr_name');
        $frfname = $request->input('fr_fname');
        $frgst = $request->input('fr_gst');
        $fraddress = $request->input('fr_address');
        $frcnic = $request->input('fr_cnic');
        $frphone = $request->input('fr_phone');
        $frcity = $request->input('fr_city');
        $fropbalance = $request->input('fr_opbalance');
        $frduedate = $request->input('fr_duedate');
        $farmers = array();
        $farmer = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'fr_duedate' => \Carbon\Carbon::parse($frduedate)->format('Y-m-d'),
                'fr_opbalance' => $fropbalance,
                'fr_balance' => $fropbalance,
                'fr_city' => $frcity,
                'fr_phone' => $frphone,
                'fr_cnic' => $frcnic,
                'fr_address' => $fraddress,
                'fr_gst' => $frgst,
                'fr_fname' => $frfname,
                'fr_name' => $frname
            );

            $farmers[] = $farmer;

            if (Farmer::where('fr_cnic', '=', $request->input('fr_cnic'))->exists()) 
            {
                return back()->with('warning', 'NTN # already exists, Please Enter a Valid NTN');
            }
            elseif (Farmer::where('fr_gst', '=', $request->input('fr_gst'))->exists()) 
            {
                return back()->with('warning', 'GST # already exists, Please Enter a Valid GST');
            }
            else
            {
                Farmer::insert($farmers);

                 $id = \DB::getPdo()->lastInsertId();

                $frname = $request->input('fr_name');
                $fropbalance = $request->input('fr_opbalance');
                $fsclyear = $request->input('fsclyear');
                
                $balances = array();
                $balance = array(
                    'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                    'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                    'ob_fyear' => $fsclyear,
                    'ob_amount' => $fropbalance,
                    'sub_name' => $frname,
                    'sub_ID' => $id
                    );

                    $balances[] = $balance;

                Obalances::insert($balances);
                return redirect('directfarmers')->with('success','Customer has been Added!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales = \DB::select('SELECT * FROM sales');
        $fpayments = \DB::select('SELECT * FROM fpayments');
        return view('directfarmers.show', ['sales' => $sales], ['fpayments' => $fpayments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $farmer = Farmer::find($id);
        return view('directfarmers.edit',compact('farmer','fr_ID'));
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
        $fnl = \DB::table('fnlyear')->first();


        $frduedate = $request->input('fr_duedate');
        \DB::update('UPDATE farmers SET fr_name = ?, fr_fname = ?, fr_address = ?, fr_cnic = ?, fr_gst = ?, fr_phone = ?, fr_city = ?, fr_balance = ?, fr_opbalance = ?, fr_duedate = ?, updated_at = ?  WHERE fr_ID = ?', [$request->input('fr_name'), $request->input('fr_fname'), $request->input('fr_address'), $request->input('fr_cnic'), $request->input('fr_gst'), $request->input('fr_phone'), $request->input('fr_city'), $request->input('fr_balance'), $request->input('fr_opbalance'), \Carbon\Carbon::parse($frduedate)->format('Y-m-d'), \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d') ,$request->input('fr_ID')]);

        \DB::update('UPDATE obalances SET sub_name = ?, ob_amount = ? WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$request->input('fr_name'), $request->input('fr_opbalance'), $request->input('fr_ID'), $fnl->fn_name, $request->input('fr_name')]);

        return redirect('directfarmers')->with('success','Customer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $farmer = Farmer::find($id);
        $farmer->delete();

        $titlename = $request->input('asname');

        $fnl = \DB::table('fnlyear')->first();
        \DB::update('DELETE from obalances WHERE sub_ID = ? AND ob_fyear = ? AND sub_name = ?', [$id, $fnl->fn_name, $titlename]); 
        return redirect('directfarmers')->with('success','Customer has been  Deleted!');
    }
}
