@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->suppliersview) && Auth::user()->suppliersview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Supplier)</small>
          </h3>
          <br>
          <form method="post" action="{{url('suppliers')}}">
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
                     <i class="material-icons text-warning">account_circle</i>Supplier Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                      <div class="form-inline">
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text voucher_txt" class="form-control" id="name" required name="s_name">
                        </div>
                        <div class="form-group">
                          <label for="s_phone" class="bmd-label-floating text-primary">Phone</label>
                          <input type="text" class="form-control" id="phone" required name="s_phone">
                        </div>
                        <div class="form-group">
                          <label for="s_company" class="bmd-label-floating text-primary">Company</label>
                          <input type="text" class="form-control" id="company" required name="s_company">
                        </div>
                        <div class="form-group">
                          <label for="s_obalance" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input type="number" class="form-control" id="s_obalance" required name="s_obalance">
                        </div>
                        <div class="form-group">
                          <label for="s_duedate" class="text-primary">Due Date</label>
                          <input type="date" class="form-control" id="s_duedate" required name="s_duedate">
                        </div>
                      </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
                 <a href="{{action('SupplierController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
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
