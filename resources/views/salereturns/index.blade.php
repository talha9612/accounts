@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     All <small class="text-muted">(Sale Returns)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Sale Returns</h4>
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Age: activate to sort column ascending">Date</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Position: activate to sort column ascending">Number</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Office: activate to sort column ascending">Title</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Office: activate to sort column ascending">item</th>
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Office: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Office: activate to sort column ascending">Customer</th>
                 
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Date</th>
                  <th rowspan="1" colspan="1">Number</th>
                  <th rowspan="1" colspan="1">Title</th>
                  <th rowspan="1" colspan="1">Item</th>
                  <th rowspan="1" colspan="1">Quantity</th>
                  <th rowspan="1" colspan="1">Customer</th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($orders as $orders):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php  $newDate = date("d-M-Y", strtotime($orders->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $orders->slr_number; ?></td>
                  <td><?php echo $orders->slr_title; ?></td>
                  <td><?php echo $orders->slr_item; ?></td>
                  <td><?php echo $orders->slr_quantity; ?></td>
                  <td><?php echo $orders->fr_name; ?></td>
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
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>