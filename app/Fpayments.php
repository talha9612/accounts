<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fpayments extends Model
{
    public $primaryKey = 'fp_ID';
   protected $fillable = ['fr_name','fr_ID', 'fr_cnic', 'fp_amount' , 'vr_number'];
}
