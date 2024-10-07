<!-- create.blade.php -->
@extends('master')
@section('content')
<?php 
  if(isset(Auth::user()->cashaccountsadd) && Auth::user()->cashaccountsadd == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Cash Account)</small>
          </h3>
          <br>
          <form method="post" action="{{url('cashinhands')}}">
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
                     <i class="material-icons text-warning">account_circle</i>Cash in Hand
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                   
                
                        <div class="form-group">
                          <label for="cih_title" class="bmd-label-floating text-primary">Title</label>
                          <input type="text" class="form-control" id="cih_title" required name="cih_title">
                        </div>
                        <div class="form-group" hidden>
                          <label for="cih_balance" class="bmd-label-floating text-primary">Balance</label>
                          <input type="text" class="form-control" id="cih_balance" required name="cih_balance">
                        </div>
                        <div class="form-group">
                          <label for="cih_obalance" class="bmd-label-floating text-primary">Opening Balance(Initial)</label>
                          <input type="text" class="form-control" id="cih_obalance" required name="cih_obalance" onchange="myChangeFunction(this)">
                        </div>
                
                     </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
               <a href="{{action('CashinhandController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
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

 <script type="text/javascript">
  function myChangeFunction(input1) {
    var input2 = document.getElementById('cih_balance');
    input2.value = input1.value;
  }
</script>      
               
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
  <?php  } else {  redirect()->to('home')->send(); } ?>     