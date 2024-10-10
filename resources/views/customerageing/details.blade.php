@extends('master')
@section('content')
<?php
if (isset(Auth::user()->salesview) && Auth::user()->salesview == '1') { ?>
    <h3 align="center" class="text-primary">
        <small class="text-muted">Sales Details for {{ $details->first()->fr_name }}</small>
    </h3>
    <div class="material-datatables">
        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                        <thead>
                            <tr>
                                <th>Sale Number</th>
                                <th>Grand Total</th>
                                <th>Year</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($details as $detail)
                            <tr>
                                <td>{{ $detail->sl_number }}</td>
                                <td>{{ $detail->sl_grandtotal }}</td>
                                <td>{{ $detail->fyear }}</td>
                                <td>{{ $detail->created_at }}</td>                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-left">
    <a href="javascript:history.back()" class="btn btn-secondary mb-3"style="background-color: black; color: white;">Go Back</a>
</div>

    </div>
    @endsection
    
    <link href="{{asset('assets/material.css')}}" rel="stylesheet" />
<?php  } else {
    redirect()->to('home')->send();
} ?>