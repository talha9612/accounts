@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Purchase Order Import)</small>
          </h3>
          <br>
           <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='po_number' value="<?php echo $details->po_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                          <input class="form-control" type='text' name='updated_at' value="<?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?>" readonly />
                </div>
              </div> 
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='po_name' name='po_name' value="<?php echo $details->po_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->po_title; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier</label>
                          <input class="form-control" type='text' id='po_title' name='s_name' value="<?php echo $details->s_name; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier ID</label>
                          <input class="form-control" type='text' id='po_title' name='s_ID' value="<?php echo $details->s_ID; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier Company</label>
                          <input class="form-control" type='text' id='po_title' name='s_company' value="<?php echo $details->s_company; ?>" readonly/> 
                    </div>
                    <div class="form-group" align="right">
                    <a href="{{action('PorderController@printPoimport' , $details->po_number)}}" target="new" title="Print/PDF"> <i class="material-icons text-warning">local_printshop</i> </a> 
                    </div>
              </div>
              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Supplier/Make 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Item Name 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Model </th>
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Specifications </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Name: activate to sort column ascending">Description</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Unit Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Total Price</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Supplier/Make</th>
                  <th rowspan="1" colspan="1">Item Name</th>
                  <th rowspan="1" colspan="1">Model</th>
                  <th rowspan="1" colspan="1">Specifications</th>
                  <th rowspan="1" colspan="1">Description</th>
                  <th rowspan="1" colspan="1">Quantity</th>
                  <th rowspan="1" colspan="1">Unit Price</th>
                  <th rowspan="1" colspan="1">Total Price</th>
                </tr>
              </tfoot>
              <tbody>
               <?php foreach ($order as $order):?>
                <tr role="row" class="odd">
                  <td><?php echo $order->po_supplier; ?></td>
                  <td><?php echo $order->po_item; ?></td>
                  <td><?php echo $order->po_size; ?></td>
                  <td><?php echo $order->po_specs; ?></td>
                  <td><?php echo $order->po_description; ?></td>
                  <td>
                    <input type="text" name="po_quantity[]" class="form-control" value="<?php echo $order->po_quantity; ?>" readonly>
                  </td>
                  <td>
                    <input type="text" name="po_unitprice[]" class="form-control" value="<?php $subtotal =  number_format($order->po_unitprice, 2, '.', ',');
                    echo $subtotal; ?>" readonly>
                  </td>
                  <td>
                    <input type="text" name="total[]" class="form-control"  value="<?php $subtotal =  number_format($order->po_unitprice * $order->po_quantity, 2, '.', ',');
                    echo $subtotal; ?>" readonly>
                  </td>
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
            <br>

             <h5>Incoterm</h5>
                   <div class="radio">
                     <a style="text-decoration: none">
                      <i class="material-icons text-primary">autorenew</i>
                        <u><?php echo $order->po_itype; ?></u>
                      </a>

                  <label class="text-dark">
                    Amount
                   <input type="number" name="amounttype" value="<?php $subtotal =  number_format($order->po_iamount, 2, '.', ',');
                    echo $subtotal; ?>" readonly required>
                   </label>
                  </div>
                   <br>
             <h5>Currency</h5>
                   <div class="radio">
                     <a style="text-decoration: none">
                      <i class="material-icons text-primary">monetization_on</i>
                        <u><?php echo $order->po_currency; ?></u>
                      </a>
                  </div>     
                   <br>
            <table class="table table-bordered">     
                    <tr>
                    <th>Conversion Rate (PKR)</th>
                    <th>Total Value (<?php echo $order->po_currency; ?>)</th>
                    <th>Grand Total (PKR)</th>
                    </tr>
                
                  <tbody>
                    <tr>
                      <td><input type="text" class="form-control" id="co_rate" name="co_rate" value="<?php echo $order->po_conrate; ?>" readonly></td>
                      <td><input type="text" class="form-control" id='co_unit' name='co_unit' value="<?php $subtotal =  number_format($order->po_totalprice, 2, '.', ',');
                    echo $subtotal; ?>" readonly></td>
                      <td><input type="text" class="form-control" id='co_totalprice' name='co_totalprice' value="<?php $subtotal =  number_format($order->po_grandtotal, 2, '.', ',');
                    echo $subtotal; ?>" readonly></td>
                    </tr>
                  </tbody>
                  
                </table>     

              <form action="{{action('GateinwardController@create', $details->po_number)}}" method="get" align="center" <?php if($order->po_status == 1) {echo "hidden";} else {echo "";} ?>>
                        <input type="hidden" name="po_number" value="<?php echo $details->po_number; ?>">
                        <button type="submit" class="btn btn-info">Inward Gate Pass</button>
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
