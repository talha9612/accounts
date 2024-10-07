@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->serviceview) && Auth::user()->serviceview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     All <small class="text-muted">(Service Invoices)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Service Invoices</h4>
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
                  <th class="sorting text-white" style="width: 29px;">Date</th>
                  <th class="sorting text-white" style="width: 164px;">Number</th>
                  <th class="sorting text-white" style="width: 83px;">Name</th>
                  <th class="sorting text-white" style="width: 83px;">Customer</th>
                  <th class="disabled-sorting sorting text-white" style="width: 0px;">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th>Date</th>
                  <th>Number</th>
                  <th>Name</th>
                  <th>Customer</th>
                  <th>Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($requisitions as $requisition):?>
                <tr>
                  <td tabindex="0" class="sorting_1"><?php  $newDate = date("d-M-Y", strtotime($requisition->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $requisition->svi_number; ?></td>
                  <td><?php echo $requisition->svi_name; ?></td>
                  <td><?php echo $requisition->svi_crname; ?></td>
                  <td class="text-right" style="">
                        <a  href="{{action('SrvinvoiceController@show', $requisition->svi_number)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
                          <i class="material-icons">visibility</i>
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

       <!-- WORK AREA END -->

    
 @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>  