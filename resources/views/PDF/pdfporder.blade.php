<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($details as $details):?>
  <title>Purchase Order <?php echo $details->po_number; ?></title>

  <style>
    @include('PDF.style')
  </style>
</head>
<body>
  <div style="width: 800px">
   <div>
  <img src="{{asset('images/star.png')}}" style="background-color: white;" width="120px" height="80px">
  <div style="float: right;margin-right: 80px;font-size: 16px;margin-top: 25px"><?php echo $details->po_number; ?></div>
  </div>
  <br>
<header class="clearfix">
  <h3>Purchase Order (Local)</h3>
   <div style="font-size: 12px;"><?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?></div>
  <div style="font-size: 13px;"> <?php echo $details->po_title; ?></div>
  <div style="font-size: 12px;"><b> Attn: </b>  <?php echo $details->s_name; ?></div>
  <div style="font-size: 12px;"><b> Company: </b>  <?php echo $details->s_company; ?></div>
   <?php endforeach; ?>
</header>
<hr>
 
 <table style="padding-top: 40px">

                <thead>
                <tr style="font-size: 12px;">
                  <th style="text-align: left"><b>Supplier/Make</b></th>
                  <th style="text-align: left"><b>Item</b></th>
                  <th><b>Model </b></th>
                  <th><b>Specs </b></th>
                  <th><b>Description </b></th>
                  <th><b>Qty</b></th>
                  <th><b>Unit Price</b></th>
                </tr>
                </thead>
                <tbody>
               <?php foreach ($pass as $pass):?>
                <tr>
                  <td style="text-align: left"><?php echo $pass->po_supplier; ?></td>
                  <td style="text-align: left"><?php echo $pass->po_item; ?></td>
                  <td><?php echo $pass->po_size; ?></td>
                  <td><?php echo $pass->po_specs; ?></td>
                  <td><?php echo $pass->po_description; ?></td>
                  <td><?php echo $pass->po_quantity; ?></td>
                  <td><?php $subtotal =  number_format($pass->po_unitprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                </tr>
                </tbody>
              <?php endforeach; ?>
    </table>

    <table>
      <tr>
         <td>
          <label><b>Total Price</b>
             Rs:<?php $subtotal =  number_format($pass->po_totalprice, 2, '.', ',');
            echo $subtotal; ?>/-</label>
        </td>
        <td>
          <label><b>GST %</b>
             Rs:<?php $subtotal =  number_format($pass->po_gstp, 2, '.', ',');
            echo $subtotal; ?>/-</label>
        </td>
         <td>
          <label><b>GST Amount</b>
             Rs:<?php $subtotal =  number_format($pass->po_gst, 2, '.', ',');
            echo $subtotal; ?>/-</label>
        </td>
        </tr>
        <tr>
         <td style="background-color: silver" colspan="3">
          <label><b>Grand Total</b>
             Rs:<?php $subtotal =  number_format($pass->po_grandtotal, 2, '.', ',');
            echo $subtotal; ?>/-</label>
        </td>
      </tr>
    </table>

</div>
      <br>
       <br>
        <br>
         <br>
          <br>
           <br>
            <br>
             <br>
  <div style="position: fixed;bottom:65"> 

   <div id="notices" style="float: left">
        <div><u> <?php echo $details->po_name; ?></u></div>
        <div>Prepared By</div>
      </div>       

      <div id="notices" style="float: left;margin-left: 225px">
        <div class="notice">________________</div>
        <div style="margin-left: 30px">Checked By</div>
      </div>

      <div style="float: right;">
        <div class="notice">__________________</div>
        <div style="margin-left: 15px">Approved By </div> 
      </div>
      <br>
  </div>
  <div style="position: fixed;bottom:40">
        <hr>
        Head office:  <br> 
        83N, Model Town Ext.  <br>
        Lahore - Pakistan. <br>
        Email: ammartarin@cyber.net.pk 
        <br>
        Tel: +92-4235175265-6  
</body>

</html>
