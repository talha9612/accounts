<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($balances as $balances):?>
  <title>Farmer Ledger <?php echo $balances->fr_name; ?></title>

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
  <h3>FARMER LEDGER</h3>
  <div style="font-size: 12px;"> <?php echo $balances->updated_at; ?></div>
  <div style="font-size: 12px;"><b> <?php echo $balances->fr_name; ?></b></div>
  <div style="font-size: 13px;"> <?php echo $balances->fr_cnic; ?></div>
  <div style="font-size: 12px;"><b> Opening Balance </b>  <?php $subtotal =  number_format($balances->fr_opbalance, 2, '.', ',');
                    echo $subtotal; ?>/-</div>
  <div style="font-size: 12px;"><b> Remaining Balance: </b><?php $subtotal =  number_format($balances->fr_balance, 2, '.', ',');
                    echo $subtotal; ?>/-</div>
   <?php endforeach; ?>
</header>
<hr>
 
 <table style="padding-top: 40px">
                <thead>
                <tr style="font-size: 12px;">
                  <th style="text-align: left"><b>Date</b></th>
                  <th><b>Voucher # </b></th>
                  <th><b>Name </b></th>
                  <th><b>Title </b></th>
                  <th><b>Debit </b></th>
                  <th><b>Credit </b></th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach ($pass as $pass):?>
                  <tr role="row" class="odd">
                  <td><?php echo $pass->created_at; ?> </td>
                  <td><?php echo $pass->jv_no; ?></td>
                  <td><?php echo $pass->jv_acc_name; ?></td>
                  <td><?php echo $pass->jv_acc_status; ?></td>
                  <td>-</td>
                  <td><?php $subtotal =  number_format($pass->jv_amount, 2, '.', ',');
                    echo $subtotal; ?></td>
                  </tr>
                
                  <?php endforeach; ?>
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
        Head office: <br> 
        83N, Model Town Ext.<br>
        Lahore - Pakistan.<br>
        Email: ammartarin@cyber.net.pk
        <br>
        Tel: +92-4235175265-6
  </div>
</body>

</html>
