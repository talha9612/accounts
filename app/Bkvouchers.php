<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bkvouchers extends Model
{
     public $primaryKey = 'vr_ID';
	 
    protected $fillable = ['bkvr_no', 'acc_title', 'acc_number', 'bt_cqnumber', 'bt_cqdate', 'bkvr_amount'];
}
