<!-- edit.blade.php -->
@extends('master')
@section('content')
<?php 
  if(isset(Auth::user()->cashaccountsedit) && Auth::user()->cashaccountsedit == '1')
      { ?>

<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Cash)</small>
          </h3>
          <br>
      <form method="post" action="{{action('CashinhandController@update', $cashinhands['cih_ID'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Cash
                  </a>
                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                        <div class="form-group">
                          <label for="cih_title" class="bmd-label-floating text-primary">Title</label>
                          <input type="text" class="form-control" id="cih_title" required name="cih_title" value="{{$cashinhands->cih_title}}">
                        </div>
                        <div class="form-group" hidden>
                          <label for="cih_balance" class="bmd-label-floating text-primary">Remaining Balance</label>
                          <input type="text" class="form-control" id="cih_balance" required name="cih_balance" value="{{$cashinhands->cih_balance}}">
                        </div>
                         <div class="form-group">
                          <label for="cih_balance" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input type="text" class="form-control" id="cih_obalance" required name="cih_obalance" value="{{$cashinhands->cih_obalance}}" onchange="myChangeFunction(this)">
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
  function myChangeFunction(input1) {
    var input2 = document.getElementById('cih_balance');
    input2.value = input1.value;
  }
</script>              
 @endsection  
 <?php  } else {  redirect()->to('home')->send(); } ?>     