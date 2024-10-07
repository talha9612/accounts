  <!-- show.blade.php -->
  @extends('master')
  @section('content')

  <?php
    if(isset(Auth::user()->bankledgersview) && Auth::user()->bankledgersview == '1')
        { ?>
  <!-- WORK AREA START -->
  <input type="hidden" name="counter" id="counter" value="">
            <?php foreach ($balances as $orbalance):?>
             <h3 align="center" class="text-primary">
              Bank Ledger (<?php echo $orbalance->acc_title; ?>)
            </h3>
            <br>
             <div class="form-inline" align="center">
              <div class="form-group" style="width: 50%">
              <label for="bk_branch_code" class="bmd-label-floating text-primary">Opening Balance</label>
              <input class="form-control" type='text'
              value="<?php $subtotal =  number_format($orbalance->ob_amount, 2, '.', ','); echo $subtotal; ?>" id='opbalance' name='opbalance' required style="width: 90%"/>
              <input type="hidden" name="openingbalance" id="openingbalance" value="<?php echo $orbalance->ob_amount ?>">
            </div>
            <div class="form-group" style="width: 50%">
              <label for="bk_branch_code" class="bmd-label-floating text-primary">Current Balance</label>
              <input class="form-control" type='text'
              value="<?php $subtotal =  number_format($orbalance->acc_balance, 2, '.', ','); echo $subtotal; ?>" id='crbalance' name='crbalance' required style="width: 90%"/>
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
            <br>
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
                <thead class="bg-primary">
                  <tr  class="bg-primary header text-white" style="text-align: left">
                    <th style="display: none" id="spn">01-Apr-1900 10:31:48 AM</th>
                    <th style="width: 50px;font-size: 10px">Date</th>
                    <th style="width: 50px;font-size: 10px">Voucher #</th>
                    <th style="width: 29px;font-size: 10px">Name</th>
                    <th style="width: 29px;font-size: 10px">Description</th>
                    <th style="width: 80px;font-size: 10px">Debit</th>
                    <th style="width: 80px;font-size: 10px">Credit</th>
                    <th style="width: 80px;font-size: 10px">Balance</th>
                    <th style="width: 80px;font-size: 10px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $totaldebit = 0; $totalcredit = 0; ?>
                 <?php foreach ($voucher as $cashtransactions):?>
                  <tr role="row" class="line[]" style="font-size: 10px">
                    <td> <?php  $newDate = date("d-M-Y", strtotime($cashtransactions->created_at)); echo $newDate; ?> </td>
                    <td><?php echo $cashtransactions->bkvr_no; ?></td>
                    <td><?php echo $cashtransactions->ex_name; ?></td>
                    <td><?php echo $cashtransactions->bt_description; ?></td>
                    <td><input type="hidden" name="debit[]" value="-"> <span>-</span></td>
                    <td>
                    <input type="hidden" name="credit[]" value="<?php  echo $cashtransactions->bt_amount;  ?>">
                    <span><?php $subtotal =  number_format($cashtransactions->bt_amount, 2, '.', ',');
                      echo $subtotal; $totalcredit += $cashtransactions->bt_amount; ?></span>
                     </td>
                    <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>

                    <td class="hid">
                       <?php if($cashtransactions->ex_name === ""){ ?>
                       <a  href="{{action('JvController@show', $cashtransactions->bkvr_no)}}" style="font-size: 10px">view</a>
                      <?php } else { ?>
                       <a  href="{{action('BanktransactionController@show', $cashtransactions->bkvr_no)}}" style="font-size: 10px">view</a>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                 <?php foreach ($rvoucher as $rcashtransactions):?>
                   <tr role="row" class="line[]" style="font-size: 10px">
                    <td><?php  $newDate = date("d-M-Y", strtotime($rcashtransactions->created_at)); echo $newDate; ?></td>
                    <td><?php echo $rcashtransactions->brv_no; ?></td>
                    <td><?php echo $rcashtransactions->br_name; ?></td>
                    <td><?php echo $rcashtransactions->br_description; ?></td>
                    <td>
                    <input type="hidden" name="debit[]" value="<?php echo $rcashtransactions->br_amount;  ?>">
                    <span><?php $subtotal =  number_format($rcashtransactions->br_amount, 2, '.', ',');
                      echo $subtotal; $totaldebit += $rcashtransactions->br_amount; ?></span>
                     </td>
                    <td><input type="hidden" name="credit[]" value="-"> <span>-</span></td>
                    <td> <span class="balance"></span> <input type="hidden" name="balance[]"></td>
                    <td class="hid">
                       <?php if($rcashtransactions->br_name === ""){ ?>
                       <a  href="{{action('JvController@show', $rcashtransactions->brv_no)}}" style="font-size: 10px">view</a>
                      <?php } else { ?>
                       <a  href="{{action('BankreceiptController@show', $rcashtransactions->brv_no)}}" style="font-size: 10px">view</a>
                      <?php } ?>
                    </td>
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

               <?php
               $remaining =  $totaldebit - $totalcredit;
               if($balances ==null){
                    $remaining = 0 + $remaining;
                    $orbalance = new \stdClass();
                    $orbalance->acc_title ='';
                    $orbalance->ob_amount = 0;
                    $orbalance->acc_balance=0;
               }else{
                   $remaining = $orbalance->ob_amount + $remaining;
               }

               ?>
              <br>
              <br>
              <br>
               <label for="vr_no" class="bmd-label-floating text-primary">Remaining Balance</label>
              <input class="form-control" type='text' value="<?php $subtotal =  number_format($remaining, 2, '.', ','); echo $subtotal; ?>" readonly/>
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
              <br>
              <br>
         <!-- WORK AREA END -->

  <script>
// For Top Current Balance correction
    // Get the PHP value from the server-side
    var valueFromPHP = <?php echo json_encode($remaining); ?>;
    // Set the value of the input field using JavaScript
    var inputField = document.getElementById('crbalance');
    inputField.value = valueFromPHP.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
// Top Current End Here //
        printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <br> <span style="font-size:11px"><?php echo $orbalance->acc_title; ?> <br> Opening Balance: <?php $subtotal =  number_format($orbalance->ob_amount, 2, '.', ','); echo $subtotal; ?> <br>Current Balance: <?php $subtotal =  number_format($orbalance->acc_balance, 2, '.', ','); echo $subtotal; ?></span> <br>')
            function printDiv(divId) {
               var hid = document.getElementsByClassName("hid");
              for(var i=0; i<hid.length; i++)
              {
                document.getElementsByClassName("hid")[i].style.visibility = 'hidden';
                // document.getElementsByClassName("form-control-sm")[0].style.visibility = 'hidden';
              }
              window.frames["print_frame"].document.body.innerHTML= printDivCSS + document.getElementById('div1').outerHTML;
              for(var i=0; i<hid.length; i++)
              {
                document.getElementsByClassName("hid")[i].style.visibility = 'visible';
                // document.getElementsByClassName("form-control-sm")[0].style.visibility = 'visible';
              }
              window.frames["print_frame"].window.focus();
              window.frames["print_frame"].window.print();
            }

    </script>
  <script src="{{asset('assets/sorting.js')}}"></script>
  <script async defer src="{{asset('assets/range.js')}}"></script>

   @endsection
   <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
   <?php  } else {  redirect()->to('home')->send(); } ?>
