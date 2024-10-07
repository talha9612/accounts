@extends('master')
<?php foreach ($guaranters as $guaranter):?>
                <!--Teacher View Modal -->
                <div class="modal fade" id="<?php echo $guaranter->gr_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $guaranter->gr_name; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active"><?php echo $guaranter->gr_name; ?> &nbsp &nbsp &nbsp <small><?php echo $guaranter->gr_gender; ?></small> </li>
                        <li class="list-group-item"><b>So/Wo/Do:</b> <?php echo $guaranter->gr_fname; ?> </li>
                        <li class="list-group-item"><b>Phone:</b> <?php echo $guaranter->gr_phone; ?> </li>
                        <li class="list-group-item"><b>CNIC:</b><?php echo $guaranter->gr_cnic; ?></li>
                        <li class="list-group-item"><b>Address:</b><?php echo $guaranter->gr_address; ?></li>
                      </ul>
                      <hr>
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
     View Record <small class="text-muted">(Guaranters)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Guaranters</h4>
          <div align="right"><a href="{{action('GuaranterController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
          </div>
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Office: activate to sort column ascending">So/Wo/Do</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 40px;" aria-label="Age: activate to sort column ascending">Gender</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 74px;" aria-label="Date: activate to sort column ascending">CNIC</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Name</th>
                  <th rowspan="1" colspan="1">So/Wo/Do</th>
                  <th rowspan="1" colspan="1">Gender</th>
                  <th rowspan="1" colspan="1">CNIC</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($guaranters as $guaranter):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $guaranter->gr_ID; ?></td>
                  <td><?php echo $guaranter->gr_name; ?></td>
                  <td><?php echo $guaranter->gr_fname; ?></td>
                  <td><?php echo $guaranter->gr_gender; ?></td>
                  <td><?php echo $guaranter->gr_cnic; ?></td>
                  <td class="text-right" style="">
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#<?php echo $guaranter->gr_ID; ?>" title="view"><i class="material-icons">visibility</i></a>
                    <a href="{{action('GuaranterController@edit', $guaranter->gr_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>
                    <form action="{{action('GuaranterController@destroy', $guaranter->gr_ID)}}" method="post" style="display: inline">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-link btn-danger btn-just-icon remove" title="delete" type="submit"><i class="material-icons">close</i></button>
                    </form>
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