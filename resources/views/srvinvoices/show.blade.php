@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->serviceview) && Auth::user()->serviceview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Service Invoice)</small>
          </h3>
          <br>
           <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='pr_number' value="<?php echo $details->svi_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                          <input class="form-control" type='text' name='updated_at' value="<?php echo $details->updated_at; ?>" readonly />
                </div>
              </div> 
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='pr_name' name='srv_name' value="<?php echo $details->svi_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Customer</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_crname; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Customer ID</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_crid; ?>" readonly/> 
                    </div>
                    
                   <div class="form-inline"> 
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Order #</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_crorder; ?>" style="width: 99%" readonly/> 
                    </div>

                    <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Sale Number</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_slnumber; ?>" style="width: 99%" readonly/> 
                    </div>
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Sale Total</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_sltotal; ?>" style="width: 99%" readonly/> 
                    </div>
                   </div> 

                   <div class="form-inline"> 
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Head</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_head; ?>" style="width: 99%" readonly/> 
                    </div>
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Head ID</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_headid; ?>" style="width: 99%" readonly/> 
                    </div>
                      <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Head Balance</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_headbalance; ?>" style="width: 99%" readonly/> 
                    </div>
                   </div> 
              </div>
              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting text-white" style="width: 164px;">ID</th>
                  <th class="sorting text-white" style="width: 164px;">Item</th>
                  <th class="sorting text-white" style="width: 83px;">Model</th>
                  <th class="sorting text-white" style="width: 83px;">Quantity</th>
                  <th class="sorting text-white" style="width: 29px;">Cost Price</th>
                  <th class="sorting text-white" style="width: 29px;" >Sale Price</th>
                  <th class="sorting text-white" style="width: 29px;">Total Price</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th>ID</th>
                  <th>Item</th>
                  <th>Model</th>
                  <th>Quantity</th>
                  <th>Cost Price</th>
                  <th>Sale Price</th>
                  <th>Total Price</th>
                </tr>
              </tfoot>
              <tbody>
               <?php foreach ($requisition as $requisition):?>
                <tr>
                  <td><?php echo $requisition->svi_i_ID; ?></td>
                  <td><?php echo $requisition->svi_item; ?></td>
                  <td><?php echo $requisition->svi_model; ?></td>
                  <td><?php echo $requisition->svi_quantity; ?></td>
                  <td><?php echo $requisition->svi_costprice; ?></td>
                  <td><?php echo $requisition->svi_sup; ?></td>
                  <td><?php echo $requisition->svi_totalprice; ?></td>
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
            <br>
            <div class="form-group">
                          <label for="bk_branch_code" class="text-primary">Tax Deducted by Customer</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_tax; ?>" readonly/> 
                    </div>
             <div class="form-group">
                          <label for="bk_branch_code" class="text-primary">Grand Total</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->svi_grandtotal; ?>" readonly/> 
                    </div>
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