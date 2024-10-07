<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Stock Report</title>

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
  <h3>STOCK REPORT</h3>
</header>

 <table style="padding-top: 40px">

                <thead>
                <tr style="font-size: 12px;">
                  <th style="text-align: left"><b>Date</b></th>
                  <th style="text-align: left"><b>ID</b></th>
                  <th style="text-align: left"><b>Make</b></th>
                  <th style="text-align: left"><b>Item</b></th>
                  <th><b>Model </b></th>
                  <th><b>Specs </b></th>
                  <th><b>Qty </b></th>
                  <th><b>Lot </b></th>
                  <th><b>Company </b></th>
                  <th><b>C-U Price </b></th>
                </tr>
                </thead>
                <tbody>
              <?php $total = 0; ?>
               <?php foreach ($pass as $pass):?>
                <tr>
                  <td style="text-align: left"><?php  $newDate = date("d-M-Y", strtotime($pass->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $pass->ss_ID; ?></td>
                  <td><?php echo $pass->ss_supplier; ?></td>
                  <td><?php echo $pass->ss_item; ?></td>
                  <td><?php echo $pass->ss_size; ?></td>
                  <td><?php echo $pass->ss_specs; ?></td>
                  <td><?php echo $pass->ss_quantity; ?></td>
                  <td><?php echo $pass->lot_number; ?></td>
                  <td><?php echo $pass->s_company; ?></td>
                  <td><b><?php $subtotal =  number_format($pass->ss_costunit, 2, '.', ',');
                    echo $subtotal; ?>/-</b></td>
                </tr>
                <?php $total += $pass->ss_costunit * $pass->ss_quantity; ?>
                </tbody>
              <?php endforeach; ?>
    </table>
    <hr>
          <div style="margin-left: 65%">
            <label><b>Grand Total</b>
            <input type="text" name="grandtotal" value="Rs:  <?php $subtotal =  number_format($total, 2, '.', ',');
                    echo $subtotal; ?>/-" style="text-align: right"></label>
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
  <div style="position: fixed;bottom:65"> 

      <div id="notices" style="float: left">
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
        Head office: <span style="margin-left: 463px"> Branch office: </span> <br> 
        83N, Model Town Ext.  <span style="margin-left: 409px"> Al Rahim Complex Near Shaoour Town </span><br>
        Lahore - Pakistan. <span style="margin-left: 433px"> Hyderabad Stop, Chak Madrissa </span> <br>
        Email: ammartarin@cyber.net.pk <span style="margin-left: 360px"> Railway Station, District Bahawalnagar. </span> 
        <br>
        Tel: +92-4235175265-6  <span style="margin-left: 405px"> Tel: +92-63-2010107 </span>
  </div>
</body>

</html>
