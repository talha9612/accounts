<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banktransactions extends Model
{
   // public $primaryKey = 'bkvr_no';
   protected $fillable = ['btvr_no', 'acc_title', 'acc_number' , 'bt_cqnumber', 'bt_cqdate', 'bt_sno', 'ex_ID', 'ex_name', 'bt_description', 'bt_amount'];
}

