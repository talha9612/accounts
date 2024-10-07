<!-- show.blade.php -->
@extends('master')
@section('content')
 <?php
  if(isset(Auth::user()->customerledgersview) && Auth::user()->customerledgersview == '1')
      { ?>
<!-- WORK AREA START -->
<input type="hidden" name="counter" id="counter" value="">
<?php foreach ($balances as $orbalance):?>
           <h3 align="center" class="text-primary">
            Customer Ledger (<?php echo $orbalance->fr_name; ?>-<?php echo $orbalance->fr_fname; ?>)
          </h3>
          <br>
           <div class="form-inline" align="center">
            <div class="form-group" style="width: 33%">
            <label for="bk_branch_code" class="bmd-label-floating text-primary">Opening Balance</label>
            <input class="form-control" type='text'
            value="<?php $subtotal =  number_format($orbalance->ob_amount, 2, '.', ',');
                    echo $subtotal; ?>" id='opbalance' name='opbalance' readonly required style="width: 95%"/>
            <input type="hidden" name="openingbalance" id="openingbalance" value="<?php echo $orbalance->ob_amount ?>">
          </div>
          <div class="form-group" style="width: 33%">
            <label for="bk_branch_code" class="bmd-label-floating text-primary">Remaining Balance</label>
            <input class="form-control" type='text'
            value="<?php $subtotal =  number_format($orbalance->fr_balance, 2, '.', ',');
                    echo $subtotal; ?>" id='crbalance' name='crbalance' readonly required style="width: 95%"/>
          </div>
          <div class="form-group" style="width: 33%">
            <label for="bk_branch_code" class="bmd-label-floating text-primary">Due Date</label>
            <input class="form-control" type='text'
            value="<?php echo $orbalance->fr_duedate; ?>" readonly required style="width: 95%"/>
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
                  <th style="width: 29px;font-size: 10px">Description</th>
                  <th style="width: 80px;font-size: 10px">Debit</th>
                  <th style="width: 80px;font-size: 10px">Credit</th>
                  <th style="width: 80px;font-size: 10px">Balance</th>
                </tr>
              </thead>
              <tbody>
                <?php $credit = 0;
                      $debit = 0;
                      $remaining = 0;
                ?>
               <?php foreach ($voucher as $cashtransactions):?>
                <tr style="font-size: 10px" class="line[]">
                  <td> <?php  $newDate = date("d-M-Y", strtotime($cashtransactions->created_at)); echo $newDate; ?> </td>
                  <td><?php echo $cashtransactions->sl_number; ?></td>
                  <td><?php echo $cashtransactions->sl_title; ?></td>
                  <td>
                  <input type="hidden" name="debit[]" value="<?php echo $cashtransactions->sl_grandtotal; ?> ">
                  <span><?php $subtotal =  number_format($cashtransactions->sl_grandtotal, 2, '.', ',');
                    echo $subtotal; $debit += $cashtransactions->sl_grandtotal; ?></span>
                   </td>
                  <td><input type="hidden" name="credit[]" value="-">
                    <span>-</span>
                  </td>
                  <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
                </tr>
                <?php $debit += $cashtransactions->sl_grandtotal; ?>
                <?php endforeach; ?>

                <?php foreach ($service as $services):?>
                <tr style="font-size: 10px" class="line[]">
                  <td> <?php  $newDate = date("d-M-Y", strtotime($services->created_at)); echo $newDate; ?> </td>
                  <td><?php echo $services->svi_number; ?></td>
                  <td><?php echo $services->svi_crorder; ?></td>
                  <td>
                  <input type="hidden" name="debit[]" value="<?php echo $services->svi_grandtotal; ?> ">
                  <span><?php $subtotal =  number_format($services->svi_grandtotal, 2, '.', ',');
                    echo $subtotal; $debit += $services->svi_grandtotal; ?></span>
                   </td>
                  <td><input type="hidden" name="credit[]" value="-">
                    <span>-</span>
                  </td>
                  <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
                </tr>
                <?php $debit += $services->svi_grandtotal; ?>
                <?php endforeach; ?>


              <?php foreach ($return as $returns):?>
                <?php $sale = $returns->slr_saleprice * $returns->slr_quantity;  ?>
                <tr style="font-size: 10px" class="line[]">
                  <td> <?php  $newDate = date("d-M-Y", strtotime($returns->created_at)); echo $newDate; ?> </td>
                  <td><?php echo $returns->slr_number; ?></td>
                  <td><?php echo $returns->slr_item; ?></td>
                  <td><input type="hidden" name="debit[]" value="-">
                    <span>-</span>
                  </td>
                  <td>
                  <input type="hidden" name="credit[]" value="<?php echo $sale; ?> ">
                  <span><?php $subtotal =  number_format($sale, 2, '.', ',');
                    echo $subtotal; $credit += $sale; ?> X <b>(<?php echo $returns->slr_quantity; ?>)</b></span>
                   </td>

                  <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
                </tr>
                <?php $credit += $sale; ?>
                <?php endforeach; ?>

                <?php foreach ($jv as $cashtransactions):?>
                <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($cashtransactions->created_at)); echo $newDate; ?> </td>
                  <td><?php echo $cashtransactions->jv_no; ?></td>
                  <td><?php echo $cashtransactions->jv_description; ?></td>
                  <td>
                    <?php if($cashtransactions->jv_acc_status == 'Debit'){
                    echo '<input type="hidden" name="debit[]" value="'.$cashtransactions->jv_amount.'">
                    <span> '.$subtotal =  number_format($cashtransactions->jv_amount, 2, '.', ',').'</span>';
                       $debit += $cashtransactions->jv_amount;}
                       else{
                        echo '<input type="hidden" name="debit[]" value="-">  <span>-</span>';
                            }  ?>
                    </td>
                    <td>
                      <?php if($cashtransactions->jv_acc_status == 'Credit') {
                        echo '<input type="hidden" name="credit[]" value="'.$cashtransactions->jv_amount.'">
                        <span> '.$subtotal =  number_format($cashtransactions->jv_amount, 2, '.', ',').'</span>';
                         $credit += $cashtransactions->jv_amount;}
                         else{
                          echo '<input type="hidden" name="credit[]" value="-"> <span>-</span>';
                              }  ?>
                    </td>
                    <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
                </tr>
                <?php endforeach; ?>

                <?php foreach ($fp as $cashtransactions):?>
                <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($cashtransactions->created_at)); echo $newDate; ?> </td>
                  <td><?php echo $cashtransactions->vr_number; ?></td>
                  <td><?php echo $cashtransactions->fp_description; ?></td>
                   <td><input type="hidden" name="debit[]" value="-">
                    <span>-</span>
                  </td>
                  <td>
                  <input type="hidden" name="credit[]" value="<?php echo $cashtransactions->fp_amount;  ?>">
                  <span><?php $subtotal =  number_format($cashtransactions->fp_amount, 2, '.', ',');
                    echo $subtotal; $credit += $cashtransactions->fp_amount; ?></span>
                   </td>
                  <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
                </tr>
                <?php $credit += $cashtransactions->fp_amount; ?>
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
           
 
            <?php
            $remaining =  $credit - $debit;
            if($balances ==null){
                 $remaining = 0 + $remaining;
                 $orbalance = new \stdClass();
                 $orbalance->fr_name ='';
                 $orbalance->ob_amount = 0;
            }else{
                $remaining = $orbalance->ob_amount + $remaining;
            }
            ?>

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
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <br> <span style="font-size:11px"><?php echo $orbalance->fr_name; ?> <br> Opening Balance: <?php $subtotal =  number_format($orbalance->ob_amount, 2, '.', ','); echo $subtotal; ?> <br>Current Balance: </span>')
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
