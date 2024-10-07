<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scvaluations extends Model
{
   public $primaryKey = 'sc_ID';
   protected $fillable = ['sc_number','sc_title', 'sc_name', 'sc_area' , 'sc_item' , 'sc_size' , 'sc_description' , 'sc_quantity' , 'sc_unitprice' , 'sc_totalprice' , 'sc_gst', 'sc_freight', 'sc_labour', 'sc_miscellaneous', 'sc_status'];
}
