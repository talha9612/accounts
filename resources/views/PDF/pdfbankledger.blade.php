<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($balances as $balances):?>
  <title>Bank Ledger <?php echo $balances->acc_title; ?></title>

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
  <h3>BANK LEDGER <b> <?php echo $balances->acc_title; ?> | <?php echo $balances->acc_number; ?></b></h3>
  <div style="font-size: 12px;"> <?php echo $balances->updated_at; ?></div>
  <div style="font-size: 12px;"><b> Opening Balance: </b>  <?php $subtotal =  number_format($balances->acc_opbalance, 2, '.', ','); echo $subtotal; ?>/-</div>
  <div style="font-size: 12px;"><b> Current Balance: </b><?php $subtotal =  number_format($balances->acc_balance, 2, '.', ','); echo $subtotal; ?>/-</div>
   <?php endforeach; ?>
</header>
<hr>
 <table style="padding-top: 40px">
                <thead>
                <tr style="font-size: 12px;">
                  <th style="text-align: left"><b>Date</b></th>
                  <th><b>Voucher # </b></th>
                  <th><b>Head </b></th>
                  <th><b>Name </b></th>
                  <th><b>Description </b></th>
                  <th><b>Debit </b></th>
                  <th><b>Credit </b></th>
                  <th><b>Balance </b></th>
                </tr>
                </thead>
                <tbody>
              <?php $totaldebit = 0; $totalcredit = 0; ?>
               <?php foreach ($voucher as $details):?>
                <tr>
                 <td> <?php echo $details->created_at; ?> </td>
                  <td><?php echo $details->bkvr_no; ?></td>
                  <td><?php echo $details->ex_ID; ?></td>
                  <td><?php echo $details->ex_name; ?></td>
                  <td><?php echo $details->bt_description; ?></td>
                  <td><?php if($details->bt_tag == 'Receipt') {$subtotal =  number_format($details->bt_amount, 2, '.', ',');
                    echo $subtotal; $totaldebit += $details->bt_amount;} else{echo '-';}  ?></td>
                  <td><?php if($details->bt_tag == 'Payment') {$subtotal =  number_format($details->bt_amount, 2, '.', ',');
                    echo $subtotal; $totalcredit += $details->bt_amount;} else{echo '-';} ?></td>
                  <td><?php $subtotal =  number_format($details->acc_balance, 2, '.', ',');
                    echo $subtotal; ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>  
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>

        <?php $subtotal =  number_format($totaldebit, 2, '.', ','); echo '<b style="margin-left:470px">'. $subtotal.'/-</b>'; ?>
        <?php $subtotal =  number_format($totalcredit, 2, '.', ','); echo '<b style="margin-left:28px">'.$subtotal.'/-</b>'; ?>

        </div>
<!--   <div style="position: fixed;bottom:65"> 
    

      <div id="notices" style="float: left;">
        <div class="notice">________________</div>
        <div style="margin-left: 30px">Checked By</div>
      </div>

      <div style="float: right;">
        <div class="notice">__________________</div>
        <div style="margin-left: 15px">Approved By </div> 
      </div>
      <br>
  </div> -->
  <!-- <div style="position: fixed;bottom:40">
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
