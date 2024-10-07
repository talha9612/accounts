@extends('master')
@section('content')
<?php 
  if(isset(Auth::user()->assetledgersview) && Auth::user()->assetledgersview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Assets Ledger)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Assets Ledger</h4>
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
                  <th>Account Number</th>
                  <th>Account Title</th>
                  <th>Opening Balance</th>
                  <th>Remaining Balance</th>
                  <th>Created At</th>
                  <th>updated At</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($cashaccount as $cashaccounts):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $cashaccounts->cih_ID; ?></td>
                  <td><?php echo $cashaccounts->cih_title; ?></td>
                  <td><?php $subtotal =  number_format($cashaccounts->cih_obalance, 2, '.', ','); echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($cashaccounts->cih_balance, 2, '.', ','); echo $subtotal; ?></td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($cashaccounts->created_at)); echo $newDate; ?> </td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($cashaccounts->updated_at)); echo $newDate; ?> </td>
                  <td class="text-right" style="">
                    <a href="{{action('CashledgerController@show', $cashaccounts->cih_title)}}" class="btn btn-link btn-info btn-just-icon like" title="view"><i class="material-icons">visibility</i></a>
                  </td>
                </tr>
                 <?php endforeach; ?>

                <?php foreach ($bankaccount as $bankaccounts):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $bankaccounts->acc_number; ?></td>
                  <td><?php echo $bankaccounts->acc_title; ?></td>
                  <td><?php $subtotal =  number_format($bankaccounts->acc_opbalance, 2, '.', ','); echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($bankaccounts->acc_balance, 2, '.', ','); echo $subtotal; ?></td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($bankaccounts->created_at)); echo $newDate; ?> </td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($bankaccounts->updated_at)); echo $newDate; ?> </td>
                  <td class="text-right" style="">
                  <a href="{{action('BankledgerController@show', $bankaccounts->acc_number)}}" class="btn btn-link btn-info btn-just-icon like" title="view"><i class="material-icons">visibility</i></a>
                  </td>
                </tr>
                 <?php endforeach; ?>

                  <?php foreach ($assets as $assets):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $assets->h_ID; ?></td>
                  <td><?php echo $assets->h_name; ?></td>
                  <td><?php $subtotal =  number_format($assets->h_opbalance, 2, '.', ','); echo $subtotal; ?></td>
                   <td><?php $subtotal =  number_format($assets->h_balance, 2, '.', ','); echo $subtotal; ?></td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($assets->created_at)); echo $newDate; ?> </td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($assets->updated_at)); echo $newDate; ?> </td>
                  <td class="text-right" style="">
                  <a href="{{action('AssetledgerController@show', $assets->h_name)}}" class="btn btn-link btn-info btn-just-icon like" title="view"><i class="material-icons">visibility</i></a>
                  </td>
                </tr>
                 <?php endforeach; ?>

                <?php foreach ($farmers as $farmers):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $farmers->fr_ID; ?></td>
                  <td><?php echo $farmers->fr_name; ?></td>
                  <td><?php $subtotal =  number_format($farmers->fr_opbalance, 2, '.', ','); echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($farmers->fr_balance, 2, '.', ','); echo $subtotal; ?></td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($farmers->created_at)); echo $newDate; ?> </td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($farmers->updated_at)); echo $newDate; ?> </td>
                  <td class="text-right" style="">
                  <a href="{{action('FarmerledgerController@show', $farmers->fr_name)}}" class="btn btn-link btn-info btn-just-icon like" title="view"><i class="material-icons">visibility</i>
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