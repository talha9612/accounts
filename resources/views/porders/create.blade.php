@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Purchase Order)</small>
          </h3>
          <br>
          <form method="post" action="{{url('porders')}}">
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
                          <input class="form-control" type='text' name='po_number' value="<?php echo $details->pr_number; ?>" required readonly />
                </div> 
                 <div class="form-group">
                          <label for="bk_name" class="text-primary">Date</label>
                          <input class="form-control" type="date" id="date" name="date"/>
                    </div>
                    <div class="form-group">
                          <label for="po_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='po_name' name='po_name' value="{{ Auth::user()->name }}" required/>
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->pr_title; ?>" required/> 
                    </div>
                <!-- {!! Form::close() !!} -->
              </div>
            <?php endforeach; ?> 
             <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Company</label>
                        <input class='form-control farmer_txt' type='text' data-type='farmercnic' id='farmercnic_1' name='s_company' required/>
                    </div>  
             <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Supplier</label>
                        <input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_1' name='s_name' required /> 
                    </div>
                    <div class="form-group">
                        <label for="pr_totalprice" class="bmd-label-floating text-primary">Supplier ID</label>
                        <input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_1' name='s_ID' readonly required/>
                    </div>  
            <br>
            <br>
         {{csrf_field()}}
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">attach_money</i>Products
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
                            <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
                            <th>S.No</th>
                            <th>Supplier/Make</th>
                            <th>Item Name</th>
                            <th>Model</th>
                            <th>Specifications</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                      <?php foreach ($requisition as $requisition):?>  
                        <tr>
                            <td><input type='checkbox' class='chkbox'/></td>
                            <td>1</td>
                            <td><input class="form-control" type='text' id='po_supplier' name='po_supplier[]' value="<?php echo $requisition->s_company; ?>" required/></td>
                            <td><input class="form-control" type='text' id='po_item' name='po_item[]' value="<?php echo $requisition->pr_item; ?>" required/></td>
                            <td><input class="form-control" type='text' id='po_size' name='po_size[]' value="<?php echo $requisition->pr_size; ?>" required /> </td>
                            <td><input class="form-control" type='text' id='po_specifications' name='po_specifications[]' value="<?php echo $requisition->pr_specs; ?>" required /> </td>
                            <td><input class="form-control" type='text' id='po_description' name='po_description[]' value="<?php echo $requisition->pr_description; ?>" required/> </td>
                            <td><input class="form-control" type='text' id='po_quantity' name='po_quantity[]' value="<?php echo $requisition->pr_quantity; ?>" required/> </td>
                            <td><input class="form-control" type='text' id='po_unitprice' name='po_unitprice[]' required/>
                              <input class="form-control" type='hidden' id='po_unitpricepkr' name='po_unitpricepkr[]' required/>
                             </td>
                            <td><input class="form-control" type='text' id='total' name='total[]' required/>
                           </td>
                        </tr>
                      <?php endforeach; ?>
                        </table>
                    <!-- {!! Form::close() !!} -->
                    <br>
                    <br>
                    <br>
                <h5>Purchase Type</h5>
                 <div class="radio">
                  <label class="text-dark">
                    <input type="radio" name="optionsType" id="local" value="local">
                    Local
                  </label>
                </div>
                 <div class="radio">
                  <label class="text-dark">
                    <input type="radio" name="optionsType" id="imports" value="imports">
                    Imports
                  </label>
                </div>
                </div>
                <hr>
                <div class="container type">
                  <h5>Select Type</h5>
                   <div class="radio">
                  <label class="text-dark">
                    <input type="radio" name="options" id="EXW" value="EXW" checked>
                    EXW
                  </label> 
                  &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="options" id="‎FCA" value="‎FCA">
                     ‎FCA
                  </label>
                   &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="options" id="FOB" value="FOB">
                    FOB
                  </label>
                  &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="options" id="CIF" value="CIF">
                     CIF
                  </label>
                  &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="options" id="CPT" value="CPT">
                    CPT
                  </label>
                   &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="options" id="CFR" value="CFR">
                    CFR
                  </label>
                   &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="options" id="CIP" value="CIP">
                    CIP
                  </label>
                   &nbsp &nbsp
                  <label class="text-dark">
                    Amount
                   <input type="number" name="amounttype" id="amounttype" required>
                   </label>
                  </div>
                  <hr>
                  <h5>Select Currency</h5>
                   <div class="radio">
                  <label class="text-dark">
                    <input type="radio" name="optionsCurrency" id="USD" value="USD" checked>
                    $ USD
                  </label> &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="optionsCurrency" id="JPY" value="JPY">
                     ‎¥ JPY
                  </label>
                   &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="optionsCurrency" id="GBP" value="GBP">
                    ‎£ GBP
                  </label>
                  &nbsp &nbsp
                  <label class="text-dark">
                    <input type="radio" name="optionsCurrency" id="EURO" value="EURO">
                     € EURO
                  </label>
                  &nbsp &nbsp
                   <label class="text-dark">
                    <input type="radio" name="optionsCurrency" id="RMB" value="RMB">
                     ¥ RMB
                  </label>
                  &nbsp &nbsp
                  </div>
                  <br>
                <table class="table table-bordered">
                    <tr>
                    <th>Conversion Rate</th>
                    <th>Total Value</th>
                    <th>Grand Total (PKR)</th>
                    </tr>
                  <tbody>
                    <tr>
                      <td><input type="text" class="form-control" id="co_rate" name="co_rate"></td>
                      <td><input type="text" class="form-control" id='co_unit' name='co_unit'></td>
                      <td><input type="text" class="form-control" id='co_totalprice' name='co_totalprice' readonly></td>
                    </tr>
                  </tbody>
                </table>
                <br>
              </div>
                    <div class="gst">
                       <div class="form-group">
                          <label for="pr_totalprice" class="bmd-label-floating text-primary">Total</label>
                          <input class="form-control" type='text' id='po_totalprice' name='po_totalprice' required/> 
                    </div>
                    <div class="form-group">
                          <label for="pr_totalprice" class="bmd-label-floating text-primary">GST %</label>
                          <input class="form-control" type='text' id='po_gstp' name='po_gstp' required/> 
                    </div>
                    <div class="form-group">
                          <label for="pr_totalprice" class="bmd-label-floating text-primary">GST Amount </label>
                          <input class="form-control" type='text' id='po_gst' name='po_gst' required/> 
                    </div>
                    
                     <div class="form-group">
                          <label for="pr_totalprice" class="bmd-label-floating text-primary">Grand Total </label>
                          <input class="form-control" type='text' id='po_grandtotal' name='po_grandtotal' required/> 
                    </div>

                    </div>
                <br>              
                <div align="center" >
                 <a href="{{action('PorderController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
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
  $(".delete").on('click', function() {
  $('.chkbox:checkbox:checked').parents("tr").remove();
  $('.check_all').prop("checked", false); 
  updateSerialNo();
});
var i=$('table tr').length;
$(".addbtn").on('click',function(){
  count=$('table tr').length;
    
      var data="<tr><td><input type='checkbox' class='chkbox'/></td>";
      data+="<td>"+count+"</td>";
      data+="<td><input class='form-control' type='text' id='pr_item_"+i+"' name='pr_item[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='pr_size_"+i+"' name='pr_size[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='pr_description_"+i+"' name='pr_description[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='pr_quantity_"+i+"' name='pr_quantity[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='pr_unitprice_"+i+"' name='pr_unitprice[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='total_"+i+"' name='total[]' required/></td>";
      data+="</tr>";
  $('table').append(data);
  i++;
});
        
