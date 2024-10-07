<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($details as $details):?>
  <title>Material Receiving Report <?php echo $details->mr_number; ?></title>

  <style>
    @include('PDF.style')
  </style>
</head>
<body>
  <div style="width: 800px">
   <div>
  <img src="{{asset('images/star.png')}}" style="background-color: white;" width="120px" height="80px">
  <div style="float: right;margin-right: 80px;font-size: 16px;margin-top: 25px"><?php echo $details->mr_number; ?></div>
  </div>
  <br>
<header class="clearfix">
  <h3>Material Receiving Report</h3>
   <div style="font-size: 12px;"><?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?></div>
  <div style="font-size: 13px;"> <?php echo $details->mr_title; ?></div>
   <div style="font-size: 12px;"><b> Lot Number: </b><?php echo $details->lot_number; ?></div>
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

                </tr>
                </thead>
                <tbody>
               <?php foreach ($pass as $pass):?>
                <tr>
                  <td style="text-align: left"><?php echo $pass->mr_supplier; ?></td>
                  <td style="text-align: left"><?php echo $pass->mr_item; ?></td>
                  <td><?php echo $pass->mr_size; ?></td>
                  <td><?php echo $pass->mr_specs; ?></td>
                  <td><?php echo $pass->mr_description; ?></td>
                  <td><?php echo $pass->mr_quantity; ?></td>
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
        <div><u> <?php echo $details->mr_name; ?></u></div>
        <div>Prepared By</div>
      </div>       

      <div id="notices" style="float: left;margin-left: 225px">
        <div><u> <?php echo $details->mr_received_by; ?></u></div>
        <div>Received By</div>
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
