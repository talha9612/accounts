<!-- edit.blade.php -->
@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->subtypesedit) && Auth::user()->subtypesedit == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Sub Types)</small>
          </h3>
          <br>
      <form method="post" action="{{action('ExptypeController@update', $exptype['tp_ID'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Head Types
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                        <div class="form-group" hidden>
                          <label for="name" class="bmd-label-floating text-primary">ID</label>
                          <input type="text" class="form-control" id="name" required name="tp_ID" value="{{$exptype->tp_ID}}">
                        </div>
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Sub Type</label>
                          <input type="text" class="form-control" id="name" required name="tp_name" value="{{$exptype->tp_name}}">
                        </div>
                    <div class="form-group">
                          <label for="type" class="text-primary">Type</label>
                          <select class="form-control" type="select" id="type" name="tp_type">
                            <option value="{{$exptype->tp_type}}">{{$exptype->tp_type}}</option>
                            <option value="Asset">Asset</option>
                            <option value="Liability">Liability</option>
                            <option value="Expense">Expense</option>
                            <option value="Income">Income</option>
                          </select>
                        </div>
                   </div>
                 </div>
               </div>
              </div>
            </div>
                <br>
                <div align="center" >
                <a href="{{action('ExptypeController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>

       <!-- WORK AREA END -->
      
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?> 