<!-- create.blade.php -->
@extends('master')
@section('content')
    <?php
  if(isset(Auth::user()->cpaymentsadd) && Auth::user()->cpaymentsadd == '1')
      { ?>

    <h3 align="center" class="text-primary"> Add New Accounting Year </h3>
    <form method="post" action="{{ url('/year-save') }}">
        @csrf
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Starting Year</label>
                                <input type="number" name="start_year" id="year1" class="form-control" min="2010" max="2100"
                                    placeholder="YYYY" oninput="this.value=this.value.slice(0,4)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Ending Year</label>
                                <input type="number" name="end_year" id="year2" class="form-control" min="2010" max="2100"
                                    placeholder="YYYY" oninput="this.value=this.value.slice(0,4)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="accordion" class="col-md-12">
                <div align="center">
                    <a href="{{ action('CashtransactionController@index') }}" class="btn btn-warning btn-raised">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-raised" id="sbmt">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        // Optionally, you can add a simple script to handle the length of the input to 4 characters
        document.getElementById('year1', 'year2').addEventListener('input', function() {
            if (this.value.length > 4) {
                this.value = this.value.slice(0, 4);
            }
        });
    </script>
@endsection
<link href="{{ asset('assets/material.css') }}" rel="stylesheet" />
<?php  } else {  redirect()->to('home')->send(); } ?>
