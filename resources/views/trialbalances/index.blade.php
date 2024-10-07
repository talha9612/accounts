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
               @if($cashinhand->cih_balance !=0 || $cashinhand->cih_obalance !=0)
                <tr role="row" class="odd">
                  <td><?php echo $cashinhand->cih_title; ?></td>
                  <td><?php $subtotal = number_format($cashinhand->cih_balance, 2, '.', ',');
                    if($subtotal == 0){
                      $subtotalo = number_format($cashinhand->cih_obalance, 2, '.', ','); 
                      echo $subtotalo;
                      $totaldebit += $cashinhand->cih_obalance; $totalcash += $cashinhand->cih_obalance;
                    }else{ 
                        echo $subtotal; 
                        $totaldebit += $cashinhand->cih_balance; $totalcash += $cashinhand->cih_balance;
                    }
                   ?></td>
                  <td>-</td>
                </tr>
                @endif
               
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
               @if($accountsbk->acc_balance != 0 || $accountsbk->acc_opbalance != 0)
                <tr role="row" class="odd">
                  <td><?php echo $accountsbk->acc_title; ?></td>
                  <td><?php $subtotal = number_format($accountsbk->acc_balance, 2, '.', ',');
                   if($subtotal == 0){
                      $subtotalo = number_format($accountsbk->acc_opbalance, 2, '.', ','); 
                      echo $subtotalo;
                      $totaldebit += $accountsbk->acc_opbalance; $totalbank += $accountsbk->acc_opbalance;
                    }else{ echo $subtotal; 
                        $totaldebit += $accountsbk->acc_balance; $totalbank += $accountsbk->acc_balance;
                    }
                   ?></td>
                  <td>-</td>
                </tr>
                @endif
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
                    if($head->h_balance != 0 || $head->h_opbalance != 0 ){
                        echo '
                            <tr role="row" class="odd">
                              <td>';
                              echo $head->h_name;
                              echo '</td> <td>';
                              $subtotal = number_format($head->h_balance, 2, '.', ','); 
                              if($subtotal == 0){
                                    $subtotalo = number_format($head->h_opbalance, 2, '.', ','); 
                                    echo $subtotalo;
                                    $totaldebit += $head->h_opbalance; 
                                    $totalasset += $head->h_opbalance; 
                              }else{
                                  echo $subtotal;
                                  $totaldebit += $head->h_balance; 
                                  $totalasset += $head->h_balance;
                              }
                              echo '</td>
                              <td>-</td>
                            </tr>';
                    }
                 }
                ?>
                <?php endforeach; ?>
                 {{--For Stock Calculations --}}
                    <?php $total = 0; ?>
                    <?php foreach ($stockorders as $orders):?>
                        <?php $subtotal =  number_format($orders->ss_costunit, 2, '.', ',');?>
                        <?php $totalcost = 0; ?>
                        <?php $totalcost = $orders->ss_costunit * $orders->ss_quantity; ?>
                        <?php $subtotal =  number_format($totalcost, 2, '.', ',');?>
                        <?php $total += $orders->ss_costunit * $orders->ss_quantity; ?>
                        <?php //$subtotal =  number_format($total, 2, '.', ','); ?>
                    <?php endforeach; ?>
                <?php
                    echo '
                            <tr role="row" class="odd">
                              <td>';
                    echo 'Stocks';
                    echo '</td> <td>';

                        echo number_format($total, 2, '.', ',');

                    echo '</td>
                              <td>-</td>
                            </tr>';
                    $totaldebit += $total; 
                    $totalasset += $total;
                    ?>
                
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
                    if($head->h_name != "Accumulated Profit & Loss Accounts"){
                    if($head->h_balance != 0 || $head->h_opbalance != 0 ){
                          echo '
                        <tr role="row" class="odd">
                          <td>';
                          echo $head->h_name;
                          echo '</td>
                          <td>-</td>
                          <td>';
                          $subtotal = number_format($head->h_balance, 2, '.', ',');
                           if($subtotal == 0){
                                    $subtotalo = number_format($head->h_opbalance, 2, '.', ','); 
                                    echo $subtotalo;
                                    $totalcredit += $head->h_opbalance; 
                                    $totalliability += $head->h_opbalance; 
                              }else{
                                  echo $subtotal;
                                  $totalcredit += $head->h_balance; 
                                  $totalliability += $head->h_balance;
                              }
                          echo '</td>
                        </tr>
                        ';
                    }
                    }
                }
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
               @if($customer->fr_balance != 0 || $customer->fr_opbalance != 0)
                <tr role="row" class="odd">
                  <td><?php echo $customer->fr_name; ?></td>
                  <td><?php $subtotal = number_format($customer->fr_balance, 2, '.', ','); 
                  
                        echo $subtotal;
                        $totaldebit += $customer->fr_balance; $totalcustomer += $customer->fr_balance;
                  
                   ?></td>
                  <td>-</td>
                </tr>
                
                @endif
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
                   @if($supplier->s_balance != 0 || $supplier->s_obalance != 0)
                   @if($supplier->s_company != "Bharmal International")
                    <tr role="row" class="odd">
                      <td><?php echo $supplier->s_company; ?></td>
                      <td>-</td>
                      <td><?php $subtotal = number_format($supplier->s_balance, 2, '.', ','); 
                     
                          echo $subtotal;
                          $totalcredit += $supplier->s_balance; $totalsupplier += $supplier->s_balance;
                     
                       ?></td>
                    </tr>
                    @endif
                    @endif
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
                    if($head->h_balance != 0 || $head->h_opbalance != 0 ){
                          echo '
                        <tr role="row" class="odd">';
                          echo '<td>';
                          echo $head->h_name;
                          echo '</td> <td>';
                          $subtotal = number_format($head->h_balance, 2, '.', ',');
                         
                              echo $subtotal;
                              $totaldebit += $head->h_balance; 
                              $totalexpense += $head->h_balance; 
                        
                          echo '</td>
                          <td></td>
                        </tr>
                        ';
                    }
                            
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
                    if($head->h_balance != 0 || $head->h_opbalance != 0 ){
                        
                        echo '
                        <tr role="row" class="odd">
                          <td>';
                          echo $head->h_name;
                          echo '</td>
                          <td>-</td>
                          <td>';
                          $subtotal = number_format($head->h_balance, 2, '.', ','); 
                        //   echo $subtotal;
                          if($subtotal == 0){
                                $subtotalo = number_format($head->h_opbalance, 2, '.', ','); 
                                echo $subtotalo;
                                $totalcredit += $head->h_opbalance;
                                $totalincome += $head->h_opbalance;
                          }else{
                            echo $subtotal;
                            $totalcredit += $head->h_balance;
                            $totalincome += $head->h_balance;
                          }
                          
                          echo '</td>
                        </tr>
                        ';
                        
                    }    
                }
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
                <?php $saletotal = 0;$salereturntotal=0; ?>
                <tr role="row" class="odd">
                  <?php foreach ($sales as $sale):?>
                  <?php $saletotal +=  $sale->sl_totalprice;?>
                   <?php endforeach; ?>
                    <?php foreach ($salesreturn as $sale):?>
                        <?php $salereturntotal +=  $sale->slr_saleprice;?>
                    <?php endforeach; ?>
                    <?php $finalSalePrice = $saletotal - $salereturntotal ?>
                  <td>Total Sales</td>
                  <td>-</td>
                  <td><?php $subtotal = number_format($finalSalePrice, 2, '.', ','); echo $subtotal; ?></td>
                   <?php $totalcredit += $finalSalePrice; ?>
                </tr>
                 <tr>
                  <td class="text-white bg-dark">Purchase</td>
                  <td class="bg-dark"></td>
                  <td class="bg-dark"></td>
                </tr>
                <?php $purchasetotal = 0;$purchasereturntotal =0; ?>
                <tr role="row" class="odd">
                  <?php foreach ($purchases as $purchase):?>
                  <?php $purchasetotal +=  $purchase->po_grandtotal;?>
                  <?php endforeach; ?>
                   
                    <?php foreach ($purchasesreturn as $purchase):?>
                        <?php $purchasereturntotal +=  $purchase->h_balance;?>
                        <?php endforeach; ?>
                        <?php $purchasetotal = $purchasetotal + $purchasereturntotal; ?>
                   
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
