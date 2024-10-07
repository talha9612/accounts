<!-- edit.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->incomeedit) && Auth::user()->incomeedit == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Income)</small>
          </h3>
          <br>
      <form method="post" action="{{action('IncomeController@update', $expense['h_ID'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Income
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                   
                    
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="name" required name="ex_name" value="{{$expense->h_name}}">
                        </div>
                    <div class="form-group">
                          <label for="type" class="text-primary">Type</label>
                          <select class="form-control" type="select" id="type" required name="ex_type">
                            <option>{{$expense->h_stype}}</option>
                             <?php foreach ($types as $type):?>
                            <option value="<?php echo $type->tp_name; ?>"><?php echo $type->tp_name; ?></option>
                             @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input type="text" class="form-control" id="name" required name="ex_opbalance" value="{{$expense->h_opbalance}}">
                        </div>
                   
                   </div>
                 </div>
               </div>
              </div>
            </div>
                <br>
                <div align="center" >
                <a href="{{action('IncomeController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>

       <!-- WORK AREA END --> 
    
 @endsection 
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>  
 <?php  } else {  redirect()->to('home')->send(); } ?>  