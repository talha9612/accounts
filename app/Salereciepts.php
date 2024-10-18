<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salereciepts extends Model
{
   public $primaryKey = 'sir_no';
   protected $fillable = ['sir_no','customer_name', 'sr_invoice', 'sr_head', 'sr_description', 'rec_amount', 'invoice_amount','sr_preparedby','fyear'];
}
