@extends('master')
@section('content')

 <?php
  if(isset(Auth::user()->jvview) && Auth::user()->jvview == '1')
      { ?>
         <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Journal Vouchers)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Journal Vouchers</h4>
          <?php
          if(isset(Auth::user()->jvadd) && Auth::user()->jvadd == '1')
              { ?>
          <div align="right"><a href="{{action('JvController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
          </div>
            <?php } else {} ?>
        </div>
        <div class="card-body">
          <div class="toolbar">
          </div>
          <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
              <input id="myInput" type="text" placeholder="Search.." class="form-control">
              <br>
              <table id="myTable" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Date</th>
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">V.Number</th>
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Prepared By</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 0px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr class="bg-primary text-white">
                  <th style="display: none" id="spn">01-Apr-1900 10:31:48 AM</th>
                  <th rowspan="1" colspan="1">Date</th>
                  <th rowspan="1" colspan="1">V.Number</th>
                  <th rowspan="1" colspan="1">Prepared By</th>
                  <th rowspan="1" colspan="1" style="">Actions
                  </th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($jvs as $jv):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"> <?php  $newDate = date("d-M-Y", strtotime($jv->created_at)); echo $newDate; ?> </td>
                  <td><?php echo $jv->jv_no; ?></td>
                   <td><?php echo $jv->jv_preparedby; ?></td>
                  <td class="text-right" style="">
                        <a  href="{{action('JvController@show', $jv->jv_no)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
                          <i class="material-icons">visibility</i>
                        </a>
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
<script>
 setInterval(function()
 {
     sortTable();
 }, 1000);

function sortTable() {
// FOR TABLE SORTING
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("datatables");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      var firstDate = Date.parse(x.innerHTML);
      var secondDate = Date.parse(y.innerHTML);
      if (firstDate > secondDate) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
</script>

<script src="{{asset('assets/sorting.js')}}"></script>

 @endsection
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
<?php  } else {  redirect()->to('home')->send(); } ?>