function select_all() {
  $('input[class=chkbox]:checkbox').each(function(){ 
    if($('input[class=check_all]:checkbox:checked').length == 0){ 
      $(this).prop("checked", false); 
    } else {
      $(this).prop("checked", true); 
    } 
  });
}
function updateSerialNo(){
  obj=$('table tr').find('span');
  $.each( obj, function( key, value ) {
    id=value.id;
    $('#'+id).html(key+1);
  });
}

</script>
 <!-- For Auto Calculation of Values -->
<script>
 window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
  };

$(document).on('focus','.farmer_txt',function(){
  type = $(this).data('type');
  
  if(type =='farmername' )autoType='s_name'; 
  if(type =='farmerid' )autoType='s_ID'; 
  if(type =='farmercnic' )autoType='s_company'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchsupplier') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    type : type,
                },
                success: function(data) {
                    var array = $.map(data, function (item) {
                       return {
                           label: item[autoType],
                           value: item[autoType],
                           data : item
                       }
                   });
                    response(array)
                }
            });
       },
       select: function( event, ui ) {
           var data = ui.item.data;           
           id_arr = $(this).attr('id');
           id = id_arr.split("_");
           elementId = id[id.length-1];
           $('#farmername_'+elementId).val(data.s_name);
           $('#farmerid_'+elementId).val(data.s_ID);
           $('#farmercnic_'+elementId).val(data.s_company);
       }
   }); 
});

