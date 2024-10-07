@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     Posted <small class="text-muted">(Sale Requisitions)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Sale Requisitions</h4>
          <div align="right">
            <a href="{{action('SrequisitionController@savedSr')}}" class="btn btn-success btn-raised" >Saved SR's</a>
            <a href="{{action('SrequisitionController@finalSr')}}" class="btn btn-success btn-raised" >Finalized SR's</a>
             <?php 
              if(isset(Auth::user()->role) && Auth::user()->role == 'Admin')
                                     { ?>
            <a href="{{action('SrequisitionController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
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
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Age: activate to sort column ascending">Date</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Number</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Title</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Name</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Date</th>
                  <th rowspan="1" colspan="1">Number</th>
                  <th rowspan="1" colspan="1">Title</th>
                  <th rowspan="1" colspan="1">Name</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($requisitions as $requisition):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php  $newDate = date("d-M-Y", strtotime($requisition->updated_at)); echo $newDate; ?></td>
                  <td><?php echo $requisition->sr_number; ?></td>
                  <td><?php echo $requisition->sr_title; ?></td>
                  <td><?php echo $requisition->sr_name; ?></td>
                  <td class="text-right" style="">
                        <a  href="{{action('SrequisitionController@show', $requisition->sr_number)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
                          <i class="material-icons">visibility</i>
                        </a>
                        <form action="{{action('SrequisitionController@unpostSr', $requisition->sr_number)}}" method="get" style="display: inline;">
                        <input type="hidden" name="sr_number" value="<?php echo $requisition->sr_number; ?>">
                        <button type="submit" class="btn btn-warning">UNPOST</button>
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
<!-- <script type="text/javascript">
  // FOR DISPLAY OF COMMA SEPRATED VALUES
var xarr = document.getElementsByName('ctamnt[]');
    for(var j=0;j<xarr.length;j++){
      var b = xarr[j].value;
      b = b.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementsByName('ctamnt[]')[j].value = b;     
    }
</script> -->  

    
 @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>  