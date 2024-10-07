<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashtransactions extends Model
{
   public $primaryKey = 'vr_no';
   protected $fillable = ['ct_name', 'ct_head' , 'ct_description', 'ct_amount', 'ct_preparedby'];
}
