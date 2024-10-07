@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->stockedit) && Auth::user()->stockedit == '1')
      { ?>
             <form method="post" action="{{action('StockController@update', $product['ss_ID'])}}">
              {{csrf_field()}}
              <input name="_method" type="hidden" value="PATCH">
                <div class="container">
                  <h3 align="center">Edit</h3>
                    
                       <div class="form-group">
                       <label for="name" class="bmd-label-floating text-primary">Product: </label>
                        <input type="text" name="ss_item" class="form-control" value="<?php echo $product->ss_item; ?>">  
                      </div>
                        
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">ID:</label>
                          <input type="text" name="ss_i_ID" class="form-control" value="<?php echo $product->ss_ID; ?>">
                           </div>


                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Company: </label>
                          <input type="text" name="ss_supplier" class="form-control" value="<?php echo $product->ss_supplier; ?>">
                          
                        </div>
                     
                           <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Model:</label>
                          <input type="text" name="ss_size" class="form-control" value="<?php echo $product->ss_size; ?>"> 
                           
                         </div>


                         <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Specifications: </label>
                          <input type="text" name="ss_specs" class="form-control" value="<?php echo $product->ss_specs; ?>">
                          
                        </div>


                         <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Descriptions:</label>
                           <input type="text" name="ss_description" class="form-control" required value="<?php echo $product->ss_description; ?>">

                            <input type="hidden" name="ss_number" class="form-control" required value="<?php echo $product->ss_number; ?>">
                             <input type="hidden" name="ss_name" class="form-control" required value="<?php echo $product->ss_name; ?>">
                              <input type="hidden" name="ss_title" class="form-control" required value="<?php echo $product->ss_title; ?>">
                              <input type="hidden" name="lot_number" class="form-control" required value="<?php echo $product->lot_number; ?>">
                              <input type="hidden" name="ss_unitprice" class="form-control" required value="<?php echo $product->ss_unitprice; ?>">
                          
                        </div>
                     

                      <br>
                      <br>

                      <table class="table table-bordered">
                        <tr>
                          <!-- <td>
                            <label class="text-dark"> Unit Price </label>
                              <input type="text" name="ss_unitprice" class="form-control" required>
                          </td> -->
                          <td colspan="2">
                            <label class="text-dark"> Quantity </label>
                              <input type="text" name="ss_quantity" class="form-control" value="<?php echo $product->ss_quantity; ?>" required>
                          </td>
                          <td>
                            <label class="text-dark">Cost Unit Price</label>
                              <input type="text" name="ss_costunit" class="form-control" value="<?php echo $product->ss_costunit; ?>" required>
                          </td>
                        </tr>
                        <tr>
                          <td>
                              <label class="text-dark">Company</label>
                              <input class='form-control farmer_txt' type='text' data-type='farmercnic' id='farmercnic_1' name='s_company' value="<?php echo $product->s_company; ?>" required/>
                          </td>
                          <td>
                                <label class="text-dark">Supplier</label>
                                <input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_1' name='s_name' value="<?php echo $product->s_name; ?>" required /> 
                          </td>
                          <td>
                                <label class="text-dark">Supplier ID</label>
                                <input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_1' name='s_ID' readonly required value="<?php echo $product->s_ID; ?>"/>
                          </td>
                        </tr>
              
                      </table>
                     
                      <div align="center">
                        <a href="{{action('StockController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
                        <input type="submit" name="submit" class="btn btn-success btn-raised">
                      </div>

                </div> 
              </form>



<script type="text/javascript">
  $(document).on('focus','.farmer_txt',function(){
  type = $(this).data('type');
  
  if(type =='farmername' )autoType='s_name'; 
  if(type =='farmerid' )autoType='s_ID'; 
  if(type =='farmercnic' )autoType='s_company'; 
  
   $(this).autocomplete({
       minLength: 0,
       source: function( request, response ) {
            $.ajax({
                url: "{{ route('searchsupplier') }}",
                dataType: "json",
                data: {
                    term : request.term,
                    type : type,
                },
                success: function(data) {
                    var array = $.map(data, function (item) {
                       return {
                           label: item[autoType],
                           value: item[autoType],
                           data : item
                       }
                   });
                    response(array)
                }
            });
       },
       select: function( event, ui ) {
           var data = ui.item.data;           
           id_arr = $(this).attr('id');
           id = id_arr.split("_");
           elementId = id[id.length-1];
           $('#farmername_'+elementId).val(data.s_name);
           $('#farmerid_'+elementId).val(data.s_ID);
           $('#farmercnic_'+elementId).val(data.s_company);
       }
   }); 
});
 window.onbeforeunload = function() {
  return "Data will be lost if you leave the page, are you sure?";
  };
</script>        
@endsection
       <!-- WORK AREA END -->       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/>
 <?php  } else {  redirect()->to('home')->send(); } ?>  