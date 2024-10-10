@extends('master')
@section('content')
<?php if (isset(Auth::user()->salesview) && Auth::user()->salesview == '1') { ?>
    <h3 align="center" class="text-primary">
        All <small class="text-muted">Quotations List</small>
    </h3>

    <div class="material-datatables">
        <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" 
                           cellspacing="0" width="100%" style="width: 100%;" role="grid" 
                           aria-describedby="datatables_info" aria-label="Quotations List">
                        <caption>List of all quotations records.</caption>
                        <thead>
                            <tr>
                                <th>Sq Number</th>
                                <th>Sale Name (fr_name)</th>
                                <th>Sale Price</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($quotations->isEmpty())
                                <tr>
                                    <td colspan="2" class="text-center">No quotations found.</td>
                                </tr>
                            @else
                                @foreach ($quotations as $quotation)
                                    <tr>
                                        <td>{{ $quotation->sq_number }}</td>
                                        <td>{{ $quotation->fr_name }}</td>
                                        <td>{{ $quotation->sq_saleprice }}</td>
                                        <td>{{ $quotation->sq_grandtotal }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div>
        {{ $quotations->links() }}
    </div>
    
@endsection

<link href="{{ asset('assets/material.css') }}" rel="stylesheet" />

<?php } else {
    redirect()->to('home')->send();
} ?>
