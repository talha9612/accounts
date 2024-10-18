<!-- create.blade.php -->
@extends('master')
@section('content')
<?php
if (isset(Auth::user()->breceiptsadd) && Auth::user()->breceiptsadd == '1') { ?>
  <!-- WORK AREA START -->
  <h3 align="center" class="text-primary">
    New Record <small class="text-muted">(Sale Receipt)</small>
  </h3>
  <br>
  <form action="{{ route('salereceipts.Store') }}" method="POST">
  @csrf
    <div id="fiscalyear">
      <input type="text" name="crntdate" id="crntdate" value="<?php echo date("Y/m/d") ?>">
      <input type="text" name="compdate" id="compdate" value="<?php echo date("Y") ?>/06/30">
      <input type="text" name="fsclyear" id="fsclyear">
    </div>
    <div class="container">
      <!--  {!! Form::open() !!}  -->
      <div class="form-group row">
        <div class="col-md-6">
          <input class="form-control" type="text" name="receipt" id="receipt_1" placeholder="Receipt Number" required readonly />
          <input type="hidden" name="preparedby" id="preparedby" value="<?php echo Auth::user()->name ?>" />
        </div>
        <div class="col-md-6">
          <input class="form-control" type="date" id="date" name="date" />
        </div>
      </div>
      <div class="form-inline">

        <div class="form-group col-sm-3">
          <label for="customer_name" class="bmd-label-floating text-primary">Customer</label>
          <input class="form-control autocomplete_txt" type='text' data-type="customer_name" id='customer_name_1' name='customer_name' required />
        </div>
        <div class="form-group col-sm-3">
          <label for="balances" class="bmd-label-floating text-primary">Balance</label>
          <input class="form-control autocomplete_txt" type='text' data-type="balances" id='balances_1' name='balances' required />
        </div>
        <div class="form-group col-sm-3">
          <label for="sq_number_1" class=" text-primary"></label>
          <select class="form-control" id="sq_number_1" name="sq_number" required>
            <option value="">Select Invoice</option>
          </select>
        </div>
        <div class="form-group col-sm-3">
          <label for="grandtotal_1" class=" text-primary">Invoice Amount</label>
          <input class="form-control" type="text" id="grandtotal_1" name="grandtotal" readonly />
        </div>
      </div>
      <div class="form-inline">
        <div class="form-group col-sm-3">
          <label for="sr_head" class="bmd-label-floating text-primary">Head</label>
          <input class="form-control autocomplete_txt" type='sr_head' data-type="sr_head" id='sr_head_1' name='sr_head' required />
        </div>
        <div class="form-group col-sm-3">
          <label for="amount" class="text-primary"></label>
          <input class="form-control" type="number" id="amount" name="amount" title="Enter amount paid against this invoice" placeholder="Enter Amount" required />
        </div>
      </div>
      <div class="form-group col-sm-12">
        <label for="sr_description"></label>
        <textarea name="sr_description" id="sr_description" class="form-control" rows="4" placeholder="Enter description">{{ old('sr_description') }}</textarea>
      </div>

      <br>
      <div align="center">
        <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Submit</button>
      </div>
    </div>
  </form>
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
    $(document).ready(function() {

      function fetch_reciept_number(query = '') {
        $.ajax({
          url: "{{ route('searchreciept') }}",
          method: 'GET',
          data: {
            query: query
          },
          dataType: 'json',
          success: function(data) {
            $('#receipt_1').val(data.table_data);
          }
        })
      }
      setInterval(function() {
        var query = "1";
        fetch_reciept_number(query);
      }, 1200);
    });


    //autocomplete script
    $(document).on('focus', '.autocomplete_txt', function() {
      let type = $(this).data('type'); // Get the type from data attribute

      // Handle customer_name autocomplete
      if (type === 'customer_name') {
        $(this).autocomplete({
          minLength: 1,
          source: function(request, response) {
            $.ajax({
              url: "{{ route('searchCustomer') }}",
              dataType: "json",
              data: {
                term: request.term,
                type: type
              },
              success: function(data) {
                let array = $.map(data, function(item) {
                  return {
                    label: item.customer_name,
                    value: item.customer_name,
                    data: item
                  };
                });
                response(array);
              }
            });
          },
          select: function(event, ui) {
            let data = ui.item.data;
            let id_arr = $(this).attr('id').split("_");
            let elementId = id_arr[id_arr.length - 1];

            $('#customer_name_' + elementId).val(data.customer_name);
            $('#balances_' + elementId).val(data.balances);

            fetchInvoices(data.fr_ID, elementId);
          }
        });
      }


      // Handle sr_head autocomplete
      if (type === 'sr_head') {
        $(this).autocomplete({
          minLength: 1, // Start filtering after at least 1 character is typed
          source: function(request, response) {
            $.ajax({
              url: "{{ route('searchHead') }}",
              dataType: "json",
              data: {
                term: request.term, // The term typed by the user
                type: type // 'sr_head'
              },
              success: function(data) {
                let array = $.map(data, function(item) {
                  return {
                    label: item.h_name, // Show the head name in the dropdown
                    value: item.h_name, // Set the input field value to the selected head name
                    data: item // Store full head data for further usage
                  };
                });
                response(array);
              }
            });
          },
          select: function(event, ui) {
            let data = ui.item.data;
            let id_arr = $(this).attr('id').split("_");
            let elementId = id_arr[id_arr.length - 1];

            // Set the selected head's name in the respective input field
            $('#sr_head_' + elementId).val(data.h_name);
          }
        });
      }
    });



    // Function to fetch invoices for the selected customer
    function fetchInvoices(fr_ID, elementId) {
      $.ajax({
        url: "{{ route('getInvoicesByCustomer') }}",
        dataType: "json",
        data: {
          fr_ID: fr_ID
        },
        success: function(data) {
          let invoiceDropdown = $('#sq_number_' + elementId);
          invoiceDropdown.empty(); // Clear previous options
          invoiceDropdown.append($('<option>', {
            value: '',
            text: 'Select Invoice'
          })); // Default option

          // Populate the dropdown with the invoices
          $.each(data, function(index, invoice) {
            invoiceDropdown.append($('<option>', {
              value: invoice.sq_number,
              text: invoice.sq_number + ' : ' + invoice.sq_grandtotal,
              'data-grandtotal': invoice.sq_grandtotal // Store grand total as data attribute
            }));
          });
        }
      });
    }

    $(document).on('change', 'select[id^="sq_number_"]', function() {
      let id_arr = $(this).attr('id');
      let id = id_arr.split("_");
      let elementId = id[id.length - 1];
      let selectedOption = $(this).find('option:selected');

      // Get the grand total from the selected option's data attribute
      if (selectedOption.length) {
        let grandTotal = selectedOption.data('grandtotal'); // Get grand total from data attribute
        $('#grandtotal_' + elementId).val(grandTotal); // Set the grand total field
      } else {
        $('#grandtotal_' + elementId).val(''); // Clear if no option is selected
      }
    });

    //-----------------------------------------fetch heads
  </script>

  <!-- <script type="text/javascript">
    $(".delete").on('click', function() {
      $('.chkbox:checkbox:checked').parents("tr").remove();
      $('.check_all').prop("checked", false);
      updateSerialNo();
    });
    var i = $('table tr').length;
    $(".addbtn").on('click', function() {
      count = $('table tr').length;

      var data = "<tr><td><input type='checkbox' class='chkbox'/></td>";
      data += "<td><input type='number' id='sn" + i + "' value='" + count + "' readonly name='ct_sno[]'></td>";
      data += "<td><input class='form-control expense_txt' type='text' data-type='name' id='name_" + i + "' name='name[]' required/></td>";
      data += "<td><input class='form-control expense_txt' type='text' data-type='head' id='head_" + i + "' name='head[]' required/></td>";
      data += "<td hidden><input class='form-control expense_txt' type='text' data-type='type' id='type_" + i + "' name='type[]' required/></td>";
      data += "<td><input class='form-control' type='text' id='desc_" + i + "' name='desc[]' required/></td>";
      data += "<td><input class='form-control' type='text' id='amnt_" + i + "' name='amnt[]' required/></td>";
      data += "<td><input class='form-control' type='text' id='balance_" + i + "' name='balance[]' required readonly/></td></tr>";
      $('table').append(data);
      document.getElementById("name_" + i + "").select();
      i++;
    });

    $(".addfr").on('click', function() {
      count = $('table tr').length;

      var data = "<tr><td class='text-success'><input type='checkbox' class='chkbox' name='chkbox[]'/> Customer </td>";
      data += "<td><input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_" + i + "' name='farmername[]' placeholder='Name' required /></td>";
      data += "<td hidden><input class='form-control farmer_txt' type='text' data-type='farmercnic' id='farmercnic_" + i + "' name='farmercnic[]' readonly required /></td>";
      data += "<td hidden><input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_" + i + "' name='farmerid[]' readonly placeholder='ID' required /></td>";
      data += "<td><input class='form-control' type='text' id='frdesc_" + i + "' name='frdesc[]' placeholder='Description' required /></td>";
      data += "<td><input class='form-control' type='text' id='amnt_" + i + "' name='amnt[]' placeholder='Amount' required /></td>"
      data += "<td><input class='form-control farmer_txt' type='text'  data-type='frbalance' id='frbalance_" + i + "' name='frbalance[]' required placeholder='Customer Balance'/></td>";
      data += "<td><input class='form-control' type='text' id='balance_" + i + "' name='balance[]' required /></td></tr>";
      $('table').append(data);
      document.getElementById("farmername_" + i + "").select();
      i++;
    });

    function select_all() {
      $('input[class=chkbox]:checkbox').each(function() {
        if ($('input[class=check_all]:checkbox:checked').length == 0) {
          $(this).prop("checked", false);
        } else {
          $(this).prop("checked", true);
        }
      });
    }

    function updateSerialNo() {
      obj = $('table tr').find('span');
      $.each(obj, function(key, value) {
        id = value.id;
        $('#' + id).html(key + 1);
      });
    }
    //autocomplete script
    $(document).on('focus', '.expense_txt', function() {
      type = $(this).data('type');

      if (type == 'name') autoType = 'h_name';
      if (type == 'head') autoType = 'h_ID';
      if (type == 'type') autoType = 'h_type';

      $(this).autocomplete({
        minLength: 0,
        source: function(request, response) {
          $.ajax({
            url: "{{ route('searchexpensehead') }}",
            dataType: "json",
            data: {
              term: request.term,
              type: type,
            },
            success: function(data) {
              var array = $.map(data, function(item) {
                return {
                  label: item[autoType],
                  value: item[autoType],
                  data: item
                }
              });
              response(array)
            }
          });
        },
        select: function(event, ui) {
          var data = ui.item.data;
          id_arr = $(this).attr('id');
          id = id_arr.split("_");
          elementId = id[id.length - 1];
          $('#name_' + elementId).val(data.h_name);
          $('#head_' + elementId).val(data.h_ID);
          $('#type_' + elementId).val(data.h_type);
        }
      });
    });


   
  </script> -->


  <!-- For Auto Calculation of Values -->

  <script>
    // Get today's date
    const today = new Date().toISOString().split('T')[0];
    // Set the value of the input field to today's date
    document.getElementById('date').value = today;
  </script>


  @endsection
  <link href="{{asset('assets/material.css')}}" rel="stylesheet" />
<?php  } else {
  redirect()->to('home')->send();
} ?>