@extends('master')
<?php 
  if(isset(Auth::user()->cpersonview) && Auth::user()->cpersonview == '1')
      { ?>
<?php foreach ($records as $record):?>
                <!--Teacher View Modal -->
                <div class="modal fade" id="<?php echo $record->cp_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $record->cp_name; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active"><?php echo $record->cp_name; ?> &nbsp &nbsp &nbsp <small><?php echo $record->cp_designation; ?></small> </li>
                        <li class="list-group-item"><b>Cell #:</b> <?php echo $record->cp_cell; ?> </li>
                        <li class="list-group-item"><b>Tel:</b> <?php echo $record->cp_tel; ?> </li>
                        <li class="list-group-item"><b>Ext:</b> <?php echo $record->cp_ext; ?> </li>
                        <li class="list-group-item"><b>Email:</b><?php echo $record->cp_email; ?></li>
                      </ul>
                      <hr>    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>      

                 <div class="modal fade" id="<?php echo $record->cp_name; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">                       
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                       <span>
                        Are You Sure you want to Delete<b class="text-warning"> <?php echo $record->cp_name; ?></b> from Record?
                       </span>
                      </div>
                      <div class="modal-footer">
                         <form action="{{action('CpersonController@destroy', $record->cp_ID)}}" method="post" style="display: inline">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" title="delete" type="submit">YES</button>             
                            <button type="button" class="btn btn-info" data-dismiss="modal">NO</button>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>      

<?php endforeach; ?>
@section('content')

    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     Contact Persons
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Contact Persons</h4>
           <?php 
              if(isset(Auth::user()->cpersonadd) && Auth::user()->cpersonadd == '1')
                          { ?>
          <div align="right"><a href="{{action('CpersonController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>      
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
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Name</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Company</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Area</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">City</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Office: activate to sort column ascending">Designation</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Age: activate to sort column ascending">Cell #</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Name</th>
                  <th rowspan="1" colspan="1">Company</th>
                  <th rowspan="1" colspan="1">Area</th>
                  <th rowspan="1" colspan="1">City</th>
                  <th rowspan="1" colspan="1">Designation</th>
                  <th rowspan="1" colspan="1">Cell #</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($records as $record):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $record->cp_ID; ?></td>
                  <td><?php echo $record->cp_name; ?></td>
                  <td><?php echo $record->c_name; ?></td>
                  <td><?php echo $record->c_area; ?></td>
                  <td><?php echo $record->c_city; ?></td>
                  <td><?php echo $record->cp_designation; ?></td>
                  <td><?php echo $record->cp_cell; ?></td>                 
                  <td class="text-right" style="">
                     <?php 
                    if(isset(Auth::user()->cpersonview) && Auth::user()->cpersonview == '1')
                                { ?>
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#<?php echo $record->cp_ID; ?>" title="view"><i class="material-icons">visibility</i></a>
                    <?php } else {} ?>    

                     <?php 
                    if(isset(Auth::user()->cpersonedit) && Auth::user()->cpersonedit == '1')
                                { ?>
                    <a href="{{action('CpersonController@edit', $record->cp_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>
                      <?php } else {} ?>  

                     <?php 
                    if(isset(Auth::user()->cpersondelete) && Auth::user()->cpersondelete == '1')
                                { ?>    
                     <a  class="btn btn-link btn-danger btn-just-icon like" data-toggle="modal" data-target="#<?php echo $record->cp_name; ?>" title="view"><i class="material-icons">close</i></a>
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