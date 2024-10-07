<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accountsbks extends Model
{
   public $primaryKey = 'acc_ID';
   protected $fillable = ['acc_title', 'acc_number', 'acc_type', 'acc_balance', 'acc_opbalance', 'bk_branch_code' , 'bk_name'];
}
