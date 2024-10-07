@extends('master')
<style type="text/css">
button {
  width: 100px;
  height: 35px;
  background: red;
  -webkit-transition: width 2s; /* For Safari 3.1 to 6.0 */
  transition: width 2s;
}

button:hover {
  width: 200px;
}
</style>
@section('content')
<?php
  if(isset(Auth::user()->cancelledordersview) && Auth::user()->cancelledordersview == '1')
      { ?>
<!-- WORK AREA START -->

           <h3 align="center" style= "color: #3F729B">
            View Cancelled Order
          </h3>
          <br>
          <form method="post" action="{{url('quotes')}}">
           <?php foreach ($records as $details):?>
          <div class="container">            
          <div class="form-inline">            
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating" style= "color: #3F729B">Reference Number</label>
                <input class="form-control" type='text' name='pr_number' value="<?php echo $details->Ref; ?>" readonly/>
            </div>   
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Quotation Number</label>
                <input class="form-control" type='text' name='pr_number' value="<?php echo $details->QuotationNumber; ?>"  readonly/>
            </div>   
            <div class="form-group" style="width: 10%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Month</label>
                <input class="form-control" type='text' name='pr_number' value="<?php echo $details->QMonth; ?>" readonly/>
            </div>   
            <div class="form-group" style="width: 10%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Year</label>
                <input class="form-control" type='text' name='pr_number' value="<?php echo $details->QYear; ?>" readonly/>
            </div>
            <div class="form-group"style="width: 10%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Category</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->category; ?>" readonly/>
            </div> 
            <div class="form-group" style="width: 10%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Revision Status</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->REV; ?>" style="width: 80%" readonly/>
            </div>  
           
            </div> 
            
            <div class="form-inline">            
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Customer Name</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->CustomerName; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Customer RFQ</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->CustomerRFQ; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Attn</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->Attn; ?>" readonly/>
            </div>          
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Designation</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->Designation; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Location</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->Location; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Contact Number</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->ContactNum; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Email Adress</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->Email; ?>" readonly/>
            </div>                     
            </div>

            <div class="form-inline">          
            <div class="form-group" style="width: 50%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Quotation Subject</label>
                <input class="form-control" type='text' name='pr_number' value="<?php echo $details->QuotationSubject; ?>" style="width: 100%" readonly/>
            </div>  
            <div class="form-group"style="width: 50%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Shipping Terms</label>
                <input class="form-control" type='text' name='pr_number' value="<?php echo $details->ShippingTerms; ?>" style="width: 100%" readonly/>
            </div>
            </div>
             <div class="form-inline">   
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Delivery Period</label>
                <input class="form-control" type='text' name='pr_number' value="<?php echo $details->DeliveryPeriod; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Currency</label>
                <input class="form-control" type='text' name='pr_number' value="<?php echo $details->Currency; ?>" readonly/>
            </div> 
            <div class="form-group"style="width: 60%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Payment Terms</label>
                <input style="width: 100%" class="form-control" type='text' name='pr_number' value="<?php echo $details->PaymentTerms; ?>" readonly/>
            </div> 
          </div>
          <div class="form-inline">          
            <div class="form-group" style="width: 20%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Issue Date</label>
                <input style="width: 100%" class="form-control" type='text' name='pr_number' value="<?php echo $details->IssueDate; ?>" readonly/>
            </div>  
            &nbsp &nbsp 
            <div class="form-group" style="width: 20%">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Valid Till</label>
                <input style="width: 100%" class="form-control" type='text' name='pr_number' value="<?php echo $details->ValidTill; ?>" readonly/>
            </div> 
            </div>  
            <div class="form-group">
                <label for="pr_number" class="bmd-label-floating"style= "color: #3F729B">Additional Notes</label>
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
                  <td><?php echo $requisition->Description; ?></td>
                  <td><?php echo $requisition->Model; ?></td>
                  <td><?php echo $requisition->make; ?></td>
                  <td><?php echo $requisition->specs; ?></td>
                  <td><?php echo $requisition->Unit; ?></td>
                  <td><?php echo $requisition->qty; ?></td>
                  <td><?php echo $requisition->UnitPrice; ?></td>
                  <td><?php echo $requisition->TotalPrice; ?></td>                
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
            
            <div class="form-inline">
            <div class="form-group" align="right" style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Grand Total</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->Totalprice_exc; ?>" style="width: 98%" readonly/>
            </div>
            <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">GST %</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->Sale_tax; ?>" style="width: 98%" readonly/>
            </div>
            <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">GST Amount</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->Tax_amount; ?>" style="width: 98%" readonly/>
            </div>
              <div class="form-group"style="width: 25%">
                <label for="bk_name" class="bmd-label-floating"style= "color: #3F729B">Grand Total Incl GST</label>
                <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->Grand_total; ?>" style="width: 98%" readonly/>
            </div>
            </div>
            <br>
            <br>
            <br> 
            <br>
            <br>
            <br>
            <br>
           
  
        

       <!-- WORK AREA END -->  
          
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 

 <?php  } else {  redirect()->to('home')->send(); } ?> 