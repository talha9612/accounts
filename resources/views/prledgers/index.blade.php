@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->purchaseledgersview) && Auth::user()->purchaseledgersview == '1')
      { ?>

    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     Purchase <small class="text-muted">(Ledger)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Purchase Ledger</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--   Here you can write extra buttons/actions for the toolbar  -->
          </div>
          <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">

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
                  <th style="width: 29px;font-size: 10px">Date</th>
                  <th style="width: 164px;font-size: 10px">Number</th>
                  <th style="width: 83px;font-size: 10px">Title</th>
                  <th style="width: 83px;font-size: 10px">Name</th>
                  <th style="width: 83px;font-size: 10px">Supplier</th>
                  <th style="width: 83px;font-size: 10px">Debit</th>
                  <th style="width: 0px;font-size: 10px">Credit</th>
                </tr>
              </thead>
              <tbody>
                 <?php $total = 0; ?>
                 <?php foreach ($orders as $orders):?>
                <tr style="font-size: 10px" class="line[]">
                  <td> <?php  $newDate = date("d-M-Y", strtotime($orders->updated_at)); echo $newDate; ?> </td>
                  <td><?php echo $orders->po_number; ?></td>
                  <td><?php echo $orders->po_title; ?></td>
                  <td><?php echo $orders->po_name; ?></td>
                  <td><?php echo $orders->s_company; ?></td>
                  <td><?php $subtotal =  number_format($orders->po_grandtotal, 2, '.', ',');
                    echo $subtotal; ?>/-
                    <input type="hidden" name="debit[]" value="<?php echo $orders->po_grandtotal;?>">
                  </td>
                  <td>-</td>
                </tr>
                 <?php  $total += $orders->po_grandtotal; ?>
               <?php endforeach; ?>
              </tbody>
            </table>
            <div class="form-inline table-primary">
              <div class="form-group" style="width: 50%">
                    <label for="todate" class="text-dark" >Total: </label>
                     &nbsp &nbsp<span id="totaldebit"></span>
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
           printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <div align="center"> <h3> PURCHASE LEDGER </h3> </div>')
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
setInterval(function()
 { 
 totaldebit();
 }, 1000);

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

</script>

<script type="text/javascript">
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
    }
</script>

 @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>   