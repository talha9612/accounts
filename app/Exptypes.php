<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exptypes extends Model
{
   public $primaryKey = 'tp_ID';
   protected $fillable = ['tp_name','tp_type'];
}
