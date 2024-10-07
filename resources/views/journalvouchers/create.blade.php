<!-- create.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->jvadd) && Auth::user()->jvadd == '1')
      { ?>

<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            New Record <small class="text-muted">(Journal Voucher)</small>
          </h3>
          <br>
          <form method="post" action="{{url('journalvouchers')}}">
            <div id="fiscalyear">
            <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
            <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
            <input type="text" name="fsclyear" id="fsclyear">
          </div>
           <div class="container">
               <!--  {!! Form::open() !!}  -->
               <div class="form-group">
                  <input class="form-control" type='text' name='voucher' id="voucher_1" placeholder="Voucher Number" readonly required />
                </div>

                <!--  <div class="form-group">
                          <label for="bk_name" class="text-primary">Date</label>
                          <input class="form-control" type="date" id="date" name="date" />
                    </div> -->
                <!-- {!! Form::close() !!} -->
              </div>
            <br>
            <br>
         {{csrf_field()}}

         <input type="hidden" name="jv_preparedby" value="<?php echo Auth::user()->name ?>">
             <div class="container">

                    <!-- {!! Form::open() !!} -->
                      <table class="table table-bordered">
                        <tr class="bg-primary text-white">
                            <th><input class='check_all' type='checkbox' onclick="select_all()"/>


                            </th>
                            <th>Account Title</th>
                            <th>ID / Account #</th>
                            <th>Description</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Balance</th>
                        </tr>
                        </table>

                          <select name="things" class="form-control">
                                <option>Select Account (DR or CR)</option>
                                <option value="addbtnDR">+Cash Account DR</option>
                                <option value="addbtn">+Cash Account CR</option>
                                <option value="addbk">+Bank Account CR</option>
                                <option value="addbkDR">+Bank Account DR</option>
                                <option value="addfrDR">+Customer DR</option>
                                <option value="addfr">+Customer CR</option>
                                <option value="addsr">+Supplier CR</option>
                                <option value="addsrDR">+Supplier DR</option>
                                <option value="add">+Add CR</option>
                                <option value="addDR">+Add DR</option>
                              </select>

                        <div class="form-inline" style="margin-left: 40%">
                        <label>Total Debit</label>
                        <input type="text" name="totaldebit" id="totaldebit" class="form-control" readonly required />

                        <label>Total Credit</label>
                        <input type="text" name="totalcredit" id="totalcredit" class="form-control" readonly required>
                        </div>

                    <div class="form-inline">
                      <button type="button" class='btn btn-danger delete'>- Delete</button>


                     <!--  <div class="form-group col-md-2">
                              <a style="text-decoration: none" data-toggle="collapse" href="#credits" aria-expanded="false" aria-controls="ledgers">
                        <i class="material-icons text-dark">chrome_reader_mode</i>
                        <b>Credits</b>
                      </a>
                      <div class="collapse" id="credits">
                        <button type="button" class='btn btn-success addbtn'>+Cash Account CR</button>
                        <button type="button" class='btn btn-success addbk'>+Bank Account CR</button>
                        <button type="button" class='btn btn-success addfr'>+Customer CR</button>
                        <button type="button" class='btn btn-success addsr'>+Supplier CR</button>
                        <button type="button" class='btn btn-success add'>+Add CR</button>
                      </div>
                    </div> -->
                    <!--  <div class="form-group col-md-2">
                              <a style="text-decoration: none" data-toggle="collapse" href="#debits" aria-expanded="false" aria-controls="ledgers">
                        <i class="material-icons text-dark">chrome_reader_mode</i>
                        <b>Debits</b>
                      </a>
                      <div class="collapse" id="debits">
                        <button type="button" class='btn btn-success addbtnDR'>+Cash Account DR</button>
                        <button type="button" class='btn btn-success addbkDR'>+Bank Account DR</button>
                        <button type="button" class='btn btn-success addfrDR'>+Customer DR</button>
                        <button type="button" class='btn btn-success addsrDR'>+Supplier DR</button>
                        <button type="button" class='btn btn-success addDR'>+Add DR</button>
                      </div>
                    </div> -->
                    </div>

                    <!-- {!! Form::close() !!} -->
                    <br>
                    <br>
                    <br>
                </div>
                <br>
                <div align="center" >
                 <a href="{{action('JvController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                  <button type="submit" class="btn btn-primary btn-raised" id="sbmt" onclick="checkFunction()">Submit</button>
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
$(document).ready(function(){

function focusfirst()
{
   $("#voucher_1").focus();
}

 function fetch_voucher_number(query = '')
 {

  $.ajax({
   url:"{{ route('searchvoucherjournal') }}",
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

setTimeout(function()
 {

  focusfirst();
 }, 400);

});
//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
  type = $(this).data('type');

  if(type =='countryname' )autoType='cih_title';
  if(type =='accountid' )autoType='cih_ID';
  if(type =='cihbalance' )autoType='cih_balance';

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
           $('#accountid_'+elementId).val(data.cih_ID);
           $('#cihbalance_'+elementId).val(data.cih_balance);
       }
   });
});


