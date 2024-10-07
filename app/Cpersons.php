<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpersons extends Model
{
   public $primaryKey = 'cp_ID';
   	protected $fillable = ['cp_name','c_ID','c_name','cp_designation', 'cp_cell', 'cp_tel','cp_ext' ,'cp_email'];
}
