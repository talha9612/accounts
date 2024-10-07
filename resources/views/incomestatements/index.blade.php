<!-- show.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->incomestatementview) && Auth::user()->incomestatementview == '1')
      { ?>
<!-- WORK AREA START -->
 <div align="right">
        <a href="javascript:printDiv('datatables')" target="new">Print</a><br>
        <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
        </div>
         <div id="div1">
           <h3 align="center" class="text-primary">
            Income Statement 
          </h3>
          <br>
           <table  class="table table-striped table-bordered" style="width: 100%" border=".5px">
              <thead>
                <tr>
                  <th class="text-primary" style="width: 50%"><h5>  </h5></th>
                  <th class="text-primary" style="width: 20%"><h5>  </h5></th>
                  <th class="text-primary" style="width: 30%"><h5>  </h5></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td>Sales</td>
                  <td></td>
                  <td>
                      <?php $totalsales = 0;  ?>
                      <?php  foreach ($sales as $sale): ?> 
                      <?php $totalsales += $sale->sl_totalprice; ?>
                      <?php endforeach;?>

                      <?php  foreach ($heads as $advancedsales): ?>
                      <?php if($advancedsales->h_name == 'Advance Sales') 
                      {
                       $totalsales += $advancedsales->h_balance; 
                      }
                      else{
                      }
                      ?>
                      <?php endforeach;?>
                      <?php $subtotal = number_format($totalsales, 2, '.', ','); echo $subtotal; ?>
                  </td>
                </tr>
                <tr>
                  <td>Less Sales Returns</td>
                  <?php $return = 0; ?>
                  <td><?php  foreach ($heads as $salesreturn): ?> 
                      <?php if($salesreturn->h_name == 'Sales Return') 
                      {
                      $return = $salesreturn->h_balance;
                      }
                      else{
                      }
                      ?>
                      <?php endforeach;?>
                  </td>
                  <td><?php $subtotal = number_format($return, 2, '.', ','); echo $subtotal; ?></td>
                </tr>
                <tr class="bg-dark text-white">
                  <td><b>Net Sales</b></td>
                  <td><b>A</b></td>
                  <td><b><?php $subtotal = number_format($totalsales - $return, 2, '.', ','); echo $subtotal; ?></b></td>
                </tr>
                <tr>
                  <td>Purchase + Import/Local Purchase</td>
                  <td></td>
                  <?php $totalpurchase = 0; ?>
                  <td>
                      <?php  foreach ($purchase as $purchases): ?>
                      <?php $totalpurchase += $purchases->po_grandtotal; ?> 
                      <?php endforeach;?>
                      <?php foreach ($heads as $localimport): ?>
                      <?php 
                      if($localimport->h_name == 'Import Purchase') 
                      {
                      $totalpurchase += $localimport->h_balance;
                      }
                      if($localimport->h_name == 'Local Purchases') 
                      {
                      $totalpurchase += $localimport->h_balance;
                      }
                      else{
                      }
                      ?>
                      <?php endforeach;?>  
                      <?php $subtotal = number_format($totalpurchase, 2, '.', ','); echo $subtotal; ?>
                  </td>
                </tr>
                <tr>
                  <td>Less Purchase Returns</td>
                  <?php $preturn = 0; ?>
                  <td><?php  foreach ($heads as $purchasereturn): ?> 
                      <?php if($purchasereturn->h_name == 'Purchase Return') 
                      {
                      $preturn = $purchasereturn->h_balance;
                      }
                      else{

                      }
                      ?>
                      <?php endforeach;?>
                  </td>
                  <td><?php $subtotal = number_format($preturn, 2, '.', ','); echo $subtotal; ?></td>
                </tr>
                 <tr class="bg-dark text-white">
                  <td><b>Net Purchase</b></td>
                  <td><b>B</b></td>
                  <td><b><?php $subtotal = number_format($totalpurchase - $preturn, 2, '.', ','); echo $subtotal; ?></b></td>
                </tr>
                <?php $totalcost = 0; ?>
                <?php  foreach ($heads as $costofgoods): ?> 
                  <?php if($costofgoods->h_stype == 'Cost of Goods' && $costofgoods->h_name !== 'Sales Return' && $costofgoods->h_name !== 'Import Purchase' && $costofgoods->h_name !== 'Local Purchases' && $costofgoods->h_name !== 'Purchase Return') 
                      { ?>
                    <tr>
                      <td> <?php echo $costofgoods->h_name; ?></td>
                      <td></td>
                      <td><?php $subtotal = number_format($costofgoods->h_balance, 2, '.', ','); echo $subtotal; $totalcost += $costofgoods->h_balance; $totalpurchase += $costofgoods->h_balance; ?></td>
                    </tr>
                  <?php  } else{}?>
                <?php endforeach;?>
                 <tr class="bg-dark text-white">
                  <td><b>Total Cost Direct Expense</b></td>
                  <td><b>C</b></td>
                  <td><b><?php $subtotal = number_format($totalcost, 2, '.', ','); echo $subtotal; ?></b></td>
                </tr>
                 <tr class="bg-dark text-white">
                  <td><b>Total Cost of Goods Sold (B+C)</b></td>
                  <td><b>D</b></td>
                  <td><b><?php $subtotal = number_format($totalpurchase, 2, '.', ','); echo $subtotal; ?></b></td>
                </tr>
                 <tr class="bg-dark text-white">
                  <td><b>Gross Profit (A-D)</b></td>
                  <td><b>E</b></td>
                  <td><b><?php $subtotal = number_format(($totalsales - $return) - $totalpurchase, 2, '.', ','); echo $subtotal; ?></b></td>
                </tr>
                <?php $totaladminaexp = 0;  foreach ($heads as $adminexpense): 
                  if($adminexpense->h_stype == 'Administrative Expenses') { ?>
                    <tr>
                      <td> 
                       <?php echo $adminexpense->h_name ?>
                       </td>
                       <td></td>
                       <td>
                       <?php $subtotal = number_format($adminexpense->h_balance, 2, '.', ','); echo $subtotal; $totaladminaexp +=  $adminexpense->h_balance; ?>
                       </td>
                    </tr>
                    <?php } else {} ?>
                  <?php endforeach;?>
                  <tr class="bg-dark text-white">
                    <td><b>Total Administrative Expenses</b></td>
                    <td><b>F</b></td>
                    <td><b><?php $subtotal = number_format($totaladminaexp, 2, '.', ','); echo $subtotal; ?></b></td>
                  </tr>
                  <?php $totalmarketexp = 0;  foreach ($heads as $marketexpense): 
                  if($marketexpense->h_stype == 'Marketing Expenses') { ?>
                    <tr>
                      <td> 
                       <?php echo $marketexpense->h_name ?>
                       </td>
                       <td></td>
                       <td>
                       <?php $subtotal = number_format($marketexpense->h_balance, 2, '.', ','); echo $subtotal; $totalmarketexp +=  $marketexpense->h_balance; ?>
                       </td>
                    </tr>
                    <?php } else {} ?>
                  <?php endforeach;?>
                  <tr class="bg-dark text-white">
                    <td><b>Total Marketing Expenses</b></td>
                    <td><b>G</b></td>
                    <td><b><?php $subtotal = number_format($totalmarketexp, 2, '.', ','); echo $subtotal; ?></b></td>
                  </tr>
                  <tr class="bg-dark text-white">
                    <td><b>Total Operational Expenses (F+G)</b></td>
                    <td><b>H</b></td>
                    <td><b><?php $subtotal = number_format($totalmarketexp + $totaladminaexp, 2, '.', ','); echo $subtotal; ?></b></td>
                  </tr>
                  <tr class="bg-dark text-white">
                    <td><b>Net Profit before taxation and bank charges (E-H)</b></td>
                    <td><b>I</b></td>
                    <?php $e = ($totalsales - $return) - $totalpurchase;
                          $h = $totalmarketexp + $totaladminaexp;
                     ?>
                    <td><b><?php $subtotal = number_format($e - $h, 2, '.', ','); echo $subtotal; ?></b></td>
                  </tr>
                  <?php $totalfinalexp = 0;  foreach ($heads as $finalexpense): 
                  if($finalexpense->h_stype == 'Financial Expenses') { ?>
                    <tr>
                      <td> 
                       <?php echo $finalexpense->h_name ?>
                       </td>
                       <td></td>
                       <td>
                       <?php $subtotal = number_format($finalexpense->h_balance, 2, '.', ','); echo $subtotal; $totalfinalexp +=  $finalexpense->h_balance; ?>
                       </td>
                    </tr>
                    <?php } else {} ?>
                  <?php endforeach;?>
                   <tr class="bg-dark text-white">
                    <td><b>Total Financial Expenses</b></td>
                    <td><b>J</b></td>
                    <td><b><?php $subtotal = number_format($totalfinalexp, 2, '.', ','); echo $subtotal; ?></b></td>
                  </tr>
                   <tr class="bg-dark text-white">
                    <td><b>Net Profit after taxation (I-J)</b></td>
                    <td><b>K</b></td>
                    <?php $e = ($totalsales - $return) - $totalpurchase;
                          $h = $totalmarketexp + $totaladminaexp;
                     ?>
                    <td><b><?php $subtotal = number_format(($e - $h) - $totalfinalexp , 2, '.', ','); echo $subtotal; ?></b></td>
                  </tr>
              </tbody>
            </table>
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
  <script>
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <br>')
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').innerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();             
            }
</script>           
       <!-- WORK AREA END -->  
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>   