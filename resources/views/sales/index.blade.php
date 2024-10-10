@extends('master')
@section('content')

<?php
if (isset(Auth::user()->salesview) && Auth::user()->salesview == '1') { ?>
  <!-- WORK AREA START -->
  <h3 align="center" class="text-primary">
    All <small class="text-muted">(Sales)</small>
  </h3>
  <div class="card">
    <div class="card-header card-header-rose card-header-icon bg-primary">
      <div class="card-icon">
        <i class="material-icons">assignment</i>
      </div>
      <h4 class="card-title text-white">Sales</h4>
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
                    <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Position: activate to sort column ascending">Number</th>
                    <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Age: activate to sort column ascending">Date</th>
                    <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Office: activate to sort column ascending">Title</th>
                    <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Office: activate to sort column ascending">Name</th>
                    <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Office: activate to sort column ascending">Customer</th>
                    <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                  </tr>
                </thead>
                <tfoot class="bg-primary">
                  <tr>
                    <th rowspan="1" colspan="1">Number</th>
                    <th rowspan="1" colspan="1">Date</th>
                    <th rowspan="1" colspan="1">Title</th>
                    <th rowspan="1" colspan="1">Name</th>
                    <th rowspan="1" colspan="1">Customer</th>
                    <th rowspan="1" colspan="1" style="">Actions
                    </th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($orders as $orders): ?>
                    <tr role="row" class="odd">
                      <td><?php echo $orders->sl_number; ?></td>
                      <td tabindex="0" class="sorting_1"><?php $newDate = date("d-M-Y", strtotime($orders->updated_at));
                                                          echo $newDate; ?></td>
                      <td><?php echo $orders->sl_title; ?></td>
                      <td><?php echo $orders->sl_name; ?></td>
                      <td><?php echo $orders->fr_name; ?></td>
                      <td class="text-right" style="">
                        <a href="{{action('SaleController@show', $orders->sl_number)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
                          <i class="material-icons">visibility</i>
                        </a>
                        <a href="{{action('SalereturnController@show', $orders->sl_number)}}" class="btn btn-link btn-warning btn-just-icon like" title="return">
                          <i class="material-icons">reply</i>
                        </a>
                      </td>

                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end content-->
  @endsection
  <link href="{{asset('assets/material.css')}}" rel="stylesheet" />
<?php  } else {
  redirect()->to('home')->send();
} ?>