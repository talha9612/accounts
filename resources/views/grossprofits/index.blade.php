@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->grossprofitview) && Auth::user()->grossprofitview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     GP <small class="text-muted">(Gross Profit)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Gross Profit</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--   Here you can write extra buttons/actions for the toolbar  -->
          </div>
          <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
          <br>      
          <h4> Enter a Range  </h4>
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
                    <input id="myInput" type="text" placeholder="Search.." class="form-control" onfocusout="calcFunction()">
          <br>
         <div id="div1">
              <table style="width: 100%;" id="myTable" border=".5px" class="table table-striped table-bordered table-hover dataTable dtr-inline">
                  <thead class="bg-primary">
                    <tr class="bg-primary header text-white" style="text-align: left">
                      <th style="display: none" id="spn">01-Apr-1900 10:31:48 AM</th>
                      <th class="sorting text-white" style="width: 20px;font-size: 10px">Date</th>
                      <th class="sorting text-white" style="width: 5px;font-size: 10px">S-N</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">Customer</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">Item</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">Model</th>
                      <th class="sorting text-white" style="width: 5px;font-size: 10px">Qty</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">Lot</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">C-U</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">S-U</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">Total Cost</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">Total Sale</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">Profit</th>
                      <th class="sorting text-white" style="width: 10px;font-size: 10px">Return</th> 
                    </tr>
                  </thead>

                  <tbody>
                    <?php 
                     $totalcost = 0;
                     $profit = 0;
                     $totalprofit = 0;
                    ?>
                      <?php foreach ($gp as $gps):?>
                      <?php $totalcost = $gps->ss_costunit * $gps->sl_quantity; ?>
                      <?php $profit = $gps->sl_total - $totalcost; ?>
                    <tr style="font-size: 10px" class="line[]">
                      <td> <?php  $newDate = date("d-M-Y", strtotime($gps->created_at)); echo $newDate; ?> </td>
                      <td><?php echo $gps->sl_number; ?></td>
                      <td><?php echo $gps->fr_name; ?></td>
                      <td><?php echo $gps->sl_item; ?></td>
                      <td><?php echo $gps->sl_size; ?></td>
                      <td><?php echo $gps->sl_quantity; ?> <input type="hidden" name="quantity[]" value="<?php echo $gps->sl_quantity; ?>"></td>
                      <td><?php echo $gps->lot_number; ?></td>
                      <td><?php echo $gps->ss_costunit; ?></td>
                      <td><?php $subtotal =  number_format($gps->sl_saleprice, 2, '.', ',');
                        echo $subtotal; ?></td>
                      <td><?php $subtotal =  number_format($totalcost, 2, '.', ',');
                        echo $subtotal; ?></td>
                      <td><?php $subtotal =  number_format($gps->sl_total, 2, '.', ',');
                        echo $subtotal; ?></td>
                      <td><?php $subtotal =  number_format($profit, 2, '.', ',');
                        echo $subtotal; ?> <input type="hidden" name="profit[]" value="<?php echo $profit; ?>"></td>  
                      <td>-<input type="hidden" name="return[]" value="-"></td>  
                    </tr>
                    <?php $totalprofit += $profit; ?>
                    <?php endforeach; ?>

                  <?php 
                     $totalcost = 0;
                    $totalreturn = 0;
                    ?>
                  
                  <?php foreach ($return as $returns):?>
                      <?php $totalcost = $returns->ss_costunit * $returns->slr_quantity; ?>
                    <tr style="font-size: 10px" class="line[]">
                      <td> <?php  $newDate = date("d-M-Y", strtotime($returns->created_at)); echo $newDate; ?> </td>
                      <td><?php echo $returns->slr_number; ?></td>
                      <td><?php echo $returns->fr_name; ?></td>
                      <td><?php echo $returns->slr_item; ?></td>
                      <td><?php echo $returns->slr_size; ?></td>
                      <td><?php echo $returns->slr_quantity; ?><input type="hidden" name="quantity[]" value="<?php echo $returns->slr_quantity; ?>"></td>
                      <td><?php echo $returns->lot_number; ?></td>
                      <td><?php echo $returns->ss_costunit; ?></td>
                      <td><?php $subtotal =  number_format($returns->slr_saleprice, 2, '.', ',');
                        echo $subtotal; ?></td>
                      <td><?php $subtotal =  number_format($totalcost, 2, '.', ',');
                        echo $subtotal; ?></td>
                      <td><?php $subtotal =  number_format($returns->slr_saleprice * $returns->slr_quantity, 2, '.', ',');
                        echo $subtotal; ?></td>
                      <td>-<input type="hidden" name="profit[]" value="-"></td> 
                      <td><?php $subtotal =  number_format(($returns->slr_saleprice * $returns->slr_quantity) - $totalcost, 2, '.', ',');
                        echo $subtotal; ?><input type="hidden" name="return[]" value="<?php echo ($returns->slr_saleprice * $returns->slr_quantity) - $totalcost; ?>"></td> 
                    </tr>
                     <?php $totalreturn += ($returns->slr_saleprice * $returns->slr_quantity) - $totalcost; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
               <div class="form-inline"> 
                <div class="form-group" style="width: 20%">
                    <label for="bk_name" class="text-primary">Total Profit</label>
                    <!-- <input class="form-control" type='text' id='totalprofit' name='slr_name' readonly style="width: 99%"/> --><br>
                    <span id="totalprofit"></span>
                  </div>
                 <div class="form-group" style="width: 20%">
                    <label for="bk_name" class="text-primary">Balance Quantity</label>
                    <!-- <input class="form-control" type='text' id='totalquantity' name='totalquantity' readonly style="width: 99%"/> --><br>
                    <span id="totalquantity"></span> 
                  </div>  
                    <div class="form-group" style="width: 20%">
                    <label for="bk_name" class="text-primary">Return Quantity</label>
                    <!-- <input class="form-control" type='text' id='totalquantity' name='totalquantity' readonly style="width: 99%"/> --><br>
                    <span id="totalrquantity"></span> 
                  </div>  
                <div class="form-group" style="width: 20%">
                    <label for="bk_name" class="text-primary">Total Return</label>
                    <!-- <input class="form-control" type='text' id='totalreturn' readonly  style="width: 99%"/> --><br>
                    <span id="totalreturn"></span>
                  </div> 

                 <div class="form-group" style="width: 20%">
                    <label for="bk_name" class="text-primary">Accumulated Profit</label>
                    <!-- <input class="form-control" type='text' id='accprofit' readonly  style="width: 99%"/> --><br>
                    <span id="accprofit"></span>
                  </div>   
                  </div>               
              </div> 
                </div>

                  </div>
                    </div>
                      </div>
                        </div>
                          </div>
        <!-- end content-->

       <!-- WORK AREA END -->
