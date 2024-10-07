@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->cpaymentsview) && Auth::user()->cpaymentsview == '1')
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
          <h4 class="card-title text-white" >Cash Transactions</h4>
         <?php
            if(isset(Auth::user()->cpaymentsadd) && Auth::user()->cpaymentsadd == '1')
                { ?>
          <div align="right">
            <a href="{{action('CashtransactionController@create')}}" class="btn btn-raised btn-success text-white">+ Add New</a>
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="V.number: activate to sort column ascending">V.Number</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Date: activate to sort column ascending">Date</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Amount: activate to sort column ascending">Amount</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">V.Number</th>
                  <th rowspan="1" colspan="1">Date</th>
                  <th rowspan="1" colspan="1">Amount</th>
                  <th rowspan="1" colspan="1" style="">Actions</th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($vouchers as $voucher):?>
                <tr role="row" class="odd">
                  <td><?php echo $voucher->vr_no; ?></td>
                  <td tabindex="0" class="sorting_1"> <?php  $newDate = date("d-M-Y", strtotime($voucher->created_at)); echo $newDate; ?> </td>
                  <td><?php $subtotal =  number_format($voucher->vr_amount, 2, '.', ',');
                    echo $subtotal;?></td>
                  <td class="text-right" style="">
                        <a  href="{{action('CashtransactionController@show', $voucher->vr_no)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
                          <i class="material-icons">visibility</i>
                        </a>
                   <!--  <a href="{{action('CashtransactionController@edit', $voucher->vr_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit">
                      <i class="material-icons">edit</i>
                    </a>
                    <form action="{{action('CashtransactionController@destroy', $voucher->vr_ID)}}" method="post" style="display: inline">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-link btn-danger btn-just-icon remove" type="submit" title="delete"><i class="material-icons">close</i></button>
                    </form> -->
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
