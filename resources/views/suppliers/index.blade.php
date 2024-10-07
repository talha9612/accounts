@extends('master')
<?php
  if(isset(Auth::user()->suppliersview) && Auth::user()->suppliersview == '1')
      { ?>
<?php foreach ($suppliers as $supplier):?>
                <!--Customer View Modal -->
                <div class="modal fade" id="<?php echo $supplier->s_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $supplier->s_company; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active"><?php echo $supplier->s_company; ?> </li>
                        <li class="list-group-item"><b>Contact Person:</b> <?php echo $supplier->s_name; ?> </li>
                        <li class="list-group-item"><b>Phone:</b> <?php echo $supplier->s_phone; ?> </li>
                      </ul>
                      <hr>

                       <div class="container-fluid">
                        <hr>
                         <div class="row">
                          <div class="col-md-6"><b>Openign Balance</b></div>
                          <div class="col-md-6 ml-auto"><input type="text" class="form-control" name="quota" id="quota" value="<?php $subtotal =  number_format($supplier->s_obalance, 2, '.', ',');
                    echo $subtotal; ?>" readonly></div>
                        </div>
                         <div class="row">
                          <div class="col-md-6"><b>Remaining Balance</b></div>
                          <div class="col-md-6 ml-auto"><input type="text" class="form-control" name="quota" id="quota" value="<?php $subtotal =  number_format($supplier->s_balance, 2, '.', ',');
                    echo $subtotal; ?>" readonly></div>
                        </div>
                        <div class="row">
                          <div class="col-md-6"><b>Due Date</b></div>
                          <div class="col-md-6 ml-auto"><input type="text" class="form-control" name="fr_duedate" id="fr_duedate" value="<?php echo $supplier->s_duedate; ?>" readonly></div>
                        </div>
                      </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>      
<?php endforeach; ?>
@section('content')


    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Suppliers)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Suppliers</h4>
           <?php
            if(isset(Auth::user()->suppliersadd) && Auth::user()->suppliersadd == '1')
                { ?>
          <div align="right"><a href="{{action('SupplierController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
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
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Company</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">Name</th>
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">Phone</th>
                    <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">Opening Balance</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Company</th>
                  <th rowspan="1" colspan="1">Name</th>
                  <th rowspan="1" colspan="1">Phone</th>
                  <th rowspan="1" colspan="1">Opening Balance</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($suppliers as $suppliers):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $suppliers->s_ID; ?></td>
                   <td><?php echo $suppliers->s_company; ?></td>
                  <td><?php echo $suppliers->s_name; ?></td>
                  <td><?php echo $suppliers->s_phone; ?></td>
                   <td><?php echo $suppliers->s_obalance; ?></td>
                  <td class="text-right" style="">
                    <?php
                    if(isset(Auth::user()->suppliersview) && Auth::user()->suppliersview == '1')
                        { ?>
                     <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#<?php echo $suppliers->s_ID; ?>" title="view"><i class="material-icons">visibility</i></a>
                     <?php } else {} ?>

                      <?php
                    if(isset(Auth::user()->suppliersedit) && Auth::user()->suppliersedit == '1')
                        { ?>
                    <a href="{{action('SupplierController@edit', $suppliers->s_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>
                     <?php } else {} ?>

                     <?php
                    if(isset(Auth::user()->suppliersdelete) && Auth::user()->suppliersdelete == '1')
                        { ?> 
                    <form action="{{action('SupplierController@destroy', $suppliers->s_ID)}}" method="post" style="display: inline">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
                      <input name="asname" type="hidden" value="<?php echo $suppliers->s_company; ?>">
                      <button class="btn btn-link btn-danger btn-just-icon remove" title="delete" type="submit"><i class="material-icons">close</i></button>
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