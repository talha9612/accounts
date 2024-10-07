@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->serviceview) && Auth::user()->serviceview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Service Requisition)</small>
          </h3>
          <br>
          <form method="post" action="{{url('srvrequisitions')}}">
             <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
           <div class="container">
               <!--  {!! Form::open() !!}  -->
                <div class="form-group">
                          <input class="form-control" type='text' name='srv_number' id="voucher_1" required readonly placeholder="Requistion Number" />
                </div> 
                <div class="form-group">
                          <label for="bk_name" class="text-primary">Date</label>
                          <input class="form-control" type="date" id="date" name="date" />
                    </div>
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='sr_name' name='srv_name' value="{{ Auth::user()->name }}" required/>
                    </div>
                    <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Customer</label>
                        <input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_1' name='farmername' required /> 
                    </div>
                    <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Customer ID</label>
                        <input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_1' name='farmerid' readonly required/>
                    </div>
                    <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Order #</label>
                        <input class='form-control' type='text' id='crorder' name='crorder' required/>
                    </div>
                   
                    <div class="form-inline">
                     <div class="form-group" style="width: 33%">
                      <label for="pr_totalprice" class="bmd-label-floating text-primary">Head Name</label>
                       <input class="form-control expense_txt" type='text' data-type="name" id='name_1' name='name' required style="width: 95%"/>
                    </div>
                     <div class="form-group" style="width: 33%">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">ID</label>
                         <input class="form-control expense_txt" type='text' data-type="head" id='head_1' name='head' required style="width: 95%" /> 
                    </div>  
                      <div class="form-group" style="width: 34%">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Balance</label>
                         <input class="form-control expense_txt" type='text' data-type="head" id='balance_1' name='balance' required style="width: 100%" /> 
                    </div>  
                    
                    </div>  
                     <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Description</label>
                         <input class="form-control" type='text'  name='headdescription' required /> 
                    </div>
                     </div>

                <!-- {!! Form::close() !!} -->
              
            <br>
            <br>
         {{csrf_field()}}
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning" style="display: block">attach_money</i>Products
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
                     <table class="table table-bordered" id="main">
                        <tr>
                            <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
                            <th>ID</th>
                            <th hidden>Lot</th>
                            <th>Item</th>
                            <th>Model</th>
                            <th>Quantity</th>
                            <th>Cost Price</th>
                            <th>Sale Price</th>
                            <th>Total Price</th>
                           
                        </tr>
                        <tr>
                            <td><input type='checkbox' class='chkbox'/></td>
                            <td><input class="form-control expenses_txt" type='text' data-type="id" id='id_1' name='id[]' required/></td>
                            <td hidden><input class="form-control expenses_txt" type='text' data-type="lot" id='lot_1' name='lot[]' required/></td>
                            <td><input class="form-control expenses_txt" type='text' data-type="item" id='item_1' name='item[]' required /> </td>
                            <td><input class="form-control expenses_txt" type='text' data-type="size" id='size_1' name='size[]' required/> </td>
                            <td><input class="form-control expenses_txt" type='number' data-type="quantity" id='quantity_1' name='quantity[]' required /></td>
                            <td><input class="form-control expenses_txt" type='number' data-type="costunit" id='costunit_1' name='costunit[]' required readonly /></td>
                            <td><input class="form-control" type='text' data-type="saleprice" id='' name='saleprice[]' required /></td>
                            <td><input class="form-control" type='text' id='total_1' name='total[]' required   /></td>
                             
                        </tr>
                      </table>
                        <button type="button" class='btn btn-danger delete'>- Delete</button>
                        <button type="button" class='btn btn-success addbtn'>+ Add More</button>
                    <!-- {!! Form::close() !!} -->
                    
                     <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Total</label>
                        <input class='form-control' type='text' id='grandtotal' name='grandtotal' /> 
                      </div>
                      
                    <div align="center" >
                      <a href="{{action('SrvrequisitionController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Save</button>
                      </div>
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

