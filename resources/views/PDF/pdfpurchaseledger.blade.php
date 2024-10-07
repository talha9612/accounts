<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
 
  <title>Purchase Ledger</title>

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
  <h3>PURCHASE LEDGER</h3>
</header>
<hr>
 
 <table style="padding-top: 40px">
                <thead>
                <tr style="font-size: 12px;">
                  <th style="text-align: left"><b>Date</b></th>
                  <th><b>Number </b></th>
                  <th><b>Title </b></th>
                  <th><b>Name </b></th>
                  <th><b>Supplier </b></th>
                  <th><b>Debit </b></th>
                  <th><b>Credit </b></th>
                </tr>
                </thead>
                <tbody>
                  <?php $debit = 0; 
                ?>
               <?php foreach ($pass as $details):?>
                <tr>
                 <td> <?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?> </td>
                  <td><?php echo $details->po_number; ?></td>
                  <td><?php echo $details->po_title; ?></td>
                  <td><?php echo $details->po_name; ?></td>
                  <td><?php echo $details->s_company; ?></td>
                  <td><?php $subtotal =  number_format($details->po_grandtotal, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td>-</td>
                </tr>
                 <?php $debit += $details->po_grandtotal; ?>
                <?php endforeach; ?>
                </tbody>     
                  </table>
                    <div>
                     <label class="text-dark"><b>Total</b></label>
                        <input type="text" value="Rs:           <?php $subtotal =  number_format($debit, 2, '.', ',');
                            echo $subtotal; ?>/-" style="text-align: right" readonly >
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
