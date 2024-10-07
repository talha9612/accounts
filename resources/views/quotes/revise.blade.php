@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->quotesview) && Auth::user()->quotesview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" style= "color: #3F729B">
            Revise Quote
          </h3>
          <br>

          <?php foreach ($records as $details):?>
            <form method="post" action="{{url('quotes')}}">
         {{csrf_field()}}
        <input type="hidden" name="revise" value="1">
          <div class="container">            
          <div class="form-inline">
             
            <div class="form-group">
                <label class="bmd-label-floating" style= "color: #3F729B">Reference Number</label>
                <input class="form-control" type='text' name='qref' value="<?php echo $details->Ref; ?>"/>
            </div>   
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Quotation Number</label>
                <input class="form-control" type='text' name='qid' value="<?php echo $details->QuotationNumber; ?>" readonly />
            </div>   
            <div class="form-group" style="width: 10%">
                <label class="bmd-label-floating"style= "color: #3F729B">Month</label>
                <input class="form-control" type='text' name='qmonth' value="<?php echo $details->QMonth; ?>"/>
            </div>   
            <div class="form-group" style="width: 10%">
                <label class="bmd-label-floating"style= "color: #3F729B">Year</label>
                <input class="form-control" type='text' name='qyear' value="<?php echo $details->QYear; ?>"/>
            </div>
            <div class="form-group"style="width: 10%">
                <label class="bmd-label-floating"style= "color: #3F729B">Category</label>
                <input class="form-control" type='text'  name='qcategory' value="<?php echo $details->category; ?>"/>
            </div> 
            <div class="form-group" style="width: 10%">
                <label class="bmd-label-floating"style= "color: #3F729B">Revision Status</label>
                <input class="form-control" type='text' id='pr_name' name='qrev' value="<?php echo ++$details->REV; ?>" style="width: 80%"/>
            </div> 
    
            </div> 

            <div class="form-inline">
            
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Customer Name</label>
                <input class="form-control" type='text' id='pr_name' name='cname' value="<?php echo $details->CustomerName; ?>"/>
            </div>
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Customer RFQ</label>
                <input class="form-control" type='text' id='pr_name' name='crfq' value="<?php echo $details->CustomerRFQ; ?>"/>
            </div>
              <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Attn</label>
                <input class="form-control" type='text' id='pr_name' name='cattn' value="<?php echo $details->Attn; ?>"/>
            </div>          
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Designation</label>
                <input class="form-control" type='text' id='pr_name' name='cdesignation' value="<?php echo $details->Designation; ?>"/>
            </div>
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Location</label>
                <input class="form-control" type='text' id='pr_name' name='carea' value="<?php echo $details->Location; ?>"/>
            </div>
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Contact Number</label>
                <input class="form-control" type='text' id='pr_name' name='cnum' value="<?php echo $details->ContactNum; ?>"/>
            </div>
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Email Adress</label>
                <input class="form-control" type='text' id='pr_name' name='cemail' value="<?php echo $details->Email; ?>"/>
            </div>                     
            </div>

            <div class="form-inline">          
            <div class="form-group" style="width: 50%">
                <label class="bmd-label-floating"style= "color: #3F729B">Quotation Subject</label>
                <input class="form-control" type='text' name='qsubject' value="<?php echo $details->QuotationSubject; ?>" style="width: 100%"/>
            </div>  
            <div class="form-group"style="width: 50%">
                <label class="bmd-label-floating"style= "color: #3F729B">Shipping Terms</label>
                <input class="form-control" type='text' name='qterms' value="<?php echo $details->ShippingTerms; ?>" style="width: 100%"/>
            </div>
            </div>
            <div class="form-inline">   
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Delivery Period</label>
                <input class="form-control" type='text' name='dperiod' value="<?php echo $details->DeliveryPeriod; ?>"/>
            </div>
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Currency</label>
                <input class="form-control" type='text' name='currency' value="<?php echo $details->Currency; ?>"/>
            </div> 
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Payment Terms</label>
                <input class="form-control" type='text' name='pterms' value="<?php echo $details->PaymentTerms; ?>"/>
            </div> 
            &nbsp &nbsp 
            <div class="form-group" style="width: 20%">
                <label class="bmd-label-floating"style= "color: #3F729B">Issue Date</label>
              <input style="width: 100%" class="form-control" type='date' name='idate' value="<?php echo date('Y-m-d');?>"/>
            </div>  
            &nbsp &nbsp 
            <div class="form-group" style="width: 20%">
                <label class="bmd-label-floating"style= "color: #3F729B">Valid Till</label>
                <input style="width: 100%" class="form-control" type='date' name='validtill' value="<?php echo $details->ValidTill; ?>"/>
            </div> 
            </div>  
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Additional Notes</label>
                <textarea name="notes" class="form-control" id="exampleFormControlTextarea3" rows="3" style="width: 100%"><?php echo $details->AdditionalComments; ?>
                </textarea>
            </div>   
            </div> 


              <?php endforeach; ?>
              <table class="table table-bordered">
                <tr>
                    <th>
                    <input class='check_all' type='checkbox' style ='width: 10%'onclick="select_all()"/>
                    </th>
                    <!-- <th style ='width: 10%'>Sr.No</th> -->
                    <th>Description</th>
                    <th>Model</th>  
                    <th>Make</th>  
                    <th>Specs</th>  
                    <th>Unit</th>                                                     
                    <th>Quantity</th>                   
                    <th>Unit Price</th>                          
                    <th>Total</th>                          
                    </tr>
    <?php foreach ($items as $requisition):?>
        <tr role="row" class="odd">
          <td><input type='checkbox' class='chkbox'/></td>
          <td><input type="hidden" name="snumber[]" class="form-control" value="<?php echo $requisition->SrNo; ?>"> <textarea rows="4" type="text" name="pname[]" class="form-control"> <?php echo $requisition->Description; ?></textarea></td>
          <td><textarea rows="4" type="text" name="psize[]" class="form-control"><?php echo $requisition->Model; ?></textarea></td>
          <td><input type="text" name="scompany[]" class="form-control" value="<?php echo $requisition->make; ?>"></td>
          <td><input type="text" name="specs[]" class="form-control" value="<?php echo $requisition->specs; ?>"></td>
          <td><input type="text" name="unit[]" class="form-control" value="<?php echo $requisition->Unit; ?>"></td>
          <td><input type="text" name="qty[]" class="form-control" value="<?php echo $requisition->qty; ?>"></td>
          <td><input type="text" name="unitprice[]" class="form-control" value="<?php echo $requisition->UnitPrice; ?>"></td>
          <td><input type="text" name="total[]" class="form-control" value="<?php echo $requisition->TotalPrice; ?>"></td>                
        </tr>
      <?php endforeach; ?>

                    </table>
                      <button type="button" class='btn btn-danger delete'>- Delete</button>
                    <button type="button" class='btn btn-success addbtn' id="products">+ Add More</button>         
                    <br>
            <div class="form-inline">
            <div class="form-group" align="right" style="width: 25%">
                <label class="bmd-label-floating"style= "color: #3F729B">Grand Total</label>
                <input class="form-control" type='text' id="grandtotal" name="grandtotal" value="<?php echo $details->Totalprice_exc; ?>" readonly style="width: 98%"/>
            </div>
            <div class="form-group"style="width: 25%">
                <label class="bmd-label-floating"style= "color: #3F729B">GST %</label>
                <input class="form-control" type='text' id="gstp" name="gstp" value="<?php echo $details->Sale_tax; ?>" style="width: 98%"/>
            </div>
            <div class="form-group"style="width: 25%">
                <label class="bmd-label-floating"style= "color: #3F729B">GST Amount</label>
                <input class="form-control" type='text' id="gstamnt" name="gstamnt" value="<?php echo $details->Tax_amount; ?>" readonly style="width: 98%"/>
            </div>
              <div class="form-group"style="width: 25%">
                <label class="bmd-label-floating"style= "color: #3F729B">Grand Total Incl GST</label>
                <input class="form-control" type='text' id="grandtotaligst" name="grandtotaligst" value="<?php echo $details->Grand_total; ?>" readonly style="width: 98%"/>
            </div>
            </div>

            <div class="form-inline">            
                <div class="form-group"style="width: 50%">
                <label for="stype" style= "color: #3F729B">Prepared By:</label>