$(document).on('focus','.farmer_txt',function(){
  type = $(this).data('type');
  
  if(type =='farmername' )autoType='fr_name'; 
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
           $('#farmerid_'+elementId).val(data.fr_ID);
       }
   }); 
});


  $(".delete").on('click', function() {
  $('.chkbox:checkbox:checked').parents("tr").remove();
  $('.check_all').prop("checked", false); 
  updateSerialNo();
});
var i=$('table tr').length;
$(".addbtn").on('click',function(){
  count=$('table tr').length;
    
      var data="<tr><td><input type='checkbox' class='chkbox'/></td>";
      data+="<td><input class='form-control expenses_txt' type='text' data-type='id' id='id_"+i+"' name='id[]' required/></td>";
      data+="<td hidden><input class='form-control expenses_txt' type='text' data-type='lot' id='lot_"+i+"' name='lot[]' required/></td>";
      data+="<td><input class='form-control expenses_txt' type='text' data-type='item' id='item_"+i+"' name='item[]' required/></td>";
      data+="<td><input class='form-control expenses_txt' type='text' data-type='size' id='size_"+i+"' name='size[]' required/></td>";
      data+="<td><input class='form-control expenses_txt' type='text' data-type='quantity' id='quantity_"+i+"' name='quantity[]' required/></td>"
      data+="<td><input class='form-control expenses_txt' type='number' data-type='costunit' id='costunit_"+i+"' name='costunit[]' required readonly/></td>";
      data+="<td><input class='form-control' type='text' data-type='saleprice' id='' name='saleprice[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='total_"+i+"' name='total[]' required /></td>";
      data+="</tr>";
  $('#main').append(data);
  i++;
});
    

//autocomplete script
$(document).on('focus','.expenses_txt',function(){
  type = $(this).data('type');
  if(type =='id' )autoType='ss_ID';
  if(type =='lot' )autoType='lot_number'; 
  if(type =='item' )autoType='ss_item';
  if(type =='size' )autoType='ss_size'; 
  if(type =='quantity' )autoType='ss_quantity'; 
  if(type =='costunit' )autoType='ss_costunit'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchstock') }}",
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
           $('#id_'+elementId).val(data.ss_ID);
           $('#lot_'+elementId).val(data.lot_number);
           $('#item_'+elementId).val(data.ss_item);
           $('#size_'+elementId).val(data.ss_size);
           $('#quantity_'+elementId).val(data.ss_quantity);
           $('#costunit_'+elementId).val(data.ss_costunit);
       }
   });
});


$(document).on('focus','.expense_txt',function(){
  type = $(this).data('type');
  
  if(type =='name' )autoType='h_name'; 
  if(type =='head' )autoType='h_ID';
  if(type =='balance' )autoType='h_balance';

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
           $('#balance_'+elementId).val(data.h_balance);
       }
   });
});


$(document).ready(function(){
 function fetch_voucher_number(query = '')
 {
  $.ajax({
   url:"{{ route('searchsrvreqnumber') }}",
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
     Total(); 
 }, 1200);


function findTotal()
{
var grandtotali = 0;
var totalisaletax = 0;  
var totalsaletax = 0;  
var saletaxp = 0; 
var runningtotal = document.getElementsByName('saleprice[]');
var total = 0;
var gtotal = 0;
var saletaxamount = 0;
    for(var i=0;i<runningtotal.length;i++){

        if(parseFloat(runningtotal[i].value) && runningtotal[i].value !== null)
        {
        total = parseFloat(runningtotal[i].value); 

    gtotal = total.toFixed(2) * document.getElementsByName('quantity[]')[i].value;
    document.getElementsByName('total[]')[i].value = gtotal.toFixed(2);  

      }  
      else {
        document.getElementsByName('total[]')[i].value = null
      }  
     }

}

function Total()
{
var running = document.getElementsByName('total[]');
var total = 0;
    for(var i=0;i<running.length;i++){
        if(parseFloat(running[i].value))
        total += parseFloat(running[i].value);  
       document.getElementById('grandtotal').value = total;         
    }      
}

 window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
  };
</script> 


 @endsection 
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>  
 <?php  } else {  redirect()->to('home')->send(); } ?> 