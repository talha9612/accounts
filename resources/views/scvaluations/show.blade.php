@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Stock Cost Valuation)</small>
          </h3>
          <br>
           <?php foreach ($details as $details):?>
          <div class="container">
            <table class="table"> 
              <tr>
                <td colspan="2">
                   <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='po_number' value="<?php echo $details->sc_number; ?>"  readonly/>
                  </div>
                </td>
                <td colspan="2">
                   <div class="form-group">
                          <input class="form-control" type='text' name='updated_at' value="<?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?>"  readonly />
                  </div>
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='po_name' name='po_name' value="<?php echo $details->sc_name; ?>" readonly/>
                    </div>
                </td>
                <td colspan="2">
                </td>
              </tr>

              <tr>
                <td>
                   <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier Name</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->s_name; ?>" readonly/> 
                    </div>
                </td>
                <td>
                   <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier ID</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->s_ID; ?>" readonly/> 
                    </div>
                </td>
                <td>
                   <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier Company</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->s_company; ?>" readonly/> 
                    </div>
                </td>
                <td>
                   <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Lot Number</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->lot_number; ?>" readonly/> 
                    </div>
                </td>
              </tr>
            </table>    
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->sc_title; ?>" readonly/> 
                    </div>
                   
                   
                   
                   
                     <div class="form-group" align="right">
                    <a href="{{action('ScvaluationController@printSc' , $details->sc_number)}}" target="new" title="Print/PDF"> <i class="material-icons text-warning">local_printshop</i> </a> 
                    </div>
                          
             
              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Supplier/Make 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Item 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Model </th>
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Specs 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Name: activate to sort column ascending">Desc</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Qty</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">U Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">C-U</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Total Price</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Supplier/Make</th>
                  <th rowspan="1" colspan="1">Item</th>
                  <th rowspan="1" colspan="1">Model</th>
                  <th rowspan="1" colspan="1">Specs</th>
                  <th rowspan="1" colspan="1">Desc</th>
                  <th rowspan="1" colspan="1">Qty</th>
                  <th rowspan="1" colspan="1">U Price</th>
                  <th rowspan="1" colspan="1">C-U</th>
                  <th rowspan="1" colspan="1">Total Price</th>
                 
                </tr>
              </tfoot>
              <tbody>
                <?php $total = 0; ?>
               <?php foreach ($pass as $pass):?>
                <tr role="row" class="odd">
                  <td><?php echo $pass->sc_supplier; ?></td>
                  <td><?php echo $pass->sc_item; ?></td>
                  <td><?php echo $pass->sc_size; ?></td>
                  <td><?php echo $pass->sc_specs; ?></td>
                  <td><?php echo $pass->sc_description; ?></td>
                  <td><?php echo $pass->sc_quantity; ?></td>
                  <td><?php $subtotal =  number_format($pass->sc_unitprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sc_ucp, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sc_costunit, 2, '.', ',');
                    echo $subtotal; ?> </td>
                </tr>
                <?php $total += $pass->sc_costunit;?>
                <?php endforeach; ?>
              </tbody>
            </table>
            <hr>

            <div align="right">
              <label class="text-dark"><b>Grand Total</b></label>
              <input type="text" name="grandtotal" value="Rs:<?php $subtotal =  number_format($total, 2, '.', ',');
                      echo $subtotal; ?>/-" style="text-align: right" readonly>
            </div>

            <table class="table table-bordered">
                     <tr>
                       <td>
                            <div class="form-group">
                              <label for="sc_freight" class="bmd-label-floating text-primary">Air Freight</label>
                              <input class="form-control" type='text' value="<?php $subtotal = number_format($pass->sc_freight, 2, '.', ','); echo $subtotal; ?>" readonly/> 
                          </div>
                       </td>
                       <td>
                          <div class="form-group">
                            <label for="sc_labour" class="bmd-label-floating text-primary">Custom Clearance</label>
                            <input class="form-control" type='text' value="<?php $subtotal = number_format($pass->sc_labour, 2, '.', ','); echo $subtotal ?>" /> 
                          </div>
                       </td>
                       <td>
                          <div class="form-group">
                            <label for="sc_misc" class="bmd-label-floating text-primary">Miscellaneous</label>
                            <input class="form-control" type='text' value="<?php $subtotal = number_format($pass->sc_miscellaneous, 2, '.', ','); echo $subtotal ?>"/> 
                          </div>
                       </td>
                     </tr>
                     <tr>
                       <td>
                          <div class="form-group">
                            <label for="totalunits" class="bmd-label-floating text-primary">Total Units</label>
                            <input class="form-control" type='text' value="<?php $subtotal = number_format($pass->sc_totalunits, 2, '.', ','); echo $subtotal ?>"/> 
                          </div>
                       </td>
                       <td>
                          <div class="form-group">
                            <label for="totalexpenses" class="bmd-label-floating text-primary">Total Expenses</label>
                            <input class="form-control" type='text' value="<?php $subtotal = number_format($pass->sc_totalexpense, 2, '.', ','); echo $subtotal ?>"/> 
                          </div>
                       </td>
                       <td>
                          <div class="form-group">
                            <label for="perpeiceexpenses" class="bmd-label-floating text-primary">Per Peice Expenses</label>
                            <input class="form-control" type='text' value="<?php $subtotal = number_format($pass->sc_ppexpense, 2, '.', ','); echo $subtotal ?>"/></div>
                       </td>
                     </tr>
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
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

       <!-- WORK AREA END -->  


<script type="text/javascript">


  // FOR DISPLAY OF COMMA SEPRATED VALUES

  var yarr = document.getElementsByName('totalprice[]');
    for(var k=0;k<yarr.length;k++){
      var c = yarr[k].value;
      c = c.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementsByName('totalprice[]')[k].value = c;     
    }    

</script>             
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
   <?php  } else {  redirect()->to('home')->send(); } ?>