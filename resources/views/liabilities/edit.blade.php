<!-- edit.blade.php -->
@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->liabilitiesedit) && Auth::user()->liabilitiesedit == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Liability)</small>
          </h3>
          <br>
      <form method="post" action="{{action('LiabilitiesController@update', $liabilities['h_ID'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Liability Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="name" required name="lb_name" value="{{$liabilities->h_name}}">
                        </div>
                         <div class="form-group">
                          <label for="lb_opbalance" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input type="number" class="form-control" id="lb_opbalance" required name="lb_opbalance" value="{{$liabilities->h_opbalance}}">
                        </div>
                         <div class="form-group">
                          <label for="stype" class="text-primary">Type</label>
                          <select class="form-control" type="select" id="stype" required name="lb_type">
                            <option value="{{$liabilities->h_stype}}">{{$liabilities->h_stype}}</option>
                             <?php foreach ($list as $list):?>
                            <option value="<?php echo $list->tp_name; ?>"><?php echo $list->tp_name; ?></option>
                             @endforeach
                          </select>
                        </div>
                   </div>
                 </div>
                </div>
              </div>
                <br>
                <div align="center" >
                <a href="{{action('LiabilitiesController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>

       <!-- WORK AREA END -->  
</script>    
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>   