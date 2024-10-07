@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            Edit Record <small class="text-muted">(Sale Return)</small>
          </h3>
          <br>
           <form method="post" action="{{url('salereturns')}}" onsubmit="return validateForm()">
             <div>
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
           <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='slr_number' value="<?php echo $details->sl_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                          <input class="form-control" type='text' name='updated_at' value="<?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?>" readonly />
                </div>
              </div> 
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='po_name' name='slr_name' value="<?php echo $details->sl_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='po_title' name='slr_title' value="<?php echo $details->sl_title; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Customer Name</label>
                          <input class="form-control" type='text' id='po_title' name='slr_crname' value="<?php echo $details->fr_name; ?>" readonly/> 
                           <input class="form-control" type='hidden' id='po_title' name='fr_ID' value="<?php echo $details->fr_ID; ?>" readonly/> 
                            <input class="form-control" type='hidden' id='po_title' name='fr_cnic' value="<?php echo $details->fr_cnic; ?>" readonly/>
                            <input class="form-control" type='hidden' id='po_title' name='slr_name' value="<?php echo Auth::user()->name; ?>" readonly/> 
                    </div>
              <?php endforeach; ?>
               {{csrf_field()}}
          <b>Please Enter the quantity, that needs to be reversed. </b>   <br>
          <b>:- Check the record you want to return </b>   
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Select 
                  </th>
                    <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Item ID 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Position: activate to sort column ascending">Item Name 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Office: activate to sort column ascending">Size </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Details: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Details: activate to sort column ascending">Sale Price</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th>Select</th>
                  <th>Item ID</th>
                  <th>Item Name</th>
                  <th>Size</th>
                  <th>Quantity</th>
                  <th>Sale Price</th>
                
                </tr>
              </tfoot>
              <tbody>

               <?php foreach ($pass as $pass):?>
                <tr role="row" class="record">
                  <td><input type='checkbox' class='chkbox' name="check[]" /></td>
                  <td><input type="hidden" id="lot_number" name="lot_number[]" value="<?php echo $pass->lot_number; ?>">
                  <input class="form-control" type='hidden' id='slr_i_ID' name='slr_i_ID[]' value="<?php echo $pass->sl_i_ID; ?>" readonly/>
                  <?php echo $pass->sl_i_ID; ?></td>

                  <td>
                    <input class="form-control" type='hidden' id='slr_item' name='slr_item[]' value="<?php echo $pass->sl_item; ?>" readonly/>
                    <?php echo $pass->sl_item; ?></td>

                  <td>
                    <input class="form-control" type='hidden' id='slr_size' name='slr_size[]' value="<?php echo $pass->sl_size; ?>" readonly/>
                    <?php echo $pass->sl_size; ?></td>

                  <td>
                    <input class="form-control" type='number' id='slr_quantity' name='slr_quantity[]' value="0" required/>
                     <input  class="form-control" type="number" id="quantity" name="quantity[]" value="<?php echo $pass->sl_quantity; ?>" readonly>
                   </td>

                  <td>
                     <input class="form-control" type='hidden' id='slr_saleprice' name='slr_saleprice[]' value="<?php echo $pass->sl_saleprice; ?>"/>
                    <?php $subtotal =  number_format($pass->sl_saleprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
             <div align="center" >
                 <a href="{{action('SalereturnController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                  <input type="submit"  class="btn btn-primary btn-raised" id="sbmt" value="Save" />
                </div>
             </form>
            
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
var crntdate = document.getElementById("crntdate").value;
var compdate = document.getElementById("compdate").value;

if(Date.parse(crntdate) > Date.parse(compdate))
{
  var d = new Date();
  var n = d.getFullYear();
  document.getElementById("fsclyear").value = (n)+'-'+(n+1);
} 
else{
    var d = new Date();
    var n = d.getFullYear();
    document.getElementById("fsclyear").value = (n-1)+'-'+(n);
}
</script>

<script type="text/javascript">
function validateForm()
{
var validate = 0;  
var upquantity = document.getElementsByName("slr_quantity[]");
var quantity = document.getElementsByName("quantity[]");
var check = document.getElementsByName("check[]");
for(var i=0;i<upquantity.length;i++){

   if(check[i].checked === true)
  {
    if(parseInt(upquantity[i].value) <= 0)
    {
      validate = 1;
    }
    else if(parseInt(upquantity[i].value) > parseInt(quantity[i].value))
    {
      validate = 1;
    }
    else{
      validate = 0;
    }
  }
  else{
  // document.getElementsByName("lot_number[]")[i].remove();
  // document.getElementsByName("slr_i_ID[]")[i].remove();
  // document.getElementsByName("slr_item[]")[i].remove();
  // document.getElementsByName("slr_size[]")[i].remove();
  // document.getElementsByName("slr_quantity[]")[i].remove();
  // document.getElementsByName("slr_saleprice[]")[i].remove();
  document.getElementsByClassName('record')[i].remove();;

}

}

if(validate === 1)
{
  alert('Item Quantity must not be 0 AND less then the quantity sold');
  return false;
}
else{
  return true;
}

}

</script>

<script type="text/javascript">
  window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
  };

</script>


 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>