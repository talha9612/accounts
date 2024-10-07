<!-- create.blade.php -->
@extends('master')
@section('content')

 <?php 
  if(isset(Auth::user()->customeradd) && Auth::user()->customeradd == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Customer)</small>
          </h3>
          <br>
          <form method="post" action="{{url('directfarmers')}}">
             <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
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
                        <div class="form-group" style="width: 33%">
                          <label for="name" class="bmd-label-floating text-primary">Company Name</label>
                          <input type="text voucher_txt" class="form-control" id="name" required name="fr_name" style="width: 95%">
                        </div>

                         <div class="form-group" style="width: 33%">  
                          <label for="city" class="bmd-label-floating text-primary">City</label>
                          <input type="text" class="form-control" id="city" required name="fr_city" style="width: 95%">
                        </div>

                        <div class="form-group" style="width: 33%">
                          <label for="sowodo" class="bmd-label-floating text-primary">Contact Person</label>
                          <input type="text" class="form-control" id="sowodo" required name="fr_fname" style="width: 95%">
                        </div>
                      </div> 

                      <div class="form-group">
                        <label for="address" class="bmd-label-floating text-primary">Address</label>
                        <textarea class="form-control" id="address" rows="1" id="address" required name="fr_address"></textarea>
                      </div>

                      <div class="form-inline">
                        <div class="form-group" style="width: 33%">
                          <label for="fr_cnic" class="bmd-label-floating text-primary">NTN #</label>
                          <!-- <input type="number" class="form-control" id="cnic" required name="fr_cnic"> -->
                          <input type="text" class="form-control" id="fr_cnic" name="fr_cnic"  required style="width: 95%">
                        </div>
                        
                        <div class="form-group" style="width: 33%">
                          <label for="fr_cnic" class="bmd-label-floating text-primary">GST #</label>
                          <!-- <input type="number" class="form-control" id="cnic" required name="fr_cnic"> -->
                          <input type="text" class="form-control" id="fr_gst" name="fr_gst"  required style="width: 95%">
                        </div>
                         <div class="form-group" style="width: 33%">
                            <label for="phone" class="bmd-label-floating text-primary">Phone #</label>
                            <input type="number" class="form-control" id="phone" required name="fr_phone" style="width: 95%">
                          </div> 
                      </div>

                      <div class="form-inline">
                         <div class="form-group" style="width: 50%">
                          <label for="amount" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input type="number" class="form-control" id="fr_opbalance" required name="fr_opbalance" style="width: 90%">
                        </div>
                        <div class="form-group" style="width: 50%">
                          <label for="amount" class="text-primary">Due Date</label>
                          <input type="date" class="form-control" id="fr_duedate" required name="fr_duedate" style="width: 90%">
                        </div>
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
<script type="text/javascript">
var crntdate = document.getElementById("crntdate").value;
var compdate = document.getElementById("compdate").value;

if(Date.parse(crntdate) > Date.parse(compdate))
{
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("fsclyear").value = (n)+'-'+(n+1);
} 
else{
    var d = new Date();
    var n = d.getFullYear();
    document.getElementById("fsclyear").value = (n-1)+'-'+(n);
}
</script>       
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?> 