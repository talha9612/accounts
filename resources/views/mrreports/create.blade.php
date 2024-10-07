<!-- create.blade.php -->
@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Maetrial Receiving Report)</small>
          </h3>
          <br>
          <form method="post" action="{{url('mrreports')}}" name="myForm" onsubmit="return validateForm()">
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
                          <input class="form-control" type='text' name='mr_number' value="<?php echo $details->gi_number; ?>" required readonly />
                </div> 
                    <div class="form-group">
                          <label for="po_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='mr_name' name='mr_name' value="<?php echo $details->gi_name; ?>" required/>
                    </div>
                    <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='mr_title' name='mr_title' value="<?php echo $details->gi_title; ?>" required/> 
                    </div>
                     <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Supplier Name</label>
                          <input class="form-control" type='text' id='mr_title' name='s_name' value="<?php echo $details->s_name; ?>" required/> 
                    </div>
                     <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Supplier ID</label>
                          <input class="form-control" type='text' id='mr_title' name='s_ID' value="<?php echo $details->s_ID; ?>" required/> 
                    </div>
                     <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Supplier Company</label>
                          <input class="form-control" type='text' id='mr_title' name='s_company' value="<?php echo $details->s_company; ?>" required/> 
                    </div>
                <!-- {!! Form::close() !!} -->
              </div>
            <?php endforeach; ?> 
           <div class="form-group">
                          <input class="form-control" type='text' name='lot_number' id="voucher_1" required placeholder="Lot Number" readonly />
                </div> 
            <br>
            <br>
         {{csrf_field()}}
            <div id="accordion" class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning" style="display: block">attach_money</i>Products
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
                        </tr>
                      <?php foreach ($requisition as $requisition):?>  
                        <tr>
                            <td><input type='checkbox' class='chkbox'/></td>
                            <td>1</td>
                            <td><input class="form-control" type='text' id='mr_supplier' name='mr_supplier[]' value="<?php echo $requisition->gi_supplier; ?>" required/></td>
                            <td><input class="form-control" type='text' id='mr_item' name='mr_item[]' value="<?php echo $requisition->gi_item; ?>" required/></td>
                            <td><input class="form-control" type='text' id='mr_size' name='mr_size[]' value="<?php echo $requisition->gi_size; ?>" required /> </td>
                            <td><input class="form-control" type='text' id='mr_specifications' name='mr_specifications[]' value="<?php echo $requisition->gi_specs; ?>" required /> </td>
                            <td><input class="form-control" type='text' id='mr_description' name='mr_description[]' value="<?php echo $requisition->gi_description; ?>"required/> </td>
                            <td><input class="form-control" type='text' id='mr_quantity' name='mr_quantity[]' value="<?php echo $requisition->gi_quantity; ?>" required/> </td>
                        </tr>
                      <?php endforeach; ?>
                        </table>
                    <!-- {!! Form::close() !!} -->
                    <br>
                    <br>
                    <br>
                </div>
                <br>              
                   <div class="form-group">
                          <label for="po_title" class="bmd-label-floating text-primary">Received By</label>
                          <input class="form-control" type='text' id='mr_received_by' name='mr_received_by' value="<?php echo $details->gi_received_by; ?>" required/> 
                    </div>
                     <div class="form-group">
                          <label for="created_at" class="bmd-label-floating text-primary">Receiving Date</label>
                          <input class="form-control" type='text' id='created_at' name='created_at' value="<?php echo $details->created_at; ?>" required/> 
                    </div>
                <div align="center">
                 <a href="{{action('MrreportController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                  <input type="submit" class="btn btn-primary btn-raised" id="sbmt" value="Save">
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
  $(document).ready(function(){
 function fetch_voucher_number(query = '')
 {
  $.ajax({
   url:"{{ route('searchlotnumber') }}",
   method:'GET',
   data:{query:query},
   dataType:'json',
   success:function(data)
   {
    $('#voucher_1').val(data.table_data);
   }
  })
 }

setInterval(function()
 { 
  var query = "1";
  fetch_voucher_number(query);
 }, 1200);
});

 window.onbeforeunload = function() {
        return "Data will be lost if you leave the page, are you sure?";
  };
</script> 

 

 @endsection 
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>  
  <?php  } else {  redirect()->to('home')->send(); } ?> 