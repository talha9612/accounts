@extends('master')
<?php if(isset(Auth::user()->role) && Auth::user()->role == 'Admin') {  ?>
<?php foreach ($users as $user):?>
                <!--Customer View Modal -->
                <div class="modal fade" id="<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $user->name; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active"><?php echo $user->name; ?> </li>
                        <li class="list-group-item"><b>Email:</b> <?php echo $user->email; ?> </li>
                        <li class="list-group-item"><b>Role:</b> <?php echo $user->role; ?> </li>
                        <li class="list-group-item"><b>Registered On:</b><?php echo $user->created_at; ?></li>
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
     View Record <small class="text-muted">(Users List)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Users List</h4>
          <div align="right"><a href="{{route('register')}}" class="btn btn-success btn-raised" >+ Add New</a>
          </div>
        </div>
        <div class="card-body">
          <div class="toolbar">
          </div>
          <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Position: activate to sort column ascending">Name</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 30px;" aria-label="Office: activate to sort column ascending">Email</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Age: activate to sort column ascending">Role</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 30px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($users as $users):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $users->id; ?></td>
                  <td><?php echo $users->name; ?></td>
                  <td><?php echo $users->email; ?></td>
                  <td><?php echo $users->role; ?></td>
                  <td class="text-right" style="">
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#<?php echo $users->id; ?>" title="view"><i class="material-icons">visibility</i></a>
                    <a href="{{action('UserController@edit', $users->id)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>

                       <a href="{{action('UserController@editPassword', $users->id)}}" class="btn btn-sm btn-warning" title="edit Password" style="display:inline">Edit Password</a>
                   <?php if($users->role == 'Admin') {  ?>
                   <?php echo ''; } else { ?>
                       <form action="{{action('UserController@destroy', $users->id)}}" method="post" style="display: inline">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-link btn-danger btn-just-icon remove" title="delete" type="submit"><i class="material-icons">close</i></button>
                    </form>
                    <?php  } ?>
                      
                   
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