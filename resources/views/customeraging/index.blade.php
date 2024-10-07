@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
    <!-- WORK AREA START -->
    <h3 align="center" class="text-primary">
        Finalized <small class="text-muted">(Sale Invoices)</small>
    </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
            <div class="card-icon">
                <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title text-white">Sale Invoices Aging</h4>
            <div align="right">
                <form id="myFormAging" class="form-inline float-right">
                    @csrf
                    <div class="col-auto my-1">
                        <select name="agingdays" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option selected value="0">Choose Aging Days</option>
                            <option value="1-30">1 to 30</option>
                            <option value="31-60">31 to 60</option>
                            <option value="61-90">61 to 90</option>
                            <option value="91-120">91 to 120</option>
                            <option value="121-150">121 to 150</option>
                        </select>
                    </div>
                    <button type="submit" id="submitButtonAging" class="btn btn-success btn-raised mb-2">Show Records</button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="toolbar">
                <!--   Here you can write extra buttons/actions for the toolbar  -->
            </div>
            <div class="material-datatables">
                <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                            <thead class="bg-primary">
                                <tr role="row">
                                <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Invoice Id</th>
                                <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Name</th>
                                <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Title</th>
                                <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Grand Total</th>
                                <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Days</th>

                                </tr>
                            </thead>
                            <tfoot class="bg-primary">
                                <tr>
                                <th rowspan="1" colspan="1">Invoice Id</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">Title</th>
                                <th rowspan="1" colspan="1">Grand Total</th>
                                <th rowspan="1" colspan="1">Days</th>

                                </tr>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- end content-->
<script>
$(document).ready(function() {
    var dataTable = null;
    $("#myFormAging").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        // Serialize form data
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
        type: "POST", // Use GET method
        url: "/aging-days", // Replace with your server endpoint URL
        data: formData, // Send serialized form data
        dataType: "json", // Expect JSON response
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log(response);
            var dataTable = $('#datatables').DataTable();
            // Clear existing table rows
            dataTable.clear().draw();
            var ResultResponse = response.ages;
            $.each(ResultResponse, function(index, record) {
                var daysSinceCreation = calculateDaysSinceCreation(record.created_at);
                dataTable.row.add([
                record.sq_number,
                record.sq_name,
                record.sq_title,
                record.sq_totalprice,
                daysSinceCreation
                ]).draw(false);
            });
          
        },
        error: function(error) {
            console.error("Error:", error);
        }
        });
    });
      function calculateDaysSinceCreation(createdAt) {
                var createdDate = new Date(createdAt);
                var currentDate = new Date();
                var timeDifference = currentDate - createdDate;
                var daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                return daysDifference;
            }
});
</script>




       <!-- WORK AREA END -->
<!-- <script type="text/javascript">
  // FOR DISPLAY OF COMMA SEPRATED VALUES
var xarr = document.getElementsByName('ctamnt[]');
    for(var j=0;j<xarr.length;j++){
      var b = xarr[j].value;
      b = b.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementsByName('ctamnt[]')[j].value = b;
    }
</script> -->
 @endsection
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
  <?php  } else {  redirect()->to('home')->send(); } ?>
