@extends('master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<?php
if (isset(Auth::user()->salesledgersview) && Auth::user()->salesledgersview == '1') { ?>
    <!-- WORK AREA START -->
    <h3 align="center" class="text-primary">
        Sales <small class="text-muted">(Customer Ageing)</small>
    </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
            <div class="card-icon">
                <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title text-white">Customer Ageing</h4>
        </div>
        <div class="card-body">
            <div class="toolbar">
                <!--   Here you can write extra buttons/actions for the toolbar  -->
            </div>
            <div class="material-datatables">
                <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-inline">
                                <div style="width: 90%" align="rigt">
                                    <input id="myInput" type="text" placeholder="Search.." class="form-control" onfocusout="calcFunction()" style="width: 95%">
                                </div>
                            </div>
                            <div id="div1">
                                <table id="myTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Farmer Name</th>
                                            <th>Invoice #</th>
                                            <th>Issue Date</th>
                                            <th>Debit Amount</th>
                                            <th>Days Ago</th> <!-- New column for Days Ago -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($saleInvoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->fr_name }}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->issue_date }}</td>
                                            <td>{{ number_format($invoice->debit_amount, 2, '.', ',') }}</td>
                                            <td>{{ $invoice->days_ago }} days ago</td> <!-- Display Days Ago -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $saleInvoices->links() }} <!-- Pagination links -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end content-->

    <!-- WORK AREA END -->

    <script src="{{asset('assets/sorting.js')}}"></script>
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none"; // Hide all rows initially

                // Loop through all td elements in each row
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = ""; // Show row if match is found
                            break; // Break to show row and move to the next row
                        }
                    }
                }
            }
        }
    </script>
    @endsection
    <link href="{{asset('assets/material.css')}}" rel="stylesheet" />
<?php  } else {
    redirect()->to('home')->send();
} ?>