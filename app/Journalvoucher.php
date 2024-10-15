<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journalvoucher extends Model
{
   public $primaryKey = 'jv_ID';
   protected $fillable = ['jv_no','jv_acc_ID', 'jv_acc_name', 'jv_acc_status' , 'jv_amount'];
   protected $dates = ['created_at', 'updated_at'];

}
