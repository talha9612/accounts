<!-- show.blade.php -->
@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->incomeledgersview) && Auth::user()->incomeledgersview == '1')
      { ?>
<!-- WORK AREA START -->
<input type="hidden" name="counter" id="counter" value="Income ledger">
      <?php foreach ($assetbalances as $assetorbalance):?>
           <h3 align="center" class="text-primary">
            Income Ledger (<?php echo $assetorbalance->h_name; ?>)
          </h3>
          <br>
           <div class="form-inline" align="center">
            <div class="form-group" style="width: 50%">
            <label for="bk_branch_code" class="bmd-label-floating text-primary">Opening Balance</label>
            <input class="form-control" type='text' value="<?php $subtotal =  number_format($assetorbalance->ob_amount, 2, '.', ','); echo $subtotal; ?>" id='opbalance' name='opbalance' readonly style="width: 90%"/> 
            <input type="hidden" name="openingbalance" id="openingbalance" value="<?php echo $assetorbalance->ob_amount ?>">
          </div>
          <div class="form-group" style="width: 50%">
            <label for="bk_branch_code" class="bmd-label-floating text-primary">Current Balance</label>
            <input class="form-control" type='text' id='crbalance' name='crbalance' value="<?php $subtotal =  number_format($assetorbalance->h_balance, 2, '.', ','); echo $subtotal; ?>" readonly style="width: 90%"/> 
          </div>
        </div>
           <b> Enter a Range  </b>
           <div class="form-inline" align="center">
            <div class="form-group" style="width: 50%">
              <label for="fromdate" class="text-primary">From Date</label>
              <input class="form-control" type='date' id='fromdate' name='fromdate' required style="width: 90%"/> 
            </div>
           <div class="form-group" style="width: 40%">
              <label for="todate" class="text-primary">To Date</label>
              <input class="form-control" type='date' id='todate' name='todate'  required style="width: 95%"/> 
            </div>
           <div class="form-group" style="width: 10%">
            <input type="submit" value="Show" class="btn-warning btn btn-md" onclick="rangeCal()"/>
            </div>
          </div>
            <?php endforeach; ?> 
            <div class="form-inline"> 
              <div style="width: 90%" align="rigt">
               <input id="myInput" type="text" placeholder="Search.." class="form-control" onfocusout="calcFunction()" style="width: 95%">
               </div>
            <div style="width: 10%"> 
              <a href="javascript:printDiv('datatables')" class="btn-primary btn btn-md">Print</a><br>
              <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
              </div>
             </div>
         <div id="div1"> 
           <table style="width: 100%;" id="myTable" border=".5px" class="table table-striped table-bordered table-hover dataTable dtr-inline">
              <thead class="bg-primary text-white">
                <tr class="bg-primary header text-white" style="text-align: left">
                  <th style="display: none" id="spn">01-Apr-1900 10:31:48 AM</th>
                  <th style="width: 50px;font-size: 10px">Date</th>
                  <th style="width: 50px;font-size: 10px">Voucher #</th>
                  <th style="width: 29px;font-size: 10px">Head</th>
                  <th style="width: 29px;font-size: 10px">Name</th>
                  <th style="width: 29px;font-size: 10px">Description</th>
                  <th style="width: 80px;font-size: 10px">Debit</th>
                  <th style="width: 80px;font-size: 10px">Credit</th>
                  <th style="width: 80px;font-size: 10px">Balance</th>
                </tr>
              </thead>
              <tbody>
              <?php $totaldebit = 0; $totalcredit = 0; ?>
               <?php foreach ($voucher as $cashtransactions):?>
                <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($cashtransactions->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $cashtransactions->vr_no; ?></td>
                  <td><?php echo $cashtransactions->ct_head; ?></td>
                  <td><?php echo $cashtransactions->ct_name; ?></td>
                  <td><?php echo $cashtransactions->ct_description; ?></td>
                  <td>
                  <input type="hidden" name="debit[]" value="<?php echo $cashtransactions->ct_amount; ?> ">
                  <span><?php $subtotal =  number_format($cashtransactions->ct_amount, 2, '.', ',');
                    echo $subtotal; $totaldebit += $cashtransactions->ct_amount; ?></span>
                   </td>

                  <td><input type="hidden" name="credit[]" value="-"> 
                    <span>-</span>
                  </td>
                  <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
                </tr>
                <?php endforeach; ?>

               <?php foreach ($rvoucher as $rcashtransactions):?>
                 <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($rcashtransactions->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $rcashtransactions->crv_no; ?></td>
                  <td><?php echo $rcashtransactions->cr_head; ?></td>
                  <td><?php echo $rcashtransactions->cr_name; ?></td>
                  <td><?php echo $rcashtransactions->cr_description; ?></td>
                   <td><input type="hidden" name="debit[]" value="-"> 
                    <span>-</span>
                  </td>
                  <td>
                  <input type="hidden" name="credit[]" value="<?php echo $rcashtransactions->cr_amount; ?>">
                  <span><?php $subtotal =  number_format($rcashtransactions->cr_amount, 2, '.', ',');
                    echo $subtotal; $totalcredit += $rcashtransactions->cr_amount; ?></span>
                   </td>
                  <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
               </tr>
               <?php endforeach; ?>

               <?php foreach ($bankvoucher as $banktransactions):?>
                <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($banktransactions->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $banktransactions->bkvr_no; ?></td>
                  <td><?php echo $banktransactions->ex_ID; ?></td>
                  <td><?php echo $banktransactions->ex_name; ?></td>
                  <td><?php echo $banktransactions->bt_description; ?></td>
                  <td>
                  <input type="hidden" name="debit[]" value="<?php echo $banktransactions->bt_amount;  ?>">
                  <span><?php $subtotal =  number_format($banktransactions->bt_amount, 2, '.', ',');
                    echo $subtotal; $totaldebit += $banktransactions->bt_amount; ?></span>
                   </td>
                  <td><input type="hidden" name="credit[]" value="-"> 
                    <span>-</span>
                  </td>
                  <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
                </tr>
                <?php endforeach; ?>

               <?php foreach ($bankrvoucher as $rbanktransactions):?>
                 <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($rbanktransactions->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $rbanktransactions->brv_no; ?></td>
                  <td><?php echo $rbanktransactions->br_head; ?></td>
                  <td><?php echo $rbanktransactions->br_name; ?></td>
                  <td><?php echo $rbanktransactions->br_description; ?></td>
                    <td><input type="hidden" name="debit[]" value="-"> 
                    <span>-</span>
                  </td>
                  <td>
                  <input type="hidden" name="credit[]" value="<?php echo $rbanktransactions->br_amount;  ?>">
                  <span><?php $subtotal =  number_format($rbanktransactions->br_amount, 2, '.', ',');
                    echo $subtotal; $totalcredit += $rbanktransactions->br_amount; ?></span>
                   </td>
                  <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
               </tr>
               <?php endforeach; ?>

               <?php foreach ($journalvoucher as $journalvouchers):?>
                 <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($journalvouchers->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $journalvouchers->jv_no; ?></td>
                  <td><?php echo $journalvouchers->jv_acc_ID; ?></td>
                  <td><?php echo $journalvouchers->jv_acc_name; ?></td>
                  <td><?php echo $journalvouchers->jv_description; ?></td>
                  <td>
                  <?php if($journalvouchers->jv_acc_status == 'Debit'){
                  echo '<input type="hidden" name="debit[]" value="'.$journalvouchers->jv_amount.'"> 
                  <span> '.$subtotal =  number_format($journalvouchers->jv_amount, 2, '.', ',').'</span>';
                     $totaldebit += $journalvouchers->jv_amount;} 
                     else{
                      echo '<input type="hidden" name="debit[]" value="-">  <span>-</span>';
                          }  ?>
                  </td>

                  <td>
                    <?php if($journalvouchers->jv_acc_status == 'Credit') {
                      echo '<input type="hidden" name="credit[]" value="'.$journalvouchers->jv_amount.'"> 
                      <span> '.$subtotal =  number_format($journalvouchers->jv_amount, 2, '.', ',').'</span>';
                       $totalcredit += $journalvouchers->jv_amount;} 
                       else{
                        echo '<input type="hidden" name="credit[]" value="-"> <span>-</span>';
                            }  ?>
                  </td>
                   <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
               </tr>
               <?php endforeach; ?>
              </tbody>
            </table>

              <div class="form-inline table-primary">
                 <div class="form-group" style="width: 50%">
                    <label for="todate" class="text-dark" >Total Debit:</label>
                    &nbsp &nbsp<span id="totaldebit"></span>
                  </div>

                   <div class="form-group" style="width: 50%">
                    <label for="todate" class="text-dark" >Total Credit: </label>
                     &nbsp &nbsp<span id="totalcredit"></span>
                  </div>
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
            <br>
            <br>
       <!-- WORK AREA END -->  
<script>
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <br> <span style="font-size:11px"><?php echo $assetorbalance->h_name; ?> <br> Opening Balance: <?php $subtotal =  number_format($assetorbalance->ob_amount, 2, '.', ','); echo $subtotal; ?> <br>Current Balance: <?php $subtotal =  number_format($assetorbalance->h_balance, 2, '.', ','); echo $subtotal; ?></span> <br>')
            function printDiv(divId) {
                // document.getElementsByClassName("form-control-sm")[0].style.visibility = 'hidden';  
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').outerHTML;
                // document.getElementsByClassName("form-control-sm")[0].style.visibility = 'visible';
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }
  </script>        

<script src="{{asset('assets/sorting.js')}}"></script>
<script async defer src="{{asset('assets/range.js')}}"></script> 


 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>
