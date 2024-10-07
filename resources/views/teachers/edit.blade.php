<!-- edit.blade.php -->
@extends('master')
@section('content')

  <div class="container">
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
    </div>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Teacher)</small>
          </h3>
          <br>
      <form method="post" action="{{action('TeacherController@update', $teacher['tr_ID'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Personal Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                   
                      <div class="form-inline">
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="name" required name="tr_name" value="{{$teacher->tr_name}}">
                        </div>
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">SO/Wo/Do</label>
                          <input type="text" class="form-control" id="sowodo" required name="tr_fname" value="{{$teacher->tr_fname}}">
                        </div>
                      </div> 
                        <div class="form-group">
                          <label for="gender" class="bmd-label-floating text-primary">Gender</label>
                          <select class="form-control" type="select" id="gender" required name="tr_gender">
                             <option value="{{$teacher->tr_gender}}">{{$teacher->tr_gender}}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                      <div class="form-group">
                          <label for="cnic" class="bmd-label-floating text-primary">CNIC</label>
                          <input type="number" class="form-control" id="cnic" required name="tr_cnic" value="{{$teacher->tr_cnic}}" readonly>
                        </div>
                       <div class="form-group">
                          <label for="phone" class="bmd-label-floating text-primary">Phone</label>
                          <input type="number" class="form-control" id="phone" required name="tr_phone" value="{{$teacher->tr_phone}}">
                        </div> 
                      <div class="form-group">
                        <label for="address" class="bmd-label-floating text-primary">Address</label>
                        <textarea class="form-control" id="address" required name="tr_address">
                          {{$teacher->tr_address}}
                        </textarea>
                      </div>
                      <div class="form-group">
                          <label for="city" class="bmd-label-floating text-primary">City</label>
                          <input type="text" class="form-control" id="city" required name="tr_city"  value="{{$teacher->tr_city}}">
                        </div>
                     </div>
                   </div>
                 </div>
               </div>
                <div class="card">
                  <div class="card-header bg-primary" id="headingTwo">
                    <h5 class="mb-0">
                      <a class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                         <i class="material-icons text-warning">library_books</i>Account Details
                      </a>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                       <div class="container">
                        <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">Amount</label>
                          <input type="number" class="form-control" id="amount" required name="tr_quota" value="{{$teacher->tr_quota}}">
                          <span class="bmd-help"></span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1" class="text-primary">Valid Till</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" required name="tr_quota_validtill">
                          <span class="bmd-help"></span>
                          <p>{{$teacher->tr_quota_validtill}} </p>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1" class="text-primary">Valid From</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" required name="tr_quota_validfrom">
                          <span class="bmd-help"></span>
                          <p>{{$teacher->tr_quota_validfrom}} </p>
                        </div>
                                                <div class="form-group">
                          <label for="Associatedcity" class="text-primary">Associated City</label>
                           <input type="text" class="form-control" name="assoc_city" value="{{$teacher->assoc_city}}" required>
                      </div>
                        <div class="form-group">
                          <label for="Associatedarea" class="text-primary">Associated Area</label>
                          <input type="text" class="form-control" name="assoc_area" value="{{$teacher->assoc_area}}" required>
                        </div>
                       
                        <div class="form-group" hidden>
                          <label for="AssociatedID" class="text-primary">Area ID</label>
                          <select class="form-control"  id="AssociatedId" required name="assoc_ID" value="{{$teacher->assoc_ID}}">
                            <option value="{{$teacher->assoc_ID}}">{{$teacher->assoc_ID}}</option>
                             <option value="1">1</option>
                          </select>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <br>
                <div align="center" >
                <a href="{{action('TeacherController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>

       <!-- WORK AREA END -->     
 @endsection  
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/>