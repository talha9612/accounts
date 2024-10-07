<!-- edit.blade.php -->
@extends('master')
<?php 
  if(isset(Auth::user()->cpersonedit) && Auth::user()->cpersonedit == '1')
      { ?>
@section('content')
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Contact Person
          </h3>
          <br>
           <?php foreach ($farmers as $farmer):?>
      <form method="post" action="{{action('CpersonController@update', $farmer->cp_ID)}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i> Edit Contact Person Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                   </div>
                   </div>
                    </div>
                 <div class="container">
                      <div class="form-inline">
                        <div class="form-group" style="width: 50%">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control" id="name" required name="cp_name" value="<?php echo $farmer->cp_name; ?>" style="width: 90%">
                           <input type="hidden" class="form-control" id="id" required name="cp_ID" value="<?php echo $farmer->cp_ID; ?>">
                        </div>
                        <div class="form-group" style="width: 50%">
                          <label for="sowodo" class="bmd-label-floating text-primary">Designation</label>
                          <input type="text" class="form-control" id="sowodo" required name="cp_designation" value="<?php echo $farmer->cp_designation; ?>" style="width: 90%">
                        </div>
                      </div>      
                        <div class="form-group">
                          <label for="name" class="text-primary">Company Name</label>
                          <input type="text" class="form-control autocomplete_txt" id="countryname_1" data-type="countryname" required name="countryname" placeholder="<?php echo $farmer->c_name; ?>" >
                        </div>

                        <div class="form-group">
                          <label for="name" class=" text-primary">Company ID</label>
                          <input type="text" class="form-control autocomplete_txt" id="country_code_1" data-type="country_code" required name="country_code" placeholder=" <?php echo $farmer->c_ID; ?> ">
                         </div>
                      <div class="form-inline">                                 
                      <div class="form-group" style="width: 33%">
                          <label for="city" class="bmd-label-floating text-primary">Cell#</label>
                          <input type="text" class="form-control" id="city" required name="cp_cell"  value="<?php echo $farmer->cp_cell; ?>" style="width: 95%">
                        </div>
                      <div class="form-group" style="width: 33%">
                          <label for="city" class="bmd-label-floating text-primary">Tel #</label>
                          <input type="text" class="form-control" id="city" required name="cp_tel"  value="<?php echo $farmer->cp_tel; ?>" style="width: 95%">
                        </div>
                         <div class="form-group" style="width: 33%">
                          <label for="city" class="bmd-label-floating text-primary">Ext</label>
                          <input type="text" class="form-control" id="city" required name="cp_ext"  value="<?php echo $farmer->cp_ext; ?>" style="width: 95%">
                        </div>
                       </div> 
                        <div class="form-group">
                          <label for="city" class="bmd-label-floating text-primary">Email</label>
                          <input type="text" class="form-control" id="city" required name="cp_email"  value="<?php echo $farmer->cp_email; ?>">
                        </div>
                     </div>
               </div>
@endforeach
                <br>
                <div align="center" >
              <a href="{{action('CpersonController@index')}}" class="btn btn-warning btn-raised">Cancel </a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
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