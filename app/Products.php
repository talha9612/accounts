<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
   public $primaryKey = 'p_ID';
	 
    protected $fillable = ['p_name','p_size'];
}
