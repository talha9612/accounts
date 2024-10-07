<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spayments extends Model
{
   public $primaryKey = 'sp_ID';
   protected $fillable = ['s_name','s_ID', 's_company', 'sp_amount' , 'vr_number'];
}
