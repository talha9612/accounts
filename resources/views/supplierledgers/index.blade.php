@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->supplierledgersview) && Auth::user()->supplierledgersview == '1')
      { ?>
<script type="text/javascript">
    $(document).ready(function () {

        $('#showWithDate1').on('click', function () {

            var date1 = document.getElementById("pickdate1")

            var data = {
                date: date1.value,
            }
            var base_url = '{{\config("environment.app_url")}}'
            var request = $.get(base_url+'/StarAutomation/public/supplierledgers', data);

            // When it's done
            request.done(function (response) {
                // console.log(response);
                $("body").html(response);
            });


        });

    });
</script>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Suppliers/Payables Ledger)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Suppliers/Payables Ledger</h4>
        </div>
        <div class="card-body">
            <div class="row">
                        <span class="col-md-5" style="margin-right: 0px; margin-left: 10px">
                            <div class="form-group form-inline">
                                <label for="pickdate1" class="text-primary" style="margin-left: 10px">Pick Date</label>
                                <input class="form-control" type="date" id="pickdate1" name="date2"
                                       style="margin-left: 10px" value="{{explode(' ', $date)[0]}}"/>
                            </div>
                        </span>
                <button class="btn btn-info form-control col-md-2 form-inline" id="showWithDate1"
                        style="margin-left: 35%;margin-top: 23px">Show
                </button>
            </div>
        <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
          <div class="col-sm-12">
            <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 164px;" aria-label="Account Title: activate to sort column ascending">Company</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Opening Balance: activate to sort column ascending">Opening Balance</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Opening Balance: activate to sort column ascending">Closing Balance</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 29px;" aria-label="Updated At: activate to sort column ascending">Due Date</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">Company</th>
                  <th rowspan="1" colspan="1">Opening Balance</th>
                  <th rowspan="1" colspan="1">Closing Balance</th>
                  <th rowspan="1" colspan="1">updated At</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                <?php $totalopening = 0; ?>
                <?php $totalclosing = 0; ?>
                <?php foreach ($requisitions as $requisitions):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $requisitions->s_company; ?></td>
                  <td><?php $subtotal = number_format($requisitions->s_obalance, 2, '.', ',');
                    echo $subtotal; ?>/-</td>
                    <td><?php $subtotal = number_format($requisitions->s_balance, 2, '.', ',');
                    echo $subtotal; ?>/-</td>
                  <td><?php echo $requisitions->s_duedate; ?></td>
                  <td class="text-right" style="">
                        <a  href="{{action('SupplierledgerController@show', $requisitions->s_ID)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
                          <i class="material-icons">visibility</i>
                        </a>
                  </td>
                </tr>
                 <?php $totalopening += $requisitions->s_obalance; ?>
                <?php $totalclosing += $requisitions->s_balance; ?>
                <?php endforeach; ?>
                <tr>
                  <td></td>
                  <td><label> Total Opening
                        <input type="text" name="totalopening" class="form-control"  value="<?php $subtotal =  number_format($totalopening, 2, '.', ',');
                    echo $subtotal; ?>" readonly></label></td>
                    <td> <label> Total Closing
                          <input type="text" name="totalopening" class="form-control"  value="<?php $subtotal =  number_format($totalclosing, 2, '.', ',');
                    echo $subtotal; ?>" readonly></label></td>
                  <td></td>
                  <td></td>
                </tr>
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
