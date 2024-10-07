@extends('master')
@section('content')
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Receivables Ageing)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Receivables Ageing</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
          
          </div>
          <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting_asc text-white" style="width: 10px;">Invoice #</th>
                  <th class="sorting text-white" style="width: 20px;">Date</th>
                  <th class="sorting text-white" style="width: 20px;">Customer</th>
                  <th class="sorting text-white" style="width: 10px;">W-I 30 Days</th>
                  <th class="sorting text-white" style="width: 10px;">W-I 60 Days</th>
                  <th class="sorting text-white" style="width: 10px;">W-I 90 Days</th>
                  <th class="sorting text-white" style="width: 10px;">M-T 90 Days</th>
                  <th class="disabled-sorting sorting text-white"  style="width: 10px;">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th>Invoice #</th>
                  <th>Date</th>
                  <th>Customer</th>
                  <th>W-I 30 Days</th>
                  <th>W-I 60 Days</th>
                  <th>W-I 90 Days</th>
                  <th>M-T 90 Days</th>
                  <th>Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($sales as $sale):?>
                <tr role="row" class="odd table-dark text-dark">
                  <td tabindex="0" class="sorting_1"><?php echo $sale->sl_number; ?></td>
                  <td><?php echo date('d-M-Y', strtotime($sale->created_at)); ?></td>
                  <td><?php echo $sale->fr_name; ?></td>
                  <td><?php 
                  $thirtydays = date('Y-m-d', strtotime($sale->created_at . ' +30 days'));
                  $sixtydays = date('Y-m-d', strtotime($sale->created_at . ' +60 days'));
                  $ninetydays = date('Y-m-d', strtotime($sale->created_at . ' +90 days'));
                  $now = date("Y-m-d");
                  // $date = date('d-M-Y', strtotime($sale->created_at . ' +30 days'));
                  if($thirtydays > $now && $thirtydays < $sixtydays)
                    {
                      $subtotal = number_format($sale->sl_totalprice, 2, '.', ',');
                      echo $subtotal;
                    }
                    else
                    {
                      echo '-'; 
                    }
                   ?>
                   </td>
                  <td>
                    <?php 
                      if($sixtydays > $now && $now > $thirtydays)
                        {
                          $subtotal = number_format($sale->sl_totalprice, 2, '.', ',');
                          echo $subtotal;
                        }
                        else
                        {
                          echo '-';
                        }
                       ?>
                  </td>
                   <td>
                    <?php 
                      if($ninetydays > $now && $now > $sixtydays)
                        {
                          $subtotal = number_format($sale->sl_totalprice, 2, '.', ',');
                          echo $subtotal;
                        }
                        else
                        {
                          echo '-';
                        }
                       ?>
                  </td>
                  <td>
                     <?php 
                      if($now > $ninetydays)
                        {
                          $subtotal = number_format($sale->sl_totalprice, 2, '.', ',');
                          echo $subtotal;
                        }
                        else
                        {
                          echo '-';
                        }
                       ?>
                  </td>
                  <td class="text-right" style="">
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#<?php echo $sale->sl_ID; ?>" title="view"><i class="material-icons">visibility</i></a>
                  </td>
                </tr>
                @endforeach

                 <?php foreach ($fpayments as $fpayment):?>
                <tr role="row" class="odd ">
                  <td tabindex="0" class="sorting_1"><?php echo $fpayment->vr_number; ?></td>
                   <td><?php echo date('d-M-Y', strtotime($fpayment->created_at)); ?></td>
                  <td><?php echo $fpayment->fr_name; ?></td>
                  <td>
                  <?php 
                    $thirtydays = date('Y-m-d', strtotime($fpayment->created_at . ' +30 days'));
                    $sixtydays = date('Y-m-d', strtotime($fpayment->created_at . ' +60 days'));
                    $ninetydays = date('Y-m-d', strtotime($fpayment->created_at . ' +90 days'));
                    $now = date("Y-m-d");
                  // $date = date('d-M-Y', strtotime($sale->created_at . ' +30 days'));
                  if($thirtydays > $now && $thirtydays < $sixtydays)
                    {
                      $subtotal = number_format($fpayment->fp_amount, 2, '.', ',');
                      echo $subtotal;
                    }
                    else
                    {
                      echo '-';
                    }
                   ?>
                   </td>
                  <td>
                    <?php 
                      if($sixtydays > $now && $now > $thirtydays)
                        {
                          $subtotal = number_format($fpayment->fp_amount, 2, '.', ',');
                          echo $subtotal;
                        }
                        else
                        {
                          echo '-';
                        }
                       ?>
                  </td>
                   <td>
                    <?php 
                      if($ninetydays > $now && $now > $sixtydays)
                        {
                          $subtotal = number_format($fpayment->fp_amount, 2, '.', ',');
                          echo $subtotal;
                        }
                        else
                        {
                          echo '-';
                        }
                       ?>
                  </td>
                  <td>
                     <?php 
                      if($now > $ninetydays)
                        {
                          $subtotal = number_format($fpayment->fp_amount, 2, '.', ',');
                          echo $subtotal;
                        }
                        else
                        {
                          echo '-';
                        }

                       ?>
                  </td>
                  <td class="text-right" style="">
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#<?php echo $fpayment->fp_ID; ?>" title="view"><i class="material-icons">visibility</i></a>
                  </td>
                </tr>
                @endforeach
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