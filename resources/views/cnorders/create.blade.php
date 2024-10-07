<!-- create.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->cancelledordersview) && Auth::user()->cancelledordersview == '1')
      { ?>
<!-- WORK AREA START -->
        <h3 align="center" style= "color: #3F729B">
        Add New Quote
        </h3>
       
        <div class="card-header card" style="background-color: #3F729B" id="headingOne">
        <h5 class="mb-0">
        <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <i class="fas fa-plus-square">
        </i>Products Quotation
        </a>
        </h5>
        </div>
        <br>  
         <form method="post" action="{{url('quotes')}}">
                      
                <div class="container">                  
                <div class="form-inline">                      
                <div class="form-group">
                <label for="name" class="bmd-label-floating" style= "color: #3F729B">Reference Number</label>
                <input type="text" class="form-control" required name="qref">
                </div>
                <div class="form-group">
                <label for="sowodo" class="bmd-label-floating" style= "color: #3F729B">Quotation ID</label>
                <input class="form-control" type='text' name='qid' id="voucher_1" placeholder="Voucher number" required readonly/>
                </div> 
                <div class="form-group">
                <label for="sowodo" class="bmd-label-floating"style= "color: #3F729B">Month</label>
                <input type="text" class="form-control" required name="qmonth" value="<?php echo date('F'); ?>">
                </div>
                <div class="form-group">
                <label for="sowodo" class="bmd-label-floating"style= "color: #3F729B">Year</label>
                <input type="text" class="form-control" required name="qyear" value="<?php echo date('Y'); ?>">
                </div>
                <div class="form-group">
                <label for="phone" class="bmd-label-floating"style= "color: #3F729B">Revision Status</label>
                <input type="text" class="form-control" required name="qrev" value="0">
                </div>
                </div>
                <div class="form-group">
                <label for="stype" style= "color: #3F729B">Category</label>
        <select class="form-control" type="select" id="stype" required name="qcategory" style="width: 15%">                 
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>                            
                </select>
                </div>                
                <br>
                {{csrf_field()}}                              
                <b> Customer Details </b>                  
                <div class="form-inline">
                <div class="form-group">
                <label for="name" class="bmd-label-floating" style= "color: #3F729B">Customer Name</label>
                <input type="text" class="form-control autocomplete_txt" id="customername_1" required name="cname" data-type="customername">
                </div>
                <div class="form-group">
                <label for="name" class="bmd-label-floating"style= "color: #3F729B">Attn</label>
                <input type="text" class="form-control autocomplete_txt" id="attn_1" required name="cattn" data-type="attn">
                </div>
                <div class="form-group">
                <label for="sowodo" class="bmd-label-floating"style= "color: #3F729B">Designation</label>
                <input type="text" class="form-control autocomplete_txt" id="designation_1" required name="cdesignation" data-type="designation">
                </div>
                <div class="form-group">
                <label for="phone" class="bmd-label-floating"style= "color: #3F729B">Location</label>
                <input type="text" class="form-control" id="phone" required name="carea" >
                </div>    
                <div class="form-group">
                <label for="phone" class="bmd-label-floating"style= "color: #3F729B">Contact Number</label>
                <input type="text" class="form-control autocomplete_txt" id="contactnum_1" required name="cnum" data-type="contactnum">
                </div>    
                <div class="form-group">
                <label for="phone" class="bmd-label-floating"style= "color: #3F729B">Customer RFQ #</label>
                <input type="text" class="form-control" id="phone" required name="crfq">
                </div>    
                <div class="form-group">
                <label for="phone" class="bmd-label-floating"style= "color: #3F729B">Email</label>
                <input type="text" class="form-control autocomplete_txt" id="email_1" required name="cemail" data-type="email">
                </div>
                </div>       
                             
                <br>
                <b> Quotation Details</b>                  
                <div class="form-inline">
                <div class="form-group" style="width: 50%">
                <label for="name" class="bmd-label-floating"style= "color: #3F729B">Subject</label>
                <input type="text" style="width: 100%" class="form-control" id="name" required name="qsubject">
                </div>
                <div class="form-group">
                <label for="phone" class="bmd-label-floating"style= "color: #3F729B">Currency</label>
                <input type="text" class="form-control" id="phone" value="PKR" required name="currency">
                </div> 
                </div>

                <div class="form-inline">                      
                <div class="form-group" style="width: 50%">
                <label class="bmd-label-floating"style= "color: #3F729B">Shipping Terms</label>                
                <input type="text" style="width: 100%" class="form-control" id="name" required name="qterms">
                </div>
                <div class="form-group"style="width: 50%">
                <label for="phone" class="bmd-label-floating"style= "color: #3F729B">Payment Terms</label>
                <input type="text" style="width: 100%" class="form-control" id="phone" required name="pterms">
                </div>
                </div>

                <div class="form-inline">  
                <div class="form-group" style="width: 33.33%">
                <label class="bmd-label-floating"style= "color: #3F729B">Delivery Period</label>
                <input type="text" style="width: 100%" class="form-control" id="sowodo" required name="dperiod">
                </div>                                                       
                <div class="form-group" style="width: 33.33%">
                <label class="bmd-label-floating"style= "color: #3F729B">Issue Date</label>
                <input type="text" style="width: 100%" value="<?php echo date('d-M-Y'); ?>" class="form-control" id="phone" required name="idate">
                </div> 
                <?php $cdate=date('d-M-Y');$cdate=date('d-M-Y',strtotime($cdate .'+30 days')); ?>   
                <div class="form-group" style="width: 33.33%">
                <label style= "color: #3F729B">Valid Till</label>
                <input type="date" style="width: 100%;background-color: pink" value="<?php echo $cdate; ?>" class="form-control" id="phone" required name="validtill">
                </div>
                </div>
                <br>
                                      
                <div class="form-group" >
                <label for="phone" class="bmd-label-floating"style= "color: #3F729B">Additional Notes</label>
                <textarea name="notes" class="form-control" id="exampleFormControlTextarea3" rows="3" style="width: 100%">*Please confirm above quoted items as per your requirement before placing order.
*Quoted prices are without accessories & certificates. Price valid for this quantity only.
*Exchange rate: The above prices are calculated on the exchange rate $1 = Rs. 158 and subject to revise if the exchange rate changes by +/-1%.</textarea>
                </div>                                        
                <br>
                <b> Add Products / Services</b> 
                <!-- {!! Form::open() !!} --> 
                <table class="table table-bordered">
                <tr>
                    <th>
                    <input class='check_all' type='checkbox' style ='width: 10%'onclick="select_all()"/>
                    </th>
                    <th style ='width: 10%'>Sr.No</th>
                    <th>Description</th>
                    <th>Model</th>  
                    <th>Make</th>  
                    <th>Specs</th>  
                    <th>Unit</th>                                                     
                    <th>Quantity</th>                   
                    <th>Unit Price</th>                          
                    <th>Total</th>                          
                    </tr>
                    </table>
                    <button type="button" class='btn btn-danger delete'>- Delete</button>
                    <button type="button" class='btn btn-success addbtn' id="products">+ Add More</button>         
                    <br>
                    <br>                                                                                 
          <label for="vr_no" class="bmd-label-floating"style= "color: #3F729B">Grand Total</label>
          <input class="form-control" type='number' id="grandtotal" name="grandtotal" required readonly />                
                  <div class="form-inline">
                  <div class="form-group" style="width: 50%">
                  <label for="r_balance"  style= "color: #3F729B">GST %</label>
                  <input class="form-control"style="width: 100%" type='number' id="gstp" name="gstp" required value="17" />
                </div>
                <div class="form-group" style="width: 50%">
                  <label for="r_balance" style= "color: #3F729B">GST Amount</label>
                  <input class="form-control"style="width: 100%" type='number' id="gstamnt" name="gstamnt" required readonly/>
                </div>
                </div>
                <br>     
          <label for="vr_no" class="bmd-label-floating"style= "color: #3F729B">Grand Total Incl GST</label>
          <input class="form-control" type='number' id="grandtotaligst" name="grandtotaligst" required readonly />                               
                <br>
                <div class="form-inline">            
                <div class="form-group"style="width: 50%">
                <label for="stype" style= "color: #3F729B">Prepared By:</label>
<select class="form-control" type="select" id="stype" required name="preparedby" style="width: 100%">                 
                <option value="Naveed Ahmad(0333-4844561)">Naveed Ahmed (0333-4844561)</option>
                <option value="Kashif Shamdsuddin(0321-4988683)">Kashif Shamsuddin (0321-4988683)</option>                                         
                </select>
                </div>
                <div class="form-group"style="width: 50%">
                <label for="stype" style= "color: #3F729B">Approved By:</label>
<select class="form-control" type="select" id="stype" required name="approvedby" style="width: 100%">                 
                <option value="Kashif Shamdsuddin(0321-4988683)">Kashif Shamsuddin (0321-4988683)</option>
                <option value="Naveed Ahmad(0333-4844561)">Naveed Ahmed (0333-4844561)</option>                                        
                </select>
                </div>
                </div>
                </div>
                <br>
                <br>
                <div align="center">
                <a href="{{action('CompanyController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
                </div>
                                      
            </form>            
          <br>
          <br>
          <br>
          <br>
       <!-- WORK AREA END -->     
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
    data+="<td><input type='number' id='sn"+i+"' value='"+count+"' style ='width: 50%' name='ct_sno[]'></td>";
    data+="<td><input class='form-control expense_txt' type='text' data-type='pname' id='pname_"+i+"' name='pname[]' required/></td>";
    data+="<td><input class='form-control expense_txt' type='text' data-type='psize' id='psize_"+i+"' name='psize[]' required /></td>";
    data+="<td><input class='form-control expense_txt' type='text' data-type='scompany' id='scompany_"+i+"' name='scompany[]' required/></td>";
    data+="<td><input class='form-control expense_txt' type='text' data-type='specs' id='specs_"+i+"' name='specs[]' required/></td>";
     data+="<td><input class='form-control' type='text' id='unit_"+i+"' name='unit[]' required/></td>";
    data+="<td><input class='form-control' type='text' id='qty_"+i+"' name='qty[]' required/></td>";
    data+="<td><input class='form-control' type='text' id='unitprice_"+i+"' name='unitprice[]' required/></td>"
    data+="<td><input class='form-control' type='text' id='total_"+i+"' name='total[]' required/></td></tr>";

  $('table').append(data);
 
  document.getElementById("psize_"+i+"").select();
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
  if(type =='pname' )autoType='p_name'; 
  if(type =='psize' )autoType='p_size';
  if(type =='scompany' )autoType='s_company';
  if(type =='specs' )autoType='p_specs'; 
  $(this).autocomplete({
  minLength: 0,
  source: function( request, response ) {
  $.ajax({
  url: "{{ route('searchproductquote') }}",
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
  }});
  response(array)
  }});
  },
    select: function( event, ui ) {
    var data = ui.item.data;           
    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    elementId = id[id.length-1];
    $('#pname_'+elementId).val(data.p_name);
    $('#psize_'+elementId).val(data.p_size);
    $('#scompany_'+elementId).val(data.s_company);
    $('#specs_'+elementId).val(data.p_specs);
  }});
  });
