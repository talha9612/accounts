<!-- show.blade.php -->
@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Material Receiving Report)</small>
          </h3>
          <br>
           <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='gi_number' value="<?php echo $details->mr_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                          <input class="form-control" type='text' name='updated_at' value=" <?php  $newDate = date("d-M-Y", strtotime($details->updated_at)); echo $newDate; ?> " readonly />
                </div>
              </div> 
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='gi_name' name='mr_name' value="<?php echo $details->mr_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='gi_title' name='mr_title' value="<?php echo $details->mr_title; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier Name</label>
                          <input class="form-control" type='text' id='gi_title' name='mr_title' value="<?php echo $details->s_name; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier ID</label>
                          <input class="form-control" type='text' id='gi_title' name='mr_title' value="<?php echo $details->s_ID; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Supplier Company</label>
                          <input class="form-control" type='text' id='gi_title' name='mr_title' value="<?php echo $details->s_company; ?>" readonly/> 
                    </div>
                     <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Lot Number</label>
                          <input class="form-control" type='text' id='gi_title' name='mr_title' value="<?php echo $details->lot_number; ?>" readonly/> 
                    </div>
                    <div class="form-group" align="right">
                    <a href="{{action('MrreportController@printMr' , $details->mr_number)}}" target="new" title="Print/PDF"> <i class="material-icons text-warning">local_printshop</i> </a> 
                    </div>
              </div>
              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Supplier/Make 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Position: activate to sort column ascending">Item Name 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Model </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Specifications </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Name: activate to sort column ascending">Description</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Details: activate to sort column ascending">Quantity</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Supplier/Make</th>
                  <th rowspan="1" colspan="1">Item Name</th>
                  <th rowspan="1" colspan="1">Model</th>
                  <th rowspan="1" colspan="1">Specifications</th>
                  <th rowspan="1" colspan="1">Description</th>
                  <th rowspan="1" colspan="1">Quantity</th>
                </tr>
              </tfoot>
              <tbody>
               <?php foreach ($pass as $pass):?>
                <tr role="row" class="odd">
                  <td><?php echo $pass->mr_supplier; ?></td>
                  <td><?php echo $pass->mr_item; ?></td>
                  <td><?php echo $pass->mr_size; ?></td>
                  <td><?php echo $pass->mr_specs; ?></td>
                  <td><?php echo $pass->mr_description; ?></td>
                  <td><?php echo $pass->mr_quantity; ?></td>
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
           <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Received By</label>
                          <input class="form-control" type='text' id='gi_received_by' name='gi_received_by' value="<?php echo $details->mr_received_by; ?>" readonly/> 
                    </div>
            <form action="{{action('ScvaluationController@create', $details->mr_number)}}" method="get" align="center" 
              <?php if($pass->mr_status == "1") {echo "hidden";} else {} ?> >
                        <input type="hidden" name="pr_number" value="<?php echo $details->mr_number; ?>">
                        <button type="submit" class="btn btn-info">Stock Cost Valuation</button>
            </form>        
            <br> 
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
       <!-- WORK AREA END -->  
        
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
  <?php  } else {  redirect()->to('home')->send(); } ?>