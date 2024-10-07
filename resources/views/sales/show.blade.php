@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Sale)</small>
          </h3>
          <br>
           <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='po_number' value="<?php echo $details->sl_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                          <input class="form-control" type='text' name='updated_at' value="<?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?>" readonly />
                </div>
              </div> 
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='po_name' name='po_name' value="<?php echo $details->sl_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->sl_title; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Customer Name</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->fr_name; ?>" readonly/> 
                    </div>
                     <div class="form-group" align="right">
                    <a href="{{action('SaleController@printSl' , $details->sl_number)}}" target="new" title="Print/PDF"> <i class="material-icons text-warning">local_printshop</i> </a> 
                    </div>
                          
             
              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Item Name 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Size </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Sale Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Total</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Total Prcie</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Item Name</th>
                  <th rowspan="1" colspan="1">Size</th>
                  <th rowspan="1" colspan="1">Quantity</th>
                  <th rowspan="1" colspan="1">Sale Price</th>
                  <th rowspan="1" colspan="1">Total</th>
                  <th rowspan="1" colspan="1">Total Price</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                $grandtotal = 0; 
                ?>
               <?php foreach ($pass as $pass):?>
                <tr role="row" class="odd">
                  <td><?php echo $pass->sl_item; ?></td>
                  <td><?php echo $pass->sl_size; ?></td>
                  <td><?php echo $pass->sl_quantity; ?></td>
                  <td><?php $subtotal =  number_format($pass->sl_saleprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sl_total, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sl_totalprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                    <?php $grandtotal += $pass->sl_totalprice; ?>
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
          <div>
            <br>
            <label class="text-primary">Grand Total</label>
            <input type="text" name="gandtotal" class="form-control"  value="<?php $subtotal =  number_format($grandtotal, 2, '.', ',');
                    echo $subtotal; ?>" readonly>
          </div>


            
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