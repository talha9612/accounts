@extends('master')
@section('content')
    <!-- WORK AREA START -->
<h3 align="center" style= "color: #3F729B">
     Quotations
</h3>
            <div class="card">
            <div class="card-header card-header-rose card-header-icon "style="background-color: #3F729B">
            <div class="card-icon">
            <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title text-white" style="background-color: #3F729B" >Quotations</h4>
            <br>
            <div align="right">
           <!--  <a align="left" href="{{action('QuotationController@show',1)}}" target="new" class="btn btn-success btn-raised"
                style="background-color: #b71c1c" >DIB Reports</a>
            <a align="left" href="{{action('QuotationController@showSreport',1)}}" class="btn btn-success btn-raised"
                style="background-color: #b71c1c" >Summary</a>
            <a align="left" href="{{action('QuotationController@edit',1)}}"  class="btn btn-success btn-raised"
                style="background-color: #b71c1c" >Product (Model) Report</a>  -->
            <a align="right" href="{{action('QuotationController@create')}}" target="new" class="btn btn-success btn-raised"
                style="background-color: #007E33" >+ Add New</a>
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
            <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-sort="ascending" aria-label="Name: activate to sort column descending" >Quotation ID</th>
            <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 50px;" aria-sort="ascending" aria-label="Name: activate to sort column descending" >Revision Status</th>
            <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-label="Position: activate to sort column ascending">Issue Date</th>
            <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 250px;" aria-label="Office: activate to sort column ascending">Customer Name</th>
            <th class="sorting text-white" tabindex="0" aria-controls="datatables"rowspan="1" colspan="1" style="width: 50px;" aria-label="Office: activate to sort column ascending">Location</th>
            <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 120px;" aria-label="Age: activate to sort column ascending">Total Price</th>
            <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px" aria-label="Actions: activate to sort column ascending">Actions</th>
            </tr>
            </thead>
            <tfoot class="sorting_asc text-white" style="background-color: #3F729B">
            <tr>
            <th rowspan="1" colspan="1">Quotation ID</th>
            <th rowspan="1" colspan="1">Revision Status</th>
            <th rowspan="1" colspan="1">Issue Date</th>
            <th rowspan="1" colspan="1">Customer Name</th>
            <th rowspan="1" colspan="1">Location</th>
            <th rowspan="1" colspan="1">Total Price</th>
            <th rowspan="1" colspan="1" style="">Actions
            </th>
            </tr>
            </tfoot>
            <tbody>
            <?php foreach ($records as $record):?>
            <tr role="row" class="odd" id="<?php echo $record->QuotationNumber; ?>">
            <td tabindex="0" class="sorting_1"><?php echo $record->QuotationNumber; ?></td>
            <td><?php echo $record->REV; ?></td>
            <td><?php echo $record->IssueDate; ?></td>
            <td><?php echo $record->CustomerName; ?></td>
            <td><?php echo $record->Location; ?></td>
            <td><?php echo $record->Grand_total; ?></td>
            <td style="text-align: center;">
            <div class="form-inline">
            <form method="post" action="{{url('quotes')}}">
            {{csrf_field()}}
            <input type="hidden" name="qrevise" value="1">
            <input type="hidden" name="reviseqnumber" value="<?php echo $record->QuotationNumber; ?>">
            <input type="hidden" name="reviseqrev" value="<?php echo $record->REV; ?>">
            <button type="submit" class="btn btn-link btn-info btn-just-icon like" title="Revise Quote"> <i class="material-icons">replay</i></button>
            </form>
            <form method="post" action="{{url('quotes')}}">
            {{csrf_field()}}
            <input type="hidden" name="qedit" value="1">
            <input type="hidden" name="editqnumber" value="<?php echo $record->QuotationNumber; ?>">
            <input type="hidden" name="editqrev" value="<?php echo $record->REV; ?>">
            <button type="submit" class="btn btn-link btn-warning btn-just-icon like" title="Edit Quote"> <i class="material-icons">edit</i></button>
            </form>
            <form method="post" action="{{url('quotes')}}">
            {{csrf_field()}}
            <input type="hidden" name="qview" value="1">
            <input type="hidden" name="qnumber" value="<?php echo $record->QuotationNumber; ?>">
            <input type="hidden" name="qrev" value="<?php echo $record->REV; ?>">
            <button type="submit" class="btn btn-link btn-success btn-just-icon like" title="View Quote"> <i class="material-icons">visibility</i></button>
            </form>
            </div>
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
            @endsection
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
