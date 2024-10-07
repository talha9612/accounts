@extends('master')
<style type="text/css">
button {
/*  width: 100px;
  height: 35px;
  background: red;
  -webkit-transition: width 2s; /* For Safari 3.1 to 6.0 */
  /*transition: width 2s;*/*/
}

button:hover {
 /* width: 200px;*/
}
</style>
@section('content')
<?php
  if(isset(Auth::user()->quotesview) && Auth::user()->quotesview == '1')
      { ?>

<!-- WORK AREA START -->
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
    <?php foreach ($records as $details):?>
            <div class="form-group" align="right" >
            <form method="post" action="{{url('quotes')}}">
                  {{csrf_field()}}
                <input type="hidden" name="qprint" value="1">
                <input type="hidden" name="printnumber" value="<?php echo $details->QuotationNumber; ?>">
                <input type="hidden" name="printrev" value="<?php echo $details->REV; ?>">
                <label class="text-primary">Print Quote</label>
                <button type="submit" class="material-icons btn-primary" style="border-radius: 6px;border-color: black" title="Print Quote">local_printshop</button>
            </form> 
            </div> 

            <h3 align="center" style= "color: #3F729B">
            View Quote
            </h3>
            <br>
            <form method="post" action="{{url('orders')}}">
            {{csrf_field()}}        
            <div class="container">            
            <div class="form-inline">            
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating" style= "color: #3F729B">Reference Number</label>
                <input class="form-control" type='text' name='qref' value="<?php echo $details->Ref; ?>" readonly/>
            </div>   
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Quotation Number</label>
                <input class="form-control" type='text' name='qid' value="<?php echo $details->QuotationNumber; ?>"  readonly/>
            </div>   
            <div class="form-group" style="width: 10%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Month</label>
                <input class="form-control" type='text' name='qmonth' value="<?php echo $details->QMonth; ?>" readonly/>
            </div>   
            <div class="form-group" style="width: 10%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Year</label>
                <input class="form-control" type='text' name='qyear' value="<?php echo $details->QYear; ?>" readonly/>
            </div>
            <div class="form-group"style="width: 10%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Category</label>
                <input class="form-control" type='text' name='qcategory' name='pr_name' value="<?php echo $details->category; ?>" readonly/>
            </div> 
            <div class="form-group" style="width: 10%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Revision Status</label>
                <input class="form-control" type='text' name='qrev' value="<?php echo $details->REV; ?>" style="width: 80%" readonly/>
            </div>  
          
            </div> 
            
            <div class="form-inline">            
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Customer Name</label>
                <input class="form-control" type='text' name='cname' value="<?php echo $details->CustomerName; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Customer RFQ</label>
                <input class="form-control" type='text' name='crfq' value="<?php echo $details->CustomerRFQ; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Attn</label>
                <input class="form-control" type='text' name='cattn' value="<?php echo $details->Attn; ?>" readonly/>
            </div>          
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Designation</label>
                <input class="form-control" type='text' name='cdesignation' value="<?php echo $details->Designation; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Location</label>
                <input class="form-control" type='text' name='carea' value="<?php echo $details->Location; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Contact Number</label>
                <input class="form-control" type='text' name='cnum' value="<?php echo $details->ContactNum; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Email Adress</label>
                <input class="form-control" type='text' name='cemail' value="<?php echo $details->Email; ?>" readonly/>
            </div>                     
            </div>

            <div class="form-inline">          
            <div class="form-group" style="width: 50%">
                <label class="bmd-label-floating"style= "color: #3F729B">Quotation Subject</label>
                <input class="form-control" type='text' name='qsubject' value="<?php echo $details->QuotationSubject; ?>" style="width: 100%" readonly/>
            </div>  
            <div class="form-group"style="width: 50%">
                <label class="bmd-label-floating"style= "color: #3F729B">Shipping Terms</label>
                <input class="form-control" type='text' name='qterms' value="<?php echo $details->ShippingTerms; ?>" style="width: 100%" readonly/>
            </div>
            </div>
             <div class="form-inline">   
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Delivery Period</label>
                <input class="form-control" type='text' name='dperiod' value="<?php echo $details->DeliveryPeriod; ?>" readonly/>
            </div>
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Currency</label>
                <input class="form-control" type='text' name='currency' value="<?php echo $details->Currency; ?>" readonly/>
            </div> 
            <div class="form-group"style="width: 60%">
                <label class="bmd-label-floating"style= "color: #3F729B">Payment Terms</label>
                <input style="width: 100%" class="form-control" type='text' name='pterms' value="<?php echo $details->PaymentTerms; ?>" readonly/>
            </div> 
          </div>
          <div class="form-inline">          
            <div class="form-group" style="width: 20%">
                <label class="bmd-label-floating"style= "color: #3F729B">Issue Date</label>
                <input style="width: 100%" class="form-control" type='text' name='idate' value="<?php echo $details->IssueDate; ?>" readonly/>
            </div>  
            &nbsp &nbsp 
            <div class="form-group" style="width: 20%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Valid Till</label>
                <input style="width: 100%" class="form-control" type='text' name='validtill' value="<?php echo $details->ValidTill; ?>" readonly/>
            </div> 
            </div>  
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Additional Notes</label>
                <textarea name="notes" class="form-control" id="exampleFormControlTextarea3" rows="3" style="width: 100%" readonly=""><?php echo $details->AdditionalComments; ?>
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
                  <th style="color:white" rowspan="1" colspan="1">Description</th>
                  <th style="color:white" rowspan="1" colspan="1">Model</th>                
                  <th style="color:white" rowspan="1" colspan="1">Make</th>
                  <th style="color:white" rowspan="1" colspan="1">Specs</th>
                  <th style="color:white" rowspan="1" colspan="1">Unit</th>
                  <th style="color:white" rowspan="1" colspan="1">Quantity</th>
                  <th style="color:white" rowspan="1" colspan="1">Unit Price</th>
                  <th style="color:white" rowspan="1" colspan="1">Total</th>
                </tr>
              </tfoot>
    <tbody>
    <?php foreach ($items as $requisition):?>
    <tr role="row" class="odd">
      <td>
        <input type="hidden" name="snumber[]" class="form-control" value="<?php echo $requisition->SrNo; ?>">

        <textarea rows="5" readonly type="text" name="pname[]" class="form-control"> <?php echo $requisition->Description; ?>
          </textarea>
      </td>
      <td>
        <textarea rows="5" readonly type="text" name="psize[]" class="form-control"><?php echo $requisition->Model; ?></textarea>
      </td>
      <td>
        <input type="text" rows="5" readonly name="scompany[]" class="form-control" value="<?php echo $requisition->make; ?>">
      </td>
      <td>
        <input type="text" rows="5" readonly name="specs[]" class="form-control" value="<?php echo $requisition->specs; ?>">
      </td>
      <td>
        <input type="text" rows="5" readonly name="unit[]" class="form-control" value="<?php echo $requisition->Unit; ?>">
      </td>
      <td><input type="text" rows="5" readonly name="qty[]" class="form-control" value="<?php echo $requisition->qty; ?>"></td>
      <td>
        <input type="text" rows="5" readonly name="unitprice[]" class="form-control" value="<?php echo $requisition->UnitPrice; ?>">
      </td>
      <td>
        <input type="text" rows="5" readonly name="total[]" class="form-control" value="<?php echo $requisition->TotalPrice; ?>">
      </td>                
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
            
            <div class="form-inline">
            <div class="form-group" align="right" style="width: 25%">
                <label class="bmd-label-floating"style= "color: #3F729B">Grand Total</label>
                <input class="form-control" type='text' id="grandtotal" name="grandtotal" value="<?php echo $details->Totalprice_exc; ?>" style="width: 98%" readonly/>
            </div>
            <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">GST %</label>
                <input class="form-control" type='text' id="gstp" name="gstp" value="<?php echo $details->Sale_tax; ?>" style="width: 98%" readonly/>
            </div>
            <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">GST Amount</label>
                <input class="form-control" type='text' id="gstamnt" name="gstamnt" value="<?php echo $details->Tax_amount; ?>" style="width: 98%" readonly/>
            </div>
              <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Grand Total Incl GST</label>
                <input class="form-control" type='text' id="grandtotaligst" name="grandtotaligst" value="<?php echo $details->Grand_total; ?>" style="width: 98%" readonly/>
            </div>
            </div>
            <br>
            <br>      
        <div class="form-group" align="center">
          <!-- <button type="submit" disabled class="btn btn-warning">Order Cancelled</button> -->
          <button type="submit" class="btn btn-info">Order Recieved</button>
        </div>

          </form>
   
          <!-- Hinnden Items for Cancelled Orders -->
          <!-- Hinnden Items for Cancelled Orders -->
          <!-- Hinnden Items for Cancelled Orders -->
          <!-- Hinnden Items for Cancelled Orders -->
          <!-- Hinnden Items for Cancelled Orders -->
          <!-- Hinnden Items for Cancelled Orders -->
          <!-- Hinnden Items for Cancelled Orders -->
          <!-- Hinnden Items for Cancelled Orders -->

    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
    <?php foreach ($records as $details):?>
      <form method="post" action="{{url('cnorders')}}">
          {{csrf_field()}}
        
          <div class="container" hidden>            
          <div class="form-inline">            
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating" style= "color: #3F729B">Reference Number</label>
                <input class="form-control" type='text' name='qref' value="<?php echo $details->Ref; ?>" readonly/>
            </div>   
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Quotation Number</label>
                <input class="form-control" type='text' name='qid' value="<?php echo $details->QuotationNumber; ?>"  readonly/>
            </div>   
            <div class="form-group" style="width: 10%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Month</label>
                <input class="form-control" type='text' name='qmonth' value="<?php echo $details->QMonth; ?>" readonly/>
            </div>   
            <div class="form-group" style="width: 10%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Year</label>
                <input class="form-control" type='text' name='qyear' value="<?php echo $details->QYear; ?>" readonly/>
            </div>
            <div class="form-group"style="width: 10%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Category</label>
                <input class="form-control" type='text' name='qcategory' name='pr_name' value="<?php echo $details->category; ?>" readonly/>
            </div> 
            <div class="form-group" style="width: 10%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Revision Status</label>
                <input class="form-control" type='text' name='qrev' value="<?php echo $details->REV; ?>" style="width: 80%" readonly/>
            </div>  
          
            </div> 
            
            <div class="form-inline">            
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Customer Name</label>
                <input class="form-control" type='text' name='cname' value="<?php echo $details->CustomerName; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Customer RFQ</label>
                <input class="form-control" type='text' name='crfq' value="<?php echo $details->CustomerRFQ; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Attn</label>
                <input class="form-control" type='text' name='cattn' value="<?php echo $details->Attn; ?>" readonly/>
            </div>          
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Designation</label>
                <input class="form-control" type='text' name='cdesignation' value="<?php echo $details->Designation; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Location</label>
                <input class="form-control" type='text' name='carea' value="<?php echo $details->Location; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Contact Number</label>
                <input class="form-control" type='text' name='cnum' value="<?php echo $details->ContactNum; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Email Adress</label>
                <input class="form-control" type='text' name='cemail' value="<?php echo $details->Email; ?>" readonly/>
            </div>                     
            </div>

            <div class="form-inline">          
            <div class="form-group" style="width: 50%">
                <label class="bmd-label-floating"style= "color: #3F729B">Quotation Subject</label>
                <input class="form-control" type='text' name='qsubject' value="<?php echo $details->QuotationSubject; ?>" style="width: 100%" readonly/>
            </div>  
            <div class="form-group"style="width: 50%">
                <label class="bmd-label-floating"style= "color: #3F729B">Shipping Terms</label>
                <input class="form-control" type='text' name='qterms' value="<?php echo $details->ShippingTerms; ?>" style="width: 100%" readonly/>
            </div>
            </div>
             <div class="form-inline">   
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Delivery Period</label>
                <input class="form-control" type='text' name='dperiod' value="<?php echo $details->DeliveryPeriod; ?>" readonly/>
            </div>
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Currency</label>
                <input class="form-control" type='text' name='currency' value="<?php echo $details->Currency; ?>" readonly/>
            </div> 
            <div class="form-group"style="width: 60%">
                <label class="bmd-label-floating"style= "color: #3F729B">Payment Terms</label>
                <input style="width: 100%" class="form-control" type='text' name='pterms' value="<?php echo $details->PaymentTerms; ?>" readonly/>
            </div> 
          </div>
          <div class="form-inline">          
            <div class="form-group" style="width: 20%">
                <label class="bmd-label-floating"style= "color: #3F729B">Issue Date</label>
                <input style="width: 100%" class="form-control" type='text' name='idate' value="<?php echo $details->IssueDate; ?>" readonly/>
            </div>  
            &nbsp &nbsp 
            <div class="form-group" style="width: 20%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Valid Till</label>
                <input style="width: 100%" class="form-control" type='text' name='validtill' value="<?php echo $details->ValidTill; ?>" readonly/>
            </div> 
            </div>  
            <div class="form-group">
                <label class="bmd-label-floating"style= "color: #3F729B">Additional Notes</label>
                <textarea name="notes" class="form-control" id="exampleFormControlTextarea3" rows="3" style="width: 100%" readonly=""><?php echo $details->AdditionalComments; ?>
                </textarea>
            </div>   
            </div> 

              <?php endforeach; ?>
           <table hidden class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
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
                  <th style="color:white" rowspan="1" colspan="1">Description</th>
                  <th style="color:white" rowspan="1" colspan="1">Model</th>                
                  <th style="color:white" rowspan="1" colspan="1">Make</th>
                  <th style="color:white" rowspan="1" colspan="1">Specs</th>
                  <th style="color:white" rowspan="1" colspan="1">Unit</th>
                  <th style="color:white" rowspan="1" colspan="1">Quantity</th>
                  <th style="color:white" rowspan="1" colspan="1">Unit Price</th>
                  <th style="color:white" rowspan="1" colspan="1">Total</th>
                </tr>
              </tfoot>
    <tbody>
    <?php foreach ($items as $requisition):?>
    <tr role="row" class="odd">
      <td>
        <input type="hidden" name="snumber[]" class="form-control" value="<?php echo $requisition->SrNo; ?>">

        <textarea rows="5" readonly type="text" name="pname[]" class="form-control"> <?php echo $requisition->Description; ?>
          </textarea>
      </td>
      <td>
        <textarea rows="5" readonly type="text" name="psize[]" class="form-control"><?php echo $requisition->Model; ?></textarea>
      </td>
      <td>
        <input type="text" rows="5" readonly name="scompany[]" class="form-control" value="<?php echo $requisition->make; ?>">
      </td>
      <td>
        <input type="text" rows="5" readonly name="specs[]" class="form-control" value="<?php echo $requisition->specs; ?>">
      </td>
      <td>
        <input type="text" rows="5" readonly name="unit[]" class="form-control" value="<?php echo $requisition->Unit; ?>">
      </td>
      <td><input type="text" rows="5" readonly name="qty[]" class="form-control" value="<?php echo $requisition->qty; ?>"></td>
      <td>
        <input type="text" rows="5" readonly name="unitprice[]" class="form-control" value="<?php echo $requisition->UnitPrice; ?>">
      </td>
      <td>
        <input type="text" rows="5" readonly name="total[]" class="form-control" value="<?php echo $requisition->TotalPrice; ?>">
      </td>                
    </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
            
            <div class="form-inline" hidden>
            <div class="form-group" align="right" style="width: 25%">
                <label class="bmd-label-floating"style= "color: #3F729B">Grand Total</label>
                <input class="form-control" type='text' id="grandtotal" name="grandtotal" value="<?php echo $details->Totalprice_exc; ?>" style="width: 98%" readonly/>
            </div>
            <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">GST %</label>
                <input class="form-control" type='text' id="gstp" name="gstp" value="<?php echo $details->Sale_tax; ?>" style="width: 98%" readonly/>
            </div>
            <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">GST Amount</label>
                <input class="form-control" type='text' id="gstamnt" name="gstamnt" value="<?php echo $details->Tax_amount; ?>" style="width: 98%" readonly/>
            </div>
              <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Grand Total Incl GST</label>
                <input class="form-control" type='text' id="grandtotaligst" name="grandtotaligst" value="<?php echo $details->Grand_total; ?>" style="width: 98%" readonly/>
            </div>
            </div>
              
        <div class="form-group" align="center">
          <button type="submit" style="visibility: visible;" class="btn btn-warning">Quotation Cancelled</button>
        
        </div>

          </form>
          <!-- Hinnden Items for Cancelled Orders -->


        

       <!-- WORK AREA END -->  
          
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
  <?php  } else {  redirect()->to('home')->send(); } ?> 
