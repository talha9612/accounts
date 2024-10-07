<!-- edit.blade.php -->
@extends('master')
@section('content')
<?php 
  if(isset(Auth::user()->companyview) && Auth::user()->companyview == '1')
      { ?>
<!-- WORK AREA START -->
  
           <h3 align="center" class="text-primary">
            Company View
          </h3>
          <br>

           <?php foreach ($records as $records):?>
              <div class="card-header bg-primary" id="headingOne">
                <h5 class="mb-0">
                  <a class="btn btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <i class="material-icons text-warning">account_circle</i> Company Details
                  </a>
                </h5>
              </div>
      <div align="right">
        <a href="javascript:printDiv('datatables')">Print</a><br>
        <iframe name="print_frame" width="0" height="0" frameborder="1" src="about:blank"></iframe>
        </div>
         <div id="div1">  
                <div class="card-body bg-light">
                 <div class="container">
                   <div> <h3 class="text-primary"> <?php echo $records->c_name; ?> <small><?php echo $records->c_type; ?></small></h3>  </div>
                    <div> <?php echo $records->c_adress; ?></div>   
                    <div><?php echo $records->c_area; ?></div>                                
                    <div><b><?php echo $records->c_city; ?></b></div>
                   </div>      
                @endforeach
 
<hr>                  </div>
<div align="center"><b>Contact Persons </b></div>
<hr> 
            <table width="100%">
              <thead class="bg-primary">
                <tr role="row" style="font-size: 14px;text-align: left">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Company</th>
                  <th>Designation</th>
                  <th>Cell #</th>
                  <th>Tel #</th>
                  <th>Ext #</th>
                  <th>Email</th>
                </tr>
              </thead>
              <tbody>
                 <?php foreach ($persons as $person):?>
                <tr style="font-size: 14px">
                  <td><?php echo $person->cp_ID; ?></td>
                  <td><?php echo $person->cp_name; ?></td>
                  <td><?php echo $person->c_name; ?></td>
                  <td><?php echo $person->cp_designation; ?></td>
                  <td><?php echo $person->cp_cell; ?></td> 
                  <td><?php echo $person->cp_tel; ?></td>
                  <td><?php echo $person->cp_ext; ?></td>
                  <td><?php echo $person->cp_email; ?></td>                 
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>    
                <br>
            <div align="center" >
              <a href="{{action('CompanyController@index')}}" class="btn btn-warning btn-raised">Cancel </a>  
              </div>
         
       <!-- WORK AREA END -->   
<script>
            printDivCSS = new String ('<head> <title> Star Automation </title><link href="{{asset("css/bootstrap-material-design.min")}}" rel="stylesheet" type="text/css"> </head> <div> <img src="{{asset("images/star.png")}}" width="20%" height="auto"></div>')
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById('div1').innerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();             
            }
</script> 
 @endsection  
 <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
 <?php  } else {  redirect()->to('home')->send(); } ?>