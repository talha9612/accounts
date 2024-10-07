@extends('master')
 <?php 
  if(isset(Auth::user()->companyview) && Auth::user()->companyview == '1')
      { ?>
<?php foreach ($records as $record):?>
                <!--Teacher View Modal -->
                <div class="modal fade" id="<?php echo $record->c_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $record->c_name; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active"><?php echo $record->c_name; ?> &nbsp &nbsp &nbsp <small><?php echo $record->c_type; ?></small> </li>
                        <li class="list-group-item"><b>Adress:</b> <?php echo $record->c_adress; ?> </li>
                        <li class="list-group-item"><b>Area:</b> <?php echo $record->c_area; ?> </li>
                        <li class="list-group-item"><b>City:</b><?php echo $record->c_city; ?></li>
                      </ul>
                      <hr>    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>      

                 <div class="modal fade" id="<?php echo $record->c_name; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        Are You Sure to want to Delete <b class="text-warning"> <?php echo $record->c_name; ?> </b> from Record?
                       </span>
                       <br>
                       <span> <b class="text-warning"> Warning: </b> All Contact Persons related to this company would be deleted!</span>
                      </div>
                      <div class="modal-footer">
                         <form action="{{action('CompanyController@destroy', $record->c_ID)}}" method="post" style="display: inline">
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
     Companies
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Companies</h4>
           <?php 
              if(isset(Auth::user()->companyadd) && Auth::user()->companyadd == '1')
                          { ?>
          <div align="right"><a href="{{action('CompanyController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>          
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 30px;" aria-label="Position: activate to sort column ascending">Name</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 40px;" aria-label="Office: activate to sort column ascending">Adress</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Age: activate to sort column ascending">Area</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Date: activate to sort column ascending">City</th>
                    <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Date: activate to sort column ascending">Type</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Name</th>
                  <th rowspan="1" colspan="1">Adress</th>
                  <th rowspan="1" colspan="1">Area</th>
                  <th rowspan="1" colspan="1">City</th>
                  <th rowspan="1" colspan="1">Type</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($records as $record):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $record->c_ID; ?></td>
                  <td><?php echo $record->c_name; ?></td>
                  <td><?php echo $record->c_adress; ?></td>
                  <td><?php echo $record->c_area; ?></td>
                  <td><?php echo $record->c_city; ?></td>
                  <td><?php echo $record->c_type; ?></td>
                 
                 <?php 
                      if(isset(Auth::user()->companyview) && Auth::user()->companyview == '1')
                          { ?>
                  <td class="text-right" style="">
                     <a href="{{action('CompanyController@show', $record->c_ID)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
                          <i class="material-icons">visibility</i>
                        </a>
                   <?php } else {} ?> 

                    <?php 
                      if(isset(Auth::user()->companyedit) && Auth::user()->companyedit == '1')
                          { ?>
                    <a href="{{action('CompanyController@edit', $record->c_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>
                    <?php } else {} ?>

                     <?php 
                      if(isset(Auth::user()->companydelete) && Auth::user()->companydelete == '1')
                          { ?>
                     <a  class="btn btn-link btn-danger btn-just-icon like" data-toggle="modal" data-target="#<?php echo $record->c_name; ?>" title="view"><i class="material-icons">close</i></a>
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