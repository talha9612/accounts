@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->incomeledgersview) && Auth::user()->incomeledgersview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Income Ledger)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Income Ledger</h4>
          <!-- <div align="right"><a href="{{action('CashledgerController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
          </div> -->
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-label="Position: activate to sort column ascending">Account Number</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Account Title</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Opening Balance</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Office: activate to sort column ascending">Remaining Balance</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Created At</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Updated At</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Account Number</th>
                  <th rowspan="1" colspan="1">Account Title</th>
                  <th rowspan="1" colspan="1">Opening Balance</th>
                  <th rowspan="1" colspan="1">Remaining Balance</th>
                  <th rowspan="1" colspan="1">Created At</th>
                  <th rowspan="1" colspan="1">updated At</th>
                  <th rowspan="1" colspan="1" style="">Actions</th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($income as $incomes):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $incomes->h_ID; ?></td>
                  <td><?php echo $incomes->h_name; ?></td>
                  <td><?php $subtotal =  number_format($incomes->h_opbalance, 2, '.', ','); echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($incomes->h_balance, 2, '.', ','); echo $subtotal; ?></td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($incomes->created_at)); echo $newDate; ?> </td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($incomes->updated_at)); echo $newDate; ?> </td>
                  <td class="text-right" style="">
                    <a href="{{action('IncomeledgerController@show', $incomes->h_name)}}" class="btn btn-link btn-info btn-just-icon like" title="view"><i class="material-icons">visibility</i></a>
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