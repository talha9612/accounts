<!-- create.blade.php -->
@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->cpaymentsadd) && Auth::user()->cpaymentsadd == '1')
      { ?>

<!-- WORK AREA START -->
           
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Cash Payment)</small>
          </h3>
          <br>
          <form method="post" action="{{url('cashtransactions')}}">
            <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
           <div class="container">
               <!--  {!! Form::open() !!}  -->
                <div class="form-group">
                    <input class="form-control" type='text' name='voucher' id="voucher_1" placeholder="Voucher number" required  readonly/>
                    <input type='hidden' name='preparedby' id="preparedby" value="<?php echo Auth::user()->name ?>" />
                </div> 
                <!-- <div class="form-group">
                          <label for="bk_name" class="text-primary">Date</label>
                          <input class="form-control" type="date" id="date" name="date" />
                    </div> -->
                  <div class="form-inline">
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Account Title</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="countryname" id='countryname_1' name='countryname' required/>
                    </div>
                  
                    <div class="form-group" style="margin-left: 65%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="country_code" id='country_code_1' name='country_code' required/> 
                    </div>
                   
                <!-- {!! Form::close() !!} -->
              </div>
           
         {{csrf_field()}}
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">attach_money</i>DETAILS
                  </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                  <!-- EMPTY FOR NOW -->
                 </div>
               </div>
              </div>
            </div>
             <div class="container">
                    <!-- {!! Form::open() !!} --> 
                      <table class="table table-bordered">
                        <tr>
                            <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
                            <th id="titlesno">S. No</th>
                            <th id="titlename">Name</th>
                            <th id="id">ID</th>
                            <th hidden>Type</th>
                            <th id="titledesc">Description</th>
                            <th id="titleamount">Amount</th>
                            <th id="titlebalance">Balance</th>
                        </tr>
                       <!--  <tr>
                             <td><input type='checkbox' class='chkbox'/></td>
                            <td><input type="number" id='sn' value="1" name="ct_sno[]" readonly></td>
                            <td><input class="form-control expense_txt" type='text' data-type="name" id='name_1' name='name[]' required/></td>
                            <td hidden><input class="form-control expense_txt" type='text' data-type="head" id='head_1' name='head[]' required /> </td>
                            <td><input class="form-control expense_txt" type='text' data-type="type" id='type_1' name='type[]' required/> </td>
                            <td><input class="form-control" type='text'  id='desc' name='desc[]' required/> </td>
                            <td><input class="form-control amnt" type='text'  id='amnt' name='amnt[]' required/> </td>
                            <td><input class="form-control" type='number'  id='balance' name='balance[]' required  readonly /></td>
                        </tr> -->
                        </table>
                        <button type="button" class='btn btn-danger delete'>- Delete</button>
                        <button type="button" class='btn btn-success addbtn' id="products" onclick="disup()">+ Add More</button>
                        <button type="button" class='btn btn-success addsr' id="suppliers" onclick="dispro()">+ Add Supplier</button>
                    <!-- {!! Form::close() !!} -->
                    <br>
                    <br>
                    <br>
                    <div> 
                     <label for="vr_no" class="bmd-label-floating text-primary">Grand Total</label>
                    <input class="form-control" type='number' id="vr_amount" name="vr_amount" required readonly /> 
                     <label for="r_balance" class="bmd-label-floating text-primary">Remaining Balance</label>
                    <input class="form-control" type='number' id="r_balance" name="r_balance" required readonly /> 
                  </div>
                </div>
                <br>              
                <div align="center" >
                 <a href="{{action('CashtransactionController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                  <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Submit</button>
                </div>
              </form>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

       <!-- WORK AREA END -->
<script type="text/javascript">
var crntdate = document.getElementById("crntdate").value;
var compdate = document.getElementById("compdate").value;

if(Date.parse(crntdate) > Date.parse(compdate))
{
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("fsclyear").value = (n)+'-'+(n+1);
} 
else{
    var d = new Date();
    var n = d.getFullYear();
    document.getElementById("fsclyear").value = (n-1)+'-'+(n);
}
</script>

<script type="text/javascript"> 
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');
  
  if(type =='countryname' )autoType='cih_title'; 
  if(type =='country_code' )autoType='cih_balance'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchaccount') }}",
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
           $('#countryname_'+elementId).val(data.cih_title);
           $('#country_code_'+elementId).val(data.cih_balance);
       }
   }); 
});
</script>

