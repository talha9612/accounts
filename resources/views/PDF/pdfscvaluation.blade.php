<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($details as $details):?>
  <title>Cost Valuation <?php echo $details->sc_number; ?></title>

  <style>
    @include('PDF.style')
  </style>
</head>
<body>
  <div style="width: 800px">
   <div>
  <img src="{{asset('images/star.png')}}" style="background-color: white;" width="120px" height="80px">
  <div style="float: right;margin-right: 80px;font-size: 16px;margin-top: 25px"><?php echo $details->sc_number; ?></div>
  </div>
  <br>
<header class="clearfix">
  <h3>STOCK COST VALUATION</h3>
  <div style="font-size: 12px;"> <?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?></div>
  <div style="font-size: 13px;"> <?php echo $details->sc_title; ?></div>
  <div style="font-size: 12px;"><b> Lot Number: </b><?php echo $details->lot_number; ?></div>
   <?php endforeach; ?>
</header>
<hr>
 
 <table style="padding-top: 40px">

                <thead>
                <tr style="font-size: 12px;">
                  <th style="text-align: left"><b>Make</b></th>
                  <th style="text-align: left"><b>Item</b></th>
                  <th><b>Model </b></th>
                  <th><b>Specs </b></th>
                  <th><b>Description </b></th>
                  <th><b>Qty </b></th>
                  <th><b>U-Price </b></th>
                  <th><b>C-U Price </b></th>
                  <th><b>Total </b></th>
                </tr>
                </thead>
                <tbody>
              <?php $total = 0; ?>
               <?php foreach ($pass as $pass):?>
                <tr>
                  <td style="text-align: left"><?php echo $pass->sc_supplier; ?></td>
                  <td style="text-align: left"><?php echo $pass->sc_item; ?></td>
                  <td><?php echo $pass->sc_size; ?></td>
                  <td><?php echo $pass->sc_specs; ?></td>
                  <td><?php echo $pass->sc_description; ?></td>
                  <td><?php echo $pass->sc_quantity; ?></td>
                  <td><?php $subtotal =  number_format($pass->sc_unitprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                  
                  
                  
                  <td><?php $subtotal =  number_format($pass->sc_ucp, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><b><?php $subtotal =  number_format($pass->sc_costunit, 2, '.', ',');
                    echo $subtotal; ?>/-</b></td>
                </tr>
                <?php $total += $pass->sc_costunit;?>
                </tbody>
              <?php endforeach; ?>
    </table>
    <hr>
          <div style="margin-left: 58%">
            <label><b>Grand Total</b>
            <input type="text" name="grandtotal" value="Rs:<?php $subtotal =  number_format($total, 2, '.', ',');
                    echo $subtotal; ?>/-" style="text-align: right"></label>
            </div>

            <hr>

            <table>
              <tr>
                <td>
                   <label><b>Air Freight</b>
                    <input type="text" name="grandtotal" value="Rs:<?php $subtotal =  number_format($pass->sc_freight, 2, '.', ',');
                            echo $subtotal; ?>/-"></label>
                </td>
                <td>
                   <label><b>Custom Clearance</b>
                    <input type="text" name="grandtotal" value="Rs:<?php $subtotal =  number_format($pass->sc_labour, 2, '.', ',');
                            echo $subtotal; ?>/-"></label>
                </td>
                <td>
                   <label><b>Miscellaneous</b>
                    <input type="text" name="grandtotal" value="Rs:<?php $subtotal =  number_format($pass->sc_miscellaneous, 2, '.', ',');
                            echo $subtotal; ?>/-" ></label>
                </td>
              </tr>

              <tr>
                <td>
                   <label><b>Total Units</b>
                    <input type="text" name="grandtotal" value="Rs:<?php $subtotal =  number_format($pass->sc_totalunits, 2, '.', ',');
                            echo $subtotal; ?>/-"></label>
                </td>
                <td>
                   <label><b>Total Expenses</b>
                    <input type="text" name="grandtotal" value="Rs:<?php $subtotal =  number_format($pass->sc_totalexpense, 2, '.', ',');
                            echo $subtotal; ?>/-"></label>
                </td>
                <td>
                   <label><b>Per Peice Expenses</b>
                    <input type="text" name="grandtotal" value="Rs:<?php $subtotal =  number_format($pass->sc_ppexpense, 2, '.', ',');
                            echo $subtotal; ?>/-" ></label>
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
        <div class="notice"><u> <?php echo $details->sc_name; ?></u></div>
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
        83N, Model Town Ext. <br>
        Lahore - Pakistan.  <br>
        Email: ammartarin@cyber.net.pk 
        <br>
        Tel: +92-4235175265-6 
  </div>
</body>

</html>