<script>
                printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <div align="center">  <h3> GROSS PROFIT </h3> </div> ')
                function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').outerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }
  </script> 
<script>
  $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

const getCellValue = (tr, idx) => Date.parse(tr.children[idx].innerText) || Date.parse(tr.children[idx].textContent);

const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    Array.from(table.querySelectorAll('tr:nth-child(n)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.appendChild(tr) );
})));

jQuery(function(){
   jQuery('#spn').click();
});
</script>
<script async defer>
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

  totalprofit();
  totalquantity();
  totalreturn();
  accprofit(); 
 
    }

document.getElementById('myInput').onkeypress = function(e){
    if (!e) e = window.event;
    var keyCode = e.keyCode || e.which;
    if (keyCode == '13'){
      // Enter pressed
        totalprofit();
        totalquantity();
        totalreturn();
        accprofit();

    }
  }

 function calcFunction() {
    totalprofit();
    totalquantity();
    totalreturn();
    accprofit();

 }     

//  FOR TOTAL DEBIT AND CREDIT
 setTimeout(function()
 { 
 totalprofit();
 totalquantity();
 totalreturn();
 accprofit();
   
 }, 1000);

 function totalprofit(){ 
  var debit = document.getElementsByName('profit[]');
  var totaldebit;
  var line = document.getElementsByClassName('line[]');
  var b = 0;
  var runningtotal = document.getElementById('totalprofit');
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

function totalquantity(){ 
  var rtn = document.getElementsByName('return[]');
  var debit = document.getElementsByName('quantity[]');
  var line = document.getElementsByClassName('line[]');
  var b = 0;
  var c = 0;
  var runningtotal = document.getElementById('totalquantity');
  var runningtotalr = document.getElementById('totalrquantity');
   for(var i=0;i<line.length;i++){

   if(line[i].style.visibility === "hidden" || line[i].style.display === "none")
   {
   
   }
   else{ 
    if(parseFloat(rtn[i].value))
    {
     c += parseInt(debit[i].value);
     runningtotalr.innerHTML = c; 
    }
    else{
    b += parseInt(debit[i].value); 
    runningtotal.innerHTML = b;
    }
  }

  }
}

function totalreturn(){ 
  var credit = document.getElementsByName('return[]');
  var totalcredit;
  var line = document.getElementsByClassName('line[]');
  var c = 0;
  var runningtotal = document.getElementById('totalreturn');
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

function accprofit(){ 
  
  var totalprofit = document.getElementById('totalprofit');
  var totalreturn = document.getElementById('totalreturn');
  var accprofit = document.getElementById('accprofit');
  var c = 0;
  c = parseFloat(totalprofit.innerHTML.replace(/,/g, '')) - parseFloat(totalreturn.innerHTML.replace(/,/g, ''));
  accprofit.innerHTML = c.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

}

</script>            
 @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>   