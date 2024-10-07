<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bankreceipts extends Model
{
   public $primaryKey = 'brv_no';
   protected $fillable = ['acc_title', 'acc_number', 'br_cqnumber', 'br_cqdate', 'brv_no', 'br_sno', 'br_name', 'br_head', 'br_description', 'br_amount'];
}