$(document).ready(function(){
document.getElementById("voucher_1").autofocus=true;
function fetch_voucher_number(query = '')
{
   $.ajax({
   url:"{{ route('searchquote') }}",
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
<script type="text/javascript"> 
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');
    if(type =='customername' )autoType='c_name'; 
    if(type =='attn' )autoType='cp_name'; 
    if(type =='designation' )autoType='cp_designation'; 
    if(type =='contactnum' )autoType='cp_cell'; 
    if(type =='email' )autoType='cp_email'; 
   $(this).autocomplete({
      minLength: 0,
      source: function( request, response ) {
      $.ajax({
      url: "{{ route('searchattn') }}",
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
      }});
      response(array)
}});
},
    select: function( event, ui ) {
      var data = ui.item.data;           
      id_arr = $(this).attr('id');
      id = id_arr.split("_");
      elementId = id[id.length-1];
      $('#customername_'+elementId).val(data.c_name);
      $('#attn_'+elementId).val(data.cp_name);
      $('#designation_'+elementId).val(data.cp_designation);
      $('#contactnum_'+elementId).val(data.cp_cell);
      $('#email_'+elementId).val(data.cp_email);
}}); 
});
</script>
 <!-- For Auto Calculation of Values -->
<script>
 setInterval(function()
 { 
     findTotal();
 }, 1200);
function findTotal(){
    var arr = document.getElementsByName('unitprice[]');
    var qty = document.getElementsByName('qty[]');
    var total = document.getElementsByName('total[]');
    var tot=0;
    var gstp = document.getElementById('gstp').value;
    var gstamnt = 0;
    var grandtotaligst = 0;
    for(var i=0;i<arr.length;i++){
      // arr[i].value = arr[i].value.replace(/\D/g, "");
    if(parseFloat(arr[i].value))
          total[i].value = parseFloat(arr[i].value * qty[i].value);
          tot += parseFloat(arr[i].value * qty[i].value);

          document.getElementById('grandtotal').value = tot;
          gstamnt = (gstp/100) *document.getElementById('grandtotal').value;
          document.getElementById('gstamnt').value = gstamnt.toFixed(2);
          grandtotaligst = gstamnt + tot;
          document.getElementById('grandtotaligst').value = grandtotaligst.toFixed(2);       
}
}
 window.onbeforeunload = function() {
  return "Any Unsaved data will be lost if you leave the page, are you sure?";
  };
</script> 
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?> 