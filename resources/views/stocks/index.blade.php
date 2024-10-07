@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->stockview) && Auth::user()->stockview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     All <small class="text-muted">(Stock)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Stock List</h4>
          <?php
          if(isset(Auth::user()->role) && Auth::user()->role == 'Admin')
              { ?>
          <div align="right"><a href="{{action('StockController@salesprice')}}" class="btn btn-success btn-raised" >Update Sales Prices</a>
          </div>
          <?php } else {} ?>
           <div align="right"><a href="{{action('StockController@viewsalesprice')}}" class="btn btn-success btn-raised" >view Sales Prices</a>
          </div>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--   Here you can write extra buttons/actions for the toolbar  -->
          </div>
          <!-- <div class="form-group" align="right">
            <a href="{{action('StockController@printSt')}}" target="new" title="Print/PDF"> <i class="material-icons text-warning">local_printshop</i> </a> 
          </div> -->
        <div align="right">
        <a href="javascript:printDiv('datatables')">Print</a><br>
        <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
        </div>
          <div class="material-datatables">
           <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <div id="div1">
                <table id="datatables1" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info"  border="1px">
                  <thead class="bg-primary">
                    <tr role="row">
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Age: activate to sort column ascending">Date</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Position: activate to sort column ascending">ID</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Position: activate to sort column ascending">Make</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Position: activate to sort column ascending">Item</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Office: activate to sort column ascending">Model</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Position: activate to sort column ascending">Specs</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">Qty</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">Lot</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Office: activate to sort column ascending">Supplier</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Office: activate to sort column ascending">C-U</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Office: activate to sort column ascending">Total</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Office: activate to sort column ascending">Actions</th>
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
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $total = 0; ?>
                     <?php foreach ($orders as $orders):?>
                    <tr role="row" class="odd" style="font-size: 10px">
                      <td tabindex="0" class="sorting_1"><?php  $newDate = date("d-M-Y", strtotime($orders->updated_at)); echo $newDate; ?></td>
                      <td><?php echo $orders->ss_ID; ?></td>
                      <td><?php echo $orders->ss_supplier; ?></td>
                      <td><?php echo $orders->ss_item; ?></td>
                      <td><?php echo $orders->ss_size; ?></td>
                      <td><?php echo $orders->ss_specs; ?></td>
                      <td><?php echo $orders->ss_quantity; ?></td>
                      <td><?php echo $orders->lot_number; ?></td>
                      <td><?php echo $orders->s_company; ?></td>
                      <td>Rs.<?php $subtotal =  number_format($orders->ss_costunit, 2, '.', ',');
                        echo $subtotal; ?></td>
                        <?php $totalcost = 0; ?>
                        <?php $totalcost = $orders->ss_costunit * $orders->ss_quantity; ?>
                      <td>Rs.<?php $subtotal =  number_format($totalcost, 2, '.', ',');
                        echo $subtotal; ?> <input type="hidden" name="total[]" value="<?php echo $totalcost; ?>">
                      </td>
                      <td class="text-right hid" style="">
                        <a  href="{{action('StockController@show', $orders->ss_ID)}}" class="btn btn-link btn-info btn-just-icon like" title="view">
                          <i class="material-icons">visibility</i>
                        </a>
                         <?php
                          if(isset(Auth::user()->stockedit) && Auth::user()->stockedit == '1')
                              { ?>
                        <a href="{{action('StockController@edit', $orders->ss_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>  
                          <?php } else {} ?>     
                      </td>
                    </tr>
                    <?php $total += $orders->ss_costunit * $orders->ss_quantity; ?>
                   <?php endforeach; ?>
                  </tbody>
                </table>
                 <div align="right">
                  <label class="text-dark"><b>Running Total:  </b></label>
                  <span id="runningtotal"> </span>
                </div>
                 </div>
               <div align="right">
                <label class="text-dark"><b>Grand Total</b></label>
                  <input type="text" name="grandtotal" value="Rs:           <?php $subtotal =  number_format($total, 2, '.', ',');
                    echo $subtotal; ?>/-" style="text-align: right" readonly>
                  </div>
                 
                
                </div>
                </div>
                </div>
                 </div>
                  </div>
                   </div>
        <!-- end content-->

       <!-- WORK AREA END -->
<script type="text/javascript">
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

setInterval(function()
 { 
     findTotal();
 }, 1500);
  function findTotal(){
  var dbarr = document.getElementsByName('total[]');
    var dbtot=0;
    for(var j=0;j<dbarr.length;j++){
        if(parseFloat(dbarr[j].value))
            dbtot += parseFloat(dbarr[j].value);
document.getElementById('runningtotal').value = dbtot.toFixed(2);
    }
var rbalance = document.getElementById('runningtotal').value;
rbalance = rbalance.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
document.getElementById('runningtotal').innerHTML = rbalance;    
  }
</script>  

<script>
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div> <h2 align="center"> Stock List </h2> <br>')
            function printDiv(divId) {
              var hid = document.getElementsByClassName("hid");
              for(var i=0; i<hid.length; i++)
              {
                document.getElementsByClassName("hid")[i].style.visibility = 'hidden'; 
                document.getElementsByClassName("form-control-sm")[0].style.visibility = 'hidden';  
              }
               
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').innerHTML;
                 for(var i=0; i<hid.length; i++)
              {
                document.getElementsByClassName("hid")[i].style.visibility = 'visible';  
                document.getElementsByClassName("form-control-sm")[0].style.visibility = 'visible';  
              }  
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();             
            }
</script>    

 @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>  