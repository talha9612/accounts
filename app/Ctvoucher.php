<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ctvoucher extends Model
{
    public $primaryKey = 'vr_ID';
	 
    protected $fillable = ['voucher', 'vr_amount'];
}
