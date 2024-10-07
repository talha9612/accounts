<!-- edit.blade.php -->
@extends('master')
@section('content')

<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Farmer)</small>
          </h3>
          <br>
      <form method="post" action="{{action('GuaranterController@update', $guaranter['gr_ID'])}}">
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
                          <input type="text" class="form-control" id="name" required name="gr_name" value="{{$guaranter->gr_name}}">
                          <input type="hidden" class="form-control" id="id" required name="gr_ID" value="{{$guaranter->gr_ID}}">
                        </div>
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">SO/Wo/Do</label>
                          <input type="text" class="form-control" id="sowodo" required name="gr_fname" value="{{$guaranter->gr_fname}}">
                        </div>
                      </div> 
                        <div class="form-group">
                          <label for="gender" class="bmd-label-floating text-primary">Gender</label>
                          <select class="form-control" type="select" id="gender" required name="gr_gender">
                             <option value="{{$guaranter->gr_gender}}">{{$guaranter->gr_gender}}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                      <div class="form-group">
                          <label for="cnic" class="bmd-label-floating text-primary">CNIC</label>
                          <input type="number" class="form-control" id="cnic" required name="gr_cnic" value="{{$guaranter->gr_cnic}}" readonly>
                        </div>
                       <div class="form-group">
                          <label for="phone" class="bmd-label-floating text-primary">Phone</label>
                          <input type="number" class="form-control" id="phone" required name="gr_phone" value="{{$guaranter->gr_phone}}">
                        </div> 
                      <div class="form-group">
                        <label for="address" class="bmd-label-floating text-primary">Address</label>
                        <textarea class="form-control" id="address" rows="2" required name="gr_address">
                          {{$guaranter->gr_address}}
                        </textarea>
                      </div>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
              <a href="{{action('GuaranterController@index')}}" class="btn btn-warning btn-raised">Cancel </a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
       <!-- WORK AREA END -->     
 @endsection  

 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 