<select class="form-control" type="select" id="stype" required name="preparedby" style="width: 100%">                 <option value="<?php echo $details->PreparedBy; ?>"><?php echo $details->PreparedBy; ?></option>
                <option value="Naveed Ahmed(0333-4844561)">Naveed Ahmed (0333-4844561)</option>
                <option value="Kashif Shamsuddin(0321-4988683)">Kashif Shamsuddin (0321-4988683)</option>                                         
                </select>
                </div>
                <div class="form-group"style="width: 50%">
                <label for="stype" style= "color: #3F729B">Approved By:</label>
<select class="form-control" type="select" id="stype" required name="approvedby" style="width: 100%">                  <option value="<?php echo $details->ApprovedBy; ?>"><?php echo $details->ApprovedBy; ?></option>
                <option value="Kashif Shamsuddin(0321-4988683)">Kashif Shamsuddin (0321-4988683)</option>
                <option value="Naveed Ahmed(0333-4844561)">Naveed Ahmed (0333-4844561)</option>                                         
                </select>
                </div> 
              </div>
            <br>
            <br>
          
             <div align="center">
                <a href="{{action('QuotationController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised">Submit</button>
                </div>            
           </form>
            <br> 
            <br>
            <br>
            <br>
            <br>
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
// var balance = document.getElementById('country_code_1').value;
// var calcamount = document.getElementById('vr_amount').value;

// document.getElementById('r_balance').value = balance - calcamount;  
// document.getElementsByName('balance[]')[i].value = document.getElementById('r_balance').value;        
    }
}


 window.onbeforeunload = function() {
  return "Any Unsaved data will be lost if you leave the page, are you sure?";
  };

</script>      

       <!-- WORK AREA END -->  
          
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
  <?php  } else {  redirect()->to('home')->send(); } ?> 