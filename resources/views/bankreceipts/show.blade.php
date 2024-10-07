<!-- show.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->breceiptsview) && Auth::user()->breceiptsview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Voucher)</small>
          </h3>
          <br>
           <div align="right">
          <a href="javascript:printDiv('datatables1')">Print</a><br>
          <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
          </div>
           <div id="div1"> 
         <?php foreach ($detail as $details):?>
          <div class="col-md-4">Voucher#: <?php echo $details->brv_no; ?></div>
          <div class="col-md-4">ACC Title: <?php echo $details->acc_title; ?></div>
           <div class="col-md-4"> <?php  $newDate = date("d-M-Y", strtotime($details->created_at)); echo $newDate; ?> </div>
            <div class="col-md-4">Prepared By: <b><?php echo $details->br_preparedby; ?></b></div>
           <?php endforeach; ?>
            <table id="datatables1" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info" border="1px">
              <thead class="bg-primary">
                 <tr>
                  <th class="text-white">Serial Number</th>
                  <th class="text-white">Account Head</th>
                  <th class="text-white">Cheque Number</th>
                  <th class="text-white">Name</th>
                  <th class="text-white">Details</th>
                  <th class="text-white">Amount</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
              <?php $total = 0; ?>
               <?php foreach ($voucher as $bankreceipts):?>
                <tr role="row" class="odd">
                  <td><?php echo $bankreceipts->br_sno; ?></td>
                  <td><?php echo $bankreceipts->br_head; ?></td>
                  <td><?php echo $bankreceipts->br_cqnumber; ?></td>
                  <td><?php echo $bankreceipts->br_name; ?></td>
                  <td><?php echo $bankreceipts->br_description; ?></td>
                  <td><?php $subtotal =  number_format($bankreceipts->br_amount, 2, '.', ',');
                    echo $subtotal; $total += $bankreceipts->br_amount; ?></td>
                </tr>
               <?php endforeach; ?>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><input type="hidden" value="10000">GRAND TOTAL</td>
                  <td><?php $subtotal =  number_format($total, 2, '.', ','); echo '<b>'. $subtotal. '/-</b>'; ?> </td>
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
            <br>
            <br>
            <br>
            <br>
       <!-- WORK AREA END -->  
  <script>
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <h3 align="center"> BANK RECEIPT </h3> ')
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').outerHTML; 
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }
  </script>                 
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
  <?php  } else {  redirect()->to('home')->send(); } ?>         