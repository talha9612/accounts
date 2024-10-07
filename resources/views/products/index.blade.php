@extends('master')
@section('content')
<?php
  if(isset(Auth::user()->productsview) && Auth::user()->productsview == '1')
      { ?>
    <!-- WORK AREA START -->
   <h3 align="center" class="text-primary">
     View Record <small class="text-muted">(Products)</small>
      </h3>
    <div class="card">
        <div class="card-header card-header-rose card-header-icon bg-primary">
          <div class="card-icon">
            <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white">Products</h4>
          <?php
            if(isset(Auth::user()->productsadd) && Auth::user()->productsadd == '1')
                { ?>
          <div align="right"><a href="{{action('ProductController@create')}}" class="btn btn-success btn-raised" >+ Add New</a>
          </div>
            <?php } else {} ?>
        </div>
        <div class="card-body">
          <div class="toolbar">
            <!--   Here you can write extra buttons/actions for the toolbar  -->
          </div>
          <div class="material-datatables">
            <div id="datatables_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
              <div class="col-sm-12">
                <table id="datatables" class="table table-striped table-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
              <thead class="bg-primary">
                <tr role="row">
                  <th class="sorting_asc text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">ID</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 30px;" aria-label="Office: activate to sort column ascending">Company/Brand</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Position: activate to sort column ascending">Name</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 10px;" aria-label="Office: activate to sort column ascending">Model</th>
                  <th class="sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Office: activate to sort column ascending">Specifications</th>
                  <th class="disabled-sorting sorting text-white" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1" style="width: 20px;" aria-label="Actions: activate to sort column ascending">Actions</th>
                </tr>
              </thead>
              <tfoot class="bg-primary">
                <tr>
                  <th rowspan="1" colspan="1">ID</th>
                  <th rowspan="1" colspan="1">Company/Brand</th>
                  <th rowspan="1" colspan="1">Name</th>
                  <th rowspan="1" colspan="1">Model</th>
                  <th rowspan="1" colspan="1">Specifications</th>
                  <th rowspan="1" colspan="1" style="">Actions</th>
                </tr>
              </tfoot>
              <tbody>
                 <?php foreach ($products as $products):?>
                <tr role="row" class="odd">
                  <td tabindex="0" class="sorting_1"><?php echo $products->p_ID; ?></td>
                  <td><?php echo $products->s_company; ?></td>
                  <td><?php echo $products->p_name; ?></td>
                  <td><?php echo $products->p_size; ?></td>
                  <td><?php echo $products->p_specs; ?></td>
                  <td class="text-right">
                   <?php
                    if(isset(Auth::user()->productsedit) && Auth::user()->productsedit == '1')
                        { ?>
                    <a  href="{{action('ProductController@addStock' , $products->p_ID)}}" class="btn btn-sm btn-info"  title="view">+ATS</a>
                      <?php } else {} ?>

                     <?php
                    if(isset(Auth::user()->productsedit) && Auth::user()->productsedit == '1')
                        { ?> 
                    <a href="{{action('ProductController@edit', $products->p_ID)}}" class="btn btn-link btn-warning btn-just-icon edit" title="edit"><i class="material-icons">edit</i></a>
                    <?php } else {} ?>

                     <?php
                    if(isset(Auth::user()->productsdelete) && Auth::user()->productsdelete == '1')
                        { ?> 
                    <form action="{{action('ProductController@destroy', $products->p_ID)}}" method="post" style="display: inline">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-link btn-danger btn-just-icon remove" title="delete" type="submit"><i class="material-icons">close</i></button>
                    </form>
                     <?php } else {} ?>
                   </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          </div>
          </div>
           </div>
            </div>
             </div>
        <!-- end content-->
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


</script>        
@endsection
       <!-- WORK AREA END -->       
<link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
<?php  } else {  redirect()->to('home')->send(); } ?>