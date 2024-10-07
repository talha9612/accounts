@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->cancelledordersview) && Auth::user()->cancelledordersview == '1')
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
                <input class="form-control" type='text' name='qid' value="<?php echo $details->QuotationNumber; ?>" />
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
                <input style="width: 100%" class="form-control" type='text' name='idate' value="<?php echo $details->IssueDate; ?>"/>
            </div>  
            &nbsp &nbsp 
            <div class="form-group" style="width: 20%">
                <label class="bmd-label-floating"style= "color: #3F729B">Valid Till</label>
                <input style="width: 100%" class="form-control" type='text' name='validtill' value="<?php echo $details->ValidTill; ?>"/>
            </div> 
            </div>  
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Additional Notes</label>
                <textarea name="notes" class="form-control" id="exampleFormControlTextarea3" rows="3" style="width: 100%"><?php echo $details->AdditionalComments; ?>
                </textarea>
            </div>   

            </div> 


              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead style="background-color:#3F729B">
                <tr role="row">
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">Description 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Position: activate to sort column ascending">Model 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Make</th>
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Specs</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-label="Name: activate to sort column ascending">Unit</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 35px;" aria-label="Details: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-label="Details: activate to sort column ascending">Unit Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-label="Details: activate to sort column ascending">Total</th>
                </tr>
              </thead>
              <tfoot style="background-color:#3F729B">
                <tr>
                  <th rowspan="1" colspan="1">Description</th>
                  <th rowspan="1" colspan="1">Model</th>                
                  <th rowspan="1" colspan="1">Make</th>
                  <th rowspan="1" colspan="1">Specs</th>
                  <th rowspan="1" colspan="1">Unit</th>
                  <th rowspan="1" colspan="1">Quantity</th>
                  <th rowspan="1" colspan="1">Unit Price</th>
                  <th rowspan="1" colspan="1">Total</th>
                </tr>
              </tfoot>
              <tbody>
    <?php foreach ($items as $requisition):?>
        <tr role="row" class="odd">
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
      </tbody>
      </table>
            
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
                <option value="Naveed Ahmad(0333-4844561)">Naveed Ahmed (0333-4844561)</option>
                <option value="Kashif Shamdsuddin(0321-4988683)">Kashif Shamsuddin (0321-4988683)</option>                                         
                </select>
                </div>
                <div class="form-group"style="width: 50%">
                <label for="stype" style= "color: #3F729B">Approved By:</label>
<select class="form-control" type="select" id="stype" required name="approvedby" style="width: 100%">                  <option value="<?php echo $details->ApprovedBy; ?>"><?php echo $details->ApprovedBy; ?></option>
                <option value="Kashif Shamdsuddin(0321-4988683)">Kashif Shamsuddin (0321-4988683)</option>
                <option value="Naveed Ahmad(0333-4844561)">Naveed Ahmed (0333-4844561)</option>                                         
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