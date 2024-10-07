<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mrreports extends Model
{
   public $primaryKey = 'mr_ID';
   protected $fillable = ['mr_number','mr_title', 'mr_name', 'mr_area' , 'mr_item' , 'mr_size' , 'mr_description' , 'mr_quantity' , 'mr_received_by' , 'lot_number'];
}
