<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
     public $primaryKey = 's_ID';
	 
    protected $fillable = ['s_name','s_number','s_company'];
}
