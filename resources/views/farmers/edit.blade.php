<!-- edit.blade.php -->
@extends('master')
@section('content')

<!-- WORK AREA START -->

           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Customer)</small>
          </h3>
          <br>
      <form method="post" action="{{action('FarmerController@update', $farmer['fr_ID'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
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
                          <input type="text" class="form-control" id="name" required name="fr_name" value="{{$farmer->fr_name}}">
                           <input type="hidden" class="form-control" id="id" required name="fr_ID" value="{{$farmer->fr_ID}}">
                        </div>
                        <div class="form-group">
                          <label for="sowodo" class="bmd-label-floating text-primary">SO/Wo/Do</label>
                          <input type="text" class="form-control" id="sowodo" required name="fr_fname" value="{{$farmer->fr_fname}}">
                        </div>
                      </div> 
                        <div class="form-group">
                          <label for="gender" class="bmd-label-floating text-primary">Gender</label>
                          <select class="form-control" type="select" id="gender" required name="fr_gender">
                             <option value="{{$farmer->fr_gender}}">{{$farmer->fr_gender}}</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                      <div class="form-group">
                          <label for="cnic" class="bmd-label-floating text-primary">CNIC</label>
                          <input type="number" class="form-control" id="cnic" required name="fr_cnic" value="{{$farmer->fr_cnic}}">
                        </div>
                       <div class="form-group">
                          <label for="phone" class="bmd-label-floating text-primary">Phone</label>
                          <input type="number" class="form-control" id="phone" required name="fr_phone" value="{{$farmer->fr_phone}}">
                        </div> 
                      <div class="form-group">
                        <label for="address" class="bmd-label-floating text-primary">Address</label>
                        <textarea class="form-control" id="address" rows="2" required name="fr_address">
                          {{$farmer->fr_address}}
                        </textarea>
                      </div>
                      <div class="form-group">
                          <label for="city" class="bmd-label-floating text-primary">City</label>
                          <input type="text" class="form-control" id="city" required name="fr_city"  value="{{$farmer->fr_city}}">
                        </div>
                     </div>
                   </div>
                 </div>
               </div>
                <div class="card">
                  <div class="card-header bg-primary" id="headingTwo">
                    <h5 class="mb-0">
                      <a class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                         <i class="material-icons text-warning">library_books</i>Account Details
                      </a>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                       <div class="container">
                         <b> Associated With </b>
                        <div class="form-inline">
                       <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">Teacher Name</label>
                          <input type="text" class="form-control teacher_txt" data-type="tr_name" id="tr_name_1" required name="tr_name" value="{{$farmer->tr_name}}">
                        </div>
                         <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">CNIC Number</label>
                          <input type="number" class="form-control teacher_txt" data-type="tr_cnic" id="tr_cnic_1" required name="tr_cnic" value="{{$farmer->tr_cnic}}">
                        </div>
                         <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">Teacher ID</label>
                          <input type="number" class="form-control teacher_txt" data-type="tr_ID" id="tr_ID_1" required name="tr_ID" value="{{$farmer->tr_ID}}">
                        </div>
                      </div>
                        <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">Amount</label>
                          <input type="number" class="form-control" id="amount" required name="fr_quota" value="{{$farmer->fr_quota}}">
                          <span class="bmd-help"></span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1" class="text-primary">Valid Till</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" required name="fr_quota_validtill">
                          <span class="bmd-help"></span>
                          <p>{{$farmer->fr_quota_validtill}} </p>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1" class="text-primary">Valid From</label>
                          <input type="date" class="form-control" id="exampleInputEmail1" required name="fr_quota_validfrom">
                          <span class="bmd-help"></span>
                          <p>{{$farmer->fr_quota_validfrom}} </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 <div class="card">
                  <div class="card-header bg-primary" id="headingThree">
                    <h5 class="mb-0">
                      <a class="btn btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                         <i class="material-icons text-warning">library_books</i>Guaranters
                      </a>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                       <div class="container">
                        <div class="form-inline bg-primary">
                         <div class="form-group">
                            <label for="amount" class="bmd-label-floating text-white">Name</label>
                            <input type="text" class="form-control guaranter_txt text-white" data-type="gr_name" id="gr_name_1" required name="gr_name_a" value="{{$farmer->gr_name_a}}">
                          </div>
                           <div class="form-group">
                            <label for="amount" class="bmd-label-floating text-white">CNIC</label>
                            <input type="number" class="form-control guaranter_txt text-white" data-type="gr_cnic" id="gr_cnic_1" required name="gr_cnic_a" value="{{$farmer->gr_cnic_a}}">
                          </div>
                           <div class="form-group">
                            <label for="amount" class="bmd-label-floating text-white">ID</label>
                            <input type="number" class="form-control guaranter_txt text-white" data-type="gr_ID" id="gr_ID_1" required 
                            name="gr_ID_a" value="{{$farmer->gr_ID_a}}">
                        </div>
                      </div>
                      <div class="form-inline bg-dark">
                       <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">Name</label>
                          <input type="text" class="form-control guaranter_txt text-white" data-type="gr_name" id="gr_name_2" required name="gr_name_b" value="{{$farmer->gr_name_b}}">
                        </div>
                         <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">CNIC</label>
                          <input type="number" class="form-control guaranter_txt text-white" data-type="gr_cnic" id="gr_cnic_2" required name="gr_cnic_b" value="{{$farmer->gr_cnic_a}}">
                        </div> 
                         <div class="form-group">
                          <label for="amount" class="bmd-label-floating text-primary">ID</label>
                          <input type="number" class="form-control guaranter_txt text-white" data-type="gr_ID" id="gr_ID_2" required 
                          name="gr_ID_b" value="{{$farmer->gr_ID_a}}">
                        </div>
                      </div>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
                <br>
                <div align="center" >
              <a href="{{action('FarmerController@index')}}" class="btn btn-warning btn-raised">Cancel </a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
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