<!-- create.blade.php -->
@extends('master')
<?php 
  if(isset(Auth::user()->cpersonadd) && Auth::user()->cpersonadd == '1')
      { ?>
@section('content')
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Add New Contact Person
          </h3>
          <br>
          <form method="post" action="{{url('cpersons')}}">
         {{csrf_field()}}
            <div id="accordion" class="col-md-12">
            <div class="card container">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Contact Person Details
                  </a>
                </h5>
              </div>
              </div>
                 <div class="container">
                      <div class="form-inline">
                        <div class="form-group"  style="width: 50%">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="name" required name="cp_name"  style="width: 90%">
                        </div>
                        <div class="form-group"  style="width: 50%">
                          <label for="sowodo" class="bmd-label-floating text-primary">Designation</label>
                          <input type="text" class="form-control" id="sowodo" required name="cp_designation"  style="width: 90%">
                        </div>
                     </div>
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Company Name</label>
                          <input type="text" class="form-control autocomplete_txt" id="countryname_1" data-type="countryname" required name="countryname" >
                        </div>
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Company ID</label>
                          <input type="text" class="form-control autocomplete_txt" id="country_code_1" data-type="country_code" required name="country_code" readonly>
                        </div>
                        <div class="form-inline"> 
                        <div class="form-group" style="width: 33%">
                          <label for="phone" class="bmd-label-floating text-primary">Cell#</label>
                          <input type="text" class="form-control" id="phone" required name="cp_cell" style="width: 90%">
                        </div> 
                        <div class="form-group" style="width: 33%">
                          <label for="phone" class="bmd-label-floating text-primary">Tel #</label>
                          <input type="text" class="form-control" id="phone" required name="cp_tel" style="width: 90%">
                        </div> 
                        <div class="form-group" style="width: 33%">
                          <label for="phone" class="bmd-label-floating text-primary">Ext</label>
                          <input type="number" class="form-control" id="phone" required name="cp_ext" style="width: 90%">
                        </div> 
                        </div>
                        <div class="form-group">
                          <label for="cnic" class="bmd-label-floating text-primary">Email</label>
                          <input type="email" class="form-control" id="name" required name="cp_email">
                        </div>
                      </div>   
                <br>
                <div align="center">
                 <a href="{{action('CpersonController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
            <br>
            <br>
            <br>
            <br>
       <!-- WORK AREA END -->     
<script type="text/javascript"> 
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');
  
  if(type =='countryname' )autoType='c_name'; 
  if(type =='country_code' )autoType='c_ID'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchcompany') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    type : type,
                },
                success: function(data) {
                    var array = $.map(data, function (item) {
                       return {
                           label: item[autoType],
                           value: item[autoType],
                           data : item
                       }
                   });
                    response(array)
                }
            });
       },
       select: function( event, ui ) {
           var data = ui.item.data;           
           id_arr = $(this).attr('id');
           id = id_arr.split("_");
           elementId = id[id.length-1];
           $('#countryname_'+elementId).val(data.c_name);
           $('#country_code_'+elementId).val(data.c_ID);
       }
   }); 
});
</script>
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>