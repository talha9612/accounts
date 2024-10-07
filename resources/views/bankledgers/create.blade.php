<!-- create.blade.php -->
@extends('master')
@section('content')

  
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Cash Payment)</small>
          </h3>
          <br>
          <form method="post" action="{{url('cashtransactions')}}">
           <div class="container">
               <!--  {!! Form::open() !!}  -->
                <div class="form-group">
                          <label for="vr_no" class="bmd-label-floating text-primary">  Voucher. No</label>
                          <input class="form-control" type='text' name='vr_no' value="1" required />
                </div> 
                  <div class="form-inline">
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Account Title</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="countryname" id='countryname_1' name='countryname' required/>
                    </div>
                    <div class="form-group" style="margin-left: 65%">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Opening Balance</label>
                          <input class="form-control autocomplete_txt" type='text' data-type="country_code" id='country_code_1' name='country_code' required/> 
                    </div>
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
                     <i class="material-icons text-warning" style="display: block">attach_money</i>Expenses
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
                            <th>S. No</th>
                            <th>Name</th>
                            <th>Head</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                        <tr>
                            <td><input type='checkbox' class='chkbox'/></td>
                            <td><input type="number" id='sn' value="1" name="ct_sno[]" readonly></td>
                            <td><input class="form-control expense_txt" type='text' data-type="name" id='name_1' name='name[]' required/></td>
                            <td><input class="form-control expense_txt" type='text' data-type="head" id='head_1' name='head[]' required/> </td>
                            <td><input class="form-control" type='text'  id='desc' name='desc[]' required/> </td>
                            <td><input class="form-control" type='text'  id='amnt' name='amnt[]' required/> </td>
                        </tr>
                        </table>
                        <button type="button" class='btn btn-danger delete'>- Delete</button>
                        <button type="button" class='btn btn-success addbtn'>+ Add More</button>
                    <!-- {!! Form::close() !!} -->
                    <br>
                    <br>
                    <br>
                    <div> 
                     <label for="vr_no" class="bmd-label-floating text-primary">Grand Total</label>
                    <input class="form-control" type='number' id="vr_amount" name="vr_amount" required readonly /> 
                     <label for="r_balance" class="bmd-label-floating text-primary">Remaining Balance</label>
                    <input class="form-control" type='number' id="r_balance" name="r_balance" required readonly /> 
                  </div>
                </div>
                <br>
                <div align="center" >
               <a href="{{action('CashtransactionController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Submit</button>
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
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');
  
  if(type =='countryname' )autoType='cih_title'; 
  if(type =='country_code' )autoType='cih_balance'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchaccount') }}",
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
           $('#countryname_'+elementId).val(data.cih_title);
           $('#country_code_'+elementId).val(data.cih_balance);
       }
   }); 
});
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
      data+="<td><input type='number' id='sn"+i+"' value='"+count+"' readonly name='ct_sno[]'></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='name' id='name_"+i+"' name='name[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='head' id='head_"+i+"' name='head[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='desc[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='amnt_"+i+"' name='amnt[]' required/></td></tr>";
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
//autocomplete script
$(document).on('focus','.expense_txt',function(){
  type = $(this).data('type');
  
  if(type =='name' )autoType='h_name'; 
  if(type =='head' )autoType='h_ID'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchhead') }}",
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
           $('#name_'+elementId).val(data.h_name);
           $('#head_'+elementId).val(data.h_ID);
       }
   }); 
});
</script>
 <!-- For Auto Calculation of Values -->
<script>
 setInterval(function()
 { 
     findTotal(); 
 }, 800);

function findTotal(){
    var arr = document.getElementsByName('amnt[]');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
document.getElementById('vr_amount').value = tot;
var balance = document.getElementById('country_code_1').value;
var calcamount = document.getElementById('vr_amount').value;

document.getElementById('r_balance').value = balance - calcamount;

}
</script>  
  
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 