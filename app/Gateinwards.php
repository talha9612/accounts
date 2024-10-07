<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateinwards extends Model
{
   public $primaryKey = 'gi_ID';
   protected $fillable = ['gi_number','gi_title', 'gi_name', 'gi_area' , 'gi_item' , 'gi_size' , 'gi_description' , 'gi_quantity' , 'gi_received_by'];
}
