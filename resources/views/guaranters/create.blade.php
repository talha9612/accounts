<!-- create.blade.php -->
@extends('master')
@section('content')
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Guaranter)</small>
          </h3>
          <br>
          <form method="post" action="{{url('guaranters')}}">
         {{csrf_field()}}
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Personal Details
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                 <div class="container">
                      <div class="form-inline">
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Name</label>
                          <input type="text voucher_txt" class="form-control" id="name" required name="gr_name">
                        </div>
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">SO/Wo/Do</label>
                          <input type="text" class="form-control" id="sowodo" required name="gr_fname">
                        </div>
                      <div class="form-group">
                          <label for="cnic" class="bmd-label-floating text-primary">CNIC</label>
                          <!-- <input type="number" class="form-control" id="cnic" required name="gr_cnic"> -->
                          <input type="tel" id="gr_cnic" name="gr_cnic" pattern="[0-9]{13}" class="form-control" required>
                        </div>
                       <div class="form-group">
                          <label for="phone" class="bmd-label-floating text-primary">Phone</label>
                          <input type="number" class="form-control" id="phone" required name="gr_phone">
                        </div> 
                    </div>
                    <div class="form-group">
                          <label for="gender" class="bmd-label-floating text-primary">Gender</label>
                          <select class="form-control" type="select" id="gender" required name="gr_gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                      <div class="form-group">
                        <label for="address" class="bmd-label-floating text-primary">Address</label>
                        <textarea class="form-control" id="address" rows="2" id="address" required name="gr_address"></textarea>
                      </div>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
                <br>
                <div align="center" >
                 <a href="{{action('GuaranterController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
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
$(document).on('focus','.guaranter_txt',function(){
  type = $(this).data('type');
  
  if(type =='gr_name' )autoType='gr_name'; 
  if(type =='gr_cnic' )autoType='gr_cnic';
  if(type =='gr_ID' )autoType='gr_ID'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchguaranter') }}",
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
           $('#gr_name_'+elementId).val(data.gr_name);
           $('#gr_cnic_'+elementId).val(data.gr_cnic);
           $('#gr_ID_'+elementId).val(data.gr_ID);
       }
   }); 
});
</script>

<script type="text/javascript">        
//autocomplete script
$(document).on('focus','.teacher_txt',function(){
  type = $(this).data('type');
  
  if(type =='tr_name' )autoType='tr_name'; 
  if(type =='tr_cnic' )autoType='tr_cnic';
  if(type =='tr_ID' )autoType='tr_ID'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchteacher') }}",
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
           $('#tr_name_'+elementId).val(data.tr_name);
           $('#tr_cnic_'+elementId).val(data.tr_cnic);
           $('#tr_ID_'+elementId).val(data.tr_ID);
       }
   }); 
});
</script>

 @endsection
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
