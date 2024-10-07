<?php

namespace App\Http\Controllers;
use App\Farmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $farmers = \DB::select('SELECT * FROM farmers WHERE tr_name != "0"');
        return view('farmers.index', ['farmers' => $farmers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('farmers.create');
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
        $frgender = $request->input('fr_gender');
        $fraddress = $request->input('fr_address');
        $frcnic = $request->input('fr_cnic');
        $frphone = $request->input('fr_phone');
        $frcity = $request->input('fr_city');
        $trname = $request->input('tr_name');
        $trcnic = $request->input('tr_cnic');
        $trid = $request->input('tr_ID');
        $grnamea = $request->input('gr_name_a');
        $grcnica = $request->input('gr_cnic_a');
        $grida = $request->input('gr_ID_a');
        $grnameb = $request->input('gr_name_b');
        $grcnicb = $request->input('gr_cnic_b');
        $gridb = $request->input('gr_ID_b');
        $frquota = $request->input('fr_quota');
        $frquotavalidtill = $request->input('fr_quota_validtill');
        $frquotavalidfrom = $request->input('fr_quota_validfrom');
        $farmers = array();
        $farmer = array(
                'updated_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'created_at'=> \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d'),
                'fr_quota_validfrom' => \Carbon\Carbon::parse($frquotavalidfrom)->format('Y-m-d'),
                'fr_quota_validtill' => \Carbon\Carbon::parse($frquotavalidtill)->format('Y-m-d'),
                'fr_balance' => $frquota,
                'fr_quota' => $frquota,
                'gr_ID_b' => $gridb,
                'gr_cnic_b' => $grcnicb,
                'gr_name_b' => $grnameb,
                'gr_ID_a' => $grida,
                'gr_cnic_a' => $grcnica,
                'gr_name_a' => $grnamea,
                'tr_ID' => $trid,
                'tr_cnic' => $trcnic,
                'tr_name' => $trname,
                'fr_address' => $fraddress,
                'fr_gender' => $frgender,
                'fr_city' => $frcity,
                'fr_phone' => $frphone,
                'fr_cnic' => $frcnic,
                'fr_fname' => $frfname,
                'fr_name' => $frname
            );

            $farmers[] = $farmer;

            if($grcnica == $grcnicb)
            {
             return back()->with('warning', 'Two Same guaranters cannot be added');   
            }
            elseif (Farmer::where('fr_cnic', '=', $request->input('fr_cnic'))->exists()) 
            {
              return back()->with('warning', 'CNIC already exists, Please Enter a Valid CNIC');
            }
            elseif (Farmer::where('gr_cnic_a', '=', $grcnica)->exists() || Farmer::where('gr_cnic_a', '=', $grcnicb)->exists()) {
              return back()->with('warning', 'One or both of guaranters are associated with an already registered farmer, please enter another one');
            }
            elseif (Farmer::where('gr_cnic_b', '=', $grcnica)->exists() || Farmer::where('gr_cnic_b', '=', $grcnicb)->exists()){
              return back()->with('warning', 'One or both of guaranters are associated with an already registered farmer, please enter another one');
            }
            else
            {
            Farmer::insert($farmers);
            return back()->with('success', 'Farmer has been added');
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
         $farmer = Farmer::find($id);
        return view('farmers.edit',compact('farmer','fr_ID'));
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
         \DB::update('UPDATE farmers SET fr_name = ?, fr_fname = ?, fr_gender = ?, fr_address = ?, fr_cnic = ?, fr_phone = ?, fr_city = ?, tr_name = ?, tr_cnic = ?, tr_ID = ?, gr_name_a = ?, gr_cnic_a = ?, gr_ID_a = ?, gr_name_b = ?, gr_cnic_b = ?, gr_ID_b = ?, updated_at = ?  WHERE fr_ID = ?', [$request->input('fr_name'), $request->input('fr_fname'), $request->input('fr_gender'), $request->input('fr_address'), $request->input('fr_cnic'), $request->input('fr_phone'), $request->input('fr_city'), $request->input('tr_name'), $request->input('tr_cnic'), $request->input('tr_ID'), $request->input('gr_name_a'), $request->input('gr_cnic_a'), $request->input('gr_ID_a'), $request->input('gr_name_b'), $request->input('gr_cnic_b'), $request->input('gr_ID_b'), \Carbon\Carbon::parse(now()->setTimezone('Asia/Karachi'))->format('Y-m-d') ,$request->input('fr_ID')]);

        return redirect('farmers')->with('success','Farmer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $farmer = Farmer::find($id);
        $farmer->delete();
        return redirect('farmers')->with('success','Farmers has been  Deleted!');
    }

    public function searchGuaranter(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('guaranters');
        if($request->type=='gr_name'){
            $countries->where('gr_name','LIKE','%'.$query.'%');
        }
        if($request->type=='gr_cnic'){
            $countries->where('gr_cnic','LIKE','%'.$query.'%');
        }
        if($request->type=='gr_ID'){
            $countries->where('gr_ID','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('gr_name'=>$country->gr_name,'gr_cnic'=>$country->gr_cnic,'gr_ID'=>$country->gr_ID);
        }
        if(count($data))
             return $data;
        else
            return ['gr_name'=>'','gr_cnic'=>'','gr_ID'=>''];
    }

        function searchFrbalance(Request $request)
    {
        if($request->ajax())
             {
              $output = '';
              $query = $request->get('query');
              if($query != '')
              {
               $data = \DB::table('farmers')
                 ->orderBy('fr_ID', 'ASC')
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

                    $res = $row->fr_quota - $row->fr_balance;
                    $subtotal =  number_format($res, 2, '.', ',');
                    $output .=
                    '
                    <tr>
                     <td><a style="text-decoration: none" data-toggle="collapse" href="#'.$row->fr_ID.'" aria-expanded="false" aria-controls='.$row->fr_ID.'
                      title="Details">
                        '.$row->fr_ID.'
                        <i class="material-icons">more_vert</i>
                        </a>
                    </td>
                    <td>'.$row->fr_name.'</td>
                    <td><input type="text" class="form-control" readonly value="'.$subtotal.'"/>
                        <input type="hidden" class="form-control" readonly name="overdue[]" value="'.$res.'"/>
                    </td>
                    <td>'.$row->fr_address.'</td>
                    </tr>
                    <tr>
                    <td colspan="4">
                    <div class="collapse bg-dark text-white" id='.$row->fr_ID.'>
                        <b>NTN #:</b>'.$row->fr_cnic.' <br>
                        <b>Valid Till:</b>'.$row->fr_quota_validtill.' <br> 
                        </div>
                    </td>
                    </tr>
                    ';
                   }
              }
              else
                  {
                   $output = '
                   <tr>
                    <td align="center" colspan="5">No Data Found</td>
                   </tr>
                   ';
                  }
              $data = array(
               'table_data'  => $output
              );

              echo json_encode($data);
             }
    }
}
