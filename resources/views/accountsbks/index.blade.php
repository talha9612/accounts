@extends('master')

<?php
  if(isset(Auth::user()->bankaccountsview) && Auth::user()->bankaccountsview == '1')
      { ?>

 <?php foreach ($account as $accounts):?>
                <!--Teacher View Modal -->
                <div class="modal fade" id="<?php echo $accounts->acc_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $accounts->acc_title; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active"><?php echo $accounts->acc_title; ?> &nbsp &nbsp &nbsp <small>Account Number: <?php echo $accounts->acc_number; ?></small> </li>
                        <li class="list-group-item active">Opening Balance: <?php echo $accounts->acc_opbalance; ?> &nbsp &nbsp &nbsp </li>
                        <li class="list-group-item active">Remaining Balance: <?php echo $accounts->acc_balance; ?> &nbsp &nbsp &nbsp </li>
                         <li class="list-group-item active">Branch Code:<?php echo $accounts->bk_branch_code; ?> &nbsp &nbsp &nbsp </li>
                         <li class="list-group-item active">Bank: <?php echo $accounts->bk_name; ?> &nbsp &nbsp &nbsp </li>
                      </ul>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
@endforeach
@section('content')

    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Bank Accounts)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Bank Accounts</h4>

          <?php
          if(isset(Auth::user()->bankaccountsadd) && Auth::user()->bankaccountsadd == '1')
              { ?>
          <div align="right">
            <a href="{{action('AccountsbksController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
          </div>
         <?php  } else { } ?>
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
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Acc_title</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Account Number</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Account Type</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Branch Code</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Bank Name</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Created At</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Account Title</th>
                  <th rowspan="1" colspan="1">Account Number</th>
                  <th rowspan="1" colspan="1">Account Type</th>
                  <th rowspan="1" colspan="1">Branch Code</th>
                  <th rowspan="1" colspan="1">Bank Name</th>
                  <th rowspan="1" colspan="1">Created At</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
               <?php foreach ($account as $accounts):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $accounts->acc_ID; ?></td>
                  <td><?php echo $accounts->acc_title; ?></td>
                  <td><?php echo $accounts->acc_number; ?></td>
                  <td><?php echo $accounts->acc_type; ?></td>
                  <td><?php echo $accounts->bk_branch_code; ?></td>
                  <td><?php echo $accounts->bk_name; ?></td>
                  <td> <?php  $newDate = date("d-M-Y", strtotime($accounts->created_at)); echo $newDate; ?> </td>
                   <td class="text-right" style="">


                   <?php
                    if(isset(Auth::user()->bankaccountsview) && Auth::user()->bankaccountsview == '1')
                      { ?>
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#<?php echo $accounts->acc_ID; ?>" title="view"><i class="material-icons">visibility</i></a>
                    <?php  } else { } ?>

                     <?php
                    if(isset(Auth::user()->bankaccountsedit) && Auth::user()->bankaccountsedit == '1')
                      { ?>
                    <a href="{{action('AccountsbksController@edit', $accounts->acc_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>
                    <?php  } else { } ?>

                    <?php
                    if(isset(Auth::user()->bankaccountsdelete) && Auth::user()->bankaccountsdelete == '1')
                      { ?>
                    <form action="{{action('AccountsbksController@destroy', $accounts->acc_ID)}}" method="post" style="display: inline">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
                        <input name="asname" type="hidden" value="<?php echo $accounts->acc_title; ?>">
                          <input name="asnumber" type="hidden" value="<?php echo $accounts->acc_number; ?>">
                      <button class="btn btn-link btn-danger btn-just-icon remove" type="submit" title="delete"><i class="material-icons">close</i></button>
                    </form>
                     <?php } else {} ?>
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
<?php  } else {  redirect()->to('home')->send(); } ?>
