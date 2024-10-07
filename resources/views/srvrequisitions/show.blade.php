@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->serviceview) && Auth::user()->serviceview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Service Requisition)</small>
          </h3>
          <br>
           <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='pr_number' value="<?php echo $details->srv_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                    <input class="form-control" type='text' name='updated_at' value="<?php echo $details->updated_at; ?>" readonly />
                </div>
              </div> 
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='pr_name' name='srv_name' value="<?php echo $details->srv_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Customer</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->srv_crname; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Customer ID</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->srv_crid; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Order #</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->srv_crorder; ?>" readonly/> 
                    </div>
                  <div class="form-inline">  
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Head</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->srv_head; ?>" style="width: 95%" readonly/> 
                    </div>
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Head ID</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->srv_headid; ?>" style="width: 95%" readonly/> 
                    </div>
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Description</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->srv_description; ?>" style="width: 95%" readonly/> 
                    </div>
                  </div>
                   
              </div>
              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="text-white" style="width: 164px;">ID</th>
                  <th class="text-white" style="width: 164px;">Item</th>
                  <th class="text-white" style="width: 83px;">Model</th>
                  <th class="text-white" style="width: 83px;">Quantity</th>
                  <th class="text-white" style="width: 29px;">Cost Price</th>
                  <th class="text-white" style="width: 29px;">Sale Price</th>
                  <th class="text-white" style="width: 29px;">Total Price</th>
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
                  <td><?php echo $requisition->srv_i_ID; ?></td>
                  <td><?php echo $requisition->srv_item; ?></td>
                  <td><?php echo $requisition->srv_model; ?></td>
                  <td><?php echo $requisition->srv_quantity; ?></td>
                  <td><?php echo $requisition->srv_costprice; ?></td>
                  <td><?php echo $requisition->srv_sup; ?></td>
                  <td><?php echo $requisition->srv_totalprice; ?></td>
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>

             <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Grand Total</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->srv_grandtotal; ?>" readonly/> 
                    </div>
             <?php 
              if(isset(Auth::user()->role) && Auth::user()->role == 'Admin')
                                     { ?>
            <form action="{{action('SrvinvoiceController@create', $details->srv_number)}}" method="get" align="center" 
              <?php if($requisition->srv_status=="1")  {echo "hidden";} else{} ?>>
                        <input type="hidden" name="srv_number" value="<?php echo $requisition->srv_number; ?>">
                        <button type="submit" class="btn btn-info">Make Invoice</button>
            </form>
             <?php } else {} ?>
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