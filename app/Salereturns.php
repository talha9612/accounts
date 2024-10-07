<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salereturns extends Model
{
    public $primaryKey = 'slr_ID';
   protected $fillable = ['slr_number','fr_ID', 'fr_name', 'fr_cnic' , 'lot_number', 'slr_title' , 'slr_name', 'slr_i_ID' , 'slr_item', 'slr_size', 'slr_description', 'slr_quantity', 'slr_saleprice'];
}
