<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crvoucher extends Model
{
    public $primaryKey = 'crv_no';
   protected $fillable = ['cih_title', 'crv_no', 'crv_amount', 'created_at' , 'updated_at'];
}