$(document).on('focus','.bank_txt',function(){
  type = $(this).data('type');

  if(type =='accountname' )autoType='acc_title';
  if(type =='accountnumber' )autoType='acc_number';

   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchbankaccount') }}",
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
           $('#accountname_'+elementId).val(data.acc_title);
           $('#accountnumber_'+elementId).val(data.acc_number);
           $('#accbalance_'+elementId).val(data.acc_balance);
       }
   });
});


$(document).on('focus','.farmer_txt',function(){
  type = $(this).data('type');

  if(type =='farmername' )autoType='fr_name';
  if(type =='farmerid' )autoType='fr_ID';
  if(type =='frbalance' )autoType='fr_balance';

   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchfarmer') }}",
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
           $('#farmername_'+elementId).val(data.fr_name);
           $('#farmerid_'+elementId).val(data.fr_ID);
           $('#frbalance_'+elementId).val(data.fr_balance);
       }
   });
});

$(document).on('focus','.supplier_txt',function(){
  type = $(this).data('type');

  if(type =='suppliercompany' )autoType='s_company';
  if(type =='supplierid' )autoType='s_ID';
  if(type =='supplierbalance' )autoType='s_balance';

   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchjsupplier') }}",
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
           $('#suppliercompany_'+elementId).val(data.s_company);
           $('#supplierid_'+elementId).val(data.s_ID);
           $('#supplierbalance_'+elementId).val(data.s_balance);
       }
   });
});


