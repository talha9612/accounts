@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->breceiptsview) && Auth::user()->breceiptsview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Vouchers)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Bank Receipts</h4>
          <?php
          if(isset(Auth::user()->breceiptsadd) && Auth::user()->breceiptsadd == '1')
              { ?>
          <div align="right"><a href="{{action('BankreceiptController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
          </div>
            <?php } else {} ?>
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">V.Number</th>
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Date</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Account Title</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Amount</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Number</th>
                  <th rowspan="1" colspan="1">Date</th>
                  <th rowspan="1" colspan="1">Account Title</th>
                  <th rowspan="1" colspan="1">Amount</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($voucher as $bankreceipts):?>
                <tr role="row" class="odd">
                  <td><?php echo $bankreceipts->brv_no; ?></td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($bankreceipts->created_at)); echo $newDate; ?> </td>
                  <td><?php echo $bankreceipts->acc_title; ?></td>
                  <td><?php $subtotal =  number_format($bankreceipts->brv_amount, 2, '.', ',');
                    echo $subtotal;?></td>
                  <td class="text-right" style="">
                        <a  href="{{action('BankreceiptController@show', $bankreceipts->brv_no)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
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