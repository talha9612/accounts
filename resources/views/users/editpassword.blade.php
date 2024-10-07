<!-- edit.blade.php -->
@extends('master')
@section('content')
<?php if(isset(Auth::user()->role) && Auth::user()->role == 'Admin') {  ?>
<!-- WORK AREA START -->

    <h3 align="center" class="text-primary">Edit Password <small class="text-muted">(User)</small></h3>
          <br>
      <form method="post" action="{{action('UserController@update', $user['id'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Password Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                        
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">New Password</label>
                          <input type="password" class="form-control" id="password" required name="password" >
                        </div>

                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">Confirm Password</label>
                          <input type="password" class="form-control" id="confirm_password" required name="confirm_password" >
                        </div>
                        <input type="hidden" class="form-control" id="id" required name="id" value="{{$user['id']}}" >

                      </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
              <a href="{{action('UserController@index')}}" class="btn btn-warning btn-raised">Cancel </a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
       <!-- WORK AREA END -->          
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>  