$(document).on('focus','.expense_txt',function(){
  type = $(this).data('type');

  if(type =='name' )autoType='h_name';
  if(type =='head' )autoType='h_ID';
  if(type =='type' )autoType='h_type';
  if(type =='balance' )autoType='h_balance';

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
           $('#type_'+elementId).val(data.h_type);
           $('#balance_'+elementId).val(data.h_balance);
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

$('select[name=things]').on('click',function() {
   if ($(this).val() == 'addbtn')
    {
      count=$('table tr').length;

      var data="<tr><td class='text-primary'><input type='checkbox' class='chkbox' name='chkbox[]'/> CIH CR</td>";
      data+="<td><input class='form-control autocomplete_txt' type='text' data-type='countryname' id='countryname_"+i+"' name='countryname[]' required /></td>";
      data+="<td><input class='form-control autocomplete_txt' type='text' data-type='accountid' id='accountid_"+i+"' name='accountid[]'  required /></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='cihdesc[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='debit_"+i+"' readonly /></td>"
      data+="<td><input class='form-control' type='text' id='credit_"+i+"' name='credit[]' required /><input type='hidden' name='chk[]'/></td>";
      data+="<td><input class='form-control autocomplete_txt' type='text' id='cihbalance_"+i+"' name='cihbalance[]' required /></td></tr>";
  $('table').append(data);
  document.getElementById("countryname_"+i+"").select();
  i++;
    $(this).val($("option:first").val());
    }

    else if ($(this).val() == 'addbtnDR')
    {

      count=$('table tr').length;
      var data="<tr><td class='text-primary'><input type='checkbox' class='chkbox' name='chkbox[]'/> CIH DR</td>";
      data+="<td><input class='form-control autocomplete_txt' type='text' data-type='countryname' id='countryname_"+i+"' name='debitaccountname[]' required /></td>";
      data+="<td><input class='form-control autocomplete_txt' type='text' data-type='accountid' id='accountid_"+i+"' name='debitaccountid[]'   required/></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='debitdescription[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='debit_"+i+"' name='debitamount[]' required /></td>"
      data+="<td><input class='form-control' type='text' id='credit_"+i+"' readonly /><input type='hidden' name='chk[]'/></td>";
      data+="<td><input class='form-control autocomplete_txt' type='text' id='cihbalance_"+i+"' name='debitbalance[]' required /></td></tr>";
  $('table').append(data);
   document.getElementById("countryname_"+i+"").select();
  i++;
  $(this).val($("option:first").val());
    }

    else if ($(this).val() == 'addbk')
    {

      count=$('table tr').length;

      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> A/C CR</td>";
      data+="<td><input class='form-control bank_txt' type='text' data-type='accountname' id='accountname_"+i+"' name='accountname[]' required/></td>";
      data+="<td><input class='form-control bank_txt' type='text' data-type='accountnumber' id='accountnumber_"+i+"' name='accountnumber[]'  required /></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='desc[]'  required/></td>";
      data+="<td><input class='form-control' type='text' id='debit_"+i+"' readonly /></td>"
      data+="<td><input class='form-control' type='text' id='credit_"+i+"' name='creditbk[]' required  /><input type='hidden' name='chk[]'/></td>";
      data+="<td><input class='form-control bank_txt' type='text' id='accbalance_"+i+"' name='accbalance[]' required/></td></tr>";
  $('table').append(data);
   document.getElementById("accountname_"+i+"").select();
  i++;
  $(this).val($("option:first").val());
    }

    else if ($(this).val() == 'addbkDR')
    {
        count=$('table tr').length;

      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> A/C DR</td>";
      data+="<td><input class='form-control bank_txt' type='text' data-type='accountname' id='accountname_"+i+"' name='bkdebitaccountname[]' required /></td>";
      data+="<td><input class='form-control bank_txt' type='text' data-type='accountnumber' id='accountnumber_"+i+"' name='bkdebitaccountnumber[]'  required/></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='bkdebitdescription[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='debit_"+i+"' name='bkdebitamount[]' required /></td>"
      data+="<td><input class='form-control' type='text' id='credit_"+i+"' readonly /><input type='hidden' name='chk[]'/></td>";
      data+="<td><input class='form-control bank_txt' type='text' id='accbalance_"+i+"' name='bkdebitbalance[]' required/></td></tr>";
  $('table').append(data);
   document.getElementById("accountname_"+i+"").select();
  i++;
  $(this).val($("option:first").val());
    }

    else if ($(this).val() == 'addfr')
    {
       count=$('table tr').length;

      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Customer CR</td>";
      data+="<td><input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_"+i+"' name='farmername[]' required /></td>";
      data+="<td><input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_"+i+"' name='farmerid[]'  required /></td>";
      data+="<td><input class='form-control' type='text' id='frdesc_"+i+"' name='frdesc[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='frdebit_"+i+"'  readonly /></td>"
      data+="<td><input class='form-control' type='text' id='frcredit_"+i+"' name='frcredit[]' required /><input type='hidden' name='chk[]'/></td>";
      data+="<td><input class='form-control farmer_txt' type='text'  data-type='frbalance' id='frbalance_"+i+"' name='frbalance[]' required/></td></tr>";
  $('table').append(data);
   document.getElementById("farmername_"+i+"").select();
  i++;

  $(this).val($("option:first").val());
    }

  else if ($(this).val() == 'addfrDR')
    {
       count=$('table tr').length;

      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Customer DR</td>";
      data+="<td><input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_"+i+"' name='debitfarmername[]' required /></td>";
      data+="<td><input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_"+i+"' name='debitfarmerid[]'  required /></td>";
      data+="<td><input class='form-control' type='text' id='frdesc_"+i+"' name='frdebitdesc[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='frdebit_"+i+"' name='farmerdebitamount[]' required /></td>"
      data+="<td><input class='form-control' type='text' id='frcredit_"+i+"' readonly /><input type='hidden' name='chk[]'/></td>";
      data+="<td><input class='form-control farmer_txt' type='text'  data-type='frbalance' id='frbalance_"+i+"' name='debitfarmerbalance[]' required/></td></tr>";
  $('table').append(data);
   document.getElementById("farmername_"+i+"").select();
  i++;


  $(this).val($("option:first").val());
    }

  else if ($(this).val() == 'addsr')
    {
       count=$('table tr').length;

      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Supplier CR</td>";
      data+="<td><input class='form-control supplier_txt' type='text' data-type='suppliercompany' id='suppliercompany_"+i+"' name='suppliercompany[]'  required/></td>";
      data+="<td><input class='form-control supplier_txt' type='text' data-type='supplierid' id='supplierid_"+i+"' name='supplierid[]'  required /></td>";
      data+="<td><input class='form-control' type='text' id='srdesc_"+i+"' name='srdesc[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='srdebit_"+i+"' readonly /></td>"
      data+="<td><input class='form-control' type='text' id='srcredit_"+i+"' name='srcredit[]' required /><input type='hidden' name='chk[]'/></td>";
      data+="<td><input class='form-control supplier_txt' type='text'  data-type='supplierbalance' id='supplierbalance_"+i+"' name='supplierbalance[]' required/></td></tr>";
  $('table').append(data);
   document.getElementById("suppliercompany_"+i+"").select();
  i++;



  $(this).val($("option:first").val());
    }

    else if ($(this).val() == 'addsrDR')
    {
      count=$('table tr').length;

      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Supplier DR</td>";
      data+="<td><input class='form-control supplier_txt' type='text' data-type='suppliercompany' id='suppliercompany_"+i+"' name='debitsuppliercompany[]' required /></td>";
      data+="<td><input class='form-control supplier_txt' type='text' data-type='supplierid' id='supplierid_"+i+"' name='debitsupplierid[]'  required /></td>";
      data+="<td><input class='form-control' type='text' id='srdesc_"+i+"' name='srdebitdesc[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='srdebit_"+i+"' name='supplierdebitamount[]' required /><input type='hidden' name='chk[]'/></td>"
      data+="<td><input class='form-control' type='text' id='srcredit_"+i+"' readonly /></td>";
      data+="<td><input class='form-control supplier_txt' type='text'  data-type='supplierbalance' id='supplierbalance_"+i+"' name='debitsupplierbalance[]' required/></td></tr>";
  $('table').append(data);
   document.getElementById("suppliercompany_"+i+"").select();
  i++;

  $(this).val($("option:first").val());
    }

  else if ($(this).val() == 'add')
    {
       count=$('table tr').length;

      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/>CR</td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='name' id='name_"+i+"' name='name[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='head' id='head_"+i+"' name='head[]' required/></td>";
      data+="<td hidden><input class='form-control expense_txt' type='text' data-type='head' id='type_"+i+"' name='type[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='adddesc[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='debit_"+i+"' readonly  /></td>";
      data+="<td><input class='form-control' type='text' id='credit_"+i+"' name='addcredit[]' /><input type='hidden' name='chk[]'/></td>"
      data+="<td><input class='form-control expense_txt' type='text' data-type='balance' id='balance_"+i+"' name='balance[]' required /></td></tr>";
  $('table').append(data);
   document.getElementById("name_"+i+"").select();
  i++;


  $(this).val($("option:first").val());
    }

  else if ($(this).val() == 'addDR')
    {
       count=$('table tr').length;

      var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/>DR</td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='name' id='name_"+i+"' name='headname[]' required/></td>";
      data+="<td><input class='form-control expense_txt' type='text' data-type='head' id='head_"+i+"' name='headid[]' required/></td>";
      data+="<td hidden><input class='form-control expense_txt' type='text' data-type='head' id='type_"+i+"' name='headtype[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='headdesc[]' required/></td>";
      data+="<td><input class='form-control' type='text' id='debit_"+i+"' name='headdebitamount[]' required /></td>";
      data+="<td><input class='form-control' type='text' id='credit_"+i+"' readonly /><input type='hidden' name='chk[]'/></td>"
      data+="<td><input class='form-control expense_txt' type='text' data-type='balance' id='balance_"+i+"' name='headbalance[]' required /></td></tr>";
  $('table').append(data);
   document.getElementById("name_"+i+"").select();
  i++;

  $(this).val($("option:first").val());
    }

  });



// $(".addbtn").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-primary'><input type='checkbox' class='chkbox' name='chkbox[]'/> CIH CR</td>";
//       data+="<td><input class='form-control autocomplete_txt' type='text' data-type='countryname' id='countryname_"+i+"' name='countryname[]' required /></td>";
//       data+="<td><input class='form-control autocomplete_txt' type='text' data-type='accountid' id='accountid_"+i+"' name='accountid[]'  required /></td>";
//       data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='cihdesc[]' required /></td>";
//       data+="<td><input class='form-control' type='text' id='debit_"+i+"' readonly /></td>"
//       data+="<td><input class='form-control' type='text' id='credit_"+i+"' name='credit[]' required /><input type='hidden' name='chk[]'/></td>";
//       data+="<td><input class='form-control autocomplete_txt' type='text' id='cihbalance_"+i+"' name='cihbalance[]' required /></td></tr>";
//   $('table').append(data);
//   document.getElementById("countryname_"+i+"").select();
//   i++;
// });



// $(".addbtnDR").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-primary'><input type='checkbox' class='chkbox' name='chkbox[]'/> CIH DR</td>";
//       data+="<td><input class='form-control autocomplete_txt' type='text' data-type='countryname' id='countryname_"+i+"' name='debitaccountname[]' required /></td>";
//       data+="<td><input class='form-control autocomplete_txt' type='text' data-type='accountid' id='accountid_"+i+"' name='debitaccountid[]'   required/></td>";
//       data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='debitdescription[]' required/></td>";
//       data+="<td><input class='form-control' type='text' id='debit_"+i+"' name='debitamount[]' required /></td>"
//       data+="<td><input class='form-control' type='text' id='credit_"+i+"' readonly /><input type='hidden' name='chk[]'/></td>";
//       data+="<td><input class='form-control autocomplete_txt' type='text' id='cihbalance_"+i+"' name='debitbalance[]' required /></td></tr>";
//   $('table').append(data);
//    document.getElementById("countryname_"+i+"").select();
//   i++;
// });



// $(".addbk").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> A/C CR</td>";
//       data+="<td><input class='form-control bank_txt' type='text' data-type='accountname' id='accountname_"+i+"' name='accountname[]' required/></td>";
//       data+="<td><input class='form-control bank_txt' type='text' data-type='accountnumber' id='accountnumber_"+i+"' name='accountnumber[]'  required /></td>";
//       data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='desc[]'  required/></td>";
//       data+="<td><input class='form-control' type='text' id='debit_"+i+"' readonly /></td>"
//       data+="<td><input class='form-control' type='text' id='credit_"+i+"' name='creditbk[]' required  /><input type='hidden' name='chk[]'/></td>";
//       data+="<td><input class='form-control bank_txt' type='text' id='accbalance_"+i+"' name='accbalance[]' required/></td></tr>";
//   $('table').append(data);
//    document.getElementById("accountname_"+i+"").select();
//   i++;
// });

// $(".addbkDR").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> A/C DR</td>";
//       data+="<td><input class='form-control bank_txt' type='text' data-type='accountname' id='accountname_"+i+"' name='bkdebitaccountname[]' required /></td>";
//       data+="<td><input class='form-control bank_txt' type='text' data-type='accountnumber' id='accountnumber_"+i+"' name='bkdebitaccountnumber[]'  required/></td>";
//       data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='bkdebitdescription[]' required /></td>";
//       data+="<td><input class='form-control' type='text' id='debit_"+i+"' name='bkdebitamount[]' required /></td>"
//       data+="<td><input class='form-control' type='text' id='credit_"+i+"' readonly /><input type='hidden' name='chk[]'/></td>";
//       data+="<td><input class='form-control bank_txt' type='text' id='accbalance_"+i+"' name='bkdebitbalance[]' required/></td></tr>";
//   $('table').append(data);
//    document.getElementById("accountname_"+i+"").select();
//   i++;
// });

// $(".addfr").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Customer CR</td>";
//       data+="<td><input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_"+i+"' name='farmername[]' required /></td>";
//       data+="<td><input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_"+i+"' name='farmerid[]'  required /></td>";
//       data+="<td><input class='form-control' type='text' id='frdesc_"+i+"' name='frdesc[]' required /></td>";
//       data+="<td><input class='form-control' type='text' id='frdebit_"+i+"'  readonly /></td>"
//       data+="<td><input class='form-control' type='text' id='frcredit_"+i+"' name='frcredit[]' required /><input type='hidden' name='chk[]'/></td>";
//       data+="<td><input class='form-control farmer_txt' type='text'  data-type='frbalance' id='frbalance_"+i+"' name='frbalance[]' required/></td></tr>";
//   $('table').append(data);
//    document.getElementById("farmername_"+i+"").select();
//   i++;
// });

// $(".addfrDR").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Customer DR</td>";
//       data+="<td><input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_"+i+"' name='debitfarmername[]' required /></td>";
//       data+="<td><input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_"+i+"' name='debitfarmerid[]'  required /></td>";
//       data+="<td><input class='form-control' type='text' id='frdesc_"+i+"' name='frdebitdesc[]' required /></td>";
//       data+="<td><input class='form-control' type='text' id='frdebit_"+i+"' name='farmerdebitamount[]' required /></td>"
//       data+="<td><input class='form-control' type='text' id='frcredit_"+i+"' readonly /><input type='hidden' name='chk[]'/></td>";
//       data+="<td><input class='form-control farmer_txt' type='text'  data-type='frbalance' id='frbalance_"+i+"' name='debitfarmerbalance[]' required/></td></tr>";
//   $('table').append(data);
//    document.getElementById("farmername_"+i+"").select();
//   i++;
// });

// $(".addsr").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Supplier CR</td>";
//       data+="<td><input class='form-control supplier_txt' type='text' data-type='suppliercompany' id='suppliercompany_"+i+"' name='suppliercompany[]'  required/></td>";
//       data+="<td><input class='form-control supplier_txt' type='text' data-type='supplierid' id='supplierid_"+i+"' name='supplierid[]'  required /></td>";
//       data+="<td><input class='form-control' type='text' id='srdesc_"+i+"' name='srdesc[]' required /></td>";
//       data+="<td><input class='form-control' type='text' id='srdebit_"+i+"' readonly /></td>"
//       data+="<td><input class='form-control' type='text' id='srcredit_"+i+"' name='srcredit[]' required /><input type='hidden' name='chk[]'/></td>";
//       data+="<td><input class='form-control supplier_txt' type='text'  data-type='supplierbalance' id='supplierbalance_"+i+"' name='supplierbalance[]' required/></td></tr>";
//   $('table').append(data);
//    document.getElementById("suppliercompany_"+i+"").select();
//   i++;
// });

// $(".addsrDR").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Supplier DR</td>";
//       data+="<td><input class='form-control supplier_txt' type='text' data-type='suppliercompany' id='suppliercompany_"+i+"' name='debitsuppliercompany[]' required /></td>";
//       data+="<td><input class='form-control supplier_txt' type='text' data-type='supplierid' id='supplierid_"+i+"' name='debitsupplierid[]'  required /></td>";
//       data+="<td><input class='form-control' type='text' id='srdesc_"+i+"' name='srdebitdesc[]' required /></td>";
//       data+="<td><input class='form-control' type='text' id='srdebit_"+i+"' name='supplierdebitamount[]' required /><input type='hidden' name='chk[]'/></td>"
//       data+="<td><input class='form-control' type='text' id='srcredit_"+i+"' readonly /></td>";
//       data+="<td><input class='form-control supplier_txt' type='text'  data-type='supplierbalance' id='supplierbalance_"+i+"' name='debitsupplierbalance[]' required/></td></tr>";
//   $('table').append(data);
//    document.getElementById("suppliercompany_"+i+"").select();
//   i++;
// });

// $(".add").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/>CR</td>";
//       data+="<td><input class='form-control expense_txt' type='text' data-type='name' id='name_"+i+"' name='name[]' required/></td>";
//       data+="<td><input class='form-control expense_txt' type='text' data-type='head' id='head_"+i+"' name='head[]' required/></td>";
//       data+="<td hidden><input class='form-control expense_txt' type='text' data-type='head' id='type_"+i+"' name='type[]' required/></td>";
//       data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='adddesc[]' required/></td>";
//       data+="<td><input class='form-control' type='text' id='debit_"+i+"' readonly  /></td>";
//       data+="<td><input class='form-control' type='text' id='credit_"+i+"' name='addcredit[]' /><input type='hidden' name='chk[]'/></td>"
//       data+="<td><input class='form-control expense_txt' type='text' data-type='balance' id='balance_"+i+"' name='balance[]' required /></td></tr>";
//   $('table').append(data);
//    document.getElementById("name_"+i+"").select();
//   i++;
// });

// $(".addDR").on('click',function(){
//   count=$('table tr').length;

//       var data="<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/>DR</td>";
//       data+="<td><input class='form-control expense_txt' type='text' data-type='name' id='name_"+i+"' name='headname[]' required/></td>";
//       data+="<td><input class='form-control expense_txt' type='text' data-type='head' id='head_"+i+"' name='headid[]' required/></td>";
//       data+="<td hidden><input class='form-control expense_txt' type='text' data-type='head' id='type_"+i+"' name='headtype[]' required/></td>";
//       data+="<td><input class='form-control' type='text' id='desc_"+i+"' name='headdesc[]' required/></td>";
//       data+="<td><input class='form-control' type='text' id='debit_"+i+"' name='headdebitamount[]' required /></td>";
//       data+="<td><input class='form-control' type='text' id='credit_"+i+"' readonly /><input type='hidden' name='chk[]'/></td>"
//       data+="<td><input class='form-control expense_txt' type='text' data-type='balance' id='balance_"+i+"' name='headbalance[]' required /></td></tr>";
//   $('table').append(data);
//    document.getElementById("name_"+i+"").select();
//   i++;
// });

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
   setInterval(function()
 {
     findTotaldebit();
     findTotalcredit();
     if( document.getElementById('totaldebit').value === document.getElementById('totalcredit').value){
      document.getElementById('sbmt').disabled = false;
     }
     if( document.getElementById('totaldebit').value !== document.getElementById('totalcredit').value){
      document.getElementById('sbmt').disabled = true;
     }
     if(document.getElementById('totaldebit').value === '' || document.getElementById('totaldebit').value === '0'){
       document.getElementById('sbmt').disabled = true;
     }
     if(document.getElementById('totalcredit').value === '' || document.getElementById('totalcredit').value === '0'){
       document.getElementById('sbmt').disabled = true;
     }


 }, 1200);

function findTotaldebit(){
    var check = document.getElementsByName('chk[]');
    var cashdebit = document.getElementsByName('debitamount[]');
    var bankdebit = document.getElementsByName('bkdebitamount[]');
    var crdebit = document.getElementsByName('farmerdebitamount[]');
    var srdebit = document.getElementsByName('supplierdebitamount[]');
    var adddebit = document.getElementsByName('headdebitamount[]');
    var tot=0;
    for(var i=0;i<check.length;i++){
      if(cashdebit[i] === undefined)
        {

        }
      else{
        if(parseFloat(cashdebit[i].value))
            tot += parseFloat(cashdebit[i].value);
           document.getElementById('totaldebit').value = tot;
      }
      if(bankdebit[i] === undefined)
        {

        }

     else{

       if(parseFloat(bankdebit[i].value))
          tot += parseFloat(bankdebit[i].value);
          document.getElementById('totaldebit').value = tot;
      }

      if(crdebit[i] === undefined)
        {

        }
      else {
      if(parseFloat(crdebit[i].value))
            tot += parseFloat(crdebit[i].value);
      document.getElementById('totaldebit').value = tot;
      }
       if(srdebit[i] === undefined)
        {

        }
        else {
      if(parseFloat(srdebit[i].value))
            tot += parseFloat(srdebit[i].value);
      document.getElementById('totaldebit').value = tot;
      }
       if(adddebit[i] === undefined)
        {

        }
        else {
      if(parseFloat(adddebit[i].value))
            tot += parseFloat(adddebit[i].value);
      document.getElementById('totaldebit').value = tot;
      }
    }
}

function findTotalcredit(){
    var check = document.getElementsByName('chk[]');
    var cashcredit = document.getElementsByName('credit[]');
    var bankcredit = document.getElementsByName('creditbk[]');
    var crcredit = document.getElementsByName('frcredit[]');
    var srcredit = document.getElementsByName('srcredit[]');
    var addcredit = document.getElementsByName('addcredit[]');
    var tot=0;
    for(var i=0;i<check.length;i++){
      if(cashcredit[i] === undefined)
        {

        }
      else{
        if(parseFloat(cashcredit[i].value))
            tot += parseFloat(cashcredit[i].value);
           document.getElementById('totalcredit').value = tot;
      }
      if(bankcredit[i] === undefined)
        {

        }

     else{

       if(parseFloat(bankcredit[i].value))
          tot += parseFloat(bankcredit[i].value);
          document.getElementById('totalcredit').value = tot;
      }

      if(crcredit[i] === undefined)
        {

        }
      else {
      if(parseFloat(crcredit[i].value))
            tot += parseFloat(crcredit[i].value);
      document.getElementById('totalcredit').value = tot;
      }
       if(srcredit[i] === undefined)
        {

        }
        else {
      if(parseFloat(srcredit[i].value))
            tot += parseFloat(srcredit[i].value);
      document.getElementById('totalcredit').value = tot;
      }
       if(addcredit[i] === undefined)
        {

        }
        else {
      if(parseFloat(addcredit[i].value))
            tot += parseFloat(addcredit[i].value);
      document.getElementById('totalcredit').value = tot;
      }
    }
}


function checkFunction()
{

  Bsbmt();
}
function Bsbmt()
{
        cashTotalCredit();
        cashTotalDebit();
        bankTotalCredit();
        bankTotalDebit();
        farmerTotalCredit();
        farmerTotalDebit();
        supplierTotalCredit();
        supplierTotalDebit();
        addTotalCredit();
        addTotalDebit();
}
function cashTotalCredit(){
    var arr = document.getElementsByName('credit[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
        document.getElementsByName('cihbalance[]')[i].value = document.getElementsByName('cihbalance[]')[i].value - tot.toFixed(2);

    }

}
function cashTotalDebit(){
    var arr = document.getElementsByName('debitamount[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
        document.getElementsByName('debitbalance[]')[i].value = +document.getElementsByName('debitbalance[]')[i].value + +tot.toFixed(2);
    }

}
function bankTotalCredit(){
    var arr = document.getElementsByName('creditbk[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
        document.getElementsByName('accbalance[]')[i].value = document.getElementsByName('accbalance[]')[i].value - tot.toFixed(2);
    }

}
function bankTotalDebit(){
    var arr = document.getElementsByName('bkdebitamount[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
        document.getElementsByName('bkdebitbalance[]')[i].value = +document.getElementsByName('bkdebitbalance[]')[i].value + +tot.toFixed(2);
    }

}
function farmerTotalCredit(){
    var arr = document.getElementsByName('frcredit[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
        document.getElementsByName('frbalance[]')[i].value = document.getElementsByName('frbalance[]')[i].value - tot.toFixed(2);
    }

}
function farmerTotalDebit(){
    var arr = document.getElementsByName('farmerdebitamount[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
        document.getElementsByName('debitfarmerbalance[]')[i].value = +document.getElementsByName('debitfarmerbalance[]')[i].value + +tot.toFixed(2);
    }

}
function supplierTotalCredit(){
    var arr = document.getElementsByName('srcredit[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
        document.getElementsByName('supplierbalance[]')[i].value = +document.getElementsByName('supplierbalance[]')[i].value + +tot.toFixed(2);
    }

}
function supplierTotalDebit(){
    var arr = document.getElementsByName('supplierdebitamount[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
        document.getElementsByName('debitsupplierbalance[]')[i].value = document.getElementsByName('debitsupplierbalance[]')[i].value - tot.toFixed(2);
    }

}
function addTotalCredit(){
    var arr = document.getElementsByName('addcredit[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
      if(document.getElementsByName('type[]')[i].value == 'Liability' || document.getElementsByName('type[]')[i].value == 'Income'){
        document.getElementsByName('balance[]')[i].value = +document.getElementsByName('balance[]')[i].value + +tot.toFixed(2);
      }
      else{
        document.getElementsByName('balance[]')[i].value = document.getElementsByName('balance[]')[i].value - tot.toFixed(2);
      }

    }

}
function addTotalDebit(){
    var arr = document.getElementsByName('headdebitamount[]');

    for(var i=0;i<arr.length;i++){
      var tot=0;
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
      if(document.getElementsByName('headtype[]')[i].value == 'Liability' || document.getElementsByName('headtype[]')[i].value == 'Income'){
         document.getElementsByName('headbalance[]')[i].value = document.getElementsByName('headbalance[]')[i].value - tot.toFixed(2);
      }
      else{
        document.getElementsByName('headbalance[]')[i].value = +document.getElementsByName('headbalance[]')[i].value + +tot.toFixed(2);
      }
    }
}
//  window.onbeforeunload = function() {
//   return "Data will be lost if you leave the page, are you sure?";
//   };
</script>
 @endsection
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
 <?php  } else {  redirect()->to('home')->send(); } ?>
