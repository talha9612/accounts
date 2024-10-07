<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateoutwards extends Model
{
    public $primaryKey = 'go_ID';
   protected $fillable = ['go_number','fr_ID', 'fr_name', 'fr_cnic' , 'go_title' , 'go_name' , 'go_area' , 'lot_number' , 'go_item', 'go_size', 'go_quantity'];
}
