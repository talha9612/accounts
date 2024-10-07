          @extends('master')             
          @section('content')
<style>
#p2 { font-family: Helvetica, Arial, sans-serif; font-size: 14px }
</style>
          <h3 align="center" style= "color: #3F729B;">Quotes: Prospect Orders</h3>          
          <div class="card">
          <div class="card-header card-header-rose card-header-icon "style="background-color: #3F729B">
          <div class="card-icon">
          <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white" style="background-color: #3F729B" >Quotes: Prospect Orders</h4>
          <br>                 
          </div>
        
        
           <form method="post" action="{{url('quotes')}}">
          {{csrf_field()}}
          <div class="form-inline" >                                                         
          <div style="width: 20%">

          <label for="cat" style= "color: #3F729B;">Category</label>
          <select class="form-control" type="select" id="cat" required name="cat" style="width: 30%;margin-left: 80px">   
          <option value="{{request('cat')}}">{{request('cat')}}</option>            
          <option value="A">A</option>
          <option value="B">B</option> 
          <option value="C">C</option> 
          <option value="ALL">ALL</option>                       
          </select>
          </div>

          <div >
          
          <label style= "color: #3F729B;margin-right: 200px">From</label>
          <input type="date" style="width: 98%;" name="fdate" id="fdate" class="form-control" value="{{request('fdate')}}">
           
          </div>                    
          <div >
          <label style= "color: #3F729B;margin-right: 200px">To</label>
          <input type="date" style="width: 98%" class="form-control" id="tdate" required name="tdate" value="{{request('tdate')}}">
          </div>
          <Button type="submit" class="btn btn-primary btn-raised" style="border-radius: 6px;border-color: black; margin-top: 30px; margin-left: 10px; width: 100px" title="Search Record">Show</Button>
          <a href="{{action('QuotationController@show',1)}}" class="btn btn-info btn-raised" style="border-radius: 6px;border-color: black; margin-top: 30px; margin-left: 10px; width: 100px">Reset</a>
           <a class="btn btn-primary btn-raised" style="border-radius: 6px;border-color: black; margin-top: 30px; margin-left: 10px; width: 100px" title="Print" href="javascript:printDiv('datatables')">Print</a><br>
          <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
          </div>
          </form>

          <div id="div1">
          <div align="center" style="margin-left: 25px;font-family: Helvetica, Arial, sans-serif; font-size: 16px" class="form-inline">
          <label>Category: </label>  <b>{{request('cat')}}</b> <br>
         
          <label>From</label>
          <b>{{date("d-M-Y", strtotime(request('fdate')))}}</b>
          <label>To</label>
          <b>{{date("d-M-Y", strtotime(request('tdate')))}}</b>
           <br>
          <br>
          </div>

          <div class="col-sm-12">
          <table id="reportables" border=".1px" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;font-family: Helvetica, Arial, sans-serif; font-size: 16px" role="grid" aria-describedby="datatables_info">
          <thead style="background-color: #3F729B">
          <tr role="row">
          <th align="left" class="sorting_asc text-white" aria-controls="datatables" rowspan="1" colspan="1" style="width: 80px;" aria-sort="ascending" aria-label="Name: activate to sort column descending" >Quotation ID</th>        
          <th align="left" class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 120px;" aria-label="Position: activate to sort column ascending">Issue Date</th>
          <th align="left" class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 230px;" aria-label="Office: activate to sort column ascending">Customer Name</th>                  
          <th align="left" class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 100px;" aria-label="Age: activate to sort column ascending">Total Price</th>         
          </tr>
          </thead>

          <tbody>
          <?php $total=0; foreach ($records as $record):?>
          <tr role="row" class="odd">
          <td class="sorting_1"><?php echo $record->QuotationNumber; ?></td>
          <td><?php echo date("d-M-Y", strtotime($record->IssueDate)) ?></td>
          <td><?php echo $record->CustomerName; ?></td>
          <td style="text-align: center;"><?php $subtotal = number_format($record->Grand_total, 2, '.', ',');echo $subtotal;?> </td>             
          </tr>
          @endforeach
          </tbody>
          <tfoot hidden>
            <tr>
                <th colspan="3" style="text-align:right">Grand Total:</th>
                <th align="center"></th>
            </tr>
            <tr>
                <th colspan="3" style="text-align:right">DIB:</th>

                <th align="center"> </th>
            </tr>

        </tfoot>            
          </table>
          <div align="right">
         <h3>DIB:<span><b id="dib"></b></span></h3> 
         <h3>Grand Total:<span><b id="gt"></b> </span></h3> 
          </div>

         <!--  <div align="right">
          <label align="left" style="color: #3F729B">Grand Total</label>
          <input style="width: 25%"  class="form-control" readonly type='number'value="<?php echo $total; ?>" /> 
          </div>

          <div align="right">
          <label align="left" style="color: #3F729B">DIB</label>
          <input style="width: 25%" class="form-control" readonly type='number' value="<?php echo $total/10; ?>" /> 
          </div> -->
          </div>
          </div>
        
          </div>
          

          <script>
            printDivCSS = new String ('<head> <title> DIB Report </title> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"> </div> <div align="center"> <h2 style= "font-family: Helvetica, Arial, sans-serif; font-size: 30px">Quotes: Prospect Orders</h2></div> <br>')
            function printDiv(divId) 
          {   
           
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').innerHTML;   
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();             
            }
          </script>  

<script type="text/javascript">
          $(document).ready(function() {


     $('#reportables').DataTable( { 
     // bFilter: false, 
     // bInfo: false ,   
     searching: false,
     paging: false, 
     info: false ,       
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var dib;
            var grandtotal;
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                pageTotal.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")

            );
        
          
          dib = pageTotal.toFixed(2)/10;
          grandtotal = pageTotal;
             document.getElementById('dib').innerHTML =dib.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
             document.getElementById('gt').innerHTML =grandtotal.toFixed(2).toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    } );
} );
</script>      
          @endsection 
     
          <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 