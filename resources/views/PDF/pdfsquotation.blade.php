<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($details as $details):?>
  <title>Commercial Invoice <?php echo $details->sq_number; ?></title>

  <style>
    @include('PDF.style')
  </style>
</head>
<body>
  <div style="width: 800px;margin-top: 120px">
<header class="clearfix">
  <h3><b style="color: black;">COMMERCIAL INVOICE</b></h3>
  <table>
    <tr>
      <td></td>
      <td></td>
      <td></td>
        <td>
          <div style="font-size: 12px"> <b> Dated: </b> 
            </div>
        </td>
        <td>
          <u> <?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?></u>
        </td>
    </tr>
    <!--  -->
    <tr>
        <td></td>
        <td></td>
        <td></td>
      <td>
         <div style="font-size: 12px"> 
          <b> Invoice #: </b>
          </div>
      </td>
      <td>
         <u> <?php echo $details->sq_number; ?> </u> 
      </td>
    </tr>
    <!--  -->
    <tr>
      <td><div style="font-size: 12px;"> <b> Customer Name: </b> </div></td>
      <td><u><?php echo $details->fr_name; ?></u></td>
      <td></td>
      <td>
         <div style="font-size: 12px"> 
          <b> Terms: </b> 
          </div>
      </td>
      <td>
       <u><?php echo $details->sq_term; ?></u>
      </td>
    </tr>
    <!--  -->
    <tr>
      <td>
         <div style="font-size: 12px;"> <b> Address: </b> </div>
      </td>
      <td>
        <u> <?php echo $details->fr_address; ?> </u>
      </td>
      <td></td>
      <td>
         <div style="font-size: 12px;"> <b> D/C #: </b> </div>
      </td>
      <td>
        <u> <?php echo $details->dc_number; ?> </u>
      </td>
    </tr>

  </table>
  <!-- <div style="font-size: 12px;"><b> GST #: </b> --> <?php //echo $details->fr_cnic; ?> <!-- </div> -->
   <?php endforeach; ?>
   <hr>
</header>
 <table border="1px">
                <thead>
                <tr style="font-size: 12px;">
                  <th width="300px"><b>Item</b></th>
                  <th><b>Qty</b></th>
                  <th><b>Unit Price </b></th>
                  <th><b>Total Price </b></th>
                  <th><b>Sale Tax </b></th>
                  <th><b>Price Incl. Sale Tax </b></th>
                </tr>
                </thead>
                <tbody>
               <?php foreach ($pass as $pass):?>
                <tr>
                  <td style="text-align: left"><?php echo $pass->sq_item; ?> <br> <?php echo $pass->sq_size; ?></td>
                  <td><?php echo $pass->sq_quantity; ?></td>
                  <td><?php $subtotal =  number_format($pass->sq_saleprice, 2, '.', ',');
                    echo $subtotal; ?>/-</td>
                  <td><?php $subtotal =  number_format($pass->sq_total, 2, '.', ',');
                    echo $subtotal; ?>/-</td>
                  <td><?php $subtotal =  number_format($pass->sq_stamount, 2, '.', ',');
                    echo $subtotal; ?>/-</td>  
                  <td><?php $subtotal =  number_format($pass->sq_totalprice, 2, '.', ',');
                    echo $subtotal; ?>/-</td>    
                </tr>
              <?php endforeach; ?>
                <tr>
                  <td>
                  </td>
                  <td colspan="2">
                    Total in Pak Rs.
                  </td>
                  <td>
                    <u><?php $subtotal = number_format($details->sq_totalesaletax, 2, '.', ',');
                    echo $subtotal; ?></u>/-
                  </td>
                  <td>
                    <u> <?php $subtotal = number_format($details->sq_totalst, 2, '.', ',');
                    echo $subtotal; ?></u>/-
                  </td>
                  <td>
                     <u> <?php $subtotal = number_format($details->sq_grandtotal, 2, '.', ',');
                    echo $subtotal; ?> </u>/- 
                  </td>
                </tr>
               </tbody>
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
      <div id="notices" style="float: right">
        <div class="notice">________________</div>
        <div>Authorized Signature</div>
      </div>
      <br>
  </div>
</body>

</html>
