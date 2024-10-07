@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Outward Gate Pass)</small>
          </h3>
          <br>
          <form method="post" action="{{url('gateoutwards')}}">
              <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
        <?php foreach ($details as $details):?>
           <div class="container">
               <!--  {!! Form::open() !!}  -->
                <div class="form-group">
                          <label for="po_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='dc_number' id="dc_number" value="<?php echo $details->sq_number; ?>" required readonly />
                          <input class="form-control" type='hidden' name='go_number' id="go_number" value="<?php echo $details->sq_number; ?>" required readonly />
                </div> 
                <div class="form-group">
                          <label for="bk_name" class="text-primary">Date</label>
                          <input class="form-control" type="date" id="date" name="date" />
                    </div>
                   
                    <div class="form-group">
                          <label for="po_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='go_name' name='go_name' value="<?php echo $details->sq_name; ?>" required/>
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='go_title' name='go_title' value="<?php echo $details->sq_title; ?>" required/> 
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Customer Name</label>
                          <input class="form-control" type='text' id='fr_name' name='fr_name' value="<?php echo $details->fr_name; ?>" required/> 
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">NTN #/FTN #</label>
                          <input class="form-control" type='text' id='fr_cnic' name='fr_cnic' value="<?php echo $details->fr_cnic; ?>" required/> 
                          <input class="form-control" type='hidden' id='fr_ID' name='fr_ID' value="<?php echo $details->fr_ID; ?>" required/> 
                    </div>
                     <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">GST #</label>
                          <input class="form-control" type='text' id='fr_gst' name='fr_gst' value="<?php echo $details->fr_gst; ?>" required/> 
                    </div>
                    <div class="form-group" hidden>
                          <label for="po_title" class="bmd-label-floating text-primary">Total Price</label>
                          <input class="form-control" type='text' id='totalprice' name='totalprice' value="<?php echo $details->sq_grandtotal; ?>" required/> 
                    </div>
               <?php endforeach; ?>
         {{csrf_field()}}
                <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                 <thead class="bg-primary">
                <tr role="row">
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">ID 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Item Name 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Size </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Lot Number</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Item Name</th>
                  <th rowspan="1" colspan="1">Size</th>
                  <th rowspan="1" colspan="1">Quantity</th>
                  <th rowspan="1" colspan="1">Lot Number</th>
                </tr>
              </tfoot>
                  <tbody>
                   <?php foreach ($pass as $pass):?>
                    <tr role="row" class="odd">
                      <td>
                        <input class="form-control" type='text' id='go_item' name='go_i_ID[]' value="<?php echo $pass->sq_i_ID; ?>" required/> 
                      </td>
                      <td>
                        <input class="form-control" type='text' id='go_item' name='go_item[]' value="<?php echo $pass->sq_item; ?>" required/> </td>
                      <td><input class="form-control" type='text' id='go_size' name='go_size[]' value="<?php echo $pass->sq_size; ?>" required/> </td>
                      <td><input class="form-control" type='text' id='go_quantity' name='go_quantity[]' value="<?php echo $pass->sq_quantity; ?>" required/> </td>
                      <td><input class="form-control" type='text' id='lot_number' name='lot_number[]' value="<?php echo $pass->lot_number; ?>" required/>
                        <input class="form-control" type='hidden' id='lot_number' name='sq_total[]' value="<?php echo $pass->sq_total; ?>" required/>
                        <input class="form-control" type='hidden' id='lot_number' name='sq_saleprice[]' value="<?php echo $pass->sq_saleprice; ?>" required/> 
                        <input class="form-control" type='hidden' id='lot_number' name='sq_totalprice[]' value="<?php echo $pass->sq_totalprice; ?>" required/> 
                        <input class="form-control" type='hidden' id='grandtotal' name='sq_grandtotal[]' value="<?php echo $pass->sq_grandtotal; ?>" required/> </td>
                    </tr>
                   <?php endforeach; ?>
                  </tbody>
                </table>
                    <br>
                    <br>
                    <br>
               <div align="center" >
                 <a href="{{action('ScvaluationController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                  <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Save</button>
                </div>
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

 <!-- For Auto Calculation of Values -->
<script>
var go_number = document.getElementById('dc_number').value;
var dc_number = go_number.substr(3) + '/' + new Date().getFullYear();
document.getElementById('dc_number').value = dc_number;

 setInterval(function()
 { 
      findrunningTotal();   
 }, 1200);

function findrunningTotal(){
    var quantity = document.getElementsByName('po_quantity[]');
    var unitprice = document.getElementsByName('po_unitprice[]');
    var arr = document.getElementsByName('total[]');
    var tot= 0;
    for(var j=0;j<unitprice.length;j++){
        if(parseFloat(unitprice[j].value))
        tot = parseFloat(unitprice[j].value);                   
 
 document.getElementsByName('costunit[]')[j].value = +unitprice[j].value + +document.getElementsByName('sc_freight[]')[j].value + +document.getElementsByName('sc_labour[]')[j].value  + +document.getElementsByName('sc_misc[]')[j].value;

  arr[j].value = document.getElementsByName('costunit[]')[j].value * parseFloat(quantity[j].value);
    }
}
 window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
  };
</script> 


 @endsection  
  <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
   <?php  } else {  redirect()->to('home')->send(); } ?>