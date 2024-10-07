@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->purchaseview) && Auth::user()->purchaseview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Purchase Requisition)</small>
          </h3>
          <br>
           <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='pr_number' value="<?php echo $details->pr_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                          <input class="form-control" type='text' name='updated_at' value="<?php echo $details->updated_at; ?>" readonly />
                </div>
              </div> 
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='pr_name' name='pr_name' value="<?php echo $details->pr_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='pr_title' name='pr_title' value="<?php echo $details->pr_title; ?>" readonly/> 
                    </div>
                     <div class="form-group" align="right">
                    <a href="{{action('PrequisitionController@printPr' , $details->pr_number)}}" target="new" title="Print/PDF"> <i class="material-icons text-warning">local_printshop</i> </a> 
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
                   <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 83px;" aria-label="Office: activate to sort column ascending">Specifications</th>
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
               <?php foreach ($requisition as $requisition):?>
                <tr role="row" class="odd">
                  <td><?php echo $requisition->s_company; ?></td>
                  <td><?php echo $requisition->pr_item; ?></td>
                  <td><?php echo $requisition->pr_size; ?></td>
                  <td><?php echo $requisition->pr_specs; ?></td>
                  <td><?php echo $requisition->pr_description; ?></td>
                  <td>
                    <input type="text" name="pr_quantity[]" class="form-control" value="<?php echo $requisition->pr_quantity; ?>" readonly>
                    <span style="display: none"><?php echo $requisition->pr_quantity; ?></span>
                  </td>
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
           
            <form action="{{action('PorderController@create', $details->pr_number)}}" method="get" align="center" 
              <?php if($requisition->pr_status=="2" || $requisition->pr_status=="0")  {echo "hidden";} else{} ?>>
                        <input type="hidden" name="pr_number" value="<?php echo $requisition->pr_number; ?>">
                        <button type="submit" class="btn btn-info">Make Purchase Order</button>
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


<!-- <script type="text/javascript">
//FOR CALCULATION OF UNIT PRICE AND TOTAL PRICE
    var quantity = document.getElementsByName('pr_quantity[]');
    var unitprice = document.getElementsByName('pr_unitprice[]');
    var arr = document.getElementsByName('pr_totalprice[]');
    var tot= 0;
    for(var k=0;k<unitprice.length;k++){
        if(parseInt(unitprice[k].value))
        tot = parseInt(unitprice[k].value);   
 arr[k].value += tot * parseInt(quantity[k].value);     
    }

  // FOR DISPLAY OF COMMA SEPRATED VALUES
 var pricearr = document.getElementsByName('pr_totalprice[]');
    var tot=0;
    for(var i=0;i<pricearr.length;i++){
        if(parseInt(pricearr[i].value))
            tot += parseInt(pricearr[i].value);
    }
tot = tot.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");    
document.getElementById('vr_amount').value = tot;
    

var xarr = document.getElementsByName('pr_totalprice[]');
    for(var j=0;j<xarr.length;j++){
      var b = xarr[j].value;
      b = b.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      document.getElementsByName('pr_totalprice[]')[j].value = b;     
    }

</script>   -->           
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 

 <?php  } else {  redirect()->to('home')->send(); } ?> 