<!-- show.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->expenseledgersview) && Auth::user()->expenseledgersview == '1')
      { ?>

<!-- WORK AREA START -->

           <h3 align="center" class="text-primary">
            Expense Report 
          </h3>
          <br>
          <br>
           <input id="myInput" type="text" placeholder="Search.." class="form-control" onfocusout="calcFunction()">
         <br>
          <h4> Enter a Range  </h4>
          
          <br>
          <div class="form-group">
            <label for="fromdate" class="text-primary">From Date</label>
            <input class="form-control" type='date' id='fromdate' name='fromdate' required/> 
          </div>
         <div class="form-group">
            <label for="todate" class="text-primary">To Date</label>
            <input class="form-control" type='date' id='todate' name='todate'  required/> 
          </div>
          <input type="submit" value="Show" onclick="rangeCal()" /> 
        <div align="right">
        <a href="javascript:printDiv('datatables')">Print</a><br>
        <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
        </div>
       
         <div id="div1"> 
           <table style="width: 100%;" id="myTable" border=".5px" class="table table-striped table-bordered table-hover dataTable dtr-inline">
              <thead class="bg-primary">
                <tr class="bg-primary header text-white" style="text-align: left">
                  <th style="display: none" id="spn">01-Apr-1900 10:31:48 AM</th>
                  <th style="width: 50px;font-size: 10px">Date</th>
                  <th style="width: 29px;font-size: 10px">Name</th>
                  <th style="width: 29px;font-size: 10px">Head</th>
                  <th style="width: 29px;font-size: 10px">P-Head</th>
                  <th style="width: 29px;font-size: 10px">Description</th>
                  <th style="width: 29px;font-size: 10px">Voucher</th>
                  <th style="width: 80px;font-size: 10px">Debit</th>
                  <th style="width: 80px;font-size: 10px">Credit</th>
                </tr>
              </thead>

              <tbody>

              <?php foreach ($voucher as $vouchers):?>

                 <?php if($vouchers->ct_head == '0') {} else { ?>

                 <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($vouchers->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $vouchers->ct_name ?></td>
                  <td><?php echo $vouchers->ct_head ?></td>
                  <td><?php echo $vouchers->h_stype ?></td>
                  <td><?php echo $vouchers->ct_description ?></td>
                  <td><?php echo $vouchers->vr_no ?></td>
                  <td><?php   $subtotal =  number_format($vouchers->ct_amount, 2, '.', ','); echo $subtotal;  ?>  <input type="text" name="debit[]" value="<?php echo $vouchers->ct_amount ?>" style = 'display: none'>
                  </td>
                   <td><input type="hidden" name="credit[]" value="-"> <span>-</span></td>
               </tr>
               <?php } endforeach; ?>

               <?php foreach ($rvoucher as $rvouchers):?>
                <?php if($rvouchers->cr_head == '0') {} else { ?>
                 <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($rvouchers->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $rvouchers->cr_name ?></td>
                  <td><?php echo $rvouchers->cr_head ?></td>
                  <td><?php echo $rvouchers->h_stype ?></td>
                  <td><?php echo $rvouchers->cr_description ?></td>
                  <td><?php echo $rvouchers->crv_no ?></td>
                  <td><input type="hidden" name="debit[]" value="-"> <span>-</span></td>
                  <td><?php   $subtotal =  number_format($rvouchers->cr_amount, 2, '.', ','); echo $subtotal;  ?>  <input type="text" name="credit[]" value="<?php echo $rvouchers->cr_amount ?>" style = 'display: none'></td>
               </tr>
               <?php } endforeach; ?>

               <?php foreach ($bankvoucher as $bankvouchers):?>
                 <?php if($bankvouchers->ex_ID == '0') {} else { ?>

                 <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($bankvouchers->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $bankvouchers->ex_name ?></td>
                  <td><?php echo $bankvouchers->ex_ID ?></td>
                  <td><?php echo $bankvouchers->h_stype ?></td>
                  <td><?php echo $bankvouchers->bt_description ?></td>
                  <td><?php echo $bankvouchers->bkvr_no ?></td>
                   <td><?php   $subtotal =  number_format($bankvouchers->bt_amount, 2, '.', ','); echo $subtotal;  ?>  <input type="text" name="debit[]" value="<?php echo $bankvouchers->bt_amount ?>" style = 'display: none'></td>
                  <td><input type="hidden" name="credit[]" value="-"> <span>-</span></td>
                 
               </tr>
               <?php } endforeach; ?>

               <?php foreach ($bankrvoucher as $bankrvouchers):?>
                <?php if($bankrvouchers->br_head == '0') {} else { ?>
                
                 <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($bankrvouchers->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $bankrvouchers->br_name ?></td>
                  <td><?php echo $bankrvouchers->br_head ?></td>
                  <td><?php echo $bankrvouchers->h_stype ?></td>
                  <td><?php echo $bankrvouchers->br_description ?></td>
                  <td><?php echo $bankrvouchers->brv_no ?></td>
                  <td><input type="hidden" name="debit[]" value="-"> <span>-</span></td>
                  <td><?php   $subtotal =  number_format($bankrvouchers->br_amount, 2, '.', ','); echo $subtotal;  ?>  <input type="text" name="credit[]" value="<?php echo $bankrvouchers->br_amount ?>" style = 'display: none'></td>
                 
               </tr>
               <?php } endforeach; ?>

                <?php foreach ($journalvoucher as $journalvouchers):?>
                <?php if($journalvouchers->h_stype == '') {} else { ?>
                
                 <tr style="font-size: 10px" class="line[]">
                  <td><?php  $newDate = date("d-M-Y", strtotime($journalvouchers->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $journalvouchers->jv_acc_name ?></td>
                  <td><?php echo $journalvouchers->jv_acc_ID ?></td>
                  <td><?php echo $journalvouchers->h_stype ?></td>
                  <td><?php echo $journalvouchers->jv_description ?></td>
                  <td><?php echo $journalvouchers->jv_no ?></td>
                  <td>
                  <?php if($journalvouchers->jv_acc_status == 'Debit'){
                  echo '<input type="hidden" name="debit[]" value="'.$journalvouchers->jv_amount.'"> 
                  <span> '.$subtotal =  number_format($journalvouchers->jv_amount, 2, '.', ',').'</span>';
                    } 
                     else{
                      echo '<input type="hidden" name="debit[]" value="-">  <span>-</span>';
                          }  ?>
                  </td>
                  <td>
                    <?php if($journalvouchers->jv_acc_status == 'Credit') {
                      echo '<input type="hidden" name="credit[]" value="'.$journalvouchers->jv_amount.'"> 
                      <span> '.$subtotal =  number_format($journalvouchers->jv_amount, 2, '.', ',').'</span>';
                       } 
                       else{
                        echo '<input type="hidden" name="credit[]" value="-"> <span>-</span>';
                            }  ?>
                  </td>
                 
               </tr>
               <?php } endforeach; ?>



              </tbody>
            </table>


                <div class="form-inline table-primary">

                 <div class="form-group" style="width: 50%">
                    <label for="toodate" class="text-dark" >Total Debit:</label>
                    &nbsp &nbsp<span id="totaldebit"></span>
                  </div>

                   <div class="form-group" style="width: 50%">
                    <label for="toodate" class="text-dark" >Total Credit:</label>
                     &nbsp &nbsp<span id="totalcredit"></span>
                  </div>

                </div>
                 <div class="form-group">
                    <label for="toodate" class="text-dark" >Balance:</label>
                     &nbsp &nbsp<span id="totalbalance"></span>
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
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"> <h3 align="center"> Expense Report </h3></div> ')
            function printDiv(divId) {
                // document.getElementsByClassName("form-control-sm")[0].style.visibility = 'hidden';  
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').outerHTML;
                // document.getElementsByClassName("form-control-sm")[0].style.visibility = 'visible';  
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }
  </script>       

<script src="{{asset('assets/sorting.js')}}"></script>
<script type="text/javascript">
  // FOR RANGE CALCULATION
  function rangeCal() {

    var table, rows, fromdate, todate;
    table = document.getElementById("myTable");
    rows = table.rows;
    fromdate = document.getElementById("fromdate");
    todate = document.getElementById("todate");

    for (var i = 1; i < (rows.length); i++) {
      x = rows[i].getElementsByTagName("TD")[0];
       if(x !== undefined)
      {
      var compdate = Date.parse(x.innerHTML);
      }
      
      if(Date.parse(fromdate.value + ' 12:00 AM') <= compdate  && Date.parse(todate.value + ' 11:59 PM') >= compdate)
      {

      }
      else{
        rows[i].style.visibility = "hidden";
        // rows[i].remove();
       // document.getElementById("datatables1").deleteRow(i); 
      }
  }
   for (var j = 1; j < (rows.length - 1); j++) {
      if(rows[j].style.visibility === "hidden")
      {
       rows[j].hidden = true;
       }
       else{

       }
      }

  totaldebit();
  totalcredit(); 
  totalbalance(); 
 
    }


//  FOR TOTAL DEBIT AND CREDIT

setTimeout(function()
 { 
  totaldebit();
  totalcredit();
  totalbalance(); 
 }, 1500);


document.getElementById('myInput').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
      // Enter pressed
        totaldebit();
        totalcredit();
        totalbalance();
    }
  }

 function calcFunction() {
    totaldebit();
    totalcredit();
    totalbalance();
 } 

 function totaldebit(){ 
  var debit = document.getElementsByName('debit[]');
  var totaldebit;
  var line = document.getElementsByClassName('line[]');
  var b = 0;
  var runningtotal = document.getElementById('totaldebit');
   for(var i=0;i<line.length;i++){

   if(line[i].style.visibility === "hidden" || line[i].style.display === "none")
   {
   
   }
   else{ 
    if(parseFloat(debit[i].value))
    {
    b += parseFloat(debit[i].value); 
    runningtotal.innerHTML = b.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    else{
    
      b += 0;
     runningtotal.innerHTML = b.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
    }
  }

  }
}

function totalcredit(){ 
  var credit = document.getElementsByName('credit[]');
  var totalcredit;
  var line = document.getElementsByClassName('line[]');
  var c = 0;
  var runningtotal = document.getElementById('totalcredit');
   for(var i=0;i<line.length;i++){

    if(line[i].style.visibility === "hidden" || line[i].style.display === "none")
   {

   }
 else{
    if(parseFloat(credit[i].value))
    {
    c += parseFloat(credit[i].value); 
    runningtotal.innerHTML = c.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    else{

      c += 0;
      runningtotal.innerHTML = c.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     
    }
  }

  }
}

function totalbalance(){ 
  var debit = document.getElementById('totaldebit');
  var credit =  document.getElementById('totalcredit');
  var b = parseFloat(debit.innerHTML.replace(/,/g, ''))  - parseFloat(credit.innerHTML.replace(/,/g, ''));
  b = b.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
   document.getElementById('totalbalance').innerHTML = b;
}
</script>
 
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>   