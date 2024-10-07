@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->serviceview) && Auth::user()->serviceview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Service Invoice)</small>
          </h3>
          <br>
           <form method="post" action="{{url('srvinvoices')}}">
             {{csrf_field()}}
           <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='svi_number' value="<?php echo $details->srv_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                          <input class="form-control" type='text' name='updated_at' value="<?php echo $details->updated_at; ?>" readonly />
                </div>
              </div> 
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='pr_name' name='svi_name' value="<?php echo $details->srv_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Customer</label>
                          <input class="form-control" type='text' name='svi_crname' value="<?php echo $details->srv_crname; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Customer ID</label>
                          <input class="form-control" type='text' id='pr_title' name='svi_crid' value="<?php echo $details->srv_crid; ?>" readonly/> 
                    </div>
                    
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Order #</label>
                          <input class="form-control" type='text' id='pr_title' name='svi_crorder' value="<?php echo $details->srv_crorder; ?>" readonly/> 
                    </div>
                  <div class="form-inline">
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Head</label>
                          <input class="form-control" type='text' id='pr_title' name='svi_head' value="<?php echo $details->srv_head; ?>" style="width: 99%" readonly/> 
                    </div>
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Head ID</label>
                          <input class="form-control" type='text' id='pr_title' name='svi_headid' value="<?php echo $details->srv_headid; ?>" style="width: 99%" readonly/> 
                    </div>
                     <div class="form-group" style="width: 33%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Head Balance</label>
                          <input class="form-control" type='text' id='pr_title' name='svi_headbalance' value="<?php echo $details->srv_headbalance; ?>" style="width: 99%" readonly/> 
                    </div>
                  </div>  
                   
              </div>
              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">

                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" width="5%" aria-label="Position: activate to sort column ascending">ID</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" width="25%" aria-label="Position: activate to sort column ascending">Item</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" width="25%" aria-label="Office: activate to sort column ascending">Model</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" width="10%"  aria-label="Office: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" width="10%" aria-label="Name: activate to sort column ascending">Cost Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" width="10%" aria-label="Details: activate to sort column ascending">Sale Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" width="10%" aria-label="Details: activate to sort column ascending">Total Price</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th>ID</th>
                  <th>Item</th>
                  <th>Model</th>
                  <th>Quantity</th>
                  <th>Cost Price</th>
                  <th>Sale Price</th>
                  <th>Total Price</th>
                </tr>
              </tfoot>
              <tbody>
               <?php foreach ($requisition as $requisition):?>
                <tr role="row" class="odd">
                  <td><input type="text" class="form-control" name="i_id[]" value="<?php echo $requisition->srv_i_ID; ?>"></td>
                  <td><input type="text" class="form-control" name="item[]" value="<?php echo $requisition->srv_item; ?>"></td>
                  <td><input type="text" class="form-control" name="model[]" value="<?php echo $requisition->srv_model; ?>"></td>
                  <td><input type="text" class="form-control" name="quantity[]" value="<?php echo $requisition->srv_quantity; ?>"></td>
                  <td><input type="text" class="form-control" name="costprice[]" value="<?php echo $requisition->srv_costprice; ?>"></td>
                  <td><input type="text" class="form-control" name="sup[]" value="<?php echo $requisition->srv_sup; ?>"></td>
                  <td><input type="text" class="form-control" name="totalprice[]"></td>
                </tr>
               <?php endforeach; ?>
               <tr>
                 <td><input type="text" class="form-control" name="i_id[]" value="-"></td>
                 <td><input type="text" class="form-control" name="item[]" value="<?php echo $details->srv_description; ?>"></td>
                 <td><input type="text" class="form-control" name="model[]" value="-"></td>
                 <td><input type="text" class="form-control" name="quantity[]"></td>
                 <td><input type="text" class="form-control" name="costprice[]" value="-"></td>
                 <td><input type="text" class="form-control" name="sup[]"></td>
                 <td><input type="text" class="form-control" name="totalprice[]"></td>
               </tr>
               <tr>
                 <td><input type="text" class="form-control" name="i_id[]" value="-"></td>
                 <td><input type="text" class="form-control" name="item[]" value="Tax Deduction by Customer"></td>
                 <td><input type="text" class="form-control" name="model[]" value="-"></td>
                 <td><input type="text" class="form-control" name="quantity[]"></td>
                 <td><input type="text" class="form-control" name="costprice[]" value="-"></td>
                 <td><input type="text" class="form-control" name="sup[]"></td>
                 <td><input type="text" class="form-control" name="totalprice[]"></td>
               </tr>
              </tbody>
            </table>

            <br>

             <div class="form-group">
                  <label for="bk_branch_code" class="bmd-label-floating text-primary">Grand Total</label>
                  <input class="form-control" type='text' id="grandtotal" name='grandtotal' readonly/> 
                </div>
              <div align="center">
                  <a href="{{action('SrvinvoiceController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                  <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Save</button>
                </div>
           </form>
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

setInterval(function()
 { 
     findTotal();
 }, 1200);

//FOR CALCULATION OF UNIT PRICE AND TOTAL PRICE
function findTotal()
{

var saleprice = document.getElementsByName('sup[]');
var quantity = document.getElementsByName('quantity[]');
var totalprice = document.getElementsByName('totalprice[]');
var grandtotal = 0;
var total = 0;
    for(var i=0;i<saleprice.length;i++){

        if(parseFloat(saleprice[i].value) && saleprice[i].value !== null)
        {
        total = parseFloat(saleprice[i].value) * quantity[i].value; 
        totalprice[i].value = total;
        grandtotal += total;

      }  
      else {
        document.getElementsByName('totalprice[]')[i].value = null
      }  
     }
document.getElementById('grandtotal').value = grandtotal;
}

</script>     
       
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?> 