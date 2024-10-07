<!-- edit.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->productsedit) && Auth::user()->productsedit == '1')
      { ?>
<!-- WORK AREA START -->

           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Product)</small>
          </h3>
          <br>
      <form method="post" action="{{action('ProductController@update', $product['p_ID'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Product Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                      <div class="form-inline">
                        <div class="form-group" style="width: 33%">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="name" required name="p_name" value="{{$product->p_name}}" style="width: 90%">
                           <input type="hidden" class="form-control" id="id" required name="p_ID" value="{{$product->p_ID}}">
                        </div>
                        <div class="form-group" style="width: 33%">
                          <label for="sowodo" class="bmd-label-floating text-primary">Model</label>
                          <input type="text" class="form-control" id="sowodo" required name="p_size" value="{{$product->p_size}}" style="width: 90%">
                        </div>
                        <div class="form-group" style="width: 33%">
                          <label for="sowodo" class="bmd-label-floating text-primary">Specifications</label>
                          <input type="text" class="form-control" id="sowodo" required name="p_specs" value="{{$product->p_specs}}" style="width: 90%">
                        </div>
                      </div>
                      <div class="form-inline">
                        <div class="form-group" style="width: 50%">
                          <label for="sowodo" class="bmd-label-floating text-primary">Supplier (Company)</label>
                        <input class="form-control supplier_txt" type="text" data-type="suppliercompany" id="suppliercompany_1" name="suppliercompany" required value="{{$product->s_company}}" style="width: 90%" />
                      </div>

                       <div class="form-group" style="width: 50%">
                          <label for="sowodo" class="bmd-label-floating text-primary">Supplier ID</label>
                        <input class="form-control supplier_txt" type="text" data-type="supplierid" id="supplierid_1" name="supplierid" readonly  required  value="{{$product->s_ID}}" style="width: 90%"/>
                      </div>
                      </div> 
                     </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
              <a href="{{action('ProductController@index')}}" class="btn btn-warning btn-raised">Cancel </a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
       <!-- WORK AREA END -->   
<script type="text/javascript">
$(document).on('focus','.supplier_txt',function(){
  type = $(this).data('type');
  
  if(type =='suppliercompany' )autoType='s_company'; 
  if(type =='supplierid' )autoType='s_ID'; 
  if(type =='supplierbalance' )autoType='s_balance'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchjsupplier') }}",
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
           $('#suppliercompany_'+elementId).val(data.s_company);
           $('#supplierid_'+elementId).val(data.s_ID);
           $('#supplierbalance_'+elementId).val(data.s_balance);
       }
   }); 
});  
</script> 
       
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>