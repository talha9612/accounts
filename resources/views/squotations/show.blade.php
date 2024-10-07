@extends('master')
@section('content')

<?php
  if(isset(Auth::user()->salesview) && Auth::user()->salesview == '1')
      { ?>
<!-- WORK AREA START -->
           <h3 align="center" class="text-primary">
            View Record <small class="text-muted">(Sales Invoice)</small>
          </h3>
          <br>
        <?php foreach ($details as $details):?>
          <div class="container">
            <div class="form-inline">
                <div class="form-group">
                          <label for="pr_number" class="bmd-label-floating text-primary">Req No</label>
                          <input class="form-control" type='text' name='po_number' value="<?php echo $details->sq_number; ?>"  readonly/>
                </div>
                <div class="form-group" style="margin-left: 65%">
                          <input class="form-control" type='text' name='updated_at' value="<?php echo $details->updated_at; ?>" readonly />
                </div>
              </div> 
                   
                    <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Name</label>
                          <input class="form-control" type='text' id='po_name' name='po_name' value="<?php echo $details->sq_name; ?>" readonly/>
                    </div>
                    <div class="form-group">
                          <label for="bk_branch_code" class="bmd-label-floating text-primary">Req Title</label>
                          <input class="form-control" type='text' id='po_title' name='po_title' value="<?php echo $details->sq_title; ?>" readonly/> 
                    </div>
                     <div class="form-group" align="right">

                    <a href="{{action('SquotationController@printSq' , $details->sq_number)}}" style="text-decoration: none;" target="new" title="Print/PDF" <?php if ($details->sq_status == 0) {echo 'hidden';} else {}?>> <label>
                    Commercial Invoice </label>
                    <i class="material-icons text-warning">local_printshop</i> </a> 
                    <br>
                     <a href="{{action('SquotationController@printSqst' , $details->sq_number)}}" style="text-decoration: none;" target="new" title="Print/PDF" <?php if ($details->sq_status == 0) {echo 'hidden';} else {}?>> <label>
                    Sale Tax Invoice </label>
                    <i class="material-icons text-warning">local_printshop</i> </a> 
                      
                    </div>
                          
             
              <?php endforeach; ?>
           <table class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">ID 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Position: activate to sort column ascending">Item Name 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 15px;" aria-label="Office: activate to sort column ascending">Model </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Details: activate to sort column ascending">Quantity</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Details: activate to sort column ascending">Sale Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Details: activate to sort column ascending">Total Price</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 5px;" aria-label="Position: activate to sort column ascending">Sale Tax Rate 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Sale Tax Amount 
                  </th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Total (Inclusive Sale Tax) 
                  </th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Item Name</th>
                  <th rowspan="1" colspan="1">Model</th>
                  <th rowspan="1" colspan="1">Quantity</th>
                  <th rowspan="1" colspan="1">Sale Price</th>
                  <th rowspan="1" colspan="1">Total Price</th>
                  <th rowspan="1" colspan="1">Sale Tax Rate</th>
                  <th rowspan="1" colspan="1">Sale Tax Amount</th>
                  <th rowspan="1" colspan="1">Total (Inclusive Sale Tax)</th>
                </tr>
              </tfoot>
              <tbody>
               <?php foreach ($pass as $pass):?>
                <tr role="row" class="odd">
                  <td><?php echo $pass->sq_i_ID; ?></td>
                  <td><?php echo $pass->sq_item; ?></td>
                  <td><?php echo $pass->sq_size; ?></td>
                  <td><?php echo $pass->sq_quantity; ?></td>
                  <td><?php $subtotal =  number_format($pass->sq_saleprice, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sq_total, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sq_strate, 2, '.', ',');
                    echo $subtotal; ?></td>  
                  <td><?php $subtotal =  number_format($pass->sq_stamount, 2, '.', ',');
                    echo $subtotal; ?></td>
                  <td><?php $subtotal =  number_format($pass->sq_totalprice, 2, '.', ',');
                    echo $subtotal; ?></td>    
                </tr>
               <?php endforeach; ?>
              </tbody>
            </table>
         {{csrf_field()}}
            <div class="form-group">
                          <label for="bk_name" class="bmd-label-floating text-primary">Total Sale Tax</label>
                          <input class="form-control" type='text' id='sq_totalst' name='sq_totalst' value="<?php $subtotal =  number_format($pass->sq_totalst, 2, '.', ',');
                    echo $subtotal; ?>/-" readonly/>
                    </div>
              <div class="form-group">
                    <label for="bk_name" class="bmd-label-floating text-primary">Total (Exclusive Sale Tax)</label>
                    <input class="form-control" type='text' id='sq_totalesaletax' name='sq_totalesaletax' value="<?php $subtotal =  number_format($pass->sq_totalesaletax, 2, '.', ',');
                    echo $subtotal; ?>/-" readonly/>
                    </div>        
              <div class="form-group">
                    <label for="bk_name" class="bmd-label-floating text-primary">Total (Inclusive Sale Tax)</label>
                    <input class="form-control" type='text' id='sq_grandtotal' name='sq_grandtotal' value="<?php $subtotal =  number_format($pass->sq_grandtotal, 2, '.', ',');
                    echo $subtotal; ?>/-" readonly/>
                    </div>             
            <form action="{{action('GateoutwardController@create', $details->sq_number)}}" method="get" align="center"
              <?php if($details->sq_status == 1){echo "hidden";} else {} ?> >
                        <input type="hidden" name="sq_number" value="<?php echo $details->sq_number; ?>">
                        <button type="submit" class="btn btn-info">Outward Gatepass</button>
            </form>        

             </div>

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
            
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
  <?php  } else {  redirect()->to('home')->send(); } ?> 