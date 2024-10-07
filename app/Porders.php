<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Porders extends Model
{
   public $primaryKey = 'po_ID';
   protected $fillable = ['po_number','po_title', 'po_name', 'po_area' , 'po_item' , 'po_size' , 'po_description' , 'po_quantity' , 'po_unitprice' , 'po_totalprice'];
}
