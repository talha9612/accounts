<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brvouchers extends Model
{
   public $primaryKey = 'brv_no';
   protected $fillable = ['brv_no', 'acc_title', 'acc_number', 'br_cqnumber', 'br_cqdate', 'brv_amount'];
}
