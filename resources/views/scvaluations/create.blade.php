@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Stock Cost Valuation)</small>
          </h3>
          <br>
          <form method="post" action="{{url('scvaluations')}}">
             <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
        <?php foreach ($details as $details):?>
           <div class="container">
               <!--  {!! Form::open() !!}  -->
               <table class="table-bordered table">
                 <tr>
                   <td>
                      <div class="form-group">
                          <label for="po_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='po_number' value="<?php echo $details->po_number; ?>"  readonly />
                      </div> 
                   </td>
                   <td>
                      <div class="form-group">
                          <label for="bk_name" class="text-primary">Date<small>(To Enter Record On Previous Dates)</small></label>
                          <input class="form-control" type="date" id="date" name="date" />
                      </div>
                   </td>
                 </tr>
               </table>    
                    <div class="form-group">
                          <label for="po_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='po_name' name='po_name' value="{{ Auth::user()->name }}" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->po_title; ?>" readonly/> 
                    </div>
                    <div class="form-inline">
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Supplier Name</label>
                          <input class="form-control" type='text' id='po_title' name='s_name' value="<?php echo $details->s_name; ?>" readonly/> 
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Supplier ID</label>
                          <input class="form-control" type='text' id='po_title' name='s_ID' value="<?php echo $details->s_ID; ?>" readonly/> 
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Supplier Company</label>
                          <input class="form-control" type='text' id='po_title' name='s_company' value="<?php echo $details->s_company; ?>" readonly/> 
                    </div>
                    </div>
                <!-- {!! Form::close() !!} -->
               <?php endforeach; ?> 
               <?php foreach ($lot as $lot):?> 
                 <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Lot Number</label>
                          <input class="form-control" type='text' id='lot_number' name='lot_number' value="<?php echo $lot->lot_number; ?>" readonly/> 
                    </div>
               <?php endforeach; ?>   
              </div>
            <br>
            <br>
         {{csrf_field()}}
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">attach_money</i>Cost Valuation
                   </a>
                </h5>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body bg-light">
                  <!-- EMPTY FOR NOW -->
                 </div>
               </div>
              </div>
            </div>
             <div class="container">
                    <!-- {!! Form::open() !!} --> 
                      <table class="table table-bordered">
                        <tr>
                            <th>Make</th>
                            <th>Item</th>
                            <th>Model</th>
                            <th hidden>Specs</th>
                            <th hidden>Desc</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th>EXP PU</th>
                            <th>UCP</th>
                            <th>C-U Total</th>
                        </tr>
                      <?php foreach ($requisition as $requisition):?>  
                        <tr>
                          <td><input class="form-control" type='text' id='sc_supplier' name='sc_supplier[]' value="<?php echo $requisition->po_supplier; ?>" readonly/></td>

                            <td><input class="form-control" type='text' id='po_item' name='po_item[]' value="<?php echo $requisition->po_item; ?>" readonly/></td>

                            <td><input class="form-control" type='text' id='po_size' name='po_size[]' value="<?php echo $requisition->po_size; ?>" readonly /> </td>

                            <td hidden><input class="form-control" type='text' id='sc_specifications' name='sc_specifications[]' value="<?php echo $requisition->po_specs; ?>" readonly/></td>

                            <td hidden><input class="form-control" type='text' id='po_description' name='po_description[]' value="<?php echo $requisition->po_description; ?>" readonly/> </td>

                            <td><input class="form-control" type='number' id='po_quantity' name='po_quantity[]' value="<?php echo $requisition->po_quantity; ?>" readonly/> </td>

                            <td><input class="form-control" type='number' id='po_unitprice' name='po_unitprice[]' readonly value="<?php echo $requisition->po_unitprice; ?>" /> </td>

                            <td><input class="form-control" type='number' id='total' name='total[]' readonly/> </td>

                            <td><input class="form-control" type='number' id='exp_pu' name='exp_pu[]' readonly/> </td>

                            <td><input class="form-control" type='number' id='ucp' name='ucp[]' readonly/> </td>

                            <td><input class="form-control" type='number' id='costunit' name='costunit[]' readonly/>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                        </table>

                   <table class="table table-bordered">
                     <tr>
                       <td>
                            <div class="form-group">
                              <label for="sc_freight" class="bmd-label-floating text-primary">Air Freight</label>
                              <input class="form-control" type='number' id='sc_freight' name='sc_freight' required/> 
                          </div>
                       </td>
                       <td>
                          <div class="form-group">
                            <label for="sc_labour" class="bmd-label-floating text-primary">Custom Clearance</label>
                            <input class="form-control" type='number' id='sc_labour' name='sc_labour' required/> 
                          </div>
                       </td>
                       <td>
                          <div class="form-group">
                            <label for="sc_misc" class="bmd-label-floating text-primary">Miscellaneous</label>
                            <input class="form-control" type='number' id='sc_misc' name='sc_misc' required/> 
                          </div>
                       </td>
                     </tr>
                     <tr>
                       <td>
                          <div class="form-group">
                            <label for="totalunits" class="bmd-label-floating text-primary">Total Units</label>
                            <input class="form-control" type='number' id='totalunits' name='totalunits' readonly/> 
                          </div>
                       </td>
                       <td>
                          <div class="form-group">
                            <label for="totalexpenses" class="bmd-label-floating text-primary">Total Expenses</label>
                            <input class="form-control" type='number' id='totalexpenses' name='totalexpenses' readonly/> 
                          </div>
                       </td>
                       <td>
                          <div class="form-group">
                            <label for="perpeiceexpenses" class="bmd-label-floating text-primary">Conv. SCV</label>
                            <input class="form-control" type='number' id='perpeiceexpenses' name='perpeiceexpenses' readonly/></div>
                       </td>
                     </tr>
                   </table>

                    <div class="form-group">
                            <label for="sc_grandtotal" class="bmd-label-floating text-primary">Grand Total</label>
                            <input class="form-control" type='number' id='sc_grandtotal' name='sc_grandtotal' readonly/>
                    </div>

                     <div class="form-group">
                            <label for="sc_grandtotal" class="bmd-label-floating text-primary">PO Value</label>
                            <input class="form-control" type='text' id='sc_povalue' name='sc_povalue' value="<?php echo $requisition->po_totalprice - $requisition->po_iamount; ?>" readonly/>
                    </div>

                    <div class="form-group" hidden>
                            <label for="sc_grandtotal" class="bmd-label-floating text-primary"></label>
                            <input class="form-control" type='text' id='totalpo' name='totalpo' value="<?php echo $requisition->po_grandtotal; ?>" readonly/>
                    </div>

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
 setInterval(function()
 { 
      
      findrunningTotal();
      
 }, 1200);

