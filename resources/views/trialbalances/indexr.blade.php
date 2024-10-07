<!-- show.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->trialbalanceview) && Auth::user()->trialbalanceview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Trial Balance 
          </h3>
          <br>
           <div align="right">
                <a href="javascript:printDiv('datatables1')" class="btn btn-success mt-2">Print</a><br>
                <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
            </div>
            <div id="div1">
           <table  class="table table-striped table-bordered" >
              <thead>
                <tr>
                  <th class="text-primary"><h5> Title </h5></th>
                  <th class="text-primary"><h5> Debit </h5></th>
                  <th class="text-primary"><h5> Credit </h5></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th><h5>Title</h5></th>
                  <th>Debit</th>
                  <th>Credit</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td class="text-white bg-dark"><b>Cash</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php 
                $totaldebit = 0;
                $totalcredit = 0;
                $totalcash = 0;
                ?>
               <?php foreach ($cashinhands as $cashinhand):?>
                <tr role="row" class="odd">
                  <td><?php echo $cashinhand->cih_title; ?></td>
                  <td><?php $subtotal = number_format($cashinhand->ob_amount, 2, '.', ','); echo $subtotal; ?></td>
                  <td>-</td>
                </tr>
                <?php $totaldebit += $cashinhand->ob_amount; $totalcash += $cashinhand->ob_amount; ?>
                <?php endforeach; ?>
                <tr class="table-success">
                  <td><?php $subtotal = number_format($totalcash, 2, '.', ','); echo '<b>Total: ' .$subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <td class="text-white bg-dark"><b>Bank</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
              <?php $totalbank = 0; ?>
               <?php foreach ($accountsbks as $accountsbk):?>
                <tr role="row" class="odd">
                  <td><?php echo $accountsbk->acc_title; ?></td>
                  <td><?php $subtotal = number_format($accountsbk->ob_amount, 2, '.', ','); echo $subtotal; ?></td>
                  <td>-</td>
                </tr>
                <?php $totaldebit += $accountsbk->ob_amount; $totalbank += $accountsbk->ob_amount; ?>
                <?php endforeach; ?>
                 <tr class="table-success">
                  <td><?php $subtotal = number_format($totalbank, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>

                <tr>
                  <td class="text-white bg-dark"><b>Assets</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
              <?php $totalasset = 0; ?>
               <?php foreach ($heads as $head):?>
                <?php if( $head->h_type == 'Asset')
                {
                  echo '
                <tr role="row" class="odd">
                  <td>';
                  echo $head->h_name;
                  echo '</td> <td>';
                  $subtotal = number_format($head->ob_amount, 2, '.', ','); echo $subtotal;
                  $totaldebit += $head->ob_amount; 
                  $totalasset += $head->ob_amount; 
                  echo '</td>
                  <td>-</td>
                </tr>';}
                ?>
                <?php endforeach; ?>
                 <tr class="table-success">
                  <td><?php $subtotal = number_format($totalasset, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="text-white bg-dark"><b>Liabilities</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
              <?php $totalliability = 0; ?>
               <?php foreach ($heads as $head):?>
                <?php if( $head->h_type == 'Liability')
                {
                  echo '
                <tr role="row" class="odd">
                  <td>';
                  echo $head->h_name;
                  echo '</td>
                  <td>-</td>
                  <td>';
                  $subtotal = number_format($head->ob_amount, 2, '.', ','); echo $subtotal;
                  $totalcredit += $head->ob_amount; 
                  $totalliability += $head->ob_amount; 
                  echo '</td>
                </tr>
                ';}
                ?>
                <?php endforeach; ?>
                <tr class="table-success">
                  <td><?php $subtotal = number_format($totalliability, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td class="text-white bg-dark"><b>Customers</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $totalcustomer = 0; ?> 
               <?php foreach ($customers as $customer):?>
                <tr role="row" class="odd">
                  <td><?php echo $customer->fr_name; ?></td>
                  <td><?php $subtotal = number_format($customer->ob_amount, 2, '.', ','); echo $subtotal; ?></td>
                  <td>-</td>
                </tr>
                <?php $totaldebit += $customer->ob_amount; $totalcustomer += $customer->ob_amount; ?>
                <?php endforeach; ?>
                 <tr class="table-success">
                  <td><?php $subtotal = number_format($totalcustomer, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td class="text-white bg-dark"><b>Suppliers</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $totalsupplier = 0; ?> 
               <?php foreach ($suppliers as $supplier):?>
                <tr role="row" class="odd">
                  <td><?php echo $supplier->s_company; ?></td>
                  <td>-</td>
                  <td><?php $subtotal = number_format($supplier->ob_amount, 2, '.', ','); echo $subtotal; ?></td>
                </tr>
                <?php $totalcredit += $supplier->ob_amount; $totalsupplier += $supplier->ob_amount; ?>
                <?php endforeach; ?>

                 <tr>
                  <td class="text-white bg-dark"><b>Expenses</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $totalexpense = 0; ?> 
                <?php foreach ($heads as $head):  $amount = 0;?>

                <?php if($head->h_type == 'Expense')
                {
                  $amount = $head->ob_amount;

                    foreach ($casht as $cashts)
                      if($cashts->ct_name == $head->h_name)
                      {
                      $amount += $cashts->ct_amount;
                      }
                      else{
                       $amount += 0; 
                      }

                      foreach ($cashr as $cashrs)
                      if($cashrs->cr_name == $head->h_name)
                      {
                      $amount -= $cashrs->cr_amount;
                      }
                      else{
                       $amount -= 0; 
                      }

                      foreach ($bankt as $bankts)
                      if($bankts->ex_name == $head->h_name)
                      {
                      $amount += $bankts->bt_amount;
                      }
                      else{
                       $amount += 0; 
                      }

                      foreach ($bankr as $bankrs)
                      if($bankrs->br_name == $head->h_name)
                      {
                      $amount -= $bankrs->br_amount;
                      }
                      else{
                       $amount -= 0; 
                      }

                      foreach ($jv as $jvs)
                      if($jvs->jv_acc_name == $head->h_name)
                      {
                      if($jvs->jv_acc_status == 'Debit')
                      {$amount += $jvs->jv_amount;}
                      elseif($jvs->jv_acc_status == 'Credit')
                      {$amount -=  $jvs->jv_amount;}
                      else{$amount += 0; }
                      }
                      else{
                       $amount += 0; 
                      }

                  echo '
                <tr role="row" class="odd">';
                  echo '<td>';
                  echo $head->h_name;
                  echo '</td> <td>';
                  $subtotal = number_format($amount, 2, '.', ','); echo $subtotal;
                  $totaldebit += $amount; 
                  $totalexpense += $amount; 
                  echo '</td>
                  <td></td>
                </tr>
                ';
                }
                ?>
                <?php endforeach; ?>
                <tr class="table-success">
                  <td><?php $subtotal = number_format($totalexpense, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="text-white bg-dark"><b>Income</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $totalincome = 0; ?> 
                <?php foreach ($heads as $head):?>
                <?php if( $head->h_type == 'Income')
                {
                   $totalcredit += $head->ob_amount;
                   $totalincome += $head->ob_amount;
                  echo '
                <tr role="row" class="odd">
                  <td>';
                  echo $head->h_name;
                  echo '</td>
                  <td>-</td>
                  <td>';
                  $subtotal = number_format($head->ob_amount, 2, '.', ','); echo $subtotal;
                  echo '</td>
                </tr>
                ';}
                ?>
                <?php endforeach; ?>
                <tr class="table-success">
                  <td><?php $subtotal = number_format($totalincome, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="text-white bg-dark"><b>Sales</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $saletotal = 0; ?>
                <tr role="row" class="odd">
                  <?php foreach ($sales as $sale):?>
                  <?php $saletotal +=  $sale->sl_totalprice;?>
                   <?php endforeach; ?>
                  <td>Total Sales</td>
                  <td>-</td>
                  <td><?php $subtotal = number_format($saletotal, 2, '.', ','); echo $subtotal; ?></td>
                   <?php $totalcredit += $saletotal; ?>
                </tr>
                 <tr>
                  <td class="text-white bg-dark"><b>Purchase</b></td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $purchasetotal = 0; ?>
                <tr role="row" class="odd">
                  <?php foreach ($purchases as $purchase):?>
                  <?php $purchasetotal +=  $purchase->po_grandtotal;?>
                   <?php endforeach; ?>
                  <td>Total Purchases</td>
                  <td><?php $subtotal = number_format($purchasetotal, 2, '.', ','); echo $subtotal; ?></td>
                  <?php $totaldebit += $purchasetotal; ?>
                  <td>-</td>
                </tr>
                <tr>
                <td></td>
                <td>
                  <div class="form-group">
                    <label class="text-primary"><b>Total Debit</b></label>
                    <input type="text" name="totaldebit" class="form-control" value="<?php $subtotal = number_format($totaldebit, 2, '.', ','); echo $subtotal; ?>" readonly />    
                  </div>
                  </td>
                    <td>
                      <div class="form-group">
                      <label class="text-primary"><b>Total Credit</b></label>
                      <input type="text" name="totalcredit" class="form-control" value="<?php $subtotal = number_format($totalcredit, 2, '.', ','); echo $subtotal; ?>" readonly />  
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <?php function diff($totaldebit, $totalcredit) {
                    //return ($totalcredit - $totaldebit) < 0 ? (-1)*($totalcredit-$totaldebit) : ($totalcredit-$totaldebit);
                }
               // $difference = diff($totalcredit, $totaldebit); 
                // echo $difference;
                ?>
                <div class="form-group col-sm-4">
                    <label class="text-primary"><b>Total Difference</b></label>
                    <input type="text" name="totalcredit" class="form-control" value="<?php $subtotal = number_format($totaldebit - $totalcredit, 2, '.', ','); echo $subtotal; ?>" readonly />    
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
            <br>
            <br>
            <br>
            <br>
       <!-- WORK AREA END -->  
       <script>
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <h3 align="center"> Trial Balance </h3> ')
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').outerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }
        </script>
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>  
