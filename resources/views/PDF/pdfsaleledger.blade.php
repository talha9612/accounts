<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
 
  <title>Sales Ledger</title>

  <style>
    @include('PDF.style')
  </style>
</head>
<body>
  <div style="width: 800px">
   <div>
  <img src="{{asset('images/star.png')}}" style="background-color: white;" width="120px" height="80px">
  </div>
  <br>
<header class="clearfix">
  <h3>SALES LEDGER</h3>
</header>
<hr>
 
 <table style="padding-top: 40px">
                <thead>
                <tr style="font-size: 12px;">
                  <th style="text-align: left"><b>Date</b></th>
                  <th><b>Number </b></th>
                  <th><b>Farmer </b></th>
                  <th><b>Item </b></th>
                  <th><b>Quantity </b></th>
                  <th><b>Lot </b></th>
                  <th><b>Unit Price </b></th>
                  <th><b>Debit </b></th>
                  <th><b>Credit </b></th>
                </tr>
                </thead>
                <tbody>
                  <?php $debit = 0; 
                ?>
               <?php foreach ($pass as $details):?>
                <tr>
                  <td><?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?> </td>
                  <td><?php echo $details->sl_number; ?></td>
                  <td><?php echo $details->fr_name; ?></td>
                  <td><?php echo $details->sl_item; ?></td>
                  <td><?php echo $details->sl_quantity; ?></td>
                  <td><?php echo $details->lot_number; ?></td>
                  <td><?php echo $details->sl_saleprice; ?></td>
                  <td>-</td>
                  <td><?php $subtotal =  number_format($details->sl_totalprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                </tr>
                 <?php $debit += $details->sl_totalprice; ?>
                <?php endforeach; ?>
                </tbody>       
    </table>
            <div>
             <label class="text-dark"><b>Total</b></label>
                <input type="text" value="Rs:           <?php $subtotal =  number_format($debit, 2, '.', ',');
                    echo $subtotal; ?>/-" style="text-align: right" readonly>
                    <hr>
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
 <!--  <div style="position: fixed;bottom:65"> 
    

      <div id="notices" style="float: left;">
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
  </div> -->
</body>
</html>
