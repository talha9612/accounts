<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php foreach ($balances as $balances):?>
  <title>Supplier Ledger <?php echo $balances->s_company; ?></title>

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
  <h3>SUPPLIER LEDGER</h3>
  <div style="font-size: 12px;"><?php  $newDate = date("d-M-Y", strtotime($balances->updated_at)); echo $newDate; ?></div>
  <div style="font-size: 12px;"><b> <?php echo $balances->s_company; ?></b></div>
  <div style="font-size: 13px;"> <?php echo $balances->s_name; ?></div>
  <div style="font-size: 12px;"><b> Opening Balance: </b>  <?php $subtotal =  number_format($balances->s_obalance, 2, '.', ',');
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
                  <?php $credit = 0; 
                      $debit = 0;
                      $remaining = 0;
                ?>
               <?php foreach ($details as $details):?>
                <tr>
                  <td><?php echo $details->created_at; ?></td>
                  <td><?php echo $details->po_number; ?></td>
                  <td><?php echo $details->po_name; ?></td>
                  <td><?php echo $details->po_title; ?></td>
                  <td><?php $subtotal =  number_format($details->po_totalprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td>-</td>
                </tr>
                 <?php $debit += $details->po_totalprice; ?>
                <?php endforeach; ?>

                 <?php foreach ($pass as $pass):?>
                  <tr role="row" class="odd">
                  <td><?php echo $pass->created_at; ?> </td>
                  <td><?php echo $pass->jv_no; ?></td>
                  <td>-</td>
                  <td>Journal Voucher</td>
                  <td>-</td>
                  <td><?php $subtotal =  number_format($pass->jv_amount, 2, '.', ',');
                    echo $subtotal; ?></td>
                </tr>
                <?php $credit += $pass->jv_amount; ?>
                  <?php endforeach; ?>

                   <?php foreach ($sp as $sp):?>
                  <tr role="row" class="odd">
                  <td><?php echo $sp->created_at; ?> </td>
                  <td><?php echo $sp->vr_no; ?></td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td><?php $subtotal =  number_format($sp->sp_amount, 2, '.', ',');
                    echo $subtotal; ?></td>
                </tr>
                <?php $credit += $sp->sp_amount; ?>
                  <?php endforeach; ?>
                </tbody>
                    
    </table>
            <div>  

                <label><b>Total Debit</b></label>
                <input type="text" value="Rs:           <?php $subtotal =  number_format($credit, 2, '.', ',');
                    echo $subtotal; ?>/-" style="text-align: right" readonly>
                <label class="text-dark"><b>Total Credit</b></label>
                <input type="text" value="Rs:           <?php $subtotal =  number_format($debit, 2, '.', ',');
                    echo $subtotal; ?>/-" style="text-align: right" readonly >
                    <br>
                    <hr>
            <label><b>Remaining Balance</b></label> 
             <?php $remaining = $debit - $credit; ?>           
            <input type='text' id="vr_amount" name="vr_amount" value="Rs:     <?php $subtotal =  number_format($remaining, 2, '.', ',');
                    echo $subtotal; ?>/-" style="text-align: right" readonly/> 
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
        Head office: <span style="margin-left: 463px"> Branch office: </span> <br> 
        83N, Model Town Ext.  <span style="margin-left: 409px"> Al Rahim Complex Near Shaoour Town </span><br>
        Lahore - Pakistan. <span style="margin-left: 433px"> Hyderabad Stop, Chak Madrissa </span> <br>
        Email: ammartarin@cyber.net.pk <span style="margin-left: 360px"> Railway Station, District Bahawalnagar. </span> 
        <br>
        Tel: +92-4235175265-6  <span style="margin-left: 405px"> Tel: +92-63-2010107 </span>
  </div>
</body>
</html>
