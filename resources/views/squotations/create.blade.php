@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Sales Invoice)</small>
          </h3>
          <br>
          <form method="post" action="{{url('squotations')}}">
            <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
        <?php foreach ($details as $details):?>
           <div class="container">
               <!--  {!! Form::open() !!}  -->
                <div class="form-group">
                          <label for="po_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='po_number' value="<?php echo $details->sr_number; ?>"  readonly />
                </div> 
                <div class="form-group">
                          <label for="bk_name" class="text-primary">Date</label>
                          <input class="form-control" type="date" id="date" name="date" />
                    </div>
                   
                    <div class="form-group">
                          <label for="po_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='po_name' name='po_name' value="{{ Auth::user()->name }}" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->sr_title; ?>" readonly/> 
                    </div>

                <!-- {!! Form::close() !!} -->
              </div>
            <?php endforeach; ?>   
         {{csrf_field()}}
             <br>
 
                    <div class="container">
                      <h4 align="center">Products Details</h4>
                     <table class="table table-bordered">
                      <tr>
                        <thead>
                          <th>
                            Make
                          </th>
                          <th>
                            Item
                          </th>
                          <th>
                            Model
                          </th>
                          <th>
                            Specifications
                          </th>
                          <th>
                            Description
                          </th>
                          <th>
                            Quantity
                          </th>
                        </thead>
                      </tr>
                       <?php foreach ($requisition as $requisition):?>  
                       <tr>
                         <td>
                            <?php echo $requisition->sr_supplier; ?> 
                         </td>
                         <td>  
                          <?php echo $requisition->sr_item; ?>
                         </td>
                         <td>
                            <?php echo $requisition->sr_size; ?>
                         </td>
                         <td>
                            <?php echo $requisition->sr_specs; ?> 
                         </td>
                         <td>
                           <?php echo $requisition->sr_description; ?>
                         </td>
                         <td>
                            <?php echo $requisition->sr_quantity; ?>
                         </td>
                       </tr>
                       <?php endforeach; ?>
                     </table>
                      
                      </div>
                      
                   <br>
 

                <div class="container box bg-dark text-white">
                  <br />
                 <h4 align="center">List of Products Available in Stock</h4>
                 <div class="panel panel-default">
                  <div class="panel-body">
                   <div class="form-group">
                    <input type="text" name="search" id="search" class="form-control text-white" placeholder="Search Products Data" />
                   </div>
                   <div class="table-responsive">
                    <h5 align="center" class="text-primary">Total Number of Products : <span id="total_records"></span></h5>
                    <table class="table table-striped table-bordered">
                     <thead>
                      <tr>
                       <th class="text-white">ID</th>
                       <th class="text-white">Model</th>
                       <th class="text-white">Specs</th>
                       <th class="text-white">Quantity(Available)</th>
                       <th class="text-white">Cost Unit Price</th>
                       <th class="text-white">Lot Number</th>
                      </tr>
                     </thead>
                     <tbody id="records" class="text-white">
                      <!-- FOR DATA FETCHED BY AJAX-->
                     </tbody>
                    </table>
                   </div>
                  </div>    
                 </div>
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
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">NTN #/FTN #</label>
                        <input class='form-control farmer_txt' type='text' data-type='farmercnic' id='farmercnic_1' name='farmercnic' required/>
                    </div>
                    <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">GST #</label>
                        <input class='form-control farmer_txt' type='text' data-type='farmergst' id='farmergst_1' name='farmergst' required/>
                    </div>
                     <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Address</label>
                        <input class='form-control farmer_txt' type='text' data-type='farmeraddress' id='farmeraddress_1' name='farmeraddress' required/>
                    </div> 
                    <br>
                    <div class="form-group">
                          <label for="term" class="text-primary">Terms</label>
                          <select class="form-control" type="select" id="term" required name="sq_term">
                            <option value="Credit">Credit</option>
                            <option value="Advance">Advance</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
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
                            <th>ST Rate</th>
                            <th>ST Amout</th>
                            <th>Total</th>
                           
                        </tr>
                        <tr>
                            <td><input type='checkbox' class='chkbox'/></td>
                            <td><input class="form-control expense_txt" type='text' data-type="id" id='id_1' name='id[]' required/></td>
                            <td hidden><input class="form-control expense_txt" type='text' data-type="lot" id='lot_1' name='lot[]' required/></td>
                            <td><input class="form-control expense_txt" type='text' data-type="item" id='item_1' name='item[]' required /> </td>
                            <td><input class="form-control expense_txt" type='text' data-type="size" id='size_1' name='size[]' required/> </td>
                            <td><input class="form-control expense_txt" type='number' data-type="quantity" id='quantity_1' name='quantity[]' required /></td>
                            <td><input class="form-control expense_txt" type='number' data-type="costunit" id='costunit_1' name='costunit[]' required readonly /></td>
                            <td><input class="form-control" type='text' data-type="saleprice" id='' name='saleprice[]' required /></td>
                             <td><input class="form-control" type='text' id='total_1' name='total[]' required   /></td>
                            <td><input class="form-control" type='text' id='saletaxp_1' name='saletaxp[]' required /></td>
                            <td><input class="form-control" type='text' id='saletaxamount_1' name='saletaxamount[]' required /></td>
                            <td><input class="form-control" type='text' id='totalisaletax_1' name='totalisaletax[]' required /></td>
                           
                        </tr>
                      </table>
                        <button type="button" class='btn btn-danger delete'>- Delete</button>
                        <button type="button" class='btn btn-success addbtn'>+ Add More</button>
                    <!-- {!! Form::close() !!} -->
                    
                     <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Total (Exlusive Sales Tax)</label>
                        <input class='form-control' type='text' id='grandtotal' name='grandtotal' /> 
                      </div>

                      <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Total Sales Tax</label>
                        <input class='form-control' type='text' id='totalsaletax' name='totalsaletax' /> 
                      </div>

                      <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Total  (Inclusive Sales Tax)</label>
                        <input class='form-control' type='text' id='grandtotali' name='grandtotali' /> 
                      </div>
                      
                      <div align="center" >
                       <a href="{{action('PorderController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Save</button>
                      </div>
              </form>
   


             
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

     saletaxp = document.getElementsByName('saletaxp[]')[i].value / 100;
     saletaxamount = saletaxp.toFixed(2) * document.getElementsByName('total[]')[i].value;
     document.getElementsByName('saletaxamount[]')[i].value = saletaxamount.toFixed(2);
     totalsaletax += +document.getElementsByName('saletaxamount[]')[i].value;
     document.getElementById('totalsaletax').value = totalsaletax.toFixed(2);
     totalisaletax = +document.getElementsByName('saletaxamount[]')[i].value + +document.getElementsByName('total[]')[i].value;
     document.getElementsByName('totalisaletax[]')[i].value = totalisaletax.toFixed(2);
     grandtotali += +document.getElementsByName('totalisaletax[]')[i].value;  
     document.getElementById('grandtotali').value = grandtotali.toFixed(2); 
      }  
      else {
        document.getElementsByName('total[]')[i].value = null
        document.getElementsByName('saletaxp[]')[i].value = null
        document.getElementsByName('saletaxamount[]')[i].value = null
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
    
      // if(total > document.getElementById('farmerbalance_1').value)
      //   document.getElementById('sbmt').disabled = true;
      //  if(total === document.getElementById('farmerbalance_1').value)
      //   document.getElementById('sbmt').disabled = false;
      //  if(total < document.getElementById('farmerbalance_1').value)
      //   document.getElementById('sbmt').disabled = false;   
    }      
}

