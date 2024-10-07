<!-- create.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->breceiptsadd) && Auth::user()->breceiptsadd == '1')
              { ?>   
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Bank Receipt)</small>
          </h3>
          <br>
          <form method="post" action="{{url('bankreceipts')}}">
            <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
           <div class="container">
               <!--  {!! Form::open() !!}  -->
                <div class="form-group">
                    <input class="form-control" type='text' name='voucher' id="voucher_1" placeholder="Voucher Number" required readonly />
                    <input type='hidden' name='preparedby' id="preparedby" value="<?php echo Auth::user()->name ?>" />
                </div> 
               <!--   <div class="form-group">
                          <label for="bk_name" class="text-primary">Date</label>
                          <input class="form-control" type="date" id="date" name="date" />
                    </div>  -->
                  <div class="form-inline">
                   
                    <div class="form-group col-sm-4">
                          <label for="bk_name" class="bmd-label-floating text-primary">Account Title</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="accounttitle" id='accounttitle_1' name='accounttitle' required/>
                    </div>
                   
                    <div class="form-group col-sm-4">
                          <label for="accountnumber" class="bmd-label-floating text-primary">Account Number</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="accountnumber" id='accountnumber_1' name='accountnumber' required/>
                    </div>
                  
                    <div class="form-group col-sm-4">
                          <label for="openingbalance" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="openingbalance" id='openingbalance_1' name='openingbalance' required/> 
                    </div>
                    </div>
                  <div class="form-group">
                          <label for="cheque_number" class="bmd-label-floating text-primary">Cheque Number</label>
                          <input class="form-control" type='text' data-type="cheque_number" id='cheque_number' name='cheque_number' required/>
                    </div> 
                      <div class="form-group col-md-12">
                          <label for="cheque_date" class="text-primary">Cheque Date</label>
                          <input class="form-control" type='date' data-type="cheque_date" id='cheque_date' name='cheque_date' required/>
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
<!--                         <tr>
                            <td><input type='checkbox' class='chkbox'/></td>
                            <td><input type="number" id='sn' value="1" name="ct_sno[]" readonly></td>
                            <td><input class="form-control expense_txt" type='text' data-type="name" id='name_1' name='name[]' required/></td>
                            <td hidden><input class="form-control expense_txt" type='text' data-type="head" id='head_1' name='head[]' required/> </td>
                            <td><input class="form-control expense_txt" type='text' data-type="type" id='type_1' name='type[]' required/> </td>
                            <td><input class="form-control" type='text'  id='desc' name='desc[]' required/> </td>
                            <td><input class="form-control" type='number'  id='amnt' name='amnt[]' required/> </td>
                            <td><input class="form-control" type='number'  id='balance' name='balance[]' required readonly /> </td>
                        </tr> -->
                        </table>
                        <button type="button" class='btn btn-danger delete'>- Delete</button>
                        <button type="button" class='btn btn-success addbtn' id="products" onclick="disfar()">+ Add More</button>
                         <button type="button" class='btn btn-success addfr' id="farmers" onclick="dispro()">+ Add Customer</button>
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
               <a href="{{action('BankreceiptController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
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
$(document).ready(function(){
 function fetch_voucher_number(query = '')
 {
  $.ajax({
   url:"{{ route('searchvoucherbr') }}",
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
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');
  
  if(type =='accounttitle' )autoType='acc_title'; 
  if(type =='openingbalance' )autoType='acc_balance'; 
  if(type =='accountnumber' )autoType='acc_number'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchbankaccount') }}",
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
           $('#accounttitle_'+elementId).val(data.acc_title);
           $('#openingbalance_'+elementId).val(data.acc_balance);
           $('#accountnumber_'+elementId).val(data.acc_number);
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
      data+="<td><input type='number' id='sn"+i+"' value='"+count+"' readonly name='ct_sno[]'></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='name' id='name_"+i+"' name='name[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='head' id='head_"+i+"' name='head[]' required/></td>";
      data+="<td hidden><input class='form-control expense_txt' type='text' data-type='type' id='type_"+i+"' name='type[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='desc[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='amnt_"+i+"' name='amnt[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='balance_"+i+"' name='balance[]' required readonly/></td></tr>";
  $('table').append(data);
  document.getElementById("name_"+i+"").select();
  i++;
});

$(".addfr").on('click',function(){
  count=$('table tr').length;
    
      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Customer </td>";
      data+="<td><input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_"+i+"' name='farmername[]' placeholder='Name' required /></td>";
      data+="<td hidden><input class='form-control farmer_txt' type='text' data-type='farmercnic' id='farmercnic_"+i+"' name='farmercnic[]' readonly required /></td>";
       data+="<td hidden><input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_"+i+"' name='farmerid[]' readonly placeholder='ID' required /></td>";
      data+="<td><input class='form-control' type='text' id='frdesc_"+i+"' name='frdesc[]' placeholder='Description' required /></td>";
      data+="<td><input class='form-control' type='text' id='amnt_"+i+"' name='amnt[]' placeholder='Amount' required /></td>"
      data+="<td><input class='form-control farmer_txt' type='text'  data-type='frbalance' id='frbalance_"+i+"' name='frbalance[]' required placeholder='Customer Balance'/></td>";
      data+="<td><input class='form-control' type='text' id='balance_"+i+"' name='balance[]' required /></td></tr>";
  $('table').append(data);
  document.getElementById("farmername_"+i+"").select();
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
                url: "{{ route('searchexpensehead') }}",
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


$(document).on('focus','.farmer_txt',function(){
  type = $(this).data('type');
  
  if(type =='farmername' )autoType='fr_name'; 
  if(type =='farmercnic' )autoType='fr_cnic'; 
  if(type =='frbalance' )autoType='fr_balance';
  if(type =='farmerid' )autoType='fr_ID'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchfarmer') }}",
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
           $('#farmername_'+elementId).val(data.fr_name);
           $('#farmercnic_'+elementId).val(data.fr_cnic);
           $('#frbalance_'+elementId).val(data.fr_balance);
           $('#farmerid_'+elementId).val(data.fr_ID);
       }
   }); 
});
</script>


 <!-- For Auto Calculation of Values -->
<script>
 setInterval(function()
 { 
     findTotal(); 
 }, 800);

function findTotal(){
    var arr = document.getElementsByName('amnt[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);

document.getElementById('vr_amount').value = tot;



var balance = document.getElementById('openingbalance_1').value;
var calcamount = document.getElementById('vr_amount').value;

document.getElementById('r_balance').value = +balance + +calcamount;
document.getElementsByName('balance[]')[i].value = document.getElementById('r_balance').value;            
    }


}

function disfar() {
  document.getElementById("farmers").disabled = true;
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

// window.onbeforeunload = function() {
//   return "Data will be lost if you leave the page, are you sure?";
//   };
</script> 

 
      
 @endsection 
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>  
 <?php  } else {  redirect()->to('home')->send(); } ?>  
