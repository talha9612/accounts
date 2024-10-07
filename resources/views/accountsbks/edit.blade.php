<!-- edit.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->bankaccountsedit) && Auth::user()->bankaccountsedit == '1')
      { ?>

<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Bank Account)</small>
          </h3>
          <br>
      <form method="post" action="{{action('AccountsbksController@update', $accounts['acc_ID'])}}">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PATCH">
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Expenses
                  </a>
                </h5>
              </div>
                    <div class="container">
                        <div class="form-group">
                          <label for="name" class="text-primary">Account Title</label>
                          <input type="text" class="form-control" id="name" required name="acc_title" value="{{$accounts->acc_title}}">
                           <input type="hidden" class="form-control" id="name" required name="acc_ID" value="{{$accounts->acc_ID}}">
                        </div>

                        <div class="form-group">
                          <label for="name" class="text-primary">Account Number</label>
                          <input type="text" class="form-control" id="name" required name="acc_number" value="{{$accounts->acc_number}}">
                        </div>
                        <div class="form-group">
                            <label for="stype" class="text-primary">Account Type</label>
                            <select class="form-control" type="select" id="stype" required name="acc_type">
                              <option>{{$accounts->acc_type}}</option>
                              <option value="Saving">Saving</option>
                              <option value="Joint Account">Joint Account</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="name" class="text-primary">Account Balance</label>
                          <input type="text" class="form-control" id="name" required name="acc_balance" value="{{$accounts->acc_balance}}">
                        </div>
                    </div>
              </div>
            </div>
             <h5 class="mb-0">
                  <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i>Bank Details
                  </a>
                </h5>
              <div class="form-group">
                          <label for="bankname" class="bmd-label-floating text-primary">Bank Name</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="accounttitle" id='accounttitle_1' name='bankname' required value="{{$accounts->bk_name}}"/>
                    </div>
                    <!-- <div class="form-group">
                          <label for="accountnumber" class="bmd-label-floating text-primary">Branch Address</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="accountnumber" id='accountnumber_1' name='accountnumber' required />
                    </div> -->

                    <div class="form-group">
                          <label for="branchcode" class="bmd-label-floating text-primary">Branch Code</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="openingbalance" id='openingbalance_1' name='branchcode' required  value="{{$accounts->bk_branch_code}}"/>
                    </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div align="center" >
                <a href="{{action('AccountsbksController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
              </div>
            </form>
       <!-- WORK AREA END -->
 <script type="text/javascript">
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');

  if(type =='accounttitle' )autoType='bk_name';
  if(type =='openingbalance' )autoType='bk_branch_code';
  if(type =='accountnumber' )autoType='bk_address';

   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchbanks') }}",
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
           $('#accounttitle_'+elementId).val(data.bk_name);
           $('#openingbalance_'+elementId).val(data.bk_branch_code);
           $('#accountnumber_'+elementId).val(data.bk_address);
       }
   });
});
</script>

 @endsection
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
 <?php  } else {  redirect()->to('home')->send(); } ?>
