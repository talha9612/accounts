@extends('master')
@section('content')

    <!-- WORK AREA START -->
    <div class="card">
        <div class="card-header bg-primary">
          <h1 align="center" class="card-title text-white" <string>CLOSING FISCAL YEAR</string> </h1>
        </div>
        <div class="card-body">
            <h3 align="center" class="text-primary">
                CashInhand Ledger<small class="text-muted"></small>
                  </h3>
            <div class="material-datatables">
             <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12">
                  <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    {{--  <thead class="bg-primary">  --}}
                        {{-- <tr role="row">
                          <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="V.number: activate to sort column ascending">V.Number</th>
                          <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Date: activate to sort column ascending">Date</th>
                          <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Amount: activate to sort column ascending">Amount</th>
                          <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                        </tr> --}}
                      {{--  </thead>  --}}
                  <tr>
                    <th rowspan="1" colspan="1">Account Number</th>
                    <th rowspan="1" colspan="1">Title</th>
                    <th rowspan="1" colspan="1">Remaining Balance</th>
                    <th rowspan="1" colspan="1">Opening Balance</th>
                    </th>
                  </tr>
                <tbody>
                   @foreach($closing_record_cash as $closing_record_cashinhands)
                  <tr>
                      <td>{{ $closing_record_cashinhands->cih_ID }}</td>
                      <td>{{ $closing_record_cashinhands->cih_title }}</td>
                      <td>{{ $closing_record_cashinhands->cih_balance }}</td>
                      <td>{{ $closing_record_cashinhands->cih_obalance}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            </div>
            </div>
             </div>
              </div>

        <div class="card-body">
            <h3 align="center" class="text-primary">
                Bank Ledger<small class="text-muted"></small>
                  </h3>

          <div class="material-datatables">
           <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                <tr>
                  <th rowspan="1" colspan="1">Account Number</th>
                  <th rowspan="1" colspan="1">Title</th>
                  <th rowspan="1" colspan="1">Remaining Balance</th>
                  <th rowspan="1" colspan="1">Opening Balance</th>
                  </th>
                </tr>
              <tbody>
                 @foreach($closing_record_accounts as $closing_record_account)
                <tr>
                    <td>{{ $closing_record_account->acc_number}}</td>
                    <td>{{ $closing_record_account->acc_title }}</td>
                    <td>{{ $closing_record_account->acc_balance }}</td>
                    <td>{{ $closing_record_account->acc_opbalance}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          </div>
          </div>
           </div>
            </div>
            <div class="card-body">
                <h3 align="center" class="text-primary">
                Suppliers Ledger<small class="text-muted"></small>
                      </h3>
              <div class="material-datatables">
               <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <tr>
                      <th rowspan="1" colspan="1">Account Number</th>
                      <th rowspan="1" colspan="1">Company</th>
                      <th rowspan="1" colspan="1">Remaining Balance</th>
                      <th rowspan="1" colspan="1">Opening Balance</th>
                      </th>
                    </tr>
                  <tbody>
                     @foreach($closing_record_suppliers as $closing_record_supplier)
                    <tr>
                        <td>{{ $closing_record_supplier->s_ID  }}</td>
                        <td>{{ $closing_record_supplier->s_company }}</td>
                        <td>{{ $closing_record_supplier->s_balance }}</td>
                        <td>{{ $closing_record_supplier->s_obalance}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
              </div>
               </div>
                </div>
                <div class="card-body">
                    <h3 align="center" class="text-primary">
                    Customer Ledger<small class="text-muted"></small>
                          </h3>
                  <div class="material-datatables">
                   <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                        <tr>
                          <th rowspan="1" colspan="1">Account Number</th>
                          <th rowspan="1" colspan="1">Title</th>
                          <th rowspan="1" colspan="1">Remaining Balance</th>
                          <th rowspan="1" colspan="1">Opening Balance</th>
                          </th>
                        </tr>
                      <tbody>
                         @foreach($closing_record_farmers as $closing_record_farmers_dt)
                        <tr>
                            <td>{{ $closing_record_farmers_dt->fr_ID }}</td>
                            <td>{{ $closing_record_farmers_dt->fr_name }}</td>
                            <td>{{ $closing_record_farmers_dt->fr_balance }}</td>
                            <td>{{ $closing_record_farmers_dt->fr_opbalance}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  </div>
                  </div>
                   </div>
                    </div>
                    <div class="card-body">
                        <h3 align="center" class="text-primary"> Asset Ledger<small class="text-muted"></small> </h3>
                      <div class="material-datatables">
                       <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                          <div class="col-sm-12">
                            <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                            <tr>
                              <th rowspan="1" colspan="1">Account Number</th>
                              <th rowspan="1" colspan="1">Title</th>
                              <th rowspan="1" colspan="1">Remaining Balance</th>
                              <th rowspan="1" colspan="1">Opening Balance</th>
                              </th>
                            </tr>
                          <tbody>
                             @foreach($closing_record_asset as $closing_record_head)
                            <tr>
                                <td>{{ $closing_record_head->h_name }}</td>
                                <td>{{ $closing_record_head->h_type }}</td>
                                <td>{{ $closing_record_head->h_balance }}</td>
                                <td>{{ $closing_record_head->h_opbalance}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      </div>
                      </div>
                       </div>
                        </div>

                        <div class="card-body">
                            <h3 align="center" class="text-primary"> Liability Ledger<small class="text-muted"></small> </h3>
                          <div class="material-datatables">
                           <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                              <div class="col-sm-12">
                                <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                                <tr>
                                  <th rowspan="1" colspan="1">Account Number</th>
                                  <th rowspan="1" colspan="1">Title</th>
                                  <th rowspan="1" colspan="1">Remaining Balance</th>
                                  <th rowspan="1" colspan="1">Opening Balance</th>
                                  </th>
                                </tr>
                                <tbody>
                                    @foreach($closing_record_liability as $closing_record_head)
                                        <tr>
                                            <td>{{ $closing_record_head->h_name }}</td>
                                            <td>{{ $closing_record_head->h_type }}</td>
                                            <td>{{ $closing_record_head->h_balance }}</td>
                                            <td>{{ $closing_record_head->h_opbalance}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                          </div>
                          </div>
                           </div>
                            </div>
                        <input style="background:rgb(199, 23, 23); color:white; margin-left: 550px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="Close Fiscal Year">
                   </div>
        <!-- end content-->
 @endsection
    <link href="{{asset('assets/material.css')}}" rel="stylesheet"/>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" ><strong>Close Fiscal Year</strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('submitdata') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="password" name="password"  class="form-control" placeholder="Enter Password">
                               
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
