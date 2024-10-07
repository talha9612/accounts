<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
   public $primaryKey = 'bk_ID';
   protected $fillable = ['bk_name', 'bk_branch_code' , 'bk_address', 'bk_phone'];
}
