@extends('master')

<?php 
  if(isset(Auth::user()->bankslistview) && Auth::user()->bankslistview == '1')
      { ?>
@foreach($banks as $bank)


                <!--Teacher View Modal -->
                <div class="modal fade" id="{{$bank['bk_ID']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{$bank['bk_name']}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active">{{$bank['bk_name']}} &nbsp &nbsp &nbsp <small>{{$bank['bk_branch_code']}}</small> </li>
                        <li class="list-group-item">{{$bank['bk_address']}} </li>
                        <li class="list-group-item">{{$bank['bk_phone']}} </li>
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
     View Record <small class="text-muted">(Bank)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Banks</h4>
           <?php 
            if(isset(Auth::user()->bankslistview) && Auth::user()->bankslistview == '1')
                { ?>
          <div align="right"><a href="{{action('BankController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
             <?php } else {} ?>
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Branch Code</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Address</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 74px;" aria-label="Date: activate to sort column ascending">Phone</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Name</th>
                  <th rowspan="1" colspan="1">Branch Code</th>
                  <th rowspan="1" colspan="1">Address</th>
                  <th rowspan="1" colspan="1">Phone</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 @foreach($banks as $bank)
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1">{{$bank['bk_ID']}}</td>
                  <td>{{$bank['bk_name']}}</td>
                  <td>{{$bank['bk_branch_code']}}</td>
                  <td>{{$bank['bk_address']}}</td>
                  <td>{{$bank['bk_phone']}}</td>
                  <td class="text-right" style="">

                   <?php 
                    if(isset(Auth::user()->bankslistview) && Auth::user()->bankslistview == '1')
                        { ?>
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#{{$bank['bk_ID']}}" title="view"><i class="material-icons">visibility</i></a>
                    <?php } else {} ?>

                     <?php 
                    if(isset(Auth::user()->bankslistedit) && Auth::user()->bankslistedit == '1')
                        { ?>
                    <a href="{{action('BankController@edit', $bank['bk_ID'])}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>

                     <?php } else {} ?>

                      <?php 
                    if(isset(Auth::user()->bankslistdelete) && Auth::user()->bankslistdelete == '1')
                        { ?>
                    <form action="{{action('BankController@destroy', $bank['bk_ID'])}}" method="post" style="display: inline">
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