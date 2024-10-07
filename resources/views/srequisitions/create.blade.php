@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Sale Requisition)</small>
          </h3>
          <br>
          <form method="post" action="{{url('srequisitions')}}">
          <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>  
           <div class="container">
               <!--  {!! Form::open() !!}  -->
                <div class="form-group">
                          <input class="form-control" type='text' name='sr_number' id="voucher_1" required readonly placeholder="Requistion Number" />
                </div> 
                <div class="form-group">
                          <label for="bk_name" class="text-primary">Date</label>
                          <input class="form-control" type="date" id="date" name="date" />
                    </div>
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='sr_name' name='sr_name' value="{{ Auth::user()->name }}" required/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='sr_title' name='sr_title' required/>
                    </div>

                <!-- {!! Form::close() !!} -->
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
                          <th>Model</th>
                          <th>Specifications</th>
                          <th>Item Name</th>
                          <th>Supplier</th>
                          <th>Description</th>
                          <th>Quantity</th>
                        </tr>
                        <tr>
                          <td><input type='checkbox' class='chkbox'/></td>
                          <td>1</td>
                          <td><input class="form-control expense_txt" type='text' data-type="size" id='sr_size_1' name='sr_size[]' required /> </td>
                          <td><input class="form-control expense_txt" type='text' data-type="specifications" id='sr_specifications_1' name='sr_specifications[]' required/></td>
                          <td><input class="form-control expense_txt" type='text' data-type="item" id='sr_item_1' name='sr_item[]' required/></td>
                          <td><input class="form-control expense_txt" type='text' data-type="supplier" id='sr_supplier_1' name='sr_supplier[]' required/></td>
                          <td><input class="form-control" type='text' id='sr_description' name='sr_description[]' required/> </td>
                          <td><input class="form-control" type='number' id='sr_quantity' name='sr_quantity[]' required/> </td>
                        </tr>
                        </table>
                        <button type="button" class='btn btn-danger delete'>- Delete</button>
                        <button type="button" class='btn btn-success addbtn'>+ Add More</button>
                    <!-- {!! Form::close() !!} -->
                    <br>
                    <br>
                    <br>
                </div>
                <br>              
                <div align="center" >
                 <!-- <a href="{{action('PrequisitionController@savedPr')}}" class="btn btn-warning btn-raised">Cancel</a> -->
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
      data+="<td><input class='form-control expense_txt' type='text' data-type='size' id='sr_size_"+i+"' name='sr_size[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='specifications' id='sr_specifications_"+i+"' name='sr_specifications[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='item' id='sr_item_"+i+"' name='sr_item[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='supplier' id='sr_supplier_"+i+"' name='sr_supplier[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='sr_description_"+i+"' name='sr_description[]' required/></td>";
      data+="<td><input class='form-control' type='number' id='sr_quantity_"+i+"' name='sr_quantity[]' required/></td>";
      data+="</tr>";
  $('table').append(data);
   document.getElementById("sr_size_"+i+"").select();
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

$(document).on('focus','.expense_txt',function(){
  type = $(this).data('type');
  if(type =='id')autoType='p_ID';  
  if(type =='item')autoType='p_name'; 
  if(type =='size')autoType='p_size'; 
  if(type =='specifications')autoType='p_specs'; 
  if(type =='supplier')autoType='s_company'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchproduct') }}",
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
           $('#sr_ID_'+elementId).val(data.p_ID);
           $('#sr_item_'+elementId).val(data.p_name);
           $('#sr_size_'+elementId).val(data.p_size);
           $('#sr_specifications_'+elementId).val(data.p_specs);
           $('#sr_supplier_'+elementId).val(data.s_company);
       }
   }); 
});


$(document).ready(function(){
 function fetch_voucher_number(query = '')
 {
  $.ajax({
   url:"{{ route('searchsreqnumber') }}",
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
 
</script>
 <!-- For Auto Calculation of Values -->
<script>
//  setInterval(function()
//  { 
//     findrunningTotal();
//      findTotal(); 
//  }, 1200);

// function findrunningTotal(){
//     var quantity = document.getElementsByName('pr_quantity[]');
//     var unitprice = document.getElementsByName('pr_unitprice[]');
//     var arr = document.getElementsByName('total[]');
//     var tot= 0;
//     for(var j=0;j<unitprice.length;j++){
//         if(parseInt(unitprice[j].value))
//         tot = parseInt(unitprice[j].value);   
//  arr[j].value = tot * parseInt(quantity[j].value);     
//     }
// }

// function findTotal()
// {
// var runningtotal = document.getElementsByName('total[]');
// var total = 0;
//     for(var i=0;i<runningtotal.length;i++){
//         if(parseInt(runningtotal[i].value))
//         total += parseInt(runningtotal[i].value);  
//         document.getElementById('pr_totalprice').value = total; 
//     }   

// }

 window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
  };
</script> 


 @endsection 
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>  
 <?php  } else {  redirect()->to('home')->send(); } ?> 