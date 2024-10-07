<!-- show.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->trialbalanceview) && Auth::user()->trialbalanceview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Closing Trial Balance 
          </h3>
          <br>
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
                  <td class="text-white bg-dark">Cash</td>
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
                  <td><?php $subtotal = number_format($cashinhand->cih_balance, 2, '.', ','); echo $subtotal; ?></td>
                  <td>-</td>
                </tr>
                <?php $totaldebit += $cashinhand->cih_balance; $totalcash += $cashinhand->cih_balance; ?>
                <?php endforeach; ?>
                <tr class="table-success">
                  <td><?php $subtotal = number_format($totalcash, 2, '.', ','); echo '<b>Total: ' .$subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td class="text-white bg-dark">Bank</td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
              <?php $totalbank = 0; ?>
               <?php foreach ($accountsbks as $accountsbk):?>
                <tr role="row" class="odd">
                  <td><?php echo $accountsbk->acc_title; ?></td>
                  <td><?php $subtotal = number_format($accountsbk->acc_balance, 2, '.', ','); echo $subtotal; ?></td>
                  <td>-</td>
                </tr>
                <?php $totaldebit += $accountsbk->acc_balance; $totalbank += $accountsbk->acc_balance; ?>
                <?php endforeach; ?>
                 <tr class="table-success">
                  <td><?php $subtotal = number_format($totalbank, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td class="text-white bg-dark">Assets</td>
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
                  $subtotal = number_format($head->h_balance, 2, '.', ','); echo $subtotal;
                  $totaldebit += $head->h_balance; 
                  $totalasset += $head->h_balance; 
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
                  <td class="text-white bg-dark">Liabilities</td>
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
                  $subtotal = number_format($head->h_balance, 2, '.', ','); echo $subtotal;
                  $totalcredit += $head->h_balance; 
                  $totalliability += $head->h_balance; 
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
                  <td class="text-white bg-dark">Customers</td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
              <?php $totalcustomer = 0; ?> 
               <?php foreach ($customers as $customer):?>
                <tr role="row" class="odd">
                  <td><?php echo $customer->fr_name; ?></td>
                  <td><?php $subtotal = number_format($customer->fr_balance, 2, '.', ','); echo $subtotal; ?></td>
                  <td>-</td>
                </tr>
                <?php $totaldebit += $customer->fr_balance; $totalcustomer += $customer->fr_balance; ?>
                <?php endforeach; ?>
                 <tr class="table-success">
                  <td><?php $subtotal = number_format($totalcustomer, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td class="text-white bg-dark">Suppliers</td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $totalsupplier = 0; ?> 
               <?php foreach ($suppliers as $supplier):?>
                <tr role="row" class="odd">
                  <td><?php echo $supplier->s_company; ?></td>
                  <td>-</td>
                  <td><?php $subtotal = number_format($supplier->s_balance, 2, '.', ','); echo $subtotal; ?></td>
                </tr>
                <?php $totalcredit += $supplier->s_balance; $totalsupplier += $supplier->s_balance; ?>
                <?php endforeach; ?>
                <tr class="table-success">
                  <td><?php $subtotal = number_format($totalsupplier, 2, '.', ','); echo '<b>Total: ' . $subtotal. '</b>'; ?></td>
                  <td></td>
                  <td></td>
                </tr>
                 <tr>
                  <td class="text-white bg-dark">Expenses</td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $totalexpense = 0; ?> 
                <?php foreach ($heads as $head):?>
                <?php if( $head->h_type == 'Expense')
                {
                  echo '
                <tr role="row" class="odd">';
                  echo '<td>';
                  echo $head->h_name;
                  echo '</td> <td>';
                  $subtotal = number_format($head->h_balance, 2, '.', ','); echo $subtotal;
                  $totaldebit += $head->h_balance; 
                  $totalexpense += $head->h_balance; 
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
                  <td class="text-white bg-dark">Income</td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $totalincome = 0; ?> 
                <?php foreach ($heads as $head):?>
                <?php if( $head->h_type == 'Income')
                {
                   $totalcredit += $head->h_balance;
                   $totalincome += $head->h_balance;
                  echo '
                <tr role="row" class="odd">
                  <td>';
                  echo $head->h_name;
                  echo '</td>
                  <td>-</td>
                  <td>';
                  $subtotal = number_format($head->h_balance, 2, '.', ','); echo $subtotal;
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
                  <td class="text-white bg-dark">Sales</td>
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
                  <td class="text-white bg-dark">Purchase</td>
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
                    <label class="text-primary">Total Debit</label>
                    <input type="text" name="totaldebit" class="form-control" value="<?php $subtotal = number_format($totaldebit, 2, '.', ','); echo $subtotal; ?>" readonly />    
                  </div>
                  </td>
                    <td>
                      <div class="form-group">
                      <label class="text-primary">Total Credit</label>
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
                    <label class="text-primary">Total Difference</label>
                    <input type="text" name="totalcredit" class="form-control" value="<?php $subtotal = number_format($totaldebit - $totalcredit, 2, '.', ','); echo $subtotal; ?>" readonly />    
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
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>  
