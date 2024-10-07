@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->serviceview) && Auth::user()->serviceview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Service Gross Profit)</small>
          </h3>
          <br>

        <div align="right">
        <a href="javascript:printDiv('datatables')">Print</a><br>
        <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
        </div>
         <input id="myInput" type="text" placeholder="Search.." class="form-control" onfocusout="calcFunction()">
          <br>
         <div id="div1">
           <table style="width: 100%;font-size: 10px" id="myTable" border=".5px" class="table table-striped table-bordered table-hover dataTable dtr-inline">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="text-white" style="width: 10px;font-size: 10px">SRV#</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">Customer</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">Order #</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">SR Invoice(B)</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">Sale Invoice(D)</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">Total(E=B+D)</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">Project(C)</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">Items(A)</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">Total Cost(F=A+C)</th>
                  <th class="text-white" style="width: 5px;font-size: 10px">GP (G=E-F)</th>
                  <th class="text-white" style="width: 10px;font-size: 10px">Tax Deducted(H)</th>
                  <th class="text-white" style="width: 5px;font-size: 10px">GP After Tax Deducted(G-H)</th>
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
                 <?php foreach ($svinvoices as $svinvoice):?>
                  <tr>
                  <td><?php echo $svinvoice->svi_number; ?></td>
                   
                  <td><?php echo $svinvoice->svi_crname; ?></td>
                   
                  <td><?php echo $svinvoice->svi_crorder; ?></td>
                   
                  <td><?php $subtotal =  number_format($svinvoice->svi_grandtotal, 2, '.', ',');
                    echo $subtotal;  ?></td>
                   
                  <td><?php $subtotal =  number_format($svinvoice->svi_sltotal, 2, '.', ',');
                    echo $subtotal;  ?></td>

                  <td><?php  $subtotal =  number_format($svinvoice->svi_sltotal + $svinvoice->svi_grandtotal, 2, '.', ','); echo $subtotal;  ?></td>

                  <td><?php $subtotal =  number_format($svinvoice->svi_headbalance, 2, '.', ','); echo $subtotal; ?></td>

                  <td><?php $subtotal =  number_format($svinvoice->srv_grandtotal, 2, '.', ','); echo $subtotal; ?></td>

                  <td><?php  $subtotal =  number_format($svinvoice->srv_grandtotal + $svinvoice->svi_headbalance, 2, '.', ','); echo $subtotal; ?></td>

                  <td><?php $gp = ($svinvoice->svi_sltotal + $svinvoice->svi_grandtotal) - ($svinvoice->srv_grandtotal + $svinvoice->svi_headbalance); $subtotal =  number_format($gp, 2, '.', ','); echo $subtotal; ?></td>
                    
                  <td><?php $subtotal =  number_format($svinvoice->svi_tax, 2, '.', ','); echo $subtotal; ?></td>
                    
                  <td><?php $total += $gp - $svinvoice->svi_tax; $subtotal =  number_format($gp - $svinvoice->svi_tax, 2, '.', ','); echo $subtotal;?></td>
                  </tr>

                  <?php endforeach; ?>
              </tbody>
            </table>
           
            <br>
            <br>

             <div class="form-group">
                  <label for="bk_branch_code" class="bmd-label-floating text-primary">Grand Total</label>
                  <input class="form-control" type='text' id="grandtotal" name='grandtotal' value="<?php $subtotal =  number_format($total, 2, '.', ','); echo $subtotal; ?>" readonly/> 
                </div>

           </div>     
       <!-- WORK AREA END -->  

<script type="text/javascript">

            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <div> <h3 align="center"> Service Gross Profit </h3> </div>');
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').innerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();             
            }

</script>
<script src="{{asset('assets/sorting.js')}}"></script>

 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?> 