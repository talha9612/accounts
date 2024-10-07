<!-- show.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->jvview) && Auth::user()->jvview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Journal Voucher)</small>
          </h3>
          <br>
      <div align="right">
        <a href="javascript:printDiv('datatables1')">Print</a><br>
        <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
        </div>
         <div id="div1">
           <?php foreach ($detail as $details):?>
          <div class="col-md-4">Voucher#: <?php echo $details->jv_no; ?></div>
           <div class="col-md-4"> <?php  $newDate = date("d-M-Y", strtotime($details->created_at)); echo $newDate; ?> </div>
            <div class="col-md-4">Prepared By: <b><?php echo $details->jv_preparedby; ?></b></div>
           <?php endforeach; ?>
           <table id="datatables1" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info" border="1px">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="text-white">Account ID</th>
                  <th class="text-white">Account Name</th>
                  <th class="text-white">Description</th>
                  <th class="text-white">Debit</th>
                  <th class="text-white">Credit</th>

                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>

                </tr>
              </tfoot>
              <tbody>
                <?php $totaldebit = 0;
                      $totalcredit = 0;
                 ?>
               <?php foreach ($voucher as $vouchers):?>
                <tr>
                  <td><?php echo $vouchers->jv_acc_ID; ?></td>
                  <td><?php echo $vouchers->jv_acc_name; ?></td>
                  <td><?php echo $vouchers->jv_description; ?></td>
                  <td><?php if($vouchers->jv_acc_status === 'Debit'){
                    $subtotal =  number_format($vouchers->jv_amount, 2, '.', ',');
                    echo $subtotal;
                    $totaldebit += $vouchers->jv_amount;
                  }
                  else { echo '-';} ?></td>
                  <td>
                    <?php if($vouchers->jv_acc_status === 'Credit'){
                    $subtotal =  number_format($vouchers->jv_amount, 2, '.', ',');
                    echo $subtotal;
                    $totalcredit += $vouchers->jv_amount;
                  }
                  else { echo '-';} ?>
                  </td>
                </tr>
               <?php endforeach; ?>
                <tr>
                  <td><input type="hidden" value="1000"></td>
                  <td></td>
                  <td></td>
                  <td>Total Debit: <?php $subtotal =  number_format($totaldebit, 2, '.', ',');
                    echo $subtotal; ?></td>
                 <td>Total Credit: <?php $subtotal =  number_format($totalcredit, 2, '.', ',');
                    echo $subtotal; ?></td>
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
       <!-- WORK AREA END -->
<script>
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <h3 align="center"> Journal Voucher </h3> ')
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').outerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }
  </script>
 @endsection
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
  <?php  } else {  redirect()->to('home')->send(); } ?>
