@extends('master')             
@section('content')
    <!-- WORK AREA START -->
<h3 align="center" style= "color: #3F729B">
    Model Report
</h3>
    <div class="card">
    <div class="card-header card-header-rose card-header-icon "style="background-color: #3F729B">
    <div class="card-icon">
    <i class="material-icons">assignment</i>
    </div>
    <h4 class="card-title text-white" style="background-color: #3F729B" >Model Report</h4>
    <br>
    <div>
       
    </div>          
    </div>
        
            <div class="card-body">
            <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
            <div class="col-sm-12">
            <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" 
            cellspacing="0" style="width: 100%" width="100%" role="grid" aria-describedby="datatables_info">
            <thead style="background-color: #3F729B">
            <tr role="row">
            <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 120px;" aria-sort="ascending" aria-label="Name: activate to sort column descending" >Quotation ID</th>
            <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-sort="ascending" aria-label="Name: activate to sort column descending" >Revision Status</th>
            <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 200px;" aria-label="Position: activate to sort column ascending">Issue Date</th>
            <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 120px;" aria-label="Office: activate to sort column ascending">Customer Name</th>
            <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 120px;" aria-label="Age: activate to sort column ascending">Model</th>
            <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 120px;" aria-label="Age: activate to sort column ascending">Unit Price</th>
        <!--     <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px" aria-label="Actions: activate to sort column ascending">Actions</th> -->
            </tr>
            </thead>
            <tfoot class="sorting_asc text-white" style="background-color: #3F729B">
            <tr>
            <th rowspan="1" colspan="1">Quotation ID</th>
            <th rowspan="1" colspan="1">Revision Status</th>
            <th rowspan="1" colspan="1">Issue Date</th>
            <th rowspan="1" colspan="1">Customer Name</th>
            <th rowspan="1" colspan="1">Model</th>                  
            <th rowspan="1" colspan="1">Unit Price</th>             
        <!--     <th rowspan="1" colspan="1" style="">Actions
            </th> -->
            </tr>
            </tfoot>
            <tbody>
            <?php foreach ($records as $record):?>
            <tr role="row" class="odd">
            <td tabindex="0" class="sorting_1"><?php echo $record->QuotationNumber; ?></td>
            <td><?php echo $record->REV; ?></td>
            <td><?php echo $record->IssueDate; ?></td>
            <td><?php echo $record->CustomerName; ?></td>
            <td><?php echo $record->Model; ?></td>
            <td><?php echo $record->UnitPrice; ?></td>                                             
            </tr>
            @endforeach
             <?php foreach ($recordo as $recordso):?>
            <tr role="row" class="odd">
            <td tabindex="0" class="sorting_1"><?php echo $recordso->QuotationNumber; ?></td>
            <td><?php echo $recordso->REV; ?></td>
            <td><?php echo $recordso->IssueDate; ?></td>
            <td><?php echo $recordso->CustomerName; ?></td>
            <td><?php echo $recordso->Model; ?></td>
            <td><?php echo $recordso->UnitPrice; ?></td>                                             
            </tr>
            @endforeach
              <?php foreach ($recordc as $recordsc):?>
            <tr role="row" class="odd">
            <td tabindex="0" class="sorting_1"><?php echo $recordsc->QuotationNumber; ?></td>
            <td><?php echo $recordsc->REV; ?></td>
            <td><?php echo $recordsc->IssueDate; ?></td>
            <td><?php echo $recordsc->CustomerName; ?></td>
            <td><?php echo $recordsc->Model; ?></td>
            <td><?php echo $recordsc->UnitPrice; ?></td>                                             
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
            @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 