<script type="text/javascript">        
  $(".delete").on('click', function() {
  $('.chkbox:checkbox:checked').parents("tr").remove();
  $('.check_all').prop("checked", false); 
  updateSerialNo();
});
var i=$('table tr').length;
$(".addbtn").on('click',function(){

  count=$('table tr').length;
      var data="<tr><td><input type='checkbox' class='chkbox'/></td>";
      data+="<td><input type='number' id='sn"+i+"' value='"+count+"' name='ct_sno[]'></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='name' id='name_"+i+"' name='name[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='head' id='head_"+i+"' name='head[]' required readonly/></td>";
      data+="<td hidden><input class='form-control expense_txt' type='text' data-type='type' id='type_"+i+"' name='type[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='desc[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='amnt_"+i+"' name='amnt[]' required/></td>"
      data+="<td><input class='form-control' type='text' id='balance_"+i+"' name='balance[]' required readonly/></td></tr>";
  $('table').append(data); 
// document.getElementById("name_"+i+"").focus(); 
document.getElementById("name_"+i+"").select(); 
   i++;  
});

$(".addsr").on('click',function(){
  count=$('table tr').length;
      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Supplier </td>";
      data+="<td><input class='form-control supplier_txt' type='text' data-type='suppliercompany' id='suppliercompany_"+i+"' name='suppliercompany[]' placeholder='Company' required /></td>";
      data+="<td hidden><input class='form-control supplier_txt' type='text' data-type='supplierid' id='supplierid_"+i+"' name='supplierid[]' placeholder='ID' readonly  required/></td>";
      data+="<td><input class='form-control' type='text' id='srdesc_"+i+"' name='srdesc[]' placeholder='Description' required/></td>";
      data+="<td><input class='form-control' type='text' id='srdebit_"+i+"' name='amnt[]' placeholder='Amount' /></td>"
      data+="<td><input class='form-control' type='text' id='supplierbalance_"+i+"' name='supplierbalance[]' placeholder='Supplier Balance' required /></td>"
      data+="<td><input class='form-control' type='text'  id='balance_"+i+"' name='balance[]'  placeholder='Balance' required readonly/></td></tr>";
  $('table').append(data);
  document.getElementById("suppliercompany_"+i+"").select();
  i++;
});
        
function select_all() {
  $('input[class=chkbox]:checkbox').each(function(){ 
    if($('input[class=check_all]:checkbox:checked').length == 0){ 
      $(this).prop("checked", false); 
    } else {
      $(this).prop("checked", true); 
    } 
  });
}
function updateSerialNo(){ 
  obj=$('table tr').find('span');
  $.each( obj, function( key, value ) {
    id=value.id;
    $('#'+id).html(key+1);
  });
}
//autocomplete script
$(document).on('focus','.expense_txt',function(){
  type = $(this).data('type');
  
  if(type =='name' )autoType='h_name'; 
  if(type =='head' )autoType='h_ID';
  if(type =='type' )autoType='h_type'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchhead') }}",
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
           $('#name_'+elementId).val(data.h_name);
           $('#head_'+elementId).val(data.h_ID);
           $('#type_'+elementId).val(data.h_type);
       }
   });
});

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

$(document).ready(function(){  
 function fetch_voucher_number(query = '')
 {
  $.ajax({
   url:"{{ route('searchvoucher') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#voucher_1').val(data.table_data);
   }
  })
 }

setInterval(function()
 { 
  var query = "1";
  fetch_voucher_number(query);
 }, 1200);
});
 
</script>

 <!-- For Auto Calculation of Values -->
<script>
 setInterval(function()
 { 
     findTotal();
 }, 1200);

function findTotal(){
    var arr = document.getElementsByName('amnt[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
      // arr[i].value = arr[i].value.replace(/\D/g, "");
        if(parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
document.getElementById('vr_amount').value = tot;
var balance = document.getElementById('country_code_1').value;
var calcamount = document.getElementById('vr_amount').value;

document.getElementById('r_balance').value = balance - calcamount;  
document.getElementsByName('balance[]')[i].value = document.getElementById('r_balance').value;        
    }
}

function disup() {
  document.getElementById("suppliers").disabled = true;
}
function dispro() {
  document.getElementById("products").disabled = true;
  document.getElementById("titlesno").hidden = true;
  document.getElementById("titlename").hidden = true;
  document.getElementById("titleamount").hidden = true;
  document.getElementById("titledesc").hidden = true;
  document.getElementById("titlebalance").hidden = true;
  document.getElementById("id").hidden = true;
}

//  window.onbeforeunload = function() {
//   return "Data will be lost if you leave the page, are you sure?";
//   };

</script> 



 @endsection 
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>  
 <?php  } else {  redirect()->to('home')->send(); } ?>   
 