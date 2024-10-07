@extends('master')
@section('content')

 <?php
      if(isset(Auth::user()->role) && Auth::user()->role == 'Admin')
              { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     Update <small class="text-muted">(Sales Prices)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Update Sales Prices</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--   Here you can write extra buttons/actions for the toolbar  -->
          </div>
      <form method="post" action="{{url('stocks')}}">
         {{csrf_field()}}

          <div class="material-datatables">
           <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
             
                  <label class="text-primary">C.C.E %</label>
                  <input type="text" name="cceall" id="cceall" class="form-control">
                <table id="datatables1" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatables_info"  border="1px">
                  <thead class="bg-primary">
                    <tr role="row">
                     
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;font-size: 10px" aria-label="Position: activate to sort column ascending">ID</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;font-size: 10px" aria-label="Position: activate to sort column ascending">Make</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;font-size: 10px" aria-label="Position: activate to sort column ascending">Item</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;font-size: 10px" aria-label="Office: activate to sort column ascending">Model</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">Qty</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">Lot</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">C-P</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">S-P</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">C.C.E</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">E.P</th>
                      <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;font-size: 10px" aria-label="Office: activate to sort column ascending">New Sales Price</th>
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
                    </tr>
                  </tfoot>
                  <tbody>
                    
                     <?php foreach ($orders as $orders):?>
                    <tr role="row" class="odd" style="font-size: 10px">
                      <td><input type="text" name="id[]" class="form-control" style="width:20px;font-size: 10px" value="<?php echo $orders->ss_ID; ?>"> <span style="display: none"><?php echo $orders->ss_ID; ?></span> </td>

                      <td><input type="text" name="make[]" class="form-control" style="width:70px;font-size: 10px" value="<?php echo $orders->ss_supplier; ?>"> <span style="display: none"><?php echo $orders->ss_supplier; ?></span>  </td>

                      <td><input type="text" name="item[]" class="form-control" style="width:100px;font-size: 10px" value="<?php echo $orders->ss_item; ?>">  <span style="display: none"><?php echo $orders->ss_item; ?></span> </td>

                      <td><input type="text" name="model[]" class="form-control" style="width:100px;font-size: 10px" value="<?php echo $orders->ss_size; ?>"> <span style="display: none"><?php echo $orders->ss_size; ?></span></td>

                      <td><input type="text" name="quantity[]" class="form-control" style="width:20px;font-size: 10px" value="<?php echo $orders->ss_quantity; ?>"></td>

                      <td><input type="text" name="lot[]" class="form-control" style="width:70px;font-size: 10px" value="<?php echo $orders->lot_number; ?>"></td>

                      <td><input type="text" name="cp[]" class="form-control" style="width:70px;font-size: 10px" value="<?php echo $orders->ss_costunit; ?>"></td>

                       <td>
                        <input type="text" name="salesprice[]" class="form-control hid" value="<?php echo $orders->ss_saleprice; ?>" style="width:70px;font-size: 10px">
                        </td> 
                       
                       <td>
                        <input type="text" name="cce[]" class="form-control hid" style="width:70px;font-size: 10px">  
                       </td>
                      
                       <td>
                        <input type="text" name="ep[]" class="form-control hid" style="width:70px;font-size: 10px">
                        </td>

                       <td>
                        <input type="text" name="newsalesprice[]" class="form-control hid" style="width:70px;font-size: 10px">
                        </td>
                    </tr>
                   <?php endforeach; ?>
                  </tbody>
                </table>
              
              <div align="center" >
                 <a href="{{action('StockController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                  <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Submit</button>
                </div>
                  </form>
                
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
  var cce = document.getElementsByName('cce[]');
    for(var j=0;j<cce.length;j++){
      
      document.getElementsByName('cce[]')[j].value = document.getElementById('cceall').value;
      
      var ccepercent =  document.getElementsByName('cce[]')[j].value / 100;
      var salesprice =  document.getElementsByName('salesprice[]')[j].value;
      var ep = ccepercent * salesprice;
      document.getElementsByName('ep[]')[j].value = ep.toFixed(2);
      
      var newsalesprice = +salesprice + +ep;
      document.getElementsByName('newsalesprice[]')[j].value = newsalesprice.toFixed(2);
      

//         if(parseFloat(dbarr[j].value))
//             dbtot += parseFloat(dbarr[j].value);
// document.getElementById('runningtotal').value = dbtot.toFixed(2);
    }
   
  }
</script>       

 @endsection       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>  