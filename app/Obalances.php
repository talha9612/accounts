<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obalances extends Model
{
   public $primaryKey = 'sub_ID';
	 
    protected $fillable = ['sub_ID','sub_name', 'ob_amount', 'ob_fyear'];
}
