<?php

namespace App\Http\Controllers;
use App\Teacher;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all()->toArray();
        return view('teachers.index', compact('teachers'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Teacher::where('tr_cnic', '=', $request->input('tr_cnic'))->exists()) {
              return back()->with('warning', 'CNIC already exists, Please Enter a Valid CNIC');
            }
            else{
         $Teacher = $this->validate(request(), [
          'tr_name' => 'required',
          'tr_fname' => 'required',
          'tr_gender' => 'required',
          'tr_cnic' => 'required',
          'tr_phone' => 'required',
          'tr_address' => 'required',
          'tr_city' => 'required',
          'tr_quota' => 'required',
          'tr_quota_validfrom' => 'required',
          'tr_quota_validtill' => 'required',
          'assoc_city' => 'required',
          'assoc_area' => 'required',
          'assoc_ID' => 'required'

        ]);
        
        Teacher::create($Teacher);

        return back()->with('success', 'Teacher has been added');
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
        $teacher = Teacher::find($id);
        return view('teachers.edit',compact('teacher','tr_ID'));
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
        $teacher = Teacher::find($id);
        $this->validate(request(), [
          'tr_name' => 'required',
          'tr_fname' => 'required',
          'tr_gender' => 'required',
          'tr_cnic' => 'required',
          'tr_phone' => 'required',
          'tr_address' => 'required',
          'tr_city' => 'required',
          'tr_quota' => 'required',
          'tr_quota_validfrom' => 'required',
          'tr_quota_validtill' => 'required',
          'assoc_city' => 'required',
          'assoc_area' => 'required',
          'assoc_ID' => 'required'
        ]);
        $teacher->tr_name = $request->get('tr_name');
        $teacher->tr_fname = $request->get('tr_fname');
        $teacher->tr_gender = $request->get('tr_gender');
        $teacher->tr_cnic = $request->get('tr_cnic');
        $teacher->tr_phone = $request->get('tr_phone');
        $teacher->tr_address = $request->get('tr_address');
        $teacher->tr_city = $request->get('tr_city');
        $teacher->tr_quota = $request->get('tr_quota');
        $teacher->tr_quota_validfrom = $request->get('tr_quota_validfrom');
        $teacher->tr_quota_validtill = $request->get('tr_quota_validtill');
        $teacher->assoc_city = $request->get('assoc_city');
        $teacher->assoc_area = $request->get('assoc_area');
        $teacher->assoc_ID = $request->get('assoc_ID');
        $teacher->save();
        return redirect('teachers')->with('success','Teacher has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        return redirect('teachers')->with('success','Teacher has been  Deleted!');
    }

    public function searchTeacher(Request $request)
    {
        $query = $request->get('term','');
        $countries=\DB::table('teachers');
        if($request->type=='tr_name'){
            $countries->where('tr_name','LIKE','%'.$query.'%');
        }
        if($request->type=='tr_cnic'){
            $countries->where('tr_cnic','LIKE','%'.$query.'%');
        }
        if($request->type=='tr_ID'){
            $countries->where('tr_ID','LIKE','%'.$query.'%');
        }
           $countries=$countries->get();        
        $data=array();
        foreach ($countries as $country) {
                $data[]=array('tr_name'=>$country->tr_name,'tr_cnic'=>$country->tr_cnic,'tr_ID'=>$country->tr_ID);
        }
        if(count($data))
             return $data;
        else
            return ['tr_name'=>'','tr_cnic'=>'','tr_ID'=>''];
    }

}
