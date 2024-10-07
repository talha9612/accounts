<!-- edit.blade.php -->
@extends('master')
@section('content')

<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Teacher)</small>
          </h3>
          <br>
      <form method="post" action="{{action('BankController@update', $bank['bk_ID'])}}">
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
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="bk_name" required name="bk_name" value="{{$bank->bk_name}}">
                        </div>
                        <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Branch Code</label>
                          <input type="text" class="form-control" id="bk_branch_code" required name="bk_branch_code" value="{{$bank->bk_branch_code}}">
                        </div>
                      </div> 
                       <div class="form-group">
                          <label for="bk_phone" class="bmd-label-floating text-primary">Phone</label>
                          <input type="number" class="form-control" id="bk_phone" required name="bk_phone" value="{{$bank->bk_phone}}">
                        </div> 
                      <div class="form-group">
                        <label for="bk_address" class="bmd-label-floating text-primary">Address</label>
                        <textarea class="form-control" id="bk_address" rows="2" required name="bk_address">
                          {{$bank->bk_address}}
                        </textarea>
                      </div>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
                <a href="{{action('BankController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
       <!-- WORK AREA END -->      
 @endsection 
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>  