<!-- create.blade.php -->
@extends('master')
@section('content')
<?php 
  if(isset(Auth::user()->companyadd) && Auth::user()->companyadd == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Add New Company
          </h3>
          <br>
          <form method="post" action="{{url('companies')}}">
         {{csrf_field()}}
            <div id="accordion" class="col-md-12">
            <div class="card container">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Company Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                      <div class="form-inline">
                        <div class="form-group" style="width: 50%">
                          <label for="name" class="bmd-label-floating text-primary">Company Name</label>
                          <input type="text" class="form-control" id="name" required name="c_name" style="width: 90%">
                        </div>

                         <div class="form-group" style="width: 50%">
                          <label for="phone" class="bmd-label-floating text-primary">Type</label>
                          <input type="text" class="form-control" id="phone" required name="c_type" style="width: 90%">
                        </div> 
                     
                     </div>
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">Address</label>
                          <input type="text" class="form-control" id="sowodo" required name="c_adress">
                        </div>
                    <div class="form-inline">
                       <div class="form-group" style="width: 50%">
                          <label for="phone" class="bmd-label-floating text-primary">Area</label>
                          <input type="text" class="form-control" id="phone" required name="c_area" style="width: 90%">
                        </div> 

                          <div class="form-group" style="width: 50%">
                          <label for="cnic" class="bmd-label-floating text-primary">City</label>
                          <input type="text" class="form-control" id="name" required name="c_city" style="width: 90%">
                        </div>
                    </div>    
                   </div>
                 </div>
               </div>
           
              </div>
                <br>
                <div align="center">
                 <a href="{{action('CompanyController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
            <br>
            <br>
            <br>
            <br>
       <!-- WORK AREA END -->     

 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>