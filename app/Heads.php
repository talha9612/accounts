<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heads extends Model
{
    public $primaryKey = 'h_ID';
	 
    protected $fillable = ['h_name','h_type', 'h_stype', 'h_opbalance'];
}
