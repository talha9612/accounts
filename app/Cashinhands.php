<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashinhands extends Model
{
   public $primaryKey = 'cih_ID';
   protected $fillable = ['cih_title', 'cih_balance', 'cih_obalance'];
}
