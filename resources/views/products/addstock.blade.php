@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->productsedit) && Auth::user()->productsedit == '1')
      { ?>
              <form method="post" action="{{url('scvaluations')}}">
                  {{csrf_field()}}
                <div class="container">
                  <h3 align="center">+Add Products To Stock List</h3>
                   
                      <?php foreach ($products as $product):?>
                      
                       <div class="form-group">
                       <label for="name" class="bmd-label-floating text-primary">Product: </label>
                        <input type="text" name="ss_item" class="form-control" value="<?php echo $product->p_name; ?>">  
                      </div>
                        
                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">ID:</label>
                          <input type="text" name="ss_i_ID" class="form-control" value="<?php echo $product->p_ID; ?>">
                           </div>


                        <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Company: </label>
                          <input type="text" name="ss_supplier" class="form-control" value="<?php echo $product->s_company; ?>">
                          
                        </div>
                     
                           <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Model:</label>
                          <input type="text" name="ss_size" class="form-control" value="<?php echo $product->p_size; ?>"> 
                           
                         </div>


                         <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Specifications: </label>
                          <input type="text" name="ss_specs" class="form-control" value="<?php echo $product->p_specs; ?>">
                          
                        </div>


                         <div class="form-group">
                          <label for="name" class="bmd-label-floating text-primary">Descriptions:</label>
                           <input type="text" name="ss_description" class="form-control" required>
                          
                        </div>
                     
                      <?php endforeach; ?>
                   

                      <input type="hidden" name="ss_name" class="form-control" value="{{ Auth::user()->name }}">

                      <input type="hidden" name="addstock" class="form-control" value="addstock">

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
                              <input type="text" name="ss_quantity" class="form-control" required>
                          </td>
                          <td>
                            <label class="text-dark">Cost Unit Price</label>
                              <input type="text" name="ss_costunit" class="form-control" required>
                          </td>
                        </tr>
                        <tr>
                          <td>
                              <label class="text-dark">Company</label>
                              <input class='form-control farmer_txt' type='text' data-type='farmercnic' id='farmercnic_1' name='s_company' required/>
                          </td>
                          <td>
                                <label class="text-dark">Supplier</label>
                                <input class='form-control farmer_txt' type='text' data-type='farmername' id='farmername_1' name='s_name' required /> 
                          </td>
                          <td>
                                <label class="text-dark">Supplier ID</label>
                                <input class='form-control farmer_txt' type='text' data-type='farmerid' id='farmerid_1' name='s_ID' readonly required/>
                          </td>
                        </tr>
              
                      </table>
                     
                      <div align="center">
                        <a href="{{action('ProductController@index')}}" class="btn btn-warning btn-raised">Cancel</a>
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