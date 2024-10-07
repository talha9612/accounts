<!-- create.blade.php -->
@extends('master')
@section('content')

<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Customer)</small>
          </h3>
          <br>
          <form method="post" action="{{url('directfarmers')}}">
         {{csrf_field()}}
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
                          <label for="name" class="bmd-label-floating text-primary">Company Name</label>
                          <input type="text voucher_txt" class="form-control" id="name" required name="fr_name">
                        </div>
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">Contact Person</label>
                          <input type="text" class="form-control" id="sowodo" required name="fr_fname">
                        </div>
                       
                      <div class="form-group">
                          <label for="fr_cnic" class="bmd-label-floating text-primary">NTN #</label>
                          <!-- <input type="number" class="form-control" id="cnic" required name="fr_cnic"> -->
                          <input type="text" class="form-control" id="fr_cnic" name="fr_cnic"  required>
                        </div>
                        <div class="form-group">
                          <label for="fr_cnic" class="bmd-label-floating text-primary">GST #</label>
                          <!-- <input type="number" class="form-control" id="cnic" required name="fr_cnic"> -->
                          <input type="text" class="form-control" id="fr_gst" name="fr_gst"  required>
                        </div>
                       <div class="form-group">
                          <label for="phone" class="bmd-label-floating text-primary">Phone</label>
                          <input type="number" class="form-control" id="phone" required name="fr_phone">
                        </div> 
                          <div class="form-group">
                          <label for="city" class="bmd-label-floating text-primary">City</label>
                          <input type="text" class="form-control" id="city" required name="fr_city">
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="address" class="bmd-label-floating text-primary">Address</label>
                        <textarea class="form-control" id="address" rows="2" id="address" required name="fr_address"></textarea>
                      </div>
                        <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input type="number" class="form-control" id="fr_opbalance" required name="fr_opbalance">
                        </div>
                        <div class="form-group">
                          <label for="amount" class="text-primary">Due Date</label>
                          <input type="date" class="form-control" id="fr_duedate" required name="fr_duedate">
                        </div>

                     </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center">
                 <a href="{{action('DirectfarmerController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
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