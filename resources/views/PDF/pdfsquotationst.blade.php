<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($details as $details):?>
  <title>Sales Tax Invoice <?php echo $details->sq_number; ?></title>

  <style>
    @include('PDF.style')
  </style>
</head>
<body>
  <div style="width: 800px;">
<header class="clearfix">
  <h3><b style="color: black;">SALES TAX INVOICE</b></h3>
  
  <table>
    <tr>
      <td>
        <div style="font-size: 12px;"> <b> Supplier Name: </b> </div>
      </td>
      <td>
        <b style="font-size: 20px">Star Automation</b>
      </td>
      <td></td>
      <td>
         <div style="font-size: 12px"> <b> Dated: </b> 
            </div>
      </td>
      <td>
        <u><?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?></u>
      </td>
    </tr>
    <tr>
      <td>
        Address:
      </td>
      <td>
        83-N, Model Town Ext, Lahore, Pakistan
      </td>
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
    <tr>
      <td>
        Tel:
      </td>
      <td>
        042-35175265-6
      </td>
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
    <tr>
      <td>
        Fax:
      </td>
      <td>
        042-35165283
      </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td>
        GST No:
      </td>
      <td>
        <b>03-04-8400-154-73</b>
      </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>

  <hr>

  <table>
    <tr>
      <td>
         <div style="font-size: 12px;"> <b> Buyer Name: </b> </div>
      </td>
      <td width="560px">
        <u><?php echo $details->fr_name; ?></u>
      </td>
     
    </tr>
    <!--  -->
    <tr>
       <td>
        <div style="font-size: 12px;"> <b> Address: </b> </div>
      </td>
      <td><u> <?php echo $details->fr_address; ?> </u> </td>
       
     
    </tr>
    <!--  -->
    <tr>
      <td>
         <div style="font-size: 12px;"> <b> NTN #/FTN #: </b> </div>
      </td>
      <td>
        <u> <?php echo $details->fr_cnic; ?> </u>
      </td>
     
    </tr>

    <tr>
      <td>
         <div style="font-size: 12px;"> <b> GST #: </b> </div>
      </td>
      <td>
        <u> <?php echo $details->fr_gst; ?> </u>
      </td>
     
    </tr>
    <!--  -->

  </table>
  <!-- <div style="font-size: 12px;"><b> GST #: </b> --> <?php //echo $details->fr_cnic; ?> <!-- </div> -->
   <?php endforeach; ?>
   <hr>
</header>
 <table border="1px">
                <thead>
                <tr style="font-size: 12px;">
                  <th width="200px"><b>Item</b></th>
                  <th><b>Qty</b></th>
                  <th><b>Unit Price </b></th>
                  <th><b>Total Price </b></th>
                  <th><b>Rate of Sales Tax </b></th>
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
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sq_total, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sq_strate, 2, '.', ',');
                    echo $subtotal; ?> %</td>
                  <td><?php $subtotal =  number_format($pass->sq_stamount, 2, '.', ',');
                    echo $subtotal; ?></td>  
                  <td><?php $subtotal =  number_format($pass->sq_totalprice, 2, '.', ',');
                    echo $subtotal; ?></td>    
                </tr>
              <?php endforeach; ?>
                <tr>
                  <td>
                  </td>
                  <td colspan="2">
                    Total in Pak Rs.
                  </td>
                  <td>
                    <u><?php $subtotal =  number_format($details->sq_totalesaletax, 2, '.', ',');
                    echo $subtotal; ?></u>/-
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    <u> <?php $subtotal =  number_format($details->sq_totalst, 2, '.', ',');
                    echo $subtotal; ?></u>/-
                  </td>
                  <td>
                     <u> <?php $subtotal =  number_format($details->sq_grandtotal, 2, '.', ',');
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
