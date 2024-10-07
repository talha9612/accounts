@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->stockview) && Auth::user()->stockview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View <small class="text-muted">(Sales Prices)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">View Sales Prices</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--   Here you can write extra buttons/actions for the toolbar  -->
          </div>
    
        <div align="right">
        <a href="javascript:printDiv('datatables')">Print</a><br>
        <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
        </div>
          <div class="material-datatables">
           <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <div id="div1">
                <table id="datatables1" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatables_info"  border="1px">
                  <thead class="bg-primary">
                    <tr role="row">
                     
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Position: activate to sort column ascending">ID</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;font-size: 10px" aria-label="Position: activate to sort column ascending">Make</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;font-size: 10px" aria-label="Position: activate to sort column ascending">Item</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;font-size: 10px" aria-label="Office: activate to sort column ascending">Model</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">Qty</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">Lot</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">Sales Price</th>
                    </tr>
                  </thead>
                  <tfoot class="bg-primary">
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    
                     <?php foreach ($orders as $orders):?>
                    <tr role="row" class="odd" style="font-size: 10px">
                      <td><?php echo $orders->slp_ID ?> </td>

                      <td><?php echo $orders->slp_make ?> </td>

                      <td><?php echo $orders->slp_item ?> </td>

                      <td><?php echo $orders->slp_model ?> </td>

                      <td><?php echo $orders->slp_quantity ?> </td>

                      <td><?php echo $orders->slp_lot ?> </td>

                       <td><?php echo $orders->slp_newsalesprice ?> </td>
                    </tr>
                   <?php endforeach; ?>
                  </tbody>
                </table>
                 </div>
              <div align="center" >
                 <a href="{{action('StockController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                  
                </div>
                </div>
                </div>
                </div>
                 </div>
                  </div>
                   </div>
        <!-- end content-->

       <!-- WORK AREA END -->

<script>

  $(document).ready(function() {
        $('#datatables1').DataTable({
          "pagingType": "full_numbers",
          "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          
          responsive: true,
          language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
          },
          "paging": false
            
        });
        var table = $('#datatable1').DataTable();
        table.on('click', '.edit', function() {
          $tr = $(this).closest('tr');
          var data = table.row($tr).data();
          alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });
        table.on('click', '.remove', function(e) {
          $tr = $(this).closest('tr');
          table.row($tr).remove().draw();
          e.preventDefault();
        });
        table.on('click', '.like', function() {
          alert('You clicked on Like button');
        });
    });

            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <h2 align="center"> Stock List </h2> <br>')
            function printDiv(divId) {
              var hid = document.getElementsByClassName("hid");

                
                document.getElementsByClassName("form-control-sm")[0].style.visibility = 'hidden';  
               

               
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').innerHTML;

                
                document.getElementsByClassName("form-control-sm")[0].style.visibility = 'visible';  
  
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();             
            }
</script>  
 @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>  