@extends('master')
@section('content')
 <?php
  if(isset(Auth::user()->grossprofitview) && Auth::user()->grossprofitview == '1')
      { ?>
<!-- WORK AREA START -->
          <h3 align="center" class="text-primary">
            Products Ledger 
          </h3>
          <br>
          <?php foreach ($purchase as $purchase):?>
            <h4 class="text-rose"> <?php echo $purchase->ss_item; ?> </h4>
            <p class="text-rose"> <?php echo $purchase->ss_size; ?> </p>
            <p class="text-rose"> <?php echo $purchase->lot_number; ?> </p>
          <div class="form-group" align="right">
                    <a href="{{action('FarmerledgerController@printFl' , $purchase->ss_ID)}}" target="new" title="Print/PDF"> <i class="material-icons text-warning">local_printshop</i> </a> 
          </div>
          <?php endforeach; ?>  
          <h4 align="center">Sales</h4>
           <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                 <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-label="Office: activate to sort column ascending">Date</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-label="Office: activate to sort column ascending">Number</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Name: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Sale Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Total Price</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Date</th>
                  <th rowspan="1" colspan="1">Number</th>
                  <th rowspan="1" colspan="1">Quantity Sold</th>
                  <th rowspan="1" colspan="1">Sale Price</th>
                  <th rowspan="1" colspan="1">Total Price</th>
                </tr>
              </tfoot>
              <tbody>
                <?php $totalprice = 0;?>
                <?php $totalsold = 0;?>
                <?php $opening = 0; ?>
               <?php foreach ($sales as $sales):?>
                <tr role="row" class="odd">
                  <td> <?php echo $sales->created_at; ?> </td>
                  <td><?php echo $sales->sl_number; ?></td>
                  <td><?php echo $sales->sl_quantity; ?></td>
                  <td><?php $subtotal =  number_format($sales->sl_saleprice, 2, '.', ','); echo $subtotal; ?></td>
                        <?php $totalprice = $sales->sl_quantity * $sales->sl_saleprice;?> 
                  <td><?php $subtotal =  number_format($totalprice, 2, '.', ','); echo $subtotal; ?></td>     
                </tr>
                  <?php $totalsold += $sales->sl_quantity;?>
                 <?php endforeach; ?>  
                 <?php $opening = $sales->sl_quantity + $purchase->ss_quantity;?>
              </tbody>
            </table>
            <div>
            <label class="text-primary"> Opening Balance</label>
             <input type="text" name="totalsold" class="form-control" value="<?php echo $opening?>" readonly/> 
           </div>
            <div>
            <label class="text-primary"> Total Sold </label>
             <input type="text" name="totalsold" class="form-control" value="<?php echo $totalsold?>" readonly/> 
            </div>
            <div>
            <label class="text-primary">Remaining Quantity</label>
            <input class="form-control" type='text' value="<?php echo $purchase->ss_quantity; ?>" name='remaining' readonly /> 
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
       <!-- WORK AREA END -->  

 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>
