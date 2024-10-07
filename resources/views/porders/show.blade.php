@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Purchase Order)</small>
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
                    <a href="{{action('PorderController@printPo' , $details->po_number)}}" target="new" title="Print/PDF"> <i class="material-icons text-warning">local_printshop</i> </a> 
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
                    <span style="display: none"><?php echo $order->po_quantity; ?></span>
                  </td>
                  <td>
                    <input type="text" name="po_unitprice[]" class="form-control" value="<?php echo $order->po_unitprice; ?>" readonly>
                    <span style="display: none"><?php echo $order->po_unitprice; ?></span>
                  </td>
                  <td>
                    <input type="text" name="total[]" class="form-control" readonly>
                    <span style="display: none" name=""></span>
                  </td>
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
             <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Total Price</label>
                          <input class="form-control" type='text' name='vr_amount' id="vr_amount"  readonly/>
              </div>

            <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">GST %</label>
                          <input class="form-control" type='text' name='po_gstp' id="po_gstp" value="<?php $subtotal =  number_format($order->po_gstp, 2, '.', ',');
                    echo $subtotal; ?>"  readonly/>
              </div>
               <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">GST Amount</label>
                          <input class="form-control" type='text' name='po_gst' id="po_gst" value="<?php $subtotal =  number_format($order->po_gst, 2, '.', ',');
                    echo $subtotal; ?>"  readonly/>
              </div>

               <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Grand Total</label>
                          <input class="form-control" type='text' name='po_gstp' id="po_gstp" value="<?php $subtotal =  number_format($order->po_grandtotal, 2, '.', ',');
                    echo $subtotal; ?>"  readonly/>
              </div>

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


<script type="text/javascript">
//FOR CALCULATION OF UNIT PRICE AND TOTAL PRICE
    var quantity = document.getElementsByName('po_quantity[]');
    var unitprice = document.getElementsByName('po_unitprice[]');
    var arr = document.getElementsByName('total[]');
    var tot= 0;
    for(var k=0;k<unitprice.length;k++){
        if(parseFloat(unitprice[k].value))
        tot = parseFloat(unitprice[k].value);   
 arr[k].value += tot * parseFloat(quantity[k].value);     
    }

  // FOR DISPLAY OF COMMA SEPRATED VALUES
 var pricearr = document.getElementsByName('total[]');
    var tot=0;
    for(var i=0;i<pricearr.length;i++){
        if(parseFloat(pricearr[i].value))
            tot += parseFloat(pricearr[i].value);
    }
tot = tot.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");    
document.getElementById('vr_amount').value = tot;
    

var xarr = document.getElementsByName('total[]');
    for(var j=0;j<xarr.length;j++){
      var b = xarr[j].value;
      b = b.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementsByName('total[]')[j].value = b;   
    }

var yarr = document.getElementsByName('po_unitprice[]');
    for(var k=0;k<yarr.length;k++){
      var c = yarr[k].value;
      c = c.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementsByName('po_unitprice[]')[k].value = c;     
    }    

</script> 
            
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>