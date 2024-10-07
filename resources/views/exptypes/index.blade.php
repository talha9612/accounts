@extends('master')
<?php
  if(isset(Auth::user()->subtypesview) && Auth::user()->subtypesview == '1')
      { ?>
 <?php foreach ($types as $type):?>
                <!--Teacher View Modal -->
                <div class="modal fade" id="<?php echo $type->tp_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $type->tp_name; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active"><?php echo $type->tp_name; ?> &nbsp &nbsp &nbsp <small><?php echo $type->tp_type; ?></small> </li>
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
     View Record <small class="text-muted">(Sub Types)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Sub Types</h4>
         <?php
            if(isset(Auth::user()->subtypesadd) && Auth::user()->subtypesadd == '1')
                { ?>
          <div align="right"><a href="{{action('ExptypeController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Name</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Type</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Name</th>
                  <th rowspan="1" colspan="1">Type</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($types as $type):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $type->tp_ID; ?></td>
                  <td><?php echo $type->tp_name; ?></td>
                  <td><?php echo $type->tp_type; ?></td>
                   <td class="text-right" style="">
                  <?php
                  if(isset(Auth::user()->subtypesview) && Auth::user()->subtypesview == '1')
                      { ?>
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#<?php echo $type->tp_ID; ?>" title="view"><i class="material-icons">visibility</i></a>
                    <?php } else {} ?>

                    <?php
                      if(isset(Auth::user()->subtypesedit) && Auth::user()->subtypesedit == '1')
                          { ?>
                    <a href="{{action('ExptypeController@edit', $type->tp_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>
                    <?php } else {} ?>

                    <?php
                      if(isset(Auth::user()->subtypesdelete) && Auth::user()->subtypesdelete == '1')
                          { ?>
                    <form action="{{action('ExptypeController@destroy', $type->tp_ID)}}" method="post" style="display: inline">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
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