</script> 
<script type="text/javascript">
$(document).ready(function() {
              $(".gst").fadeTo(600, 0).slideUp(500, function(){
                $(this).hide(); 
                });   

});

$('input:radio[name="optionsType"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'local') {
                document.getElementById("po_gstp").required = true;
                document.getElementById("po_gst").required = true;
                document.getElementById("po_totalprice").required = true;
                document.getElementById("po_grandtotal").required = true;

                document.getElementById("co_unit").required = false;
                document.getElementById("co_rate").required = false;
                document.getElementById("co_totalprice").required = false;
                document.getElementById("amounttype").required = false;

                $(".type").fadeTo(600, 0).slideUp(500, function(){
                $(this).hide(); 
                });

                $(".gst").fadeTo(0, 500).slideUp(0, function(){
                $(this).show(); 
                });

                setInterval(function()
                 { 
                    findrunningTotal();
                     findTotal(); 
                 }, 1200);

                function findrunningTotal(){
                    var quantity = document.getElementsByName('po_quantity[]');
                    var unitprice = document.getElementsByName('po_unitprice[]');
                    var arr = document.getElementsByName('total[]');
                    var tot= 0;
                    var r = 0;
                    for(var j=0;j<unitprice.length;j++){
                        if(parseFloat(unitprice[j].value))
                        tot = parseFloat(unitprice[j].value);   
                        r = tot * parseFloat(quantity[j].value);     
                        arr[j].value = r.toFixed(2);
                    }
                }

                function findTotal()
                {
                var runningtotal = document.getElementsByName('total[]');
                var total = 0;
                    for(var i=0;i<runningtotal.length;i++){
                        if(parseFloat(runningtotal[i].value))
                        total += parseFloat(runningtotal[i].value);  
                        document.getElementById('po_totalprice').value = total.toFixed(2); 
                    } 
                    var gstp = document.getElementById('po_gstp').value / 100;
                    var gst = gstp.toFixed(2) * document.getElementById('po_totalprice').value;
                    document.getElementById('po_gst').value = gst.toFixed(2);
                    document.getElementById('po_grandtotal').value = +document.getElementById('po_totalprice').value  + + document.getElementById('po_gst').value;


                }
        }
        else if ($(this).is(':checked') && $(this).val() == 'imports') {
                document.getElementById("po_gstp").required = false;
                document.getElementById("po_gst").required = false;
                document.getElementById("po_totalprice").required = false;
                document.getElementById("po_grandtotal").required = false;

                document.getElementById("co_unit").required = true;
                document.getElementById("co_rate").required = true;
                document.getElementById("co_totalprice").required = true;
                document.getElementById("amounttype").required = true;

           
                $(".type").fadeTo(0, 500).slideUp(0, function(){
                $(this).show(); 
                });    

                $(".gst").fadeTo(600, 0).slideUp(500, function(){
                $(this).hide(); 
                });   

                setInterval(function()
                 { 
                    findrunningTotal();
                    findTotal();
                    findCo(); 
                 }, 1200);

                function findrunningTotal(){
                    var quantity = document.getElementsByName('po_quantity[]');
                    var unitprice = document.getElementsByName('po_unitprice[]');
                    var arr = document.getElementsByName('total[]');
                    var tot= 0;
                    var r = 0;
                    for(var j=0;j<unitprice.length;j++){
                        if(parseFloat(unitprice[j].value))
                        tot = parseFloat(unitprice[j].value); 
                        r =  tot * parseFloat(quantity[j].value);    
                        arr[j].value = r.toFixed(2); 
                    }
                }

                function findTotal()
                {
                var runningtotal = document.getElementsByName('total[]');
                var total = 0;
                var counit = 0;
                    for(var i=0;i<runningtotal.length;i++){
                        if(parseFloat(runningtotal[i].value))
                        total += parseFloat(runningtotal[i].value);  
                        document.getElementById('co_unit').value = total; 
                        document.getElementsByName('po_unitpricepkr[]')[i].value = document.getElementsByName('po_unitprice[]')[i].value * document.getElementById('co_rate').value; 
                    }
                    counit = +document.getElementById('co_unit').value + +document.getElementById('amounttype').value;
                   document.getElementById('co_unit').value = counit.toFixed(2);  
                }


                function findCo()
                {
                var corate = document.getElementById('co_rate').value;
                var unit = document.getElementById('co_unit').value;
                var rs = corate * unit;
                document.getElementById('co_totalprice').value = rs.toFixed(2);
                }
        }
    });
</script> 

 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?> 