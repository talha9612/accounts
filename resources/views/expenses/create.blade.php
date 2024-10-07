<!-- create.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->expenseadd) && Auth::user()->expenseadd == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Expense)</small>
          </h3>
          <br>
          <form method="post" action="{{url('expenses')}}">
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
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="name" required name="ex_name">
                        </div>
                    
                    <div class="form-group">
                          <label for="stype" class="text-primary">Sub Type</label>
                          <select class="form-control" type="select" id="stype" required name="ex_stype">
                            <option>Select</option>
                             <?php foreach ($types as $type):?>
                            <option value="<?php echo $type->tp_name; ?>"><?php echo $type->tp_name; ?></option>
                             @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="type" class="bmd-label-floating text-primary">Type</label>
                          <input type="text" class="form-control" id="type" required name="ex_type"  value="Expense" readonly>
                        </div>
                         <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input type="text" class="form-control" id="name" required name="h_opbalance">
                        </div>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
                 <a href="{{action('ExpenseController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
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