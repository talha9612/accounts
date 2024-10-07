<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    public $primaryKey = 'ss_ID';
   protected $fillable = ['ss_number','ss_title', 'ss_name', 'ss_area', 's_name', 's_ID', 's_company', 'ss_item', 'ss_size', 'ss_description', 'ss_quantity', 'ss_unitprice', 'lot_number', 'ss_costunit'];
}
