<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Squotations extends Model
{
   public $primaryKey = 'sq_ID';
   protected $fillable = ['sq_number','fr_ID', 'fr_name', 'fr_cnic' , 'lot_number', 'sq_title' , 'sq_name' , 'sq_area' , 'sq_item', 'sq_size', 'sq_description', 'sq_quantity', 'sq_saleprice', 'sq_total', 'sq_totalprice'];
}
