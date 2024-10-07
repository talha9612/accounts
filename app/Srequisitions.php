<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Srequisitions extends Model
{
   public $primaryKey = 'sr_ID';
   protected $fillable = ['sr_number','sr_title', 'sr_name', 'sr_area' , 'sr_item' , 'sr_size' , 'sr_description' , 'sr_quantity', 'sr_status'];
}
