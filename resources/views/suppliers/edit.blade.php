<!-- edit.blade.php -->
@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->suppliersedit) && Auth::user()->suppliersedit == '1')
      { ?>
<!-- WORK AREA START -->

           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Supplier)</small>
          </h3>
          <br>
      <form method="post" action="{{action('SupplierController@update', $supplier['s_ID'])}}">
          <div>
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
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
                   <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary"> Company</label>
                          <input type="text" class="form-control" id="name" required name="s_company" value="{{$supplier->s_company}}">
                           
                        </div>
                      
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary"> Name</label>
                          <input type="text" class="form-control" id="name" required name="s_name" value="{{$supplier->s_name}}">
                           <input type="hidden" class="form-control" id="id" required name="s_ID" value="{{$supplier->s_ID}}">
                        </div>
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">Phone</label>
                          <input type="text" class="form-control" id="sowodo" required name="s_phone" value="{{$supplier->s_phone}}">
                        </div>
                      
                        <div class="form-group">
                          <label for="cnic" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input type="text" class="form-control" id="cnic" required name="s_obalance" value="{{$supplier->s_obalance}}">
                        </div>
                       <div class="form-group">
                          <label for="cnic" class="bmd-label-floating text-primary">Remaining Balance</label>
                          <input type="text" class="form-control" id="cnic" name="s_balance" value="{{$supplier->s_balance}}" required>
                        </div>
                      
                        <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">Due Date</label>
                          <input type="date" class="form-control" id="s_duedate" name="s_duedate" required>
                          <input type="text"  value="{{$supplier->s_duedate}}" readonly>
                        </div>
                      
                     </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
              <a href="{{action('SupplierController@index')}}" class="btn btn-warning btn-raised">Cancel </a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
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