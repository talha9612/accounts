<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public $primaryKey = 'ss_ID';
   protected $fillable = ['sl_number','fr_ID', 'fr_name', 'fr_cnic' , 'lot_number', 'sl_title' , 'sl_name' , 'sl_area', 'sl_i_ID' , 'sl_item', 'sl_size', 'sl_description', 'sl_quantity', 'sl_saleprice', 'sl_total', 'sl_totalprice'];
}