function findrunningTotal(){
    var exp_pu = document.getElementsByName('exp_pu[]');
    var quantity = document.getElementsByName('po_quantity[]');
    var unitprice = document.getElementsByName('po_unitprice[]');
    var totalunits = 0;
    var grandtotal = 0;
    var arr = document.getElementsByName('total[]');
    var tot= 0;
    for(var j=0;j<unitprice.length;j++){
        if(parseFloat(unitprice[j].value))
        tot = parseFloat(unitprice[j].value);                   
  arr[j].value = unitprice[j].value * parseFloat(quantity[j].value);
  totalunits += parseFloat(quantity[j].value);
  document.getElementById('totalunits').value = totalunits;

  grandtotal += parseFloat(document.getElementsByName('costunit[]')[j].value);
  document.getElementById('sc_grandtotal').value = grandtotal.toFixed(2);

  exp_pu[j].value = document.getElementById('perpeiceexpenses').value;
  var ucp = exp_pu[j].value * unitprice[j].value; 
  document.getElementsByName('ucp[]')[j].value = ucp.toFixed(2);

  var cup = document.getElementsByName('ucp[]')[j].value * quantity[j].value;
  document.getElementsByName('costunit[]')[j].value = cup.toFixed(2);
    } 
    
  document.getElementById('totalexpenses').value = +document.getElementById('sc_freight').value + +document.getElementById('sc_labour').value + +document.getElementById('sc_misc').value; 





document.getElementById('sc_grandtotal').value = +document.getElementById('totalexpenses').value + +document.getElementById('totalpo').value;

var perpeiceexpenses =  document.getElementById('sc_grandtotal').value / document.getElementById('sc_povalue').value;
  document.getElementById('perpeiceexpenses').value = perpeiceexpenses.toFixed(2);


}
 window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
  };
</script> 

 @endsection  

 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
  <?php  } else {  redirect()->to('home')->send(); } ?> 