          @extends('master')             
          @section('content')

          <h3 align="center" style= "color: #3F729B">Summary Report</h3>
          
          <div class="card">
          <div class="card-header card-header-rose card-header-icon "style="background-color: #3F729B">
          <div class="card-icon">
          <i class="material-icons">assignment</i>
          </div>
          <h4 class="card-title text-white" style="background-color: #3F729B" >Summary Report</h4>
          <br>                 
          </div>
        
  

          <form method="post" action="{{url('quotes')}}">
            {{csrf_field()}}
          <div class="form-inline" style="margin-left: 25px">                                                         
          <div class="form-group"style="width: 20%">
          <label for="scat" style= "color: #3F729B">Select Category</label>
          <select class="form-control" type="select" id="scat" required name="scat" style="width: 30%">              
          <option value="A">A</option>
          <option value="B">B</option> 
          <option value="C">C</option>                       
          </select>
          </div>

          <div class="form-group">
          <label style= "color: #3F729B">From</label>
          <input type="date" style="width: 100%" name="sfdate" class="form-control">
          </div>                    
          <div class="form-group">
          <label style= "color: #3F729B">To</label>
          <input type="date" style="width: 100%" class="form-control" required name="stdate">
          </div>
          <button type="submit" class="material-icons btn-primary" style="border-radius: 6px;border-color: black; margin-top: 30px; margin-left: 10px; width: 60px" title="Search Record">double_arrow</button>
          <a href="{{action('QuotationController@showSreport',1)}}" class="btn btn-info btn-raised" style="border-radius: 6px;border-color: black; margin-top: 30px; margin-left: 10px; width: 100px">Reset</a>
          </div>
          </form>

          <div class="form-inline" style="margin-left: 25px" align="center">                                                         
          <div class="form-group">
          <?php foreach ($records as $record):?>
          <label style= "color: #3F729B">Total Quotations</label>
          <input type="number" readonly style="width: 98%" class="form-control" value="<?php echo $record->totalq; ?>">
          @endforeach
          </div>                    
          <div class="form-group">
          <?php foreach ($recordo as $recordso):?>
          <label style= "color: #3F729B">Total Orders Received</label>
          <input type="number" readonly style="width: 98%" class="form-control" value="<?php echo $recordso->totalo; ?>" >
          @endforeach
          </div>
          <div class="form-group">
          <?php foreach ($recordc as $recordsc):?>
          <label style= "color: #3F729B">Total Orders Cancelled</label>
          <input type="number" readonly style="width: 98%" class="form-control" value="<?php echo $recordsc->totalc; ?>">
          @endforeach
          </div>        
          </div>
          </div>
         
          <link href="{{asset('assets/material.css')}}" rel="stylesheet"/> 
          @endsection        