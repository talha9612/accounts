@extends('master')
@foreach($teachers as $teacher)
                <!--Teacher View Modal -->
                <div class="modal fade" id="{{$teacher['tr_ID']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{$teacher['tr_name']}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <ul class="list-group bmd-list-group-sm">
                        <li class="list-group-item active">{{$teacher['tr_name']}} &nbsp &nbsp &nbsp <small>{{$teacher['tr_gender']}}</small> </li>
                        <li class="list-group-item"><b>So/Wo/Do:</b> {{$teacher['tr_fname']}} </li>
                        <li class="list-group-item"><b>Phone:</b> {{$teacher['tr_phone']}} </li>
                        <li class="list-group-item"><b>CNIC:</b>{{$teacher['tr_cnic']}}</li>
                      </ul>
                      <hr>

                       <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-6"><b>Associated Area</b></div>
                          <div class="col-md-6 ml-auto">{{$teacher['assoc_city']}} | {{$teacher['assoc_area']}}</div>
                        </div>

                        <hr>

                        <div class="row">
                          <div class="col-md-6"><b>Quota Valid From</b></div>
                          <div class="col-md-6 ml-auto">{{$teacher['tr_quota_validfrom']}}</div>
                        </div>

                        <div class="row">
                          <div class="col-md-6"><b>Quota Valid Till</b></div>
                          <div class="col-md-6 ml-auto">{{$teacher['tr_quota_validtill']}}</div>
                        </div>



                        <hr>

                         <div class="row">
                          <div class="col-md-6"><b>Amount</b></div>
                          <div class="col-md-6 ml-auto"><input type="text" class="form-control" name="quota" id="quota" value="{{$teacher['tr_quota']}}" readonly> </div>
                        </div>
                      </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>      
@endforeach
@section('content')

    <div class="container">
      @if (\Session::has('success'))
      <div class="alert alert-success">
          <p>{{ \Session::get('success') }}</p>
      </div><br />
      @endif
  </div>

    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Teacher)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Teachers</h4>
          <div align="right"><a href="{{action('TeacherController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">So/Wo/Do</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Gender</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 74px;" aria-label="Date: activate to sort column ascending">CNIC</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 74px;" aria-label="Date: activate to sort column ascending">Quota</th>
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
                  <th rowspan="1" colspan="1">Quota</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 @foreach($teachers as $teacher)
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1">{{$teacher['tr_ID']}}</td>
                  <td>{{$teacher['tr_name']}}</td>
                  <td>{{$teacher['tr_fname']}}</td>
                  <td>{{$teacher['tr_gender']}}</td>
                  <td>{{$teacher['tr_cnic']}}</td>
                  <td><input type="text" name="quota" class="form-control" id="quotatable" value="{{$teacher['tr_quota']}}" readonly></td>
                  <td>
                    <a  class="btn btn-link btn-info btn-just-icon like" data-toggle="modal" data-target="#{{$teacher['tr_ID']}}" title="view"><i class="material-icons">visibility</i></a>
                    <a href="{{action('TeacherController@edit', $teacher['tr_ID'])}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>
                    <form action="{{action('TeacherController@destroy', $teacher['tr_ID'])}}" method="post" style="display: inline">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-link btn-danger btn-just-icon remove" type="submit" title="delete"><i class="material-icons">close</i></button>
                    </form>
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
<script type="text/javascript">
var quota = document.getElementById("quota").value;  
quota = quota.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
document.getElementById("quota").value = quota;

var quotatable = document.getElementById("quotatable").value;  
quotatable = quotatable.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
document.getElementById("quotatable").value = quota;
</script>       
 @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 