<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prequisitions extends Model
{
   public $primaryKey = 'pr_ID';
   protected $fillable = ['pr_number','pr_title', 'pr_name', 'pr_area' , 'pr_item' , 'pr_size' , 'pr_description' , 'pr_quantity' , 'pr_unitprice' , 'pr_totalprice'];
}
