<!-- edit.blade.php -->
@extends('master')
@section('content')
<?php 
  if(isset(Auth::user()->companyedit) && Auth::user()->companyedit == '1')
      { ?>
<!-- WORK AREA START -->

           <h3 align="center" class="text-primary">
            Edit Company
          </h3>
          <br>
           <?php foreach ($farmers as $farmer):?>
      <form method="post" action="{{action('CompanyController@update', $farmer->c_ID)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i> Company Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                      <div class="form-inline">
                        <div class="form-group" style="width: 50%">
                          <label for="name" class="bmd-label-floating text-primary">Company Name</label>
                          <input type="text" class="form-control" id="name" required name="c_name" value="<?php echo $farmer->c_name; ?>" style="width: 90%">
                           <input type="hidden" class="form-control" id="id" required name="c_ID" value="<?php echo $farmer->c_ID; ?>">
                        </div>

                         <div class="form-group" style="width: 50%">
                          <label for="city" class="bmd-label-floating text-primary">Type</label>
                          <input type="text" class="form-control" id="city" required name="c_type"  value="<?php echo $farmer->c_type; ?>" style="width: 90%">
                        </div>
                      </div>   

                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">Adress</label>
                          <input type="text" class="form-control" id="sowodo" required name="c_adress" value="<?php echo $farmer->c_adress; ?>">
                        </div>

                    <div class="form-inline">                                     
                      <div class="form-group" style="width: 50%">
                          <label for="city" class="bmd-label-floating text-primary">Area</label>
                          <input type="text" class="form-control" id="city" required name="c_area"  value="<?php echo $farmer->c_area; ?>" style="width: 90%">
                        </div>
                      <div class="form-group" style="width: 50%">
                          <label for="city" class="bmd-label-floating text-primary">City</label>
                          <input type="text" class="form-control" id="city" required name="c_city"  value="<?php echo $farmer->c_city; ?>" style="width: 90%">
                        </div>
                      </div> 
                     </div>
                   </div>
                 </div>
               </div>
@endforeach

              </div>
                <br>
                <div align="center" >
              <a href="{{action('CompanyController@index')}}" class="btn btn-warning btn-raised">Cancel </a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
       <!-- WORK AREA END -->   

 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>