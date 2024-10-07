<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($details as $details):?>
  <title>Sale <?php echo $details->sl_number; ?></title>

  <style>
    @include('PDF.style')
  </style>
</head>
<body>
  <div style="width: 800px">
   <div>
  <img src="{{asset('images/star.png')}}" style="background-color: white;" width="120px" height="80px">
  <div style="float: right;margin-right: 80px;font-size: 16px;margin-top: 25px"><?php echo $details->sl_number; ?></div>
  </div>
  <br>
<header class="clearfix">
  <h3>SALES</h3>
   <div style="font-size: 12px;"><?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?></div>
  <div style="font-size: 13px;"> <?php echo $details->sl_title; ?></div>
  <div style="font-size: 12px;"><b> Customer Name: </b><?php echo $details->fr_name; ?></div>
   <?php endforeach; ?>
</header>
<hr>
 <table style="padding-top: 40px">
                <thead>
                <tr style="font-size: 12px;">
                  <th style="text-align: left"><b>Item</b></th>
                  <th><b>Size </b></th>
                  <th><b>Qty </b></th>
                  <th><b>Lot Number </b></th>
                  <th><b>Unit Price </b></th>
                  <th><b>Total  </b></th>
                  <th><b>Total Price </b></th>
                </tr>
                </thead>
                <tbody>
               <?php foreach ($pass as $pass):?>
                <tr>
                  <td style="text-align: left"><?php echo $pass->sl_item; ?></td>
                  <td><?php echo $pass->sl_size; ?></td>
                  <td><?php echo $pass->sl_quantity; ?></td>
                  <td><?php echo $pass->lot_number; ?></td>
                  <td><?php $subtotal =  number_format($pass->sl_saleprice, 2, '.', ',');
                    echo $subtotal; ?>/-</td>
                  <td><?php $subtotal =  number_format($pass->sl_total, 2, '.', ',');
                    echo $subtotal; ?>/-</td>
                  <td><?php $subtotal =  number_format($pass->sl_totalprice, 2, '.', ',');
                    echo $subtotal; ?>/-</td>
                </tr>
                </tbody>
              <?php endforeach; ?>
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
        <div class="notice"><u> <?php echo $details->sl_name; ?></u></div>
        <div>Prepared By</div>
      </div>       

      <div id="notices" style="float: left;margin-left: 225px">
        <div class="notice">________________</div>
        <div style="margin-left: 30px">Checked By</div>
      </div>

      <div style="float: right;">
        <div class="notice"><u> /-
       </u></div>
        <div>Grand Total </div> 
      </div>
      <br>
  </div>
  <div style="position: fixed;bottom:40">
        <hr>
        Head office:  <br> 
        83N, Model Town Ext.  <br>
        Lahore - Pakistan.  <br>
        Email: ammartarin@cyber.net.pk
        <br>
        Tel: +92-4235175265-6 
  </div>
</body>

</html>
