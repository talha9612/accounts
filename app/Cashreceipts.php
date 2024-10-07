<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashreceipts extends Model
{
   public $primaryKey = 'crv_no';
   protected $fillable = ['cih_title', 'crv_no', 'cr_sno', 'cr_name', 'cr_head', 'cr_description', 'cr_amount'];
}