$(document).on('focus','.farmer_txt',function(){
  type = $(this).data('type');
  
  if(type =='farmername' )autoType='fr_name'; 
  if(type =='farmerid' )autoType='fr_ID'; 
  if(type =='farmercnic' )autoType='fr_cnic';
  if(type =='farmerbalance' )autoType='fr_balance';
  if(type =='farmergst' )autoType='fr_gst'; 
  
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
           $('#farmercnic_'+elementId).val(data.fr_cnic);
           $('#farmeraddress_'+elementId).val(data.fr_address);
           $('#farmergst_'+elementId).val(data.fr_gst);
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
      data+="<td><input class='form-control expense_txt' type='text' data-type='id' id='id_"+i+"' name='id[]' required/></td>";
      data+="<td hidden><input class='form-control expense_txt' type='text' data-type='lot' id='lot_"+i+"' name='lot[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='item' id='item_"+i+"' name='item[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='size' id='size_"+i+"' name='size[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='quantity' id='quantity_"+i+"' name='quantity[]' required/></td>"
      data+="<td><input class='form-control expense_txt' type='number' data-type='costunit' id='costunit_"+i+"' name='costunit[]' required readonly/></td>";
      data+="<td><input class='form-control' type='text' data-type='saleprice' id='' name='saleprice[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='total_"+i+"' name='total[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='saletaxp_"+i+"' name='saletaxp[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='saletaxamount_"+i+"' name='saletaxamount[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='totalisaletax_"+i+"' name='totalisaletax[]' required /></td>";
      data+="</tr>";
  $('#main').append(data);
   document.getElementById("id_"+i+"").select();
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


 window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
  };
</script>


<script>
$(document).ready(function(){

 fetch_customer_data();

 function fetch_customer_data(query = '')
 {
  $.ajax({
   url:"{{ route('searchproducts') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#records').html(data.table_data);
    $('#total_records').text(data.total_data);
   }
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_customer_data(query);
 });
});
</script> 

 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
  <?php  } else {  redirect()->to('home')->send(); } ?> 