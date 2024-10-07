<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
   public $primaryKey = 'c_ID';
   	protected $fillable = ['c_name','c_adress', 'c_city', 'c_area' , 'c_type'];
}
